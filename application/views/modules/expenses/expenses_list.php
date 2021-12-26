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
            <h3 class="card-label text-white">List of Expenses</h3>
          </div>
          <div class="card-toolbar">

            <?php if($this->session->userdata('user_role')!='master_admin'){ ?>

              <!--begin::Button-->
              <a data-toggle="modal" data-target="#expense_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
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
                </span>Add New Expense</a>
                <!--end::Button-->

              <?php } else {  ?>

               <!--begin::Button-->
               <button id="refresh_da_btn" class="btn btn-pill btn-dark font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M16.7689447,7.81768175 C17.1457787,7.41393107 17.7785676,7.39211077 18.1823183,7.76894473 C18.5860689,8.1457787 18.6078892,8.77856757 18.2310553,9.18231825 L11.2310553,16.6823183 C10.8654446,17.0740439 10.2560456,17.107974 9.84920863,16.7592566 L6.34920863,13.7592566 C5.92988278,13.3998345 5.88132125,12.7685345 6.2407434,12.3492086 C6.60016555,11.9298828 7.23146553,11.8813212 7.65079137,12.2407434 L10.4229928,14.616916 L16.7689447,7.81768175 Z" fill="#000000" fill-rule="nonzero"/>
                  </g>
                </svg>
                <!--end::Svg Icon-->
              </span>Refresh DA</button>
              <!--end::Button-->

            <?php } ?>

          </div>
        </div>
        <div class="card-body card-body-custom">

          <div class="row">


           <div class="col-md-4">
            <div class="form-group">
              <label>Date</label>
              <div class="input-icon input-icon-right">
                <input type='text' class="form-control" id='table_filter_date' readonly  placeholder="Select date range"/>
                <span><i class="la la-calendar-check-o icon-md"></i></span>
              </div>
            </div>
          </div>

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

          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group ">
              <label for="expense_head">Manager</label>
              <select required style="width: 100%" class="form-control select-2 table_filters" id="table_filter_manager">
                <option selected value="all">Select All</option>
                <?php foreach ($managers as $key => $value) { ?>
                  <option value="<?= $value->manager_id ?>"><?= $value->manager_name ?></option>
                <?php } ?>
              </select>
            </div>
          </div> 

        <?php } ?>

        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="form-group">
            <label>Expense type</label>
            <div class="radio-inline">
              <label class="radio radio-warning">
                <input type="radio" value="all" name="table_filter_type" class="table_filters" checked/>
                <span></span>
                All
              </label>
              <label class="radio radio-info">
                <input type="radio" value="ta" name="table_filter_type" class="table_filters" />
                <span></span> 
                TA
              </label>
              <label class="radio radio-success">
                <input type="radio" value="da" name="table_filter_type" class="table_filters" />
                <span></span> 
                DA
              </label>
              <label class="radio radio-primary">
                <input type="radio" value="other" name="table_filter_type" class="table_filters" />
                <span></span>
                Other
              </label>
            </div>
          </div> 
        </div>  


      </div>


      <!--begin: Datatable-->
      <?php $this->load->view('include_tables/table_expenses') ?>
      <!--end: Datatable-->


    </div>
  </div>
  <!--end::Card-->
</div>
</div>
</div>
<!--end::Content-->

<?php $this->load->view('include_modals/expenses_modals') ?>
<?php $this->load->view('include_scripts/expenses_scripts') ?>


<script type="text/javascript">
  $('.menu-item-active').removeClass('menu-item-active');
  $('#expenses_menu').addClass('menu-item-active');
</script>


<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?&libraries=places&dummy=.js&key=AIzaSyB_n73aSZsgc4vpjf1z-D2oLf6n4pI0fgc"></script>

<style type="text/css">
  .pac-container {
    z-index: 10000 !important;
  }
</style>
<script type="text/javascript">

  $('body').on('click', '#refresh_da_btn', function() {
    $.post("<?= base_url() ?>cron/calculate_daily_allowance",function(data) {
      var obj = $.parseJSON(data);
      expenses_view_table.ajax.reload();
    });
      toastr['success']('DA refreshed !');
  });


  $(function() {
    initialize_autocomplete();
  });


  function initialize_autocomplete() {
    var input_1 = document.getElementById('starting_point_1');
    var input_2 = document.getElementById('ending_point_1');
    var options = { };
    new google.maps.places.Autocomplete(input_1, options);
    new google.maps.places.Autocomplete(input_2, options);
  }

  google.maps.event.addDomListener(window, 'load', initialize_autocomplete);


  $('body').on('change keyup', '.places_fields', function() {
    var row = $(this).data('sl');
    console.log(row);  
    calculateDistances(row);  
  });



  function calculateDistances(row) {
    var service = new google.maps.DistanceMatrixService();
    var origin1 = document.getElementById('starting_point_'+row).value;
    var destinationA = document.getElementById('ending_point_'+row).value;

    if(origin1!='' && destinationA!=''){

      var size = 1;

      service.getDistanceMatrix({
        origins: [origin1,],
        destinations: [destinationA],

        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
      }, function (response, status) {
        console.log(response)
        var distance = response.rows[0].elements[0].distance.text.split(' ')[0];
        console.log(distance);
        $('#distance_'+row).val(distance).trigger('change');
      });

    }

  }



</script>

<!-- Autocomplete End-->

<!-- Calculate Distance-->


