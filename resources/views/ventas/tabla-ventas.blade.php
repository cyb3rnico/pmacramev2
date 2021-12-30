<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resumen de Ventas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div class="container-fluid">
        
        <img class="logo" src="{{asset('img/logo.jpg')}}">
        <br>
        <span>Resumen de Ventas</span>
        <br>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Producto</td>
                    <td>Cliente</td>
                    <td>Cantidad</td>
                    <td>Total</td>
                    <td>Fecha</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($tablaVentas as $venta)
                    <tr>
                        <td>{{$venta['id']}}</td>
                        <td>
                            @foreach ($venta->productos as $key =>$producto)
                                @if ($key==0)
                                    {{$producto->nombre}}
                                @else
                                    {{$producto->nombre}},
                                @endif
                            @endforeach
                        </td>
                        <td>{{$venta->cliente->nombre}} {{$venta->cliente->apellidos}}</td>
                        <td>{{$venta['cantidad']}}</td>
                        <td>$ {{number_format($venta['total'],0,',','.')}}</td>
                        <td>{{$venta['fecha']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <span class="d-flex justify-content-end"><b>Vendido a la fecha: $ {{number_format($sum_total,0,',','.')}}</b></span>
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