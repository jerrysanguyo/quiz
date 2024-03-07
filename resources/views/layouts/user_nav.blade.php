@extends('layouts.navbar')

@section('navbar-links')
    <a class="dropdown-item" href="{{ route('quiz') }}">
        Take the quiz
    </a>
@endsection
