@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Question') }}</div>
                <div class="card-body">
                    @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="post" action="{{ route('update-disability', ['disability'=>$disability]) }}">
                        @csrf
                        @method('put')
                        <div class="col-md-12">
                            <label class="form-label">Disability Name:</label>
                            <input class="form-control" type="text" name="disability_name" value="{{ $disability->disability_name }}" />
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <input class="btn btn-primary" type="submit" value="Update Question" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection