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
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
        <?php   //echo getcwd();; ?>
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body container">
                    <div class="container text-center">
                    <?php foreach($job as $row){
         $job_name = $row["job_name"];
         $job_date_start = $row["job_start"];
         $job_date_end = $row["job_end"];
         } ?>
  <div class="row">
    <div class="col">
   
    </div>
    <div class="col">
         <?php echo $job_name;?>
    </div>
    <div class="col">
   
    </div>
  </div>
  <div class="row">
    <div class="col">
   
    </div>
    <div class="col">
    <?php echo $job_date_start;?>
    </div>
    <div class="col">
   
    </div>
  </div>
</div>
                   
                    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">ขั้นตอนการทำงาน</label>
      <input type="text" class="form-control process-name" id="processname" value="">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    
                        <!-- </div>
                       
                      </div>
                    
                    </div>
                  </div>
                </div>
              
            
              </div> -->
            </div>
           
          </div>
        
     
        </div>

        <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body container">
                    <div class="container text-center">
  <div class="row row-cols-4">


    <div class="col">Column</div>
    <?php foreach($job as $opj){?>
    <div class="col">Column</div>
    <?php }?>
    <div class="col">Column</div>
    <div class="col">Column</div>
  </div>
</div>
                   
                    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">ขั้นตอนการทำงานย่อย</label>
      <input type="text" class="form-control process-name" id="processname" value="">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    
                        <!-- </div>
                       
                      </div>
                    
                    </div>
                  </div>
                </div>
              
            
              </div> -->
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