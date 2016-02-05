<?PHP 
require_once('session.php');
if($status=="OK"){
	//Twitter API 1.1
	if($_SESSION['identify'])
	  $identify = $_SESSION['identify'];
	if($_SESSION['user'])
	  $screen_name = $_SESSION['user'];
	if($_SESSION['user_image'])
	  $user_image = $_SESSION['user_image'];
	if($_SESSION['sessionid'])
	  $ssid = $_SESSION['sessionid'];
	include 'desktop/header.php';
	include 'desktop/menu.php';
	if(getUserLanguage()=="es")
	  include 'lenguajes/espanol.php';
	else
	  include 'lenguajes/ingles.php';
	header_desktop("".$txt["titulo3"]." ".$screen_name."");
	?>
<?PHP
$query=$conn->query("SELECT social_networks FROM token WHERE identify='".$identify."' AND red='".$redSocial."'");
$row=$query->fetch_assoc();
$social_networks=$row["social_networks"];
$social_networks_parts=explode(",",$social_networks);
$c=0;
include 'scripts/query-write.php';
?>
<link type="text/css" href="css/escribir.css" rel="stylesheet" media="all" />
<!--GetTweets Style-->
<link href="twitter/css/style.css" rel="stylesheet" type="text/css" />
<style>
<?PHP $c=0;
while($c!=50) {
 ?> #main-feed<?PHP echo $c;
?> {
 width: 200px;
 margin:auto;
 font-family: Arial, Helvetica, sans-serif;
 margin-top: 0px;
 padding: 0px;
 border-radius: 0px;
 background-color:#FFF;
 color:#333;
}
 #main-feed<?PHP echo $c;
?> h1 {
 color:#5F5F5F;
 margin:0px;
 padding:9px 0px 9px 0px;
 font-size:18px;
 font-weight:lighter;
}
 <?PHP $c++;
}
?>
</style>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/huso-horario.js"></script>
<script type="text/javascript">
<?PHP include 'textos.php'; ?>
</script>
<script type="text/javascript">
  var identify = '<?PHP echo $identify; ?>';
  var screen_name = '<?PHP echo $screen_name; ?>';
  var ssid = '<?PHP echo $ssid; ?>';
  var red = '<?PHP echo $redSocial; ?>';
  var id_token = '<?PHP echo $_SESSION['id_token']; ?>';
  var imageProfileDefault = '<?PHP echo $user_image; ?>';
  var urlPathActual = 'statistics';
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#login').click(function(){
	  window.location = "login.php";
   });
});
</script>
<script type="text/javascript">
//JQUERY
$(document).ready(function(){
  $('#tableSys5').css("border-left","5px solid #FFF");
   <?PHP
	$c=1;
	while($c!=$totalIconosMenu){
  ?>
  $('#textosSys<?PHP echo $c; ?>').css("display","none");
  $('#textosSys<?PHP echo $c; ?>').css("width","0%");
  <?PHP
	  $c++;
	}
  ?>
  <?PHP
  $c=1;
  while($c!=$totalIconosMenu){
  ?>
  $('#tableSys<?PHP echo $c; ?>').hover(function(){
	 $('#tableSys<?PHP echo $c; ?>').css("border-left","5px solid #FFF");
	 $('#tableSys<?PHP echo $c; ?>').css("cursor","pointer");
	 $('#expandirSys').css("width","20%");
  }, function(){
	 $('#tableSys<?PHP echo $c; ?>').css("border-left","5px solid #283147");
	 $('#tableSys5').css("border-left","5px solid #FFF");
  });
  <?PHP
	  $c++;
	}
  ?>
  $('#expandirSys').hover(function(){
  <?PHP
	$c=1;
	while($c!=$totalIconosMenu){
  ?>
	  $('#botonesSys<?PHP echo $c; ?>').css("width","50px");
	  $('#textosSys<?PHP echo $c; ?>').css("display","block");
	  $('#textosSys<?PHP echo $c; ?>').css("width","95%");
  <?PHP
	  $c++;
	}
  ?>
      $('#expandirSys').css("z-index","3");
	  $('#expandirSys').css("width","20%");
	  }, function(){
  <?PHP
	$c=1;
	while($c!=$totalIconosMenu){
  ?>
		$('#botonesSys<?PHP echo $c; ?>').css("width","50px");
		$('#textosSys<?PHP echo $c; ?>').css("display","none");
		$('#textosSys<?PHP echo $c; ?>').css("width","0%");
  <?PHP
	  $c++;
	}
  ?>
    $('#expandirSys').css("z-index","1");
	$('#expandirSys').css("width","50px");
  });
  <?PHP
    include 'menu-javaScript.php';
  ?>
  <?PHP
	$c=1;
	while($c<=$totalRedes){
	  ?>
	  $('#redes<?PHP echo $c; ?>').hover(function(){
		$('#redes<?PHP echo $c; ?>').css("background-color","#283147");
		$('#redes<?PHP echo $c; ?>').css("color","#FFFFFF");
	  },function(){
		$('#redes<?PHP echo $c; ?>').css("background-color","#FFFFFF");
		$('#redes<?PHP echo $c; ?>').css("color","#000000");
	  });
	  <?PHP
	  $c++;
	}
  ?>
  $(function() {
    $("#xchart").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	});

    $("#chartsjs").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	});

    $("#help").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
    });

    $("#cargando").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	  closeOnEscape: false,
	}); 

     consultaClientes(0);
    $("#ventana").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	  closeOnEscape: false,
	}); 

    $("#tabs").tabs();
    rastrear("crm");
  });
  
  
  <!--Llamadas iniciales a las funciones-->
  <!-- getUserDetails(); -->
  <!-- dejaDeSeguirCont(); -->
  <!-- getAutoDmDetails(); -->
});
</script>
<script type="text/javascript" src="js/rastreo.js"></script>
<script>
$(document).ready(function(){
  var calendar = $('#calendario').fullCalendar({
	header: {
	  left: 'prev,next today',
	  center: 'title',
	  right: 'month,agendaWeek,agendaDay'
	},
	//defaultDate: '2015-02-12', // When not specified, this value defaults to the current date.
	editable: true,
	eventLimit: true, // allow "more" link when too many events
	dayClick: function(date, jsEvent, view) {
	  var fechaI = new Date(date);
	  var fechaReal = moment(fechaI).add(1,'days').toString().split(" ");
	  //var fecha = ''+fechaII.getFullYear()+'-'+fechaII.getMonth()+'-'+fechaII.getDay()+'';
	  //$('#tabs').tabs({ active: 1 });
	  agregarEvento(0);
	  $("#datepicker2").val(fechaReal[2] + "-" + monthNames2[fechaReal[1]] + "-" + fechaReal[3]);
	//$('#calendario').fullCalendar('addEventSource', [{title: "lesson", start: date}]);
	},
	eventClick: function(calEvent, jsEvent, view) {
          //var fechaI = new Date(calEvent.start);
	  //var fechaReal = moment(fechaI).toString().split(" ");
          //var fechaTxt = fechaReal[2] + "-" + monthNames2[fechaReal[1]] + "-" + fechaReal[3];
	  //alert(txt391 + ": " + calEvent.title + " " + txt389 + ": " + fechaTxt + " a las: " + fechaReal[4] +" ");
	  // change the border color just for fun
	  //$(this).css('border-color', 'red');
	  agregarEvento(calEvent.id);
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
          openDialog();
          $.ajax({	        data:  { id:calEvent.id, fecha:fechaTxt, fecha2:fechaTxt2},
				url:   "scripts/CRM/post-calendar.php",
				type:  "post",
				success:  function (response) {
                                  toastr["info"](txt392 + ": " + calEvent.title + " " + txt389 + ": " + " " + fechaTxt);
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				} , error: function(response){
                                  toastr["error"](txt92, "ERROR");
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				}
	  });
	
	},
	eventColor: '#378006'
  });
});
</script>
<script type="text/javascript">
    ////Variables Escribir
	var redesTeclasFa = 2000;
	var redesTeclasTw = 140;
