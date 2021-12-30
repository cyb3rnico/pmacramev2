@extends("layouts.master")

@section('title', 'Agregar Producto')

@section("contenido")

<div class="row mt-5">
    <div class="col-12 col-md-6 col-lg-5 mx-auto">
      <div class="card">
        <div class="card-header csecondary">
          <i class="fas fa-box fa-1x"></i>
          <span>Agregar Producto</span>
        </div>

        <div class="card-body">
            <div class="mb-3">
              <label for="nombre-txt" class="form-label">Nombre</label>
              <input type="text" id="nombre-txt" class="form-control" placeholder="Ingrese el nombre del producto">
            </div>
            <div class="mb-3">
              <label for="categoria-select" class="form-label">Categoría</label>
              <select id="categoria-select" class="form-select"></select>
            </div>
            <div class="mb-3">
              <label for="materiales-select" class="form-label">Materiales</label>
              <select id="materiales-select" multiple class="form-select"></select>
            </div>
            <div class="mb-3">
              <label for="cantidad-material-txt" class="form-label">Cantidad de cada material</label>
              <input type="number" min="0" class="form-control" id="cantidad-material-txt" placeholder="Ingrese la cantidad de materiales que componen el producto">
          </div>
            <div class="mb-3">
                <label class="form-label" for="descripcion-txt">Descripción/Imagen</label>
                <textarea class="form-control" id="descripcion-txt" placeholder="Ingrese una breve descripción o una imágen mediana"></textarea>
            </div>
            <div class="mb-3">
                <label for="cantidad-txt" class="form-label">Cantidad</label>
                <input type="number" min="0" class="form-control" id="cantidad-txt" placeholder="Ingrese la cantidad del producto (stock)">
            </div>
            <div class="mb-3">
                <label for="precio-txt" class="form-label">Precio por unidad</label>
                <input type="number" min="0" class="form-control" id="precio-txt" placeholder="Ingrese el precio unitario del producto">
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
  <script src="{{asset('js/agregar_prod.js')}}"></script>
  <script src="{{asset('js/servicios/productosService.js')}}"></script>

@endsection