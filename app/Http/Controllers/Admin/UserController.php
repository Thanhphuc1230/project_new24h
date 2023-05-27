<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::select('uuid', 'fullname', 'email', 'avatar', 'created_at', 'level', 'status_user')->get();
        return view('admin.modules.user.index', $data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->except('_token', 'password_confirmation');
        $data['password'] = Hash::make($request->password);
        $data['created_at'] = new \DateTime();
        $data['uuid'] = Str::uuid();
        $data['status_user'] = '1';

        $image = $request->avatar;
        $imageName = time() . '-' . $image->getClientOriginalName();

        $destinationPath = public_path('/images/users');
        $imgFile = Image::make($image->getRealPath());
        $imgFile
            ->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($destinationPath . '/' . $imageName);

        $data['avatar'] = $imageName;

        User::insert($data);

        return redirect()
            ->back()
            ->with('success', 'Thêm thành viên thành công');
    }

    public function status_user($uuid, $status)
    {
        User::where('uuid', $uuid)->update(['status_user' => $status]);

        return redirect()
            ->back()
            ->with('success', 'Người dùng đã bị chặn đăng nhập');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('uuid', $id);

        if ($user->exists()) {
            $data['user'] = $user->first();
            return view('admin.modules.user.edit', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user_current = User::where('uuid', $id)->first();
        $data = $request->except('_token', 'password_confirmation');
        $data['updated_at'] = new \DateTime();

        if (empty($request->password)) {
            $data['password'] = $user_current->password;
        } else {
            $request->validate(
                [
                    'password' => 'min:8',
                ],
                [
                    'password.min' => 'Mật khẩu ít nhất 8 ký tự',
                ],
            );
            $data['password'] = bcrypt($request->password);
        }
        if (empty($request->avatar)) {
            $data['avatar'] = $user_current->avatar;
        } else {
            $image_path = public_path('images/users') . '/' . $user_current->avatar;
            $imageName = time() . '-' . $request->avatar->getClientOriginalName();
            $request->avatar->move(public_path('images/users'), $imageName);
            $data['avatar'] = $imageName;

            if ($user_current->avatar && file_exists($image_path)) {
                unlink($image_path);
            }
        }

        User::where('uuid', $id)->update($data);
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Successfully updated');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('uuid', $id);
        $history_user = DB::table('history')->where('user_id', $id);
        $save_post = DB::table('save_post')->where('user_id', $id);
        if ($user->exists()) {
            $user->delete();
            $history_user->delete();
            $save_post->delete();
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Xóa người dùng thành công.');
        } else {
            abort(404);
        }
    }
}
