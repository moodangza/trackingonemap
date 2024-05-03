
const draggbles = document.querySelectorAll(".shallow-draggable")
const containers = document.querySelectorAll(".draggable-container")

draggbles.forEach((draggble) => {
  //for start dragging costing opacity
  draggble.addEventListener("dragstart", () => {
    draggble.classList.add("dragging")
  })

  //for end the dragging opacity costing
  draggble.addEventListener("dragend", () => {
    draggble.classList.remove("dragging")
  })
})
//shit
containers.forEach((container) => {
  container.addEventListener("dragover", function (e) {
    e.preventDefault()
    const afterElement = dragAfterElement(container, e.clientY)
    const dragging = document.querySelector(".dragging")
    if (afterElement == null) {
      container.appendChild(dragging)
    } else {
      container.insertBefore(dragging, afterElement)
    }
  })
})

function dragAfterElement(container, y) {
  const draggbleElements = [...container.querySelectorAll(".shallow-draggable:not(.dragging)")]

  return draggbleElements.reduce(
    (closest, child) => {
      const box = child.getBoundingClientRect()
      const offset = y - box.top - box.height / 2
      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child }
      } else {
        return closest
      }
    },
    { offset: Number.NEGATIVE_INFINITY }
  ).element
}

$(document).ready(function() {
  $('#urladdprocess').hide();
  // $('#addjob').hide();
//ปฏิทิน
$('#s_date,#e_date,#job_start,#job_end,.create-s-date,.create-e-date,#editjob_start,#editjob_end').datepicker({
  language:'th-th',
  format: 'dd/mm/yyyy',
  todayBtn: 'linked',
  todayHighlight: true,
  autoclose: true
});
const pathname = window.location.pathname;
const text = pathname.split("/");


// return false;
if(text[1] = 'formupdateprocess'){
    showsubprocess();
}
$("input").autoresize({padding:20,minWidth:40,maxWidth:350});



});
//เพิ่ม subprocess
$(document).on( "click",".addsubprocess", function() {

  // alert( "Handler for `click` called." );
  let s_job = $('#s_job').val();
  let e_job = $('#e_job').val();
  let s_sub_date = $('#s_sub_date').val();
  let e_sub_date = $('#e_sub_date').val();
  let sub_process = $('#subprocessinput').val();
  // alert(s_sub_date);
  // alert(e_sub_date);
  let job_id = $('#job_id').val();
  let process_id = $('#process_id').val();
  // if(s_sub_date<s_job||s_sub_date>e_job){
  //   alert('โปรดตรวจสอบวันที่เริ่มต้น');
  //   return false;
  // }
  // if(e_sub_date<s_job||s_sub_date>e_job){
  //   alert('โปรดตรวจสอบวันที่สิ้นสุด');
  //   return false;
  // }

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
        data: { job_id : job_id,process_id : process_id, sub_process: sub_process,s_sub_date : s_sub_date ,e_sub_date : e_sub_date},
        success: function (data) {
    
         alert('บันทึกสำเร็จ');
         
          showsubprocess();       
          location.reload();
        }
    });   
    }
});


} );
//


// โชว subprocess
function showsubprocess(){
  let process_id = $('#process_id').val();
  $.ajax(
    {
    url: "/showsubprocess",
    type: "get",
    dataType: 'text',
    data: { process_id : process_id},
    success: function (data) {
      let a = JSON.parse(data);
      // console.log(a)   
      $('#subprocess_id').val(data.subprocess_id);
    }
});  
  $('#processitem').html('');
        
  // $('#addjob_id').html('');
  // $('#addjob_id').append('<input class="addprocessid" type="text" value="'+a.process[0]['job_id']+'">');
  $("#urladdprocess").attr("href", "/formprocess/"+a.process[0]['job_id']+""); 
  a.process.forEach(element => {
   
    $('#processitem').append('<div class="card">'+
    '<div class="card process_list" id="process'+element.process_id+'">'+
      '<div class="card-body">'+
        '<h5 class="card-title">'+ element.process_name +'</h5>'+
        '<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end +'<br>'+
        '<div class="text-right">'+
            '<button class="btn btn-warning editsubprocess" type="button" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">'+
            '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'+
            '&nbsp;&nbsp;<button class="btn btn-success" onclick="confirmprocess('+element.process_id+')" title="จบขั้นตอนการทำงาน">'+
            '<i class="fa fa-check-circle" aria-hidden="true"></i></button>'+
            '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteprocess('+element.process_id+')" title="ลบ">'+
            '<i class="fa fa-window-close" aria-hidden="true"></i></button>'+
        '</div>'+
      '</div>'+
    '</div>'+
  '</div>')
  });
 
}

