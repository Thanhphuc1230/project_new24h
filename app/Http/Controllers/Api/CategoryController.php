<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\SessionUser;
class CategoryController extends BaseController
{   
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $categories = Category::all();
        $responseData = [
            'status code' => 200,
            'data' => $categories,
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
        $data['status_cate'] = 0;
        $categories = Category::create($data);

        $responseData = [
            'status code' => 200,
            'categories' => $categories,
            'message' => "create categories success",
        ];
    
        return $this->checkAuthorization($request, $responseData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request ,$uuid)
    {
        $category = Category::where('uuid', $uuid)->first();
        if (!$category) {
            return response()->json(
                [
                    'message' => 'Category not found',
                ],
                404
            );
        }
    
        $responseData = [
            'status code ' => 200,
            'categories' => $category,
        ];
    
        return $this->checkAuthorization($request, $responseData);
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

        $responseData = [
            'status code ' => 200,
            'message' => 'Category updated successfully!',
            'category' => $category,
        ];
        return $this->checkAuthorization($request, $responseData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$uuid)
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

        $responseData = [
        'status code ' => 200,
        'message' => 'Category deleted successfully!',
    ];

        return $this->checkAuthorization($request, $responseData);
    }
}
