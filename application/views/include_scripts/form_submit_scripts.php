 
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.js"></script>
<script type="text/javascript">

	$('.form_submit').click(function(e) {
		e.preventDefault();
		var btn = $(this);
		var form = $(this).closest('form');
		var action = form.attr('action');
		var form_id = form.attr('id');
		var form_location = form.data('form-location');

		form.validate({
			rules: {
			}
		});

		if (!form.valid()) {

			var scroll_to = '.modal';

			if(form_location=='body'){
				var scroll_to = 'html';
			}

			$(scroll_to).animate({
				scrollTop: $('.'+form_id+'_alert').offset().top
			}, 'slow');

			$('.'+form_id+'_alert').removeClass('d-none');

			return false; 

		}else{
			$('.'+form_id+'_alert').addClass('d-none');
		}

		var btn_text = btn.html();
		btn.html('<span class="spinner ml-3"></span>'+btn_text);

		btn.attr('disabled', true);

			// var modal_id = form.data('modal-id');
			// $('#'+modal_id).modal('toggle');

			// swal.fire({
			// 	icon: "success",
			// 	allowOutsideClick: true,
			// 	closeOnEsc: true,
			// 	showConfirmButton: false,
			// 	showCancelButton: true,
			// 	confirmButtonText: 'OK',
			// 	confirmButtonColor: "#000",
			// 	cancelButtonText: 'Close',
			// 	cancelButtonColor: "#3699FF",

			// 	title: "Success !",

			// })

			form.ajaxSubmit({
				url: action,
				success: function(response, status, xhr, $form) {

					setTimeout(function() {

						var obj = $.parseJSON(response);

						btn.attr("disabled", false);
						btn.html(btn_text);
						$('.form_'+form_id+'_alert').hide();

						if(obj.status==1){

							var modal_id = form.data('modal-id');
							var form_type = form.data('form-type');

							console.log(form_type);

							$('#'+modal_id).modal('toggle');
							$('.'+form_id+'_fields').val('');
							$('.'+form_id+'_select').val('').trigger('change');
							$('.'+form_id+'_textarea').html('');

							if(obj.swal!=1){

								switch(form_type){

									case 'locality': 
									localities_view_table.ajax.reload(); 
									break;

									case 'doctor': 
									doctors_view_table.ajax.reload(); 
									break;

									case 'manager': 
									managers_view_table.ajax.reload(); 
									break;

									case 'sales_man': 
									sales_men_view_table.ajax.reload(); 
									break;

									case 'product': 
									products_view_table.ajax.reload(); 
									break;

									case 'manager_work_log':
									managers_work_logs_view_table.ajax.reload(); 
									break;

									case 'work_log':
									work_logs_view_table.ajax.reload(); 
									break;

									case 'survey':
									surveys_view_table.ajax.reload(); 
									break;

									case 'leave':
									leaves_view_table.ajax.reload(); 
									break;

									case 'expense':
									expenses_view_table.ajax.reload(); 
									break;

									case 'product_category':
									product_categories_view_table.ajax.reload(); 
									break;

									case 'gifts':
									gifts_view_table.ajax.reload(); 
									break;

									case 'events':
									events_view_table.ajax.reload(); 
									break;

									case 'gifts_issued':
									gifts_issued_view_table.ajax.reload(); 
									fetch_pending_gifts('#gift_issue_add');
									
									break;

									case 'gifts_delivered':
									gifts_delivered_view_table.ajax.reload();
									fetch_pending_issued_gifts('#gift_delivery_add');
									break;
									

									case 'samples':
									samples_view_table.ajax.reload(); 
									break;
									
									case 'samples_issued':
									samples_issued_view_table.ajax.reload(); 
									fetch_pending_samples('#sample_issue_add');
									
									break;

									case 'samples_delivered':
									samples_delivered_view_table.ajax.reload();
									fetch_pending_issued_samples('#sample_delivery_add');
									break;

									case 'tour_plan': 
									load_calendar();
									break;

									case 'qualification':
									qualifications_view_table.ajax.reload();
									break;

									case 'speciality':
									specialities_view_table.ajax.reload();
									break;

									case 'unit_update': 
									setTimeout(
										function() 
										{
											location.reload(true);
										}, 1500);

									case 'password': 
									setTimeout(
										function() 
										{
											window.location.replace("<?= base_url() ?>login/logout");
										}, 3000);
								}

								if('<?= $page ?>'=='hospital_profile' || '<?= $page ?>'=='donor_profile'){
									fetch_summary_info();
								}

								toastr[obj.flashdata_type](obj.flashdata_msg, obj.flashdata_title);

							}else{

								var html = '';

								$.each(obj.swal_item, function(index, value) {
									html += '<a class="btn '+value.button_class+' m-1" href="'+value.redirect+'">'+value.button_text+'</a><br>';
								});

							// if(obj.redirect && obj.redirect2){
							// 	var html = '<a class="btn btn-success m-1" href="'+obj.redirect+'">'+obj.button_text+'</a><br><a class="btn btn-primary" href="'+obj.redirect2+'">'+obj.button_text2+'</a><br>';
							// }else{
							// 	if(obj.redirect){
							// 		var html = '<a class="btn btn-success m-1" href="'+obj.redirect+'">'+obj.button_text+'</a><br>';
							// 	}else{
							// 		var html = '';
							// 	}
							// }

							swal.fire({
								html: html,
								icon: "success",
								allowOutsideClick: false,
								closeOnEsc: false,
								showConfirmButton: false,
								showCancelButton: false,
								confirmButtonText: obj.button_text,
								confirmButtonColor: "#000",

								title: "Success !",

							})

						} 
					}else{
						toastr[obj.flashdata_type](obj.flashdata_msg, obj.flashdata_title);
					}
                    // showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
                }, 2000);

}
});
});
</script>

