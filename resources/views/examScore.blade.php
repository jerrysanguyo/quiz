@extends('layouts.app')

@section('content')
<!-- user view -->
<div class="container">
    <div class="row">
        <div class="col-md-4 text text-light">
            <h2>Name: {{ $user->name }}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Score for First Assessment</h4>
                    <hr>
                    <div class="row text-center">
                        @if(isset($showQuizButton) && $showQuizButton)
                            <h1>0%</h1>
                        @else
                        <div class="col-md-6">
                            <h1>{{ $totalScore }}%</h1>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('final-score') }}"><button class="btn btn-primary">View details</button></a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Score for Second Assessment</h4>
                    <hr>
                    <div class="row text-center">
                        @if(isset($secondExamNotAvailable) && $secondExamNotAvailable)
                        <form action="{{ route('second-score-add') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="forScore" class="form-label">Score:</label>
                                        <input type="text" name="score" id="forScore" class="form-control">
                                        <input type="text" name="user_scoreId" id="" class="form-control" value="{{ $user->id }}" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>
                        @else
                            <h1>{{ $secondExamScore }}%</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Score for Third Assessment</h4>
                    <hr>
                    <div class="row text-center">
                        
                        @if(isset($secondExamNotAvailable) && $secondExamNotAvailable)
                        <form action="{{ route('third-score-add') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="forScore" class="form-label">Score:</label>
                                        <input type="text" name="score" id="forScore" class="form-control">
                                        <input type="text" name="user_scoreId" id="" class="form-control" value="{{ $user->id }}" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>
                        @else
                            <h1>{{ $thirdExamScore }}%</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-md-4 pt-3 pb-3">
            <div class="card">
                <div class="card-body">
                    <h4>Total score in all Assessments</h4>
                    <hr>
                    <div class="row text-center">
                        <div class="col-md-6">
                            <h1> {{ $overAll }}% </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection