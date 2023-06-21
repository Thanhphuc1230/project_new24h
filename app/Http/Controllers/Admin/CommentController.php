<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $data['comments'] = Comment::join('news', 'comments.post_uuid_comment', '=', 'news.uuid')
        ->join('users', 'comments.user_uuid_comment', '=', 'users.uuid')
        ->select('comments.*', 'news.title', 'users.email')
        ->paginate(10);

        return view('admin.modules.comment.index',$data);
    }

    /**
     * Show the form for status a new resource.
     */
    public function status_comment($uuid,$status){

        Comment::where('uuid',$uuid)->update(['status_comment'=>$status]);

        return redirect()->back()->with('success', 'Xét duyệt comment thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Comment::join('news', 'comments.post_uuid_comment', '=', 'news.uuid')
        ->join('users', 'comments.user_uuid_comment', '=', 'users.uuid')
        ->select('comments.*', 'news.title', 'users.email')
        ->where('comments.uuid', $id)
        ->first();
        if ($comment->exists()) {
            $data['comment'] = $comment;
     
            return view('admin.modules.comment.edit',$data);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();
        Comment::where('uuid', $id)->update($data);

       return redirect()->route('admin.comment.index')->with('success', 'Cập nhật Comment người dùng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        $new = DB::table('comments')->where('uuid',$uuid);

        if ($new->exists()) {
            $new->delete();
            return back()->with('success', 'Xóa comments thành công');
        } else {
            abort(404);
        }
    }

}
