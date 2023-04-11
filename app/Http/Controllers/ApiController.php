<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api;


class ApiController extends Controller
{
    public function ApiCreate(Request $res){
        $api = Api::find(1);
        if(isset($api)){
            $api->token = $res->token;
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
