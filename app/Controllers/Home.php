<?php

namespace App\Controllers;
use App\Models\jobModel;
use App\Models\approveModel;
use App\Models\processModel;
use App\Models\subprocessModel;
use App\Models\divisionModel;
use App\Controllers\Date;

class Home extends BaseController
{
    public function login()
    {
        
        return view('spica/login/index');
    }

    public function index()
    {
        $total_ts=0; //ตัวแปรเก็บค่าหน่วยงานที่ทำงานเสร็จแล้ว
        $total_c=0; //$total_c-total_s ตัวแปรนับทั้งหมดทุกหน่วยงาน
        $total_a=0;
        $total_p=0;
        $total_w=0;
        $total_s=0;
        $divisionmodel = new divisionModel();
        $divisionmodel ->select('division_tb.division_id,division_tb.division_name,division_tb.division_status')
        ->select('count(division_name) as d_division')
        ->select('count(status) as c_job')
        ->select("(select count(*) from job_tb where job_tb.division_id=division_tb.division_id and status = '1' ) As a_job")
        ->select("(select count(*) from job_tb where job_tb.division_id=division_tb.division_id and status = '2' ) As p_job")
        ->select("(select count(*) from job_tb where job_tb.division_id=division_tb.division_id and status = '3' ) As w_job")
        ->select("(select count(*) from job_tb where job_tb.division_id=division_tb.division_id and status = '4' ) As s_job")
        ->where("division_tb.division_status!=",'1')
        ->join("job_tb","division_tb.division_id = job_tb.division_id","left")
        ->groupBy('division_tb.division_id,division_tb.division_name,division_tb.division_status')
        ->orderBy('division_id','asc');
        $dv_rs = $divisionmodel->findAll();
        $jobmodel1 = new jobModel();

        foreach($dv_rs as $x => $value){
            $total_c=$value["c_job"]+$total_c; //$total_c-total_s วนลูป+ตัวแปรนับทั้งหมดทุกหน่วยงาน
            //$total_ts=$value["c_job"=="s_job"]+$total_c=$total_s;
            $total_a=$value["a_job"]+$total_a;
            $total_p=$value["p_job"]+$total_p;
            $total_w=$value["w_job"]+$total_w;
            $total_s=$value["s_job"]+$total_s;

            $jobmodel1 ->select('job_tb.job_id,job_tb.job_name,status')
            ->where('job_tb.delete_flag', '1') 
            ->where('job_tb.division_id',$value["division_id"])
            ->groupBy('job_tb.job_id,job_tb.job_name,status')
            ->orderBy('job_start','asc');
            $job_rs = $jobmodel1->findAll();
            $dv_rs[$x]["job"] = $job_rs;
            if($value["c_job"]-$value["s_job"]=='0'&& $value["c_job"]!='0'&&$value["s_job"]!=0) {
                $total_ts++ ; //คำนวนจำนวนหน่วยงานที่ทำงานเสร็จแล้ว
            }
            //echo $value["division_name"].$value["c_job"]." ".$value["s_job"]."<br>";
            }
            //exit;
        $jobmodel1  ->select('job_tb.job_id,job_tb.job_name,status,division_tb.division_id,division_tb.division_name,job_tb.job_start,job_tb.job_end,job_finish ')
        ->join('division_tb','job_tb.division_id = division_tb.division_id','inner')
        ->where('job_tb.division_id = 1' )
        ->groupBy('job_tb.job_id,job_tb.job_name,status,division_tb.division_id,division_tb.division_name,job_tb.job_start,job_tb.job_end,job_finish ')
        ->orderBy('job_start','asc');

        $return = [
            'job' => $dv_rs,
            'total_ts' => $total_ts, //ส่งค่าตัวแปรเก็บค่าหน่วยงานที่ทำงานเสร็จแล้ว
            'total_c' => $total_c, //$total_c-total_s นำตัวแปรนับทั้งหมดทุกหน่วยงานไปแสดงผลที่หน้า index
            'total_a' => $total_a,
            'total_p' => $total_p,
            'total_w' => $total_w,
            'total_s' => $total_s

        ];
        return view('spica/index',$return);
    }
 
