$(document).ready(function() {
  $("#reason").hide();
$(".radioapprove").change(function(){
  // alert('aaa');
  var approvval = $('input[name="radioapprove"]:checked').val();
  // console.log(approvval);

  if(approvval != 1){
    $("#reason").show();
    $('#reasoninput').attr('disabled',false);
  }else{
    $("#reason").hide();
    $('#reasoninput').attr('disabled',true).val('');
    

  }
});
$(".close,.closemodal").click(function(){
  $(".radioapprove").prop('checked',false);
  $("#reason").hide();
  $('#reasoninput').attr('disabled',true).val('');
});
});
function detailprocessapprove(jobid){
        $.ajax(
      {
          url: "/detailapprove",
          type: "post",
          // dataType: 'json',
          data: { job_id : jobid},
          success: function (rs_data) {
          // let rs_data = JSON.parse(data);
        // console.log(rs_data.process);
      //     // $('#subprocess_id').val(data.subprocess_id);
      rs_data.job.forEach(rs_job => {
        $('#job_id').val(rs_job.job_id);
        $('#job_name').text(rs_job.job_name);
        $('#showjob_start').text(rs_job.job_start);
        $('#showjob_end').text(rs_job.job_end);
        if(rs_job.status == 4){
          $('.radioapprove,#reason,.approvejob,.radiapprove').hide();
        }
  
    });
    $('#showprocess').html('');
       const colorlist = ['#80CBC4','#FAD7A0'];
    rs_data.process.forEach(rs_process => {
     
        $('#showprocess').append('<div id="process'+rs_process.process_id+'" '+
            'class="card table" data-bs-toggle="collapse" data-bs-target="#collapsesubprocess'+rs_process.process_id+'" '+ 'aria-expanded="true" aria-controls="collapseExample">'+
            '&nbsp; ขั้นตอนการทำงาน : ' + rs_process.process_name +'<br>&nbsp; วันที่เริ่ม : '+ rs_process.process_start +'&nbsp; วันที่สิ้นสุด : '+ rs_process.process_end +'<br>'+
        '</div>'
        );
        rs_process.subprocess.forEach(rs_subprocess => {
          console.log(rs_subprocess)
          $('#process'+rs_process.process_id+'').append('<div class="collapse" id="collapsesubprocess'+rs_process.process_id+'">'+
          '<div class="col-1"></div>'+
            '<div class="col-auto">'+
              '<div class="list-group list-group-light" >'+
                '<a href="#" class="list-group-item list-group-item-action px-2 border-0 rounded-3 mb-1 list-group-item-success" style="background-color:'+colorlist+'">'+
            rs_subprocess.subprocess_name+ ' ตั้งแต่วันที่ : '+ rs_subprocess.subprocess_start +' ถึง ' + rs_subprocess.subprocess_end + '</a>'+
              '</div>'+
            '</div>'+
            '</div>'
          );
      });
    });
  
      }
  });  
      
     
}
$(document).on( "click",".approvejob", function() {
  let job_id = $('#job_id').val();
  // console.log(job_id);
  let text = "ยืนยันหรือไม่";
  let ckradio = $('.radioapprove').val();
  let ckreason = $('#reasoninput').val();
  
    if (confirm(text) == true) {
      if($("#radioapprove1").prop('checked')){
       
        $.ajax(
          {
            
              url: "/confirmapprove",
              type: "post",
              dataType: 'text',
              data: { job_id : job_id},
              success: function (rs_data) {
              }
            });  
    
      }
      else if($("#radioapprove").prop('checked') ){
        console.log(ckreason);
        // $.ajax(
        //   {
        //       url: "/rejectapprove",
        //       type: "post",
        //       dataType: 'text',
        //       data: { job_id : job_id},
        //       success: function (rs_data) {
  
        //       }
        //     });  
      }
      
    }else{

    }
 

} );

