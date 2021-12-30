@extends("layouts.master")

@section('title', 'Registrar Venta')


@section("contenido")

<div class="row mt-5">
    <div class="col-12 col-md-6 col-lg-5 mx-auto">
      <div class="card">
        <div class="card-header csecondary">
            <i class="fas fa-money-check-alt fa-1x"></i>
          <span>Agregar Venta</span>
        </div>

        <div class="card-body">
          <div class="mb-3">
            <label for="productos-select" class="form-label">Productos a vender</label>
            <select id="productos-select" multiple class="form-select"></select>
          </div>
            <div class="mb-3">
                <label for="cliente-select">Cliente</label>
                <select  id="cliente-select" class="form-select"></select>
            </div>
            <div class="mb-3">
                <label for="cantidad-txt" class="form-label">Cantidad por producto</label>
                <input type="number" min="0" id="cantidad-txt" class="form-control" placeholder="Ingrese la cantidad a vender por cada producto seleccionado">
            </div>
            {{-- <div class="mb-3">
              <label for="total-txt" class="form-label">Total</label>
              <input disabled type="number" min="0" class="form-control" id="total-txt">
            </div> --}}
          </div>

        <div class="card-footer d-grid gap-1">
          {{-- <button id="calcular-btn" class="btn btn-success">Calcular</button> --}}
          <button id="registrar-btn" class="btn boton">Registrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section("javascript")
  <script src="{{asset('js/servicios/ventasService.js')}}"></script>
  <script src="{{asset('js/agregar_venta.js')}}"></script>
  <script>
    console.log('Funcionando aqui');
  </script>

@endsection