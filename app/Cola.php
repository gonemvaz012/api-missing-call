<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cola extends Model
{
    protected $fillable = ['id_cola','cola', 'clid'];

    public function llamadas(){
        return $this->hasMany(Llamadas::class, 'id_cola', 'cola');
    }
}