function jobText(id, element,cedit){
    console.log('in Function('+id+''+cedit+')');
    $('#'+id).append('<ul style="padding-bottom: 2px;" class="list-group">'+
          '<li class="list-group-item "> '+
          '<div class="row">'+
          '<div class="col-8">'+
            element.job_name+
          '<br> วันที่เริ่ม :'+ element.job_start + '<br> วันที่สิ้นสุด :'+ element.job_end +
          '<br> '+ ((+element.dateremain<0)?'ล่าช้ามาแล้ว :'+(element.dateremain*-1):'วันคงเหลือก่อนครบกำหนด :'+element.dateremain) +'วัน' +
          '</div>'+
          '<div class="col-4" class="text-right">'+
        
          (cedit == 'can' ?  '<button class="btn btn-warning" onclick="updatejobform('+ element.job_id + ')">'+
          '<i class="fa fa-pencil " aria-hidden="true" ></i> '+
        '</button>': '') +
          
              '<a href="/showjobselect/'+element.job_id+'" class="btn btn-success">'+
                '<i class="fa fa-eye" aria-hidden="true" ></i>'+
              '</a>'+
              (cedit == 'can' ?  '<button class="btn btn-danger" onclick="deletejob('+ element.job_id + ')">'+
              '<i class="fa fa-trash" aria-hidden="true"></i></i> '+
              '</button>': '') +
          '</div>'+
        '</li>'+
    '</ul>'
    );
}

//เลือก หน่วยงาน แสดง job
$(document).on( "change",".selectdivision", function() {
  $( "select option:selected" ).each( function() {

    divid = $(this).val();
    alert(divid);
    return;
  } );
  // $('#urladdprocess').hide();
  showjobselect(divid)    
} );
// show job หลังจากเลือกหน่วยงาน
function showjobselect(divid){
  $('#urladdjob').show();
  $.ajax(
    {
      url: "/showafterdiv",
      type: "get",
      dataType: 'json',
      data: { division_id: divid},
    success: function (data) {
      try {
        // let showdata = JSON.parse(data);
        console.log(data);
        // Process the parsed JSON data
      } catch (error) {
        console.error("Error parsing JSON:", error);
        // Handle the error appropriately
      }
      let showdata =data;
     
      // return;
      var cedit = showdata.cedit;
     if(cedit!='can'){
        $('#addjob').hide();
     }else{
      $('#addjob').show();
     }
      $('#mustact,#inprogress,#waitapprove,#approve').html('');
      // $('#finishjobitem').html('');
      if(showdata.job != 0){
      showdata.job.forEach(element => {
      

      if(element.status == '1'){
        jobText('mustact', element,cedit);
      }
      if(element.status == '2'){
        jobText('inprogress', element,cedit);
      }
      if(element.status == '3'){
        jobText('waitapprove', element,cedit);
      }
      if(element.status == '4'){
        $('#approve').append('<ul style="padding-bottom: 2px;" class="list-group">'+
            '<li class="list-group-item "> '+
            '<div class="row">'+
            '<div class="col-8">'+
              element.job_name+
            '<br> วันที่เริ่ม :'+ element.job_start + '<br> วันที่สิ้นสุด :'+ element.job_end +
            '</div>'+
            '<div class="col-4" class="text-right">'+
            (cedit == 'can' ?  '<button class="btn btn-warning" onclick="updatejobform('+ element.job_id + ')">'+
                  '<i class="fa fa-pencil " aria-hidden="true" ></i> '+
                '</button>': '') +
                '<a href="/showjobselect/'+element.job_id+'" class="btn btn-success">'+
                  '<i class="fa fa-eye" aria-hidden="true" ></i>'+
                '</a>'+
                (cedit == 'can' ?  '<button class="btn btn-danger" onclick="deletejob('+ element.job_id + ')">'+
                '<i class="fa fa-trash" aria-hidden="true"></i></i> '+
                '</button>': '') +
            '</div>'+
          '</li>'+
      '</ul>'
      
        );
      }
        
   
  });
  }
  else{
    alert('ไม่พบ');
  }
      
    },
    error: function(xhr, status, error) {
      console.error("AJAX request error:", error);
      // Handle the AJAX error appropriately
    }

});   
}

