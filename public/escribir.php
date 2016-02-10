<?PHP
require_once(''.dirname(__FILE__).'/session.php');
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
	include ''.dirname(__FILE__).'/desktop/header.php';
	if(getUserLanguage()=="es")
	  include ''.dirname(__FILE__).'/lenguajes/espanol.php';
	else
	  include ''.dirname(__FILE__).'/lenguajes/ingles.php';
	header_desktop("".$txt["titulo3"]." ".$screen_name."");
	?>
<?PHP
if($identify){
    $query=$conn->query("SELECT social_networks FROM token WHERE identify='".$identify."' AND red='".$redSocial."'");
    $row=$query->fetch_assoc();
    $social_networks=$row["social_networks"];
    $social_networks_parts=explode(",",$social_networks);
    $c=0;
    include ''.dirname(__FILE__).'/scripts/query-write.php';
}
?>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/huso-horario.js"></script>
<!-- Resize -->
<script type="text/javascript" src="js/resize.js"></script>
<!-- watermark -->
<script type="text/javascript" src="js/watermark.js"></script>
<script type="text/javascript">
<?PHP include ''.dirname(__FILE__).'/textos.php' ?>
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
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});
</script>
<script>
<?PHP include ''.dirname(__FILE__).'/logins.php'; ?>
</script>
<script type="text/javascript">
//JQUERY
$(document).ready(function(){
  <?PHP

    include ''.dirname(__FILE__).'/menu-javaScript.php';
  ?>
  <?PHP
	$c=1;
	while($c<=$totalRedes){
	  ?>
	  $('#redes<?PHP echo $c; ?>').hover(function(){
	  },function(){
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
  });

});
$(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
  });
</script>
<script type="text/javascript" src="js/rastreo.js"></script>
<script type="text/javascript">
    ////Variables Escribir
	var redesTeclasFa = 2000;
        var redesTeclasIn = 2000;
	var redesTeclasTw = 140;
</script>
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

<!--Angular Librerías-->
<script type="text/javascript" src="angular/lib/escribir.js"></script>
<script type="text/javascript" src="angular/lib/nots.js"></script>
<script type="text/javascript" src="angular/lib/factory.js"></script>
<!--Fin angular-->

