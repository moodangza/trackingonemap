function manageuserform(user_id){

    $.ajax(
      {
      url: "/manageuserform",
      type: "post",
      dataType: "json",
      data: { user_id: user_id},
      success: function (data) {
        $('#manageusermodal').modal('show');
        console.log(data);
        var flag = data.flag;
        var text = $('#manageusermodalLongTitle').text();
        // modify text
        text = text.replace('รายละเอียด', 'แก้ไขข้อมูล');
        // update element text
        $('#flag').text(text); 
        $("#user_id").val(data.user_rs[0].user_id);
        data.user_rs.forEach(rs => {
            $('#staticusername').val(rs.user_name);
            $("#level").val(rs.level).change();
        $('#actionbutton').append( (flag == 'update' ?  '<button class="btn btn-warning" onclick="updateuser('+ rs.user_id + ')">'+
        '<i class="fa fa-pencil " aria-hidden="true" ></i> '+
      '</button>': '') );
        })
      }
  });   
  }
  function updateuser(user_id){

    $.ajax(
      {
      url: "/manageuserform",
      type: "post",
      dataType: "json",
      data: { user_id: user_id},
      success: function (data) {
        $('#manageusermodal').modal('show');
        console.log(data);
        var flag = data.flag;
        var text = $('#manageusermodalLongTitle').text();
        // modify text
        text = text.replace('รายละเอียด', 'แก้ไขข้อมูล');
        // update element text
        $('#flag').text(text); 
        $("#user_id").val(data.user_rs[0].user_id);
        data.user_rs.forEach(rs => {
            $('#staticusername').val(rs.user_name);
            $("#level").val(rs.level).change();
        $('#actionbutton').append( (flag == 'update' ?  '<button class="btn btn-warning" onclick="updateuser('+ rs.user_id + ')">'+
        '<i class="fa fa-pencil " aria-hidden="true" ></i> '+
      '</button>': '') );
        })
      }
  });   
  }
  function updateuser(user_id)
  {
    var password = $('#password').val();
    var level = $('#level').val(); 
    $.ajax(
      {
      url: "/updateuser",
      type: "post",
      dataType: "json",
      data: { user_id: user_id,password: password,level: level},
      success: function (data) {
        alert('แก้ไขข้อมูลสำเร็จ');
        location.reload();
      }
  });  
  }