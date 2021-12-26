<!-- Modal-->
<div class="modal fade" id="gift_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_gift_add" data-form-type="gifts" data-modal-id="gift_add_modal" method="POST" action="<?= base_url()?>gifts/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Gift</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_gift_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>


                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Gift Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="gift_name" class="form-control form-control-pill form_gift_add_fields" name="gift_name" placeholder="Gift Name"/>
                                    <span><i class="flaticon-gift icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gift Quantity <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="number" id="quantity" class="form-control form_gift_add_fields" name="quantity" placeholder="Quantity"/>
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
                                <textarea rows="3" id="remarks" type="text" class="form-control form_gift_add_fields" name="remarks" placeholder="Remarks" ></textarea>
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
<div class="modal fade" id="gift_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_gift_edit" data-form-type="gifts" data-modal-id="gift_edit_modal" method="POST" action="<?= base_url()?>gifts/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Gift</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_gift_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" id="gift_id_edit" name="gift_id">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Gift Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="gift_name_edit" class="form-control form-control-pill form_gift_edit_fields" name="gift_name" placeholder="Gift Name"/>
                                    <span><i class="flaticon-edit icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gift Quantity <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="number" id="quantity_edit" class="form-control form_gift_edit_fields" name="quantity" placeholder="Quantity"/>
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
                                <textarea rows="3" id="remarks_edit" type="text" class="form-control form_gift_edit_fields" name="remarks" placeholder="Remarks" ></textarea>
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


<div class="modal fade" id="gift_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="gifts" data-modal-id="gift_delete_modal" action="<?= base_url()?>gifts/delete">

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
                <input type="hidden" id="gift_id_delete" name="gift_id">
            </div>


        </form>
    </div>
</div>
</div>






<!-- Modal-->
<div class="modal fade" id="gift_transfer_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_gift_transfer_add" data-form-type="gift_transfer" data-modal-id="gift_transfer_add_modal" method="POST" action="<?= base_url()?>gifts/create_transfer">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Transfer Gift</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_gift_transfer_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>


                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group ">
                              <label for="doctor_transfer_add">Doctor <span class="text-danger">*</span></label>
                              <select required style="width: 100%" class="form-control select-2 form_gift_transfer_add_select" id="doctor_transfer_add" name="doctor">
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
                        <input required type="text" id="transfer_date" class="form-control form_gift_transfer_add_fields date-field" name="transfer_date" placeholder="Transfer Date"/>
                        <span><i class="flaticon-edit icon-md"></i></span>
                    </div>
                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Gift Name <span class="text-danger">*</span></label>
                    <select required style="width: 100%" class="form-control select-2 form_gift_transfer_add_select" id="gift_transfer_add" name="gift">
                        <option selected disabled>Select Gift</option>
                        <?php foreach ($gifts as $key => $value) { ?>
                          <option value="<?= $value->gift_id ?>"><?= $value->gift_name ?></option>
                      <?php } ?>
                  </select>
                  <span class="form-text text-muted"></span>
              </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
                <label>Transfer Quantity <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                    <input required type="number" id="transfer_quantity" class="form-control form_gift_transfer_add_fields" name="transfer_quantity" placeholder="Quantity"/>
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
                <textarea rows="3" id="remarks_transfer_add" type="text" class="form-control form_gift_transfer_add_fields" name="remarks" placeholder="Remarks" ></textarea>
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
<div class="modal fade" id="gift_transfer_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_gift_transfer_edit" data-form-type="gift_transfer" data-modal-id="gift_transfer_edit_modal" method="POST" action="<?= base_url()?>gifts/update_transfer">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Updated Transfer Gift</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_gift_transfer_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" id="gift_id_edit_transfer" name="gift_id">
                    <input type="hidden" id="transfer_id_edit" name="transfer_id">

                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="form-group ">
                              <label for="doctor_transfer_edit">Doctor <span class="text-danger">*</span></label>
                              <select required style="width: 100%" class="form-control select-2 form_gift_transfer_edit_select" id="doctor_transfer_edit" name="doctor">
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
                        <input required type="text" id="transfer_date_edit" class="form-control form_gift_transfer_edit_fields date-field" name="transfer_date" placeholder="Transfer Date"/>
                        <span><i class="flaticon-edit icon-md"></i></span>
                    </div>
                </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Gift Name <span class="text-danger">*</span></label>
                    <select required style="width: 100%" class="form-control select-2 form_gift_transfer_edit_select" id="gift_transfer_edit" name="gift">
                        <option selected disabled>Select Gift</option>
                        <?php foreach ($gifts as $key => $value) { ?>
                          <option value="<?= $value->gift_id ?>"><?= $value->gift_name ?></option>
                      <?php } ?>
                  </select>
                  <span class="form-text text-muted"></span>
              </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
                <label>Transfer Quantity <span class="text-danger">*</span></label>
                <div class="input-icon input-icon-right">
                    <input required type="number" id="transfer_quantity_edit" class="form-control form_gift_transfer_edit_fields" name="transfer_quantity" placeholder="Quantity"/>
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
                <textarea rows="3" id="remarks_transfer_edit" type="text" class="form-control form_gift_transfer_edit_fields" name="remarks" placeholder="Remarks" ></textarea>
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



<div class="modal fade" id="gift_transfer_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="gift_transfer" data-modal-id="gift_transfer_delete_modal" action="<?= base_url()?>gifts/delete_transfer">

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

                <input type="hidden" id="gift_id_delete_transfer" name="gift_id">
                <input type="hidden" id="transfer_id_delete" name="transfer_id">

            </div>


        </form>
    </div>
</div>
</div>