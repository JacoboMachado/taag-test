@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ">
            <h1 class="text-center">Editar Libro</h1>
            <form class="col-md-6 offset-md-3" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" value="{{$book->title}}">
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor:</label>
                    <select name="autor" id="autor" class="form-control">
                        @foreach($authors as $author)
                            <option value="{{$author->id}}" {{ ( $author->id == $book->author_id) ? 'selected' : '' }}>{{$author->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select name="categoria" id="categoria" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ ( $category->id == $book->category_id) ? 'selected' : '' }}>{{$category->category}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="publicacion" class="form-label">Año de Publicación:</label>
                    <input type="number" class="form-control" name="publicacion" id="publicacion" min="1900" max="{{now()->year}}" value="{{$book->publication}}">
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Editar">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
