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
 <?php 
      foreach($job as $rs){
          $job_id = $rs["job_id"];
          $job_name = $rs["job_name"];
          $job_start = $rs["job_start"];
          $job_end = $rs["job_end"];
      }
 ?>
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
                    <div class="text-center" style=" margin-bottom: 0.5rem;">
                    <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-user"></i> เพิ่มขั้นตอนการทำงาน</h3>
                </div>
                <div class="card-body form">
                    <div class="form-horizontal form-input" role="form">
                        <div class="row">
                            <div class="col-12 col-md-12 col-xl-12">
                                <div class="form-group row">
                                  
                                    <label class="col-12 col-md-12 col-xl-12 col-form-label text-center"> <h3><?php echo $job_name;?></h3>  </label>
                                    <input type="hidden" name="job_id" value="<?php echo $job_id;?>">
                                </div>
                            </div>
                         
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-12 col-md-12 col-xl-6">
                                <div class="form-group row">
                                    <label class="col-4 col-md-4 col-xl-4 col-form-label">วันที่เริ่ม : </label>
                                    <label class="col-8 col-md-8 col-xl-8 col-form-label text-left"><?php echo $job_start;?></label>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-12 col-md-12 col-xl-6">
                                <div class="form-group row">
                                    <label class="col-4 col-md-4 col-xl-4 col-form-label">วันที่สิ้นสุด : </label>
                                    <label class="col-8 col-md-8 col-xl-8 col-form-label text-left">
                                    <?php echo $job_end;?>
                                    </label>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        
                    </div>
                </div>
            </div>
</div>
                   
<div class="card">
                    <div class="card-body">
                        <div class="form-body">
                                                        <div class="row">
                                <div class="col-12 col-md-12 col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4"> ขั้นตอนการทำงาน</label>
                                        <div class="col-md-8">
                                            <input type="text" id="process_name" name="process_name" class="form-control" placeholder="เรื่อง" value="" required="">

                                        </div>
                                    </div>
                                </div>
                             
                                <!--/span-->

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">วันที่เริ่มขั้นตอนการทำงาน</label>
                                        <div class="col-md-8">
                                            <div class="input-group date">
                                                <input type="text" id="s_date" readonly="readonly" class="form-control datepicker create-s-date" name="s_date" data-old="" value="">
                                                <div class="input-group-append">
                                                    <div required class="input-group-text toggle-datepicker" data-toggle="#create-s-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div id="countLeave" class="col-3 col-form-label"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-12 col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">จนถึงวันที่</label>
                                        <div class="col-md-8">
                                            <div class="input-group date">
                                                <input type="text" required readonly="readonly" id="e_date" class="form-control  datepicker-input create-e-date" name="e_date" data-old="" value="">
                                                <div class="input-group-append">
                                                    <div  class="input-group-text toggle-datepicker" data-toggle="#create-e-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                    <div class="col-12 col-md-12 col-xl-8">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3">
                                              <button class="btn btn-success addsubprocess">เพิ่มขั้นตอนการทำงานย่อย</button>
                                            </label>
                                        
                                        </div>
                                        <div class="subprocess">

                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-12 text-center">
                                          <button class="btn btn-success insertprocess">บันทึก</button>
                                    </div>
                            </div>
                          
                            
                                                          
                          
                        </div>
                    </div>
                </div>
            </div>
           
          </div>
        
     
    </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
       
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  
   <?php echo $this->include('templates/footer');?>
  <?php $this->endSection();?>
</body>

</html>