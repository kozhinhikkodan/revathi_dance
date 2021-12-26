
<script type="text/javascript">

 function GetSalesMan() { return $('#table_filter_sales_man').val();}
 function GetStatus() { return $('[name=table_filter_status]:checked').val();}

 var leaves_view_table = $('#leaves_view_table').DataTable({



    // serverSide: true,
    // responsive: true,
    // searchDelay: 500,
    // processing: true,
    scrollX:true,
    dom: 'Bfrtip',
    // buttons: [
    // 'csv', 'excel', 'pdf', 'print'
    // ],
    buttons:[
    {
      extend: 'csv',
      exportOptions: {
        columns: [ "thead th:not(.noExport)" ]
      }
    }
    ,{
      extend: 'excel',
      exportOptions: {
        columns: [ "thead th:not(.noExport)" ]
      }
    },
    {
      extend: 'pdf',
      exportOptions: {
        columns: [ "thead th:not(.noExport)" ]
      }
    },
    {
      extend: 'print',
      exportOptions: {
        columns: [ "thead th:not(.noExport)" ]
      },
      title: '<?= ucfirst(str_replace('_', ' ', $page)) ?>',
      customize: function ( win ) {
        $(win.document.body)
        .prepend(
          '<img src="<?= base_url() ?>assets/media/logos/company_logo.png" style="position:absolute; top:50%; left:40%;opacity:0.4;" />'
          );
      }
    }
    ],

    columnDefs: [
    { 
      orderable: false, 
      targets: [],

    },
    {
      className:'d-none noExport',
      targets:[]
    }
    ]

  });

 $(".table_filters").on("change", function() {
  leaves_view_table.ajax.reload();
});



 $('body').on('click', '#leave_edit_btn', function() {
  var row = $(this).closest('tr').children('td');
  var dateArr = row.eq(9).text().split(',');
  console.log(dateArr);
  for (var j = 0; j < dateArr.length; j++) {
   $("#leave_dates_edit").datepicker("setDate", dateArr[j]);
 }
 $('#remarks_edit').val(row.eq(3).text());
});

 $('body').on('click', '#leave_delete_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#leave_id_delete').val(row.eq(7).text());
});

 $('body').on('click', '#leave_status_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#leave_id_status').val(row.eq(7).text());
  $('[name=leave_approve_radio][value='+row.eq(8).text()+']').prop('checked',true);
});

</script>