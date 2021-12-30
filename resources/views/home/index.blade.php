@extends("layouts.master")

@section('title', 'Home')

@section("contenido")
    <div class="row mt-5">
        <div class="col-12 col-md-6 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-header csecondary">
                    <i class="fas fa-address-book fa-2x"></i>
                    <span>Bienvenido <b></i> {{Auth::user()->nombre}} ({{Auth::user()->rol->nombre}})</span>
                </div>
                @php
                    $rol = Auth::user()->rol->nombre;
                @endphp
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <small>Último inicio de sesión: {{date('d-m-Y',strtotime(Auth::user()->ultimo_login))}} a las {{date('H:i:s',strtotime(Auth::user()->ultimo_login))}}</b></small>
                            <p>Este es tu sitio web, diseñado a medida según tus requerimientos.</p>
                            @if ($rol == "Administrador")
                                <img class="img-fluid" src="{{asset('img/portada.jpg')}}" alt="" srcset="">
                            @else
                                <img class="img-fluid" src="{{asset('img/guest.png')}}" alt="" srcset="" height="100" width="100">
                            @endif
                            
                            <p>Para comenzar a utilizar la aplicación, debes añadir:
                                <ul>
                                    <li>1) Categorías</li>
                                    <li>2) Proveedores</li>
                                    <li>3) Materiales</li>
                                    <li>4) Productos</li>
                                    <li>Finalmente añadir Clientes y podrás registrar Ventas.</li>
                                </ul>
                            </p>
                            <span>Tip: En la sección Configuración podrás gestionar los roles y usuarios del sistema.</span>
                            <br>
                            <span>Tip 2: Podrás genera reportes PDF de tus proveedores, materiales, productos, clientes y ventas.</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer csecondary">
                    <nav class="redes-sociales pt-3">
                        <ul>
                            <li>
                                <a target="_blank"href="https://www.facebook.com/pristina.macrame/">
                                    <img src="{{asset('img/facebook.png')}}" alt="facebook-logo">
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.instagram.com/pristina.macrame/">
                                    <img src="{{asset('img/instagram.png')}}" alt="instagram-logo">
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("javascript")

@endsection
