@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center"><h1>{{ __('List of exam takers') }}</h1></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Full name</th>
                                <th>Disability</th>
                                <th>Score</th>
                                <th>Date taken</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($takers as $taker)
                                <tr>
                                    <td>{{ $taker->name }}</td>
                                    <td>{{ $taker->disability->disability_name ?? 'N/A' }}</td>
                                    <td>{{ $taker->overall_score }}</td>
                                    <td>{{ $taker->answers->max('created_at') ? $taker->answers->max('created_at')->format('Y-m-d') : 'N/A' }}</td>
                                    <td>
                                        @if(Auth::User()->type === 'admin')
                                        
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('adminQuizDetails', ['detail' => $taker]) }}" class="dropdown-item">View Details</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('score-index', ['score'=> $taker]) }}" class="dropdown-item">Add Scores</a>
                                                </li>
                                            </ul>
                                        </div>
                                        @else
                                        <a href="{{ route('adminQuizDetails', ['detail'=> $taker->id]) }}">
                                            <button class="btn btn-primary">
                                                View details
                                            </button>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
