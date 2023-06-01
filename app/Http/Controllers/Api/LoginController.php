<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SessionUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $dataCheckUser = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($dataCheckUser)) {
            $checkTokenExit = SessionUser::where('user_uuid', Auth::user()->uuid)->first();
            if (Auth::user()->level == 1) {
                if (empty($checkTokenExit)) {
                    $userSession = SessionUser::create([
                        'uuid' => Str::uuid(),
                        'token' => Str::random(40),
                        'refresh_token' => Str::random(40),
                        'token_expried' => date('Y-m-d H:i:s', strtotime('+7 days')),
                        'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+30 days')),
                        'user_uuid' => Auth::user()->uuid,
                    ]);
                } else {
                    $userSession = $checkTokenExit;
                }
                return response()->json(
                    [
                        'code' => 200,
                        'data' => $userSession,
                    ],
                    200,
                );
            } else {
                return response()->json(
                    [
                        'code' => 401,
                        'message' => 'Bạn không đủ thẩm quyền',
                    ],
                    401,
                );
            }
        } else {
            return response()->json(
                [
                    'code' => 401,
                    'message' => 'Email or password wrong',
                ],
                401,
            );
        }
    }
    public function refreshToken(Request $request){
        $token = $request->header('token');
        $checkTokenExit = SessionUser::where('token',$token)->first();
        
        //get time in session user
        $carbonDateTime = Carbon::parse($checkTokenExit->token_expried);
        if(!empty($checkTokenExit)){
            
            if($carbonDateTime->timestamp < time()){
                $checkTokenExit->update([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'token_expried' => date('Y-m-d H:i:s', strtotime('+7 days')),
                    'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+30 days')),
                ]);
            }
        }
        
        $dataSessionNew = SessionUser::find($checkTokenExit->id);
        return response()->json([
            'code' => 401,
            'data' => $dataSessionNew,
            'message' => 'refresh token success',
        ], 200);
    }
    public function deleteToken(Request $request){
        $token = $request->header('token');
        $checkTokenExit = SessionUser::where('token',$token)->first();
        if(!empty($checkTokenExit)){
            $checkTokenExit->delete();
        }
        return response()->json([
            'code' => 401,
            'data' => $dataSessionNew,
            'message' => 'detele token success',
        ], 200);
    }
}
