<!DOCTYPE html>
<html lang="en">

<?php echo $this->extend('templates/header'); ?>
<?php echo $this->section('content'); ?>
<style>
.bookmark-post .favorite-icon a, .job-box.bookmark-post .favorite-icon a {
    background-color: #da3746;
    color: #fff;
    border-color: danger;
}
.favorite-icon a {
    display: inline-block;
    width: 30px;
    height: 30px;
    font-size: 18px;
    line-height: 30px;
    text-align: center;
    border: 1px solid #eff0f2;
    border-radius: 6px;
    color: rgba(173,181,189,.55);
    -webkit-transition: all .5s ease;
    transition: all .5s ease;
}


.candidate-list-box .favorite-icon {
    position: absolute;
    right: 22px;
    top: 22px;
}
.fs-14 {
    font-size: 14px;
}
.modal{
        position: absolute;
        background-color: #ffffff;
        border: 1px solid #cccccc;
        width: 85%;
        height: auto;
        top: 65%;
        left: 50%;
        transform: translate(-50%, -50%);
}

.form-control {
          display: inline;
          width: inherit;
          border-top: 0px;
          border-left: 0px;
          border-right: 0px;
        }

</style>  
<?php 
 function cardlistjobapprove($rs_job)
{
  if($rs_job['job_finish']!='' ){
    $rsfi = $rs_job['job_finish'];
  }else{
    $rsfi = '<span style="color:red">ยังไม่สิ้นสุดกระบวนการ</span>';
  }
    print ' <div class="candidate-list-box card mt-2">'.
    '<div class="p-2 card-body">'.
        
        '<div class="align-items-center row">'.
        
            '<div class="col-12">'.
                '<div class="candidate-list-content mt-3 mt-lg-0">'.
                    '<h5 class="fs-19 mb-0" style="
                    text-justify: inter-character;">'.
                            '<b>'.$rs_job["job_name"].'</b>'.
                      '</h5>'.
                      '<hr>'.
                    '<p class="text-muted mb-2">'.$rs_job["prefix"].' '.$rs_job["name"].' '.$rs_job["surname"].'</p>'.
                    '<ul class="list-inline mb-0 text-muted">'.
                        '<li class="list-inline-item">'.
                            '<b><i class="fa fa-calendar-o "></i> '.$rs_job['job_start'] .' ถึง '. $rs_job['job_end'].'</b>'.
                        '</li>'.
                        '<br><li class="list-inline-item">'.
                            '<i class="fa fa-calendar-check-o"></i>&nbsp;'. $rsfi.
                        '</li>'.
                    '</ul>'.
                '</div>'.
            '</div>'.
            '<div class="col-12" style="text-align:end">'.
            '<button class="btn btn-warning" onclick="updatejobform(\''.$rs_job['job_id'].'\')"><i class="fa fa-pencil-square-o " aria-hidden="true"></i> </button>'.
            '<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalCenter" onclick="detailprocessapprove(\''.$rs_job['job_id'].'\')">ดูรายละเอียด</button>'.
            '</div>'.
        '</div>'.
    '</div>'.
'</div>';

}
?>  
<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
   <?php echo $this->include('templates/menu');?>
    <!-- partial -->
    <div class="page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
     <?php echo $this->include('templates/navbar');?>
      <!-- partial -->
      <div class="main-panel">
      <div id="myModal" class="modal fade modal-lg" role="dialog" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">

                              <h5 class="modal-title" id="staticBackdropLabel">เพิ่มหัวข้อ</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <ul class="list-group list-group-horizontal-md" style="box-shadow: 5px 10px #888888;margin-bottom: 2px;">
                                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ชื่อหัวข้อ</label>
                                </div>
                                <div class="list-group-item col-10 form-floating">
                                  <div class="p-2 g-col-6">
                                    <!-- <input type="text" class="form-control" id="job_name" name="job_name"> -->
                                    <textarea class="form-control" id="job_name" name="job_name">
                                      
                                    </textarea>
                                  </div>
                                </div>
                              </ul>

                              <ul class="list-group list-group-horizontal-md">
                                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ระยะเวลาการทำงาน</label>
                                </div>
                                <div class="list-group-item col-10 d-flex form-floating">
                                  <div class="p-2 g-col-6 d-flex align-items-center text-center justify-content-center">
                                    <label for="job_start" class="form-label">ตั้งแต่</label>
                                    &nbsp;&nbsp;<input type="text" class="form-control datepicker-input" id="job_start" style="width: fit-content;" readonly name="job_start">
                                    &nbsp;&nbsp;<label for="job_end" class="form-label">ถึง</label>
                                    &nbsp;&nbsp;<input type="text" class="form-control datepicker-input" id="job_end" style="width: fit-content;" readonly name="job_end">
                                  </div>
                                </div>
                              </ul>
                              <input type="hidden" class="form-control" id="division_id" name="division_id">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" onclick="addjob()">บันทึก</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- formodalupdate -->
                      <div id="myModaledit" class="modal fade modal-lg" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" id="staticBackdropLabel">เพิ่มหัวข้อ</h5> -->
                              <h5 class="modal-title" id="staticBackdropLabel">แก้ไขหัวข้อ</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <input type="hidden" class="form-control" id="editjob_id" name="editjob_id" value="">
                            <div class="modal-body">
                              <ul class="list-group list-group-horizontal-md">
                                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ชื่อหัวข้อ</label>
                                </div>
                                <div class="list-group-item col-10 form-floating">
                                  <div class="p-2 g-col-6">
                                    <!-- <input type="text" class="form-control" id="editjob_name" name="editjob_name"> -->
                                    <textarea class="form-control" id="editjob_name" name="editjob_name">

                                    </textarea>
                                  </div>
                                </div>
                              </ul>
                              <ul class="list-group list-group-horizontal-md">
                                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ระยะเวลาการทำงาน</label>
                                </div>
                                <div class="list-group-item col-10 d-flex form-floating">
                                  <div class="p-2 g-col-6 d-flex align-items-center text-center justify-content-center">
                                    <label for="editjobstart" class="form-label">ตั้งแต่</label>
                                    &nbsp;&nbsp;<input type="text" class="form-control datepicker-input" id="editjob_start" style="width: fit-content;" readonly name="editjob_start">
                                    &nbsp;&nbsp;<label for="editjobend" class="form-label">ถึง</label>
                                    &nbsp;&nbsp;<input type="text" class="form-control datepicker-input" id="editjob_end" style="width: fit-content;" readonly name="editjob_end">
                                  </div>
                                </div>
                              </ul>
                              <ul class="list-group list-group-horizontal-md">
                                <!-- <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ขั้นตอนการทำงาน</label>
                                </div> -->
                                <table class="table">
                                  <thead>
                                    <tr>
                                    <th>checklist</th>
                                    </tr>
                                   <tr>
                                    <th colspan="1">ขั้นตอนการทำงาน</th>
                                    <th colspan="1">วันที่เริ่ม</th>
                                    <th colspan="1">วันที่สิ้นสุด</th>
                                   </tr>
                                  </thead>
                                  <tbody id="listprocess">
                                   
                                    <tr>
                                      <td colspan="3"> <button class="btn btn-success addprocess" >เพิ่มขั้นตอน</button></td>
                                    </tr>
                                  </tbody>
                                </table>
                                <!-- <div class="list-group-item col-10 form-floating">
                                  <div class="p-2 g-col-6">
                                 
                                   
                                    <div id="listprocess">
                                      
                                    </div>
                                   
                                  </div>
                                </div> -->
                              </ul>
                              <div class="modal-footer center-block footer-edit">
                              
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
      <div class="modal fade modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" data-bs-backdrop="static"
       data-bs-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">รายละเอียด</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row g-3">
                <div class="col-md">
                <figure class="text-left">
                <h5 id="job_name" class="card-title align-middle">หัวข้อการทำงาน</h5>
                          <input type="hidden" id="job_id" value="">
                        เริ่มต้น : <em id="showjob_start">วันที่เริ่มต้น</em>
                        สิ้นสุด : <em id="showjob_end">วันที่สิ้นสุด</em>
