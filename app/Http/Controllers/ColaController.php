<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cola;

class ColaController extends Controller
{

    public function Listado(){
        $colas = Cola::orderBy('cola', 'DESC')->get();
        return $colas;
    }
    
}
