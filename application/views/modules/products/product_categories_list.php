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
            <h3 class="card-label text-white">List of Product categories </h3>
          </div>
          <div class="card-toolbar">

            <!--begin::Button-->
            <a data-toggle="modal" data-target="#category_add_modal" class="btn btn-pill btn-dark font-weight-bolder">
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
              </span>Add New Category</a>
              <!--end::Button-->

            </div>
          </div>
          <div class="card-body card-body-custom">

            <div class="row">

              
            </div>

            <!--begin: Datatable-->
            <table class="table table-bordered table-tripped table-hover table-checkable" id="product_categories_view_table" >
              <thead>
                <tr>

                  <th width="5%">SL</th>
                  <th width="60%">Category Name</th>
                  <th width="12%">Actions</th>
                  <th class="d-none">id</th>

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

  <?php $this->load->view('include_modals/product_categories_modals') ?>

  <script type="text/javascript">
    $('.menu-item-active').removeClass('menu-item-active');
    $('#categories_menu').addClass('menu-item-active');
  </script>


  <script type="text/javascript">


   var product_categories_view_table = $('#product_categories_view_table').DataTable({

     "ajax":{
      url :"<?= base_url().'products/select_product_categories' ?>",
      type: "post",
      data: function(d){
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
      targets: [2],

    },
    {
      className:'d-none noExport',
      targets:[3]
    },
    {
      className:'noExport',
      targets:[2]
    }
    ]

  });



   $('body').on('click', '#product_category_edit_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#category_id_edit').val(row.eq(3).text());
    $('#name_edit').val(row.eq(1).text());
  });

   $('body').on('click', '#product_category_delete_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#category_id_delete').val(row.eq(3).text());
  });

</script>