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
        print_r($_POST);
        // exit;
        $data = array('job_id'=>$_POST['job_id'],
        'process_name'=>$_POST['process_name'],
        'process_start'=>$_POST['process_start'],
        'process_end'=>$_POST['process_end'],
        'created_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
        'detail'=>$_POST['detail'],
        'delete_flag'=>'1',
        'status'=>'1');
        
        $addprocessmodel -> insert($data);
         $addprocessmodel -> lastInsertId();
        print_r($addprocessmodel);
        exit();
        $updatejob = new jobModel();
        $dataupdate = array('status'=>'2',
                            'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour'))
        );
       
        $updatejob ->set($dataupdate) ->where('job_id',$job_id) -> update();

        $updateprocessmodel = new processModel();
        $updateprocessmodel ->select('job_tb.job_id,job_tb.job_name,job_tb.job_start,job_tb.job_end')
        ->select('process_tb.process_id,process_tb.process_name,process_tb.process_start,process_end,detail,process_tb.status')
        ->join('job_tb','job_tb.job_id = process_tb.job_id','inner')
        ->where('process_tb.process_id', $addprocessmodel )
        ->where('process_tb.delete_flag', '1') 
        ->groupBy('job_tb.job_id,job_tb.job_name,job_tb.job_start,job_tb.job_end,process_tb.process_id,process_tb.process_name,process_tb.process_start,process_end,detail,process_tb.status ');
        $process_rs1 = $updateprocessmodel->findAll();
        
        // print_r($process_rs1);
        // echo $process_rs1[0]["status"];
        // exit;
        if($process_rs1[0]["status"]=='2'){
                $text = 'view';
        }else{
            $text = 'update';
        }
        $dateth = new Date();
        foreach($process_rs1 as $key => $date_th){
            $process_rs1[$key]['job_start'] = $dateth->DateThai($date_th['job_start']);
            $process_rs1[$key]['job_end'] = $dateth->DateThai($date_th['job_end']);
            $process_rs1[$key]['job_startpic'] = $dateth->Dateinpicker($date_th['job_start']);
            $process_rs1[$key]['job_endpic'] = $dateth->Dateinpicker($date_th['job_end']);
            $process_rs1[$key]['process_start'] = $dateth->Dateinpicker($date_th['process_start']);
            $process_rs1[$key]['process_end'] = $dateth->Dateinpicker($date_th['process_end']);
          
        }
       
        $returndata = [
            'job'=> $process_rs1,
            'flag' => $text,
        ];
       
        return view('spica/page/formprocess',$returndata);
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
}