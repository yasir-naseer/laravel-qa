@can('accept', $model)
    <a onclick="event.preventDefault(); document.getElementById('accept-form-{{ $model->id }}').submit();" title="mark this answer as best" class=" {{ $model->status }} mt-2">
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form action="{{ route('answers.accept', $model->id) }}" method="POST" id="accept-form-{{ $model->id }}">
        @csrf
    </form>
@else
    @if($model->accepted)
    <a  title="mark this answer as best" class=" {{ $model->status }} mt-2">
        <i class="fas fa-check fa-2x"></i>
    </a>
    @endif

@endcan