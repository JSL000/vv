<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Book;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanPass
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $pass = false;
        $user = $request->user();
        // dd($user);
        // $books = Book::get();
        // if ($books[0]) {
        //     return redirect('/');
        // }
        if(!$user) {
            return redirect('/');
        }
        return $next($request);
    }
}
