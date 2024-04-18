<!DOCTYPE html>
<html lang="en">

<?php echo $this->extend('templates/header'); ?>
<?php echo $this->section('content'); ?>
<style>
      .draggable-container {
  background-color: #bddad5;
  padding: 1rem;
  margin: 1rem 0;
  width: 100%;
  border-radius: 5px;
  box-shadow: 10px 15px 20px #1e192844;
}
.shallow-draggable {
  background-color: #f1edf3;
  color: black;
  padding: 1rem;
  margin-top: 2rem;
  border-radius: 5px;
  transition: opacity 200ms ease;
}

.dragging {
  opacity: 0.5;
  transition: opacity 1s ease;
}
      </style>
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
            <div class="container">
            <div class="row row-cols-auto">
              <div class="col">  
            <select class="form-select selectjob" aria-label="Default select example" style="width:auto;">
                <option value="0" selected>เลือกหัวข้อ</option>
                <?php foreach($job as $opj){?>
                
                  <option value="<?php echo $opj['job_id'];?>" <?php echo (isset($job_id) && $opj['job_id']==$job_id) ?'selected': '' ?>>
                      <?php echo $opj['job_name'];?>
                  </option>
              
                <?php }?>
            </select>
            </div>
            <!-- <div class="draggable-container">
      <h1 class="title">Pick from here</h1>
      <p class="shallow-draggable" draggable="true">1</p>
      <p class="shallow-draggable" draggable="true">2</p>
    </div>
    <div class="draggable-container">
      <h1 class="title">Put it here !!!</h1>
      <p class="shallow-draggable" draggable="true">3</p>
      <p class="shallow-draggable" draggable="true">4</p>
    </div> -->
            <div class="col">
                 
              <a id="urladdprocess" href="<?php echo base_url('formprocess');?>"><button  class="btn btn-success btn-sm addprocess">
                เพิ่มขั้นตอนการทำงาน
              </button>
                </a>

              <div id="addjob_id" >
                  
              </div>
            </div>
            </div>
            </div>
            <br>

            <div class="justify-content-center">
                        <div class="card">
                          <h5 class="card-header bg-warning text-black text-center" >ขั้นตอนการทำงาน</h5>
                            <div class="card-body">
                              <div class="row">
                                  <div class="col-6">
                                  <div class="card" style="margin: 10px;" bg-primary>
                                  <h6 class="card-header bg-success text-center text-white">ขั้นตอนการทำงาน</h6>
                                  <div class= "card-body">
                                  <div class="row" nowrap>
                                  <div class="col-12">                             
                                  <div id='processitem'>
                              
                              </div>
                                            
                                                                      
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  <div class="col-6">
                                  <div class="card" style="margin: 10px;" bg-primary>
                                  <h6 class="card-header bg-success text-center text-white">จบขั้นตอนการทำงาน</h6>
                                  <div class= "card-body">
                                  <div class="row" nowrap>
                                  <div class="col-12">                             
                                  <div id='finishprocessitem'>
                              
                              </div>
                                            
                                                                      
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                </div>
              </div>
            </div>
          </div>
        
          </div>
          <?php //echo $this->include('templates/footer');?>
         
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
    
        <!-- partial -->
    
  <script>
  <?php 
if ($job_id){?>
jobselect(<?php echo $job_id;?>)
<?php }  
  ?>
  </script>
  <?php $this->endSection();?>
</body>

</html>