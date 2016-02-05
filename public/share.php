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
<!--Loading-->
<link type="text/css" href="../css/style-loading.css" rel="stylesheet" media="all" />
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
  $('#tableSys3').css("border-left","5px solid #FFF");
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
	 $('#tableSys3').css("border-left","5px solid #FFF");
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
    $("#cargando").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	  closeOnEscape: false,
	}); 
	cargando(1);
        rastrear("share");
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
	numCat=document.getElementById("seleccionarCuenta").value;
	cargando(numCat);
}
function cargando(cat){
  var cargandoText= "";
  cargandoText += ''+txt118+'<br /><br /><br />';
  cargandoText += '<div class="Knight-Rider-loader animate">';
	cargandoText += '<div class="Knight-Rider-bar"></div>';
	cargandoText += '<div class="Knight-Rider-bar"></div>';
	cargandoText += '<div class="Knight-Rider-bar"></div>';
  cargandoText += '</div>';
  $("#cargando").html(cargandoText);
  $(".ui-dialog-titlebar-close").hide();
  $("#cargando").dialog("open");
  $("#cargando").dialog('option', 'title', txt115);
  
  iniShare(cat);
}
</script>
<script type="text/javascript">
    ////Variables Escribir
	var redesTeclasFa = 2000;
	var redesTeclasTw = 140;
</script>
<script type="text/javascript">
//get-share
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%53%68%61%72%65%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
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
<!--XCharts-->
<link type="text/css" href="css/sortable.css" rel="stylesheet" media="all" />
<link rel="stylesheet" href="xChart/css/master.css">
</head>
<?php include 'body-script.php'; ?>
          <td style="vertical-align: top;"><table style="background-color: <?PHP echo $backgroundColor; ?>; border-radius: 0px 0px 10px 10px; width: 100%;">
              <tr>
                <td style="text-align: center; padding-top: 0em;">
                  <div style="display: inline-block; width: 250px; text-align: left;">
                    <select id="seleccionarCuenta" onchange="seleccionarCuenta()" style="display: inline-block; margin: 0.9em 0em 0em 0em; width: 18em; height: 30px; padding: 0px 0px 0px 0px;">
                              <option value="1">Noticias, Política y Actualidad</option>
	                      <option value="2">Artes y Humanidades</option>
	                      <option value="3">Negocios y Finanzas</option>
	                      <option value="4">Autos</option>
	                      <option value="5">Educación</option>
	                      <option value="6">Entretenimiento</option>
	                      <option value="7">Belleza y Moda</option>
	                      <option value="8">Ejecicio</option>
	                      <option value="9">Comida y Bebida</a></option>
	                      <option value="10">Salud</option>
                              <option value="11">Música</option>
	                      <option value="12">Hogar y Estilo de vida</a></option>
	                      <option value="13">Crianza y Familia</a></option>
	                      <option value="14">Religión y Espiritualidad</a></option>
	                      <option value="15">Ciencia</option>
	                      <option value="16">Mercadotecnia</option>
	                      <option value="17">Deportes</option>
	                      <option value="18">Tecnología</option>
	                      <option value="19">Medio Ambiente</option>
	                      <option value="20">Viajes</option>
				?>
                    </select>
                  </div>
                  <div style="display: inline-block;">
                    <img style="margin-top: -10px;" src="images/mano.png">
                  </div>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 100%; padding-top: 15px;">
                 
                  <ul id="sortable" style="padding-left: 45px; width: 100%;">
                    <?PHP
					$co=1;
					while($co<=50){
						?>
						<li style="height: auto; width: 28.9em; display: none;">
						  <div class="portlet">
							<div style="background-color: #61A3EC;" id="portlet-header" class="portlet-header">
							  <div class="textoS" id="main-feed<?PHP echo $co; ?>Text"></div>
                                                          <div class="acercaSR" title="<?PHP echo $txt["txt48"]; ?>"></div>
							  <div class='ui-icon ui-icon-minusthick portlet-toggle' title="<?PHP echo $txt["txt72"]; ?>"></div>
							  <div id="portletheaderClose<?PHP echo $co; ?>" onclick="portletHeaderClose(this.id);" class="closeS" title="<?PHP echo $txt["txt219"]; ?>"></div>
							</div>
						        <div id="main-feed<?PHP echo $co; ?>" class="portlet-content" style="display: inline-block; z-index: 0; border: 0px solid #283147; width: 100%; text-align: center; overflow-y: auto; height: 23em;"> 
                                                          <div id="tituloShare<?PHP echo $co; ?>" style="display: block; font-size: 1.01em; padding-left: 1.5em; padding-right: 1.5em; width: 100%; color: #22304E; text-align: left; height: 4em; background-color: #B3D7FF;"></div>
                                                          <div style="vertical-align: middle; background: url('images/imagenesProtector.png') no-repeat center center; height: 6em; width: 100%; text-align: center; background-color: transparent; display: block;">
                                                            <img id="imageShare<?PHP echo $co; ?>" style="margin-top: 0.25em; vertical-align: middle; text-align: center; max-width: 80%; max-height: 80px;" />
                                                          </div>
                                                          <div style="width: 100%; display: block;">
                                                            <div id="fechaShare<?PHP echo $co; ?>" style="width: 50%; display: inline-block; padding-top: 0.3em; vertical-align: middle; height: 2em; color: black; background: url('images/fechaShare.png') no-repeat center center; float: right;"></div>
                                                            <div id="likeShare<?PHP echo $co; ?>" style="width: 50%; display: inline-block; float: left;"></div>
                                                          </div><br /><br />
                                                          <div id="descripcionShare<?PHP echo $co; ?>" style="height: 85px; width: 100%; display: block; padding-left: 1.5em; padding-right: 1.5em; color: black; text-align: left; background-color: white;"></div>
                                                          <div id="footerShare<?PHP echo $co; ?>" style="width: 100%; display: block; color: black; text-align: center; background-color: transparent;"></div>
                                                          
                                                          </div>
                                                        </div>
							</div>
						  </div>
						</li>
                        <?php
						$co++;
					}
					?>
                  </ul>

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