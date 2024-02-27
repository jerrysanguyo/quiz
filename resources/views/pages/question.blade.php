@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Question') }}</div>
                <div class="card-body">
                    @if($errors->any())
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="post" action="{{ route('add-question') }}">
                        @csrf
                        @method('post')
                        <div class="col-md-12" hidden>
                            <label class="form-label">Added by:</label>
                            <input class="form-control" type="number" name="added_by" value="{{ Auth::user()->id }}" />
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Question Number:</label>
                            <input class="form-control" type="number" name="qNumber" />
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Question:</label>
                            <input class="form-control" type="text" name="qDescription" />
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Answer:</label>
                                <input class="form-control" type="text" name="qAnswer" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Choice B:</label>
                                <input class="form-control" type="text" name="qChoicesB" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Choice C:</label>
                                <input class="form-control" type="text" name="qChoicesC" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Choice D:</label>
                                <input class="form-control" type="text" name="qChoicesD" />
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <input class="btn btn-primary" type="submit" value="Add Question" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection