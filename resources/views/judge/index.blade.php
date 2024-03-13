@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List of exam takers') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Full name</th>
                                <th>Score</th>
                                <th>Date taken</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($takers as $taker)
                                <tr>
                                    <td>{{ $taker->name }} </td>
                                    <td>{{ $taker->total_score }}</td>
                                    <td>{{ $taker->date }}</td>
                                    <td>
                                        <a href="{{ route('judgeQuizDetails', ['detail'=> $taker->id]) }}">
                                            <button class="btn btn-primary">
                                                View details
                                            </button>
                                        </a>
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
