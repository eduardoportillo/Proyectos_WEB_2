@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nuevo Tablero</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tableros.store') }}">
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
                            <input id="usuario_id" type="hidden"
                                   class="form-control" name="usuario_id"
                                   value="{{auth()->user()->id}}" required>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Guardar Datos
                                </button>&nbsp;
                                <a href="{{route('tableros.index')}}">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
