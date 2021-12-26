<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <!--begin::Card-->
      <div class="card card-custom" style="overflow: hidden;">
        <div class="card-header bg-primary">
          <div class="card-title">
            <span class="card-icon">

            </span>
            <h3 class="card-label text-white">List of Students</h3>
          </div>
          <div class="card-toolbar">

            <!--begin::Button-->
            <a href="<?= base_url() ?>students/register" class="btn btn-pill btn-dark font-weight-bolder">
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
              </span>Add New Student</a>
              <!--end::Button-->

            </div>
          </div>
          <div class="card-body card-body-custom">


           <div class="row">

            

           <div class="col-lg-4 col-md-4 col-sm-12 d-none">
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
        <?php $this->load->view('include_tables/table_students') ?>
        <!--end: Datatable-->

        <!-- </div> -->
      </div>
      <!--end::Card-->
    </div>
  </div>
</div>
</div>
<!--end::Content-->

<?php // $this->load->view('include_modals/sales_men_modals') ?>

<script type="text/javascript">
  $('.menu-item-active').removeClass('menu-item-active');
  $('#students_menu').addClass('menu-item-active');
</script>

<?php $this->load->view('include_scripts/students_scripts') ?>
