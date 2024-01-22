// //showjob
// $.ajax({
//     url: "job/get",
//     type: "post",
//     datatype: "text",
//     success: function (data) {
//     var job = JSON.parse(data); 
//     console.log(job);
// // //a.job.forEach(Element => {
// //     var job = element
// // })
// }

// })

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
            
            $('#processitem').append('<a href="#" id="process'+element.process_id+'" class="list-group-item list-group-item-action process_list">'+
            '&nbsp; ชื่อ: ' + element.process_name +'<br>&nbsp; วันที่เริ่ม: '+ element.process_start +'<br>&nbsp; วันที่สิ้นสุด :'+ element.process_end + '</a>');
              
                
        });
    
  
      }
  });     
  } );