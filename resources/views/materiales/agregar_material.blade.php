@extends("layouts.master")

@section('title', 'Agregar Materiales')

@section("contenido")

<div class="row mt-5">
    <div class="col-12 col-md-6 col-lg-5 mx-auto">
      <div class="card">
        <div class="card-header csecondary">
            <i class="fas fa-pencil-alt fa-1x"></i>
          <span>Agregar Material</span>
        </div>

        <div class="card-body">
          <div class="mb-3">
            <label for="nombre-txt" class="form-label">Nombre</label>
            <input name="name" type="text" id="nombre-txt" class="form-control" placeholder="Ingrese un nombre para el material">
          </div>
          <div class="mb-3">
            <label class="form-label" for="descripcion-txt">Descripción</label>
            <textarea name="descripcion" class="form-control" id="descripcion-txt" placeholder="Ingrese una breve descripción"></textarea>
            </div>
          <div class="mb-3">
            <label for="proveedor-select">Proveedor</label>
            <select name="rut_proveedor" id="proveedor-select" class="form-select"></select>
          </div>
          <div class="mb-3">
            <label for="unidad-medida-txt" class="form-label">Unidad de medida</label>
            <input type="text" name="unidad_medida" min="0" id="unidad-medida-txt" class="form-control" placeholder="La unidad de medida del material">
          </div>
          <div class="mb-3">
            <label for="stock-minimo-txt" class="form-label">Stock Mínimo</label>
            <input name="stock_minimo" type="number" min="0" id="stock-minimo-txt" class="form-control" placeholder="Ingrese cantidad mínima a comprar">
          </div>
          <div class="mb-3">
            <label for="stock-maximo-txt" class="form-label">Stock Máximo</label>
            <input name="stock_maximo" type="number" min="0" id="stock-maximo-txt" class="form-control" placeholder="Ingrese cantidad máxima a comprar">
          </div>
          <div class="mb-3">
            <label for="precio-txt" class="form-label">Precio por unidad</label>
            <input name="precio" type="number" min="0" id="precio-txt" class="form-control" placeholder="Ingrese precio unitario del material">
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
    <script src="{{asset('js/servicios/materialesService.js')}}"></script>
    <script src="{{asset('js/agregar_material.js')}}"></script>
@endsection