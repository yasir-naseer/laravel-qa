
<form action="/questions/{{$model->id}}/favorite" method="POST" id="favorite-question-{{ $model->id }}">
    @csrf

    @if($model->is_favorited)
        @method('DELETE')
    @endif
</form>