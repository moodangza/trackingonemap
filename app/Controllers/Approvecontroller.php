<?php

namespace App\Controllers;
use App\Models\jobModel;
use App\Models\approveModel;
use App\Models\processModel;
use App\Models\subprocessModel;
use App\Models\divisionModel;
use App\Models\statusModel;

class Approvecontroller extends BaseController
{
    public function approvefirstpage(){
        $showdivision = new divisionModel();
        $showdivision ->select('division_id as d_id ,division_name as d_name');
        $divi_rs = $showdivision->findAll();
        
        $showjob = new jobModel();
        // $showstatus = new statusModel();
        
        foreach($divi_rs as $x => $value){
        $showjob ->select(' count(status) as c_job,status')
        ->where('job_tb.delete_flag', '1') 
        ->where('job_tb.division_id',$value["d_id"])
        ->groupBy('status');
        $job_rs = $showjob->findAll();
        $divi_rs[$x]["job"] = $job_rs;
       
        
        }
        $returndata = [
            'divi'=>$divi_rs,
            
        ];
        // header('Content-Type: application/json');
        // echo json_encode( $returndata );
       
        return view('spica/page/manager/showapprove',$returndata);
    }
    public function listjobapprove(){
        $jobselect = new jobModel();
        $jobselect ->select('job_id,job_name,job_start,job_finish')
        ->where('job_tb.delete_flag','1')
        ->where('job_tb.division_id',$_GET["d_id"]);
        return view('spica/page/manager/listjobapprove,status,job_finish');
    }
    public function deleteprocess($process_id)
    {
        // echo $process_id;
        // exit;
        $deleteprocess = new processModel();
        $dataprocess = array('delete_flag'=>'0',
                              'deleted_at'=>date('Y-m-d H:i:s', strtotime('7 hour'))
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
                              'deleted_at'=>date('Y-m-d H:i:s', strtotime('7 hour'))
                            );
        $deletesubprocess ->set($datasubprocess) ->where('subprocess_id',$subprocessid) -> update();
        
        
       
    }
    public function confirmprocess($process_id)
    {
        // echo $process_id;
        // exit;
        $deleteprocess = new processModel();
        $dataprocess = array('delete_flag'=>'1',
                              'process_finish'=>date('Y-m-d'),
                              'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
                                'status'=>'2'
                            );
       
        $deleteprocess ->set($dataprocess) ->where('process_id',$process_id) -> update();
        $deletesubprocess = new subprocessModel();
        $deletesubprocess ->set($dataprocess) ->where('process_id',$process_id) -> update();
        
       
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
        'status'=>'1');
        
        $last_id = $addprocessmodel -> insert($data);
         
        $updatejob = new jobModel();
        $dataupdate = array('status'=>'2',
                            'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour'))
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
                                'status'=>'2'
                            );
        $deleteprocess ->set($dataprocess) ->where('process_id',$processid) -> update();
    }
    public function updatesubprocess(){
        $subprocessid = $_POST['sub_id'];
        $editsubprocess = new subprocessModel();
        $dataprocess = array('subprocess_name'=>$_POST['subprocess_name'],
                              'subprocess_start'=>$_POST['subprocess_start'],
                              'subprocess_end'=>$_POST['subprocess_end'],                  
                              'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour'))
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
                              'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour'))
    );
    $confirmsubprocess ->set($dataprocess) ->where('subprocess_id',$subprocessid) ->update();
    header('Content-Type: application/json');
        
    echo json_encode( $confirmsubprocess );
    }
  
}