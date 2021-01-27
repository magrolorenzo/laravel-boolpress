
@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>{{$post->title}}</h1>
            <p>{{$post->body}}</p>

        </div>
    </div>
</div>
@endsection
