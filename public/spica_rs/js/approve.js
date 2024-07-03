$(document).ready(function () {
  $("#reason").hide();
  $(".radioapprove").change(function () {
    // alert('aaa');
    var approvval = $('input[name="radioapprove"]:checked').val();
    // console.log(approvval);

    if (approvval != 1) {
      $("#reason").show();
      $('#reasoninput').attr('disabled', false);
    } else {
      $("#reason").hide();
      $('#reasoninput').attr('disabled', true).val('');


    }
  });
  $(".close,.closemodal").click(function () {
    $(".radioapprove").prop('checked', false);
    $("#reason").hide();
    $('#reasoninput').attr('disabled', true).val('');
    location.reload(true);
  });
});
function detailprocessapprove(jobid) {
  $.ajax(
    {
      url: "/detailapprove",
      type: "post",
      // dataType: 'json',
      data: { job_id: jobid },
      success: function (rs_data) {
        // let rs_data = JSON.parse(data);
        console.log(rs_data.history);
        //     // $('#subprocess_id').val(data.subprocess_id);
        rs_data.job.forEach(rs_job => {
          $('#job_id').val(rs_job.job_id);
          $('#job_name').text(rs_job.job_name);
          $('#showjob_start').text(rs_job.job_start);
          $('#showjob_end').text(rs_job.job_end);
          if (rs_job.status == 4) {
            $('.radioapprove,#reason,.approvejob,.radiapprove').hide();
          }

        });
        $('#showprocess').html('');
        $('#historyapprove').html('');
        const colorlist = ['#80CBC4', '#FAD7A0'];
        rs_data.process.forEach(rs_process => {

          $('#showprocess').append('<tr id="process' + rs_process.process_id + '" ' +
            'class="table table-sm" data-bs-toggle="collapse" data-bs-target="#collapsesubprocess' + rs_process.process_id + '" ' + 'aria-expanded="true" >' +
            '<td>' + rs_process.process_name + '</td><td>' + rs_process.process_start + '</td><td>' + rs_process.process_end + '</td>'+
            // '&nbsp; ขั้นตอนการทำงาน : ' + rs_process.process_name + '<br>&nbsp; วันที่เริ่ม : ' + rs_process.process_start + '&nbsp; วันที่สิ้นสุด : ' + rs_process.process_end + '<br>' +
            '</tr>'+
            '<tr class="table table-sm" id="rsprocess' + rs_process.process_id + '" ></tr>' 
          );
          rs_process.subprocess.forEach(rs_subprocess => {
            // console.log(rs_subprocess)
            $('#rsprocess' + rs_process.process_id + '').append('<tr class="collapse table table-sm" id="collapsesubprocess' + rs_process.process_id + '">'+
              
              // '<td>' +
              // '<a href="#" class="list-group-item list-group-item-action px-2 border-0 rounded-3 mb-1 list-group-item-success" style="background-color:' + colorlist + '">' +
              '<td>' + rs_subprocess.subprocess_name + '</td><td>' + rs_subprocess.subprocess_start + '</td><td>' + rs_subprocess.subprocess_end + '</td>'+
             
              '</tr>'
            );
          });
        });
        rs_data.history.forEach(rs_history => {
          console.log(rs_history);
          if(rs_history.reject_detail != 'null'){
            var reject_dt = rs_history.reject_detail;
          }else{
            var reject_dt = '';
          }
          if(rs_history.approve_date != 'null'){
            var approve_date = rs_history.approve_date
          }else{
            var approve_date = '';
          }
          if(rs_history.reject_date != 'null'){
            var reject_date = rs_history.reject_date
          }else{
            var reject_date = '';
          }
          $('#historyapprove').append('<div class="card table" >' +
            '&nbsp; เหตุผลที่ไม่อนุมัติ : ' + reject_dt + '<br>&nbsp; อนุมัติเมื่อ : ' + approve_date + '<br> &nbsp; วันที่ไม่อนุมัติ : ' + reject_date + '<br>' +
            '</div>'
          );
        }
        );

      }
    });


}
$(document).on("click",".addprocess",function(){
  $("#myModaledit").modal('hide');
  $("#testModal").modal('show');
  // $("#listprocess").append("<input type='text' name=''>");
});
$(document).on("click", ".approvejob", function () {
  let job_id = $('#job_id').val();
  // console.log(job_id);
  let text = "ยืนยันหรือไม่";
  let ckradio = $('.radioapprove').val();
  let ckreason = $('#reasoninput').val();

  if (confirm(text) == true) {
    if ($("#radioapprove1").prop('checked')) {

      $.ajax(
        {

          url: "/confirmapprove",
          type: "post",
          dataType: 'text',
          data: { job_id: job_id, status: ckradio },
          success: function (rs_data) {
            location.reload();
          }
        });

    }
    else if ($("#radioapprove").prop('checked')) {
      // console.log(ckreason);
      if ($('#reasoninput').val() == '') {
        alert('กรุณากรอกเหตุผล');
        return false;
      } else {
        alert('บันทึก');
        $.ajax(
          {
            url: "/rejectapprove",
            type: "post",
            dataType: 'text',
            data: { job_id: job_id, status: ckradio, reject_detail: ckreason },
            success: function (rs_data) {
              location.reload();
            }
          });
      }
    } else {
      alert('กรุณาเลือกผลการอนุมัติ');
      $("#radioapprove1").focus();
      return (false);
    }

  } else {

  }


});

