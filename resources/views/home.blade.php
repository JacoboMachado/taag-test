@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (!Session::has('success') && !$errors->any())
                <div class="card">
                    <div class="card-header">Bienvenido!</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
