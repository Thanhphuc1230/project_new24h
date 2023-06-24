<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\PositionStaff;
use App\Models\Position;
class PositionController extends Controller
{
    public function index(Request $request){

        $data['category_selected'] = Category::select('id_category', 'name_cate')->where('parent_id', 1)->where('status_cate',1)->get();
        $data['position'] = PositionStaff::select('uuid', 'position')->where('status_position',1)->get();
        $data['staff'] = User::select('uuid', 'fullname')->where('level','!=',3)->get();
        

        $data['position_staff'] = \DB::table('position')
        ->join('users','position.uuid_staff','=','users.uuid')
        ->join('staff_position','position.position_staff','=','staff_position.uuid')
        ->select('users.fullname','position.uuid','position.created_at','position.category_id','position.status_position','staff_position.position');

        $searchQuery = $request->query('search');
    
        if ($searchQuery) {
            $data['position_staff']->where(function ($innerQuery) use ($searchQuery) {
                $innerQuery->where('users.fullname', 'like', '%' . $searchQuery . '%')
                    ->orWhere('staff_position.position', 'like', '%' . $searchQuery . '%');
            });
        }
        
        $data['position_staff'] = $data['position_staff']->paginate(10);


        return view('admin.modules.position.index',$data);
    }

    public function status_position($uuid, $status)
    {
        Position::where('uuid', $uuid)->update(['status_position' => $status]);

        $mess = ($status == 1) ? 'Kích hoạt' : 'Tắt';
        return redirect()->back()->with('success', $mess . ' phân quyền thành công');
    }

    public function store(Request $request){

        $data= $request->all();
        $category_id = $request->input('category_id');

        $data['category_id'] = json_encode($category_id);
        $data['uuid'] = \Str::uuid();
        Position::create($data);

        return back()
            ->with('success', 'Đã phân quyền nhân viên thành công');
    }

    public function edit(string $uuid)
    {   

        $position = \DB::table('position')
        ->join('users','position.uuid_staff','=','users.uuid')
        ->select('users.fullname','position.uuid','position.created_at','position.category_id','position.status_position','position.position_staff')
        ->where('position.uuid',$uuid);

        if ($position->exists()) {
            $data['position'] = $position->first();
            $data['category_selected'] = Category::select('id_category', 'name_cate')->where('parent_id', 1)->where('status_cate',1)->get();
            $data['staff_positions'] = PositionStaff::select('uuid', 'position')->where('status_position',1)->get();
            return view('admin.modules.position.edit',$data);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $uuid){
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();
        Position::where('uuid', $uuid)->update($data);

        return redirect()->route('admin.position.index')->with('success', 'Cập nhật chủ đề thành công.');
    }

    public function destroy( $uuid)
    {   
        $position = Position::where('uuid', $uuid);

        if ($position->exists()) {
            $position->delete();
            return back()->with('success', 'Xóa chủ đề thành công.');
        } else {
            abort(404);
        }
    }
}
