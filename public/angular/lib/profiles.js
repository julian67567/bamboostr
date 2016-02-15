app.controller('profilesCtrl', function($scope, evt, $rootScope){
  $rootScope.title = "Perfiles";
  setTimeout(function(){
    $('body').addClass('loaded');
  }, 1000);
  
  evt.getDetails().then(function (response) {
		console.log("GetDetails");
		console.log(response.data);
        $scope.details = response.data;
	}, function (response) {
	   /*ERROR*/
	   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
    });/*fin getcuentas*/
  
  evt.getCuentas().then(function (response) {
		console.log("GetCuentas");
		console.log(response.data);
        $scope.cuentas = response.data;
	}, function (response) {
	   /*ERROR*/
	   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
    });/*fin getcuentas*/

  $scope.cambiarImagen = function(){
        $('body').attr("class","loading");
        ga('send', 'event', 'Subir Imágen Profile', 'click', 'Subir Imágen Profile');
        var rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
        if (document.getElementById("fileImage").files.length === 0) { return; }
        var oFile = document.getElementById("fileImage").files[0];
        if (!rFilter.test(oFile.type))
        {   $('body').addClass('loaded');
            toastr["error"](txt125, "ERROR");
            return; 
        }
        var fd = new FormData();
        fd.append("fileImage", oFile);
        console.log(fd);
        $.ajax({  url:   'subirImagenes.php',
                    type:  'POST',
                    data:   fd,
                    processData: false,
                    contentType: false,
                    success:  function (response2) {
                        
                        if(response2.indexOf("ERROR")=="-1"){

                            evt.actualizarDetails(null, null, null, null, null, response2, 3).then(function (response) {
          
		                      if(response.data.success == "true"){ 
                                 $('body').addClass('loaded');
                                 $('#foto_perfil').css("background", "url('"+response2+"') no-repeat scroll center center / 100% 100%");
                                 window.location = "profiles.php";
                              } else {
                                 $('body').addClass('loaded');
                                 toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
                              }
	                      }, function (response) {
                            
	                        /*ERROR*/
                                $('body').addClass('loaded');
	                        toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
                            });/*fin getcuentas*/

                        } else {
                          $('body').addClass('loaded');
                          toastr["error"](txt126, "ERROR");
                        }
 
                        
                    }
        });
  };

  $scope.confCuenta = function(x){
        toastr["info"]("PRÓXIMAMENTE");
  };

  $scope.olvidastePass = function(x){
        toastr["info"]("PRÓXIMAMENTE");
  };

  $scope.guardarCambios52 = function(){
    if(!$("#username52").val()){
      toastr["error"]("Escribe tu username", "ERROR");
    } else if(!$("#nombre52").val()){
      toastr["error"]("Escribe tu nombre", "ERROR");
    } else if((!$("#mail52").val() ||
                   $("#mail52").val().indexOf(".")=="-1" || 
                   $("#mail52").val().indexOf("@")=="-1")){
          toastr["error"]("Escribe tu mail correctamente", "ERROR");
    } else if(!$("#password52").val() && !$("#passwordConf52").val()){
      //actualizar sin password
      console.log("actualizar sin password");
      evt.actualizarDetails($("#username52").val(), $("#nombre52").val(), $("#mail52").val(), $("#categoria52").val(), $("#password52").val(), 1).then(function (response) {
		if(response.data.success=="true"){
          toastr["success"]("Datos Guardados");
          $scope.details = response.data;
        } else {
          toastr["info"](response.data.texto);    
        }
	  }, function (response) {
	   /*ERROR*/
	   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
      });/*fin getcuentas*/
    } else if($("#password52").val() && !$("#passwordConf52").val()){
      toastr["error"]("Las contraseñas no coinciden", "ERROR");
    } else if(!$("#password52").val() && $("#passwordConf52").val()){
      toastr["error"]("Las contraseñas no coinciden", "ERROR");
    } else if($("#password52").val() && $("#passwordConf52").val() && ($("#password52").val()!=$("#passwordConf52").val())){
      toastr["error"]("Las contraseñas no coinciden", "ERROR");
    } else if($("#password52").val() && $("#passwordConf52").val() && ($("#password52").val()==$("#passwordConf52").val())){
      //actualizar con password 
      console.log("actualizar con password");
      evt.actualizarDetails($("#username52").val(), $("#nombre52").val(), $("#mail52").val(), $("#categoria52").val(), $("#password52").val(), 2).then(function (response) {
		if(response.data.success=="true"){
          toastr["success"]("Datos Guardados");
          $scope.details = response.data;
        } else {
          toastr["info"](response.data.texto);  
        }
	  }, function (response) {
	   /*ERROR*/
	   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
      });/*fin getcuentas*/
    } else {
      toastr["error"]("Contacte a su administrador", "ERROR");
    }
  };

  $scope.deleteCuenta = function(x){
        var confirmar = confirm("¿Estás seguro de que quieres eliminarla?"); 
        if (confirmar){
          if(x[9] == "cuenta"){
            var id_cuenta = "";
            if(x[1] == "twitter"){
              id_cuenta = 'tw' + x[7];
            }
            else if(x[1] == "facebook"){
              id_cuenta = 'fa' + x[7];
            }
            else if(x[1] == "instagram"){
              id_cuenta = 'in' + x[7];
            }
            eliminarUser(id_cuenta,x[2]);
          }
          else if(x[9] == "page"){
            deleteFanPage(x[0], 0, 0);
          }
       }
  };

});/*fin controller*/