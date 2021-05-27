@extends('layouts.layout')

@section('content')
    <nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <div class="container-fluid container-sm" >
        <a class="navbar-brand a_back" href="{{route('tienda_home')}}">
          <img src="../../img/libreta.png" alt="logo" width="75" height="75" class="d-inline-block align-top">
        </a>
        <a class="navbar-brand fs-1 a_back" href="{{route('tienda_home')}}" style="color: #191970;"> La economica</a>

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
                <li><a class="dropdown-item fs-5 a_back" href="{{route('tienda_papeleria')}}">Papeleria</a></li>
                <li><a class="dropdown-item fs-5 a_back" href="{{route('tienda_servicios')}}">Servicios</a></li>
              </ul>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>

    <br>

    <div class="container">
      
      <div class="py-3 text-center">
        <h2>Confirmacion de pedido.</h2>
      </div>
      
      @if(isset($status))
      <div class="row g-3">
        <div class="col-md-7 col-lg-8">
          @if($status === 'Gracias! El pago a través de PayPal se ha ralizado correctamente.' || $status === 'Su orden se creo correctamente.')
          <div class="alert alert-success" role="alert">
            {{$status}}
          </div>
          @else
          <div class="alert alert-danger" role="alert">
            {{$status}}
          </div>
          @endif
        </div>
      </div>
        {!! session()->forget('status') !!}
      @endif

        <div class="row g-3">
            @if(!isset($pago))
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="">Tu carrito</span>
                    <span class="badge bg-dark rounded-pill">{{count(Cart::getContent())}}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach(Cart::getContent() as $item)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">{{$item->name}}</h6>
                            <small class="text-muted">Cantidad: {{$item->quantity}} <br> Precio: {{$item->price}}</small>
                        </div>
                        <span class="text-muted">${{$item->attributes->total}}</span>
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between bg-light">
                      <span>Subtotal (MX)</span>
                      <strong>${{Cart::getSubTotal()}}</strong>
                    </li>
                    @if(Cart::getSubTotal() < 200)
                    <li class="list-group-item d-flex justify-content-between">
                      <div class="text-success">
                        <h6 class="my-0">Costo de envio</h6>
                        <!--<small>EXAMPLECODE</small>-->
                      </div>
                      <span class="text-success">+$30</span>
                    </li>
                    @else
                    <li class="list-group-item d-flex justify-content-between">
                      <div class="text-danger">
                        <h6 class="my-0">Costo de envio</h6>
                        <!--<small>EXAMPLECODE</small>-->
                      </div>
                      <span class="text-success"><s class="text-danger">+$30</s> &nbsp;&nbsp; $0</span>
                    </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between bg-light">
                      <span>Total (MX)</span>
                      <strong>${{Cart::getTotal()}}</strong>
                    </li>
                </ul>
            </div>
            @endif

            <div class="col-md-7 col-lg-8">
              @if(!isset($pedido_id))
                <h4 class="mb-3 informacion_cliente">Infromacion de envio</h4>
                <!--<form action="" method="POST" class="needs-validation" novalidate>-->
                <div class="row g-3">
                    <div class="col-sm-6 informacion_cliente">
                      <label for="nombre" class="form-label">Nombres</label>
                      <input type="text" class="form-control validacion" id="nombre" placeholder="" value="" required>
                    </div>

                    <div class="col-sm-6 informacion_cliente">
                      <label for="apellidos" class="form-label">Apellidos</label>
                      <input type="text" class="form-control validacion" id="apellidos" placeholder="" value="" required>
                    </div>

                    <div class="col-6 informacion_cliente">
                      <label for="email" class="form-label">Correo</label>
                      <input type="email" class="form-control validacion" id="email" placeholder="you@example.com" value="" required>
                    </div>

                    <div class="col-6 informacion_cliente">
                      <label for="telefono" class="form-label">Telefono</label>
                      <input type="text" class="form-control validacion" id="telefono" placeholder="5520164875" value="" required minlength="10" maxlength="10">
                    </div>

                    <div class="col-12 informacion_cliente">
                      <label for="direccion" class="form-label">Direccion</label>
                      <input type="text" class="form-control validacion" id="direccion" placeholder="Gabriel Suaréz 260. Mercado condesa local 342." required>
                    </div>

                    <div class="col-md-2 informacion_cliente">
                      <label for="cp" class="form-label">Codigo Postal</label>
                      <input type="text" class="form-control validacion" id="cp" placeholder="" required>
                    </div>

                    <div class="col-md-5 informacion_cliente">
                      <label for="municipio" class="form-label">Municipio</label>
                      <input type="text" class="form-control validacion" id="municipio" required readonly>
                    </div>
                    
                    <div class="col-md-5 informacion_cliente">
                      <label for="colonia" class="form-label">Colonia</label>
                      <select class="form-select validacion" id="colonia" required>
                        <option value="">Seleccione una colonia</option>
                      </select>
                    </div>

                    <div class="col-12 informacion_cliente">
                      <label for="estado" class="form-label">Estado</label>
                      <input type="text" class="form-control validacion" id="estado" required readonly>
                    </div>

                    <div class="col-md-5 informacion_cliente">
                      <label for="dia_entrega" class="form-label">Dia de entrega</label>
                      {{-- date('Y-m-d',strtotime('+1 Days')) }}  {{ date('Y-m-d') --}}
                      <input type="date" class="form-control validacion" id="dia_entrega" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="col-md-7 informacion_cliente">
                      <label for="hora_entrega" class="form-label">Horario de entrega</label>
                      <select class="form-select validacion" id="hora_entrega" required>
                        <option value="">Seleccione un horario</option>
                      </select>
                    </div>

                    <div class="col-12 informacion_cliente">
                      <label for="comments" class="form-label">Comentarios adicionales</label>
                      <textarea class="form-control" name="comments" id="comments" cols="30" rows="10" placeholder="La calle se encunetra entre las calles..." minlength="0" maxlength="500"></textarea>
                    </div>
              @endif
              @if(!isset($pago))
                    <h4 class="mb-3 forma_pago"  style="display: {{isset($pedido_id) ? '' : 'none'}};">Forma de pago</h4>

                    <div class="my-3 forma_pago" style="display: {{isset($pedido_id) ? '' : 'none'}};">
                      <div class="form-check">
                        <input id="contra_entrega" name="paymentMethod" type="radio" class="form-check-input" value="ContraEntrega" required>
                        <label class="form-check-label" for="credit">Contra entrega</label>
                      </div>
                      {{--<div class="form-check">
                        <input id="efectivo" name="paymentMethod" type="radio" class="form-check-input" value="Efectivo" required>
                        <label class="form-check-label" for="credit">Pago en efectivo con mercado pago</label>
                      </div>
                      <div class="form-check">
                        <input id="tarjeta debito/credito" name="paymentMethod" type="radio" class="form-check-input" value="Tarjeta" required>
                        <label class="form-check-label" for="debit">Tarjeta de debito/credito con mercado pago</label>
                      </div>--}}
                      <div class="form-check">
                        <input type="hidden" name="pid" id="pid" value="{{isset($pedido_id) ?  $pedido_id : ''}}">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" value="PayPal" required>
                        <label class="form-check-label" for="paypal">PayPal</label>
                      </div>
                    </div>

                    <!-- inputs o botones de la forma de pago-->
                    <div class="row gy-3" id="forma_de_pago_requerimientos" style="display: none;">
                      {{--Contra entrega--}}
                      <div class="alert alert-warning" role="alert" id="forma_de_pago_contraentrega">El repartidor acepta pagos con efectivo o tarjetas. Si el pago es con efectivo considera que el repartidor solo lleva $100 de cambio</div>

                      {{--Pago con paypal--}}
                      <div class="col-md-6" id="forma_de_pago_paypal">
                        <button type="button" class="btn btn-outline-light" id="bpPP" onclick="URLPP()" style="background-color: white; border-color: white;">
                          <img src="https://www.paypalobjects.com/marketing/web/mx/logos-buttons/Paga-con-yellow_227x44.png" alt="Check out with PayPal" />
                        </button>
                      </div>
                        
                    </div>
              @else
                  <p class="mb-3 text-uppercase fs-2 fw-bold" style="color: #4F507E;">Pedido Confirmado</p>
                  <p class="mb-3 text-muted fs-5 ">
                    Numero de pedido: {{$pedido_id}} <br><br>
                    <b class="text-center">Gracias por tu compra!</b>
                  </p>
                  {!! session()->forget('pago') !!}
                  {!! session()->forget('pedido_id') !!}
              @endif

                    <hr class="my-4" >
                    <button class="w-100 btn btn-primary btn-lg" type="button" paso="datos" id="boton_pasos" onclick="" style="background-color: #4F507E; border-color: #4F507E; display: {{ isset($pedido_id) ? ( isset($pago) ? ($pago == true ? 'none' : '') : 'none') : ''}};">
                    {{-- (!isset($pedido_id) || isset($pago)) ? ($pago == true ? 'none' : '') : 'none' --}}
                    
                        <span class="spinner-border spinner-border-sm SBC" role="status" aria-hidden="true" style="display: none;"></span>
                        <b id="text-boton-checkout">Continuar al pago</b>
                      </button>
                </div>
                <!--</form>-->
            </div>
        </div>


    </div>
    


    <br><br>

    <footer class="text-center footer-style" style="background-color: #e3f2fd;">
        <div class="container-sm">
            <div class="row">
                <div class="col-md-4 footer-col" style="margin: 20px 0px 20px 0px">
                    <a href="https://www.facebook.com/Papeleria-caf%C3%A9-internet-la-economica-110019644094696" target="_blank"><img src="../../img/facebook.png" width="40" height="40" alt="facebook"></a>
                </div>

                <div class="col-md-4 footer-col" style="margin: 20px 0px 20px 0px">
                    <h3>Telefono</h3>
                    <p>55-27-91-30-93</p>
                </div>
                
                <div class="col-md-4 footer-col" style="margin: 20px 0px 20px 0px">
                    <a href="https://wa.me/525612187000?text=Hola,%20necesito%20algunos%20productos%20de%20papeleria." target="_blank"><img src="../../img/whatsapp.png" width="40" height="40" alt="whatsapp"></a>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('scripts')
