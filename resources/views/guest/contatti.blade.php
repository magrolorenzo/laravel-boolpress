@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route("contatti.sent")}}" method="POST" >
                    @csrf

                    {{-- Nome --}}
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="name" class="form-control" maxlength="255" required>
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label>E-Mail</label>
                        <input type="email" name="email" class="form-control"  maxlength="255" required>
                    </div>

                    {{-- Messaggio --}}
                    <div class="form-group">
                        <label>Messaggio</label>
                        <textarea type="textarea" name="message" class="form-control" required></textarea>
                    </div>

                    {{-- Bottone Invia --}}
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" value="Invia">
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
