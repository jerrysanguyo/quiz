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
                                <th>Disability</th>
                                <th>First Assessment</th>
                                <th>Second Assessment</th>
                                <th>Third Assessment</th>
                                <th>Overall</th>
                                <th>Date taken</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($takers as $taker)
                                <tr>
                                    <td>{{ $taker->name }}</td>
                                    <td>{{ $taker->disability->disability_name ?? 'N/A' }}</td>
                                    <td>{{ $taker->firstAssessmentScore ?? 'N/A'  }}</td>
                                    <td>{{ $taker->secondAssessmentScore ?? 'N/A' }}</td>
                                    <td>
                                        @if($taker->exempted === 'Yes')
                                            Exempted
                                        @else
                                            {{ $taker->thirdAssessmentScore ?? 'N/A' }}
                                        @endif
                                    </td>
                                    <td>{{ $taker->overall_score ?? 'N/A' }}</td>
                                    <td>{{ $taker->answers->max('created_at') ? $taker->answers->max('created_at')->format('Y-m-d') : 'N/A' }}</td>
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
