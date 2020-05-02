<div class="media post">
    @include('shared.vote', [
        'model' => $answer
    ])  
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
                @include('shared.authors', [
                    'model' => $answer,
                    'label' => 'Answer'
                ])
            </div>
    </div>
              
    </div>
</div>
