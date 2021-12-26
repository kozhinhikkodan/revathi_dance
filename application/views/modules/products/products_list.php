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
            <h3 class="card-label text-white">List of Products </h3>
          </div>
          <div class="card-toolbar">

            <!--begin::Button-->
            <a data-toggle="modal" data-target="#product_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
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
              </span>Add New Product</a>
              <!--end::Button-->

            </div>
          </div>
          <div class="card-body card-body-custom">

            <div class="row">

              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-group ">
                  <label for="expense_head">Product Category</label>
                  <select required style="width: 100%" class="form-control select-2 table_filters" id="table_filter_category">
                    <option selected value="all">Select All</option>
                    <?php foreach ($product_categories as $key => $value) { ?>
                      <option><?= $value->category_name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div> 

            </div>

            <!--begin: Datatable-->
            <table class="table table-bordered table-tripped table-hover table-checkable" id="products_view_table">
              <thead>
                <tr>

                  <th width="5%">SL</th>
                  <th width="5%">Category</th>
                  <th width="20%">Name</th>
                  <th width="50%">Image</th>
                  <th width="10%">Created On</th>
                  <th width="5%">Actions</th>
                  <th class="d-none">id</th>
                  <th class="d-none">file</th>
                  <th class="d-none">cat_name</th>
                  <th class="d-none">status</th>

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

  <?php $this->load->view('include_modals/products_modals') ?>

  <script type="text/javascript">
    $('.menu-item-active').removeClass('menu-item-active');
    $('#products_menu').addClass('menu-item-active');
  </script>


  <script type="text/javascript">

   function GetCategory() { return $('#table_filter_category').val();}

   var products_view_table = $('#products_view_table').DataTable({

     "ajax":{
      url :"<?= base_url().'products/select_products' ?>",
      type: "post",
      data: function(d){
        d.category = GetCategory();
      }
    },

    // serverSide: true,
    responsive: true,
    // searchDelay: 500,
    // processing: true,
    // scrollX:true,
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
      targets: [],

    },
    {
      className:'d-none noExport',
      targets:[<?php if($this->session->userdata('user_role')=='sales_man') { echo "5"; }?>,6,7,8,9]
    }
    ]

  });

   $(".table_filters").on("change", function() {
    products_view_table.ajax.reload();
  });



   $('body').on('click', '#product_edit_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#product_id_edit').val(row.eq(6).text());
    $('#name_edit').val(row.eq(2).text());
    $('#category_edit').val(row.eq(8).text()).trigger('change');
    $('[name=product_status_radio][value="'+row.eq(9).text()+'"]').prop('checked',true);
  });

   $('body').on('click', '#product_delete_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#product_id_delete').val(row.eq(6).text());
    $('#product_file_name_delete').val(row.eq(7).text());
  });

</script>