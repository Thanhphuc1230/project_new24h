<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\NewsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Image;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        //check position staff
        $positionStaff = DB::table('position')
            ->where('uuid_staff', Auth::user()->uuid)
            ->value('category_id');

        $positionStaff = json_decode($positionStaff);
        $positionStaffUuid = DB::table('position')->where('uuid_staff',Auth::user()->uuid)->value('position_staff');
        $check = DB::table('staff_position')->where('uuid',$positionStaffUuid)->value('position');
        
        //search
        $searchQuery = $request->query('search');
        //create query
        $query = DB::table('news')
        ->join('categories', 'news.category_id', '=', 'categories.id_category')
        ->select('news.*', 'categories.name_cate')
        ->orderBy('categories.name_cate', 'asc');

        if (Auth::user()->level !== 1) {
            if($check == 'Kiểm duyệt'){
                $data['news'] = $query->whereIn('category_id',$positionStaff)
                ->paginate(10);
            }else{
                $data['news'] = $query
                ->where('uuid_author', Auth::user()->uuid)
                ->paginate(10);
            }
            $data['categories_select'] = Category::select('id_category', 'name_cate', 'parent_id')
                ->whereIn('id_category', $positionStaff)
                ->where('status_cate', 1)
                ->get();
        } else {
            $data['news'] = $query->paginate(10);
            $data['categories_select'] = Category::select('id_category', 'name_cate', 'parent_id')
                ->where('id_category','!=',1)
                ->where('status_cate', 1)
                ->get();
        }

        if ($searchQuery) {
            $query->where(function ($innerQuery) use ($searchQuery) {
                $innerQuery->where('categories.name_cate', 'like', '%' . $searchQuery . '%')
                    ->orWhere('news.title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('news.intro', 'like', '%' . $searchQuery . '%')
                    ->orWhere('news.status', '=', ($searchQuery === 'active' ? 1 : 0));;
            });
        }
        
        $data['news'] = $query->paginate(10);


        return view('admin.modules.news.index', $data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {
        $data = $request->except('_token');

        if (Auth::user()->level !== 1) {
            $data['status'] = 0;
        }
        $data['created_at'] = new \DateTime();
        $data['uuid'] = Str::uuid();
        $data['uuid_author'] = Auth::user()->uuid;

        $image = $request->avatar;
        $imageName = time() . '-' . $image->getClientOriginalName();

        $destinationPath = public_path('/images/news');
        $imgFile = Image::make($image->getRealPath());
        $imgFile
            ->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($destinationPath . '/' . $imageName);

        $data['avatar'] = $imageName;
        
        News::insert($data);

        return redirect()
            ->back()
            ->with('success', 'Đã đăng bài viết thành công');
    }

    public function status_news($uuid, $status)
    {
        News::where('uuid', $uuid)->update(['status' => $status]);

        $mess = $status == 1 ? 'Kích hoạt' : 'Tắt';
        return redirect()
            ->back()
            ->with('success', $mess . ' bài viết thành công');
    }

    public function hotNew($uuid, $hotNew)
    {
        News::where('uuid', $uuid)->update(['hot_new' => $hotNew]);

        $mess = $hotNew == 1 ? 'Kích hoạt' : 'Tắt kích hoạt';
        return redirect()
            ->back()
            ->with('success', $mess . ' hot new bài viết thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $new = News::where('uuid', $uuid);
        $positionStaff = DB::table('position')
            ->where('uuid_staff', Auth::user()->uuid)
            ->value('category_id');

        $positionStaff = json_decode($positionStaff);
        if ($new->exists()) {
            $data['new'] = $new->first();
            $data['categories_select'] = Category::select('id_category', 'name_cate', 'parent_id')
            ->whereIn('id_category', $positionStaff)
            ->where('status_cate', 1)
            ->get();
            return view('admin.modules.news.edit', $data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, string $uuid)
    {
        $new_current = News::where('uuid', $uuid)->first();

        $data = $request->except('_token');

        $data['updated_at'] = new \DateTime();

        if ($request->hasFile('avatar')) {
            $image_path = public_path('images/news') . '/' . $new_current->avatar;
            $imageName = time() . '-' . $request->avatar->getClientOriginalName();

            $request->avatar->move(public_path('images/news'), $imageName);

            // Resize the avatar image
            $destinationPath = public_path('images/news');
            $imgFile = Image::make($destinationPath . '/' . $imageName);
            $imgFile
                ->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save();

            $data['avatar'] = $imageName;

            if ($new_current->avatar && file_exists($image_path)) {
                unlink($image_path);
            }
        } else {
            $data['avatar'] = $new_current->avatar;
        }
        News::where('uuid', $uuid)->update($data);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Cập nhật bài viết thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $new = News::where('uuid', $uuid)->first();
        if ($new) {
            $imagePath = public_path('images/news/' . $new->avatar);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            DB::table('history')->where('uuid_post', $uuid)->delete();
            $new->delete();
            return back()->with('success', 'Xóa bài viết thành công.');
        } else {
            abort(404);
        }
    }
}
