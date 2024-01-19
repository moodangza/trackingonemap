
  $(document).on('click', '.addprocess', function() {
    console.log("fdfmnjkdsbjhdbsj");
    $('#test').modal('show');
  });
  $(document).on( "change",".selectjob", function() {
    let jobid = "";
    $( "select option:selected" ).each( function() {
      jobid += $( this ).val() + " ";
    } );
    alert( jobid );
    $.ajax(
      {
      url: "home/get",
      type: "post",
      dataType: 'text',
      data: { jobid1: jobid},
      success: function (data) {
        var a = JSON.parse(data);
        console.log(a.process)
        $('#processitem').html('');
        a.process.forEach(element => {
            var color = element.process_status;
            
            $('#processitem').append('<a href="#" id="'+element.process_id+'" class="list-group-item list-group-item-action">'+
            '&nbsp; ชื่อ: ' + element.process_name +'<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end + '</a>');
              
                
        });
    
  
      }
  });     
  } );