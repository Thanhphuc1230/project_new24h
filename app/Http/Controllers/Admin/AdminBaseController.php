<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class AdminBaseController extends Controller
{
    public function checkSessionAndLogout(Request $request)
    {   
        $uuid = Auth::user()->uuid;
        $user = User::where('uuid', $uuid)->first();

        //check wrong password more than 5 times
        if (!Hash::check($request->password, $user->password)) {
            $failedAttempts = session('login_failed_attempts', 0);
            $failedAttempts++;
            session()->put('login_failed_attempts', $failedAttempts);
    
            if ($failedAttempts >= 3) {
                Auth::logout();
                session()->forget('login_failed_attempts');
                return redirect()->route('getLogin')->with('error', 'Đã vượt quá số lần nhập mật khẩu sai, bạn đã đăng xuất');
            }
    
            return redirect()->back()->with('error_level', 'Mật khẩu không chính xác, quá 3 lần sẽ tự động đăng xuất');
        } else {
            session()->put('admin_check', true);
            session()->forget('login_failed_attempts');
            return redirect()->back()->with('success', 'Mật khẩu đúng, bây giờ bạn có thể chỉnh sửa');
        }
    }

    public function checkLevel($uuid){
        $check = User::where('uuid',$uuid)->value('level');
        if ($check !== 1) {
            throw new \Exception('Bạn không đủ quyền truy cập');
        }
    }
}
