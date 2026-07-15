<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$Roles): Response
    {
        // Cek user sudah login
        if (!$request->user()){
            return redirect('login');
        }
        //cek apakah user role ada di dalam role yang diizinkan
        if(in_array($request->user()->role, $Roles)){
            return $next($request);
        }
        //jika tidak ada akses maka diarahkan ke Dashboardar
        return redirect('/dashboard')->with('error', 'anda tidak dapat login dan mengakses ke laman ini!');
    }
}
