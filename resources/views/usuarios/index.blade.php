@extends('layouts.master')

@section('title', 'Usuarios')

@section('hojas-estilo')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
@endsection

@section('contenido')
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Usuarios</button>
        </div>
    </div>

    <div class="row">
        <!--formulario-->
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header cprimary">
                    Agregar Usuario
                </div>
                <div class="card-body">
                    <!--errores-->
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <p>Por favor solucione los siguientes problemas:</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!--/errores-->

                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input required type="text" id="nombre" name="nombre"
                                class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input required type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input required type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                        </div>
                        <div class="form-group">
                            <label for="password2">Repetir Contraseña:</label>
                            <input required type="password" id="password2" name="password2"
                                class="form-control @error('password2') is-invalid @enderror"
                                value="{{ old('password2') }}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Rol:</label>
                            <select id="rol" name="rol" class="form-control">
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group">
                            <div class="row pt-3">
                                <div class="col-12 col-lg-3 offset-lg-6 pr-lg-0">
                                    <button type="reset" class="btn btn-warning btn-block text-white">Cancelar</button>
                                </div>
                                <div class="col-12 col-lg-3 mt-1 mt-lg-0">
                                    <button type="submit" class="btn btn-success btn-block text-white">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/formulario-->

        <!--tabla-->
        <div class="col-12 col-lg-8 mt-1 mt-lg-0">
            <table class="table table-bordered table-striped table-hover">
                <thead class="csecondary">
                    <tr>
                        <th>Nº</th>
                        <th>Email</th>
                        <th>Nombre</th>
                        <th>Último Login</th>
                        <th>Rol</th>
                        <th>Activo</th>
                        <th colspan="3">Acciones</th>
                    </tr>
                </thead>
                @foreach ($usuarios as $num => $usuario)
                    <tr>
                        <td>{{ $num + 1 }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($usuario->ultimo_login)) }}</td>
                        <td>{{ $usuario->rol->nombre ?? 'Sin Rol Asignado' }}</td>
                        </td>
                        <td>{{ $usuario->activo ? 'Si' : 'No' }}</td>
                        <td class="text-center" style="width:1rem">
                            <!--Borrar-->
                            @if (Auth::user()->id != $usuario->id)
                                <span data-toggle="tooltip" data-placement="top" title="Borrar Usuario">
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#usuarioBorrarModal{{ $usuario->id }}">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </span>
                            @endif
                        </td>
                        <td class="text-center" style="width:1rem">
                            @if (Auth::user()->id != $usuario->id)
                                <span data-toggle="tooltip" data-placement="top" title="Actualizar Usuario">
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#usuarioActualizarModal{{ $usuario->id }}">
                                        <i class="far fa-edit"></i>
                                    </button>
                                </span>
                            @else
                                <p>Admin</p>
                            @endif
                        </td>
                        <td class="text-center" style="width:1rem">
                            @if (Auth::user()->id != $usuario->id)
                                <form method="POST" action="{{ route('usuarios.activar', $usuario->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm cprimary" data-toggle="tooltip"
                                        data-placement="top" title="{{ $usuario->activo ? 'Desactivar' : 'Activar' }} Usuario">
                                        <i class="fas fa-user-{{ $usuario->activo ? 'slash' : 'check' }}"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal Borrar Usuario -->
                    <div class="modal fade" id="usuarioBorrarModal{{ $usuario->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Borrar Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle text-danger mr-2" style="font-size: 2rem"></i>
                                        ¿Desea borrar al usuario {{ $usuario->nombre }}?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('usuarios.destroy', $usuario->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Borrar Usuario</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Actualizar Usuario #563d7c  -->
                    <!--ventana para Update--->
                    <div class="modal fade" id="usuarioActualizarModal{{ $usuario->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #563d7c !important;">
                                    <h6 class="modal-title" style="color: #fff; text-align: center;">
                                        Actualizar Usuario
                                    </h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>


                                <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                                    @method('PUT')
                                    @csrf

                                    <div class="modal-body" id="cont_modal">

                                        <div class="form-group">
                                            <label for="nombre">Nombre:</label>
                                            <input required type="text" id="nombre" name="nombre"
                                                class="form-control @error('nombre') is-invalid @enderror"
                                                value="{{ $usuario->nombre }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="nombre">Rol:</label>
                                            <select id="rol" name="rol" class="form-control">
                                                @foreach ($roles as $rol)
                                                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn csecondary">Actualizar</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!---fin ventana Update --->


                @endforeach
            </table>
        </div>
        <!--/tabla-->
    </div>

@endsection

@section('scripts')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
