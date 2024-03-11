<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userDepartamentos extends Model
{
    protected $fillable = ['user_id', 'cola_id'];


    public function departamentos(){
        return $this->hasOne(Cola::class, 'id', 'cola_id');
    }
}

