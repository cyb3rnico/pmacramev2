<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//importar Model
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class SendingSalesEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Model $cliente, Model $venta, $usuario, $rol)
    {
        $this->cliente = $cliente;
        $this->venta = $venta;
        $this->usuario = $usuario;
        $this->rol = $rol;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            "nombre" => $this->cliente->nombre,
            "apellidos" => $this->cliente->apellidos,
            "productos" => $this->venta->productos,
            "venta" => $this->venta,
            "total" => $this->venta->total,
            "precio" => $this->cliente->precio,
            "usuario" => $this->usuario,
            "rol" => $this->rol,
            ];
        return $this->view('mail.sending-mail',$data)
            ->subject('Pedido realizado con éxito')
            ->from('pmacramev2@gmail.com');
    }
}
