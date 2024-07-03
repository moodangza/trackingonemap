<div id="myModal" class="modal fade modal-lg" role="dialog" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">

                              <h5 class="modal-title" id="staticBackdropLabel">เพิ่มหัวข้อ</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <ul class="list-group list-group-horizontal-md" style="box-shadow: 5px 10px #888888;margin-bottom: 2px;">
                                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ชื่อหัวข้อ</label>
                                </div>
                                <div class="list-group-item col-10 form-floating">
                                  <div class="p-2 g-col-6">
                                    <!-- <input type="text" class="form-control" id="job_name" name="job_name"> -->
                                    <textarea class="form-control" id="job_name" name="job_name">
                                      
                                    </textarea>
                                  </div>
                                </div>
                              </ul>

                              <ul class="list-group list-group-horizontal-md">
                                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ระยะเวลาการทำงาน</label>
                                </div>
                                <div class="list-group-item col-10 d-flex form-floating">
                                  <div class="p-2 g-col-6 d-flex align-items-center text-center justify-content-center">
                                    <label for="job_start" class="form-label">ตั้งแต่</label>
                                    &nbsp;&nbsp;<input type="text" class="form-control datepicker-input" id="job_start" style="width: fit-content;" readonly name="job_start">
                                    &nbsp;&nbsp;<label for="job_end" class="form-label">ถึง</label>
                                    &nbsp;&nbsp;<input type="text" class="form-control datepicker-input" id="job_end" style="width: fit-content;" readonly name="job_end">
                                  </div>
                                </div>
                              </ul>
                              <input type="hidden" class="form-control" id="division_id" name="division_id">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" onclick="addjob()">บันทึก</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- formodalupdate -->
                      <div id="myModaledit" class="modal fade modal-lg" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" id="staticBackdropLabel">เพิ่มหัวข้อ</h5> -->
                              <h5 class="modal-title" id="staticBackdropLabel">แก้ไขหัวข้อ</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <input type="hidden" class="form-control" id="editjob_id" name="editjob_id" value="">
                            <div class="modal-body">
                              <ul class="list-group list-group-horizontal-md">
                                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ชื่อหัวข้อ</label>
                                </div>
                                <div class="list-group-item col-10 form-floating">
                                  <div class="p-2 g-col-6">
                                    <!-- <input type="text" class="form-control" id="editjob_name" name="editjob_name"> -->
                                    <textarea class="form-control" id="editjob_name" name="editjob_name">

                                    </textarea>
                                  </div>
                                </div>
                              </ul>
                              <ul class="list-group list-group-horizontal-md">
                                <div class="list-group-item col-2 d-flex align-items-center text-center justify-content-center">
                                  <label for="inputlevel" nowrap class="text-nowrap col-form-label d-inline-flex">ระยะเวลาการทำงาน</label>
                                </div>
                                <div class="list-group-item col-10 d-flex form-floating">
                                  <div class="p-2 g-col-6 d-flex align-items-center text-center justify-content-center">
                                    <label for="editjobstart" class="form-label">ตั้งแต่</label>
                                    &nbsp;&nbsp;<input type="text" class="form-control datepicker-input" id="editjob_start" style="width: fit-content;" readonly name="editjob_start">
                                    &nbsp;&nbsp;<label for="editjobend" class="form-label">ถึง</label>
                                    &nbsp;&nbsp;<input type="text" class="form-control datepicker-input" id="editjob_end" style="width: fit-content;" readonly name="editjob_end">
                                  </div>
                                </div>
                              </ul>

                              <div class="modal-footer center-block footer-edit">
                                <button type="button" class="btn btn-primary " onclick="editjob()">บันทึก</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>