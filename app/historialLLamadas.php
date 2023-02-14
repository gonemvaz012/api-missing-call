<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class historialLLamadas extends Model
{
    protected $fillable = [
        'id_gestion',
        'id_llamada',
        'id_usuario',
        'devolucion_n_efectiva',
        'fecha',
        'hora'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
    public function comentario(){
        return $this->hasMany(comentariosLLamadas::class, 'id_llamada', 'id_llamada');
    }

}
