@csrf

<div class="form-group">
    <label for="question-title">Title</label>
    <input id="question-title" type="text" value="{{ old('title', $question->title) }}"  name="title" class="form-control @error('title') is-invalid @enderror">
     
    @error('title')
     <strong class="invalid-feedback">{{ $message }}</strong>
    @enderror
    
</div>

<div class="form-group">
    <label for="question-body">Explain your Question</label>
    <textarea rows="10" id="question-body" name="body" class="form-control @error('body') is-invalid @enderror ">{{ old('body', $question->body)}} </textarea>
     
    @error('body')
    <strong class="invalid-feedback">{{ $message }}</strong>
    @enderror
</div>

<div class="form-group">
    <button type="submit" id="question-title"  class="btn btn-outline-primary btn-lg">{{ $buttonText }}</button>
</div>