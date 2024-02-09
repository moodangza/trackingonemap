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

</script>

<style>
          .modal {
         position: absolute;
         background-color: #ffffff;
         border: 1px solid #cccccc;
         width: 500px;
         height: 500px;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         /* additional styles for the modal */
      }
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
                      <!-- <button class="btn btn-success" id="intjob" onclick="openForm()">เพิ่มหัวข้อ</button> -->
                      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">เพิ่มหัวข้อ</button>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" id="staticBackdropLabel">เพิ่มหัวข้อ</h5> -->
        <h5 class="modal-title" id="staticBackdropLabel">เพิ่มหัวข้อ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <label for="inputjob" class="form-label">ชื่อหัวข้อ</label>
        <input type="text" class="form-control" id="job_name" name="job_name">
        <label for="jobstart" class="form-label">วันที่เริ่ม</label>
        <input type="text" class="form-control datepicker-input" id="job_start" readonly name="job_start"> <div class="input-group-append">
                                                    <div  class="input-group-text toggle-datepicker" data-toggle="#create-e-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
        <label for="jobend" class="form-label">วันที่สิ้นสุด</label>
        <input type="text" class="form-control datepicker-input" id="job_end" readonly name="job_end"> <div class="input-group-append">
                                                    <div  class="input-group-text toggle-datepicker" data-toggle="#create-e-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="addjob()">บันทึก</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
    </div>
    </div>
    <br>   <br>   <br>
    
  <!-- formodalupdate -->
    <div id="myModaledit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" id="staticBackdropLabel">เพิ่มหัวข้อ</h5> -->
        <h5 class="modal-title" id="staticBackdropLabel">แก้ไขหัวข้อ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <input type="hidden" class="form-control" id="editjob_id" name="editjob_id">
      <div class="modal-body">
      <label for="inputjob" class="form-label">ชื่อหัวข้อ</label>
        <input type="text" class="form-control" id="editjob_name" name="editjob_name">
        <label for="editjobstart" class="form-label">วันที่เริ่ม</label>
        <input type="text" class="form-control datepicker-input" id="editjob_start" readonly name="editjob_start"> <div class="input-group-append">
                                                    <div  class="input-group-text toggle-datepicker" data-toggle="#create-e-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
        <label for="editjobend" class="form-label">วันที่สิ้นสุด</label>
        <input type="text" class="form-control datepicker-input" id="editjob_end" readonly name="editjob_end"> <div class="input-group-append">
                                                    <div  class="input-group-text toggle-datepicker" data-toggle="#create-e-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="editjob()">บันทึก</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
    </div>
    </div>
    

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
                                <a href="<?php echo base_url('showjobselect/'.$row['job_id']);?>" class="list-group-item list-group-item-action">
                                <?php echo $row['job_name']?>
                                <br> วันที่เริ่ม : <?php echo $row['job_start']?>
                                <br> วันที่สิ้นสุด : <?php echo $row['job_end']?></a>
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
                                <ul style="padding-bottom: 2px;" class="list-group">
                                  <li class="list-group-item "> 
                                    <!-- <a href="<?php // echo base_url('showjobselect/'.$row['job_id']);?>" class="list-group-item list-group-item-action"> -->
                                  <?php echo $row['job_name']?>
                                  <br> วันที่เริ่ม : <?php echo $row['job_start']?>
                                  <br> วันที่สิ้นสุด : <?php echo $row['job_end']?>
                                  <!-- </a> -->
                                  <br>
                                  <div class="text-right">
                                  <button class="btn btn-warning" onclick="updatejob(<?php echo $row['job_id'];?>)">
                                    <i class="fa fa-pencil " aria-hidden="true" ></i> 
                                  </button>
                            
                                  <a href="<?php echo base_url('showjobselect/'.$row['job_id']);?>" class="btn btn-success">
                                    <i class="fa fa-eye" aria-hidden="true" ></i> 
                                  </a>
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

            <div class="col-lg-5 grid-margin stretch-card">
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

            <div class="col-lg-5 grid-margin stretch-card">
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
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Financial management review</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            User
                          </th>
                          <th>
                            First name
                          </th>
                          <th>
                            Progress
                          </th>
                          <th>
                            Amount
                          </th>
                          <th>
                            Deadline
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="py-1">
                            <img src="spica_rs/images/faces/face1.jpg" alt="image"/>
                          </td>
                          <td>
                            Herman Beck
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="spica_rs/images/faces/face2.jpg" alt="image"/>
                          </td>
                          <td>
                            Messsy Adam
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $245.30
                          </td>
                          <td>
                            July 1, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="spica_rs/images/faces/face3.jpg" alt="image"/>
                          </td>
                          <td>
                            John Richards
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $138.00
                          </td>
                          <td>
                            Apr 12, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="spica_rs/images/faces/face4.jpg" alt="image"/>
                          </td>
                          <td>
                            Peter Meggik
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="spica_rs/images/faces/face5.jpg" alt="image"/>
                          </td>
                          <td>
                            Edward
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 160.25
                          </td>
                          <td>
                            May 03, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="spica_rs/images/faces/face6.jpg" alt="image"/>
                          </td>
                          <td>
                            John Doe
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 123.21
                          </td>
                          <td>
                            April 05, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            <img src="spica_rs/images/faces/face7.jpg" alt="image"/>
                          </td>
                          <td>
                            Henry Tom
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 150.00
                          </td>
                          <td>
                            June 16, 2015
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- row end -->
          <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card bg-facebook d-flex align-items-center">
                <div class="card-body py-5">
                  <div
                    class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                    <i class="mdi mdi-facebook text-white icon-lg"></i>
                    <div class="ml-3 ml-md-0 ml-xl-3">
                      <h5 class="text-white font-weight-bold">2.62 Subscribers</h5>
                      <p class="mt-2 text-white card-text">You main list growing</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card bg-google d-flex align-items-center">
                <div class="card-body py-5">
                  <div
                    class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                    <i class="mdi mdi-google-plus text-white icon-lg"></i>
                    <div class="ml-3 ml-md-0 ml-xl-3">
                      <h5 class="text-white font-weight-bold">3.4k Followers</h5>
                      <p class="mt-2 text-white card-text">You main list growing</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card bg-twitter d-flex align-items-center">
                <div class="card-body py-5">
                  <div
                    class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                    <i class="mdi mdi-twitter text-white icon-lg"></i>
                    <div class="ml-3 ml-md-0 ml-xl-3">
                      <h5 class="text-white font-weight-bold">3k followers</h5>
                      <p class="mt-2 text-white card-text">You main list growing</p>
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
  <!-- container-scroller -->
  <!-- <div class="modal_fade modal-dialog modal-md" id='jobadd' tabindex='-1' role='dialog' >
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                 <div class="modal-body">
                 <h4 class="modal-title" id="modalpreviewlabel">เพิ่มข้อมูล</h4>                                     
                 <form class="row g-3">
  <div class="col-md-12">
    <label for="inputjob" class="form-label">ชื่อหัวข้อ</label>
    <input type="email" class="form-control" id="job_name" name="job_name">
  </div>
  <div class="col-md-6">
    <label for="jobstart" class="form-label">วันที่เริ่ม</label>
    <input type="text" class="form-control" id="date_start" name="job_start">
  </div>
  <div class="col-6">
  <label for="jobend" class="form-label">วันที่สิ้นสุด</label>
    <input type="text" class="form-control" id="date_end" name="job_end">
  </div>
<br>
<div class="col-6">
 <br><br>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">บันทึก</button>
  </div>
</form>
                 </div>
            </div>
        </div>
      </div>
  </div> -->

  <?php $this->endSection();?>
</body>

</html>