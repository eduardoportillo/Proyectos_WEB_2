@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Pin</div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('pins.update',$objPin->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nombre">Titulo</label>

                                <input id="titulo" type="text"
                                       class="form-control @error('titulo') is-invalid @enderror" name="titulo"
                                       value="{{$objPin->titulo }}" required>

                                @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-group">
                                    <label for="file">Imagen</label>

                                    <input type="file" name="file" id="file"
                                           class="form-control p-1 @error('file') is-invalid @enderror"
                                           value="" required>

                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tablero_id">Dueño</label>

                                    <select id="tablero_id"
                                            class="form-control @error('personaId') is-invalid @enderror" name="tablero_id"
                                            required>
                                        @foreach($listaTableros as $objTablero)
                                            <option
                                                value="{{$objTablero->id}}" {{old('tablero_id',$objPin->tablero_id) == $objTablero->id? 'selected':''}}>
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
                                <div class="form-group">
                                    <label for="url">URL</label>

                                    <input type="text" id="url"
                                           class="form-control @error('url') is-invalid @enderror" name="url"
                                           value="{{ $objPin->url}}" required>

                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <input type="hidden" id="imagen"
                                       class="form-control" name="imagen" required>

                                <input id="usuario_id" type="hidden"
                                       class="form-control" name="usuario_id"
                                       value="{{auth()->user()->id}}" required>

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
