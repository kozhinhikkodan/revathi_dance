<!-- Modal-->
<div class="modal fade" id="work_log_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_work_log_add" data-form-type="work_log" data-modal-id="work_log_add_modal" method="POST" action="<?= base_url()?>work_logs/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form_work_log_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Name</label>
                                <div class="input-icon input-icon-right">
                                    <input rows="3" id="remarks" type="text" class="form-control form_work_log_add_fields" name="remarks" placeholder="" />
                                    <span><i class="flaticon-edit icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Fee</label>
                                <div class="input-icon input-icon-right">
                                    <input rows="3" id="remarks" type="text" class="form-control form_work_log_add_fields" name="remarks" placeholder="" />
                                    <span><i class="flaticon-edit icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold form_submit_demo" data-msg="Course Added Succussfully">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade" id="work_log_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_work_log_edit" data-form-type="work_log" data-modal-id="work_log_edit_modal" method="POST" action="<?= base_url()?>work_logs/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form_work_log_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>
                    <input type="hidden" name="work_log_id" id="work_log_id_edit">
                    <input type="hidden" name="sales_man_id" id="sales_man_id_edit">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Name</label>
                                <div class="input-icon input-icon-right">
                                    <input rows="3" id="remarks" type="text" class="form-control form_work_log_add_fields" name="remarks" value="Classical Dance" />
                                    <span><i class="flaticon-edit icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Course Fee</label>
                                <div class="input-icon input-icon-right">
                                    <input rows="3" id="remarks" type="text" class="form-control form_work_log_add_fields" name="remarks" value="200" />
                                    <span><i class="flaticon-edit icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold form_submit_demo" data-msg="updated successfully">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

