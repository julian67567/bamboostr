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

<link type="text/css" href="css/escribir.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/huso-horario.js"></script>
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
  var user_image = '<?PHP echo $_SESSION['user_image']; ?>';
</script>
<script>
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});
</script>
<script>
<?PHP
if($_GET["action"]=="newUser"){
  ga('send', 'event', 'Nuevos Usuarios Total', 'click', 'Nuevos Usuarios Total');  
}
if($_GET["action"]=="newUserTwitter"){
  ga('send', 'event', 'Nuevos Usuarios Twitter', 'click', 'Nuevos Usuarios Twitter');  
}
if($_GET["action"]=="newUserFacebook"){
  ga('send', 'event', 'Nuevos Usuarios Facebook', 'click', 'Nuevos Usuarios Facebook');  
}
if($_GET["action"]=="newUserNo"){
  ga('send', 'event', 'Nuevos Usuarios Bamboostr', 'click', 'Nuevos Usuarios Bamboostr');  
}
?>
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
          
          html +='<div class="row" style="margin:0;">';
              html +='<div class="col-md-2">';
              html +='</div>';
              html +='<div class="col-md-8">';
                html +='<div class="col-md-6">';
                  html +='<a href="escribir.php">';
                    html +='<div class="card" style="background-color: #76BC12;">';
                    
                        html +='<div class="card-content" style="height: 120px; padding-top: 12px;">';
                          html +='<span style="color: white; font-size: 50px;" class="fa fa-pencil"></span>';
                          html +='<p style="color: white; font-size: 20px; padding-top: 10px;">Escribe una publicación nueva</p>';
                        html +='</div>';
                        
                    html +='</div>';
                  html +='</a>';
                html +='</div>';
                html +='<div class="col-md-6">';
                  html +='<a href="calendario.php">';
                    html +='<div class="card" style="background-color: #274565;">';
                        
                        html +='<div class="card-content" style="height: 120px; padding-top: 12px;">';
                          html +='<span style="color: white; font-size: 50px;" class="fa fa-calendar"></span>';
                          html +='<p style="color: white; font-size: 20px; padding-top: 10px;">Ver calendario de publicaciones</p>';
                        html +='</div>';
                        
                    html +='</div>';
                  html +='</a>';
                html +='</div>';
              html +='</div>';
              html +='<div class="col-md-2">';
              html +='</div>';
          html +='</div>';
          
          html +='<div class="row">';
              html +='<div class="col-md-2">';
              html +='</div>';
              html +='<div class="col-md-8">';
                  
                html +='<div class="col-md-6">';
                  html +='<a href="responder.php">';
                    html +='<div class="card" style="background-color: #F68921;">';
                    
                        html +='<div class="card-content" style="height: 120px; padding-top: 12px;">';
                          html +='<span style="color: white; font-size: 50px;" class="fa fa-envelope"></span>';
                          html +='<p style="color: white; font-size: 20px; padding-top: 10px;">Mis mensajes</p>';
                        html +='</div>';
                        
                    html +='</div>';
                  html +='</a>';
                html +='</div>';
                  
                html +='<div class="col-md-6">';
                  html +='<a href="ayuda.php">';
                    html +='<div class="card" style="background-color: #4C7AD8;">';
                    
                        html +='<div class="card-content" style="height: 120px; padding-top: 12px;">';
                          html +='<span style="color: white; font-size: 50px;" class="fa fa-question-circle"></span>';
                          html +='<p style="color: white; font-size: 20px; padding-top: 10px;">¿Necesitas Ayuda?</p>';
                        html +='</div>';
                        
                    html +='</div>';
                  html +='</a>';
                html +='</div>';
                html +='<div class="col-md-2">';
                html +='</div>';
              html +='</div>';
			  
			  $("#tableSys6").css("display","none");
			  $("#tableSys7").css("display","none");
			  $("#tableSys9").css("display","none");
              $("#tableSys12").css("display","none");
              
			  $("#bloques").html(html);
			} else {
			  /***************************EXPERTOS****************************/
			html +='<div class="row">';
                          html +='<div class="col-md-2">';
                          html +='</div>';
			  html +='<div class="col-md-8">';
                html +='<div class="col-md-4">';
                  html +='<a href="escribir.php">';
                    html +='<div class="card" style="background-color: #76BC12;">';
                    
                        html +='<div class="card-content" style="height: 140px; padding-top: 12px;">';
                          html +='<span style="color: white; font-size: 50px;" class="fa fa-pencil"></span>';
                          html +='<p style="color: white; font-size: 20px; padding-top: 10px;">Escribe una publicación nueva</p>';
                        html +='</div>';
                        
                    html +='</div>';
                  html +='</a>';
                html +='</div>';
                html +='<div class="col-md-4">';
                  html +='<a href="calendario.php">';
                    html +='<div class="card" style="background-color: #274565;">';
                        
                        html +='<div class="card-content" style="height: 140px; padding-top: 12px;">';
                          html +='<span style="color: white; font-size: 50px;" class="fa fa-calendar"></span>';
                          html +='<p style="color: white; font-size: 20px; padding-top: 10px;">Ver calendario de publicaciones</p>';
                        html +='</div>';
                        
                    html +='</div>';
                  html +='</a>';
                html +='</div>';
                html +='<div class="col-md-4">';
                  html +='<a href="responder.php">';
                    html +='<div class="card" style="background-color: #2EBEB5;">';
                    
                        html +='<div class="card-content" style="height: 140px; padding-top: 12px;">';
                          html +='<span style="color: white; font-size: 50px;" class="fa fa-envelope"></span>';
                          html +='<p style="color: white; font-size: 20px; padding-top: 10px;">Mis mensajes</p>';
                        html +='</div>';
                        
                    html +='</div>';
                  html +='</a>';
                html +='</div>';
              html +='</div>';
              html +='<div class="col-md-2">';
              html +='</div>';
          html +='</div>';
          
          html +='<div class="row">';
              html +='<div class="col-md-2">';
              html +='</div>';
              html +='<div class="col-md-8">';
                html +='<div class="col-md-4">';
                  html +='<a href="stats.php">';
                    html +='<div class="card" style="background-color: #F68921;">';
                    
                        html +='<div class="card-content" style="height: 140px; padding-top: 12px;">';
                          html +='<span style="color: white; font-size: 50px;" class="icon-stats-dots"></span>';
                          html +='<p style="color: white; font-size: 20px; padding-top: 10px;">Mis estadísticas</p>';
                        html +='</div>';
                        
                    html +='</div>';
                  html +='</a>';
                html +='</div>';
                html +='<div class="col-md-4">';
                  html +='<a href="">'; 
                    html +='<div class="card" style="background-color: #4C7AD8;">';
                        
                        html +='<div class="card-content" style="height: 140px; padding-top: 12px;">';
                          html +='<span style="color: white; font-size: 50px;" class="fa fa-newspaper-o"></span>';
                          html +='<p style="color: white; font-size: 20px; padding-top: 10px;">Descubre contenidos</p>';
                        html +='</div>';
                        
                    html +='</div>';
                  html +='</a>';
                html +='</div>';
                html +='<div class="col-md-4">';
                  html +='<a href="">';
                    html +='<div class="card" style="background-color: #1F8984;">';
                    
                        html +='<div class="card-content" style="height: 140px; padding-top: 12px;">';
                          html +='<span style="color: white; font-size: 50px;" class="fa fa-cogs"></span>';
                          html +='<p style="color: white; font-size: 20px; padding-top: 10px;">Herramientas</p>';
                        html +='</div>';
                        
                    html +='</div>';
                  html +='</a>';
                html +='</div>';
                html +='<div class="col-md-2">';
                html +='</div>';
              html +='</div>';
			  $("#bloques").html(html);
			}
		  }, error: function (response){
			toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
		  }
	});
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
    getMail();
  });

});
</script>

