<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\dataHotel;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{

    public function userView()
    {
        // Retornamos el usuario logueado por su id
        $user = User::where('id', Auth::user()->id)->with('datos')->first();
        return $user;
    }

    public function updateDatos(Request $res, $id)
    {
        // buscamos los datos del user 
        $user = User::find($id);
        $user->razon_social = $res->razon_social;
        $user->telefono = $res->telefono;
        $user->save();

        $datosUser = dataHotel::where('user_id', $id)->first();
        $datos = dataHotel::find($datosUser->id)->update($res->datos);

        return response()->json(['ok' => true, 'datos' => $datos]);
    }

    public function UpdateUser(Request $res)
    {
        $validator = Validator::make($res->all(), [
            'id'     => 'required',
            'name'     => 'required',
            'telefono'    => 'required',
            'email'    => 'required',
            'pais'    => 'required',
        ]);

        if ($validator->fails()) { // Si no cumplen con la condicion retorna los errores
            return response()->json([
                'ok' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $user = User::find($res->id);
        $user->name = $res->name;
        $user->nit = $res->nit;
        $user->telefono = $res->telefono;
        $user->email = $res->email;
        $user->pais_name = $res->pais_name;
        $user->pais = $res->pais;
        $user->save();

        return response()->json(['ok' => true]);
    }

    public function UpdatePass(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'password'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }
        DB::beginTransaction(); /// es como almacenar todo el proceso en un lote
        try { // verificas la transaccion
            $user = User::findOrFail(Auth::user()->id);
            $user->password = bcrypt($r->password);
            $user->save();

            DB::commit();

            return response()->json(['ok' => true]);
        } catch (\Exception $e) { //en caso de que falle aqui pasas el mensahe del servidor o algun return con algo y el DB rolback que restaura los cambios de la base de datos que se realizaron en la transaccion 
            throw new \Exception("Error de funcionamiento", 1);
            DB::rollBack();
        }
    }

    public function ListBusiness(Request $res)
    {
        $columns = ['id'];
        $length = $res->length;
        $column = $res->column;
        $dir = $res->dir;
        $searchValue = $res->search;

        $query = User::where('type', 'empresa')->orderBy($columns[$column], $dir);

        if ($res->filterDate) {
            $desde = Carbon::create($res->filterDate[0])->format('Y-m-d');
            $hasta = Carbon::create($res->filterDate[1])->format('Y-m-d');
            $query->whereDate('created_at', '>=', $desde)->whereDate('created_at', '<=', $hasta);
        }

        if ($res->filterDay) {
            $hoy = Carbon::now()->subDay(1)->format('Y-m-d');
            $query->whereDate('created_at', '=', $hoy);
        }

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);
        foreach ($projects as $item) {
            $item->created_at2 = Carbon::create($item->created_at)->format('d-m-Y');
        }
        return ['data' => $projects, 'draw' => $res->draw];
    }

    public function ListManagers(Request $res)
    {
        $columns = ['id'];
        $length = $res->length;
        $column = $res->column;
        $dir = $res->dir;
        $searchValue = $res->search;

        $query = User::where('type', 'admin')->orderBy($columns[$column], $dir);

        if ($res->filterDate) {
            $desde = Carbon::create($res->filterDate[0])->format('Y-m-d');
            $hasta = Carbon::create($res->filterDate[1])->format('Y-m-d');
            $query->whereDate('created_at', '>=', $desde)->whereDate('created_at', '<=', $hasta);
        }

        if ($res->filterDay) {
            $hoy = Carbon::now()->subDay(1)->format('Y-m-d');
            $query->whereDate('created_at', '=', $hoy);
        }

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);
        foreach ($projects as $item) {
            $item->created_at2 = Carbon::create($item->created_at)->format('d-m-Y');
        }
        return ['data' => $projects, 'draw' => $res->draw];
    }

    public function UpdateUserLimit(Request $res)
    {
        $validator = Validator::make($res->all(), [
            'id'     => 'required',
            'limit_reset'     => 'required',
        ]);

        if ($validator->fails()) { // Si no cumplen con la condicion retorna los errores
            return response()->json([
                'ok' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $user = User::find($res->id);
        $user->limit_reset = $res->limit_reset;
        $user->save();

        return response()->json(['ok' => true]);
    }

    public function UpdateUserBlocked(Request $res)
    {
        $validator = Validator::make($res->all(), [
            'id'     => 'required',
            'userblocked'     => 'required',
        ]);

        if ($validator->fails()) { // Si no cumplen con la condicion retorna los errores
            return response()->json([
                'ok' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $user = User::find($res->id);
        $user->userblocked = $res->userblocked;
        $user->save();

        return response()->json(['ok' => true]);
    }

    public function NewManager(Request $res)
    {
        $validator = Validator::make($res->all(), [
            'name'     => 'required',
            'email'     => 'required',
            'password'     => 'required',
        ]);

        if ($validator->fails()) { // Si no cumplen con la condicion retorna los errores
            return response()->json([
                'ok' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $user = new User([ // Creacion del manager
            'name'     => $res->name,
            'email'    => $res->email,
            'password' => bcrypt($res->password),
            'type'    => 'admin',
        ]);
        $user->save();

        return response()->json(['ok' => true]);
    }

    public function UpdateManager(Request $res)
    {
        $validator = Validator::make($res->all(), [
            'id'     => 'required',
            'name'     => 'required',
            'email'     => 'required',
        ]);

        if ($validator->fails()) { // Si no cumplen con la condicion retorna los errores
            return response()->json([
                'ok' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $user = User::find($res->id);
        $user->name = $res->name;
        $user->email = $res->email;
        if (isset($res->password)) {
            $user->password = bcrypt($res->password);
        }
        $user->save();

        return response()->json(['ok' => true]);
    }

    public function DeleteManager(Request $res)
    {
        $validator = Validator::make($res->all(), [
            'id'     => 'required',
        ]);

        if ($validator->fails()) { // Si no cumplen con la condicion retorna los errores
            return response()->json([
                'ok' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $user = User::find($res->id);
        $user->delete();

        return response()->json(['ok' => true]);
    }
}
