<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;
use App\Models\User;
use App\Http\Requests\UserDataRequest;
use App\Models\Role;
use App\Helpers\Notification;
use App\Models\Category;
use Exception;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Controlador que se encarga de actualizar los datos para el usuario registrado y que 
 * ha iniciado sesión. Este es el usuario cliente.
 */
class UserDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //dd(auth()->user());
        //$user=User::with('userdata')->where('id',auth()->user()->id)->first();
        $categories=Category::all();
        $userData=UserData::with('user')->where('user_id',auth()->user()->id)->first();
        return view('userData.edit',compact('userData', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();


            /*$validator = Validator::make($request->all(), [
                'first_name'        => 'required|between:1,100',
                'last_name'         => 'required|between:1,100',
                'email'             => 'required|between:3,64|email',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput();
            }*/

           /*  echo "mobile --->  ".$request->mobile; */
            $arrayRemove = array(" " , "(" ,")" , "-");
            $mobile = str_replace($arrayRemove,"",$request->mobile);
    /*         echo "<br> mobile --->  ".$mobile;
            echo '<br> dni: '.$request->dni; */
            $dni = str_replace(".","",$request->dni);
           /*  echo '<br> dni: '.$dni;
            dd('stop'); */
            $role = Role::where('id', $request->role)->first();
            if ($request->file('avatar')) {
                $image = $request->file('avatar');
                $type = $image->getClientOriginalExtension();
                $img = date('Y-m-d-H-i-s') . '-id-' . auth()->user()->id . '.' . $type;
                $image->move('image/user/', $img);

                $avatar_image = 'image/user/' . $img;
            } else {
                $avatar_image = '/dist/img/user2-160x160.jpg';
            }
            $userData = UserData::create([
                'user_id'           =>  auth()->user()->id,
                'first_name'        =>  $request->first_name,
                'last_name'         =>  $request->last_name,
                'dni'               =>  $dni,
                'avatar'            =>  $avatar_image,
                'address'           =>  $request->address,
                'mobile'            =>  $mobile,
                'date_of_birth'     =>  $request->date_of_birth,
            ]);



            if (!is_null($userData)) {
                DB::commit();
                $notification = Notification::Notification('User Successfully Created', 'success');
                return redirect('home')->with('notification', $notification);
            }


        } catch (\Exception $e) {
            /* dd($e); */
            DB::rollBack();
            $notification = Notification::Notification('Error', 'error');
            return redirect()->route('userData.show')->with('notification', $notification);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserDataRequest $request)
    {
        //¿Qué pasa si el usuario ya tiene datos ingresados a la tabla?
        //¿Qué pasa si el usuario no tiene ingresados sus datos a la tabla?
     
        $user_data=UserData::where('user_id',auth()->user()->id);
        if(is_null($user_data)){
            return $this->store($request);
        }else{
            //creo los datos del usuario
            try {
                DB::beginTransaction();
    
                $arrayRemove = array(" ","(",")","-");
                $mobile = str_replace($arrayRemove,"",$request->mobile);
                $dni = str_replace(".","",$request->dni);
    
                $userData = UserData::where('user_id',auth()->user()->id)->first();
                $userData->first_name = $request->first_name;
                $userData->last_name = $request->last_name;
                $userData->dni = $dni;
                $userData->address = $request->address;
                $userData->mobile = $mobile;
                $userData->date_of_birth = $request->date_of_birth;
                $userData->save();
    
                if (!is_null($userData)) {
                    DB::commit();
                    $notification = Notification::Notification('User Successfully Updated', 'success');
                    return redirect('home')->with('notification', $notification);
                };
        }catch (\Exception $e) {
            DB::rollBack();
            $notification = Notification::Notification('Error', 'error');
            return redirect('userData.show')->with('notification', $notification);
        }
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
