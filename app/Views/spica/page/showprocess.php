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
        <div class="container">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">ขั้นตอนการทำงาน</h4>
                  <div class="draggable-container">
                  <ol class="list-group list-group-numbered">    
                         <div id='processitem'>
                              
                         </div>
                                <!-- <a href="#" id='processitem' class="list-group-item list-group-item-action"></a> -->
                        </ol>
                    </div>
              
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">จบขั้นตอนการทำงาน</h4>
                  <div class="draggable-container">
                  <ol class="list-group list-group-numbered">    
                         <div id='finishprocessitem'>
                              
                         </div>
                                <!-- <a href="#" id='processitem' class="list-group-item list-group-item-action"></a> -->
                        </ol>
                    </div>
                </div>
              </div>
            </div>
          </div>
          </div>
        
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