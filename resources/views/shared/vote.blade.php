@if($model instanceof App\Question)
    @php 
        $name = 'question';
        $URLSagment = 'questions';
    @endphp

@elseif($model instanceof App\Answer)
    @php 
        $name = 'answer';
        $URLSagment = 'answers';
    @endphp
@endif


    <div class="d-flex flex-column votes-control">
    <a title="This {{$name}} is useful" 
    class="vote-up {{ Auth::guest() ? 'off' : '' }}"
    onclick="event.preventDefault(); document.getElementById('vote-up-{{ $name }}-{{ $model->id }}').submit();"
    >
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form action="/{{$URLSagment}}/{{$model->id}}/vote" method="POST" id="vote-up-{{$name}}-{{ $model->id }}">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count">{{ $model->votes_count }}</span>
    <a title="This {{$name}} is not useful" class="vote-down  {{ Auth::guest() ? 'off' : '' }}"
    onclick="event.preventDefault(); document.getElementById('vote-down-{{$name}}-{{ $model->id }}').submit();"
    >
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form action="/{{$URLSagment}}/{{$model->id}}/vote" method="POST" id="vote-down-{{$name}}-{{ $model->id }}">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>

    @if($model instanceof App\Question)
        <favorite :question="{{ $model }}" />

    @elseif($model instanceof App\Answer)
        <accept :answer="{{ $model }}"></accept>
    @endif
</div>


