<!-- Modal-->
<div class="modal fade" id="sample_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_sample_add" data-form-type="samples" data-modal-id="sample_add_modal" method="POST" action="<?= base_url()?>samples/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Issue New sample</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_sample_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
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
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Sample Name <span class="text-danger">*</span></label>
                        <div class="input-icon input-icon-right">
                            <input required type="text" id="sample_name" class="form-control form-control-pill form_sample_add_fields" name="sample_name" placeholder="sample Name"/>
                            <span><i class="flaticon-edit icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Sample Quantity <span class="text-danger">*</span></label>
                        <div class="input-icon input-icon-right">
                            <input required type="number" id="quantity" class="form-control form_sample_add_fields" name="quantity" placeholder="Quantity"/>
                            <span><i class="flaticon-edit icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                 <div class="form-group">
                    <label>Remarks</label>
                    <div class="input-icon input-icon-right">
                        <textarea rows="3" id="remarks" type="text" class="form-control form_sample_add_fields" name="remarks" placeholder="Remarks" ></textarea>
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
<div class="modal fade" id="sample_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_sample_edit" data-form-type="samples" data-modal-id="sample_edit_modal" method="POST" action="<?= base_url()?>samples/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Issued sample</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_sample_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" id="sample_id_edit" name="sample_id">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group ">
                              <label for="expense_head">Sales Man <span class="text-danger">*</span></label>
                              <select required style="width: 100%" class="form-control select-2" id="sales_man_edit" name="sales_man">
                                <option selected disabled>Select Sales man</option>
                                <?php foreach ($sales_men as $key => $value) { ?>
                                  <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                              <?php } ?>
                          </select>
                      </div>
                  </div> 
              </div>

              <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>sample Name <span class="text-danger">*</span></label>
                        <div class="input-icon input-icon-right">
                            <input required type="text" id="sample_name_edit" class="form-control form-control-pill form_sample_edit_fields" name="sample_name" placeholder="sample Name"/>
                            <span><i class="flaticon-edit icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>sample Quantity <span class="text-danger">*</span></label>
                        <div class="input-icon input-icon-right">
                            <input required type="number" id="quantity_edit" class="form-control form_sample_edit_fields" name="quantity" placeholder="Quantity"/>
                            <span><i class="flaticon-edit icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                 <div class="form-group">
                    <label>Remarks</label>
                    <div class="input-icon input-icon-right">
                        <textarea rows="3" id="remarks_edit" type="text" class="form-control form_sample_edit_fields" name="remarks" placeholder="Remarks" ></textarea>
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


<div class="modal fade" id="sample_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="samples" data-modal-id="sample_delete_modal" action="<?= base_url()?>samples/delete">

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
                <input type="hidden" id="sample_id_delete" name="sample_id">
            </div>


        </form>
    </div>
</div>
</div>






