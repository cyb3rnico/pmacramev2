@extends("layouts.master")

@section('title', 'Ver Proveedores')

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
                        <span class="input-group-text" id="inputGroup-sizing-sm">Buscar por apellidos</span>
                        <input type="text" id="busqueda-txt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        <button type="button" class="btn boton" id="busqueda-btn">
                            <i class="fas fa-search"></i>
                          </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12 col-md-12 col-lg-10 mx-auto">
            <table class="table table-hover tabla-bordered table-striped table-responsive">
                <thead class="csecondary">
                    <tr>
                        <td>RUT</td>
                        <td>Nombre</td>
                        <td>Apellidos</td>
                        <td>Dirección</td>
                        <td>Email</td>
                        <td>Teléfono</td>
                        <td>Acción</td>
                    </tr>
                </thead>
                <tbody id="tbody-proveedor"></tbody>
            </table>
            <div class="d-flex justify-content-end pt-5" aria-labelledby="navbarDropdown">
                <button><a class="dropdown-item" href="{{route('proveedores.descargar-tabla-proveedores')}}">Exportar PDF</a></button>
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
                <label for="apellidos-txt" class="form-label">Apellidos</label>
                <input type="text" id="apellidos-txt" class="form-control apellidos-txt">
            </div>
            <div class="mb-3">
                <label class="form-label" for="direccion-txt">Dirección</label>
                <textarea class="form-control direccion-txt"></textarea>
            </div>
            <div class="mb-3">
                <label for="email-txt" class="form-label">Email</label>
                <input type="email" min="0" class="form-control email-txt">
            </div>
            <div class="mb-3">
                <label for="telefono-txt" class="form-label">Télefono</label>
                <input type="text" min="0" class="form-control telefono-txt">
            </div>
            <div class="d-grid gap-1">
                <button class="btn csecondary actualizar-btn">Actualizar</button>
            </div>
        </div>

    </div>
@endsection

@section("javascript")
  <script src="{{asset('js/servicios/proveedoresService.js')}}"></script>
  <script src="{{asset('js/ver_proveedores.js')}}"></script>
@endsection