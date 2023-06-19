@extends('layouts.default')
 
@section('header')

<header>
   
    <div class="flex">
   
      <!-- <div class="left_bar">左サイドバー</div> -->
       
     <main class="main_contents">  
       <h1><a href="{{ route('blogs.index') }}"><img src="/img/logo.png" alt="Foodcamp"></a></h1>
       
       <p>{{ Auth::user()->name }}さん、こんにちは！</p>
     </main>  
       
    <div class="right_bar">  
      <li>
        <a href="{{ route('blogs.create') }}">
          新規投稿
        </a>
      </li>
       
       <li>
         <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="ログアウト">
         </form>
       </li>
    </div>
    </header>

@endsection