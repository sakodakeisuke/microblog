@extends('layouts.logged_in')

@section('title',$title)

@section('content')
 
    
    <h1>{{$title}}</h1>
    {{$user->name}}
    @if(Auth::user()->id !== $user->id)
      @if(Auth::user()->isFollowing($user))
        <form method="post" action="{{route('follows.destroy', $user)}}" class="follow">
          @csrf
          @method('delete')
          <input type="submit" value="フォロー解除">
        </form>
      @else
        <form method="post" action="{{route('follows.store')}}" class="follow">
          @csrf
          <input type="hidden" name="blog_id" value="{{ $user->id }}">
          <input type="submit" value="フォロー">
        </form>
      @endif
    @endif
    <ul>
      @forelse($user_blogs as $user_blog)
        {{$user_blog->user->name}}:
        <li>{!! nl2br($user_blog->log) !!}:{{$user_blog->created_at}}</li>
      @empty
        <li>投稿がありません</li>
      @endforelse
    </ul>
    
@endsection