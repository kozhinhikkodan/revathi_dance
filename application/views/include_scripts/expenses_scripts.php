
<script type="text/javascript">

 $('body').on('click', '#expense_delete_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#expense_id_delete').val(row.eq(7).text());
});

 function GetDate() { return $('#table_filter_date').val(); }
 function GetSalesman() { return $('#table_filter_sales_man').val();}
 function GetManager() { return $('#table_filter_manager').val(); }
 function GetType() { return $('[name=table_filter_type]:checked').val(); }

 var expenses_view_table = $('#expenses_view_table').DataTable({

   "ajax":{
    url :"<?= base_url().'expenses/select_expenses' ?>",
    type: "post",
    data: function(d){
      d.date = GetDate();
      <?php if($page!='sales_man_profile'){ ?>
        d.sales_man = GetSalesman();
      <?php }else{ ?>
        d.sales_man = '<?= $sales_man_data->sales_man_id ?>';
      <?php }?> 
      d.manager = GetManager();
      d.type = GetType();
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
      targets:[<?php if($page=='manager_profile' || $page=='sales_man_profile') { echo "3,6,7"; }?>,8,9,10<?php if($this->session->userdata('user_role')=='sales_man'){ echo ",7,3"; } ?>]
    },
    {
      className:'noExport',
      targets:[7]
    }
    ]

  });

 $(".table_filters").on("change", function() {
  expenses_view_table.ajax.reload();
});



 // predefined ranges
 var start = moment().subtract(29, 'days');
 var end = moment();

 function range_init(start,end) {
   $('#table_filter_date').val( start.format('DD MMMM, YYYY') + ' - ' + end.format('DD MMMM, YYYY'));
   expenses_view_table.ajax.reload();
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





 $('body').on('change', '[name=expense_type]', function() {
  expense_type_change();  
});

 expense_type_change();  

 function expense_type_change() {
   var type = $('[name=expense_type]:checked').val();
   if(type=='ta'){
    $('.ta_row').show();
    $('.ta_fields').attr('required','required');
    $('#other_expense_amount_div').hide();
    $('#other_expense_amount').removeAttr('required');
  }else{
    $('.ta_row').hide();
    $('.ta_fields').removeAttr('required');
    $('#other_expense_amount_div').show();
    $('#other_expense_amount').attr('required','required');
  }
}




$('#ta_item_add_btn').click(function () {

  var no = $('#current_row_count').val();
  var new_no = parseFloat(no) + 1;

  var row = '<tr id="row_'+new_no+'"> <td> <div class="form-group mx-1"> <input disabled type="text" id="name" class="form-control form-control-pill form_hospital_add_fields sl_no_fields" name="name" placeholder="SL" value="'+new_no+'" /> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input type="text" id="starting_point_'+new_no+'" class="form-control form-control-pill form_expense_add_fields ta_fields autocomplete_fields places_fields" name="ta_items[starting_point][]" placeholder="Starting Point"/> <span><i class="flaticon2-location icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input required type="text" id="ending_point_'+new_no+'" class="form-control form-control-pill form_expense_add_fields ta_fields end_points places_fields" data-sl="'+new_no+'" name="ta_items[ending_point][]" placeholder="Ending Point" /> <span><i class="flaticon2-location icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input readonly type="text" data-sl="'+new_no+'" id="distance_'+new_no+'" class="form-control form-control-pill form_expense_add_fields ta_fields distance_fields" name="ta_items[distance][]" placeholder="KM"/> <span><i class="flaticon2-location icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input readonly type="text" id="amount_'+new_no+'" class="form-control form-control-pill form_expense_add_fields ta_fields expense_amount_fields" data-sl="'+new_no+'" name="ta_items[amount][]" placeholder="Amount"/> <span><i class="la la-rupee icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1" style=" margin-top: -2em; "> <button type="button" data-sl="'+new_no+'" class="btn btn-icon btn-sm btn-pill btn-danger float-right ta_item_delete_btn" ><i class="flaticon flaticon-close" ></i></button> </div> </td> </tr>';

  $('#ta_items_table').append(row);
  $('#current_row_count').val(new_no);
  
  // Auto complete

  var input_1 = document.getElementById('starting_point_'+new_no);
  var input_2 = document.getElementById('ending_point_'+new_no);
  var options = { };
  new google.maps.places.Autocomplete(input_1, options);
  new google.maps.places.Autocomplete(input_2, options);


  order_serial_nos();

});

function order_serial_nos() {
  var sl = 1;
  $('.sl_no_fields').each(function(index, value) {
    $(this).val(sl); 
    sl++;
  });

}

$('body').on('click', '.ta_item_delete_btn', function() {
  var sl = $(this).data('sl');
  console.log(sl);
  $('#row_'+sl).remove();
  var new_no = sl - 1;
  $('#current_row_count').val(new_no);  
  order_serial_nos();

});

function calculate_total_expense_amount() {
  var amount = 0;
  $('.expense_amount_fields').each(function(index, value) {
    amount += parseFloat($(this).val()); 
  });
  console.log(amount);
  // $('#total_expense_amount_no_return').val(amount.toFixed(2));
  // var total = amount*2;
  $('#total_expense_amount').val(amount.toFixed(2));

}

function calculate_expense_amount(row_no) {
  <?php if($this->session->userdata('user_role')=='sales_man'){ ?>
    var unit_allowance = parseFloat('<?= $this->session->userdata('sales_man_data')->sales_man_ta ?>');
  <?php } elseif($this->session->userdata('user_role')=='manager'){ ?>
    var unit_allowance = parseFloat('<?= $this->session->userdata('manager_data')->manager_ta ?>');
  <?php } ?>

  var distance = parseFloat($('#distance_'+row_no).val());
  var amount = unit_allowance*distance;
  console.log(distance);
  $('#amount_'+row_no).val(amount.toFixed(2));
}

$('body').on('change keyup', '.distance_fields', function() {
  var row_no = $(this).data('sl');
  calculate_expense_amount(row_no);
  calculate_total_expense_amount();  
});


$('body').on('change keyup', '.expense_amount_fields', function() {
  calculate_total_amount();  
});






$('body').on('click', '#expense_edit_btn', function() {
  var row = $(this).closest('tr').children('td');
  $('#expense_id_edit').val(row.eq(8).text());
  $('[name=expense_type_edit][value='+row.eq(9).text()+']').prop('checked',true).trigger('change');

  if(row.eq(9).text()=='ta'){

    $('#ta_items_table_edit_tbody').html('');

    var ta_details = $.parseJSON(row.eq(10).text());
    console.log(ta_details);
    var new_no = 1;
    $.each(ta_details, function(index, value) {
      var row = '<tr id="row_edit_'+new_no+'"> <td> <div class="form-group mx-1"> <input disabled type="text" id="name" class="form-control form-control-pill form_hospital_edit_fields sl_no_fields_edit" name="name" placeholder="SL" value="'+new_no+'" /> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input type="text" id="starting_point_edit_'+new_no+'" class="form-control form-control-pill form_expense_edit_fields ta_fields_edit places_fields" name="ta_items[starting_point][]" placeholder="Starting Point" value="'+value.starting_point+'"/> <span><i class="flaticon2-location icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input required type="text" id="ending_point_edit_'+new_no+'" class="form-control form-control-pill form_expense_edit_fields ta_fields_edit end_points places_fields" data-sl="'+new_no+'" name="ta_items[ending_point][]" placeholder="Ending Point" value="'+value.ending_point+'" /> <span><i class="flaticon2-location icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input readonly type="text" data-sl="'+new_no+'" id="distance_edit_'+new_no+'" class="form-control form-control-pill form_expense_edit_fields ta_fields_edit distance_fields_edit" name="ta_items[distance][]" placeholder="KM" value="'+value.distance+'"/> <span><i class="flaticon2-location icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input readonly type="text" id="amount_edit_'+new_no+'" class="form-control form-control-pill form_expense_edit_fields ta_fields_edit expense_amount_fields_edit" data-sl="'+new_no+'" name="ta_items[amount][]" placeholder="Amount" value="'+value.amount+'"/> <span><i class="la la-rupee icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1" style=" margin-top: -2em; "> <button type="button" data-sl="'+new_no+'" class="btn btn-icon btn-sm btn-pill btn-danger float-right ta_item_delete_btn_edit" ><i class="flaticon flaticon-close" ></i></button> </div> </td> </tr>';

      $('#ta_items_table_edit').append(row);

      calculate_expense_amount_edit(new_no);
      calculate_total_expense_amount_edit();  

      new_no++;

      $('#current_row_count_edit').val(new_no);

    });

    

  }else{
    $('#other_expense_amount_edit').val(row.eq(3).text());
  }

  $('#remarks_edit').val(row.eq(4).text());

});








// edit 



$('body').on('change', '[name=expense_type_edit]', function() {
  expense_type_change_edit();  
});

expense_type_change_edit();  

function expense_type_change_edit() {
 var type = $('[name=expense_type_edit]:checked').val();
 if(type=='ta'){
  $('.ta_row_edit').show();
  $('.ta_fields_edit').attr('required','required');
  $('#other_expense_amount_div_edit').hide();
  $('#other_expense_amount_edit').removeAttr('required');
}else{
  $('.ta_row_edit').hide();
  $('.ta_fields_edit').removeAttr('required');
  $('#other_expense_amount_div_edit').show();
  $('#other_expense_amount_edit').attr('required','required');
}
}




$('#ta_item_add_btn_edit').click(function () {

  var no = $('#current_row_count_edit').val();
  var new_no = parseFloat(no) + 1;

  var row = '<tr id="row_edit_'+new_no+'"> <td> <div class="form-group mx-1"> <input disabled type="text" id="name" class="form-control form-control-pill form_hospital_edit_fields sl_no_fields_edit" name="name" placeholder="SL" value="'+new_no+'" /> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input type="text" id="starting_point_edit_'+new_no+'" class="form-control form-control-pill form_expense_edit_fields ta_fields_edit places_fields" name="ta_items[starting_point][]" placeholder="Starting Point"/> <span><i class="flaticon2-location icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input required type="text" id="ending_point_edit_'+new_no+'" class="form-control form-control-pill form_expense_edit_fields ta_fields_edit end_points places_fields" data-sl="'+new_no+'"  name="ta_items[ending_point][]" placeholder="Ending Point" /> <span><i class="flaticon2-location icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input type="text" data-sl="'+new_no+'" id="distance_edit_'+new_no+'" class="form-control form-control-pill form_expense_edit_fields ta_fields_edit distance_fields_edit" name="ta_items[distance][]" placeholder="KM"/> <span><i class="flaticon2-location icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1"> <div class="input-icon input-icon-right"> <input readonly type="text" id="amount_edit_'+new_no+'" class="form-control form-control-pill form_expense_edit_fields ta_fields_edit expense_amount_fields_edit" data-sl="'+new_no+'" name="ta_items[amount][]" placeholder="Amount"/> <span><i class="la la-rupee icon-md"></i></span> </div> </div> </td> <td> <div class="form-group mx-1" style=" margin-top: -2em; "> <button type="button" data-sl="'+new_no+'" class="btn btn-icon btn-sm btn-pill btn-danger float-right ta_item_delete_btn_edit" ><i class="flaticon flaticon-close" ></i></button> </div> </td> </tr>';

  $('#ta_items_table_edit').append(row);
  $('#current_row_count_edit').val(new_no);

  order_serial_nos_edit();

});

function order_serial_nos_edit() {
  var sl = 1;
  $('.sl_no_fields_edit').each(function(index, value) {
    $(this).val(sl); 
    sl++;
  });

}

$('body').on('click', '.ta_item_delete_btn_edit', function() {
  var sl = $(this).data('sl');
  console.log(sl);
  $('#row_edit_'+sl).remove();
  var new_no = sl - 1;
  $('#current_row_count_edit').val(new_no);  
  order_serial_nos_edit();

});

function calculate_total_expense_amount_edit() {
  var amount = 0;
  $('.expense_amount_fields_edit').each(function(index, value) {
    amount += parseFloat($(this).val()); 
  });
  console.log(amount);
  $('#total_expense_amount_edit').val(amount.toFixed(2));
}

function calculate_expense_amount_edit(row_no) {
 <?php if($this->session->userdata('user_role')=='sales_man'){ ?>
  var unit_allowance = parseFloat('<?= $this->session->userdata('sales_man_data')->sales_man_ta ?>');
<?php } elseif($this->session->userdata('user_role')=='manager'){ ?>
  var unit_allowance = parseFloat('<?= $this->session->userdata('manager_data')->manager_ta ?>');
<?php } ?>
var distance = parseFloat($('#distance_edit_'+row_no).val());
var amount = unit_allowance*distance;
$('#amount_edit_'+row_no).val(amount.toFixed(2));
}

$('body').on('change keyup', '.distance_fields_edit', function() {
  var row_no = $(this).data('sl');
  calculate_expense_amount_edit(row_no);
  calculate_total_expense_amount_edit();  
});


$('body').on('change keyup', '.expense_amount_fields_edit', function() {
  calculate_total_amount_edit();  
});







</script>