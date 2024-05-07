<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use App\Jobs\SendMailForgotPassword;

use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Permite enviar el enlace de reseteo de contraseña al mail del usuario
     * @var Illuminate\Http\Request $request Es la petición con los datos del mail
     */
    public function sendResetLinkEmail(Request $request)
    {
        $user=$this->getUser($this->credentials($request));
        //dd($user);
        $codeToken=$this->createToken();
        if(is_null($user)){
            return redirect()->back()->withErrors(['error_message'=>'Invalid credentials'])
            ->withInput();
        }else{
            //creo los datos del token y el mail guardándolos en la sesión
            session(['codeToken'=>$codeToken ,'email'=> $user->email]);
            //controla que en la tabla PasswordReset exista ya el mail del usuario
            $passwordReset=PasswordReset::where('email',$user->email)->first();
            $this->createOrUpdatePasswordReset($passwordReset,$user,$codeToken);
            $this->sendEmailForReset($user,$codeToken);
            return view('emails.successSendMail');
        }
    }

    /**
     * Permite ingresar el registro en la tabla PasswordReset con el mail, fecha y token para el
     * usuario. Si ya existe esa información, la actualiza
     * @var App\Models\PasswordReset $passwordReset es el registro que existirá o no en la tabla
     * PasswordReset para el usuario. Podrá ser nulo si no existe
     * @var App\Models\User $user son los datos del usuario para el mail enviado
     * @var String $codeToken Es el token para el reseteo
     */
    private function createOrUpdatePasswordReset($passwordReset, $user, String $codeToken){
        //Si no se tiene registrado en la tabla PasswordReset los datos del usuario, se crean
        //En caso contrario, se actualiza el token
        if (is_null($passwordReset)){
            PasswordReset::create([
                'email'=>$user->email,
                'token'=>$codeToken,
                'created_at'=>Date('Y-m-d H:i:s')
            ]);
        }else{
            PasswordReset::where('email',$user->email)->update([
                'token'=>$codeToken
            ]);

        }
        
    }

    /**
     * Permite obtener las credenciales del usuario
     * @var Illuminate\Http\Request $request Es la petición con los datos enviados
     * @return Array Retorna un arreglo con los datos de las credenciales del usuario
     */
    public function credentials(Request $request):array{
        //Almaceno la información del input que tendrá el name=login
        $login=$request->input($this->username());
        //filtro para saber si el valor del input se trata o no de un mail
        $field=filter_var($login,FILTER_VALIDATE_EMAIL)?'email':'username';
        //retorno un arreglo que tendrá el valor del campo y la contraseña
       
        return [
            $field=>$login
        ];
    }

    /**
     * Permite recuperar el nombre del campo que treará si es un mail o un nombre 
     * de usuario.
     * @return String Retorna un string con el name del input que se usará para saber si el 
     * usuario quiere acceder con su mail o con su nombre de usuario
     */
    public function username():String{
        return 'login';
    }


    /**
     * Permite determinar si el mail o nombre de usuario ingresado existen en la base de datos
     * @var Array $credentialArray: Es el arreglo con los datos de la credenciales del usuario
     * @return Http/Models/User  retorna al usuario si existe y null en caso contrario
     */
    private function getUser($credentialArray):User|null{
        //determina si se usará el nombre de usuario o el mail
        $fieldUsed=array_keys($credentialArray)[0];
        $datumField=$credentialArray[$fieldUsed];
      
        return  User::where($fieldUsed,$datumField)->first();

    }

    /**
     * Permite crear el string token para el reseteo de la contraseña
     * @return string el string que representa el token usado para el reseteo de contraseña
     */
    
    private function createToken():string{
        return Str::random(60);
    }

    /**
     * Envía el mail para realizar el reseteo de contraseña
     */

    private function sendEmailForReset($user,$codeToken){
        SendMailForgotPassword::dispatch($user,$codeToken);
        
    }

    /**
     * Se encargará de mostrar la vista donde se podrá modificar la contraseña
     * @var Illuminate\Http\Request $request Es la petición con los datos para el reseteo
     */

    public function passwordReset(Request $request){
        //Selecciona el registro en la tabla PasswordReset con el mail y token correspondiente
        //para la sesión creada.
        $passwordReset=PasswordReset::select('email','token')->where('email',session('email'))
        ->where('token',session('codeToken'))->first();
        //Si no existe ese registro, se envia un mensaje de error 
        //En caso que exista, reseteamos la contraseña enviando los datos a la ruta pertinente
        if(is_null($passwordReset)){
            $this->emptySession();
            return redirect()->route('password.request')
            ->withErrors(['error_message'=>'Ocurrió un error. Vuelva a enviar el mail para el reseteo de cotraseña'])
            ->withInput();
        }else{
            $email=$passwordReset->email;
            $token=$passwordReset->token;
            return view('auth.passwords.reset',compact('email','token'));
        }
       
    }

    /**
     * Se encargará de la actualización de la contraseña en la base de datos
     * @var Illuminate\Http\Request $request Los datos de la petición para realizar el reseteo
     */
    public function passwordUpdate(Request $request){
        $redirectionReturn=null;
        //recupero los datos del token y email, así como los datos del usuario registrado
       $dataUserAndPasswordReset=$this->getUserAndPasswordResetIfExist($request);
        
       //determino si la contraseña no tiene un formato válido
       if(!$dataUserAndPasswordReset['password']) $redirectionReturn=$this->errorMessage(400,'Passwords no match');

       //compruebo que tanto los datos del token y email, así como los datos del usuario registrado
       //existan. Si no existen, vuelvo a la ventana 
       if(is_null($dataUserAndPasswordReset['user']) || is_null($dataUserAndPasswordReset['passwordReset'])){
            $this->emptySession();
            $redirectionReturn=$this->errorMessage(400,'Credentials not valids');
       }   else{
                        //modifico al nuevo password
                    $dataUserAndPasswordReset['user']->password=Hash::make($request->password);
                    //salvo las modificaciones
                
                $dataUserAndPasswordReset['user']->save();
                    //elimino ese dato de la tabla de tokens asociados a los mails
                //$dataUserAndPasswordReset['passwordReset']->delete();
                PasswordReset::where('email',$dataUserAndPasswordReset['passwordReset']->email)->delete();
                    //vacío la sesión que almacenaba los datos del token y el mail
                $this->emptySession();
                $redirectionReturn=$this->errorMessage(200,'Password modified.Please, login');
       }
       
       

        return $redirectionReturn;
       
       
            
        
    }

    /**
     * Permite controlar que los datos del formulario sean válidos, que exista el token y el mail,
     * y que exista el usuario registrado
     * @param Illuminate\Http\Request La solicitud inicial con los datos del formulario
     * @return Array Retorna un array asociativo con los datos del token y el mail, y con los datos
     * del usuario registrado, junto con si el password es correcto. En caso contrario, uno o varios campos serán nulos.
     */
    private function getUserAndPasswordResetIfExist($initialRequest){
        $user=null;
        $validPassword=$this->checkPassword($initialRequest->password,$initialRequest->password_confirmation);
        $passwordReset=PasswordReset::where('email', session('email'))->where('token',session('codeToken'))->first();
        if(!is_null($passwordReset) && $validPassword) $user=User::where('email',$passwordReset->email)->first();
        return ['passwordReset'=>$passwordReset,'user'=>$user,
        'password'=>$validPassword];
        
    }

    /**
     * Permite vacias los datos del token y el mail para la sesión
     */
   private function emptySession(){
        Session::forget(['codeToken','email']);
     
   }

   /**
    * Comprueba si la contraseña y la confirmación de la contraseña, al momento de realizar la 
    *actualización de la misma, son iguales
    */
    private function checkPassword(string $password, string $passwordConfirmation){
        return $password===$passwordConfirmation;
    }

    /**
     * Permite establecer la redirección a la vista anterior dependiendo los errores producidos
     * @var Integer $code El código de error
     * @var String $message El mensaje de error que se mostrará
     */
  
    private function errorMessage($code,$message){

        switch($code){
            case 200:
                Session::flash('success',$message);
                return redirect()->route('login');
                break;
            case 400:
                //Session::flash('error_message',$message);
                return redirect()->back()->withErrors(['error_message'=>$message]);
                break;
        }
    }
}