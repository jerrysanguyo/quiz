@extends('layouts.navbar')

@section('navbar-links')
    <a class="dropdown-item" href="{{ route('question') }}">
        List of questions
    </a>
    <a class="dropdown-item" href="{{ route('disability') }}">
        List of disability
    </a>
@endsection
