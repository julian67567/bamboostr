<?PHP
require_once('session.php');
if($status=="OK"){
	//Twitter API 1.1
	if($_SESSION['identify'])
	  $identify = $_SESSION['identify'];
	if($_SESSION['user'])
	  $screen_name = $_SESSION['user'];
    if($_SESSION['user_bamboostr'])
	  $screen_name_bamboostr = $_SESSION['user_bamboostr'];
	if($_SESSION['user_image'])
	  $user_image = $_SESSION['user_image'];
    if($_SESSION['foto_bamboostr'])
	  $foto_bamboostr = $_SESSION['foto_bamboostr'];
	if($_SESSION['sessionid'])
	  $ssid = $_SESSION['sessionid'];
	include 'desktop/header.php';
	if(getUserLanguage()=="es")
	  include 'lenguajes/espanol.php';
	else
	  include 'lenguajes/ingles.php';
	header_desktop("".$txt["titulo3"]." ".$screen_name."");
	?>
<?PHP
if($identify){
    $query=$conn->query("SELECT social_networks FROM token WHERE identify='".$identify."' AND red='".$redSocial."'");
    $row=$query->fetch_assoc();
    $social_networks=$row["social_networks"];
    $social_networks_parts=explode(",",$social_networks);
    $c=0;
    include 'scripts/query-write.php';
}
?>
<link type="text/css" href="css/escribir.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/huso-horario.js"></script>
<script type="text/javascript">
<?PHP include 'textos.php' ?>
</script>
<script type="text/javascript">
  var identify = '<?PHP echo $identify; ?>';
  var screen_name = '<?PHP echo $screen_name; ?>';
  var screen_name_bamboostr = '<?PHP echo $screen_name_bamboostr; ?>';
  var ssid = '<?PHP echo $ssid; ?>';
  var red = '<?PHP echo $redSocial; ?>';
  var id_token = '<?PHP echo $_SESSION['id_token']; ?>';
  var user_image = '<?PHP echo $user_image; ?>';
  var urlPathActual = 'escribir';
</script>
<script>
$(document).ready(function(){
	$.ajax({  data: { id:id_token },
		  url:   "scripts/get-nivel.php",
		  type:  'POST',
		  success:  function (response) {
			obj = JSON.parse(response);
			var html = "";
			if(obj.nivel==1){
		      /***************************Principiantes****************************/
         		  
			  $("#tableSys6").css("display","none");
			  $("#tableSys7").css("display","none");
			  $("#tableSys9").css("display","none");

			  $("#bloques").html(html);
			} else {
			  /***************************EXPERTOS****************************/
			}
		  }, error: function (response){
                        toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
		  }
	});
});
</script>
<script>
<?PHP include 'logins.php'; ?>
</script>
<script type="text/javascript">
//JQUERY
$(document).ready(function(){
  <?PHP
    include 'menu-javaScript.php';
  ?>
  <!--Llamadas iniciales a las funciones-->
  <!-- getUserDetails(); -->
  <!-- dejaDeSeguirCont(); -->
  <!-- getAutoDmDetails(); -->

  $(function() {
    getMsgsProgram(1);
    getDraftsProgram(2);
    getPublicadosProgram(3);
  });

});
</script>
<script>
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});
</script>
<script type="text/javascript" src="js/rastreo.js"></script>

<!--Angular Librerías-->
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.js"></script>
<script type="text/javascript" src="angular/lib/calendario.js"></script>
<script type="text/javascript" src="angular/lib/nots.js"></script>
<script type="text/javascript" src="angular/lib/factory.js"></script>
<!--Fin angular-->

<script type="text/javascript">
    ////Variables Escribir
	var redesTeclasFa = 2000;
	var redesTeclasTw = 140;
</script>
<script type="text/javascript" src="js/getMsgsProgram.js"></script>
<script type="text/javascript" src="js/getDraftsProgram.js"></script>
<script type="text/javascript" src="js/getPublicadosProgram.js"></script>
<script type="text/javascript">
//ayuda
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%61%79%75%64%61%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//get-notifiaciones
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%4E%6F%74%69%66%69%63%61%63%69%6F%6E%65%73%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//escribir jquery
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%65%73%63%72%69%62%69%72%2D%6A%71%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//escribir
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%65%73%63%72%69%62%69%72%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//sortable (ordenador)
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%73%6F%72%74%61%62%6C%65%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
</script>
<link type="text/css" href="css/style-loading.css" rel="stylesheet" media="all" />
<link type="text/css" href="css/sortable.css" rel="stylesheet" media="all" />

