<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('query');

        $role = strtolower(auth()->user()->role);

        $quizzes = Quiz::when($keyword, function ($q) use ($keyword) {

            $q->where('judul','like',"%{$keyword}%")
              ->orWhere('kategori','like',"%{$keyword}%");

        });

        if($role == 'siswa'){
            $quizzes->where('status','approved');
        }

        $quizzes = $quizzes->latest()->get();

        $results = QuizResult::where('user_id', auth()->id())
                    ->with('quiz')
                    ->latest()
                    ->get();

        return view('quiz.index', compact(
            'quizzes',
            'keyword',
            'results'
        ));
    }

    public function create()
    {
        $role = strtolower(auth()->user()->role);

        if($role!='admin' && $role!='guru'){
            return redirect()->route('quiz.index')
            ->with('error','Tidak memiliki akses.');
        }

        return view('quiz.create');
    }

   public function store(Request $request)
    {
        $request->validate([

            'judul'        => 'required',
            'kategori'     => 'required',
            'jumlah_soal'  => 'required|numeric',
            'durasi'       => 'required|numeric|min:1'

        ]);

        Quiz::create([

            'judul'        => $request->judul,
            'kategori'     => $request->kategori,
            'jumlah_soal'  => $request->jumlah_soal,
            'durasi'       => $request->durasi,
            'pembuat'      => auth()->user()->name,
            'status'       => 'pending'

        ]);

        return redirect()
            ->route('quiz.index')
            ->with('success', 'Quiz berhasil dibuat dan menunggu ACC Admin.');
    }

    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);

        return view('quiz.show',compact('quiz'));
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);

        return view('quiz.edit',compact('quiz'));
    }

    public function update(Request $request,$id)
    {
        $quiz = Quiz::findOrFail($id);

        $quiz->update([

            'judul'=>$request->judul,
            'kategori'=>$request->kategori,
            'jumlah_soal'=>$request->jumlah_soal,

        ]);

        return redirect()->route('quiz.index')
        ->with('success','Quiz berhasil diubah');
    }

    public function destroy($id)
    {
        Quiz::findOrFail($id)->delete();

        return redirect()->route('quiz.index')
        ->with('success','Quiz berhasil dihapus');
    }

    public function approve($id)
    {
        $quiz = Quiz::findOrFail($id);

        $quiz->update([

            'status'=>'approved'

        ]);

        return redirect()->back()
        ->with('success','Quiz berhasil di-ACC');
    }

    public function results()
    {
        $results = QuizResult::with(['user','quiz'])
                    ->latest()
                    ->get();

        return view('quiz.results', compact('results'));
    }

}