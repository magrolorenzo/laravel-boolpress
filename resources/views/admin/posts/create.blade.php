@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>
                        Aggiungi Post
                    </h1>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                        🠔 Indietro
                    </a>
                </div>
                {{-- Form di edit --}}
                <form enctype="multipart/form-data" action="{{ route('admin.posts.store') }}" method="POST" >
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- Titolo --}}
                    <div class="form-group">
                        <label>Titolo</label>
                        <input type="text" name="title" class="form-control" maxlength="255" required value="{{old("title")}}">
                    </div>

                    {{-- Autore --}}
                    <div class="form-group">
                        <label>Autore</label>
                        <input type="text" name="author" class="form-control" maxlength="255" required value="{{old("author")}}">
                    </div>


                    {{-- Data --}}
                    <div class="form-group">
                        <label>Data</label>
                        <input type="date" name="date" class="form-control" value="{{old("data")}}">
                    </div>

                    {{-- Corpo del post --}}
                    <div class="form-group">
                        <label>Contenuto</label>
                        <textarea name="body" class="form-control" rows="10" required>{{old("body")}}</textarea>
                    </div>

                    {{-- SELECT Categoria --}}
                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control" name="category_id">
                            <option value="">
                                Seleziona una categoria
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{old("category_id") == $category->id ? "selected=selected" : ""}}>
                                    {{ $category->id }} - {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Checkbox Tag --}}
                    <div class="form-group">
                        @foreach ($tags as $tag)
                            <div class="form-check">
                                <input name="tags[]" class="form-check-input" type="checkbox" value="{{$tag->id}}" id="{{$tag->slug}}" {{in_array($tag->id, old("tags", [])) ? "checked=checked" : ""}}>
                                <label class="form-check-label" for="{{$tag->slug}}">
                                    {{$tag->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Input immagine cover --}}
                    <div class="form-group">
                        <label>
                            Inserisci Cover Image
                        </label>
                        <input type="file" name="image_cover" class="form-control-file"  accept="image/*">
                    </div>

                    {{-- Bottone --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            Salva il post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
