@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<div>
  {{--<form action="{{ route('blogs.index') }}" method="GET">--}}
  <form action="{{ route('blogs.search') }}" method="GET">
    <input type="text" name="keyword" value="{{ $keyword }}">
    <input type="submit" value="検索">
  </form>
</div>

@forelse($blogs as $blog)
    
  @if($blog->user->id !== $user->id) 
    {{$blog->user->name}}:
    <li>{!! nl2br($blog->log) !!}:{{$blog->created_at}}</li>
            
  @endif
@empty
    <li>投稿がありません</li>
@endforelse            

@endsection