@extends('layouts.app')

@section('content')
<style>
    .row, .col-md-12{
        padding-top:5px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var timer = document.getElementById('timer');
        var timerBar = document.getElementById('timer-bar');
        var radioButtons = document.querySelectorAll('input[type="radio"]');
        var timeLeft = 30;
        var timerInterval = setInterval(updateTimer, 1000); 

        function updateTimer() {
            timeLeft--;
            timer.textContent = timeLeft + ' seconds left';
            var percentageLeft = (timeLeft / 30) * 100; 
            timerBar.style.width = percentageLeft + '%'; 

            if (timeLeft <= 0) {
                clearInterval(timerInterval); 
                timer.textContent = 'Time\'s up! 0';
                timerBar.style.width = '0%'; 
                
                radioButtons.forEach(function(button) {
                    button.disabled = true;
                });
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
                    <form method="post" action="">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" id="timer-bar"></div>
                            </div>
                            <div class="text-center mt-3">
                                <h2><span id="timer">30</span></h2>
                            </div>
                        </div>
                        @foreach ($listQuestion as $questions)
                        <div class="row">
                            <div class="col-md-12">
                                <p class="display-3">{{ $questions->qDescription }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="col-md-12">
                                <input type="radio" class="btn-check" name="answer" id="Answer1" value="{{ $questions->qAnswer }}" autocomplete="off">
                                <label class="btn btn-outline-success" for="Answer1">{{ $questions->qAnswer }}</label>
                            </div>
                            <div class="col-md-12">
                                <input type="radio" class="btn-check" name="answer" id="Answer2" value="{{ $questions->qChoicesB }}"  autocomplete="off">
                                <label class="btn btn-outline-success" for="Answer2">{{ $questions->qChoicesB }}</label>
                            </div>
                            <div class="col-md-12">
                                <input type="radio" class="btn-check" name="answer" id="Answer3" value="{{ $questions->qChoicesC }}"  autocomplete="off">
                                <label class="btn btn-outline-success" for="Answer3">{{ $questions->qChoicesC }}</label>
                            </div>
                            <div class="col-md-12">
                                <input type="radio" class="btn-check" name="answer" id="Answer4" value="{{ $questions->qChoicesD }}"  autocomplete="off">
                                <label class="btn btn-outline-success" for="Answer4">{{ $questions->qChoicesD }}</label>
                            </div> -->
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
                                    echo '<input type="radio" class="btn-check" name="answer" id="' . $answer['id'] . '" value="' . $answer['value'] . '" autocomplete="off">';
                                    echo '<label class="btn btn-outline-success" for="' . $answer['id'] . '">' . $answer['text'] . '</label>';
                                    echo '</div>';
                                }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input class="btn btn-primary" type="submit" value="Submit" />
                            </div>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection