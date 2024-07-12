<?php

namespace App\Controllers;


use App\Models\jobModel;
use App\Models\approveModel;
use App\Models\processModel;
use App\Models\subprocessModel;
use App\Models\divisionModel;
use App\Libraries\Date;
use App\Libraries\Ckedit;
use Exception;

class Home extends BaseController
{
  

    public function login()
    {
        
        return view('spica/page/login/login');
        // $this->load->library('Auth_Ldap');
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
        ->join("job_tb","division_tb.division_id = job_tb.division_id","left")
        ->where("division_tb.division_status!=",'1'); //แสดงหน่วยงานต้องส่งมอบงาน
        // if($_SESSION['usertbl']['level'] != 'admin'){
        //     $divisionmodel ->where("division_tb.division_id",$_SESSION['usertbl']['division_id']);
        // }
        $divisionmodel->groupBy('division_tb.division_id,division_tb.division_name,division_tb.division_status')
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
            ->groupBy('job_tb.job_id,job_tb.job_name,status');
            // ->orderBy('job_start','asc');
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
        $rs_datenow1 = new Date();
        $rs_datenow = $rs_datenow1->Datethaifull(date("Y-m-d"));
        $return = [
            'job' => $dv_rs,
            'total_ts' => $total_ts, //ส่งค่าตัวแปรเก็บค่าหน่วยงานที่ทำงานเสร็จแล้ว
            'total_c' => $total_c, //$total_c-total_s นำตัวแปรนับทั้งหมดทุกหน่วยงานไปแสดงผลที่หน้า index
            'total_a' => $total_a,
            'total_p' => $total_p,
            'total_w' => $total_w,
            'total_s' => $total_s,
            'datenow' => $rs_datenow
        ];
        return view('spica/index',$return);
    }

