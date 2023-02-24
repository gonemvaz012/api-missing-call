<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class llamadasContestadas extends Model
{
    protected $fillable = ['id_llamada_contestada', 'duracion', 'agente_atiende', 'id_llamada'];
}
