@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($progress as $entry)
        <div class="progress">
            <p>{{ $entry->word->word }}</p>
            <p>Correct: {{ $entry->correct_attempts }}</p>
            <p>Incorrect: {{ $entry->incorrect_attempts }}</p>
        </div>
    @endforeach
</div>
@endsection
