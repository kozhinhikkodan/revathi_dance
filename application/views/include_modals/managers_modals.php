<!-- Modal-->
<div class="modal fade" id="manager_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_manager_add" data-form-type="manager" data-modal-id="manager_add_modal" method="POST" action="<?= base_url()?>managers/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Manager</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_manager_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Manager Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="name" class="form-control form-control-pill form_manager_add_fields" name="name" placeholder="Manager Name"/>
                                    <span><i class="flaticon-user icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="location" class="form-control form_manager_add_fields" name="location" placeholder="Location"/>
                                    <span><i class="flaticon-map-location icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>E Mail <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="email" id="email" class="form-control form_manager_add_fields" name="email" placeholder="Email" />
                                    <span><i class="flaticon-email icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact No <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="number" id="contact" class="form-control form_manager_add_fields" name="contact" placeholder="Contact No" maxlength="10" minlength="10" />
                                    <span><i class="flaticon2-phone icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Field Localities <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_manager_add_select select-2" multiple="true" id="localities"  name="localities[]" data-placeholder="Select Locality">
                                  <?php foreach ($localities as $key => $value) { ?>
                                      <option value="<?= $value->locality_id ?>"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></option>
                                  <?php } ?>
                              </select>
                              <span class="form-text text-muted"></span>
                          </div>

                      </div>
                  </div>

                  <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label>Travel Allowance <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="number" id="ta" class="form-control form_manager_add_fields" name="ta" placeholder="TA"/>
                                    <span><i class="la la-rupee icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Daily Allowance <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="number" id="da" class="form-control form_manager_add_fields" name="da" placeholder="DA"/>
                                    <span><i class="la la-rupee icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Address</label>
                            <div class="input-icon input-icon-right">
                                <textarea rows="3" id="address" type="text" class="form-control form_manager_add_fields" name="address" placeholder="Address" ></textarea>
                                <span><i class="flaticon2-location icon-md"></i></span>
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
<div class="modal fade" id="manager_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_manager_edit" data-form-type="manager" data-modal-id="manager_edit_modal" method="POST" action="<?= base_url()?>managers/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Manager Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_manager_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" name="manager_id" id="manager_id_edit">
                    <input type="hidden" name="user_id" id="user_id_edit">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Manager Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="name_edit" class="form-control form-control-pill form_manager_edit_fields" name="name" placeholder="Manager Name"/>
                                    <span><i class="flaticon-user icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="location_edit" class="form-control form_manager_edit_fields" name="location" placeholder="Location"/>
                                    <span><i class="flaticon-map-location icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>E Mail <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="email" id="email_edit" class="form-control form_manager_edit_fields" name="email" placeholder="Email" />
                                    <span><i class="flaticon-email icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact No <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="number" id="contact_edit" class="form-control form_manager_edit_fields" name="contact" placeholder="Contact No" maxlength="10" minlength="10" />
                                    <span><i class="flaticon2-phone icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Field Localities <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_manager_edit_select select-2" multiple="true" id="localities_edit"  name="localities[]" data-placeholder="Select Locality">
                                  <?php foreach ($localities as $key => $value) { ?>
                                      <option value="<?= $value->locality_id ?>"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></option>
                                  <?php } ?>
                              </select>
                              <span class="form-text text-muted"></span>
                          </div>

                      </div>
                  </div>


                  <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label>Travel Allowance <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="number" id="ta_edit" class="form-control form_manager_edit_fields" name="ta" placeholder="TA"/>
                                    <span><i class="la la-rupee icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Daily Allowance <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="number" id="da_edit" class="form-control form_manager_edit_fields" name="da" placeholder="DA"/>
                                    <span><i class="la la-rupee icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Address</label>
                            <div class="input-icon input-icon-right">
                                <textarea rows="3" id="address_edit" type="text" class="form-control form_manager_edit_fields" name="address" placeholder="Address" ></textarea>
                                <span><i class="flaticon2-location icon-md"></i></span>
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

<div class="modal fade" id="manager_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="manager" data-modal-id="manager_delete_modal" action="<?= base_url()?>managers/delete">

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

                <input type="hidden" id="manager_id_delete" name="manager_id">
                <input type="hidden" id="user_id_delete" name="user_id">

            </div>


        </form>
    </div>
</div>
</div>