</head>
<body style="background-color: #f3f3f3;" ng-controller="escribirCtrl">
        <?PHP
            include ''.dirname(__FILE__).'/desktop/header-menu.php';
            headerMenu($_SESSION['foto_bamboostr']);
        ?>
        <?PHP
            include ''.dirname(__FILE__).'/loading.php';
        ?>
        
        <section id="main">
            <aside id="sidebar" class="">
                <div class="sidebar-inner c-overflow" tabindex="1" style="overflow: hidden; outline: none;">
                    <?PHP 
					  include ''.dirname(__FILE__).'/desktop/menu.php';
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
                        <a class="underline lato-bold" href="system.php">Inicio</a> > <a class="underline lato-bold" href="">Publicación Nueva</a>
                      </p><br />
                      <p style="padding-right: 50px; font-size: 20px; display: inline-block;" class="pull-right hidden-xs lato-bold">
                        <button onclick="abrirSignUpModal();" style="background-color: #26A8FF; margin-left: 50px;" class="btn waves-effect waves-light" type="submit" name="action">Agrega otra red social
                            <span class="fa fa-plus"></span>
                        </button>    
                      </p>
                      <p class="lato-bold" style="color: #14446d; padding-left: 50px; font-size: 28px; display: inline-block;">Publicación Nueva</p><br />
                      <p class="lato-bold" style="color: #929292; padding-left: 50px; font-size: 18px; display: inline-block;">Sigue los pasos y publica contenido de interés para tus clientes</p>
                    </div>
                </div>
              </div>

              <div class="col-md-2">
              </div>

          </div>  
        </section>

        <section id="body">
          <div class="row">

             <div class="col-md-2">
             </div>

              <div class="col-md-8">
                <div class="card">
                    <div class="card-content">
                      <!--1 Selecciona cuentas-->
                      <p class="lato-bold" style="color: #0a6ebd; padding-left: 10px; font-size: 20px; display: inline-block;">1. </p>
                      <p class="lato-bold" style="color: #929292; padding-left: 5px; font-size: 18px; display: inline-block;">Seleccionar Cuenta(s)</p><p style="color: #929292; padding-left: 50px; font-size: 17px; display: inline-block;" class="hidden-xs hidden-md hidden-lg lato-bold">Total: <?PHP echo $totalRedes-2; ?></p><br /><br />
                      <div class="row">
                        <?PHP
                            //si no hay cuentas vinculadas muestra texto
                            if($totalRedes-2==0){
                              ?>
                              <p style="text-align: center; color: red;" class="lato-bold">No tienes redes sociales agregadas</p>
                              <p style="text-align: center;">
                                <a style="cursor: pointer; text-align: center;" onclick="abrirSignUpModal();" class="lato-bold">Agrega una red</a>
                              </p>
                              <?PHP
                            }
                            //fin si no hay cuentas vinculadas muestra texto
                            $c=1;
                            foreach($feed_array_escribir as $item){
                              if($item['9']=="cuenta"){
                                  if($item['1']=="twitter"){
                                      ?><div onclick="agregarRedSocial('<?PHP echo $item[3]; ?>','<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>','<?PHP echo $c; ?>','@<?PHP echo $item['2']; ?>','');" id="redes<?PHP echo $c; ?>" style="padding-left: 0px; cursor: pointer; margin-right: 5px; margin-left: 5px; width: 50px; -webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;" class="col-xs-1 col-md-2 card tooltipped" data-position="top" data-tooltip="<?PHP echo ''.$item['2'].' Twitter'; ?>" ><?PHP
                                    } else if($item['1']=="facebook"){
                                      ?><div onclick="agregarRedSocial('<?PHP echo $item[3]; ?>','<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>','<?PHP echo $c; ?>','<?PHP echo $item['2']; ?>','');" id="redes<?PHP echo $c; ?>" style="padding-left: 0px; cursor: pointer; margin-right: 5px; margin-left: 5px; width: 50px; -webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;" class="col-xs-1 col-md-2 card tooltipped" data-position="top" data-tooltip="<?PHP echo ''.$item['2'].' Facebook'; ?>"><?PHP
                                    } else if($item['1']=="instagram"){
                                      ?><div onclick="agregarRedSocial('<?PHP echo $item[3]; ?>','<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>','<?PHP echo $c; ?>','<?PHP echo $item['2']; ?>','');" id="redes<?PHP echo $c; ?>" style="padding-left: 0px; cursor: pointer; margin-right: 5px; margin-left: 5px; width: 50px; -webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;" class="col-xs-1 col-md-2 card tooltipped" data-position="top" data-tooltip="<?PHP echo ''.$item['2'].' Instagram'; ?>"><?PHP
                                    }
                                  ?>
                                    <div class="card-content" style="display: table-row;">
                                      <div class="redesImage">
                                        <?PHP
                                        if($item['1']=="twitter"){
                                        ?><div style="position: absolute; right: 8px; top: 28px;" data-position="top" id="" class="img-circle"><img style="-webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; width:15px;" src="images/t.png"></img></div>
                                        <?PHP } else if($item['1']=="facebook"){
                                        ?><div style="position: absolute; right: 8px; top: 28px;" data-position="top" id="" class="img-circle"><img style="-webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; width:15px;" src="images/f.png"></img></div>
                                        <?PHP } else if($item['1']=="instagram"){
                                        ?><div style="position: absolute; right: 8px; top: 28px;" data-position="top" id="" class="img-circle"><img style="-webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; width:15px;" src="images/i.png"></img></div>
                                        <?PHP } ?>
                                        <img id="redesImg<?PHP echo $c; ?>" onerror="this.src='images/logo-bamboostr.png'" style="width: 50px;" src="<?PHP echo $item['3']; ?>" />
                                      </div>
                                    </div>
                                  </div>
                                  <?PHP
                                  $c++;
                              }
                            }
							foreach($feed_array_escribir as $item){
                              if($item['9']=="page"){
                                  ?>
                                  <div onclick="agregarRedSocial('<?PHP echo $item[3]; ?>','<?PHP echo $item['8']; ?><?PHP echo substr($item['1'],0,2); ?>','<?PHP echo $c; ?>','<?PHP echo $item['2']; ?>','<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>');" id="redes<?PHP echo $c; ?>" style="padding-left: 0px; cursor: pointer; margin-right: 5px; margin-left: 5px; width: 50px; -webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;" class="col-xs-1 col-md-2 card tooltipped" data-position="top" data-tooltip="<?PHP echo ''.$item['2'].' Facebook'; ?>">
                                    <div class="card-content" style="display: table-row;">
                                      <div class="redesImage">
                                        <div style="position: absolute; right: 8px; top: 28px;" data-position="top" id="" class="img-circle"><img style="-webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; width:15px;" src="images/f.png"></img></div>
                                        <img id="redesImg<?PHP echo $c; ?>" onerror="this.src='images/logo-bamboostr.png'" style="width: 50px;" src="<?PHP echo $item['3']; ?>" />
                                      </div>
                                    </div>
                                  </div>
                                  <?PHP
                                  $c++;
                              }
                            }
                            foreach($feed_array_escribir as $item){
                              if($item['9']=="grupo"){
                                  ?>
                                  <div onclick="agregarRedSocial('<?PHP echo $item[3]; ?>','<?PHP echo $item['8']; ?><?PHP echo substr($item['1'],0,2); ?>','<?PHP echo $c; ?>','<?PHP echo $item['2']; ?>','<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>');" id="redes<?PHP echo $c; ?>" style="padding-left: 0px; cursor: pointer; margin-right: 5px; margin-left: 5px; width: 50px; -webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px;" class="col-xs-1 col-md-2 card tooltipped" data-position="top" data-tooltip="<?PHP echo ''.$item['2'].' Facebook'; ?>">
                                    <div class="card-content" style="display: table-row;">
                                      <div class="redesImage">
                                        <img id="redesImg<?PHP echo $c; ?>" onerror="this.src='images/logo-bamboostr.png'" style="width: 50px;" src="<?PHP echo $item['3']; ?>" />
                                      </div>
                                    </div>
                                  </div>
                                  <?PHP
                                  $c++;
                              }

                            }
                          ?>
                      </div><hr style="border-width: 3px;"><br />
                      <!--2 Escribir Publicación-->
                      <p style="color: #0a6ebd; padding-left: 10px; font-size: 20px; display: inline-block;">2. </p>
                      <p style="color: #929292; padding-left: 5px; font-size: 18px; display: inline-block;">Escribir Publicación</p>
                      <p onclick="trends_block()" style="padding-right:16px; cursor: pointer; color: #43b3ff; font-size: 14px; display: inline-block; float:right" class="hidden-xs"><i style="font-size: 18px;" class="fa fa-sort-desc"></i></p>
                      <p onclick="trends_block()" style="padding-right:7px; padding-top:3px; cursor: pointer; color: #43b3ff; font-family: lato-bold; font-size: 14px; display: inline-block; float:right" class="hidden-xs">Recomendación de contenido </p><br /><br />

                      <div id="trendingTopicD" style="display: none; padding: 0; margin: 0;" class="row">
                        <div style="padding-left: 10px; margin: 0;" class="col-xs-12 text-left">
                          <p style="color: #0a6ebd; font-size: 16px;">Tendencias de Twitter</p>
                          <p style="color: #929292; font-size: 16px;">Los hashtags más usados en tu país</p><br>
                          <select style="display: block; width: 250px;" onchange="trends(this.value);" id="country">
                            <option value="23424900">México</option>
                            <option value="23424747">Argentina</option>
                            <option value="23424950">España</option>
                            <option value="23424982">Venezuela</option>
                            <option value="23424977">Estados Unidos</option>
                          </select><br>
                          <div id="trending" style="text-align: left;" class="col-xs-12">
                            <div class="Knight-Rider-loader animate">
	                      <div class="Knight-Rider-bar"></div>
	                      <div class="Knight-Rider-bar"></div>
	                      <div class="Knight-Rider-bar"></div>
	                      </div>
                          </div>
                        </div>
                      </div>
                      <br>
 
                      <div id="contenido" style="display: none; padding: 0; margin: 0;" class="row">
                        <div style="padding-left: 10px; margin: 0;" class="col-xs-12 text-left">
                          <p style="color: #0a6ebd; font-size: 16px;">Puedes elegir un artículo de tu preferencia</p>
                          <p style="color: #929292; font-size: 16px;">Elige una categoría</p><br>
                          <select style="display: block; width: 250px;" onchange="getCat(this.value);" id="country">
                            <option value="1">Noticias, Política y Actualidad</option>
                            <option value="2">Artes y Humanidades</option>
                            <option value="3">Negocios y Finanzas</option>
                            <option value="4">Autos</option>
                            <option value="5">Educación</option>
                            <option value="6">Entretenimiento</option>
                            <option value="7">Belleza y Moda</option>
                            <option value="8">Ejercicio</option>
                            <option value="9" selected>Comida y Bebida</option>
                            <option value="10">Salud</option>
                            <option value="11">Música</option>
                            <option value="12">Hogar y Estilo de vida</option>
                            <option value="13">Crianza y Familia</option>
                            <option value="14">Religión y Espiritualidad</option>
                            <option value="15">Ciencia</option>
                            <option value="16">Mercadotecnia</option>
                            <option value="17">Deportes</option>
                            <option value="18">Tecnología</option>
                            <option value="19">Medio Ambiente</option>
                            <option value="20">Viajes</option>
                          </select><br>

                          <div id="articulo" style="text-align: left;">
                           
                          <div class="Knight-Rider-loader animate">
	                      <div class="Knight-Rider-bar"></div>
	                      <div class="Knight-Rider-bar"></div>
	                      <div class="Knight-Rider-bar"></div>
	                  </div>

                          </div>

                        </div>
                      </div>

                      <div class="row">
                        <form class="col s12">
                          <div class="row" style="margin-bottom: 0px;">
                            <div class="col s12">
                              <textarea style="resize:none; height:100px; border-width:2px;" placeholder="Escribir Mensaje..." onkeyup="teclas()" id="comparte" name="comparte"></textarea>
                            </div>
                          </div>
                        </form>
                      </div>
