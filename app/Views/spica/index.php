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
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body container">
                     
            <div class="row">          
              <div class="col-lg-12 grid-margin stretch-card">
                <!-- <div class="card"> -->
                  <div class="card-body">
                    <div class="list-group">
                      <a href="#" class="list-group-item list-group-item-action active" aria-current="true">ต้องดำเนินการ</a>
                          <?php $i = 0;?>
                           <?php foreach($dv as $group){?>
                              <ul style="padding-bottom: 2px;" class="list-group">
                                <li class="list-group-item "> 
                                  <div class="row">
                                    <div class="col-lg-9">
                                      <div  nowrap><p class="text-justify" nowrap>
                                        <?php echo $group["division_name"];?></p> 
                                          </div>
                                            </div>
                                              <div class="col-lg-3">
                                                <a href="<?php echo base_url('showjob/'.$group['division_id']);?>" class="btn btn-success">
                                                  <i class="fa fa-eye" aria-hidden="true" ></i> </a>
                                                </div>
                                              </div>
                                            </li>
                                          </ul>
                                            <?php  $i++; }?>
                    </div>
                  </div>
                <!-- </div> -->
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
                            <?php foreach($job as $row){?>
                              <?php if($row['status']==2){?>
                                <ul style="padding-bottom: 2px;" class="list-group">
                                  <li class="list-group-item "> 
                                    <div class="row">
                              <div class="col-lg-9">
                                    <!-- <a href="<?php // echo base_url('showjobselect/'.$row['job_id']);?>" class="list-group-item list-group-item-action"> -->
                                  <?php echo $row['job_name']?>
                                  <br> วันที่เริ่ม : <?php echo $row['job_start']?>
                                  <br> วันที่สิ้นสุด : <?php echo $row['job_end']?>
                                  <!-- </a> -->
                              </div>
                              
                                  <div class="col-3" class="text-right">
                                  <button class="btn btn-warning" onclick="updatejobform(<?php echo $row['job_id'];?>)">
                                    <i class="fa fa-pencil " aria-hidden="true" ></i> 
                                  </button>
                            
                                  <a href="<?php echo base_url('showjobselect/'.$row['job_id']);?>" class="btn btn-success">
                                    <i class="fa fa-eye" aria-hidden="true" ></i> 
                                  </a>

                                  <button class="btn btn-danger" >
                                  <i class="fa fa-trash" aria-hidden="true"></i></i> 
                                  </button>
                                  </div>
                              
                              </div>
                                </li>
                            </ul>
                          <?php }
                        }?>
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
                            <?php foreach($job as $row){?>
                              <?php if($row['job_finish']!='' && $row['status']==2){?>
                                <a href="<?php echo base_url('showjobselect/'.$row['job_id']);?>" class="list-group-item list-group-item-action">
                                <?php echo $row['job_name']?> <br> วันที่เริ่ม :
                                <?php echo $row['job_start']?> <br> วันที่สิ้นสุด :
                                <?php echo $row['job_end']?> </a>
                          <?php }
                        }?>
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
                            <?php foreach($job as $row){?>
                              <?php if($row['status']==3){?>
                                <a href="<?php echo base_url('showjobselect/'.$row['job_id']);?>" class="list-group-item list-group-item-action"><?php echo $row['job_name']?></a>
                          <?php }
                        }?>
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