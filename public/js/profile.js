//FUNCIONES
function openDialog(){
  $(".ui-dialog-titlebar-close").hide();
  $('.ui-dialog-content').show();
  $("#cargando").dialog("open");
  $("#cargando").dialog('option', 'title', txt115+"...");
  var loadStats = '<div class="Knight-Rider-loader animate">';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '</div>';
  $("#cargando").html(txt201+""+loadStats);
}
function eliminarUser(userEliminar, name){
        openDialog();
	var parametros = { identifyEliminar:userEliminar, identify:identify, red:red};
	$.ajax({	data:  parametros,
				url:   "scripts/profile/eliminarUser.php",
				type:  "post",
				success:  function (response) {
					if(response.indexOf("true")!="-1"){
                                          toastr["info"](name + " " + txt147);
					  window.location = "profiles.php";
					} else {
					  toastr["error"](txt92);
					}
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				} , error: function(response){
				  toastr["error"](txt92);
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				}
			});
}
function getMail(){
openDialog();
	$.ajax({	data:  { identify:identify, red:red},
				url:   "scripts/profile/get-mail.php",
				type:  "post",
				success:  function (response) {
                                  obj = JSON.parse(response);
                                  if(obj.mail){
                                    $("#mail").val(obj.mail);
                                  }
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				} , error: function(response){
				  toastr["error"](txt92);;
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				}
			});
}
function guardarConfGeneral(){
openDialog();
  if($('#mail').val().indexOf("@")!=-1 && $('#mail').val().indexOf(".")!=-1){
	$.ajax({	data:  { identify:identify, red:red, mail:$('#mail').val(), notifications:document.getElementById("notifications").checked
                                 , feed_programados:document.getElementById("msgpro").checked, feed_drafts:document.getElementById("draftspro").checked, 
                                 feed_refresh:document.getElementById("autorefresh").checked},
				url:   "scripts/profile/post-confGeneral.php",
				type:  "post",
				success:  function (response) {
                                  obj = JSON.parse(response);
                                  if(obj.success){
                                    toastr["success"](txt481);
                                    window.location = "profiles.php";
                                  } else {
                                    toastr["error"](txt92);
                                  }
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				} , error: function(response){
				  toastr["error"](txt92);
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				}
			});
  } else {
    toastr["error"](txt480, "ERROR");
    $(".ui-dialog-titlebar-close").show();
    $("#cargando").dialog("close");
  }
}
function columnas(id, c, tituloCheck){
console.log(""+c+" "+tituloCheck+"");
openDialog();
	$.ajax({	data:  { identify:identify, red:red, id:id, id_token:id_token, tituloCheck:tituloCheck, bool:document.getElementById(''+tituloCheck+''+c+'').checked},
				url:   "scripts/profile/post-columnas.php",
				type:  "post",
				success:  function (response) {
                                  obj = JSON.parse(response);
                                   if(obj.success){
                                    toastr["success"](txt481);
                                  } else {
                                    toastr["error"](txt92);
                                  }                                 
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				} , error: function(response){
				  toastr["error"](txt92);
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				}
			});
}
function deleteFanPage(id, id_token, identifyFa){
	                      $.ajax({	data:  { id:id },
				url:   "scripts/profile/delete-fan-pages.php",
				 type:  "post",
				success:  function (response) {                         
                                  toastr["info"]("Fanpage eliminada");
		                  window.location = "profiles.php";
  		                  
				  } , error: function(response){
				  toastr["error"](txt92);
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				}
			});
}
function abrirFanPages(id, identifyFa){
  openDialog();
  if(id==""){
    id = id_token;
  }
  if(identifyFa==""){
    identifyFa = identify;
  }
	$.ajax({	data:  { id:id_token, identify:identifyFa },
				url:   "scripts/profile/get-fanPages.php",
				type:  "post",
				success:  function (response) {
                                  obj = JSON.parse(response);
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
                                  $("#fanPages").dialog("open"); 
                                  $("#fanPages").dialog('option', 'title', "Fan Page's");
                                  $("#fanPages").dialog('option', 'width', 700);
                                  $("#fanPages").dialog('option', 'height', 400);
                                  if(obj.errors){
                                    $("#fanPages").html('<div style="width: 100%; text-align: center;">'+txt483+'</div>');
                                  } else {

                                    var htmlFanPages = '';
                                    htmlFanPages += '<div style="display: table; width: 100%;">';
                                        htmlFanPages += '<div style="display: table-row;">';
                                          htmlFanPages += '<div style="color: #FFFFFF; background-color: #2e70b9; text-align: center; display: table-cell;">';
                                            htmlFanPages += 'Fan Pages';
                                          htmlFanPages += '</div>';
                                          htmlFanPages += '<div style="color: #FFFFFF; background-color: #2e70b9; text-align: center; display: table-cell;">';
                                            htmlFanPages += txt36;
                                          htmlFanPages += '</div>';    
                                          htmlFanPages += '<div style="color: #FFFFFF; background-color: #2e70b9; text-align: center; display: table-cell;">';
                                            htmlFanPages += txt59;
                                          htmlFanPages += '</div>';    
                                          htmlFanPages += '<div style="color: #FFFFFF; background-color: #2e70b9; text-align: center; display: table-cell;">';
                                            htmlFanPages += txt60;
                                          htmlFanPages += '</div>';      
                                        htmlFanPages += '<div style="color: #FFFFFF; background-color: #2e70b9; text-align: center; display: table-cell;">';
                                            htmlFanPages += '';
                                          htmlFanPages += '</div>';                             
                                        htmlFanPages += '</div>';

                                      for(var ffna2=0; ffna2<obj.length; ffna2++){
                                        htmlFanPages += '<div class="colorEven" style="display: table-row;">';
                                          htmlFanPages += '<div style="text-align: center; display: table-cell;">';
                                            htmlFanPages += '<a target="_blank" href="http://facebook.com/'+obj[ffna2].identify+'">';
                                              htmlFanPages += '<img style="width: 3em;" src="images/fan-page.png" />';
                                            htmlFanPages += '</a>';
                                          htmlFanPages += '</div>';
                                          htmlFanPages += '<div style="text-align: left; display: table-cell;">';
                                            htmlFanPages += '<a target="_blank" href="http://facebook.com/'+obj[ffna2].identify+'">';
                                              htmlFanPages += obj[ffna2].name;
                                            htmlFanPages += '</a>';
                                          htmlFanPages += '</div>';    
                                          htmlFanPages += '<div style="text-align: center; display: table-cell;">';
                                          var checkMuro = (obj[ffna2].feed_perfil==1)?"checked":"";
                                            htmlFanPages += '<input onclick="columnas('+comilla+''+obj[ffna2].id+''+comilla+', '+comilla+''+ffna2+''+comilla+', '+comilla+'fanPageMuroCheck'+comilla+');" type="checkbox" name="fanPageMuroCheck'+ffna2+'" value="fanPageMuroCheck'+ffna2+'" id="fanPageMuroCheck'+ffna2+'" '+checkMuro+'>';
                                          htmlFanPages += '</div>';    
                                          htmlFanPages += '<div style="text-align: center; display: table-cell;">';
                                          var checkMuro2 = (obj[ffna2].feed_dms==1)?"checked":"";
                                            htmlFanPages += '<input onclick="columnas('+comilla+''+obj[ffna2].id+''+comilla+', '+comilla+''+ffna2+''+comilla+', '+comilla+'fanPageDmsCheck'+comilla+');" type="checkbox" name="fanPageDmsCheck'+ffna2+'" value="fanPageDmsCheck'+ffna2+'" id="fanPageDmsCheck'+ffna2+'" '+checkMuro2+'>';
                                          htmlFanPages += '</div>';  
                                          htmlFanPages += '<div style="text-align: center; display: table-cell;">';
                                            htmlFanPages += '<button onclick="deleteFanPage('+comilla+''+obj[ffna2].id+''+comilla+','+comilla+''+id+''+comilla+','+comilla+''+identifyFa+''+comilla+')" class="btn btn-danger" type="button">'+txt58+'</button>';
                                          htmlFanPages += '</div>';                                
                                        htmlFanPages += '</div>';
                                      }
                                    htmlFanPages += '</div>';

                                    $("#fanPages").html(htmlFanPages);
                                    $(".colorEven:even").css("background-color","#EEEEEE");
                                    $(".colorEven").hover(function(){
                                      $(this).css("background-color", "#c5cde0");
                                    }, function(){
                                      $(".colorEven:odd").css("background-color","#FFFFFF");
                                      $(".colorEven:even").css("background-color","#EEEEEE");
                                    });
                                  }
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				} , error: function(response){
				  toastr["error"](txt92);
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				}
			});
}