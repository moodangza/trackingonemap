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
        $usermodel ->select('user_name,division_id,level')
       ->where('user_name',$_POST['username']);
       $user_rs = $usermodel->first();
       if(isset($user_rs['division_id'])){
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
        }else{
            
            $arr = [
                'usertbl' => $user_rs,
             
            ];
            $session->set($arr);
            return redirect()->to('/'); 
        }
      }else{
        return redirect()->to('login'); 
      }
    }
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('login'); 
    }
}    