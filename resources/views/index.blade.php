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
                <!--<li><a class="dropdown-item" href="#">Something else here</a></li>-->
              </ul>
          </ul>
        </div>
      </div>
    </nav>

    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="4000">
        <img src="../../img/1.jpg" class="d-block w-100" alt="..." width="150" height="550">
        <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
        </div>
        </div>
        <div class="carousel-item" data-bs-interval="4000">
        <img src="../../img/2.jpg" class="d-block w-100" alt="..."  width="150" height="550">
        <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        </div>
        <div class="carousel-item" data-bs-interval="4000">
        <img src="../../img/3.jpg" class="d-block w-100" alt="..."  width="150" height="550">
        <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
        </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleDark" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleDark" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
    </div>

    <br><br>

    <div class="container">
    <div class="row text-center">
        <div class="col"></div>
        <div class="col-6 content-center">
        <p class="fs-2">Ofrecemos</p>
        </div>
        <div class="col"></div>
    </div>

    <br><br>

    <div class="row align-items-start text-center">
        <div class="col">
        <p class="fs-4">Pago de servicios.</p>
        <div class="row">
            <div class="col-md-6">
            <img src="../../img/cfe.png" alt="CFE" width="100" height="100">
            </div>
            <div class="col-md-6">
            <img src="../../img/izzi.png" alt="IZZI" width="100" height="100">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <img src="../../img/totalplay.jpg" alt="Total Play" width="120" height="120">
            </div>
            <div class="col-md-6">
            <img src="../../img/telefono.png" alt="Recargas" width="180" height="100">
            </div>
        </div>
        </div>
        <div class="col">
        <p class="fs-4">Papeleria.</p>
        <img src="../../img/pape.jpg" alt="Papeleria" width="320" height="200">
        </div>
        <div class="col">
        <p class="fs-4">Adornos de temporada.</p>
        <img src="../../img/temp.jfif" alt="Adornos" width="320" height="200">
        </div>
    </div>

    <br><br>

    <div class="text-center">
        <p class="fs-2">Ubicacion.</p>
        <p class="fs-4">Gabriel Suaréz 260. Mercado condesa local 342.</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d939.3477559850853!2d-99.0736752!3d19.6533163!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDM5JzExLjkiTiA5OcKwMDQnMjMuMyJX!5e0!3m2!1sen!2smx!4v1608869543891!5m2!1sen!2smx" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>

    </div>

    <br><br>

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