{{-- Pagina visualizzazione post PUBBLICA --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Elenco Post</h1>
            <table class"table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titolo</th>
                    </tr>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>
                                    <a href="{{route("posts.show",["slug"=>$post->slug])}}">
                                        {{$post->title}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
