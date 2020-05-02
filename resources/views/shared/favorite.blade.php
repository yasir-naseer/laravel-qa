<a 
title="Click to mark this question as favorite (click again to undo)" 
class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited': '') }}"
onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();">
    <i class="fas fa-star fa-2x"></i>
    <span class="favorites-count">{{ $model->favorited_count }}</span>
</a>
<form action="/questions/{{$model->id}}/favorite" method="POST" id="favorite-question-{{ $model->id }}">
    @csrf

    @if($model->is_favorited)
        @method('DELETE')
    @endif
</form>