    //ดู job
    public function showjob($division=null)
    {
        $divisionmodel1 = new divisionModel();
        $divisionmodel1  ->select('division_tb.division_id,division_tb.division_name')
        ->groupBy('division_tb.division_id,division_tb.division_name')
        ->orderBy('division_tb.division_id','asc');
        $division_rs1 = $divisionmodel1->findAll();
        
        
        // $approve = new $approveModel();
        // $approve ->select ('approve_id,approve_tb.status')
        // ->join('job_name','job_tb.job_id = approve_tb.job_id','left');
        // $approve_rs = $approveModel->findAll();

        $returnjob = [
            'division'=> $division_rs1,
            'divisionid'=> $division
        ];
        
        return view('spica/page/showjob',$returnjob);
    }
    // แสดงผลหลังเลือก หน่วยงานส่งค่าไปjson
    public function showafterdiv(){
        $divisionmodel1 = new divisionModel();
        $divisionmodel1  ->select('division_tb.division_id,division_tb.division_name')
        ->groupBy('division_tb.division_id,division_tb.division_name')
        ->orderBy('division_tb.division_id','asc');
        $division_rs1 = $divisionmodel1->findAll();

        $divisionid1 = $this->request->getVar('divisionid1');
        $jobmodel1 = new jobModel();
        $jobmodel1  
        ->select('job_tb.job_id,job_tb.job_name,job_start,job_end,status,job_finish,status,job_end-CURRENT_DATE as dateremain', false)
        ->where('delete_flag' ,'1') // ไม่แสดงข้อมูลที่ลบ (ลบไม่จริง)
        ->where('job_tb.division_id', $divisionid1 )
        ->groupBy('job_tb.job_id,job_tb.job_name,status,job_finish,status')
        ->orderBy('job_id','asc')
        ;
        $job_rs1 = $jobmodel1->findAll();
        // print_r($job_rs1);
        $dateth = new Date();
        foreach($job_rs1 as $key => $date_th){
            $job_rs1[$key]['job_start'] = $dateth->DateThai($date_th['job_start']);
            $job_rs1[$key]['job_end'] = $dateth->DateThai($date_th['job_end']);
        }
        $return = [
            'division'=> $division_rs1,
            'job'=> $job_rs1,
            'flag'=>'afterselect'
        ];
        header('Content-Type: application/json');
        echo json_encode( $return );
        //  return view('spica/page/showjob',$return);
    }
   
    //คลิก job ดู process
    public function showjobselect($job_id=null)
    {
        $jobmodel1 = new jobModel();
        $jobmodel1  ->select('job_tb.job_id,job_tb.job_name,status,job_finish')
        // -> select ('CURRENT_DATE-job_end as dateremain')
        ->where('job_tb.division_id', '1' )
        ->where('delete_flag', '1') 
        ->groupBy('job_tb.job_id,job_tb.job_name,status,job_finish')
        ->orderBy('job_id','asc');
        $job_rs1 = $jobmodel1->findAll();
        $return = [
            'job'=> $job_rs1,
            'job_id'=> $job_id
        ];

        return view('spica/page/showprocess',$return);
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
    'created_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
    'status'=>'1');
    $addjobmodel1 -> insert($data);
    // $return = [

    // ];
}
// ส่งข้อมูลไป form แก้ไข job
public function updatejobform()
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

// แก้ไข  job (update)
public function editjob()
{
    $editjobmodel = new jobmodel();
    $jobid1 = $this->request->getVar('editjobid');
    // $dataedit = array('status'=>'2');
    // $editjobmodel ->set($dataedit) ->where('status',$_POST['job_id']) -> update();
    $dataedit = array('job_name'=>$_POST['editjobname'],
    'job_start'=>$_POST['editjobstart'],
    'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
    'job_end'=>$_POST['editjobend']);
    // 'status'=>'1');
    // $editjobmodel -> update($dataedit);
    $u=$editjobmodel ->set($dataedit) ->where('job_id',$jobid1 ) -> update();
    print_r($dataedit);

}

