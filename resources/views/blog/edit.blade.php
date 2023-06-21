@extends ('layouts.logged_in')

@section('title',$title)

@section('content')

<h1>{{$title}}</h1>

<form method="post" action="{{ route('blogs.update',$blogs->id) }}">
    @csrf
    @method('patch')
    <div>
        <label>
            <textarea type="text" name="log" rows="5" cols="30">{{$blogs->log}}</textarea>
        </label>
    </div>
    
    <input type="submit" value="保存">
    
</form>

@endsection