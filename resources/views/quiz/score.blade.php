@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center align-content-center">
                    <div class="glowing-border">
                        <div class="card border-3 rounded-4 border-dark bg-transparent" style="width: 18rem;">
                            <div class="col-md-12 d-flex justify-content-center align-content-center p-3">
                                <img src="{{ asset('imgs/trophy.webp') }}" alt="" style="width:250px" class="">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title d-flex justify-content-center align-content-center text-justify text-center font-monospace text-light">
                                    Congratulation!<br>You have completed<br>the first Assesment.
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Kindly click me to see your Assessment results!
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            @if($userAnswers->isNotEmpty())
                                <h3>Total Questions Answered: {{ $userAnswers->count() }}</h3>
                                <h3>Correct Answer/s: {{ $correctAnswersCount }}</h3>
                                <h3>Incorrect Answer/s: {{ $incorrectAnswersCount }}</h3>
                                <hr>
                                @foreach($userAnswers as $answer)
                                    <p>
                                        <strong>Question:</strong> {{ $answer->question->qDescription }}<br>
                                        <strong>Your Answer:</strong> {{ $answer->answer }}<br>
                                        <strong>Time Spent:</strong> {{ $answer->time_spent }} second/s<br>
                                        <strong>Result:</strong> {{ ($answer->answer == $answer->question->qAnswer) ? 'Correct' : 'Incorrect' }}<br>
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
    </div>
</div>
@endsection
