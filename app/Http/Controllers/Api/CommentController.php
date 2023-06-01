<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
class CommentController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $comment = Comment::join('news', 'comments.post_id_comment', '=', 'news.uuid')
            ->join('users', 'comments.user_id_comment', '=', 'users.uuid')
            ->select('comments.*', 'news.title', 'users.email')
            ->get();
        $responseData = [
            'status code' => 200,
            'data' => $comment,
        ];
        return $this->checkAuthorization($request, $responseData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['uuid'] = Str::uuid();
        $comment = Comment::create($data);

        $responseData = [
            'status code' => 200,
            'categories' => $comment,
            'message' => 'create comment success',
        ];
        return $this->checkAuthorization($request, $responseData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $uuid)
    {
        $comment = Comment::where('uuid', $uuid)->first();
        if (!$comment) {
            return response()->json(
                [
                    'message' => 'Comment not found',
                ],
                404,
            );
        }

        $responseData = [
            'status code ' => 200,
            'comment' => $comment,
        ];
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $comment = Comment::where('uuid', $uuid)->first();
        if (!$comment) {
            return response()->json(
                [
                    'message' => 'Comment not found.',
                ],
                404,
            );
        }

        $data = $request->all();
        $comment->update($data);

        $responseData = [
            'status code ' => 200,
            'message' => 'comment updated successfully!',
            'comment' => $comment,
        ];
        return $this->checkAuthorization($request, $responseData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $comment = Comment::where('uuid', $uuid)->first();
        if (!$comment) {
            return response()->json(
                [
                    'message' => 'Comment not found.',
                ],
                404,
            );
        }

        $comment->delete();

        $responseData = [
            'status code ' => 200,
            'message' => 'comment deleted successfully!',
        ];
        return $this->checkAuthorization($request, $responseData);
    }
}
