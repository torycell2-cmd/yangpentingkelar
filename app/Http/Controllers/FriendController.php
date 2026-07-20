<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function addFriend($friend_id)
{
    $user = Auth::user();

        if ($user->id == $friend_id) {
            return back()->with('error', 'Tidak bisa menambahkan diri sendiri!');
        }

    // Cek apakah sudah ada relasi (pending atau accepted)
        $exists = $user->friends()->where('friend_id', $friend_id)->exists();

        if (!$exists) {
            // Gunakan attach dengan data tambahan 'status'
            $user->friends()->attach($friend_id, ['status' => 'pending']);
            return back()->with('success', 'Permintaan pertemanan dikirim!');
        }

        return back()->with('error', 'Permintaan sudah pernah dikirim!');
    }

    public function acceptFriend($friend_id)
    {
        $user = auth()->user();

        $user->friendRequests()->detach($friend_id);
        $user->friends()->detach($friend_id);

        $user->friends()->attach($friend_id, ['status' => 'accepted']);
    
        $friend = \App\Models\User::find($friend_id);
        $friend->friends()->attach($user->id, ['status' => 'accepted']);

        return back()->with('success', 'Pertemanan berhasil di-acc!');
    }
    public function index()
    {
        $user = auth()->user();

        $friends = \App\Models\User::whereHas('friends', function($query) use ($user) {
            $query->where('friend_id', $user->id)->where('status', 'accepted');
        })->orWhereHas('friendRequests', function($query) use ($user) {
            $query->where('user_id', $user->id)->where('status', 'accepted');
        })->get();

        $receivedRequests = $user->friendRequests()->wherePivot('status', 'pending')->get();
        $sentRequests = $user->friends()->wherePivot('status', 'pending')->get();
        $pendingRequests = $receivedRequests->merge($sentRequests);

        $suggestedUsers = \App\Models\User::where('id', '!=', $user->id)
            ->whereNotIn('id', $friends->pluck('id'))
            ->whereNotIn('id', $pendingRequests->pluck('id'))
            ->get();

        return view('friends.index', compact('friends', 'pendingRequests', 'suggestedUsers'));
    }

    public function unfriend($friend_id)
    {
    // Menghapus relasi pertemanan
        auth()->user()->friends()->detach($friend_id);
        return back()->with('success', 'Teman berhasil dihapus.');
    }
}