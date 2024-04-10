<?php

namespace App\Controllers;
use App\Models\userModel;

class Authencontroller extends BaseController
{
    public function ckuser()
    {
        $usermodel = new userModel();
        $usermodel ->select('user_name')
       ->where('user_name',$_POST['email']);
       $user_rs = $usermodel->first();
       $passmodel = $usermodel;
       $passmodel ->select('password')
       ->where('password',$_POST['pass']);
       $pass_rs = $passmodel->first();
       if($user_rs == $_POST['email'] && $pass_rs == $_POST['pass']){
        $return = [
        
            'flag'=>'aaaa'
        ];
        header('Content-Type: application/json');
        echo json_encode( $return );
        
        
       }else if($user_rs == $_POST['email'] && $pass_rs == ''){
        $return = [
        
            'flag'=>'bbbb'
        ];
        header('Content-Type: application/json');
        echo json_encode( $return );
       }else{
        $return = [
        
            'flag'=>'cccc'
        ];
        header('Content-Type: application/json');
        echo json_encode( $return );
       }
    }
}    