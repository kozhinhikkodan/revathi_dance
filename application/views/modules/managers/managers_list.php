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
            <h3 class="card-label text-white">List of Managers</h3>
          </div>
          <div class="card-toolbar">

            <!--begin::Button-->
            <a data-toggle="modal" data-target="#manager_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
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
              </span>Add New Manager</a>
              <!--end::Button-->

            </div>
          </div>
          <div class="card-body card-body-custom">



            <div class="row">

              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group ">
                  <label for="expense_head">Locality</label>
                  <select style="width: 100%" class="form-control select-2 table_filters" id="table_filter_locality" data-placeholder="Select Locality">
                    <option selected value="all">Select All</option>
                    <?php foreach ($localities as $key => $value) { ?>
                      <option value="<?= $value->locality_id ?>"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> 

            </div>

            <!--begin: Datatable-->
            <table class="table table-bordered table-tripped table-hover table-checkable" id="managers_view_table" >
              <thead>
                <tr>

                  <th width="5%">SL</th>
                  <th width="20%">Name</th>
                  <th width="30%">Location</th>
                  <th width="30%">Email</th>
                  <th width="30%">Locations</th>
                  <th width="30%">Contact No</th>
                  <th width="10%">Created On</th>
                  <th width="5%">Actions</th>
                  <th class="d-none">m_id</th>
                  <th class="d-none">user_id</th>
                  <th class="d-none">user_id</th>
                  <th class="d-none">user_id</th>
                  <th class="d-none">user_id</th>
                  <th class="d-none">user_id</th>
                  <th class="d-none">id</th>

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

  <?php $this->load->view('include_modals/managers_modals') ?>

  <script type="text/javascript">
    $('.menu-item-active').removeClass('menu-item-active');
    $('#managers_menu').addClass('menu-item-active');
  </script>


  <script type="text/javascript">

   function GetLocation() { return $('#table_filter_locality').val();}

   var managers_view_table = $('#managers_view_table').DataTable({

     "ajax":{
      url :"<?= base_url().'managers/select_managers' ?>",
      type: "post",
      data: function(d){
        d.location = GetLocation();
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
      }
    }
    ],

    columnDefs: [
    { 
      orderable: false, 
      targets: [7],

    },
    {
      className:'d-none noExport',
      targets:[8,9,10,11,12,13,14]
    }
    ]

  });

   $(".table_filters").on("change", function() {
    managers_view_table.ajax.reload();
  });



   $('body').on('click', '#manager_edit_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#name_edit').val(row.eq(1).text());
    $('#location_edit').val(row.eq(2).text());
    $('#email_edit').val(row.eq(3).text());
    $('#contact_edit').val(row.eq(5).text());
    $('#localities_edit').val(row.eq(11).text().split(',')).trigger('change');
    $('#manager_id_edit').val(row.eq(8).text());
    $('#user_id_edit').val(row.eq(9).text());
    $('#address_edit').val(row.eq(10).text());
    $('#ta_edit').val(row.eq(12).text());
    $('#da_edit').val(row.eq(13).text());
 
  });

   $('body').on('click', '#manager_delete_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#manager_id_delete').val(row.eq(8).text());
    $('#user_id_delete').val(row.eq(9).text());
  });

   
  $('body').on('click', '#copy_login_btn', function() {
    var row = $(this).closest('tr').children('td');
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(row.eq(15).text()).select();
    document.execCommand("copy");
    $temp.remove();
    toastr['info']('Login Details Copied to Clipboard !<br>Use Ctrl+V to Paste');
  });


</script>