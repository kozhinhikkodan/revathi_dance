
<style type="text/css">
  #survey_items_table tr td{
    padding-right:0.75rem !important;
    padding-left:0.75rem !important;
  }

  #survey_items_info_table tr td{
    padding-right:0.75rem !important;
    padding-left:0.75rem !important;
  }

  #survey_items_table_edit tr td{
    padding-right:0.75rem !important;
    padding-left:0.75rem !important;
  }
</style>


<script type="text/javascript">

 $('body').on('click', '#survey_info_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#locality_survey_info').val(row.eq(4).text());
  $('#doctor_survey_info').val(row.eq(3).text());
  $('#date_survey_info').val(row.eq(5).text());
  $('#sales_man_survey_info').val(row.eq(2).text());

  var items = $.parseJSON(row.eq(8).text());
  console.log(items);
  var i = 1;
  $.each(items, function(index, value) {
    var row = '<tr id="info_row_'+i+'"> <td> <div class="form-group"> <input disabled type="text" class="form-control form-control-pill form_survey_info_fields" value="'+i+'" /> </div> </td> <td> <div class="form-group"> <input disabled type="text" id="info_company_1" class="form-control form-control-pill form_survey_info_fields" value="'+value.company+'" /> </div> </td> <td> <div class="form-group"> <input disabled type="text" id="info_product_1" class="form-control form-control-pill form_survey_info_fields" value="'+value.product+'"/> </div> </td> <td> <div class="form-group"> <input disabled type="text" id="info_notes_1" class="form-control form-control-pill form_survey_info_fields" value="'+value.notes+'" /> </div> </td> </tr>';

    $('#survey_items_info_table').append(row);
    i++;
  });
});


 $('body').on('click', '#survey_edit_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#survey_id_edit').val(row.eq(7).text());

  $('#locality_survey_edit').val(row.eq(10).text()).trigger('change');
  $('#doctor_survey_edit').val(row.eq(9).text()).trigger('change');
  $('#date_survey_edit').val(row.eq(5).text()).trigger('change');

  $('#chemist_1_edit').val(row.eq(11).text());
  $('#chemist_2_edit').val(row.eq(12).text());


  var items = $.parseJSON(row.eq(8).text());
  var i = 1;

  $('#survey_items_table_edit_body').html('');

  $.each(items, function(index, value) {

    var row = '<tr id="edit_row_'+i+'"> <td> <div class="form-group"> <input disabled type="text" class="form-control form-control-pill form_survey_edit_fields edit_sl_no_fields" placeholder="Company" value="'+i+'" /> </div> </td> <td> <div class="form-group"> <input type="text" id="company_'+i+'" class="form-control form-control-pill form_survey_edit_fields" name="survey_item[company][]" placeholder="Company" value="'+value.company+'" /> </div> </td> <td> <div class="form-group"> <input type="text" id="product_'+i+'" class="form-control form-control-pill form_survey_edit_fields" name="survey_item[product][]" placeholder="Company" value="'+value.product+'" /> </div> </td> <td> <div class="form-group"> <input type="text" id="notes_'+i+'" class="form-control form-control-pill form_survey_edit_fields" name="survey_item[notes][]" placeholder="Company" value="'+value.notes+'" /> </div> </td> <td> <div class="form-group" style=" margin-top: -2em; "> <button type="button" data-sl="'+i+'" class="btn btn-icon btn-sm btn-pill btn-danger float-right edit_survey_item_delete_btn" ><i class="flaticon flaticon-close" ></i></button> </div> </td> </tr>';

    $('#survey_items_table_edit_body').append(row);
    i++;
  });

  $('#edit_current_row_count').val(items.length);
});


 $('body').on('click', '#survey_delete_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#survey_id_delete').val(row.eq(7).text());
});

 $('body').on('change', '#locality_survey_add', function(e) {
  var locality = $(this).val();
  if(locality!=null && locality!=''){ 
    locality_change(locality,'add');
  }
});


 function locality_change(locality,type) {
    // var locality = $(this).val();
    if(locality!=null && locality!=''){
      $.post("<?= base_url() ?>doctors/fetch_doctors",{'locality_id':locality},function(data) {
        var obj = $.parseJSON(data);
        var count = obj.count;
        console.log(obj);
        var doctors = '<option selected disabled>Select Doctor</option>';
        if(count>0){
          $.each(obj.data, function(index, value) {
            doctors += '<option value="'+value.doctor_id+'">'+value.name+' - '+value.qualification+'</option>';
          });
        }else{
          toastr['warning']('No doctors found ', 'Not Found');
        }

        $('#doctor_survey_'+type).html(doctors);

      });
    }
  }






  function GetDate() { return $('#table_filter_date').val();}
  function GetLocality() { return $('#table_filter_locality').val(); }
  function GetDoctor() { return $('#table_filter_doctor').val(); }
  function GetSalesMan() { return $('#table_filter_sales_man').val(); }


  var surveys_view_table = $('#surveys_view_table').DataTable({

   "ajax":{
    url :"<?= base_url().'work_logs/select_surveys' ?>",
    type: "post",
    data: function(d){
      d.locality = GetLocality();
      d.doctor = GetDoctor();
      <?php if($this->session->userdata('user_role')=='sales_man'){ ?>
        d.sales_man = '<?= $this->session->userdata('sales_man_data')->sales_man_id ?>';
      <?php } else { ?>
        d.sales_man = GetSalesMan();
      <?php } ?>
      d.date = GetDate();
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
      targets: [],

    },
    {
      className:'d-none noExport',
      targets:[<?php if($this->session->userdata('user_role')=='sales_man') { echo "2"; } ?><?php if($page=='doctor_profile') { echo ",2"; }?>,7,8,9,10,11,12]
    }
    ]

  });

  $(".table_filters").on("change", function() {
    surveys_view_table.ajax.reload();
  });


     // predefined ranges
     var start = moment().subtract(29, 'days');
     var end = moment();

     function range_init(start,end) {
       $('#table_filter_date').val( start.format('DD MMMM, YYYY') + ' - ' + end.format('DD MMMM, YYYY'));
       surveys_view_table.ajax.reload();
     } 

     $('#table_filter_date').daterangepicker({
       buttonClasses: ' btn',
       applyClass: 'btn-primary',
       cancelClass: 'btn-secondary',

       startDate: start,
       endDate: end,
       locale: {
        format: 'DD MMMM, YYYY'
      },
      ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
     }
   },range_init);

     range_init(start,end);


     $('#survey_item_add_btn').click(function () {

      var no = $('#current_row_count').val();
      var new_no = parseFloat(no) + 1;

      if(new_no==1){
        var delete_disabled = 'disabled';
      }else{
        var delete_disabled = '';
      }

      var row = '<tr id="row_'+new_no+'"> <td> <div class="form-group"> <input disabled type="text" class="form-control form-control-pill form_survey_add_fields sl_no_fields" placeholder="Company" value="'+new_no+'" /> </div> </td> <td> <div class="form-group"> <input type="text" id="company_'+new_no+'" class="form-control form-control-pill form_survey_add_fields" name="survey_item[company][]" placeholder="Company" value="" /> </div> </td> <td> <div class="form-group"> <input type="text" id="product_'+new_no+'" class="form-control form-control-pill form_survey_add_fields" name="survey_item[product][]" placeholder="Company" value="" /> </div> </td> <td> <div class="form-group"> <input type="text" id="notes_'+new_no+'" class="form-control form-control-pill form_survey_add_fields" name="survey_item[notes][]" placeholder="Company" value="" /> </div> </td> <td> <div class="form-group" style=" margin-top: -2em; "> <button '+delete_disabled+' type="button" data-sl="'+new_no+'" class="btn btn-icon btn-sm btn-pill btn-danger float-right survey_item_delete_btn" ><i class="flaticon flaticon-close" ></i></button> </div> </td> </tr>';

      $('#survey_items_table').append(row);
      $('#current_row_count').val(new_no);

      order_serial_nos();

    });

     function order_serial_nos() {
        // sl_no_field
        var sl = 1;
        $('.sl_no_fields').each(function(index, value) {
          $(this).val(sl); 
          sl++;
        });

      }



      $('body').on('click', '.survey_item_delete_btn', function() {
        var sl = $(this).data('sl');
        console.log(sl);
        $('#row_'+sl).remove();
        var new_no = sl - 1;
        $('#current_row_count').val(new_no);  
        order_serial_nos();
      });


  // $('.survey_item_delete_btn').click(function () {
  //   var sl = $(this).data('sl');
  //   console.log(sl);
  //   $('#row_'+sl).remove();
  //   var new_no = sl - 1;
  //   $('#current_row_count').val(new_no);
  // });


  $('#edit_survey_item_add_btn').click(function () {

    var no = $('#edit_current_row_count').val();
    console.log(no)
    var new_no = parseFloat(no) + 1;
    
    var row = '<tr id="edit_row_'+new_no+'"> <td> <div class="form-group"> <input disabled type="text" class="form-control form-control-pill form_survey_add_fields edit_sl_no_fields" placeholder="Company" value="'+new_no+'" /> </div> </td> <td> <div class="form-group"> <input type="text" id="company_'+new_no+'" class="form-control form-control-pill form_survey_add_fields" name="survey_item[company][]" placeholder="Company" value="" /> </div> </td> <td> <div class="form-group"> <input type="text" id="product_'+new_no+'" class="form-control form-control-pill form_survey_edit_fields" name="survey_item[product][]" placeholder="Company" value="" /> </div> </td> <td> <div class="form-group"> <input type="text" id="notes_'+new_no+'" class="form-control form-control-pill form_survey_add_fields" name="survey_item[notes][]" placeholder="Company" value="" /> </div> </td> <td> <div class="form-group" style=" margin-top: -2em; "> <button type="button" data-sl="'+new_no+'" class="btn btn-icon btn-sm btn-pill btn-danger float-right edit_survey_item_delete_btn" ><i class="flaticon flaticon-close" ></i></button> </div> </td> </tr>';

    $('#survey_items_table_edit').append(row);
    $('#edit_current_row_count').val(new_no);

    edit_order_serial_nos();

  });

  function edit_order_serial_nos() {
    var sl = 1;
    $('.edit_sl_no_fields').each(function(index, value) {
      $(this).val(sl); 
      sl++;
    });
  }


  $('body').on('click', '.edit_survey_item_delete_btn', function() {
    var sl = $(this).data('sl');
    console.log(sl);
    $('#edit_row_'+sl).remove();
    var new_no = sl - 1;
    $('#edit_current_row_count').val(new_no);  
    edit_order_serial_nos();
  });
</script>