</script>
<style>
.xchart .errorLine path {
  stroke: #C6080D;
  stroke-width: 3px;
}
</style>
<script type="text/javascript">
//ayuda
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%61%79%75%64%61%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//notificaciones jquery
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%6E%6F%74%69%66%69%63%61%63%69%6F%6E%65%73%2D%6A%71%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//get-notifiaciones
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%4E%6F%74%69%66%69%63%61%63%69%6F%6E%65%73%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//escribir jquery
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%65%73%63%72%69%62%69%72%2D%6A%71%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//escribir
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%65%73%63%72%69%62%69%72%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//sortable jquery
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%73%6F%72%74%61%62%6C%65%2D%6A%71%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//sortable (ordenador)
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%73%6F%72%74%61%62%6C%65%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
// loading CSS
document.write(unescape("%3C%6C%69%6E%6B%20%74%79%70%65%3D%22%74%65%78%74%2F%63%73%73%22%20%68%72%65%66%3D%22%2E%2E%2F%63%73%73%2F%73%74%79%6C%65%2D%6C%6F%61%64%69%6E%67%2E%63%73%73%22%20%72%65%6C%3D%22%73%74%79%6C%65%73%68%65%65%74%22%20%6D%65%64%69%61%3D%22%61%6C%6C%22%20%2F%3E"));
// CRM
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%63%72%6D%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
// D3 y XCharts
document.write(unescape("%3C%73%63%72%69%70%74%20%73%72%63%3D%22%78%43%68%61%72%74%2F%64%33%2E%6D%69%6E%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
document.write(unescape("%3C%73%63%72%69%70%74%20%73%72%63%3D%22%78%43%68%61%72%74%2F%78%63%68%61%72%74%73%2E%6D%69%6E%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
// ChartsJs
document.write(unescape("%3C%73%63%72%69%70%74%20%73%72%63%3D%22%63%68%61%72%74%73%4A%73%2F%43%68%61%72%74%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
// Google API
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%68%74%74%70%73%3A%2F%2F%77%77%77%2E%67%6F%6F%67%6C%65%2E%63%6F%6D%2F%6A%73%61%70%69%22%3E%3C%2F%73%63%72%69%70%74%3E"));
</script>

<link type="text/css" href="css/sortable.css" rel="stylesheet" media="all" />
<link rel="stylesheet" href="xChart/css/master.css">
<link rel="stylesheet" href="chartsJs/dona.css">

<script>
mapa();
</script>
</head>
<?php include 'body-script.php'; ?>
          <td style="vertical-align: top;"><table style="background-color: <?PHP echo $backgroundColor; ?>; border-radius: 0px 0px 10px 10px; width: 100%;">
              <tr>
                <td style="vertical-align: top; width: 100%; padding-top: 15px;">

                  <div style="float: right; width: 95%; margin-right: .5em;" id="tabs">
                    <ul>
                      <li><a onclick="consultaClientes();" href="#tab1"><?PHP echo $txt["txt326"]; ?></a></li>
                      <li style="display: none;"><a onclick="altaClientes(0);" href="#tab2"><?PHP echo $txt["txt352"]; ?></a></li>
                      <li><a onclick="getCalendar();" href="#tab3"><?PHP echo $txt["txt388"]; ?></a></li>
                      <li><a onclick="getMapa();" href="#tab4"><?PHP echo $txt["txt395"]; ?></a></li>
                    </ul>
                    <div id="tab1" style="width: 1280px; overflow-x: auto;">
                      <div style="width: 100%; text-align: center;">
                        <?PHP echo $txt["txt301"]; ?><input type="text" style="width: 10em;" id="palabraArrayUser" value="" onkeyup="buscarArraUser();" /><br /><br />
                      </div>
                      <div style="width: 100%; text-align: left; padding-bottom: 0.2em;">
                        <button onclick="altaMovCli();" class="btn btn-success"> <?PHP echo $txt["txt397"]; ?></button>
                        <img src="images/del2.png" style="width: 1em;"> <?PHP echo $txt["txt58"]; ?>
                        <img src="images/edit2.png" style="width: 1em;"> <?PHP echo $txt["txt381"]; ?>
                      </div>
                      <div style="overflow-x: auto; width: 2800px; display: table-inline;" id="tab1Sub">
                      </div>
                    </div>
                    <div id="tab2">
                    </div>
                    <div id="tab3">
                      <div style="padding-bottom: 1em;"><button class="btn btn-success" onclick="agregarEvento(0);"><?PHP echo $txt["txt401"]; ?></button></div>
                      <div id="calendario"></div>
                    </div>
                    <div style="width: 100%;" id="tab4">
                      <div id="regions_div" style="width: 100%; height: 500px;"></div>
                    </div>
                  </div>

                  <div style="text-align: left;" id="ventana">
                  </div>
                  <div id="cargando">
                  </div>
                  <div id="help">
                  </div>
                  <?PHP include 'notificaciones.php' ?>
                </td>
              </tr>
            </table></td>
        </tr>
      </table>
    </center>
  </div>
</div>
</body>
</html><?PHP
} else {
  include 'error-page.php';
}?>