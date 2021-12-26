
<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head><base href="">
	<meta charset="utf-8" />
	<title><?= config_item('app_name') ?></title>
	<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="https://keenthemes.com/metronic" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<meta name="theme-color" content="#ed0838">
	
	<!--end::Fonts-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<!-- <link href="<?= base_url() ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" /> -->
	<!--end::Page Vendors Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="<?= base_url() ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="<?= base_url() ?>assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
	<!--end::Layout Themes-->
	<!-- <link rel="shortcut icon" href="<?= base_url()?>assets/media/logos/bloodbank20.ico" /> -->

	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="<?= base_url() ?>assets/plugins/global/plugins.bundle.js"></script>
	<script src="<?= base_url() ?>assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
	<script src="<?= base_url() ?>assets/js/scripts.bundle.js"></script>
	<!--end::Global Theme Bundle-->

	<!-- begin::DataTable -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/sc-2.0.1/sp-1.0.1/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/sc-2.0.1/sp-1.0.1/datatables.min.css"/>

	<!-- end::DataTable -->

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> -->


	<script src="<?= base_url() ?>assets/js/pages/widgets.js"></script>

	<script src="<?= base_url() ?>assets/js/pages/crud/forms/widgets/bootstrap-switch.js?v=7.1.8"></script>

	<script src="<?= base_url() ?>assets/plugins/custom/kanban/kanban.bundle.js?v=7.2.8"></script>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/css/jquery.fancybox.min.css" integrity="sha512-3IQL+PcFRQuSVCbyYeiT3jtO7Hwes+JU2JO0SlEBKwfyYr/aGRqLk72UTolR0opyvnDAiOTnG7u2Jyl5bri9tQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.7/js/jquery.fancybox.min.js" integrity="sha512-ycg6GpWTcSok9ORtPFQNzbLzRoOGd2fjmFZ5UI5hY2Vvc3bPrI7c4hC5tH4w44wCp3K9MPFJbDWTXz3VYUeInQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>

	<style type="text/css">
		.dt-buttons .btn {
			background: #fff !important;
			font-size: 1em !important;
			margin-right: -2% !important;
			border-radius: 0% !important;
		}

		.dt-buttons .btn-group{
			position: absolute !important;
			top: 4% !important;
		}

		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			margin: 0; 
		}

		.form-control:disabled, .form-control[readonly] {
			background-color: #ebebeb !important;
			opacity: 1;
		}

		.form-control,.select2-selection{
			/*color: #3F4254 !important;*/
			background-color:#f7f8f9 !important;
			/*border:1px solid #F3F6F9 !important;*/
			border-radius:1.2rem !important;
		}

		.select2-selection__rendered{
			color: #b8b8c6 !important;
		}

		.btn-pill{
			border-radius:1.2rem;
		}

		.card-body-custom{
			border: 2px solid #3699ff;
			border-top: 0px;
			margin-top: -1px;
		}

		.card-body-custom-info{
			border: 2px solid #8950FC;
			border-top: 0px;
			margin-top: -1px;
		}

		.delete-light-danger {
			background-color: #FFE2E5;
			border-color: transparent;
		}

		/*.dataTables_scrollBody{
			border: 2px solid #3699ff5e !important;
		}

		.dataTables_scrollHeadInner{
			background-color: #3699ff5e !important;
		}*/

		.dataTable{
			border: 2px solid #3699ff5e !important;
		}

		.dataTable thead{
			background-color: #3699ff5e !important;
		}


	</style>

	<script type="text/javascript">

		$(function() {

			$('[data-switch=true]').bootstrapSwitch();

			$('.date-field').datepicker({
				format: 'dd-mm-yyyy'
			});

			$('.select-2').select2({
				  minimumResultsForSearch: 0
			});

			// $('.modal-dialog').draggable({
			// 	handle: ".modal-header"
			// });

		});

	</script>


</head>
<!--end::Head-->

<?php $this->load->view('includes/Inc_notifications') ?>
