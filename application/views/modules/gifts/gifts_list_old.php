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
            <h3 class="card-label text-white">List of Issued Gifts</h3>
          </div>
          <div class="card-toolbar">

            <?php if($this->session->userdata('user_role')=='master_admin') { ?>

              <!--begin::Button-->
              <a data-toggle="modal" data-target="#gift_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
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
                </span>Issue New Gift</a>
                <!--end::Button-->

              <?php } ?>

            </div>
          </div>
          <div class="card-body card-body-custom">


            <div class="row">

              <?php if($this->session->userdata('user_role')!='sales_man') { ?>

                <div class="col-lg-4 col-md-4 col-sm-12">
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

              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Delivery Status</label>
                  <div class="radio-inline">
                    <label class="radio radio-primary">
                      <input type="radio" value="all" name="table_filter_status" class="table_filters" checked/>
                      <span></span>
                      All
                    </label>
                    <label class="radio radio-warning">
                      <input type="radio" value="2" name="table_filter_status" class="table_filters" />
                      <span></span> 
                      Pending
                    </label>
                    <label class="radio radio-success">
                      <input type="radio" value="1" name="table_filter_status" class="table_filters" />
                      <span></span> 
                      Delivered
                    </label>
                    <label class="radio radio-danger">
                      <input type="radio" value="0" name="table_filter_status" class="table_filters" />
                      <span></span>
                      Not Delivered
                    </label>
                  </div>
                </div> 
              </div> 

            </div>


            <!--begin: Datatable-->
            <table class="table table-header-fixed table-striped table-bordered table-hover table-header-fixed dataTable no-footer" id="gifts_view_table">
              <thead>
                <tr>

                  <th width="5%">SL</th>
                  <th width="30%">Gift Name</th>
                  <th width="30%">Quantities</th>
                  <th width="30%">Sales Man</th>
                  <th width="30%">Remarks</th>
                  <th width="10%">Created On</th>
                  <th width="5%">Actions</th>
                  <th class="d-none">id</th>
                  <th class="d-none">sales_man_id</th>
                  <th class="d-none">gift_quantity</th>

                </tr>

              </thead>

            </table>


            <!--end: Datatable-->
          </div>
        </div>
        <!--end::Card-->



        <!--begin::Card-->
        <div class="card card-custom mt-5">
          <div class="card-header bg-info">
            <div class="card-title">
              <span class="card-icon">

              </span>
              <h3 class="card-label text-white">List of Transferred Gifts</h3>
            </div>
            <div class="card-toolbar">

              <?php if($this->session->userdata('user_role')=='sales_man' && $gifts_balance_qty>0) { ?>

                <!--begin::Button-->
                <a data-toggle="modal" data-target="#gift_transfer_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
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
                  </span>Add New Gift Transfer</a>
                  <!--end::Button-->

                <?php } ?>

              </div>
            </div>
            <div class="card-body card-body-custom-info">


              <div class="row">

                <?php if($this->session->userdata('user_role')!='sales_man') { ?>

                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group ">
                      <label for="expense_head">Sales Man</label>
                      <select required style="width: 100%" class="form-control select-2 table_filters_2" id="table_filter_sales_man_2">
                        <option selected value="all">Select All</option>
                        <?php foreach ($sales_men as $key => $value) { ?>
                          <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div> 

                <?php } ?>


              </div>


              <!--begin: Datatable-->
              <table class="table table-header-fixed table-striped table-bordered table-hover table-header-fixed dataTable no-footer" id="gift_transfers_view_table" style="margin-top: 13px !important">
                <thead>
                  <tr>

                    <th width="5%">SL</th>
                    <th width="30%">Sales Man Name</th>
                    <th width="30%">Gift Name</th>
                    <th width="30%">Tarferred Date</th>
                    <th width="30%">Tarferred Quantity</th>
                    <th width="30%">Transferred To </th>
                    <th width="30%">Remarks</th>
                    <th width="10%">Created On</th>
                    <th width="5%">Actions</th>
                    <th class="d-none">gift_id</th>
                    <th class="d-none">transfer_id</th>
                    <th class="d-none">doct_id</th>

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

    <?php $this->load->view('include_modals/gifts_modals') ?>

    <script type="text/javascript">
      $('.menu-item-active').removeClass('menu-item-active');

      $('#gifts_menu').addClass('menu-item-open menu-item-here');
      $('#gifts_menu_1').addClass('menu-item-active');
    </script>


    <script type="text/javascript">

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
     function GetStatus() { return $('[name=table_filter_status]:checked').val();}


     var gifts_view_table = $('#gifts_view_table').DataTable({

       "ajax":{
        url :"<?= base_url().'gifts/select_gifts' ?>",
        type: "post",
        data: function(d){

          d.status = GetStatus();

          <?php if($this->session->userdata('user_role')!='sales_man'){ ?>
            d.sales_man = GetSalesman();
          <?php }else{ ?>
            d.sales_man = '<?= $this->session->userdata('sales_man_data')->sales_man_id ?>';
          <?php } ?> 
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
      targets:[<?php if($this->session->userdata('user_role')=='sales_man'){  ?>3,6,<?php } ?>7,8,9]
    },{
      className:'noExport',
      targets:[6]
    }
    ]

  });

     $(".table_filters").on("change", function() {
      gifts_view_table.ajax.reload();
    });



     $('body').on('click', '#gift_edit_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#gift_id_edit').val(row.eq(7).text());
      $('#sales_man_edit').val(row.eq(8).text()).trigger('change');
      $('#gift_name_edit').val(row.eq(1).text());
      $('#quantity_edit').val(row.eq(9).text());
      $('#remarks_edit').val(row.eq(4).text());
    });

     $('body').on('click', '#gift_delete_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#gift_id_delete').val(row.eq(7).text());
    });


     $('body').on('change', '#gift_transfer_add', function() {
      var gift_id = $('#gift_transfer_add').val();
      if(gift_id!='' && gift_id!=null && gift_id!='Select Gift'){
        $.post("<?= base_url() ?>gifts/fetch_gift_info",{'gift_id':gift_id},function(data) {
          var obj = $.parseJSON(data);
          var balance = obj.gift['balance_quantity'];
          $('#transfer_quantity').attr('max',balance);
          $('#transfer_quantity_info_text').html('Balance - '+balance);
        });
      }
    });

     $('body').on('change', '#gift_transfer_edit', function() {
      var gift_id = $('#gift_transfer_edit').val();
      if(gift_id!='' && gift_id!=null && gift_id!='Select Gift'){
        $.post("<?= base_url() ?>gifts/fetch_gift_info",{'gift_id':gift_id},function(data) {
          var obj = $.parseJSON(data);
          var balance = parseFloat(obj.gift['balance_quantity']);
          balance += parseFloat($('#transfer_quantity_edit').val()); 
          $('#transfer_quantity_edit').attr('max',balance);
          $('#transfer_quantity_edit_info_text').html('Balance - '+balance);
        });
      }
    });



     function GetSalesman_2() { return $('#table_filter_sales_man_2').val();}


     var gift_transfers_view_table = $('#gift_transfers_view_table').DataTable({

       "ajax":{
        url :"<?= base_url().'gifts/select_gift_transfers' ?>",
        type: "post",
        data: function(d){

          // d.status = GetStatus();

          <?php if($this->session->userdata('user_role')!='sales_man'){ ?>
            d.sales_man = GetSalesman_2();
          <?php }else{ ?>
            d.sales_man = '<?= $this->session->userdata('sales_man_data')->sales_man_id ?>';
          <?php } ?> 
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
      },
      title: 'Gift Transfer List',
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
      targets: [8],

    },
    {
      className:'d-none noExport',
      targets:[<?php if($this->session->userdata('user_role')=='sales_man'){  echo "1,"; } else { echo "8,"; } ?>9,10,11]
    },{
      className:'noExport',
      targets:[8]
    }
    ]

  });


     $(".table_filters_2").on("change", function() {
      gift_transfers_view_table.ajax.reload();
    });


     $('body').on('click', '#gift_transfer_delete_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#gift_id_delete_transfer').val(row.eq(9).text());
      $('#transfer_id_delete').val(row.eq(10).text());
    });


     $('body').on('click', '#gift_transfer_edit_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#gift_id_edit_transfer').val(row.eq(9).text());
      $('#transfer_id_edit').val(row.eq(10).text());

      $('#doctor_transfer_edit').val(row.eq(11).text()).trigger('change');
      $('#transfer_date_edit').val(row.eq(3).text());
      $('#gift_transfer_edit').val(row.eq(9).text()).trigger('change');
      $('#transfer_quantity_edit').val(row.eq(4).text());
      $('#remarks_transfer_edit').val(row.eq(6).text());

    });

  </script>