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

 <div class="row">
   <?php foreach($dv as $group){?>
  <div class="col-sm-4">
    <div class="card" style="margin: 10px;">
      <div class="card-body">
      <div  nowrap><p class="text-justify" nowrap>
                                        <?php echo $group["division_name"];?></p>

                                        จำนวนงานทั้งหมด : <?php ?>
                                        <br> จำนวนงานที่ดำเนินการแล้ว : <?php ?>
                                        <br> จำนวนงานที่คงเหลือ : <?php ?>     
                                      </div>
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="<?php echo base_url('showjob/'.$group['division_id']);?>" class="btn btn-primary">ดูรายละเอียด</a>
      </div>
    </div>
  </div>
   <?php }?>
</div>

                     
            <div class="row">          
              <div class="col-lg-12 grid-margin stretch-card">
                <!-- <div class="card"> -->
                  <div class="card-body">
                    <div class="row mb-4"> 
                    <?php $i = 0;?>
                           <?php foreach($dv as $group){?>
                            <div class="col-4 card"> 
                            <div class="col-lg-9">
                                      <div  nowrap><p class="text-justify" nowrap>
                                        <?php echo $group["division_name"];?></p>

                                        จำนวนงานทั้งหมด : <?php ?>
                                        <br> จำนวนงานที่ดำเนินการแล้ว : <?php ?>
                                        <br> จำนวนงานที่คงเหลือ : <?php ?>     
                                      </div>
                            </div>
                                              <div class="col-lg-3">
                                                <a href="<?php echo base_url('showjob/'.$group['division_id']);?>" class="btn btn-success">
                                                  <i class="fa fa-eye" aria-hidden="true" ></i> </a>
                                              </div>
                            </div>
                            <?php }?>
                      </div>
                    </div>
                
                  </div>
                <!-- </div> -->
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