<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show($recommended_user)
    {
        $user = User::find($recommended_user);
    
        return view('users.show',[
            'title'=>'プロフィール',
            'recommended_user' => $user,
            'user_blogs' => $user->blogs()->latest()->get(),
        
        ]);
    
    }
}
