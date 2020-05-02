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
                        @include('shared.vote', [
                            'model' => $question    
                        ])
                        <div class="media-body">
                                {{ $question->body }}
                               <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <div class="mt-3">
                                        @include('shared.authors', [
                                                'model' => $question,
                                                'label' => 'Asked'
                                           ])
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
