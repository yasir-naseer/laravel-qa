@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Create Questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">See All Questions</a>
                        </div>
                    </div>
                
                </div>

                <div class="card-body">
                   <form action="{{ route('questions.store') }}" method="POST">
                       @csrf

                       <div class="form-group">
                           <label for="question-title">Title</label>
                           <input id="question-title" type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                            
                           @error('title')
                            <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                           
                       </div>

                       <div class="form-group">
                           <label for="question-body">Explain your Question</label>
                           <textarea rows="10" id="question-body" name="body" class="form-control @error('body') is-invalid @enderror "></textarea>
                            
                           @error('body')
                           <strong class="invalid-feedback">{{ $message }}</strong>
                           @enderror
                       </div>

                       <div class="form-group">
                           <input type="submit" id="question-title"  class="btn btn-primary btn-lg">
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
