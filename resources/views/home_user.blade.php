@extends("layouts.master")

@section('title', 'Home')

@section("contenido")
    <div class="row mt-5">
        <div class="col-12 col-md-6 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-address-book fa-2x"></i>
                    <span>Bienvenido usuario Prístina!</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <p>Este es tu sitio web, diseñado a medida</p>
                            <img class="img-fluid" src="{{asset('img/portada.jpg')}}" alt="" srcset="">
                            <p>Para comenzar a utilizar la aplicación, el admin con anterioridad debió agregar categorias:
                                <ul>
                                    <li>1) Productos</li>
                                    <li>2) Contactos</li>
                                    <li>Finalmente añadir Materiales y Ventas</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
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
