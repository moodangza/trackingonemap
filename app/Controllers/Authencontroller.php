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
        echo $_POST['username'] . 'password:  ' .md5($_POST['pass'].'onlb+-');
        $usermodel ->select('user_name,password,division_id,level')
       ->where('user_name',$_POST['username']);
       $user_rs = $usermodel->first();
        if(isset($user_rs['division_id']) && $user_rs['division_id'] == '13'){
            if($user_rs['division_id']==13){
                $ldap_au = new LDAPLibrary;
                $ldap_rs = $ldap_au ->login($_POST['username'],$_POST['pass']);
                print_r($ldap_rs);
                // exit;
            if(isset($ldap_rs['user'])){
                
                $arr = [
                    'usertbl' => $user_rs,
                    'userldap' => $ldap_rs,
                ];
            
                $session->set($arr);
                return redirect()->to('/'); 
            }
            if(isset($ldap_rs['error'])){
                return redirect()->to('login'); 
                die(0);
            }
            }elseif(md5($_POST['pass'].'onlb+-') == $user_rs['password']){
                
                $arr = [
                    'usertbl' => $user_rs,
                
                ];
                $session->set($arr);
                return redirect()->to('/'); 
            } else{
                return redirect()->to('login'); 
                die(0);
            }
        }
        else if(md5($_POST['pass'].'onlb+-') == $user_rs['password']) {
     echo 'ไม่ใช่ onlb แต่ login ถูก';
     $arr = [
        'usertbl' => $user_rs,
    
    ];
    $session->set($arr);
            return redirect()->to('/'); 
        }
        else{
            echo 'ไม่ใช่ onlb แต่ login ผิด';
            return redirect()->to('login'); 
            die(0);
        }
    }
    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('login'); 
    }
}    