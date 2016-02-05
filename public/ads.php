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
  $('#tableSys6').css("border-left","5px solid #FFF");
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
	 $('#tableSys6').css("border-left","5px solid #FFF");
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

    rastrear("ads");
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
$(function(){
    var sampleTags = [];

    //-------------------------------
    // Tag events
    //-------------------------------
    var eventTags = $('#eventTags');

    var addEvent = function(text) {
        $('#events_container').append(text + '<br>');
    };

    eventTags.tagit({
        availableTags: sampleTags,
        beforeTagAdded: function(evt, ui) {
            if (!ui.duringInitialization) {
                addEvent('beforeTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
            }
        },
        afterTagAdded: function(evt, ui) {
            if (!ui.duringInitialization) {
                addEvent('afterTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
            }
        },
        beforeTagRemoved: function(evt, ui) {
            addEvent('beforeTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
        },
        afterTagRemoved: function(evt, ui) {
            addEvent('afterTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
        },
        onTagClicked: function(evt, ui) {
            addEvent('onTagClicked: ' + eventTags.tagit('tagLabel', ui.tag));
        },
        onTagExists: function(evt, ui) {
            addEvent('onTagExists: ' + eventTags.tagit('tagLabel', ui.existingTag));
        }
    });
});
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
function openDialog(){
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
}
function cargando(identifyLocal,identifyOther,tipo,imagenRed,redLocal,screenname){
  openDialog();
  var parametros = { identify:identifyLocal, 
                     identify_account:identifyOther,
                     red:redLocal };
  $.ajax({  data:  parametros,
			url:   'scripts/expire-token.php',
			type:  'GET',
			success:  function (response) { 
				if(response.indexOf("FALSE")!="-1"){ 
			      $("#cargando").closest('.ui-dialog-content').dialog('close');
                  toastr["error"](txt116, "ERROR");
				} else {
				  if(tipo=="twitter"){
				  } else if(tipo=="facebook"){
				  } else if(tipo=="page"){
					$.ajax({  data:  { identify_account:identifyLocal, identify:identifyOther.substr(0,identifyOther.length-2), tipo:tipo, red:redLocal },
							  url:   'facebookAds/examples/connectionobjects.php',
						   	  type:  'POST',
							  success:  function (response) {
                                                            obj = JSON.parse(response);
                                                            if(obj.success){
							      iniFaAds(identifyLocal,identifyOther,redLocal,imagenRed,tipo,screenname,$("#seleccionarCuenta2").val());
                                                            } else {
                                                              toastr["error"](txt493, "ERROR");
				                              $(".ui-dialog-titlebar-close").show();
							      $("#cargando").closest('.ui-dialog-content').dialog('close');
                                                            }
							  },
							  error: function (response){
							    //error primario
								$("#cargando").closest('.ui-dialog-content').dialog('close');
								toastr["error"](txt493, "ERROR");
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
  $(".msdrop").msDropdown({roundedBorder:true});
  $('.typeahead').typeahead();
});
</script>
<script type="text/javascript">
//facebook ads
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%46%42%41%64%73%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
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
                 <div class="row">
                 <div class="col-xs-3">
                 </div>
                 <div class="col-xs-7" style="vertical-align: middle; text-align: center;">
                    <div class="col-xs-2">
                    </div>
                    <select class="col-xs-4 msdrop" id="seleccionarCuenta2" onchange="seleccionarCuenta()" style="margin-top: 10px; height: 30px; padding: 0px 0px 0px 0px; text-align: left;">
                      <option value="1">Get Followers</option>
                      <option value="2">Get Website Traffic</option>
                      <option value="3">Reach More People</option>
                      <option value="4">More Engagement</option>
                    </select>
                    <img class="hidden-xs col-xs-1" style="float: right; margin-top: 10px;" src="images/mano.png">
                    <div class="col-xs-1">
                    </div>
                  </div>
                  <div class="col-xs-3">
                  </div>
                  </div>
                  <div class="row">
                  <div class="col-xs-3">
                  </div>
                  <div class="col-xs-7" text-align: left;">
                  <select class="msdrop" id="seleccionarCuenta" onchange="seleccionarCuenta()" style="text-align: left; margin-top: 10px; height: 30px; padding: 0px 0px 0px 0px;"><option><?PHP echo $txt["txt384"]; ?></option>
<?PHP
				    $i=0;
                                    
                                    /*
				    foreach($feed_array_escribir as $item){
					  if($item['9']=="cuenta"){
						  if($item['1']=="twitter"){
						    ?><option data-description="Twitter" data-image="<?PHP echo $feed_array_escribir[$i][3]; ?>" ? $feed_array_escribir[$i][3]; ?>" value="<?PHP echo $item[1]; ?>|<?PHP echo $item[3]; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>|@<?PHP echo $item['2']; ?>"><?PHP echo '@'.$feed_array_escribir[$i][2].''; ?></option><?PHP
						  }
						  if($item['1']=="facebook"){
							?><option data-description="Facebook" data-image="<?PHP echo $feed_array_escribir[$i][3]; ?>" value="<?PHP echo $item[1]; ?>|<?PHP echo $item[3]; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>|<?PHP echo $item['2']; ?>"><?PHP echo $feed_array_escribir[$i][2]; ?></option><?PHP
						  }
					  } 
					  $i++;        
					}
					*/
					$i=0;
					foreach($feed_array_escribir as $item){
					  if($item['9']=="page"){
						  ?><option data-description="Fan Page" data-image="<?PHP echo $feed_array_escribir[$i][3]; ?>" value="page|<?PHP echo $item[3]; ?>|<?PHP echo $item['8']; ?><?PHP echo substr($item['1'],0,2); ?>|<?PHP echo $item['2']; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>"><?PHP echo $feed_array_escribir[$i][2]; ?></option><?PHP
					  }  
					  $i++;         
					}
                                        /*
					$i=0;
					foreach($feed_array_escribir as $item){
					  if($item['9']=="grupo"){
						  ?><option data-description="Grupo" data-image="<?PHP echo $feed_array_escribir[$i][3]; ?>" value="grupo|<?PHP echo $item[3]; ?>|<?PHP echo $item['8']; ?><?PHP echo substr($item['1'],0,2); ?>|<?PHP echo $item['2']; ?>|<?PHP echo $item[7]; ?><?PHP echo substr($item['1'],0,2); ?>"><?PHP echo $feed_array_escribir[$i][2]; ?></option><?PHP
					  } 
					  $i++;          
					}
					*/
				  ?>
                  </select>
                  <img class="hidden-xs" style="margin-top: 0px;" src="images/mano.png">
                  </div>
                  <div class="col-xs-3">
                  </div></div>
                </td>
              </tr>
              <tr>
                <td class="col-md-12" style="vertical-align: top; padding-top: 15px;">
                  <div class="col-md-12" id="patrocinar" style="display: none;">
                    <div class="col-md-6" style="border-radius: 4px; border: 1px solid #CCCCCC; padding-left: 5em; background-color: white; vertical-align: top; z-index: 0;">
                      <div class="col-md-12">
		        <nav>
			  <ul class="pager">
			    <li style="cursor: pointer;" class="previous"><a onclick="back();"><span aria-hidden="true">&larr;</span> Regresar</a></li>
			  </ul>
			</nav>
                      </div>
                      <div class="col-md-12" style="text-align: center;"><p style="font-size: 2em;"><?PHP echo $txt["txt500"]; ?></p></div>
                      <div class="col-md-12" style="padding-top: 1em; text-align: center;">
                        <div class="col-md-4">
                          <div class="btn-group" role="group" aria-label="...">
                            <button onclick="dineroAds(1);" value="10" type="button" id="dinero1" class="btn btn-default">$10</button>
                            <button onclick="dineroAds(2);" value="25" type="button" id="dinero2" class="btn btn-success">$25</button>
                            <button onclick="dineroAds(3);" value="50" type="button" id="dinero3" class="btn btn-default">$50</button>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <p style="font-size: 1.2em; margin-top: 0.3em;"><?PHP echo $txt["txt499"]; ?>:</p>
                        </div>
			<div class="col-md-4" class="form-group">
			  <div style="width: 200px;" class="input-group">
			    <div class="input-group-addon">$</div>
			    <input onkeyup="dineroAds(4);" type="text" class="form-control" id="dinero4" placeholder="<?PHP echo $txt["txt498"]; ?>">
			    <div class="input-group-addon">.00</div>
			  </div>
			</div>
                      </div>
                      <div class="col-md-12" style="margin-top: 4em; text-align: center;">
                        <div class="col-md-6" style="vertical-align: middle; text-align: left;">
                          <p style="margin-top: 0.3em; font-size: 1.2em;">Tipo de Audiencia:</p>                   
                        </div>
                        <div class="col-md-6">
                          Check Boxes
                        </div>
                      </div>
                      <div style="margin-top: 4em;"  class="col-md-12" style="text-align: center;">
                        <div class="col-md-6" style="vertical-align: middle; text-align: left;">
                          <p style="margin-top: 0.3em; font-size: 1.2em;"><?PHP echo $txt["txt501"]; ?>:</p>
                        </div>
                        <div class="col-md-6" style="vertical-align: middle; text-align: center;">
                          <input id="arrayPais" value="México" holder="<?PHP echo $txt["txt503"]; ?>" onkeyup="adsSearchComplete(this.value, 'pais');" class="col-md-12" type="text" class="span3" style="height: 34px; margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[]" autocomplete="on">
                        </div>
                      </div>
                      <div style="margin-top: 4em;"  class="col-md-12" style="text-align: center;">
                        <div class="col-md-6" style="vertical-align: middle; text-align: left;">
                          <p style="margin-top: 0.3em; font-size: 1.2em;"><?PHP echo $txt["txt502"]; ?>:</p>
                        </div>
                        <div class="col-md-6" style="vertical-align: middle; text-align: center;">
                          <input id="arrayIdioma" value="Español" holder="<?PHP echo $txt["txt504"]; ?>" onkeyup="adsSearchComplete(this.value, 'idioma');" class="col-md-12" type="text" class="span3" style="height: 34px; margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[]" autocomplete="on">
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-top: 4em; text-align: center;">
                        <div class="col-md-6" style="vertical-align: middle; text-align: left;">
                          <p style="margin-top: 0.3em; font-size: 1.2em;"><?PHP echo $txt["txt505"]; ?>:</p>                   
                        </div>
                        <div class="col-md-6">
                          <div class="btn-group" role="group" aria-label="...">
                            <button onclick="generoAds(1);" type="button" id="genero1" class="btn btn-success"><?PHP echo $txt["txt506"]; ?></button>
                            <button onclick="generoAds(2);" type="button" id="genero2" class="btn btn-default"><?PHP echo $txt["txt507"]; ?></button>
                            <button onclick="generoAds(3);" type="button" id="genero3" class="btn btn-default"><?PHP echo $txt["txt508"]; ?></button>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-top: 4em; text-align: left;">
                        <div class="col-md-6">
                            <p style="margin-top: 0.3em; font-size: 1.2em;"><?PHP echo $txt["txt509"]; ?>:</p>
                        </div>
                        <div class="col-md-6">
                          <select onclick="edadAds();" id="edad1" style="display: inline;">
                          <?PHP
                            for($cfge=13; $cfge<66; $cfge++){
                              ?>
                              <option value="<?PHP echo $cfge; ?>"><?PHP echo $cfge; ?></option>
                              <?PHP
                            }
                          ?>
                          </select>
                          <p style="display: inline; margin-top: 0.3em; font-size: 1.2em;">a:</p>
                          <select onclick="edadAds();" id="edad2" style="display: inline;"><option value="65" selected>65</option>
                          <?PHP
                            for($cfge=13; $cfge<66; $cfge++){
                              ?>
                              <option value="<?PHP echo $cfge; ?>"><?PHP echo $cfge; ?></option>
                              <?PHP
                            }
                          ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-top: 4em; text-align: center;">
                        <div class="col-md-6" style="vertical-align: middle; text-align: left;">
                          <p style="margin-top: 0.3em; font-size: 1.2em;"><?PHP echo $txt["txt510"]; ?>:</p>                   
                        </div>
                        <div class="col-md-6">
                          <ul class="tagit ui-widget ui-widget-content ui-corner-all" id="eventTags">
                            <li class="tagit-new"></li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-top: 4em; text-align: center;">
                        <div class="col-md-6" style="vertical-align: middle; text-align: left;">
                          <p style="margin-top: 0.3em; font-size: 1.2em;"><?PHP echo $txt["txt511"]; ?>:</p>                   
                        </div>
                        <div class="col-md-6">
                          Date Picker
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6" style="border-radius: 4px; border: 1px solid #CCCCCC; background-color: white; vertical-align: top; z-index: 0; text-align: left;">
                      <div class="col-md-12" style="margin-top: 1em; background-color: transparent; vertical-align: top; text-align: left;">
                        <div class="col-md-6" style="margin-top: 1em; background-color: transparent; vertical-align: top; text-align: left;">
                          <div style="font-weight: bold; display: inline;"><?PHP echo $txt["txt512"]; ?>: </div><div style="font-weight: bold; display: inline;" id="reachAds"></div>
                        </div>
                        <div class="col-md-6" style="margin-top: 1em; background-color: transparent; vertical-align: top; text-align: left;">
                          <div style="font-weight: bold; display: inline;"><?PHP echo $txt["txt513"]; ?>: </div><div style="font-weight: bold; display: inline;" id="reach2Ads"></div>
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-top: 3em; background-color: transparent; vertical-align: top; text-align: left;">
                        <div class="progress">
                          <div class="progress-bar progress-bar-success progress-bar-striped" id="barAds" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                            <span class="sr-only">40% Complete (success)</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12" style="background-color: transparent; height: 1000px; vertical-align: top; text-align: left;" id="fb-root">
                       
                      </div>
                    </div>
                  </div>
                  <ul class="col-md-12" style="padding-left: 45px;" id="sortable">
                    <?PHP
					$co=1;
					while($co<100){
						?>
						<li style="height: auto; width: 28.9em;">
						  <div style="width: 98%;" class="portlet">
							<div id="portlet-header" class="portlet-header">
							  <div style="position: absolute; display: none;"><img class="imgIcon<?PHP echo $co; ?>" src="images/engrane.png" style="width: 2.0em; float:left; padding:0px; top: 0px;" title="Herramientas" alt="H" /></div>
									<div class="textoS" id="main-feed<?PHP echo $co; ?>Text"></div>
                                    <div class="acercaSR" title="<?PHP echo $txt["txt48"]; ?>"></div>
									<div class='ui-icon ui-icon-minusthick portlet-toggle' title="<?PHP echo $txt["txt72"]; ?>"></div>
									<div id="portletheaderClose<?PHP echo $co; ?>" onclick="portletHeaderClose(this.id);" class='closeS' title="<?PHP echo $txt["txt219"]; ?>"></div>
									</div>
									<div id="main-feed<?PHP echo $co; ?>" class="portlet-content" style="display: inline-block; z-index: 0; border: 0px solid #283147; width: 100%; text-align: center; overflow-y: auto; height: 32em;"> 
		                                                          <div style="display: block; font-size: 1.01em; padding-left: 1.5em; padding-right: 1.5em; width: 100%; color: #22304E; text-align: left; height: 2em; background-color: #B3D7FF;">
                                                                          <div style="width: 95px; display: inline-block; padding-top: 0.3em; vertical-align: middle; height: 2em; color: black; background: url('https://cdn0.iconfinder.com/data/icons/awards-6/500/award_guarantee-128.png') no-repeat center center; float: left;"></div>

                                                                          <div id="fechaShare<?PHP echo $co; ?>" style="width: 95px; display: inline-block; padding-top: 0.3em; vertical-align: middle; height: 2em; color: black; background: url('images/fechaShare.png') no-repeat center center; float: right;"></div>
                                                                          </div>
		                                                          <div style="vertical-align: middle; background: url('images/imagenesProtector.png') no-repeat center center; height: 6em; width: 100%; text-align: center; background-color: transparent; display: block;">
		                                                            <img id="imageShare<?PHP echo $co; ?>" style="margin-top: 0.25em; vertical-align: middle; text-align: center; max-width: 80%; max-height: 80px;" />
		                                                          </div>
		                                                          <div id="descripcionShare<?PHP echo $co; ?>" style="width: 100%; display: block; padding-left: 1.5em; padding-right: 1.5em; color: black; text-align: left; background-color: white; height: 60px;"></div>
		                                                          <div style="width: 100%; display: block;">
		                                                            <div id="likeShare<?PHP echo $co; ?>" style="width: 33%; display: inline-block; padding-top: 0.3em; vertical-align: middle; height: 2em; color: black; background: url('images/fechaShare.png') no-repeat center center; float: right;"></div>
		                                                            <div style="width: 33%; display: inline-block; float: left;"><a target="_blank" href=""><img title="'+txt382+'" style="cursor: pointer; width: 2em; margin-right: 1em;" src="images/like-100.png" /></a></div><div style="width: 33%; display: inline-block;">Likes</div>
		                                                          </div><br />
		                                                          <div style="width: 100%; display: block;">
		                                                            <div id="reachShare<?PHP echo $co; ?>" style="width: 33%; display: inline-block; padding-top: 0.3em; vertical-align: middle; height: 2em; color: black; background: url('images/fechaShare.png') no-repeat center center; float: right;"></div>
		                                                            <div style="width: 33%; display: inline-block; float: left;"></div><div style="width: 33%; display: inline-block;">Reached</div>
		                                                          </div><br />
		                                                          <div style="width: 100%; display: block;">
		                                                            <div id="clickPostShare<?PHP echo $co; ?>" style="width: 33%; display: inline-block; padding-top: 0.3em; vertical-align: middle; height: 2em; color: black; background: url('images/fechaShare.png') no-repeat center center; float: right;"></div>
		                                                            <div style="width: 33%; display: inline-block; float: left;"></div><div style="width: 33%; display: inline-block;">Post Clicks</div>
		                                                          </div><br />
		                                                          <div style="width: 100%; display: block;">
		                                                            <div id="clickShare<?PHP echo $co; ?>" style="width: 33%; display: inline-block; padding-top: 0.3em; vertical-align: middle; height: 2em; color: black; background: url('images/fechaShare.png') no-repeat center center; float: right;"></div>
		                                                            <div style="width: 33%; display: inline-block; float: left;"></div><div style="width: 33%; display: inline-block;">Link Clicks</div>
		                                                          </div><br />
		                                                          <div style="width: 100%; display: block;">
		                                                            <div id="engagedShare<?PHP echo $co; ?>" style="width: 33%; display: inline-block; padding-top: 0.3em; vertical-align: middle; height: 2em; color: black; background: url('images/fechaShare.png') no-repeat center center; float: right;"></div>
		                                                            <div style="width: 33%; display: inline-block; float: left;"></div><div style="width: 33%; display: inline-block;">Engaged</div>
		                                                          </div><br />
		                                                          <div id="footerShare<?PHP echo $co; ?>" style="width: 100%; display: block; color: black; text-align: center;"></div>
		                                                          
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