$(document).ready(function () {
  $('#urladdprocess').hide();
  // $('#addjob').hide();
  //ปฏิทิน
  // $('.create-s-date,.create-e-date,#job_start,#job_end,.create-s-date,.create-e-date,#editjob_start,#editjob_end').datepicker({
  //   language: 'th-th',
  //   format: 'dd/mm/yyyy',
  //   todayBtn: 'linked',
  //   todayHighlight: true,
  //   autoclose: true
  // });
  const pathname = window.location.pathname;
  const text = pathname.split("/");


  // return false;
  if (text[1] = 'formupdateprocess') {
    // showsubprocess();
  }


});
$(document).on("click","#job_start,#job_end,.addcreate-s-date,.addcreate-e-date,#editjob_start,#editjob_end", function () {
  console.log("click");
  $(this).datepicker({
  language: 'th-th',
  format: 'dd/mm/yyyy',
  todayBtn: 'linked',
  todayHighlight: true,
  autoclose: true});
});
//เพิ่ม subprocess
$(document).on("click", ".addsubprocess", function () {

  let s_job = $('#s_job').val();
  let e_job = $('#e_job').val();
  let s_sub_date = $('#s_sub_date').val();
  let e_sub_date = $('#e_sub_date').val();
  let sub_process = $('#subprocessinput').val();
  let job_id = $('#job_id').val();
  let process_id = $('#process_id').val();
  Swal.fire({
    title: 'บันทึกข้อมูลหรือไม่',
    text: $(this).data('project_data_detail'),
    icon: 'warning',
    confirmButtonText: 'ยืนยัน',
    showDenyButton: true,
    denyButtonText: 'ไม่',
  }).then((result) => {
    if (result.isConfirmed) {

      $.ajax(
        {
          url: "/addsubprocess",
          type: "post",
          dataType: 'text',
          data: { job_id: job_id, process_id: process_id, sub_process: sub_process, s_sub_date: s_sub_date, e_sub_date: e_sub_date },
          success: function (data) {
            alert('บันทึกสำเร็จ');
            showsubprocess();
            location.reload();
          }
        });
    }
  });
});
//
// โชว subprocess
function showsubprocess() {
  let process_id = $('#process_id').val();
  $.ajax(
    {
      url: "/showsubprocess",
      type: "get",
      dataType: 'text',
      data: { process_id: process_id },
      success: function (data) {
        let a = JSON.parse(data);
        // console.log(a)   
        $('#subprocess_id').val(data.subprocess_id);
      }
    });
  $('#processitem').html('');
  // $('#addjob_id').html('');
  // $('#addjob_id').append('<input class="addprocessid" type="text" value="'+a.process[0]['job_id']+'">');
  $("#urladdprocess").attr("href", "/formprocess/" + a.process[0]['job_id'] + "");
  a.process.forEach(element => {

    $('#processitem').append('<div class="card">' +
      '<div class="card process_list" id="process' + element.process_id + '">' +
      '<div class="card-body">' +
      '<h5 class="card-title">' + element.process_name + '</h5>' +
      '<br>&nbsp; วันที่เริ่ม: ' + element.process_start + '<br>&nbsp; วันที่สิ้นสุด :' + element.process_end + '<br>' +
      '<div class="text-right">' +
      '<button class="btn btn-warning editsubprocess" type="button" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">' +
      '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>' +
      '&nbsp;&nbsp;<button class="btn btn-success" onclick="confirmprocess(' + element.process_id + ')" title="จบขั้นตอนการทำงาน">' +
      '<i class="fa fa-check-circle" aria-hidden="true"></i></button>' +
      '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteprocess(' + element.process_id + ')" title="ลบ">' +
      '<i class="fa fa-trash" aria-hidden="true"></i></button>' +
      '</div>' +
      '</div>' +
      '</div>' +
      '</div>')
  });
}

