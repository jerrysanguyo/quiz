@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List of Questions') }}</div>

                <div class="card-body">
                    <div class="row">
                        <a href="{{ route('question-form') }}">
                            <button class="btn btn-primary">Add question</button>
                        </a>
                    </div><br>
                    <div class="row">
                        @if(session()->has('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success">{{ session('success') }}</div>
                        </div>
                        @endif
                    </div>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Question number</th>
                                <th>Description</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listQuestion as $questions)
                            <tr>
                                <td>{{ $questions->qNumber }}</td>
                                <td>{{ $questions->qDescription }}</td>
                                <td>{{ $questions->qAnswer }}</td>
                                <td>{{ $questions->qChoicesB }}</td>
                                <td>{{ $questions->qChoicesC }}</td>
                                <td>{{ $questions->qChoicesD }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('edit-question', ['question' => $questions]) }}" class="dropdown-item">Edit</a>
                                            </li>
                                            <li>
                                                <form method="post" action="{{ route('delete-question', ['question'=>$questions]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
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
