<!DOCTYPE html>
<html lang="en">

<?php echo $this->extend('templates/header'); ?>
<?php echo $this->section('content'); ?>

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
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                     <div class="card-body container">
                      <div class="row mb-4"> 
                        <?php 
                              foreach ($divi as $x) {?>
                          <div class="col-4">
                            <div class="card" style="margin : 10px" >
                               <div class="card-header bg-primary text-white">
                               <?php echo $x["d_name"]. "<br>";?>
                               </div> 
                                <div class="card-body">
                                <?php 
                                      foreach($x["job"] as $y){?>
                                      
                                <?php if($y["status"]==1){?> 
                                  ต้องดำเนินการ  <?php echo $y["job_name"];?>  <br>        
                                 <?php } ?> 
                                 <?php if($y["status"]==2){?> 
                                  กำลังดำเนินการ  <?php echo $y["job_name"];?> <br>         
                                 <?php } ?> 
                                 <?php if($y["status"]==3){?> 
                                     รอยืนยัน <?php echo $y["job_name"];?><br>          
                                 <?php } ?> 
                                <?php }?>
                                </div>
                          </div>
                                      </div>
                       <?php }?>
                      </div>
                      <!-- <div class="row md-4">          
                        <div class="col-lg-6 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                             
                            </div>
                          </div>
                        </div>

                          </div> -->
                        
            </div> 
           
          </div>
          
          <!-- row end -->
          
          <!-- row end -->
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
          <?php echo $this->include('templates/footer');?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- <div class="modal_fade modal-dialog modal-md" id='jobadd' tabindex='-1' role='dialog' >
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <div class="modal-body">
                 <h4 class="modal-title" id="modalpreviewlabel">เพิ่มข้อมูล</h4>                                     
                 <form class="row g-3">
  <div class="col-md-12">
    <label for="inputjob" class="form-label">ชื่อหัวข้อ</label>
    <input type="email" class="form-control" id="job_name" name="job_name">
  </div>
  <div class="col-md-6">
    <label for="jobstart" class="form-label">วันที่เริ่ม</label>
    <input type="text" class="form-control" id="date_start" name="job_start">
  </div>
  <div class="col-6">
  <label for="jobend" class="form-label">วันที่สิ้นสุด</label>
    <input type="text" class="form-control" id="date_end" name="job_end">
  </div>
<br>
<div class="col-6">
 <br><br>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">บันทึก</button>
  </div>
</form>
                 </div>
            </div>
        </div>
      </div>
  </div> -->

  <?php $this->endSection();?>
</body>

</html>