<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class PositionStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   

        $positionStaffUuid = \DB::table('position')->where('uuid_staff',Auth::user()->uuid)->value('position_staff');
        $check = \DB::table('staff_position')->where('uuid',$positionStaffUuid)->value('position');
        if ($check !== 'Kiểm duyệt') {
            return back()->with('error_level','Bạn không đủ thẩm quyền để sử dụng chức năng này');
        }
        return $next($request);
    }
}
