<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Http\Requests\BlogRequest;
use App\User;
use Aoo\Follow;


class BlogController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    
    public function index(Request $request){
        $user = \Auth::user();
        //$blogs =Blog::where('user_id',"=", \Auth::user()->id)->latest()->get();
        $follow_users_ids=$user->follow_users->pluck('id');

        //$follow_blogs=$user->blogs()->orWhereIn('user_id', $follow_users_ids )->get();
        $follow_users_ids->add($user->id);
        
        $keyword = $request->input('keyword');

        $query = $user->blogs()->orWhereIn('user_id', $follow_users_ids );
        
        if(!empty($keyword)) {
            $query->where('log', 'LIKE', "%{$keyword}%");
            
        }
        //dd($query->toSql());
        $follow_blogs=$query->latest()->get();
       // dd($follow_blogs,$keyword);
        //$follow_blogs = $query->latest('blogs.created_at')->get();
        
        return view('blog.index',[
            'title' => '投稿一覧',
            //'blogs' =>$blogs,
            'user' =>$user,
            'recommended_users' => User::recommend($follow_users_ids)->get(),
            'follow_blogs'=>$follow_blogs,
            'keyword'=>$keyword,
             ]);
    }        
    
    public function create(){
        
        return view('blog.create',[
            'title' =>'新規投稿',
            
            ]);
    }
        
    public function store(BlogRequest $request){
        
        $blog=new Blog;
        
        $blog->log=$request->log;
        $blog->user_id=auth()->user()->id;
        $blog->save();
        session()->flash('success','新規追加しました');
        return redirect('/blogs');
}

    
    public function edit($id){
        
        $blogs=Blog::find($id);
        
        return view('blog.edit',[
            'title'=>'編集画面',
            'blogs'=>$blogs,
            ]);
        
    }

    public function update($id,BlogRequest $request){
        
        $blogs=Blog::find($id);
        $blogs->update($request->only(['log']));
        session()->flash('success', '投稿を編集しました');
        return redirect()->route('blogs.index');
    }

    public function destroy($id){
        $blogs=Blog::find($id);
        $blogs->delete();
        session()->flash('success','日記を削除しました');
        return redirect()->route('blogs.index');
    }

    
    public function search(Request $request){
        $user = \Auth::user();
        $blogs=Blog::query();
        
        //$follow_users_ids=$user->follow_users->pluck('id');
        //$follow_users_ids->add($user->id);
        
        $keyword = $request->input('keyword');
        $query = $blogs;
        
        if(!empty($keyword)) {
            $query->where('log', 'LIKE', "%{$keyword}%");
        } else {
            return redirect()->route('blogs.index');
        }
        $blogs=$query->latest()->get();
        return view('blog.search',[
            'title' => '検索結果',
            'blogs' =>$blogs,
            'user' =>$user,
            'keyword'=>$keyword,
             ]);
}

}