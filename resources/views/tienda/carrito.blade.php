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
                <input type="number" class="form-control" min="1" step="1"  id="input_C{{$item->id}}" name="input_C{{$item->id}}" value="{{$item->quantity}}">
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