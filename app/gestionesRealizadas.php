<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gestionesRealizadas extends Model
{
    protected $fillable =[
        'id_gestion',
        'fecha',
        'hora',
        'id_usuario',
        'comentarios',
        'devolucion_efectiva',
        'id_llamada_estado',
    ];
    public function user(){
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
    
}
