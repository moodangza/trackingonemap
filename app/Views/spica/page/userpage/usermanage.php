<!DOCTYPE html>
<html lang="en">

<?php echo $this->extend('templates/header'); ?>
<?php echo $this->section('content'); ?>
<style>
  .bookmark-post .favorite-icon a,
  .job-box.bookmark-post .favorite-icon a {
    background-color: #da3746;
    color: #fff;
    border-color: danger;
  }

  .favorite-icon a {
    display: inline-block;
    width: 30px;
    height: 30px;
    font-size: 18px;
    line-height: 30px;
    text-align: center;
    border: 1px solid #eff0f2;
    border-radius: 6px;
    color: rgba(173, 181, 189, .55);
    -webkit-transition: all .5s ease;
    transition: all .5s ease;
  }


  .candidate-list-box .favorite-icon {
    position: absolute;
    right: 22px;
    top: 22px;
  }

  .fs-14 {
    font-size: 14px;
  }

  .modal {
    position: absolute;
    background-color: #ffffff;
    border: 1px solid #cccccc;
    width: 85%;
    height: auto;
    top: 65%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <?php //print_r($_SESSION); ?>
        <div class="modal fade modal-lg" id="manageusermodal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="manageusermodalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="manageusermodalLongTitle">รายละเอียด</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-12">
                    <div class="card" style="height: 100%;">

                      <div class="card-body">
                        <ul class="list-group list-group-horizontal-md">
                          <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                            <label for="staticusername" class="col-form-label">Username</label>
                          </div>
                          <div class="list-group-item col-10 form-floating">
                            <div class="p-2 g-col-6">
                              <input type="text" readonly class="form-control" id="staticusername" value="" onchange="ckdupuser();">
                              <div id='#user'></div>
                            </div>
                          </div>
                        </ul>
                        <ul class="list-group list-group-horizontal-md">
                          <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                            <label for="password" class="col-form-label">Password</label>
                          </div>
                          <div class="list-group-item col-10 form-floating">
                            <div class="p-2 g-col-6">
                              <input type="password" class="form-control" id="password" maxlength="25" placeholder="Password">
                              <small id="password" class="text-muted">
                                สามารถใส่รหัสผ่านได้สูงสุด 25 ตัว
                              </small>
                              <div id='#user'></div>
                            </div>
                          </div>
                        </ul>
                        <ul class="list-group list-group-horizontal-md">
                          <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                            <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">เลือกประเภทผู้ใช้</label>
                          </div>
                          <div class="list-group-item col-10 form-floating">
                            <div class="p-2 g-col-6">
                              <select id="level" style="width: fit-content;" class="form-select" aria-label="Default select example">
                                <option value="user">ผู้ใช้ทั่วไป</option>
                                <option value="aprove">ผู้อนุมัติ</option>
                              </select>
                            </div>
                          </div>
                        </ul>
                        <ul class="list-group list-group-horizontal-md">
                          <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                            <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ข้อมูลทั่วไป</label>
                          </div>
                          <div class="list-group-item col-10 form-floating">
                            <div class="p-2 g-col-6">
                              <select id="prefix" style="width: fit-content;" class="form-select" aria-label="Default select example">
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                              </select>
                                                           
                                <input type="text" class="form-control col-9" id="staticname" placeholder="ชื่อ" value="">
                               
                                <input type="text" class="form-control col-9" id="staticsurname" placeholder="นามสกุล" value="">

                              <input type="text" class="form-control col-9" id="position" placeholder="ตำแหน่ง" value="">
                            </div>
                          </div>
                        </ul>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer ">
                <div class="text-center">
                  <button type="button" class="btn btn-danger closemodal" data-dismiss="modal">Close</button>
                  <button id="actionbutton" class="btn btn-warnning"></button>
                  <!-- <div id="actionbutton"></div> -->

                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="row">
                  <div class="col-12 col-xl-12 grid-margin stretch-card">
                    <div class="row w-100 flex-grow" style="justify-content: center">
                      <?php echo $division_rs['division_name']; ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-head bg-primary text-center" style="padding: 10px;color:white;">
                      <b>ผู้ใช้งาน</b>
                    </div>
                    <div class="card-body ">
                      <button class="btn btn-primary" onclick="adduserform('adduser');">เพิ่มผู้ใช้ <i class="fa fa-plus-square"></i></button>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">username</th>
                            <th scope="col">ชื่อ-สกุล</th>
                            <th scope="col">ตำแหน่ง</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1;
                          foreach ($user_rs as $rs) { ?>
                            <tr>
                              <th scope="row"> <?php echo $i;
                                                $i++; ?></th>
                              <td><?php echo $rs["user_name"]; ?> </td>
                              <td><?php echo $rs["prefix"] . " " . $rs["name"] . " " . $rs["surname"]; ?></td>
                              <td><?php echo $rs["position"]; ?></td>
                              <td><?php if ($rs["level"] == 'aprove') {
                                    echo 'ผู้อนุมัติงาน';
                                  } else {
                                    echo 'ผู้ใช้ทั่วไป';
                                  } ?>
                              </td>
                              <td>
                                <button class="btn btn-warning" onclick="manageuserform('<?php echo $rs['user_id']; ?>')">
                                  <i class="fa fa-pencil " aria-hidden="true"></i>
                                </button>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>


                    </div>

                    <!-- row end -->
                  </div>
                </div>

                <!-- main-panel ends -->
              </div>
              <!-- page-body-wrapper ends -->
            </div>
          </div>
          <!-- main-panel ends -->
          <?php echo $this->include('templates/footer'); ?>
        </div>
        <!-- page-body-wrapper ends -->

      </div>

      <!-- content-wrapper ends -->
      <!-- partial:./partials/_footer.html -->

      <!-- partial -->

      <?php $this->endSection(); ?>
</body>

</html>