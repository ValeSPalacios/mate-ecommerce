<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use App\Helpers\Notification;
use App\Http\Requests\ProviderRequest;
use Exception;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
 /*        dd($providers ); */
        return view('admin.provider.list',compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.provider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        //dd($request);
        $data = [
            'first_name'    =>$request->first_name,
            'last_name'     =>$request->last_name,
            'dni'           =>$request->dni,
            'address'       =>$request->address,
            'mobile'        =>$request->mobile,
            'user_created'  =>auth()->user()->id,
            'user_updated'  =>auth()->user()->id,
        ];
        $provider = Provider::create($data);
        if(!is_null($provider)){
            $notification = Notification::Notification('Provider Successfully Created', 'success');
            return redirect()->route('admin.provider.index')->with('notification', $notification);
        }
        $notification = Notification::Notification('Error', 'error');
        return redirect()->route('admin.provider.create')->with('notification', $notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $provider=Provider::find($id);
        return view('admin.provider.edit',compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        //
        $existDni=true;
        $notSameDni=$provider->dni!=$request->dni;
        $provider->first_name=$request->first_name;
        $provider->last_name=$request->last_name;
        $provider->address=$request->address;
        $provider->mobile=$request->mobile;
       
        //controlo si el dni mandado no es el mismo que el del usuario que se quiere
        // actualizar
        //si no lo es, compruebo que ese dni no exista en la base de datos
       
        //dd($notSameDni);
        if($notSameDni){
            $existDni=!is_null(Provider::select('dni')->where('dni','=',$request->dni)->where('id','!=',$provider->id));
        }
        
        //dd($existDni);
        //Si el dni no es válido, retorno con error. Si es un dni válido y no es el mismo
        //que el del usuario que está modificándose, lo actualizo.
        if($existDni){
            //dd("entra");
            return redirect()->back()->withInput()->withErrors(['dni'=>'The DNI already exists']);
        }else if($notSameDni && !$existDni){
            $provider->dni=$request->dni;
            
        }
        $provider->save();
        return redirect()->route('admin.provider.index');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      
        $provider=Provider::find($request->providerId);
        if(!is_null($provider)){
            $provider->delete();
            return ['status'=>200];
        }
        return ['status'=>400];
    }

    public function getProviderById(Request $request){
      
        $provider=Provider::find($request->providerId);
        $data=[
            'first_name'=>$provider->first_name,
            'last_name'=>$provider->last_name,
            'dni'=>$provider->dni,
            'address'=>$provider->address,
            'mobile'=>$provider->mobile
        ];

        return ['status'=>200,'data'=>json_encode($data)];
    }
}
