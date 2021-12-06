@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Tablero</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tableros.update',$objTablero->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nombre">Nombre</label>

                                <input id="nombre" type="text"
                                       class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                       value="{{ old('nombre',$objTablero->nombre) }}" required>

                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="usuario_id" type="hidden"
                                       class="form-control" name="usuario_id"
                                       value="{{auth()->user()->id}}" required>

                                <div class="form-group py-3">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar Datos
                                    </button>&nbsp;
                                    <a href="/tableros">Cancelar</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
