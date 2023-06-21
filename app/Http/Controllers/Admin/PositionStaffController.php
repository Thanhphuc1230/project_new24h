<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PositionStaff;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\PositionRequest;
class PositionStaffController extends Controller
{
    public function index(){
        $data['position'] = PositionStaff::paginate(10);
        return view('admin.modules.position.index',$data);
    }

    public function store(PositionRequest $request){

        $data = $request->all();

        $data['created_at'] = new \DateTime();
        $data['uuid'] = Str::uuid();
        PositionStaff::create($data);

        return redirect()->back()->with('success', 'Thêm chức vụ thành công');
    }

    public function status_position($uuid, $status)
    {
        PositionStaff::where('uuid', $uuid)->update(['status_position' => $status]);
        $mess = ($status == 1) ? 'Kích hoạt' : 'Tắt kích hoạt';
        return redirect()->back()->with('success', $mess . ' chức vụ thành công');
    }

    public function edit(string $uuid)
    {
        $position = PositionStaff::where('uuid', $uuid);

        if ($position->exists()) {
            $data['position'] = $position->first();
           
            return view('admin.modules.position.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update(PositionRequest $request,$uuid){
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();
        PositionStaff::where('uuid', $uuid)->update($data);

       return redirect()->route('admin.position.index')->with('success', 'Cập nhật chủ đề thành công.');
    }

    public function destroy($uuid){
        $position = PositionStaff::where('uuid', $uuid)->first();

        if ($position) {
            $position->delete();

            return back()->with('success', 'Xóa bài viết thành công.');
        } else {
            abort(404);
        }
    }
}
