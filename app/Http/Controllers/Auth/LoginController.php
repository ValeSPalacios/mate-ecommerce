<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Nette\Utils\Arrays;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $user=null;
        //recuperamos las credenciales
        $credentials=$this->credentials($request);
        //Comprueba si las credenciales son válidas
        if(Auth::validate($credentials)){
            $user=Auth::getLastAttempted();
            auth()->login($user);
            return redirect('home');
        }else{
           return $this->redirectWithErrors($credentials);
           
        }
        
    }

    public function credentials(Request $request):array{
        //Almaceno la información del input que tendrá el name=login
        $login=$request->input($this->username());
        //filtro para saber si el valor del input se trata o no de un mail
        $field=filter_var($login,FILTER_VALIDATE_EMAIL)?'email':'username';
        //retorno un arreglo que tendrá el valor del campo y la contraseña
        return [
            $field=>$login,
            'password'=>$request->input('password')
        ];
    }

    /**
     * Permite recuperar el nombre del campo que treará si es un mail o un nombre 
     * de usuario. Este dato es el usado en los atributos name e id del input de la vista
     * @return String retorna el nombre del campo usado para iniciar la sesión. 
     * 
     */
    public function username():String{
        return 'login';
    }

    /**
     * Permite determinar si el mail o nombre de usuario ingresado existen en la base de datos
     * @var Array $credentialArray: Es el arreglo con los datos de la credenciales del usuario
     * @return bool retorna true si existe el usuario o email, retorna false en caso contrario
     */
    private function existUserOrMail($credentialArray):bool{
        //determina si se usará el nombre de usuario o el mail
        $fieldUsed=array_keys($credentialArray)[0];
        $datumField=$credentialArray[$fieldUsed];
       return is_null(User::where($fieldUsed,$datumField)->first()) ? false:true;

    }

    /**
     * Permite redireccionar con un determinado error a la vista anterior
     * @var Array $credentialArray: Es el arreglo con los datos de la credenciales del usuario
     * @return \Illuminate\Contracts\Support\Renderable retorna a la vista anterior con los datos del error
     */
    private function redirectWithErrors($credentialArray){
        $error=$this->existUserOrMail($credentialArray)?'The password is wrong':'The mail o username is wrong';
        Session::flash('login_error',$error);
        return back()->withInput();
    }
}
