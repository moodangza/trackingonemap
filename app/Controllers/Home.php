<?php

namespace App\Controllers;
use App\Models\firstModel;
use App\Models\jobModel;
use Hermawan\DataTables\DataTable;

class Home extends BaseController
{
    public function index(): string
    {
        return view('spica/index');
    }
    public function showprocess(){
        $jobmodel = new jobModel();
        $jobmodel  ->select('job_name ,job_start,job_end,process_name,process_start,process_end,detail,process_status')
        ->join('process','job.job_id = process.job_id','LEFT')
        ->orderBy('process_start','desc');
        $process_rs = $jobmodel->findAll();
        $data = [
            'process'=> $process_rs
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
