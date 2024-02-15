<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class avisoUrgente extends Mailable
{
    use Queueable, SerializesModels;

    public $ultimaLlamada;
    public $configuracion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ultimaLlamada, $configuracion)
    {
        $this->ultimaLlamada = $ultimaLlamada;
        $this->configuracion = $configuracion;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mails.avisoUrgente')->subject('Missing call - Llamada urgente por atender');;
    }
}