//ลบหัวข้อ job
public function deletejob()
{ 
    $deletejob = new jobModel();
    $datajob = $_POST['job_id'];
    $dataj = array('delete_flag'=>'0','deleted_at'=>date('Y-m-d H:i:s', strtotime('7 hour')));
    // $datajob = ['delete_flag'] = $deletejob ->where('job_id',$datajob['job_id'])-> update();
    $deletejob ->set($dataj) ->where('job_id',$datajob) -> update();
    // echo $datajob;
    // exit;  
}
// หน้า showprocess เลือกjob
public function showprocess(){
    $jobmodel = new jobModel();
    $jobmodel  ->select('job_tb.job_id,job_tb.job_name ')
    ->where('job_tb.division_id',  '1' )
    ->where('delete_flag !=','0')
    ->groupBy('job_tb.job_id,job_tb.job_name ')
    ->orderBy('job_id','asc');
    $job_rs = $jobmodel->findAll();
    $jobid1 = $this->request->getVar('jobid1');

    $processmodel = new processModel();
    $processmodel ->select('process_tb.job_id,process_id,process_name,process_start,process_end,detail, process_tb.process_status')
    ->where('delete_flag', '1') 
    ->where('process_finish ',NULL)
    ->where('process_tb.job_id', $jobid1 )
    ->groupBy('process_tb.job_id,process_tb.process_id,process_tb.process_name,process_start,process_end,detail, process_tb.process_status ')
    ->orderBy('process_start','asc');

    $process_rs = $processmodel->findAll();

    // $processmodel ->select('process_tb.job_id,process_id,process_name,process_start,process_end,detail, process_tb.process_status')
    // ->where('delete_flag', '1') 
    // ->where('process_finish != ',NULL)
    // ->where('process_tb.job_id', $jobid1 )
    // ->groupBy('process_tb.job_id,process_tb.process_id,process_tb.process_name,process_start,process_end,detail, process_tb.process_status ')
    // ->orderBy('process_start','asc');

    // $processfinish_rs = $processmodel->findAll();
    $dateth = new Date();
    foreach($process_rs as $key => $date_th){
        $process_rs[$key]['process_start'] = $dateth->DateThai($date_th['process_start']);
        $process_rs[$key]['process_end'] = $dateth->DateThai($date_th['process_end']);
    }
    // foreach($processfinish_rs as $key => $date_th){
    //     $processfinfish_rs[$key]['process_start'] = $dateth->DateThai($date_th['process_start']);
    //     $processfinfish_rs[$key]['process_end'] = $dateth->DateThai($date_th['process_end']);
    // }
    $data = [
        'job'=> $job_rs,
        'process' => $process_rs ,
        // if()
        // 'processfinish' => $processfinfish_rs,
       
    ];
    header('Content-Type: application/json');
     echo json_encode( $data );
    
}
    // หน้าเพิ่ม process
    public function formprocess($job_id){
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
            $job_rs[$key]['job_startpic'] = $dateth->Dateinpicker($date_th['job_start']);
            $job_rs[$key]['job_endpic'] = $dateth->Dateinpicker($date_th['job_end']);
        }
        
        $data = [
            'job'=> $job_rs,
            'flag'=> 'add'
        ];
            if($job_id !=''){
            return view('spica/page/formprocess',$data);
        }
    }

