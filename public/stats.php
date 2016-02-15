<?PHP
require_once('session.php');
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
	include 'desktop/header.php';
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
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/huso-horario.js"></script>
<script type="text/javascript">
<?PHP include 'textos.php' ?>
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

<!--Angular Librerías-->
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.js"></script>
<script type="text/javascript" src="angular/lib/stats.js"></script>
<script type="text/javascript" src="angular/lib/nots.js"></script>
<script type="text/javascript" src="angular/lib/factory.js"></script>
<!--Fin angular-->

<script>
  function abrirSignUpModal(){
    $("#signup-modal").modal("show");
  }
</script>
    
</head>
<body style="background-color: #f3f3f3;" ng-controller="statsCtrl">
        <?PHP
            include 'desktop/header-menu.php';
            headerMenu($_SESSION['foto_bamboostr']);
        ?>

        <?PHP
            include 'loading.php';
        ?>
        
        <section id="main">
            <aside id="sidebar" class="">
                <div class="sidebar-inner c-overflow" tabindex="1" style="overflow: hidden; outline: none;">
                    <?PHP 
					  include 'desktop/menu.php';
	                  menu();
					?>
                </div>
            </aside>
        </section>

        <section id="body">

          <div class="row">
              <div class="col-md-12">
                <div style="background-color: #f9f9f9;" class="card">
                    <div class="card-content">
                      <p style="color: #175780; padding-left: 50px; font-size: 15px; display: inline-block;">
                        <a class="underline" href="system.php">Inicio</a> > <a class="underline" href="">Publicación Nueva</a>
                      </p><br />
                      <p style="padding-right: 50px; font-size: 20px; display: inline-block;" class="pull-right hidden-xs">
                        <button onclick="abrirSignUpModal();" style="background-color: #26A8FF; margin-left: 50px;" class="btn waves-effect waves-light" type="submit" name="action">Agrega otra red social
                            <span class="fa fa-plus"></span>
                        </button>    
                      </p>
                      <p style="color: #14446d; padding-left: 50px; font-size: 28px; display: inline-block;">Mis Estadísticas</p><br />
                      <p style="color: #929292; padding-left: 50px; font-size: 18px; display: inline-block;">Obten y analiza la información de lo que sucede en tus cuentas.</p>
                    </div>
                </div>
              </div>
          </div>  
        </section>

        <section id="body">
            <div class="row">
                <div class="col-md-12">
                  <div class="card">
                      <div class="row">
                        <div class="col-md-12">
                          <ul class="tabs">
                            <li class="tab col-md-12"><a class="active" href="#test1">Información General</a></li>
                          </ul>
                        </div>
                        <div style="margin-top: 10px;" id="test1" class="col-md-12">
                          <div class="row">
                            <div style="color: #929292; font-size: 18px;" class="col-md-12">
                              Resumen de siete días de la actividad más importante de tu página.
                            </div>
                          </div>
                        </div>
                      </div><!--Fin row-->
                  </div><!--fin card-->
                </div>
            </div><!--Fin row-->
    
            <div class="row">
                <div class="col-md-4">
                  <div class="card">
                    <div style="border: 3px solid #929292; padding: 10px 10px;" class="col-md-12">
                      <p style="margin-bottom: 0px; font-size: 18px; color: #0a6ebd;">Me gusta de la página <!--<i class="fa fa-chevron-right"></i>--></p>
                      
                    </div>
                    
                    <div style="padding: 10px 10px;" class="col-md-12">
                      <p style="padding-bottom: 0px; margin-bottom: 0px; font-size: 20px; color: #14446d;" class="col-md-4">437</p> <p style="padding-bottom: 0px; margin-bottom: 0px; padding-top: 3px; color: #929292;" class="col-md-8">Me gusta en total</p>
                    </div>

                    <div style="border-bottom: 3px solid #929292; padding: 0 10px 10px 0;" class="col-md-12">
                      <p style="padding-left: 40px; padding-bottom: 0px; margin-bottom: 0px; font-size: 16px; color: #14446d;" class="col-md-4">0%</p> <p style="padding-bottom: 0px; margin-bottom: 0px; padding-top: 3px; color: #929292;" class="col-md-8">Desde la última semana</p>
                    </div>

                    <div style="padding: 10px 10px;" class="col-md-12">
                      <p style="padding-bottom: 0px; margin-bottom: 0px; font-size: 20px; color: #14446d;" class="col-md-4">0</p> <p style="padding-bottom: 0px; margin-bottom: 0px; padding-top: 3px; color: #929292;" class="col-md-8">Nuevos me gusta</p>
                    </div>

                    <div style="border-bottom: 3px solid #929292; padding: 0 10px 10px 0;" class="col-md-12">
                      <p style="padding-left: 40px; padding-bottom: 0px; margin-bottom: 0px; font-size: 16px; color: #14446d;" class="col-md-4">0%</p>
                    </div>

                  </div>
                </div>
                <div class="col-md-4">
                  <div style="border: 3px solid #929292; padding: 10px 10px;" class="card">
                    <p style="margin-bottom: 0px; font-size: 18px; color: #0a6ebd;">Alcance de la publicación <!--<i class="fa fa-chevron-right"></i>--></p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div style="border: 3px solid #929292; padding: 10px 10px;" class="card">
                    <p style="margin-bottom: 0px; font-size: 18px; color: #0a6ebd;">Participación <!--<i class="fa fa-chevron-right"></i>--></p>
                  </div>
                </div>
              </div>
            </div>         
        </section>

    <?PHP include 'footer.php'; footer(); ?>
    <?PHP include 'notificaciones.php'; ?>
</body>
 </html>
 <?PHP
} else {
  include 'error.html';
}?>