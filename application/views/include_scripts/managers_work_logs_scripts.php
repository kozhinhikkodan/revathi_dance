
<script type="text/javascript">





 function GetManager() { return $('#table_filter_manager').val();}
 function GetSalesMan() { return $('#table_filter_sales_man').val(); }
 function GetLocality() { return $('#table_filter_locality').val(); }
 function GetDate() { return $('#table_filter_date_range').val(); }


 var managers_work_logs_view_table = $('#managers_work_logs_view_table').DataTable({

   "ajax":{
    url :"<?= base_url().'managers_work_logs/select_work_logs' ?>",
    type: "post",
    data: function(d){
      <?php if($this->session->userdata('user_role')=='manager') { ?>
        d.manager_id = '<?= $this->session->userdata('manager_data')->manager_id ?>';
      <?php } else { ?>
        d.manager_id = GetManager();
      <?php } ?>
      d.sales_man_id = GetSalesMan();
      d.locality_id = GetLocality();
      d.date = GetDate();
    }
  },

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
      targets: [6],

    },
    {
      className:'d-none noExport',
      targets:[<?php if($this->session->userdata('user_role')=='manager') { echo "1"; }?><?php if($page=='doctor_profile') { echo ",2"; }?>,7,8,9,10]
    },
    {
      className: 'noExport',
      targets: [6]
    },
    ]

  });

 $(".table_filters").on("change", function() {
  managers_work_logs_view_table.ajax.reload();
});

 // predefined ranges
 var start = moment().subtract(29, 'days');
 var end = moment();

 function range_init(start,end) {
   $('#table_filter_date_range').val( start.format('DD MMMM, YYYY') + ' - ' + end.format('DD MMMM, YYYY'));
   managers_work_logs_view_table.ajax.reload();
 } 

 $('#table_filter_date_range').daterangepicker({
   buttonClasses: ' btn',
   applyClass: 'btn-primary',
   cancelClass: 'btn-secondary',

   startDate: start,
   endDate: end,
   locale: {
    format: 'DD MMMM, YYYY'
  },
  ranges: {
   'Today': [moment(), moment()],
   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
   'This Month': [moment().startOf('month'), moment().endOf('month')],
   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
 }
},range_init);

 range_init(start,end);


 $('body').on('click', '#manager_work_log_edit_btn', function() {
  var row = $(this).closest('tr').children('td');

  $('#sales_man_edit').val(row.eq(8).text()).trigger('change');
  $('#locality_edit_manager_work_log').val(row.eq(7).text()).trigger('change');
  $('#work_log_id_edit').val(row.eq(9).text());
  $('#remarks_edit').val(row.eq(4).text());
});

 $('body').on('click', '#manager_work_log_delete_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#work_log_id_delete').val(row.eq(10).text());
});

</script>