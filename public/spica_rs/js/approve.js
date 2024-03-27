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
        $('#job_name').text(rs_job.job_name);
        $('#showjob_start').text(rs_job.job_start).attr('disabled',true);
        $('#showjob_end').text(rs_job.job_end).attr('disabled',true);
        // $('#approveitem').append('<li id="process'+rs_job.process_id+'" class="list-group-item  process_list ">'+
        // '&nbsp; ชื่อ: ' + rs_job.process_name +'<br>&nbsp; วันที่เริ่ม: '+ rs_job.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ rs_job.process_end +'<br>'+
        // '<div class="text-right">'+
        // '<button class="btn btn-warning editsubprocess" type="button" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">'+ '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'+
        // '&nbsp;&nbsp;<button class="btn btn-success" onclick="confirmprocess('+rs_job.process_id+')" title="จบขั้นตอนการทำงาน"><i class="fa fa-check-circle" aria-hidden="true"></i></button>'+
        // '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteprocess('+rs_job.process_id+')" title="ลบ"><i class="fa fa-window-close" aria-hidden="true"></i></button>'+
        // '</div>'+
        // '</li>'
        // );
    });
    $('#showprocess').html('');
       
    rs_data.process.forEach(rs_process => {
     
        $('#showprocess').append('<li id="process'+rs_process.process_id+'" '+
         'class="list-group-item  process_list " data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">'+
        '&nbsp; ชื่อ: ' + rs_process.process_name +'<br>&nbsp; วันที่เริ่ม: '+ rs_process.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ rs_process.process_end +'<br>'+
        '<div class="text-right">'+
        '<button class="btn btn-warning editsubprocess" type="button" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">'+ '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'+
        '&nbsp;&nbsp;<button class="btn btn-success" onclick="confirmprocess('+rs_process.process_id+')" title="จบขั้นตอนการทำงาน"><i class="fa fa-check-circle" aria-hidden="true"></i></button>'+
        '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteprocess('+rs_process.process_id+')" title="ลบ"><i class="fa fa-window-close" aria-hidden="true"></i></button>'+
        '</div>'+
        '</li>'
        );
        rs_process.subprocess.forEach(rs_subprocess => {
          console.log(rs_subprocess)
          $('#process'+rs_process.process_id+'').append('<li id="subprocess'+rs_subprocess.subprocess_id+'" '+
           'class="list-group-item  process_list " data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">'+
          '&nbsp; ชื่อ: ' + rs_subprocess.process_name +'<br>&nbsp; วันที่เริ่ม: '+ rs_subprocess.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ rs_subprocess.process_end +'<br>'+
          '<div class="text-right">'+
          '<button class="btn btn-warning editsubprocess" type="button" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">'+ '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'+
          '&nbsp;&nbsp;<button class="btn btn-success" onclick="confirmprocess('+rs_subprocess.process_id+')" title="จบขั้นตอนการทำงาน"><i class="fa fa-check-circle" aria-hidden="true"></i></button>'+
          '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteprocess('+rs_subprocess.process_id+')" title="ลบ"><i class="fa fa-window-close" aria-hidden="true"></i></button>'+
          '</div>'+
          '</li>'
          );
      });
    });
  
      }
  });  
      
     
}