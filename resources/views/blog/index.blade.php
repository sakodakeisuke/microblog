@extends('layouts.logged_in')

@section('title',$title)

@section('content')
 
    <h1>{{$title}}</h1>
    
    @forelse($recommended_users as $recommended_user)
        <li><a href="{{ route('users.show', $recommended_user) }}">{{ $recommended_user->name }}</a></li>
    @empty
        <li>他のユーザーが存在しません</li>
    @endforelse
    
    <div>
        <form action="{{ route('blogs.search') }}" method="GET">
            <input type="text" name="keyword" value="{{ $keyword }}">
            <input type="submit" value="検索">
        </form>
    </div>
    <ul>
    
        @forelse($follow_blogs as $follow_blog)
          
            {{$follow_blog->user->name}}:
            <li>{!! nl2br($follow_blog->log) !!}:{{$follow_blog->created_at}}</li>
    
        　  @if($follow_blog->user->id === $user->id)
                <a href="{{ route('blogs.edit',$follow_blog->id) }}">編集</a>

                <form action="{{ route('blogs.destroy',$follow_blog->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除">
                </form>
        　  @endif
          
        @empty
            <li>投稿がありません</li>
        @endforelse
    </ul>

@endsection