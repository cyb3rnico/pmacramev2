<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resumen de Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="container-fluid">
        
        <img class="logo" src="{{asset('img/logo.jpg')}}">
        <br>
        <span>Resumen de Productos</span>
        <br>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Categoría</td>
                    <td>Imagen</td>
                    <td>Cantidad</td>
                    <td>Precio por unidad</td>
                    <td>Valor total</td>
                    <td>Fecha</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($tablaProductos as $producto)
                    <tr>
                        <td>{{$producto['id']}}</td>
                        <td>{{$producto['nombre']}}</td>
                        <td>{{$producto->categoria->nombreCat}}</td>
                        <td>{!! $producto['descripcion'] !!}</td>
                        <td>{{$producto['cantidad']}}</td>
                        <td>$ {{number_format($producto['precio'],0,',','.')}}</td>
                        <td>$ {{number_format($producto['cantidad'] * $producto['precio'],0,',','.')}}</td>
                        <td>{{$producto['fecha']}}</td>
                        {{$total = $total + ($producto['precio'] * $producto['cantidad'])}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <span class="d-flex justify-content-end"><b>Total en productos $ {{number_format($total,0,',','.')}}</b></span>
        <br>
        <br>
        <br>
        <span>© Prístina Macramé - 2021</span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>
</html>