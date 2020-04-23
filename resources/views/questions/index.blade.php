@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Create A Question</a>
                        </div>
                    </div>
                
                </div>

                <div class="card-body">
                    @foreach($questions as $question) 
                        <div class="media">
                            <div class="flex flex-column counters">
                                <div class="votes">
                                    <strong> {{ $question->votes}} </strong> {{  \Illuminate\Support\Str::plural('vote', $question->votes) }}
                                </div>

                                <div class="status {{$question->status}} ">
                                    <strong> {{ $question->answers}} </strong> {{  \Illuminate\Support\Str::plural('answer', $question->answer) }}
                                </div>

                                <div class="views">
                                    {{ $question->views . " " .  \Illuminate\Support\Str::plural('view', $question->views) }}
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title}}</a></h3>
                                {{ \Illuminate\Support\Str::limit($question->body, 250, '...') }}
                                <p class="lead">
                                    Asked By 
                                    <a href="{{ $question->user->url}}">{{ $question->user->name}}</a>
                                    <small class="text-muted">{{ $question->create_date}}</small>
                                </p>                            
                            </div>
                        </div>
                        <hr>
                    @endforeach

                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
