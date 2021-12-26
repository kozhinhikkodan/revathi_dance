<style type="text/css">



  @media only screen and (min-width: 320px) and (max-width: 479px) {
    .profile_div{
      margin-top: 1rem !important;
    }
    .user-img{
      margin-left: 7rem !important;
      margin-top: 1.25rem !important;
    }
  }
  @media only screen and (min-width: 480px) and (max-width: 767px) {
    .profile_div{
      margin-top: 1rem !important;
    }
    .user-img{
      margin-left: 7rem !important;
      margin-top: 1.25rem !important;
    }
  }
  @media only screen and (min-width: 979px) and (max-width: 979px) {
    .profile_div{
      margin-top: 1rem !important;
    }
    .user-img{
      margin-left: 7rem !important;
      margin-top: 1.25rem !important;
    }
  }
</style>


<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <div class="d-flex align-items-center flex-wrap mr-1">
      <div class="d-flex align-items-baseline flex-wrap mr-5">
        <h5 class="text-dark font-weight-bold my-1 mr-5">Doctor Profile</h5>
      </div>
    </div>
  </div>
</div>


<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Profile Overview-->


      <div class="row">
        <!--begin::Aside-->
        <div class="col-md-3 w-300px w-xl-350px" id="kt_profile_aside">


          <!--begin::Profile Card-->
          <div class="card card-custom card-stretch">
            <!--begin::Body-->
            <div class="card-body pt-4">

              <!--begin::User-->
              <div class="d-flex align-items-center mt-5 ml-15">
                <div class="symbol symbol-90 symbol-light-success symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                  <!-- <div class="symbol-label" style="background-image:url('')"></div>  -->
                  <!-- <span class="font-size-h1 symbol-label font-weight-boldest text-dark"><i class="la la-hashtag text-dark"></i>12</span> -->

                  <span class="symbol symbol-circle symbol-100">
                    <img class="img-fluid" src="<?= base_url() ?>assets/media/users/default.jpg" width="100%">
                  </span>


                  <!-- <i class="symbol-badge bg-success"></i> -->
                </div>


              </div>
              <div class="text-center">
                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-center text-hover-primary"><?= $doc_data->doctor_name ?></a>
                <div class="text-muted"></div>
              </div>

              <!--end::User-->
              <!--begin::Nav-->
              <div class="navi navi-bold navi-hover navi-active navi-link-rounded py-9">
                <div class="navi-item mb-2">
                  <a href="javascript:;" class="navi-link py-4 active profile_nav" id="profile_nav_overview" data-div="overview" data-tables="">
                    <span class="navi-icon mr-2">
                      <span class="svg-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
                            <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
                          </g>
                        </svg>
                        <!--end::Svg Icon-->
                      </span>
                    </span>
                    <span class="navi-text font-size-lg">Overview</span>
                  </a>
                </div>


                <div class="navi-item mb-2">
                  <a href="javascript:;" class="navi-link py-4 profile_nav" id="profile_nav_work_logs" data-div="work_logs" data-tables="work_logs_view_table">
                    <span class="navi-icon mr-2">
                      <span class="svg-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Text/Article.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                            <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3" />
                          </g>
                        </svg>
                        <!--end::Svg Icon-->
                      </span>
                    </span>
                    <span class="navi-text">Sales Man Visits</span>
                  </a>
                </div>






              </div>
              <!--end::Nav-->
            </div>
            <!--end::Body-->
          </div>
          <!--end::Profile Card-->
        </div>
        <!--end::Aside-->
        <!--begin::Content-->
        <div class="col-md-9">






          <div class=" profile_div" id="div_overview">

            <div class="row">


              <div class="col-xl-4  ">
                <div class="card card-custom gutter-b" style="height: 130px">
                  <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                      <div class="text-dark-50 font-weight-bold">Missed Calls</div>
                      <div class="font-weight-bolder font-size-h3"><?= $missed_calls['count'] ?> / <?= $missed_calls['frequency'] ?></div>
                    </div>
                    <?php $progress = ($missed_calls['count']/$missed_calls['frequency'])*100;  ?>
                    <div class="progress progress-xs">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $progress ?>%;" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4  ">
                <div class="card card-custom gutter-b" style="height: 130px">
                  <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                      <div class="text-dark-50 font-weight-bold">Birth Date</div>
                      <div class="font-weight-bolder font-size-h3"><?= date('d F',strtotime($doc_data->dob)) ?></div>

                      <?php 
                      
                      $dob_split = explode('-', $doc_data->dob);
                      
                      if($dob_split[1]==date('m') &&  $dob_split[2]==date('d') ) { 

                        ?>

                        <div class="font-weight-bold text-danger">Wish Him Today </div>

                      <?php } ?>

                    </div>
                  </div>
                </div>
              </div>


              <div class="col-xl-4  ">
                <div class="card card-custom gutter-b" style="height: 130px">
                  <div class="card-body d-flex flex-column">
                    <div class="flex-grow-1">
                      <div class="text-dark-50 font-weight-bold">Wedding Date</div>
                      <div class="font-weight-bolder font-size-h3"><?= date('d F',strtotime($doc_data->wedding_date)) ?></div>

                      <?php 
                      
                      $dob_split = explode('-', $doc_data->wedding_date);
                      
                      if($dob_split[1]==date('m') &&  $dob_split[2]==date('d') ) { 

                        ?>

                        <div class="font-weight-bold text-danger">Wish Him Today </div>

                      <?php } ?>

                    </div>
                  </div>
                </div>
              </div>

            </div>

            <!--begin::Card-->
            <div class="card card-custom card-stretch">



              <!--begin::Header-->
              <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                  <h3 class="card-label font-weight-bolder text-dark">Profile Overview</h3>
                </div>
              </div>
              <!--end::Header-->
              <!--begin::Form-->
              <form class="form"> 
                <!--begin::Body-->
                <div class="card-body">

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Name </label>
                    <div class="col-lg-9 col-xl-9">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="flaticon-user"></i>
                          </span>
                        </div>
                        <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $doc_data->doctor_name ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Full Name </label>
                    <div class="col-lg-9 col-xl-9">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="flaticon-user"></i>
                          </span>
                        </div>
                        <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $doc_data->full_name ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Qualification </label>
                    <div class="col-lg-9 col-xl-9">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="flaticon-edit"></i>
                          </span>
                        </div>
                        <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $doc_data->qualification ?> " />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Specialities </label>
                    <div class="col-lg-9 col-xl-9">

                      <?php foreach (explode(',', $doc_data->specialities) as $key => $value) { ?>
                        <button type="button" class="btn btn-sm btn-lg btn-secondary m-1"><?= $value ?></button>
                      <?php } ?>

                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Hospital </label>
                    <div class="col-lg-6 col-xl-6 mb-3">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="flaticon2-hospital"></i>
                          </span>
                        </div>
                        <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $doc_data->hospital ?> " />
                      </div>
                    </div>

                    <div class="col-lg-3 col-xl-3">
                      <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $doc_data->hospital_location ?> " />
                    </div>

                  </div>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Localities </label>
                    <div class="col-lg-9 col-xl-9">

                      <?php foreach ($doc_data->localities as $key => $value) { ?>
                        <button type="button" class="btn btn-sm btn-lg btn-secondary m-1"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></button><br>
                      <?php } ?>

                    </div>

                  </div>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Phone </label>
                    <div class="col-lg-9 col-xl-9">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="flaticon2-phone"></i>
                          </span>
                        </div>
                        <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $doc_data->phone ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Mobile </label>
                    <div class="col-lg-9 col-xl-9">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="la la-mobile-phone"></i>
                          </span>
                        </div>
                        <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $doc_data->mobile ?>" />
                      </div>
                    </div>
                  </div>

                  <?php if($doc_data->wedding_date!='0000-00-00') { ?>

                    <div class="form-group row">
                      <label class="col-xl-3 col-lg-3 col-form-label">Wedding Date </label>
                      <div class="col-lg-9 col-xl-9">
                        <div class="input-group input-group-lg input-group-solid">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="flaticon2-calendar-9"></i>
                            </span>
                          </div>
                          <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= date('d-m-Y',strtotime($doc_data->wedding_date)) ?>" />
                        </div>
                      </div>
                    </div>

                  <?php } ?>
                  <?php if($doc_data->dob!='0000-00-00') { ?>

                    <div class="form-group row">
                      <label class="col-xl-3 col-lg-3 col-form-label">Date of Birth </label>
                      <div class="col-lg-9 col-xl-9">
                        <div class="input-group input-group-lg input-group-solid">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="flaticon2-calendar-9"></i>
                            </span>
                          </div>
                          <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= date('d-m-Y',strtotime($doc_data->dob)) ?>" />
                        </div>
                      </div>
                    </div>

                  <?php } ?>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Visit Frequency </label>
                    <div class="col-lg-9 col-xl-9">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="flaticon-edit"></i>
                          </span>
                        </div>
                        <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $doc_data->visit_frequency ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Email </label>
                    <div class="col-lg-9 col-xl-9">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="flaticon-email"></i>
                          </span>
                        </div>
                        <input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $doc_data->email ?>" />
                      </div>
                    </div>
                  </div>




                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">Created On</label>
                    <div class="col-lg-9 col-xl-9">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="la la-clock"></i>
                          </span>
                        </div>
                        <input readonly type="text" class="form-control form-control-lg form-control-solid" value=" <?= date('d-m-Y h:i:s A',strtotime($doc_data->created_date)) ?>" placeholder="Email" />
                      </div>
                    </div>
                  </div>

                  <!-- <div id="pcm_chart_2"></div> -->



                </div>

                <!--end::Body-->
              </form>
              <!--end::Form-->
            </div>

          </div>

          <!--begin::Card-->


          <div class="card card-custom card-stretch d-none profile_div" id="div_work_logs">
            <div class="card-header bg-primary">
              <div class="card-title">
                <span class="card-icon">
                </span>
                <h3 class="card-label text-white">List of Sales Man Visits</h3>
              </div>
            </div>
            <div class="card-body card-body-custom">
              <!-- <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Date</label>
                    <div class="input-icon input-icon-right">
                      <input type='text' class="form-control" id='kt_daterangepicker_6' readonly  placeholder="Select date range"/>
                      <span><i class="la la-calendar-check-o icon-md"></i></span>
                    </div>
                  </div>
                </div>

              </div> -->

              <!-- <div class="row"> -->

                <?php $this->load->view('include_tables/table_work_logs') ?>

              <!-- </div> -->

            </div>
          </div>





        </div>
        <!--end::Content-->
      </div>
      <!--end::Profile Overview-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Entry-->
