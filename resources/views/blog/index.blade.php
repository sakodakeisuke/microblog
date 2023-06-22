@extends('layouts.logged_in')

@section('title',$title)

@section('content')
 
    <h1>{{$title}}</h1>
    
    <ul>
        @forelse($blogs as $blog)
            {{$blog->user->name}}:
            <li>{!! nl2br($blog->log) !!}:{{$blog->created_at}}</li>
    
            <a href="{{ route('blogs.edit',$blog->id) }}">編集</a>
            
            <form action="{{ route('blogs.destroy',$blog->id) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="削除">
            </form>
            
        @empty
            <li>投稿がありません</li>
        @endforelse
    </ul>
@endsection