<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\configuracion;

class ConfiguracionController extends Controller
{
    public function getConfiguracion(){
        $config = configuracion::find(1);
        return $config;
    }

    public function guadarConfiguracion(Request $res){
        $config = configuracion::find(1)->update($res->all());
        $config = configuracion::find(1);
        return $config;
    }
}
