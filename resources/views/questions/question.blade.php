<div class="media post">
    <div class="flex flex-column counters">
        <div class="votes">
            <strong> {{ $question->votes_count}} </strong> {{  \Illuminate\Support\Str::plural('vote', $question->votes_count) }}
        </div>

        <div class="status {{$question->status}} ">
            <strong> {{ $question->answers_count}} </strong> {{  \Illuminate\Support\Str::plural('answer', $question->answers_count) }}
        </div>

        <div class="views">
            {{ $question->views . " " .  \Illuminate\Support\Str::plural('view', $question->views) }}
        </div>
        
    </div>
    <div class="media-body">
        <div class="d-flex align-items-center">
            <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title}}</a></h3>
            <div class="ml-auto">
                @can('update', $question)
                <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
                @endcan
                @can('delete', $question)
                <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-inline" onclick="return confirm('Are you sure?')"> 
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
                @endcan
            </div>
        </div>
        {{ \Illuminate\Support\Str::limit($question->body, 250, '...') }}
        <p class="lead">
            Asked By 
            <a href="{{ $question->user->url}}">{{ $question->user->name}}</a>
            <small class="text-muted">{{ $question->create_date}}</small>
        </p>                            
    </div>
</div>