{{-- Homepage da loggati --}}

@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Dati</span>
                </div>
                <div class="card-body">
                    <dl>
                        <dt>Nome Utente</dt>
                        <dd>{{Auth::user()->name}}</dd>
                        <dt>e-mail</dt>
                        <dd>{{Auth::user()->email}}</dd>
                        <dt>API Token</dt>
                        @if (Auth::user()->api_token)
                            <dd>{{Auth::user()->api_token}}</dd>
                        @else
                            <form class="" action="{{route("admin.generate_token")}}" method="post">
                                @csrf
                                <button type="submit" name="button" class="btn btn-info">
                                    Genera Token
                                </button>
                            </form>
                        @endif

                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
