@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="cold-md-12">
            <form action="{{route('tableros.index')}}" method="GET">
                <div class="form-row">
                    <div class="col-sm-4 my-3">
                        <input class="form-control" type="text" name="texto" placeholder="Buscar tablero">
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
                    @foreach($listaTableros as $objTablero)
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$objTablero->nombre}}</h4>
                                <p class="card-text">Creado por: {{$objTablero->name}}</p>
                                <a href="{{route('pins.all',$objTablero->tablero_id)}}">Ver Pins</a>
                                @if(auth()->id() == $objTablero->usuario_id)
                                    <form method="POST" action="{{ route('tableros.destroy',$objTablero->tablero_id) }}">
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" class="btn text-dark float-right"
                                               onclick="return confirm('¿Está seguro que desea eliminar el pin?')"
                                               value="Eliminar"/>
                                    </form>
                                    <p class="btn float-right "><a class="text-dark text-decoration-none"
                                                                   href="{{ route('tableros.edit',$objTablero->tablero_id) }}">Editar</a>
                                    </p>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
