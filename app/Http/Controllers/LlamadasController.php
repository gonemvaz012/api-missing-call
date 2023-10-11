<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Llamadas;
use App\comentariosLlamadas;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\llamadasRealizadas;
use App\gestionesRealizadas;
use Illuminate\Support\Facades\Http;

class LlamadasController extends Controller
{   
    
    public function LlamadasCount(){
       
        $todas =  Llamadas::where('estado', 'No Atendida')->count();
       $pendientes =  Llamadas::where('estado', 'No Atendida')->where('estado_tramitacion', 'No atendida')->count();
       $tramitandose =  Llamadas::where('estado', 'No Atendida')->where('estado_tramitacion', 'Tramitandose')->count();
       $completadas =  Llamadas::where('estado', 'No Atendida')->where('estado_tramitacion', 'Completada')->count();
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

        if($request->key){
            $query = Llamadas::where('estado','No Atendida')->with('realizadas.user')->with('comentario.user')->with('cola')->orderBy($request->key, $request->order);
        }else {
            $query = Llamadas::where('estado','No Atendida')->with('realizadas.user')->with('comentario.user')->with('cola')->orderBy($columns[$column], $dir);
        }
        
    
        if ($request->filterCola && $request->filterCola != 0 ) {
            $query->where('cola', $request->filterCola);
        }
        if ($request->menu && $request->menu != 0 ) {
            $query->where('estado_tramitacion', $request->menu);
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
                $query->where('numero_llamante', 'like', '%' . $searchValue . '%');
            });
        }
    
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->draw];
    }


    // create comentarios 
    public function createCommets(Request $res){
         // Guardaremos la gestion en proceso  
         $date = Carbon::now();
         $gestion = new gestionesRealizadas();
         $gestion->fecha = $date->format('Y-m-d');
         $gestion->hora = $date;
         $gestion->id_usuario = $res->user_id; 
         $gestion->comentarios = $res->comentario;
         $gestion->id_llamada_estado = $res->id;
        //  Si la function recibe la llamada completa la valida y procesa los datos 
         if($res->completa){
            $gestion->devolucion_efectiva = true;
           }
        $gestion->save();
        //  Si la function recibe la llamada completa la valida y procesa los datos 

        $llamada = Llamadas::where('id_llamada_estado', $res->id)->first();
        if($res->completa){
            $llamada->estado_tramitacion = 'Completada';
            $llamada->save();
        }else{
            $llamada->estado_tramitacion = 'Tramitandose';
            $llamada->save();
        }
        return response()->json(['state' => true, 'data' => $gestion]);
    }

    // Funcion para agregar un comentario despues de realizar la llamada
    public function createLog(Request $res){
        $update = llamadasRealizadas::where('id_llamada_estado', $res->id)->latest()->first();
        $update->comentarios = $res->comentario;
        if($res->completa){
            $update->devolucion_efectiva = true;
           }
           $update->save();
         
         //  Si la function recibe la llamada completa la valida y procesa los datos 
         $llamada = Llamadas::where('id_llamada_estado', $res->id)->first();
         if($res->completa){
             $llamada->estado_tramitacion = 'Completada';
             $llamada->save();
         }else{
             $llamada->estado_tramitacion = 'Tramitandose';
             $llamada->save();
         }


        return response()->json(['state' => true, 'data' => $llamada]);
    }

    // FUNCIONES NUEVAS 
    // Guardar el registro de una nueva llamada 
    public function llamadaSaliente(Request $res){
        
        $formulario = [
            'num_extension' => $res->extension,
            'num_llamante' => $res->numero_llamante,
            'clid' => $res->clid,
        ];

        $response  = Http::withHeaders([
            'Authorization' => $res->token,
        ])->post($res->url, $formulario);
        
        $datos =  $response->json();


        $llamada = Llamadas::where('id_llamada_estado', $res->id)->first();
        $llamada->estado_tramitacion = 'Tramitandose';
        $llamada->save();
     
       $date = Carbon::now();
       $realizada = new llamadasRealizadas();
       $realizada->fecha  = $date->format('Y-m-d');
       $realizada->hora  = $date;
       $realizada->id_usuario = $res->user_id;
       $realizada->id_llamada_estado = $res->id;
       $realizada->api_callid = $datos['apicallid'];
       $realizada->api_result = $datos['apiresult'];
       $realizada->save();
    }
}
