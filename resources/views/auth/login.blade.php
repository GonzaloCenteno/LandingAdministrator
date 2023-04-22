@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-center"><h1>INICIAR SESION</h1></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="USUA_NombreUsuario" class="col-md-4 col-form-label text-md-end">USUARIO</label>

                            <div class="col-md-6">
                                <input id="USUA_NombreUsuario" type="text" class="form-control @error('USUA_NombreUsuario') is-invalid @enderror" name="USUA_NombreUsuario" value="{{ old('USUA_NombreUsuario') }}" required autocomplete="USUA_NombreUsuario" autofocus>

                                @error('USUA_NombreUsuario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">PASSWORD</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-4"></div>
                            <div class="col-6 d-grid gap-2">
                                <button type="submit" class="btn btn-outline-primary btn-block">
                                    INGRESAR
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
