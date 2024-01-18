
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
        a.process.forEach(element => {
          console.log(element)
            $('#processitem').html('<p> Name: ' + element.process_name + '</p>');
                $('#processitem').append('<p>Age : ' + element.process_start+ '</p>');
                $('#processitem').append('<p> Sex: ' + element.process_end+ '</p>');  
        });
      //   $.ajax({
      //     method:'POST',
      //     contentType:'application/json',
      //     url:'home/get',
      //     data: JSON.stringify({"process_id": "process_id", "process_name": "process_name", "data": "detail"}),
      //     success:function(response){
      //       $('#processitem').html('<p> Name: ' + data.response.process_name + '</p>');
      //           $('#processitem').append('<p>Age : ' + data.process_start+ '</p>');
      //           $('#processitem').append('<p> Sex: ' + data.process_end+ '</p>');
      //     }
    
      //  });
      //   $.getJSON('home.json', function(data) {
      //     $('#processitem').html('<p> Name: ' + data.process_name + '</p>');
      //     $('#processitem').append('<p>Age : ' + data.process_start+ '</p>');
      //     $('#processitem').append('<p> Sex: ' + data.process_end+ '</p>');
      //  });
  
      }
  });     
  } );