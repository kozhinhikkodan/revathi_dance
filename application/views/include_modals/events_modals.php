<!-- Modal-->
<div class="modal fade" id="event_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_event_add" data-form-type="events" data-modal-id="event_add_modal" method="POST" action="<?=base_url()?>events/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_event_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

              <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Event Title <span class="text-danger">*</span></label>
                        <div class="input-icon input-icon-right">
                            <input required type="text" id="event_title" class="form-control form-control-pill form_event_add_fields" name="event_title" placeholder="Event Name"/>
                            <span><i class="flaticon-edit icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Event Date <span class="text-danger">*</span></label>
                        <div class="input-icon input-icon-right">
                            <input required type="text" id="event_date" class="form-control form_event_add_fields date-field" name="event_date" placeholder="Date" value="<?=date('d-m-Y')?>"/>
                            <span><i class="flaticon-calendar icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                 <div class="form-group">
                    <label>Event Description</label>
                    <div class="input-icon input-icon-right">
                        <textarea rows="3" id="event_description" type="text" class="form-control form_event_add_fields" name="event_description" placeholder="Event Description" ></textarea>
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
<div class="modal fade" id="event_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_event_edit" data-form-type="events" data-modal-id="event_edit_modal" method="POST" action="<?=base_url()?>events/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Edit Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_event_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                <input type="hidden" id="event_id_edit" name="event_id">

              <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Event Title <span class="text-danger">*</span></label>
                        <div class="input-icon input-icon-right">
                            <input required type="text" id="event_title_edit" class="form-control form-control-pill form_event_edit_fields" name="event_title" placeholder="Event Name"/>
                            <span><i class="flaticon-edit icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Event Date <span class="text-danger">*</span></label>
                        <div class="input-icon input-icon-right">
                            <input required type="text" id="event_date_edit" class="form-control form_event_edit_fields date-field" name="event_date" placeholder="Date" />
                            <span><i class="flaticon-calendar icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                 <div class="form-group">
                    <label>Event Description</label>
                    <div class="input-icon input-icon-right">
                        <textarea rows="3" id="event_description_edit" type="text" class="form-control form_event_edit_fields" name="event_description" placeholder="Event Description" ></textarea>
                        <span><i class="flaticon2-list-3 icon-md"></i></span>
                    </div>
                    <span class="form-text text-muted"></span>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-pill btn-light-danger font-weight-bold" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-pill btn-primary font-weight-bold form_submit">Update</button>
    </div>
</form>
</div>
</div>
</div>

























<div class="modal fade" id="event_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="events" data-modal-id="event_delete_modal" action="<?=base_url()?>events/delete">

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
                <input type="hidden" id="event_id_delete" name="event_id">
            </div>


        </form>
    </div>
</div>
</div>