</div>

<?php $this->load->view('include_scripts/expenses_scripts') ?>
<?php $this->load->view('include_scripts/work_logs_scripts') ?>




<script type="text/javascript">
  $('.menu-item-active').removeClass('menu-item-active');
  $('#doctors_menu').addClass('menu-item-active');

  $('#kt_body').addClass('aside-minimize');


  jQuery(document).ready(function() {
    $('.profile_nav').on('click', function(e){
      var table_name = $(this).attr('data-tables');
      if(table_name!=''){
        var tables = table_name.split(',');
        $.each(tables, function( index, value ){
          var table_name = value;
          $('#'+table_name).dataTable().fnDestroy();
          eval(table_name).init("reload");
        });
      }

      $($.fn.dataTable.tables(true)).DataTable()
      .columns.adjust()
      .responsive.recalc();
      
    });
  })

  function activate_menu(menu) {
    $('.profile_nav').removeClass('active');
      // var div = $(this).data('div');
      $('#profile_nav_'+menu).addClass('active');
      $('.profile_div').addClass('d-none');
      $('#div_'+menu).removeClass('d-none');

      //tables
      var tables = $('#profile_nav_'+menu).data('tables');
      if(tables!=''){
        tables = tables.split(',');
        $.each(tables, function(index, value) {
          // $('#'+value).dataTable().fnClearTable();
          // $('#'+value).dataTable().fnDestroy();
          $('#'+value).DataTable().columns.adjust().responsive.recalc();
        });
      }
    }

    <?php if(!empty($vendor_data)) { ?>
      $('#assigned_id').val('<?= $vendor_data->vendor_id ?>');
    <?php } ?>

    $('body').on('click', '.profile_nav', function() {
      var menu = $(this).data('div');
      activate_menu(menu);
    });

    activate_menu('overview');





  </script>


  <style type="text/css">
    .dataTables_wrapper {
      padding: 30px !important;
    }
  </style>





  <script type="text/javascript">

    var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };

    var element2 = document.getElementById("pcm_chart_2");
    var options2 = {
        // series: [{
        //     name: 'Net Profit',
        //     data: [30, 40, 40, 90, 90, 70, 70]
        // }],

        theme: {
          palette: 'palette9'
        },

        series: [{
          name: 'Manager 1',
          data: [31, 40, 28, 51, 42, 109, 100]
        }, 

        

            // ,{
            //     name: 'Sales Man 4',
            //     data: [14, 14, 25, 25, 34, 87, 79]
            // }

            ],

            chart: {
              type: 'line',
              height: 350,
              toolbar: {
                show: false
              }
            },
            plotOptions: {

            },
            legend: {
              show: false
            },
            dataLabels: {
              enabled: false
            },
            fill: {
              type: 'solid',
              opacity: 1
            },
            stroke: {
              curve: 'smooth',
              show: true,
              width: 3,
            // colors: [KTAppSettings['colors']['theme']['base']['info']]
            colours: undefined
          },
          xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
            axisBorder: {
              show: false,
            },
            axisTicks: {
              show: false
            },
            labels: {
              style: {
                    // colors: KTAppSettings['colors']['gray']['gray-500'],
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                  }
                },
                crosshairs: {
                  position: 'front',
                  stroke: {
                    color: KTAppSettings['colors']['theme']['base']['info'],
                    width: 1,
                    dashArray: 3
                  }
                },
                tooltip: {
                  enabled: true,
                  formatter: undefined,
                  offsetY: 0,
                  style: {
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                  }
                }
              },
              yaxis: {
                labels: {
                  style: {
                    // colors: KTAppSettings['colors']['gray']['gray-500'],
                    fontSize: '12px',
                    fontFamily: KTAppSettings['font-family']
                  }
                }
              },
              states: {
                normal: {
                  filter: {
                    type: 'none',
                    value: 0
                  }
                },
                hover: {
                  filter: {
                    type: 'none',
                    value: 0
                  }
                },
                active: {
                  allowMultipleDataPointsSelection: false,
                  filter: {
                    type: 'none',
                    value: 0
                  }
                }
              },
              tooltip: {
                style: {
                  fontSize: '12px',
                  fontFamily: KTAppSettings['font-family']
                },
                y: {
                  formatter: function (val) {
                    return val + " Hours"
                  },
                  title: {
                    formatter: function(value, { series, seriesIndex, dataPointIndex, w }) {
                      return false
                    }
                  }
                }
              },
        // colors: [KTAppSettings['colors']['theme']['light']['info']],
        grid: {
          borderColor: KTAppSettings['colors']['gray']['gray-200'],
          strokeDashArray: 4,
          yaxis: {
            lines: {
              show: true
            }
          }
        },
        markers: {
                //size: 5,
                //colors: [KTAppSettings['colors']['theme']['light']['danger']],
                strokeColor: KTAppSettings['colors']['theme']['base']['info'],
                strokeWidth: 3
              }
            };

            var chart2 = new ApexCharts(element2, options2);
            chart2.render();

          </script>
