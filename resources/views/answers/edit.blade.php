@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Edit Your answer for: {{ $question->title}}</h3>
                    </div>
                    <hr>
                    <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <textarea name="body" id="body"  rows="7" class="form-control @error('body') is-invalid @enderror ">{{ old('body', $answer->body)}}</textarea>

                            @error('body')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary float-right">Update</button>
                        </div>
                    </form>                 
                </div>
            </div>
        </div>
    </div>

@endsection