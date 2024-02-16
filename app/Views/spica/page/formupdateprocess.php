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
 </style> 
  <script>
 
 
 </script>   
 <?php 
   if($flag == 'update' || $flag == 'view'){
        foreach($job as $rs){
            $job_id = $rs['job_id'];
            $job_name = $rs['job_name'];
            $job_start = $rs['job_start'];
            $job_end = $rs['job_end'];
            $job_startpic = $rs['job_startpic'];
            $job_endpic = $rs['job_endpic'];
            $process_id = $rs['process_id'];
            $process_name = $rs['process_name'];
            $process_start = $rs['process_start'];
            $process_end = $rs['process_end'];
            $detail = $rs['detail'];
        }
   }
 ?>
      <!-- partial -->
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
        <?php   //echo getcwd();; ?>
        <form id="formupdateprocess">
            <div class="col-12 col-xl-12 grid-margin stretch-card">
              <div class="row w-100 flex-grow">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body container">
                    <div class="text-center" style=" margin-bottom: 0.5rem;">
                    <div class="card">
        <input type="hidden" id="flag" value="<?php echo $flag;?>">
                <div class="card-header">
                    <h3 class="card-title"><i class="fa fa-user"></i> แก้ไขขั้นตอนการทำงาน</h3>
                </div>
                <div class="modal fade" id="exampleModalToggle" aria-labelledby="exampleModalToggleLabel" tabindex="-1" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-xl ">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-4" id="exampleModalToggleLabel">เพิ่มขั้นตอนการทำงานย่อย</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                        <div class="row g-3">
                    <div class="col-md">
                        <div class="form-floating">
                        <input type="text" class="form-control" id="subprocessinput" name="subprocessinput" placeholder="จัดทำร่าง พรบ." value="">
                        <label for="floatingInputGrid">ขั้นตอนการทำงานย่อย</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type='text' id='s_sub_date' readonly='readonly' class='form-control datepicker create-s-date' name='s_sub_date' data-old='' value=''>
                            <label for="s_sub_date">ระบุวันที่เริ่มต้น</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type='text' id='e_sub_date' readonly='readonly' class='form-control datepicker create-s-date' name='e_sub_date' data-old='' value=''>
                            <label for="e_sub_date">ระบุวันที่สิ้นสุด</label>
                        </div>
                    </div>
                    </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-primary addsubprocess"  type="button">บันทึก</button>
          </div>
        </div>
      </div>
    </div>
                <div class="card-body">
                    <div class="form-horizontal form-input">
                        <div class="row">
                            <div class="col-12 col-md-12 col-xl-12">
                                <div class="form-group row">
                                  
                                    <label class="col-12 col-md-12 col-xl-12 col-form-label text-center"> <h3><?php echo $job_name;?></h3>  </label>
                                    <input type="hidden" id="job_id" name="job_id" value="<?php echo $job_id;?>">
                                </div>
                            </div>
                         
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-12 col-md-12 col-xl-6">
                                <div class="form-group row">
                                    <label class="col-4 col-md-4 col-xl-4 col-form-label">วันที่เริ่ม : </label>
                                    <label class="col-8 col-md-8 col-xl-8 col-form-label text-left"><?php echo $job_start; ?></label>
                                    <input  type="hidden" readonly id='s_job' value="<?php echo $job_startpic; ?>">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-12 col-md-12 col-xl-6">
                                <div class="form-group row">
                                    <label class="col-4 col-md-4 col-xl-4 col-form-label">วันที่สิ้นสุด : </label>
                                    <label class="col-8 col-md-8 col-xl-8 col-form-label text-left">
                                    <?php echo $job_end;?>
                                    </label>
                                    <input  type="hidden" readonly id='e_job' value="<?php echo $job_endpic; ?>">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        
                    </div>
                        </div>
            </div>
                        </div>
                   
                        <div class="card">
                            <div class="card-body">
                            <div class="form-body">
                                                        <div class="row">
                                <div class="col-12 col-md-12 col-xl-6">
                                    <div class="form-group row">

                                        <label class="col-form-label col-md-4"> ขั้นตอนการทำงาน</label>
                                        <div class="col-md-8">
                                            <input type="text" id="process_name" name="process_name" class="form-control" placeholder="เรื่อง" value="<?php echo $process_name;?>" required="">

                                        </div>
                                    </div>
                                </div>
                             
                                <!--/span-->

                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">วันที่เริ่มขั้นตอนการทำงาน</label>
                                        <div class="col-md-8">
                                            <div class="input-group date">
                                                <input type="text" id="s_date" readonly="readonly" class="form-control datepicker create-s-date" 
                                                name="s_date" data-old="" value="<?php echo $process_start;?>">
                                                <div class="input-group-append">
                                                    <div required class="input-group-text toggle-datepicker" data-toggle="#create-s-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div id="countLeave" class="col-3 col-form-label"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-12 col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">จนถึงวันที่</label>
                                        <div class="col-md-8">
                                            <div class="input-group date">
                                                <input type="text" required readonly="readonly" id="e_date" class="form-control  datepicker-input create-e-date" 
                                                name="e_date" data-old="" value="<?php echo $process_end;?>">
                                                <div class="input-group-append">
                                                    <div  class="input-group-text toggle-datepicker" data-toggle="#create-e-date"><i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">รายละเอียด</label>
                                        <div class="col-md-9">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a comment here" id="detail" name="detail" style="height: 100px"><?php echo $detail;?></textarea>
                                            <label for="floatingTextarea2">Comments</label>
                                        </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                    <div >
                                    <button class="btn btn-primary subprocessform" type="button" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                        <i class="fa fa-plus-square"></i> เพิ่ม
                                    </button>
                                        <div class="form-group row subprocess " id="subprocess">
                                           
                                           <div class="col-12 ">
                                            <table  class="table table-hover" id="tblsubprocess">
                                                <thead>
                                                      <th>ขั้นตอนการทำงานย่อย</th>
                                                      <th>วันที่เริ่ม</th>
                                                      <th>วันที่สิ้นสุด</th>  
                                                      <th>จัดการ</th>
                                                </thead>
                                                <tbody>
                                                    <input id="process_id" class="hidden-field" type="hidden" name="process_id" value="<?php echo $process_id;?>">
                                                  
		                                            
                                                <?php foreach($subprocess as $rsub){?>    
                                                <tr id="subprocess<?php echo $rsub['subprocess_id'];?>">
                                                    <td><input type='text' readonly class='form-control' name='subprocessinput[]' id='subprocessinput[]' value="<?php echo $rsub['subprocess_name'];?>"> </td>
                                                    <td>
                                                        <div class='input-group date'>
                                                        <input type='text' id='s_sub_date[]' readonly='readonly' class='form-control datepicker create-s-date' name='s_sub_date[]' data-old='' value='<?php echo $rsub['subprocess_start'];?>'>
                                                    <div class='input-group-append'>
                                                        <div required class='input-group-text toggle-datepicker' data-toggle='#create-s-date'>
                                                            <i class='fa fa-calendar'></i>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </td>
                                                    <td>
                                                        <div class='input-group date'>
                                                        <input type='text' id='e_sub_date[]' readonly='readonly' class='form-control datepicker create-e-date' name='e_sub_date[]' data-old='' value='<?php echo $rsub['subprocess_end'];?>'>
                                                        <div class='input-group-append'>
                                                        <div required class='input-group-text toggle-datepicker' data-toggle='#create-s-date'>
                                                            <i class='fa fa-calendar'></i>
                                                        </div>
                                                        <input type="hidden" id="subprocess_id" name="subprocess_id" value="">
                                                    </div>
                                                    </div>
                                                    </td>
                                                    <td nowrap>
                                                        <button class='btn btn-warning' type="button" onclick="updatesubprocess(<?php echo $rsub['subprocess_id'];?>)"><i class='fa fa-pencil'></i> แก้ไข</button>
                                                        <button class='btn btn-danger' onclick="deletesubprocess(<?php echo $rsub['subprocess_id'];?>)" ><i class='fa fa-times-circle'></i> ลบ</button>
                                                    </td>
                                                   </tr>
                                                   <?php }?>
                                                </tbody>   
                                            </table>
                                            </div> 
                                        </div>
                                  
                            </div>
                            <div class="row">
                                    <div class="col-12 text-center">
                                        <?php if($flag='update'){?>
                                                <button class="btn btn-success insertprocess" type="button" >บันทึก</button>
                                        <?php }else { ?>
                                          <a class="btn btn-warning"  href="<?php echo base_url('showjobselect/'.$job_id);?>">ย้อนกลับ</a>
                                          <?php }?>
                                    </div>
                            </div>
                          
    
  
                                                          
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
  <!-- container-scroller -->
 
   <?php echo $this->include('templates/footer');?>
  <?php $this->endSection();?>
</body>

</html>