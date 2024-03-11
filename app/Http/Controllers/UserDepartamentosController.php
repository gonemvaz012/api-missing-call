<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cola;
use App\userDepartamentos;

class UserDepartamentosController extends Controller
{

    public function listaDepartamentosUser(Request $request){
       // listamos  
       $departamento = userDepartamentos::where('user_id', $request->user_id)->with('departamentos')->get();
       return $departamento;
    }

    // listamos las cosas o departamentos  
    public function departamentosLista(){
       $departamentos = Cola::orderBy('cola', 'ASC')->get();
       return $departamentos;
    }


    public function guardarDepartamentos(Request $request)
    {
        // Valida los datos recibidos desde Vue.js
        // $request->validate([
        //     'departamentos' => 'required|array',
        //     'departamentos.*' => 'integer|exists:colas,id',
        // ]);

        // Obtiene el ID del usuario (puedes cambiar esto dependiendo de cómo manejas la autenticación en tu aplicación)
        $userId = $request->user_id;

        // Obtiene los IDs de los departamentos seleccionados
        $departamentosSeleccionados = $request->departamentos;

        // Obtiene los IDs de los departamentos actualmente asignados al usuario
        $departamentosAsignados = userDepartamentos::where('user_id', $userId)->pluck('cola_id')->toArray();

        // Determina los IDs de los departamentos que se deben agregar y eliminar
        $departamentosParaAgregar = array_diff($departamentosSeleccionados, $departamentosAsignados);
        $departamentosParaEliminar = array_diff($departamentosAsignados, $departamentosSeleccionados);

        // Agrega nuevos departamentos
        foreach ($departamentosParaAgregar as $departamentoId) {
            userDepartamentos::create([
                'user_id' => $userId,
                'cola_id' => $departamentoId,
            ]);
        }

        // Elimina los departamentos no seleccionados
        userDepartamentos::where('user_id', $userId)->whereIn('cola_id', $departamentosParaEliminar)->delete();

        // listamos  
        $actualizados = userDepartamentos::where('user_id', $userId)->get();
        return response()->json(['datos' => $actualizados, 'message' => 'Departamentos guardados correctamente']);
    }




}
