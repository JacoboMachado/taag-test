@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <h1>Buscar Libro</h1>
            <form id="searchBookForm" method="POST">
                    @method('POST')
                    @csrf
                    <div class="col-md-12 mb-4">
                        <input type="search" name="searchBook" id="searchBook"class="form-control" @if(isset($request['searchBook'])) value="{{$request['searchBook']}}" @endif placeholder="Escribe un Título o Autor">
                    </div>
                    <div class="col-md-12 mb-4">
                        <select name="category" id="category" class="form-control" >
                            <option disabled selected>o Seleccina una Categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if(isset($request['category']) && $request['category'] == $category->id) {{"selected"}} @endif>{{$category->category}}</option>
                            @endforeach
                        </select>
                    </div>  
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary btn-block" value="Buscar">
                    </div>              
            </form>
        </div>
        @if(isset($available_books))
            <div class="col-sm-12">
                @if(count($available_books))
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
                                @foreach($available_books as $available_book)
                                <tr>
                                    <td>{{$available_book->title}}</td>
                                    <td>{{$available_book->author->name}}</td>
                                    <td>{{$available_book->publication}}</td>
                                    <td>
                                        <form action="{{route('newLoan', $available_book->id) }}" method="POST">
                                            @method('POST')
                                            @csrf
                                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-check-to-slot"></i></button>
                                        </form>
                                    </td>      
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                @else
                    <h4>No hay libros disponibles para su consulta</h4>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(function(){
            $('#category').on('change', function(){ 
                $('#searchBookForm').submit();
            });
        });
    </script>
@endsection