//เลือก job แสดง process
function jobselect(jobid){
 
  $.ajax(
    {
      
    url: "/home/get",
    type: "post",
    dataType: 'text',
    data: { jobid1: jobid},
    success: function (data) {
      var a = JSON.parse(data);
      console.log(a.cedit);
      if(a.cedit=='can'){
        $('#urladdprocess').show();
      }else{
        $('#urladdprocess').hide();
      }
      
     
      $('#processitem').html('');
      $('#finishprocessitem').html('');
      
      // $('#addjob_id').html('');
      // $('#addjob_id').append('<input class="addprocessid" type="text" value="'+a.process[0]['job_id']+'">');
      $("#urladdprocess").attr("href", "/formprocess/"+a.job_id+""); 
       
      a.process.forEach(element => {
        if(element.status == 1){
        
          $('#processitem').append('<ul style="padding-bottom: 2px;" class="list-group">'+
          // '<li class="list-group-item "> '+
          '<li id="process'+element.process_id+'" class="list-group-item  process_list ">'+
          '<div class="row">'+
          '<div class="col-8">'+
          '&nbsp; ชื่อ: ' + element.process_name +'<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end +'<br>'+
          '</div>'+
          '<div class="col-4" class="text-right">'+
          '<div class="text-right">'+
          (a.cedit == 'can' ?  '<a class="btn btn-warning" href="/formupdateprocess/'+element.process_id+'" title="แก้ไข">'+
          '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'+
          '&nbsp;&nbsp;<button class="btn btn-success" onclick="confirmprocess('+element.process_id+')" title="จบขั้นตอนการทำงาน">'+
          '<i class="fa fa-check-circle" aria-hidden="true"></i></button>'+
          '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteprocess('+element.process_id+')" title="ลบ">'+
          '<i class="fa fa-window-close" aria-hidden="true"></i></button>': '')+
          (a.cedit == 'cant' ? '<a class="btn btn-success" href="/formupdateprocess/'+element.process_id+'" title="ดูข้อมูล">'+
          '<i class="fa fa-search" aria-hidden="true"></i></a>': '')+
          '</div></div>'+
          '</li>'+
          '</div>'+
          '</ul>'
          
          
          );
          }else if(element.status == 2){
            $('#finishprocessitem').append('<ul style="padding-bottom: 2px;" class="list-group">'+
            // '<li class="list-group-item "> '+
            '<li id="process'+element.process_id+'" class="list-group-item  process_list ">'+
            '<div class="row">'+
            '<div class="col-8">'+
            '&nbsp; ชื่อ: ' + element.process_name +'<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end +'<br>'+
            '</div>'+
            '<div class="col-4" class="text-right">'+
            '<div class="text-right">'+
            '<a class="btn btn-success" href="/formupdateprocess/'+element.process_id+' " title="ดูข้อมูล">'+ '<i class="fa fa-search" aria-hidden="true"></i></a>'+
            '</div>'+
            '</div>'+
            '</li>'+
            '</div>'+
            '</ul>'
          );
            // $('#finishprocessitem').append('<li id="process'+element.process_id+'" class="list-group-item  process_list ">'+
            // '&nbsp; ชื่อ: ' + element.process_name +'<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end +'<br>'+
            // '<div class="text-right">'+
            // '<a class="btn btn-success" href="/formupdateprocess/'+element.process_id+' " title="ดูข้อมูล">'+ '<i class="fa fa-search" aria-hidden="true"></i></a>'+
            // '</div>'+
            // '</li>'
            
            // );
          }
      });

      
    }
});   
}




