<?php

namespace App\Controllers;
use App\Models\firstModel;
use App\Models\jobModel;
//use App\Models\approveModel;
use App\Models\processModel;
use App\Models\subprocessModel;
use App\Controllers\Date;
use Hermawan\DataTables\DataTable;

class Home extends BaseController
{

    public function index()
    {
        $jobmodel1 = new jobModel();
        $jobmodel1  ->select('job_tb.job_id,job_tb.job_name,status ')
        // ->where('job_tb.division_id = 1' )
        ->groupBy('job_tb.job_id,job_tb.job_name,status ')
        ->orderBy('job_id','asc');
        $job_rs1 = $jobmodel1->findAll();

        $return = [
            'job'=> $job_rs1

        ];
        return view('spica/index',$return);
    }
    public function showjob()
    {
        $jobmodel1 = new jobModel();
        $jobmodel1  ->select('job_tb.job_id,job_tb.job_name,job_start,job_end,status,job_finish')
        // ->where('job_tb.division_id = 1' )
        //->where('job_finish' != NULL )
        //->where('status' == 2 )
        ->groupBy('job_tb.job_id,job_tb.job_name,status,job_finish')
        ->orderBy('job_id','asc');
        $job_rs1 = $jobmodel1->findAll();
        $dateth = new Date();
        foreach($job_rs1 as $key => $date_th){
            $job_rs1[$key]['job_start'] = $dateth->DateThai($date_th['job_start']);
            $job_rs1[$key]['job_end'] = $dateth->DateThai($date_th['job_end']);
        }
        // $approve = new $approveModel();
        // $approve ->select ('approve_id,approve_tb.status')
        // ->join('job_name','job_tb.job_id = approve_tb.job_id','left');
        // $approve_rs = $approveModel->findAll();

        $return = [
            'job'=> $job_rs1
            // 'approve'=> $approve_rs
        ];
        // header('Content-Type: application/json');
        //  json_encode( $return );
        return view('spica/page/showjob',$return);
    }
    public function showprocess(){
        $jobmodel = new jobModel();
        $jobmodel  ->select('job_tb.job_id,job_tb.job_name ')
        ->where('job_tb.division_id = 1' )
        ->groupBy('job_tb.job_id,job_tb.job_name ')
        ->orderBy('job_id','asc');
        $job_rs = $jobmodel->findAll();
        $jobid1 = $this->request->getVar('jobid1');
        $processmodel = new processModel();
        $processmodel ->select('process_tb.job_id,process_id,process_name,process_start,process_end,detail, process_tb.process_status')
        ->where('delete_flag', '1') 
        ->where('process_tb.job_id', $jobid1 )
        ->groupBy('process_tb.job_id,process_tb.process_id,process_tb.process_name,process_start,process_end,detail, process_tb.process_status ')
        ->orderBy('process_start','asc');

        $process_rs = $processmodel->findAll();
        $dateth = new Date();
        foreach($process_rs as $key => $date_th){
            $process_rs[$key]['process_start'] = $dateth->DateThai($date_th['process_start']);
            $process_rs[$key]['process_end'] = $dateth->DateThai($date_th['process_end']);
        }
        
        $data = [
            'job'=> $job_rs,
            'process' => $process_rs

        ];
        header('Content-Type: application/json');
         echo json_encode( $data );
        
    }

    public function showjobselect($job_id=null)
    {
        $jobmodel1 = new jobModel();
        $jobmodel1  ->select('job_tb.job_id,job_tb.job_name,status,job_finish')
        //->where('job_tb.job_id', $job_id )
        ->groupBy('job_tb.job_id,job_tb.job_name,status,job_finish')
        ->orderBy('job_id','asc');
        $job_rs1 = $jobmodel1->findAll();
        $return = [
            'job'=> $job_rs1,
            'job_id'=> $job_id
        ];

        return view('spica/page/showprocess',$return);
    }

    public function formaddprocess($job_id){
        $jobmodel = new jobModel();
        $jobmodel  ->select('job_tb.job_id,job_tb.job_name,job_start,job_end,status ')
        ->where('job_tb.division_id ', 1)
        // $jobid1 = $this->request->getVar('jobid1');
        ->where('job_tb.job_id', $job_id )
        ->groupBy('job_tb.job_id,job_tb.job_name ')
        ->orderBy('job_id','asc');
        $job_rs = $jobmodel->findAll();
        $dateth = new Date();
        foreach($job_rs as $key => $date_th){
            $job_rs[$key]['job_start'] = $dateth->DateThai($date_th['job_start']);
            $job_rs[$key]['job_end'] = $dateth->DateThai($date_th['job_end']);
        }
        
        $data = [
            'job'=> $job_rs,
        ];
        if($job_id !=''){
        return view('spica/page/formaddprocess',$data);
    }
    }

    // เพิ่มหัวข้อ
    public function addjob()
    {
        $processmodel = new processModel();
        $processmodel ->select('process_id,process_name,process_start,process_end,detail, process_tb.process_status')
        ->where('delete_flag', '1') 
        ->groupBy('process_tb.process_id,process_tb.process_name,process_start,process_end,detail, process_tb.process_status ')
        ->orderBy('process_start','asc');

        $process_rs = $processmodel->findAll();
  
        $addjobmodel1 = new jobModel();
        $data = array('job_name'=>$_POST['jobname'],
        'job_start'=>$_POST['jobstart'],
        'job_end'=>$_POST['jobend'],
        'status'=>'1');
        $addjobmodel1 -> insert($data);
        // $return = [

        // ];
    }