function jobText(id, element, cedit) {
  console.log('in Function(' + id + '' + cedit + ')');
  $('#' + id).append('<ul style="padding-bottom: 2px;" class="list-group">' +
    '<li class="list-group-item "> ' +
    '<div class="row">' +
    '<div class="col-8">' +
    element.job_name +
    '<br> วันที่เริ่ม :' + element.job_start + '<br> วันที่สิ้นสุด :' + element.job_end +
    '<br> ' + ((+element.dateremain < 0) ? 'ล่าช้ามาแล้ว :' + (element.dateremain * -1) : 'วันคงเหลือก่อนครบกำหนด :' + element.dateremain) + 'วัน' +
    '</div>' +
    '<div class="col-4" class="text-right">' +

    (cedit == 'can' ? '<button class="btn btn-warning" onclick="updatejobform(' + element.job_id + ')">' +
      '<i class="fa fa-pencil-square-o " aria-hidden="true" ></i> ' +
      '</button>' : '') +

    '<a href="/showjobselect/' + element.job_id + '" class="btn btn-success">' +
    '<i class="fa fa-eye" aria-hidden="true" ></i>' +
    '</a>' +
    (cedit == 'can' ? '<button class="btn btn-danger" onclick="deletejob(' + element.job_id + ')">' +
      '<i class="fa fa-trash" aria-hidden="true"></i></i> ' +
      '</button>' : '') +
    '</div>' +
    '</li>' +
    '</ul>'
  );
}

