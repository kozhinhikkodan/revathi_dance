<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <!--begin::Card-->
      <div class="card card-custom">
        <div class="card-header bg-primary">
          <div class="card-title">
            <span class="card-icon">

            </span>
            <h3 class="card-label text-white">List of Localities</h3>
          </div>
          <div class="card-toolbar">

            <!--begin::Button-->
            <a data-toggle="modal" data-target="#locality_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
              <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>Add New Locality</a>
              <!--end::Button-->

            </div>
          </div>
          <div class="card-body card-body-custom">

            <div class="row">

              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group ">
                  <label for="expense_head">State</label>
                  <select style="width: 100%" class="form-control select-2 table_filters" id="table_filter_state">
                    <option selected value="all">Select All</option>
                    <?php foreach (config_item('states') as $key => $value) { ?>
                      <option value="<?= $value->state_id ?>"><?= $value->state_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> 

              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group ">
                  <label for="expense_head">District</label>
                  <select style="width: 100%" class="form-control select-2 table_filters" id="table_filter_district">
                    <option selected value="all">Select All</option>
                    <?php foreach (config_item('districts') as $key => $value) { ?>
                      <option value="<?= $value->district_id ?>"><?= $value->district_name.' - '.$value->state_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> 

            </div>


            <!--begin: Datatable-->
            <table class="table table-header-fixed table-striped table-bordered table-hover table-header-fixed dataTable no-footer" id="localities_view_table" >
              <thead>
                <tr>

                  <th width="5%">SL</th>
                  <th width="30%">Locality</th>
                  <th width="30%">Distrcit</th>
                  <th width="30%">State</th>
                  <th width="14%">Created On</th>
                  <th width="5%">Actions</th>
                  <th class="d-none">locality_id</th>
                  <th class="d-none">district_id</th>
                  <th class="d-none">state_id</th>
                  <th class="d-none">status</th>
                  
                </tr>

              </thead>


            </tbody>

          </table>


          <!--end: Datatable-->
        </div>
      </div>
      <!--end::Card-->


    </div>
  </div>
</div>
<!--end::Content-->

<?php $this->load->view('include_modals/localities_modals') ?>


<script type="text/javascript">
  $('.menu-item-active').removeClass('menu-item-active');
  $('#locations_menu').addClass('menu-item-active');
</script>

<script type="text/javascript">

 $('body').on('change', '#state_add', function() {
  var state_id = $(this).val();
  if(state_id!=null){
    fetch_districts(state_id,'#district_add');
  }
});

 function GetState() { return $('#table_filter_state').val();}
 function GetDistrict() { return $('#table_filter_district').val(); }

 var localities_view_table = $('#localities_view_table').DataTable({

   "ajax":{
    url :"<?= base_url().'locations/select_localities' ?>",
    type: "post",
    data: function(d){
      d.state = GetState();
      d.district = GetDistrict();
    }
  },

    // serverSide: true,
    responsive: true,
    // searchDelay: 500,
    // processing: true,
    // scrollX:true,
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
      }
    }
    ],

    columnDefs: [
    { 
      orderable: false, 
      targets: [5],

    },
    {
      className:'d-none noExport',
      targets:[6,7,8,9]
    }
    ]

  });

 $(".table_filters").on("change", function() {
  localities_view_table.ajax.reload();
});



 $('body').on('click', '#locality_edit_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#locality_id_edit').val(row.eq(6).text());
  $('#locality_edit').val(row.eq(1).text());
  $('#state_edit').val(row.eq(8).text()).trigger('change');
  fetch_districts(row.eq(8).text(),'#district_edit',row.eq(7).text());
});

 $('body').on('click', '#locality_delete_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#locality_id_delete').val(row.eq(6).text());
});

 $('body').on('click', '#locality_status_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#locality_id_status').val(row.eq(6).text());
  $('#state_status').val(row.eq(3).text());
  $('#district_status').val(row.eq(2).text());
  $('#locality_status').val(row.eq(1).text());
  $('[name=locality_approve_radio][value='+row.eq(9).text()+']').prop('checked',true);
});



</script>

<?php $this->load->view('include_scripts/localities_scripts') ?>
