//JQUERY Escribir
$(document).ready(function(){
	
  $(function() {
     $(".datepicker").pickadate({
	   changeMonth: true,
           changeYear: true,
	   dateFormat: 'dd-mm-yyyy',
           format: 'dd-mm-yyyy',
	   minDate: 0,
	   showOn: "both",
	   buttonImage: "images/calendar.gif",
	   buttonImageOnly: false,
           buttonText: "Select date"
	 });
  });
  
  $('#timepicker').timepicker({ 'scrollDefault': 'now', 'step': 15, 'timeFormat': 'H:i A' });
  


  
  $(document).keydown(function(e){
    <!-- alert(e.keyCode); -->
    if(e.which == 27){
      /*boton esc*/
    }
  });
});