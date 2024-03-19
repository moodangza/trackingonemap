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
         width: 500px;
         height: 500px;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
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
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-12">
                        <div class="card">
                          <div class="card-header text-center border">
                          <h5 class="card-title align-middle">หัวข้อการทำงาน</h5>
                          </div>
                            <div class="card-body">
                             
                                ขั้นตอนการทำงาน
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Button with data-bs-target
  </button>

                            </div>
                        </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
                    <?php if($rs_job["status"] == 2){ cardlistjobapprove($rs_job); }?>
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
                    <?php if($rs_job["status"] == 3){?>
                    <div class="candidate-list-box card mt-2">
                        <div class="p-2 card-body">
                            
                            <div class="align-items-center row">
                                <!-- <div class="col-auto">
                                    <div class="candidate-list-images">
                                        <a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="avatar-md img-thumbnail rounded-circle" /></a>
                                    </div>
                                </div> -->
                                <div class="col-10">
                                    <div class="candidate-list-content mt-3 mt-lg-0">
                                        <h5 class="fs-19 mb-0" nowrap>
                                                <b> <?php echo $rs_job["job_name"];?></b>
                                          
                                            
                                        </h5>
                                        <p class="text-muted mb-2">คนบันทึก</p>
                                        <ul class="list-inline mb-0 text-muted">
                                            <li class="list-inline-item">
                                                <i class="mdi mdi-map-marker"></i> วันที่ เริ่มต้น วันที่ สิ้นสุด
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="mdi mdi-wallet"></i> วันที่เสร็จสิ้นการดำเนินการ
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                              
                            </div>
                          
                          
                        </div>
                    </div>
                        <?php }?>
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
                    <?php if($rs_job["status"] == 4){?>
                    <div class="candidate-list-box card mt-2">
                        <div class="p-2 card-body">
                            
                            <div class="align-items-center row">
                                <!-- <div class="col-auto">
                                    <div class="candidate-list-images">
                                        <a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="avatar-md img-thumbnail rounded-circle" /></a>
                                    </div>
                                </div> -->
                                <div class="col-10">
                                    <div class="candidate-list-content mt-3 mt-lg-0">
                                        <h5 class="fs-19 mb-0" nowrap>
                                                <b> <?php echo $rs_job["job_name"];?></b>
                                          
                                            
                                        </h5>
                                        <p class="text-muted mb-2">คนบันทึก</p>
                                        <ul class="list-inline mb-0 text-muted">
                                            <li class="list-inline-item">
                                                <i class="mdi mdi-map-marker"></i> วันที่ เริ่มต้น วันที่ สิ้นสุด
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="mdi mdi-wallet"></i> วันที่เสร็จสิ้นการดำเนินการ
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                              
                            </div>
                          
                          
                        </div>
                    </div>
                        <?php }?>
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