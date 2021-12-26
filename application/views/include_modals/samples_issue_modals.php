<!-- Modal-->
<div class="modal fade" id="sample_issue_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form autocomplete="off" id="form_sample_issue" data-form-type="samples_issued" data-modal-id="sample_issue_modal" method="POST" action="<?= base_url()?>samples/create_issued_sample">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Issue New sample</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">

          <div class="form_sample_issue_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
          </div>


          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group ">
                <label for="expense_head">Sales Man <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control select-2" id="sales_man" name="sales_man">
                  <option selected disabled>Select Sales man</option>
                  <?php foreach ($sales_men as $key => $value) { ?>
                    <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div> 
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group ">
                <label for="expense_head">Sample <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control select-2" id="sample_issue_add" name="sample">
                  <option selected disabled>Select Sample</option>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Issued Quantity <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                  <input required type="number" id="sample_issue_qty_add" class="form-control form_sample_issue_fields" name="quantity" placeholder="Quantity" min="1" />
                  <span><i class="flaticon-edit icon-md"></i></span>
                </div>
                <span class="form-text text-muted" id="sample_issue_qty_add_info"></span>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Due Date</label>
                <div class="input-icon input-icon-right">
                  <input type="text" id="sample_due_date" class="form-control form_sample_issue_fields date-field" name="due_date" placeholder="Due Date" value="<?= date('d-m-Y',strtotime(date('d-m-Y').' +7 days'))  ?>" />
                  <span><i class="flaticon-calendar icon-md"></i></span>
                </div>
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-md-12">
             <div class="form-group">
              <label>Remarks</label>
              <div class="input-icon input-icon-right">
                <textarea rows="3" id="remarks" type="text" class="form-control form_sample_issue_fields" name="remarks" placeholder="Remarks" ></textarea>
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
<div class="modal fade" id="sample_issue_update_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form autocomplete="off" id="form_sample_issue_update" data-form-type="samples_issued" data-modal-id="sample_issue_update_modal" method="POST" action="<?= base_url()?>samples/update_issued_sample">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Update Issued sample</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">

          <div class="form_sample_issue_update_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
          </div>

          <input type="hidden" id="issue_id_edit" name="issue_id">
          <input type="hidden" id="sample_id_edit_issue" name="sample_id">

          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group ">
                <label for="expense_head">Sales Man <span class="text-danger">*</span></label>
                <select required style="width: 100%" class="form-control select-2" id="sales_man_issue_edit" name="sales_man">
                  <option selected disabled>Select Sales man</option>
                  <?php foreach ($sales_men as $key => $value) { ?>
                    <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div> 
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group ">
                <label for="expense_head">sample</label>
                <div class="input-icon input-icon-right">
                  <input disabled required type="text" id="sample_issue_edit" class="form-control form_sample_issue_update_fields" />
                  <span><i class="flaticon-edit icon-md"></i></span>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Issued Quantity <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                  <input required type="number" id="sample_qty_issue_edit" class="form-control form_sample_issue_update_fields" name="quantity" placeholder="Quantity"/>
                  <span><i class="flaticon-edit icon-md"></i></span>
                </div>
                <span class="form-text text-muted" id="sample_qty_issue_edit_info"></span>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Due Date</label>
                <div class="input-icon input-icon-right">
                  <input type="text" id="sample_due_date_edit" class="form-control form_sample_issue_fields date-field" name="due_date" placeholder="Due Date" />
                  <span><i class="flaticon-calendar icon-md"></i></span>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
             <div class="form-group">
              <label>Remarks</label>
              <div class="input-icon input-icon-right">
                <textarea rows="3" id="remarks_issue_edit" type="text" class="form-control form_sample_issue_update_fields" name="remarks" placeholder="Remarks" ></textarea>
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




<div class="modal fade" id="sample_issue_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" data-form-type="samples_issued" data-modal-id="sample_issue_delete_modal" action="<?= base_url()?>samples/delete_issued_sample">

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
          <input type="hidden" id="issue_id_delete" name="issue_id">
          <input type="hidden" id="sample_id_delete_issue" name="sample_id">

        </div>


      </form>
    </div>
  </div>
</div>


<!-- Modal-->
<div class="modal fade" id="sample_issue_receive_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 20em">
    <div class="modal-content">
      <form autocomplete="off" id="form_sample_issue_receive" data-form-type="samples_issued" data-modal-id="sample_issue_receive_modal" method="POST" action="<?= base_url()?>samples/receive_sample_issued">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="exampleModalLabel">Mark as Received</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>
        <div class="modal-body">

          <div class="form_sample_issue_receive_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
          </div>

          <input type="hidden" name="issue_id" id="issue_id_receive">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Received Date <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                  <input required type="text" id="sample_issue_received_date" class="form-control form_sample_issue_receive_fields date-field" name="received_date" placeholder="Received Date" value="<?= date('d-m-Y')?>" />
                  <span><i class="flaticon-calendar icon-md"></i></span>
                </div>
              </div>
            </div>

          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-pill btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-pill btn-primary font-weight-bold form_submit">Submit</button>
      </div>
    </form>
  </div>
</div>
</div>



