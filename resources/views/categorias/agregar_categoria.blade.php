@extends("layouts.master")

@section('title', 'Agregar Categoría')

@section("contenido")

<div class="row mt-5">
    <div class="col-12 col-md-6 col-lg-5 mx-auto">
      <div class="card">
        <div class="card-header csecondary">
          <i class="fas fa-cubes fa-1x"></i>
          <span>Agregar Categoría</span>
        </div>

        <div class="card-body">
            <div class="mb-3">
              <label for="nombre-txt" class="form-label">Nombre Categoría</label>
              <input type="text" id="nombre-txt" class="form-control" placeholder="Ingrese un nombre para la categoría">
            </div>
          </div>

        <div class="card-footer d-grid gap-1">
          <button id="registrar-btn" class="btn boton">Registrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section("javascript")
  <script src="{{asset('js/agregar_categoria.js')}}"></script>
  <script src="{{asset('js/servicios/categoriasService.js')}}"></script>

@endsection