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


      <style>
     
        .modal {
          position: absolute;
          background-color: #dddddd;
          border: 1px solid #fffff4;
          width: 60%;
          height: fit-content;
          /* top: 50%;
         left: 50%;
         transform: translate(-50%, -50%); */
          padding: 0;
          box-shadow: 0 0 0 40vmax rgba(0,0,0,.5);
          /* additional styles for the modal */
        }

        .form-control {
          display: inline;
          width: inherit;
          border-top: 0px;
          border-left: 0px;
          border-right: 0px;
        }

        .arrowNav {
          position: absolute;
          top: 0;
          width: 100%;
          height: 100%;
          left: 5%;
          background: #000;
          opacity: 1;
        }

        ul {
          /* list-style-type: none; */
          margin: 0;
          padding: 0;

        }

        #formupdateprocess>ul {
          box-shadow: 5px 10px #888888;
          margin-bottom: 2px;
        }

        .em {
          color: red;
        }
      </style>

      <?php
      //  print_r($job);

      ?>
      <!-- partial -->
     
        <div class="modal fade modal-xl" id="exampleModalToggle" data-backdrop="false" aria-labelledby="exampleModalToggleLabel" tabindex="-1" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-xl ">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title fs-4 text-center" id="exampleModalToggleLabel">เพิ่มขั้นตอนการทำงานย่อย</h3>
                <button type="button" class="btn-close modalclose" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row g-3">
                  <div class="col-md">
                    <figure class="text-left">

                      <h3><?php echo $job["job_name"]; ?></h3>


                      <?php echo 'วันที่เริ่มต้น&nbsp;&nbsp;&nbsp;' . $job["job_start"] . '&nbsp;&nbsp;&nbsp;วันที่สิ้นสุด&nbsp;&nbsp;&nbsp;' . $job["job_end"]; ?>

                    </figure>
                  </div>
                </div>
                <div class="row g-3">

                  <ul class="list-group list-group-horizontal-md ">
                    <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                      ขั้นตอนการทำงานย่อย <em class="em">*</em>
                    </div>


                    <div class="list-group-item col-10 form-floating">
                      <input type="hidden" id="sub_id" value="">
                      <input type="text" autocomplete="off" class="form-control" id="subprocessinput" name="subprocessinput" placeholder="จัดทำร่าง พรบ." value="">
                      <label for="floatingInputGrid">ขั้นตอนการทำงานย่อย</label>
                    </div>

                  </ul>
                  <ul class="list-group list-group-horizontal-md ">
                    <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                      ระยะเวลาการทำงาน <em class="em">*</em>
                    </div>
                    <div class="list-group-item col-10 form-floating">
                      <div class="p-2 g-col-6">
                        <input type='text' id='s_sub_date' readonly='readonly' class='form-control datepicker create-s-date' name='s_sub_date' data-old='' value=''>

                        ถึง
                        <input type='text' id='e_sub_date' readonly='readonly' class='form-control datepicker create-s-date' name='e_sub_date' data-old='' value=''>

                      </div>
                    </div>
                  </ul>


                </div>

              </div>
              <div class="modal-footer">

                <button class="btn btn-primary addsubprocess" type="button">บันทึก</button>

                <button class="btn btn-primary updatesubprocess" type="button">แก้ไข</button>

                <button class="btn btn-danger cancel" type="button">ปิด</button>
              </div>
            </div>
          </div>
        </div>
     
      <div class="main-panel">
        <div class="container">
          <div class="row">
            <?php   //echo getcwd();; 
            ?>
            <form id="formupdateprocess">

              <ul class="list-group list-group-horizontal-md d-block ">
                <li class="list-group-item">
                  <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 
                                        5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466
                                         1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023" />
                  </svg>
                  <h5><?php echo $job["job_name"]; ?></h5>
                  <input type="hidden" id="flag" value="<?php echo $flag; ?>">
                  <h6> <?php echo 'ตั้งแต่วันที่&nbsp;&nbsp;&nbsp;' . $job["job_start"] . '&nbsp;&nbsp;&nbsp;ถึง&nbsp;&nbsp;&nbsp;' . $job["job_end"]; ?></h6>
                </li>

              </ul>
              <ul class="list-group list-group-horizontal-md ">
                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                  ขั้นตอนการทำงาน <em class="em">*</em>
                </div>


                <div class="list-group-item col-10">
                  <input type="hidden" id="sub_id" value="">
                  <input type="text" autocomplete="off" class="form-control" id="subprocessinput" name="subprocessinput" placeholder="จัดทำร่าง พรบ." value="<?php echo $process["process_name"]; ?>">
                </div>
                <input type="hidden" id="job_id" name="job_id" value="<?php echo $job["job_id"]; ?>">
              </ul>
              <ul class="list-group list-group-horizontal-md ">
                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                  ระยะเวลาการทำงาน <em class="em">*</em>
                </div>
                <div class="list-group-item col-10">
                  <div class="p-2 g-col-6">
                    <input type="text" id="s_date" readonly="readonly" class="form-control datepicker create-s-date" name="s_date" data-old="" value="<?php echo $process["process_start"]; ?>">

                    ถึง
                    <input type="text" required readonly="readonly" id="e_date" class="form-control  datepicker-input create-e-date" name="e_date" data-old="" value="<?php echo $process["process_end"]; ?>">

                  </div>
                </div>
              </ul>

              <ul class="list-group list-group-horizontal-md ">
                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                  รายละเอียด
                </div>


                <div class="list-group-item col-10">
                  <div class="form-floating">

                    <textarea autocomplete="off" class="form-control" placeholder="Leave a comment here" id="detail" name="detail" style="height: 50px; width: 600px"><?php echo $process["detail"]; ?></textarea>
                    <label for="floatingTextarea2">คำอธิบาย</label>
                  </div>
                </div>

              </ul>
              <ul class="list-group list-group-horizontal-md ">
                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                  ขั้นตอนการทำงานย่อย
                </div>
                <div class="list-group-item col-10">
                  <table class="table table-hover" id="tblsubprocess">
                    <thead>
                      <th>ขั้นตอนการทำงานย่อย</th>
                      <th>วันที่เริ่ม</th>
                      <th>วันที่สิ้นสุด</th>
                      <th>จัดการ</th>
                    </thead>
                    <tbody>
                      <input id="process_id" class="hidden-field" type="hidden" name="process_id" value="<?php echo $process["process_id"]; ?>">


                      <?php
                      if ($flag != 'add') {
                        if (isset($subprocess)) {
                          foreach ($subprocess as $rsub) { ?>
                            <tr id="subprocess<?php echo $rsub['subprocess_id']; ?>">
                              <td>
                                <input type='text' readonly class='form-control' name='subprocessinput[]' id='subprocessinput[]' value="<?php echo $rsub['subprocess_name']; ?>">
                              </td>
                              <td>
                                <div class='input-group date'>
                                  <input type='text' id='s_sub_date[]' disabled  readonly='readonly' class='form-control datepicker create-s-date' name='s_sub_date[]' data-old='' value='<?php echo $rsub['subprocess_start']; ?>'>
                                  <div class='input-group-append'>
                                    <div required class='input-group-text toggle-datepicker' data-toggle='#create-s-date'>
                                      <i class='fa fa-calendar'></i>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class='input-group date'>
                                  <input type='text' id='e_sub_date[]' disabled readonly='readonly' class='form-control datepicker create-e-date' name='e_sub_date[]' data-old='' value='<?php echo $rsub['subprocess_end']; ?>'>
                                  <div class='input-group-append'>
                                    <div required class='input-group-text toggle-datepicker' data-toggle='#create-s-date'>
                                      <i class='fa fa-calendar'></i>
                                    </div>
                                    <input type="hidden" id="subprocess_id" name="subprocess_id" value="">
                                  </div>
                                </div>
                              </td>
                              <td nowrap>
                                <?php if ($cedit == 'can') { ?>
                                  <?php if ($rsub['subprocess_finish'] == '') { ?>
                                    <button class='btn btn-warning' type="button" id="editsub" onclick="editsubprocess(<?php echo $rsub['subprocess_id']; ?>)"><i class='fa fa-pencil'></i> แก้ไข</button>
                                    <button class='btn btn-success' type="button" id="confirmsub" onclick="confirmsubprocess(<?php echo $rsub['subprocess_id']; ?>)"><i class='fa fa-check'></i> ยืนยัน</button>
                                    <button class='btn btn-danger' type="button" id="deletesub" onclick="deletesubprocess(<?php echo $rsub['subprocess_id']; ?>)"><i class='fa fa-times-circle'></i> ลบ</button>
                                <?php }
                                } ?>
                              </td>
                            </tr>
                          <?php } ?>
                          <?php if ($cedit == 'can') { ?>
                            <?php if ($flag == 'update') { ?>
                              <tr class="button-addsub">
                                <td colspan="4" class="text-center">
                                  <button class="btn btn-primary formaddsubprocess col-12 mx-auto" type="button" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                    <i class="fa fa-plus-square"></i> เพิ่ม
                                  </button>
                                </td>
                              </tr>
                          <?php }
                          } ?>
                      <?php       }
                      } ?>
                    </tbody>
                  </table>

                </div>

              </ul>
              <ul class="list-group list-group-horizontal-md ">
                <div class="list-group-item col-12 d-flex align-items-center text-center justify-content-center">
                  <?php if ($cedit == 'can') { ?>
                    <?php if ($flag == 'add') { ?>
                      <button class="btn btn-success insertprocess" type="button">บันทึก</button>&nbsp;
                    <?php } else if ($flag == 'update') { ?>
                      <button class="btn btn-warning updateprocess" type="button">แก้ไข</button>&nbsp;
                    <?php } ?>
                  <?php } ?>
                  <a class="btn btn-danger" href="<?php echo base_url('showjobselect/' . $job["job_id"]); ?>">ย้อนกลับ</a>

                </div>


              </ul>

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
    <?php if ($job["j_status"] == '1') { ?>
      $(document).ready(function() {
        $('.formaddsubprocess,.updateprocess').prop('disabled', false).show();
      });
    <?php } ?>
  </script>
  <?php //echo $this->include('templates/footer');
  ?>
  <?php $this->endSection(); ?>
</body>

</html>