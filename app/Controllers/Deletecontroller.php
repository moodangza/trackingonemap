<?php

namespace App\Controllers;
use App\Models\jobModel;
//use App\Models\approveModel;
use App\Models\processModel;
use App\Models\subprocessModel;


class Manage extends BaseController
{
    public function deleteprocess($process_id)
    {
        $deleteprocess = new processModel();
        $dataprocess = array('status'=>'2',
                              'deleted_at'=>date('Y-m-d H:i:s', strtotime('7 hour'))
                            );
       
        $deleteprocess ->set($deleteprocess) ->where('process_id',$process_id) -> update();
       
    }
}