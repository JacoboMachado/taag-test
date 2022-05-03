@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center">Consulta de Prestamos por Usuario</h1>
        </div>
        <div class="col-sm-8">
            <div class="table-responsive">
                <table class="table table-hover align-middle" >
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>E-mail</th>
                            <th>Prestamos totales</th>
                            <th>Prestamos activos</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody id="booksList">
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->loans_count}}</td>
                            <td></td>
                            <td>
                                <a href="{{route('detailLoansPerUser', $user->id)}}" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
