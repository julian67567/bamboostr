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
</script>
<script type="text/javascript" src="js/rastreo.js"></script>
<script type="text/javascript">
    ////Variables Escribir
	var redesTeclasFa = 2000;
	var redesTeclasTw = 140;
</script>
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
//sortable (ordenador)
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%73%6F%72%74%61%62%6C%65%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
</script>
<link type="text/css" href="css/style-loading.css" rel="stylesheet" media="all" />
<link type="text/css" href="css/sortable.css" rel="stylesheet" media="all" />

<!--Angular Librerías-->
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.js"></script>
<script type="text/javascript" src="angular/lib/profiles.js"></script>
<script type="text/javascript" src="angular/lib/nots.js"></script>
<script type="text/javascript" src="angular/lib/factory.js"></script>
<!--Fin angular-->
 
<script>
  function abrirSignUpModal(){
    $("#signup-modal").modal("show");
  }
</script>
    
</head>
<body style="background-color: #f3f3f3;" ng-controller="profilesCtrl">
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
                      <!-- <p style="color: #175780; padding-left: 50px; font-size: 15px; display: inline-block;">
                         <a class="underline" href="system.php">Inicio</a> > <a class="underline" href="">Mi perfil</a>
                      </p><br /> -->
                      <!-- <p style="padding-right: 50px; font-size: 20px; display: inline-block;" class="pull-right hidden-xs">
                        <button onclick="abrirSignUpModal();" style="background-color: #26A8FF; margin-left: 50px;" class="btn waves-effect waves-light" type="submit" name="action">Agrega otra red social<span class="fa fa-plus"></span>
                        </button>    
                      </p> -->
                      <p style="color: #14446d; padding-left: 50px; font-size: 28px; display: inline-block;">Mi perfil</p><br />
                      <p style="color: #929292; padding-left: 50px; font-size: 18px; display: inline-block;">Modifica las características de tu perfil</p>
                    </div>
                </div>
              </div>

             <div class="col-md-2">
             </div>

          </div>  
        </section>

        <section id="body">
            <!-- <div class="row">
   
              <div class="col-md-2">
              </div>

              <div class="col-md-8">

                <div class="card">
                    <div class="card-content">
                      <img src="<?PHP echo $user_image; ?>" style="display: inline-block;">
                      <p style="padding-left: 50px; font-size: 20px; display: inline-block;"><?PHP echo $screen_name; ?></p>
                    </div>
                </div>
              </div>

              <div class="col-md-2">
              </div>

          </div> -->


         <div class="row">

          <div class="row">
           <div class="col-md-2">
           </div>
            
           <div class="col-md-8">
             <ul class="tabs">
               <li class="tab col-md-4"><a class="active" href="#tab1">Perfil</a></li>
               <li class="tab col-md-4"><a href="#tab2">Cuentas</a></li>
               <li class="tab col-md-4"><a href="#tab3">Redes</a></li>
             </ul>
           </div>
         
           <div class="col-md-2">
           </div>
          </div>

          <div class="col-md-2">
          </div> 

           <div class="col-xs-12 col-md-8">
             <div class="card">
               <div class="card-content">

              <div id="tab1" class="col s12">
                
                <div class="col-xs-12 col-sm-6 col-md-5" style="text-align: right; padding: 0;">
                    
                  <div id="foto_perfil" style="cursor: pointer; opacity: 1; color: #ffffff; font-size: 35px; text-align: center; background: url('<?PHP echo $foto_bamboostr; ?>') no-repeat scroll center center / 100% 100%; max-width: 300px; width:80%; height:80%;" data-position="top" id="">
                    <!--<input id="fileImage" type="file" name="file" style="text-align: center; width: 100px; height: 100px; opacity: 0; display: inline-block;">
                    -->

                    <div style="background: rgba(0,0,0,0.5);width: 100%;height: 100%;">
                      <p style="font-size: 70px; margin-top: 100px;" class="glyphicon glyphicon-camera"></p>
                      <p style="margin-top: -10px; font-family: lato-bold;">Cambia tu foto</p>
                      <p style="margin-top: -10px; font-family: lato-bold;">de perfil</p>
                    </div>

                    <span class="file-input btn btn-block btn-primary btn-file col-lg-6 col-sm-6 col-12">
                        Examinar&hellip; <input id="fileImage" type="file" name="file" size="50" ng-model="photo" onchange="angular.element(this).scope().cambiarImagen()" type="file" accept="image/jpeg, image/png, image/gif, image/bmp" />
                    </span>

                  </div>

                </div>

                <div class="hidden-xs hidden-sm col-md-1" style="border-right:3px solid #eeeeee; height:425px; padding: 0; margin: 0; margin-right: 10px; width:3px; text-align: center;">
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6" style="text-align: left; padding: 0;">

                  <p style="font-size: 16px; color:#a3a3a3">Usuario</p>

                  <input style="border: 1px solid #26a8ff; height: 30px; font-size: 13px; color: #5e5e5e; padding-left: 10px; height: 36px; width: 80%; border-radius: 4px; margin-bottom:10px;" type="text" class="form-control" value="{{details.screen_name}}" aria-describedby="sizing-addon1" id="username52">


                  <p style="font-size: 16px; color:#a3a3a3">Nombre</p>

                  <input style="border: 1px solid #26a8ff; height: 30px; font-size: 13px; color: #5e5e5e; padding-left: 10px; height: 36px; width: 80%; border-radius: 4px; margin-bottom:10px;" type="text" class="form-control" value="{{details.screen_name_bamboostr}}" aria-describedby="sizing-addon1" id="nombre52">

                  <p style="font-size: 16px; color:#a3a3a3">Correo electrónico</p>

                  <input style="border: 1px solid #26a8ff; height: 30px; font-size: 13px; color: #5e5e5e; padding-left: 10px; height: 36px; width: 80%; border-radius: 4px; margin-bottom:10px;" type="text" class="form-control" value="{{details.mail}}" aria-describedby="sizing-addon1" id="mail52">

                  
                  <p style="font-size: 16px; color:#a3a3a3">Tu categoría</p>

                  <select id="categoria52" onchange="getCat(this.value);" style="display: block; border-color: #26a8ff; color: #5e5e5e; width: 80%; height: 80%; border-radius: 4px; margin-bottom:20px;">
                    <option value="1">Noticias, Política y Actualidad</option>
                    <option ng-if="details.categoria=='1'" value="1" selected>Noticias, Política y Actualidad</option>
                    <option value="2">Artes y Humanidades</option>
                    <option ng-if="details.categoria=='2'" value="2" selected>Artes y Humanidades</option>
                    <option value="3">Negocios y Finanzas</option>
                    <option ng-if="details.categoria=='3'" value="3" selected>Negocios y Finanzas</option>
                    <option value="4">Autos</option>
                    <option ng-if="details.categoria=='4'" value="4" selected>Autos</option>
                    <option value="5">Educación</option>
                    <option ng-if="details.categoria=='5'" value="5" selected>Educación</option>
                    <option value="6">Entretenimiento</option>
                    <option ng-if="details.categoria=='6'" value="6" selected>Entretenimiento</option>
                    <option value="7">Belleza y Moda</option>
                    <option ng-if="details.categoria=='7'" value="7" selected>Belleza y Moda</option>
                    <option value="8">Ejecicio</option>
                    <option ng-if="details.categoria=='8'" value="8" selected>Ejecicio</option>
                    <option value="9">Comida y Bebida</option>
                    <option ng-if="details.categoria=='9'" value="9" selected>Comida y Bebida</option>
                    <option value="10">Salud</option>
                    <option ng-if="details.categoria=='10'" value="10" selected>Salud</option>
                    <option value="11">Música</option>
                    <option ng-if="details.categoria=='11'" value="11" selected>Música</option>
                    <option value="12">Hogar y Estilo de vida</option>
                    <option ng-if="details.categoria=='12'" value="12" selected>Hogar y Estilo de vida</option>
                    <option value="13">Crianza y Familia</option>
                    <option ng-if="details.categoria=='13'" value="13" selected>Crianza y Familia</option>
                    <option value="14">Religión y Espiritualidad</option>
                    <option ng-if="details.categoria=='14'" value="14" selected>Religión y Espiritualidad</option>
                    <option value="15">Ciencia</option>
                    <option ng-if="details.categoria=='15'" value="15" selected>Ciencia</option>
                    <option value="16">Mercadotecnia</option>
                    <option ng-if="details.categoria=='16'" value="16" selected>Mercadotecnia</option>
                    <option value="17">Deportes</option>
                    <option ng-if="details.categoria=='17'" value="17" selected>Deportes</option>
                    <option value="18">Tecnología</option>
                    <option ng-if="details.categoria=='18'" value="18" selected>Tecnología</option>
                    <option value="19">Medio Ambiente</option>
                    <option ng-if="details.categoria=='19'" value="19" selected>Medio Ambiente</option>
                    <option value="20">Viajes</option>
                    <option ng-if="details.categoria=='20'" value="20" selected>Viajes</option>
                  </select>
       

                  <p style="font-size: 16px; color:#a3a3a3">Contraseña actual</p>

                  <input style="border: 1px solid #26a8ff; height: 30px; font-size: 13px; color: #5e5e5e; padding-left: 10px; height: 34px; width: 80%; border-radius: 4px; margin-bottom:0;" type="password" class="form-control" value="password" aria-describedby="sizing-addon1" id="nombreURL">

                  <p ng-click="olvidastePass()" style="font-size: 16px; color:#26a8ff; cursor: pointer; width:190px;">¿Olvidaste tu contraseña?</p>
                  

                  <p style="font-size: 16px; color:#a3a3a3">Nueva contraseña</p>

                  <input style="border: 1px solid #26a8ff; height: 30px; font-size: 13px; color: #5e5e5e; padding-left: 10px; height: 34px; width: 80%; border-radius: 4px; margin-bottom:0;" type="password" class="form-control" value="" aria-describedby="sizing-addon1" id="password52">
                  

                  <p style="font-size: 16px; color:#a3a3a3">Confirmar contraseña</p>

                  <input style="border: 1px solid #26a8ff; height: 30px; font-size: 13px; color: #5e5e5e; padding-left: 10px; height: 34px; width: 80%; border-radius: 4px; margin-bottom:0;" type="password" class="form-control" value="" aria-describedby="sizing-addon1" id="passwordConf52">

                  </br>
                  <a class="waves-effect waves-light btn" style="background-color:#26A8FF; width:250px;" ng-click="guardarCambios52();">Guardar cambios</a>
                   
                </div>
 
                </br>

                <div class="col-xs-12 col-sm-12 col-md-12">
                   <br/>
                </div>

                </div>

                </div> <!-- FIN TAB PERFIL -->

                <div id="tab2" class="col s12"> 
                   
                   <!--si no hay cuentas-->
                   <div ng-if="cuentas == 'null'">
                     <p style="text-align: center; color: red;" class="lato-bold">No tienes redes sociales agregadas</p>
                     <p style="text-align: center;">
                       <a style="cursor: pointer; text-align: center;" onclick="abrirSignUpModal();" class="lato-bold">Agrega una red</a>
                     </p>
                   </div>
                   <!--fin si no hay cuentas-->
                   
                   <div ng-if="x[1]=='twitter'" ng-repeat="(key,x) in cuentas">
                     <div class="col-md-2 col-xs-2" style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15); margin:10px; padding:0px; background-color:#f9f9f9; border: 1px solid #e2e2e2; height: 60px; width: 250px;">                     
                       <div id="twitter_icono" class="col-md-3 col-xs-3" style="padding-top: 10px; padding-right: 10px;">
                         <div style="position: absolute; right: 8px; top: 28px;" data-position="top" id="" class="img-circle"><img style="-webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; width:15px;" src="images/t.png"></img></div>
                         <img src="{{x[3]}}" style="-webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; width:35px;">
                       </div>

                       <div class="col-md-7 col-xs-7" style="padding:0;">
                         <p style="font-size: 16px; color: #929292; padding-top: 18px;">@{{x[2]}}</p>
                       </div>

                       <div class="col-md-2 col-xs-2">
                         <div class="col-md-12 col-xs-12" style="padding-top:0px;">
                           <p ng-click="deleteCuenta(x)" id="" class="glyphicon glyphicon-trash" style="cursor: pointer; background-color: rgb(255, 132, 132); color: rgb(255, 255, 255); width: 25px; font-size: 15px; height: 30px; padding-top: 8px; padding-left: 5px; margin-top: 0px; margin-bottom: 0px;"></p>
                           <p ng-click="confCuenta(x)" id="" class="glyphicon glyphicon-cog" style="cursor: pointer; background-color: #8b8b8b; color: #ffffff; width: 25px; font-size: 15px; height: 30px; padding-top: 8px; padding-left: 5px; margin-top: 0px;"></p>
                         </div>
                       </div>

                     </div> <!-- final col-md-2 100% -->
                   </div> <!-- final ng-if twitter -->       

                   </br>

                   <div class="col-md-12 col-xs-12">
                     <hr style="border-width: 2px;">
                   </div>   

                   <div ng-if="x[1]=='facebook'" ng-repeat="(key,x) in cuentas">
                     <div class="col-md-2 col-xs-2" style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15); margin:10px; padding:0px; background-color:#f9f9f9; border: 1px solid #e2e2e2; height: 60px; width: 250px;">                     
                       <div id="facebook_icono" class="col-md-3 col-xs-3" style="padding-top: 10px; padding-right: 10px;">
                         <div style="position: absolute; right: 8px; top: 28px;" data-position="top" id="" class="img-circle"><img style="-webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; width:15px;" src="images/f.png"></img></div>
                         <img src="{{x[3]}}" style="-webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; width:35px;">
                       </div>

                       <div class="col-md-7 col-xs-7" style="padding:0;">
                         <p style="font-size: 16px; color: #929292; padding-top: 18px;">{{x[2]}}</p>
                       </div>

                       <div class="col-md-2 col-xs-2">
                         <div class="col-md-12 col-xs-12" style="padding-top:0px;">
                           <p ng-click="deleteCuenta(x)" id="" class="glyphicon glyphicon-trash" style="cursor: pointer; background-color: rgb(255, 132, 132); color: rgb(255, 255, 255); width: 25px; font-size: 15px; height: 30px; padding-top: 8px; padding-left: 5px; margin-top: 0px; margin-bottom: 0px;"></p>
                           <p ng-click="confCuenta(x)" id="" class="glyphicon glyphicon-cog" style="cursor: pointer; background-color: #8b8b8b; color: #ffffff; width: 25px; font-size: 15px; height: 30px; padding-top: 8px; padding-left: 5px; margin-top: 0px;"></p>
                         </div>
                       </div>

                     </div> <!-- final col-md-2 100% -->
                   </div> <!-- final ng-if facebook -->  

                   <div class="col-md-12 col-xs-12">
                     <hr style="border-width: 2px;">
                   </div>   

                   <div ng-if="x[1]=='instagram'" ng-repeat="(key,x) in cuentas">
                     <div class="col-md-2 col-xs-2" style="box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15); margin:10px; padding:0px; background-color:#f9f9f9; border: 1px solid #e2e2e2; height: 60px; width: 250px;">                     
                       <div id="instagram_icono" class="col-md-3 col-xs-3" style="padding-top: 10px; padding-right: 10px;">
                         <div style="position: absolute; right: 8px; top: 28px;" data-position="top" id="" class="img-circle"><img style="-webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; width:15px;" src="images/i.png"></img></div>
                         <img src="{{x[3]}}" style="-webkit-border-radius: 30px; -khtml-border-radius: 30px; -moz-border-radius: 30px; border-radius: 30px; width:35px;">
                       </div>

                       <div class="col-md-7 col-xs-7" style="padding:0;">
                         <p style="font-size: 16px; color: #929292; padding-top: 18px;">{{x[2]}}</p>
                       </div>

                       <div class="col-md-2 col-xs-2">
                         <div class="col-md-12 col-xs-12" style="padding-top:0px;">
                           <p ng-click="deleteCuenta(x)" id="" class="glyphicon glyphicon-trash" style="cursor: pointer; background-color: rgb(255, 132, 132); color: rgb(255, 255, 255); width: 25px; font-size: 15px; height: 30px; padding-top: 8px; padding-left: 5px; margin-top: 0px; margin-bottom: 0px;"></p>
                           <p ng-click="confCuenta(x)" id="" class="glyphicon glyphicon-cog" style="cursor: pointer; background-color: #8b8b8b; color: #ffffff; width: 25px; font-size: 15px; height: 30px; padding-top: 8px; padding-left: 5px; margin-top: 0px;"></p>
                         </div>
                       </div>

                     </div> <!-- final col-md-2 100% -->
                   </div> <!-- final ng-if instagram --> 

                  <div class="col-md-12 col-xs-12">
                     <br/>
                  </div> 

                  </div> <!-- FIN TAB CUENTAS -->

                  <div id="tab3" class="col s12">
                     <div class="col-md-1 col-sm-1">
                       <img src="images/facebook_c.png" style="width:35px;">
                     </div>
                     <div class="col-md-8 col-sm-8">
                       <p style="font-size: 16px; color:#929292; padding-top:5px;">Facebook</p>
                     </div>
                     <div class="col-md-3 col-sm-3" style="text-align: center;">
                       <a class="waves-effect waves-light btn" style="background-color:#26A8FF; width:150px;" onclick="rastrearLogR('faConditions');">Conectar</a>
                     </div>

                     <div class="col-md-12 col-xs-12">
                       <hr style="border-width: 2px;">
                     </div> 
  
                     <div class="col-md-1 col-sm-1">
                       <img src="images/fanpage_c.png" style="width:35px;">
                     </div>
                     <div class="col-md-8 col-sm-8">
                       <p style="font-size: 16px; color:#929292; padding-top:5px;">Facebook page</p>
                     </div>
                     <div class="col-md-3 col-sm-3" style="text-align: center;">
                       <a class="waves-effect waves-light btn" style="background-color:#26A8FF; width:150px;" ng-click="">Conectar</a>
                     </div>

                     <div class="col-md-12 col-xs-12">
                       <hr style="border-width: 2px;">
                     </div> 

                     <div class="col-md-1 col-sm-1">
                       <img src="images/twitter_c.png" style="width:35px;">
                     </div>
                     <div class="col-md-8 col-sm-8">
                       <p style="font-size: 16px; color:#929292; padding-top:5px;">Twitter</p>
                     </div>
                     <div class="col-md-3 col-sm-3" style="text-align: center;">
                       <a class="waves-effect waves-light btn" style="background-color:#26A8FF; width:150px;" onclick="rastrearLogR('twConditions');">Conectar</a>
                     </div>

                     <div class="col-md-12 col-xs-12">
                       <hr style="border-width: 2px;">
                     </div> 

                     <div class="col-md-1 col-sm-1">
                       <img src="images/instagram_c.png" style="width:35px;">
                     </div>
                     <div class="col-md-8 col-sm-8">
                       <p style="font-size: 16px; color:#929292; padding-top:5px;">Instagram</p>
                     </div>
                     <div class="col-md-3 col-sm-3" style="text-align: center;">
                       <a class="waves-effect waves-light btn" style="background-color:#26A8FF; width:150px;" onclick="rastrearLogR('inConditions');">Conectar</a>
                     </div>

                     <div class="col-md-12 col-xs-12">
                       <br/>
                     </div> 

                  </div>

                </div> <!-- final card-content -->
               </div> <!-- final card -->
              </div> <!-- final col-md-8 -->

              <div class="col-md-2">
              </div> 
               
              </div>
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