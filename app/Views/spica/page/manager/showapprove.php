<!DOCTYPE html>
<html lang="en">

<?php echo $this->extend('templates/header'); ?>
<?php echo $this->section('content'); ?>

<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    <?php echo $this->include('templates/menu'); ?>
    <!-- partial -->
    <div class="page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <?php echo $this->include('templates/navbar'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <div class="row mb-4">
                        <?php
                        foreach ($divi as $x) { ?>
                          <div class="col-4">
                            <div class="card" style="margin : 10px">
                              <div class="card-header bg-success text-white">
                                <?php echo $x["d_name"] . "<br>"; ?>
                              </div>
                              <div class="card-body">
                                <ul class="list-group">
                                  <li class="list-group-item">
                                    ต้องดำเนินการ
                                    <?php
                                    foreach ($x["job"] as $y) { ?>
                                      <?php if ($y["status"] == 1) { ?>
                                        <span class="badge badge-danger badge-pill"><?php echo $y["c_job"]; ?></span>
                                      <?php } ?>

                                    <?php } ?>
                                    
                                  </li>
                                  <li class="list-group-item">
                                    กำลังดำเนินการ
                                    <?php
                                    foreach ($x["job"] as $y) { ?>

                                      <?php if ($y["status"] == 2) { ?>
                                        <span class="badge badge-warning badge-pill"><?php echo $y["c_job"]; ?></span>
                                      <?php } ?>

                                    <?php } ?>
                                  </li>
                                  <li class="list-group-item">
                                    รออนุมัติ
                                    <?php
                                    foreach ($x["job"] as $y) { ?>

                                      <?php if ($y["status"] == 3) { ?>
                                        <span class="badge badge-info badge-pill"><?php echo $y["c_job"]; ?></span>
                                      <?php } ?>

                                    <?php } ?>
                                  </li>
                                  <li class="list-group-item">
                                    อนุมัติเสร็จสิ้น
                                    <?php
                                    foreach ($x["job"] as $y) { ?>

                                      <?php if ($y["status"] == 4) { ?>
                                        <span class="badge badge-success badge-pill"><?php echo $y["c_job"]; ?></span>
                                      <?php } ?>

                                    <?php } ?>
                                  </li>
                                  <li class="list-group-item text-center" style="border: none;">
                                  <a href="/listjobapprove/<?php echo $x["d_id"]; ?>">
                                    <button class="btn btn-primary btn-sm">ดูรายละเอียด</button>
                                  </a>
                                  </li>
                                  
                                </ul>
                                  
                               
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </div>

                    </div>

                  </div>
                  <!-- row end -->
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:./partials/_footer.html -->
                <?php echo $this->include('templates/footer'); ?>
                <!-- partial -->
              </div>
              <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
          </div>


          <?php $this->endSection(); ?>
</body>

</html>