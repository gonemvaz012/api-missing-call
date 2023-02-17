<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Llamadas;
use App\comentariosLlamadas;
use Carbon\Carbon;
use App\historialLLamadas;

class LlamadasController extends Controller
{   

    public function Pendientes(){
        return Llamadas::where('state', 1)->get();
    }

    
    public function Listado(Request $request){
        $columns = ['id'];
        $length = $request->length;
        $column = $request->column; //Index
        $dir = $request->dir;
        $searchValue = $request->search;
    
        $query = Llamadas::with('comentario.user')->with('cola')->where('state', '!=', 3)->orderBy($columns[$column], $dir);
    
        if ($request->filterCola && $request->filterCola != 0 ) {
            $query->where('cola', $request->filterCola);
        }
        if ($request->menu && $request->menu != 0 ) {
            $query->where('state', $request->menu);
        }

        if ($request->filterDate) {
            $desde = Carbon::create($request->filterDate['desde'])->subDay(1)->format('Y-m-d');
            $hasta = Carbon::create($request->filterDate['hasta'])->subDay(1)->format('Y-m-d');
            $query->whereDate('fecha', '>', $desde)->whereDate('fecha', '<', $hasta);
        }
    
        if ($request->filterDay) {
            $hoy = Carbon::now()->subDay(1)->format('Y-m-d');
            $query->whereDate('created_at', '=', $hoy);
        }
    
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id_llamada', 'like', '%' . $searchValue . '%')
                     ->orWhere('numero_llamante', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%');
            });
        }
    
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->draw];
    }




    public function ListadoCompletas(Request $request){
        $columns = ['id'];
        $length = $request->length;
        $column = $request->column; //Index
        $dir = $request->dir;
        $searchValue = $request->search;
    
        $query = historialLLamadas::with('comentario.user')->with('user')->orderBy($columns[$column], $dir);
        if ($request->filterDate) {
            $desde = Carbon::create($request->filterDate['desde'])->subDay(1)->format('Y-m-d');
            $hasta = Carbon::create($request->filterDate['hasta'])->subDay(1)->format('Y-m-d');
            $query->whereDate('fecha', '>', $desde)->whereDate('fecha', '<', $hasta);
        }
    
        // if ($request->filterDay) {
        //     $hoy = Carbon::now()->subDay(1)->format('Y-m-d');
        //     $query->whereDate('created_at', '=', $hoy);
        // }
    
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id_llamada', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%');
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
            $llamada = Llamadas::where('id', $res->id)->first();
            $llamada->state = 3;
            $llamada->devolucion_n_efectiva = true;
            $llamada->save();

            $date = Carbon::now();
            $Historial = new historialLLamadas();
            $Historial->id_llamada = $llamada->id;
            $Historial->id_usuario = $res->user_id; 
            $Historial->devolucion_n_efectiva = true; 
            $Historial->fecha  = $date->format('Y-m-d');
            $Historial->hora  = $date->format('H:mm:ss A');
            $Historial->save();
        }

        return response()->json(['state' => true, 'data' => $activy]);
    }

    // create comentarios 
    public function createLog(Request $res){
        $llamada = Llamadas::where('id', $res->id)->first();
        $llamada->state = 2;
        $llamada->save();


        $activy = new comentariosLlamadas();
        $activy->id_llamada = $res->id;
        $activy->id_usuario = $res->user_id;
        if($res->completa){
            $activy->active = true;
        }
        if($res->comentario){
            $activy->comentario = $res->comentario;
        }
        
        $activy->type = 2;
        $activy->save();

        if($res->completa){
            $llamada = Llamadas::where('id', $res->id)->first();
            $llamada->state = 3;
            $llamada->devolucion_n_efectiva = true;
            $llamada->save();

            $date = Carbon::now();
            $Historial = new historialLLamadas();
            $Historial->id_llamada = $llamada->id;
            $Historial->id_usuario = $res->user_id; 
            $Historial->devolucion_n_efectiva = true; 
            $Historial->fecha  = $date->format('Y-m-d');
            $Historial->hora  = $date->format('H:mm:ss A');
            $Historial->save();
        }


        return response()->json(['state' => true, 'data' => $activy]);
    }

    public function changeState(Request $res){
        $llamada = Llamadas::where('id', $res->id)->first();
        $llamada->state = 3;
        $llamada->devolucion_n_efectiva = true;
        $llamada->save();


        $activy = new comentariosLlamadas();
        $activy->id_llamada = $res->id_llamada;
        $activy->id_usuario = $res->user_id;
        $activy->type = 3;
        $activy->save();


        $date = Carbon::now();
        $Historial = new historialLLamadas();
        $Historial->id_llamada = $llamada->id;
        $Historial->id_usuario = $res->user_id; 
        $Historial->devolucion_n_efectiva = true; 
        $Historial->fecha  = $date->format('Y-m-d');
        $Historial->hora  = $date->format('H:mm:ss A');
        $Historial->save();



    }
}
