@if(Auth::user()->empleado->estado == "Baja")

@endif



@extends('layouts.layout')

@section('content')
<header class="navbar sticky-top  flex-md-nowrap p-3 shadow" style="background-color: #e3f2fd;">
<div class="container-fluid">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-3" href="" style="color: #191970;">Papeleria "La economica"</a>
    <button class="col-1 offset-10 navbar-toggler position-absolute d-md-none collapsed col-md-4 col-lg-offset-0"  type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <img src="../../img/menu.png" alt="menu" width="30" height="30">
    </button>
    
</div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: #e3f2fd;">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          @if(Auth::user()->empleado->estado != "Baja")
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#" style="color: #191970;" id="inicio">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Inicio
              </a>
            </li>
            @if(Auth::user()->empleado->puesto->nombre != "Repartidor")
            <li class="nav-item">
              <a class="nav-link" href="#" style="color: #191970;" id="inventario">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                Inventario
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a class="nav-link" href="#" style="color: #191970;" id="pedidos">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                Pedidos 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-danger rounded-pill noti" id="noti" style="display: none;">10</span>
              </a>
            </li>
            @if(Auth::user()->empleado->puesto->nombre == "Administrador")
            <li class="nav-item">
              <a class="nav-link" href="#" style="color: #191970;" id="empleados">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                Empleados
              </a>
            </li> 
            @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" style="color: #191970;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><button type="button" class="btn btn-outline-light" style="border-color: #191970; color:#191970;">Cerrar sesion</button>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
            
          @endif
          
        </ul>

        <!--<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Year-end sale
            </a>
          </li>
        </ul>-->
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
                <div class="">

                </div>
            </div>
            <div class="chartjs-size-monitor-shrink">
                <div class="">

                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" >
            <h1 class="h2" id="titulo">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0" id="btn-titulo">
              <div class="btn-group me-2">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                  This week
              </button>
            </div>
        </div>

        <!-- Modal agregar empleado -->
        <div class="modal fade" id="registrarEmpleado" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card border-0">
                  <div class="card-body">
                    <div class="container">
                      <div class="row align-items-center">
                          <div class="col-4 text-end">
                              <label for="name" class="col-form-label ">Nombre:</label>
                          </div>
                          <div class="col-7">
                              <input id="name" type="text" class="form-control validacion emp" name="name" value="{{ old('name') }}" required autofocus autocomplete="off">
                          </div>
                      </div>
                      <br>
                      <div class="row align-items-center">
                          <div class="col-4 text-end">
                              <label for="puesto" class="col-form-label ">Puesto:</label>
                          </div>
                          <div class="col-7">
                                @php($puestos =  App\Puesto::all())
                                <select name="puesto" id="puesto" class="form-control validacion emp" required>
                                <option hidden selected value="">Seleccione un puesto</option>
                                @foreach($puestos as $puesto)
                                <option value="{{$puesto->id}}">{{$puesto->nombre}}</option>
                                @endforeach
                                </select>
                          </div>
                      </div>
                      <br>
                      <div class="row align-items-center">
                          <div class="col-4 text-end">
                              <label for="email" class="col-form-label ">Correo:</label>
                          </div>
                          <div class="col-7">
                              <input id="email" type="text" class="form-control validacion emp" name="email" value="{{ old('email') }}" required autofocus autocomplete="off">
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="CancelarsGE">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarEmpleado">
                  <span class="spinner-border spinner-border-sm sGE" role="status" aria-hidden="true" style="display: none;"></span>
                  Guardar
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal-->

        <!-- Modal editar empleado -->
        <div class="modal fade" id="editarEmpleado" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card border-0">
                  <div class="card-body">
                    <div class="container">
                      <input id="id2" type="hidden" name="id2">
                      <div class="row align-items-center">
                          <div class="col-4 text-end">
                              <label for="name2" class="col-form-label ">Nombre:</label>
                          </div>
                          <div class="col-7">
                              <input id="name2" type="text" class="form-control validacion" name="name2" autofocus autocomplete="off">
                          </div>
                      </div>
                      <br>
                      <div class="row align-items-center">
                          <div class="col-4 text-end">
                              <label for="puesto2" class="col-form-label ">Puesto:</label>
                          </div>
                          <div class="col-7">
                                @php($puestos =  App\Puesto::all())
                                <select name="puesto2" id="puesto2" class="form-control validacion">
                                @foreach($puestos as $puesto)
                                <option value="{{$puesto->id}}">{{$puesto->nombre}}</option>
                                @endforeach
                                </select>
                          </div>
                      </div>
                      <br>
                      <div class="row align-items-center">
                          <div class="col-4 text-end">
                              <label for="email2" class="col-form-label ">Correo:</label>
                          </div>
                          <div class="col-7">
                              <input id="email2" type="text" class="form-control validacion" name="email2"  autocomplete="off">
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="CancelarsGE2">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarEmpleado2">
                  <span class="spinner-border spinner-border-sm sGE2" role="status" aria-hidden="true" style="display: none;"></span>
                  Guardar</button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal-->

        <!-- Modal eliminar-->
        <div class="modal fade" id="eliminarEmpleado" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card border-0">
                  <div class="card-body">
                    <div class="container text-center">
                      <input type="hidden" id="id_elm" name="id_elm">
                      <img src="../../img/advertencia.png" alt="advertencia" id="advertencia_img">
                      <br>
                      <p id="mensaje_elm"></p>

                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="Cancelar">Cancelar</button>
                <button type="button" class="btn btn-danger" id="Confirmar">
                  <span class="spinner-border spinner-border-sm sCE" role="status" aria-hidden="true" style="display: none;"></span>
                  Confirmar
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal-->

        <!-- Modal agregar producto -->
        <div class="modal fade" id="agregarProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card border-0">
                  <div class="card-body">
                      <div class="container">
                        <div class="row align-items-center">
                            <div class="col-4 text-end">
                                <label for="departamento" class="col-form-label ">Departamento:</label>
                            </div>
                            <div class="col-8">
                                  @php($departamentos = App\Departamento::all())
                                  <select name="departamento" id="departamento" class="form-control validacion prod" required>
                                    <option hidden selected value="">Seleccione un departamento</option>
                                    @foreach($departamentos as $departamento)
                                    <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center ps" style="display: none;">
                            <div class="col-4 text-end">
                                <label for="descripcion" class="col-form-label ">Descripcion:</label>
                            </div>
                            <div class="col-8">
                                <textarea name="descripcion" id="descripcion" cols="30" rows="2" class="form-control validacion prod" autofocus autocomplete="off" placeholder="Descripcion del producto"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center p" style="display: none;">
                            <div class="col-4 text-end">
                                <label for="prec_costo" class="col-form-label">Precio costo:</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                  <span class="input-group-text" id="inputGroupPrepend">$</span>
                                  <input type="number" name="prec_costo" id="prec_costo" min="1" step="0.01" class="form-control validacion prod" placeholder="0.00" >
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center p" style="display: none;">
                            <div class="col-4 text-end">
                                <label for="prec_venta" class="col-form-label ">Precio venta:</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                  <span class="input-group-text" id="inputGroupPrepend">$</span>
                                  <input type="number" name="prec_venta" id="prec_venta" min="1" step="0.01" class="form-control validacion prod" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center p" style="display: none;">
                            <div class="col-4 text-end">
                                <label for="prec_mayoreo" class="col-form-label ">Precio mayoreo:</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                  <span class="input-group-text" id="inputGroupPrepend">$</span>
                                  <input type="number" name="prec_mayoreo" id="prec_mayoreo" min="1" step="0.01" class="form-control validacion prod" placeholder="0.00">
                                </div>
                                  
                            </div>
                        </div>
                        <div class="row align-items-center p" style="display: none;">
                            <div class="col-4 text-end">
                                <label for="existencia" class="col-form-label ">Existencia:</label>
                            </div>
                            <div class="col-8">
                                  <input type="number" name="existencia" id="existencia" min="1" step="1" class="form-control validacion prod" placeholder="5">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center p" style="display: none;">
                            <div class="col-4 text-end">
                                <label for="inventario_min" class="col-form-label ">Inventario min:</label>
                            </div>
                            <div class="col-8">
                                  <input type="number" name="inventario_min" id="inventario_min" min="1" step="1" class="form-control validacion prod" placeholder="1">
                            </div>
                        </div>
                        <div class="row align-items-center p" style="display: none;">
                            <div class="col-10 text-end">
                                <label for="colores_producto" class="col-form-label ">Tiene varios colores</label>
                            </div>
                            <div class="col-1">
                                  <input type="checkbox" class="form-check-input" name="colores_producto" id="colores_producto" value="1">
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="CancelarsGP">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarProducto">
                  <span class="spinner-border spinner-border-sm sGP" role="status" aria-hidden="true" style="display: none;"></span>
                  Guardar
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal-->

        <!-- Modal agregar color producto -->
        <div class="modal fade" id="agregarColorProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar color del producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card border-0">
                  <div class="card-body">
                      <div class="container">
                        <div class="row align-items-center">
                            <input type="hidden" id="colores_producto_id" name="colores_producto_id">
                            <div class="col-6 text-end">
                                <h4 for="color_p" class="col-form-label">Color:</h4>
                            </div>
                            <div class="col-3">
                                  <input class='form-control form-control-lg color_prod' type="color" name="color_p" id="color_p" value="#ffffff">
                            </div>
                            
                            <br><br>

                            <div class="col-11" id="row_tabla_colores">

                            </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="CancelarsGCP">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarColorProducto">
                  <span class="spinner-border spinner-border-sm sGCP" role="status" aria-hidden="true" style="display: none;"></span>
                  Guardar
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal-->

        <!-- Modal editar producto -->
        <div class="modal fade" id="editarProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card border-0">
                  <div class="card-body">
                      <div class="container">
                        <input type="hidden" name="id_prod" id="id_prod">
                        <div class="row align-items-center">
                            <div class="col-4 text-end">
                                <label for="descripcion" class="col-form-label ">Descripcion:</label>
                            </div>
                            <div class="col-8">
                                <textarea name="descripcion2" id="descripcion2" cols="30" rows="2" class="form-control validacion prod" autofocus autocomplete="off" placeholder="Descripcion del producto"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-4 text-end">
                                <label for="prec_costo" class="col-form-label">Precio costo:</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                  <span class="input-group-text" id="inputGroupPrepend">$</span>
                                  <input type="number" name="prec_costo2" id="prec_costo2" min="1" step="0.01" class="form-control validacion prod" placeholder="0.00" >
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-4 text-end">
                                <label for="prec_venta" class="col-form-label ">Precio venta:</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                  <span class="input-group-text" id="inputGroupPrepend">$</span>
                                  <input type="number" name="prec_venta2" id="prec_venta2" min="1" step="0.01" class="form-control validacion prod" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-4 text-end">
                                <label for="prec_mayoreo" class="col-form-label ">Precio mayoreo:</label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                  <span class="input-group-text" id="inputGroupPrepend">$</span>
                                  <input type="number" name="prec_mayoreo2" id="prec_mayoreo2" min="1" step="0.01" class="form-control validacion prod" placeholder="0.00">
                                </div>
                                  
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-4 text-end">
                                <label for="existencia" class="col-form-label ">Existencia:</label>
                            </div>
                            <div class="col-8">
                                  <input type="number" name="existencia2" id="existencia2" min="1" step="1" class="form-control validacion prod" placeholder="5">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-4 text-end">
                                <label for="inventario_min" class="col-form-label ">Inventario min:</label>
                            </div>
                            <div class="col-8">
                                  <input type="number" name="inventario_min2" id="inventario_min2" min="1" step="1" class="form-control validacion prod" placeholder="1">
                            </div>
                        </div>
                        <br>
                        <div class="row align-items-center">
                            <div class="col-4 text-end">
                                <label for="departamento" class="col-form-label ">Departamento:</label>
                            </div>
                            <div class="col-8">
                                  @php($departamentos = App\Departamento::all())
                                  <select name="departamento2" id="departamento2" class="form-control validacion prod" required>
                                    <option hidden selected value="">Seleccione un departamento</option>
                                    @foreach($departamentos as $departamento)
                                    <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="CancelarsGP2">Cancelar</button>
                <button type="button" class="btn btn-primary" id="guardarProducto2">
                  <span class="spinner-border spinner-border-sm sGP2" role="status" aria-hidden="true" style="display: none;"></span>
                  Guardar
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal-->

        <!-- Modal ver imagen producto-->
        <div class="modal fade" id="verImagenProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Imagen del producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card border-0">
                  <div class="card-body">

                    <input type="hidden" name="id_producto" id="id_producto">

                    <div class="container-fluid">
                      <div class="col-4 offset-8">
                        <button type="button" class="btn btn-outline-info btn-sm" id="cambiar_img">Cambiar foto</button>
                      </div>
                    </div>
                    <br>

                    <div class="container text-center">
                      <img src="" alt="" id="imagen_producto" width="300" height="300">
                    </div>

                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="Cancelar">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal-->

        <!-- Modal subir imagen producto-->
        <div class="modal fade" id="cargarImagenProducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Imagen del producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card border-0">
                  <div class="card-body">
                    <div class="container">

                      <form action="post" id="form_img" enctype="multipart/form-data">
                      
                        <input type="hidden" name="id_producto_f" id="id_producto_f">
                        <div class="row">
                          <div class="col-sm-3 text-end">
                            <label for="imagen_p" class="col-form-label">Imagen:</label>
                          </div>
                          <div class="col-9">
                            <input type="file" name="imagen_p" id="imagen_p" accept="image/png, .jpeg, .jpg, .jfif, image/gif" class="form-control">
                          </div>
                        </div>
                      </form>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="CancelarsGI">Cancelar</button>
                <button type="submit" form="form_img" class="btn btn-primary" id="guardarImagen" name="guardarImagen">
                  <span class="spinner-border spinner-border-sm sGI" role="status" aria-hidden="true" style="display: none;"></span>
                  Guardar
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal-->

        <!-- Modal subir imagen entrega-->
        <div class="modal fade" id="cargarImagenEntrega" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card border-0">
                  <div class="card-body">
                    <div class="container">
                      <h6 class="text-center">Sube una imagen del cliente recibiendo el pedido</h6>
                      <br>
                      <form action="post" id="form_img_entrega" enctype="multipart/form-data">
                      
                        <input type="hidden" name="id_pedido_f" id="id_pedido_f">
                        <div class="row">
                          <div class="col-sm-3 text-end">
                            <label for="imagen_pe" class="col-form-label">Imagen:</label>
                          </div>
                          <div class="col-9">
                            <input type="file" name="imagen_pe" id="imagen_pe" accept="image/png, .jpeg, .jpg, image/gif" class="form-control">
                          </div>
                        </div>
                      </form>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="CancelarsGIP">Cancelar</button>
                <button type="submit" form="form_img_entrega" class="btn btn-primary" id="guardarImagenP" name="guardarImagenP">
                  <span class="spinner-border spinner-border-sm sGIP" role="status" aria-hidden="true" style="display: none;"></span>
                  Guardar
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal-->

        <!-- Modal ver imagen pedido-->
        <div class="modal fade" id="verImagenPedido" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Imagen del pedido entregado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card border-0">
                  <div class="card-body">

                    <div class="container text-center">
                      <img src="" alt="" id="imagen_pedido" width="300" height="300">
                    </div>

                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="Cancelar">Cancelar</button>
              </div>
            </div>
          </div>
        </div>
        <!--fin modal-->

        

        <div id="contenido">
          @if(Auth::user()->empleado->estado != "Baja")
          <p class="fs-3 text-center">Bienvenido {{Auth::user()->empleado->nombre}}</p>
          @else
          <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading text-center">Fuiste dado de baja!</h4>
            <p>Parece que algun administrador te dio de baja, si no sabes porque paso esto habla con alguno de ellos para que active de nuevo tu cuenta.</p>
            <hr>
            <p class="mb-0">Mientras tu cuenta esta inactiva no podras utilizar el sistema.</p>
            <a class="nav-link" href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><button type="button" class="btn btn-outline-danger" >Cerrar sesion</button>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </div>
          @endif
        </div>

      

      
    </main>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/empleado.js') }}"></script>
<script src="{{ asset('js/inventario.js') }}"></script>
<script src="{{ asset('js/pedidos.js') }}"></script>
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
    });

    $('#inicio').click(function(){
      $('#titulo').empty();
      $('#btn-titulo').empty();
      $('#contenido').empty();

      $('#titulo').append('Dashboard');
      $('#btn-titulo').append('<div class="btn-group me-2"><button type="button" class="btn btn-sm btn-outline-secondary">Share</button><button type="button" class="btn btn-sm btn-outline-secondary">Export</button></div><button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>This week</button>');
      $('#contenido').append('<p class="fs-3 text-center">Bienvenido {{Auth::user()->empleado->nombre}}</p>');
    });
</script>
@endsection
