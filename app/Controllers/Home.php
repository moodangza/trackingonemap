<?php

namespace App\Controllers;
use App\Models\firstModel;
use Hermawan\DataTables\DataTable;

class Home extends BaseController
{
    public function index(): string
    {
        return view('spica/index');
    }
    public function showdata(){
        $firstmodel = new firstModel();
        $firstmodel 
        ->select('orders.OrderID AS id,products.ProductID,Quantity,OrderDate,ProductName,Unit,Price')
        ->join('Order_details','Orders.OrderID = Order_details.OrderID','left')
        ->join('Products','Order_details.ProductID = Products.ProductID','left')
        ->where("OrderDate Between '2022-07-01' AND '2022-09-30'")
        
        ->orderBy('orders.OrderID ASC');
        $product = $firstmodel->findAll();
        $return = [
            'product' => $product
        ];
        return view('spica/page/showdata',$return);
    }
    
}
