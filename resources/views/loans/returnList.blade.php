@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(isset($loans))
            <div class="col-sm-12">
                @if(count($loans))
                    <h1>Libros en Prestamo</h1>
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th >Título</th>
                                <th >Autor</th>
                                <th >Publicación</th>
                                <th width="10%"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                            <tr>
                                <td>{{$loan->onShelve->book->title}}</td>
                                <td>{{$loan->onShelve->book->author->name}}</td>
                                <td>{{$loan->onShelve->book->publication}}</td>
                                <td>
                                    <form action="{{route('newReturn', $loan->id) }}" method="POST">
                                        @method('POST')
                                        @csrf
                                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-rotate-left"></i></button>
                                    </form>
                                </td>      
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No tienes libros pendientes por devolver</h4>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
