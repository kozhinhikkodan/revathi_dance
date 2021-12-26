<!-- Modal-->
<div class="modal fade" id="fee_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_fee_add" data-form-type="fee" data-modal-id="fee_add_modal" method="POST" action="<?= base_url()?>fees/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Fee Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form_fee_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Paid Amount</label>
                                <div class="input-icon input-icon-right">
                                    <input rows="3" id="remarks" type="text" class="form-control form_fee_add_fields" name="remarks" placeholder="" />
                                    <span><i class="flaticon-edit icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Paid Date</label>
                                <div class="input-icon input-icon-right">
                                    <input rows="3" id="remarks" type="text" class="form-control form_fee_add_fields date-field" name="remarks" placeholder="" value="<?= date('d-m-Y') ?>" />
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
                                    <textarea rows="3" id="remarks" type="text" class="form-control form_fee_add_fields" name="remarks" placeholder="" ></textarea>
                                    <span><i class="flaticon-edit icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary font-weight-bold form_submit_demo" data-msg="Payment Added Succussfully">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade" id="fee_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_fee_edit" data-form-type="fee" data-modal-id="fee_edit_modal" method="POST" action="<?= base_url()?>fees/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update feecd cd</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form_fee_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>
                    <input type="hidden" name="fee_id" id="fee_id_edit">
                    <input type="hidden" name="sales_man_id" id="sales_man_id_edit">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Paid Amount</label>
                                <div class="input-icon input-icon-right">
                                    <input rows="3" id="remarks" type="text" class="form-control form_fee_add_fields" name="remarks" placeholder="" value="130"/>
                                    <span><i class="flaticon-edit icon-md"></i></span>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Paid Date</label>
                                <div class="input-icon input-icon-right">
                                    <input rows="3" id="remarks" type="text" class="form-control form_fee_add_fields date-field" name="remarks" placeholder="" value="<?= date('d-m-Y') ?>" />
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
                                    <textarea rows="3" id="remarks" type="text" class="form-control form_fee_add_fields" name="remarks" placeholder="" >via phonepe</textarea>
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

