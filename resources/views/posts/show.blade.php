@extends('layouts.app')


@section('content')

    <div class="container bg-light">
        <hr>
        <a href="/public/posts" class="btn btn-primary">Go back</a>
        <br>
        <br>
        <h1> {{ $post->title }} </h1>

        <div>
        {!!$post->body!!}
        </div>
        <div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Отчество</th>
                    <th scope="col">Номер телефона</th>
                    <th scope="col">Номер пасспорта</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">@</th>
                    <td>{{$post->surname}}</td>
                    <td>{{$post->name}}</td>
                    <td>{{$post->patronymic}}</td>
                    <td>{{$post->phnumber}}</td>
                    <td>{{$post->ppnumber}}</td>
                </tr>

                </tbody>
            </table>
        </div>


        <h6>PDF Документ</h6>

        <iframe src="/storage/app/public/pdfdocs/{{$post->pdfdocs}}" width="100%" height="700px">

            <hr>
            <small>Written on {{ $post->created_at }} by <b>{{$post->user->name}}</b></small>
            <hr>














        @if(!Auth::user()->id == $post->user_id)
        <a href="{{$post->id}}/edit" class="btn btn-warning">Edit post</a>


        {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'  ])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
        </div>
    @endif
@endsection
