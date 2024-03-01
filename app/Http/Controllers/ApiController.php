<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api;
use Illuminate\Support\Facades\Http;
use App\Llamadas;
use Illuminate\Support\Facades\Validator;
use App\llamadasRealizadas;



class ApiController extends Controller
{   
//    -- -- - --   
    public function assignCall(Request $request){

        $validator = Validator::make($request->all(), [
            'idCallRegister' => 'required',
        ], [
            'idCallRegister.required' => 'El id de la llamada es requerido por el sistema',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }


        $llamada = llamadasRealizadas::find($request->idCallRegister);
        if($llamada){
            $llamada->api_callid = $request->tag;
            $llamada->api_result = $request->result;
            $llamada->save();
        }else {
            return response()->json(['status' => 404,'message' => 'Llamada no existe en los registros'], 404);
        }
        

        return response()->json(['status' => 200,'message' => 'Llamada actualizada con éxito'], 200);

    }


    public function registerCall(Request $request){

        $validator = Validator::make($request->all(), [
            'id_llamada' => 'required',
            'numero_cola' => 'required',
            'numero_llamante' => 'required',
            'fecha_llamada' => 'required',
            'hora_llamada' => 'required',
        ], [
            'id_llamada.required' => 'El id de la llamada es requerido por el sistema',
            'numero_cola.required' => 'El número de cola es requerido',
            'numero_llamante.required' => 'El número del llamante es requerido',
            'fecha_llamada.required' => 'La fecha de la llamada es requerida',
            'hora_llamada.required' => 'La hora de la llamada es requerida',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }


        $llamada = new Llamadas();
        $llamada->id_llamada = $request->id_llamada;
        $llamada->cola = $request->numero_cola;
        $llamada->numero_llamante =  $request->numero_llamante;
        $llamada->fecha = $request->fecha_llamada; // Formato hora fecha 2023-10-16;
        $llamada->hora = $request->hora_llamada; // Formato hora fecha 18:27:10
        $llamada->estado= 'No Atendida';
        $llamada->estado_tramitacion = 'No atendida';
        $llamada->save();

        return response()->json(['status' => 200,'message' => 'Llamada registrada con éxito'], 200);

    }

    // -------- 

    
    public function LlamadasApi(Request $res){

        $formulario = [
            'num_extension' => $res->extension,
            'num_llamante' => $res->numero_llamante,
            'clid' => $res->clid,
        ];

        $response  = Http::withHeaders([
            'Authorization' => $res->token,
        ])->post($res->url, $formulario);
        
        return $response;

    }

    public function ApiCreate(Request $res){
        $api = Api::find(1);
        if(isset($api)){
            $api->token = $res->token;
            $api->url = $res->url;
            $api->save();
            return $api;
        }else {
            $api = Api::create($res->all());
            return $api;
        }
    }

    public function listApi(){
        $api = Api::find(1);
        return $api;
    }
}
