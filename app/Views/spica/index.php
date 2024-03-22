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
                                <!-- <div class="col-12"> -->
                                  <!-- <div class="card" style="margin: 10px;" bg-primary> -->
                                  <div class="list-group">
                                  <li class="list-group-item css.active bg-info">
                                    <?php ?> <center> ความก้าวหน้าการดำเนินการทั้งหมด </center>
                                    </li>
                                    <?php  ?>
                                    <li class="list-group-item">
                                    จำนวนหน่วยงานทั้งหมด :  <?php echo count($job) .' หน่วยงาน' ?>    
                                    <br> จำนวนงานทั้งหมด :  <?php echo $total_c ?>                                      
                                    <br> จำนวนงานที่ต้องดำเนินการ : <?php echo $total_a  ?>
                                    <br> จำนวนงานที่กำลังดำเนินการ : <?php echo $total_p  ?>
                                    <br> จำนวนงานที่รออนุมัติ : <?php echo $total_w ?>
                                    <br> จำนวนงานที่ดำเนินการเสร็จแล้ว : <?php echo $total_s ?>
                                    <br> จำนวนงานที่คงเหลือ : <?php echo $total_c-$total_s ?> 
                                    <br> ร้อยละความก้าวหน้าจากหน่วยงานทั้งหมด (%) : <?php if ($total_s!=0 && $total_a!=0 ){
                                                                        echo number_format( ($total_s/$total_c)*100, 2 ).'%'   ;
                                                                        } else {
                                                                          echo "ยังไม่มีงานที่สำเร็จ";
                                                                        } ?>                                                             
                                  </li>
                                  </div>
                                  <?php ?>
                                  <br>
                                  <!-- </div> -->
                                <!-- </div> -->
                      <div class="justify-content-center">
                        <div class="card">
                          <div class="card-header bg-warning text-black text-center" >ความก้าวหน้าการดำเนินงานแต่ละหน่วยงาน</div>
                            <div class="card-body">
                              <div class="row">
                                  <?php foreach($job as $group){?>
                                  <div class="col-6">
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
                                                                        <br> ร้อยละความก้าวหน้า (%) : <?php if ($group["s_job"]!=0 && $group["a_job"]!=0 ){
                                                                        echo number_format( ($group["s_job"]/$group["c_job"])*100, 2 ).'%'   ;
                                                                        } else {
                                                                          echo "ยังไม่มีงานที่สำเร็จ";
                                                                        } 
                                                                        ?>                                                             
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
                      <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
          <?php echo $this->include('templates/footer');?>
        <!-- partial -->
            </div>
           
          </div>
  
          <!-- row end -->
          
          <!-- row end -->
        </div>

      </div>
  

  <?php $this->endSection();?>
</body>

</html>