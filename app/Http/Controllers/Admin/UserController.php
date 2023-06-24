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
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchQuery = $request->query('search');

        $query = User::query()->where('level', 3);

        if ($searchQuery) {
            $query->where(function ($innerQuery) use ($searchQuery) {
                $innerQuery->where('fullname', 'like', '%' . $searchQuery . '%')
                    ->orWhere('email', 'like', '%' . $searchQuery . '%');
            });
        }

        $data['users'] = $query->paginate(10);
        return view('admin.modules.user.index', $data);
    }

    public function list(Request $request)
    {   

        $searchQuery = $request->query('search');

        $query = User::query()->where('level','!=', 3);

        if ($searchQuery) {
            $query->where(function ($innerQuery) use ($searchQuery) {
                $innerQuery->where('fullname', 'like', '%' . $searchQuery . '%')
                    ->orWhere('email', 'like', '%' . $searchQuery . '%');
            });
        }

        $data['users'] = $query->paginate(10);

     
        return view('admin.modules.user.listStaff',$data);
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

        $mess = ($status == 1) ? 'Kích hoạt' : 'Chặn';
        return redirect()->back()->with('success', $mess . ' người dùng thành công');
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
    public function update(UserRequest $request, string $uuid)
    {
        $user_current = User::where('uuid', $uuid)->first();
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
        if ($request->hasFile('avatar')) {
            $image_path = public_path('images/users') . '/' . $user_current->avatar;
            $imageName = time() . '-' . $request->avatar->getClientOriginalName();
    
            $request->avatar->move(public_path('images/users'), $imageName);
    
            // Resize the avatar image
            $destinationPath = public_path('images/users');
            $imgFile = Image::make($destinationPath . '/' . $imageName);
            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
    
            $data['avatar'] = $imageName;
    
            if ($user_current->avatar && file_exists($image_path)) {
                unlink($image_path);
            }
        } else {
            $data['avatar'] = $user_current->avatar;
        }



        User::where('uuid', $uuid)->update($data);
        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Successfully updated');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        $imagePath = public_path('images/users') . '/' . $user->avatar;

        if ($user) {
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $user->delete();
            DB::table('history')
                ->where('user_id', $id)
                ->delete();
            DB::table('save_post')
                ->where('user_id', $id)
                ->delete();

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Xóa người dùng thành công.');
        } else {
            abort(404);
        }
    }
}
