<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <div class="row">

        <div class="col-md-12 card card-custom">
          <div class="card-header">
            <h3 class="card-title">
              Register Student
            </h3>


            <div class="card-toolbar">

              <!--begin::Button-->
              <a href="<?= base_url() ?>students" class="btn btn-pill btn-dark font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24"></rect>
                      <path d="M5.5,2 L18.5,2 C19.3284271,2 20,2.67157288 20,3.5 L20,6.5 C20,7.32842712 19.3284271,8 18.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,3.5 C4,2.67157288 4.67157288,2 5.5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L13,6 C13.5522847,6 14,5.55228475 14,5 C14,4.44771525 13.5522847,4 13,4 L11,4 Z" fill="#000000" opacity="0.3"></path>
                      <path d="M5.5,9 L18.5,9 C19.3284271,9 20,9.67157288 20,10.5 L20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 L4,10.5 C4,9.67157288 4.67157288,9 5.5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L13,13 C13.5522847,13 14,12.5522847 14,12 C14,11.4477153 13.5522847,11 13,11 L11,11 Z M5.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,20.5 C20,21.3284271 19.3284271,22 18.5,22 L5.5,22 C4.67157288,22 4,21.3284271 4,20.5 L4,17.5 C4,16.6715729 4.67157288,16 5.5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L13,20 C13.5522847,20 14,19.5522847 14,19 C14,18.4477153 13.5522847,18 13,18 L11,18 Z" fill="#000000"></path>
                    </g>
                  </svg>
                  <!--end::Svg Icon-->
                </span>View All Students</a>
                <!--end::Button-->


              </div>

            </div>

            <form autocomplete="off" id="form_student_add" data-form-type="student_add" data-form-location="body" method="post" action="<?= base_url() ?>projects/create">

              <div class="card-body ">


                <div class="form-group mb-8">
                  <div class="alert alert-custom alert-warning form_project_alert d-none" role="alert" id="form_student_add_alert">
                    <div class="alert-icon">
                      <i class="flaticon-warning text-white"></i>
                    </div>
                    <div class="alert-text">
                      Some field not properly filled , Please correct and try again
                    </div>
                  </div>
                </div>


                <div class="row">

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Admission Date <span class="text-danger">*</span></label>
                      <div class="input-icon input-icon-right">
                        <input required type="text" id="admission_date" class="form-control form-control-pill form_student_add_fields date-field" name="admission_date" value="<?= date('d-m-Y') ?>" />
                        <span><i class="flaticon2 flaticon-event-calendar-symbol icon-md" ></i></span>
                      </div>
                      <span class="form-text text-muted"></span>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Admission No <span class="text-danger">*</span></label>
                      <!-- <div class="input-icon input-icon-right"> -->
                        <input required type="text" id="admission_no" class="form-control form-control-pill form_student_add_fields" name="admission_no" value="AD00001" />
                        <!-- <span><i class="flaticon2 flaticon2-phone icon-md"></i></span> -->
                        <!-- </div> -->
                        <span class="form-text text-muted"></span>
                      </div>
                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Student Name <span class="text-danger">*</span></label>
                        <div class="input-icon input-icon-right">
                          <input required type="text" id="student_name" class="form-control form-control-pill form_student_add_fields" name="student_name" value="Salih" />
                          <span><i class="flaticon2 flaticon2-user icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Contact Number <span class="text-danger">*</span></label>
                        <div class="input-icon input-icon-right">
                          <input minlength="10" maxlength="10" required type="text" id="contact_no" class="form-control form-control-pill form_student_add_fields" name="contact_no" value="9876543210" />
                          <span><i class="flaticon2 flaticon2-phone icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>DOB</label>
                        <div class="input-icon input-icon-right">
                          <input type="text" required type="text" id="contact_no" class="form-control form-control-pill form_student_add_fields date-field" name="contact_no" value="25-10-2010" />
                          <span><i class="flaticon2 flaticon-event-calendar-symbol icon-md"></i></span>
                        </div>
                        <span class="form-text text-muted"></span>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Age</label>
                        <!-- <div class="input-icon input-icon-right"> -->
                          <input minlength="10" maxlength="10" required type="text" id="contact_no" class="form-control form-control-pill form_student_add_fields" name="contact_no" value="24" />
                          <!-- <span><i class="flaticon2 flaticon2-phone icon-md"></i></span> -->
                          <!-- </div> -->
                          <span class="form-text text-muted"></span>
                        </div>
                      </div>

                    </div>

                    <div class="row">

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>School <span class="text-danger">*</span></label>
                          <!-- <div class="input-icon input-icon-right"> -->
                            <input required type="text" id="school" class="form-control form-control-pill form_student_add_fields" name="admission_date"  value="ABCD School"/>
                            <!-- <span><i class="flaticon2 flaticon-event-calendar-symbol icon-md"></i></span> -->
                            <!-- </div> -->
                            <span class="form-text text-muted"></span>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <div class="form-group">
                            <label>Class <span class="text-danger">*</span></label>
                            <!-- <div class="input-icon input-icon-right"> -->
                              <input required type="text" id="admission_no" class="form-control form-control-pill form_student_add_fields" name="admission_no" value="5" />
                              <!-- <span><i class="flaticon2 flaticon2-phone icon-md"></i></span> -->
                              <!-- </div> -->
                              <span class="form-text text-muted"></span>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Father's Job</label>
                              <!-- <div class="input-icon input-icon-right"> -->
                                <input required type="text" id="admission_no" class="form-control form-control-pill form_student_add_fields" name="admission_no" value="Accountant" />
                                <!-- <span><i class="flaticon2 flaticon2-phone icon-md"></i></span> -->
                                <!-- </div> -->
                                <span class="form-text text-muted"></span>
                              </div>
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">
                                <label>Mother's Job</label>
                                <!-- <div class="input-icon input-icon-right"> -->
                                  <input required type="text" id="admission_no" class="form-control form-control-pill form_student_add_fields" name="admission_no" value="Teacher" />
                                  <!-- <span><i class="flaticon2 flaticon2-phone icon-md"></i></span> -->
                                  <!-- </div> -->
                                  <span class="form-text text-muted"></span>
                                </div>
                              </div>

                            </div>




                            <div class="row">

                              <div class="col-5">

                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <div class="input-icon input-icon-right">
                                      <textarea required rows="3" type="text" id="remarks" class="form-control form-control-pill form_student_add_fields" name="remarks">Line 1</textarea>
                                      <span><i class="flaticon2 flaticon-edit icon-md"></i></span>
                                    </div>
                                    <span class="form-text text-muted"></span>
                                  </div>
                                </div>

                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>PIN Code <span class="text-danger">*</span></label>
                                    <!-- <div class="input-icon input-icon-right"> -->
                                      <input required type="text" id="admission_no" class="form-control form-control-pill form_student_add_fields" name="admission_no" value="676518" />
                                      <!-- <span><i class="flaticon2 flaticon2-phone icon-md"></i></span> -->
                                      <!-- </div> -->
                                      <span class="form-text text-muted"></span>
                                    </div>
                                  </div>



                                </div>
                                <div class="col-2">

                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Student Photo</label><br>
                                      <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url(<?= base_url() ?>assets/media/>users/blank.png)">
                                        <div class="image-input-wrapper" style="background-image: url(https://preview.keenthemes.com/metronic/demo1/custom/apps/user/assets/media/users/100_14.jpg)"></div>

                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                          <i class="fa fa-pen icon-sm text-muted"></i>
                                          <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                          <input type="hidden" name="profile_avatar_remove" />
                                        </label>

                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                          <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>

                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                          <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                      </div>
                                      <span class="form-text text-muted"></span>
                                    </div>
                                  </div>

                                </div>
                                <div class="col-5">

                                 <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Monthly Income <span class="text-danger">*</span></label>
                                    <!-- <div class="input-icon input-icon-right"> -->
                                      <input required type="text" id="admission_no" class="form-control form-control-pill form_student_add_fields" name="admission_no" value="15,000" />
                                      <!-- <span><i class="flaticon2 flaticon2-phone icon-md"></i></span> -->
                                      <!-- </div> -->
                                      <span class="form-text text-muted"></span>
                                    </div>
                                  </div>

                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Remarks <span class="text-danger">*</span></label>
                                      <div class="input-icon input-icon-right">
                                        <textarea required rows="3" type="text" id="remarks" class="form-control form-control-pill form_student_add_fields" name="remarks">Sample remarks</textarea>
                                        <span><i class="flaticon2 flaticon-edit icon-md"></i></span>
                                      </div>
                                      <span class="form-text text-muted"></span>
                                    </div>
                                  </div>
                                </div>


                              </div>


                              <div class="row">

                               <div class="col-md-12">
                                <div class="form-group">
                                  <label>Courses attending <span class="text-danger">*</span></label>
                                  <select required style="width: 100%" class="form-control select-2 form_sales_man_add_select" id="manager_add"  name="manager" data-placeholder="Select Courses attending" multiple="true">
                                    <!-- <option selected disabled>Select Course</option> -->
                                     <option selected>Violin</option>
                                     <option>Guitar</option>
                                     <option selected>Kuchhippudi</option>
                                 </select>
                                 <label for="manager_add" class="error"></label>
                               </div>
                             </div>



                           </div>









                         </div>

                         <div class="card-footer">
                          <div class="float-right mb-8">
                            <button type="submit" class="btn btn-primary mr-2 float-right form_submit">Update Student</button>
                            <button type="reset" class="btn btn-secondary mr-2 ">Cancel</button>
                          </div>
                        </div>
                      </form>
                      <!--end::Form-->
                    </div>


                  </div>


                  <!--end::Dashboard-->
                </div>
                <!--end::Container-->
              </div>
              <!--end::Entry-->
            </div>
            <!--end::Content-->

            <script type="text/javascript">
              $('.active').removeClass('menu-item-active');

              $('#students_menu').addClass('menu-item-open menu-item-here');
              $('#students_menu_1').addClass('menu-item-active');

              $('#kt_body').addClass('aside-minimize');

              var avatar4 = new KTImageInput('kt_image_4');

  // avatar4.on('cancel', function(imageInput) {
  //   swal.fire({
  //     title: 'Image successfully canceled !',
  //     type: 'success',
  //     buttonsStyling: false,
  //     confirmButtonText: 'Awesome!',
  //     confirmButtonClass: 'btn btn-primary font-weight-bold'
  //   });
  // });

  // avatar4.on('change', function(imageInput) {
  //   swal.fire({
  //     title: 'Image successfully changed !',
  //     type: 'success',
  //     buttonsStyling: false,
  //     confirmButtonText: 'Awesome!',
  //     confirmButtonClass: 'btn btn-primary font-weight-bold'
  //   });
  // });

  // avatar4.on('remove', function(imageInput) {
  //   swal.fire({
  //     title: 'Image successfully removed !',
  //     type: 'error',
  //     buttonsStyling: false,
  //     confirmButtonText: 'Got it!',
  //     confirmButtonClass: 'btn btn-primary font-weight-bold'
  //   });
  // });



  show_hide_rates();

  function show_hide_rates() {
    <?php if (in_array($this->session->userdata('user_role'), array('designing_staff', 'printing_staff'))) { ?>
      $('.price-divs').hide();
    <?php } else { ?>
      $('.price-divs').show();
    <?php } ?>
  }

  // var avatar3 = new KTImageInput('kt_image_3');



  $('#delivery_date').datepicker({
    format: 'dd-mm-yyyy'
  });

  $('#delivery_time').timepicker({
    defaultTime: false
  });

  $('body').on('change keyup', '.material_select', function() {
    var sl = $(this).data('sl');
    var unit = $('#material_' + sl + ' :selected').data('unit');

    $('#unit_' + sl).val(unit);

    if (unit != 'minutes') { // area
      $('.area_tds_' + sl).removeClass('d-none');
      $('.minutes_tds_' + sl).addClass('d-none');
    } else { // minutes
      $('.minutes_tds_' + sl).removeClass('d-none');
      $('.area_tds_' + sl).addClass('d-none');
    }

    rate_change(sl);

  });


  function rate_change(sl) {

    var unit = $('#material_' + sl + ' :selected').data('unit');
    var rate = $('#material_' + sl + ' :selected').data('rate');
    if ($.isNumeric(rate)) {
      $('#material_rate_' + sl).val(rate.toFixed(2));
    }
    if (unit != 'minutes') {
      var width = ($('#width_' + sl).val() == '') ? 0 : $('#width_' + sl).val();
      var height = ($('#height_' + sl).val() == '') ? 0 : $('#height_' + sl).val();
      var qty = ($('#qty_' + sl).val() == '') ? 0 : $('#qty_' + sl).val();
      var unit = $('#material_' + sl + ' :selected').data('unit');

      console.log(unit);
      //  if (unit == 'feet') {
      //   var area = ((width * height) / 144).toFixed(2);
      // } else if (unit == 'inch') {
      //   var area = (width * height).toFixed(2);
      // } else {
      //   var area = 0;
      // }

      if (unit != 'minutes') {
        if (unit == 'inch') {
          var area = (width * height).toFixed(2);
        } else {
          var area = ((width * height) / 144).toFixed(2);
        }
      } else {
        var area = 0;
      }

      $('#area_' + sl).val(area);

      //  var area = parseFloat(width*height).toFixed(2);
      //  $('#area_'+sl).val(area);
      var net_rate = parseFloat(rate * area * qty).toFixed(2);
    } else {
      var minutes = ($('#minutes_' + sl).val() == '') ? 0 : $('#minutes_' + sl).val();
      var net_rate = parseFloat(rate * minutes).toFixed(2);
    }

    if (!$.isNumeric(net_rate)) {
      net_rate = 0;
    }
    $('#rate_' + sl).val(net_rate);
    calculate_total_rate();
  }

  $('body').on('change keyup', '.rate-fields', function() {
    var sl = $(this).data('sl');
    rate_change(sl);
  });

  function calculate_total_rate() {
    var total_rate = 0;
    $('.total-rate-fields').each(function(index, value) {
      total_rate += parseFloat(this.value);
    });
    $('#total_rate').val(total_rate.toFixed(2));
  }


  // material_select
  material_select('#material_1');

  function material_select(target) {
    $.post("<?= base_url() ?>materials/select_materials", function(data) {
      var obj = $.parseJSON(data);
      var count = Object.keys(obj).length;
      $(target).html('');
      var options = '<option selected disabled>Select Material</option>';
      if (count > 0) {
        $.each(obj.data, function(index, value) {
          options += '<option value="' + value[7] + '" data-rate="' + value[3] + '" data-unit="' + value[8] + '" >' + value[1] + ' ( ' + value[8].toUpperCase() + ' )</option>';
        });
        $(target).html(options);
      } else {
        $(target).html('');
        toastr['warning']('No Materials found ', 'Not Found');
      }
    });
  }



  $('body').on('click', '#add_btn', function() {

    $rate_show = 1;
    <?php if (in_array($this->session->userdata('user_role'), array('designing_staff', 'printing_staff'))) { ?>
      $rate_show = 0;
    <?php } ?>

    var items_count = parseInt($('#items_count').val());

    var new_count = items_count + 1;

    var newrow = '<tr id="row_' + new_count + '"> <td width="20%"> <div class="form-group"> <select style="width: 100% !important" class="form-control material_select select-2 " data-sl="' + new_count + '" id="material_' + new_count + '" name="items[material][' + new_count + ']" data-placeholder="Select Material" > <option selected disabled>Select Material</option> </select> <span class="form-text text-muted"></span> </div> </td> <td class="price-divs"> <div class="form-group"> <div class="input-icon input-icon-right"> <input readonly required type="text" data-sl="' + new_count + '" id="material_rate_' + new_count + '" class="form-control form-control-pill form_student_add_fields rate-fields" name="items[unit_rate][' + new_count + ']" placeholder="Rate"/> <span><i class="flaticon2 flaticon-edit icon-md"></i></span> </div> <span class="form-text text-muted"></span> </div> </td> <input type="hidden" name="items[unit][' + new_count + ']" data-sl="' + new_count + '" id="unit_' + new_count + '"><td class="area_tds_' + new_count + '"> <div class="form-group"> <div class="input-icon input-icon-right"> <input required type="text" data-sl="' + new_count + '" id="width_' + new_count + '" class="form-control form-control-pill form_student_add_fields rate-fields" name="items[width][' + new_count + ']" placeholder="Width"/> <span><i class="flaticon2 flaticon-edit icon-md"></i></span> </div> <span class="form-text text-muted"></span> </div> </td> <td class="area_tds_' + new_count + '"> <div class="form-group"> <div class="input-icon input-icon-right"> <input required type="text" data-sl="' + new_count + '" id="height_' + new_count + '" class="form-control form-control-pill form_student_add_fields rate-fields" name="items[height][' + new_count + ']" placeholder="Height"/> <span><i class="flaticon2 flaticon-edit icon-md"></i></span> </div> <span class="form-text text-muted"></span> </div> </td> <td class="area_tds_' + new_count + '"> <div class="form-group"> <div class="input-icon input-icon-right"> <input readonly required type="text" data-sl="' + new_count + '" id="area_' + new_count + '" class="form-control form-control-pill form_student_add_fields project-cost-fields" name="items[area][' + new_count + ']" placeholder="Area" value="" /> <span><i class="flaticon2 flaticon-edit icon-md"></i></span> </div> <span class="form-text text-muted"></span> </div> </td> <td class="area_tds_' + new_count + '"> <div class="form-group"> <div class="input-icon input-icon-right"> <input required type="text" data-sl="' + new_count + '" id="qty_' + new_count + '" class="form-control form-control-pill form_student_add_fields rate-fields" name="items[quantity][' + new_count + ']" placeholder="Quantity" value="" /> <span><i class="flaticon2 flaticon-edit icon-md"></i></span> </div> <span class="form-text text-muted"></span> </div> </td> <td colspan="4" class="d-none minutes_tds_' + new_count + '"> <div class="form-group"> <div class="input-icon input-icon-right"> <input required type="text" data-sl="' + new_count + '" id="minutes_' + new_count + '" class="form-control form-control-pill form_student_add_fields project-cost-fields rate-fields" name="items[minutes][' + new_count + ']" placeholder="Minutes" value="0" /> <span><i class="flaticon2 flaticon-edit icon-md"></i></span> </div> <span class="form-text text-muted"></span> </div> </td> <td class="price-divs"> <div class="form-group"> <div class="input-icon input-icon-right"> <input readonly required type="text" data-sl="' + new_count + '" id="rate_' + new_count + '" class="form-control form-control-pill form_student_add_fields total-rate-fields" name="items[rate][' + new_count + ']" placeholder="Rate" value="" /> <span><i class="flaticon2 flaticon-edit icon-md"></i></span> </div> <span class="form-text text-muted"></span> </div> </td> <td> <div class="form-group mx-1" style=" margin-top: -2em; "> <button type="button" data-sl="' + new_count + '" class="btn btn-icon btn-sm btn-pill btn-danger float-right item_delete_btn" ><i class="flaticon flaticon-close" ></i></button> </div> </td></tr>';

    $('#item_tbody').append(newrow);
    $('.select-2').select2();
    material_select('#material_' + new_count);
    show_hide_rates();

    $('#items_count').val(new_count);

  });

$('body').on('click', '.item_delete_btn', function() {
  var sl = $(this).data('sl');
  $('#row_' + sl).remove();
  var new_no = sl - 1;
  $('#items_count').val(new_no);
});
</script>