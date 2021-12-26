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

            <div class="col-md-3">
              <div class="form-group">
                <label>Month</label>
                <div class="input-icon input-icon-right">
                  <input type='text' class="form-control " id='table_filter_date'  placeholder="Select Month" value="<?= date('F Y')?>" />
                  <span><i class="la la-calendar-check-o icon-md"></i></span>
                </div>
              </div>
            </div>

            <?php if($this->session->userdata('user_role')!='sales_man') { ?>

              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group ">
                  <label for="expense_head">Sales Man</label>
                  <select style="width: 100%" class="form-control select-2 " id="table_filter_sales_man2">
                    <option selected disabled>Select Sales man</option>
                    <?php foreach ($sales_men as $key => $value) { ?>
                      <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>

            <?php } ?> 

            
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
      <div class="card card-custom" id="missed_call_div" style="display: none;">
        <div class="card-header bg-info">
          <div class="card-title">
            <span class="card-icon">

            </span>
            <h3 class="card-label text-white">Missed Call Report</h3>
          </div>
          <div class="card-toolbar">

          </div>
        </div>
        <div class="card-body card-body-custom-info">
          <!--begin: Datatable-->
          <table class="table table-bordered table-tripped table-hover table-checkable" id="missed_call_report_table">
            <thead>
              <tr>
                <th width="5%">SL</th>
                <th width="15%">Month</th>
                <th width="30%">Doctor Name</th>
                <th width="30%">Localities</th>
                <th width="30%">Visits</th>
                <th width="30%">Total Visits</th>
              </tr>
            </thead>

            <tbody id="missed_call_report_table_tbody"></tbody>
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
  $('#missed_call_report_menu').addClass('menu-item-active');
</script>


<script type="text/javascript">


  function GetDate() { return $('#table_filter_date').val();}
  function GetSaleMan() { 
    <?php if($this->session->userdata('user_role')=='sales_man'){ ?>
      return '<?=  $this->session->userdata('sales_man_data')->sales_man_id ?>';
    <?php }else{ ?>
      return $('#table_filter_sales_man2').val();
    <?php } ?>
  }


  $('body').on('click', '#btn_get_report', function() {
    var sales_man_id = GetSaleMan();
    var date = GetDate();
    if(sales_man_id!=null && date!=null){
      generate_report();
    }else{
      toastr['warning']('Please select Month and Sales Man');
    }
  });


  function generate_report(){

    $('#missed_call_report_table').dataTable().fnDestroy();

    $.post("<?= base_url() ?>reports/select_missed_call_report",{'sales_man_id':GetSaleMan(),'date':GetDate()},function(data) {
      var obj = $.parseJSON(data);

      $('#missed_call_report_table_tbody').html('');
      $('#missed_call_report_table_tbody').append(obj.data);

      var missed_call_report_table = $('#missed_call_report_table').DataTable({
        scrollX:true,
        dom: 'Bfrtip',
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

      });


    });

    $('#missed_call_div').show();

  }


  $('#table_filter_date').datepicker({
    format: 'MM yyyy',
    minViewMode: 1
  });

// generate_report();

</script>