<?PHP
include 'desktop/header.php';
include 'desktop/menu.php';
include 'lenguajes/espanol.php';
include 'scripts/mobileDetect.php';
if(class_exists('Mobile_Detect'))
{ $detect = new Mobile_Detect();
  $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
}
header_desktop("".$txt["titulo"]."");
?>
<script>
function limpiarNombre(){
  var nombre = document.getElementById('nombre').value;
  if(nombre=="Ingresa Tu Nombre"){
    document.getElementById('nombre').value = "";
  }
}
function limpiarMail(){
  var mail = document.getElementById('mail').value;
  if(mail=="Ingresa Tu Mail"){
    document.getElementById('mail').value = "";
  }
}
function openDialog(){
  $("#cargando").dialog("open");
  $("#cargando").dialog('option', 'title', 'Cargando');
  var loadStats = '<div class="Knight-Rider-loader animate">';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '</div>';
  $("#cargando").html("Realizando Proceso....Por favor Espere<br /><br />"+loadStats);
}
function enviar(){
  var nombre = document.getElementById('nombre').value;
  var mail = document.getElementById('mail').value;
  if(nombre=="" || nombre=="Ingresa Tu Nombre"){
    toastr["warning"]("Ingresa Tu Nombre");
  } else if(mail=="" || mail=="Ingresa Tu Mail"){
    toastr["warning"]("Ingresa Tu Mail");
  } else {
    openDialog();
	var comilla = "'";
	var htmlMail = '<html>';
	   htmlMail += '<head>';
	   htmlMail += '<meta charset="UTF-8">';
	   htmlMail += '</head>';
	   htmlMail += '<body style="text-align: center;">';
	   htmlMail += '<div style="width: 700px; text-align: center;" id="contenedor">';
	   htmlMail += '  <a href="http://bamboostr.com"><img style="width: 400px;" src="http://bamboostr.com/images/mails/bamboostr7.png" /></a><br /><br />';
	   htmlMail += '  <img style="width: 700px;" src="http://bamboostr.com/images/mails/image.png" />';
	   htmlMail += '  <div id="contenedor_ciudad" style="background: url('+comilla+'http://bamboostr.com/images/mails/ciudad.png'+comilla+') no-repeat; text-align: center;">';
	   htmlMail += '    <p style="padding-bottom: 1em; font-size: 2em; color: black; text-align: left; width: 20em; padding-top: 3em; padding-left: 2em;">';
	   htmlMail += '        Hola '+document.getElementById('nombre').value+':<br /><br />';
	   htmlMail += '        Gracias por tu interés en Bamboostr. Por ser de las primeras personas en suscribirte a nuestra plataforma, tendrás el beneficio de utilizar nuestra prueba beta sin costo alguno durante 1 mes.<br /><br />';
	   htmlMail += '        Pronto estaremos en contacto contigo para hacerte saber sobre nuestro lanzamiento.<br /><br />';
	   htmlMail += '        Gracias y  Saludos</p>';
	   htmlMail += '  </div>';
	   htmlMail += '  <img style="width: 700px;" src="http://bamboostr.com/images/mails/image.png" />';
	   htmlMail += '  <div style="width: 100%; padding-top: .5em; text-align: center; display: table;">';
	   htmlMail += '      <div style="text-align: center; display: table-row;">';
	   htmlMail += '        <div style="width: 50%; text-align: center; display: table-cell;">';
	   htmlMail += '          <a href="http://bamboostr.com"><img style="width: 300px;" src="http://bamboostr.com/images/mails/bamboostr7.png" /></a>';
	   htmlMail += '        </div>';
	   htmlMail += '        <div style="width: 50%; vertical-align: top; text-align: center; display: table-cell;">';
	   htmlMail += '          <p>Síguenos en Redes Sociales</p>';
	   htmlMail += '        </div>';
	   htmlMail += '      </div>';
	   htmlMail += '      <div style="text-align: center; display: table-row;">';
	   htmlMail += '        <div style="width: 50%; text-align: center; display: table-cell;">';
	   htmlMail += '          <i style="color: blue;">Copyright © 2015 Bamboostr, All rights reserved.</i>';
	   htmlMail += '        </div>';
	   htmlMail += '        <div style="width: 50%; text-align: center; display: table-cell;">';
	   htmlMail += '          <a href="https://facebook.com/bamboostr"><img src="http://bamboostr.com/images/mails/facebook.png" /></a>';
	   htmlMail += '          <a href="https://twitter.com/bamboostr"><img src="http://bamboostr.com/images/mails/twitter.png" /></a>';
	   htmlMail += '          <a href="https://instagram.com/bamboostr"><img src="http://bamboostr.com/images/mails/instagram.png" /></a>';
	   htmlMail += '        </div>';
	   htmlMail += '      </div>';
	   htmlMail += '  </div>';
	   htmlMail += '</div>';
	   htmlMail += '</body>';
	   htmlMail += '</html>';
    var parametros = { server:"bluehost",
	  		     nombre:document.getElementById('nombre').value,
	  		     email:document.getElementById('mail').value,
	  		     asunto:"Bamboostr: Gracias Por Su Interés en Adquirir Nuestro Software!.",
	  		     body:htmlMail,
	  		     mensaje:document.getElementById('nombre').value,
	  		     from:"ventas@bamboostr.com",
	  		     mailDes:document.getElementById('mail').value};
	  $.ajax({   data:  parametros,
	       		url:   "lanzador-mail.php",
			type:  "post",
			success:  function (response) {
                        var parametros = { nombre:document.getElementById('nombre').value,
                                           email:document.getElementById('mail').value};
	  $.ajax({      data:  parametros,
	       		url:   "almacenar-newsletter.php",
			type:  "post",
			success:  function (response) {
                          toastr["info"]("Muchas Gracias Por su Interés. Estaremos en Contacto más pronto de lo que usted cree.");
                          $("#cargando").dialog("close");
			},
			error: function (response){
			  toastr["error"]("Inténtalo nuevamente.", "ERROR");
                          $("#cargando").dialog("close");
			}
	  });
			},
			error: function (response){
                          toastr["error"]("Inténtalo nuevamente.", "ERROR");
                          $("#cargando").dialog("close");
			}
          });
  }
}
</script>
<script>
$(document).ready(function(){
	$(function() {
		$("#cargando").dialog({
		  autoOpen: false,
		  position: {my: "center", at: "center", to: window},
		  modal: true,
		});
	});
});
</script>
</head>
<?PHP
if($deviceType=="phone"){
  ?>
  <br /><br /><br />
  <?PHP
} 
?>
<body id="_susbribir">
<?PHP
  if($deviceType=="phone"){
    ?>
	<div style="width: 100%;" class="container_wapper">
		<div style="width: 100%;" id="_banner_menu">
		  <div style="width: 100%;" class="container-fluid">	
                      <div id="_mobile_menu">
		        <ul class="nav nav-pills nav-stacked">
                          <li><a href="#_susbribir"><i class="glyphicon glyphicon-send"></i> &nbsp; Ingresa</a></li>
		          <li><a href="#_ciudad"><i class="glyphicon glyphicon-home"></i> &nbsp; Intro</a></li>
		          <li><a href="#_intro"><i class="glyphicon glyphicon-briefcase"></i> &nbsp; ¿Qué es?</a></li>
		          <li><a href="#_tools"><i class="glyphicon glyphicon-bullhorn"></i> &nbsp; Características</a></li>
		          <li><a href="#_gestion"><i class="glyphicon glyphicon-briefcase"></i> &nbsp; Portabilidad</a></li>
		          <li><a href="#_programar"><i class="glyphicon  glyphicon-calendar"></i> &nbsp; Publica</a></li>
		          <li><a onclick="window.open('http://bamboostr.com/blog','_blank');"><i class="glyphicon  glyphicon-calendar"></i> &nbsp; Blog</a></li>
		          <li><a href="#_datos"><i class="glyphicon glyphicon-phone-alt"></i> &nbsp; Contacto</a></li>
		        </ul>
		      </div>
                    </div>
		    <div style="vertical-align: middle;" class="col-xs-12 visible-xs"> 
                      <a href="http://bamboostr.com"><img style="padding-top: 1em; width: 10%;" src="http://letstweet.me/images/logo-bamboostr.png" /></a>
                      <a href="http://bamboostr.com"><img style="padding-top: 1em; width: 40%;" src="http://letstweet.me/images/texto-bamboostr.png" /></a>
                      <a href="#" id="mobile_menu"><span class="glyphicon glyphicon-th-list"></span></a> 
                    </div>
		</div>
	</div>
    <?PHP
  }
