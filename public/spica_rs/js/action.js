$(document).ready(function() {
   let flag = $('#flag').val();
   if(flag == ''){
  $( "#subprocess" ).hide();
}else{
  $( "#subprocess" ).show();
}
  $('#s_date,#e_date,#job_start,#job_end,.create-s-date,.create-e-date').datepicker({
    language:'th',
    format: 'dd/mm/yyyy',
    todayBtn: 'linked',
    todayHighlight: true,
    autoclose: true
  });
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
      // $('#addjob_id').html('');
      // $('#addjob_id').append('<input class="addprocessid" type="text" value="'+a.process[0]['job_id']+'">');
      $("#urladdprocess").attr("href", "/formaddprocess/"+a.process[0]['job_id']+""); 
       
      a.process.forEach(element => {
       
          $('#processitem').append('<a href="/formupdateprocess/'+element.process_id+'" id="process'+element.process_id+'" class="list-group-item list-group-item-action process_list">'+
          '&nbsp; ชื่อ: ' + element.process_name +'<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end + '</a>');
           
      });
  

    }
});   
}

//updatejob
$(document).on( "click",".updatejob", function() {
  // alert( "Handler for `click` called." );
  $( ".updatejob" ).show();
  let rowcontent = " <tr>"+
  "<td><input type='text' class='form-control' name='subprocessinput[]' id='subprocessinput[]'> </td>"+
  "<td>"+
      "<div class='input-group date'>"+
          "<input type='text' id='s_sub_date[]' readonly='readonly' class='form-control datepicker create-s-date' name='s_sub_date[]' data-old='' value=''>"+
      "<div class='input-group-append'>"+
      "<div required class='input-group-text toggle-datepicker' data-toggle='#create-s-date'><i class='fa fa-calendar'></i>"+
      "</div>"+
      "</div>"+
      "</div>"+
  "</td>"+
"<td>"+
"<div class='input-group date'>"+
"<input type='text' id='e_sub_date[]' readonly='readonly' class='form-control datepicker create-e-date' name='e_sub_date[]' data-old='' value=''>"+
"<div class='input-group-append'>"+
  "<div required class='input-group-text toggle-datepicker' data-toggle='#create-s-date'><i class='fa fa-calendar'></i>"+
  "</div>"+
"</div>"+
"</div>"+
"</td>"+
"<td nowrap>"+
"<button class='btn btn-warning'><i class='fa fa-pencil'></i> บันทึก</button>"+
"<button class='btn btn-danger'><i class='fa fa-times-circle'></i> ลบ</button>"+
"</td>"+
     "</tr>";
  $("#tblsubprocess tbody").append(rowcontent);
  $('#s_date,#e_date,#job_start,#job_end,.create-s-date,.create-e-date').datepicker({
    language:'th',
    format: 'dd/mm/yyyy',
    todayBtn: 'linked',
    todayHighlight: true,
    autoclose: true
  });
} );



$(document).on( "click",".addsubprocess", function() {
  // alert( "Handler for `click` called." );
  $( ".subprocess" ).show();
  let rowcontent = " <tr>"+
  "<td><input type='text' class='form-control' name='subprocessinput[]' id='subprocessinput[]'> </td>"+
  "<td>"+
      "<div class='input-group date'>"+
          "<input type='text' id='s_sub_date[]' readonly='readonly' class='form-control datepicker create-s-date' name='s_sub_date[]' data-old='' value=''>"+
      "<div class='input-group-append'>"+
      "<div required class='input-group-text toggle-datepicker' data-toggle='#create-s-date'><i class='fa fa-calendar'></i>"+
      "</div>"+
      "</div>"+
      "</div>"+
  "</td>"+
"<td>"+
"<div class='input-group date'>"+
"<input type='text' id='e_sub_date[]' readonly='readonly' class='form-control datepicker create-e-date' name='e_sub_date[]' data-old='' value=''>"+
"<div class='input-group-append'>"+
  "<div required class='input-group-text toggle-datepicker' data-toggle='#create-s-date'><i class='fa fa-calendar'></i>"+
  "</div>"+
"</div>"+
"</div>"+
"</td>"+
"<td nowrap>"+
"<button class='btn btn-warning'><i class='fa fa-pencil'></i> บันทึก</button>"+
"<button class='btn btn-danger'><i class='fa fa-times-circle'></i> ลบ</button>"+
"</td>"+
     "</tr>";
  $("#tblsubprocess tbody").append(rowcontent);
  $('#s_date,#e_date,#job_start,#job_end,.create-s-date,.create-e-date').datepicker({
    language:'th',
    format: 'dd/mm/yyyy',
    todayBtn: 'linked',
    todayHighlight: true,
    autoclose: true
  });
} );



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
    data: { editjobname: editjobname,editjobstart: editjstart,editjobend: editjend},
    success: function (data) {
      alert('บันทึก')
      window.location.reload(false);
    }
});   
}

function updatejob(jobid){
  $.ajax(
    {
    url: "updatejob",
    type: "post",
    dataType: "json",
    data: { jobid: jobid},
    success: function (data) {
      $('#myModaledit').modal('show');
      console.log(data);
      $("#editjob_name").val(data.job_name);
      $("#editjob_start").val(data.job_start);
      $("#editjob_end").val(data.job_end);
    }
});   
}
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
 
