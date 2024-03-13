@extends('layouts.app')

@section('content')
<style>
    .pagination {
        font-size: 1px; /* Adjust the font size as needed */
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>
                        {{ __('List of users') }}
                    </h1>
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
                                <form action="{{ route('acc-reg') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="forName" class="form-label">Name:</label>
                                                <input type="text" name="name" id="forName" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="forEmail" class="form-label">Email:</label>
                                                <input type="email" name="email" id="forEmail" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="forPaforPwssword" class="form-label">Password:</label>
                                                <input type="password" name="password" id="forPw" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="forType" class="form-label">Type</label>
                                                <select name="type" id="forType" class="form-select">
                                                    <option value="judge">Judge</option>
                                                    <option value="admin">Admin</option>
                                                </select>
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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('superadmin-dashboard') }}" method="GET" class="d-flex p-3" role="search">
                            <input type="text" name="search" value="{{ $search }}" placeholder="Search..." class="form-control me-2">
                            <button type="submit" class="btn btn-outline-success">Search</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listOfUser as $Users)
                            <tr>
                                <td>{{ $Users->id }}</td>
                                <td>{{ $Users->name }}</td>
                                <td>{{ $Users->email }}</td>
                                <td>{{ $Users->type }}</td>
                                <td>{{ $Users->created_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('update-judge', ['userId' => $Users->id]) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="dropdown-item">Change role to Judge</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('update-admin', ['userId' => $Users->id]) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="dropdown-item">Change role to Admin</button>
                                                </form>
                                            </li>
                                            <hr>
                                            <li>
                                                <form method="post" action="{{ route('delete-user', ['userId' => $Users->id]) }}">
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
                    {{ $listOfUser->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
