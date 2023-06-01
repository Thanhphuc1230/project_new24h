<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SessionUser;
class BaseController extends Controller
{
     function checkAuthorization(Request $request,$data)
    {
        $token = $request->header('token');
        $checkTokenUser = SessionUser::where('token', $token)->first();

        if (empty($token)) {
            return response()->json([
                'code' => 401,
                'message' => "Token không được gửi qua header"
            ], 401);
        } elseif (empty($checkTokenUser)) {
            return response()->json([
                'code' => 401,
                'message' => "Token không hợp lệ",
            ], 401);
        }else{
            return $data;
        }
    }
}
