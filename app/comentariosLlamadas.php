<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comentariosLlamadas extends Model
{
    protected $fillable = ['id_llamada', 'comentario', 'id_usuario', 'type'];

    public function user(){
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
}
