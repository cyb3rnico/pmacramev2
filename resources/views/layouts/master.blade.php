<!doctype html>
<html lang="es">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @if(isset($_COOKIE) || isset($_COOKIE['success_session']) || is_null($_COOKIE['success_session']))
      <meta name="success-response" content="{{$_COOKIE['success_session']}}">
    @endif

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{asset('vendor/fontawesome-free-5.15.3-web/css/all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="shortcut icon" type="image/jpg" href="{{asset('img/logo.jpg')}}"/>

    <title>@yield('title') - Prístina Macramé</title>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light cprimary">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{route('home.index')}}">
                <img class="logo" src="{{asset('img/logo.jpg')}}">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav w-100 d-flex align-items-center">
                  <i class="fas fa-home fa-1x"></i>
                    <a class="nav-link active" aria-current="page" href="{{route('home.index')}}">INICIO</a>

                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-cubes fa-1x"></i>
                        CATEGORÍAS
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="nav-link dropdown-item" href="{{route('categorias/agregar_categoria')}}">Agregar Categoría</a></li>
                        <li><a class="nav-link dropdown-item" href="{{route('categorias/ver_categorias')}}">Ver Categorías</a></li>
                      </ul>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-id-card-alt fa-1x"></i>
                        PROVEEDORES
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="nav-link dropdown-item" href="{{route('proveedores/agregar_proveedor')}}">Agregar Proveedor</a></li>
                        <li><a class="nav-link dropdown-item" href="{{route('proveedores/ver_proveedores')}}">Ver Proveedores</a></li>
                      </ul>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-pencil-alt fa-1x"></i>
                        MATERIALES
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="nav-link dropdown-item" href="{{route('materiales/agregar_material')}}">Agregar Material</a></li>
                        <li><a class="nav-link dropdown-item" href="{{route('materiales/ver_materiales')}}">Ver Materiales</a></li>
                      </ul>
                    </li>
                  
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-box fa-1x"></i>
                      PRODUCTOS
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="nav-link dropdown-item" href="{{route('productos/agregar_producto')}}">Agregar Producto</a></li>
                      <li><a class="nav-link dropdown-item" href="{{route('productos/ver_productos')}}">Ver Productos</a></li>
                    </ul>
                  </li>
                  
                  
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-address-card fa-1x"></i>
                      CLIENTES
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="nav-link dropdown-item" href="{{route('clientes/agregar_cliente')}}">Agregar Cliente</a></li>
                      <li><a class="nav-link dropdown-item" href="{{route('clientes/ver_clientes')}}">Ver Clientes</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-money-check-alt fa-1x"></i>
                      VENTAS
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="nav-link dropdown-item" href="{{route('ventas/agregar_venta')}}">Agregar Venta</a></li>
                      <li><a class="nav-link dropdown-item" href="{{route('ventas/ver_ventas')}}">Ver Ventas</a></li>
                    </ul>
                  </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-users fa-1x"></i>
                        CONFIGURACIÓN
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Gate::allows('usuarios-listar'))
                          <li><a class="nav-link dropdown-item" href="{{route('roles.index')}}">Roles</a></li>
                          <li><a class="nav-link dropdown-item" href="{{route('usuarios.index')}}">Usuarios</a></li>
                        @else
                          <li><a class="nav-link dropdown-item disabled" href="#">Roles</a></li>
                          <li><a class="nav-link dropdown-item disabled" href="#">Usuarios</a></li>
                        @endif
                        
                      </ul>
                    </li>
                 </ul>
                 <div class="nav-item dropdown ddlBienvenida d-flex justify-content-end align-items-center ">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <p>Bienvenido <b><i class="fas fa-user fa-1x"></i>&nbsp {{Auth::user()->nombre}} ({{Auth::user()->rol->nombre}})</b></p> 
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="nav-link dropdown-item" href="{{route('usuarios.logout')}}">Cerrar sesión</a></li>
                    </ul>
                 </div>
                </div>
              </div>
            </div>
          </nav>
    </header>
    <main class="container-fluid">
      <body class="image-fondo">
        @yield("contenido")
      </body>
    </main>

    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    <script src="{{asset('vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('js/axios_config.js')}}"></script>
    @yield("javascript")

  </body>
</html>