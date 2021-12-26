

<script type="text/javascript">


  $('#locality_add_sales_man,#locality_edit_sales_man').select2({
    minimumResultsForSearch: 0
  })

  function GetManager() { return $('#table_filter_manager').val();}
  function GetLocality() { return $('#table_filter_locality').val();}


  var students_view_table = $('#students_view_table').DataTable({

  //  "ajax":{
  //   url :"<?= base_url().'sales_men/select_sales_men' ?>",
  //   type: "post",
  //   data: function(d){
  //     d.location = GetLocality();
  //     <?php if($page=='manager_profile') { ?>
  //       d.manager = <?= $manager_data->manager_id ?>
  //     <?php } else { ?>
  //       d.manager = GetManager();
  //     <?php } ?>

      


  //   }
  // },

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
          '<img src="<?= base_url() ?>assets/media/logos/company_logo.png" style="position:absolute; top:50%; left:40%;opacity:0.4;"  />'
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
      targets:[]
    },{
      className: 'noExport',
      targets: []
    }
    ]

  });

  $(".table_filters").on("change", function() {
    sales_men_view_table.ajax.reload();
  });



  $('body').on('click', '#sales_man_edit_btn', function() {
    var row = $(this).closest('tr').children('td');
    console.log(row);
    $('#name_edit').val(row.eq(1).text());
    $('#location_edit').val(row.eq(3).text());
    $('#email_edit').val(row.eq(4).text());
    $('#contact_edit').val(row.eq(5).text());
    $('#manager_edit').val(row.eq(10).text()).trigger('change');
    $('#address_edit').val(row.eq(11).text());
    $('#sales_man_id_edit').val(row.eq(8).text());
    $('#user_id_edit').val(row.eq(9).text());
    $('#ta_edit').val(row.eq(12).text());
    $('#da_edit').val(row.eq(13).text());
    $('#locality_edit_sales_man').val(row.eq(14).text().split(',')).trigger('change');


  });

  $('body').on('click', '#sales_man_delete_btn', function() {
    var row = $(this).closest('tr').children('td');
    $('#sales_man_id_delete').val(row.eq(8).text());
    $('#user_id_delete').val(row.eq(9).text());
  });

  // $('body').on('click', '#copy_login_btn', function() {
  //   var row = $(this).closest('tr').children('td');
  //   var copyText = row.eq(15);
  // });

  $('body').on('click', '#copy_login_btn', function() {
    var row = $(this).closest('tr').children('td');
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(row.eq(15).text()).select();
    document.execCommand("copy");
    $temp.remove();
    toastr['info']('Login Details Copied to Clipboard !<br>Use Ctrl+V to Paste');
  });



</script>