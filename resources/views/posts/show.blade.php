@extends('layouts.app')

{{----}}
@section('content')

    <div class="container">
        <a href="/public/posts" class="btn btn-primary">Go back</a>


    <br>
    <br>

    <h1> {{ $post->title }} </h1>
    <div>
        {!!$post->body!!}
    </div>
        <hr>
        <small>Written on {{ $post->created_at }} by <b>{{$post->user->name}}</b></small>
        <hr>
        @if(!Auth::user()->id == $post->user_id)
        <a href="{{$post->id}}/edit" class="btn btn-warning">Edit post</a>
{{--    <small>Written on {{ $post->created_at }}</small>--}}

        {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'  ])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        </div>
    @endif
@endsection
