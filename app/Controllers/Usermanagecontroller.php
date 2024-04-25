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
        if(md5($_POST['password'].'onlb+-') != $ck_rs['password']){
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
    // public function insertprocess()
    // {
    //     // print_r($_POST['e_sub_date']);
    //     // exit;
    //     $addprocessmodel = new processModel();
    //     $job_id = $this->request->getVar('job_id');
    //     // echo $job_id;
    //     // print_r($_POST);
    //     // exit;
    //     $data = array('job_id'=>$_POST['job_id'],
    //     'process_name'=>$_POST['process_name'],
    //     'process_start'=>$_POST['process_start'],
    //     'process_end'=>$_POST['process_end'],
    //     'created_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
    //     'detail'=>$_POST['detail'],
    //     'delete_flag'=>'1',
    //     'status'=>'1',
    //     'create_by'=>$_SESSION['usertbl']['user_name']);
        
    //     $last_id = $addprocessmodel -> insert($data);
         
    //     $updatejob = new jobModel();
    //     $dataupdate = array('status'=>'2',
    //                         'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
    //                         'update_by'=>$_SESSION['usertbl']['user_name']
    //     );
       
    //     $updatejob ->set($dataupdate) ->where('job_id',$job_id) -> update();

       
    //     $returndata = [
    //         'process'=> $last_id,
    //         'flag' => 'update',
    //     ];
    //     header('Content-Type: application/json');
        
    //     echo json_encode( $returndata );
       
    // }
    // public function updateprocess(){
    //     $processid = $this->request->getVar('processid');
    //     $deleteprocess = new processModel();
    //     $dataprocess = array('process_name'=>$_POST[''],
    //                           'process_finish'=>date('Y-m-d'),
    //                           'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
    //                             'status'=>'2',
    //                             'update_by'=>$_SESSION['usertbl']['user_name']
    //                         );
    //     $deleteprocess ->set($dataprocess) ->where('process_id',$processid) -> update();
    // }
    // public function updatesubprocess(){
    //     $subprocessid = $_POST['sub_id'];
    //     $editsubprocess = new subprocessModel();
    //     $dataprocess = array('subprocess_name'=>$_POST['subprocess_name'],
    //                           'subprocess_start'=>$_POST['subprocess_start'],
    //                           'subprocess_end'=>$_POST['subprocess_end'],                  
    //                           'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
    //                           'update_by'=>$_SESSION['usertbl']['user_name']
    // );
    // $editsubprocess ->set($dataprocess) ->where('subprocess_id',$subprocessid) ->update();
    // header('Content-Type: application/json');
        
    // echo json_encode( $editsubprocess );
    // }
    // public function confirmsubprocess(){
    //     $subprocessid = $_POST['subprocessid'];
    //     $confirmsubprocess = new subprocessModel();
    //     $dataprocess = array('subprocess_status'=>'2',
    //                           'subprocess_finish'=>date('Y-m-d'),
    //                           'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
    //                           'update_by'=>$_SESSION['usertbl']['user_name']
    // );
    // $confirmsubprocess ->set($dataprocess) ->where('subprocess_id',$subprocessid) ->update();
    // header('Content-Type: application/json');
        
    // echo json_encode( $confirmsubprocess );
    // }
  
}