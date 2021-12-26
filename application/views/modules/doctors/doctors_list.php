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
            <h3 class="card-label text-white">List of Doctors</h3>
          </div>
          <div class="card-toolbar">

            <!--begin::Button-->
            <a data-toggle="modal" data-target="#doctor_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
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
              </span>Add New Doctor</a>
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

              <?php if($this->session->userdata('user_role')!='sales_man') { ?>

                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="form-group ">
                    <label for="expense_head">Sales Man</label>
                    <select style="width: 100%" class="form-control select-2 table_filters" id="table_filter_sales_man">
                      <option selected value="all">Select All</option>
                      <?php foreach ($sales_men as $key => $value) { ?>
                        <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div> 

              <?php } ?>

              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Approval Status</label>
                  <div class="radio-inline">
                    <label class="radio radio-primary">
                      <input type="radio" value="all" name="table_filter_status" class="table_filters" checked/>
                      <span></span>
                      All
                    </label>
                    <label class="radio radio-warning">
                      <input type="radio" value="0" name="table_filter_status" class="table_filters" />
                      <span></span> 
                      Pending
                    </label>
                    <label class="radio radio-success">
                      <input type="radio" value="1" name="table_filter_status" class="table_filters" />
                      <span></span> 
                      Approved
                    </label>
                    <label class="radio radio-danger">
                      <input type="radio" value="2" name="table_filter_status" class="table_filters" />
                      <span></span>
                      Rejected
                    </label>
                  </div>
                </div> 
              </div> 

            </div>


            <!--begin: Datatable-->
            <table class="table table-header-fixed table-striped table-bordered table-hover table-header-fixed dataTable no-footer" id="doctors_view_table" >
              <thead>
                <tr>

                  <th width="5%">SL</th>
                  <th width="30%">Name</th>
                  <th width="30%">Location</th>
                  <th width="30%">Specialities</th>
                  <th width="30%">Sales Men</th>
                  <th width="30%">Contact No</th>
                  <th width="10%">Created On</th>
                  <th width="5%">Actions</th>
                  <th class="d-none">id</th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>
                  <th class="d-none"></th>

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

  <?php $this->load->view('include_modals/doctors_modals') ?>

  <script type="text/javascript">
    $('.menu-item-active').removeClass('menu-item-active');

    $('#doctors_menu').addClass('menu-item-open menu-item-here');
    $('#doctors_menu_1').addClass('menu-item-active');

  </script>


  <script type="text/javascript">





   $('#dob').datepicker({
    format: 'dd-mm-yyyy'
  });


   $('#locality_add_doctor,#locality_edit_doctor').select2({
    minimumResultsForSearch: 0
  })



   function GetLocation() { return $('#table_filter_locality').val();}
   function GetSalesMan() { return $('#table_filter_sales_man').val();}
   function GetStatus() { return $('[name=table_filter_status]:checked').val();}

   var doctors_view_table = $('#doctors_view_table').DataTable({

     "ajax":{
      url :"<?= base_url().'doctors/select_doctors' ?>",
      type: "post",
      data: function(d){
        d.location = GetLocation();
        d.sales_man_id = GetSalesMan();
        d.status = GetStatus();
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
      targets: [7],

    },
    {
      className:'d-none noExport',
      targets:[<?php if($this->session->userdata('user_role')=='sales_man') { echo "4,"; }?>8,9,10,11,12,13,14,15,16,17,18,19,20,21,22]
    }
    ]

  });

   $(".table_filters").on("change", function() {
    doctors_view_table.ajax.reload();
  });



   $('body').on('click', '#doctor_edit_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#doctor_id_edit').val(row.eq(8).text());
    $('#name_edit').val(row.eq(1).text());
    $('#email_edit').val(row.eq(22).text());
    $('#full_name_edit').val(row.eq(9).text());
    $('#qualification_edit').val(row.eq(10).text().split(',')).trigger('change');
    $('#specialities_edit').val(row.eq(11).text().split(',')).trigger('change');

    $('#hospital_edit').val(row.eq(12).text());
    $('#hospital_location_edit').val(row.eq(13).text());
    if(row.eq(15).text()!=''){
      $('#dob_edit').val(row.eq(15).text()); 
    }
    if(row.eq(16).text()!=''){
      $('#wedding_date_edit').val(row.eq(16).text());
    }
    $('#address_edit').val(row.eq(18).text());
    $('#visit_frequency_edit').val(row.eq(17).text()).trigger('change');
    $('#mobile_edit').val(row.eq(19).text());
    $('#phone_edit').val(row.eq(20).text());
    $('#locality_edit_doctor').val(row.eq(14).text().split(',')).trigger('change');


    $('[name=doctor_approve_radio][value='+row.eq(21).text()+']').prop('checked',true);

    // if(tagify2 != null && tagify2 != undefined && tagify2 != 'undefined' ){
    //   tagify2.removeAllTags();
    // }

// tagify2.removeAllTags.bind(tagify)


// $('#specialities_edit').val(row.eq(11).text());
// var input2 = document.getElementById('specialities_edit'),
// tagify2 = new Tagify(input2, {
//   whitelist: ["Allergy and immunology","Anesthesiology","Dermatology","Diagnostic radiology","Emergency medicine","Family medicine","Internal medicine","Medical genetics","Neurology","Nuclear medicine","Obstetrics and gynecology","Ophthalmology","Pathology","Pediatrics","Physical medicine and rehabilitation","Preventive medicine","Psychiatry","Radiation oncology","Surgery","Urology"],
//   blacklist: [],
// });

});

   $('body').on('click', '#doctor_delete_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#doctor_id_delete').val(row.eq(8).text());
  });

</script>