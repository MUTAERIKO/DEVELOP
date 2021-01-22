<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use Socialite;


class AuthController extends Controller
{
    public function redirectToProvider()
  {
  return Socialite::driver('github')->redirect();
  }
  
  
  public function handleProviderCallback()
  {
  $user = Socialite::driver('github')->user();
  dd($user);
  }
  
  
  
     public function redirectToGoogle()
    {
        // Google へのリダイレクト
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $gUser = Socialite::driver('google')->stateless()->user();
        // email が合致するユーザーを取得
        $user = User::where('email', $gUser->email)->first();
        // 見つからなければ新しくユーザーを作成
        if ($user == null) {
            $user = $this->createUserByGoogle($gUser);
        }
        // ログイン処理
        \Auth::login($user, true);
        return redirect('/home');
    }

    public function createUserByGoogle($gUser)
    {
        $user = User::create([
            'name'     => $gUser->name,
            'email'    => $gUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }
}