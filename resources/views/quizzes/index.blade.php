@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($quizzes as $quiz)
        <div class="quiz">
            <p>{{ $quiz->question }}</p>
            <form method="POST" action="{{ route('quizzes.answer', $quiz->id) }}">
                @csrf
                <input type="radio" name="answer" value="option1"> {{ $quiz->option1 }}<br>
                <input type="radio" name="answer" value="option2"> {{ $quiz->option2 }}<br>
                <input type="radio" name="answer" value="option3"> {{ $quiz->option3 }}<br>
                <input type="radio" name="answer" value="option4"> {{ $quiz->option4 }}<br>
                <button type="submit">Submit</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
