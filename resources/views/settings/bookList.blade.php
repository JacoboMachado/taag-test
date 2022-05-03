@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <h1 class="text-center">Listado de Libros</h1>

            <h3 class="border-bottom">Nuevo Libro</h3>
            <form id="newBook" method="POST" class="row text-center">
                    @method('POST')
                    @csrf
                    <div class="col-md-3 mb-4">
                        <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título del Libro">
                    </div>
                    <div class="col-md-3 mb-4">
                        <select name="autor" id="autor" class="form-control">
                            <option disabled selected>Autor</option>
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-4">
                        <select name="categoria" id="categoria" class="form-control">
                            <option disabled selected>Categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-4">
                        <input type="number" name="publicacion" id="publicacion" class="form-control" min="1900" max="{{now()->year}}" placeholder="Año de Publicación">
                    </div>
                    <div class="col-md-1 mb-4">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-circle-plus"></i></button>
                    </div>              
            </form>
        </div>
        @if(isset($books))
            <div class="col-sm-12">
                @if(count($books))
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
                                            <a href="{{route('editBook', $book->id)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </td>   
                                        <td>
                                            <form action="{{route('deleteBook', $book->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>    
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