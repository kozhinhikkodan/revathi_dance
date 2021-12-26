<!-- Modal-->
<div class="modal fade" id="manager_work_log_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form autocomplete="off" id="form_manager_work_log_add" data-form-type="manager_work_log" data-modal-id="manager_work_log_add_modal" method="POST" action="<?= base_url()?>managers_work_logs/create">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Add New Work Log</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form_manager_work_log_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
          </div>
          <div class="row" >
            <div class="col-md-7">
              <div class="form-group">
                <label>Sales Man <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control select-2 form_manager_work_log_add_select" id="sales_man_add"  name="sales_man" data-placeholder="Select Sales Man">
                  <option selected disabled>Select Sales man</option>
                  <?php foreach ($sales_men as $key => $value) { ?>
                    <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Locality <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control form_manager_work_log_add_select select-2" id="locality_add_manager_work_log"  name="locality" data-placeholder="Select Locality">
                  <option selected disabled>Select a Locality</option>
                  <?php foreach ($localities as $key => $value) { ?>
                    <option value="<?= $value->locality_id ?>"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
           <div class="col-md-12">
            <div class="form-group">
              <label>Remarks</label>
              <div class="input-icon input-icon-right">
                <textarea required type="text" id="reamrks" class="form-control form-control-pill form_manager_add_fields" name="remarks" placeholder="Remarks"></textarea>
                <span><i class="flaticon-edit icon-md"></i></span>
              </div>
              <span class="form-text text-muted"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary font-weight-bold form_submit">Submit</button>
      </div>
    </form>
  </div>
</div>
</div>

<!-- Modal-->
<div class="modal fade" id="manager_work_log_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form autocomplete="off" id="form_manager_work_log_edit" data-form-type="manager_work_log" data-modal-id="manager_work_log_edit_modal" method="POST" action="<?= base_url()?>managers_work_logs/update">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Update Work Log</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form_manager_work_log_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
          </div>
          <div class="row" >
            <input type="hidden" id="work_log_id_edit" name="work_log_id">
            <div class="col-md-7">
              <div class="form-group">
                <label>Sales Man <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control select-2 form_manager_work_log_edit_select" id="sales_man_edit"  name="sales_man" data-placeholder="Select Sales Man">
                  <option selected disabled>Select Sales man</option>
                  <?php foreach ($sales_men as $key => $value) { ?>
                    <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Locality <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control form_manager_work_log_edit_select select-2" id="locality_edit_manager_work_log"  name="locality" data-placeholder="Select Locality">
                  <option selected disabled>Select a Locality</option>
                  <?php foreach ($localities as $key => $value) { ?>
                    <option value="<?= $value->locality_id ?>"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
           <div class="col-md-12">
            <div class="form-group">
              <label>Remarks</label>
              <div class="input-icon input-icon-right">
                <textarea required type="text" id="remarks_edit" class="form-control form-control-pill form_manager_edit_fields" name="remarks" placeholder="Remarks"></textarea>
                <span><i class="flaticon-edit icon-md"></i></span>
              </div>
              <span class="form-text text-muted"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary font-weight-bold form_submit">Submit</button>
      </div>
    </form>
  </div>
</div>
</div>

<div class="modal fade" id="manager_work_log_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" id="form_manager_work_log_delete" data-form-type="manager_work_log" data-modal-id="manager_work_log_delete_modal" action="<?= base_url()?>managers_work_logs/delete">

        <div class="alert delete-light-danger" role="alert" style="margin-bottom: 0px">
          <button type="button" class="close" data-dismiss="modal"></button>
          <br>
          <h4 class="alert-heading">Warning! Please Confirm Your Action</h4>
          <br>
          <p> Are You Sure to Delete this Data ?. All the Associated Data will Lost. </p>
          <p>
            <div class="col">
              <button type="button" class="btn btn-secondary font-weight-bold mr-1" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger font-weight-bold form_submit">Confirm and Delete</button>
            </div>
          </p>

          <input type="hidden" id="work_log_id_delete" name="work_log_id">

        </div>
      </form>
    </div>
  </div>
</div>
