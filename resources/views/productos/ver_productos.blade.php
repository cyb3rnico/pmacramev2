@extends("layouts.master")

@section('title', 'Ver Productos')

@section("contenido")
    <div class="row mt-2">
        <div class="col-12 col-md-6 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-header filtro">
                    <i class="fas fa-filter fa-1x"></i>
                    <span>Filtrar</span>
                </div>
                <div class="card-body">
                    <select class="form-select" id="filtro-ctg">
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
                <thead class="csecondary">
                    <tr>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Categoría</td>
                        <td>Descripción/Imágen</td>
                        <td>Cantidad</td>
                        <td>Precio por unidad</td>
                        <td>Fecha</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody id="tbody-producto"></tbody>
            </table>
            <div class="d-flex justify-content-end pt-5" aria-labelledby="navbarDropdown">
                <button><a class="dropdown-item" href="{{route('productos.descargar-tabla-productos')}}">Exportar PDF</a></button>
            </div>
        </div>
    </div>
    <div class="d-none">
        <div class="row mt-5 molde-actualizar">
            <div class="mb-3">
                <label for="nombre-txt" class="form-label">Nombre</label>
                <input type="text" id="nombre-txt" class="form-control nombre-txt">
            </div>
            <div class="mb-3">
                <label for="categoria-select" class="form-label">Categoría</label>
                <select class="form-select categoria-select"></select>
            </div>
            {{-- <div class="mb-3">
                <label for="materiales-select" class="form-label">Materiales</label>
                <select id="materiales-select" multiple class="form-select materiales-select"></select>
              </div>
              <div class="mb-3">
                <label for="cantidad-material-txt" class="form-label">Cantidad de cada material</label>
                <input type="number" min="0" class="form-control cantidad-material-txt" id="cantidad-material-txt">
            </div> --}}
            <div class="mb-3">
                <label class="form-label" for="descripcion-txt">Descripción/Imagen</label>
                <textarea class="form-control descripcion-txt"></textarea>
            </div>
            <div class="mb-3">
                <label for="precio-txt" class="form-label">Cantidad</label>
                <input type="number" min="0" class="form-control cantidad-txt">
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
    <div class="d-none">
        <div class="row mt-5 molde-ver-materiales">
            <div>
                <select id="ver-materiales-select" multiple class="form-select ver-materiales-select"></select>
            </div>
        </div>
        
    </div>
    
@endsection

@section("javascript")
  <script src="{{asset('js/servicios/productosService.js')}}"></script>
  <script src="{{asset('js/ver_productos.js')}}"></script>
@endsection