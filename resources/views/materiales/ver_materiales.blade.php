@extends("layouts.master")

@section('title', 'Ver Materiales')

@section("contenido")
    <div class="row mt-2">
        <div class="col-12 col-md-6 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-header filtro">
                    <i class="fas fa-filter fa-1x"></i>
                    <span>Filtrar por proveedor</span>
                </div>
                <div class="card-body">
                    <select class="form-select" id="filtro-pvd">
                        <option value="todos">Todos</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-2 d-flex justify-content-center input-group">
        <div class="form-outline">
          <input type="search" id="busqueda-txt" class="form-control" placeholder="Buscar por nombre" />
        </div>
        <button type="button" class="btn boton" id="busqueda-btn">
          <i class="fas fa-search"></i>
        </button>
      </div>
    <div class="row mt-2">
        <div class="col-12 col-md-12 col-lg-10 mx-auto">
            <table class="table table-hover tabla-bordered table-striped table-responsive">
                <thead class="text-light csecondary">
                    <tr>
                        <td>ID</td>
                        <td>Fecha</td>
                        <td>Nombre</td>
                        <td>Descripción</td>
                        <td>Proveedor</td>
                        <td>Unidad de medida</td>
                        <td>Stock</td>
                        <td>Precio por unidad</td>
                        <td>Total $</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody id="tbody-material"></tbody>
            </table>
            <div class="d-flex justify-content-end pt-5" aria-labelledby="navbarDropdown">
                <button><a class="dropdown-item" href="{{route('materiales.descargar-tabla-materiales')}}">Exportar PDF</a></button>
            </div>
        </div>
    </div>
    <div class="d-none">
        <div class="row mt-5 molde-actualizar">
            <div class="mb-3">
                <label for="nombre-txt" class="form-label">Nombre</label>
                <input disabled type="text" id="nombre-txt" class="form-control nombre-txt">
            </div>
            <div class="mb-3">
                <label class="form-label" for="descripcion-txt">Descripción</label>
                <textarea class="form-control descripcion-txt"></textarea>
            </div>
            <div class="mb-3">
                <label for="proveedor-select" class="form-label">Proveedor</label>
                <select disabled class="form-select proveedor-select"></select>
            </div>
            <div class="mb-3">
                <label for="unidad-medida-txt" class="form-label">Unidad de medida</label>
                <input disabled type="text" min="0" class="form-control unidad-medida-txt">
            </div>
            <div class="mb-3">
                <label for="stock-minimo-txt" class="form-label">Stock Mínimo</label>
                <input type="number" min="0" class="form-control stock-minimo-txt">
            </div>
            <div class="mb-3">
                <label for="stock-maximo-txt" class="form-label">Stock Máximo</label>
                <input type="number" min="0" class="form-control stock-maximo-txt">
              </div>
            <div class="mb-3">
                <label for="precio-txt" class="form-label">Precio por unidad</label>
                <input type="number" min="0" class="form-control precio-txt">
            </div>
            <div class="d-grid gap-1">
                <button class="btn csecondary actualizar-btn">Actualizar</button>
            </div>
        </div>

    </div>
@endsection

@section("javascript")
  <script src="{{asset('js/servicios/materialesService.js')}}"></script>
  <script src="{{asset('js/ver_materiales.js')}}"></script>
@endsection