@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="cold-md-12">
            <form action="{{route('artistas.index')}}" method="GET">
                <div class="form-row">
                    <div class="col-sm-4 my-3">
                        <label>
                            <input class="form-control" type="text" name="texto" placeholder="Buscar Artista">
                        </label>
                        <input type="submit" class="btn btn-primary" value="Buscar" >
                    </div>

                </div>
            </form>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-columns">
                    @foreach($listaArtista as $objArtista)
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$objArtista->nombre}}</h4>
                                <img src="public/images/crearPartida.png" alt="Sin_Foto_Artista">
                                <p class="card-text">Genero: "{{route('artistas-genero', $objArtista->id)}}"</p>

                                <a href="#">Ver Canciones del Artista </a>
                                <br>

                                    <form method="POST" action="{{ request('artistas.destroy',$objArtista->id) }}">
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" class="btn btn-danger float-right"
                                               onclick="return confirm('¿Está seguro que desea eliminar el Artista?')"
                                               value="Eliminar"/>
                                    </form>

                                <p class="btn  float-right ">
                                    <a class="text-dark text-decoration-none" href="{{route('artistas.edit',$objArtista->id) }}">Editar</a>
                                </p>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
