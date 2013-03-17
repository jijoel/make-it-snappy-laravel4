@extends('layouts.default')

@section('content')
    <h1>{{ ucfirst($username) }} Questions</h1>

    @if(!count($questions))
        <p>You have not asked any questions yet.</p>
    @else
        <ul>
            @foreach($questions as $question)
                <li>
                    {{ Str::limit(e($question->question),40) }} -
                    {{ ($question->solved) ? "(solved) - " : "" }}
                    <a href="{{ route('questions.show', array('questions'=>$question->id)) }}">View</a> - 
                    <a href="{{ route('questions.edit', array('questions'=>$question->id)) }}">Edit</a> 
                </li>
            @endforeach
        </ul>

        {{ $questions->links() }}
    @endif
@stop