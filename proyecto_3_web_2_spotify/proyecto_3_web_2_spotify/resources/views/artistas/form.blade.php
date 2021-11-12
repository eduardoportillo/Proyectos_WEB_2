@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nuevo Artista</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('artistas.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nombre">Nombre</label>

                                <input id="nombre" type="text"
                                       class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                       value="{{ old('nombre') }}" required>

                                @error('nombre')

                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div>
                                <label for="path_foto">URL Imagen</label>
                                <input class="form-control id="path_foto" name="path_foto" nametype="text" value="{{ old('path_foto') }}" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Guardar Datos
                                </button>&nbsp;
                                <a href="{{route('artistas.index')}}">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
