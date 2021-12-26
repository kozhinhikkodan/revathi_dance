<!-- Modal-->
<div class="modal fade" id="doctor_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style=" max-width: 700px; ">
        <div class="modal-content">
            <form autocomplete="off" id="form_doctor_add" data-form-type="doctor" data-modal-id="doctor_add_modal" method="POST" action="<?= base_url()?>doctors/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add new Doctor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_doctor_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Doctor Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="name" class="form-control form-control-pill form_doctor_add_fields" name="name" placeholder="Doctor"/>
                                    <span><i class="flaticon-network icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Full Name</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="full_name" class="form-control form_doctor_add_fields" name="full_name" placeholder="Full Name"/>
                                    <span><i class="flaticon-user icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Qualification <span class="text-danger">*</span></label>

                                <select style="width: 100%" multiple="true" class="form-control form_doctor_add_select select-2" id="qualification"  name="qualification[]" data-placeholder="Select Locality">
                                    <!-- <option selected disabled>Select Qualification</option> -->
                                    <?php foreach (config_item('doctor_qualifications') as $key => $value) { ?>
                                        <option value="<?= $value ?>"><?= $value ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Specialities <span class="text-danger">*</span></label>

                                <select required style="width: 100%" multiple="true" class="form-control form_doctor_add_select select-2" id="specialities_add"  name="specialities[]" placeholder="Select Specialities">
                                    <?php foreach (config_item('doctor_specialities') as $key => $value) { ?>
                                        <option value="<?= $value ?>"><?= $value ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>



                    </div>

                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Hospital</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="hospital" class="form-control form_doctor_add_fields" name="hospital" placeholder="Hospital" />
                                    <span><i class="flaticon2-hospital icon-md"></i></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hospital Location</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="hospital_location" class="form-control form_doctor_add_fields" name="hospital_location" placeholder="Hospital Location" />
                                    <span><i class="flaticon2-location icon-md"></i></span>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Localities <span class="text-danger">*</span></label>
                                <select required style="width: 100%" multiple="true" class="form-control form_doctor_add_select " id="locality_add_doctor"  name="localities[]" data-placeholder="Select Locality">
                                    <!-- <option selected disabled>Select Locality</option> -->
                                    <?php foreach ($localities as $key => $value) { ?>
                                        <option value="<?= $value->locality_id ?>"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></option>
                                    <?php } ?>
                                </select>
                                <span class="form-text text-muted"></span>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="mobile" class="form-control form_doctor_add_fields" name="mobile" placeholder="Mobile" />
                                    <span><i class="la la-mobile-phone icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="phone" class="form-control form_doctor_add_fields" name="phone" placeholder="Phone" />
                                    <span><i class="flaticon2-phone icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>E Mail</label>
                                <div class="input-icon input-icon-right">
                                    <input type="email" id="email" class="form-control form_doctor_add_fields" name="email" placeholder="E Mail"  />
                                    <span><i class="flaticon-email icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="dob" class="form-control date-field form_doctor_add_fields" name="dob" placeholder="Date of Birth" />
                                    <span><i class="flaticon2-calendar-9 icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Wedding Date</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="wedding_date" class="form-control date-field form_doctor_add_fields" name="wedding_date" placeholder="Wedding Date"  />
                                    <span><i class="flaticon2-calendar-9 icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Monthly Visit Frequency <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_doctor_add_select select-2" id="visit_frequency"  name="visit_frequency" data-placeholder="Select Frequency">
                                    <option selected disabled>Select Frequency</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>

                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                            <label>Address</label>
                            <div class="input-icon input-icon-right">
                                <textarea rows="3" id="address" type="text" class="form-control form_doctor_add_fields" name="address" placeholder="Address" ></textarea>
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
<div class="modal fade" id="doctor_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style=" max-width: 700px; ">
        <div class="modal-content">
            <form autocomplete="off" id="form_doctor_edit" data-form-type="doctor" data-modal-id="doctor_edit_modal" method="POST" action="<?= base_url()?>doctors/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Doctor Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_doctor_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" name="doctor_id" id="doctor_id_edit">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="name_edit" class="form-control form-control-pill form_doctor_edit_fields" name="name" placeholder="Name"/>
                                    <span><i class="flaticon-user icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Full Name</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="full_name_edit" class="form-control form_doctor_edit_fields" name="full_name" placeholder="Full Name"/>
                                    <span><i class="flaticon-user icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Qualification <span class="text-danger">*</span></label>

                                <select style="width: 100%" multiple="true" class="form-control form_doctor_add_select select-2" id="qualification_edit" name="qualification[]" data-placeholder="Select Locality">
                                    <!-- <option selected disabled>Select Qualification</option> -->
                                    <?php foreach (config_item('doctor_qualifications') as $key => $value) { ?>
                                        <option value="<?= $value ?>"><?= $value ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Specialities <span class="text-danger">*</span></label>

                                <select required style="width: 100%" multiple="true" class="form-control form_doctor_edit_select select-2" id="specialities_edit"  name="specialities[]" data-placeholder="Select Specialities">
                                    <?php foreach (config_item('doctor_specialities') as $key => $value) { ?>
                                        <option value="<?= $value ?>"><?= $value ?></option>
                                    <?php } ?>
                                </select>


                            </div>
                        </div>



                    </div>

                    <div class="row">

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Hospital</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="hospital_edit" class="form-control form_doctor_edit_fields" name="hospital" placeholder="Hospital" />
                                    <span><i class="flaticon2-hospital icon-md"></i></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hospital Location</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="hospital_location_edit" class="form-control form_doctor_edit_fields" name="hospital_location" placeholder="Hospital Location" />
                                    <span><i class="flaticon2-location icon-md"></i></span>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Localities <span class="text-danger">*</span></label>
                                <select required style="width: 100%" multiple="true" class="form-control form_doctor_edit_select " id="locality_edit_doctor"  name="localities[]" data-placeholder="Select Locality">
                                    <!-- <option selected disabled>Select Locality</option> -->
                                    <?php foreach ($localities as $key => $value) { ?>
                                        <option value="<?= $value->locality_id ?>"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></option>
                                    <?php } ?>
                                </select>
                                <span class="form-text text-muted"></span>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="mobile_edit" class="form-control form_doctor_edit_fields" name="mobile" placeholder="Mobile" />
                                    <span><i class="la la-mobile-phone icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="phone_edit" class="form-control form_doctor_edit_fields" name="phone" placeholder="Phone" />
                                    <span><i class="flaticon2-phone icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>E Mail</label>
                                <div class="input-icon input-icon-right">
                                    <input type="email" id="email_edit" class="form-control form_doctor_edit_fields" name="email" placeholder="E Mail"  />
                                    <span><i class="flaticon-email icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="dob_edit" class="form-control date-field form_doctor_edit_fields" name="dob" placeholder="Date of Birth" />
                                    <span><i class="flaticon2-calendar-9 icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Wedding Date</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="wedding_date_edit" class="form-control date-field form_doctor_edit_fields" name="wedding_date" placeholder="Wedding Date"  />
                                    <span><i class="flaticon2-calendar-9 icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Monthly Visit Frequency <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control form_doctor_edit_select select-2" id="visit_frequency_edit"  name="visit_frequency" data-placeholder="Select Frequency">
                                    <option selected disabled>Select Frequency</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                            <label>Address</label>
                            <div class="input-icon input-icon-right">
                                <textarea rows="3" id="address_edit" type="text" class="form-control form_doctor_edit_fields" name="address" placeholder="Address" ></textarea>
                                <span><i class="flaticon2-location icon-md"></i></span>
                            </div>
                            <span class="form-text text-muted"></span>
                        </div>
                    </div>
                </div>


                <?php if($this->session->userdata('user_role')!='sales_man') { ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="radio-inline">
                                 <label class="radio radio-warning">
                                    <input type="radio" name="doctor_approve_radio" value="0" />
                                    <span></span>
                                    Pending
                                </label>
                                <label class="radio radio-success">
                                    <input type="radio" name="doctor_approve_radio" checked="checked" value="1" />
                                    <span></span>
                                    Approve
                                </label>
                                <label class="radio radio-danger">
                                    <input type="radio" name="doctor_approve_radio" value="2" />
                                    <span></span>
                                    Reject
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-pill btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-pill btn-primary font-weight-bold form_submit">Submit</button>
        </div>
    </form>
</div>
</div>
</div>



<div class="modal fade" id="doctor_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="doctor" data-modal-id="doctor_delete_modal" action="<?= base_url()?>doctors/delete">

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
                <input type="hidden" id="doctor_id_delete" name="doctor_id">
            </div>


        </form>
    </div>
</div>
</div>
