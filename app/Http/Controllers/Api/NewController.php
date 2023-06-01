<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Str;
class NewController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $news = News::all();
        $responseData = [
            'status code' => 200,
            'data' => $news,
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
        $news = News::create($data);

        $responseData = [
            'status code' => 200,
            'categories' => $news,
            'message' => 'create news success',
        ];
        return $this->checkAuthorization($request, $responseData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $uuid)
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

        $responseData = [
            'status code ' => 200,
            'news' => $news,
        ];
        return $this->checkAuthorization($request, $responseData);
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

        $responseData = [
            'status code ' => 200,
            'message' => 'news updated successfully!',
            'news' => $news,
        ];

        return $this->checkAuthorization($request, $responseData);
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

        $responseData = [
            'status code ' => 200,
            'message' => 'news deleted successfully!',
        ];
        return $this->checkAuthorization($request, $responseData);
    }
}
