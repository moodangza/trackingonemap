<?php

namespace App\Controllers;
use App\Models\userModel;
use App\Models\divisionModel;


class Usermanagecontroller extends BaseController
{
    public function usermanage()
    {
        $divisionmodel = new divisionModel();
        $divisionmodel ->select('division_id,division_name')
        ->where('division_id',$_SESSION['usertbl']['division_id']);
        $division_rs = $divisionmodel->first();
        $usermodel = new userModel();
        $usermodel ->select('*')
        ->where('user_tb.division_id',$division_rs['division_id']);
       
        $user_rs = $usermodel->findAll();
        $returnuser = [
            'division_rs' =>$division_rs,
            'user_rs'=> $user_rs,
        ];
        return view('spica/page/userpage/usermanage',$returnuser);
       
    }
    public function manageuserform()
    {
        $usermodel = new userModel();
        $userid = $this->request->getVar('user_id');
        $usermodel ->select('user_id,user_name,level,prefix,name,surname,position')
        ->where('user_tb.user_id',$userid);
        $user_rs = $usermodel->findAll();
        $return = [
            'user_rs'=> $user_rs,
            'flag'=>'update',
        ];
        header('Content-Type: application/json');
        echo json_encode( $return );
    }
    public function updateuser()
    {   
        $updateuserid = $this->request->getVar('user_id');
        $ckuser = new userModel();
        $ckuser->select('*')
                ->where('user_tb.user_id',$updateuserid);
                $ck_rs = $ckuser->first();


        $updateusermodel = new userModel();
        if(md5($_POST['password'].'onlb+-') != $ck_rs['password'] && $_POST['password']!=''){
            $password = md5($_POST['password'].'onlb+-');
        }else{ 
            $password =$ck_rs['password'];
        }
        $updateuser = array(

                              'password'=>$password,
                              'level'=>$_POST["level"],
                              'prefix'=> $_POST['prefix'],
                              'name' =>$_POST['name'],
                              'surname' =>$_POST['surname'],
                              'position' =>$_POST['position'],
                            );
                          
        $updateusermodel ->set($updateuser) ->where('user_id',$updateuserid ) -> update();
        $return =[
                'success'=>'success',
        ];
        header('Content-Type: application/json');
        echo json_encode( $return );
        
        
       
    }

    public function adduser()
    {
        // echo $process_id;
        // exit;
        
        $addusermodel = new userModel();
        
        $addeuser = array(
                                'user_name'=> $_POST['user_name'],
                                'password'=> md5($_POST['password'].'onlb+-'),
                                'level'=> $_POST["level"],
                                'prefix'=> $_POST['prefix'],
                                'name' =>$_POST['name'],
                                'surname' =>$_POST['surname'],
                                'position' =>$_POST['position'],
                                'division_id' =>$_SESSION['usertbl']['division_id'],
                            );
                          
        $addusermodel -> insert($addeuser);
        
       
    }
    public function ckdupuser()
    {
        $ckdupuser = new userModel();
        $ckdupuser ->select('user_name')
        ->where('user_name',$_POST['user_name']);
        $rsckdup = $ckdupuser->first();

        if(isset($rsckdup["user_name"]) && $rsckdup["user_name"]==$_POST['user_name']){
            $rs = 'USER_EXISTS';
        }else{
            $rs = 'USER_AVAILABLE';
        }
        $return = [
                    'rs' => $rs,
        ];
        header('Content-Type: application/json');
        echo json_encode( $return );
    } 
}