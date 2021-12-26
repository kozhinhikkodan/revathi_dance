<!-- Modal-->
<div class="modal fade" id="leave_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_leaves_add" data-form-type="leave" data-modal-id="leave_add_modal" method="POST" action="<?= base_url()?>leaves/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Leave Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_product_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Leave Dates <span class="text-danger">*</span></label>
                                <input required type="text" id="leave_dates" class="form-control form-control-pill form_leaves_add_fields" name="leave_dates" placeholder="Leave Dates"/>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks <span class="text-danger">*</span></label>
                                <textarea required type="text" id="remarks" class="form-control form-control-pill form_leaves_add_fields" name="remarks" placeholder="Remarks"></textarea>
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
<div class="modal fade" id="leave_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_leave_edit" data-form-type="leave" data-modal-id="leave_edit_modal" method="POST" action="<?= base_url()?>leaves/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Leave Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_leave_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" name="leave_id" id="leave_id_edit">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Leave Dates <span class="text-danger">*</span></label>
                                <input required type="text" id="leave_dates_edit" class="form-control form-control-pill form_leave_edit_fields" name="leave_dates" placeholder="Leave Dates"/>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks <span class="text-danger">*</span></label>
                                <textarea required type="text" id="remarks_edit" class="form-control form-control-pill form_leave_edit_fields" name="remarks" placeholder="Remarks"></textarea>
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





<div class="modal fade" id="leave_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="leave" data-modal-id="leave_delete_modal" action="<?= base_url()?>leaves/delete">

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

                <input type="hidden" id="leave_id_delete" name="leave_id">

            </div>
        </form>
    </div>
</div>
</div>


<!-- Modal-->
<div class="modal fade" id="leave_status_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_leave_status" data-form-type="leave" data-modal-id="leave_status_modal" method="POST" action="<?= base_url()?>leaves/approve">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Approve Leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_leave_status_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" id="leave_id_status" name="leave_id">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="radio-inline">
                                   <label class="radio radio-warning">
                                    <input type="radio" name="leave_approve_radio" value="0" />
                                    <span></span>
                                    Pending
                                </label>
                                <label class="radio radio-success">
                                    <input type="radio" name="leave_approve_radio" checked="checked" value="1" />
                                    <span></span>
                                    Approve
                                </label>
                                <label class="radio radio-danger">
                                    <input type="radio" name="leave_approve_radio" value="2" />
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
                            <label>Remarks <span class="text-danger">*</span></label>
                            <textarea required type="text" id="reply_remarks" class="form-control form-control-pill form_leaves_add_fields" name="remarks" placeholder="Remarks"></textarea>
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



<script type="text/javascript">
    $('#leave_dates,#leave_dates_edit').datepicker({
    startDate: new Date(),
    multidate: true,
    format: 'dd-mm-yyyy'
});
</script>