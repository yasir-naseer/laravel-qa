@extends('layouts.app')

@section('content')
<div class="container">
    <question :question="{{ $question }}"></question>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
               <answers :question="{{ $question }}" ></answers>
            </div>
        </div>
    </div>
</div>
@endsection
