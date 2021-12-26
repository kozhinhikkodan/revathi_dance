 <!-- Modal-->
<div class="modal fade" id="qualification_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_qualification_add" data-form-type="qualification" data-modal-id="qualification_add_modal" method="POST" action="<?= base_url()?>doctors/create_qualification">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Qualification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_qualification_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label >Qualification<span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="qualification_add" class="form-control form-control-pill form_qualification_add_fields" name="qualification" placeholder="qualification Name"/>
                                    <span><i class="flaticon-edit icon-md"></i></span>
                                </div>
                                <label for="qualification_add" class="error"></label>
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
<div class="modal fade" id="qualification_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_qualification_edit" data-form-type="qualification" data-modal-id="qualification_edit_modal" method="POST" action="<?= base_url()?>doctors/update_qualification">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update  Qualification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_qualification_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <input type="hidden" id="qualification_id_edit" name="qualification_id">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Qualification<span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="qualification_edit" class="form-control form-control-pill form_qualification_edit_fields" name="qualification" placeholder="qualification Name"/>
                                    <span><i class="flaticon-edit icon-md"></i></span>
                                </div>
                                <label for="qualification_edit" class="error"></label>
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


<div class="modal fade" id="qualification_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="qualification" data-modal-id="qualification_delete_modal" action="<?= base_url()?>doctors/delete_qualification">

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
                    <input type="hidden" id="qualification_id_delete" name="qualification_id">
            </div>


        </form>
    </div>
</div>
</div>
