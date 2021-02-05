
@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>
                {{$post->title}}
            </h1>
            <h2>
                Written by {{$post->author}}
            </h2>
            <h5 class="text-info">
                Categoria: {{$post->category ? $post->category->name : "N.A."}}
            </h5>
            <h5 class="text-info">
                Tags:
                @forelse ($post->tags as $tag)
                    {{$tag->name}}{{!$loop->last ? "," : ""}}
                @empty
                    N.A.
                @endforelse
            </h5>
            <p>
                {{$post->body}}
            </p>

            {{-- Immagine del post --}}
            @if($post->cover)
                <div class="cover-container">
                    <img src="{{asset("storage/".$post->cover)}}" alt="">
                </div>
            @else
                <div class="">
                    <h5>-- Nessuna immagine di copertina --</h5>
                </div>
            @endif

        </div>
    </div>
    <div>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
            🠔 Indietro
        </a>
    </div>
</div>
@endsection
