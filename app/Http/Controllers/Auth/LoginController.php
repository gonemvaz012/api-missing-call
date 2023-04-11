<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use stdClass, File, DB;
use App\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }


    public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'usuario' => 'required',
            'password' => 'required',
        ]);
  
        $fieldType = filter_var($request->usuario, FILTER_VALIDATE_EMAIL) ? 'email' : 'usuario';
        if(auth('web')->attempt(array($fieldType => $input['usuario'], 'password' => $input['password'])))
        {


              // Si coinciden las credenciales le damos paso y creamos el token de passport
        $user = $request->user('web');
        if ($user->userblocked == 1) {
            return response()->json([
                'ok' => false,
                'data' => ['login' => ['Su cuenta ha sido bloqueada']]
            ]);
        }
        $tokenResult = $user->createToken('Token Web');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        $data = new stdClass(); //  Creamos un objeto como resultado del logueo
        $data->user = $user;
        $data->token = $tokenResult->accessToken;
        $data->token_expires = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();

        return response()->json([
            'ok'   => true,
            'data' => $data
        ]);


        }else{
            return response()->json([
                'ok' => false,
                'data' => ['login' => ['Estas credenciales no coinciden con nuestros registros.']]
            ]);
        }
          
    }

    public function createAdmin(){

        // $user = new User([ // Creacion del suario
        //     'name'     => 'Administrador',
        //     'usuario' => 'administrador',
        //     'email'    => 'root@missingcall.com',
        //     'password' => bcrypt('root'),
        //     'type' => 'admin'
        // ]);
        // $user->save();


        // $user = new User([ // Creacion del suario
        //     'name'     => 'Alberto Romario',
        //     'usuario' => 'alberto',
        //     'email'    => 'alberto@missingcall.com',
        //     'password' => bcrypt('test'),
        //     'type' => 'user'
        // ]);
        // $user->save();




    }

    public function logoutUser(Request $request)
    {

        return true;

        // $request->user()->token()->revoke();
        // return response()->json([
        //     'ok' => true,
        //     'data' => 'Salió exitosamente'
        // ]);
    }



    
}
