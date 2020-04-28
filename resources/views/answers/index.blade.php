<div class="card-body">
                    <div class="card-title">
                       <h2> {{ $answersCount . " " .  \Illuminate\Support\Str::plural('Answer', $answersCount ) }}</h2>
                    </div>
                    <hr>
                    @include('layouts.messages')
                    @foreach($answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column votes-control">
                                <a title="This answer is useful" class="vote-up">
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <span class="votes-count">1234</span>
                                <a title="This answer is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                <a title="mark this answer as best" class="vote-accepted mt-2 favorited">
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                            </div>  
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