// ลบขั้นตอนการทำงาน
function deleteprocess(process_id){
  let text = "ยืนยันการลบข้อมูล";
  if (confirm(text) == true) {
    text = "ทำการลบข้อมูลแล้ว";
    alert(text);
    // window.location.reload(false);
    // return false;
    $.ajax(
      {
      url: "/deleteprocess/"+process_id,
      type: "post",
      dataType: 'text',
      // data: { process_id: process_id},
      success: function (data) {
        location.reload(true);
      }
  });   
  } 
  
}

function confirmprocess(process_id){
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
      data: { process_id: process_id},
      success: function (data) {
        location.reload();
      }
  });   
  } 
}
// เพิ่มขั้นตอนการทำงาน
$(document).on("click",".insertprocess",function(){
  let job_id = $('#job_id').val();
  let process_name = $('#process_name').val();
  let processstart = $('#s_date').val();
  let processend = $('#e_date').val();
  let detail = $('#detail').val();
  
  var p_s_start = processstart.split('/');
  let rs_start = p_s_start[2]-543+'-'+p_s_start[1]+'-'+p_s_start[0];
  var p_s_end= processend.split('/');
  let rs_end = p_s_end[2]-543+'-'+p_s_end[1]+'-'+p_s_end[0];
  // alert(rs_start);
  // alert(rs_end);
  let s_job = $('#s_job').val();
  let e_job = $('#e_job').val();
  if(rs_end < rs_start){
    alert('วันที่ สิ้นสุดต้องไม่น้อยกว่าวันที่เริ่มต้น');
    
  }
 
  if(process_name ==''){
    alert('กรุณากรอก ขั้นตอน');
    process_name.focus();
    return false;
  }else if(processstart == ''){
    alert('กรุณากรอกวันที่เริ่มต้น');
    processstart.focus();
    return false;
  }else if(processend == ''){
    alert('กรุณากรอกวันที่สิ้นสุด');
    processend.focus();
    return false;
  }

  $.ajax(
    {
    url: "/insertprocess",
    type: "post",
    dataType: 'text',
    data: {job_id : job_id, process_name : process_name,process_start : rs_start, process_end : rs_end,detail : detail} ,
    success: function (data) {
      
      const obj = JSON.parse(data);
      console.log(obj);
      location.replace("/formupdateprocess/")
    }
});   
});