<!--Angular Librerías-->
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.js"></script>
<script type="text/javascript" src="angular/lib/system.js"></script>
<script type="text/javascript" src="angular/lib/nots.js"></script>
<script type="text/javascript" src="angular/lib/factory.js"></script>


<script type="text/javascript" src="js/rastreo.js"></script>
<script type="text/javascript">
    ////Variables Escribir
	var redesTeclasFa = 2000;
	var redesTeclasTw = 140;
</script>
<!--Profile se usa en system para el getMail()-->
<script type="text/javascript" src="js/profile.js"></script>
<script type="text/javascript">
//ayuda
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%61%79%75%64%61%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
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
</script>
<link type="text/css" href="css/style-loading.css" rel="stylesheet" media="all" />
<link type="text/css" href="css/sortable.css" rel="stylesheet" media="all" />

<script>
  function abrirSignUpModal(){
    $("#signup-modal").modal("show");
  }
</script>
    
</head>
<body style="background-color: #f3f3f3;" ng-controller="systemCtrl">
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
                <div class="card">
                    <div class="card-content">
                      <img src="<?PHP echo $foto_bamboostr; ?>" style="width: 100px; height: 100px; display: inline-block;">
                      <p style="padding-left: 50px; font-size: 20px; display: inline-block;">Bienvenido <?PHP echo $screen_name_bamboostr; ?></p>
                      <p style="padding-right: 50px; font-size: 20px; display: inline-block;" class="pull-right hidden-xs">
                        <button onclick="abrirSignUpModal();" style="background-color: #26A8FF; margin-left: 50px;" class="btn waves-effect waves-light" type="submit" name="action">Agrega otra red social
                            <span class="fa fa-plus"></span>
                        </button>    
                      </p>
                    </div>
                </div>
              </div>
            <div class="col-md-2">
            </div>
          </div>
          
          <div id="bloques" class="row" style="margin:0;">
              
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