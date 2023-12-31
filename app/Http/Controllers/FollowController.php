<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;

class FollowController extends Controller
{
    public function store(Request $request)
    {
        $user = \Auth::user();
        Follow::create([
           'user_id' => $user->id,
           'blog_id' => $request->blog_id,
        ]);
        \Session::flash('success', 'フォローしました');
        return redirect()->route('blogs.index');
    }

    public function destroy($recommended_user)
    {
        $follow = \Auth::user()->follows->where('blog_id', $recommended_user)->first();
        $follow->delete();
        \Session::flash('success', 'フォロー解除しました');
        return redirect()->route('blogs.index');
    }
}
