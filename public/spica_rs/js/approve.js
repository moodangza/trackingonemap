
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
  
    });
    $('#showprocess').html('');
       const colorlist = ['#80CBC4','#FAD7A0'];
    rs_data.process.forEach(rs_process => {
     
        $('#showprocess').append('<div id="process'+rs_process.process_id+'" '+
         'class="card" data-bs-toggle="collapse" data-bs-target="#collapsesubprocess'+rs_process.process_id+'" '+ 'aria-expanded="false" aria-controls="collapseExample">'+
        '&nbsp; ขั้นตอนการทำงาน : ' + rs_process.process_name +'<br>&nbsp; วันที่เริ่ม : '+ rs_process.process_start +'&nbsp; วันที่สิ้นสุด : '+ rs_process.process_end +'<br>'+
        '</div>'
        );
        rs_process.subprocess.forEach(rs_subprocess => {
          console.log(rs_subprocess)
          $('#process'+rs_process.process_id+'').append('<div class="collapse" id="collapsesubprocess'+rs_process.process_id+'"><div class="col-1"></div>'+
          '<div class="col-auto">'+
          '<div class="list-group list-group-light" >'+
        
          '<a href="#" class="list-group-item list-group-item-action px-3 border-0 rounded-3 mb-2 list-group-item-success" style="background-color:'+colorlist+'">'+
            rs_subprocess.subprocess_name+ ' ตั้งแต่วันที่ : '+ rs_subprocess.subprocess_start +' ถึง ' + rs_subprocess.subprocess_end + '</a>'+
        '</div></div></div>'
          );
      });
    });
  
      }
  });  
      
     
}
$(document).on( "click",".approvejob", function() {
  let job_id = $('#job_id').val();
  console.log(job_id);
  let text = "ยืนยันหรือไม่";
  if (confirm(text) == true) {
    $.ajax(
      {
          url: "/confirmapprove",
          type: "post",
          // dataType: 'json',
          data: { job_id : job_id},
          success: function (rs_data) {

          }
        });  
  } else {
   $('#exampleModalCenter').modal();
   $('#exampleModalCenter1').modal('show')
  }

} );