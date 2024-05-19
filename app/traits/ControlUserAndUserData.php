<?php

namespace App\Traits;

trait ControlUserAndUserData{
    public function controlMobile($mobile){
        $msgError='';
        $msgError=strlen($mobile)<10?'El teléfono debe tener 10 caracteres':'';
        return $msgError;
    }

    public function controlDni($dni,$userData){
        $errorMsg='';
        //$userData=UserData::where('dni',$dni)->where('user_id','!=',auth()->user()->id)->first();
        if(!is_null($userData)) $errorMsg='El dni ya existe';
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
}