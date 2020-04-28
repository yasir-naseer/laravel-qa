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
                                <a title="mark this answer as best" class=" {{ $answer->status }} mt-2">
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                            </div>  
                            <div class="media-body">  
                                {{ $answer->body}}
                                <div class="row mt-3">
                                    <div class="col-4">
                                        @if(Auth::user()->can('update', $answer))
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-success">Edit</a>
                                        @endif
                                        @if(Auth::user()->can('delete', $answer))
                                            <form action="{{ route('questions.answers.destroy', [$question->id, $answer->id] ) }}" method="POST" class="d-inline" onclick="return confirm('Are you sure?')"> 
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        @endif
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