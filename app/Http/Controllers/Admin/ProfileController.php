<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Requests\Website\UpdatedEmailRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
class ProfileController extends Controller
{   
    public function profile(){
        $data['admin'] = User::where('uuid',Auth::user()->uuid)->first();
        return view('admin.modules.profile.index',$data);
    }
    public function deleteHistory($uuid_history)
    {
        dd(123);
        // $history_user = DB::table('history')->where('uuid', $uuid_history);
        // if ($history_user->exists()) {
        //     $history_user->delete();
        //     return redirect()
        //         ->back()
        //         ->with('success', 'Xoá lịch sử xem bài viết thành công');
        // } else {
        //     dd(123);
        // }
    }
    public function updatedProfile(ProfileRequest $request)
    {   
        $uuid = Auth::user()->uuid;
        $user_current = User::where('uuid', $uuid)->first();
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();

        if (empty($request->avatar)) {
            $data['avatar'] = $user_current->avatar;
        } else {
            $image_path = public_path('images/users') . '/' . $user_current->avatar;
            $imageName = time() . '-' . $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('images/users'), $imageName);
            $data['avatar'] = $imageName;
        }
        User::where('uuid', $uuid)->update($data);

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công.');
    }

    public function updatedPassword(Request $request)
    {   $uuid = Auth::user()->uuid;
        $user = User::where('uuid', $uuid)->first();
        if($user->password !== NULL){
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()
                    ->back()
                    ->with('error', 'Mật khẩu cũ sai');
            }
        }

        if ($request->password != $request->password_confirm) {
            return redirect()
                ->back()
                ->with('error', 'Mật khẩu mới không khớp nhau');
        }

        if (strlen($request->password) < 6) {
            return redirect()
                ->back()
                ->with('error', 'Mật khẩu mới phải có ít nhất 6 ký tự');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật mật khẩu thành công.');
    }
    
    public function updatedEmail(UpdatedEmailRequest $request)
    {   $uuid = Auth::user()->uuid;
        $user = Auth::user();
        $currentEmail = $user->email;
        $newEmail = $request->input('email');

        // Generate a new email verification token
        $token = Str::random(60);

        // Update the user's email verification token and save the user
        $user->email_token = $token;
        $user->save();

        // Send a verification email to the new email
        Mail::to($newEmail)->send(new VerifyEmail($user, $newEmail, url('/verify_email/'.$token)));
     
        return redirect()
            ->back()
            ->with('success', 'Email của bạn đã được cập nhật, vui lòng xác nhận bên trong email ');
    }

    public function verifyEmail(Request $request, $token)
    {
        $user = User::where('email_token', $token)->first();

        if (!$user) {
            return response()->view('website.modules.error.index', [], 404);
        }
        $newEmail = $request->query('new_email');
        $user->email = $newEmail;
        $user->email_verified_at = now();
        $user->email_token = null;
        $user->updated_at = new \DateTime();
        $user->save();

        return redirect('admin.profile_admin.profile')->with('success', 'Email đã được cập nhật');
    }
}
