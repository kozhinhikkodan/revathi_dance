
<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
	<!--begin::Container-->
	<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
		<!--begin::Copyright-->
		<div class="text-dark order-2 order-md-1">
			<span class="text-muted font-weight-bold mr-2"><?= date('Y') ?> &copy; </span>
			<a href="<?= base_url() ?>" class="text-dark-75 text-hover-primary"><?= config_item('company_name') ?></a>
		</div>
		<!--end::Copyright-->
		<!--begin::Nav-->
		<div class="nav nav-dark">
			<!-- <a href="#" target="_blank" class="nav-link pl-0 pr-5">About</a>
			<a href="#" target="_blank" class="nav-link pl-0 pr-5">Team</a>
			<a href="#" target="_blank" class="nav-link pl-0 pr-0">Contact</a> -->
		</div>
		<!--end::Nav-->
	</div>
	<!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Main-->

<style type="text/css">
	.error{
		color: #F64E60 !important;
	}
	.form-control[readonly]{
		background-color: #f1f1f1 ;
	}
</style>

<script type="text/javascript">
	$("#notifications_div").load("<?php echo base_url()?>notifications");

	$('body').on('click', '.form_submit_demo', function(e) {
		e.preventDefault();
		var msg = $(this).attr('data-msg');

		var form = $(this).closest('form');
		var modal_id = form.data('modal-id');
		$('#'+modal_id).modal('toggle');

		toastr.success(msg);
});


// Delete swal demo
$('body').on('click', '.delete_swal_demo', function(e) {

	Swal.fire({
  title: 'Are you sure?',
  showDenyButton: true,
  showCancelButton: false,
  confirmButtonText: 'Confirm & Delete',
  denyButtonText: `Don't Delete`,
  color: '#716add',

}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('Deleted !', '', 'success')
  } else if (result.isDenied) {
    Swal.fire(' Not Deleted', '', 'info')
  }
})

});

</script>

<?php $this->view("include_scripts/form_submit_scripts"); ?>

