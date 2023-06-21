<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Http\Requests\BlogRequest;


class BlogController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    
    public function index(){
        $user = \Auth::user();
        $blogs =Blog::where('user_id',"=", \Auth::user()->id)->latest()->get();
        
        
        return view('blog.index',[
            'title' => '投稿一覧',
            'blogs' =>$blogs,
            'user' =>$user,
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

}