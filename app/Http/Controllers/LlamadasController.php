<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Llamadas;
use App\comentariosLlamadas;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\llamadasRealizadas;
use App\gestionesRealizadas;

class LlamadasController extends Controller
{   
    
    public function LlamadasCount(){
       
       $todas =  Llamadas::count();
       $pendientes =  Llamadas::where('estado_tramitacion', 'No atendida')->count();
       $tramitandose =  Llamadas::where('estado_tramitacion', 'Tramitandose')->count();
       $completadas =  Llamadas::where('estado_tramitacion', 'Completada')->count();
       return response()->json(['pendientes' => $pendientes, 'tramitandose' => $tramitandose, 'completadas' => $completadas, 'todas' => $todas ]);
    }

    public function Pendientes(){
        return Llamadas::where('estado', 1)->get();
    }

    
    public function Listado(Request $request){
        $columns = ['id_llamada_estado'];
        $length = $request->length;
        $column = $request->column; //Index
        $dir = $request->dir;
        $searchValue = $request->search;
    
        $query = Llamadas::with('comentario.user')->with('cola')->orderBy($columns[$column], $dir);
    
        if ($request->filterCola && $request->filterCola != 0 ) {
            $query->where('cola', $request->filterCola);
        }
        if ($request->menu && $request->menu != 0 ) {
            $query->where('estado', $request->menu);
        }

        if ($request->filterDate) {
            $desde = Carbon::create($request->filterDate['desde'])->format('Y-m-d');
            $hasta = Carbon::create($request->filterDate['hasta'])->format('Y-m-d');
        if($desde == $hasta){
                $query->whereDate('fecha', '=', $hasta);
            }else {
                $query->whereDate('fecha', '>=', $desde)->whereDate('fecha', '<=', $hasta);
            }
            
        }
    
        if ($request->filterDay) {
            $hoy = Carbon::now()->subDay(1)->format('Y-m-d');
            $query->whereDate('created_at', '=', $hoy);
        }
    
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id_llamada', 'like', '%' . $searchValue . '%')
                ->orWhere('id_llamada_estado', 'like', '%' . $searchValue . '%');
            });
        }
    
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->draw];
    }


    // create comentarios 
    public function createCommets(Request $res){
        $activy = new comentariosLlamadas();
        $activy->id_llamada = $res->id;
        $activy->comentario = $res->comentario;
        if($res->completa){
            $activy->active = true;
        }
        $activy->id_usuario = $res->user_id;
        $activy->type = 1;
        $activy->save();

        if($res->completa){
            $llamada = Llamadas::where('id_llamada_estado', $res->id)->first();
            $llamada->estado = 'Completada';
            $llamada->estado_tramitacion = 'Completada';
            $llamada->save();

            // Guardaremos la gestion en proceso  
           $date = Carbon::now();
           $gestion = new gestionesRealizadas();
           $gestion->fecha = $date->format('Y-m-d');
           $gestion->hora = $date->format('H:mm:ss A');
           $gestion->id_usuario = $res->user_id; 
           $gestion->comentarios = $res->comentario;
           $gestion->devolucion_efectiva = true;
           $gestion->id_llamada_estado = $res->id;
           $gestion->save();
        }

        return response()->json(['state' => true, 'data' => $activy]);
    }

    // Funcion para agregar un comentario despues de realizar la llamada
    public function createLog(Request $res){
        // Buscamos la llamada por su id 
        $llamada = Llamadas::where('id_llamada_estado', $res->id)->first();

        // Agregamos una nueva accion con su respectivo comentario 
        $activy = new comentariosLlamadas();
        $activy->id_llamada = $res->id;
        $activy->id_usuario = $res->user_id;
        if($res->completa){
            $activy->active = true;
        }
        if($res->comentario){
            $activy->comentario = $res->comentario;
        }
        $activy->type = 2;  // tipo 2 representa una accion - no solo un comentario 
        $activy->save();
         
        // Si el agente envia la llamada como completada entonces se busca la llamada por la id para cambiarle el estado 
        if($res->completa){
            $llamada = Llamadas::where('id_llamada_estado', $res->id)->first();
            $llamada->estado = 'Completada';
            $llamada->estado_tramitacion = 'Completada';
            $llamada->save();
            
           // Guardaremos la gestion en proceso  
           $date = Carbon::now();
           $gestion = new gestionesRealizadas();
           $gestion->fecha = $date->format('Y-m-d');
           $gestion->hora = $date->format('H:mm:ss A');
           $gestion->id_usuario = $res->user_id; 
           $gestion->comentarios = $res->comentario;
           $gestion->devolucion_efectiva = true;
           $gestion->id_llamada_estado = $res->id;
           $gestion->save();


        }


        return response()->json(['state' => true, 'data' => $activy]);
    }

    // FUNCIONES NUEVAS 
    // Guardar el registro de una nueva llamada 
    public function llamadaSaliente(Request $res){
        $llamada = Llamadas::where('id_llamada_estado', $res->id)->first();
        $llamada->estado = 'Tramitandose';
        $llamada->estado_tramitacion = 'Tramitandose';
        $llamada->save();

       $call_id = Str::random(20);
       $result = true;

       $date = Carbon::now();
       $realizada = new llamadasRealizadas();
       $realizada->fecha  = $date->format('Y-m-d');
       $realizada->hora  = $date->format('H:mm:ss A');
       $realizada->id_usuario = $res->user_id;
       $realizada->devolucion_efectiva = true;
       $realizada->id_llamada_estado = $res->id;
       $realizada->api_callid = $call_id;
       $realizada->api_result = $result;
       $realizada->save();

       $activy = new comentariosLlamadas();
        $activy->id_llamada = $res->id;
        $activy->id_usuario = $res->user_id;
        $activy->comentario = 'Api result';
        $activy->type = 2;
        $activy->save();

    }
}
