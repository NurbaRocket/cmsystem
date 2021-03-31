@extends('layouts.app')


@section('content')
    <div class="container bg-light">
    <h1>Create Post</h1>

    {{ Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

    <div class="form-group">
    {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
    </div>

    <div class="form-group">
        {{ Form::label('body', 'body') }}
        {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body text']) }}
    </div>

    <div class="form-group">
        {{ Form::label('surname', 'surname') }}
        {{ Form::text('surname', '', ['class' => 'form-control', 'placeholder' => 'Введите фамилию']) }}
    </div>

    <div class="form-group">
        {{ Form::label('name', 'name') }}
        {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Введите имя']) }}
    </div>

    <div class="form-group">
        {{ Form::label('patronymic', 'patronymic') }}
        {{ Form::text('patronymic', '', ['class' => 'form-control', 'placeholder' => 'Введите отчество']) }}
    </div>

    <div class="form-group">
        {{ Form::label('phnumber', 'phnumber') }}
        {{ Form::number('phnumber', '', ['class' => 'form-control', 'placeholder' => 'Номер телефона']) }}
    </div>

    <div class="form-group">
        {{ Form::label('ppnumber', 'ppnumber') }}
        {{ Form::number('ppnumber', '', ['class' => 'form-control', 'placeholder' => 'Номер паспорта']) }}
    </div>

    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>

    <div class="form-group">
        {{Form::file('pdfdocs')}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{Form::close()}}
    </div>
@endsection

{{----}}
