@extends('layouts.logged_in')

@section('title',$title)

@section('content')
 
    
    <h1>{{$title}}</h1>
    
    
    
    <ul>
        @forelse($blogs as $blog)
            {{$blog->user->name}}:
            <li>{!! nl2br($blog->log) !!}:{{$blog->created_at}}</li>
    
            <a href="{{ url('/blogs/' . $blog->id . '/edit') }}">編集</a>
            
            <form action="{{ url('/blogs/'.$blog->id) }}" method="post">
                @csrf
                @method('DELETE')
                    
                    
                    <input type="submit" value="削除">
                
            </form>
            
        
        @empty
            <li>日記はありません。</li>
        @endforelse
    </ul>
@endsection