
@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>{{$post->title}}</h1>
            <h2>Written by {{$post->author}}</h2>
            <h5 class="text-info">Categoria: {{$post->category->name}}</h5
            <p>{{$post->body}}</p>
        </div>
    </div>
    <div>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
            🠔 Indietro
        </a>
    </div>
</div>
@endsection
