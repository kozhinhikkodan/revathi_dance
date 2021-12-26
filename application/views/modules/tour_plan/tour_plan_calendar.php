

<link href="<?=base_url()?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.2.7" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.2.7"></script>
<!-- <script src="<?=base_url()?>assets/js/pages/features/calendar/basic.js?v=7.2.7"></script> -->

<style>
  .fc-sun { background-color:#f64e604d;  }
</style>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">


  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">




     <div class="card card-custom mb-5">

      <div class="card-header bg-primary">
        <div class="card-title">
          <span class="card-icon">

          </span>
          <h3 class="card-label text-white">Tour Plan Calendar</h3>
        </div>
        <div class="card-toolbar">

          <?php if ($this->session->userdata('user_role') == 'sales_man') {?>

            <!--begin::Button-->
            <a data-toggle="modal" data-target="#tour_plan_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
              <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <polygon points="0 0 24 0 24 24 0 24"></polygon>
                  <path d="M8,7 C7.44771525,7 7,6.55228475 7,6 C7,5.44771525 7.44771525,5 8,5 L16,5 C18.209139,5 20,6.790861 20,9 C20,11.209139 18.209139,13 16,13 L8,13 C6.8954305,13 6,13.8954305 6,15 C6,16.1045695 6.8954305,17 8,17 L17,17 C17.5522847,17 18,17.4477153 18,18 C18,18.5522847 17.5522847,19 17,19 L8,19 C5.790861,19 4,17.209139 4,15 C4,12.790861 5.790861,11 8,11 L16,11 C17.1045695,11 18,10.1045695 18,9 C18,7.8954305 17.1045695,7 16,7 L8,7 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                  <path d="M9.79289322,3.79289322 C10.1834175,3.40236893 10.8165825,3.40236893 11.2071068,3.79289322 C11.5976311,4.18341751 11.5976311,4.81658249 11.2071068,5.20710678 L8.20710678,8.20710678 C7.81658249,8.59763107 7.18341751,8.59763107 6.79289322,8.20710678 L3.79289322,5.20710678 C3.40236893,4.81658249 3.40236893,4.18341751 3.79289322,3.79289322 C4.18341751,3.40236893 4.81658249,3.40236893 5.20710678,3.79289322 L7.5,6.08578644 L9.79289322,3.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(7.500000, 6.000000) rotate(-270.000000) translate(-7.500000, -6.000000) "></path>
                  <path d="M18.7928932,15.7928932 C19.1834175,15.4023689 19.8165825,15.4023689 20.2071068,15.7928932 C20.5976311,16.1834175 20.5976311,16.8165825 20.2071068,17.2071068 L17.2071068,20.2071068 C16.8165825,20.5976311 16.1834175,20.5976311 15.7928932,20.2071068 L12.7928932,17.2071068 C12.4023689,16.8165825 12.4023689,16.1834175 12.7928932,15.7928932 C13.1834175,15.4023689 13.8165825,15.4023689 14.2071068,15.7928932 L16.5,18.0857864 L18.7928932,15.7928932 Z" fill="#000000" fill-rule="nonzero" transform="translate(16.500000, 18.000000) scale(1, -1) rotate(270.000000) translate(-16.500000, -18.000000) "></path>
                </g>
              </svg>
              <!--end::Svg Icon-->
            </span>Request Tour Plan</a>
            <!--end::Button-->

          <?php } else{ ?>

            <!--begin::Button-->
            <a data-toggle="modal" data-target="#tour_plan_bulk_approve_modal" class="btn btn-pill btn-dark font-weight-bolder">
              <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <rect x="0" y="0" width="24" height="24"/>
                  <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                  <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
                  <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                </g>
              </svg>
              <!--end::Svg Icon-->
            </span>Tour Plan Bulk Approval</a>
            <!--end::Button-->

          <?php } ?>


        </div>
      </div>

      <div class="card-body">
        <div class="row">

          <?php if ($this->session->userdata('user_role') != 'sales_man') {?>

            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group ">
                <label for="expense_head">Sales Man</label>
                <select style="width: 100%" class="form-control select-2 calendar_filters" id="calendar_filter_sales_man">
                  <option selected value="all">Select All</option>
                  <?php foreach ($sales_men as $key => $value) {?>
                    <option value="<?=$value->sales_man_id?>"><?=$value->sales_man_name . ' - ' . $value->manager_name?></option>
                  <?php }?>
                </select>
              </div>
            </div>

          <?php }?>

          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group">
              <label>Status</label>
              <div class="radio-inline">
                <label class="radio radio-info">
                  <input type="radio" value="all" name="calendar_filter_status" class="calendar_filters" checked/>
                  <span></span>
                  All
                </label>
                <label class="radio radio-warning">
                  <input type="radio" value="0" name="calendar_filter_status" class="calendar_filters" />
                  <span></span>
                  Pending
                </label>
                <label class="radio radio-success">
                  <input type="radio" value="1" name="calendar_filter_status" class="calendar_filters" />
                  <span></span>
                  Approved
                </label>

                <label class="radio radio-danger">
                  <input type="radio" value="2" name="calendar_filter_status" class="calendar_filters" />
                  <span></span>
                  Rejected
                </label>

              </div>
              <!-- <span class="form-text text-muted">Some help text goes here</span> -->
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="form-group ">
              <label for="expense_head">Locality</label>
              <select style="width: 100%" class="form-control select-2 calendar_filters" id="calendar_filter_locality" data-placeholder="Select Locality">
                <option selected value="all">Select All</option>
                <?php foreach ($localities as $key => $value) {?>
                  <option value="<?=$value->locality_id?>"><?=$value->locality_name . ' - ' . $value->district_name . ', ' . $value->state_name?></option>
                <?php }?>
              </select>
            </div>
          </div>



        </div>
      </div>
    </div>



    <!--begin::Dashboard-->
    <div class="card card-custom">
     <!--   <div class="card-header">
        <div class="card-title">
         <h3 class="card-label">
          Tour Planing
        </h3>
      </div>
      <div class="card-toolbar">

      </div>
    </div> -->
    <div class="card-body" id="kt_calendar_div">
      <div id="kt_calendar"></div>
    </div>
  </div>


  <!--end::Dashboard-->
</div>
<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->

<?php $this->load->view('include_modals/tour_plan_modals')?>



<script type="text/javascript">
  $('.menu-item-active').removeClass('menu-item-active');
  $('#tour_plan_menu').addClass('menu-item-active');
</script>

<style type="text/css">
  .fc-unthemed .fc-toolbar .fc-button{
    background: #f4f5f8;
    border: 0;
    text-shadow: none !important;
  }
</style>

<?php $this->load->view('include_scripts/localities_scripts')?>


<script type="text/javascript">

  // 

  $('body').on('change', '[name=check_all]', function() {
    var state = $('[name=check_all]:checked').val();
    if(state=='on'){
      $('.bulk_approval_checkboxes').prop('checked',true);
    }else{
      $('.bulk_approval_checkboxes').prop('checked',false);
    }
    
    update_tour_plan_ids();

  });


  $('body').on('change', '.bulk_approval_checkboxes', function() {
    update_tour_plan_ids();
  })

  function update_tour_plan_ids() {
    var ids = '';
    var true_count = 0;
    var count = 0;

    $('.bulk_approval_checkboxes').each(function(index, value) {
      var state = $(this).prop('checked');
      if(state){
        ids += $(this).data('tour-plan-id')+',';
        true_count++;
      }
      count++;
      $('#tour_plan_ids').val(ids.replace(/,\s*$/, ""));
      
    });

    if(count==true_count){
      $('[name=check_all]').prop('checked',true);
    }else{
      $('[name=check_all]').prop('checked',false);
    }

  }


  function bulk_approve_locality() { return $('#locality_bulk_approval').val(); }
  function bulk_approve_sales_man() { return $('#sales_man_bulk_approval').val(); }
  function bulk_approve_start_date() { return $('#start_date_bulk_approval').val(); }
  function bulk_approve_end_date() { return $('#end_date_bulk_approval').val(); }

  $('body').on('change keyup', '.bulk_approval_filter', function() {
    load_bulk_approval();
  });

  load_bulk_approval();


  function load_bulk_approval() {

    $.post("<?=base_url()?>tour_plan/fetch_tour_plans",{'locality':bulk_approve_locality,'sales_man':bulk_approve_sales_man,'start_date':bulk_approve_start_date,'end_date':bulk_approve_end_date},function(data) {
      var obj = $.parseJSON(data);

      $('#bulk_approval_tbody').html('');

      if(obj.length>0){

        $.each(obj, function(index, value) {

          new_row = '<tr>';
          new_row += '<td><div class="form-group"> <label class="checkbox checkbox-success"> <input type="checkbox" class="bulk_approval_checkboxes" data-tour-plan-id="'+value.tour_plan_id+'" name="checkbox_'+value.tour_plan_id+'"/> <span></span> &nbsp; </label> </div></td>';

          new_row += '<td><div class="form-group mr-2"> <input required type="text" id="end_date_bulk_approval" class="form-control" value="'+value.start_date+'"/> </div></td>';
          new_row += '<td><div class="form-group mr-2"> <input required type="text" id="end_date_bulk_approval" class="form-control" value="'+value.end_date+'"/> </div></td>';
          new_row += '<td><div class="form-group mr-2"> <input required type="text" id="end_date_bulk_approval" class="form-control" value="'+value.sales_man_name+'"/> </div></td>';
          new_row += '<td><div class="form-group mr-2"> <input required type="text" id="end_date_bulk_approval" class="form-control" value="'+value.locality_name+' - '+value.district_name+', '+value.state_name+' "/> </div></td>';
          new_row += '<td><div class="form-group mr-2"> <input required type="text" id="end_date_bulk_approval" class="form-control" value="'+value.notes+' "/> </div></td>';
          new_row += '</tr>';

          $('#bulk_approval_tbody').append(new_row);

        });

      }else{
        new_row = '<tr><td colspan="6" class="text-center">No tour Plans</td></tr>';
        $('#bulk_approval_tbody').append(new_row);
      }


    });

  }



  load_calendar();


  // var startDateFrom = moment().startOf('month');
  // var startDateTo = moment().endOf('month');
  // var startDateTo = moment().endOf('month').format('DD-MM-YYYY');

  // var currentTime = new Date();
  // var startDateFrom = new Date(currentTime.getFullYear(),currentTime.getMonth(),1);
  // var startDateTo = new Date(currentTime.getFullYear(),currentTime.getMonth() +1,0);


  $('#start_date_tour_plan_add,#end_date_tour_plan_add').datepicker({
    format: 'dd-mm-yyyy',
    // min: startDateFrom,
    // max: startDateTo
  });

  $('body').on('change', '#state_tour_plan_add', function() {
    var state_id = $(this).val();
    if(state_id!=null){
      fetch_districts(state_id,'#district_tour_plan_add');
    }
  });

  $('body').on('change', '#district_tour_plan_add', function() {
    var district_id = $(this).val();
    if(district_id!=null){
      fetch_localities(district_id,'#locality_tour_plan_add',true);
    }
  });


  $(".calendar_filters").on("change", function() {

    $('#kt_calendar_div').html('');
    $('#kt_calendar_div').html('<div id="kt_calendar"></div>');
    
    load_calendar();
  });


  function load_calendar() {

    if(typeof(calendar)!='undefined'){
      calendar.destroy();
    }

    $('#kt_calendar_div').html('');
    $('#kt_calendar_div').html('<div id="kt_calendar"></div>');

    var status = $('[name=calendar_filter_status]:checked').val();
    <?php if ($this->session->userdata('user_role') == 'sales_man') {?>
      var sales_man = '<?=$this->session->userdata('sales_man_data')->sales_man_id?>';
    <?php } else {?>
      var sales_man = $('#calendar_filter_sales_man').val();
    <?php }?>
    var locality = $('#calendar_filter_locality').val();


    $.post("<?=base_url()?>tour_plan/fetch_calendar_events",{'status':status,'sales_man_id':sales_man,'locality':locality},function(data) {
      var obj = $.parseJSON(data);
      var events_list = obj;

      var events = [];
      $.each(events_list, function(index, value) {
        events.push({
          id: value['id'],
          start: value['start'],
          end : value['end'],
          title : value['title'],
          description : value['description'],
          className : value['className'],
          url : value['url'],

          sales_man_name : value['sales_man_name'],
          start_date : value['start_date'],
          end_date : value['end_date'],
          state_name : value['state_name'],
          district_name : value['district_name'],
          locality_name : value['locality_name'],
          notes : value['notes'],
          tour_plan_id : value['tour_plan_id'],
          tour_plan_status : value['tour_plan_status'],
          reply_note : value['reply_note'],
          responded_by : value['responded_by'],
          responded_user_role : value['responded_user_role']
        });
      });



      var todayDate = moment().startOf('day');
      var YM = todayDate.format('YYYY-MM');
      var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
      var TODAY = todayDate.format('YYYY-MM-DD');
      var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

      var calendarEl = document.getElementById('kt_calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
        themeSystem: 'bootstrap',

        isRTL: KTUtil.isRTL(),

        header: {
          left: 'prev,next today',
          center: 'title',
          right: ''
        },

        eventDisplay: 'block',


        height: 800,
        contentHeight: 780,
        aspectRatio: 3,
        nowIndicator: true,
        now: TODAY + 'T09:25:00',

        views: {
          dayGridMonth: { buttonText: 'month' },
      // timeGridWeek: { buttonText: 'week' },
      // timeGridDay: { buttonText: 'day' }
    },

    defaultView: 'dayGridMonth',
    defaultDate: TODAY,

    <?php if ($this->session->userdata('user_role') == 'sales_man') {?>
      selectable: true,
    <?php }?>

    editable: false,
    eventLimit: false,
    navLinks: true,
    views: {
     month: {
       eventLimit: 4
     }
   },
                // events: [
                // {
                //     title: 'All Day Event',
                //     start: '2021-05-01',
                //     description: 'Toto lorem ipsum dolor sit incid idunt ut',
                //     className: "fc-event-danger fc-event-solid-warning"
                // }
                // ],

                events : events,

                eventRender: function(info) {


                  var element = $(info.el);

                  if (info.event.extendedProps && info.event.extendedProps.description) {
                    if (element.hasClass('fc-day-grid-event')) {
                      element.data('content', info.event.extendedProps.description);
                      element.data('placement', 'top');
                      KTApp.initPopover(element);
                    } else if (element.hasClass('fc-time-grid-event')) {
                      element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                      element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    }
                  }
                },



                // dateClick: function(info) {
                //   // alert('Date: ' + info.dateStr);
                //   // alert('Resource ID: ' + info.resource.);
                // },

                <?php if ($this->session->userdata('user_role') == 'sales_man') {?>

                  select : function(info) {
                    $('#start_date_tour_plan_add').val(moment(info.startStr).format('DD-MM-YYYY'));
                    $('#end_date_tour_plan_add').val(moment(info.endStr).subtract(1, 'day').format('DD-MM-YYYY'));
                    $('#tour_plan_add_modal').modal('toggle');
                  },


                  eventClick: function(info) {

                    var item = events[info.event.id];

                    if(item.sales_man_name!=''){


                      $('#start_date_tour_plan_info').val(moment(info.event.start).format('DD-MM-YYYY'));
                      info.event.end==null ? event_end = moment(info.event.start).format('DD-MM-YYYY') : event_end = moment(info.event.end).subtract(1, 'day').format('DD-MM-YYYY');
                      $('#end_date_tour_plan_info').val(event_end);


                    // $('#sales_man_tour_plan_approve').val(item.sales_man_name);
                    $('#state_tour_plan_info').val(item.state_name);
                    $('#district_tour_plan_info').val(item.district_name);
                    $('#locality_tour_plan_info').val(item.locality_name);
                    $('#notes_tour_plan_info').val(item.notes);

                    $('#reply_notes_tour_plan_info').val(item.reply_note);
                    var label_color,label_text = '';
                    if(item.tour_plan_status==0){
                      label_color = 'warning';
                      label_text = 'Pending';
                    }else if(item.tour_plan_status==1){
                     label_color = 'success';
                     label_text = 'Approved';
                   }else if(item.tour_plan_status==2){
                     label_color = 'danger';
                     label_text = 'Rejected';
                   }
                   $('#tour_plan_info_status_div').html('<label class="label label-lg label-'+label_color+' label-inline" style=" margin-top: 2.5em !important; width: 100%; ">'+label_text+'</label>')

                   if(item.tour_plan_status!=0){
                     if(item.responded_user_role!=''){
                      var responded_by = item.responded_by+' ( '+item.responded_user_role+' )';
                    }else{
                      var responded_by = item.responded_by;
                    }

                    $('#tour_plan_id_delete').val('');
                    $('#tour_plan_delete_btn_div').hide();

                  }else{
                    var responded_by = 'Waiting for response !';
                    $('#tour_plan_id_delete').val(item.tour_plan_id);
                    $('#tour_plan_delete_btn_div').show();


                  }

                  $('#responded_by_tour_plan_info').val(responded_by);



                  $('#tour_plan_info_modal').modal('toggle');

                  info.el.style.borderColor = 'black';

                }

              }


            <?php } else {?>

              eventClick: function(info) {


                var item = events[info.event.id];

                if(item.sales_man_name!=''){

                  $('#start_date_tour_plan_approve').val(moment(info.event.start).format('DD-MM-YYYY'));
                  info.event.end==null ? event_end = moment(info.event.start).format('DD-MM-YYYY') : event_end = moment(info.event.end).subtract(1, 'day').format('DD-MM-YYYY');
                  $('#end_date_tour_plan_approve').val(event_end);

                  // var item = events[info.event.id];

                  $('#sales_man_tour_plan_approve').val(item.sales_man_name);
                  $('#state_tour_plan_approve').val(item.state_name);
                  $('#district_tour_plan_approve').val(item.district_name);
                  $('#locality_tour_plan_approve').val(item.locality_name);
                  $('#notes_tour_plan_approve').val(item.notes);

                  $('#tour_plan_id_approve').val(item.tour_plan_id);
                  $('#reply_notes_tour_plan_approve').val(item.reply_note);
                  $('[name=tour_plan_approve_radio][value='+item.tour_plan_status+']').prop('checked',true);






                  $('#tour_plan_approve_modal').modal('toggle');

                    // alert('Event: ' + info.event.title);
                    // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    // alert('View: ' + info.view.type);
                    info.el.style.borderColor = 'black';
                  }

                }

              <?php }?>




            });

calendar.render();

});

}

$('body').on('click', '#tour_plan_delete_btn', function() {
  $('#tour_plan_info_modal').modal('hide');
});


</script>

<style type="text/css">

  .fc-unthemed .fc-event.fc-start .fc-content:before, .fc-unthemed .fc-event-dot.fc-start .fc-content:before {
    background: #ebedf300;
  }

  .fc-title {
    margin-left: -20px;
  }

  .fc-unthemed .fc-event .fc-title, .fc-unthemed .fc-event-dot .fc-title {
    font-size: 1rem;
    font-weight: 400;
  }
</style>