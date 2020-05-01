@if($answersCount > 0)
    <div class="card-body">
        <div class="card-title">
            <h2> {{ $answersCount . " " .  \Illuminate\Support\Str::plural('Answer', $answersCount ) }}</h2>
        </div>
        <hr>
        @include('layouts.messages')
        @foreach($answers as $answer)
            @include('answers.answer')
        @endforeach  
                        
    </div>
@endif