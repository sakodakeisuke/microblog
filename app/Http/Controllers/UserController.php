<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show($user)
    {
        $user = User::find($user);
    
        return view('users.show',[
            'title'=>'プロフィール',
            'user' => $user,
            'user_blogs' => $user->blogs()->latest()->get(),
        
        ]);
    
    }
}
