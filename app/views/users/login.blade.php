@extends('layouts.default')

@section('content')
    <h1>Login</h1>
    {{ Form::open(array('action' => 'Login', 'method' => 'POST')) }}
    {{ Form::token() }}

    <p>
        {{ Form::label('username', 'Username')}}<br />
        {{ Form::text('username', Input::old('username'), array("autofocus"=>"True")) }}
    </p>
    <p>
        {{ Form::label('password', 'Password')}}<br />
        {{ Form::password('password') }}
    </p>
    <p>{{ Form::submit('Login')}}</p>

    {{ Form::close() }}

@stop