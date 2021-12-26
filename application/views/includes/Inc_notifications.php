		
<!--begin::Quick Panel-->
<div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
	<!--begin::Header-->
	<div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
		<ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-danger flex-grow-1 px-10" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_missed_calls">Missed Calls</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#kt_quick_panel_birthdays">Birth Days</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#kt_quick_panel_weddingdays">Wedding Days</a>
			</li>

		</ul>
		<div class="offcanvas-close mt-n1 pr-5">
			<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
				<i class="ki ki-close icon-xs text-muted"></i>
			</a>
		</div>
	</div>
	<!--end::Header-->
	<!--begin::Content-->
	<div class="offcanvas-content px-10">
		<div class="tab-content">

			<!--begin::Tabpane-->
			<div class="tab-pane fade show pt-3 pr-5 mr-n5 active" id="kt_quick_panel_missed_calls" role="tabpanel">
				<!--begin::Section-->
				<div class="mb-15">
					<h5 class="font-weight-bold mb-5">Missed Calls</h5>

					<?php foreach (config_item('missed_calls') as $key => $value) { 

						//print_r($value);

						?>

						<!--begin: Item-->
						<div class="d-flex align-items-center flex-wrap mb-5">
							<a href="<?= base_url() ?>doctor/<?= $value['doctor']->doctor_id ?>">
								<div class="symbol symbol-50 symbol-light mr-5">
									<span class="symbol-label">
										<img src="<?= base_url() ?>assets/media/users/default.jpg" class="h-50 align-self-center" alt="" />
									</span>
								</div>
							</a>
							<div class="d-flex flex-column flex-grow-1 mr-2">
								<a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1"><?= substr($value['doctor']->name,0,15) ?></a>
								<span class="text-muted font-weight-bold"><?= $value['doctor']->hospital ?></span>
							</div>
							<span class="btn btn-sm btn-light font-weight-bolder py-1 my-lg-0 my-2 text-dark-50"><?= $value['count'] ?> Visited / <?= $value['frequency'] ?> </span>
						</div>
						<!--end: Item-->

					<?php } ?>

				</div>
				<!--end::Section-->
				
			</div>
			<!--end::Tabpane-->

			<!--begin::Tabpane-->
			<div class="tab-pane fade show pt-3 pr-5 mr-n5" id="kt_quick_panel_birthdays" role="tabpanel">
				<!--begin::Section-->
				<div class="mb-15">
					<h5 class="font-weight-bold mb-5">Birth Days Today</h5>

					<?php foreach (config_item('birthdays') as $key => $value) { 
						$dob_split = explode('-', $value->dob);
						if($dob_split[1]==date('m') &&  $dob_split[2]==date('d') ) {
							?>

							<!--begin: Item-->
							<div class="d-flex align-items-center flex-wrap mb-5">
								<a href="<?= base_url() ?>doctor/<?= $value->doctor_id ?>">
									<div class="symbol symbol-50 symbol-light mr-5">
										<span class="symbol-label">
											<img src="<?= base_url() ?>assets/media/users/default.jpg" class="h-50 align-self-center" alt="" />
										</span>
									</div>
								</a>
								<div class="d-flex flex-column flex-grow-1 mr-2">
									<a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1"><?= substr($value['doctor']->name,0,15) ?></a>
									<span class="text-muted font-weight-bold"><?= $value->hospital ?></span>
								</div>
								<!-- <span class="btn btn-sm btn-light font-weight-bolder py-1 my-lg-0 my-2 text-dark-50">+82$</span> -->
							</div>
							<!--end: Item-->

						<?php } } ?>

					</div>
					<!--end::Section-->
					<!--begin::Section-->
					<div class="mb-5">
						<h5 class="font-weight-bold mb-5">Coming Birth Days in This Month</h5>

						<?php foreach (config_item('birthdays') as $key => $value) { 
							$dob_split = explode('-', $value->dob);
							if($dob_split[1]==date('m') &&  $dob_split[2]>date('d') ) {

								?>

								<!--begin: Item-->
								<div class="d-flex align-items-center flex-wrap mb-5">
									<a href="<?= base_url() ?>doctor/<?= $value->doctor_id ?>">
										<div class="symbol symbol-50 symbol-light mr-5">
											<span class="symbol-label">
												<img src="<?= base_url() ?>assets/media/users/default.jpg" class="h-50 align-self-center" alt="" />
											</span>
										</div>
									</a>
									<div class="d-flex flex-column flex-grow-1 mr-2">
										<a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1"><?= substr($value['doctor']->name,0,15) ?></a>
										<span class="text-muted font-weight-bold"><?= $value->hospital ?></span>
									</div>
									<span class="btn btn-sm btn-light font-weight-bolder py-1 my-lg-0 my-2 text-dark-50"><?= date('d M',strtotime($value->dob)) ?></span>
								</div>
								<!--end: Item-->

							<?php } } ?>


						</div>
						<!--end::Section-->
					</div>
					<!--end::Tabpane-->

					<!--begin::Tabpane-->
					<div class="tab-pane fade show pt-3 pr-5 mr-n5 " id="kt_quick_panel_weddingdays" role="tabpanel">
						<!--begin::Section-->
						<div class="mb-15">
							<h5 class="font-weight-bold mb-5">Wedding Days Today</h5>
							
							<?php foreach (config_item('wedding_days') as $key => $value) { 
								$dob_split = explode('-', $value->wedding_date);
								if($dob_split[1]==date('m') &&  $dob_split[2]==date('d') ) {

									?>

									<!--begin: Item-->
									<div class="d-flex align-items-center flex-wrap mb-5">
										<a href="<?= base_url() ?>doctor/<?= $value->doctor_id ?>">
											<div class="symbol symbol-50 symbol-light mr-5">
												<span class="symbol-label">
													<img src="<?= base_url() ?>assets/media/users/default.jpg" class="h-50 align-self-center" alt="" />
												</span>
											</div>
										</a>
										<div class="d-flex flex-column flex-grow-1 mr-2">
											<a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1"><?= substr($value['doctor']->name,0,15) ?></a>
											<span class="text-muted font-weight-bold"><?= $value->hospital ?></span>
										</div>
										<!-- <span class="btn btn-sm btn-light font-weight-bolder py-1 my-lg-0 my-2 text-dark-50">+82$</span> -->
									</div>
									<!--end: Item-->

							<?php } } ?>

							</div>
							<!--end::Section-->
							<!--begin::Section-->
							<div class="mb-5">
								<h5 class="font-weight-bold mb-5">Coming Wedding Days in This Month</h5>

								<?php  foreach (config_item('wedding_days') as $key => $value) { 
									$dob_split = explode('-', $value->wedding_date);
									if($dob_split[1]==date('m') &&  $dob_split[2]>date('d') ) {

										?>

										<!--begin: Item-->
										<div class="d-flex align-items-center flex-wrap mb-5">
											<a href="<?= base_url() ?>doctor/<?= $value->doctor_id ?>">
												<div class="symbol symbol-50 symbol-light mr-5">
													<span class="symbol-label">
														<img src="<?= base_url() ?>assets/media/users/default.jpg" class="h-50 align-self-center" alt="" />
													</span>
												</div>
											</a>
											<div class="d-flex flex-column flex-grow-1 mr-2">
												<a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1"><?= $value->full_name ?></a>
												<span class="text-muted font-weight-bold"><?= $value->hospital ?></span>
											</div>
											<span class="btn btn-sm btn-light font-weight-bolder py-1 my-lg-0 my-2 text-dark-50"><?= date('d M',strtotime($value->wedding_date)) ?></span>
										</div>
										<!--end: Item-->

							<?php } } ?>


								</div>
								<!--end::Section-->
							</div>
							<!--end::Tabpane-->

							<!--begin::Tabpane-->
							<div class="tab-pane fade pt-2 pr-5 mr-n5" id="kt_quick_panel_notifications" role="tabpanel">
								<!--begin::Nav-->
								<div class="navi navi-icon-circle navi-spacer-x-0">
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon-bell text-success icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">5 new user generated report</div>
												<div class="text-muted">Reports based on sales</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon2-box text-danger icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">2 new items submited</div>
												<div class="text-muted">by Grog John</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon-psd text-primary icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">79 PSD files generated</div>
												<div class="text-muted">Reports based on sales</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon2-supermarket text-warning icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">$2900 worth producucts sold</div>
												<div class="text-muted">Total 234 items</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon-paper-plane-1 text-success icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">4.5h-avarage response time</div>
												<div class="text-muted">Fostest is Barry</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon-safe-shield-protection text-danger icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">3 Defence alerts</div>
												<div class="text-muted">40% less alerts thar last week</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon-notepad text-primary icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">Avarage 4 blog posts per author</div>
												<div class="text-muted">Most posted 12 time</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon-users-1 text-warning icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">16 authors joined last week</div>
												<div class="text-muted">9 photodrapehrs, 7 designer</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon2-box text-info icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">2 new items have been submited</div>
												<div class="text-muted">by Grog John</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon2-download text-success icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">2.8 GB-total downloads size</div>
												<div class="text-muted">Mostly PSD end AL concepts</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon2-supermarket text-danger icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">$2900 worth producucts sold</div>
												<div class="text-muted">Total 234 items</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon-bell text-primary icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">7 new user generated report</div>
												<div class="text-muted">Reports based on sales</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
									<!--begin::Item-->
									<a href="#" class="navi-item">
										<div class="navi-link rounded">
											<div class="symbol symbol-50 mr-3">
												<div class="symbol-label">
													<i class="flaticon-paper-plane-1 text-success icon-lg"></i>
												</div>
											</div>
											<div class="navi-text">
												<div class="font-weight-bold font-size-lg">4.5h-avarage response time</div>
												<div class="text-muted">Fostest is Barry</div>
											</div>
										</div>
									</a>
									<!--end::Item-->
								</div>
								<!--end::Nav-->
							</div>
							<!--end::Tabpane-->

						</div>
					</div>
					<!--end::Content-->
				</div>
				<!--end::Quick Panel-->