//เพิ่มขั้นตอนการทำงาน
// แก้ไขขั้นตอนการทำงาน
$(document).on("click",".updateprocess",function(){
  // let job_idprocess = $('.addprocessid').val();
  console.log( $('#formaddprocess').serialize() );
  // return false;
  let job_id = $('#job_id').val();
  let process_name = $('#process_name').val();
  let processstart = $('#s_date').val();
  let processend = $('#e_date').val();
  let detail = $('#detail').val();
  // alert(processstart);
  // alert(processend);
  
  var p_s_start = processstart.split('/');
  let rs_start = p_s_start[2]+'-'+p_s_start[1]+'-'+p_s_start[0];
  var p_s_end= processend.split('/');
  let rs_end = p_s_end[2]+'-'+p_s_end[1]+'-'+p_s_end[0];
  // alert(rs_start);
  // alert(rs_end);
  let s_job = $('#s_job').val();
  let e_job = $('#e_job').val();
  if(rs_end < rs_start){
    alert('วันที่ สิ้นสุดต้องไม่น้อยกว่าวันที่เริ่มต้น');
    
  }
 
//   alert(rs_end-rs_start);
// return false;
  if(process_name ==''){
    alert('กรุณากรอก ขั้นตอน');
    process_name.focus();
    return false;
  }else if(processstart == ''){
    alert('กรุณากรอกวันที่เริ่มต้น');
    processstart.focus();
    return false;
  }else if(processend == ''){
    alert('กรุณากรอกวันที่สิ้นสุด');
    processend.focus();
    return false;
  }

  $.ajax(
    {
    url: "/updateprocess",
    type: "post",
    dataType: 'text',
    data: $('#formaddprocess').serialize() ,
    success: function (data) {
        alert('บันทึก');
        location.reload(true);
    }
});   
});
// แก้ไขขั้นตอนการทำงาน
// addjob
function addjob(){
  let jobname = $('#job_name').val();
  let jobstart = $('#job_start').val();
  let jobend = $('#job_end').val();
  var arr1 = jobstart.split('/');
  let jstart = arr1[2]-543+'-'+arr1[1]+'-'+arr1[0];
  var arr2 = jobend.split('/');
  let jend = arr2[2]-543+'-'+arr2[1]+'-'+arr2[0];  
  var name = document.getElementById("job_name");
  var start = document.getElementById("job_start");
  var end = document.getElementById("job_end");
  if( name.value == "") {
      alert("กรุณากรอกข้อมูลให้ครบถ้วน")
      name.focus();
      return false;
  }else if (start.value ==""){
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
      start.focus();
      return false;
  }else if (end.value == "" ){
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
      end.focus();
      return false;
  }else if (jend < jstart){
    alert("กรุณากรอกข้อมูลวันที่ให้ถูกต้อง")
    return false;
  }
  
  $.ajax(
    {
    url: "/addjob",
    type: "post",
    dataType: 'json',
    data: { jobname: jobname,jobstart: jstart,jobend: jend},
    success: function (data) {
      if(data.success){
        
      alert('บันทึก')
      location.reload(true);
      }else{
        alert(data.error);
      }
    }
});   
}

// editjob
function editjob(){
  let editjob_id = $('#editjob_id').val();
  let editjobname = $('#editjob_name').val();
  let editjobstart = $('#editjob_start').val();
  let editjobend = $('#editjob_end').val();
  var arr1 = editjobstart.split('/');
  let editjstart = arr1[2]-543+'-'+arr1[1]+'-'+arr1[0];
  var arr2 = editjobend.split('/');
  let editjend = arr2[2]-543+'-'+arr2[1]+'-'+arr2[0];  
 
  if( editjobname.value == "") {
      alert("กรุณากรอกข้อมูลให้ครบถ้วน")
      $('#editjob_name').focus();
      return false;
  }else if (editjobstart.value ==""){
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    $('#editjob_start').focus();
      return false;
  }else if (editjobend.value == "" ){
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    $('#editjob_end').focus();
      return false;
  }else if (editjend < editjstart){
    alert("กรุณากรอกข้อมูลวันที่ให้ถูกต้อง")
    return false;
  }
  
  $.ajax(
    {
    url: "/editjob",
    type: "post",
    dataType: 'text',
    data: { editjobid: editjob_id,editjobname: editjobname,editjobstart: editjstart,editjobend: editjend},
    success: function (data) {
      if(data.success){
        
        alert('บันทึก')
        location.reload(true);
        }else{
          alert(data.error);
        }
    }
});   
}

