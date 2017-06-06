<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
class EmailController extends Controller
{
    public function verify($token)
    {
       $user = User::where('confirmation_token',$token)->first();
        if(is_null($user)){
            flash('邮箱验证失败','danger');
            return redirect('/');
        }

        $user->is_active = 1;
        $user->confirmation_token = str_random(40);
        $user->save();

        Auth::login($user);
        flash('邮箱验证成功','success');
        return redirect('/home');
   }
}
