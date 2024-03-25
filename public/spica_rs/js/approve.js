function detailprocessapprove(jobid){
    $.ajax(
        {
            url: "/detailapprove",
            type: "post",
            dataType: 'json',
            data: { job_id : jobid},
            success: function (data) {
            let a = JSON.parse(data);
          console.log(a)   
            $('#subprocess_id').val(data.subprocess_id);
        }
    });  
      $('#processitem').html('');
       
      a.process.forEach(element => {
       
          $('#processitem').append('<li id="process'+element.process_id+'" class="list-group-item  process_list ">'+
          '&nbsp; ชื่อ: ' + element.process_name +'<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end +'<br>'+
          '<div class="text-right">'+
          '<button class="btn btn-warning editsubprocess" type="button" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">'+ '<i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'+
          '&nbsp;&nbsp;<button class="btn btn-success" onclick="confirmprocess('+element.process_id+')" title="จบขั้นตอนการทำงาน"><i class="fa fa-check-circle" aria-hidden="true"></i></button>'+
          '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteprocess('+element.process_id+')" title="ลบ"><i class="fa fa-window-close" aria-hidden="true"></i></button>'+
          '</div>'+
          '</li>'
          );
      });
}