@extends('layouts.logged_in')

@section('title',$title)

@section('content')
 
    
    <h1>{{$title}}</h1>
    {{$recommended_user->name}}
    
    @if(Auth::user()->isFollowing($recommended_user))
          <form method="post" action="{{route('follows.destroy', $recommended_user)}}" class="follow">
            @csrf
            @method('delete')
            <input type="submit" value="フォロー解除">
          </form>
        @else
          <form method="post" action="{{route('follows.store')}}" class="follow">
            @csrf
            <input type="hidden" name="follow_id" value="{{ $recommended_user->id }}">
            <input type="submit" value="フォロー">
          </form>
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