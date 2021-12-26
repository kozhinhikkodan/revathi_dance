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
            <h3 class="card-label text-white">Course Fee Collected</h3>
          </div>
          <div class="card-toolbar">

              <!--begin::Button-->
              <a data-toggle="modal" id="fee_add_btn" data-target="#fee_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
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
                </span>Add new payment</a>
                <!--end::Button-->

            </div>
          </div>
          <div class="card-body card-body-custom">

            <div class="row">


          </div>






<!--begin: Datatable-->
<table class="table table-bordered table-tripped table-hover table-checkable" id="leaves_view_table">
    <thead>
        <tr>

            <th width="5%">SL</th>
            <th width="25%">Student</th>
            <th width="25%">Paid Date</th>
            <th width="20%">Paid Amount</th>
            <th width="20%">Remarks</th>
            <th width="10%">Created On</th>
            <th width="5%">Actions</th>

        </tr>

    </thead>

    <tbody>
        <tr>
            <td width="5%">1</td>
            <td width="30%">
                <a href="<?= base_url() ?>students/profile/1">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                            <img class="" src="https://preview.keenthemes.com/metronic/demo1/custom/apps/user/assets/media/users/100_14.jpg" alt="photo">
                        </div>
                        <div class="ml-4">
                            <div class="text-dark-75 font-weight-bolder font-size-sm mb-0">Salih</div>
                            <a href="#" class="text-muted font-weight-bold text-hover-primary">9943231209</a>
                        </div>
                    </div>
                </a>
                </div>
            </td>
            <td width="25%">25-10-2020</td>
            <td width="20%">350</td>
            <td width="20%">paid via google pay ref:1234</td>
            <td width="10%">25-10-2020 10:19 AM</td>
            <td width="5%">

                <a href="<?= base_url(); ?>courses/receipt" class="btn btn-sm btn-primary m-1"><i class="flaticon2-printer"></i></a>
                <a class="btn btn-sm btn-warning m-1" data-toggle="modal" data-target="#fee_edit_modal"><i class="flaticon-edit"></i></a>
                <a class="btn btn-sm btn-danger m-1 delete_swal_demo"><i class="flaticon-delete"></i></a>
            </td>
        </tr>

        <tr>
            <td width="5%">1</td>
            <td width="30%">
                <a href="<?= base_url() ?>students/profile/1">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                            <img class="" src="https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media//users/300_1.jpg" alt="photo">
                        </div>
                        <div class="ml-4">
                            <div class="text-dark-75 font-weight-bolder font-size-sm mb-0">Sinan</div>
                            <a href="#" class="text-muted font-weight-bold text-hover-primary">8897654889</a>
                        </div>
                    </div>
                </a>
                </div>
            </td>
            <td width="25%">15-10-2020</td>
            <td width="20%">150</td>
            <td width="20%">by cash</td>
            <td width="10%">24-10-2020 08:08 AM</td>
            <td width="5%">

                <a href="<?= base_url(); ?>courses/receipt" class="btn btn-sm btn-primary m-1"><i class="flaticon2-printer"></i></a>
                <a class="btn btn-sm btn-warning m-1" href="<?= base_url() ?>students/edit/1"><i class="flaticon-edit"></i></a>
                <a class="btn btn-sm btn-danger m-1 delete_swal_demo"><i class="flaticon-delete"></i></a>
            </td>
        </tr>
    </tbody>



</table>





</div>
      </div>
      <!--end::Card-->



    </div>
  </div>
</div>
<!--end::Content-->

<?php $this->load->view('include_modals/fee_modals') ?>
<?php $this->load->view('include_modals/survey_modals') ?>



<script type="text/javascript">
  $('.menu-item-active').removeClass('menu-item-active');
  $('#fee_menu').addClass('menu-item-active');
</script>

<?php $this->load->view('include_scripts/leave_scripts') ?>


<script type="text/javascript">





</script>
