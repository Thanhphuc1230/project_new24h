<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ProfileController extends Controller
{
    public function profile($uuid)
    {   
        $data['profile'] = User::where('uuid', $uuid)->first();
        if (!$data['profile']) {
            return response()->view('website.modules.error.index', [], 404);
        }
        $data['comments'] = DB::table('comments')
            ->join('news', 'comments.post_id_comment', '=', 'news.uuid')
            ->select('news.uuid', 'news.title', 'comments.uuid as Cuuid', 'comments.comment', 'comments.status_comment', 'comments.created_at')
            ->where('comments.user_id_comment', $uuid)
            ->get();
        $data['history'] = DB::table('history')
            ->join('news', 'history.id_post', '=', 'news.uuid')
            ->select('news.uuid', 'news.title', 'history.created_at', 'history.uuid as Huuid')
            ->where('history.user_id', $uuid)
            ->get();

        $data['save_post'] = DB::table('save_post')
            ->join('news', 'save_post.id_post', '=', 'news.uuid')
            ->select('news.uuid', 'news.title', 'save_post.created_at', 'save_post.uuid as Suuid')
            ->where('save_post.user_id', $uuid)
            ->get();
        return view('website.modules.account.profile', $data);
    }

    public function deleteHistory($uuid_history)
    {
        $history_user = Db::table('history')->where('uuid', $uuid_history);

        if ($history_user->exists()) {
            $history_user->delete();
            return redirect()
                ->back()
                ->with('success', 'Xoá lịch sử xem bài viết thành công');
        } else {
            return response()->view('website.modules.error.index', [], 404);
        }
    }

    public function deleteComment($uuid_comment)
    {
        $comment_user = Db::table('comments')->where('uuid', $uuid_comment);

        if ($comment_user->exists()) {
            $comment_user->delete();
            return redirect()
                ->back()
                ->with('success', 'Xoá bài luận thành công');
        } else {
            return response()->view('website.modules.error.index', [], 404);
        }
    }

    public function deleteSavePost($uuid_save_post)
    {
        $save_post = Db::table('save_post')->where('uuid', $uuid_save_post);
        if ($save_post->exists()) {
            $save_post->delete();
            return redirect()
                ->back()
                ->with('success', 'Xoá bài viết đã lưu thành công');
        } else {
            return response()->view('website.modules.error.index', [], 404);
        }
    }

    public function editComment($uuid)
    {
        $data['comment_user'] = DB::table('comments')
            ->join('news', 'comments.post_id_comment', '=', 'news.uuid')
            ->select('news.uuid', 'news.title', 'comments.uuid as Cuuid', 'comments.comment', 'comments.status_comment', 'comments.created_at')
            ->where('comments.uuid', $uuid)
            ->first();
        return view('website.modules.account.edit_profile', $data);
    }

    public function updatedComment(Request $request, $uuid)
    {
        $data = [
            'comment' => $request->input('comment'),
            'updated_at' => new \DateTime(),
        ];

        DB::table('comments')
            ->where('uuid', $uuid)
            ->update($data);

        return redirect('/profile/' . Auth::user()->uuid)->with('success', 'Chỉnh sửa comment thành công.');
    }

    public function updatedProfile(Request $request, $uuid)
    {
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

        return redirect('/profile/' . Auth::user()->uuid)->with('success', 'Chỉnh sửa thông tin thành công.');
    }

    public function updatedPassword(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        // Check if old password is correct
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()
                ->back()
                ->with('error', 'Mật khẩu cũ sai');
        }

        // Check if new password and confirm password match
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

        return redirect('/profile/' . Auth::user()->uuid)->with('success', 'Password updated successfully.');
    }

    public function updatedEmail(Request $request, $uuid)
    {
        $user = Auth::user();
        $currentEmail = $user->email;
        $newEmail = $request->input('email');

        // Validate the email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Generate a new email verification token
        $token = Str::random(60);

        // Update the user's email verification token and save the user
        $user->email_verification_token = $token;
        $user->save();

        // Send a verification email to the new email
        Mail::to($newEmail)->send(new VerifyEmail($user, $newEmail, url('/verify_email/'.$token)));
     
        return redirect()
            ->back()
            ->with('success', 'Email của bạn đã được cập nhật, vui lòng xác nhận bên trong email ');
    }

    public function verifyEmail(Request $request, $token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return response()->view('website.modules.error.index', [], 404);
        }
        $newEmail = $request->query('new_email');
        $user->email = $newEmail;
        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->updated_at = new \DateTime();
        $user->save();

        return redirect('/')->with('success', 'Email đã được cập nhật');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/get_login');
    }
}
