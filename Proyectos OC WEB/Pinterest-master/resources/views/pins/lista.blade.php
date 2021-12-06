@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="cold-md-12">
            <form action="{{route('pins.index')}}" method="GET">
                <div class="form-row">
                    <div class="col-sm-4 my-3">
                        <input class="form-control" type="text" name="texto" placeholder="Buscar pin">
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
                    @foreach($listaPins as $objPin)
                        <div class="card">
                            <a href="{{$objPin->url}}" target="_blank">
                                <img class="card-img-top" height="250" width="250"
                                     src="../images/{{$objPin->imagen}}">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">{{$objPin->titulo}}</h4>
                                <p class="card-text">Creado por: {{$objPin->name}}</p>
                                @if(auth()->id() == $objPin->user_id)
                                    <form method="POST" action="{{ route('pins.destroy',$objPin->pin_id) }}">
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" class="btn text-dark float-right"
                                               onclick="return confirm('¿Está seguro que desea eliminar el pin?')"
                                               value="Eliminar"/>
                                    </form>
                                    <p class="btn float-right "><a class="text-dark text-decoration-none"
                                                                   href="{{ route('pins.edit',$objPin->pin_id) }}">Editar</a>
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