</figure>
                </div>
               
                <div class="col-12">
                        <div class="card" style="height: 100%;">
                          <div class="card-header text-center border">
                            
                          </div>
                            <div class="card-body">
                            <ul class="list-group list-group-horizontal-md ">
                           
                    <div class="list-group-item col-12 d-flex align-items-center text-center justify-content-center">
                      
                      <table class="table table-sm">
                        <thead>
                          <th>ขั้นตอนการทำงาน</th>
                          <th>วันที่เริ่ม</th>
                          <th>วันที่สิ้นสุด</th>
                        </thead>
                        <tbody id="showprocess">

                        </tbody>
                      </table>
                      <!-- <div class="list-group-item col-10 form-floating" >
                     
                    </div> -->
                    </div>


                    

                  </ul>
                  <ul class="list-group list-group-horizontal-md radiapprove">
                    <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                        <span >&nbsp;ผลการอนุมัติ</span>
                    </div>
                    <div class="list-group-item col-10 form-floating">
                      <div class="p-2 g-col-6">
                       
                                <input class="radioapprove" type="radio" 
                                <?php if($_SESSION['usertbl']['level'] != 'aprove'){?> disabled  <?php } ?> 
                                name="radioapprove" id="radioapprove" value="0">&nbsp; ไม่อนุมัติ &nbsp;&nbsp;
                                <input class="radioapprove" type="radio" 
                                <?php if($_SESSION['usertbl']['level'] != 'aprove'){?> disabled  <?php } ?>  
                                name="radioapprove" id="radioapprove1" value="1"> &nbsp;อนุมัติ
  
                      </div>
                    </div>
                  </ul>
                  <ul class="list-group list-group-horizontal-md radiapprove" id="reason">
                    <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                    <label for="exampleInputtext" class="form-label" style="color:red;">*โปรดระบุเหตุผล</label>
                    </div>
                    <div class="list-group-item col-10 form-floating">
                      <div class="p-2 g-col-6">
                        <input type="text" class="form-control" autocomplete="off" id="reasoninput" value="">
                      </div>
                    </div>
                  </ul>
                  <ul class="list-group list-group-horizontal-md" id="historyreason">
                    <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                    <label for="exampleInputtext" class="form-label" style="color:red;">ประวัติการอนุมัติ</label>
                    </div>
                    <div class="list-group-item col-10 form-floating">
                      <div class="p-2 g-col-6" id="historyapprove">

                      </div>
                    </div>
                  </ul>

                            </div>
                        </div>
                </div>
            </div>
      </div>
      <div class="modal-footer ">
        <div class="text-center">
          <button type="button" class="btn btn-danger closemodal" data-dismiss="modal">Close</button>
          <?php if($_SESSION['usertbl']['level'] == 'aprove'){?>
          <button type="button" class="btn btn-success approvejob">อนุมัติการทำงาน</button>
            <?php }?>
        </div>
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-lg" id="exampleModalCenter1" tabindex="-1" role="dialog" data-bs-backdrop="static"
       data-bs-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-12">
                        <div class="card" >
                          <div class="card-header text-center border">
                            <h5 id="job_name" class="card-title align-middle">โปรดกรอกเหตุผลที่ไม่อนุมัติขั้นตอนการทำงาน</h5>
                            <div class="form-floating mb-3">
                              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                              <label for="floatingInput">Email address</label>
                            </div>
                          </div>
                            <div class="card-body">
                              <div class="form-floating">
                                <textarea class="form-control" placeholder="บันทึกเหตุผล" id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">หมายเหตุ</label>
                              </div>
                            </div>
                        </div>
                </div>
            </div>
      </div>
      <div class="modal-footer ">
        <div class="text-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php if($_SESSION['usertbl']['level'] == 'aprove'){?>
          <button type="button" class="btn btn-primary approvejob">อนุมัติการทำงาน</button>
          <?php }?>
        </div>
        
      </div>
    </div>
  </div>
