<?php

namespace App\Http\Controllers\Login;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
class SocialController extends Controller
{   

    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    
    public function callbackSocial(Request $request, $provider){

        try {
            $social_user =  Socialite::driver($provider)->user();
            $user = User::where('provider_id',$social_user->getId())->first();
            $checkEmail = User::where('email',$social_user->email)->first();
            if(!$user){
                if(!$checkEmail){
                    $new_user = User::create([
                        'uuid' => Str::uuid(),
                        'fullname' => $social_user->getName(),
                        'email' => $social_user->email,
                        'provider'=>$provider,
                        'provider_id' => $social_user->id,
                        'email_verified_at' => new \DateTime(),
                        'created_at' =>  new \DateTime(),
                        'level' => 3,
                        
                    ]);
                    Auth::login($new_user);
                    return redirect()->route('website.index')->with('success', 'Đăng nhập thành công bằng tài khoản '.$provider);
                }else{
                    return redirect()->route('getLogin')->with('error','Email này đã được đăng ký với '.$checkEmail->provider);
                }
               
            }else{
                Auth::login($user);
                return redirect()->route('website.index')->with('success', 'Đăng nhập thành công bằng tài khoản '.$provider);
            }
        } catch(\throwable $th){
            dd('Some thing went wrong' .$th->getMessage());
        }
    }
}
