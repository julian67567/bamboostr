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
function generalAdmin(){
  openDialog();
  $.ajax({      url:   "scripts/admin/get-usuariosAdmin.php",
		type:  'GET',
		success:  function (response) {
                  obj = JSON.parse(response);
                  if(obj.error){
                    toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
                  } else {
                    var htmlAdmin = '';
                    var totalP = 0;
                    var usandoP = 0;
                    var usandoDM = 0;
                    var expire = 0;
                    var esp = 0;
                    var twitter123 = 0;
                    var facebook123 = 0;
                    var free = 0;
                    var pro = 0;
                    var enterprise = 0;
                    var unicoSAdmin = 0;
                    var unicoS = '';
                    var c34 =0;
                    for(var wer23z=0; wer23z<obj.length; wer23z++){
                      if(obj[wer23z].ssid!="" && obj[wer23z].ssid!="NULL" && obj[wer23z].ssid!=null && obj[wer23z].identify!="0"){
                        usandoP++;
                      }
                      if(obj[wer23z].identify!="0"){
                        totalP++;
                      }
                      if(obj[wer23z].automatize=="1" && obj[wer23z].identify!="0"){
                        usandoDM++;
                      }
                      if(obj[wer23z].idioma=="es" && obj[wer23z].identify!="0"){
                        esp++;
                      }
                      if(obj[wer23z].expire_token=="1" && obj[wer23z].identify!="0"){
                        expire++;
                      }
                      if(obj[wer23z].red=="facebook" && obj[wer23z].identify!="0"){
                        facebook123++;
                      }
                      if(obj[wer23z].red=="twitter" && obj[wer23z].identify!="0"){
                        twitter123++;
                      }
                      if((obj[wer23z].tipo=="" || obj[wer23z].tipo=="0" || obj[wer23z].tipo=="NULL" || obj[wer23z].tipo=="null") && obj[wer23z].identify!="0"){
                        free++;
                      }
                      if((obj[wer23z].tipo=="pro" || obj[wer23z].tipo=="PRO") && obj[wer23z].identify!="0"){
                        pro++;
                      }
                      if((obj[wer23z].tipo=="ent" || obj[wer23z].tipo=="ENT") && obj[wer23z].identify!="0"){
                        enterprise++;
                      }
                      if(obj[wer23z].ssid!="" && obj[wer23z].ssid!="NULL" && obj[wer23z].ssid!=null && obj[wer23z].identify!="0"){
                        var entro = 1;
                        for(var varnbvc=0; varnbvc<obj.length; varnbvc++){
                          if(obj[varnbvc].ssid!="" && obj[varnbvc].ssid!="NULL" && obj[varnbvc].ssid!="null" && obj[varnbvc].identify!="0"){
                            if(obj[varnbvc].social_networks.indexOf(obj[wer23z].red.substr(0,2)+''+obj[wer23z].identify)!="-1"){
                              if(unicoS.indexOf(obj[wer23z].red.substr(0,2)+''+obj[wer23z].identify)=="-1" && entro==1){
                                unicoSAdmin++;
                                unicoS=unicoS+''+obj[varnbvc].social_networks+''+obj[wer23z].social_networks+'';
                                //console.log(c34 + " " + obj[wer23z].screen_name);
                                c34++;
                                entro=-1;
                              }
                              unicoS=unicoS+''+obj[varnbvc].social_networks+'';
                              entro=-1;
                            }
                          }
                        }//fin for
                        if(entro==1){
                          unicoS=unicoS+''+obj[wer23z].red.substr(0,2)+''+obj[wer23z].identify+',';
                        }
                      }
                    }//fin for
                    htmlAdmin += '<div style="width: 100%; display: table;">';
                      htmlAdmin += '<div style="width: 100%; display: table-row;">';
                        htmlAdmin += '<div style="width: 50%; display: table-cell;">';
                          htmlAdmin += '<div style="height: 300px; overflow-y: auto;">';
                            htmlAdmin += ''+txt338+': '+totalP+'<br />';
                            htmlAdmin += ''+txt339+': '+usandoP+'<br />';
                            htmlAdmin += ''+txt348+': '+unicoSAdmin+'<br />';
                            htmlAdmin += ''+txt340+': '+usandoDM+'<br />';
                            htmlAdmin += ''+txt341+': '+expire+'<br />';
                            htmlAdmin += ''+txt342+': '+esp+'<br />';
                            htmlAdmin += ''+txt343+': '+twitter123+'<br />';
                            htmlAdmin += ''+txt344+': '+facebook123+'<br />';
                            htmlAdmin += ''+txt345+': '+free+'<br />';
                            htmlAdmin += ''+txt346+': '+pro+'<br />';
                            htmlAdmin += ''+txt347+': '+enterprise+'<br />';
                            htmlAdmin += '<div style="display: inline-block;">Big Data: </div><div style="display: inline-block;" id="bigData"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a Perfil: </div><div style="display: inline-block;" id="perfil"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a Notificaciones: </div><div style="display: inline-block;" id="notifi"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a Stats: </div><div style="display: inline-block;" id="stats"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a Share: </div><div style="display: inline-block;" id="share"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a Tools: </div><div style="display: inline-block;" id="tools"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a CRM: </div><div style="display: inline-block;" id="crm"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a ADS: </div><div style="display: inline-block;" id="ads"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a Cuenta: </div><div style="display: inline-block;" id="cuenta"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a Ayuda: </div><div style="display: inline-block;" id="ayuda"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a AdminBB: </div><div style="display: inline-block;" id="adminBB"></div><br />';
                            htmlAdmin += '<div style="display: inline-block;">Visitas a Publicaciones: </div><div style="display: inline-block;" id="publicaciones"></div>';
                          htmlAdmin += '</div>';
                        htmlAdmin += '</div>';
                        htmlAdmin += '<div style="width: 50%; display: table-cell;">';
                          htmlAdmin += '<div style="width: 100%; text-align: center;"><b>Últimas Sesiones</b></div>';
                          htmlAdmin += '<div style="height: 300px; overflow-y: auto;">';
			  $.ajax({      url:   "scripts/admin/get-usuariosSSID.php",
					type:  'GET',
					success:  function (response) {
			                  obj = JSON.parse(response);
			                  if(obj.error){
			                    toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
			                  } else {
			                    for(var wer23z=0; wer23z<obj.length; wer23z++){
			                          htmlAdmin += ''+obj[wer23z].screen_name+' '+obj[wer23z].fecha+' '+obj[wer23z].identify+'<br />';
			                    }
                          htmlAdmin += '</div>';
                        htmlAdmin += '</div>';
                      htmlAdmin += '</div>'; /*Fin row*/
                    htmlAdmin += '</div>';
                    htmlAdmin += '<div style="width: 100%; display: table;">';
                      htmlAdmin += '<div style="width: 100%; display: table-row;">';
                        htmlAdmin += '<div style="width: 50%; display: table-cell;">';
                          htmlAdmin += '<div style="width: 100%; text-align: center;"><b>Usuarios Activos</b></div>';
                          htmlAdmin += '<div style="height: 300px; overflow-y: auto;" id="usuariosActivos">';
                          htmlAdmin += '</div>';
                        htmlAdmin += '</div>';
                      htmlAdmin += '</div>'; /*Fin row*/
                    htmlAdmin += '</div>';
                    htmlAdmin += '<div style="width: 100%; display: table;">';
                      htmlAdmin += '<div style="width: 100%; display: table-row;">';
                        htmlAdmin += '<div style="width: 50%; display: table-cell;">';
                          htmlAdmin += '<div style="width: 100%; text-align: center;"><b>Rastreo</b></div>';
                          htmlAdmin += '<div style="height: 300px; overflow-y: auto;" id="rastreo">';
                          htmlAdmin += '</div>';
                        htmlAdmin += '</div>';
                      htmlAdmin += '</div>'; /*Fin row*/
                    htmlAdmin += '</div>';
                    $("#main-feed1Text").html(txt337);
                    $("#main-feed1").html(htmlAdmin);
                  var webosHtml = '';
                  var usuarioRepetidos = [];
		  $.ajax({      url:   "scripts/admin/get-usuariosSSID.php",
				type:  'GET',
				success:  function (response) {
		                  obj = JSON.parse(response);
		                  if(obj.error){
		                    toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
		                  } else {
		                    for(var wer23z=0; wer23z<obj.length; wer23z++){
                                          if(usuarioRepetidos[""+obj[wer23z].identify+""]){
                                            usuarioRepetidos[""+obj[wer23z].identify+""]["num"]++;
                                            if(restaFechas(obj[wer23z].fecha.substr(0,obj[wer23z].fecha.length-6),usuarioRepetidos[""+obj[wer23z].identify+""]["fechaFin"])>0){
                                              usuarioRepetidos[""+obj[wer23z].identify+""]["fechaInicio"] = obj[wer23z].fecha;
                                            } else {
                                              usuarioRepetidos[""+obj[wer23z].identify+""]["fechaInicio"] = obj[wer23z].fecha;
                                            }
                                          } else {
                                            usuarioRepetidos[""+obj[wer23z].identify+""] = [];
                                            usuarioRepetidos[""+obj[wer23z].identify+""]["num"] = 1;
                                            usuarioRepetidos[""+obj[wer23z].identify+""]["id"] = obj[wer23z].id;
                                            usuarioRepetidos[""+obj[wer23z].identify+""]["screenName"] = obj[wer23z].screen_name;
                                            usuarioRepetidos[""+obj[wer23z].identify+""]["fechaInicio"] = obj[wer23z].fecha;
                                            usuarioRepetidos[""+obj[wer23z].identify+""]["fechaFin"] = obj[wer23z].fecha;
                                            usuarioRepetidos[""+obj[wer23z].identify+""]["red"] = obj[wer23z].red;
                                          }
		                    }
		                    webosHtml = ''+webosHtml+'Id_Token|Nombre de Usuario|Identificador|Red|N de Sesiones|fecha de inicio|fecha de Fin|<br />';
                                    for (var k in usuarioRepetidos){
				      if (typeof usuarioRepetidos[k] !== 'function') {
				         webosHtml = ''+webosHtml+''+usuarioRepetidos[k]["id"]+'|'+usuarioRepetidos[k]["screenName"]+'|'+k+'|'+usuarioRepetidos[k]["red"]+'|'+usuarioRepetidos[k]["num"]+'|'+usuarioRepetidos[k]["fechaInicio"]+'|'+usuarioRepetidos[k]["fechaFin"]+'|<br />';
				      }
				    }
		                  }
		                  $("#usuariosActivos").html(webosHtml);
				  $(".ui-dialog-titlebar-close").show();
		  		  $("#cargando").dialog("close");
				},
				error: function (response){
				  $(".ui-dialog-titlebar-close").show();
		  		  $("#cargando").dialog("close");
				}
		  });
		  $.ajax({      url:   "scripts/admin/get-usuariosAdmin.php",
				type:  'GET',
				success:  function (response) {
		                  obj = JSON.parse(response);
		                  if(obj.error){
		                    toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
		                  } else {
                                    webosHtml = '';
		                    webosHtml = ''+webosHtml+'Id_Token|Nombre de Usuario|Identificador|Red|fecha de inicio|fecha de Fin|profile|notificaciones|stats|share|tools|crm|ads|cuenta|ayuda|adminBB|publicaciones|<br />';
                                    var perfilCont123 = 0;
                                    var notificacionesCont123 = 0;
                                    var statsCont123 = 0;
                                    var shareCont123 = 0;
                                    var toolsCont123 = 0;
                                    var crmCont123 = 0;
                                    var adsCont123 = 0;
                                    var cuentaCont123 = 0;
                                    var ayudaCont123 = 0;
                                    var adminBBCont123 = 0;
                                    var publicacionesCont123 = 0;
		                    for(var wer23z=0; wer23z<obj.length; wer23z++){
                                      webosHtml = ''+webosHtml+''+obj[wer23z].id+'|'+obj[wer23z].screen_name+'|'+obj[wer23z].identify+'|'+obj[wer23z].red+'|'+obj[wer23z].first_ssid+'|'+obj[wer23z].last_ssid+'|'+obj[wer23z].profile+'|'+obj[wer23z].notificaciones+'|'+obj[wer23z].stats+'|'+obj[wer23z].share+'|'+obj[wer23z].tools+'|'+obj[wer23z].crm+'|'+obj[wer23z].ads+'|'+obj[wer23z].cuenta+'|'+obj[wer23z].ayuda+'|'+obj[wer23z].adminBB+'|'+obj[wer23z].publicaciones+'<br />';
                                      if(obj[wer23z].identify!="100001184682948" && obj[wer23z].identify!="2933941372" && obj[wer23z].identify!="1398496100466657" && obj[wer23z].identify!="100004745324034" && obj[wer23z].identify!="3167700344"){
                                        perfilCont123 = perfilCont123 + parseInt(obj[wer23z].profile);
                                        notificacionesCont123 = notificacionesCont123 + parseInt(obj[wer23z].notificaciones);
                                        statsCont123 = statsCont123 + parseInt(obj[wer23z].stats);
                                        shareCont123 = shareCont123 + parseInt(obj[wer23z].share);
                                        toolsCont123 = toolsCont123 + parseInt(obj[wer23z].tools);
                                        crmCont123 = crmCont123 + parseInt(obj[wer23z].crm);
                                        adsCont123 = adsCont123 + parseInt(obj[wer23z].ads);
                                        cuentaCont123 = cuentaCont123 + parseInt(obj[wer23z].cuenta);
                                        ayudaCont123 = ayudaCont123 + parseInt(obj[wer23z].ayuda);
                                        adminBBCont123 = adminBBCont123 + parseInt(obj[wer23z].adminBB);
                                        publicacionesCont123 = publicacionesCont123 + parseInt(obj[wer23z].publicaciones);
                                      }
                                    }
                                    $('#perfil').html(perfilCont123);
                                    $('#notifi').html(notificacionesCont123);
                                    $('#stats').html(statsCont123);
                                    $('#share').html(shareCont123);
                                    $('#tools').html(toolsCont123);
                                    $('#crm').html(crmCont123);
                                    $('#ads').html(adsCont123);
                                    $('#cuenta').html(cuentaCont123);
                                    $('#ayuda').html(ayudaCont123);
                                    $('#adminBB').html(adminBBCont123);
                                    $('#publicaciones').html(publicacionesCont123);
		                  }
		                  $("#rastreo").html(webosHtml);
				  $(".ui-dialog-titlebar-close").show();
		  		  $("#cargando").dialog("close");
				},
				error: function (response){
				  $(".ui-dialog-titlebar-close").show();
		  		  $("#cargando").dialog("close");
				}
		  });
                    $.ajax({      url:   "scripts/admin/get-big-data.php",
					type:  'GET',
					success:  function (response) {
			                  obj = JSON.parse(response);
			                  if(obj.error){
			                    toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
			                  } else {
			                    $("#bigData").html(obj.id_max);
			                  }
			                }, error: function (response){
			                }
                            });
			                  }
			                }, error: function (response){
			                }
			        });
                  }
                  
		  $(".ui-dialog-titlebar-close").show();
  		  $("#cargando").dialog("close");
		},
		error: function (response){
		  $(".ui-dialog-titlebar-close").show();
  		  $("#cargando").dialog("close");
		}
  });
}
function notificacionesAdmin(){
  openDialog();
  htmlNotAdmin1 = '';
  htmlNotAdmin1 += ''+txt349+': <input style="cursor: text; width: 100%;" type="text" id="tituloNotAdmin1" />';
  htmlNotAdmin1 += ''+txt350+': <textarea style="width: 100%;" id="contenidoNotAdmin1"></textarea>';
  htmlNotAdmin1 += '<p style="float:left;">'+txt351+'</p> <input id="pruebaAdmin1" style="margin-top: 0.2em; text-align: center; float: left; width: 5em;" type="checkbox" /> <p style="float:left;">'+txt490+'</p> <input id="mailAdmin1" style="margin-top: 0.2em; text-align: center; float: left; width: 5em;" type="checkbox" /> <p style="float:left;">'+txt491+'</p> <input id="sinNotAdmin1" style="margin-top: 0.2em; text-align: center; float: left; width: 5em;" type="checkbox" /> <p style="float:left;">'+txt492+'</p> <input id="inactivosAdmin1" style="margin-top: 0.2em; text-align: center; float: left; width: 5em;" type="checkbox" />';
  htmlNotAdmin1 += '<button class="btn btn-success" style="margin-top: 1em; margin-right: 1em; text-align: center; float: right; width: 5em;" type="button" onclick="notMandarAdmin();">'+txt38+'</button>';
  $("#main-feedNot1").html(htmlNotAdmin1);
  $(".ui-dialog-titlebar-close").show();
  $("#cargando").dialog("close");
  
}
function notMandarAdmin(){
  openDialog();
  $.ajax({      data: { titulo:$("#tituloNotAdmin1").val(), contenido:$("#contenidoNotAdmin1").val(), prueba:document.getElementById("pruebaAdmin1").checked, mail:document.getElementById("mailAdmin1").checked, sinNot:document.getElementById("sinNotAdmin1").checked, inactivos:document.getElementById("inactivosAdmin1").checked},
                url:   "scripts/admin/post-not.php",
		type:  'POST',
		success:  function (response) {
		  $(".ui-dialog-titlebar-close").show();
  		  $("#cargando").dialog("close");
                }, error: function (response){
		  $(".ui-dialog-titlebar-close").show();
  		  $("#cargando").dialog("close");
		}
  });
}