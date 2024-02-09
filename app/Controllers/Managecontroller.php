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
}