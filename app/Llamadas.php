<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Llamadas extends Model
{
    protected $fillable = ['id_llamada','cola', 'numero_llamante', 'fecha', 'hora', 'state', 'devolucion_n_efectiva'];

    public function comentario(){
        return $this->hasMany(comentariosLLamadas::class, 'id_llamada', 'id_llamada');
    }

    public function cola(){
        return $this->hasOne(Cola::class, 'id', 'cola');
    }
}
