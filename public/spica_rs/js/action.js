
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
//ปฏิทิน
  $('#s_date,#e_date,#job_start,#job_end,.create-s-date,.create-e-date,#editjob_start,#editjob_end').datepicker({
    language:'th',
    format: 'dd/mm/yyyy',
    todayBtn: 'linked',
    todayHighlight: true,
    autoclose: true
  });
  $(document).on( "click",".addsubprocess", function() {
    alert( "Handler for `click` called." );
    
  } );
});

function jobselect(jobid){
  $.ajax(
    {
      
    url: "/home/get",
    type: "post",
    dataType: 'text',
    data: { jobid1: jobid},
    success: function (data) {
      var a = JSON.parse(data);
      console.log(a.process)
     
      $('#processitem').html('');
      $('#finishprocessitem').html('');
      
      // $('#addjob_id').html('');
      // $('#addjob_id').append('<input class="addprocessid" type="text" value="'+a.process[0]['job_id']+'">');
      $("#urladdprocess").attr("href", "/formaddprocess/"+a.process[0]['job_id']+""); 
       
      a.process.forEach(element => {
       
          $('#processitem').append('<li id="process'+element.process_id+'" class="list-group-item  process_list ">'+
          '&nbsp; ชื่อ: ' + element.process_name +'<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end +'<br>'+
          '<div class="text-right">'+
          '<a class="btn btn-warning" href="/formupdateprocess/'+element.process_id+'" title="แก้ไข">'+ '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'+
          '&nbsp;&nbsp;<button class="btn btn-success" onclick="confirmprocess('+element.process_id+')" title="จบขั้นตอนการทำงาน"><i class="fa fa-check-circle" aria-hidden="true"></i></button>'+
          '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteprocess('+element.process_id+')" title="ลบ"><i class="fa fa-window-close" aria-hidden="true"></i></button>'+
          '</div>'+
          '</li>'
          
          
          );
          
      });
      a.processfinish.forEach(element => {
       
        $('#finishprocessitem').append('<li id="process'+element.process_id+'" class="list-group-item  process_list ">'+
        '&nbsp; ชื่อ: ' + element.process_name +'<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end +'<br>'+
        '<div class="text-right">'+
        '<a class="btn btn-success" href="/formupdateprocess/'+element.process_id+' " title="ดูข้อมูล">'+ '<i class="fa fa-search" aria-hidden="true"></i></a>'+
        '</div>'+
        '</li>'
        
        );
        
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
      url: "deleteprocess/"+process_id,
      type: "post",
      dataType: 'text',
      // data: { process_id: process_id},
      success: function (data) {
       
        window.location.reload(false);
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
      url: "confirmprocess/"+process_id,
      type: "post",
      dataType: 'text',
      // data: { process_id: process_id},
      success: function (data) {
       
        window.location.reload(false);
      }
  });   
  } 
}

$(document).on("click",".insertprocess",function(){
  // let job_idprocess = $('.addprocessid').val();
  // alert(job_idprocess);
  insertprocess();
});
function insertprocess(){
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
    url: "/insertprocess",
    type: "post",
    dataType: 'text',
    data: $('#formaddprocess').serialize() ,
    success: function (data) {
        alert('บันทึก')
    }
});   
}

// addjob
function addjob(){
  let jobname = $('#job_name').val();
  let jobstart = $('#job_start').val();
  let jobend = $('#job_end').val();
  var arr1 = jobstart.split('/');
  let jstart = arr1[2]+'-'+arr1[1]+'-'+arr1[0];
  var arr2 = jobend.split('/');
  let jend = arr2[2]+'-'+arr2[1]+'-'+arr2[0];  
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
    url: "addjob",
    type: "post",
    dataType: 'text',
    data: { jobname: jobname,jobstart: jstart,jobend: jend},
    success: function (data) {
      alert('บันทึก')
      window.location.reload(false);
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
  let editjstart = arr1[2]+'-'+arr1[1]+'-'+arr1[0];
  var arr2 = editjobend.split('/');
  let editjend = arr2[2]+'-'+arr2[1]+'-'+arr2[0];  
  var editname = document.getElementById("editjob_name");
  var editstart = document.getElementById("editjob_start");
  var editend = document.getElementById("editjob_end");
  if( editname.value == "") {
      alert("กรุณากรอกข้อมูลให้ครบถ้วน")
      editname.focus();
      return false;
  }else if (editstart.value ==""){
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    editstart.focus();
      return false;
  }else if (editend.value == "" ){
    alert("กรุณากรอกข้อมูลให้ครบถ้วน")
    editend.focus();
      return false;
  }else if (editjend < editjstart){
    alert("กรุณากรอกข้อมูลวันที่ให้ถูกต้อง")
    return false;
  }
  
  $.ajax(
    {
    url: "editjob",
    type: "post",
    dataType: 'text',
    data: { editjobid: editjob_id,editjobname: editjobname,editjobstart: editjstart,editjobend: editjend},
    success: function (data) {
      alert('บันทึก')
      window.location.reload(false);
    }
});   
}

function updatejobform(jobid){
  $.ajax(
    {
    url: "updatejobform",
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
    }
});   
}

function deletejob(job_id){
  let text = "ยืนยันการลบข้อมูล";
  if (confirm(text) == true) {
    text = "ทำการลบข้อมูลแล้ว";
    alert(text);

      $.ajax({
          url: 'deletejob',
          type: "post",
          dataType: "json",
          data: {job_id: job_id},
          success: function (data) {
            alert('ลบข้อมูลเรียบร้อย')
            window.location.reload(false);
          }
      });
  }
};

function updatesubprocess(subprocessid){
  let inputsub = $("#subprocessinput").val();
  console.log(inputsub);
  return false;
  $.ajax(
    {
    url: "updatesubprocess",
    type: "post",
    dataType: "json",
    data: { subprocessid: subprocessid},
    success: function (data) {

    }
}); 
}
$(document).on('click', '.deletesubprocess', function () {
  alert('dlsnfolsed');
//   $(this).parent('td.text-center').parent('tr.rowClass').remove(); 
//   $.ajax(
//     {
//     url: "deletesubprocess",
//     type: "post",
//     dataType: "json",
//     data: { subprocessid: subprocessid},
//     success: function (data) {
      
//     }
// }); 
});

// showprocess
$(function() {
  // Open Popup
  $('[popup-open]').on('click', function() {
      var popup_name = $(this).attr('popup-open');
$('[popup-name="' + popup_name + '"]').fadeIn(300);
  });

  // Close Popup
  $('[popup-close]').on('click', function() {
var popup_name = $(this).attr('popup-close');
$('[popup-name="' + popup_name + '"]').fadeOut(300);
  });

  // Close Popup When Click Outside
  $('.popup').on('click', function() {
var popup_name = $(this).find('[popup-close]').attr('popup-close');
$('[popup-name="' + popup_name + '"]').fadeOut(300);
  }).children().click(function() {
return false;
  });

});


  $(document).on( "change",".selectjob", function() {
    $( "select option:selected" ).each( function() {
      jobid = $(this).val() + " ";
    } );
    jobselect(jobid)    
  
  } );
$(document).on("click",".addprocess",function(){
    let job_idprocess = $('.addprocessid').val();
    // alert(job_idprocess);
    addprocess(job_idprocess);
});
function addprocess(job_idprocess){
  $.ajax(
    {
    url: "/formaddprocess/job",
    type: "post",
    dataType: 'text',
    data: { job_id: job_idprocess},
    success: function (data) {
    

    }
});   
}
// drag and drop
// id หรือ class ที่ต้องการลาก
// const draggbles = document.querySelectorAll(".shallow-draggable")
// // id หรือ class ที่ต้องการวาง
// const containers = document.querySelectorAll(".draggable-container")

// draggbles.forEach((draggble) => {
//   //for start dragging costing opacity
//   draggble.addEventListener("dragstart", () => {
//     draggble.classList.add("dragging")
//   })

//   //for end the dragging opacity costing
//   draggble.addEventListener("dragend", () => {
//     draggble.classList.remove("dragging")
//   })
// })
// //shit
// containers.forEach((container) => {
//   container.addEventListener("dragover", function (e) {
//     e.preventDefault()
//     const afterElement = dragAfterElement(container, e.clientY)
//     const dragging = document.querySelector(".dragging")
//     if (afterElement == null) {
//       container.appendChild(dragging)
//     } else {
//       container.insertBefore(dragging, afterElement)
//     }
//   })
// })

// function dragAfterElement(container, y) {
//   const draggbleElements = [...container.querySelectorAll(".shallow-draggable:not(.dragging)")]

//   return draggbleElements.reduce(
//     (closest, child) => {
//       const box = child.getBoundingClientRect()
//       const offset = y - box.top - box.height / 2
//       if (offset < 0 && offset > closest.offset) {
//         return { offset: offset, element: child }
//       } else {
//         return closest
//       }
//     },
//     { offset: Number.NEGATIVE_INFINITY }
//   ).element
// }
 
