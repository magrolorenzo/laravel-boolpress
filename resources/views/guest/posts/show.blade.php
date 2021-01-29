{{-- Pagina visualizzazione post PUBBLICA --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="col-12">
                {{-- Titolo --}}
                <h1>
                    {{$post->title}}
                </h1>

                {{-- Autore --}}
                <h2>
                    Written by {{$post->author}}
                </h2>

                {{-- Categoria --}}
                <h5 class="text-info">
                    Categoria:
                    @if ($post->category)
                        <a href="{{route("categories.show", ["slug"=>$post->category->slug])}}" class="badge badge-primary">
                            {{$post->category->name}}
                        </a>
                    @else
                        N.A.
                    @endif
                </h5>

                {{-- Corop del post --}}
                <p>
                    {{$post->body}}
                </p>
            </div>
        </div>
        <div>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                🠔 Indietro
            </a>
        </div>
    </div>
</div>
@endsection
