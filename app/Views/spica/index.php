<!DOCTYPE html>
<html lang="en">

<?php echo $this->extend('templates/header'); ?>
<?php echo $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                    <div class="card">
  <h5 class="card-header bg-info text-center">ความก้าวหน้าการดำเนินการทั้งหมด</h5>
  <?php //print_r($_SESSION);?>
  <div class="card-body">
  <div class="row">
                                    <div class="col-6 pe-0">
                                    จำนวนหน่วยงานทั้งหมด :  <?php echo count($job) .' หน่วยงาน' ?>    
                                    <br> หน่วยงานที่ทำงานเสร็จแล้ว :  <?php echo $total_ts .' หน่วยงาน'  ?>        
                                    <br> จำนวนงานทั้งหมด :  <?php echo $total_c ?>                                      
                                    <br> จำนวนงานรวมที่ต้องดำเนินการ : <?php echo $total_a  ?>
                                    <br> จำนวนงานรวมที่กำลังดำเนินการ : <?php echo $total_p  ?>
                                    <br> จำนวนงานรวมที่รออนุมัติ : <?php echo $total_w ?>
                                    <br> จำนวนงานรวมที่ดำเนินการเสร็จแล้ว : <?php echo $total_s ?>
                                    <br> จำนวนงานรวมที่คงเหลือ : <?php echo $total_c-$total_s ?> 
                                    <br> ร้อยละความก้าวหน้าจากหน่วยงานทั้งหมด (%) : <?php if ($total_s!=0 && $total_a!=0 ){
                                                                        echo number_format( ($total_s/$total_c)*100, 2 ).'%'   ;
                                                                        } else {
                                                                          echo "ยังไม่มีงานที่สำเร็จ";
                                                                        } ?>                                                             
                                  </div>
                                  <div class="col-3 ps-0 "> 
                                  <!-- ชาร์ตแสดงงาน -->
                                  <div class="donut-container">
                                  <div class="chart-container"  style="position: relative; height:25vh; width:80vw">
                                  <canvas id="donut-chart"></canvas>
                                  </div>
                                  </div>
                                  </div>
                                  <!-- ชาร์ตแสดงงาน -->
                                  <div class="col-3 ps-0 ">
                                  <div class="donut-container">
                                  <div class="chart-container"  style="position: relative; height:25vh; width:80vw">
                                  <canvas id="donut-charta"></canvas>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
  </div>
</div>
<br>
                                <!-- <div class="col-12"> -->
                                  <!-- <div class="card" style="margin: 10px;" bg-primary> -->                              
                                  
                                  <!-- </div> -->
                                <!-- </div> -->
                      <div class="justify-content-center">
                        <div class="card">
                          <h5 class="card-header bg-warning text-black text-center" >ความก้าวหน้าการดำเนินงานแต่ละหน่วยงาน</h5>
                            <div class="card-body">
                              <div class="row">
                                  <?php foreach($job as $group){?>

                                  <div class="col-6">
                                  <div class="card" style="margin: 10px;" bg-primary>
                                  <h6 class="card-header bg-success text-center text-white"><?php echo $group["division_name"];?></h6>
                                  <div class= "card-body">
                                  <div class="row" nowrap>
                                
                                  <div class="col-7">
                                                                        
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
                                            <br>
                                            <a href="<?php echo base_url('showjob/'.$group['division_id']);?>" class="btn btn-primary mt-4">ดูรายละเอียด</a>
                                                                      
                                  </div>
                                  <div class="col-5">
                                  <div class="donut-container" style="text-align: center;">
                                  <div class="container"  style="width: 100%; display: inline-block;">
                                  <canvas id="donut-chart<?php echo $group['division_id'] ;?>"></canvas>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  </div>
    <script> //ตั้งค่าชาร์ตแสดงงาน
    // Data for the donut chart (Group 2 first, then Group 1)
    const data<?php echo $group['division_id'] ;?> = {
    labels: ['จำนวนงานที่เสร็จแล้ว', 'จำนวนงานที่คงเหลือ'], // Swap the order of labels
    datasets: [{
        data: [<?php echo $group["s_job"]; ?>,<?php echo $group["c_job"]-$group["s_job"]; ?>], // Swap the order of data values
        backgroundColor: ['#A1A5B7', '#F1BC00'], // Colors for each group
    }]
};

// Configuration for the chart
const config<?php echo $group['division_id'] ;?> = {
    type: 'doughnut', // Use doughnut chart type for a donut chart
    data: data<?php echo $group['division_id'] ;?>,
    options: {
        rotation: -90, 
        circumference: 180,
        cutout: '70%', // Cutout percentage for a 180-degree chart
        plugins: {
            legend: {
                display: true, // Hide the legend if not needed
                position: 'bottom' 
            },
        },
    },
};

// Get the canvas element and create the chart
const canvas<?php echo $group['division_id'] ;?> = document.getElementById('donut-chart<?php echo $group['division_id'] ;?>');
const ctx<?php echo $group['division_id'] ;?> = canvas<?php echo $group['division_id'] ;?>.getContext('2d');
new Chart(ctx<?php echo $group['division_id'] ;?>, config<?php echo $group['division_id'] ;?>);
</script>
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
              
             <?php echo $this->include('templates/footer');?>
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
  
<script> //ตั้งค่าชาร์ตแสดงงาน
// Data for the donut chart (Group 2 first, then Group 1)
const data = {
    labels: ['จำนวนหน่วยงานที่งานเสร็จแล้ว', 'จำนวนหน่วยงานที่งานยังไม่เสร็จ'], // Swap the order of labels
    datasets: [{
        data: [<?php echo $total_ts ?>,<?php echo count($job) ?>], // Swap the order of data values
        backgroundColor: ['#F1BC00','#A1A5B7'], // Colors for each group
    }]
};

// Configuration for the chart
const config = {
    type: 'doughnut', // Use doughnut chart type for a donut chart
    data: data,
    options: {
        rotation: -90, 
        circumference: 180,
        cutout: '70%', // Cutout percentage for a 180-degree chart
        plugins: {
            legend: {
                display: true, // Hide the legend if not needed
            },
        },
    },
};

// Get the canvas element and create the chart
const canvas = document.getElementById('donut-chart');
const ctx = canvas.getContext('2d');
new Chart(ctx, config);
</script>

<script> //ตั้งค่าชาร์ตแสดงงาน
// Data for the donut chart (Group 2 first, then Group 1)
const dataa = {
    labels: ['จำนวนงานรวมที่เสร็จแล้ว', 'จำนวนงานรวมที่คงเหลือ'], // Swap the order of labels
    datasets: [{
        data: [<?php echo $total_s ?>,<?php echo $total_c-$total_s ?>], // Swap the order of data values
        backgroundColor: ['#2ECC71', '#F1BC00'], // Colors for each group
    }]
};

// Configuration for the chart
const configa = {
    type: 'doughnut', // Use doughnut chart type for a donut chart
    data: dataa,
    options: {
        rotation: -90, 
        circumference: 180,
        cutout: '70%', // Cutout percentage for a 180-degree chart
        plugins: {
            legend: {
                display: true, // Hide the legend if not needed
            },
        },
    },
};

// Get the canvas element and create the chart
const canvasa = document.getElementById('donut-charta');
const ctxa = canvasa.getContext('2d');
new Chart(ctxa, configa);
</script>

  <?php $this->endSection();?>
</body>

</html>