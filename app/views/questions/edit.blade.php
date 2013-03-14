@extends('layouts.default')

@section('content')
<div id="edit">
    <h1>Edit your Question</h1>
    @if(count($errors)>0)
        <p>The following errors have occurred</p>
        <ul id="form-errors">
            {{ $errors->first('question', '<li>:message</li>') }}
            {{ $errors->first('solved', '<li>:message</li>') }}
        </ul>
    @endif

    {{ Form::open(array('url' => route('questions.update', ['questions'=>$question->id]),
        'method' => 'PUT')) }}
    {{ Form::token() }}

    <p>
        {{ Form::label('question', 'Question') }}<br />
        {{ Form::text('question', $question->question) }}
    </p>
    <p>
        {{ Form::label('solved', 'Solved') }}<br />
        {{ Form::checkbox('solved', 1, $question->solved) }}
    </p>

    <p>
        {{ Form::hidden('question_id', $question->id) }}
        {{ Form::submit('Update your question') }}
    </p>
    {{ Form::close() }}
</div><!-- edit -->

@stop
