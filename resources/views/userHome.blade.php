@extends('layouts.app')

@section('content')
<!-- user view -->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Score for First Assessment</h4>
                    <hr>
                    <div class="row text-center">
                        @if(isset($showQuizButton) && $showQuizButton)
                            <a href="{{ route('quiz') }}" class="btn btn-primary">Take Quiz</a>
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
                        <div class="col-md-12">
                            @if(isset($secondExamScore))
                            <h1>{{ $secondExamScore ?? 'N/A' }}</h1>
                            @else
                            <a href="{{ asset('exams/Excel.xlsx') }}">
                                <button class="btn btn-primary">
                                    Download Excel Exam
                                </button>
                            </a>
                            @endIf
                        </div>
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
                        <div class="col-md-12">
                            @If(isset($thirdExamScore))
                            <h1>{{ $thirdExamScore ?? 'N/A' }}</h1>
                            @else
                            <a href="{{ asset('exams/ppt.pptx') }}">
                                <button class="btn btn-primary">
                                    Download PPT Exam
                                </button>
                            </a>
                            @endIf
                        </div>
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
                    <div class="row justify-content-center align-items-center text-center">
                        <div class="col-md-6">
                            @if(isset($overAll))
                                <h1> {{ $overAll }}% </h1>
                            @else
                                <h3>Over all score is still computing</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection