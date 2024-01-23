<?php

namespace App\Controllers;
use App\Models\firstModel;
use App\Models\jobModel;
use App\Models\addjobModel;
//use App\Models\approveModel;
use App\Models\processModel;
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
        $jobmodel1  ->select('job_tb.job_id,job_tb.job_name,status,job_start,job_end,job_finish')
        // ->where('job_tb.division_id = 1' )
        //->where('job_finish' != NULL )
        //->where('status' == 2 )
        ->groupBy('job_tb.job_id,job_tb.job_name,status,job_start,job_end,job_finish')
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
        $processmodel ->select('process_id,process_name,process_start,process_end,detail, process_tb.process_status')
        ->where('delete_flag', '1') 
        ->where('process_tb.job_id', $jobid1 )
        ->groupBy('process_tb.process_id,process_tb.process_name,process_start,process_end,detail, process_tb.process_status ')
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

    // เพิ่มหัวข้อ
    // public function addjob()
    // {
    //     $addjobmodel = new addjobModel();
    //     $addjobmodel -> insert('job_name','job_start','job_end')
    //     $addjob_rs = $addjobmodal -> insert($job_tb);
    //     $return = [

    //     ]
    // }
    public function showdata(){
        
        $firstmodel = new firstModel();
        $firstmodel 
        ->select('orders.OrderID AS id,products.ProductID,Quantity,OrderDate,ProductName,Unit,Price')
        ->join('Order_details','Orders.OrderID = Order_details.OrderID','left')
        ->join('Products','Order_details.ProductID = Products.ProductID','left')
        ->where("OrderDate Between '2022-07-01' AND '2022-08-30'")
        
        ->orderBy('orders.OrderID ASC');
        $product = $firstmodel->findAll();
        $return = [
            'product' => $product
        ];
        return view('spica/page/showdata',$return);
        
    }
  
    
}
