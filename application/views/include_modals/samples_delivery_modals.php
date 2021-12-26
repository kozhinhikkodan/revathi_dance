<!-- Modal-->
<div class="modal fade" id="sample_delivery_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form autocomplete="off" id="form_sample_delivery_add" data-form-type="samples_delivered" data-modal-id="sample_delivery_add_modal" method="POST" action="<?= base_url()?>samples/create_sample_delivery">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Add new sample delivery</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">

          <div class="form_sample_delivery_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
          </div>


          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group ">
                <label for="expense_head">Doctor <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control select-2" id="doctor_delivery_add" name="doctor">
                  <option selected disabled>Select Doctor</option>
                  <?php foreach ($doctors as $key => $value) { ?>
                    <option value="<?= $value->doctor_id ?>"><?= $value->name.' - '.$value->qualification ?></option>
                  <?php } ?>
                </select>
              </div>
            </div> 
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group ">
                <label for="expense_head">sample <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control select-2" id="sample_delivery_add" name="issue_id">
                  <option selected disabled>Select sample</option>
                </select>
              </div>
            </div>

            

            <div class="col-md-4">
              <div class="form-group">
                <label>Delivered Quantity <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                  <input required type="number" id="sample_delivery_add_qty" class="form-control form_sample_delivery_add_fields" name="quantity" placeholder="Quantity"/>
                  <span><i class="flaticon-edit icon-md"></i></span>
                </div>
                <span class="form-text text-muted" id="sample_delivery_add_qty_info"></span>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Delivered Date <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                  <input required type="text" id="sample_delivered_date" class="form-control form_sample_delivery_add_fields date-field" name="delivered_date" placeholder="Delivered Date"/>
                  <span><i class="flaticon-edit icon-md"></i></span>
                </div>
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-md-12">
             <div class="form-group">
              <label>Remarks</label>
              <div class="input-icon input-icon-right">
                <textarea rows="3" id="remarks" type="text" class="form-control form_sample_delivery_add_fields" name="remarks" placeholder="Remarks" ></textarea>
                <span><i class="flaticon2-list-3 icon-md"></i></span>
              </div>
              <span class="form-text text-muted"></span>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pill btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-pill btn-primary font-weight-bold form_submit">Submit</button>
      </div>
    </form>
  </div>
</div>
</div>


<!-- Modal-->
<div class="modal fade" id="sample_delivery_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form autocomplete="off" id="form_sample_delivery_edit" data-form-type="samples_delivered" data-modal-id="sample_delivery_edit_modal" method="POST" action="<?= base_url()?>samples/update_sample_delivery">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Update sample delivery</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">

          <div class="form_sample_delivery_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
          </div>


          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group ">
                <label for="expense_head">Doctor <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control select-2" id="doctor_delivery_edit" name="doctor">
                  <option selected disabled>Select Doctor</option>
                  <?php foreach ($doctors as $key => $value) { ?>
                    <option value="<?= $value->doctor_id ?>"><?= $value->name.' - '.$value->qualification ?></option>
                  <?php } ?>
                </select>
              </div>
            </div> 
          </div>

          <div class="row">

            <!-- <div class="col-md-4">
              <div class="form-group ">
                <label for="expense_head">sample <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control select-2" id="sample_delivery_edit" name="issue_id">
                  <option selected disabled>Select sample</option>
                </select>
              </div>
            </div> -->

            <div class="col-md-4">
              <div class="form-group">
                <label>sample <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                  <input readonly type="text" id="sample_delivery_edit" class="form-control form_sample_delivery_edit_fields" placeholder="sample"/>
                  <span><i class="flaticon-edit icon-md"></i></span>
                </div>
              </div>
            </div>
            

            <div class="col-md-4">
              <div class="form-group">
                <label>Delivered Quantity <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                  <input required type="number" id="sample_delivery_edit_qty" class="form-control form_sample_delivery_edit_fields" name="quantity" placeholder="Quantity"/>
                  <span><i class="flaticon-edit icon-md"></i></span>
                </div>
                <span class="form-text text-muted" id="sample_delivery_edit_qty_info"></span>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Delivered Date <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                  <input required type="text" id="sample_delivered_date_edit" class="form-control form_sample_delivery_edit_fields date-field" name="delivered_date" placeholder="Delivered Date"/>
                  <span><i class="flaticon-edit icon-md"></i></span>
                </div>
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-md-12">
             <div class="form-group">
              <label>Remarks</label>
              <div class="input-icon input-icon-right">
                <textarea rows="3" id="remarks_edit" type="text" class="form-control form_sample_delivery_edit_fields" name="remarks" placeholder="Remarks" ></textarea>
                <span><i class="flaticon2-list-3 icon-md"></i></span>
              </div>
              <span class="form-text text-muted"></span>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pill btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-pill btn-primary font-weight-bold form_submit">Update</button>
      </div>
    </form>
  </div>
</div>
</div>








<div class="modal fade" id="sample_delivery_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" data-form-type="samples_delivered" data-modal-id="sample_delivery_delete_modal" action="<?= base_url()?>samples/delete_delivery">

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
          <input type="hidden" id="delivery_id_delete" name="delivery_id">
          <input type="hidden" id="sample_id_delete_delivery" name="sample_id">

        </div>


      </form>
    </div>
  </div>
</div>
