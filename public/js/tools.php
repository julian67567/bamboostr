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
  $('#tableSys4').css("border-left","5px solid #FFF");
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
	 $('#tableSys4').css("border-left","5px solid #FFF");
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
    $("#help").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	});
    $("#ventana").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	  closeOnEscape: false,
	}); 
    $("#cargando").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	}); 
	$("#arrayUsers").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	}); 
	if(red=='twitter')
	  cargando(identify,'',red,imageProfileDefault,red,'@'+screen_name);
	else
	  cargando(identify,'',red,imageProfileDefault,red,screen_name);
    rastrear("tools");
  });
  
  
  <!--Llamadas iniciales a las funciones-->
  <!-- getUserDetails(); -->
  <!-- dejaDeSeguirCont(); -->
  <!-- getAutoDmDetails(); -->
});
</script>
<script type="text/javascript" src="js/rastreo.js"></script>
<script type="text/javascript">
//VARIABLES
var tt;
var opts;
//FUNCIONES
function seleccionarCuenta(){
	infoCuenta=document.getElementById("seleccionarCuenta").value;
	infoCuentaArray=infoCuenta.split("|");
	if(infoCuentaArray[0]=="twitter"){
	  cargando(infoCuentaArray[2].substr(0,infoCuentaArray[2].length-2),infoCuentaArray[4],infoCuentaArray[0],infoCuentaArray[1],'twitter',infoCuentaArray[3]);
	} 
	if(infoCuentaArray[0]=="facebook"){
	  cargando(infoCuentaArray[2].substr(0,infoCuentaArray[2].length-2),'',infoCuentaArray[0],infoCuentaArray[1],'facebook',infoCuentaArray[3]);
	} 
	if(infoCuentaArray[0]=="page"){
	  cargando(infoCuentaArray[2].substr(0,infoCuentaArray[2].length-2),infoCuentaArray[4],infoCuentaArray[0],infoCuentaArray[1],'facebook');
	} 
	if(infoCuentaArray[0]=="grupo"){
	  cargando(infoCuentaArray[2].substr(0,infoCuentaArray[2].length-2),infoCuentaArray[4],infoCuentaArray[0],infoCuentaArray[1],'facebook');
	}
}
function cargando(identifyLocal,identifyOther,tipo,imagenRed,redLocal,screenname){
  var cargandoText= "";
  cargandoText += ''+txt137+'<br /><br /><br />';
  cargandoText += '<div class="Knight-Rider-loader animate">';
	cargandoText += '<div class="Knight-Rider-bar"></div>';
	cargandoText += '<div class="Knight-Rider-bar"></div>';
	cargandoText += '<div class="Knight-Rider-bar"></div>';
  cargandoText += '</div>';
  $("#cargando").html(cargandoText);
  $(".ui-dialog-titlebar-close").hide();
  $("#cargando").dialog("open");
  $("#cargando").dialog('option', 'title', txt115);
  var parametros = { identify:identifyLocal, 
                     identify_account:identifyOther,
                     red:redLocal
			         };
  $.ajax({  data:  parametros,
			url:   'scripts/expire-token.php',
			type:  'GET',
			success:  function (response) { 
				if(response.indexOf("FALSE")!="-1"){ 
			      $("#cargando").closest('.ui-dialog-content').dialog('close');
				  toastr["error"](txt116, "ERROR");
				} else {
				  if(tipo=="twitter"){
					$.ajax({  data:  parametros,
							  url:   'twitter/stats/get-twitter-id-followers-cron.php?screen_name='+screenname.substr(1),
						   	  type:  'GET',
							  success:  function (response) {
					$.ajax({  data:  parametros,
							  url:   'twitter/stats/get-twitter-id-following-cron.php?screen_name='+screenname.substr(1),
						   	  type:  'GET',
							  success:  function (response) {
					$.ajax({  data:  parametros,
							  url:   'twitter/stats/get-twitter-notfollowingme-cron.php?screen_name='+screenname.substr(1),
						   	  type:  'GET',
							  success:  function (response) {
								$("#cargando").closest('.ui-dialog-content').dialog('close');
							    iniTwTools(identifyLocal,identifyOther,redLocal,imagenRed,screenname);
				                $(".ui-dialog-titlebar-close").show();
							  },
							  error: function (response){
							    //error primario
								$("#cargando").closest('.ui-dialog-content').dialog('close');
								toastr["error"](txt117, "ERROR");
								$(".ui-dialog-titlebar-close").show();
					          }
					});
					          }
					});
							  },
							  error: function (response){
							    //error primario
								$("#cargando").closest('.ui-dialog-content').dialog('close');
								toastr["error"](txt117, "ERROR");
								$(".ui-dialog-titlebar-close").show();
							  }
					});
				  } else if(tipo=="facebook"){
					$.ajax({  data:  parametros,
							  url:   '',
						   	  type:  'GET',
							  success:  function (response) {
							  $("#cargando").closest('.ui-dialog-content').dialog('close');
							    iniFaTools(identifyLocal,identifyOther,redLocal,imagenRed,tipo,screenname);
				                $(".ui-dialog-titlebar-close").show();
							  },
							  error: function (response){
							    //error primario
								$("#cargando").closest('.ui-dialog-content').dialog('close');
								toastr["error"](txt117, "ERROR");
								$(".ui-dialog-titlebar-close").show();
							  }
					});
				  } else {
					$("#cargando").closest('.ui-dialog-content').dialog('close');
				  }
				}
			},
			error: function (response){
			  $("#cargando").closest('.ui-dialog-content').dialog('close'); 
			  $(".ui-dialog-titlebar-close").show();
			  toastr["error"](txt117, "ERROR");
			}
  });
}
</script>
<script type="text/javascript">
    ////Variables Escribir
	var redesTeclasFa = 2000;
	var redesTeclasTw = 140;
