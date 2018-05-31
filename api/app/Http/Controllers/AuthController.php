<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Requests\RegisterFormRequest;

use Illuminate\Http\Request;
use JWTAuth;
use Auth;
use Captcha;
use Validator;
use App\Transformers\UserTransformer;

class AuthController extends Controller
{
    
    public function register(RegisterFormRequest $request)
    {
        $validator = Captcha::check_api($request->captcha, $request->key);
        if (!$validator) {
            return response()->json([
                'errors'=> [
                    'captcha'=> '验证码有误！'
                ],
                'message'=> 'The given data was invalid.'
            ]);
        } else {
            $user = new User;
            $card = uniqid();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->uId = md5($card);
            $user->card = $card;
            $user->password = bcrypt($request->password);
            $user->save();
            return response([
                'status' => 1,
                'msg' => '注册成功！',
                'data' => $user
            ], 200);
        }
    }
    public function login(Request $request)
    {
        $validator = Captcha::check_api($request->captcha, $request->key);
        if (!$validator) {
            return response()->json([
                'errors'=> [
                    'captcha'=> '验证码有误！'
                ],
                'message'=> 'The given data was invalid.'
            ]);
        } else {
            $credentials = $request->only('email', 'password');
            if ( ! $token = JWTAuth::attempt($credentials)) {
                return response([
                    'status' => 0,
                    'error' => 'invalid.credentials',
                    'msg' => '错误的邮箱或密码！'
                ], 400);
            }
            $user = User::where('email', $request->email)->first();
            $user->token = $token;
            $user->save();
            return response([
                'status' => 1,
                'msg'=>'登录成功！',
                'data'=>[
                    'token' => $token
                ]
            ]);
        }
    }
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user = fractal($user, new UserTransformer())->toArray();
        return response()->json($user);
    }
    
    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'status' => 1,
            'msg' => '成功退出系统！'
        ], 200);
    }
    public function refresh()
    {
        return response([
         'status' => 1,
         'msg'=>'token已更新！',
         'token'=>null
        ]);
    }
    public function captcha () {
        return captcha::create('flat', true);
    }
}
