 <?PHP
$redSocial=$_GET["redSocial"];
include 'scripts/detectLanguageExplorer.php';
if($redSocial=="twitter")
  include 'login-twitter.php';
else if($redSocial=="facebook")
  include 'login-facebook.php';
require_once("scripts/mobileDetect.php");
if(class_exists('Mobile_Detect'))
{ $detect = new Mobile_Detect();
  $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
}
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
<?PHP include 'textos.php' ?>
</script>
<script type="text/javascript">
  var identify = '<?PHP echo $identify; ?>';
  var screen_name = '<?PHP echo $screen_name; ?>';
  var ssid = '<?PHP echo $ssid; ?>';
  var red = '<?PHP echo $redSocial; ?>';
  var id_token = '<?PHP echo $_SESSION['id_token']; ?>';
  var urlPathActual = 'profile';
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
	$c=0;
	 ?>
	 
	   var htmlSignIn = $('#main-feed<?PHP echo $c; ?>').html();
	   htmlSignIn += '<table style="width: 100%; text-align: center;">';
	     htmlSignIn += '<tr>';
	       htmlSignIn += '<td style="font-size: 1.1em; color: #FFFFFF; width: 100%; text-align: center;"><?PHP echo $txt["txt56"]; ?><br /><br /></td>';
		 htmlSignIn += '</tr>';
		 htmlSignIn += '<tr>';
		 htmlSignIn += '<td><img style="width: 10em;" src="images/agregar2.png" alt="<?PHP echo $txt["txt75"]; ?>" title="<?PHP echo $txt["txt75"]; ?>" /><br /><br /></td>';
		 htmlSignIn += '</tr>';
		 htmlSignIn += '<tr>';
		 <?PHP
		 if($redSocial=="facebook"){
		   ?>htmlSignIn += '<td style="width: 100%; text-align: center;"><a href="twitter/redirect.php?identify=<?PHP echo $identify; ?>&ssid=<?PHP echo $ssid; ?>"><img title ="'+txt76+'" alt="'+txt76+'" src="images/twitter-signin.png"></a></td>';<?php
		 } else if($redSocial=="twitter") {
		   ?>htmlSignIn += '<td style="width: 100%; text-align: center;"><a href="twitter/redirect.php?identify=<?PHP echo $identify; ?>&ssid=<?PHP echo $ssid; ?>"><img title ="'+txt76+'" alt="'+txt76+'" src="images/twitter-signin.png"></a></td>';<?php
		 } 
		 ?>
	     htmlSignIn += '</tr>';
		 htmlSignIn += '<tr>';
		   <?PHP
		   if($redSocial=="facebook"){
		     ?>htmlSignIn += '<td style="width: 100%; text-align: center;"><a href="facebook/clearsessions.php?redirect=2&access_token=<?PHP echo $_SESSION["access_token"];?>"><img title ="'+txt77+'" alt="'+txt77+'" src="images/facebook-signin.png"></a></td>';<?PHP
		   } else if($redSocial=="twitter"){
		     ?>htmlSignIn += '<td style="width: 100%; text-align: center;"><a href="facebook/redirect.php?redirect=1&identify=<?PHP echo $identify; ?>&ssid=<?PHP echo $ssid; ?>"><img title ="'+txt77+'" alt="'+txt77+'" src="images/facebook-signin.png"></a></td>';<?PHP
		   }
		   ?>
	     htmlSignIn += '</tr><tr><td><br /></td></tr>';
	   htmlSignIn += '</table>';
       $('#main-feed<?PHP echo $c; ?>').html(htmlSignIn);
	   $('#main-feed0').parent().css("background-color","#2e70b9");
	 
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
	 $('#tableSys<?PHP echo $c; ?>').css("background-color","#394665");
	 $('#tableSys<?PHP echo $c; ?>').css("border","1px solid #000");
	 $('#tableSys<?PHP echo $c; ?>').css("cursor","pointer");
	 $('#expandirSys').css("width","20%");
  }, function(){
	 $('#tableSys<?PHP echo $c; ?>').css("background-color","#283147");
	 $('#tableSys<?PHP echo $c; ?>').css("border","1px none #000");
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
      $('#expandirSys').css("z-index","1");
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
    $('#expandirSys').css("z-index","0");
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
  <!--Llamadas iniciales a las funciones-->
  <!-- getUserDetails(); -->
  <!-- dejaDeSeguirCont(); -->
  <!-- getAutoDmDetails(); -->

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
  });

});
</script>
<script type="text/javascript">
//FUNCIONES
function eliminarUser(userEliminar, name){
	var parametros = { identifyEliminar:userEliminar, identify:identify, red:'<?PHP echo $redSocial; ?>'};
	$.ajax({	data:  parametros,
				url:   "scripts/eliminarUser.php",
				type:  "post",
				success:  function (response) {
					if(response.indexOf("true")!="-1"){
					  alert(name + " " + txt147);
					  window.location = "profile.php?redSocial=<?PHP echo $redSocial; ?>&identify="+identify+"&ssid="+ssid+"";
					} else {
					  alert(txt92);
					}
				} , error: function(response){
					alert(txt92);
				}
			});
}
</script>
<script type="text/javascript">
    ////Variables Escribir
	var redesTeclasFa = 2000;
	var redesTeclasTw = 140;
