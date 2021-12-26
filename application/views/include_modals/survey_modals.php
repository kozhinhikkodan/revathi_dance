<!-- Modal-->
<div class="modal fade" id="survey_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style=" max-width: 820px; ">
        <div class="modal-content">
            <form autocomplete="off" id="form_survey_add" data-form-type="survey" data-modal-id="survey_add_modal" method="POST" action="<?= base_url()?>work_logs/create_survey">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Competetor Survey</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_survey_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">



                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Locality <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control select-2 form_survey_add_select" id="locality_survey_add"  name="locality" data-placeholder="Select Locality">
                                    <option selected disabled>Select Locality</option>
                                    <?php foreach ($localities_2 as $key => $value) { ?>
                                        <option value="<?= $value->locality_id ?>"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Doctor </label>
                                <select style="width: 100%" class="form-control select-2 form_survey_add_select" id="doctor_survey_add"  name="doctor" data-placeholder="Select Doctor">
                                    <option selected disabled>Select Doctor</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date and Time</label>
                                <div class="input-icon input-icon-right">
                                    <input disabled required type="text" id="date_survey_add" class="form-control form-control-pill form_survey_add_select" name="date" placeholder="date" value="<?= date('d-m-Y h:i A') ?>" />
                                    <span><i class="flaticon-calendar-with-a-clock-time-tools icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Chemist 1</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="chemist_1_add" class="form-control form-control-pill form_survey_add_select" name="chemist_1" placeholder="Chemist 1" />
                                    <span><i class="flaticon-edit"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Chemist 2</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="chemist_2_add" class="form-control form-control-pill form_survey_add_select" name="chemist_2" placeholder="Chemist 2" />
                                    <span><i class="flaticon-edit"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <table id="survey_items_table" width="100%">
                        <thead>
                            <tr>
                                <td width="8%">SL</td>
                                <td>Company</td>
                                <td>Product</td>
                                <td>Notes</td>
                            </tr>
                        </thead>    
                        <tbody>
                            <tr id="row_1">
                                <td>
                                    <div class="form-group">
                                        <input disabled type="text" class="form-control form-control-pill form_survey_add_fields sl_no_fields" placeholder="Company" value="1" />
                                    </div> 
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="company_1" class="form-control form-control-pill form_survey_add_fields" name="survey_item[company][]" placeholder="Company" value="" />
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="product_1" class="form-control form-control-pill form_survey_add_fields" name="survey_item[product][]" placeholder="Company" value="" />
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="notes_1" class="form-control form-control-pill form_survey_add_fields" name="survey_item[notes][]" placeholder="Company" value="" />
                                    </div>
                                </td>
                                <td>
                                   <div class="form-group" style=" margin-top: -2em; ">
                                    <button disabled type="button" data-sl="1" class="btn btn-icon btn-sm btn-pill btn-danger float-right survey_item_delete_btn" ><i class="flaticon flaticon-close" ></i></button>
                                </div>
                            </td>
                        </tr>

                        <input type="hidden" id="current_row_count" value="1">
                    </tbody>

                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                               <div class="form-group">
                                <button type="button" class="btn btn-icon btn-sm btn-pill btn-dark float-right"><i class="flaticon flaticon-plus" id="survey_item_add_btn"></i></button>
                            </div>
                        </td>

                    </tr>
                </tfoot>
            </table>


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
<div class="modal fade" id="survey_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style=" max-width: 820px; ">
        <div class="modal-content">
            <form autocomplete="off" id="form_survey_edit" data-form-type="survey" data-modal-id="survey_edit_modal" method="POST" action="<?= base_url()?>work_logs/update_survey">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Competetor Survey</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_survey_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">


                        <input type="hidden" name="survey_id" id="survey_id_edit">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Locality <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control select-2 form_survey_edit_select" id="locality_survey_edit"  name="locality" data-placeholder="Select Locality">
                                    <option selected disabled>Select Locality</option>
                                    <?php foreach ($localities_2 as $key => $value) { ?>
                                        <option value="<?= $value->locality_id ?>"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Doctor </label>
                                <select style="width: 100%" class="form-control select-2 form_survey_edit_select" id="doctor_survey_edit"  name="doctor" data-placeholder="Select Doctor">
                                    <option selected disabled>Select Doctor</option>
                                    <?php foreach ($doctors as $key => $value) { ?>
                                      <option value="<?= $value->doctor_id ?>"><?= $value->full_name.' - '.$value->qualification ?></option>
                                  <?php } ?>
                              </select>
                          </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Date and Time</label>
                            <div class="input-icon input-icon-right">
                                <input disabled required type="text" id="date_survey_edit" class="form-control form-control-pill form_survey_edit_select" name="date" placeholder="date" value="<?= date('d-m-Y h:i A') ?>" />
                                <span><i class="flaticon-calendar-with-a-clock-time-tools icon-md"></i></span>
                            </div>
                            <span class="form-text text-muted"></span>
                        </div>
                    </div>

                </div>

                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Chemist 1</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="chemist_1_edit" class="form-control form-control-pill form_survey_edit_select" name="chemist_1" placeholder="Chemist 1" />
                                    <span><i class="flaticon-edit"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Chemist 2</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="chemist_2_edit" class="form-control form-control-pill form_survey_edit_select" name="chemist_2" placeholder="Chemist 2" />
                                    <span><i class="flaticon-edit"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>


                <table id="survey_items_table_edit" width="100%">
                    <thead>
                        <tr>
                            <td width="8%">SL</td>
                            <td>Company</td>
                            <td>Product</td>
                            <td>Notes</td>
                        </tr>
                    </thead>    
                    <tbody id="survey_items_table_edit_body">
                      

                    </tbody>

                    <input type="hidden" id="edit_current_row_count" value="1">

                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                               <div class="form-group">
                                <button type="button" class="btn btn-icon btn-sm btn-pill btn-dark float-right"><i class="flaticon flaticon-plus" id="edit_survey_item_add_btn"></i></button>
                            </div>
                        </td>

                    </tr>
                </tfoot>
            </table>


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
<div class="modal fade" id="survey_info_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style=" max-width: 820px; ">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Add New Competetor Survey</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sales Man</label>
                            <div class="input-icon input-icon-right">
                                <input disabled required type="text" id="sales_man_survey_info" class="form-control form-control-pill form_survey_add_select" placeholder="date"/>
                                <span><i class="flaticon-user icon-md"></i></span>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Locality</label>
                            <div class="input-icon input-icon-right">
                                <input disabled required type="text" id="locality_survey_info" class="form-control form-control-pill form_survey_add_select" placeholder="date"/>
                                <span><i class="flaticon2-location icon-md"></i></span>
                            </div>

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Doctor </label>
                            <div class="input-icon input-icon-right">
                                <input disabled required type="text" id="doctor_survey_info" class="form-control form-control-pill " placeholder="date" />
                                <span><i class="flaticon-user icon-md"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date and Time</label>
                            <div class="input-icon input-icon-right">
                                <input disabled required type="text" id="date_survey_info" class="form-control form-control-pill " name="date" placeholder="date"/>
                                <span><i class="flaticon-calendar-with-a-clock-time-tools icon-md"></i></span>
                            </div>
                            <span class="form-text text-muted"></span>
                        </div>
                    </div>

                </div>


                <table id="survey_items_info_table">
                    <thead>
                        <tr>
                            <td width="8%">SL</td>
                            <td>Company</td>
                            <td>Product</td>
                            <td>Notes</td>
                        </tr>
                    </thead>    
                    <tbody>


                    </tbody>

                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-pill btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-pill btn-primary font-weight-bold form_submit">Submit</button> -->
            </div>
        </form>
    </div>
</div>
</div>



<div class="modal fade" id="survey_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="survey" data-modal-id="survey_delete_modal" action="<?= base_url()?>work_logs/delete_survey">

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

                <input type="hidden" id="survey_id_delete" name="survey_id">

            </div>
        </form>
    </div>
</div>
</div>
