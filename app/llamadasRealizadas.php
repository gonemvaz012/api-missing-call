<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class llamadasRealizadas extends Model
{   
    protected $primaryKey = 'id_llamada_realizada';

    protected $fillable =[
        'id_llamada_realizada',
        'fecha',
        'hora',
        'id_usuario',
        'comentarios',
        'devolucion_efectiva',
        'id_llamada_estado',
        'api_callid',
        'api_result',
        ];

        public function user(){
            return $this->hasOne(User::class, 'id_usuario', 'id');
        }

}
