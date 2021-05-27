@extends('layouts.layout')

@section('content')
    <nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <div class="container-fluid container-sm" >
        <a class="navbar-brand" href="{{route('tienda_home')}}">
          <img src="../../img/libreta.png" alt="logo" width="75" height="75" class="d-inline-block align-top">
        </a>
        <a class="navbar-brand fs-1" href="{{route('tienda_home')}}" style="color: #191970;"> La economica</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle fs-3" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #4F507E;">
                 Tienda  
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item fs-5" href="{{route('tienda_papeleria')}}">Papeleria</a></li>
                <li><a class="dropdown-item fs-5" href="{{route('tienda_servicios')}}">Servicios</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown" id="carritoRecarga">
              <div class="btn-group" style="margin: 5px 0px 0px 30px;">
                <button type="button" class="btn btn-primary dropdown-toggle btn-lg" data-bs-toggle="dropdown" aria-expanded="false" style="border-color: #4F507E; background-color: #4F507E;">
                  <span class="badge bg-danger rounded-pill n_carrito" id="n_carrito" style="display: {{count(Cart::getContent()) ? '' : 'none'}} ;">
                    {{count(Cart::getContent())}}
                  </span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                  </svg> 
                </button>
    
                <ul class="dropdown-menu p-2 " aria-labelledby="navbarDropdownMenuLink" id="carrito_desplegable" style="width: 30rem; height: auto; max-height:400px; overflow-x:hidden; ">
                  <div class="container" id="lista_productos">
                    @forelse(Cart::getContent() as $item)
                    <li class="item">
                      <div class="row">
                        <div class="col-1">
                          <a title="Placeholder link title" class="text-decoration-none" style="color: #E60026;" onclick="EliminarCarrito({{$item->id}})"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg>
                          </a>
                        </div>
                        <div class="col-2">
                          <img src="../../inv/{{$item->attributes->url_foto}}" alt="" width="70" height="70">
                        </div>
                        <div class="col-5">
                          {{$item->name}}<br><small>{{$item->price}} x {{$item->quantity}} = {{$item->attributes->total}}</small>
                        </div>
                        <div class="col-4">
                          <div class="btn-group btn-group-sm" style="margin-top: 10px;">
                            <input type="number" class="form-control" min="1" step="1" id="input_C{{$item->id}}" name="input_C{{$item->id}}" value="{{$item->quantity}}">
                            <button type="button" class="btn btn-sm btn-primary" onclick="ActualizarCarrito({{$item->id}})" style="border-color: #4F507E; background-color: #4F507E;"><small>Cambiar</small></button>
                          </div>
                        </div>
                      </div>
                    </li>
                    @empty
                    <li><div class="alert alert-warning" role="alert">El carrito esta vacio</div></li>
                    @endforelse

                  </div>
                  <li><hr class="dropdown-divider"></li>
                  <li class="dropdown-item text-end" id="totalcarrito">Total = $<b id="subtotal_num">{{number_format(Cart::getTotal(),2)}}</b></li>
                  @if(count(Cart::getContent()) > 0)
                  <li class="item">
                    <div class="d-grid gap-2 col-6 mx-auto">
                      <a href="{{route('confirmar_compra')}}" class="btn btn-primary" type="button" id="BTNConfirmarCompra" style="border-color: #4F507E; background-color: #4F507E;">Confirmar compra</a>
                    </div>
                  </li>
                  <li><hr class="dropdown-divider"></li>
                  <li class="item">
                    <div class="d-grid gap-2 col-6 mx-auto">
                      <button class="btn btn-outline-secondary" type="button" style="border: none;" onclick="VaciarCarrito()">Vaciar carrito</button>
                    </div>
                  </li>
                  @endif

                </ul>
              </div>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>

    <br>

    <div class="container">
      <h3 class="text-muted text-center">
        Productos de papeleria
      </h3>

      <br>
      
      <div class="alert alert-warning" role="alert">
        <b>Precio de mayoreo</b> a partir de 10 productos. <br>
        <b>Costo de envio </b>gratis en pedidos superiores a $200 (MXN)
      </div>
      <br>

      <div class="row align-items-center">
        <div class="col-6">
          <h6>
            Pagina {{$inventario->currentPage()}}
            <br>
            <small class="text-muted">mostrando {{$inventario->count()}} de {{$inventario->total()}}</small>
          </h6>
        </div>
        <div class="col-1 offset-5">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
              <li class="page-item {{$inventario->previousPageUrl() != null ? '' : 'disabled'}}"><a class="page-link" href="{{$inventario->previousPageUrl() != null ? $inventario->previousPageUrl() : ''}}"><<</a></li>
              <li class="page-item {{$inventario->nextPageUrl() != null ? '' : 'disabled'}}"><a class="page-link" href="{{$inventario->nextPageUrl() != null ? $inventario->nextPageUrl() : ''}}">>></a></li>
              <br><br>
              
            </ul>
          </nav>
        </div>
      </div>

      @if(count($inventario) > 0)
      <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-5">
        @foreach($inventario as $producto)
        <div class="col">
          <div class="card shadow-sm">
            
            <img src="../../inv/{{$producto->imagen}}" class="card-img-top" alt="...">
            <div class="card-body">
              <p class="card-text">{{$producto->descripcion}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text">Precio: ${{number_format($producto->p_venta,2)}}</small>            
                <div class="btn-group">
                  <!--<button type="button" class="btn btn-sm btn-outline-secondary">View</button>-->
                  <input type="number" class="form-control" min="1" step="1" max="{{$producto->inventario}}" id="input{{$producto->id}}" name="input{{$producto->id}}" value="1">
                  <button type="button" class="btn btn-sm btn-primary" onclick="AgregarCarrito({{$producto->id}})" style="border-color: #4F507E; background-color: #4F507E;">Agregar</button>
                </div>
              </div>
              <small class="text-muted" style="color: #E60026;">Precio mayoreo: ${{number_format($producto->p_mayoreo,2)}}</small>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @else
      <div class="alert alert-info" role="alert">
        Aun no hay productos, estamos trabajando en ello. Esperalos pronto!
      </div>
      @endif
      
      <br>

      <div class="row align-items-center">
          <div class="col-6">
            <h6>
              Pagina {{$inventario->currentPage()}}
              <br>
              <small class="text-muted">mostrando {{$inventario->count()}} de {{$inventario->total()}}</small>
            </h6>
          </div>
          <div class="col-1 offset-5">
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end">
                <li class="page-item {{$inventario->previousPageUrl() != null ? '' : 'disabled'}}"><a class="page-link" href="{{$inventario->previousPageUrl() != null ? $inventario->previousPageUrl() : ''}}"><<</a></li>
                <li class="page-item {{$inventario->nextPageUrl() != null ? '' : 'disabled'}}"><a class="page-link" href="{{$inventario->nextPageUrl() != null ? $inventario->nextPageUrl() : ''}}">>></a></li>
                <br><br>
                
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <br>

    <footer class="text-center footer-style" style="background-color: #e3f2fd;">
        <div class="container-sm">
            <div class="row">
                <div class="col-md-4 footer-col" style="margin: 20px 0px 20px 0px">
                    <a href="https://www.facebook.com/Papeleria-caf%C3%A9-internet-la-economica-110019644094696"><img src="../../img/facebook.png" width="40" height="40" alt="facebook"></a>
                </div>

                <div class="col-md-4 footer-col" style="margin: 20px 0px 20px 0px">
                    <h3>Telefono</h3>
                    <p>55-27-91-30-93</p>
                </div>
                
                <div class="col-md-4 footer-col" style="margin: 20px 0px 20px 0px">
                    <a href="https://wa.me/525612187000?text=Hola,%20necesito%20algunos%20productos%20de%20papeleria."><img src="../../img/whatsapp.png" width="40" height="40" alt="whatsapp"></a>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('scripts')
<script src="{{ asset('js/tienda.js') }}"></script>
@endsection