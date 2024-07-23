<?php

namespace App\Controllers;
use App\Models\jobModel;
//use App\Models\approveModel;
use App\Models\processModel;
use App\Models\subprocessModel;
use App\Models\divisionModel;

class Jsoncontroller extends BaseController
{
public function showjobjson($division=null)
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
       
        
        // $approve = new $approveModel();
        // $approve ->select ('approve_id,approve_tb.status')
        // ->join('job_name','job_tb.job_id = approve_tb.job_id','left');
        // $approve_rs = $approveModel->findAll();

        $returnjob = [
            'division'=> $division_rs1,
            'divisionid'=> $division,
          
        ];
        
        header('Content-Type: application/json');
    echo json_encode( $returnjob );
    }
}