
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
                            <td class="d-flex">
                                <a href="{{route("admin.posts.show" , ["post"=> $post->id]) }}" class="btn btn-primary">
                                    Visualizza
                                </a>
                                <a href="{{route("admin.posts.edit" , ["post"=> $post->id]) }}" class="btn btn-warning">
                                    Modifica
                                </a>
                                <a href="#" class="btn btn-danger">
                                    Elimina
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
