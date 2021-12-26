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
				<h5 class="text-dark font-weight-bold my-1 mr-5">Manager Profile</h5>
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
				<div class="col-12 col-md-3 w-300px w-xl-350px" id="kt_profile_aside">
					<!--begin::Profile Card-->
					<div class="card card-custom card-stretch">
						<!--begin::Body-->
						<div class="card-body pt-4">
							
							<!--begin::User-->
							<div class="d-flex align-items-center user-img mt-5 ml-15">
								<div class="symbol symbol-90 symbol-light-success symbol-xxl-100 mr-5 align-self-start align-self-xxl-center align-self-center">
									<span class="symbol symbol-circle symbol-100"><img class="img-fluid" src="<?= base_url() ?>assets/media/users/default.jpg" width="100%"></span>
								</div>
							</div>
							<div class="text-center">
								<a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-center text-hover-primary"><?= $manager_data->manager_name ?></a>
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
									<a href="javascript:;" class="navi-link py-4 profile_nav" id="profile_nav_expenses" data-div="expenses" data-tables="expenses_view_table">
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
										<span class="navi-text">Expenses</span>
									</a>
								</div>

								<div class="navi-item mb-2">
									<a href="javascript:;" class="navi-link py-4 profile_nav" id="profile_nav_sales_men" data-div="sales_men" data-tables="sales_men_view_table">
										<span class="navi-icon mr-2">
											<span class="svg-icon">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Text/Article.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<polygon points="0 0 24 0 24 24 0 24"></polygon>
														<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
														<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</span>
										<span class="navi-text">Sales Men</span>
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

					<!--begin::Card-->
					<div class="card card-custom card-stretch profile_div" id="div_overview">
						<!--begin::Header-->
						<div class="card-header py-3">
							<div class="card-title align-items-start flex-column">
								<h3 class="card-label font-weight-bolder text-dark">Profile Overview</h3>
							</div>


							<div class="card-toolbar">

								<?php 
								$whatsapp_message = 'Login to  :  '.config_item('app_name').' - '.base_url().' %0A username : '.$manager_data->username.' %0A Password : '.$manager_data->password;
								?>

								<!-- <a href="https://api.whatsapp.com/send?text=<?= $whatsapp_message ?>" class="btn btn-success font-weight-bolder" target="_blank">
									<i class="icon-2x socicon-whatsapp"></i>
								</a> -->

							</div>



						</div>
						<!--end::Header-->
						<!--begin::Form-->
						<form class="form"> 
							<!--begin::Body-->
							<div class="card-body">




											<!-- <div class="row">
												<label class="col-xl-3"></label>
												<div class="col-lg-9 col-xl-6">
													<h5 class="font-weight-bold mt-1 mb-4"> Info</h5>
												</div>
											</div>
										-->
										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Name </label>
											<div class="col-lg-9 col-xl-6">
												<div class="input-group input-group-lg input-group-solid">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="flaticon-user"></i>
														</span>
													</div>
													<input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $manager_data->manager_name ?>" />
												</div>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Location </label>
											<div class="col-lg-9 col-xl-6">
												<div class="input-group input-group-lg input-group-solid">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="flaticon-map-location"></i>
														</span>
													</div>
													<input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $manager_data->manager_location ?>" />
												</div>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Email </label>
											<div class="col-lg-9 col-xl-6">
												<div class="input-group input-group-lg input-group-solid">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="flaticon-email"></i>
														</span>
													</div>
													<input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" <?= $manager_data->manager_email ?>" />
												</div>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Field Localities </label>
											<div class="col-lg-9 col-xl-6">
												
												<?php foreach($manager_data->localities as $key => $value) { ?>
													<button type="button" class="btn btn-sm btn-lg btn-secondary m-1"><?= $value->locality_name.' - '.$value->district_name.', '.$value->state_name ?></button>
												<?php } ?>


											</div>
										</div>

										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Allowances </label>
											<div class="col-lg-4 col-xl-3">
												<div class="input-group input-group-lg input-group-solid">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="la la-rupee"></i>
														</span>
													</div>
													<input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" TA - <?= $manager_data->manager_ta ?>" />
												</div>
											</div>

											<div class="col-lg-5 col-xl-3">
												<div class="input-group input-group-lg input-group-solid">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="la la-rupee"></i>
														</span>
													</div>
													<input readonly type="text" class="form-control form-control-lg form-control-solid" placeholder="name" value=" DA - <?= $manager_data->manager_da ?>" />
												</div>
											</div>
										</div>


										<div class="form-group row">
											<label class="col-xl-3 col-lg-3 col-form-label">Created On</label>
											<div class="col-lg-9 col-xl-6">
												<div class="input-group input-group-lg input-group-solid">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<i class="la la-clock"></i>
														</span>
													</div>
													<input readonly type="text" class="form-control form-control-lg form-control-solid" value=" <?= date('d-m-Y h:i:s A',strtotime($manager_data->created_date)) ?>" placeholder="Email" />
												</div>
											</div>
										</div>

										<hr>

										<div id="pcm_chart_2"></div>


										
									</div>

									<!--end::Body-->
								</form>
								<!--end::Form-->
							</div>


							<!--begin::Card-->

							<div class="card card-custom card-stretch d-none profile_div" id="div_expenses">
								<div class="card-header bg-primary">
									<div class="card-title">
										<span class="card-icon">
										</span>
										<h3 class="card-label text-white">List of Expenses</h3>
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
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="form-group">
												<label>Expense type</label>
												<div class="radio-inline">
													<label class="radio radio-warning">
														<input type="radio" value="all" name="table_filter_status" class="table_filters" checked/>
														<span></span>
														All
													</label>
													<label class="radio radio-info">
														<input type="radio" value="1" name="table_filter_status" class="table_filters" />
														<span></span>
														TA
													</label>
													<label class="radio radio-primary">
														<input type="radio" value="0" name="table_filter_status" class="table_filters" />
														<span></span>
														Other
													</label>
												</div>
											</div> 
										</div>  
									</div> -->
									<?php $this->load->view('include_tables/table_expenses') ?>
								</div>
							</div>


							<div class="card card-custom card-stretch d-none profile_div" id="div_sales_men">
								<div class="card-header bg-primary">
									<div class="card-title">
										<span class="card-icon">
										</span>
										<h3 class="card-label text-white">List of Sales Men</h3>
									</div>
								</div>
								<div class="card-body card-body-custom">
									<div class="row">
										<!-- Filters -->
									</div>
									<?php $this->load->view('include_tables/table_sales_men') ?>
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
		<?php $this->load->view('include_scripts/sales_men_scripts') ?>

		<?php $this->load->view('include_modals/sales_men_modals') ?>


  <script src="//www.google.com/jsapi"></script>

		<script type="text/javascript">
			$('.menu-item-active').removeClass('menu-item-active');
			$('#managers_menu').addClass('menu-item-active');

			$('#kt_body').addClass('aside-minimize');


			jQuery(document).ready(function() {
				$('.profile_nav').on('click', function(e){
					var table_name = $(this).attr('data-tables');
					if(table_name!=''){
						var tables = table_name.split(',');
						$.each(tables, function( index, value ){
							var table_name = value;
							console.log(table_name);
							$('#'+table_name).dataTable().fnDestroy();
							eval(table_name).init("reload");
						});
					}
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

		
     google.load('visualization', '1', {
      packages: ['corechart', 'bar', 'line']
    });

    google.setOnLoadCallback(fetch_chart_data);

    function fetch_chart_data() {
      // var type = 'member';
      // var id = $('#table_filter_member').val();
      // var committee_id = $('#table_filter_committee').val();
      // var member_name = $('#table_filter_member :selected').html().split('-')[0];
      // var committee_name = $('#table_filter_committee :selected').html();


      // var start_month = $('#chart_filter_start_month').val();
      // var end_month = $('#chart_filter_end_month').val();

      // var start_month_object = new Date(start_month);
      // var end_month_object = new Date(end_month);

      // if(start_month_object<end_month_object){

        $.post("<?= base_url() ?>managers/fetch_chart_data",{id:'<?= $manager_data->manager_id ?>'},function(data) {
          var obj = $.parseJSON(data);

 

        console.log(obj);

        var dataArray = [['Month']];
        $.each(obj.managers, function(index, value) {
          dataArray[0].push(value);
        });
        // console.log(dataArray);


        var j = 1
        $.each(obj.values, function(index, value) {
          // console.log(value.length);
          // console.log([index,value[0],value[1]]);

          // dataArray.push([index,value[0],value[1],value[2]]);

          dataArray[j] = []; 
          dataArray[j][0] = index; 
          for (var i = 1; i <= value.length; i++) {
            dataArray[j][i] = value[i-1];
          }

          j++;
        });


        console.log(dataArray);



        var data = new google.visualization.arrayToDataTable(dataArray);

        var title_end = 'All Members in All Committees';

        // if(committee_name!='Select All'){
        //   title_end = committee_name;
        // }

        // if(member_name!='Select All'){
        //   title_end = member_name;
        // }


        var options = {
          chart: {
            title: 'Work Logs ',
            subtitle: 'in Number of Visits',
          },
          vAxis: { format:'long'},
          legend: { position: 'none' },
          curveType: 'function',
          // colors: ['#ED0838']
        };

        var chart = new google.charts.Line(document.getElementById('pcm_chart_2'));
        chart.draw(data, options);

      });

      // }else{
      //   toastr['warning']('Please Check Start and End Months selected !', 'Month Selection Error !');
      // }

    }

   // fetch_chart_data('member',1);

   $(".chart_filters").on("change", function() {
    fetch_chart_data();
  });

   $('#chart_filter_start_month,#chart_filter_end_month').datepicker({
    format: "MM yyyy",
    viewMode: "months", 
    minViewMode: "months"
  });

</script>