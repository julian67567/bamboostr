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
	cargando(identify,'',red,imageProfileDefault,red);

    $("#ventana").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	  closeOnEscape: false,
	}); 
  });
  
  
  <!--Llamadas iniciales a las funciones-->
  <!-- getUserDetails(); -->
  <!-- dejaDeSeguirCont(); -->
  <!-- getAutoDmDetails(); -->
});
</script>
<script type="text/javascript">
//VARIABLES
var tt;
var opts;
//FUNCIONES
function seleccionarCuenta(){
	infoCuenta=document.getElementById("seleccionarCuenta").value;
	infoCuentaArray=infoCuenta.split("|");
	if(infoCuentaArray[0]=="twitter"){
	  cargando(infoCuentaArray[2].substr(0,infoCuentaArray[2].length-2),infoCuentaArray[4],infoCuentaArray[0],infoCuentaArray[1],'twitter');
	} 
	if(infoCuentaArray[0]=="facebook"){
	  cargando(infoCuentaArray[2].substr(0,infoCuentaArray[2].length-2),'',infoCuentaArray[0],infoCuentaArray[1],'facebook');
	} 
	if(infoCuentaArray[0]=="page"){
	  cargando(infoCuentaArray[2].substr(0,infoCuentaArray[2].length-2),infoCuentaArray[4],infoCuentaArray[0],infoCuentaArray[1],'facebook');
	} 
	if(infoCuentaArray[0]=="grupo"){
	  cargando(infoCuentaArray[2].substr(0,infoCuentaArray[2].length-2),infoCuentaArray[4],infoCuentaArray[0],infoCuentaArray[1],'facebook');
	}
}
function cargando(identifyLocal,identifyOther,tipo,imagenRed,redLocal){
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
					$("#cargando").dialog("close");
                                        $(".ui-dialog-titlebar-close").show(); 
				  } else if(tipo=="facebook"){
                                        iniShareFa(identifyLocal,identifyOther,tipo,imagenRed,redLocal);
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
// D3 y XCharts
document.write(unescape("%3C%73%63%72%69%70%74%20%73%72%63%3D%22%78%43%68%61%72%74%2F%64%33%2E%6D%69%6E%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
document.write(unescape("%3C%73%63%72%69%70%74%20%73%72%63%3D%22%78%43%68%61%72%74%2F%78%63%68%61%72%74%73%2E%6D%69%6E%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
// ChartsJs
document.write(unescape("%3C%73%63%72%69%70%74%20%73%72%63%3D%22%63%68%61%72%74%73%4A%73%2F%43%68%61%72%74%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
</script>

<script type="text/javascript" src="js/faNetwork.js"></script>
<link rel="stylesheet" href="xChart/css/master.css">
<link type="text/css" href="css/sortable.css" rel="stylesheet" media="all" />
<link rel="stylesheet" href="chartsJs/dona.css">
</head>
<?php include 'body-script.php'; ?>
          <td style="vertical-align: top;"><table style="background-color: <?PHP echo $backgroundColor; ?>; border-radius: 0px 0px 10px 10px; width: 100%;">
              <tr>
                <td style="text-align: center; padding-top: 10px;">
                  <select id="seleccionarCuenta" onchange="seleccionarCuenta()" style="width: 200px; height: 30px; padding: 0px 0px 0px 0px;">
                  <?PHP
				    $i=0;
				    foreach($feed_array_escribir as $item){
					  if($item['9']=="cuenta"){
						  if($item['1']=="twitter"){
						    ?><option value="<?PHP echo $item[1]; ?>|<?PHP echo $item[3]; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>|@<?PHP echo $item['2']; ?>" style="vertical- text-align: left; height: 40px; width: 100%; background: url(<?PHP echo ''.$feed_array_escribir[$i][3].''; ?>) no-repeat scroll right center / 40px 40px;" value="1" name="1"><?PHP echo '@'.$feed_array_escribir[$i][2].''; ?></option><?PHP
						  }
						  if($item['1']=="facebook"){
							?><option value="<?PHP echo $item[1]; ?>|<?PHP echo $item[3]; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>|<?PHP echo $item['2']; ?>" style="vertical- text-align: left; height: 40px; width: 100%; background: url(<?PHP echo ''.$feed_array_escribir[$i][3].''; ?>) no-repeat scroll right center / 40px 40px;" value="1" name="1"><?PHP echo $feed_array_escribir[$i][2]; ?></option><?PHP
						  }
					  } 
					  $i++;        
					}
                                        /*
					$i=0;
					foreach($feed_array_escribir as $item){
					  if($item['9']=="page"){
						  ?><option value="page|<?PHP echo $item[3]; ?>|<?PHP echo $item['8']; ?><?PHP echo substr($item['1'],0,2); ?>|<?PHP echo $item['2']; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>" style="vertical- text-align: left; height: 40px; width: 100%; background: url(<?PHP echo ''.$feed_array_escribir[$i][3].''; ?>) no-repeat scroll right center / 40px 40px;" value="1" name="1"><?PHP echo $feed_array_escribir[$i][2]; ?></option><?PHP
					  }  
					  $i++;         
					}
					$i=0;
					foreach($feed_array_escribir as $item){
					  if($item['9']=="grupo"){
						  ?><option value="grupo|<?PHP echo $item[3]; ?>|<?PHP echo $item['8']; ?><?PHP echo substr($item['1'],0,2); ?>|<?PHP echo $item['2']; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>" style="vertical- text-align: left; height: 40px; width: 100%; background: url(<?PHP echo ''.$feed_array_escribir[$i][3].''; ?>) no-repeat scroll right center / 40px 40px;" value="1" name="1"><?PHP echo $feed_array_escribir[$i][2]; ?></option><?PHP
					  } 
					  $i++;          
					}
					*/
				  ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top; width: 100%; padding-top: 15px;">
                  <ul style="padding-left: 45px; width: 100%;" id="sortable">
                    <?PHP
					$co=1;
					while($co<=2){
						?>
						<li style="height: 330px; width: 28.9em;">
						  <div class="portlet">
							<div id="portlet-header" class="portlet-header">
							  <div style="position: absolute; display: inline-block;"><img src="images/statics.png" style="width: 2.3em; float: left; padding:0px; top: 0px;" alt="S" /></div>
							  <div class="textoS" id="main-feed<?PHP echo $co; ?>Text"></div>
                                                          <div class="acercaSR" title="<?PHP echo $txt["txt48"]; ?>"></div>
							  <div class='ui-icon ui-icon-minusthick portlet-toggle' title="<?PHP echo $txt["txt72"]; ?>"></div>
							  <div id="portletheaderClose<?PHP echo $co; ?>" onclick="portletHeaderClose(this.id);" class="closeS" title="<?PHP echo $txt["txt219"]; ?>"></div>
							</div>
						        <div id="main-feed<?PHP echo $co; ?>" class="portlet-content" style="display: inline-block; z-index: 0; border: 0px solid #283147; width: 100%; text-align: center;"> </div>
							</div>
						  </div>
						</li>
                        <?php
						$co++;
					}
					?>
                  </ul>
                  <div id="ventana">
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
