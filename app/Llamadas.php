<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Llamadas extends Model
{   
    public function getKeyName(){
        return "id_llamada_estado";
    }
    // Datos del modelo de llamadas 
    protected $fillable = ['id_llamada_estado', 'id_llamada','cola', 'numero_llamante', 'fecha', 'hora', 'estado', 'estado_tramitacion', 'grupo_id', 'no_visible'];

 // Relacion entre los comentarios y la llamada principal 
    public function comentario(){
        return $this->hasMany(gestionesRealizadas::class, 'id_llamada_estado', 'id_llamada_estado');
    }

    public function realizadas(){
        return $this->hasMany(llamadasRealizadas::class, 'id_llamada_estado', 'id_llamada_estado');
    }

    public function grupo(){
        return $this->hasMany(Llamadas::class, 'grupo_id', 'id_llamada_estado');
    }

    // Relacion entre los departamentos o cola y la llamada principal 
    public function cola(){
        return $this->hasOne(Cola::class, 'id_cola', 'cola');
    }
}
