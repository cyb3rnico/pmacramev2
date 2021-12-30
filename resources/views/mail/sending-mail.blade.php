<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviando email...</title>
</head>
<body>
    <p>
        Hola {{$nombre}} {{$apellidos}}, su compra se ha realizado con éxito.
        <table class="center">
            <tr class="header_th">
                <th>PRODUCTO</th>
                <th>CANTIDAD</th>
                <th>PRECIO UNITARIO</th>
                <th>TOTAL</th>
            </tr>
            @foreach($productos as $producto)
                <tr>
                    <td>{{$producto->nombre}}</td>
                    <td>{{$venta->cantidad}}</td>
                    <td>$ {{number_format($producto->precio,0,',','.')}}</td>
                    <td>$ {{number_format($venta->cantidad * $producto->precio,0,',','.')}}</td>
                </tr>
            @endforeach
        </table>
        <br>
        <div>
            <span>Total pagado: <b>$ {{number_format($total,0,',','.')}}</span>
        </div>
    Usted fue atentido por: {{$usuario}} - ({{$rol}})
    <br>    
    Gracias por comprar en Prístina Macramé.
    <br>
    Saludos.
    </p>
</body>
</html>