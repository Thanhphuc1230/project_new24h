<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AdminAuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uuid = Auth::user()->uuid;
        $this->checkLevel($uuid);

        return $next($request);
    }
    private function checkLevel($uuid)
    {
        $check = User::where('uuid', $uuid)->value('level');

        if ($check !== 1) {
            return back()->with('error_level','Bạn không đủ thẩm quyền để sử dụng chức năng này');
        }
    }
}
