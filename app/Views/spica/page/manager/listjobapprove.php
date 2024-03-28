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
.modal {
         position: fixed;
         background-color: #ffffff;
         border: 1px solid #cccccc;
         width: 90%;
        
         top: 50%;
         left: 50%;
         transform: scale(1) translate(-45%, -45%);
         /* additional styles for the modal */
      }
</style>  
<?php 
 function cardlistjobapprove($rs_job)
{
    print ' <div class="candidate-list-box card mt-2">'.
    '<div class="p-2 card-body">'.
        
        '<div class="align-items-center row">'.
        
            '<div class="col-10">'.
                '<div class="candidate-list-content mt-3 mt-lg-0">'.
                    '<h5 class="fs-19 mb-0" nowrap>'.
                            '<b>'.$rs_job["job_name"].'</b>'.
                      '</h5>'.
                    '<p class="text-muted mb-2">คนบันทึก</p>'.
                    '<ul class="list-inline mb-0 text-muted">'.
                        '<li class="list-inline-item">'.
                            '<i class="mdi mdi-map-marker"></i> วันที่ เริ่มต้น วันที่ สิ้นสุด'.
                        '</li>'.
                        '<li class="list-inline-item">'.
                            '<i class="mdi mdi-wallet"></i> วันที่เสร็จสิ้นการดำเนินการ'.
                        '</li>'.
                    '</ul>'.
                '</div>'.
            '</div>'.
            '<div class="col-auto">'.
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
      <div class="modal fade modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" data-bs-backdrop="static"
       data-bs-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">รายละเอียด ก่อนอนุมัติ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-12">
                        <div class="card">
                          <div class="card-header text-center border">
                            <h5 id="job_name" class="card-title align-middle">หัวข้อการทำงาน</h5>
                          <input type="hidden" id="job_id" value="">
                          <div class="">
                              
                              เริ่มต้น : <em id="showjob_start">วันที่เริ่มต้น</em>
                              สิ้นสุด : <em id="showjob_end">วันที่สิ้นสุด</em>
                               
                          </div>
                            
                          </div>
                            <div class="card-body">
                             <div id="showprocess">
                                  
                             </div>
                           
                                
                               

                            </div>
                        </div>
                </div>
            </div>
      </div>
      <div class="modal-footer ">
        <div class="text-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary approvejob">อนุมัติการทำงาน</button>
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
        <h5 class="modal-title" id="exampleModalLongTitle">test</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-12">
                        <div class="card">
                          <div class="card-header text-center border">
                            <h5 id="job_name" class="card-title align-middle">หัวข้อการทำงาน</h5>
                          <input type="hidden" id="job_id" value="">
                          <div class="">
                              
                              เริ่มต้น : <em id="showjob_start">วันที่เริ่มต้น</em>
                              สิ้นสุด : <em id="showjob_end">วันที่สิ้นสุด</em>
                               
                          </div>
                            
                          </div>
                            <div class="card-body">
                             <div id="showprocess">
                                  
                             </div>
                           
                                
                               

                            </div>
                        </div>
                </div>
            </div>
      </div>
      <div class="modal-footer ">
        <div class="text-center">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary approvejob">อนุมัติการทำงาน</button>
        </div>
        
      </div>
    </div>
  </div>
</div>

        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-head bg-primary text-center">
                        กำลังดำเนินการ
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
                    <div class="card-head bg-primary text-center">
                        รออนุมัติ
                    </div>
                    <div class="card-body">
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
                    <div class="card-head bg-primary text-center">
                        อนุมัติเสร็จสิ้น
                    </div>
                    <div class="card-body">
                  <div class="candidate-list">
                  <?php foreach($showjob as $rs_job){?>
                  
                    <?php if($rs_job["status"] == 4){
                          cardlistjobapprove($rs_job); 
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