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
     evt.getNotificationsMessages2().then(function (response) {
		   /*recibir respuesta de Nots*/
		   if(response.data){
			 console.log("getNotificationsMessages2");
			 console.log(response.data);
			 $rootScope.notificationsMessages3 = response.data.data;
    
		   } 		   
	 }, function (response) {
		   /*ERROR*/
		   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
	 });
     $scope.abrirNotMsg23D = function(x,option){
       if(option==1){
         ga('send', 'event', 'Abrir News Messages', 'click', 'Abrir News Messages');
       }
       if(option==2){
         ga('send', 'event', 'Abrir Nots Messages', 'click', 'Abrir Nots Messages');
       }
       if(option==3){
         ga('send', 'event', 'Abrir Nots AI Messages', 'click', 'Abrir Nots AI Messages');
       }
       console.log("Abrir Notificacion Nueva");
       console.log(x);
       console.log(option);
	   abrirNot(x,option);
	 };
     $scope.rastrearHeaders = function(option){
       if(option=="ai"){
         if($("#"+option+"Button").attr('class')=="dropdown"){
           console.log("Abrir Header Menu Nots AI");
           ga('send', 'event', 'Abrir Header Menu Nots AI', 'click', 'Abrir Header Menu Nots AI');  
         }
       }
       if(option=="nots"){
         if($("#"+option+"Button").attr('class')=="dropdown"){
           console.log("Abrir Header Menu Nots");
           ga('send', 'event', 'Abrir Header Menu Nots', 'click', 'Abrir Header Menu Nots');  
         }
       }
       if(option=="profile"){
         if($("#"+option+"Button").attr('class')=="dropdown"){
           console.log("Abrir Header Menu Profile");
           ga('send', 'event', 'Abrir Header Menu Profile', 'click', 'Abrir Header Menu Profile');  
         }
       }
       if(option=="home"){
         console.log("Abrir Header Menu Home");
         ga('send', 'event', 'Abrir Header Menu Home', 'click', 'Abrir Header Menu Home');  
       }
       if(option=="escribir"){
         console.log("Abrir Header Menu Escribir");
         ga('send', 'event', 'Abrir Header Menu Escribir', 'click', 'Abrir Header Menu Escribir');  
       }
       if(option=="logo"){
         console.log("Abrir Header Menu Logo");
         ga('send', 'event', 'Abrir Header Menu Logo', 'click', 'Abrir Header Menu Logo');  
       }
       if(option=="ayuda"){
         console.log("Abrir Header Menu Ayuda");
         ga('send', 'event', 'Abrir Header Menu Ayuda', 'click', 'Abrir Header Menu Ayuda');  
       }
       if(option=="profileProfile"){
         console.log("Abrir Header Menu Profile Profile");
         ga('send', 'event', 'Abrir Header Menu Profile Profile', 'click', 'Abrir Header Menu Profile Profile');  
       }
       if(option=="profileAgregarRed"){
         console.log("Abrir Header Menu Profile AgregarRed");
         ga('send', 'event', 'Abrir Header Menu Profile AgregarRed', 'click', 'Abrir Header Menu Profile AgregarRed');  
       }
       if(option=="profileNews"){
         console.log("Abrir Header Menu Profile News");
         ga('send', 'event', 'Abrir Header Menu Profile News', 'click', 'Abrir Header Menu Profile News');  
       }
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