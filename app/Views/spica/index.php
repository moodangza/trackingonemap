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
$(function(){
            $("#date_start,#date_end").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true
            });
        });
</script>
<style>
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
                    <div class="card-body p-5">

                    
 <div class="justify-content-center">
<!-- <div class="col-2"></div> -->
<div class="card">
<div class="card-header bg-info text-black text-center" >กกกก</div>
  <div class="card-body">
  <div class="row justify-content-center" >
  <?php foreach($job as $group){?>
  <div class="col-sm-5">
  <div class="card" style="margin: 10px;" bg-primary>
  <div nowrap>
                                        <div class="list-group">
                                        <li class="list-group-item css.active bg-success">
                                        <?php echo $group["division_name"];?>
                                        </li>
                                        <li class="list-group-item">
                                        จำนวนงานทั้งหมด :  <?php echo $group["c_job"];?>                                      
                                        <br> จำนวนงานที่ต้องดำเนินการ : <?php  echo $group["a_job"]; ?>
                                        <br> จำนวนงานที่กำลังดำเนินการ : <?php  echo $group["p_job"]; ?>
                                        <br> จำนวนงานที่รออนุมัติ : <?php echo $group["w_job"]; ?>
                                        <br> จำนวนงานที่ดำเนินการเสร็จแล้ว : <?php echo $group["s_job"]; ?>
                                        <br> จำนวนงานที่คงเหลือ : <?php echo $group["c_job"]-$group["s_job"]; ?> 
                                        <br><a href="<?php echo base_url('showjob/'.$group['division_id']);?>" class="btn btn-primary">ดูรายละเอียด</a>
                                        </li>
  </div>
  </div>
  </div>
  </div>
  <?php }?>
</div>
</div>
</div>
</div>

  <div class="col-sm-7">
    <div class="card" style="margin: 10px;" bg-primary>
      <div class="card-header bg-info text-black text-center" >กกกก</div>
      <div class="card-body">
      <div nowrap>
                                        <div class="list-group">
                                        <?php foreach($job as $group){?>
                                          <li class="list-group-item css.active bg-success">
                                        <?php echo $group["division_name"];?>
                                          </li>
                                        <li class="list-group-item">
                                        จำนวนงานทั้งหมด :  <?php 
                                          echo $group["c_job"];
                                          ?>                                      
                                        <br> จำนวนงานที่ต้องดำเนินการ : <?php  echo $group["a_job"]; ?>
                                        <br> จำนวนงานที่กำลังดำเนินการ : <?php  echo $group["p_job"]; ?>
                                        <br> จำนวนงานที่รออนุมัติ : <?php echo $group["w_job"]; ?>
                                        <br> จำนวนงานที่ดำเนินการเสร็จแล้ว : <?php echo $group["s_job"]; ?>
                                        <br> จำนวนงานที่คงเหลือ : <?php echo $group["c_job"]-$group["s_job"]; ?> 
                                        <br><a href="<?php echo base_url('showjob/'.$group['division_id']);?>" class="btn btn-primary">ดูรายละเอียด</a>
                                        </li>
                                        <?php// foreach($group["job"] as $job_name){?>
                                          <!-- <li class="list-group-item"> -->
                                        <?php //echo $job_name["job_name"];?> <br>
                                        <!-- </li> -->
                                        <?php// }?>
                                        <?php }?>
                                        </div>


      </div>
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="<?php echo base_url('showjob/'.$group['division_id']);?>" class="btn btn-primary">ดูรายละเอียด</a>
      </div>
    </div>
  </div>
  <!-- <div class="col-2"></div> -->
   
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
  

  <?php $this->endSection();?>
</body>

</html>