</script>
<!-- <msdropdown> -->
<link rel="stylesheet" type="text/css" href="msdropdown/dd.css" />
<script src="msdropdown/jquery.dd.js"></script>
<!-- </msdropdown> -->
<script>
$(document).ready(function(e) {		
	//convert
	$("#seleccionarCuenta").msDropdown({roundedBorder:true});
});
</script>
<script type="text/javascript">
//facebook tools
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%46%61%63%65%62%6F%6F%6B%54%6F%6F%6C%73%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//twitter tools
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%54%77%69%74%74%65%72%54%6F%6F%6C%73%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
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
</script>
<link type="text/css" href="css/sortable.css" rel="stylesheet" media="all" />
</head>
<?php include 'body-script.php'; ?>
          <td style="vertical-align: top;"><table style="background-color: <?PHP echo $backgroundColor; ?>; border-radius: 0px 0px 10px 10px; width: 100%;">
              <tr>
                <td style="text-align: center; padding-top: 0em;">
                  <div style="display: inline-block; width: 250px; text-align: left;">
                    <select id="seleccionarCuenta" onchange="seleccionarCuenta()" style="display: inline-block; margin-top: 10px; width: 18em; height: 30px; padding: 0px 0px 0px 0px;">
                      <?PHP
				    $i=0;
				    foreach($feed_array_escribir as $item){
					  if($item['9']=="cuenta"){
						  if($item['1']=="twitter"){
						    ?><option data-description="Twitter" data-image="<?PHP echo $feed_array_escribir[$i][3]; ?>" value="<?PHP echo $item[1]; ?>|<?PHP echo $item[3]; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>|@<?PHP echo $item['2']; ?>" value="1" name="1"><?PHP echo '@'.$feed_array_escribir[$i][2].''; ?></option><?PHP
						  }
						  if($item['1']=="facebook"){
							?><option data-description="Facebook" data-image="<?PHP echo $feed_array_escribir[$i][3]; ?>" value="<?PHP echo $item[1]; ?>|<?PHP echo $item[3]; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>|<?PHP echo $item['2']; ?>" value="1" name="1"><?PHP echo $feed_array_escribir[$i][2]; ?></option><?PHP
						  }
					  } 
					  $i++;        
					}
					/*
					$i=0;
					foreach($feed_array_escribir as $item){
					  if($item['9']=="page"){
						  ?><option data-description="Fan Page" data-image="<?PHP echo $feed_array_escribir[$i][3]; ?>" value="page|<?PHP echo $item[3]; ?>|<?PHP echo $item['8']; ?><?PHP echo substr($item['1'],0,2); ?>|<?PHP echo $item['2']; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>" value="1" name="1"><?PHP echo $feed_array_escribir[$i][2]; ?></option><?PHP
					  }  
					  $i++;         
					}
					$i=0;
					foreach($feed_array_escribir as $item){
					  if($item['9']=="grupo"){
						  ?><option data-description="Grupo" data-image="<?PHP echo $feed_array_escribir[$i][3]; ?>" value="grupo|<?PHP echo $item[3]; ?>|<?PHP echo $item['8']; ?><?PHP echo substr($item['1'],0,2); ?>|<?PHP echo $item['2']; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>" value="1" name="1"><?PHP echo $feed_array_escribir[$i][2]; ?></option><?PHP
					  } 
					  $i++;          
					}
					*/
				?>
                    </select>
                  </div>
                  <div style="display: inline-block;">
                    <img style="margin-top: -20px;" src="images/mano.png">
                  </div>
                <div class="row">
                  <div id="mostrarDetallesTools" style="display: none; margin-top: 10px; text-align: center;" class="col-md-12">
                    <div style="text-align: center;" class="col-md-3">
                      <button style="font-size: 12px; width: 200px;" class="btn btn-primary">Seguidores <br /><p id="seguidoresTools123" style="padding: 0; margin: 0;">500</p></button>
                    </div>
                    <div style="text-align: center;" class="col-md-3">
                      <button style="font-size: 12px; width: 200px;" class="btn btn-success">Siguiendo <br /><p id="siguiendoTools123" style="padding: 0; margin: 0;">500</p></button>
                    </div>
                    <div style="text-align: center;" class="col-md-3">
                      <button style="font-size: 12px; width: 200px;" class="btn btn-warning">Límite Siguiendo <br /><p id="limSiguiendoTools123" style="padding: 0; margin: 0;">500</p></button>
                    </div>
                    <div style="text-align: center;" class="col-md-3">
                      <button style="font-size: 12px; width: 200px;" class="btn btn-danger">Límite Unfollows <br /><p id="limiteUnfollowsTools123" style="padding: 0; margin: 0;">500</p></button>
                    </div>
                  </div>
                </div>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 100%; padding-top: 15px;">
                  <ul style="padding-left: 45px; width: 100%;" id="sortable">
                    <?PHP
					$co=1;
					while($co<=9){
						?>
						<li style="height: auto; width: 28.9em;">
						  <div class="portlet">
							<div id="portlet-header" class="portlet-header">
							  <div style="position: absolute; display: inline-block;"><img class="imgIcon<?PHP echo $co; ?>" src="images/engrane.png" style="width: 2.0em; float:left; padding:0px; top: 0px;" title="Herramientas" alt="H" /></div>
									<div class="textoS" id="main-feed<?PHP echo $co; ?>Text"></div>
                                    <div class="acercaSR" title="<?PHP echo $txt["txt48"]; ?>"></div>
									<div class='ui-icon ui-icon-minusthick portlet-toggle' title="<?PHP echo $txt["txt72"]; ?>"></div>
									<div id="portletheaderClose<?PHP echo $co; ?>" onclick="portletHeaderClose(this.id);" class='closeS' title="<?PHP echo $txt["txt219"]; ?>"></div>
									</div>
									<div id="main-feed<?PHP echo $co; ?>" class="portlet-content" style="display: inline-block; z-index: 0; border: 0px solid #283147; width: 100%; text-align: center; overflow-y: auto; height: 18.5em;"> </div>
							</div>
						  </div>
						</li>
                        <?php
						$co++;
					}
					?>
                  </ul>
                  <div id="help">
                  </div>
                  <div id="ventana">
                  </div>
                  <div id="cargando">
                  </div>
                  <div style="text-align: center;" id="arrayUsers">
                    <?PHP echo $txt["txt301"]; ?><input type="text" id="palabraArrayUser" onkeyup="buscarArraUser();" /><br /><br />
                    <div id="arrayUsersContent">
                    </div>
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