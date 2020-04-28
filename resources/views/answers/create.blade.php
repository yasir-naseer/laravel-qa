<div class="card-body">
    <div class="card-title">
        <h3>Your answer</h3>
    </div>
    <hr>
    <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea name="body" id="body"  rows="7" class="form-control @error('body') is-invalid @enderror ">{{ old('body')}}</textarea>

            @error('body')
                <strong class="invalid-feedback">{{ $message }}</strong>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary float-right">Submit</button>
        </div>
    </form>                 
</div>