//เลือก หน่วยงาน แสดง job
$(document).on("change", ".selectdivision", function () {
  $("select option:selected").each(function () {
    divid = $(this).val();
    // alert(divid);
    return;
  });
  // $('#urladdprocess').hide();
  showjobselect(divid)
});
// show job หลังจากเลือกหน่วยงาน
function showjobselect(divid) {
  $('#urladdjob').show();
  $.ajax(
    {
      url: "/showafterdiv",
      type: "get",
      dataType: 'json',
      data: { division_id: divid },
      success: function (data) {
        try {
          // let showdata = JSON.parse(data);
          console.log(data);
          // Process the parsed JSON data
        } catch (error) {
          console.error("Error parsing JSON:", error);
          // Handle the error appropriately
        }
        let showdata = data;
        // return;
        var cedit = showdata.cedit;
        if (cedit != 'can') {
          $('#addjob').hide();
        } else {
          $('#addjob').show();
        }
        $('#mustact,#inprogress,#waitapprove,#approve').html('');
        // $('#finishjobitem').html('');
        if (showdata.job != 0) {
          showdata.job.forEach(element => {
            if (element.status == '1') {
              jobText('mustact', element, cedit);
            }
            if (element.status == '2') {
              jobText('inprogress', element, cedit);
            }
            if (element.status == '3') {
              jobText('waitapprove', element, cedit);
            }
            if (element.status == '4') {
              $('#approve').append('<ul style="padding-bottom: 2px;" class="list-group">' +
                '<li class="list-group-item "> ' +
                '<div class="row">' +
                '<div class="col-8">' +
                element.job_name +
                '<br> วันที่เริ่ม :' + element.job_start + '<br> วันที่สิ้นสุด :' + element.job_end +
                '</div>' +
                '<div class="col-4" class="text-right">' +
                (cedit == 'can' ? '<button class="btn btn-warning" onclick="updatejobform(' + element.job_id + ')">' +
                  '<i class="fa fa-pencil-square-o " aria-hidden="true" ></i> ' +
                  '</button>' : '') +
                '<a href="/showjobselect/' + element.job_id + '" class="btn btn-success">' +
                '<i class="fa fa-eye" aria-hidden="true" ></i>' +
                '</a>' +
                (cedit == 'can' ? '<button class="btn btn-danger" onclick="deletejob(' + element.job_id + ')">' +
                  '<i class="fa fa-trash" aria-hidden="true"></i></i> ' +
                  '</button>' : '') +
                '</div>' +
                '</li>' +
                '</ul>'

              );
            }
          });
        }
        else {
          alert('ไม่พบ');
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX request error:", error);
        // Handle the AJAX error appropriately
      }
    });
}

//เลือก job แสดง process
function jobselect(jobid) {
  $.ajax(
    {

      url: "/home/get",
      type: "post",
      dataType: 'text',
      data: {jobid1: jobid},
      success: function (data) {
       
        var a = JSON.parse(data);
        
        console.log('job'+a.job_status.status);
      
        if (a.cedit == 'can') {
          $('#urladdprocess').show();
        } else {
          $('#urladdprocess').hide();
        }
        $('#processitem').html('');
        $('#finishprocessitem').html('');
       
        $('#hiddenid').attr("value",a.job_id);
        $("#urladdprocess").attr("href", "/formprocess/" + a.job_id + "");
      
        a.process.forEach(element => {
         
          // console.log('cf:'+element.cf+'cc'+element.cc);
          if(a.job_id == element.job_id && element.cf=='1' && element.cc=='0'){
            // alert('fff');
            $("#urladdprocess").hide();
            if(a.job_status.status <3 && a.showckcan == 1){
              $("#finishjob").show();
            }else{
              $("#finishjob").hide();
            }
            

          }else if(a.job_id == element.job_id && element.cc=='1'){
            $("#urladdprocess").show();
            $("#finishjob").hide();
          }

          if (element.status == 1) {
            console.log(element.status);
            $('#processitem').append('<ul style="padding-bottom: 2px;" class="list-group">' +
              // '<li class="list-group-item "> '+
              '<li id="process' + element.process_id + '" class="list-group-item  process_list ">' +
              '<div class="row">' +
              '<div class="col-8">' +
              '&nbsp; ชื่อ: ' + element.process_name + '<br>&nbsp; วันที่เริ่ม: ' + element.process_start + '<br>&nbsp; วันที่สิ้นสุด :' + element.process_end + '<br>' +
              '</div>' +
              '<div class="col-4" class="text-right">' +
              '<div class="text-right">' +
              (a.cedit == 'can' ? '<a class="btn btn-warning" href="/formupdateprocess/' + element.process_id + '" title="แก้ไข">' +
                '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>' +
                '&nbsp;&nbsp;<button class="btn btn-success" onclick="confirmprocess(' + element.process_id + ')" title="จบขั้นตอนการทำงาน">' +
                '<i class="fa fa-check-circle" aria-hidden="true"></i></button>' +
                '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteprocess(' + element.process_id + ')" title="ลบ">' +
                '<i class="fa fa-trash" aria-hidden="true"></i></button>' : '') +
              (a.cedit == 'cant' ? '<a class="btn btn-success" href="/formupdateprocess/' + element.process_id + '" title="ดูข้อมูล">' +
                '<i class="fa fa-eye" aria-hidden="true"></i></a>' : '') +
              '</div></div>' +
              '</li>' +
              '</div>' +
              '</ul>'


            );
          } else if (element.status == 2) {
         
            $('#finishprocessitem').append('<ul style="padding-bottom: 2px;" class="list-group">' +
              // '<li class="list-group-item "> '+
              '<li id="process' + element.process_id + '" class="list-group-item  process_list ">' +
              '<div class="row">' +
              '<div class="col-8">' +
              '&nbsp; ชื่อ: ' + element.process_name + '<br>&nbsp; วันที่เริ่ม: ' + element.process_start + '<br>&nbsp; วันที่สิ้นสุด :' + element.process_end + '<br>' +
              '</div>' +
              '<div class="col-4" class="text-right">' +
              '<div class="text-right">' +
              '<a class="btn btn-success" href="/formupdateprocess/' + element.process_id + ' " title="ดูข้อมูล">' + '<i class="fa fa-eye" aria-hidden="true"></i></a>' +
              '</div>' +
              '</div>' +
              '</li>' +
              '</div>' +
              '</ul>'
            );
          
          }
          
        });
      
      }
    });
}
function reoload(){ 
  location.reload();
}
$(document).on("click", "#finishjob", function () {
  let job_id = $('#hiddenid').val();

Swal.fire({
  title: 'ยืนยันขั้นตอนการทำงานหรือไม่',
  // text: $(this).data('project_data_detail'),
  icon: 'warning',
  confirmButtonText: 'ยืนยัน',
  showDenyButton: true,
  denyButtonText: 'ไม่',
}).then((result) => {
  if (result.isConfirmed) {
// return false;
    $.ajax(
      {
        url: "/confirmallprocess",
        type: "post",
        dataType: 'json',
        data: { job_id: job_id },
        success: function (data) {
          reload();
        
        }
      });
  }
});
});

// ลบขั้นตอนการทำงาน
function deleteprocess(process_id) {
  let text = "ยืนยันการลบข้อมูล";
  if (confirm(text) == true) {
    text = "ทำการลบข้อมูลแล้ว";
    alert(text);
  
    $.ajax(
      {
        url: "/deleteprocess/" + process_id,
        type: "post",
        dataType: 'text',
        // data: { process_id: process_id},
        success: function (data) {
          location.reload(true);
        }
      });
  }
}

function confirmprocess(process_id) {
  let text = "ยืนยันการสิ้นสุดการทำงาน";
  if (confirm(text) == true) {
    text = "ทำการยืนยันข้อมูลแล้ว";
    alert(text);
    // window.location.reload(false);
    // return false;
    $.ajax(
      {
        url: "/confirmprocess",
        type: "post",
        dataType: 'text',
        data: { process_id: process_id },
        success: function (data) {
          location.reload();
        }
      });
  }
}
// เพิ่มขั้นตอนการทำงาน
// $(document).on("click", ".insertprocess", function () {
//   let job_id = $('#job_id').val();
//   let process_name = $('#process_name').val();
//   let processstart = $('#s_date').val();
//   let processend = $('#e_date').val();
//   let detail = $('#detail').val();
//   var p_s_start = processstart.split('/');
//   let rs_start = p_s_start[2]-543  + '-' + p_s_start[1] + '-' + p_s_start[0];
//   var p_s_end = processend.split('/');
//   let rs_end = p_s_end[2]-543  + '-' + p_s_end[1] + '-' + p_s_end[0];
//   // alert(rs_start);
//   // alert(rs_end);
//   let s_job = $('#s_job').val();
//   let e_job = $('#e_job').val();
//   if (rs_end < rs_start) {
//     alert('วันที่ สิ้นสุดต้องไม่น้อยกว่าวันที่เริ่มต้น');
//   }

//   if (process_name == '') {
//     alert('กรุณากรอก ขั้นตอน');
//     process_name.focus();
//     return false;
//   } else if (processstart == '') {
//     alert('กรุณากรอกวันที่เริ่มต้น');
//     processstart.focus();
//     return false;
//   } else if (processend == '') {
//     alert('กรุณากรอกวันที่สิ้นสุด');
//     processend.focus();
//     return false;
//   }
//   $.ajax(
//     {
//       url: "/insertprocess",
//       type: "post",
//       dataType: 'text',
//       data: { job_id: job_id, process_name: process_name, process_start: rs_start, process_end: rs_end, detail: detail },
//       success: function (data) {
//         // console.log(data);
//         var obj = JSON.parse(data);
//         console.log(obj.process);
//         location.replace("/formupdateprocess/"+obj.process)
//       }
//     });
// });

//เพิ่มขั้นตอนการทำงาน
// แก้ไขขั้นตอนการทำงาน
$(document).on("click", ".updateprocess", function () {
  // let job_idprocess = $('.addprocessid').val();
  console.log($('#formaddprocess').serialize());
  // return false;
  let job_id = $('#job_id').val();
  let process_name = $('#process_name').val();
  let processstart = $('#s_date').val();
  let processend = $('#e_date').val();
  let detail = $('#detail').val();
  // alert(processstart);
  // alert(processend);

  var p_s_start = processstart.split('/');
  let rs_start = p_s_start[2]-543 + '-' + p_s_start[1] + '-' + p_s_start[0];
  var p_s_end = processend.split('/');
  let rs_end = p_s_end[2]-543 + '-' + p_s_end[1] + '-' + p_s_end[0];
  // alert(rs_start);
  // alert(rs_end);
  let s_job = $('#s_job').val();
  let e_job = $('#e_job').val();
  if (rs_end < rs_start) {
    alert('วันที่ สิ้นสุดต้องไม่น้อยกว่าวันที่เริ่มต้น');

  }

  //   alert(rs_end-rs_start);
  // return false;
  if (process_name == '') {
    alert('กรุณากรอก ขั้นตอน');
    process_name.focus();
    return false;
  } else if (processstart == '') {
    alert('กรุณากรอกวันที่เริ่มต้น');
    processstart.focus();
    return false;
  } else if (processend == '') {
    alert('กรุณากรอกวันที่สิ้นสุด');
    processend.focus();
    return false;
  }

  $.ajax(
    {
      url: "/updateprocess",
      type: "post",
      dataType: 'text',
      data: $('#formaddprocess').serialize(),
      success: function (data) {
        alert('บันทึก');
        location.reload(true);
      }
    });
});
// แก้ไขขั้นตอนการทำงาน
// addjob
function addjob() {
  let jobname = $('#job_name').val();
  let jobstart = $('#job_start').val();
  let jobend = $('#job_end').val();
  var arr1 = jobstart.split('/');
  let jstart = arr1[2]-543  + '-' + arr1[1] + '-' + arr1[0];
  var arr2 = jobend.split('/');
  let jend = arr2[2]-543  + '-' + arr2[1] + '-' + arr2[0];
  var name = document.getElementById("job_name");
  var start = document.getElementById("job_start");
  var end = document.getElementById("job_end");
  if (name.value == "") {
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    name.focus();
    return false;
  } else if (start.value == "") {
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    start.focus();
    return false;
  } else if (end.value == "") {
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    end.focus();
    return false;
  } else if (jend < jstart) {
    alert("กรุณากรอกข้อมูลวันที่ให้ถูกต้อง")
    return false;
  }

  $.ajax(
    {
      url: "/addjob",
      type: "post",
      dataType: 'json',
      data: { jobname: jobname, jobstart: jstart, jobend: jend },
      success: function (data) {
        if (data.success) {

          alert('บันทึก')
          location.reload(true);
        } else {
          alert(data.error);
        }
      }
    });
}

// editjob
function editjob() {
  let editjob_id = $('#editjob_id').val();
  let editjobname = $('#editjob_name').val();
  let editjobstart = $('#editjob_start').val();
  let editjobend = $('#editjob_end').val();
  var arr1 = editjobstart.split('/');
  let editjstart = arr1[2]-543 + '-' + arr1[1] + '-' + arr1[0];
  var arr2 = editjobend.split('/');
  let editjend = arr2[2]-543 + '-' + arr2[1] + '-' + arr2[0];

  if (editjobname.value == "") {
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    $('#editjob_name').focus();
    return false;
  } else if (editjobstart.value == "") {
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    $('#editjob_start').focus();
    return false;
  } else if (editjobend.value == "") {
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    $('#editjob_end').focus();
    return false;
  } else if (editjend < editjstart) {
    alert("กรุณากรอกข้อมูลวันที่ให้ถูกต้อง")
    return false;
  }

  $.ajax(
    {
      url: "/editjob",
      type: "post",
      dataType: 'text',
      data: { editjobid: editjob_id, editjobname: editjobname, editjobstart: editjstart, editjobend: editjend },
      success: function (data) {
        
        
      }
    });
}

function updatejobform(jobid) {
  console.log(1);
  $('#listprocess').html('');
  //$('.tr_items').remove();
  $.ajax(
    {
      url: "../updatejobform",
      type: "post",
      dataType: "json",
      data: { jobid: jobid },
      success: function (data) {
        $('#myModaledit').modal('show');
        console.log(data);
        $("#editjob_id").val(data.job.job_id);
        $("#editjob_name").val(data.job.job_name);
        $("#editjob_start").val(data.job.job_start);
        $("#editjob_end").val(data.job.job_end);
       (data.cedit == 'cant') ? $("input,textarea").prop('disabled', true) : '';
        
        data.process.forEach(rs_process => {
         
          $('#listprocess').prepend('<tr id="process' + rs_process.process_id + '" ' +
            'class="table table-sm tr_items" data-bs-toggle="collapse" data-bs-target="#collapsesubprocess' + rs_process.process_id + '" ' + 'aria-expanded="true" >' +
            '<td><textarea  autocomplete="off" class="form-control" id="process_name" name="process_name" placeholder="จัดทำร่าง พรบ." >'+ rs_process.process_name +'</textarea>'+
              '</td><td><input  type="text" id="s_date' + rs_process.process_id + '" readonly="readonly"  class="form-control datepicker create-s-date" name="s_date" data-old="" value="' + rs_process.process_start +'">'+ ''+
              '<input  type="text" required="" readonly="readonly" id="e_date' + rs_process.process_id + '"  class="form-control  datepicker-input create-e-date" name="e_date" data-old="" value="' + rs_process.process_end + '"></td>'+
            // '<td><input type="checkbox" name="complete" id="complete_'+ rs_process.process_id +' onclick="confirmprocess(' + rs_process.process_id + ')" " value="2"></td>'+
            '</tr>'+
            '<tr class="table table-sm" id="rsprocess' + rs_process.process_id + '" ></tr>' 
          );
       
        });
      
        $('.create-s-date,.create-e-date').datepicker({
          language: 'th-th',
          format: 'dd/mm/yyyy',
          todayBtn: 'linked',
          todayHighlight: true,
          autoclose: true
        });
        if (data.status == '4') {
          $('.footer-edit').hide();
        } else {
          $('.footer-edit').show();
        }

      }
    });
    
}

//ลบหัวข้อ job //172.31.0.54
function deletejob(job_id) {
  let text = "ยืนยันการลบข้อมูล";
  // alert(job_id);
  if (confirm(text) == true) {
    text = "ทำการลบข้อมูลแล้ว";
    alert(text);

    $.post( "/deletejob",{job_id: job_id}, function( data ) {
      if (data.success) {

          alert('ลบข้อมูลเรียบร้อย')
          location.reload(true);
        } else {
          alert(data.error);
        }
    },'json');
  }
};
$(document).on('click', '.formaddsubprocess', function () {
  $('.addsubprocess').show();
  $('.updatesubprocess').hide();
});
function editsubprocess(subprocessid) {

  $.ajax(
    {
      url: "/editsubprocess",
      type: "get",
      dataType: "json",
      data: { subprocess_id: subprocessid },
      success: function (data) {
        $('#exampleModalToggle').modal('show');
        $('.addsubprocess').hide();
        $("#sub_id").val(data.subprocess_id);
        $("#subprocessinput").val(data.subprocess_name);
        $("#s_sub_date").val(data.subprocess_start);
        $("#e_sub_date").val(data.subprocess_end);

      }
    });
}

function confirmsubprocess(subid) {
  let text = "ยืนยันข้อมูลใช่หรือไม่";
  let process_id = $('#process_id').val();
  let job_id = $('#job_id').val();
  if (confirm(text) == true) {
    text = "ยืนยันข้อมูลแล้ว";
    alert(text);
    $.ajax(
      {
        url: "/confirmsubprocess",
        type: "post",
        dataType: "่json",
        data: { job: job_id, subprocessid: subid, processid: process_id },
        success: function (data) {
          location.reload(true);
        }
      }
    )
  }
}
function deletesubprocess(subid) {
  let text = "ลบขั้นตอนการทำงานใช่หรือไม่";
  if (confirm(text) == true) {
    text = "ทำการลบข้อมูลแล้ว";
    alert(text);
    $.ajax(
      {
        url: "/deletesubprocess",
        type: "post",
        dataType: "text",
        data: { subprocessid: subid },
        success: function (data) {
          location.reload(true);
        }
      });
  }
}
$(document).on("change", ".selectjob", function () {
  $("select option:selected").each(function () {
    jobid = $(this).val();
  });
  $('#urladdprocess').hide();
  jobselect(jobid)

});
// ปุ่มเพิ่ม process
function addprocess(){
  let job_idprocess = $('.addprocessid').val();
  // alert(job_idprocess);
  addprocess(job_idprocess);
}
// เพิ่ม process
function addprocess(job_idprocess) { 
  $.ajax(
    {
      url: "/formprocess/job",
      type: "post",
      dataType: 'text',
      data: { job_id: job_idprocess },
      success: function (data) {
      }
    });
}

$(document).on("click", ".modalclose,.cancel", function () {
  $('#exampleModalToggle').modal('hide');
  $('#sub_id,#subprocessinput,#s_sub_date,#e_sub_date').val("");
  // โหลดหน้าเว็บใหม่
  window.location.reload();
});
// แก้ไข subprocess
$(document).on("click", ".updatesubprocess", function () {
  let subid = $('#sub_id').val();
  let subinput = $('#subprocessinput').val();
  let s_sub_date = $('#s_sub_date').val();
  let e_sub_date = $('#e_sub_date').val();
  var arr1 = s_sub_date.split('/');
  let substart = arr1[2]-543  + '-' + arr1[1] + '-' + arr1[0];
  var arr2 = e_sub_date.split('/');
  let subend = arr2[2]-543  + '-' + arr2[1] + '-' + arr2[0];
  var start = document.getElementById("s_date");
  var end = document.getElementById("e_date");
  if (subinput.value == "") {
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    subinput.focus();
    return false;
  } else if (s_sub_date.value == "" || e_sub_date.value == "") {
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    return false;
  } else if (e_sub_date < s_sub_date) {
    alert("กรุณากรอกข้อมูลวันที่ให้ถูกต้อง")
    return false;
  }
  // else if(s_sub_date < start){
  //   alert("กรุณากรอกข้อมูลวันที่ให้ถูกต้อง2")
  //   return false;
  // }else if(e_sub_date > end){
  //   alert("กรุณากรอกข้อมูลวันที่ให้ถูกต้อง3")
  //   return false;
  // }
  $.ajax(
    {
      url: "/updatesubprocess",
      type: "post",
      dataType: 'json',
      data: { sub_id: subid, subprocess_name: subinput, subprocess_start: substart, subprocess_end: subend },
      success: function (data) {
        location.reload();
      }
    });
});

