<style type="text/css">
    .select2-results__option[aria-selected=true] { display: none;}
</style>


<!-- Modal-->
<div class="modal fade" id="tour_plan_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_tour_plan_add" data-form-type="tour_plan" data-modal-id="tour_plan_add_modal" method="POST" action="<?= base_url()?>tour_plan/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Request Tour Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_tour_plan_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>State <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control select-2" id="state_tour_plan_add"  name="state" data-placeholder="Select State">
                                    <option selected disabled>Select State</option>

                                    <?php foreach (config_item('states') as $key => $value) {
                                        if($value->state_name=='Kerala') { $selected = 'selected'; } else { $selected = ''; } ?>
                                        <option <?= $selected ?> value="<?= $value->state_id ?>" ><?= $value->state_name ?></option>
                                    <?php } ?>

                                </select>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>District <span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control select-2 form_tour_plan_add_select" id="district_tour_plan_add"  name="district" data-placeholder="Select District">
                                    <option selected disabled>Select District</option>

                                </select>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Locality <span class="text-danger">*</span></label>
                                <select required style="width: 100%" multiple="true" class="form-control select-2 form_tour_plan_add_select" id="locality_tour_plan_add"  name="locality[]" data-placeholder="Select Localities">
                                    <!-- <option selected disabled>Select Locality</option> -->
                                    
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-<?php if(config_item('tp_end_date_enabled')){ echo "6"; } else { echo "12"; } ?>">
                            <div class="form-group">
                                <label><?php if(config_item('tp_end_date_enabled')){ echo "Start"; } ?> Date <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="start_date_tour_plan_add" class="form-control form-control-pill form_tour_plan_add_fields" name="start_date" placeholder="Start"/>
                                    <span><i class="flaticon2-calendar-9 icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                        <?php if(config_item('tp_end_date_enabled')){ ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date <span class="text-danger">*</span></label>
                                    <div class="input-icon input-icon-right">
                                        <input required type="text" id="end_date_tour_plan_add" class="form-control form_tour_plan_add_fields" name="end_date" placeholder="End"/>
                                        <span><i class="flaticon2-calendar-9 icon-md"></i></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea type="text" id="notes" class="form-control form-control-pill form_tour_plan_add_fields" name="notes" placeholder="Notes"></textarea>
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
<div class="modal fade" id="tour_plan_approve_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style=" max-width: 650px; ">
        <div class="modal-content">
            <form autocomplete="off" id="form_tour_plan_approve" data-form-type="tour_plan" data-modal-id="tour_plan_approve_modal" method="POST" action="<?= base_url()?>tour_plan/approve">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Approve Tour Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_tour_plan_approve_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>


                    <div class="p-5 mb-5" style="border: 5px solid #ebebeb;">
                        <span class="font-weight-bold h5 mb-5" >Tour Plan Summary </span>

                        <div class="row" style=" margin-top: 3%; ">

                            <div class="col-md-<?php if(config_item('tp_end_date_enabled')){ echo "6"; } else { echo "9"; } ?>">
                                <div class="form-group">
                                    <label>Sales Man</label>
                                    <input required disabled type="text" id="sales_man_tour_plan_approve" class="form-control form-control-pill form_tour_plan_approve_fields" name="name" placeholder="Start"/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php if(config_item('tp_end_date_enabled')){ echo "Start"; } ?> Date</label>
                                    <input required disabled type="text" id="start_date_tour_plan_approve" class="form-control form-control-pill form_tour_plan_approve_fields" name="name" placeholder="Start"/>
                                </div>
                            </div>

                            <?php if(config_item('tp_end_date_enabled')){ ?>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>End Date </label>
                                        <input required disabled type="text" id="end_date_tour_plan_approve" class="form-control form_tour_plan_approve_fields" name="location" placeholder="End"/>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <input required disabled type="text" id="state_tour_plan_approve" class="form-control form-control-pill form_tour_plan_approve_fields" name="name" placeholder="Start"/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>District</label>
                                    <input required disabled type="text" id="district_tour_plan_approve" class="form-control form_tour_plan_approve_fields" name="location" placeholder="End"/>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Locality</label>
                                    <input required disabled type="text" id="locality_tour_plan_approve" class="form-control form_tour_plan_approve_fields" name="location" placeholder="End"/>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea disabled required type="text" id="notes_tour_plan_approve" class="form-control form-control-pill form_tour_plan_approve_fields" name="name" placeholder="Notes"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="radio-inline">
                                   <label class="radio radio-warning">
                                    <input type="radio" name="tour_plan_approve_radio" value="0" />
                                    <span></span>
                                    Pending
                                </label>
                                <label class="radio radio-success">
                                    <input type="radio" name="tour_plan_approve_radio" checked="checked" value="1" />
                                    <span></span>
                                    Approve
                                </label>
                                <label class="radio radio-danger">
                                    <input type="radio" name="tour_plan_approve_radio" value="2" />
                                    <span></span>
                                    Reject
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="tour_plan_id" id="tour_plan_id_approve">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Reply Notes</label>
                            <textarea required type="text" id="reply_notes_tour_plan_approve" class="form-control form-control-pill tour_plan_approve_radio" name="reply_note" placeholder="Notes"></textarea>
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
<div class="modal fade" id="tour_plan_info_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style=" max-width: 650px; ">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Tour Plan Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="p-5 mb-5" style="border: 5px solid #ebebeb;">
                    <!-- <span class="font-weight-bold h5 mb-5" >Tour Plan Summary </span> -->

                    <div class="row" style=" margin-top: 3%; ">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php if(config_item('tp_end_date_enabled')){ echo "Start"; } ?> Date</label>
                                <input required disabled type="text" id="start_date_tour_plan_info" class="form-control form-control-pill form_tour_plan_approve_fields" name="name" placeholder="Start"/>
                            </div>
                        </div>

                        <?php if(config_item('tp_end_date_enabled')){ ?>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>End Date </label>
                                    <input required disabled type="text" id="end_date_tour_plan_info" class="form-control form_tour_plan_approve_fields" name="location" placeholder="End"/>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="col-md-4">
                            <div class="form-group" id="tour_plan_info_status_div">
                                <!-- <label class="d-none">Status</label> -->
                                <label class="label label-lg label-success label-inline" style=" margin-top: 2.5em !important; width: 100%; ">Approved</label>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>State</label>
                                <input required disabled type="text" id="state_tour_plan_info" class="form-control form-control-pill form_tour_plan_approve_fields" name="name" placeholder="Start"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>District</label>
                                <input required disabled type="text" id="district_tour_plan_info" class="form-control form_tour_plan_approve_fields" name="location" placeholder="End"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Locality</label>
                                <input required disabled type="text" id="locality_tour_plan_info" class="form-control form_tour_plan_approve_fields" name="location" placeholder="End"/>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea disabled required type="text" id="notes_tour_plan_info" class="form-control form-control-pill form_tour_plan_approve_fields" name="name" placeholder="Notes"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Responded By</label>
                                <input required disabled type="text" id="responded_by_tour_plan_info" class="form-control form_tour_plan_approve_fields" name="location" placeholder="End"/>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Reply Notes</label>
                                <textarea disabled required type="text" id="reply_notes_tour_plan_info" class="form-control form-control-pill form_tour_plan_approve_fields" name="name" placeholder="Notes"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="tour_plan_delete_btn_div" style="display: none;">
                        <div class="col-md-12">

                            <button data-toggle="modal" id="tour_plan_delete_btn" data-target="#tour_plan_delete_modal" class="btn btn-light-danger font-weight-bold mr-2 float-right">
                                <i class="flaticon2 flaticon2-rubbish-bin"></i> Delete tdis Tour Plan
                            </button>

                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="tour_plan_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="tour_plan" data-modal-id="tour_plan_delete_modal" action="<?= base_url()?>tour_plan/delete">

                <div class="alert delete-light-danger" role="alert" style="margin-bottom: 0px">
                  <button type="button" class="close" data-dismiss="modal"></button>
                  <br>
                  <h4 class="alert-heading">Warning! Please Confirm Your Action</h4>
                  <br>
                  <p> Are You Sure to Delete tdis Data ?. All tde Associated Data will Lost. </p>
                  <p>
                      <div class="col">
                        <button type="button" class="btn btn-secondary font-weight-bold mr-1" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger font-weight-bold form_submit">Confirm and Delete</button>
                    </div>
                </p>
                <input type="hidden" id="tour_plan_id_delete" name="tour_plan_id">
            </div>


        </form>
    </div>
</div>
</div>



<!-- Modal-->
<div class="modal fade" id="tour_plan_bulk_approve_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style=" max-width: 860px; ">
        <div class="modal-content">
            <form autocomplete="off" id="form_tour_plan_bulk_approve" data-form-type="tour_plan" data-modal-id="tour_plan_bulk_approve_modal" method="POST" action="<?= base_url()?>tour_plan/approve_bulk">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Tour Plan Bulk Approval</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body" >

                    <div class="form_tour_plan_bulk_approve_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Locality</label>
                                <select style="width: 100%" class="form-control select-2 bulk_approval_filter" id="locality_bulk_approval" data-placeholder="Select Locality">
                                    <option selected value="all">Select All</option>
                                    <?php foreach ($localities as $key => $value) {?>
                                        <option value="<?=$value->locality_id?>"><?=$value->locality_name . ' - ' . $value->district_name . ', ' . $value->state_name?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="expense_head">Sales Man</label>
                                <select style="width: 100%" class="form-control select-2 bulk_approval_filter" id="sales_man_bulk_approval">
                                    <option selected value="all">Select All</option>
                                    <?php foreach ($sales_men as $key => $value) {?>
                                        <option value="<?=$value->sales_man_id?>"><?=$value->sales_man_name . ' - ' . $value->manager_name?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group ">
                                <label for="transfer_date">Start Date</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="start_date_bulk_approval" class="form-control date-field bulk_approval_filter" placeholder="Start Date"/>
                                    <span><i class="flaticon-calendar icon-md"></i></span>
                                </div>
                            </div>
                        </div> 

                        <div class="col-lg-3">
                            <div class="form-group ">
                                <label for="transfer_date">End Date</label>
                                <div class="input-icon input-icon-right">
                                    <input type="text" id="end_date_bulk_approval" class="form-control date-field bulk_approval_filter" placeholder="End Date"/>
                                    <span><i class="flaticon-calendar icon-md"></i></span>
                                </div>
                            </div>
                        </div> 

                    </div>


                    <label>Tour Plans</label>

                    <input type="hidden" name="tour_plan_ids" id="tour_plan_ids">

                    <div class="row" style="width: 100% !important; overflow-y: scroll;max-height: 300px">

                        <table class="col-md-12" style="width: 100% !important">
                            <thead>
                                <tr>
                                    <td>
                                        <div class="form-group mr-2">
                                            <label>&nbsp;</label>
                                            <label class="checkbox checkbox-success">
                                                <input type="checkbox" name="check_all"/>
                                                <span></span>   
                                                &nbsp;                                         
                                            </label>
                                        </div>
                                    </td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>Sales Man</td>
                                    <td>Locality</td>
                                    <td>Notes</td>
                                </tr>
                            </thead>

                            <tbody id="bulk_approval_tbody">

                            </tbody>
                        </table>


                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="radio-inline">
                                 <label class="radio radio-warning">
                                    <input type="radio" name="tour_plan_bulk_approve_radio" value="0" />
                                    <span></span>
                                    Pending
                                </label>
                                <label class="radio radio-success">
                                    <input type="radio" name="tour_plan_bulk_approve_radio" checked="checked" value="1" />
                                    <span></span>
                                    Approve
                                </label>
                                <label class="radio radio-danger">
                                    <input type="radio" name="tour_plan_bulk_approve_radio" value="2" />
                                    <span></span>
                                    Reject
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Reply Notes</label>
                            <textarea type="text" id="notes_bulk_approval" class="form-control form-control-pill form_tour_plan_add_fields" name="notes_bulk_approval" placeholder="Reply Notes"></textarea>
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

