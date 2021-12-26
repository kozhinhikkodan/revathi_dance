<style type="text/css">
  @media print {

    .no-print,
    .no-print * {
      display: none !important;
    }
  }

  .invoice-logo {
    width: 16%;
    position: absolute;
    top: 16%;
    left: 0;
  }

  .watermark-logo {
    position: absolute;
    top: 30%;
    left: 30%;
    opacity: 0.16;
    width: 30%;
    z-index: 9999;
  }

  .invoice-seal {
    width: 48%;
    transform: rotate(-29deg);
  }
</style>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <!--begin::Container-->
      <div class="container">
        <!-- begin::Card-->
        <div class="card card-custom overflow-hidden">
          <div class="card-body p-0">

          <img src="<?= base_url()?>assets/media/logos/<?= config_item('company_logo') ?>" class="watermark-logo ml-5">



            <!-- begin: Invoice-->
            <!-- begin: Invoice header-->
            <div class="row justify-content-center py-8 px-8 px-md-0">
              <div class="col-md-9">
                <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">

                  <h1 class="display-4 font-weight-boldest mb-10">Receipt</h1>


                  <div class="d-flex flex-column align-items-md-end px-0">

                    <h3><?= config_item('company_name') ?></h3>
                    <!--end::Logo-->
                    <span class="d-flex flex-column align-items-md-end opacity-70 text-right">
                      <?= nl2br(config_item('company_address')) ?><br>
                      <?php if (config_item('company_gstin') != '') { ?>
                      <?php echo 'GSTIN : ' . config_item('company_gstin') ?><br>
                      <?php } ?>

                      <?= config_item('company_phone') ?><br>
                      <?= config_item('company_email') ?>
                      <?php if (config_item('company_website') != '') {
                        echo ', ' . config_item('company_website');
                      } ?>
                    </span>
                    <img src="<?= base_url() ?>assets/media/logos/<?= config_item('company_logo') ?>" class="invoice-logo ml-5">

                  </div>

                </div>
                <div class="border-bottom w-100"></div>
                <div class="row d-flex justify-content-between pt-6">
                  <div class="d-flex flex-column flex-root">
                    <span class="font-weight-bolder mb-2 text-uppercase">BILLED TO</span>
                    <span class="opacity-70">Salih</span>
                    <span class="opacity-70">Admission No : AD0019</span>

                  </div>
                  <div class="d-flex flex-column flex-root text-center">
                    <span class="font-weight-bolder mb-2 text-center text-uppercase">Receipt NO</span>
                    <span class="opacity-70 text-center">REC002001</span>
                  </div>


                  <div class="d-flex flex-column flex-root mr-0 text-right">
                    <span class="font-weight-bolder mb-2 text-right text-uppercase">Receipt DATE</span>
                    <span class="opacity-70 text-right"><?= date('d F Y') ?></span>

                  </div>
                </div>
              </div>
            </div>
            <!-- end: Invoice header-->
            <!-- begin: Invoice body-->
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
              <div class="col-md-9">
                <label class="h5 pl-0 font-weight-bold text-dark text-uppercase">Particluars</label>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="pl-0 font-weight-bold text-dark text-uppercase text-left">SL</th>
                        <th class="pl-0 font-weight-bold text-dark text-uppercase text-left">Description</th>
                        <th class="pl-0 font-weight-bold text-dark text-uppercase text-right">Amount</th>
                      </tr>
                    </thead>
                    <tbody>


                      <tr class="font-weight-boldest">
                        <td class="pl-0 pt-7 text-left">1</td>
                        <td class="pl-0 pt-7 text-left">
                          Course Fee
                        </td>

                        <td class="pl-0 pt-7 text-right">120</td>

                      </tr>


                      <tr class="font-weight-boldest border-bottom-0"></tr>




                      <tr class="font-weight-boldest">
                        <td colspan="2" class="pl-0 pt-7 text-left text-primary">Total </td>
                        <td class="pl-0 pt-7 text-right text-primary">120</td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- end: Invoice body-->
            <!-- begin: Invoice footer-->
            <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
              <div class="col-md-9">
                <div class="table-responsive">

                  <br>
                  <table class="table">

                    <thead>
                      <tr>
                        <th class="font-weight-bold text-dark text-uppercase">Remarks</th>
                        <th class="font-weight-bold text-dark text-uppercase text-right">Paid Amount</th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr class="font-weight-bolder">
                        <td>paid via phonepe</td>
                        <td class="text-danger font-size-h3 font-weight-boldest text-right">120</td>


                        </td>
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
            <!-- end: Invoice footer-->
            <!-- begin: Invoice action-->
            <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 no-print">
              <div class="col-md-9">

                <div class="d-flex justify-content-between float-right">


                  <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();"><i class="flaticon2 flaticon2-printer"> </i> Print Receipt</button>


                </div>
              </div>
            </div>
            <!-- end: Invoice action-->
            <!-- end: Invoice-->
          </div>
        </div>
        <!-- end::Card-->
      </div>
      <!--end::Container-->

    </div>
  </div>
</div>
<!--end::Content-->


<script>
  $('.menu-item-active').removeClass('menu-item-active');
  $('#purchase_orders_menu').addClass('menu-item-active');

  $('#payable_amount i').removeClass('text-dark');
  $('#payable_amount i').addClass('font-size-h3 font-weight-boldest text-danger');

  $('#kt_body').addClass('print-content-only');
  $('#kt_body').addClass('aside-minimize');

  $('#start_date,#end_date').datepicker({
    format: 'dd-mm-yyyy'
  });

  $('#patient_gender_add,#patient_gender_add').select2({
    placeholder: 'Select Gender'
  });


  window.print();

  // $('title').html('');
</script>