@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{ $question->title}}</h2>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">See All Questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="media">
                        <div class="d-flex flex-column votes-control">
                            <a title="This Quesiton is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1234</span>
                            <a title="This Quesiton is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <a 
                            title="Click to mark this question as favorite (click again to undo)" 
                            class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited': '') }}"
                            onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();">
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count">{{ $question->favorited_count }}</span>
                            </a>
                            <form action="/questions/{{$question->id}}/favorite" method="POST" id="favorite-question-{{ $question->id }}">
                                @csrf

                                @if($question->is_favorited)
                                    @method('DELETE')
                                @endif
                            </form>
                        </div>
                        <div class="media-body">
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
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
               @include('answers.index', [
                    'answersCount' => $question->answers_count,
                    'answers' => $question->answers
               ])
               @include('answers.create', [
                    'question' => $question 
               ])
            </div>
        </div>
    </div>
</div>
@endsection
