@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Question-wise Breakdown') }}</div>
                <div class="card-body">
                    @if($userAnswers->isNotEmpty())
                        <h3>Total Questions Answered: {{ $userAnswers->count() }}</h3>
                        <h3>Correct Answers: {{ $correctAnswersCount }}</h3>
                        <h3>Incorrect Answers: {{ $incorrectAnswersCount }}</h3>
                        <hr>
                        @foreach($userAnswers as $answer)
                            <p>
                                <strong>Question:</strong> {{ $answer->question }}<br>
                                <strong>Your Answer:</strong> {{ $answer->answer }}<br>
                                <strong>Time Spent:</strong> {{ $answer->timespent }} second/s<br>
                                <strong>Result:</strong> {{ $answer->is_correct ? 'Correct' : 'Incorrect' }}<br>
                            </p>
                        @endforeach
                    @else
                        <p>No answers submitted yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
