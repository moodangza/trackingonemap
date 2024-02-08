<?php

namespace App\Controllers;
use App\Models\deletejobModel;
//use App\Models\approveModel;
use App\Models\deleteprocessModel;
use App\Models\deletesubprocessModel;


class Manage extends BaseController
{
    public function deleteprocess($process_id)
    {
        $deleteprocess = new deleteprocessModel();
        $dataprocess = array('status'=>'2');
       
        $deleteprocess ->set($deleteprocess) ->where('process_id',$process_id) -> update();
       
    }
}