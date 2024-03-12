@extends('layouts.app')

@section('content')
<style>
    .row,
    .col-md-12 {
        padding-top: 5px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var timer = document.getElementById('timer');
        var timerBar = document.getElementById('timer-bar');
        var radioButtons = document.querySelectorAll('input[type="radio"]');
        var remainingTimeInput = document.getElementById('remaining-time');
        var timeLeft = 30;
        var timerInterval = setInterval(updateTimer, 1000);

        function updateTimer() {
            timeLeft--;
            timer.textContent = timeLeft + ' seconds left';
            var percentageLeft = (timeLeft / 30) * 100;
            timerBar.style.width = percentageLeft + '%';
            
            remainingTimeInput.value = 30 - timeLeft;

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                timer.textContent = 'Time\'s up! 0';
                timerBar.style.width = '0%';

                document.getElementById('defaultChoices').style.display = 'none';
                document.getElementById('passBtn').style.display = 'none';
                document.getElementById('noAnswerDiv').style.display = 'inline-block';
                document.getElementById('subBtn').className = 'col-md-12';
            }
        }
    });
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Good luck!') }}</div>
                <div class="card-body" style="text-align:center">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="{{ route('submit-answer') }}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" id="timer-bar"></div>
                            </div>
                            <div class="text-center mt-3">
                                <h2><span id="timer">30</span></h2>
                            </div>
                        </div>
                        @foreach ($listQuestion as $questions)
                        <div class="row">
                            <div class="col-md-12">
                                <input class="form-control" type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                <input class="form-control" type="hidden" name="question_id" value="{{ $questions->id }}" />
                                <input class="form-control" type="hidden" id="remaining-time" name="time_spent">

                                <p class="display-3">{{ $questions->qDescription }}</p>
                            </div>
                        </div>
                        <div class="row" id="defaultChoices" style="display:inline-block">
                            <?php
                                $answers = [
                                    ['id' => 'Answer1', 'value' => $questions->qAnswer, 'text' => $questions->qAnswer],
                                    ['id' => 'Answer2', 'value' => $questions->qChoicesB, 'text' => $questions->qChoicesB],
                                    ['id' => 'Answer3', 'value' => $questions->qChoicesC, 'text' => $questions->qChoicesC],
                                    ['id' => 'Answer4', 'value' => $questions->qChoicesD, 'text' => $questions->qChoicesD]
                                ];

                                shuffle($answers);

                                foreach ($answers as $answer) {
                                    echo '<div class="col-md-12">';
                                        echo '<div class="d-grid gap-2">';
                                            echo '<input type="radio" class="btn-check" name="answer" id="' . $answer['id'] . '" value="' . $answer['value'] . '" autocomplete="off">';
                                            echo '<label class="btn btn-outline-success" for="' . $answer['id'] . '">' . $answer['text'] . '</label>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                            ?>
                        </div>
                        @endforeach
                        <div class="row" id="noAnswerDiv" style="display: none;">
                            <div class="col-md-12">
                                <input type="radio" class="btn-check" id="NoAnswer" name="answer" value="No Answer">
                                <label class="btn btn-outline-success" for="NoAnswer">No Answer</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" id="passBtn" style="display=inline-block">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-success" id="btnPass">Pass</button>
                                </div>
                            </div>
                            <div class="col-md-6" id="subBtn">
                                <div class="d-grid gap-2">
                                    <input class="btn btn-primary" type="submit" value="Submit" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
