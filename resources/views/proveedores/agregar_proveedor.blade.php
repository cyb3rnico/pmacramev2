@extends("layouts.master")

@section('title', 'Agregar Proveedor')

@section("contenido")

<div class="row mt-5">
    <div class="col-12 col-md-6 col-lg-5 mx-auto">
      <div class="card">
        <div class="card-header csecondary">
            <i class="fas fa-address-card fa-1x"></i>
          <span>Agregar Proveedor</span>
        </div>

        <div class="card-body">
            <div class="mb-3">
              <label for="rut-txt" class="form-label">RUT</label>
              <input type="text" id="rut-txt" class="form-control" placeholder="Ingrese RUT con puntos y guión">
            </div>
            <div class="mb-3">
                <label for="nombre-txt" class="form-label">Nombre</label>
                <input type="text" id="nombre-txt" class="form-control" placeholder="Ingrese el nombre del proveedor">
              </div>
            <div class="mb-3">
                <label for="apellidos-txt" class="form-label">Apellidos</label>
                <input type="text" id="apellidos-txt" class="form-control" placeholder="Ingrese los apellidos del proveedor">
            </div>
            <div class="mb-3">
                <label class="form-label" for="direccion-txt">Dirección</label>
                <textarea class="form-control" id="direccion-txt" placeholder="Ingrese una dirección"></textarea>
            </div>
            <div class="mb-3">
                <label for="email-txt" class="form-label">Email</label>
                <input type="email" id="email-txt" class="form-control" placeholder="Ingrese un email existente">
            </div>
            <div class="mb-3">
                <label for="telefono-txt" class="form-label">Teléfono</label>
                <input type="text" id="telefono-txt" class="form-control" placeholder="Ingrese el teléfono o celular">
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
    <script src="{{asset('js/agregar_prov.js')}}"></script>
    <script src="{{asset('js/servicios/proveedoresService.js')}}"></script>

@endsection