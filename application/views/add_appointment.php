<script>
$.fn.datepicker.defaults.format = "yyyy/mm/dd";
$('.datepicker').datepicker({
});
</script>	
<div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
             <li class="active"><a href="#">New Appointment</a></li>
			</ul>
		   </div>
		</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/wickedpicker.min.css">
<div class="col-md-12"> 
<div class="box-header with-border">
  <h5 class="box-title">Appoitmnents List</h5>
</div>

<div id="appoints-table" >

</div>



<script>

$(document).ready(function(){
	var link = "<?php echo base_url('clinic/getAppointment')  ?>";
	console.log(link);
	$.ajax({
		type: 'GET',
		url:link, 
		async: false,
		success: function(result){
			console.log(result);
		$("#appoints-table").html(result);
	}});
  
});

</script>

<script>
$(function(){
	$("#addClass").click(function (e) {
		e.preventDefault();
		$('#qnimate').addClass('popup-box-on');
	});          
	$("#removeClass").click(function () {
		$('#qnimate').removeClass('popup-box-on');
	});
});
</script>


