<div class="card-body">
                    <div class="card-title">
                       <h2> {{ $answersCount . " " .  \Illuminate\Support\Str::plural('Answer', $answersCount ) }}</h2>
                    </div>
                    <hr>
                    @include('layouts.messages')
                    @foreach($answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column votes-control">
                            <a title="This Answer is useful" 
                            class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('vote-up-answer-{{ $answer->id }}').submit();"
                            >
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form action="{{ route('answers.vote', $answer->id) }}" method="POST" id="vote-up-answer-{{ $answer->id }}">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{ $answer->votes_count }}</span>
                            <a title="This Answer is not useful" class="vote-down  {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('vote-down-answer-{{ $answer->id }}').submit();"
                            >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form action="/answers/{{$answer->id}}/vote" method="POST" id="vote-down-answer-{{ $answer->id }}">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                                @can('accept', $answer)
                                    <a onclick="event.preventDefault(); document.getElementById('accept-form-{{ $answer->id }}').submit();" title="mark this answer as best" class=" {{ $answer->status }} mt-2">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                    <form action="{{ route('answers.accept', $answer->id) }}" method="POST" id="accept-form-{{ $answer->id }}">
                                        @csrf
                                    </form>
                                @else
                                    @if($answer->accepted)
                                    <a  title="mark this answer as best" class=" {{ $answer->status }} mt-2">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                    @endif

                                @endcan
                            </div>  
                            <div class="media-body">  
                                {{ $answer->body}}
                                <div class="row mt-3">
                                    <div class="col-4">
                                        @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-success">Edit</a>
                                        @endcan
                                        @can('delete', $answer)
                                            <form action="{{ route('questions.answers.destroy', [$question->id, $answer->id] ) }}" method="POST" class="d-inline" onclick="return confirm('Are you sure?')"> 
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                    <div class="col-4">
                                    </div>
                                    <div class="col-4 ">
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
                        </div>
                        <hr>
                    @endforeach  
                    
</div>