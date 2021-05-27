@extends('layouts.layout')

@section('content')
<br><br>
<div class="container-fluid">
    <div class="row">
        <div class="col-2 offset-1 ">
            <a href="{{route('login')}}"><img src="../../img/back.png" alt="volver" width="25" height="25"></a>
        </div>
    </div>
</div>

<div class="container">
    <div class="text-center">
        <div class="col-md-6 offset-md-3">
            <div class="card border-0">
                <div class="card-body">
                    <div class="container">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $message)
                                <p><strong>{{ $message }}</strong></p>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                        <p class="fs-1 card-title" style="color: #191970;">Recuperar contraseña</p>
                        <br>
                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <div class="row align-items-center">
                                <div class="col-4 text-end">
                                    <label for="email" class="fs-4 col-form-label " style="color: #191970;">Correo:</label>
                                </div>
                                <div class="col-7">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off">
                                </div>
                            </div>
                            
                            <br>
                            <div class="row align-items-center">
                                <div class="col-7 offset-4 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        Enviar link
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