function updatejobform(jobid){
  $.ajax(
    {
    url: "../updatejobform",
    type: "post",
    dataType: "json",
    data: { jobid: jobid},
    success: function (data) {
      $('#myModaledit').modal('show');
      console.log(data);
      $("#editjob_id").val(data.job_id);
      $("#editjob_name").val(data.job_name);
      $("#editjob_start").val(data.job_start);
      $("#editjob_end").val(data.job_end);
      
      if(data.status == '4'){
        $('.footer-edit').hide();
      }else{
        $('.footer-edit').show();
      }
    }
});   
}

//ลบหัวข้อ job
function deletejob(job_id){
  let text = "ยืนยันการลบข้อมูล";
  alert(job_id);
  if (confirm(text) == true) {
    text = "ทำการลบข้อมูลแล้ว";
    alert(text);

      $.ajax({
      url: "/deletejob",
      type: "POST",
      dataType: 'text',
      data: { job_id: job_id},
      success: function (data) {
        if(data.success){
        
          alert('ลบข้อมูลเรียบร้อย')
          location.reload(true);
          }else{
            alert(data.error);
          }
      
          }
      });
  }
};
$(document).on('click','.formaddsubprocess',function(){
  $('.addsubprocess').show();
  $('.updatesubprocess').hide();
});
function editsubprocess(subprocessid){
  
  $.ajax(
    {
    url: "/editsubprocess",
    type: "get",
    dataType: "json",
    data: { subprocess_id: subprocessid},
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

function confirmsubprocess(subid){
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
      data: {job: job_id, subprocessid: subid,processid: process_id },
      success: function (data) {
        location.reload(true);
      } 
    }
  )
}
}
function deletesubprocess(subid){
  let text = "ลบขั้นตอนการทำงานใช่หรือไม่";
  if (confirm(text) == true) {
    text = "ทำการลบข้อมูลแล้ว";
    alert(text);
        $.ajax(
          {
            url: "/deletesubprocess",
            type: "post",
            dataType: "text",
            data: { subprocessid: subid},
            success: function (data) {
              location.reload(true);
            }
      }); 
  }
}
$(document).on( "change",".selectjob", function() {
    $( "select option:selected" ).each( function() {
      jobid = $(this).val() + " ";
    } );
    $('#urladdprocess').hide();
    jobselect(jobid)    
  
  } );
  // ปุ่มเพิ่ม process
$(document).on("click",".addprocess",function(){
    let job_idprocess = $('.addprocessid').val();
    // alert(job_idprocess);
    addprocess(job_idprocess);
});
// เพิ่ม process
function addprocess(job_idprocess){
  $.ajax(
    {
    url: "/formprocess/job",
    type: "post",
    dataType: 'text',
    data: { job_id: job_idprocess},
    success: function (data) {
      
    }
});   
}

$(document).on("click",".modalclose,.cancel",function(){
  $('#exampleModalToggle').modal('hide');
  $('#sub_id,#subprocessinput,#s_sub_date,#e_sub_date').val("");
  // โหลดหน้าเว็บใหม่
  window.location.reload();
});
// แก้ไข subprocess
$(document).on("click",".updatesubprocess",function(){
  let subid = $('#sub_id').val();
  let subinput = $('#subprocessinput').val();
  let s_sub_date = $('#s_sub_date').val();
  let e_sub_date = $('#e_sub_date').val();
  var arr1 = s_sub_date.split('/');
  let substart = arr1[2]-543+'-'+arr1[1]+'-'+arr1[0];
  var arr2 = e_sub_date.split('/');
  let subend = arr2[2]-543+'-'+arr2[1]+'-'+arr2[0]; 
  var start = document.getElementById("s_date");
  var end = document.getElementById("e_date");
  if( subinput.value == "") {
      alert("กรุณากรอกข้อมูลให้ครบถ้วน")
      subinput.focus();
      return false;
  }else if (s_sub_date.value == "" || e_sub_date.value == ""){
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
      return false;
  }else if (e_sub_date < s_sub_date){
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
      data: { sub_id: subid,subprocess_name: subinput,subprocess_start: substart,subprocess_end: subend},
      success: function (data) {
        location.reload();
      }
  });   
});
 
