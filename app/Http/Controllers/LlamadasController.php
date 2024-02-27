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
use App\User;
use App\Cola;
use App\configuracion;



class LlamadasController extends Controller
{   

    public function Example(){
       
    // // Obtener la configuración
    //     $configuracion = Configuracion::find(1);
    //     $intervalo = $configuracion->intervalo_min;
    //     $repeticionesMinimas = intval($configuracion->llamadas_intervalo);// Obtener el valor dinámico

    //     // Calcular el rango de tiempo
    //     $horaActual = Carbon::now();
    //     $horaInicioRango = $horaActual->copy()->subMinutes($intervalo); // Retroceder el intervalo
 
    //     // Consulta para obtener las llamadas dentro del rango de tiempo
    //     $llamadas = Llamadas::whereBetween('created_at', [$horaInicioRango, $horaActual])
    //         ->get();

    //     // return $horaActual . ' - - - -- ' . $horaInicioRango;
    //     // Agrupar las llamadas por número y contar cuántas veces se repite cada número
    //     $llamadasAgrupadas = $llamadas->groupBy('numero_llamante')->map(function ($grupo) use ($repeticionesMinimas) {
    //         return [
    //             'numero_llamante' => $grupo->first()->numero_llamante,
    //             'repeticiones' => count($grupo),
    //             'llamadas' => $grupo
    //         ];
    //     })->filter(function ($grupo) use ($repeticionesMinimas) {
    //         return $grupo['repeticiones'] >= $repeticionesMinimas; // Filtrar solo los números que se repiten al menos 3 veces
    //     })->values(); // Reindexar el array
     
    //     foreach ($llamadasAgrupadas as $grupo) {
    //         $ultimaLlamada = $grupo['llamadas']->last();
    //         $ultimaLlamadaId = $ultimaLlamada->id_llamada_estado;
    //         foreach ($grupo['llamadas'] as $llamada) {
    //             $llamada->grupo_id = $ultimaLlamadaId;
    //             $llamada->save();
    //         }

    //         // Obtener las llamadas anteriores al último y actualizar el campo no_visible a true
    //         $cantidadAnteriores = min($repeticionesMinimas - 1, $grupo['llamadas']->count() - 1);
    //         $llamadasAnteriores = $grupo['llamadas']->reverse()->slice(1, $cantidadAnteriores); // Obtener las anteriores
    //         foreach ($llamadasAnteriores as $llamadaAnterior) {
    //             $llamadaAnterior->no_visible = true;
    //             $llamadaAnterior->save();
    //         }
            
    //     }

    //     return  $llamadasAgrupadas;
    
    }

    public function LlamadasCount(){
       
       $todas =  Llamadas::where('estado', 'No Atendida')->where('no_visible', 0)->count();
       $pendientes =  Llamadas::where('estado', 'No Atendida')->where('no_visible', 0)->where('estado_tramitacion', 'No atendida')->count();
       $tramitandose =  Llamadas::where('estado', 'No Atendida')->where('no_visible', 0)->where('estado_tramitacion', 'Tramitandose')->count();
       $completadas =  Llamadas::where('estado', 'No Atendida')->where('no_visible', 0)->where('estado_tramitacion', 'Completada')->count();
       $urgentes =  Llamadas::whereNotNull('grupo_id')->where('grupo_id', '!=', '')->where('no_visible', 0)->count();

       return response()->json(['pendientes' => $pendientes, 'tramitandose' => $tramitandose, 'completadas' => $completadas, 'todas' => $todas, 'urgentes' => $urgentes ]);
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
            $query = Llamadas::where('estado','No Atendida')
            ->where('no_visible', 0)
            ->with('realizadas.user', 'grupo.cola')->with('comentario.user')->with('cola')->orderBy($request->key, $request->order);
        }else {
            $query = Llamadas::where('estado','No Atendida')
            ->where('no_visible', 0)
            ->with('realizadas.user', 'grupo.cola')->with('comentario.user')->with('cola')->orderBy($columns[$column], $dir);
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

        // revisamnos el proceso para ver si tiene un grupo 
        $llamada = Llamadas::where('id_llamada_estado', $res->id)->with('grupo')->first();
        if($llamada && $llamada->grupo_id){

            foreach($llamada->grupo as $call){
                 // Guardaremos la gestion en proceso  
                    $date = Carbon::now();
                    $gestion = new gestionesRealizadas();
                    $gestion->fecha = $date->format('Y-m-d');
                    $gestion->hora = $date;
                    $gestion->id_usuario = $res->user_id; 
                    $gestion->comentarios = $res->comentario;
                    $gestion->id_llamada_estado = $call->id_llamada_estado;
                    //  Si la function recibe la llamada completa la valida y procesa los datos 
                    if($res->completa){
                        $gestion->devolucion_efectiva = true;
                    }
                    $gestion->save();
                    //  Si la function recibe la llamada completa la valida y procesa los datos 
                    $micall = Llamadas::where('id_llamada_estado', $call->id_llamada_estado)->first();
                    if($res->completa){
                        $micall->estado_tramitacion = 'Completada';
                        $micall->save();
                    }else{
                        $micall->estado_tramitacion = 'Tramitandose';
                        $micall->save();
                    }  
            }
            return response()->json(['state' => true, 'data' => $llamada]);

        }else {
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

       
        if($res->completa){
            $llamada->estado_tramitacion = 'Completada';
            $llamada->save();
        }else{
            $llamada->estado_tramitacion = 'Tramitandose';
            $llamada->save();
        }
        return response()->json(['state' => true, 'data' => $gestion]);
        }

         
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

        $user = User::find($res->user_id);
        $cola = Cola::where('clid', $res->clid)->first();


        $llamada = Llamadas::where('id_llamada_estado', $res->id)->first();
        $llamada->estado_tramitacion = 'Tramitandose';
        $llamada->save();
     
        $date = Carbon::now();

        $realizada = new llamadasRealizadas();
        $realizada->fecha  = $date->format('Y-m-d');
        $realizada->hora  = $date;
        $realizada->id_usuario = $res->user_id;
        $realizada->id_llamada_estado = $res->id;
        //    $realizada->api_callid = $datos['apicallid'];
        //    $realizada->api_result = $datos['apiresult'];
        $realizada->save();

       if($realizada){

            $formulario = [
                'idCallRegister' => 'api'. $realizada->id,
                'prefijo' => $cola->prefijo,
                'number' => $res->numero_llamante,
                'extension' => $user->extension,
                'password' => $user->passwordpbx,
            ];
            
            $response = Http::withToken($request->token)
            ->post($res->url .'/callbacks', $formulario);
            
            $datos = $response->json();

            return $datos;
       }
    }
}
