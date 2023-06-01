<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::all();
        $responseData = [
            'status code' => 200,
            'data' => $user,
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
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        $responseData = [
            'status code' => 200,
            'data' => $user,
            'message' => 'create user success',
        ];

        return $this->checkAuthorization($request, $responseData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        if (!$user) {
            return response()->json(
                [
                    'message' => 'User not found',
                ],
                404,
            );
        }

        $responseData = [
            'status code ' => 200,
            'data' => $user,
        ];

        return $this->checkAuthorization($request, $responseData);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        if (!$user) {
            return response()->json(
                [
                    'message' => 'User not found.',
                ],
                404,
            );
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user->update($data);

        $responseData = [
            'status code ' => 200,
            'message' => 'user updated successfully!',
            'data' => $user,
        ];
        return $this->checkAuthorization($request, $responseData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->first();
        if (!$user) {
            return response()->json(
                [
                    'message' => 'User not found.',
                ],
                404,
            );
        }

        $user->delete();

        $responseData = [
            'status code ' => 200,
            'message' => 'user deleted successfully!',
        ];
        return $this->checkAuthorization($request, $responseData);
    }
}
