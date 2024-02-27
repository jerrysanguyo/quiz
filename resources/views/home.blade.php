@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List of Questions') }}</div>

                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} -->
                    <div class="row">
                        @if(session()->has('success'))
                        <div class="col-md-12">
                            {{ session('success') }}
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
                                    <a href="{{ route('edit-question', ['question' => $questions]) }}"><button class="btn btn-success">Edit</button></a>
                                    <form method="post" action="{{ route('delete-question', ['question'=>$questions]) }}">
                                        @csrf
                                        @method('delete')
                                        <input class="btn btn-danger" type="submit" value="Delete" />
                                    </form>
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
