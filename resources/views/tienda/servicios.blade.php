@extends('layouts.layout')

@section('content')
    <nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <div class="container-fluid container-sm" >
        <a class="navbar-brand" href="{{route('home')}}">
          <img src="../../img/libreta.png" alt="logo" width="75" height="75" class="d-inline-block align-top">
        </a>
        <a class="navbar-brand fs-1" href="{{route('home')}}" style="color: #191970;"> La economica</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link fs-3" aria-current="page" href="{{route('home')}}" style="color: #4F507E;">Inicio</a>
            </li>
            &nbsp;&nbsp;
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle fs-3" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #4F507E;">
                 Tienda  
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item fs-5" href="{{route('tienda_papeleria')}}">Papeleria</a></li>
                <li><a class="dropdown-item fs-5" href="{{route('tienda_servicios')}}">Servicios</a></li>
                <!--<li><a class="dropdown-item" href="#">Something else here</a></li>-->
              </ul>
          </ul>
        </div>
      </div>
    </nav>

    <br>
    <br>
    <br>

    <div class="container">
    @if(count($inventario) > 0)
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($inventario as $producto)
        <div class="col">
          <div class="card shadow-sm">
            
            <img src="../../inv/{{$producto->imagen}}" class="card-img-top" alt="..." >
            <div class="card-body">
              <p class="card-text">{{$producto->descripcion}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text">Precio: ${{number_format($producto->p_venta,2)}}</small>            
                <div class="btn-group">
                  <!--<button type="button" class="btn btn-sm btn-outline-secondary">View</button>-->
                  <input type="number" class="form-control" min="1" step="1" max="{{$producto->inventario}}">
                  <button type="button" class="btn btn-sm btn-outline-primary">Agregar</button>
                </div>
              </div>
              <small class="text-muted" style="color: #E60026;">Precio mayoreo: ${{number_format($producto->p_mayoreo,2)}}</small>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @else
        <div class="alert alert-info" role="alert">Aun no hay productos, estamos trabajando en ello. Esperalos pronto!</div>
    @endif
    </div>
@endsection