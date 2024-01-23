<!DOCTYPE html>
<html lang="en">

<?php echo $this->extend('templates/header'); ?>
<?php echo $this->section('content'); ?>

<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
   <?php echo $this->include('templates/menu');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
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
                    <div class="card-body container">
                      <button class="btn btn-success" id="intjob">เพิ่มหัวข้อ</button>
                      <br>   <br>   <br>

                      <!-- <div class="row mb-3">
                        <div class="col-md-12">
                          <div class="d-flex justify-content-between traffic-status">
                            <div class="item">                           
                              <div ondrop="drop(event)" ondragover="allowDrop(event)" class="row" style="margin-bottom: 2px">
                              <div class="container"> -->
            <div class="row">          
            <div class="col-lg-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 
                  <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            ต้องดำเนินการ
                            </a>
                            <?php foreach($job as $row){?>
                              <?php if($row['status']==1){?>
                                <a href="#" class="list-group-item list-group-item-action"><?php echo $row['job_name']?></a>
                          <?php } 
                        }?>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-lg-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            อยู่ระหว่างดำเนินการ
                            </a>
                            <?php foreach($job as $row){?>
                              <?php if($row['status']==2){?>
                                <a href="#" class="list-group-item list-group-item-action"><?php echo $row['job_name']?></a>
                          <?php }
                        }?>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-lg-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            รออนุมัติ
                            </a>
                            <?php foreach($job as $row){?>
                              <?php if($row['status']==2){?>
                                <a href="#" class="list-group-item list-group-item-action"><?php echo $row['job_name']?></a>
                          <?php }
                        }?>
                    </div>
                </div>
              </div>
            </div>

            <div class="col-lg-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            เสร็จสิ้น
                            </a>
                            <?php foreach($job as $row){?>
                              <?php if($row['status']==3){?>
                                <a href="#" class="list-group-item list-group-item-action"><?php echo $row['job_name']?></a>
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
  

  <?php $this->endSection();?>
</body>

</html>