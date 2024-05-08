function manageuserform(user_id) {

  $.ajax(
    {
      url: "/manageuserform",
      type: "post",
      dataType: "json",
      data: { user_id: user_id },
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
          $('#staticname').val(rs.name);
          $('#staticsurname').val(rs.surname);
          $('#position').val(rs.position);
          $("#level").val(rs.level).change();
          $("#prefix").val(rs.prefix).change();
          $('#actionbutton').append((flag == 'update' ? '<button class="btn btn-warning" onclick="updateuser(' + rs.user_id + ')">' +
            '<i class="fa fa-pencil " aria-hidden="true" ></i> แก้ไข' +
            '</button>' : ''));
        })
      }
    });
}
function updateuser(user_id) {

  $.ajax(
    {
      url: "/manageuserform",
      type: "post",
      dataType: "json",
      data: { user_id: user_id },
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
        $('#actionbutton').html();
        data.user_rs.forEach(rs => {
          $('#staticusername').val(rs.user_name);
          $("#level").val(rs.level).change();
          $('#actionbutton').append((flag == 'update' ? '<button class="btn btn-warning" onclick="updateuser(' + rs.user_id + ')">' +
            '<i class="fa fa-pencil " aria-hidden="true" ></i> แก้ไข' +
            '</button>' : ''));
        })
      }
    });
}
function updateuser(user_id) {

  var password = $('#password').val();
  var level = $('#level').val();
  var level = $('#level').val();
  var prefix = $('#prefix').val();
  var name = $('#staticname').val();
  var surname = $('#staticsurname').val();
  var position = $('#position').val();
  $.ajax(
    {
      url: "/updateuser",
      type: "post",
      dataType: "json",
      data: {
        user_id: user_id, password: password, level: level,
        prefix: prefix, name: name, surname: surname, position: position
      },
      success: function (data) {
        // alert(data);
        $('#manageusermodal').modal('toggle');
        location.reload();
      }
    });
}
function adduserform(adduser) {
  var flag = adduser;

  $('#manageusermodal').modal('toggle');
  $('#staticusername').prop('readonly', false);
  $('#actionbutton').html();
  $('#actionbutton').append((flag == 'adduser' ? '<button class="btn btn-success" onclick="adduser()">' +
    '<i class="fa fa-check-circle-o  " aria-hidden="true" ></i> บันทึก' +
    '</button>' : ''));
}
function adduser() {

  Swal.fire({
    title: "ต้องการเพิ่มผู้ใช้ใช่หรือไม่?",
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Save",
    denyButtonText: `Don't save`
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire("Saved!", "", "success");
      var user_name = $('#staticusername').val();
      var password = $('#password').val();
      var level = $('#level').val();
      var prefix = $('#prefix').val();
      var name = $('#staticname').val();
      var surname = $('#staticsurname').val();
      var position = $('#position').val();
      $.ajax(
        {
          url: "/adduser",
          type: "post",
          dataType: "text",
          data: { user_name: user_name, password: password,
            prefix: prefix, level: level,  name: name, surname: surname, position: position },
          success: function (data) {
            $('#manageusermodal').modal('toggle');
            location.reload();
          }
        });
    } else if (result.isDenied) {
      // Swal.fire("Changes are not saved", "", "info");
      $('#manageusermodal').modal('toggle');
      location.reload();
    }
  });
}
function ckdupuser() {
  var user_name = $('#staticusername').val();

  $.ajax(
    {
      url: "/ckdupuser",
      type: "post",
      dataType: "json",
      data: { user_name: user_name },
      success: function (data) {
        var rs = data.rs;
        console.log(rs);
        if (rs == 'USER_EXISTS') {
          // alert(rs);
          $('#staticusername')
            .css('color', 'red')
            .addClass("is-invalid");
          $('#actionbutton').hide();
        }
        else if (rs == 'USER_AVAILABLE') {
          // alert(rs);
          $('#staticusername')
            .css('color', 'black')
            .removeClass("is-invalid");
          $('#actionbutton').show();
        }
      }
    });
}