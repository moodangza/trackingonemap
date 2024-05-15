<?php

namespace App\Controllers;
use App\Models\jobModel;
//use App\Models\approveModel;
use App\Models\processModel;
use App\Models\subprocessModel;


class Managecontroller extends BaseController
{
    public function deleteprocess($process_id)
    {
        // echo $process_id;
        // exit;
        $deleteprocess = new processModel();
        $dataprocess = array('delete_flag'=>'0',
                              'deleted_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
                            //   'delete_by'=>$_SESSION['usertbl']['user_name']
                            );
       
        $deleteprocess ->set($dataprocess) ->where('process_id',$process_id) -> update();
        $deletesubprocess = new subprocessModel();
        $deletesubprocess ->set($dataprocess) ->where('process_id',$process_id) -> update();
        
       
    }
    public function deletesubprocess()
    {
        // echo $process_id;
        // exit;
        // $subprocessid = $_POST['subprocess_id'];
        $subprocessid = $this->request->getVar('subprocessid');
        // print_r ($subprocess_id);
        $deletesubprocess = new subprocessModel();
        $datasubprocess = array('delete_flag'=>'0',
                              'deleted_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
                            //   'delete_by'=>$_SESSION['usertbl']['user_name']
                            );
        $deletesubprocess ->set($datasubprocess) ->where('subprocess_id',$subprocessid) -> update();
        
        
       
    }
    public function confirmprocess()
    {
        echo  $_POST["process_id"];
        // exit;
        $processid = $this->request->getVar('process_id');
        $confirmprocess = new processModel();
        $dataprocess = array('delete_flag'=>'1',
                              'process_finish'=>date('Y-m-d'),
                              'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
                                'status'=>'2',
                                // 'delete_by'=>$_SESSION['usertbl']['user_name']
                            );
       
        $confirmprocess ->set($dataprocess) ->where('process_id',$processid) -> update();
        $confirmsubprocess = new subprocessModel();
        $datasubprocess = array('delete_flag'=>'1',
        'subprocess_finish'=>date('Y-m-d'),
        'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
          'subprocess_status'=>'2',
          // 'delete_by'=>$_SESSION['usertbl']['user_name']
      );
        $confirmsubprocess ->set($datasubprocess) ->where('process_id',$processid) -> update();
        
       
    }
    public function confirmallprocess()
    {
       
        $job_id = $this->request->getVar('job_id');
        $confirmprocess = new jobModel();
        $dataprocess = array('delete_flag'=>'1',
                             
                              'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
                                'status'=>'3',
                                'update_by'=>$_SESSION['usertbl']['user_name']
                            );
        $confirmprocess ->set($dataprocess) ->where('job_id',$job_id) -> update();
        
       
    }
    public function insertprocess()
    {
        // print_r($_POST['e_sub_date']);
        // exit;
        $addprocessmodel = new processModel();
        $job_id = $this->request->getVar('job_id');
        // echo $job_id;
        // print_r($_POST);
        // exit;
        $data = array('job_id'=>$_POST['job_id'],
        'process_name'=>$_POST['process_name'],
        'process_start'=>$_POST['process_start'],
        'process_end'=>$_POST['process_end'],
        'created_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
        'detail'=>$_POST['detail'],
        'delete_flag'=>'1',
        'status'=>'1',
        // 'create_by'=>$_SESSION['usertbl']['user_name']
    );
        
        $last_id = $addprocessmodel -> insert($data);
         
        $updatejob = new jobModel();
        $dataupdate = array('status'=>'2',
                            'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
                            // 'update_by'=>$_SESSION['usertbl']['user_name']
        );
       
        $updatejob ->set($dataupdate) ->where('job_id',$job_id) -> update();

       
        $returndata = [
            'process'=> $last_id,
            'flag' => 'update',
        ];
        header('Content-Type: application/json');
        
        echo json_encode( $returndata );
       
    }
    public function updateprocess(){
        $processid = $this->request->getVar('processid');
        $deleteprocess = new processModel();
        $dataprocess = array('process_name'=>$_POST[''],
                              'process_finish'=>date('Y-m-d'),
                              'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
                                'status'=>'2',
                                // 'update_by'=>$_SESSION['usertbl']['user_name']
                            );
        $deleteprocess ->set($dataprocess) ->where('process_id',$processid) -> update();
    }
    public function updatesubprocess(){
        $subprocessid = $_POST['sub_id'];
        $editsubprocess = new subprocessModel();
        $dataprocess = array('subprocess_name'=>$_POST['subprocess_name'],
                              'subprocess_start'=>$_POST['subprocess_start'],
                              'subprocess_end'=>$_POST['subprocess_end'],                  
                              'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
                            //   'update_by'=>$_SESSION['usertbl']['user_name']
    );
    $editsubprocess ->set($dataprocess) ->where('subprocess_id',$subprocessid) ->update();
    header('Content-Type: application/json');
        
    echo json_encode( $editsubprocess );
    }
    public function confirmsubprocess(){
        $subprocessid = $_POST['subprocessid'];
        $confirmsubprocess = new subprocessModel();
        $dataprocess = array('subprocess_status'=>'2',
                              'subprocess_finish'=>date('Y-m-d'),
                              'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
                            //   'update_by'=>$_SESSION['usertbl']['user_name']
    );
    $confirmsubprocess ->set($dataprocess) ->where('subprocess_id',$subprocessid) ->update();
    header('Content-Type: application/json');
        
    echo json_encode( $confirmsubprocess );
    }
  
}