<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Website\AccountRequest;
use App\Http\Requests\Website\UpdatedEmailRequest;
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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
class ProfileController extends Controller
{

    public function profile()
    {   
        
        if (empty($uuid = optional(Auth::user())->uuid)) {
            return redirect()->route('website.index')->with('success', 'Hiện tại bạn chưa đăng nhập');
        } 
        $data['profile'] = User::where('uuid', $uuid)->first();
        $data['comments'] = DB::table('comments')
            ->join('news', 'comments.post_uuid_comment', '=', 'news.uuid')
            ->select('news.uuid', 'news.title', 'comments.uuid as Cuuid', 'comments.comment', 'comments.status_comment', 'comments.created_at')
            ->where('comments.user_uuid_comment', $uuid)
            ->get();
        $data['history'] = DB::table('history')
            ->join('news', 'history.uuid_post', '=', 'news.uuid')
            ->select('news.uuid', 'news.title', 'history.created_at', 'history.uuid as Huuid')
            ->where('history.user_uuid', $uuid)
            ->get();
        
        $data['save_post'] = DB::table('save_post')
            ->join('news', 'save_post.uuid_post', '=', 'news.uuid')
            ->select('news.uuid', 'news.title', 'save_post.created_at', 'save_post.uuid as Suuid')
            ->where('save_post.user_uuid', $uuid)
            ->get();
        return view('website.modules.account.profile', $data);
    }

    public function deleteHistory($uuid_history)
    {    

        $history_user = DB::table('history')->where('uuid', $uuid_history);
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

        $comment_user = DB::table('comments')->where('uuid', $uuid_comment);
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
            ->join('news', 'comments.post_uuid_comment', '=', 'news.uuid')
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

            return redirect()->route('website.profile')->with('success', 'Cập nhật thông tin thành công.');
    }

    public function updatedProfile(AccountRequest $request, $uuid)
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
            //delete old images
            if ($user_current->avatar && file_exists($image_path)) {
                unlink($image_path);
            }
        }
        User::where('uuid', $uuid)->update($data);

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công.');
    }

    public function updatedPassword(Request $request, $uuid)
    {   
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

    public function updatedEmail(UpdatedEmailRequest $request, $uuid)
    {
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

        return redirect('/')->with('success', 'Email đã được cập nhật');
    }
}