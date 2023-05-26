<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['uuid'] = Str::uuid();
        $categories = Category::create($data);

        return response()->json(
            [
                'message' => 'categories saved successfully!',
                'categories' => $categories,
            ],
            200,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $category = Category::where('uuid', $uuid)->first();
        if (!$category) {
            return response()->json(
                [
                    'message' => 'Category not found',
                ],
                404,
            );
        }

        return response()->json([
            'categories' => $category,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $category = Category::where('uuid', $uuid)->first();

        if (!$category) {
            return response()->json(
                [
                    'message' => 'Category not found.',
                ],
                404,
            );
        }

        $data = $request->all();
        $category->update($data);

        return response()->json(
            [
                'message' => 'Category updated successfully!',
                'category' => $category,
            ],
            200,
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $category = Category::where('uuid', $uuid)->first();
        if (!$category) {
            return response()->json(
                [
                    'message' => 'Category not found.',
                ],
                404,
            );
        }

        $category->delete();

        return response()->json(
            [
                'message' => 'Category deleted successfully!',
            ],
            200,
        );
    }
}
