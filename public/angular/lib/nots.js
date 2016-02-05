app.controller('notsCtrl', function($rootScope, $scope, evt, $filter){
    $rootScope.inboxHeader = [];
    $rootScope.notificationsMessages = [];
	evt.getDMS().then(function (response) {
		   /*recibir respuesta de DMS*/
		   if(response.data){
			 console.log("getDMS");
			 console.log(response.data);
			 $rootScope.inboxHeader = response.data.data;
		   } else {
			 toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
		   }
		   
	}, function (response) {
		   /*ERROR*/
		   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
	});
	evt.getNotificationsMessages().then(function (response) {
		   /*recibir respuesta de Nots*/
		   if(response.data){
			 console.log("getNotificationsMessages");
			 console.log(response.data);
			 $rootScope.notificationsMessages = response.data.data;
    
		   } 		   
	 }, function (response) {
		   /*ERROR*/
		   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
	 });
     $scope.abrirNotMsg23D = function(x,option){
       console.log("Abrir Notificacion Nueva");
       console.log(x);
       console.log(option);
	   abrirNot(x,option);
	 };
     evt.payOption().then(function (response) {
       console.log("PayOption");
       console.log(response);
       if(response.data.success="true"){
         if(response.data.tipo=="ent" || response.data.tipo=="basic" || response.data.tipo=="pro"){
           $("#tableSys11").css("display","none");
         }   
       } else {
         $("#tableSys11").css("display","none"); 
       }
     }, function (response) {
       /*ERROR*/
       toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
     });
});