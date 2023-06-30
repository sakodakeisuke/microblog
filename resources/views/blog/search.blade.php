@extends('layouts.logged_in')

@section('title',$title)

@section('content')

@forelse($blogs as $blog)
    
  @if($blog->user->id !== $user->id) 
    {{$blog->user->name}}:
    <li>{!! nl2br($blog->log) !!}:{{$blog->created_at}}</li>
            
  @endif
@empty
    <li>投稿がありません</li>
@endforelse            

@endsection