// เข้าผ่านปุ่มแก้ไขprocess
public function formupdateprocess($process_id){
    // print_r($process_id);
    // exit;
    $updateprocessmodel = new processModel();
    $updateprocessmodel ->select('job_tb.job_id,job_tb.job_name,job_tb.job_start,job_tb.job_end')
    ->select('process_tb.process_id,process_tb.process_name,process_tb.process_start,process_end,detail,process_tb.status')
    ->join('job_tb','job_tb.job_id = process_tb.job_id','inner')
    ->where('process_tb.process_id', $process_id )
    ->where('process_tb.delete_flag', '1') 
    ->groupBy('job_tb.job_id,process_tb.process_id,process_tb.process_name,process_start,process_end,detail, process_tb.process_status,process_tb.status ');
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
    $updatesubprocessmodel = new subprocessModel();
    $updatesubprocessmodel ->select('subprocess_id,subprocess_name,subprocess_start,subprocess_end,subprocess_finish')
                           ->where('process_id',$process_id);
    $subprocess_rs1 = $updatesubprocessmodel->findAll();
    foreach($subprocess_rs1 as $key => $date_th){
        $subprocess_rs1[$key]['subprocess_start'] = $dateth->Dateinpicker($date_th['subprocess_start']);
        $subprocess_rs1[$key]['subprocess_end'] = $dateth->Dateinpicker($date_th['subprocess_start']);
    }
    $returndata = [
        'job'=> $process_rs1,
        'subprocess' =>$subprocess_rs1,
        'flag' => $text,
    ];
    // print_r($returndata);
    // exit;
   
    return view('spica/page/formprocess',$returndata);
}
// insert subprocess
public function addsubprocess(){
            $addsubprocessmodel = new subprocessModel();
    
            
                $s = explode("/",$_POST['s_sub_date']);
                $e = explode("/",$_POST['e_sub_date']);
                $subprocessstart = $s[2].'-'.$s[1].'-'.$s[0];
                $subprocessend = $e[2].'-'.$e[1].'-'.$e[0];
                $subprocess_data = [
                 'job_id' => $_POST['job_id'],
                 'process_id' => $_POST['process_id'],
                 'subprocess_name' => $_POST['sub_process'],
                 'subprocess_start' => $subprocessstart,
                 'subprocess_end' => $subprocessend,
                 'delete_flag' => '1'
                ];
                
              $addsubprocessmodel->insert($subprocess_data);
                 
               
        }
        // แสดง subprocess
        public function showsubprocess(){
            $process_id = $this->request->getVar('process_id');
            $showsubprocees = new subprocessModel();
            $showsubprocees ->where('subprocess_tb.delete_flag', '1') 
        ->where('subprocess_tb.process_id', $process_id )
        ->orderBy('subprocess_start','asc');
        $process_rs = $showsubprocees->findAll();
        print_r($process_rs);
        header('Content-Type: application/json');
        
        echo json_encode( $process_rs );
         
        }
        // แก้ไข subprocess
        public function editsubprocess(){
        $subprocess_id = $this->request->getVar('subprocess_id');
          $form = new subprocessModel();
          $dateth = new Date();
          $form ->where('subprocess_tb.subprocess_id',$subprocess_id);
          $process_rs = $form->findAll();
        //   print_r($process_rs);
        $process_rs["subprocess_id"] = $process_rs[0]["subprocess_id"];
        $process_rs["subprocess_name"] = $process_rs[0]["subprocess_name"];
          $process_rs["subprocess_start"] = $dateth->Dateinpicker($process_rs[0]['subprocess_start']);
          $process_rs["subprocess_end"] = $dateth->Dateinpicker($process_rs[0]['subprocess_end']);
          header('Content-Type: application/json');
          echo json_encode( $process_rs );
          
        }
        // โชว์ approve
        public function showapprove()
    {
        $divisionmodel = new divisionModel();
        $divisionmodel ->select('division_tb.division_id,division_tb.division_name')
        ->orderBy('division_id','asc');
        $dv_rs = $divisionmodel->findAll();
        $jobmodel1 = new jobModel();

        $jobmodel1  ->select('job_tb.job_id,job_tb.job_name,status,division_tb.division_id,division_tb.division_name,job_tb.job_start,job_tb.job_end,job_finish ')
        ->join('division_tb','job_tb.division_id = division_tb.division_id','inner')
        // ->where('job_tb.division_id = 1' )
        ->groupBy('job_tb.job_id,job_tb.job_name,status,division_tb.division_id,division_tb.division_name,job_tb.job_start,job_tb.job_end ')
        ->orderBy('job_start','asc');
        $job_rs1 = $jobmodel1->findAll();
        $dateth = new Date();
        foreach($job_rs1 as $key => $date_th){
            $job_rs1[$key]['job_start'] = $dateth->DateThai($date_th['job_start']);
            $job_rs1[$key]['job_end'] = $dateth->DateThai($date_th['job_end']);
        }
        $return = [
            'dv' => $dv_rs,
            'job' => $job_rs1

        ];
        return view('spica/page/manager/showapprove',$return);
    }
}


