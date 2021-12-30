@extends("layouts.master")

@section('title', 'Revisar Ventas')

@section("contenido")
    <div class="row mt-2">
        <div class="col-12 col-md-6 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-header filtro">
                    <i class="fas fa-filter fa-1x"></i>
                    <span>Filtrar por cliente</span>
                </div>
                <div class="card-body">
                    <select class="form-select" id="filtro-cliente">
                        <option value="todos">Todos</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none">
        <input type="text" id="rol-txt" value="{{Auth::user()->rol->nombre}}">
    </div>
    <div class="pt-2 d-flex justify-content-center input-group">
        <div class="form-outline">
          <input type="search" id="busqueda-txt" class="form-control" placeholder="Buscar por fecha" />
        </div>
        <button type="button" class="btn boton" id="busqueda-btn">
          <i class="fas fa-search"></i>
        </button>
      </div>
    <div class="row mt-2">
        <div class="col-12 col-md-12 col-lg-10 mx-auto">
            <table class="table table-hover tabla-bordered table-striped table-responsive">
                <thead class="csecondary">
                    <tr>
                        <td>ID</td>
                        <td>Producto</td>
                        <td>Cliente</td>
                        <td>Cantidad</td>
                        <td>Total</td>
                        <td>Fecha</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody id="tbody-venta"></tbody>
            </table>
            <div class="d-flex justify-content-end pt-5" aria-labelledby="navbarDropdown">
                <button><a class="dropdown-item" href="{{route('ventas.descargar-tabla-ventas')}}">Exportar PDF</a></button>
            </div>
        </div>
    </div>
@endsection

@section("javascript")
  <script src="{{asset('js/servicios/ventasService.js')}}"></script>
  <script src="{{asset('js/ver_ventas.js')}}"></script>
@endsection