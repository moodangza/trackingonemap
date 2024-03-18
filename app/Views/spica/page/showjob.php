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
     <script>
function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}
</script>
<script>
  $(document).ready(function () {
    var modal = $("#jobadd");
    $("#intjob").click(function () {
      // alert('cl');
        // $("#jobadd").fadeIn(300);
        $("#jobadd").modal({
                escapeClose: true,
                clickClose: true,
                showClose: true,
                fadeDuration: 100
            });
    });
    $(".close").click(function () {
        $("#jobadd").fadeOut(300);
    });
});

</script>

<style>
          .modal {
         position: absolute;
         background-color: #ffffff;
         border: 1px solid #cccccc;
         width: 500px;
         height: 500px;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         /* additional styles for the modal */
      }
#jobadd {
  width: 750px;
  margin: auto;
}
 </style> 
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
        <?php   //echo getcwd();; ?>
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body container">
                      <!-- <button class="btn btn-success" id="intjob" onclick="openForm()">เพิ่มหัวข้อ</button> -->
                      <!-- Button trigger modal -->
                        
            <select class="form-select selectdivision" aria-label="Default select example" style="width:auto;">
                <option value="0" selected>เลือกหน่วยงาน</option>
                  <?php foreach($division as $opj){?>
                    <option value="<?php echo $opj['division_id'];?>" <?php 
                    if($divisionid==$opj['division_id']){echo 'selected';}?>><?php echo $opj['division_name'];?></option>
                  <?php }?>
            </select> <br>
            
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">เพิ่มหัวข้อ</button>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" id="staticBackdropLabel">เพิ่มหัวข้อ</h5> -->
        <h5 class="modal-title" id="staticBackdropLabel">เพิ่มหัวข้อ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <label for="inputjob" class="form-label">ชื่อหัวข้อ</label>
        <input type="text" class="form-control" id="job_name" name="job_name">
        <label for="jobstart" class="form-label">วันที่เริ่ม</label>
        <input type="text" class="form-control datepicker-input" id="job_start" readonly name="job_start"> <div class="input-group-append">
                                                    <div  class="input-group-text toggle-datepicker" data-toggle="#create-e-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
        <label for="jobend" class="form-label">วันที่สิ้นสุด</label>
        <input type="text" class="form-control datepicker-input" id="job_end" readonly name="job_end"> <div class="input-group-append">
                                                    <div  class="input-group-text toggle-datepicker" data-toggle="#create-e-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
        <input type="hidden" class="form-control" id="division_id" name="division_id">
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="addjob()">บันทึก</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิกก</button>
      </div>
    </div>
    </div>
    </div>
    <br>   <br>   <br>
    
  <!-- formodalupdate -->
    <div id="myModaledit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" id="staticBackdropLabel">เพิ่มหัวข้อ</h5> -->
        <h5 class="modal-title" id="staticBackdropLabel">แก้ไขหัวข้อ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <input type="hidden" class="form-control" id="editjob_id" name="editjob_id">
      <div class="modal-body">
      <label for="inputjob" class="form-label">ชื่อหัวข้อ</label>
        <input type="text" class="form-control" id="editjob_name" name="editjob_name">
        <label for="editjobstart" class="form-label">วันที่เริ่ม</label>
        <input type="text" class="form-control datepicker-input" id="editjob_start" readonly name="editjob_start"> <div class="input-group-append">
                                                    <div  class="input-group-text toggle-datepicker" data-toggle="#create-e-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
        <label for="editjobend" class="form-label">วันที่สิ้นสุด</label>
        <input type="text" class="form-control datepicker-input" id="editjob_end" readonly name="editjob_end"> <div class="input-group-append">
                                                    <div  class="input-group-text toggle-datepicker" data-toggle="#create-e-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="editjob()">บันทึก</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
    </div>
    </div>
    
            <div class="row">          
            <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
            <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            ต้องดำเนินการ
                            </a>
                            
                           
                    <div id="mustact">
                      
                      </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            อยู่ระหว่างดำเนินการ
                            </a>
                           
                    <div id="inprogress">
                      
                      </div>
                              </a>
                                
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            รออนุมัติ
                            </a>
                       
                    <div id="waitapprove">
                      
                      </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            เสร็จสิ้น
                            </a>
                           
                    <div id="approve">
                      
                      </div>
                    </div>
                </div>
              </div>
            </div>
            
                          </div>
                        <!-- </div>
                       
                      </div>
                    
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

<!-- คลิก หน่วยงาน ดู Job -->
<?php if ($divisionid){ ?>
  <script>showjobselect(<?=$divisionid?>)</script> 
<?php }?>
  <?php $this->endSection();?>
</body>

</html>