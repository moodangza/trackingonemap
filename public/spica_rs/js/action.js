$(document).ready(function() {
  $('#s_date,#e_date,#job_start,#job_end').datepicker({
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
       
          $('#processitem').append('<a href="#" id="process'+element.process_id+'" class="list-group-item list-group-item-action process_list">'+
          '&nbsp; ชื่อ: ' + element.process_name +'<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end + '</a>');
           
      });
  

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
  $.ajax(
    {
    url: "addjob",
    type: "post",
    dataType: 'text',
    data: { jobname: jobname,jobstart: jstart,jobend: jend},
    success: function (data) {
   alert('บันทึก')
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
 
