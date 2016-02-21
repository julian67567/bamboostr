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
if($identify){
    $query=$conn->query("SELECT social_networks FROM token WHERE identify='".$identify."' AND red='".$redSocial."'");
    $row=$query->fetch_assoc();
    $social_networks=$row["social_networks"];
    $social_networks_parts=explode(",",$social_networks);
    $c=0;
    include 'scripts/query-write.php';
}
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
<script type="text/javascript" src="angular/lib/responder.js"></script>
<script type="text/javascript" src="angular/lib/nots.js"></script>
<script type="text/javascript" src="angular/lib/factory.js"></script>
<!--Fin angular-->

<script>
  function abrirSignUpModal(){
    $("#signup-modal").modal("show");
  }
</script>

<script>
function changeTab(tab,name){
  console.log(tab);
  $('ul.tabs').tabs('select_tab', tab);
  $('#textoChangeTab').html(name);
}
</script>
    
</head>
<body style="background-color: #f3f3f3;" ng-controller="responderCtrl">
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
              <div class="col-md-2">
              </div>
                  
              <div class="col-md-8">
                <div style="background-color: #f9f9f9;" class="card">
                    <div class="card-content">
                      <p style="color: #175780; padding-left: 50px; font-size: 15px; display: inline-block;">
                        <a class="underline" href="system.php">Inicio</a> > <a class="underline" href="">Mis Mensajes</a>
                      </p><br />
                      <p style="padding-right: 50px; font-size: 20px; display: inline-block;" class="pull-right hidden-xs">
                        <button onclick="abrirSignUpModal();" style="background-color: #26A8FF; margin-left: 50px;" class="btn waves-effect waves-light" type="submit" name="action">Agrega otra red social
                            <span class="fa fa-plus"></span>
                        </button>    
                      </p>
                      <p style="color: #14446d; padding-left: 50px; font-size: 28px; display: inline-block;">Mis Mensajes</p><br />
                      <p style="color: #929292; padding-left: 50px; font-size: 18px; display: inline-block;">Encuentra todos tu mensajes en un sólo lugar.</p>
                    </div>
                </div>
              </div>
              
              <div class="col-md-2">
              </div>    
          </div>  
        </section>

        <section style="padding-top: 60px; margin-bottom: 60px;" id="body">
	      <div class="row">
            <div class="col-md-2">
                
            </div>
	    	<div class="hidden-xs col-md-8" ng-hide="enviar1">
	      		<ul class="tabs" style="background-color: transparent !important;">
	        		<li class="tab col-md-3" ng-click="clear()">
                      <a class="active" href="#tab1">Todos (<b ng-show="(inbox | filter: { delete:0}).length">{{todos.length}}</b><b ng-show="!(inbox | filter: { delete:0}).length">0</b>)</a>
                    </li>
                    <li class="tab col-md-3" ng-click="clear()">
                      <a href="#tab2">No Leídos (<b ng-show="(inbox | filter: { read:0}).length">{{read.length}}</b><b ng-show="!(inbox | filter: { read:0}).length">0</b>)</a>
                    </li>
	        		<li class="tab col-md-3" ng-click="clear()">
                      <a href="#tab3">Archivados (<b ng-show="(inbox | filter: { pin:1}).length">{{archivados.length}}</b><b ng-show="!(inbox | filter: { pin:1}).length">0</b>)</a>
                    </li>	
                    <li class="tab col-md-3" ng-click="clear()">
                      <a href="#tab4">Eliminados (<b ng-show="(inbox | filter: { delete:1}).length">{{eliminados.length}}</b><b ng-show="!(inbox | filter: { delete:1}).length">0</b>)</a>
                    </li>      		
                </ul>
	    	</div>
            
            <div style="z-index:1;" class="hidden-sm hidden-md hidden-lg col-xs-12">
                <div class="text-center dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span id="textoChangeTab">TODOS (<b ng-show="(inbox | filter: { delete:0}).length">{{todos.length}}</b><b ng-show="!(inbox | filter: { delete:0}).length">0</b>)</span>
                        <span class="caret"></span>
                    </button>
                    <ul style="left: 40%;" class="text-center dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a style="cursor: pointer; float: left; width: 100%; text-align: left;" onclick="changeTab('tab1','TODOS');">TODOS (<b ng-show="(inbox | filter: { delete:0}).length">{{todos.length}}</b><b ng-show="!(inbox | filter: { delete:0}).length">0</b>)</a></li>
                        <li><a style="cursor: pointer; float: left; width: 100%; text-align: left;" onclick="changeTab('tab2','NO LEÍDOS');">NO LEÍDOS (<b ng-show="(inbox | filter: { read:0}).length">{{read.length}}</b><b ng-show="!(inbox | filter: { read:0}).length">0</b>)</a></li>
                        <li><a style="cursor: pointer; float: left; width: 100%; text-align: left;" onclick="changeTab('tab3','ARCHIVADOS');">ARCHIVADOS (<b ng-show="(inbox | filter: { pin:1}).length">{{archivados.length}}</b><b ng-show="!(inbox | filter: { pin:1}).length">0</b>)</a></li>
                        <li><a style="cursor: pointer; float: left; width: 100%; text-align: left;" onclick="changeTab('tab4','ELIMINADOS');">ELIMINADOS (<b ng-show="(inbox | filter: { delete:1}).length">{{eliminados.length}}</b><b ng-show="!(inbox | filter: { delete:1}).length">0</b>)</a></li>
                    </ul>
                </div>
            </div>
            
	    	<div id="tab1" class="col-md-12">
                <div class="col-md-2">
                </div>
                
		    	<div class="col-md-8" ng-hide="enviar1">
                    
                    <div style="margin-top: 15px;" class="row">
                      <div class="col-md-12">
                        <div class="input-group input-group-lg col-xs-12 col-md-4">
                          <input style="border: 1px solid #ccc; height: 37px; font-size: 13px;" type="text" class="form-control" placeholder="Buscar mensaje" aria-describedby="sizing-addon1" ng-model="buscadorTab1">
                          <span style="padding: 0px 8px 9px 8px; font-size: 12px; height: 30px; margin-top: 0px;" class="input-group-addon glyphicon glyphicon-search" id="sizing-addon1"></span>
                         </div>
                      </div>
                    </div><!--row-->
                    
                    <div ng-if="todos.length=='0'" class="responderNoHayMsg">
                      <div class="alert alert-warning">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> No hay mensajes.
                      </div>
                    </div>
                    
		    		<div id="{{x.id}}" ng-repeat="x in todos = (inbox | limitTo:100 | filter: {delete:0} | filter:buscadorTab1)" class="responderBloque">
			        	<div ng-if="x.red=='twitter'" class="row">
                            <div ng-click="abrirMsg(x)" style="text-align: center; padding-top:10px;" class="col-md-1">
                              <img onerror="this.src='images/logo-bamboostr.png'" style="text-align: center; " class="round2" src="{{x.image_user}}" />
                            </div>
			            	<div ng-click="abrirMsg(x)" class="col-md-9" style="padding-top:10px;">
			            		<span class="" style="font-weight: bold;">
                                  <strong>{{x.name}} @{{x.screen_name}}</strong><strong style="padding-left: 10px;">{{x.fecha}}</strong>
                                </span><br />
                                <span ng-if="x.propietario=='0'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>@{{x.screen_name}}: {{x.mensaje}} </strong>
                                </span>
                                <span ng-if="x.propietario=='1'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>@{{x.propietario_screen_name}}: {{x.mensaje}} </strong>
                                </span>
			            	</div>
                            <div style="padding-top:10px;" class="col-md-2">
                              <a style="background-color: #ff8484;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="eliminarMsgDm(x,1)">
                                <i style="color: white;" class="glyphicon glyphicon-trash"></i>
                              </a>
                              <a style="background-color: #8b8b8b;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="archivar(x, 1, $event)">
                                <i style="color: white;" class="fa fa-thumb-tack"></i>
                              </a>
                            </div>
			          	</div>
                        
                        <div ng-if="x.red=='facebook'" class="row">
                            <div ng-click="abrirMsg(x)" style="text-align: center; padding-top:10px;" class="col-md-1">
                              <img onerror="this.src='images/logo-bamboostr.png'" style="text-align: center; " class="round2" src="images/redes_sociales/facebook.png" />
                            </div>
			            	<div ng-click="abrirMsg(x)" class="col-md-9" style="padding-top:10px;">
			            		<span class="" style="font-weight: bold;">
                                  <strong>{{x.name}} {{x.fecha}}</strong>
                                </span><br />
                                <span ng-if="x.propietario=='0'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>{{x.screen_name}}: {{x.mensaje}} </strong>
                                </span>
                                <span ng-if="x.propietario=='1'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>{{x.propietario_screen_name}}: </strong>
                                  <span ng-bind-html="x.mensaje"></span>
                                </span>
                            </div>
                            <div style="padding-top:10px;" class="col-md-2">
                              <a style="background-color: #ff8484;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="eliminarMsgDm(x,1)">
                                <i style="color: white;" class="glyphicon glyphicon-trash"></i>
                              </a>
                              <a style="background-color: #8b8b8b;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="archivar(x, 1, $event)">
                                <i style="color: white;" class="fa fa-thumb-tack"></i>
                              </a>
                            </div>
			          	</div>
			      	</div><!--fin inbox repeat-->
                      
                    <div class="col-md-2">
                    </div>
		    	</div>
		    	<div style="margin-bottom: 0px;" class="row" ng-show="enviar1">
                  <a class="responderRegresarMensaje" ng-click="enviar1=false"><b>Regresar a mi mensajes</b></a>
                </div>
                
                <div class="col-md-2">
                </div> 
                
                <div class="col-md-8 responderResponder" ng-show="enviar1" style="padding:0;">
                   
                    
                  <div class="col-md-12 responderResponder2">
		    		<div class="row responderGlobitoRowConversacion">
		    			 <strong>Conversación con {{user1}} y {{user2}}</strong>  
		    		</div>
		    		<div id="scrollConversation" class="row responderGlobitoRow">
		    			<ul class="collection responderGlobitoUl">
		    				<li class="collection-item responderGlobitoLi" ng-repeat="(key,x) in chat1">
                              <!--Twitter-->
                              <div ng-if="x.red=='twitter'" class="col-xs-12 col-sm-12 col-md-12">
                                <img onerror="this.src='images/logo-bamboostr.png'" style="float: left;" class="round2" src="{{x.image_user}}" />
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='0'">@{{x.screen_name}} {{x.fecha}}</strong>
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='1'">@{{x.propietario_screen_name}} {{x.fecha}}</strong>
                              </div>
                              <div style="padding-bottom: 15px;" ng-if="x.red=='twitter'" class="col-xs-12 col-sm-12 col-md-12">
                                <p class="responderGlobitoPropietario" ng-if="x.propietario=='0'">{{x.mensaje}}</p>
                                <p class="responderGlobito" ng-if="x.propietario=='1'">{{x.mensaje}}</p>
                              </div>
                              <!--Facebook-->
                              <div ng-if="x.red=='facebook'" class="col-xs-12 col-sm-12 col-md-12">
                                <img onerror="this.src='images/logo-bamboostr.png'" style="float: left;" class="round2" src="images/redes_sociales/facebook.png" />
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='0'">{{x.screen_name}} {{x.fecha}}</strong>
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='1'">{{x.propietario_screen_name}} {{x.fecha}}</strong>
                              </div>
                              <div style="padding-bottom: 15px;" ng-if="x.red=='facebook'" class="col-xs-12 col-sm-12 col-md-12">
                                <p class="responderGlobitoPropietario" ng-if="x.propietario=='0'" ng-bind-html="x.mensaje"></p>
                                <p class="responderGlobito" ng-if="x.propietario=='1'" ng-bind-html="x.mensaje"></p>
                              </div>
                            </li>
	    				</ul>
		    		</div>
		    		<div ng-if="key=='0'" class="row responderGlobitoForm" ng-repeat="(key,x) in chat1">
		    			<form ng-submit="send(x,send2)">
			    			<div class="input-field col-md-12">
					         	<input type="text" placeholder="Escribir un Mensaje..." class="col-xs-12 col-sm-12 col-md-12 validate responderGlobitoInput" ng-model="send1" />
                                <button style="float: right; margin-top: 5px; margin-left: 5px;" class="col-md-2 btn btn-twitter" ng-click="send(x,send2)">Enviar</button>
					        </div>
			    		</form>
		    		</div>
                  </div>
		    	</div>
                
                <div class="col-md-2">
                </div>
                
		    </div><!--Fin tab1-->
            
            
            <div id="tab2" class="col-md-12">
                
                <div class="col-md-2">
                </div> 
                
	    		<div class="col-md-8" ng-hide="enviar1">
                    
                    <div style="margin-top: 15px;" class="row">
                      <div class="col-md-12">
                        <div class="input-group input-group-lg col-xs-12 col-md-4">
                          <input style="border: 1px solid #ccc; height: 37px; font-size: 13px;" type="text" class="form-control" placeholder="Buscar mensaje" aria-describedby="sizing-addon1" ng-model="buscadorTab2">
                          <span style="padding: 0px 8px 9px 8px; font-size: 12px; height: 30px; margin-top: 0px;" class="input-group-addon glyphicon glyphicon-search" id="sizing-addon1"></span>
                         </div>
                      </div>
                    </div><!--row-->
                    
                    <div ng-if="read.length=='0'" class="responderNoHayMsg">
                      <div class="alert alert-warning">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> No hay mensajes.
                      </div>
                    </div>
                    
		    		<div ng-repeat="x in read =(inbox | limitTo:100 | filter: { read:0, delete:0} | filter: buscadorTab2)"  class="responderBloque">
			    		<div ng-if="x.red=='twitter'" class="row">
                            <div ng-click="abrirMsg(x)" style="text-align: center; padding-top:10px;" class="col-md-1">
                              <img onerror="this.src='images/logo-bamboostr.png'" style="text-align: center; " class="round2" src="{{x.image_user}}" />
                            </div>
			            	<div ng-click="abrirMsg(x)" class="col-md-9" style="padding-top:10px;">
			            		<span class="" style="font-weight: bold;">
                                  <strong>{{x.name}} @{{x.screen_name}}</strong><strong style="padding-left: 10px;">{{x.fecha}}</strong>
                                </span><br />
                                <span ng-if="x.propietario=='0'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>@{{x.screen_name}}: {{x.mensaje}} </strong>
                                </span>
                                <span ng-if="x.propietario=='1'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>@{{x.propietario_screen_name}}: {{x.mensaje}} </strong>
                                </span>
			            	</div>
                            <div style="padding-top:10px;" class="col-md-2">
                              <a style="background-color: #ff8484;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="eliminarMsgDm(x,1)">
                                <i style="color: white;" class="glyphicon glyphicon-trash"></i>
                              </a>
                              <a style="background-color: #8b8b8b;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="archivar(x, 1, $event)">
                                <i style="color: white;" class="fa fa-thumb-tack"></i>
                              </a>
                            </div>
			          	</div>
                        
                        <div ng-if="x.red=='facebook'" class="row">
                            <div ng-click="abrirMsg(x)" style="text-align: center; padding-top:10px;" class="col-md-1">
                              <img onerror="this.src='images/logo-bamboostr.png'" style="text-align: center; " class="round2" src="images/redes_sociales/facebook.png" />
                            </div>
			            	<div ng-click="abrirMsg(x)" class="col-md-9" style="padding-top:10px;">
			            		<span class="" style="font-weight: bold;">
                                  <strong>{{x.name}} {{x.fecha}}</strong>
                                </span><br />
                                <span ng-if="x.propietario=='0'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>{{x.screen_name}}: {{x.mensaje}} </strong>
                                </span>
                                <span ng-if="x.propietario=='1'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>{{x.propietario_screen_name}}: </strong>
                                  <span ng-bind-html="x.mensaje"></span>
                                </span>
                            </div>
                            <div style="padding-top:10px;" class="col-md-2">
                              <a style="background-color: #ff8484;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="eliminarMsgDm(x,1)">
                                <i style="color: white;" class="glyphicon glyphicon-trash"></i>
                              </a>
                              <a style="background-color: #8b8b8b;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="archivar(x, 1, $event)">
                                <i style="color: white;" class="fa fa-thumb-tack"></i>
                              </a>
                            </div>
			          	</div>
                          
                        <div class="col-md-2">
                        </div>   
                          
			      	</div><!--fin read repeat-->
		    	</div>
		    	<div style="margin-bottom: 0px;" class="row" ng-show="enviar1">
                  <a class="responderRegresarMensaje" ng-click="enviar1=false"><b>Regresar a mi mensajes</b></a>
                </div>
                
                <div class="col-md-2">
                </div> 
                
                <div class="col-md-8 responderResponder" ng-show="enviar1" style="padding:0;">
                   
                    
                  <div class="col-md-12 responderResponder2">
		    		<div class="row responderGlobitoRowConversacion">
		    			 <strong>Conversación con {{user1}} y {{user2}}</strong>  
		    		</div>
		    		<div class="row responderGlobitoRow">
		    			<ul class="collection responderGlobitoUl">
		    				<li class="collection-item responderGlobitoLi" ng-repeat="(key,x) in chat1">
                              <!--Twitter-->
                              <div ng-if="x.red=='twitter'" class="col-xs-12 col-sm-12 col-md-12">
                                <img onerror="this.src='images/logo-bamboostr.png'" style="float: left;" class="round2" src="{{x.image_user}}" />
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='0'">@{{x.screen_name}} {{x.fecha}}</strong>
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='1'">@{{x.propietario_screen_name}} {{x.fecha}}</strong>
                              </div>
                              <div style="padding-bottom: 15px;" ng-if="x.red=='twitter'" class="col-xs-12 col-sm-12 col-md-12">
                                <p class="responderGlobitoPropietario" ng-if="x.propietario=='0'">{{x.mensaje}}</p>
                                <p class="responderGlobito" ng-if="x.propietario=='1'">{{x.mensaje}}</p>
                              </div>
                              <!--Facebook-->
                              <div ng-if="x.red=='facebook'" class="col-xs-12 col-sm-12 col-md-12">
                                <img onerror="this.src='images/logo-bamboostr.png'" style="float: left;" class="round2" src="images/redes_sociales/facebook.png" />
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='0'">{{x.screen_name}} {{x.fecha}}</strong>
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='1'">{{x.propietario_screen_name}} {{x.fecha}}</strong>
                              </div>
                              <div style="padding-bottom: 15px;" ng-if="x.red=='facebook'" class="col-xs-12 col-sm-12 col-md-12">
                                <p class="responderGlobitoPropietario" ng-if="x.propietario=='0'" ng-bind-html="x.mensaje"></p>
                                <p class="responderGlobito" ng-if="x.propietario=='1'" ng-bind-html="x.mensaje"></p>
                              </div>
                            </li>
	    				</ul>
		    		</div>
                    
                    <div ng-if="key=='0'" class="row responderGlobitoForm" ng-repeat="(key,x) in chat1">
		    			<form ng-submit="send(x,send3)">
			    			<div class="input-field col-md-12">
					         	<input type="text" placeholder="Escribir un Mensaje..." class="col-xs-12 col-sm-12 col-md-12 validate responderGlobitoInput" ng-model="send1" />
                                <button style="float: right; margin-top: 5px; margin-left: 5px;" class="col-md-2 btn btn-twitter" ng-click="send(x,send3)">Enviar</button>
					        </div>
			    		</form>
		    		</div>
                    
                  </div>
		    	</div>
                
                <div class="col-md-2">
                </div>
                
	    	</div><!--Fin tab2-->
            
            
	    	<div id="tab3" class="col-md-12">
                
                <div class="col-md-2">
                </div> 
                
	    		<div class="col-md-8" ng-hide="enviar1">
                    
                    <div style="margin-top: 15px;" class="row">
                      <div class="col-md-12">
                        <div class="input-group input-group-lg col-xs-12 col-md-4">
                          <input style="border: 1px solid #ccc; height: 37px; font-size: 13px;" type="text" class="form-control" placeholder="Buscar mensaje" aria-describedby="sizing-addon1" ng-model="buscadorTab3">
                          <span style="padding: 0px 8px 9px 8px; font-size: 12px; height: 30px; margin-top: 0px;" class="input-group-addon glyphicon glyphicon-search" id="sizing-addon1"></span>
                         </div>
                      </div>
                    </div><!--row-->
                    
                    <div ng-if="archivados.length=='0'" class="responderNoHayMsg">
                      <div class="alert alert-warning">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> No hay mensajes.
                      </div>
                    </div>
                    
		    		<div ng-repeat="x in archivados =(inbox | limitTo:100 | filter: { pin:1, delete:0} | filter: buscadorTab3)" class="responderBloque">
			    		<div ng-if="x.red=='twitter'" class="row">
                            <div ng-click="abrirMsg(x)" style="text-align: center; padding-top:10px;" class="col-md-1">
                              <img onerror="this.src='images/logo-bamboostr.png'" style="text-align: center; " class="round2" src="{{x.image_user}}" />
                            </div>
			            	<div ng-click="abrirMsg(x)" class="col-md-9" style="padding-top:10px;">
			            		<span class="" style="font-weight: bold;">
                                  <strong>{{x.name}} @{{x.screen_name}}</strong><strong style="padding-left: 10px;">{{x.fecha}}</strong>
                                </span><br />
                                <span ng-if="x.propietario=='0'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>@{{x.screen_name}}: {{x.mensaje}} </strong>
                                </span>
                                <span ng-if="x.propietario=='1'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>@{{x.propietario_screen_name}}: {{x.mensaje}} </strong>
                                </span>
			            	</div>
                            <div style="padding-top:10px;" class="col-md-2">
                              <a style="background-color: #ff8484;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="eliminarMsgDm(x,1)">
                                <i style="color: white;" class="glyphicon glyphicon-trash"></i>
                              </a>
                              <a style="background-color: #8b8b8b;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="archivar(x, 0, $event)">
                                <i style="color: white;" class="fa fa-thumb-tack"></i>
                              </a>
                            </div>
			          	</div>
                        
                        <div ng-if="x.red=='facebook'" class="row">
                            <div ng-click="abrirMsg(x)" style="text-align: center; padding-top:10px;" class="col-md-1">
                              <img onerror="this.src='images/logo-bamboostr.png'" style="text-align: center; " class="round2" src="images/redes_sociales/facebook.png" />
                            </div>
			            	<div ng-click="abrirMsg(x)" class="col-md-9" style="padding-top:10px;">
			            		<span class="" style="font-weight: bold;">
                                  <strong>{{x.name}} {{x.fecha}}</strong>
                                </span><br />
                                <span ng-if="x.propietario=='0'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>{{x.screen_name}}: {{x.mensaje}} </strong>
                                </span>
                                <span ng-if="x.propietario=='1'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>{{x.propietario_screen_name}}: </strong>
                                  <span ng-bind-html="x.mensaje"></span>
                                </span>
                            </div>
                            <div style="padding-top:10px;" class="col-md-2">
                              <a style="background-color: #ff8484;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="eliminarMsgDm(x,1)">
                                <i style="color: white;" class="glyphicon glyphicon-trash"></i>
                              </a>
                              <a style="background-color: #8b8b8b;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="archivar(x, 1, $event)">
                                <i style="color: white;" class="fa fa-thumb-tack"></i>
                              </a>
                            </div>
			          	</div>
                          
                        <div class="col-md-2">
                        </div>   
                          
			      	</div><!--fin archivados repeat-->
		    	</div>
		    	<div style="margin-bottom: 0px;" class="row" ng-show="enviar1">
                  <a class="responderRegresarMensaje" ng-click="enviar1=false"><b>Regresar a mi mensajes</b></a>
                </div>
                
                <div class="col-md-2">
                </div> 
                
                <div class="col-md-8 responderResponder" ng-show="enviar1" style="padding:0;">
                   
                    
                  <div class="col-md-12 responderResponder2">
		    		<div class="row responderGlobitoRowConversacion">
		    			 <strong>Conversación con {{user1}} y {{user2}}</strong>  
		    		</div>
		    		<div class="row responderGlobitoRow">
		    			<ul class="collection responderGlobitoUl">
		    				<li class="collection-item responderGlobitoLi" ng-repeat="(key,x) in chat1">
                              <!--Twitter-->
                              <div ng-if="x.red=='twitter'" class="col-xs-12 col-sm-12 col-md-12">
                                <img onerror="this.src='images/logo-bamboostr.png'" style="float: left;" class="round2" src="{{x.image_user}}" />
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='0'">@{{x.screen_name}} {{x.fecha}}</strong>
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='1'">@{{x.propietario_screen_name}} {{x.fecha}}</strong>
                              </div>
                              <div style="padding-bottom: 15px;" ng-if="x.red=='twitter'" class="col-xs-12 col-sm-12 col-md-12">
                                <p class="responderGlobitoPropietario" ng-if="x.propietario=='0'">{{x.mensaje}}</p>
                                <p class="responderGlobito" ng-if="x.propietario=='1'">{{x.mensaje}}</p>
                              </div>
                              <!--Facebook-->
                              <div ng-if="x.red=='facebook'" class="col-xs-12 col-sm-12 col-md-12">
                                <img onerror="this.src='images/logo-bamboostr.png'" style="float: left;" class="round2" src="images/redes_sociales/facebook.png" />
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='0'">{{x.screen_name}} {{x.fecha}}</strong>
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='1'">{{x.propietario_screen_name}} {{x.fecha}}</strong>
                              </div>
                              <div style="padding-bottom: 15px;" ng-if="x.red=='facebook'" class="col-xs-12 col-sm-12 col-md-12">
                                <p class="responderGlobitoPropietario" ng-if="x.propietario=='0'" ng-bind-html="x.mensaje"></p>
                                <p class="responderGlobito" ng-if="x.propietario=='1'" ng-bind-html="x.mensaje"></p>
                              </div>
                            </li>
	    				</ul>
		    		</div>
		    		<div ng-if="key=='0'" class="row responderGlobitoForm" ng-repeat="(key,x) in chat1">
		    			<form ng-submit="send(x,send4)">
			    			<div class="input-field col-md-12">
					         	<input type="text" placeholder="Escribir un Mensaje..." class="col-xs-12 col-sm-12 col-md-12 validate responderGlobitoInput" ng-model="send1" />
                                <button style="float: right; margin-top: 5px; margin-left: 5px;" class="col-md-2 btn btn-twitter" ng-click="send(x,send4)">Enviar</button>
					        </div>
			    		</form>
		    		</div>
                  </div>
		    	</div>
                
                <div class="col-md-2">
                </div>
                
	    	</div><!--fin tab3-->
            
            <div id="tab4" class="col-md-12">
                
                <div class="col-md-2">
                </div> 
                
		    	<div class="col-md-8" ng-hide="enviar1">
                  
                    <div style="margin-top: 15px;" class="row">
                      <div class="col-md-12">
                        <div class="input-group input-group-lg col-xs-12 col-md-4">
                          <input style="border: 1px solid #ccc; height: 37px; font-size: 13px;" type="text" class="form-control" placeholder="Buscar mensaje" aria-describedby="sizing-addon1" ng-model="buscadorTab4">
                          <span style="padding: 0px 8px 9px 8px; font-size: 12px; height: 30px; margin-top: 0px;" class="input-group-addon glyphicon glyphicon-search" id="sizing-addon1"></span>
                         </div>
                      </div>
                    </div><!--row-->
                    
                    <div ng-if="eliminados.length=='0'" class="responderNoHayMsg">
                      <div class="alert alert-warning">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> No hay mensajes.
                      </div>
                    </div>
                    
		    		<div id="{{x.id}}" ng-repeat="x in eliminados = (inbox | limitTo:100 | filter: {delete:1, deletePerm:0} | filter: buscadorTab4)" class="responderBloque">
			        	<div ng-if="x.red=='twitter'" class="row">
                            <div ng-click="abrirMsg(x)" style="text-align: center; padding-top:10px;" class="col-md-1">
                              <img onerror="this.src='images/logo-bamboostr.png'" style="text-align: center; " class="round2" src="{{x.image_user}}" />
                            </div>
			            	<div ng-click="abrirMsg(x)" class="col-md-9" style="padding-top:10px;">
			            		<span class="" style="font-weight: bold;">
                                  <strong>{{x.name}} @{{x.screen_name}}</strong><strong style="padding-left: 10px;">{{x.fecha}}</strong>
                                </span><br />
                                <span ng-if="x.propietario=='0'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>@{{x.screen_name}}: {{x.mensaje}} </strong>
                                </span>
                                <span ng-if="x.propietario=='1'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>@{{x.propietario_screen_name}}: {{x.mensaje}} </strong>
                                </span>
			            	</div>
                            <div style="padding-top:10px;" class="col-md-2">
                              <a style="background-color: #ff8484;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="eliminarMsgDm(x,2)">
                                <i style="color: white;" class="glyphicon glyphicon-trash"></i>
                              </a>
                              <a style="background-color: rgba(129, 219, 137, 0.99);" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Mensaje Recuperado" ng-click="eliminarMsgDm(x,0)">
                                <i style="color: white;" class="fa fa-plus"></i>
                              </a>
                            </div>
			          	</div>
                        
                        <div ng-if="x.red=='facebook'" class="row">
                            <div ng-click="abrirMsg(x)" style="text-align: center; padding-top:10px;" class="col-md-1">
                              <img onerror="this.src='images/logo-bamboostr.png'" style="text-align: center; " class="round2" src="images/redes_sociales/facebook.png" />
                            </div>
			            	<div ng-click="abrirMsg(x)" class="col-md-9" style="padding-top:10px;">
			            		<span class="" style="font-weight: bold;">
                                  <strong>{{x.name}} {{x.fecha}}</strong>
                                </span><br />
                                <span ng-if="x.propietario=='0'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>{{x.screen_name}}: {{x.mensaje}} </strong>
                                </span>
                                <span ng-if="x.propietario=='1'" class="hidden-xs" style="font-weight: bold;">
                                  <strong>{{x.propietario_screen_name}}: </strong>
                                  <span ng-bind-html="x.mensaje"></span>
                                </span>
                            </div>
                            <div style="padding-top:10px;" class="col-md-2">
                              <a style="background-color: #ff8484;" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Archivar mensaje" ng-click="eliminarMsgDm(x,2)">
                                <i style="color: white;" class="glyphicon glyphicon-trash"></i>
                              </a>
                              <a style="background-color: rgba(129, 219, 137, 0.99);" class="btn waves-teal waves-effect waves-light secondary-content tooltipped" data-position="top" data-tooltip="Mensaje Recuperado" ng-click="eliminarMsgDm(x,0)">
                                <i style="color: white;" class="fa fa-plus"></i>
                              </a>
                            </div>
			          	</div>
                          
                        <div class="col-md-2">
                        </div>  
                          
			      	</div><!--fin inbox repeat-->
		    	</div>
		    	<div style="margin-bottom: 0px;" class="row" ng-show="enviar1">
                  <a class="responderRegresarMensaje" ng-click="enviar1=false"><b>Regresar a mi mensajes</b></a>
                </div>
                
                <div class="col-md-2">
                </div> 
                
                <div class="col-md-8 responderResponder" ng-show="enviar1" style="padding:0;">
                   
                    
                  <div class="col-md-12 responderResponder2">
		    		<div class="row responderGlobitoRowConversacion">
		    			 <strong>Conversación con {{user1}} y {{user2}}</strong>  
		    		</div>
		    		<div class="row responderGlobitoRow">
		    			<ul class="collection responderGlobitoUl">
		    				<li class="collection-item responderGlobitoLi" ng-repeat="(key,x) in chat1">
                              <!--Twitter-->
                              <div ng-if="x.red=='twitter'" class="col-xs-12 col-sm-12 col-md-12">
                                <img onerror="this.src='images/logo-bamboostr.png'" style="float: left;" class="round2" src="{{x.image_user}}" />
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='0'">@{{x.screen_name}} {{x.fecha}}</strong>
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='1'">@{{x.propietario_screen_name}} {{x.fecha}}</strong>
                              </div>
                              <div style="padding-bottom: 15px;" ng-if="x.red=='twitter'" class="col-xs-12 col-sm-12 col-md-12">
                                <p class="responderGlobitoPropietario" ng-if="x.propietario=='0'">{{x.mensaje}}</p>
                                <p class="responderGlobito" ng-if="x.propietario=='1'">{{x.mensaje}}</p>
                              </div>
                              <!--Facebook-->
                              <div ng-if="x.red=='facebook'" class="col-xs-12 col-sm-12 col-md-12">
                                <img onerror="this.src='images/logo-bamboostr.png'" style="float: left;" class="round2" src="images/redes_sociales/facebook.png" />
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='0'">{{x.screen_name}} {{x.fecha}}</strong>
                                <strong class="responderGlobitoArribaTexto" ng-if="x.propietario=='1'">{{x.propietario_screen_name}} {{x.fecha}}</strong>
                              </div>
                              <div style="padding-bottom: 15px;" ng-if="x.red=='facebook'" class="col-xs-12 col-sm-12 col-md-12">
                                <p class="responderGlobitoPropietario" ng-if="x.propietario=='0'" ng-bind-html="x.mensaje"></p>
                                <p class="responderGlobito" ng-if="x.propietario=='1'" ng-bind-html="x.mensaje"></p>
                              </div>
                            </li>
	    				</ul>
		    		</div>
		    		<div ng-if="key=='0'" class="row responderGlobitoForm" ng-repeat="(key,x) in chat1">
		    			<form ng-submit="send(x,send1)">
			    			<div class="input-field col-md-12">
					         	<input type="text" placeholder="Escribir un Mensaje..." class="col-xs-12 col-sm-12 col-md-12 validate responderGlobitoInput" ng-model="send1" />
                                <button style="float: right; margin-top: 5px; margin-left: 5px;" class="col-md-2 btn btn-twitter" ng-click="send(x,send1)">Enviar</button>
					        </div>
			    		</form>
		    		</div>
                  </div>
		    	</div>
                
                <div class="col-md-2">
                </div>
                
		    </div><!--fin tab4-->
            
            <div class="col-md-2">
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