@extends("layouts.master")

@section('title', 'Ver Categorías')

@section("contenido")
<div class="row mt-2">
    <div class="col-12 col-md-6 col-lg-5 mx-auto">
        <div class="card">
            <div class="card-header filtro">
                <i class="fas fa-search fa-1x"></i>
                <span>Buscar</span>
            </div>
            <div class="card-body">
                <div class="input-group input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Buscar por nombre</span>
                    <input type="text" id="busqueda-txt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <button type="button" class="btn boton" id="busqueda-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row mt-5">
        <div class="col-12 col-md-12 col-lg-6 mx-auto">
            <table class="table table-hover tabla-bordered table-striped table-responsive">
                <thead class="csecondary">
                    <tr>
                        <td>Nombre Categoría</td>
                        <td>Fecha</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody id="tbody-categoria"></tbody>
            </table>
        </div>
    </div>
    <div class="d-none">
        <div class="row mt-5 molde-actualizar">
            <div class="mb-3">
                <label for="nombre-txt" class="form-label">Nombre Categoría</label>
                <input type="text" id="nombre-txt" class="form-control nombre-txt">
            </div>
            <div class="d-grid gap-1">
                <button class="btn btn-primary actualizar-btn">Actualizar</button>
            </div>
        </div>

    </div>
@endsection

@section("javascript")
  <script src="{{asset('js/servicios/categoriasService.js')}}"></script>
  <script src="{{asset('js/ver_categorias.js')}}"></script>
@endsection