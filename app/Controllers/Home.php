<?php

namespace App\Controllers;
use App\Models\firstModel;
use App\Models\jobModel;
use App\Models\processModel;
use Hermawan\DataTables\DataTable;

class Home extends BaseController
{
    public function index()
    {
        $jobmodel1 = new jobModel();
        $jobmodel1  ->select('job_tb.job_id,job_tb.job_name,status ')
        // ->where('job_tb.division_id = 1' )
        ->groupBy('job_tb.job_id,job_tb.job_name ')
        ->orderBy('job_id','asc');

        $job_rs1 = $jobmodel1->findAll();
        $return = [
            'job'=> $job_rs1

        ];
        return view('spica/index',$return);
    }
    public function showprocess(){
        $jobmodel = new jobModel();
        $jobmodel  ->select('job_tb.job_id,job_tb.job_name ')
        ->where('job_tb.division_id = 1' )
        ->groupBy('job_tb.job_id,job_tb.job_name ')
        ->orderBy('job_id','asc');
        $job_rs = $jobmodel->findAll();

        $processmodel = new processModel();
        $processmodel ->select('process_id,process_name,process_start,process_end,detail, process_tb.process_status ')
        ->where('delete_flag = 1 and process_tb.job_id = 1' )
        ->groupBy('process_tb.process_id,process_tb.process_name,process_start,process_end,detail, process_tb.process_status ')
        ->orderBy('process_start','asc');

        $process_rs = $processmodel->findAll();
        $data = [
            'job'=> $job_rs,
            'process' => $process_rs

        ];
        return view('spica/page/showprocess',$data);
        
    }
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