?>
<div style="top: 0em;" id="_contact" class="container_wapper">
  <div class="container-fluid">
    
    <div class="hidden-xs" style="text-align: center;">
	<ul style="color: #2a3047;">
	  <li style="text-decoration: none; font-size: 1.7em; color: #2a3047; display: inline-block;"><a style="text-decoration: none;" href="#_ciudad">Intro</a></li>
	  <li style="text-decoration: none; font-size: 1.7em; color: #2a3047; display: inline-block; padding-left: 1em;"><a style="color: #2a3047; text-decoration: none;" href="#_intro">¿Qué es?</a></li>
	  <li style="text-decoration: none; font-size: 1.7em; color: #2a3047; display: inline-block; padding-left: 1em;"><a style="color: #2a3047; text-decoration: none;" href="#_tools">Características</a></li>
	  <li style="text-decoration: none; font-size: 1.7em; color: #2a3047; display: inline-block; padding-left: 1em;"><a style="color: #2a3047; text-decoration: none;" href="#_gestion">Portabilidad</a></li>
	  <li style="text-decoration: none; font-size: 1.7em; color: #2a3047; display: inline-block; padding-left: 1em;"><a style="color: #2a3047; text-decoration: none;" href="#_programar">Publica</a></li>
          <li style="text-decoration: none; font-size: 1.7em; color: #2a3047; display: inline-block; padding-left: 1em;"><a target="_blank" style="color: #2a3047; text-decoration: none;" href="http://bamboostr.com/blog">Blog</a></li>
	  <li style="text-decoration: none; font-size: 1.7em; color: #2a3047; display: inline-block; padding-left: 1em;"><a style="color: #2a3047; text-decoration: none;" href="#_datos">Contacto</a></li>
	</ul>
    </div>
    
    <div style="text-align: center; top: 2em;" class="col-xs-12">
      <img style="width: 70%;" src="images/vende-mas-con-redes-sociales.png" />
      <img style="width: 60%;" src="images/impulsar-tus-ideas.png" />
    </div>
    
    <div style="text-align: center;" class="col-xs-12">
      <div style="text-align: center; width: 100%;">
