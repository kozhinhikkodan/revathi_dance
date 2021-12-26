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
            <h3 class="card-label text-white">List of Delivered Samples</h3>
          </div>
          <div class="card-toolbar">

            <?php if($this->session->userdata('user_role')=='sales_man') { ?>

              <!--begin::Button-->
              <a data-toggle="modal" data-target="#sample_delivery_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
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
                </span>Deliver New Sample</a>
                <!--end::Button-->

              <?php } ?>

            </div>
          </div>
          <div class="card-body card-body-custom">


            <div class="row">

              <?php if($this->session->userdata('user_role')!='sales_man') { ?>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="form-group ">
                    <label for="expense_head">Sales Man</label>
                    <select required style="width: 100%" class="form-control select-2 table_filters" id="table_filter_sales_man">
                      <option selected value="all">Select All</option>
                      <?php foreach ($sales_men as $key => $value) { ?>
                        <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div> 

              <?php } ?>

              <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="form-group ">
                  <label for="expense_head">Sample</label>
                  <select required style="width: 100%" class="form-control select-2 table_filters" id="table_filter_sample">
                    <option selected value="all">Select All</option>
                    <?php foreach ($samples2 as $key => $value) { ?>
                      <option value="<?= $value->sample_id ?>"><?= $value->sample_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>


              <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="form-group ">
                  <label for="expense_head">Doctor</label>
                  <select required style="width: 100%" class="form-control select-2 table_filters" id="table_filter_doctor">
                    <option selected value="all">Select All</option>
                    <?php foreach ($doctors as $key => $value) { ?>
                      <option value="<?= $value->doctor_id ?>"><?= $value->name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> 

              

            </div>


            <!--begin: Datatable-->
            <table class="table table-header-fixed table-striped table-bordered table-hover table-header-fixed dataTable no-footer" id="samples_delivered_view_table">
              <thead>
                <tr>

                  <th width="5%">SL</th>
                  <th width="30%">Doctor</th>
                  <th width="30%">Sample Name</th>
                  <th width="30%">Quantity</th>
                  <th width="30%">Sales Man</th>
                  <th width="30%">Remarks</th>
                  <th width="30%">Delivered Date</th>
                  <th width="10%">Created On</th>
                  <th width="5%">Actions</th>
                  <th class="d-none">id</th>
                  <th class="d-none">sales_man_id</th>
                  <th class="d-none">sample_id</th>
                  <th class="d-none">sample_id</th>

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

  <?php $this->load->view('include_modals/samples_delivery_modals') ?>

  <script type="text/javascript">
    $('.menu-item-active').removeClass('menu-item-active');

    $('#samples_menu').addClass('menu-item-open menu-item-here');
    $('#samples_menu_2').addClass('menu-item-active');
  </script>


  <script type="text/javascript">

    fetch_pending_issued_samples('#sample_delivery_add');



    function fetch_pending_issued_samples(target) {
      var sales_man_id = '<?= isset($this->session->userdata('sales_man_data')->sales_man_id) ? $this->session->userdata('sales_man_data')->sales_man_id : ' ' ?>';
      if(sales_man_id!=' '){
        $.post("<?= base_url() ?>samples/fetch_pending_samples_issued",{'sales_man_id':sales_man_id},function(data) {
          var obj = $.parseJSON(data);
          console.log(obj);
          $(target).html('');
          var samples = '<option selected disabled>Select sample</option>';
          $.each(obj, function(index, value) {
            console.log(value);
            samples += '<option value="'+value.issue_id+'">'+value.sample_name+'</option>';
          });
          $(target).html(samples);
        });
      }
    }



    $('body').on('change', '#sample_delivery_add', function() {
      var issue_id = $('#sample_delivery_add').val();
      if(issue_id!='Select sample'){
        $.post("<?= base_url() ?>samples/get_issued_sample_info",{'issue_id':issue_id},function(data) {
          var obj = $.parseJSON(data);
          console.log(obj.sample.balance_quantity);
          $('#sample_delivery_add_qty').attr('max',obj.sample.sample_balance_quantity).attr('min',1);
          $('#sample_delivery_add_qty_info').html('Balance : '+obj.sample.sample_balance_quantity);
        });
      }
    });






    var input = document.getElementById('specialities'),
    tagify = new Tagify(input, {
      whitelist: ["Allergy and immunology","Anesthesiology","Dermatology","Diagnostic radiology","Emergency medicine","Family medicine","Internal medicine","Medical genetics","Neurology","Nuclear medicine","Obstetrics and gynecology","Ophthalmology","Pathology","Pediatrics","Physical medicine and rehabilitation","Preventive medicine","Psychiatry","Radiation oncology","Surgery","Urology"],
      blacklist: [],
    })




    $('#dob').datepicker({
      format: 'dd-mm-yyyy'
    });


    $('#locality_add_doctor,#locality_edit_doctor').select2({
      minimumResultsForSearch: 0
    })



    function GetSalesman() { return $('#table_filter_sales_man').val();}
    function Getsample() { return $('#table_filter_sample').val();}
    function GetDoctor() { return $('#table_filter_doctor').val();}


    var samples_delivered_view_table = $('#samples_delivered_view_table').DataTable({

     "ajax":{
      url :"<?= base_url().'samples/select_samples_delivered' ?>",
      type: "post",
      data: function(d){

        d.doctor = GetDoctor();
        d.sample = Getsample();

        <?php if($this->session->userdata('user_role')!='sales_man'){ ?>
          d.sales_man = GetSalesman();
        <?php }else{ ?>
          d.sales_man = '<?= $this->session->userdata('sales_man_data')->sales_man_id ?>';
        <?php } ?> 
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
      targets:[<?php if($this->session->userdata('user_role')=='sales_man'){  ?>4,<?php } ?>9,10,11,12]
    },{
      className:'noExport',
      targets:[7]
    }
    ]

  });

    $(".table_filters").on("change", function() {
      samples_delivered_view_table.ajax.reload();
    });



    $('body').on('click', '#sample_delivery_edit_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#remarks_edit').val(row.eq(5).text());
      $('#doctor_delivery_edit').val(row.eq(11).text()).trigger('change');
      $('#sample_delivery_edit_qty').val(row.eq(3).text());
      $('#sample_delivered_date_edit').val(row.eq(6).text());
      $('#sample_delivery_edit').val(row.eq(2).text());
      var max =  parseFloat(row.eq(12).text());
      $('#sample_delivery_edit_qty').attr('max',max);
      $('#sample_delivery_edit_qty_info').html('Balance : '+max);
    });

    $('body').on('click', '#sample_delivery_delete_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#delivery_id_delete').val(row.eq(10).text());
      $('#sample_id_delete_delivery').val(row.eq(9).text());
    });




  </script>