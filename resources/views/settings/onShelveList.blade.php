@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(isset($books))
            <div class="col-sm-12">
                @if(count($books))
                    <h1>Ejemplares de Libros</h1>
                    <h3 class="border-bottom">Libros Existentes</h3>
                    <label for="search">Filtrar:</label>
                    <input type="search" name="search" id="search" class="form-control" placeholder="Título/Autor/Categoría/Año de Publicacion">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" >
                            <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th>Categoría</th>
                                    <th>Cantidad de Ejemplares</th>
                                    <th>Publicación</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody id="booksList">
                                @foreach($books as $book)
                                <tr>
                                    <td>{{$book->title}}</td>
                                    <td>{{$book->author->name}}</td>
                                    <td>{{$book->category->category}}</td>
                                    <td>{{$book->on_shelves_count}}</td>
                                    <td>{{$book->publication}}</td>
                                    <td>
                                        <a href="{{route('onShelvesDetails', $book->id)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h4>No hay libros en la Librería</h4>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(function(){
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#booksList tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection