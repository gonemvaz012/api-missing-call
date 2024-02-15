<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class configuracion extends Model
{
    protected $fillable =['state','intervalo_min',
    'llamadas_intervalo',
    'email'];
}
