@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center">Detalle de Ejemplares de Libro</h1>
            <h2 class="text-center">{{$book->author->name}}, ({{$book->publication}}). {{$book->title}}</h2>


            <h3 class="border-bottom">Nuevo Ejemplar</h3>
            <form id="newOnShelve" method="POST" class="row text-center">
                @method('POST')
                @csrf
                <div class="col-md-11 mb-4">
                    <select name="estante" id="estante" class="form-control">
                        <option disabled selected>Estante</option>
                        @foreach ($shelves as $shelve)
                            <option value="{{$shelve->id}}">{{$shelve->shelve}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 mb-4">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-circle-plus"></i></button>
                </div>              
            </form>
        </div>
        @if(isset($book->onShelves))
            <div class="col-sm-8">
                @if(count($book->onShelves))
                    <table class="table table-hover align-middle" >
                        <thead>
                            <tr>
                                <th>Estante</th>
                                <th>Status del Libro</th>
                                <th width="5%"> </th>
                            </tr>
                        </thead>
                        <tbody id="booksList">
                            @foreach($book->onShelves as $onShelve)
                            <tr>
                                <td>{{$onShelve->shelve->shelve}}</td>
                                @if($onShelve->loan)
                                    <td>En Prestamo</td>
                                    <td>
                                        <button class="btn btn-danger" disabled><i class="fa-solid fa-trash-can"></i></button>
                                    </td>    
                                @else
                                    <td>En Estante</td>
                                    <td>
                                        <form action="{{route('deleteOnShelve', ['book' => $book->id, 'onShelve' => $onShelve->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>    
                                    </td>
                                @endif   
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No hay Ejemplares del Libro.</h4>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
