<script type='text/javascript'>
  $().ready(function
var table = $('#mytable').DataTable({
    dom: "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-6'i><'col-sm-6'p>>",
    processing: true,
    serverSide: true,
    order: [
      [0, 'desc']
    ],
    pageLength: 5,
    ajax: {
      url: '/meeting/datatables',
      data: function(d) {
        d.type = $('#type').val()
      }
    },
    language: {
      "url": "/assets/libs/datatables/thai.json",
      "paginate": {
        "first": '<i class="bi bi-chevron-double-left"></i>',
        "last": '<i class="bi bi-chevron-double-right"></i>',
        "previous": '<i class="bi bi-chevron-left"></i>',
        "next": '<i class="bi bi-chevron-right"></i>',
      }
    },
    columnDefs: [
      { targets: [0], render: { _: 'display', sort: 'timestamp' } },
      { targets: [1], render: { _: 'display', sort: 'timestamp' } },
      { targets: [4], className: 'text-nowrap text-center' },
      { targets: [3, 4], orderable: false },
      // { targets: [3], render: { _: 'display', sort: 'timestamp' } },
    ],
  });
  </script>