<?php

namespace App\Controllers;
use App\Models\userModel;
use App\Libraries\LDAPLibrary;

class Authencontroller extends BaseController
{
    public function ckuser()
    {
        $session = session();
        $usermodel = new userModel();
        echo $_POST['username'] . 'password'. $_POST['pass'];
        $usermodel ->select('user_name,division_id')
       ->where('user_name',$_POST['username']);
       $user_rs = $usermodel->first();
        if($user_rs['division_id']==13){
            $ldap_au = new LDAPLibrary;
            $ldap_rs = $ldap_au ->login($_POST['username'],$_POST['pass']);
            print_r($ldap_rs);
            $arr = [
                'usertbl' => $user_rs,
                'userldap' => $ldap_rs,
            ];
           
            $session->set($arr);
            return redirect()->to('/'); 
        }
        exit();

       $passmodel = $usermodel;
       $passmodel ->select('password')
       ->where('password',$_POST['pass']);
       $pass_rs = $passmodel->first();
    //    echo '<br>'. $user_rs . '   ' . $pass_rs;
       
       if($user_rs["user_name"] == $_POST['username'] && $pass_rs["password"] == $_POST['pass']){
        echo 'aaaa';
       
        exit();
        
       }else if($user_rs["user_name"] == $_POST['username'] && $pass_rs["password"] == ''){
        echo 'bbbb';
       
        exit();
       }else{
        echo 'cccc';
       
        exit();
       }
    }
}    