@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="cold-md-12">
            <form action="{{route('canciones.inedx')}}" method="GET">
                <div class="form-row">
                    <div class="col-sm-4 my-3">
                        <label>
                            <input class="form-control" type="text" name="texto" placeholder="Buscar Cancion">
                        </label>
                    </div>
                    <div class="col-auto my-3">
                        <input type="submit" class="btn btn-primary" value="Buscar" >
                    </div>
                </div>
            </form>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-columns">
                    @foreach($listaCanciones as $objCancion)
                        <div class="card">
                            <div class="card-body">
                                <h4> class="card-title">{{$objCancion->nombre}}</h4>
                                <img src="#" alt="">
                                <p class="card-text">Artista: "{{$objCancion->artista_id}}"</p>



                                <p class="btn float-right ">
                                    <a class="text-dark text-decoration-none" href="{{route('canciones.edit',$objCancion->id) }}">Editar</a>
                                </p>
                                    <form method="POST" action="{{ request('canciones.destroy',$objCancion->id) }}">
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" class="btn text-dark float-right"
                                               onclick="return confirm('¿Está seguro que desea eliminar el Artista?')"
                                               value="Eliminar"/>
                                    </form>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
