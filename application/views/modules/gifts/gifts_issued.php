<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

  <!--begin::Entry-->
  <div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
      <!--begin::Dashboard-->

      <!--begin::Card-->
      <div class="card card-custom">
        <div class="card-header bg-primary">
          <div class="card-title">
            <span class="card-icon">

            </span>
            <h3 class="card-label text-white">List of Issued Gifts</h3>
          </div>
          <div class="card-toolbar">

            <?php if($this->session->userdata('user_role')=='master_admin') { ?>

              <!--begin::Button-->
              <a data-toggle="modal" data-target="#gift_issue_modal" class="btn btn-pill btn-dark font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24"/>
                      <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                      <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
                    </g>
                  </svg>
                  <!--end::Svg Icon-->
                </span>Issue New Gift</a>
                <!--end::Button-->

              <?php } ?>

            </div>
          </div>
          <div class="card-body card-body-custom">


            <div class="row">

              <?php if($this->session->userdata('user_role')!='sales_man') { ?>

                <div class="col-lg-3 col-md-3 col-sm-12">
                  <div class="form-group ">
                    <label for="expense_head">Sales Man</label>
                    <select required style="width: 100%" class="form-control select-2 table_filters" id="table_filter_sales_man">
                      <option selected value="all">Select All</option>
                      <?php foreach ($sales_men as $key => $value) { ?>
                        <option value="<?= $value->sales_man_id ?>"><?= $value->sales_man_name.' - '.$value->manager_name ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div> 

              <?php } ?>

              <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="form-group ">
                  <label for="expense_head">Gift</label>
                  <select required style="width: 100%" class="form-control select-2 table_filters" id="table_filter_gift">
                    <option selected value="all">Select All</option>
                    <?php foreach ($gifts2 as $key => $value) { ?>
                      <option value="<?= $value->gift_id ?>"><?= $value->gift_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> 

              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group">
                  <label>Delivery Status</label>
                  <div class="radio-inline">
                    <label class="radio radio-primary">
                      <input type="radio" value="all" name="table_filter_status" class="table_filters" checked/>
                      <span></span>
                      All
                    </label>
                    <label class="radio radio-warning">
                      <input type="radio" value="2" name="table_filter_status" class="table_filters" />
                      <span></span> 
                      Pending
                    </label>
                    <label class="radio radio-success">
                      <input type="radio" value="1" name="table_filter_status" class="table_filters" />
                      <span></span> 
                      Delivered
                    </label>
                    <label class="radio radio-danger">
                      <input type="radio" value="0" name="table_filter_status" class="table_filters" />
                      <span></span>
                      Not Delivered
                    </label>
                  </div>
                </div> 
              </div> 

              <div class="col-lg-2 col-md-2 col-sm-12">
                <div class="form-group">
                  <label>Due Status</label>
                  <div class="radio-inline">
                    <label class="radio radio-primary">
                      <input type="radio" value="all" name="table_filter_due_status" class="table_filters" checked/>
                      <span></span>
                      All
                    </label>
                    <label class="radio radio-danger">
                      <input type="radio" value="1" name="table_filter_due_status" class="table_filters" />
                      <span></span> 
                      Due
                    </label>
                    <label class="radio radio-primary">
                      <input type="radio" value="0" name="table_filter_due_status" class="table_filters" />
                      <span></span> 
                      No Due
                    </label>
                   
                  </div>
                </div> 
              </div> 

            </div>


            <!--begin: Datatable-->
            <table class="table table-header-fixed table-striped table-bordered table-hover table-header-fixed dataTable no-footer" id="gifts_issued_view_table">
              <thead>
                <tr>

                  <th width="5%">SL</th>
                  <th width="30%">Gift Name</th>
                  <th width="30%">Quantities</th>
                  <th width="30%">Status</th>
                  <th width="30%">Sales Man</th>
                  <th width="30%">Remarks</th>
                  <th width="10%">Created On</th>
                  <th width="5%">Actions</th>
                  <th class="d-none">id</th>
                  <th class="d-none">sales_man_id</th>
                  <th class="d-none">gift_id</th>
                  <th class="d-none">qty</th>
                  <th class="d-none">due_date</th>
                </tr>

              </thead>

            </table>


            <!--end: Datatable-->
          </div>
        </div>
        <!--end::Card-->



      </div>
    </div>
  </div>
  <!--end::Content-->

  <?php $this->load->view('include_modals/gifts_issue_modals') ?>

  <script type="text/javascript">
    $('.menu-item-active').removeClass('menu-item-active');

    $('#gifts_menu').addClass('menu-item-open menu-item-here');
    $('#gifts_menu_1').addClass('menu-item-active');
  </script>


  <script type="text/javascript">

    fetch_pending_gifts('#gift_issue_add');

    function fetch_pending_gifts(target) {
      $.post("<?= base_url() ?>gifts/fetch_pending_gifts",function(data) {
        var obj = $.parseJSON(data);
        $(target).html('');
        var gifts = '<option selected disabled>Select Gift</option>';
        $.each(obj, function(index, value) {
          gifts += '<option data-balance="'+value.balance_quantity+'" value="'+value.gift_id+'">'+value.gift_name+'</option>';
        });
        $(target).html(gifts);
      });
    }

    $('body').on('change', '#gift_issue_add', function() {
      var balance = $('#gift_issue_add :selected').data('balance');
      console.log(balance);
      $('#gift_issue_qty_add').attr('max',balance);
      $('#gift_issue_qty_add_info').html('Balance : '+balance);
    });


    fetch_pending_gifts('#gift_issue_edit',0);


    function GetSalesman() { return $('#table_filter_sales_man').val();}
    function GetGift() { return $('#table_filter_gift').val();}
    function GetStatus() { return $('[name=table_filter_status]:checked').val();}
    function GetDueStatus() { return $('[name=table_filter_due_status]:checked').val();}


    var gifts_issued_view_table = $('#gifts_issued_view_table').DataTable({

     "ajax":{
      url :"<?= base_url().'gifts/select_gifts_issued' ?>",
      type: "post",
      data: function(d){

        d.status = GetStatus();
        d.due_status = GetDueStatus();

        d.gift = GetGift();

        <?php if($this->session->userdata('user_role')!='sales_man'){ ?>
          d.sales_man = GetSalesman();
        <?php }else{ ?>
          d.sales_man = '<?= $this->session->userdata('sales_man_data')->sales_man_id ?>';
        <?php } ?> 
      }
    },

    // serverSide: true,
    // responsive: true,
    // searchDelay: 500,
    // processing: true,
    scrollX:true,
    dom: 'Bfrtip',
    // buttons: [
    // 'csv', 'excel', 'pdf', 'print'
    // ],
    buttons:[
    {
      extend: 'csv',
      exportOptions: {
        columns: [ "thead th:not(.noExport)" ]
      }
    }
    ,{
      extend: 'excel',
      exportOptions: {
        columns: [ "thead th:not(.noExport)" ]
      }
    },
    {
      extend: 'pdf',
      exportOptions: {
        columns: [ "thead th:not(.noExport)" ]
      }
    },
    {
      extend: 'print',
      exportOptions: {
        columns: [ "thead th:not(.noExport)" ]
      },
      title: '<?= ucfirst(str_replace('_', ' ', $page)) ?>',
      customize: function ( win ) {
        $(win.document.body)
        .prepend(
          '<img src="<?= base_url() ?>assets/media/logos/company_logo.png" style="position:absolute; top:50%; left:40%;opacity:0.4;" />'
          );
      }
    }
    ],

    columnDefs: [
    { 
      orderable: false, 
      targets: [7],

    },
    {
      className:'d-none noExport',
      targets:[<?php if($this->session->userdata('user_role')=='sales_man'){  ?>4,<?php } ?>8,9,10,11,12]
    },{
      className:'noExport',
      targets:[7]
    }
    ]

  });

    $(".table_filters").on("change", function() {
      gifts_issued_view_table.ajax.reload();
    });



    $('body').on('click', '#gift_issue_update_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#issue_id_edit').val(row.eq(8).text());
      $('#gift_id_edit_issue').val(row.eq(10).text());

      $('#remarks_issue_edit').val(row.eq(5).text());
      $('#gift_qty_issue_edit').val(row.eq(11).text());
      $('#sales_man_issue_edit').val(row.eq(9).text()).trigger('change');

      $('#gift_due_date_edit').val(row.eq(12).text());

      $('#gift_issue_edit').val(row.eq(1).text());
      var qty =  parseFloat(row.eq(11).text());
      $('#gift_qty_issue_edit').attr('max',qty);
      $('#gift_qty_issue_edit_info').html('Balance : '+qty);
    });

    $('body').on('click', '#gift_issue_delete_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#issue_id_delete').val(row.eq(8).text());
      $('#gift_id_delete_issue').val(row.eq(10).text());
    });

    $('body').on('click', '#gift_issue_receive_btn', function() {
      var row = $(this).closest('tr').children('td');
      $('#issue_id_receive').val(row.eq(8).text());
    });





  </script>