<div class="row">
                        <!-- CONTADOR -->
                        <div style="padding: 0; margin: 0;" class="col-md-12 text-center">
                          <div style="width: 170px; padding: 0; margin: 0; margin-top: 0px;" class="col-md-2 text-left">
                            <div title="Texto Escrito" onclick="helpEscribir('1','escribirNum');" style="border-radius: 15px; margin-top: 0px; cursor: pointer; vertical-align: top; color: #929292; height: 24px;">
                              <p style="padding-top: 3px; padding-left: 15px; font-size: 12px;">No. de caracteres <span style="padding-top: 3px; padding-left: 15px; font-size: 12px;" id="compartirTxt">0</span></p>
                            </div>
                          </div>
                          
                          <!-- TWITTER -->

                          <div style="width: 100px; display: none; padding: 0; margin: 0; margin-top: 0px;" class="col-md-1 text-center" id="contTw">
                            <div title="Texto Escrito" onclick="helpEscribir('1','escribirNum');" style="border-radius: 15px; margin-top: 0px; cursor: pointer; vertical-align: top; color: #000; height: 24px;">
                              <img src="images/t.png" style="width: 25px;" id="contadorTwImage">
                              <span style="padding-top: 3px; padding-left: 0px; font-size: 12px; color: black;" id="contadorTw">140</span>
                              
                            </div>
                          </div>
       
                          <!-- INSTAGRAM -->

                          <div style="width: 100px; display: none; padding: 0; margin: 0; margin-top: 0px;" class="col-md-1 text-center" id="contIn">
                            <div title="Texto Escrito" onclick="helpEscribir('1','escribirNum');" style="border-radius: 15px; margin-top: 0px; cursor: pointer; vertical-align: top; color: #000; height: 24px;">
                              <img src="images/i.png" style="width: 25px;" id="contadorInImage">
                              <span style="padding-top: 3px; padding-left: 0px; font-size: 12px; color: black;" id="contadorIn">123</span>
                              
                            </div>
                          </div>

                          <!-- FACEBOOK -->

                          <div style="width: 100px; display: none; padding: 0; margin: 0; margin-top: 0px;" class="col-md-1 text-center" id="contFa">
                            <div title="Texto Escrito" onclick="helpEscribir('1','escribirNum');" style="border-radius: 15px; margin-top: 0px; cursor: pointer; vertical-align: top; color: #000; height: 24px;">
                              <img src="images/f.png" style="width:25px;" id="contadorFaImage">
                              <span style="padding-top: 3px; padding-left: 0px; font-size: 12px; color: black;" id="contadorFa">1983</span>
                              
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-2">
                          </div>
                          <div class="col-md-6">
                            <input style="border: 1px solid #ccc; height: 30px; font-size: 13px; padding-left: 10px; height: 36px;" type="text" class="form-control" placeholder="Acortar Link" aria-describedby="sizing-addon1" id="nombreURL">
                          </div>
                          <div class="col-md-2">
                            <a class="waves-effect waves-light btn" style="background-color:#26A8FF; width:250px;" onclick="acortar('1','');">Acortar</a>
                          </div>
                          <div class="col-md-2">
                          </div>
                        </div>
                      </div>

                      <br><hr style="border-width: 3px;"><br>

                      <!--3 Agregar Imágen-->
                      <p style="color: #0a6ebd; padding-left: 10px; font-size: 20px; display: inline-block;">3. </p>
                      <p style="color: #929292; padding-left: 5px; font-size: 18px; display: inline-block;">Agregar Imagen</p>
                      <p onclick="imagenes_block()" style="padding-right:16px; cursor: pointer; color: #43b3ff; font-size: 14px; display: inline-block; float:right" class="hidden-xs"><i style="font-size: 18px;" class="fa fa-sort-desc"></i></p>
                      <p onclick="imagenes_block()" style="padding-right:7px; padding-top:3px; cursor: pointer; color: #43b3ff; font-size: 14px; display: inline-block; float:right" class="hidden-xs">Recomendación de imagen </p><br /><br />

                    <div class="row" id="imagenes" style="display:none">
                      <p style="color: #0a6ebd; font-size: 16px;">Busca en nuestro banco de imágenes</p>
                      <br>
                        <form class="col s12">
                          <div class="row" style="margin-bottom: 0px;">

                            <div class="input-group input-group-lg col s4">
  
                                   <input style="border: 1px solid #ccc; height: 37px; font-size: 13px;" type="text" class="form-control" placeholder="Escribe la palabra clave de la imagen que necesites" aria-describedby="sizing-addon1" id="buscador_imagenes">
                                   <span style="padding: 0px 9px 8px 8px; font-size: 12px; height: 30px; margin-top: 0px;" class="input-group-addon glyphicon glyphicon-search" id="sizing-addon1"></span>
                            </div>
                          </div><br>
                         
                          <div id="imagenes_bus">
                          </div>

                        </form>
                      </div>

                      <div class="col-md-12" style="vertical-align: middle;  text-align: center; display: table-cell; border: 2px solid #d7d7d7;">
                        <div style="display: table; width: 100%; text-align: left; padding-top:10px; padding-bottom:10px">
                          <div id="fileImageMas" style="background: url('images/mas-gris.png') no-repeat scroll center center / 50px 50px; width: 100px; height: 100px; display: inline-block; border: 1px dotted #dddddd; vertical-align: top;">
                            <input id="fileImage" type="file" onchange="subirImage();" name="file" style="text-align: center; width: 100px; height: 100px; opacity: 0; display: inline-block;">
                          </div>
                          <div id="ImagesUploaded" style="vertical-align: middle; display: none; text-align: left;">
                          </div>
                        </div>
                        <div id="cargandoFileImage" style="text-align: center; vertical-align: middle; display: none; height: 100%;">
                            <br>
                            <div class="Knight-Rider-loader animate">
                              <div class="Knight-Rider-bar"></div>
                              <div class="Knight-Rider-bar"></div>
                              <div class="Knight-Rider-bar"></div>
                            </div>
                        </div>
                      </div>

                      <br><br><br><br><br><br>
                      <br><hr style="border-width: 3px;"><br>


                      <!--4 Fecha de Publicación-->
                      <p style="color: #0a6ebd; padding-left: 10px; font-size: 20px; display: inline-block;">4. </p>
                      <p style="color: #929292; padding-left: 5px; font-size: 18px; display: inline-block;">Fecha de Publicación</p><br /><br />
                      <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-1">
                          </div>
                          <div class="col-md-5" style="text-align: center;">
                              <input onclick="programarFecha('1');" value="fecha" name="group1" type="radio" id="test1" />
                              <label for="test1" style="font-size:16px">Programar Fecha</label>
                          </div>
                          <div class="col-md-5" style="text-align: center;">
                              <input onclick="programarFecha('2');" value="ahora" name="group1" type="radio" id="test2" checked />
                              <label for="test2" style="font-size:16px">Publicar Ahora</label>
                          </div>
                          <div class="col-md-1">
                          </div>
                        </div>
                      </div> 

                    </div>
                    <div id="programar435f" style="display: none;" class="row">
                      <div class="col-md-12">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-5">
                          <div style="height: 100%;" id="calendario"></div>
                        </div>
                        <div class="col-md-5">

                        <br><br><br>

                        <div class="col-md-12" style="padding-bottom:10px">
                          <p style="color:#0a6ebd; font-size: 18px;">Elige una de las mejores horas para lanzar tu publicación</p>
                        </div>
                        
                        <div class="col-md-6">
                          <input onclick="otraHoraN()" value="9:00 AM" class="with-gap" name="horasp" type="radio" id="hora1" />
                          <label for="hora1" style="font-size:16px; color:#26a8ff;">9:00 AM</label>
                        </div>
                        <div class="col-md-6">
                          <input onclick="otraHoraN()" value="12:00 PM" class="with-gap" name="horasp" type="radio" id="hora2" />
                          <label for="hora2" style="font-size:16px; color:#26a8ff;">12:00 PM</label>
                        </div>
    
                        <div class="col-md-6">
                          <input onclick="otraHoraN()" value="15:00 PM" class="with-gap" name="horasp" type="radio" id="hora3" />
                          <label for="hora3" style="font-size:16px; color:#26a8ff;">15:00 PM</label>
                        </div>
                        <div class="col-md-6">
                          <input onclick="otraHoraN()" value="17:00 PM" class="with-gap" name="horasp" type="radio" id="hora4" />
                          <label for="hora4" style="font-size:16px; color:#26a8ff;">17:00 PM</label>
                        </div>

                        <div class="col-md-6">
                          <input onclick="otraHoraN()" value="18:00 PM" class="with-gap" name="horasp" type="radio" id="hora5" />
                          <label for="hora5" style="font-size:16px; color:#26a8ff;">18:00 PM</label>
                        </div>
                        <div class="col-md-6">
                          <input onclick="otraHoraB()" value="Otro" class="with-gap" name="horasp" type="radio" id="hora6" />
                          <label for="hora6" style="font-size:16px; color:#26a8ff;">Otro</label>
                        </div>
        
                        <div class="col-md-12" style="padding-top:15px">
                          <p id="otra_hora" style="display:none">
                            <label class="active" for="first_name2"></label>
                            <input placeholder="Hora" value="" id="timepicker" type="text">
                          </p>
                        </div>

                        </div>
                        <div class="col-md-1"> 
                        </div>
                      </div>
                    </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="col-md-2"> 
                          </div>
                          <div class="col-md-4" style="text-align: center;">
                            
                            <a onclick="enviarBotonComenta2(2);" style="background-color:#26A8FF; width:250px;" class="waves-effect waves-light btn">Borrador</a>

                          </div>
                          <div class="col-md-4" style="text-align: center;">
                          
                            <a onclick="enviarBotonComenta2(1);" style="background-color:#26A8FF; width:250px;" class="waves-effect waves-light btn">Enviar</a>
                            
                          </div>
                          <div class="col-md-2"> 
                          </div>
                        </div>
                      </div>
                </div>
              </div>
              
              <div class="col-md-2">
              </div>

          </div>

        </section>

    <?PHP include ''.dirname(__FILE__).'/footer.php'; footer(); ?>
    <?PHP include ''.dirname(__FILE__).'/notificaciones.php'; ?>
</body>
 </html>
 <?PHP
} else {
  include ''.dirname(__FILE__).'/error.html';
}?>