<script src="{{ asset('js/tienda.js') }}"></script>
<script>
    $(document).ready(function(){
        $(".validacion").focusout(function() {
          var value = $(this).val();
          if (value == "") {
            $(this).addClass("is-invalid");
          } else {
            $(this).removeClass("is-invalid");
          }
        });

        $('.a_back').click(function(e){
          let pid = $('#pid').val();
          if(pid != ''){
            @if(isset($pago))
              @if($pago != true)
                var opcion = confirm("Quieres abandonar la pagina actual? se perdera toda la informacion introducida");
                if (opcion == true) {
                  //alert('ok');
                  $.ajax({
                    url:'/pedidos/eliminar/'+pid,
                    type:'GET',
                    error:function(resp){
                      alert('error al eliminar el pedido');
                      e.preventDefault();
                      console.log(resp);
                    }
                  })
                } else {
                  //alert('cancel');
                  e.preventDefault();
                }
              @endif 
            @else
              var opcion = confirm("Quieres abandonar la pagina actual? se perdera toda la informacion introducida");
              if (opcion == true) {
                //alert('ok');
                $.ajax({
                  url:'/pedidos/eliminar/'+pid,
                  type:'GET',
                  error:function(resp){
                    alert('error al eliminar el pedido');
                    e.preventDefault();
                    console.log(resp);
                  }
                })
              } else {
                //alert('cancel');
                e.preventDefault();
              }
            @endif
          }
        })
    });

    function URLPP(){
      let pid = $('#pid').val();
      let url = "{{url('/paypal/pay', ['pedido_id' => 't1' ])}}";
      url = url.replace('t1', pid);
      
      //window.close();
      window.open(url,"_self");
    }

    function URLF(){
      let pid = $('#pid').val();
      let url = "{{url('/tienda/finalizado', ['pedido_id' => 't1' ])}}";
      url = url.replace('t1', pid);

      window.open(url,"_self");
    }

</script>
@endsection