<script>
  function abrirSignUpModal(){
    $("#signup-modal").modal("show");
  }
</script>
<script>
function guardarMsgPro(id_msgPro){
        var timePrArray = document.getElementById("timepicker2").value;
	timePr = timePrArray.split(":");
	timePrH = timePr[0];
	timePrMArray = timePr[1].split(" ");
	timePrM = timePrMArray[0];
	timeP = timePrH + "" +timePrM;
	var date = new Date();
	timeRFecha = date.getDate() + "/" +(date.getMonth()+1) + "/" +  date.getFullYear();
	timeR = date.getHours() + "" +date.getMinutes() + " ";
	
	timeRFechaParse = monthNames[parseInt(date.getMonth())] + " " +date.getDate() + ", " +  date.getFullYear();
	timePFechaArray = document.getElementById("datepicker2").value.split("-");
	timePFechaParse = monthNames[parseInt(timePFechaArray[1]-1)] + " " +timePFechaArray[0] + ", " +  timePFechaArray[2];
	
	if(Date.parse(timePFechaParse)>=Date.parse(timeRFechaParse)){
	  if(parseInt(timeP)>parseInt(timeR) && (Date.parse(timePFechaParse)==Date.parse(timeRFechaParse)) || (Date.parse(timePFechaParse)>Date.parse(timeRFechaParse))){
		var fecha = document.getElementById("datepicker2").value + " " + 
						timePrH + ":" +timePrM;
		var parametros = { id:id_msgPro, 
		                   mensaje:document.getElementById("mensajeMsgsPro").value,
						   horario:husoHorario,
						   fecha:fecha
						   };
	    $.ajax({data:  parametros,
				url:   "scripts/mod-program-message.php",
				type:  "post",
				success:  function (response) {
				  if(response.indexOf("FALSE")!="-1"){
                                        toastr["error"](txt133, "ERROR");
				  } else if(response.indexOf("TRUE")!="-1") {
                                        toastr["success"](txt134);
				  } else {
                                        toastr["info"](txt92);
				  }
                                  $("#edit-message").modal("hide");
                                  getMsgsProgram(1);
                                  getCalendar();
				},
				error: function (response){
				  toastr["info"](txt92);
				}
        }); 
	  } else {
            toastr["error"](txt124, "ERROR");
	  } 
	} else {
	  toastr["error"](txt132, "ERROR");
	}
}
function editarMsg(obj){
$("#edit-message").modal("show");
htmlDialogEditMsPr = '';
				  htmlDialogEditMsPr += '<div style="display: table; width: 100%;">';
					htmlDialogEditMsPr += '<div style="display: table-row; width: 100%;">';
					  htmlDialogEditMsPr += '<div style="text-align: center; display: table-cell; width: 100%;">';
						htmlDialogEditMsPr += ''+obj.name+'';
					  htmlDialogEditMsPr += '</div>';
					htmlDialogEditMsPr += '</div>';
					htmlDialogEditMsPr += '<div style="display: table-row; width: 100%;">';
					  htmlDialogEditMsPr += '<div style="text-align: center; display: table-cell; width: 100%;">';
						htmlDialogEditMsPr += '<img style="width: 50px;" src="'+obj.image_profile+'" />';
					  htmlDialogEditMsPr += '</div>';
					htmlDialogEditMsPr += '</div>';
				  htmlDialogEditMsPr += '</div>';
				  htmlDialogEditMsPr += '<div style="display: table-row; width: 100%;">';
					  htmlDialogEditMsPr += '<div style="text-align: left; display: table-cell; width: 200px;">';
						htmlDialogEditMsPr += 'Red social: ';
					  htmlDialogEditMsPr += '</div>';
					  htmlDialogEditMsPr += '<div style="text-align: left; display: table-cell;">';
						htmlDialogEditMsPr += ''+obj.red+'';
					  htmlDialogEditMsPr += '</div>';
					htmlDialogEditMsPr += '</div>';
				  htmlDialogEditMsPr += '<div style="display: table; width: 100%;">';
					htmlDialogEditMsPr += '<div style="display: table-row; width: 100%;">';
					  htmlDialogEditMsPr += '<div style="text-align: left; display: table-cell; width: 200px;">';
						htmlDialogEditMsPr += 'Fecha: ';
					  htmlDialogEditMsPr += '</div>';
					  htmlDialogEditMsPr += '<div style="text-align: left; display: table-cell;">';
					    fechaEdirMsgsProArray=obj.fecha.split(" ");
						htmlDialogEditMsPr += ''+txt79+': <input value="'+fechaEdirMsgsProArray[0]+'" style="display: inline-block;" type="date" class="datepicker2" id="datepicker2">';
						htmlDialogEditMsPr += ' '+txt80+': <input value="'+fechaEdirMsgsProArray[1]+'" style="display: inline-block;" type="text" id="timepicker2">';
					  htmlDialogEditMsPr += '</div>';
					htmlDialogEditMsPr += '</div>';
					htmlDialogEditMsPr += '<div style="display: table-row; width: 100%;">';
					  htmlDialogEditMsPr += '<div style="text-align: left; display: table-cell; width: 200px;">';
						htmlDialogEditMsPr += 'Mensaje: ';
					  htmlDialogEditMsPr += '</div>';
					  htmlDialogEditMsPr += '<div style="text-align: left; display: table-cell;">';
						htmlDialogEditMsPr += '<input id="mensajeMsgsPro" name="mensajeMsgsPro" type="text" style="width: 100%;" value="'+obj.mensaje.replace(/"/g, " ")+'" />';
					  htmlDialogEditMsPr += '</div><br /><br />';
					htmlDialogEditMsPr += '</div>';
					htmlDialogEditMsPr += '<div style="display: table-row; width: 100%;">';
					  htmlDialogEditMsPr += '<div style="text-align: left; display: table-cell; width: 200px;">';
						htmlDialogEditMsPr += 'Imágen(es): ';
					  htmlDialogEditMsPr += '</div>';
					  htmlDialogEditMsPr += '<div style="text-align: left; display: table-cell;">';
					  if(obj.images==""){
					    htmlDialogEditMsPr += 'N/A';
					  }
					  arrayImageEdit = obj.images.split(",");
					  for(var iCImMsgsPro=0; iCImMsgsPro<arrayImageEdit.length-1; iCImMsgsPro++){
					    htmlDialogEditMsPr += '<img style="width: 400px;" src="'+arrayImageEdit[iCImMsgsPro]+'" /><br />';
					  }
					  htmlDialogEditMsPr += '</div>';
					htmlDialogEditMsPr += '</div>';
				  htmlDialogEditMsPr += '</div>';
				  htmlDialogEditMsPr += '<div style="display: table-row; width: 100%;">';
					  htmlDialogEditMsPr += '<div style="text-align: left; display: table-cell; width: 200px;">';
						htmlDialogEditMsPr += 'Link: ';
					  htmlDialogEditMsPr += '</div>';
					  htmlDialogEditMsPr += '<div style="text-align: left; display: table-cell;">';
					  if(obj.link==""){
					    htmlDialogEditMsPr += 'N/A';
					  }
					  htmlDialogEditMsPr += '</div><br /><br />';
					htmlDialogEditMsPr += '</div><br />';
				  htmlDialogEditMsPr += '<div style="display: table; width: 100%;">';
					htmlDialogEditMsPr += '<div style="display: table-row; width: 100%;">';
					  htmlDialogEditMsPr += '<div style="text-align: center; display: table-cell; width: 100%;">';
						htmlDialogEditMsPr += '<a class="waves-effect waves-light btn" onclick="guardarMsgPro('+comilla+''+obj.id+''+comilla+');">Guardar Cambios</a>';
					  htmlDialogEditMsPr += '</div>';
					htmlDialogEditMsPr += '</div>';
				  htmlDialogEditMsPr += '</div>';
				  $("#edit-message-body").html(htmlDialogEditMsPr);
				    $(function() {
					 $(".datepicker2").pickadate({
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
				  
				  $('#timepicker2').timepicker({ 'scrollDefault': 'now', 'step': 15, 'timeFormat': 'H:i A' });
}
function getCalendar(){
		  var parametros = { id_token:id_token };
				  $.ajax({data:parametros,
						  url:'scripts/getCalendar.php',
					  type:'POST',
					  success:  function (response) { 
						obj = JSON.parse(response);
						if(obj[0]){
						  $('#calendario').fullCalendar('removeEvents');
						  $('#calendario').fullCalendar('addEventSource', obj);
						  $('#calendario').fullCalendar('refetchEvents');
						} else if(obj.error){
							  $('#calendario').fullCalendar('removeEvents');
						  $('#calendario').fullCalendar('addEventSource', obj);
						  $('#calendario').fullCalendar('refetchEvents');
							} else {
							  $('#calendario').fullCalendar('removeEvents');
						  $('#calendario').fullCalendar('addEventSource', obj);
						  $('#calendario').fullCalendar('refetchEvents');
						}
						
					  },
					  error: function (response){
						toastr["error"]("ERROR");
					  }
				  });
}
</script>
<script type="text/javascript">
            $(document).ready(function() {
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                var cId = $('#calendario'); //Change the name if you want. I'm also using thsi add button for more actions

                //Generate the Calendar
                cId.fullCalendar({
                    header: {
                        right: '',
                        center: 'prev, title, next',
                        left: ''
                    },

                    theme: true, //Do not remove this as it ruin the design
                    selectable: true,
                    selectHelper: true,
                    editable: true,
					dayClick: function(date, jsEvent, view) {
					  //var fechaI = new Date(date);
					  //var fechaReal = moment(fechaI).add(1,'days').toString().split(" ");
					  //var fecha = ''+fechaII.getFullYear()+'-'+fechaII.getMonth()+'-'+fechaII.getDay()+'';
					  //$('#tabs').tabs({ active: 1 });
					  //agregarEvento(0);
					  //$("#datepicker2").val(fechaReal[2] + "-" + monthNames2[fechaReal[1]] + "-" + fechaReal[3]);
					  //$('#calendario').fullCalendar('addEventSource', [{title: "lesson", start: date}]);
                                          window.location = "escribir.php";
					},
					eventClick: function(calEvent, jsEvent, view) {
						  //var fechaI = new Date(calEvent.start);
					  //var fechaReal = moment(fechaI).toString().split(" ");
						  //var fechaTxt = fechaReal[2] + "-" + monthNames2[fechaReal[1]] + "-" + fechaReal[3];
					  //alert(txt391 + ": " + calEvent.title + " " + txt389 + ": " + fechaTxt + " a las: " + fechaReal[4] +" ");
					  // change the border color just for fun
					  //$(this).css('border-color', 'red');
					  //agregarEvento(calEvent.id);
                                          editarMsg(calEvent);
					},
					eventDrop: function(calEvent,dayDelta,minuteDelta,allDay,revetFunc) {
						  var fechaI = new Date(calEvent.start);
					          var fechaReal = moment(fechaI).toString().split(" ");
						  var hora = fechaReal[4].split(":");
						  var fechaTxt = fechaReal[2] + "-" + monthNames2[fechaReal[1]] + "-" + fechaReal[3] + " " + hora[0] + ":" +hora[1];
						  if(calEvent.end!="null" && calEvent.end!=null){
							var fechaI = new Date(calEvent.end);
						    var fechaReal = moment(fechaI).toString().split(" ");
							var hora = fechaReal[4].split(":");
							var fechaTxt2 = fechaReal[2] + "-" + monthNames2[fechaReal[1]] + "-" + fechaReal[3] + " " + hora[0] + ":" +hora[1];
						  } else {
							var fechaTxt2 = "";
						  }
						  $.ajax({      data:  { id:calEvent.id, fecha:fechaTxt},
								url:   "scripts/postCalendar.php",
								type:  "post",
								success:  function (response) {
                                                                  toastr["info"](txt392 + ": " + calEvent.title + " " + txt389 + ": " + " " + fechaTxt);
                                                                  getMsgsProgram(1);
                                                                  getCalendar();
								} , error: function(response){
								  toastr["error"](txt92, "ERROR");
								}
					      });
					
					}
                });

                //Create and ddd Action button with dropdown in Calendar header. 
                var actionMenu = '<ul class="actions actions-alt" id="fc-actions">' +
                                    '<li class="dropdown">' +
                                        '<a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>' +
                                        '<ul class="dropdown-menu dropdown-menu-right">' +
                                            '<li class="active">' +
                                                '<a data-view="month" href="">Month View</a>' +
                                            '</li>' +
                                            '<li>' +
                                                '<a data-view="basicWeek" href="">Week View</a>' +
                                            '</li>' +
                                            '<li>' +
                                                '<a data-view="agendaWeek" href="">Agenda Week View</a>' +
                                            '</li>' +
                                            '<li>' +
                                                '<a data-view="basicDay" href="">Day View</a>' +
                                            '</li>' +
                                            '<li>' +
                                                '<a data-view="agendaDay" href="">Agenda Day View</a>' +
                                            '</li>' +
                                        '</ul>' +
                                    '</div>' +
                                '</li>';


                cId.find('.fc-toolbar').append(actionMenu);
                
                //Event Tag Selector
                (function(){
                    $('body').on('click', '.event-tag > span', function(){
                        $('.event-tag > span').removeClass('selected');
                        $(this).addClass('selected');
                    });
                })();  

                //Calendar views
                $('body').on('click', '#fc-actions [data-view]', function(e){
                    e.preventDefault();
                    var dataView = $(this).attr('data-view');
                    
                    $('#fc-actions li').removeClass('active');
                    $(this).parent().addClass('active');

                    cId.fullCalendar('changeView', dataView);  
                });/*full calendar*/
		getCalendar();
            });/*docuemtn ready*/                        
        </script>

</head>
<body style="background-color: #f3f3f3;" ng-app="calendario" ng-controller="calendarioCtrl">
        <?PHP
            include 'desktop/header-menu.php';
            headerMenu($_SESSION['foto_bamboostr']);
        ?>
        
        <?PHP
            include 'loading.php';
        ?>

        <section id="main">
            <aside id="sidebar" class="">
                <div class="sidebar-inner c-overflow" tabindex="1" style="overflow: hidden; outline: none;">
                    <?PHP 
					  include 'desktop/menu.php';
	                  menu();
					?>
                </div>
            </aside>
        </section>

        <section id="body">

          <div class="row">
              <div class="col-md-2">
              </div>
              <div class="col-md-8">
                <div style="background-color: #f9f9f9;" class="card">
                    <div class="card-content">
                      <p style="color: #175780; padding-left: 50px; font-size: 15px; display: inline-block;">
                        <a class="underline" href="system.php">Inicio</a> > <a class="underline" href="">Calendario</a>
                      </p><br />
                      <p style="color: #175780; padding-left: 50px; font-size: 20px; display: inline-block;">Calendario de Publicaciones</p><br />
                      <p style="color: #a3a3a3; padding-left: 50px; font-size: 15px; display: inline-block;">Organiza, edita y da seguimiento a tus publicaciones.</p>
                    </div>
                </div>
              </div>
              <div class="col-md-2">
              </div>
          </div>  
        </section>

        <section style="padding-top: 50px;" id="body">

           <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-xs-12 col-md-4">
              <ul style="background-color: transparent;" class="tabs">
                <li class="tab col-md-3"><a class="active" href="#test2">Programados</a></li>
                <li class="tab col-md-3"><a href="#test3">No programados</a></li>
                <li class="tab col-md-3"><a href="#test4">Publicados</a></li>
              </ul>
              <div style="margin-top: 10px; width: 100%;" id="test2" class="col-xs-12 col-md-6"><div id="main-feed1"></div></div>
              <div style="margin-top: 10px; width: 100%;" id="test3" class="col-xs-12 col-md-6"><div id="main-feed2"></div></div>
              <div style="margin-top: 10px; width: 100%;" id="test4" class="col-xs-12 col-md-6"><div id="main-feed3"></div></div>
            </div>
            <div style="margin-top: 0px;" class="col-md-4 hidden-xs">
              <div id="calendario"></div>
            </div>
            <div class="col-md-2">
            </div>
          </div>
          
        </section>

   <!-- Edit Message -->
    <div style="width: 100%;" class="modal modal-signup" id="edit-message" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin: 0px; padding: 0px; margin-top: 20px;">
            <div class="modal-content" style="height: 400px; overflow-y: auto;">
                <div class="modal-header">
                    <button style="float: left; color: red; opacity: 1;" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 style="text-align: center;" id="signupModalLabel" class="modal-title text-center">Editar Mensaje.</h4>
                    <!--<p class="intro text-center">It only takes 3 minutes!</p>-->
                    <p></p>
                </div>
                <div class="modal-body col-md-12" id="edit-message-body">
                </div><!--//modal-body-->
                <!--
                <div class="modal-footer">
                    <p>Already have an account? <a class="login-link" id="login-link" href="http://themes.3rdwavemedia.com/tempo/1.4/#">Log in</a></p>                    
                </div>--><!--//modal-footer-->
            </div><!--//modal-content-->
        </div><!--//modal-dialog col-md-8-->
        <div class="col-md-2"></div>
    </div><!--//modal-->

    <?PHP include 'footer.php'; footer(); ?>
    <?PHP include 'notificaciones.php'; ?>
</body>
 </html>
 <?PHP
} else {
  include 'error.html';
}?>