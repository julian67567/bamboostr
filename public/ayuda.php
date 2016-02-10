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

 
        <section>
    <br>
    <br>
    <div class="row text-center">
      <p style="font-size:36px;">Preguntas Frecuentes</p>
    </div>
    <br>
  </section>

  <section>
<div class="row text-center">
  <div class="col-md-3">
      <br><br>
  </div><!-- /.col-lg-6 -->
  <div class="col-md-6">
    <div class="input-group">
      <input type="text" class="form-control" style="height:36px; padding-left:10px;" placeholder="Encuentra lo que necesites, escribe una palabra clave">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" STYLE="background: #26a8ff; BORDER-COLOR: #26a8ff;"><span class="glyphicon glyphicon-search" style="color:white;"></span></button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
    <div class="col-md-3">
      <br><br>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br>
  </section>


<section>
<div class="row">
          <div class="col-md-2">
          </div>

          <div class="col-md-4">

            <div class="row">
              <div class="col-md-12"> <h4>¿Cómo funciona Bamboostr?</h4></div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <p>No pierdas el contacto con tu comunidad, ahorra tiempo en cambiarte entre páginas y observa el contenido de tus diferentes cuentas en un solo lugar. </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12"> <h4>¿Cómo funciona Bamboostr?</h4></div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <p>No pierdas el contacto con tu comunidad, ahorra tiempo en cambiarte entre páginas y observa el contenido de tus diferentes cuentas en un solo lugar. </p>
              </div>
            </div>            
          </div>
   
          <div class="col-md-2">
          </div>

      </div>
</section>

<section>
<div class="row">
          <div class="col-md-2">
          </div>

          <div class="col-md-4">

            <div class="row">
              <div class="col-md-12"> <h4>¿Cómo funciona Bamboostr?</h4></div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <p>No pierdas el contacto con tu comunidad, ahorra tiempo en cambiarte entre páginas y observa el contenido de tus diferentes cuentas en un solo lugar. </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12"> <h4>¿Cómo funciona Bamboostr?</h4></div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <p>No pierdas el contacto con tu comunidad, ahorra tiempo en cambiarte entre páginas y observa el contenido de tus diferentes cuentas en un solo lugar. </p>
              </div>
            </div>            
          </div>
   
          <div class="col-md-2">
          </div>

      </div>
</section>

<section>
<div class="row">
          <div class="col-md-2">
          </div>

          <div class="col-md-4">

            <div class="row">
              <div class="col-md-12"> <h4>¿Cómo funciona Bamboostr?</h4></div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <p>No pierdas el contacto con tu comunidad, ahorra tiempo en cambiarte entre páginas y observa el contenido de tus diferentes cuentas en un solo lugar. </p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12"> <h4>¿Cómo funciona Bamboostr?</h4></div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <p>No pierdas el contacto con tu comunidad, ahorra tiempo en cambiarte entre páginas y observa el contenido de tus diferentes cuentas en un solo lugar. </p>
              </div>
            </div>            
          </div>
   
          <div class="col-md-2">
          </div>

      </div>
</section>

    <section style="background-color: #343434; margin:0; padding:0;">
    <br>
          <div class="row">
              <div class="col-md-12 text-center" >
                  <h2 style="color: white;">Si no encontraste lo que buscabas escríbenos y te ayudaremos</h2>
             </div>
          </div>
<br>
          <div class="row" style="margin:0;"> 
            <div class="col-md-4"></div>

              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" id="user" style="padding-left:10px;" placeholder= "Tu Nombre" >
                </div>
              </div>
          </div>

          <div class="row" style="margin:0;">
<div class="col-md-4"></div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" class="form-control" style="padding-left:10px;" id="mail" placeholder="Tu Correo" >
                </div>                
              </div>
          </div>


<div class="row">
          <div class="col-md-4"></div>
              <div class="col-md-4">
                <div class="form-group">
                  <textarea class="form-control"rows="4" style="padding-left:10px; padding-top:5px;" placeholder="Comentarios..."></textarea>
                 
                </div>                
              </div>
</div>


<div class="row">
  <div class="col-md-4"></div>
              <div class="col-md-4 text-center">
                <button type="button" class="btn btn-cta btn-cta-primary" data-toggle="modal" data-target=" ">¡Listo!</button>                
              </div>
</div>

          </div>
          <br>
    </section> 
                
       
    <?PHP include ''.dirname(__FILE__).'/footer.php'; footer(); ?>
    <?PHP include ''.dirname(__FILE__).'/notificaciones.php'; ?>
</body>
 </html>
 <?PHP
} else {
  include ''.dirname(__FILE__).'/error.html';
}?>