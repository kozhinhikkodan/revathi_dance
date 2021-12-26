<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <!--begin::Card-->
      <div class="card card-custom mb-4">
        <div class="card-body ">
          <div class="row">

            <div class="col-md-4">
              <div class="form-group">
                <label>Date</label>
                <div class="input-icon input-icon-right">
                  <input type='text' class="form-control " id='table_filter_date'  placeholder="Select date range"/>
                  <span><i class="la la-calendar-check-o icon-md"></i></span>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group ">
                <label for="expense_head">Sales Man</label>
                <select style="width: 100%" class="form-control select-2 " id="table_filter_sales_man">
                  <option selected disabled>Select Sales man</option>
                  <?php foreach ($sales_men as $key => $value) { ?>
                    <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div> 

            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group ">
                <label for="expense_head">&nbsp;</label>
                <!-- <button class="btn btn-sm "></button> -->
                <button class="btn btn-icon btn-primary btn-shadow btn-circle btn-lg mr-4 mt-6" id="btn_get_report"> <i class="flaticon-search"></i> </button>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!--end::Card-->

      <!--begin::Card-->
      <div class="card card-custom" id="coverage_div" style="display: none;">
        <div class="card-header bg-info">
          <div class="card-title">
            <span class="card-icon">

            </span>
            <h3 class="card-label text-white">Coverage Report</h3>
          </div>
          <div class="card-toolbar">

          </div>
        </div>
        <div class="card-body card-body-custom-info">
          <!--begin: Datatable-->
          <table class="table table-bordered table-tripped table-hover table-checkable" id="coverage_report_table">
            <thead>
              <tr>
                <th width="5%">SL</th>
                <th width="20%">Date</th>
                <th width="30%">Sales Man Name</th>
                <th width="30%">Locality</th>
                <th width="30%">Doctor Name</th>
                <th width="30%">Duration</th>
              </tr>
            </thead>
          </table>
          <!--end: Datatable-->
        </div>
      </div>
      <!--end::Card-->
    </div>
  </div>
</div>
<!--end::Content-->

<script type="text/javascript">
  $('.menu-item-active').removeClass('menu-item-active');
  $('#coverage_report_menu').addClass('menu-item-active');
</script>


<script type="text/javascript">

 $('body').on('click', '#btn_get_report', function() {
  var sales_man_id = $('#table_filter_sales_man').val();
  var date = $('#table_filter_date').val();
  if(sales_man_id!=null && date!=null){
    generate_report();
    $('#coverage_div').show();
  }else{
    toastr['warning']('Please select Date and Sales Man');
  }
});


 function generate_report(){

  $('#coverage_report_table').dataTable().fnDestroy();
  // eval(coverage_report_table).init("reload");

  

  var coverage_report_table = $('#coverage_report_table').DataTable({

   "ajax":{
    url :"<?= base_url().'reports/select_coverage_report' ?>",
    type: "post",
    data: function(d){
      d.sales_man_id = GetSaleMan();
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
      targets: [],

    },
    {
      className:'d-none noExport',
      targets:[]
    }
    ]

  });

function GetSaleMan() { return $('#table_filter_sales_man').val();}
  function GetDate() { return $('#table_filter_date').val();}








}


 // predefined ranges
 var start = moment().subtract(29, 'days');
 var end = moment();

 function range_init(start,end) {
   $('#table_filter_date').val( start.format('DD MMMM, YYYY') + ' - ' + end.format('DD MMMM, YYYY'));
   // coverage_report_table.ajax.reload();
   // generate_report();  
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


generate_report();

</script>