</div>

<div id="testModal" class="modal fade modal-lg" role="dialog" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">

                              <h5 class="modal-title" id="staticBackdropLabel">testprocess</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <ul class="list-group list-group-horizontal-md" style="box-shadow: 5px 10px #888888;margin-bottom: 2px;">
                                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ชื่อหัวข้อ</label>
                                </div>
                                <div class="list-group-item col-10 form-floating">
                                  <div class="p-2 g-col-6">
                                  
                                  <input type="text" autocomplete="off" class="form-control" id="process_name" name="process_name" placeholder="จัดทำร่าง พรบ." value="">
                                  </div>
                                </div>
                              </ul>

                              <ul class="list-group list-group-horizontal-md">
                                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ระยะเวลาการทำงาน</label>
                                </div>
                                <div class="list-group-item col-10 d-flex form-floating">
                                  <div class="p-2 g-col-6 d-flex align-items-center text-center justify-content-center">
                                 
                    <input type="text" id="s_date" readonly="readonly" class="form-control datepicker create-s-date" name="s_date" data-old="" value="">
                    ถึง
                    <input type="text" required="" readonly="readonly" id="e_date" class="form-control  datepicker-input create-e-date" name="e_date" data-old="" value="">
                                    <!-- <label for="job_start" class="form-label">ตั้งแต่</label>
                                    &nbsp;&nbsp;<input type="text" class="form-control datepicker-input" id="job_start" style="width: fit-content;" readonly name="job_start">
                                    &nbsp;&nbsp;<label for="job_end" class="form-label">ถึง</label>
                                    &nbsp;&nbsp;<input type="text" class="form-control datepicker-input" id="job_end" style="width: fit-content;" readonly name="job_end"> -->
                                  </div>
                                </div>
                              </ul>
                              <input type="hidden" class="form-control" id="division_id" name="division_id">
                            </div>
                            <div class="modal-footer">
                            <?php //if ($cedit == 'can') { ?>
                    <?php // if ($flag == 'add') { ?>
                      <button class="btn btn-success insertprocess" type="button">บันทึก</button>&nbsp;
                    <?php //} else if ($flag == 'update') { ?>
                      <button class="btn btn-warning updateprocess" type="button">แก้ไข</button>&nbsp;
                    <?php // } ?>
                  <?php //} ?>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            </div>
                          </div>
                        </div>
                      </div>

        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="row w-100 flex-grow">

              <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="row w-100 flex-grow" style="justify-content: center">
                    <h4><?php echo $showjob[0]['division_name']; ?></h4>
              </div>
            </div>
              </div>  
              
                <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-head bg-primary text-center" style="padding: 10px;color:white;">
                        <b>กำลังดำเนินการ</b>
                        
                        <button type="button" id="addjob" class="btn btn-primary ms-5" data-bs-toggle="modal" data-bs-target="#myModal"> เพิ่มขั้นตอนการทำงาน </button>
                    </div>
                
                    <div class="card-body">
                
                  <div class="candidate-list">
                  <?php foreach($showjob as $rs_job){?>
                    <?php if($rs_job["status"] == 2){ 
                        cardlistjobapprove($rs_job); 
                        }?>
                    <?php }?> 
                </div>
              
                </div>
             
            <!-- row end -->
            </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card text-white">
                  <div class="card">
                    <div class="card-head bg-warning text-center" style="padding: 10px;color:white;">
                        <b>รออนุมัติ</b>
                    </div>
                    <div class="card-body scroll">
                  <div class="candidate-list">
                  <?php foreach($showjob as $rs_job){?>
                    <?php if($rs_job["status"] == 3){
                          cardlistjobapprove($rs_job); 
                     }?>
                    <?php }?>  
                </div>
                </div>
            <!-- row end -->
            </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card text-white">
                  <div class="card">
                    <div class="card-head bg-success text-center" style="padding: 10px; color:white;">
                        <b>อนุมัติเสร็จสิ้น</b>
                    </div>
                    <div class="card-body scroll">
                  <div class="candidate-list">
                  <?php foreach($showjob as $rs_job){?>
                  
                    <?php if($rs_job["status"] == 4){
                       if($rs_job['job_finish']!='' ){
                        $rsfi = $rs_job['job_finish'];
                      }
                         echo  '<div class="candidate-list-box card mt-2">'.
                           '<div class="p-2 card-body">'.
                               
                               '<div class="align-items-center row">'.
                               
                                   '<div class="col-12">'.
                                       '<div class="candidate-list-content mt-3 mt-lg-0">'.
                                           '<h5 class="fs-19 mb-0" style="
                                           text-justify: inter-character;">'.
                                                   '<b>'.$rs_job["job_name"].'</b>'.
                                             '</h5>'.
                                             '<hr>'.
                                           '<p class="text-muted mb-2">'.$rs_job["prefix"].' '.$rs_job["name"].' '.$rs_job["surname"].'</p>'.
                                           '<ul class="list-inline mb-0 text-muted">'.
                                               '<li class="list-inline-item">'.
                                                   '<b><i class="fa fa-calendar-o "></i> '.$rs_job['job_start'] .' ถึง '. $rs_job['job_end'].'</b>'.
                                               '</li>'.
                                               '<br><li class="list-inline-item">'.
                                                   '<i class="fa fa-calendar-check-o"></i>&nbsp;'. $rsfi.
                                               '</li>'.
                                           '</ul>'.
                                       '</div>'.
                                   '</div>'.
                                   '<div class="col-12" style="text-align:end">'.
                                  
                                   '<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalCenter" onclick="detailprocessapprove(\''.$rs_job['job_id'].'\')">ดูรายละเอียด</button>'.
                                   '</div>'.
                               '</div>'.
                           '</div>'.
                       '</div>';
                       }?>
                  
                    <?php }?>  
                </div>
                </div>
            <!-- row end -->
            </div>
            </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  </div>
      <!-- main-panel ends -->
      <?php echo $this->include('templates/footer');?>
    </div>
    <!-- page-body-wrapper ends -->
    
  </div>

        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
         
        <!-- partial -->
     
  <?php $this->endSection();?>
</body>

</html>