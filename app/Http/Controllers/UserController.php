<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\UserData;
use App\Http\Requests\UserFormRequest;
use App\Helpers\Notification;
use App\Http\Requests\UserAndDataRequest;
use Exception;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Traits\ControlUserAndUserData;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

/**
 * Controlador que se encarga de trabajar con los usuarios
 */

class UserController extends Controller
{
    use ControlUserAndUserData;
    /**
     * Mostará la lista de los usuarios a un usuari administrador, excluyendo al usuario que tiene la sesión activa
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('userdata')->where('id','!=',auth()->user()->id)->get();
        return view('admin.user.list',compact('users'));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario por parte del administrador
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* $roles = Role::all(); */
        $roles = Role::all();
        /* foreach ($roles as  $role) {
            $role->description = "description";
        }
        dd($roles); */
        //$roles->description = "Description";
        
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Almacena un nuevo usuario desde el lado del administrador
     *
     * @param  Http\Request\UserAndDataRequest $request Una custom request que controla los datos del usuario y los datos de la persona
     * @return \Illuminate\Http\Response
     */
    public function store(UserAndDataRequest $request)
    {
     /*     dd($request); */
        try {
            DB::beginTransaction();
           /*  echo "mobile --->  ".$request->mobile; */
            
            $mobile = $this->removeMaskMobile($request->mobile);
            $dni = $this->removeMaskDni($request->dni);
            $errors=$this->checkMobile($mobile);
            if(strlen($errors)>0) return redirect()->back()->withInput()->withErrors($errors);
            //dd($errorMobile);
            
            //creo el rol y el usuario
            $role = Role::where('id', $request->role)->first();
            $user = User::create([
                //'name'                  => $request->name,
                'username'              => $request->username,
                'email'                 => $request->email,
                'password'              => Hash::make($request->password),
            ]);
            //$avatar_image=$this->getUrlAvatar($request->file('avatar'));
            //guardo la imagen
            if($request->file('avatar')){
                $avatar_image=$this->getUrlAvatar($request->file('avatar'));
            }

            //creo los datos del usuario
            $userData = UserData::create([
                'user_id'           =>  $user->id,
                'first_name'        =>  $request->first_name,
                'last_name'         =>  $request->last_name,
                'dni'               =>  $dni,
                'avatar'            =>  $avatar_image,
                'address'           =>  $request->address,
                'mobile'            =>  $mobile,
                'date_of_birth'     =>  $request->date_of_birth,
            ]);


            //si no hay error, almaceno todos los datos
            if (!is_null($user && $userData)) {
                $user->assignRole($role->name);
                DB::commit();
                $notification = Notification::Notification('User Successfully Created', 'success');
                return redirect()->route('admin.index')->with('notification', $notification);
            }


        } catch (\Exception $e) {
          
             //guardo la información del error
             $errorInfo=(array)json_decode(json_encode($e,true));
             //Reviso el código del error. Los errores SQL tienen una estructura particular
            //Reviso que esa estructura sea la adecuada
            $errors=[];
           
            //Reviso el código del error
            $errors=!is_null($errorInfo['errorInfo'])?$this->getSQLError($errorInfo['errorInfo'][2]):null;
             //dd($errorCode);
             DB::rollBack();
             //El error 23000 es el error para la violación de la restricción de código único
             //Si sucede, por la naturaleza del problema, es que el dni está repetido
             if(count($errors)>0){
                 return redirect()->back()->withInput()->withErrors($errors);
             }else{
                 $notification = Notification::Notification('Error', 'error');
             }
             
             return redirect()->back()->withInput()->with('notification', $notification);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = User::where('id', $request->id)->with('userdata','roles')->first();
        return [
            'status'    =>  200,
            'name'      =>  $user->name,
            'username'  =>  $user->username,
            'firstName' =>  $user->userdata->first_name,

        ];
    }

    /**
     * Muestra el formulario para editar los datos del usuario y de la persona por parte del administrador
     *
     * @param  Http\Model\User $user Es el usuario cuyos datos se van a modificar
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        /* dd($user); */
        $user = User::where('id', $user->id)->with('userdata','roles')->first();
        $roles = Role::all();
        
    
        return view('admin.user.edit', compact('user', 'roles'));

        
    }