    public function editjob()
    {
        $editjobmodel = new jobmodel();
        // $dataedit = array('status'=>'2');
        // $editjobmodel ->set($dataedit) ->where('status',$_POST['job_id']) -> update();
        $dataedit = array('job_name'=>$_POST['editjobname'],
        'job_start'=>$_POST['editjobstart'],
        'job_end'=>$_POST['editjobend']);
        // 'status'=>'1');
        // $editjobmodel -> update($dataedit);
        $editjobmodel ->set($dataedit) ->where($_POST['job_id']) -> update();
    }

    public function updatejob()
    {
        $updatejobmodel = new jobModel();
        $dateth = new Date();
        $updatejobmodel ->select('job_tb.job_id,job_tb.job_name,job_start,job_end')
            ->where('job_id',$_POST['jobid']);
            $updatejobmodel_rs = $updatejobmodel->first();
            $updatejobmodel_rs["job_start"] = $dateth->Dateinpicker($updatejobmodel_rs['job_start']);
            $updatejobmodel_rs["job_end"] = $dateth->Dateinpicker($updatejobmodel_rs['job_end']);
            //array_push//($updatejobmodel_rs ,$datestart,$dateend);
            header('Content-Type: application/json');
            echo json_encode( $updatejobmodel_rs );

    }   
    public function insertprocess()
    {
        // print_r($_POST['e_sub_date']);
        // exit;
        $addprocessmodel = new processModel();
        $data = array('job_id'=>$_POST['job_id'],
        'process_name'=>$_POST['process_name'],
        // 'process_start'=>$_POST['process_start'],
        // 'process_end'=>$_POST['process_end'],
        'detail'=>$_POST['detail'],
        'status'=>'1');
        $addprocessmodel -> insert($data);
        if($_POST['subprocessinput'] != ''){
        $lastprocessid = $addprocessmodel -> getInsertID();
        $addsubprocessmodel = new subprocessModel();
    
        foreach ($_POST['subprocessinput'] as $key => $subprocessname) {
            $s = explode("/",$_POST['s_sub_date'][$key]);
            $e = explode("/",$_POST['e_sub_date'][$key]);
            $subprocessstart = $s[2].'-'.$s[1].'-'.$s[0];
            $subprocessend = $e[2].'-'.$e[1].'-'.$e[0];
            $subprocess_data = [
               
             'job_id' => $_POST['job_id'],
             'process_id' => $lastprocessid,
             'subprocess_name' => $subprocessname,
             'subprocess_start' => $subprocessstart,
             'subprocess_end' => $subprocessend
            ];
            
             $addsubprocessmodel->insert($subprocess_data);
             
           }
        }
        $updatejob = new jobModel();
        $dataupdate = array('status'=>'2');
       
        $updatejob ->set($dataupdate) ->where('status',$_POST['job_id']) -> update();
        $returndata = [
            'job'=> $_POST['job_id'],
        ];
        return view('spica/page/showprocess',$returndata);
    }
// formupdateprocess
public function formupdateprocess($process_id)
{
    // print_r($process_id);
    // exit;
    $updateprocessmodel = new processModel();
    $updateprocessmodel ->select('job_tb.job_id,job_tb.job_name,job_tb.job_start,job_tb.job_end')
    ->select('process_tb.process_id,process_tb.process_name,process_tb.process_start,process_end,detail')
    ->join('job_tb','job_tb.job_id = process_tb.job_id','inner')
    ->where('process_tb.process_id', $process_id )
    ->where('delete_flag', '1') 
    ->groupBy('job_tb.job_id,process_tb.process_id,process_tb.process_name,process_start,process_end,detail, process_tb.process_status ');
    $process_rs1 = $updateprocessmodel->findAll();
    $dateth = new Date();
    foreach($process_rs1 as $key => $date_th){
        $process_rs1[$key]['job_start'] = $dateth->DateThai($date_th['job_start']);
        $process_rs1[$key]['job_end'] = $dateth->DateThai($date_th['job_end']);
        $process_rs1[$key]['process_start'] = $dateth->Dateinpicker($date_th['process_start']);
        $process_rs1[$key]['process_end'] = $dateth->Dateinpicker($date_th['process_end']);
      
    }
    $updatesubprocessmodel = new subprocessModel();
    $updatesubprocessmodel ->select('subprocess_id,subprocess_name,subprocess_start,subprocess_end')
                           ->where('process_id',$process_id);
    $subprocess_rs1 = $updatesubprocessmodel->findAll();
    foreach($subprocess_rs1 as $key => $date_th){
        $subprocess_rs1[$key]['subprocess_start'] = $dateth->Dateinpicker($date_th['subprocess_start']);
        $subprocess_rs1[$key]['subprocess_end'] = $dateth->Dateinpicker($date_th['subprocess_start']);
    }
    $returndata = [
        'job'=> $process_rs1,
        'subprocess' =>$subprocess_rs1,
        'flag' => 'update',
    ];
    // print_r($returndata);
    // exit;
   
    return view('spica/page/formupdateprocess',$returndata);
}
}

    // public function edit($process_id)
    // {
        
    //     $processmodel = new processModel();
    //     $processmodel ->select('process_id,process_name,process_start,process_end,detail, process_tb.process_status')
    //     ->where('delete_flag', '1') 
    //     ->where('process_tb.job_id', $jobid1 )
    //     ->groupBy('process_tb.process_id,process_tb.process_name,process_start,process_end,detail, process_tb.process_status ')
    //     ->orderBy('process_start','asc');

    //     $process_rs = $processmodel->findAll();
    
    //   $return = [
    //     'title' => 'แก้ไข',
    //     'agenda_types' => $agenda_types,
    //     'agenda' => $agenda,
    //     'attachments' => $attachments,
    //   ];
    //   return view('meeting/agenda/form', $return);
    // }


