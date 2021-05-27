@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="text-center">
        <br>
        <img src="../../img/libreta.png" alt="logo" width="250" height="250">
        <br><br>
        <div class="col-md-6 offset-md-3">
            <div class="card border-0">
                <div class="card-body">
                    <div class="container">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $message)
                                    <p><strong>{{ $message }}</strong></p>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <p class="fs-1 card-title" style="color: #191970;">Inicio de sesion</p>
                        <br>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                            <div class="row align-items-center">
                                <div class="col-4 text-end">
                                    <label for="email" class="fs-4 col-form-label " style="color: #191970;">Correo:</label>
                                </div>
                                <div class="col-7">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus autocomplete="off">
                                </div>
                            </div>

                            <br>
                            <div class="row align-items-center">
                                <div class="col-4 text-end">
                                    <label for="password" class="fs-4 col-form-label " style="color: #191970;">Contraseña:</label>
                                </div>
                                <div class="col-7">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>

                                <div class="col-11 text-end">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
                                        </label>
                                    </div>
                                </div>
                            </div>

                            

                            <br>
                            <div class="row align-item-center">
                                <div class="col-11 text-end">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Ingresar
                                    </button>
                                </div>
                                
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
