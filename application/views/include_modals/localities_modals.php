<!-- Modal-->
<div class="modal fade" id="locality_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_locality_add" data-form-type="locality" data-modal-id="locality_add_modal" method="POST" action="<?= base_url()?>locations/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Locality</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_locality_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <select required style="width: 100%" class="form-control select-2" id="state_add"  name="state" data-placeholder="Select State">
                                    <option selected disabled>Select State</option>

                                    <?php foreach (config_item('states') as $key => $value) {
                                        if($value->state_name=='Kerala') { $selected = 'selected'; } else { $selected = ''; } ?>
                                        <option <?= $selected ?> value="<?= $value->state_id ?>" ><?= $value->state_name ?></option>
                                    <?php } ?>

                                </select>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>District</label>
                                <select required style="width: 100%" class="form-control form_locality_add_select select-2" id="district_add"  name="district" data-placeholder="Select District">
                                    <option selected disabled>Select District</option>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Locality Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="locality_add" class="form-control form-control-pill form_locality_add_fields" name="locality" placeholder="Locality Name"/>
                                    <span><i class="flaticon2-location icon-md"></i></span>
                                </div>
                                <label for="locality_add" class="error"></label>
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
<div class="modal fade" id="locality_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_locality_edit" data-form-type="locality" data-modal-id="locality_edit_modal" method="POST" action="<?= base_url()?>locations/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update  Locality</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_locality_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" id="locality_id_edit" name="locality_id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <select required style="width: 100%" class="form-control form_locality_edit_select select-2" id="state_edit"  name="state" data-placeholder="Select State">
                                    <option selected disabled>Select State</option>

                                    <?php foreach (config_item('states') as $key => $value) {
                                        if($value->state_name=='Kerala') { $selected = 'selected'; } else { $selected = ''; } ?>
                                        <option <?= $selected ?> value="<?= $value->state_id ?>" ><?= $value->state_name ?></option>
                                    <?php } ?>

                                </select>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>District</label>
                                <select required style="width: 100%" class="form-control form_locality_edit_select select-2" id="district_edit"  name="district" data-placeholder="Select District">
                                    <option selected disabled>Select District</option>
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Locality Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="locality_edit" class="form-control form-control-pill form_locality_edit_fields" name="locality" placeholder="Locality Name"/>
                                    <span><i class="flaticon2-location icon-md"></i></span>
                                </div>
                                <label for="locality_edit" class="error"></label>
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
<div class="modal fade" id="locality_status_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_locality_status" data-form-type="locality" data-modal-id="locality_status_modal" method="POST" action="<?= base_url()?>locations/update_status">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update  Locality Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_locality_status_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" id="locality_id_status" name="locality_id">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>State</label>
                                <div class="input-icon input-icon-right">
                                    <input readonly type="text" id="state_status" class="form-control form-control-pill form_locality_status_fields" />
                                    <span><i class="flaticon2-location icon-md"></i></span>
                                </div>
                                <label for="state_status" class="error"></label>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>District</label>
                                <div class="input-icon input-icon-right">
                                    <input readonly required type="text" id="district_status" class="form-control form-control-pill form_locality_status_fields"/>
                                    <span><i class="flaticon2-location icon-md"></i></span>
                                </div>
                                <label for="district_status" class="error"></label>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Locality Name</label>
                                <div class="input-icon input-icon-right">
                                    <input readonly type="text" id="locality_status" class="form-control form-control-pill form_locality_status_fields"/>
                                    <span><i class="flaticon2-location icon-md"></i></span>
                                </div>
                                <label for="locality_edit" class="error"></label>
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="radio-inline">
                                 <label class="radio radio-warning">
                                    <input type="radio" name="locality_approve_radio" value="0" />
                                    <span></span>
                                    Pending
                                </label>
                                <label class="radio radio-success">
                                    <input type="radio" name="locality_approve_radio" checked="checked" value="1" />
                                    <span></span>
                                    Approve
                                </label>
                                <label class="radio radio-danger">
                                    <input type="radio" name="locality_approve_radio" value="2" />
                                    <span></span>
                                    Reject
                                </label>
                            </div>
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



<div class="modal fade" id="locality_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="locality" data-modal-id="locality_delete_modal" action="<?= base_url()?>locations/delete">

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
                    <input type="hidden" id="locality_id_delete" name="locality_id">
            </div>


        </form>
    </div>
</div>
</div>