    /**
     * Perite actualizar los datos del usuario por parte del administrador
     *
     * @param  Http\Request\UserDataRequest  $request Una custom request que controla los datos del usuario y de la persona
     * @param  Http\Models\User $user El usuario cuyos datos personales o de usuario se van a modificar
     * @return \Illuminate\Http\Response
     */
    public function update(UserAndDataRequest $request, User $user)
    {
       //dd($request);
        try {
            DB::beginTransaction();

            //################# NOTA #######################
            //Estos controles los hago porque me dan errores al momento de usar el custom request
            //Por algún motivo, no controla que el dni sea único y tampoco controla la máscara del móvil
         
            $mobile = $this->removeMaskMobile($request->mobile);
            $dni = $this->removeMaskDni($request->dni);
            $errors=[];
            $checkMobile=$this->checkMobile($mobile);
            $userData = UserData::where('user_id',$user->id)->first();
            //dd($userData);
            //Controlo que el teléfono cumpla el formato planteado
            //Si no, retorno con el
          
            if(strlen($checkMobile)!=0) $errors['mobile']=$checkMobile;
            if(count($errors)>0) return redirect()->back()->withInput()->withErrors($errors);
    
           //guardo la imagen
           if($request->file('avatar')){
                 $avatar_image=$this->getUrlAvatar($request->file('avatar'));
            }

            
            if(!is_null($userData)){
                $userData->first_name = $request->first_name;
                $userData->last_name = $request->last_name;
                
                $userData->address = $request->address;
                $userData->mobile = $mobile;
                $userData->date_of_birth = $request->date_of_birth;
                //si llego hasta aquí es porque pasó todos los controles y sólo determino si se cambiará
                //o no el dni dependiendo si el usuario puso un valor distinto al que estaba
             //$userData->dni=$dni; 
            }else{
               $userData=UserData::create([
                'first_name' => $request->first_name,
                'last_name'=>$request->last_name,
                'dni' => $dni,
                'address' => $request->address,
                'mobile' => $mobile,
                'date_of_birth'=> $request->date_of_birth,
                'user_id'=>$user->id,
                'avatar'=>$avatar_image
               ]);
                
            }
          
            $userData->save();
           
         

            if (!is_null($user && $userData)) {
                DB::commit();
                $notification = Notification::Notification('User Successfully Updated', 'success');
                return redirect()->route('admin.index')->with('notification', $notification);
            }


        } catch (\Exception $e) {
            //dd($e);
            //guardo la información del error convirtiendo previamente la información en arreglo
            $errorInfo=(array)json_decode(json_encode($e,true));
            //Reviso el código del error. Los errores SQL tienen una estructura particular
            //Reviso que esa estructura sea la adecuada
            $errors=[];
           
            //Reviso el código del error
            $errors=!is_null($errorInfo['errorInfo'])?$this->getSQLError($errorInfo['errorInfo'][2]):null;
            //dd($errorCode);
            DB::rollBack();
            //El error 23000 es el error para la violación de la restricción de código único
            //Si sucede, por la naturaleza del problema, es que el dni está repetido
            if(count($errors)>0){
                return redirect()->back()->withInput()->withErrors($errors);
            }else{
                $notification = Notification::Notification('Error', 'error');
            }
            
            return redirect()->back()->withInput()->with('notification', $notification);
        }
    }

    /**
     * Permite eliminar un usuario de parte del administrador
     *
     * @param  \Illuminate\Http\Response La petición con los datos del usuario a eliminar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::find($request->userId);
            if(!is_null($user)){
                $userData = UserData::where('user_id',$user->id)->first();
                //Puede darse el caso que el usuario no tenga datos de usuario en 
                //la tabla dataUser. Por eso, si no tiene un registro en dataUser
                //sólo elimino al usuario.
                //Si tiene datos de usuario, elimino al usuario y a sus datos
                if(!is_null($userData)){
                    $userData->delete();
                    $user->delete();
                    DB::commit();
                    return ['status' => 200];
                }else{
                    $user->delete();
                    DB::commit();
                    return ['status' => 200];
                }
               
                
                
            }
            DB::rollBack();
            return ['status' => 400];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => 400];
        }
        
    }
     /**
     * 
     *
     * @param  int  $username
     * @return \Illuminate\Http\Response
     */
    public function searchUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            return ['status' => 200];
        } else {
            return ['status' => 400];
        }
    }

    /**
     * Permite recuperar los datos del usuario para mostrarlos
     * @param \Illuminate\Http\Request $request La petición con los datos necesarios para recuperar al usuario
     * @return JSON Un archivo json con los datos del usuario
     */
    public function getUserById(Request $request){
      
        //dd($request);
        $user=User::with('userdata')->where('id',$request->userId)->first();
        if(!is_null($user)){
            $data=[
                'username'=>$user->username,
                'email'=>$user->email,
               
            ];
            
        }else{
            return ['status'=>400,'msgError'=>'No se encuentra el usuario solicitado'];
        }

        if(!is_null($user->userdata)){
            $data['first_name']=$user->userdata->first_name;
            $data['last_name']=$user->userdata->last_name;
            $data['dni']=$user->userdata->dni;
            $data['address']=$user->userdata->address;
            $data['mobile']=$user->userdata->mobile;
            $data['avatar']=$user->userdata->avatar;
        }

        //dd($data);
        return ['status'=>200,'data'=>json_encode($data)];
      
    }

    

   /**
    * Controla individualmente al teléfono móvil
    *@param String $mobile El número de teléfono a controlar
    *@return String El string con el error producido
    */
   private function checkMobile($mobile){
        $errorMobile='';
      
        $errorMobile=$this->getErrorsMobile($mobile);
       
        //dd($errorMobile);
        return $errorMobile;
    }

    


 

}
