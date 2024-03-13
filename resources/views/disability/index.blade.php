@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between ">
                    <h1>List of disability</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add account
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="exampleModalLabel">Type of disability</h1>
                                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('disabilty-create') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="forName" class="form-label">Name of disabiltiy:</label>
                                                <input type="text" name="disability_name" id="forName" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Add account">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal admin registration -->
                </div>
                <div class="card-body"><br>
                    <div class="row">
                        @if(session()->has('success'))
                        <div class="col-md-12">
                            <div class="alert alert-success">{{ session('success') }}</div>
                        </div>
                        @endif
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Disability Name</th>
                                <th>Date and Time added</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listOfDisability as $disability)
                            <tr>
                                <td>{{ $disability->id }}</td>
                                <td>{{ $disability->disability_name }}</td>
                                <td>{{ $disability->created_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('edit-disability', ['disability' => $disability]) }}" class="dropdown-item">Edit</a>
                                            </li>
                                            <li>
                                                <form method="post" action="{{ route('delete-disability', ['disability'=>$disability]) }}">
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
