<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;
class NewController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        return response()->json([
            'news' => $news,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['uuid'] = Str::uuid();
        $news = News::create($data);

        return response()->json(
            [
                'message' => 'News saved successfully!',
                'news' => $news,
            ],
            200,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $news = News::where('uuid', $uuid)->first();
        if (!$news) {
            return response()->json(
                [
                    'message' => 'News not found',
                ],
                404,
            );
        }

        return response()->json([
            'news' => $news,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $news = News::where('uuid', $uuid)->first();

        if (!$news) {
            return response()->json(
                [
                    'message' => 'News not found.',
                ],
                404,
            );
        }

        $data = $request->all();
        $news->update($data);

        return response()->json(
            [
                'message' => 'news updated successfully!',
                'category' => $news,
            ],
            200,
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $news = News::where('uuid', $uuid)->first();
        if (!$news) {
            return response()->json(
                [
                    'message' => 'News not found.',
                ],
                404,
            );
        }

        $news->delete();

        return response()->json(
            [
                'message' => 'News deleted successfully!',
            ],
            200,
        );
    }
}