<?PHP
if($deviceType=="phone"){
  ?>
        <div style="background: url('images/newsletter-mobile.png') no-repeat scroll center center rgba(0, 0, 0, 0); height: 550px; width: 100%; text-align: center;">
 <?PHP
} else {
  ?>
       <div style="background: url('images/newsletter.png') no-repeat scroll center center rgba(0, 0, 0, 0); height: 550px; width: 100%; text-align: center;">
  <?PHP
}
?>
<?PHP
if($deviceType=="phone"){
  ?>
  <div style="width: 80%; left: 2em; top: 19em; position: relative; text-align: center;">
    <a href="http://letstweet.me/twitter/redirect.php?liberar=1">
      <img alt="Sign in with Twitter" src="images/twitter-signin.png">
    </a>
  <?PHP
} else {
  ?>
  <div style="width: 41%; left: 27em; top: 20em; position: relative; text-align: center;">
    <a href="http://letstweet.me/twitter/redirect.php?liberar=1">
      <img alt="Sign in with Twitter" src="images/twitter-signin.png">
    </a>
  <?PHP
}
?>
          </div>
<?PHP
if($deviceType=="phone"){
  ?>
  <div style="width: 80%; left: 2em; top: 20em; position: relative; text-align: center;">
    <a href="http://letstweet.me/facebook/redirect.php?liberar=1">
      <img alt="Sign in with Twitter" src="images/facebook-signin.png">
    </a>
  <?PHP
} else {
  ?>
  <div style="width: 41%; left: 27em; top: 22em; position: relative; text-align: center;">
    <a href="http://letstweet.me/facebook/redirect.php?liberar=1">
      <img alt="Sign in with Twitter" src="images/facebook-signin.png">
    </a>
  <?PHP
}
?>
          </div>
        </div>
