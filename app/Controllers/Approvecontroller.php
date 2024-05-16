<?php

namespace App\Controllers;

use App\Models\jobModel;
use App\Models\approveModel;
use App\Models\processModel;
use App\Models\subprocessModel;
use App\Models\divisionModel;
use App\Models\statusModel;
use App\Libraries\Date;
use App\Libraries\Ckedit;


class Approvecontroller extends BaseController
{
    public function approvefirstpage()
    {
        $showdivision = new divisionModel();
        $showdivision->select('division_id as d_id ,division_name as d_name');
        $divi_rs = $showdivision->findAll();

        $showjob = new jobModel();
        // $showstatus = new statusModel();

        foreach ($divi_rs as $x => $value) {
            $showjob->select(' count(status) as c_job,status')
                ->where('job_tb.delete_flag', '1')
                ->where('job_tb.division_id', $value["d_id"])
                ->groupBy('status');
            $job_rs = $showjob->findAll();
            $divi_rs[$x]["job"] = $job_rs;
        }
        $returndata = [
            'divi' => $divi_rs,

        ];
        // header('Content-Type: application/json');
        // echo json_encode( $returndata );

        return view('spica/page/manager/showapprove', $returndata);
    }
    public function listjobapprove($d_id)
    {
        $jobselect = new jobModel();
        $jobselect->select('job_id,job_name,job_start,job_end,job_finish,status,create_by')
            ->select('division_tb.division_name')
            ->select('prefix , name, surname ')
            ->join('division_tb', 'job_tb.division_id = division_tb.division_id', 'inner')
            ->join('user_tb','user_tb.user_name = job_tb.create_by','left')
            ->where('job_tb.delete_flag', '1')
            ->where('job_tb.division_id', $d_id);
        $job_rs = $jobselect->findAll();
        $dateth = new Date();
        foreach ($job_rs as $key => $date_th) {
            $job_rs[$key]['job_start'] = $dateth->DateThai($date_th['job_start']);
            $job_rs[$key]['job_end'] = $dateth->DateThai($date_th['job_end']);
            if ($job_rs[$key]['job_finish'] != '') {
                $job_rs[$key]['job_finish'] = $dateth->DateThai($date_th['job_finish']);
            }
        }

        $returndata = [
            'showjob' => $job_rs,


        ];
        return view('spica/page/manager/listjobapprove', $returndata);
    }
    public function detailapprove()
    {
        $job_id = $this->request->getVar('job_id');
        $job_sql = new jobModel();
        $job_sql->select('job_id,job_name,job_start,job_end,job_finish,status')
            ->where('job_tb.delete_flag', '1')
            ->where('job_tb.job_id', $job_id)
            ->groupBy('job_id,job_name,job_start,job_finish,status');
        $job_rs = $job_sql->findAll();
        $dateth = new Date();
        foreach ($job_rs as $key => $date_th) {
            $job_rs[$key]['job_start'] = $dateth->DateThai($date_th['job_start']);
            $job_rs[$key]['job_end'] = $dateth->DateThai($date_th['job_end']);
        }
        $processsql = new processModel();
        $processsql->select('process_tb.process_id,process_tb.process_name,process_tb.process_start,process_tb.process_end,process_tb.process_finish,process_tb.detail,process_tb.status')
            ->where('process_tb.delete_flag', '1')
            ->where('process_tb.job_id', $job_id);
        $process_rs = $processsql->findAll();
        foreach ($process_rs as $key1 => $date_th) {
            $process_rs[$key1]['process_start'] = $dateth->DateThai($date_th['process_start']);
            $process_rs[$key1]['process_end'] = $dateth->DateThai($date_th['process_end']);
        }
        $subprocesssql = new subprocessModel();
        foreach ($process_rs as $x => $value) {

            $subprocesssql->select('subprocess_tb.subprocess_id,subprocess_tb.subprocess_name,subprocess_tb.subprocess_start,subprocess_tb.subprocess_end,subprocess_tb.subprocess_finish,subprocess_tb.subprocess_status')
                ->where('subprocess_tb.delete_flag', '1')
                ->where('subprocess_tb.process_id', $value['process_id'])
                // ->groupBy('job_tb.job_id,job_tb.job_name,status')
                ->orderBy('subprocess_start', 'asc');
            $subprocess_rs = $subprocesssql->findAll();
            foreach ($subprocess_rs as $key2 => $date_th) {
                $subprocess_rs[$key2]['subprocess_start'] = $dateth->DateThai($date_th['subprocess_start']);
                $subprocess_rs[$key2]['subprocess_end'] = $dateth->DateThai($date_th['subprocess_end']);
            }
            // $dateth->DateThai($date_th['subprocess_end']);
            $process_rs[$x]["subprocess"] = $subprocess_rs;
        }
        $approvesql = new approveModel();
        $approvesql->select('reject_detail,status,approve_date,reject_date')
        ->where('job_id',$job_id)
        ->orderBy('approve_create', 'asc');
        $approvehis_rs = $approvesql->findAll();
        $return = [
            'job' => $job_rs,
            'process' => $process_rs,
            'history' => $approvehis_rs,
            'flag' => 'afterselect'
        ];
        return $this->response->setJSON($return);
        header('Content-Type: application/json');

        echo json_encode($return);
    }

