
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <div class="card card-custom">
        <div class="card-header">
          <div class="card-title">
            <h3 class="card-label">Software Configurations</h3>
          </div>
          <div class="card-toolbar">
           <ul class="nav nav-bold nav-pills">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#tab_1">Company</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#tab_4">Advanced</a>
            </li>

          </ul>
        </div>
      </div>
      <form autocomplete="off" id="form_change_config" data-form-type="config" data-form-location="body" method="post" action="<?= base_url()?>settings/config_update">

        <div class="card-body">

          <div class="form-group mb-8" >
            <div class="alert alert-custom alert-warning" role="alert" style="display: none;" id="form_change_password_alert">
              <div class="alert-icon">
                <i class="flaticon-warning text-white"></i>
              </div>
              <div class="alert-text">
                Some field not properly filled , Please correct and try again
              </div>
            </div>
          </div>

          <div class="tab-content">
            <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name" value="<?= config_item('company_name') ?>" />
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="company_name">Company Logo</label>

                    <div class="image-input" id="kt_image_3">
                     <div class="image-input-wrapper" style="background-image: url(<?= base_url() ?>assets/media/logos/<?= config_item('company_logo') ?>)"></div>

                     <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                      <i class="fa fa-pen icon-sm text-muted"></i>
                      <input type="file" name="company_logo" accept=".png, .jpg, .jpeg"/>
                      <input type="hidden" name="company_logo_remove"/>
                    </label>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                      <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                  </div>
                </div>
              </div>

            </div>


            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="company_address">Company Address</label>
                  <textarea type="text" class="form-control" name="company_address" id="company_address" placeholder="Company Address" rows="4"><?= config_item('company_address') ?></textarea>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="company_phone">Company Phone</label>
                  <input type="text" class="form-control" name="company_phone" id="company_phone" placeholder="Company Phone" value="<?= config_item('company_phone') ?>" />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="company_email">Company Email</label>
                  <input type="text" class="form-control" name="company_email" id="company_email" placeholder="Company EMail" value="<?= config_item('company_email') ?>" />
                </div>
              </div>
            </div>

        


          </div>


          <div class="tab-pane fade" id="tab_4" role="tabpanel" aria-labelledby="tab_4">

            <div class="row mb-10">
              <label class="col-6 col-form-label">Maintanance Mode</label>
              <div class="col-6">
                <span class="switch switch-outline switch-icon switch-success">
                  <label>
                    <input type="checkbox" <?php if(config_item('maintanance_mode')==1){ echo "checked"; } ?> name="maintanance_mode" value="1" />
                    <span></span>
                  </label>
                </span>
              </div>
            </div>

            <div class="row mb-10">
              <label class="col-6 col-form-label">Tour Plan End Date</label>
              <div class="col-6">
                <span class="switch switch-outline switch-icon switch-success">
                  <label>
                    <input type="checkbox" <?php if(config_item('tp_end_date_enabled')==1){ echo "checked"; } ?> name="tp_end_date_enabled" value="1" />
                    <span></span>
                  </label>
                </span>
              </div>
            </div>

          </div>

        </div>

        <div class="card-footer">
          <div class="float-right mb-8">
            <button type="submit" class="btn btn-primary mr-2 float-right form_submit">Submit</button>
            <button type="reset" class="btn btn-secondary mr-2 ">Cancel</button>
          </div>
        </div>

      </div>

    </form>
    <!--end::Form-->
  </div>


  <!--end::Dashboard-->
</div>
<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->

<script type="text/javascript">
  $('.active').removeClass('menu-item-active');
  $('#configurations_menu').addClass('menu-item-active');

  $('#kt_body').addClass('aside-minimize');

  $('[data-switch=true]').bootstrapSwitch();
  var avatar3 = new KTImageInput('kt_image_3');
  var avatar4 = new KTImageInput('kt_image_4');
  var avatar5 = new KTImageInput('kt_image_5');



    // $('[data-switch=true]').bootstrapSwitch('state', false);

  </script>