<?PHP
  if($deviceType=="computer" || $deviceType=="tablet"){
?>
        <div style="display: inline-block; position: relative; top: 25px; width: 20%;">
            <a target="_blank" href="http://facebook.com/bamboostr">
              <img style="width: 40%;" src="images/dame-un-like.png" />
            </a>
            <a target="_blank" href="http://facebook.com/bamboostr">
              <img style="width: 25%;" src="images/facebook.png" />
            </a>
        </div>
        <div style="cursor: pointer; display: inline-block; position: relative; top: 20px; width: 45%;">

        </div>
        <div style="display: inline-block; position: relative; top: 25px; width: 20%;">
            <a target="_blank" href="http://twitter.com/bamboostr">
              <img style="width: 25%;" src="images/twitter.png" />
            </a>
            <a target="_blank" href="http://twitter.com/bamboostr">
              <img style="width: 30%;" src="images/sigueme.png" />
            </a>
        </div>
<?PHP
} 
if($deviceType=="computer" || $deviceType=="tablet"){
?>
        <div style="text-align: center; display: table-inline;">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/vmIxtheWois" frameborder="0" allowfullscreen></iframe>
       </div> 
<?PHP
} else {
?>
        <div style="text-align: center; display: table-inline;">
          <iframe width="230" height="200" src="https://www.youtube.com/embed/vmIxtheWois" frameborder="0" allowfullscreen></iframe>
       </div> 
<?PHP 
}
?>
      </div>
    </div>
    <!--
    <div class="col-md-4">
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-12">
        </div>
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
        </div>
    </div>
    -->
  </div>
</div>


<div style="text-align: center;" id="_ciudad" class="container_wapper">
  <div style="text-align: center; top: 150px; height: 300px;" class="col-xs-12">
    <img style="width: 60%;" src="images/bamboostr-lo-hace-facil.png" />
  </div>
  <div style="height: 500px; background: url('images/compu.png') no-repeat scroll center center rgba(0, 0, 0, 0); text-align: center;" class="col-xs-12">
    <img style="width: 350px;" src="images/system1.png" />
  </div>
</div>



<div style="text-align: center;" id="_intro" class="container_wapper">
  <div style="text-align: center;" class="col-xs-12">
    <img style="width: 80%;" src="images/intro.png" />
  </div>
  <div style="text-align: center;" class="col-xs-12">
    <img style="width: 60%;" src="images/intro-2.png" />
  </div>
</div>


<div style="background-color: #151824;" style="text-align: center;" id="_tools" class="container_wapper">
  <img style="width: 100%;" src="images/experto-en-el-tema.png" />
</div>

<div style="text-align: center;" id="_gestion" class="container_wapper">
  <img style="width: 100%;" src="images/gestion.png" />
</div>

<div style="text-align: center;" id="_programar" class="container_wapper">
  <img style="width: 100%;" src="images/programar.png" />
</div>

<div style="text-align: center;" id="_datos" class="container_wapper">
  
  <div style="display: table;">
    <img style="width: 100%;" src="images/datos.png" />
  </div>
  
  <div style="width: 100%; display: table;">
    <div style="display: table-row">
      <div style="width: 30%; display: table-cell;">
        <a target="_blank" href="http://facebook.com/bamboostr">
          <img style="width: 30%;" src="images/dame-un-like.png" />
        </a>
        <a target="_blank" href="http://facebook.com/bamboostr">
          <img style="width: 15%;" src="images/facebook.png" />
        </a>
      </div>
      <div style="width: 40%; display: table-cell;">
        <a href="http://bamboostr.com">
          <img style="width: 100%;" src="images/bamboostr2.png" />
        </a>
      </div>
      <div style="width: 30%; display: table-cell;">
        <a target="_blank" href="http://twitter.com/bamboostr">
          <img style="width: 15%;" src="images/twitter.png" />
        </a>
        <a target="_blank" href="http://twitter.com/bamboostr">
          <img style="width: 25%;" src="images/sigueme.png" />
        </a>
      </div>
    </div>
  </div>
  <div id="cargando">
  </div>
  
</div>
<?PHP
include 'desktop/footer.php';
echo footer($footer_bottom); ?> 
<script src="js/jquery-ui.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.singlePageNav.min.js"></script> 
<script src="js/unslider.min.js"></script> 
<script src="js/_script.js"></script>
</body>
</html>