    //ดู job
    public function showjob($division=null)
    {
        
        $divisionmodel1 = new divisionModel();
       
        $divisionmodel1  ->select('division_tb.division_id,division_tb.division_name,division_status')
        ->where("division_tb.division_status!=",'1'); //แสดงหน่วยงานต้องส่งมอบงาน
        // if($_SESSION['usertbl']['level'] != 'admin'){
        //     $divisionmodel1 ->where("division_tb.division_id",$_SESSION['usertbl']['division_id']);
        // }
       $divisionmodel1->groupBy('division_tb.division_id,division_tb.division_name,division_status')
        ->orderBy('division_tb.division_id','asc');
        $division_rs1 = $divisionmodel1->findAll();
        $rs_datenow1 = new Date();
        $rs_datenow = $rs_datenow1->Datethaifull(date("Y-m-d"));
        
        // $approve = new $approveModel();
        // $approve ->select ('approve_id,approve_tb.status')
        // ->join('job_name','job_tb.job_id = approve_tb.job_id','left');
        // $approve_rs = $approveModel->findAll();

        $returnjob = [
            'division'=> $division_rs1,
            'divisionid'=> $division,
            'datenow'=>$rs_datenow
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
        $divisionid1 = $this->request->getVar('division_id');
        $jobmodel1 = new jobModel();
        $jobmodel1  ->select('job_id,job_name,job_start,job_end,status,job_finish,job_end-CURRENT_DATE as dateremain', false)
        ->where('delete_flag' ,'1') // ไม่แสดงข้อมูลที่ลบ (ลบไม่จริง)
        ->where('job_tb.division_id', $divisionid1 )
        ->groupBy('job_id,job_name,job_start,job_end,status,job_finish,dateremain')
        ->orderBy('job_id','asc');
        $job_rs1 = $jobmodel1->findAll();
        $dateth = new Date();
        foreach($job_rs1 as $key => $date_th){
            $job_rs1[$key]['job_start'] = $dateth->DateThai($date_th['job_start']);
            $job_rs1[$key]['job_end'] = $dateth->DateThai($date_th['job_end']); 
        }
        $can = new Ckedit();
        $cedit = $can->ckcan($divisionid1);
        $return = [
            'division'=> $division_rs1,
            'job'=> $job_rs1,
            'flag'=>'afterselect',
            'cedit'=>$cedit,

        ];
        header('Content-Type: application/json');
        echo json_encode( $return );
        //  return view('spica/page/showjob',$return);
    }
   
    //คลิก job ดู process
    public function showjobselect($job_id=null)
    {
        $rs_datenow1 = new Date();
        $rs_datenow = $rs_datenow1->Datethaifull(date("Y-m-d"));
        $jobmodel1 = new jobModel();
        $jobdivision = $jobmodel1 ->select('division_id')
        ->where('job_id',$job_id)
        ->first();
        $jobmodel1  ->select('job_tb.job_id,job_tb.job_name,status,job_finish')
        // -> select ('CURRENT_DATE-job_end as dateremain')
        ->where('job_tb.division_id', $jobdivision["division_id"] )
        ->where('delete_flag', '1') 
        ->groupBy('job_tb.job_id,job_tb.job_name,status,job_finish')
        ->orderBy('job_id','asc');
        $job_rs1 = $jobmodel1->findAll();
        foreach($job_rs1 as $key => $str_th){
            if(strlen($job_rs1[$key]['job_name']) > 150){
                $job_rs1[$key]['job_name'] = mb_substr($str_th['job_name'], 0, 152).'...';
            }
        }
        $can = new Ckedit();
        $cedit = $can->ckcan($jobdivision["division_id"]);
        $return = [
            'job'=> $job_rs1,
            'job_id'=> $job_id,
            'cedit'=>$cedit,
        ];

        return view('spica/page/showprocess',$return);
    }
    // คลิกดูprocess จาก job
    public function showjobselect1($job_id)
    {
        $jobmodel1 = new jobModel();
        $jobdivision = $jobmodel1 ->select('division_id')
        ->where('job_id',$job_id)
        ->first();
        $jobmodel1  ->select('job_tb.job_id,job_tb.job_name,status,job_finish')
        // -> select ('CURRENT_DATE-job_end as dateremain')
        ->where('job_tb.division_id', $jobdivision["division_id"] )
        ->where('delete_flag', '1') 
        ->groupBy('job_tb.job_id,job_tb.job_name,status,job_finish')
        ->orderBy('job_id','asc');
        $job_rs1 = $jobmodel1->findAll();
        foreach($job_rs1 as $key => $str_th){
            if(strlen($job_rs1['job_name']) > 150){
                $job_rs1[$key]['job_name'] = mb_substr($str_th['job_name'], 0, 152).'...';
            }
        }
        $return = [
            'job'=> $job_rs1,
            // 'job_id'=> $job_id
        ];

        return view('spica/page/showprocess',$return);
    }

// เพิ่มหัวข้อ
public function addjob()
{
    try {
        $addjobmodel1 = new jobModel();
        $data = array('job_name'=>$_POST['jobname'],
        'job_start'=>$_POST['jobstart'],
        'job_end'=>$_POST['jobend'],
        'create_by'=>$_SESSION['usertbl']['user_name'],
        'created_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
        'division_id'=>$_SESSION['usertbl']['division_id'],
        'status'=>'1',
        'delete_flag'=>'1',);
        // print_r($data);
        // exit;
        $success = $addjobmodel1 -> insert($data);
        if($success){
            return $this->response->setJson(['success'=>$success]);
        }
        else{
            return $this->response->setJson(['error'=>'fail']);
        }
    } catch (Exception $e) {
        return $this->response->setJson(['error'=>$e->getMessage()]);
        echo $e->getMessage();
    }
    // $return = [

    // ];
}
// ส่งข้อมูลไป form แก้ไข job
public function updatejobform()
{
    $updatejobmodel = new jobModel();
    $dateth = new Date();
    $updatejobmodel ->select('job_tb.job_id,job_tb.job_name,job_start,job_end,status,division_id')
        ->where('job_id',$_POST['jobid']);
        $updatejobmodel_rs = $updatejobmodel->first();
        $updatejobmodel_rs["job_start"] = $dateth->Dateinpickerth($updatejobmodel_rs['job_start']);
        $updatejobmodel_rs["job_end"] = $dateth->Dateinpickerth($updatejobmodel_rs['job_end']);
        //array_push//($updatejobmodel_rs ,$datestart,$dateend);
        $processsql = new processModel();
        $processsql->select('process_tb.process_id,process_tb.process_name,process_tb.process_start,process_tb.process_end,process_tb.process_finish,process_tb.detail,process_tb.status')
            ->where('process_tb.delete_flag', '1')
            ->where('process_tb.job_id', $_POST['jobid']);
        $process_rs = $processsql->findAll();
        foreach ($process_rs as $key1 => $date_th) {
            $process_rs[$key1]['process_start'] = $dateth->DateThai($date_th['process_start']);
            $process_rs[$key1]['process_end'] = $dateth->DateThai($date_th['process_end']);
        }
      
        $can = new Ckedit();
        $cedit = $can->ckcan($updatejobmodel_rs["division_id"]);
        $data = [
            'job'=> $updatejobmodel_rs,
            'process'=> $process_rs,
            'cedit'=>$cedit,
        ];
        header('Content-Type: application/json');
        echo json_encode( $data );

}   

// แก้ไข  job (update)
public function editjob()
{
    print_r($_POST);
    try {
    $editjobmodel = new jobmodel();
    $jobid1 = $this->request->getVar('editjobid');
    // $dataedit = array('status'=>'2');
    // $editjobmodel ->set($dataedit) ->where('status',$_POST['job_id']) -> update();
    $dataedit = array('job_name'=>$_POST['editjobname'],
    'job_start'=>$_POST['editjobstart'],
    'job_end'=>$_POST['editjobend'],
    'updated_at'=>date('Y-m-d H:i:s', strtotime('7 hour')),
    );
    // 'status'=>'1');
    // $editjobmodel -> update($dataedit);
    $success=$editjobmodel ->set($dataedit) ->where('job_id',$_POST['editjobid'] ) -> update();
  
    if($success){
        return $this->response->setJson(['success'=>$success]);
        
    }
    else{
        return $this->response->setJson(['error'=>'fail']);
    }
    } catch (Exception $e) {
        return $this->response->setJson(['error'=>$e->getMessage()]);
        echo $e->getMessage();
}

}

//ลบหัวข้อ job
public function deletejob()
{ 
    try {
    $deletejob = new jobModel();
    
    $data = array('delete_flag'=>'0',
                    'deleted_at'=>date('Y-m-d H:i:s', strtotime('7 hour'))
                );
    $success = $deletejob ->set($data) ->where('job_id',$_POST['job_id']) -> update();
    if($success){

        return $this->response->setJson(['success'=>$success]);
        //55
    }
    else{
        return $this->response->setJson(['error'=>'fail']);
    }
    } catch (Exception $e) {
        return $this->response->setJson(['error'=>$e->getMessage()]);
        echo $e->getMessage();
}
    // echo $datajob;
    // exit;  
}
// หน้า showprocess เลือกjob
public function showprocess(){
    $jobmodel = new jobModel();
    $jobid1 = $this->request->getVar('jobid1');
    $jobdivision = $jobmodel ->select('division_id')
    ->where('job_id',$jobid1)
    ->first();    
    $jobmodel  ->select('job_tb.job_id,job_tb.job_name')
    ->where('job_tb.division_id',  $jobdivision["division_id"] )
    ->where('delete_flag !=','0')
    ->groupBy('job_tb.job_id,job_tb.job_name ')
    ->orderBy('job_id','asc');
    $job_rs = $jobmodel->findAll();
    $processmodel = new processModel();
    $processmodel ->select('process_tb.job_id,process_id,process_name,process_start,process_end,detail, process_tb.process_status,process_tb.status ,
     count(status = 1 OR NULL) AS cc
    , count(status = 2 OR NULL) AS cf ')
    ->where('delete_flag', '1') 
    // ->where('process_finish ',NULL)
    ->where('process_tb.job_id', $jobid1 )
    ->groupBy('process_tb.job_id,process_id,process_name,process_start,process_end,detail, process_tb.process_status,process_tb.status ')
    ->orderBy('process_start','asc');

    $process_rs = $processmodel->findAll();

    $dateth = new Date();
    foreach($process_rs as $key => $date_th){
        $process_rs[$key]['process_start'] = $dateth->Dateinpickerth($date_th['process_start']);
        $process_rs[$key]['process_end'] = $dateth->Dateinpickerth($date_th['process_end']);
    }
   
    $can = new Ckedit();
    $cedit = $can->ckcan($jobdivision["division_id"]);
    if($_SESSION['usertbl']['division_id'] == $jobdivision["division_id"]){
    $showckcan = 1;
    }else{
        $showckcan = 0;
    }
    // foreach($processfinish_rs as $key => $date_th){
    //     $processfinfish_rs[$key]['process_start'] = $dateth->DateThai($date_th['process_start']);
    //     $processfinfish_rs[$key]['process_end'] = $dateth->DateThai($date_th['process_end']);
    // }
    $jobmodel  ->select('job_tb.status')
    ->where('job_tb.job_id',  $jobid1)
    ->where('delete_flag !=','0');
    $job_status = $jobmodel->first();
    $data = [
        'job'=> $job_rs,
        'job_status' => $job_status,
        'process' => $process_rs ,
       'job_id'=>$jobid1,
       'cedit'=>$cedit,
       'showckcan'=>$showckcan,

       
    ];
    header('Content-Type: application/json');
     echo json_encode( $data );
    
}
    // หน้าเพิ่ม process
    public function formprocess($job_id){
        $jobmodel = new jobModel();
        $jobdivisionid = $jobmodel ->select('division_id')
        ->where('job_id',$job_id)
        ->first();
        $jobid1 = $this->request->getVar('jobid1');
        $jobmodel  ->select('job_tb.job_id,job_tb.job_name,job_tb.job_start,job_tb.job_end,job_tb.division_id,job_tb.status as j_status ')
        ->where('job_tb.division_id ', $jobdivisionid["division_id"])
       
        ->where('job_tb.job_id', $job_id )
        ->groupBy('job_tb.job_id,job_tb.job_name ')
        ->orderBy('job_id','asc');
        $job_rs = $jobmodel->first();
        $dateth = new Date();
      
            $job_rs['job_start'] = $dateth->DateThai($job_rs['job_start']);
            $job_rs['job_end'] = $dateth->DateThai($job_rs['job_end']);
            // $job_rs['job_startpic'] = $dateth->Dateinpicker($job_rs['job_start']);
            // $job_rs['job_endpic'] = $dateth->Dateinpicker($job_rs['job_end']);
        
        $can = new Ckedit();
        print_r($job_rs);
        // exit;
        $cedit = $can->ckcan($jobdivisionid["division_id"]);
        $data = [
            'job'=> $job_rs,
            'flag'=> 'add',
            'cedit'=>$cedit,
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
    $updateprocessmodel ->select('process_tb.job_id,process_tb.process_id,process_tb.process_name,process_tb.process_start,process_end,detail,process_tb.status as p_status')
    ->where('process_tb.process_id', $process_id )
    ->where('process_tb.delete_flag', '1') ;
    // ->groupBy('job_tb.job_id,process_tb.process_id,process_tb.process_name,process_start,process_end,detail, process_tb.process_status,process_tb.status,job_tb.division_id ');
    $process_rs = $updateprocessmodel->first();
   
    $updatejobmodel = new jobModel();
    $updatejobmodel -> select('job_tb.job_id,job_tb.job_name,job_tb.job_start,job_tb.job_end,job_tb.division_id,job_tb.status as j_status')
    ->where('job_tb.job_id', $process_rs['job_id'] )
    ->where('job_tb.delete_flag', '1') ;
    $job_rs = $updatejobmodel->first();
    if(($job_rs["j_status"]=='3' || $job_rs["j_status"]=='4') || ($process_rs["p_status"]==2) ){
            $text = 'view';
    }else{
        $text = 'update';
    }
//     echo $text;
//    exit;
    $dateth = new Date();
   
    $job_rs['job_start'] = $dateth->DateThai($job_rs['job_start']);
    $job_rs['job_end'] = $dateth->DateThai($job_rs['job_end']);
    // $job_rs['job_startpic'] = $dateth->Dateinpicker($job_rs['job_start']);
    // $job_rs['job_endpic'] = $dateth->Dateinpicker($job_rs['job_end']);

 
    
        $process_rs['process_start'] = $dateth->Dateinpickerth($process_rs['process_start']);
        $process_rs['process_end'] = $dateth->Dateinpickerth($process_rs['process_end']);
      

    $updatesubprocessmodel = new subprocessModel();
    $updatesubprocessmodel ->select('subprocess_id,subprocess_name,subprocess_start,subprocess_end,subprocess_finish')
                           ->where('process_id',$process_id);
    $subprocess_rs1 = $updatesubprocessmodel->findAll();
    foreach($subprocess_rs1 as $key => $date_th){
        $subprocess_rs1[$key]['subprocess_start'] = $dateth->Dateinpickerth($date_th['subprocess_start']);
        $subprocess_rs1[$key]['subprocess_end'] = $dateth->Dateinpickerth($date_th['subprocess_start']);
    }
    $can = new Ckedit();
    $cedit = $can->ckcan($job_rs["division_id"]);
    $returndata = [
        'job'=> $job_rs,
        'process'=> $process_rs,
        'subprocess' =>$subprocess_rs1,
        'flag' => $text,
        'cedit' => $cedit,
    ];
    // print_r($subprocess_rs1);
    // exit;
   
    return view('spica/page/formprocess',$returndata);
}
// insert subprocess
public function addsubprocess(){
            $addsubprocessmodel = new subprocessModel();
    
            
                $s = explode("/",$_POST['s_sub_date']);
                $e = explode("/",$_POST['e_sub_date']);
                $subprocessstart = $s[2]-543..'-'.$s[1].'-'.$s[0];
                $subprocessend = $e[2]-543..'-'.$e[1].'-'.$e[0];
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
            if(isset($process_id)){
            $showsubprocees = new subprocessModel();
            $showsubprocees ->where('subprocess_tb.delete_flag', '1') 
        ->where('subprocess_tb.process_id', $process_id )
        ->orderBy('subprocess_start','asc');
        $process_rs = $showsubprocees->findAll();
        print_r($process_rs);
        header('Content-Type: application/json');
        
        echo json_encode( $process_rs );
         }
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


