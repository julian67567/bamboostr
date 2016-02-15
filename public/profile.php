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
  var ssid = '<?PHP echo $ssid; ?>';
  var red = '<?PHP echo $redSocial; ?>';
  var id_token = '<?PHP echo $_SESSION['id_token']; ?>';
  var urlPathActual = 'profile';
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
    $("#fanPages").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	  closeOnEscape: false,
	}); 
    getMail();
    rastrear("profile");
  });

});
</script>
<script type="text/javascript" src="js/rastreo.js"></script>
<script type="text/javascript">
    ////Variables Escribir
	var redesTeclasFa = 2000;
	var redesTeclasTw = 140;
</script>
<script type="text/javascript">
//perfil
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%70%72%6F%66%69%6C%65%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
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
                <td style="vertical-align: top; width: 100%; padding-top: 15px;">
                
                      <?PHP
                      $grupos=0;
                      $c=2;
                      $query=$conn->query("SELECT social_networks FROM token WHERE id='".$_SESSION['id_token']."'");
                      $row=$query->fetch_assoc();
                      $social_networks_parts=explode(",",$row["social_networks"]);
                      foreach($social_networks_parts as &$item){
                          if($item){
                              if($grupos==0){
                                $query2=$conn->query("SELECT id,red,link,screen_name,foto,expire_token,feed_perfil,feed_noticias,feed_mentions,feed_dms,feed_programados,feed_drafts,feed_events,feed_refresh,notificaciones
                                                     FROM token WHERE id='".$_SESSION['id_token']."'");
                                $row2=$query2->fetch_assoc();
                                $id_token=$row2["id"];
                                $red=$row2["red"];
                                $link=$row2["link"];
                                $screen_name_tmp=$row2["screen_name"];
                                $foto=$row2["foto"];
                                $expire_token=$row2["expire_token"];
                                $feed_programados=$row2["feed_programados"];
                                $feed_drafts=$row2["feed_drafts"];
                                $feed_events=$row2["feed_events"];
                                $feed_refresh=$row2["feed_refresh"];
                                $notificaciones=$row2["notificaciones"];
                                $grupos++;
                              ?>

                <div style="padding-left: 60px; width: 300px; float: left; padding-bottom: 100px;" class="column">
                  <div class="portlet">
                    <div id="portlet-header" class="portlet-header">
                      <div onclick="help('1','agregar');" class="cuentaS" title="<?PHP echo $txt["txt28"]; ?>"></div>
                      <div class="textoS"><?PHP echo $txt["txt28"]; ?></div>
                      <div onclick="help('1','agregar');" class="acercaSR" title="<?PHP echo $txt["txt48"]; ?>"></div>
                      <div class='ui-icon ui-icon-minusthick portlet-toggle' title="<?PHP echo $txt["txt72"]; ?>"></div>
                      <div id="portletheaderClose0" onclick="portletHeaderClose(this.id);" class="closeS" title="<?PHP echo $txt["txt219"]; ?>"></div>
                    </div>
                    <div id="main-feed0" class="portlet-content" style="width: 100%; background-color: #2e70b9; display: block; z-index: 0; border: 0px solid #283147; text-align: center; color: #FFFFFF;"></div>
                  </div><br />
                  
                  
                  <div class="portlet">
                    <div id="portlet-header" class="portlet-header">
                      <div onclick="help('1','configuracion');" class="generalS" title="<?PHP echo $txt["txt220"]; ?>"></div>
                      <div class="textoS"><?PHP echo $txt["txt220"]; ?></div>
                      <div onclick="help('1','configuracion');" class="acercaSR" title="<?PHP echo $txt["txt48"]; ?>"></div>
                      <div class='ui-icon ui-icon-minusthick portlet-toggle' title="<?PHP echo $txt["txt72"]; ?>"></div>
                      <div id="portletheaderClose1" onclick="portletHeaderClose(this.id);" class="closeS" title="<?PHP echo $txt["txt219"]; ?>"></div>
                    </div>
                    <div id="main-feed1" class="portlet-content" style="width: 100%; background-color: #2e70b9; display: inline-block; z-index: 0; border: 0px solid #283147; text-align: center; color: #FFFFFF;">
                        <table style=" width: 100%; text-align: center;">
                          <tr>
                            <td style="font-size: 1em; width: 100%;"><?PHP echo $txt["txt190"]; ?><br /><br /></td>
                          </tr>
                          <tr>
                            <td style="text-align: center; width: 100%;"><table style="text-align: center; width: 100%;">
                                <tr>
                                  <td style="text-align: left; width: 100%;"><?PHP echo $txt["txt53"]; ?>:</td>
                                </tr>
                                <tr>
                                  <td style="text-align: center; width: 100%;"><select style="width: 100%;" name="idioma" value="idioma">
                                      <option name="<?PHP echo $txt["txt54"]; ?>" value="<?PHP echo $txt["txt54"]; ?>"> <?PHP echo $txt["txt54"]; ?> </option>
                                      <!--<option name="<?PHP echo $txt["txt55"]; ?>" value="<?PHP echo $txt["txt55"]; ?>"> <?PHP echo $txt["txt55"]; ?> </option>-->
                                    </select></td>
                                </tr>
                                <tr>
                                  <td style="text-align: left; width: 100%;"><?PHP echo $txt["txt123"]; ?>:</td>
                                </tr>
                                <tr>
                                  <td style="text-align: center; width: 100%;">
                                      <input placeholder="<?PHP echo $txt["txt478"]; ?>" id="mail" style="width: 100%;" type="text" value="" name="mail" /></td>
                                </tr>
                                <tr>
                                  <td style="text-align: left; width: 100%;">
                                    <?PHP echo $txt["txt42"]; ?>: <input type="checkbox" name="notifications" value="notifications" id="notifications" <?PHP echo ($notificaciones==1) ? "checked" : "" ; ?> >
                                  </td>
                                </tr>
                                <tr>
                                  <td style="text-align: left; width: 100%;">
                                    <?PHP echo $txt["txt128"]; ?>: <input type="checkbox" name="msgpro" value="msgpro" id="msgpro" <?PHP echo ($feed_programados==1) ? "checked" : "" ; ?>></td>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="text-align: left; width: 100%;">
                                    <?PHP echo $txt["txt479"]; ?>: <input type="checkbox" name="draftspro" value="draftspro" id="draftspro" <?PHP echo ($feed_drafts==1) ? "checked" : "" ; ?>></td>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="text-align: left; width: 100%;">
                                    <?PHP echo $txt["txt482"]; ?>: <input type="checkbox" name="autorefresh" value="autorefresh" id="autorefresh" <?PHP echo ($feed_refresh==1) ? "checked" : "" ; ?>></td>
                                  </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td style="text-align: center;"><button onclick="guardarConfGeneral();" class="btn btn-success" id="saveProfile" value="<?PHP echo $txt["txt57"]; ?>" name="saveProfile"><?PHP echo $txt["txt57"]; ?></button></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <ul style="width: 100%; padding-left: 21em;" id="sortable">
                              <?PHP
                              } else {
                                $query2=$conn->query("SELECT tok.id as identor, tok.identify,tok.red,tok.link,tok.screen_name,tok.foto,tok.expire_token,
                                                            gr.feed_perfil,gr.feed_noticias,gr.feed_mentions,gr.feed_dms,gr.feed_events,gr.id
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
                                $id=$row2["id"];
                                $id2=$row2["identor"];
				                $identifyFa=$row2["identify"];
                                $grupos++;
                              }
                              ?>
                            <li style="height: auto; width:250px;">
                              <div style="margin-left: 5px; margin-bottom: 5px;" class="portlet">
                                <div id="portlet-header" class="portlet-header">
                                <?PHP
									if($red=="facebook"){
									  ?><div style="position: absolute; display: inline-block;"><img src="images/f.png" style="float:left; padding:0px; top: 0px; width: 2.0em;" alt="facebook bird" /></div><?PHP
									}
									else if($red=="twitter"){
									  ?><div style="position: absolute; display: inline-block;"><img src="images/t.png" style="float:left; padding:0px; top: 0px; width: 2.0em;" alt="twitter bird" /></div><?PHP
									}
								?> 
                                <div class="textoS"><?PHP echo $screen_name_tmp; ?></div>
                                <?PHP
                                  if($c==2){
                                    ?><div onclick="help('1','profile');" class="acercaSR" title="<?PHP echo $txt["txt48"]; ?>"></div><?PHP
                                  }
                                  if($c!=2){
                                    ?><div onclick="help('2','profile');" class="acercaSR" title="<?PHP echo $txt["txt48"]; ?>"></div><?PHP
                                  }
                                ?>
                                <div class='ui-icon ui-icon-minusthick portlet-toggle' title="<?PHP echo $txt["txt72"]; ?>"></div>
                                <div id="portletheaderClose<?PHP echo $c; ?>" onclick="portletHeaderClose(this.id);" class='closeS' title="<?PHP echo $txt["txt219"]; ?>"></div></div>
                                <div id="main-feed<?PHP echo $c; ?>" class="portlet-content" style="overflow-y: auto; height: 18em; display: block; z-index: 0; border: 0px solid #283147; text-align: center;">
                                <table style=" width: 100%; text-align: center;">
                                <tr>
                                    <td style="text-align: center;">
                                        <?PHP
                                        if($expire_token==1){
                                            echo $txt["txt524"];
                                        }
                                        ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center;">
                                    <?PHP
                                      if($_SESSION["identify"]==substr($item,2,strlen($item))){
                                        ?><button type="button" class="btn btn-danger btn-xs">Admin</button><?PHP				
                                      }
                                    ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: center;"><img style="width: 48px; height: 48px;" onerror="this.src='images/logo-bamboostr.png'" src="<?PHP echo $foto; ?>" /></td>
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
                                              <input onclick="columnas('<?PHP echo $id; ?>', '<?PHP echo $c; ?>', 'tweetsCheck');" type="checkbox" name="tweetsCheck<?PHP echo $c; ?>" value="tweetsCheck<?PHP echo $c; ?>" id="tweetsCheck<?PHP echo $c; ?>" checked>
                                              <?PHP
                                            } else {
                                              ?>
                                              <input onclick="columnas('<?PHP echo $id; ?>', '<?PHP echo $c; ?>', 'tweetsCheck');" type="checkbox" name="tweetsCheck<?PHP echo $c; ?>" value="tweetsCheck<?PHP echo $c; ?>" id="tweetsCheck<?PHP echo $c; ?>">
                                              <?PHP
                                            }
                                          ?>
                                          </td>
                                        </tr>
                                        
                                          <?PHP
                                            if($row2["feed_noticias"]==1 && $red=="twitter"){
                                              ?>
                                        <tr>
                                          <td style="text-align: left; width: 75%;">
                                            <?PHP echo $txt["txt50"]; ?>
                                          </td>
                                          <td style="text-align: center; width: 25%;">
                                              <input onclick="columnas('<?PHP echo $id; ?>', '<?PHP echo $c; ?>', 'inicioCheck');" type="checkbox" name="inicioCheck<?PHP echo $c; ?>" value="inicioCheck<?PHP echo $c; ?>" id="inicioCheck<?PHP echo $c; ?>" checked>
                                          </td>
                                        </tr>
                                              <?PHP
                                            } else if($red=="twitter") {
                                              ?>
                                         <tr>
                                          <td style="text-align: left; width: 75%;"><?PHP echo $txt["txt50"]; ?></td>
                                          <td style="text-align: center; width: 25%;">
                                              <input onclick="columnas('<?PHP echo $id; ?>', '<?PHP echo $c; ?>', 'inicioCheck');" type="checkbox" name="inicioCheck<?PHP echo $c; ?>" value="inicioCheck<?PHP echo $c; ?>" id="inicioCheck<?PHP echo $c; ?>">
                                              <?PHP
                                            }
                                          ?>
                                          </td>
                                        </tr>
                                          <?PHP
                                        /*
                                            if($red=="facebook"){
                                              echo $txt["txt60"];
                                            }
                                        */
                                            if($red=="twitter"){
                                              ?>
                                        <tr>
                                          <td style="text-align: left; width: 75%;">
                                             DM's
                                           </td>
                                          <td style="text-align: center; width: 25%;">
                                              <?PHP
                                            }
                                          ?> 
                                          <?PHP
                                            if($row2["feed_dms"]==1 && $red=="twitter"){
                                              ?>
                                              <input onclick="columnas('<?PHP echo $id; ?>', '<?PHP echo $c; ?>', 'dmsCheck');" type="checkbox" name="dmsCheck<?PHP echo $c; ?>" value="dmsCheck<?PHP echo $c; ?>" id="dmsCheck<?PHP echo $c; ?>" checked>
                                          </td>
                                        </tr>
                                              <?PHP
                                            } else if($red=="twitter") {
                                              ?>
                                              <input onclick="columnas('<?PHP echo $id; ?>', '<?PHP echo $c; ?>', 'dmsCheck');" type="checkbox" name="dmsCheck<?PHP echo $c; ?>" value="dmsCheck<?PHP echo $c; ?>" id="dmsCheck<?PHP echo $c; ?>">
                                          </td>
                                        </tr>
                                              <?PHP
                                            }
                                          ?>
                                        <tr>
                                          <td style="text-align: left; width: 75%;"><?PHP echo $txt["txt51"]; ?></td>
                                          <td style="text-align: center; width: 25%;">
                                          <?PHP
                                            if($row2["feed_mentions"]==1){
                                              ?>
                                              <input onclick="columnas('<?PHP echo $id; ?>', '<?PHP echo $c; ?>', 'mencionesCheck');" type="checkbox" name="mencionesCheck<?PHP echo $c; ?>" value="mencionesCheck<?PHP echo $c; ?>" id="mencionesCheck<?PHP echo $c; ?>" checked>
                                              <?PHP
                                            } else {
                                              ?>
                                              <input onclick="columnas('<?PHP echo $id; ?>', '<?PHP echo $c; ?>', 'mencionesCheck');" type="checkbox" name="mencionesCheck<?PHP echo $c; ?>" value="mencionesCheck<?PHP echo $c; ?>" id="mencionesCheck<?PHP echo $c; ?>">
                                              <?PHP
                                            }
                                          ?>
                                          </td>
                                        </tr>
                                          <?PHP
                                            if($row2["feed_events"]==1 && $red=="facebook"){
                                              ?>
                                        <tr>
                                          <td style="text-align: left; width: 75%;">
                                            <?PHP echo $txt["txt309"]; ?>
                                          </td>
                                          <td style="text-align: center; width: 25%;">
                                              <input onclick="columnas('<?PHP echo $id; ?>', '<?PHP echo $c; ?>', 'eventosCheck');" type="checkbox" name="eventosCheck<?PHP echo $c; ?>" value="eventosCheck<?PHP echo $c; ?>" id="eventosCheck<?PHP echo $c; ?>" checked>
                                          </td>
                                        </tr>
                                              <?PHP
                                            } else if($red=="facebook") {
                                              ?>
                                         <tr>
                                          <td style="text-align: left; width: 75%;"><?PHP echo $txt["txt309"]; ?></td>
                                          <td style="text-align: center; width: 25%;">
                                              <input onclick="columnas('<?PHP echo $id; ?>', '<?PHP echo $c; ?>', 'eventosCheck');" type="checkbox" name="eventosCheck<?PHP echo $c; ?>" value="eventosCheck<?PHP echo $c; ?>" id="eventosCheck<?PHP echo $c; ?>">
                                              <?PHP
                                            }
                                        ?>
                                        <?PHP
                                        if($red=="facebook"){
                                          ?>
                                        </table>
                                        <table style="text-align: center; width: 100%;">
                                          <tr>
                                            <td style="text-align: left; width: 100%;">
                                              <a onclick="abrirFanPages('<?PHP echo $id2; ?>','<?PHP echo $identifyFa; ?>');" style="color: #428bca; text-decoration: none; cursor: pointer;"><button style="font-size: 14px;" type="button" class="btn btn-warning btn-xs">Fan Page's</button></a>
                                            </td>
                                          </tr>
                                        
                                          <tr>
                                            <td style="text-align: left; width: 100%;">
                                              <a onclick="toastr['warning']('En Mantenimiento');" style="color: #428bca; text-decoration: none; cursor: pointer;"><button style="font-size: 14px;" type="button" class="btn btn-success btn-xs"><?PHP echo $txt["txt63"]; ?></button></a>
                                            </td>
                                          </tr>
                                          <?PHP
                                        }
                                        ?>
                                        <tr>
                                            <td style="text-align: left; width: 100%;">
                                              <a onclick="toastr['warning']('En Mantenimiento');" style="color: #428bca; text-decoration: none; cursor: pointer;"><button style="font-size: 14px;" type="button" class="btn btn-success btn-xs"><?PHP echo $txt["txt45"]; ?></button></a>
                                            </td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td style="text-align: left; width: 100%;">
                                      <button style="font-size: 14px;" class="btn btn-danger btn-xs" onclick="eliminarUser('<?PHP echo $item; ?>','<?PHP echo $screen_name_tmp; ?>');"><?PHP echo $txt["txt58"]; ?></button>
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
                  <div id="help"></div>
                  <div id="fanPages">
                  <?PHP
                    echo 'En mantenimiento';
                  ?>
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