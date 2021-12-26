<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Card-->
      <div class="card card-custom gutter-b">
        <div class="card-body">
          <!--begin::Details-->
          <div class="d-flex mb-9"> 
            <!--begin: Pic-->
            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
              <div class="symbol symbol-success symbol-50 symbol-lg-120">

                <!-- <img src="<?= base_url()?>assets/media/svg/avatars/007-boy-2.svg" alt="image" /> -->
              
                <span class="font-size-h1 symbol-label font-weight-boldest">#<?= $hospital_data->hospital_id ?></span>
              </div>
            <!--   <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
              </div> -->
            </div>
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
              <!--begin::Title-->
              <div class="d-flex justify-content-between flex-wrap mt-1">
                <div class="d-flex mr-3">
                  <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3"><?= ucfirst($hospital_data->hospital_name).' '.ucfirst($hospital_data->location) ?></a>
                  <a href="#">
                    <i class="flaticon2-correct text-success font-size-h5"></i>
                  </a>
                </div>
                <div class="my-lg-0 my-3">

                 <div class="my-lg-0 my-3" style=" position: absolute; right: 3%; ">

                <!--   <a class="btn btn-sm btn-dark" href="<?= base_url()?>calendar/<?= $hospital_data->hospital_id ?>" ><i class="flaticon-event-calendar-symbol"></i></a>

                  <button data-toggle="modal" data-target="#vendor_edit_modal" id="vendor_edit_btn" class="btn btn-sm btn-primary m-1"> <i class="flaticon flaticon-edit"></i> </button>

                  <button class="btn btn-sm btn-danger m-1" data-toggle="modal" id="vendor_delete_btn" data-target="#vendor_delete_modal"> <i class="flaticon2 flaticon2-rubbish-bin"></i> </button> -->

                <!--   <button class="btn-sm font-weight-bolder text-uppercase btn btn-success w-100 py-2 px-0 float-right" data-toggle="modal" data-target="#vendor_edit_modal" id="vendor_edit_btn" style="width: 70% !important">Edit</button>

                  <button class="btn-sm font-weight-bolder text-uppercase btn btn-danger w-100 py-2 px-0 mt-3 float-right" data-toggle="modal" data-target="#vendor_delete_modal" id="vendor_delete_btn" style="width: 70% !important">Delete</button> -->

                </div>

              </div>
            </div>
            <!--end::Title-->
            <!--begin::Content-->
            <div class="d-flex flex-wrap justify-content-between mt-1">
              <div class="d-flex flex-column flex-grow-1 pr-8">
                <div class="d-flex flex-wrap mb-4">
                  
                  <a href="tel:<?= str_replace(' ', '', $hospital_data->contact) ?>" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                    <i class="flaticon2-phone mr-2 font-size-lg"></i><?= $hospital_data->contact ?>
                  </a>
                  <a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                    <i class="flaticon2-pin mr-2 font-size-lg"></i><?= str_replace('\n', ' ', $hospital_data->address) ?>
                  </a>
                </div>

                <span class="font-weight-bold text-dark-50"><?= nl2br($hospital_data->description) ?></span>

              </div>
              <div class="d-flex align-items-center w-25 flex-fill float-right mt-lg-12 mt-8">
                <!-- <span class="font-weight-bold text-dark-75">Progress</span> -->
                <div class="progress progress-xs mx-3 w-100">
                  <div class="progress-bar bg-success" role="progressbar" id="percentage_progress_bar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="font-weight-bolder text-dark" id="percentage_info">0%</span>
              </div>
            </div>

            <!--end::Content-->
          </div>
          <!--end::Info-->
        </div>
        <!--end::Details-->
        <div class="separator separator-solid hidden"></div>
        <!--begin::Items-->
        <div class="d-flex align-items-center flex-wrap mt-8">
          <!--begin::Item-->
          <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
            <span class="mr-4">
              <i class="flaticon-share display-4 text-muted font-weight-bold"></i>
            </span>
            <div class="d-flex flex-column text-dark-75">
              <span class="font-weight-bolder font-size-sm">Open Cases</span>
              <span class="font-weight-bolder font-size-h5 text-danger">
                <span class="text-danger font-weight-bold"></span>
                <span id="open_cases_count"></span>
              </span>
            </div>
          </div>
          <!--end::Item-->
          <!--begin::Item-->
          <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
            <span class="mr-4">
              <i class="flaticon-lock display-4 text-muted font-weight-bold"></i>
            </span>
            <div class="d-flex flex-column text-dark-75">
              <span class="font-weight-bolder font-size-sm">Closed Cases</span>
              <span class="font-weight-bolder font-size-h5 text-success">
                <span class="text-success font-weight-bold"></span>
                <span id="closed_cases_count"></span>
              </span>
            </div>
          </div>
          <!--end::Item-->
          <!--begin::Item-->
          <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
            <span class="mr-4">
              <i class="flaticon-list display-4 text-muted font-weight-bold"></i>
            </span>
            <div class="d-flex flex-column text-dark-75">
              <span class="font-weight-bolder font-size-sm">Donations</span>
              <span class="font-weight-bolder font-size-h5 text-primary">
                <span id="donations_units_count"></span>
                <span class="text-dark-50 font-weight-bold">Units</span></span>
              </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
              <span class="mr-4">
                <i class="flaticon-apps display-4 text-muted font-weight-bold"></i>
              </span>
              <div class="d-flex flex-column flex-lg-fill">
                <span class="text-danger font-weight-bolder font-size-sm">
                  <span id="needed_units_count"></span>
                Units Needed</span>
                <a href="<?= base_url() ?>cases" class="text-primary font-weight-bolder">View</a>
              </div>
            </div>

            <!--end::Item-->
            <!--begin::Item-->
                <!-- <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                  <span class="mr-4">
                    <i class="flaticon-chat-1 display-4 text-muted font-weight-bold"></i>
                  </span>
                  <div class="d-flex flex-column">
                    <span class="text-dark-75 font-weight-bolder font-size-sm">648 Comments</span>
                    <a href="#" class="text-primary font-weight-bolder">View</a>
                  </div>
                </div> -->
                <!--end::Item-->

              </div>
              <!--begin::Items-->
            </div>
          </div>

          <div class="card card-custom mb-5">
            <div class="card-body">
              <div class="row">


                <ul class="nav nav-bold nav-pills">
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" data-target="cases_tab" data-table="cases_view_table">Cases</a>

                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" data-target="donations_tab" data-table="donations_view_table">Donations</a>
                  </li>

                </ul>

              </div>
            </div>
          </div>

          <div class="tab-content">
            <div class="tab-pane fade show active" id="cases_tab" role="tabpanel">

              <div class="row">
                <div class="col-xl-12">
                  <div class="card card-custom card-stretch gutter-b ">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                      <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Cases</span>
                      </h3>
                      <div class="card-toolbar">

                        <a data-toggle="modal" data-target="#case_add_modal" class="btn btn-dark btn-md py-2 font-weight-bolder" aria-haspopup="true" aria-expanded="false">Add Case</a>

                      </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2 pb-0">
                      <!--begin::Table-->
                      <div class="table-responsive">
                        <?php $this->load->view('include_tables/cases_table') ?>
                      </div>
                      <!--end::table-->
                    </div>
                    <!--begin::Body-->
                  </div>
                </div>
              </div>

            </div>
          </div>


          <div class="tab-content">
            <div class="tab-pane fade hide" id="donations_tab" role="tabpanel">
              <div class="row">
                <div class="col-xl-12">
                  <div class="card card-custom card-stretch gutter-b ">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                      <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">Donations</span>
                      </h3>
                      <div class="card-toolbar">

                        <a data-toggle="modal" data-target="#donation_add_modal" class="btn btn-dark btn-md py-2 font-weight-bolder" aria-haspopup="true" aria-expanded="false">Add Donation</a>

                      </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2 pb-0">
                      <!--begin::Table-->
                      <div class="table-responsive">
                        <?php $this->load->view('include_tables/donations_table') ?>
                      </div>
                      <!--end::table-->
                    </div>
                    <!--begin::Body-->
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    <!--end::Card-->




    <!-- Modals -->
    <?php $this->load->view('include_modals/cases_modals') ?>
    <?php $this->load->view('include_modals/donations_modals') ?>

    <!-- Table Scripts -->
    <?php $this->load->view('include_scripts/cases_scripts') ?>
    <?php $this->load->view('include_scripts/donations_scripts') ?>


    <script type="text/javascript">
      $('.menu-item-active').removeClass('menu-item-active');
      $('#hospitals_menu').addClass('menu-item-active');



      $('#paid_date_add,#paid_date_edit').datepicker({
        format: 'dd-mm-yyyy'
      });

      $('#invoice_add,#invoice_edit').select2({
        placeholder: 'Select Vendor'
      })


      function fetch_summary_info() {
        var hospital_id = '<?= $hospital_data->hospital_id ?>';
        $.post("<?= base_url() ?>hospitals/fetch_summary_info",{hospital_id:hospital_id},function(data) {
          var obj = $.parseJSON(data);
          $('#percentage_info').html(obj.percentage+'%');
          $('#percentage_progress_bar').attr('aria-valuenow',obj.percentage);
          $('#percentage_progress_bar').css('width',obj.percentage+'%');
          if(obj.percentage<40){
            $('#percentage_progress_bar').addClass('bg-danger').removeClass('bg-success');
          }else{
            $('#percentage_progress_bar').addClass('bg-success').removeClass('bg-danger');
          }

          $('#open_cases_count').html(obj.open_cases_count);
          $('#closed_cases_count').html(obj.closed_cases_count);
          $('#donations_units_count').html(obj.donations_units_count);
          $('#needed_units_count').html(obj.needed_units);
        });
      }

      fetch_summary_info();


      $('#total_amount_info i,#received_amount_info i,#balance_amount_info i').removeClass('text-dark');
      $('#total_amount_info i').addClass('font-weight-bolder font-size-h5 text-primary');
      $('#received_amount_info i').addClass('font-weight-bolder font-size-h5 text-success');
      $('#balance_amount_info i').addClass('font-weight-bolder font-size-h5 text-danger');


      $('#kt_body').addClass('aside-minimize');

      $('#table_filter_patient_type').select2({
        placeholder: 'Select Type'
      });

      $('#start_date,#end_date').datepicker({
        format: 'dd-mm-yyyy'
      });

      $('#joined_date_edit').datepicker({
        format: 'dd-mm-yyyy'
      });


      var avatar5 = new KTImageInput('kt_image_3');

      $('#table_filter_vendor_status').select2({
        placeholder: 'Select Status'
      });

      $('#vendor_status_edit').select2({
        placeholder: 'Select Status'
      });

      $('#service_categories_2,#cities_of_service').select2({
        placeholder: 'Select'
      })


      $('body').on('click', '#vendor_status_btn', function() {
        var row = $(this).closest('tr').children('td');
        $('#user_id_status').val(row.eq(9).text());
        $('input[name=block_status_add][value='+row.eq(10).text()+']').prop('checked',true);

      });



      $('body').on('click', '#invoice_payment_delete_btn', function() {
        var row = $(this).closest('tr').children('td');
        $('#invoice_payment_id_delete').val(row.eq(2).text());
      });


      $('body').on('click', '#invoice_payment_edit_btn', function() {
        var row = $(this).closest('tr').children('td');
        $('#invoice_edit').val(row.eq(2).text()).trigger('change');
        $('#paid_date_edit').val(row.eq(3).text());
        $('#paid_amount_edit').val(row.eq(4).text());
        $('#reference_no_edit').val(row.eq(5).text());
        $('#remarks_edit').val(row.eq(6).text());
        $('#invoice_payment_id_edit').val(row.eq(2).text());


      });






  // nav-link
  $('body').on('click', '.nav-link', function() {

    var tab = $(this).data('target');
    tab_activate(tab);

  });

  function tab_activate(tab) {
    $('.nav-link,.tab-pane').removeClass('active');
    $('.tab-pane').removeClass('show').addClass('hide');
    $('.nav-link[data-target='+tab+'],#'+tab).addClass('active');
    $('#'+tab).removeClass('hide').addClass('show');

    var table = $('.nav-link[data-target='+tab+']').data('table');
    if(table!=''){
      $('#'+table).DataTable().columns.adjust().responsive.recalc();
    }
  }
  
  tab_activate('cases_tab');
  
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
    $($.fn.dataTable.tables(true)).DataTable()
    .columns.adjust()
    .responsive.recalc();
  });


</script>