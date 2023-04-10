@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <select name="" id="">
                    <option value="">Seleccione un Tipo Formulario:</option>
                    @foreach (App\Enums\FormularioTipos::cases() as $tipos)
                        <option value="{{ $tipos->value }}">{{ $tipos->name }}</option>    
                    @endforeach
                </select>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
