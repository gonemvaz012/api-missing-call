<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api;
use Illuminate\Support\Facades\Http;



class ApiController extends Controller
{   
    
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
