@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<h1>新規投稿画面</h1>
<a href="{{ route('blogs.index')}}">一覧に戻る</a>

<form method="post" action="{{ route('blogs.store') }}">
  @csrf

  <div>
    <label>
      <textarea type="text" name="log" placeholder="内容を入力" rows="5" cols="80"></textarea>
    </label>
  </div>

  <input type="submit" value="保存">

</form>
@endsection