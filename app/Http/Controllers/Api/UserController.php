<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return response()->json([
            'user' => $user,
        ]);
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

        return response()->json(
            [
                'message' => 'User saved successfully!',
                'user' => $user,
            ],
            200,
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
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

        return response()->json([
            'user' => $user,
        ]);
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

        return response()->json(
            [
                'message' => 'User updated successfully!',
                'user' => $user,
            ],
            200,
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
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

        return response()->json(
            [
                'message' => 'User deleted successfully!',
            ],
            200,
        );
    }
}
