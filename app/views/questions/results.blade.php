@extends('layouts.default')

@section('content')
    <h1>Search Results</h1>
    @if(!count($questions))
        <p>Nothing found. Please try a different search.</p>
    @else
        <ul>
            @foreach($questions as $question)
            <li>
                <a href="{{ route('questions.show', ['questions'=>$question->id]) }}">
                    {{ $question->question }}
                </a>
                by {{ ucfirst($question->user->username) }}
                ({{ count($question->answers) }} answers)
            </li>
            @endforeach
        </ul>

        {{ $questions->links() }}
    @endif
@stop