<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  


    public function Listado(Request $request){
        $columns = ['id'];
        $length = $request->length;
        $column = $request->column; //Index
        $dir = $request->dir;
        $searchValue = $request->search;
    
        $query = User::where('type', 'user')->orderBy($columns[$column], $dir);

        if ($request->filterDate) {
            $desde = Carbon::create($request->filterDate[0])->subDay(1)->format('Y-m-d');
            $hasta = Carbon::create($request->filterDate[1])->subDay(1)->format('Y-m-d');
            $query->whereDate('fecha', '>', $desde)->whereDate('fecha', '<', $hasta);
        }
    
        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%')
                     ->orWhere('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%');
            });
        }
    
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->draw];
    }


    public function createUser(Request $res){

        $res->validate([
            'password' => 'required',
            'usuario' => 'required|unique:users'
        ]);

        $user = new User([ // Creacion del suario
            'name'     => $res->nombre,
            'usuario' => $res->usuario,
            'password' => bcrypt($res->password),
            'type' => 'user',
            'extension' => $res->extension
        ]);
        $user->save();




    }




    
}