    public function confirmapprove()
    {
        print_r($_POST);
       
        $job_id = $_POST['job_id'];
        echo $job_id;
        // exit;
        $approvejob = new jobModel();
        $datajob = array(
            'updated_at' => date('Y-m-d H:i:s', strtotime('7 hour')),
            'status' => '4',
            'update_by' => $_SESSION["usertbl"]["user_name"],
            'job_finish' =>date('Y-m-d'),
        );

        $approvejob->set($datajob)->where('job_id', $job_id)->update();

        $approveprocess = new processModel();
        $dataprocess = array(
            'updated_at' => date('Y-m-d H:i:s', strtotime('7 hour')),
            'status' => '2',
            'update_by' => $_SESSION["usertbl"]["user_name"],

        );
        $approveprocess->set($dataprocess)->where('job_id', $job_id)->update();
        $confirmsubprocess = new subprocessModel();
        $datasubprocess = array(
            'subprocess_status' => '2',
            'subprocess_finish' => date('Y-m-d'),
            'updated_at' => date('Y-m-d H:i:s', strtotime('7 hour')),
              'update_by'=>$_SESSION['usertbl']['user_name'],
        );
        $confirmsubprocess->set($datasubprocess)->where('job_id', $job_id)->update();
        $approve = new approveModel();
        $data = array(
            'job_id' => $job_id,
            'approve_date' => date('Y-m-d'),
            'approve_create' => date('Y-m-d H:i:s', strtotime('7 hour')),
            'status' => '1',
            'approve_create_by' => $_SESSION['usertbl']['user_name']
        );
        $approve->insert($data);
    }
    public function rejectapprove()
    {


        $job_id = $this->request->getVar('job_id');

        $approvejob = new jobModel();
        $datajob = array(
            'updated_at' => date('Y-m-d H:i:s', strtotime('7 hour')),
            'status' => '2',
            'update_by' => $_SESSION['usertbl']['user_name']
        );

        $approvejob->set($datajob)->where('job_id', $job_id)->update();

        $approveprocess = new processModel();
        $dataprocess = array(
            'updated_at' => date('Y-m-d H:i:s', strtotime('7 hour')),
            'status' => '2',
            'update_by' => $_SESSION['usertbl']['user_name']
        );

        $confirmsubprocess = new subprocessModel();
        $dataprocess = array(
            'subprocess_status' => '1',
            'subprocess_finish' => date('Y-m-d'),
            'updated_at' => date('Y-m-d H:i:s', strtotime('7 hour'))
        );
        $confirmsubprocess->set($dataprocess)->where('subprocess_id', $job_id)->update();

        $approve = new approveModel();
        $data = array(
            'job_id' => $job_id,
            'reject_date' => date('Y-m-d'),
            'reject_detail' => $_POST['reject_detail'],
            'approve_create' => date('Y-m-d H:i:s', strtotime('7 hour')),
            'status' => '0',
            'create_by' => $_SESSION['usertbl']['user_name']
        );
        $approve->insert($data);
    }
}
