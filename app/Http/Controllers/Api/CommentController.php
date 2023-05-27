<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
class CommentController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $comment = Comment::join('news', 'comments.post_id_comment', '=', 'news.uuid')
            ->join('users', 'comments.user_id_comment', '=', 'users.uuid')
            ->select('comments.*', 'news.title', 'users.email')
            ->get();
        return response()->json([
            'comment' => $comment,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['uuid'] = Str::uuid();
        $comment = Comment::create($data);

        return response()->json(
            [
                'message' => 'comment saved successfully!',
                'comment' => $comment,
            ],
            200,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
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

        return response()->json([
            'comment' => $comment,
        ]);
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

        return response()->json(
            [
                'message' => 'Comment updated successfully!',
                'comment' => $comment,
            ],
            200,
        );
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

        return response()->json(
            [
                'message' => 'Comment deleted successfully!',
            ],
            200,
        );
    }
}
