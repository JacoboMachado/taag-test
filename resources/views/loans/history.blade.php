@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(isset($loans))
            <div class="col-sm-12">
                @if(count($loans))
                    <h1>Historial de Prestamos @if(isset($user)) de {{$user->name}} @endif</h1>
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Estado</th>
                                <th>Fecha de Prestamo</th>
                                <th>Fecha de Devolucion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                            <tr>
                                <td>{{$loan->onShelve->book->title}}</td>
                                <td>{{$loan->onShelve->book->author->name}}</td>
                                @if(isset($loan->return_date))
                                    <td class="text-success">
                                        Devuelto
                                    </td>
                                @else
                                    <td class="text-warning">
                                        En tu poder
                                    </td>
                                @endif
                                <td>{{$loan->formated_loan_date}}</td>
                                <td>@if(isset($loan->return_date)){{$loan->formated_return_date}}@endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No has realizado prestamos anteriormente</h4>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection