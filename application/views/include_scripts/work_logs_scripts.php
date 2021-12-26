
<script type="text/javascript">


  var work_logs_view_table = $('#work_logs_view_table').DataTable({

  //  "ajax":{
  //   url :"",
  //   type: "post",
  //   data: function(d){
     

  //   }
  // },

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
  ]

   

  });

  $(".table_filters").on("change", function() {
    work_logs_view_table.ajax.reload();
  });


 // predefined ranges
 var start = moment();
 var end = moment();

 function range_init(start,end) {
   $('#table_filter_date').val( start.format('DD MMMM, YYYY') + ' - ' + end.format('DD MMMM, YYYY'));
  //  work_logs_view_table.ajax.reload();

 } 

 $('#table_filter_date').daterangepicker({
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

</script>