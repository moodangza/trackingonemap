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
 

<style>
  .modal {
         position: absolute;
         /* background-color: #fffff4; */
         border: 1px solid #fffff4;
         width: 100%;
         height: 450px;
         top: 20%;
         left: 50%;
         transform: translate(-50%, -50%);
         /* additional styles for the modal */
      }
   .arrowNav{   
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    left: 5%;
    background: #000;
    opacity: 1;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}
#formupdateprocess{
  background-color: #fffff4;
}
 </style> 
 
 <?php 
 print_r($job);
 
 ?>
      <!-- partial -->
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
                <?php   //echo getcwd();; ?>
                <form id="formupdateprocess">
                      <div class="col-3 col-xl-3 grid-margin stretch-card"></div>
                      <div class="col-8 col-xl-8 grid-margin stretch-card">
                        <div class="row w-100 flex-grow">
                          <div class="col-md-12 grid-margin stretch-card">  
                          
                              <ul class="form-header">
                                  <li class="list-header">
                                      <div class="arrowNav">
                                        <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" 
                                          width="36" height="36" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" 
                                        stroke-width="2" 
                                        d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 
                                        5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466
                                         1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023"/>
                                        </svg>
                                        <h5><?php echo $job["job_name"];?></h5>
                                        <input type="hidden" id="flag" value="<?php echo $flag;?>"> 
                                        <h6> <?php echo 'ตั้งแต่วันที่&nbsp;&nbsp;&nbsp;'.$job["job_start"]. '&nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;'. $job["job_end"] ; ?></h6>
                                      </div>
                                  </li>
                              </ul>
                           
                          </div> 
                        </div>
                      </div> 
                      <div class="col-3 col-xl-3 grid-margin stretch-card"></div>
                </form>
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
 <script>
    <?php if($flag=='update'){?>
        $(document).ready(function() {
        $('.formaddsubprocess,.updateprocess').prop('disabled', true).hide();
        });
    <?php }?>

 </script>
   <?php //echo $this->include('templates/footer');?>
  <?php $this->endSection();?>
</body>

</html>