var agregarADeckArrayFa = [];
var id_msgF = '';
var optionF = '';
var feedF = '';
var userF = '';
var idF = '';
var userPage2 = '';
function eliminarMsgPost(msg_id,optionF2,feedF2,userF2,idF2,userPage){
    $.ajax({		url:   "facebook/post-delete.php?identify="+idF2+"&id_msg="+msg_id,
						type:  "post",
						success:  function (response) {
						    toastr["success"](txt130);
                                                    imgRefreshFacebook(optionF2,feedF2,userF2,idF2,userPage);
						},
						error: function (response){
						  toastr["error"](txt92);
						}
      });
}
function mandarLike(){
  if(agregarADeckArrayFa.length==0){
    toastr["warning"](txt148);
  } else {
    $("#cargando").dialog("open");
    $(".ui-dialog-titlebar-close").hide();
    $("#cargando").dialog('option', 'title', txt115+"...");
    var mensaje23ew = 0;
    for(var wersq2349=0; wersq2349<agregarADeckArrayFa.length; wersq2349++){
      $('#'+agregarADeckArrayFa[wersq2349]['img']+'').css("opacity","1");
      $('#li'+agregarADeckArrayFa[wersq2349]['c']+'').css("background","url('images/palomita.png') no-repeat center center / 0px 0px transparent");
      $.ajax({		url:   "facebook/post-like.php?identify="+agregarADeckArrayFa[wersq2349]['id']+"&id_msg="+id_msgF,
						type:  "post",
						success:  function (response) {
                                                  if(response.indexOf("Permissions error")!="-1"){
                                                    toastr["error"]("Error en permisos");
                                                  }
                                                  mensaje23ew++;
                                                  if(mensaje23ew==agregarADeckArrayFa.length){
						    toastr["success"](txt155);
                                                    $("#cargando").dialog("close");
                                                    $(".ui-dialog-titlebar-close").show();
                                                    agregarADeckArrayFa = [];
                                                    imgRefreshFacebook(optionF,feedF,userF,idF,userPage2);
                                                  }
						},
						error: function (response){
						  toastr["error"](txt92);
                                                  $("#cargando").dialog("close");
                                                  $(".ui-dialog-titlebar-close").show();
                                                  agregarADeckArrayFa = [];
						}
      });
    } // fin for
  } // fin if
}
function quitarLike(identifyF,id_msgF,option,feed,user,idUser,userPage){
    $("#cargando").dialog("open");
    $(".ui-dialog-titlebar-close").hide();
    $("#cargando").dialog('option', 'title', txt115+"...");
    $.ajax({		url:   "facebook/post-unlike.php?identify="+identifyF+"&id_msg="+id_msgF,
						type:  "post",
						success:  function (response) {
						    toastr["success"](txt156);
                                                    $("#cargando").dialog("close");
                                                    $(".ui-dialog-titlebar-close").show();
                                                    imgRefreshFacebook(option,feed,user,idUser,userPage);
						},
						error: function (response){
						  toastr["error"](txt92);
                                                  $("#cargando").dialog("close");
                                                  $(".ui-dialog-titlebar-close").show();
						}
      });
}
function agregarADeckFa(id, img, userName, c){
  var band=-1;
  if(agregarADeckArrayFa.length!=0){
    for(var efweqd=0; efweqd<agregarADeckArrayFa.length; efweqd++){
      if(agregarADeckArrayFa[efweqd]['id']==id){
        agregarADeckArrayFa.splice(efweqd, 1);
        efweqd=agregarADeckArrayFa.length;
        band=1;
        $('#'+img+'').css("opacity","1");
        $('#li'+c+'').css("background","url('images/palomita.png') no-repeat center center / 0px 0px transparent");
      }
    }
  }
  if(band==-1){
    $('#'+img+'').css("opacity","0.5");
    $('#li'+c+'').css("background","url('images/palomita.png') no-repeat center center / 50px 50px transparent");
    agregarADeckArrayFa[agregarADeckArrayFa.length] = [];
    agregarADeckArrayFa[agregarADeckArrayFa.length-1]['id'] = id;  
    agregarADeckArrayFa[agregarADeckArrayFa.length-1]['user'] = userName; 
    agregarADeckArrayFa[agregarADeckArrayFa.length-1]['img'] = img; 
    agregarADeckArrayFa[agregarADeckArrayFa.length-1]['c'] = c; 
  }
}
function abrirDeckFa(id_msg,option,feed,user,idUser,userPage){
  id_msgF = id_msg;
  optionF = option;
  feedF = feed;
  userF = user;
  idF = idUser;
  userPage2 = userPage;
  $("#likes").dialog('option', 'title', txt157);
  $("#likes").dialog('option', 'width', 500);
  $("#likes").dialog('option', 'height', 300);
  $("#likes").dialog("open");
  //$(".ui-dialog-titlebar-close").hide();
}