app.controller('responderCtrl', function($rootScope, $scope, evt, $filter, $timeout){
    $rootScope.title = "Responde";
    $scope.loading = true;
    $scope.enviar1=false;
	$scope.inbox = [];
    $scope.cuentas = [];
    setTimeout(function(){
      $('body').addClass('loaded');
    }, 5000);
    $scope.eliminarMsgDm = function(x, option){
        console.log("EliminarMsgDM");
        //console.log(x);
        //console.log(x.id);
        evt.eliminardms(x, option).then(function (response) {
          console.log("Response Eliminar DMS");
          console.log(response.data);
          if(response.data.success=="true"){
            $("#"+response.data.id+"").css("display","none");
            evt.getDMS().then(function (response) {
                /*recibir respuesta de DMS*/
                if(response.data){
                    console.log("getDMS");
                    console.log(response.data);
                    $scope.inbox = response.data.data;
                    $rootScope.inboxHeader = response.data.data;
                } else {
                    toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
                }
                
            }, function (response) {
                /*ERROR*/
                toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
            });
          } else {
            toastr["error"]("No se pudo eliminar el mensaje", "ERROR");
          }
        }, function (response) {
			   //ERROR
           toastr["error"]("No se pudo eliminar el mensaje", "ERROR");
		});
    };
	/*recibir respuesta de DMS*/
	evt.getDMS().then(function (response) {
			   //recibir respuesta de DMS
			   if(response.data){
				 console.log("GetDMS");
				 console.log(response.data);
				 $scope.inbox = response.data.data;
				 $rootScope.inboxHeader = response.data.data;
			   } else {
				 toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
			   }
    }, function (response) {
	   //ERROR
	   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
    });
	evt.getCuentas().then(function (response) {
		console.log("GetCuentas");
		console.log(response.data);
        $scope.cuentas = response.data;
		for(var wer32=0; wer32<$scope.cuentas.length; wer32++){
		  //console.log($scope.cuentas[wer32][1]);
		  if($scope.cuentas[wer32][1]=="twitter"){
			evt.setDMSTwitter($scope.cuentas[wer32][7]).then(function (response) {
			   //recibir respuesta de DMS
		    }, function (response) {
			   //ERROR
		    });
		  } else if($scope.cuentas[wer32][1]=="facebook"){
			evt.setDMSFacebook($scope.cuentas[wer32][7]).then(function (response) {   
		    }, function (response) {
			   //ERROR
		    });
		  }
		}
	}, function (response) {
	   /*ERROR*/
	   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
    });
	$timeout(function () {
		/*recibir respuesta de DMS*/
		evt.getDMS().then(function (response) {
				   //recibir respuesta de DMS
				   if(response.data){
					 console.log("GetDMS");
					 console.log(response.data);
					 $scope.inbox = response.data.data;
				     $rootScope.inboxHeader = response.data.data;
				   } else {
					 toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
				   }
		}, function (response) {
		   //ERROR
		   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
		});
    }, 2000);
	$scope.user1 = 'Selecciona un chat para continuar...';
	$scope.userLog ='Angel';
	$scope.last =function(data){
		try{
			var last;
			$.each(data,function(key, value){
				last=value.user+': '+value.message;
			});return last;
		}catch(e){
			return 'Inicia una conversación!!';
		}
	};
	$scope.send = function(x, text){
        $('body').attr("class","loading");
		if(text){
	      //mandar mensaje a red social ajax BD
          console.log("Enviar");
          console.log(x);
          //var text2 = JSON.stringify(text);
          console.log(text);
          console.log(x.id_msg);
          if(x.red=="twitter"){
            evt.sendDmsTwitter(x, text).then(function (response) {
              console.log("response SendDms Twitter");
              console.log(response.data);
              if(response.data.id_str){
                evt.getCuentas().then(function (response) {
                  console.log("GetCuentas");
                  console.log(response.data);
                  $scope.cuentas = response.data;
                  for(var wer32=0; wer32<$scope.cuentas.length; wer32++){
                    //console.log($scope.cuentas[wer32][1]);
                    console.log(x.red + " " + x.propietario2_screen_name + " " + $scope.cuentas[wer32][2]);
                    if($scope.cuentas[wer32][1]=="twitter" && x.red=="twitter" && x.propietario2_screen_name==$scope.cuentas[wer32][2]){
                        evt.setDMSTwitter($scope.cuentas[wer32][7]).then(function (response) {
                            //recibir respuesta de DMS
                            evt.getConversation(x).then(function (response) {
                                /*recibir respuesta de DMS*/
                                if(response.data){
                                    $scope.chat1 = response.data.data;
                                    console.log("getConversation");
                                    console.log($scope.chat1);
                                    console.log("imprime x");
                                    console.log(x);
                                    $scope.read123(x);
                                    console.log($("#scrollConversation").height());
                                    $timeout(function () {
                                      $("#scrollConversation").scrollTop($("#scrollConversation").height()+999999);
                                    }, 3000);
                                    $('body').addClass('loaded');
                                } else {
                                    toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
                                    $('body').addClass('loaded');
                                }
                                
                            }, function (response) {
                                /*ERROR*/
                                toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
                                $('body').addClass('loaded');
                            });
                        }, function (response) {
                        //ERROR
                          $('body').addClass('loaded');
                        });
                    }/*fin if twitter && facebook*/
                  }/*fin for*/
                }, function (response) {
                  /*ERROR*/
                  toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
                  $('body').addClass('loaded');
                });
              } else {
                toastr["info"](response.data);
                $('body').addClass('loaded');
              }
            }, function (response) {
              /*ERROR*/
              toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
              $('body').addClass('loaded');
            });
          } else {
            evt.sendDmsFacebook(x, text).then(function (response) {
              console.log("response SendDms Facebook");
              console.log(response.data);
              if(response.data && response.data.success=="true"){
                evt.getCuentas().then(function (response) {
                  console.log("GetCuentas");
                  console.log(response.data);
                  $scope.cuentas = response.data;
                  for(var wer32=0; wer32<$scope.cuentas.length; wer32++){
                    //console.log($scope.cuentas[wer32][1]);
                    console.log(x.red + " " + x.identify_recipient + " " + $scope.cuentas[wer32][7] + " " + $scope.cuentas[wer32][1]);
                    if($scope.cuentas[wer32][1]=="facebook" && x.red=="facebook" && x.identify_recipient==$scope.cuentas[wer32][7]){
                        evt.setDMSFacebook2($scope.cuentas[wer32][7],x).then(function (response) {
                            //recibir respuesta de DMS
                            evt.getConversation(x).then(function (response) {
                                /*recibir respuesta de DMS*/
                                if(response.data){
                                    $scope.chat1 = response.data.data;
                                    console.log("getConversation");
                                    console.log($scope.chat1);
                                    console.log("imprime x");
                                    console.log(x);
                                    $scope.read123(x);
                                    console.log($("#scrollConversation").height());
                                    $timeout(function () {
                                      $("#scrollConversation").scrollTop($("#scrollConversation").height()+999999);
                                    }, 3000);
                                    $('body').addClass('loaded');
                                } else {
                                    toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
                                    $('body').addClass('loaded');
                                }
                                
                            }, function (response) {
                                /*ERROR*/
                                toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
                                $('body').addClass('loaded');
                            });
                        }, function (response) {
                        //ERROR
                          $('body').addClass('loaded');
                        });
                    }/*fin if twitter && facebook*/
                  }/*fin for*/
                }, function (response) {
                  /*ERROR*/
                  toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
                  $('body').addClass('loaded');
                });
              } else {
                toastr["info"](response.data);
                $('body').addClass('loaded');
              }
            }, function (response) {
              /*ERROR*/
              toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
              $('body').addClass('loaded');
            });
          }/* fin if twitter && facebook */
		} else {
          toastr["warning"]("No has escrito nada");
          $('body').addClass('loaded');
        }
	};
	$scope.size = function(data){
		return evt.size(data);
	};
	$scope.clear = function(){
		$scope.enviar1=false;
		$scope.send1=null;
		$scope.user1 = 'Selecciona un chat para continuar...';
		$scope.chat1={};
	};
	$scope.read123 = function(x){
	   evt.setReadDMS(x).then(function (response) {
		   evt.getDMS().then(function (response) {
				   /*recibir respuesta de DMS*/
				   if(response.data){
					 console.log("getDMS");
					 console.log(response.data);
					 $scope.inbox = response.data.data;
				     $rootScope.inboxHeader = response.data.data;
				   } else {
					 toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
				   }
				   
			   }, function (response) {
				   /*ERROR*/
				   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
			   });
	   }, function (response) {
		   /*ERROR*/
		   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
	   });
	};
	$scope.abrirMsg = function(x){
		//no hay evento
		$scope.chat1 = [];
		$scope.user1 = x.name;
		$scope.user2 = x.propietario2_screen_name;
		$scope.enviar1=true;
        $('body').attr("class","loading");
		evt.getConversation(x).then(function (response) {
			   /*recibir respuesta de DMS*/
			   if(response.data){
				 $scope.chat1 = response.data.data;
				 console.log("getConversation");
				 console.log($scope.chat1);
				 console.log("imprime x");
				 console.log(x);
				 $scope.read123(x);
                 $('body').addClass('loaded');
                 $timeout(function () {
                    $("#scrollConversation").scrollTop($("#scrollConversation").height()+500);
                 }, 1000);
				
			   } else {
				 toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
			   }
			   
		   }, function (response) {
			   /*ERROR*/
			   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
		   });
		//var i = evt.getUser($scope.inbox,chat.user);
		//$scope.inbox[i].estatus=1;
	};
	$scope.archivar = function(x, est, event) {
		//est: esticker puede archivar a desarchivar
		if(event){
			//archivar a ajax BD
			if(est==1) {
				evt.setPinDMS(x, est).then(function (response) {
				   /*recibir respuesta de DMS*/
				   if(response.success="true"){
					 Materialize.toast('Conversación con '+x.name+' archivada con éxito!', 1000)
					 evt.getDMS().then(function (response) {
						   /*recibir respuesta de DMS*/
						   if(response.data){
							 console.log("getDMS");
							 console.log(response.data);
							 $scope.inbox = response.data.data;
				             $rootScope.inboxHeader = response.data.data;
						   } else {
							 toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
						   }
						   
					   }, function (response) {
						   /*ERROR*/
						   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
					   });
				   } else {
					 toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
				   }
				   
			    }, function (response) {
				   /*ERROR*/
				   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
			    });
				
			} else {
			    $scope.clear();
				evt.setPinDMS(x, est).then(function (response) {
				   /*recibir respuesta de DMS*/
				   if(response.success="true"){
					 Materialize.toast('Conversación con '+x.name+' desarchivada con éxito!', 1000)
					 evt.getDMS().then(function (response) {
						   /*recibir respuesta de DMS*/
						   if(response.data){
							 console.log("getDMS");
							 console.log(response.data);
							 $scope.inbox = response.data.data;
				             $rootScope.inboxHeader = response.data.data;
						   } else {
							 toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
						   }
						   
					   }, function (response) {
						   /*ERROR*/
						   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
					   });
				   } else {
					 toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
				   }
				   
			    }, function (response) {
				   /*ERROR*/
				   toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
			    });
				
			}
			event.stopPropagation();
			event.preventDefault();
		}
	};
});