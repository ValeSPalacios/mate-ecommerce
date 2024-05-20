<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Request;

trait ControlUserAndUserData{
    public function getErrorsMobile($mobile){
        $msgError='';
        $msgError=strlen($mobile)<10?'El teléfono debe tener 10 caracteres':'';
        return $msgError;
    }

    public function getErrorsDni($dni,$userData){
        $errorMsg='';
        //$userData=UserData::where('dni',$dni)->where('user_id','!=',auth()->user()->id)->first();
        //if(!is_null($userData)) $errorMsg='El dni ya existe';
        if($errorMsg=='' && strlen($dni)<8) $errorMsg='El dni debe tener 8 dígitos';
        return $errorMsg;

    }

    public function removeMaskMobile($mobile){
        $arrayRemove = array(" ","(",")","-",'_');
        $cleanMobile = str_replace($arrayRemove,"",$mobile);
        return $cleanMobile;
    }

    public function removeMaskDni($dni){
        $arrayRemove = array(".",'_');
        $cleanDni = str_replace($arrayRemove,"",$dni);
        return $cleanDni;
       
    }

    public function getUrlAvatar($file){
        //dd($file);
        if (!is_null($file)) {
            //$image = $file->file('avatar');
            $type = $file->getClientOriginalExtension();
            $img = date('Y-m-d-H-i-s') . '-id-' . auth()->user()->id . '.' . $type;
            $file->move('image/user/', $img);

            $avatar_image = 'image/user/' . $img;
        } else {
            $avatar_image = 'dist/img/user2-160x160.jpg';
        }
        return $avatar_image;
    }

    /**
     * Retorna el error SQL producido durante la excepción
     * @param String $stringError El mensaje de error que se va a controlar
     * @return Array Retorna un arreglo con los errores y los mensajes de errores
     */
    public function getSQLError($stringError){
        $errorsList=[];
        if(strpos($stringError, 'users_data_dni') !== false) $errorsList['dni']='El dni ya existe';
        return $errorsList;
    }
}