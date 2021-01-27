
@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Elenco Post</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titolo</th>
                        <th>Slug</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                            <td class="d-flex ">
                                <a href="{{route("admin.posts.show" , ["post"=> $post->slug]) }}" class="btn btn-success">
                                    Visualizza
                                </a>
                                <a href="{{route("admin.posts.edit" , ["post"=> $post->slug]) }}" class="btn btn-primary">
                                    Modifica
                                </a>
                                {{-- Tasto di eliminazione post --}}
                                <form action="{{route("admin.posts.destroy", ["post"=> $post->id]) }}" action="index.html" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">
                                        Elimina
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="">
                <a href="{{route("admin.posts.create")}}" class="btn btn-success">
                    + Crea un nuovo post
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
