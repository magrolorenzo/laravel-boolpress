@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>
                        Modifica post {{ $post->id }}
                    </h1>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                         🠔 Indietro
                    </a>
                </div>
                {{-- Form di edit --}}
                <form action="{{route("admin.posts.update", ["post" => $post->id])}}" method="POST" >
                    @csrf
                    @method('PUT')

                    {{-- Titolo --}}
                    <div class="form-group">
                        <label>Titolo</label>
                        <input type="text" name="title" class="form-control" value="{{ $post->title }}" maxlength="255" required>
                    </div>

                    {{-- Autore --}}
                    <div class="form-group">
                        <label>Autore</label>
                        <input type="text" name="author" class="form-control" value="{{ $post->author }}" maxlength="255" required>
                    </div>

                    {{-- Data --}}
                    <div class="form-group">
                        <label>Data</label>
                        <input type="date" name="date" class="form-control" value="{{ $post->date }}">
                    </div>

                    {{-- Corpo del post --}}
                    <div class="form-group">
                        <label>Contenuto</label>
                        <textarea name="body" class="form-control" rows="10" required>{{ $post->body }}</textarea>
                    </div>


                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control" name="category_id">
                            <option value="">
                                Seleziona una categoria
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected=selected' : '' }}>
                                    {{ $category->id }} - {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Checkbox Tag --}}
                    <div class="form-group">
                        @foreach ($tags as $tag)
                            <div class="form-check">
                                <input name="tags[]" class="form-check-input" type="checkbox" value="{{$tag->id}}" {{$post->tags->contains($tag) ? "checked" : ""}} id="{{$tag->slug}}">
                                <label class="form-check-label" for="{{$tag->slug}}">
                                    {{$tag->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Bottone --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            Applica Modifiche
                        </button>
                    </div>
                </form>

                <form action="{{route("admin.posts.destroy", ["post"=> $post->id]) }}" action="index.html" method="post">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">
                        Elimina il post
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
