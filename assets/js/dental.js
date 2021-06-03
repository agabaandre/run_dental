
$.fn.datepicker.defaults.format = "yyyy-mm-dd";
$('.datepicker').datepicker({
    
});


$('#alert').fadeTo(2000, 500).slideUp(500, function(){
    $('#alert').slideUp(500);
});

$(document).ready(function(){
  $("#reqdate").change(function(){
    var reqdate = $("#reqdate").val();
    var baseurl = $("#baseurl").val();

    if(reqdate!=""){
   // console.log(baseurl);
    $.ajax({
      url: baseurl+"clinic/availableDoctors",
      method: "post",
      data: "date=" + reqdate
      
     }).done(function(availables){
     console.log(availables);
     
     availables = JSON.parse(availables);
     $("#doctor").empty();
     availables.forEach(function(availables) {

       $("#doctor").append('<option value="'+availables.id+'">'+availables.name+'</option>');
      
       
     })

    })

  }})

});

$('.messages').submit(function(e){
	e.preventDefault();

	var method =$(this).attr('method');
	var path =$(this).attr('action');
	var form_data=$(this).serialize();
	console.log(form_data);
	  $.ajax({
    method:method,
    data:form_data,
    url:path,
    success : function(res){
    $.notify("Succesful", "success", { showAnimation: 'slideDown',
    showDuration: 40000,
    hideAnimation: 'slideUp'});
  	//console.log(res);
  	setTimeout(function(){
	
		
	},1000);
	
}


});//close $.ajax amd the param array




});//close submit and its function








