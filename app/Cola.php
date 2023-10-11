<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cola extends Model
{
    protected $fillable = ['id_cola','cola', 'clid', 'prefijo'];

    public function llamadas(){
        return $this->hasMany(Llamadas::class, 'cola', 'id_cola');
    }
}