</script>
<script type="text/javascript" src="js/notificaciones-jq.js"></script>
<script type="text/javascript" src="js/getNotificaciones.js"></script>
<script type="text/javascript" src="js/escribir-jq.js"></script>
<script type="text/javascript" src="js/escribir.js"></script>
<link type="text/css" href="css/sortable.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="js/sortable-jq.js"></script>
<script type="text/javascript" src="js/sortable.js"></script>
<script type="text/javascript" src="js/ayuda.js"></script>
</head>
<?php include 'body-script.php'; ?>
          <td style="vertical-align: top;"><table style="background-color: <?PHP echo $backgroundColor; ?>; border-radius: 0px 0px 10px 10px; width: 100%;">
              <tr>
                <td style="vertical-align: top; width: 100%; padding-top: 15px;">
                
                <div style="padding-left: 60px;" class="column">
                  <div class="portlet">
                    <div id="portlet-header" class="portlet-header">
                      <div class="cuentaS"></div>
                      <div class="textoS">Cuentas</div>
                      <div onclick="help('1','agregar');" class="acercaSR"></div>
                      <div class='ui-icon ui-icon-minusthick portlet-toggle'></div>
                      <div id="portletheaderClose0" onclick="portletHeaderClose(this.id);" class="closeS"></div>
                    </div>
                    <div id="main-feed0" class="portlet-content" style="background-color: #2e70b9; display: block; z-index: 0; border: 0px solid #283147; text-align: center;"></div>
                  </div><br />
                  
                  
                  <div class="portlet">
                    <div id="portlet-header" class="portlet-header"><div class="generalS"></div><div class="textoS">General</div><div class="acercaSR"></div><div class='ui-icon ui-icon-minusthick portlet-toggle'></div><div id="portletheaderClose1" onclick="portletHeaderClose(this.id);" class="closeS"></div></div>
                    <div id="main-feed1" class="portlet-content" style="top: 250px; left: 70px; display: inline-block; z-index: 0; border: 0px solid #283147; text-align: center;">
                        <table style=" width: 100%; text-align: center;">
                          <tr>
                            <td style="text-align: center; width: 100%;"><table style="text-align: center; width: 100%;">
                                <tr>
                                  <td style="font-size: 1em; width: 100%; color: #FFFFFF;"><?PHP echo $txt["txt190"]; ?></td>
                                </tr>
                                <tr>
                                  <td style="text-align: left; width: 75%;"><?PHP echo $txt["txt53"]; ?>:</td>
                                  <td style="text-align: center; width: 25%;"><select name="idioma" value="idioma">
                                      <option name="<?PHP echo $txt["txt54"]; ?>" value="<?PHP echo $txt["txt54"]; ?>"> <?PHP echo $txt["txt54"]; ?> </option>
                                      <option name="<?PHP echo $txt["txt55"]; ?>" value="<?PHP echo $txt["txt55"]; ?>"> <?PHP echo $txt["txt55"]; ?> </option>
                                    </select></td>
                                </tr>
                                <tr>
                                  <td style="text-align: left; width: 75%;"><?PHP echo $txt["txt123"]; ?>:</td>
                                  <td style="text-align: center; width: 25%;">
                                      <input style="width: 100%;" type="text" value="" name="mail" /></td>
                                </tr>
                                <tr>
                                  <td style="text-align: left; width: 75%;"><?PHP echo $txt["txt42"]; ?>:</td>
                                  <td style="text-align: center; width: 25%;">
                                      <input type="checkbox" name="notifications" value="notifications" id="tweetsCheck<?PHP echo $c; ?>" checked></td>
                                </tr>
                                <tr>
                                  <td style="text-align: left; width: 75%;"><?PHP echo $txt["txt128"]; ?>:</td>
                                  <td style="text-align: center; width: 25%;">
                                      <input type="checkbox" name="notifications" value="msgpro" id="msgpro" checked></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"><input id="saveProfile" type="button" style="margin: 10px 0px 0px 0px; background: url(http://infomundo.org/Themes/blue_boxy/images/custom/board2.png) repeat-x scroll 0 0 rgba(0, 0, 0, 0); background-image: url(http://infomundo.org/Themes/blue_boxy/images/custom/board2.png);color: #ffffff;" value="<?PHP echo $txt["txt57"]; ?>" name="saveProfile"></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <ul style="width: 100%; padding-left: 21em;" id="sortable">
                      <?PHP
                      $grupos=0;
                      $c=2;
                      $query=$conn->query("SELECT social_networks FROM token WHERE identify='".$identify."' AND red='".$redSocial."'");
                      $row=$query->fetch_assoc();
                      $social_networks_parts=explode(",",$row["social_networks"]);
                      foreach($social_networks_parts as &$item){
                          if($item){
                              if($grupos==0){
                                $query2=$conn->query("SELECT id,red,link,screen_name,foto,expire_token,feed_perfil,feed_noticias,feed_mentions,feed_dms 
                                                     FROM token WHERE identify='".$identify."' AND red='".$redSocial."'");
                                $row2=$query2->fetch_assoc();
                                $id_token=$row2["id"];
                                $red=$row2["red"];
                                $link=$row2["link"];
                                $screen_name_tmp=$row2["screen_name"];
                                $foto=$row2["foto"];
				$expire_token=$row2["expire_token"];
                                $grupos++;
                              } else {
                                $query2=$conn->query("SELECT tok.red,tok.link,tok.screen_name,tok.foto,tok.expire_token,
                                                            gr.feed_perfil,gr.feed_noticias,gr.feed_mentions,gr.feed_dms
                                                     FROM token AS tok INNER JOIN grupos AS gr 
                                                     ON  tok.identify='".substr($item,2,strlen($item))."'
                                                     AND tok.social_networks like ('%".$item."%')
                                                     AND gr.grupo='".$identify."'
                                                     AND gr.id_token='".$id_token."'
                                                     ORDER BY gr.id ASC
                                                     LIMIT ".($grupos-1).",1");
                                unset($row2);					 
                                $row2=$query2->fetch_assoc();
                                $red=$row2["red"];
                                $link=$row2["link"];
                                $screen_name_tmp=$row2["screen_name"];
                                $foto=$row2["foto"];
				$expire_token=$row2["expire_token"];
                                $grupos++;
                              }
                              ?>
                            <li style="height: 330px; width:250px;">
                              <div class="portlet">
                                <div id="portlet-header" class="portlet-header">
                                <?PHP
									if($red=="facebook"){
									  ?><div style="position: absolute; display: inline-block;"><img src="images/f.png" style="float:left; padding:0px; top: 0px; width: 2.0em;" alt="facebook bird" /></div><?PHP
									}
									else if($red=="twitter"){
									  ?><div style="position: absolute; display: inline-block;"><img src="images/t.png" style="float:left; padding:0px; top: 0px; width: 2.0em;" alt="twitter bird" /></div><?PHP
									}
								?> 
                                <div class="textoS"><?PHP echo $screen_name_tmp; ?></div><div class="acercaSR"></div><div class='ui-icon ui-icon-minusthick portlet-toggle'></div><div id="portletheaderClose<?PHP echo $c; ?>" onclick="portletHeaderClose(this.id);" class='closeS'></div></div>
                                <div id="main-feed<?PHP echo $c; ?>" class="portlet-content" style="display: block; z-index: 0; border: 0px solid #283147; text-align: center;">
                                <table style=" width: 100%; text-align: center;">
                                <tr>
                                    <td style="text-align: center;">
                                    <?PHP
									  if($expire_token==1){
									    echo $txt["txt68"];
									  }
									?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center;"><img src="<?PHP echo $foto; ?>" /></td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center; width: 100%;"><table style="text-align: center; width: 100%;">
                                        <tr>
                                          <td style="text-align: left; width: 75%;"> 
                                          <?PHP
                                            if($red=="facebook"){
                                              echo $txt["txt59"];
                                            }
                                            else if($red=="twitter"){
                                              ?>Tweets<?PHP
                                            }
                                          ?> 
                                          </td>
                                          <td style="text-align: center; width: 25%;">
                                          <?PHP
                                            if($row2["feed_perfil"]==1){
                                              ?>
                                              <input type="checkbox" name="tweetsCheck<?PHP echo $c; ?>" value="tweetsCheck<?PHP echo $c; ?>" id="tweetsCheck<?PHP echo $c; ?>" checked>
                                              <?PHP
                                            } else {
                                              ?>
                                              <input type="checkbox" name="tweetsCheck<?PHP echo $c; ?>" value="tweetsCheck<?PHP echo $c; ?>" id="tweetsCheck<?PHP echo $c; ?>">
                                              <?PHP
                                            }
                                          ?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="text-align: left; width: 75%;"><?PHP echo $txt["txt50"]; ?></td>
                                          <td style="text-align: center; width: 25%;">
                                          <?PHP
                                            if($row2["feed_noticias"]==1){
                                              ?>
                                              <input type="checkbox" name="inicioCheck<?PHP echo $c; ?>" value="inicioCheck<?PHP echo $c; ?>" id="inicioCheck<?PHP echo $c; ?>" checked>
                                              <?PHP
                                            } else {
                                              ?>
                                              <input type="checkbox" name="inicioCheck<?PHP echo $c; ?>" value="inicioCheck<?PHP echo $c; ?>" id="inicioCheck<?PHP echo $c; ?>">
                                              <?PHP
                                            }
                                          ?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="text-align: left; width: 75%;">
                                          <?PHP
                                            if($red=="facebook"){
                                              echo $txt["txt60"];
                                            }
                                            else if($red=="twitter"){
                                              ?>DM's<?PHP
                                            }
                                          ?> 
                                           </td>
                                          <td style="text-align: center; width: 25%;">
                                          <?PHP
                                            if($row2["feed_dms"]==1){
                                              ?>
                                              <input type="checkbox" name="dmsCheck<?PHP echo $c; ?>" value="dmsCheck<?PHP echo $c; ?>" id="dmsCheck<?PHP echo $c; ?>" checked>
                                              <?PHP
                                            } else {
                                              ?>
                                              <input type="checkbox" name="dmsCheck<?PHP echo $c; ?>" value="dmsCheck<?PHP echo $c; ?>" id="dmsCheck<?PHP echo $c; ?>">
                                              <?PHP
                                            }
                                          ?>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="text-align: left; width: 75%;"><?PHP echo $txt["txt51"]; ?></td>
                                          <td style="text-align: center; width: 25%;">
                                          <?PHP
                                            if($row2["feed_mentions"]==1){
                                              ?>
                                              <input type="checkbox" name="mencionesCheck<?PHP echo $c; ?>" value="mencionesCheck<?PHP echo $c; ?>" id="mencionesCheck<?PHP echo $c; ?>" checked>
                                              <?PHP
                                            } else {
                                              ?>
                                              <input type="checkbox" name="mencionesCheck<?PHP echo $c; ?>" value="mencionesCheck<?PHP echo $c; ?>" id="mencionesCheck<?PHP echo $c; ?>">
                                              <?PHP
                                            }
                                          ?>
                                          </td>
                                        </tr>
                                        <?PHP
                                        if($red=="facebook"){
                                          ?>
                                          <tr>
                                            <td style="text-align: left; width: 100%;">
                                              <a style="color: #428bca; text-decoration: none; cursor: pointer;">Fan Page's</a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td style="text-align: left; width: 100%;">
                                              <a style="color: #428bca; text-decoration: none; cursor: pointer;"><?PHP echo $txt["txt63"]; ?></a>
                                            </td>
                                          </tr>
                                          <?PHP
                                        }
                                        ?>
                                        <tr>
                                            <td style="text-align: left; width: 100%;">
                                              <a style="color: #428bca; text-decoration: none; cursor: pointer;"><?PHP echo $txt["txt45"]; ?></a>
                                            </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center; width: 100%;">
                                    <?PHP
                                      if($_SESSION["identify"]==substr($item,2,strlen($item))){
                                        ?><h1>Admin</h1><?PHP
										  ?><a onclick="eliminarUser('<?PHP echo $item; ?>','<?PHP echo $screen_name_tmp; ?>');" style="color: #428bca; text-decoration: none; cursor: pointer;"><?PHP echo $txt["txt58"]; ?></a><?PHP
										
                                      }
                                      else{
                                        ?><a onclick="eliminarUser('<?PHP echo $item; ?>','<?PHP echo $screen_name_tmp; ?>');" style="color: #428bca; text-decoration: none; cursor: pointer;"><?PHP echo $txt["txt58"]; ?></a><?PHP
                                      }
                                    ?>
                                    </td>
                                  </tr>
                                </table>
                                </div>
                              </div>
                            </li> 
						  <?PHP
						  $c++;
					  }
				  }
				  ?>
                  </ul>
                  <div id="cargando"></div>
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
<!--Funcionalidad del menú Mobile--> 
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html><?PHP
} else {
  include "error-script.php";
}?>
