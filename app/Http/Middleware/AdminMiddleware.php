<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //nếu không đăng nhập và không phải là admin thì không đc phép truy cập
        if (!Auth::check() || !Auth::user()->isRoleAdmin()) {
            if (Auth::check()) {
                return redirect()->route('home');
            }
            return redirect()->route('login')->withErrors(['email' => 'Bạn không có quyền truy cập vào trang quản trị.']);
        }

        return $next($request);
    }
}