<!-- Modal-->
<div class="modal fade" id="sample_transfer_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_sample_transfer_add" data-form-type="sample_transfer" data-modal-id="sample_transfer_add_modal" method="POST" action="<?= base_url()?>samples/create_transfer">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Transfer sample</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_sample_transfer_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>


                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group ">
                              <label for="doctor_transfer_add">Doctor <span class="text-danger">*</span></label>
                              <select required style="width: 100%" class="form-control select-2 form_sample_transfer_add_select" id="doctor_transfer_add" name="doctor">
                                <option selected disabled>Select Doctor</option>
                                <?php foreach ($doctors as $key => $value) { ?>
                                  <option value="<?= $value->doctor_id ?>"><?= $value->full_name.' - '.$value->qualification ?></option>
                              <?php } ?>
                          </select>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group ">
                      <label for="transfer_date">Transfer Date <span class="text-danger">*</span></label>
                      <div class="input-icon input-icon-right">
                        <input required type="text" id="transfer_date" class="form-control form_sample_transfer_add_fields date-field" name="transfer_date" placeholder="Transfer Date"/>
                        <span><i class="flaticon-edit icon-md"></i></span>
                    </div>
                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>sample Name <span class="text-danger">*</span></label>
                    <select required style="width: 100%" class="form-control select-2 form_sample_transfer_add_select" id="sample_transfer_add" name="sample">
                        <option selected disabled>Select sample</option>
                        <?php foreach ($samples as $key => $value) { ?>
                          <option value="<?= $value->sample_id ?>"><?= $value->sample_name ?></option>
                      <?php } ?>
                  </select>
                  <span class="form-text text-muted"></span>
              </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
                <label>Transfer Quantity <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                    <input required type="number" id="transfer_quantity" class="form-control form_sample_transfer_add_fields" name="transfer_quantity" placeholder="Quantity"/>
                    <span><i class="flaticon-edit icon-md"></i></span>
                </div>
                <span class="form-text text-muted" id="transfer_quantity_info_text"></span>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
         <div class="form-group">
            <label>Remarks</label>
            <div class="input-icon input-icon-right">
                <textarea rows="3" id="remarks_transfer_add" type="text" class="form-control form_sample_transfer_add_fields" name="remarks" placeholder="Remarks" ></textarea>
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
<div class="modal fade" id="sample_transfer_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_sample_transfer_edit" data-form-type="sample_transfer" data-modal-id="sample_transfer_edit_modal" method="POST" action="<?= base_url()?>samples/update_transfer">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Updated Transfer sample</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_sample_transfer_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" id="sample_id_edit_transfer" name="sample_id">
                    <input type="hidden" id="transfer_id_edit" name="transfer_id">

                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group ">
                              <label for="doctor_transfer_edit">Doctor <span class="text-danger">*</span></label>
                              <select required style="width: 100%" class="form-control select-2 form_sample_transfer_edit_select" id="doctor_transfer_edit" name="doctor">
                                <option selected disabled>Select Doctor</option>
                                <?php foreach ($doctors as $key => $value) { ?>
                                  <option value="<?= $value->doctor_id ?>"><?= $value->full_name.' - '.$value->qualification ?></option>
                              <?php } ?>
                          </select>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group ">
                      <label for="transfer_date">Transfer Date <span class="text-danger">*</span></label>
                      <div class="input-icon input-icon-right">
                        <input required type="text" id="transfer_date_edit" class="form-control form_sample_transfer_edit_fields date-field" name="transfer_date" placeholder="Transfer Date"/>
                        <span><i class="flaticon-edit icon-md"></i></span>
                    </div>
                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>sample Name <span class="text-danger">*</span></label>
                    <select required style="width: 100%" class="form-control select-2 form_sample_transfer_edit_select" id="sample_transfer_edit" name="sample">
                        <option selected disabled>Select sample</option>
                        <?php foreach ($samples as $key => $value) { ?>
                          <option value="<?= $value->sample_id ?>"><?= $value->sample_name ?></option>
                      <?php } ?>
                  </select>
                  <span class="form-text text-muted"></span>
              </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
                <label>Transfer Quantity <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                    <input required type="number" id="transfer_quantity_edit" class="form-control form_sample_transfer_edit_fields" name="transfer_quantity" placeholder="Quantity"/>
                    <span><i class="flaticon-edit icon-md"></i></span>
                </div>
                <span class="form-text text-muted" id="transfer_quantity_edit_info_text"></span>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
         <div class="form-group">
            <label>Remarks</label>
            <div class="input-icon input-icon-right">
                <textarea rows="3" id="remarks_transfer_edit" type="text" class="form-control form_sample_transfer_edit_fields" name="remarks" placeholder="Remarks" ></textarea>
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



<div class="modal fade" id="sample_transfer_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="sample_transfer" data-modal-id="sample_transfer_delete_modal" action="<?= base_url()?>samples/delete_transfer">

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

                <input type="hidden" id="sample_id_delete_transfer" name="sample_id">
                <input type="hidden" id="transfer_id_delete" name="transfer_id">

            </div>


        </form>
    </div>
</div>
</div>