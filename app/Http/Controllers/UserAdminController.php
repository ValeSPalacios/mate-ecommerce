<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\UserData;
use App\Http\Requests\UserFormRequest;
use App\Helpers\Notification;
use Exception;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


/**
 * Controlador que se encarga de realizar las modificaciones del usuario desde el lado 
 * del administrador que está logueado
 */

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('userdata')->where('id','!=',auth()->user()->id)->get();
        return view('admin.user.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     /*     dd($request); */
        try {
            DB::beginTransaction();


            $validator = Validator::make($request->all(), [
                'first_name'        => 'required|between:1,100',
                'last_name'         => 'required|between:1,100',
                'email'             => 'required|between:3,64|email',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withInput();
            }

           /*  echo "mobile --->  ".$request->mobile; */
            $arrayRemove = array(" " , "(" ,")" , "-");
            $mobile = str_replace($arrayRemove,"",$request->mobile);
    /*         echo "<br> mobile --->  ".$mobile;
            echo '<br> dni: '.$request->dni; */
            $dni = str_replace(".","",$request->dni);
           /*  echo '<br> dni: '.$dni;
            dd('stop'); */
            $role = Role::where('id', $request->role)->first();
            $user = User::create([
                'name'                  => $request->name,
                'username'              => $request->username,
                'email'                 => $request->email,
                'password'              => Hash::make($request->password),
            ]);
            if ($request->file('avatar')) {
                $image = $request->file('avatar');
                $type = $image->getClientOriginalExtension();
                $img = date('Y-m-d-H-i-s') . '-id-' . $user->id . '.' . $type;
                $image->move('image/user/', $img);

                $avatar_image = 'image/user/' . $img;
            } else {
                $avatar_image = '/dist/img/user2-160x160.jpg';
            }
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



            if (!is_null($user && $userData)) {
                $user->assignRole($role->name);
                DB::commit();
                $notification = Notification::Notification('User Successfully Created', 'success');
                return redirect()->route('admin.index')->with('notification', $notification);
            }


        } catch (\Exception $e) {
            /* dd($e); */
            DB::rollBack();
            $notification = Notification::Notification('Error', 'error');
            return redirect('user/create')->with('notification', $notification);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
       
        try {
            DB::beginTransaction();

            $arrayRemove = array(" ","(",")","-");
            $mobile = str_replace($arrayRemove,"",$request->mobile);
            $dni = str_replace(".","",$request->dni);

            //$user->name = $request->name;
            $user->username = $request->username;
            if(!is_null($user->password))$user->password=Hash::make($request->password);
            $user->save();
            $userData = UserData::where('user_id',$user->id)->first();
            $userData->first_name = $request->first_name;
            $userData->last_name = $request->last_name;
            $userData->dni = $dni;
            $userData->address = $request->address;
            $userData->mobile = $mobile;
            $userData->date_of_birth = $request->date_of_birth;
            $userData->save();

            if (!is_null($user && $userData)) {
                DB::commit();
                $notification = Notification::Notification('User Successfully Updated', 'success');
                return redirect()->route('admin.index')->with('notification', $notification);
            }


        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            $notification = Notification::Notification('Error', 'error');
            return redirect('user/list')->with('notification', $notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
     * Search the specified resource from storage.
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




}
