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
    public function listjobapprove($d_id){
        $jobselect = new jobModel();
        $jobselect ->select('job_id,job_name,job_start,job_finish,status')
        ->where('job_tb.delete_flag','1')
        ->where('job_tb.division_id',$d_id);
        $job_rs = $jobselect->findAll();
        $returndata = [
            'showjob'=>$job_rs,
            
        ];
        return view('spica/page/manager/listjobapprove',$returndata);
    }
   public function detailapprove(){
    $job_id = $this->request->getVar('job_id');
    $job_sql = new jobModel();
    $job_sql ->select('job_id,job_name,job_start,job_end,job_finish,status')
    ->where('job_tb.delete_flag','1')
    ->where('job_tb.job_id',$job_id)
    ->groupBy('job_id,job_name,job_start,job_finish,status');
    $job_rs = $job_sql->findAll();
    $dateth = new Date();
    foreach($job_rs as $key => $date_th){
        $job_rs[$key]['job_start'] = $dateth->DateThai($date_th['job_start']);
        $job_rs[$key]['job_end'] = $dateth->DateThai($date_th['job_end']);
    }
    $processmodel = new processModel();
    $processmodel ->select('process_tb.process_id,process_tb.process_name,process_tb.process_start,process_tb.process_end,process_tb.process_finish,process_tb.detail,process_tb.status')
    ->where('process_tb.delete_flag', '1') 
    ->where('process_tb.job_id',$job_id);
    $process_rs = $processmodel->findAll();
    $subprocessmodel = new subprocessModel();
        foreach($process_rs as $x => $value){

            $subprocessmodel ->select('subprocess_tb.subprocess_id,subprocess_tb.subprocess_name,subprocess_tb.subprocess_start,subprocess_tb.subprocess_end,subprocess_tb.subprocess_finish,subprocess_tb.subprocess_status')
            ->where('subprocess_tb.delete_flag', '1') 
            ->where('subprocess_tb.process_id',$value["process_id"])
            // ->groupBy('job_tb.job_id,job_tb.job_name,status')
            ->orderBy('subprocess_start','asc');
            $subprocess_rs = $subprocessmodel->findAll();
            $process_rs[$x]["subprocess"] = $subprocess_rs;
            }
    $return = [
        'job'=> $job_rs,
        'process' => $process_rs,
        'flag'=>'afterselect'
    ];
    return $this->response->setJSON($return);
    header('Content-Type: application/json');
    
    echo json_encode( $return );
   }
    public function confirmapprove()
    {
        // echo $process_id;
        // exit;
        // $subprocessid = $_POST['subprocess_id'];
        $subprocessid = $this->request->getVar('subprocessid');
        // print_r ($subprocess_id);
        // $deletesubprocess = new subprocessModel();
        // $datasubprocess = array('delete_flag'=>'0',
        //                       'deleted_at'=>date('Y-m-d H:i:s', strtotime('7 hour'))
        //                     );
        // $deletesubprocess ->set($datasubprocess) ->where('subprocess_id',$subprocessid) -> update();
        
        
       
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