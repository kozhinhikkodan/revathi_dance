
<script type="text/javascript">

 fetch_districts(18,'#district_add');
 fetch_districts(18,'#district_tour_plan_add');

 function fetch_districts(state_id,target,selected = '') {
  $.post("<?= base_url() ?>locations/fetch_districts",{'state_id':state_id},function(data) {
    var obj = $.parseJSON(data);
    var count = obj.count;
    $(target).html('');
    var districts = '<option selected disabled>Select District</option>';
    if(count>0){
      $.each(obj.data, function(index, value) {
       districts += '<option value="'+value.district_id+'">'+value.district_name+'</option>';
     });
      $(target).html(districts);
    }else{
      $(target).html('');
      toastr['warning']('No districts found ', 'Not Found');
    }
  });
}


function fetch_localities(district_id,target,selected = '',multiple=false) {
  $.post("<?= base_url() ?>locations/fetch_localities",{'district_id':district_id},function(data) {
    var obj = $.parseJSON(data);
    var count = obj.count;
    $(target).html('');
    // if(selected==''){ 
      var selected = 'selected';
    // }else{
    //   var selected = '';
    // }

    if(multiple){
      console.log('single');
      var localities = '<option '+selected+' disabled>Select Locality</option>';
    }else{
      var localities = '';
    }

    if(count>0){
      $.each(obj.data, function(index, value) {
        // if(value.locality_id==selected){
        //   var selected_2 = 'selected';
        // }else{
          var selected_2 = '';
        // }
        localities += '<option '+selected_2+' value="'+value.locality_id+'">'+value.locality_name+'</option>';
      });
      $(target).html(localities);
    }else{
      $(target).html('');
      toastr['warning']('No Localities found ', 'Not Found');
    }
  });
}

</script>