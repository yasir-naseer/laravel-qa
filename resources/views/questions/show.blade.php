@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>{{ $question->title}}</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">See All Questions</a>
                        </div>
                    </div>
                
                </div>

                <div class="card-body">
                    {{ $question->body }}
                    <div class="float-right mt-3">
                                    <span class="text-muted">Answered {{ $question->create_date}}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $question->user->url }}" class="pr-2">
                                            <img src="{{ $question->user->avatar }}" alt="no img" >
                                        </a>

                                        <div class="media-body ">
                                            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                       <h2> {{ $question->answers_count . " " .  \Illuminate\Support\Str::plural('Answer', $question->answers_count) }}</h2>
                    </div>
                    <hr>
                    @foreach($question->answers as $answer)
                        <div class="media">
                            <div class="media-body">    
                                {{ $answer->body}}
                                <div class="float-right mt-3">
                                    <span class="text-muted">Answered {{ $answer->created_date}}</span>
                                    <div class="media mt-2">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}" alt="no img" >
                                        </a>

                                        <div class="media-body ">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <hr>
                    @endforeach  
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
