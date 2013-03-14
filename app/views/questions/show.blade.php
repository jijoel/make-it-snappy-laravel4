@extends('layouts.default')

@section('content')
    <h1>{{ ucfirst($question->user->username) }} asks:</h1>
    <p>
        {{ e($question->question) }}
    </p>

    <div id="answers">
        <h2>Answers</h2>
        @if(!count($question->answers))
            <p>This question has not been answered yet</p>
        @else
            <ul id="answer">
                @foreach($question->answers as $answer)
                    <li>
                        {{ e(Str::limit($answer->answer,40)) }}
                            by {{ ucfirst($answer->user->username) }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div id="post-answer">
        <h2>Answer this Question</h2>
        @if(!Auth::check())
            <p>Please log in to post an answer for this question</p>
        @else
            @if(count($errors)>0)
                <ul id="form-errors">
                    {{ $errors->first('answer', '<li>:message</li>') }}
                </ul>
            @endif

            {{ Form::open(array('url'=>route('answers.store'), 'method'=>'POST')) }}
            {{ Form::token() }}

            {{ Form::hidden('question_id', $question->id )}}
            <p>
                {{ Form::label('answer', 'Answer') }}
                {{ Form::text('answer', Input::old('answer')) }}
                {{ Form::submit('Post Answer') }}
                {{ Form::close() }}
            </p>
        @endif
    </div>
@stop
