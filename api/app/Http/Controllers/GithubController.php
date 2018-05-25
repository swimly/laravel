<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;

class GithubController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/github');
        }
        return response()->json([
            'data'=>$user
        ]);
 
    }
}
