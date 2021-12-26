<!-- Modal-->
<div class="modal fade" id="product_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_product_add" data-form-type="product" data-modal-id="product_add_modal" method="POST" action="<?= base_url()?>products/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Product</h5>
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
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Product Name <span class="text-danger">*</span></label>
                                <input required type="text" id="name" class="form-control form-control-pill form_product_add_fields" name="name" placeholder="Product Name"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Category<span class="text-danger">*</span></label>
                                <select required style="width: 100%" class="form-control select-2 form_product_add_select" id="category_add"  name="category" data-placeholder="Select Category">
                                    <option selected disabled>Select Category</option>
                                    <?php foreach ($product_categories as $key => $value) { ?>
                                        <option><?= $value->category_name ?></option>
                                    <?php } ?>
                                </select>
                                <label for="category_add" class="error"></label>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product Image <span class="text-danger">*</span></label>
                                <div></div>
                                <div class="custom-file">
                                    <input required type="file" accept="image/*" class="custom-file-input form_product_add_fields" id="customFile" name="product_image" />
                                    <label class="custom-file-label" for="customFile">Choose file</label>
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

<!-- Modal-->
<div class="modal fade" id="product_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="form_product_edit" data-form-type="product" data-modal-id="product_edit_modal" method="POST" action="<?= base_url()?>products/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Product details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                  </button>
              </div>
              <div class="modal-body">

                <div class="form_product_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                </div>

                <input type="hidden" name="product_id" id="product_id_edit">

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input required type="text" id="name_edit" class="form-control form-control-pill form_product_edit_fields" name="name" placeholder="Product Name" />
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Category<span class="text-danger">*</span></label>
                            <select required style="width: 100%" class="form-control select-2 form_product_edit_select" id="category_edit" name="category" data-placeholder="Select Category">
                              <option selected disabled>Select Category</option>
                              <?php foreach ($product_categories as $key => $value) { ?>
                                  <option><?= $value->category_name ?></option>
                              <?php } ?>
                          </select>
                          <label for="category_edit" class="error"></label>
                      </div>
                  </div>

              </div>

              <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Product Image</label>
                        <div></div>
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input form_product_edit_fields" id="customFile_edit" name="product_image" />
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>

            </div>


            <?php if($this->session->userdata('user_role')!='sales_man') { ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="radio-inline">
                               <label class="radio radio-warning">
                                <input type="radio" name="product_status_radio" value="0" />
                                <span></span>
                                Pending
                            </label>
                            <label class="radio radio-success">
                                <input type="radio" name="product_status_radio" checked="checked" value="1" />
                                <span></span>
                                Approve
                            </label>
                            <label class="radio radio-danger">
                                <input type="radio" name="product_approve_radio" value="2" />
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

<div class="modal fade" id="product_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="product" data-modal-id="product_delete_modal" action="<?= base_url()?>products/delete">

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

                <input type="hidden" id="product_id_delete" name="product_id">
                <input type="hidden" id="product_file_name_delete" name="product_file_name">

            </div>
        </form>
    </div>
</div>
</div>
