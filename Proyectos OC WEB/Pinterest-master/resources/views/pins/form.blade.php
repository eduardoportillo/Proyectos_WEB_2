@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nuevo Pin</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pins.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="titulo">Titulo</label>

                                <input type="text" id="titulo"
                                       class="form-control @error('titulo') is-invalid @enderror" name="titulo"
                                       value="{{ old('titulo') }}" required>

                                @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">Imagen</label>

                                <input type="file" name="file" id="file"
                                       class="form-control p-1 @error('file') is-invalid @enderror"
                                       value="{{ old('file')}}" required>

                                @error('imagen')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="url">URL</label>

                                <input type="text" id="url"
                                       class="form-control @error('url') is-invalid @enderror" name="url"
                                       value="{{ old('url') }}" required>

                                @error('url')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tablero_id">Tablero</label>

                                <select id="tablero_id"
                                        class="form-control @error('tablero_id') is-invalid @enderror" name="tablero_id"
                                        required>
                                    @foreach($listaTableros as $objTablero)
                                        <option
                                            value="{{$objTablero->id}}" {{old('tablero_id') == $objTablero->id? 'selected':''}}>
                                            {{$objTablero->nombre}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tablero_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input id="usuario_id" type="hidden"
                                   class="form-control" name="usuario_id"
                                   value="{{auth()->user()->id}}" required>

                            <input type="hidden" id="imagen"
                                   class="form-control" name="imagen" required>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Guardar Datos
                                </button>&nbsp;
                                <a href="{{route('pins.index')}}">Cancelar</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
