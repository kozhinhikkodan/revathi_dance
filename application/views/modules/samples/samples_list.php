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
            <h3 class="card-label text-white">List of Samples</h3>
          </div>
          <div class="card-toolbar">

            <?php if($this->session->userdata('user_role')=='master_admin') { ?>

              <!--begin::Button-->
              <a data-toggle="modal" data-target="#sample_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
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
                </span>Add New Sample</a>
                <!--end::Button-->

              <?php } ?>

            </div>
          </div>
          <div class="card-body card-body-custom">


            <div class="row">


              <div class="col-lg-6 col-md-6 col-sm-12">
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
            <table class="table table-header-fixed table-striped table-bordered table-hover table-header-fixed dataTable no-footer" id="samples_view_table">
              <thead>
                <tr>

                  <th width="5%">SL</th>
                  <th width="30%">Sample Name</th>
                  <th width="30%">Quantities</th>
                  <th width="30%">Remarks</th>
                  <th width="10%">Created On</th>
                  <th width="5%">Actions</th>
                  <th class="d-none">id</th>
                  <th class="d-none">sample_quantity</th>

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

    <?php $this->load->view('include_modals/samples_list_modals') ?>

    <script type="text/javascript">
      $('.menu-item-active').removeClass('menu-item-active');

      $('#samples_menu').addClass('menu-item-open menu-item-here');
      $('#samples_menu_3').addClass('menu-item-active');
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


     var samples_view_table = $('#samples_view_table').DataTable({

       "ajax":{
        url :"<?= base_url().'samples/select_samples' ?>",
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
      targets: [5],

    },
    {
      className:'d-none noExport',
      targets:[6,7]
    },{
      className:'noExport',
      targets:[5]
    }
    ]

  });

     $(".table_filters").on("change", function() {
      samples_view_table.ajax.reload();
    });



     $('body').on('click', '#sample_edit_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#sample_id_edit').val(row.eq(6).text());
      $('#sample_name_edit').val(row.eq(1).text());
      $('#quantity_edit').val(row.eq(7).text());
      $('#remarks_edit').val(row.eq(3).text());
    });

     $('body').on('click', '#sample_delete_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#sample_id_delete').val(row.eq(6).text());
    });


     $('body').on('change', '#sample_transfer_add', function() {
      var sample_id = $('#sample_transfer_add').val();
      if(sample_id!='' && sample_id!=null && sample_id!='Select sample'){
        $.post("<?= base_url() ?>samples/fetch_sample_info",{'sample_id':sample_id},function(data) {
          var obj = $.parseJSON(data);
          var balance = obj.sample['balance_quantity'];
          $('#transfer_quantity').attr('max',balance);
          $('#transfer_quantity_info_text').html('Balance - '+balance);
        });
      }
    });

     $('body').on('change', '#sample_transfer_edit', function() {
      var sample_id = $('#sample_transfer_edit').val();
      if(sample_id!='' && sample_id!=null && sample_id!='Select sample'){
        $.post("<?= base_url() ?>samples/fetch_sample_info",{'sample_id':sample_id},function(data) {
          var obj = $.parseJSON(data);
          var balance = parseFloat(obj.sample['balance_quantity']);
          balance += parseFloat($('#transfer_quantity_edit').val()); 
          $('#transfer_quantity_edit').attr('max',balance);
          $('#transfer_quantity_edit_info_text').html('Balance - '+balance);
        });
      }
    });



  </script>