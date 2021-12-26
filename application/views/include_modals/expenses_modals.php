


<!-- Modal-->
<div class="modal fade" id="expense_add_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style=" max-width: 950px; ">
        <div class="modal-content">
            <form autocomplete="off" id="form_expense_add" data-form-type="expense" data-modal-id="expense_add_modal" method="POST" action="<?= base_url()?>expenses/create">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Add New Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_expense_add_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Expense Type</label>
                                <div class="radio-inline">
                                    <label class="radio radio-info">
                                        <input class="form_expense_add_radio" required type="radio" name="expense_type" checked value="ta" />
                                        <span></span>
                                        TA
                                    </label>
                                    <label class="radio radio-primary">
                                        <input class="form_expense_add_radio" required type="radio" name="expense_type" value="other" />
                                        <span></span>
                                        Other
                                    </label>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-8" id="other_expense_amount_div" style="display: none;">
                            <div class="form-group">
                                <label>Expense Amount <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="other_expense_amount" class="form-control form-control-pill form_expense_add_fields" name="other_expense_amount" placeholder="Amount"/>
                                    <span><i class="la la-rupee icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <table id="ta_items_table" class="ta_row">
                        <thead>
                            <tr>
                                <td width="8%">SL</td>
                                <td>Starting Point</td>
                                <td>Ending Point</td>
                                <td>Distance in KM</td>
                                <td>Expense Amount</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>    
                        <tbody>
                            <tr id="row_1">

                               <td>
                                <div class="form-group mx-1">
                                    <input disabled type="text" id="name" class="form-control form-control-pill form_hospital_add_fields sl_no_fields" name="name" placeholder="SL" value="1" />
                                </div>
                            </td>

                            <td>
                                <div class="form-group mx-1">
                                    <div class="input-icon input-icon-right">
                                        <input type="text" id="starting_point_1" class="form-control form-control-pill form_expense_add_fields ta_fields places_fields" name="ta_items[starting_point][]" placeholder="Starting Point"/>
                                        <span><i class="flaticon2-location icon-md"></i></span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="form-group mx-1">
                                    <div class="input-icon input-icon-right">
                                        <input required type="text" id="ending_point_1" class="form-control form-control-pill form_expense_add_fields ta_fields end_points places_fields" data-sl="1" name="ta_items[ending_point][]" placeholder="Ending Point"  />
                                        <span><i class="flaticon2-location  icon-md"></i></span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="form-group mx-1">
                                    <div class="input-icon input-icon-right">
                                        <input readonly type="text" data-sl="1" id="distance_1" class="form-control form-control-pill form_expense_add_fields ta_fields distance_fields" name="ta_items[distance][]" placeholder="KM"/>
                                        <span><i class="flaticon2-location icon-md"></i></span>
                                    </div>
                                </div>
                            </td>


                            <td>
                                <div class="form-group mx-1">
                                    <div class="input-icon input-icon-right">
                                        <input readonly type="text" id="amount_1" class="form-control form-control-pill form_expense_add_fields ta_fields expense_amount_fields" data-sl="1" name="ta_items[amount][]" placeholder="Amount"/>
                                        <span><i class="la la-rupee icon-md"></i></span>
                                    </div>
                                </div>
                            </td>

                            <td>
                             <div class="form-group mx-1" style=" margin-top: -2em; ">
                                <button type="button" data-sl="1" class="btn btn-icon btn-sm btn-pill btn-danger float-right ta_item_delete_btn" ><i class="flaticon flaticon-close" ></i></button>
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
                        <td>
                          <!--   <div class="form-group mx-1">
                                <label>Expense Amount</label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="total_expense_amount_no_return" class="form-control form-control-pill form_hospital_add_fields" name="total_expense_amount_no_return" placeholder="Total Amount"/>
                                    <span><i class="la la-rupee icon-md"></i></span>
                                </div>
                            </div> -->
                        </td>
                        <td>
                            <div class="form-group mx-1">
                                <label>Total Expense Amount</label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="total_expense_amount" class="form-control form-control-pill form_hospital_add_fields" name="total_expense_amount" placeholder="Total Amount"/>
                                    <span><i class="la la-rupee icon-md"></i></span>
                                </div>
                            </div>
                        </td>
                        <td>
                           <div class="form-group">
                            <button type="button" class="btn btn-icon btn-sm btn-pill btn-dark float-right"><i class="flaticon flaticon-plus" id="ta_item_add_btn"></i></button>
                        </div>
                    </td>

                </tr>
            </tfoot>
        </table>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Remarks</label>
                    <div class="input-icon input-icon-right">
                        <textarea rows="2" type="text" id="remarks" class="form-control form-control-pill form_hospital_add_fields " name="remarks" placeholder="Remarks"></textarea>
                        <span><i class="flaticon-edit icon-md"></i></span>
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
<div class="modal fade" id="expense_edit_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document" style=" max-width: 950px; ">
        <div class="modal-content">
            <form autocomplete="off" id="form_expense_edit" data-form-type="expense" data-modal-id="expense_edit_modal" method="POST" action="<?= base_url()?>expenses/update">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Update Expense</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form_expense_edit_alert alert alert-custom alert-light-warning fade show mb-5 d-none" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Some fields missed or filled incorrectly , Please correct and try again!</div>
                    </div>
                    <input type="hidden" id="expense_id_edit" name="expense_id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Expense Type</label>
                                <div class="radio-inline">
                                    <label class="radio radio-info">
                                        <input class="form_expense_edit_radio_edit" required type="radio" name="expense_type_edit" checked value="ta" />
                                        <span></span>
                                        TA
                                    </label>
                                    <label class="radio radio-primary">
                                        <input class="form_expense_edit_radio_edit" required type="radio" name="expense_type_edit" value="other" />
                                        <span></span>
                                        Other
                                    </label>
                                </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>

                        <div class="col-md-8" id="other_expense_amount_div_edit" style="display: none;">
                            <div class="form-group">
                                <label>Expense Amount <span class="text-danger">*</span></label>
                                <div class="input-icon input-icon-right">
                                    <input required type="text" id="other_expense_amount_edit" class="form-control form-control-pill form_expense_edit_fields" name="other_expense_amount" placeholder="Amount"/>
                                    <span><i class="la la-rupee icon-md"></i></span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <table id="ta_items_table_edit" class="ta_row_edit">
                        <thead>
                            <tr>
                                <td width="8%">SL</td>
                                <td>Starting Point</td>
                                <td>Ending Point</td>
                                <td>Distance in KM</td>
                                <td>Expense Amount</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>    
                        
                        <tbody id="ta_items_table_edit_tbody"></tbody>

                        <input type="hidden" id="current_row_count_edit" value="1">

                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="form-group">
                                        <label>Total Expense Amount</label>
                                        <div class="input-icon input-icon-right">
                                            <input required type="text" id="total_expense_amount_edit" class="form-control form-control-pill form_hospital_edit_fields" name="total_expense_amount" placeholder="Total Amount"/>
                                            <span><i class="la la-rupee icon-md"></i></span>
                                        </div>
                                    </div>
                                </td> 
                                <td>
                                   <div class="form-group">
                                    <button type="button" class="btn btn-icon btn-sm btn-pill btn-dark float-right"><i class="flaticon flaticon-plus" id="ta_item_add_btn_edit"></i></button>
                                </div>
                            </td>

                        </tr>
                    </tfoot>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks</label>
                            <div class="input-icon input-icon-right">
                                <textarea rows="2" type="text" id="remarks_edit" class="form-control form-control-pill form_hospital_edit_fields " name="remarks" placeholder="Remarks"></textarea>
                                <span><i class="flaticon-edit icon-md"></i></span>
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





<div class="modal fade" id="expense_delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" data-form-type="expense" data-modal-id="expense_delete_modal" action="<?= base_url()?>expenses/delete">

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
                <input type="hidden" id="expense_id_delete" name="expense_id">
            </div>


        </form>
    </div>
</div>
</div>
