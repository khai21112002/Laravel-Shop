<?php

// app/Http/Middleware/AdminMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập và có role là 1 (admin)
        if (Auth::check() && Auth::user()->role === 1) {
            return $next($request);
        }

        // Trả về lỗi 403 nếu không có quyền admin
        abort(403, 'You are not allowed to access this view');
    }
}

