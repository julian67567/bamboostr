var arrayUserOrder;
var screennameBack;
var optionBack;
var hojaBack;
var contTabla = 0;
var contVer = 0;
var loadStats = '<div class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>';

function loadMaterial(id,long){
  var progress = document.createElement('div');
  progress.className = 'mdl-progress mdl-js-progress mdl-progress__indeterminate';
  progress.style.cssText  = 'width: '+long+'; text-align: center;';
  componentHandler.upgradeElement(progress);
  document.getElementById(id).innerHTML="";
  document.getElementById(id).appendChild(progress);
}

function openDialog(){
  $(".ui-dialog-titlebar-close").hide();
  $('.ui-dialog-content').show();
  $("#cargando").dialog("open");
  $("#cargando").dialog('option', 'title', txt115+"...");
  $("#cargando").html(txt201+""+loadStats);
  /*loadMaterial('cargando','200px');*/
}
8
if(txt10O == "595e85c50ef0b0e20ce03d0a6ad0c7594b9a051b" || txt10O=="c4fdd99c0706c3de99f5dd6d7365b293b223e25f"){
  var charTool = "140";
} else {
  var charTool = "125";
}
$(document).keydown(function(e){
    /* alert(e.keyCode); */
    if(e.which==13){   
      if($("#userSS").is(":focus")==true){
        optionBack=1;
      }
      if($("#userSS").is(":focus")==true || $("#cont1Ant").is(":focus")==true){
	      if($('#arrayUsers').parent().css("display")=="none"){
	        if(document.getElementById('cont1Ant'))
		  document.getElementById('cont1Ant').value=1;
	      }
	      var infoCuenta=document.getElementById("seleccionarCuenta").value;
	      infoCuentaArray=infoCuenta.split("|");
	      if(document.getElementById('cont1Ant') && document.getElementById('cont1Des')){
	        var ant = document.getElementById('cont1Ant').value;
	        var des = document.getElementById('cont1Des').value;
	        if(parseInt(ant)<=parseInt(des) && parseInt(ant)>0){
                  console.log("continuar filtro");
	          continuarSS('@'+infoCuentaArray[3].substr(1)+'',''+ant+'',''+optionBack+'');
	        } else {
	          toastr["error"](txt202, "ERROR");
	        }
	      } else {
	        continuarSS('@'+infoCuentaArray[3].substr(1)+'','1',''+optionBack+'');
	      }
      }
    }
});
function cleanMainsTw(){
  for(var aer=1; aer<=9; aer++){
    $("#main-feed"+aer+"").html("");
	$("#main-feed"+aer+"Text").html("");
	$("#main-feed"+aer+"Text").parent().parent().css("display","block");
        $("#main-feed"+aer).siblings().find(".acercaSR").attr('onclick','help('+comilla+''+aer+''+comilla+','+comilla+'twTools'+comilla+');');
  }
  for(var aer=9; aer<9; aer++){
    $("#main-feed"+aer+"").html("");
	$("#main-feed"+aer+"Text").html("");
	$("#main-feed"+aer+"Text").parent().parent().css("display","none");
  }
  if(document.getElementById('cont1Ant') && document.getElementById('cont1Des')){
        document.getElementById('cont1Ant').value = 1;
        document.getElementById('cont1Des').value = 50;
  }
}
function iniTwTools(identifyLocal,identifyOther,redLocal,imagenRed,screenname){
	cleanMainsTw();
        getDetails(screenname,1);
	getTwitterTool1(identifyLocal,identifyOther,redLocal,imagenRed,1,screenname);
	getTwitterTool2(identifyLocal,identifyOther,redLocal,imagenRed,2,screenname);
        getTwitterTool3(identifyLocal,identifyOther,redLocal,imagenRed,3,screenname);
	getTwitterTool4(identifyLocal,identifyOther,redLocal,imagenRed,4,screenname);
	getTwitterTool5(identifyLocal,identifyOther,redLocal,imagenRed,5,screenname);
        getTwitterTool6(identifyLocal,identifyOther,redLocal,imagenRed,6,screenname);
        getTwitterTool7(identifyLocal,identifyOther,redLocal,imagenRed,7,screenname);
        getTwitterTool8(identifyLocal,identifyOther,redLocal,imagenRed,8,screenname);
        cargar_muestreo(identifyLocal,identifyOther,redLocal,imagenRed,7,screenname);
        getTwitterTool9(identifyLocal,identifyOther,redLocal,imagenRed,9,screenname);
}
function cargar_muestreo(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,screenname){
  $.ajax({ data: {red:redLocal, identify:identifyLocal, option:'muestreo4'},		
           url:   "twitter/stats/thread-stats-tw.php",
	   type:  "GET",
	   success:  function (response) {
		  $.ajax({ data: {red:redLocal, identify:identifyLocal, option:'muestreo5'},		
		           url:   "twitter/stats/thread-stats-tw.php",
							type:  "GET",
							success:  function (response) {
		                                          obj = JSON.parse(response);
		                                          $("#siguiendoBots").html(obj.bots.cont);
		                                          $("#siguiendoInactivas").html(obj.inactivas.cont);
		                                          $("#siguiendoImages").html(obj.sinImagenPerfil.cont);
		                                        },
							error: function (response) {
		                                          $("#siguiendoBots").html("ERROR");
		                                          $("#siguiendoInactivas").html("ERROR");
		                                          $("#siguiendoImages").html("ERROR");
							}
		  });
        },
	error: function (response) {
	  $("#siguiendoBots").html("ERROR");
	  $("#siguiendoInactivas").html("ERROR");
	  $("#siguiendoImages").html("ERROR");
	}
  });
}
function bajarS(){
  $("#modal-body").scrollTop(document.getElementById("modal-body").scrollTop + 129);
}
function spam(screenname,option){
  $.ajax({url: "twitter/thread-tw.php?screen_name="+screenname.substr(1)+"&option=spam&spam="+option+"",
		  type: "GET",
                  cache: false,
		  success: function(response) {
                  }, error: function(response){
                  }
  });
}

var usersCola = Array();
var usersColaCont = 0;

function dejaSeguirTw(screenname, seguir, id){
  contVer++;
  usersCola[usersColaCont] = Array();
  usersCola[usersColaCont][0]=seguir;
  usersCola[usersColaCont][1]=id;
  usersColaCont++;
  
  /*$('#'+id+'').html(loadStats);*/
  loadMaterial(''+id+'','100%');
  var arrayUsers = document.getElementById('arrayUsers');
  bajarS();
  //console.log(window[""+screenname+"NotFollowingMe"]);
  checarCola(screenname,2);
}

function  noSeguirExec(screenname){
    if(window[""+screenname+"NotFollowingMe"]==0){
	    spam(screenname,3); 
    }
    var backCola = usersCola;
	$.ajax({		url:   "twitter/thread-tw.php",
	                data: {screen_name:screenname.substr(1), seguir:JSON.stringify(usersCola), option:"postUnfollow", id_token:id_token},
					type:  "GET",
					success:  function (response) {
                                          obj = JSON.parse(response);
                                          if(obj.errors){
                                            if(obj.errors[0].message.indexOf("You are unable to follow more people at this time")!=-1){
                                              toastr["error"](txt251, "ERROR");
                                              for(var rt433=0; rt433<obj.ids.length; rt433++){
											    $('#'+obj.ids[rt433]+'').html(txt212);
												if(obj.ids[rt433].substr(0,1)=="E"){
											      $('#'+obj.ids[rt433].substr(1)+'').html(txt212);
												} else {
											      $('#'+obj.ids[rt433]+'').html('<a style="cursor: pointer;" onclick="bajarS();">'+txt203+'</a>');
											    }
												contVer--;
											  }
                                            } else {
                                              toastr["error"](obj.errors[0].message, "ERROR");
                                              for(var rt433=0; rt433<obj.ids.length; rt433++){
											    $('#'+obj.ids[rt433]+'').html(txt212);
												if(obj.ids[rt433].substr(0,1)=="E"){
											      $('#'+obj.ids[rt433].substr(1)+'').html(txt212);
												} else {
											      $('#'+obj.ids[rt433]+'').html('<a style="cursor: pointer;" onclick="bajarS();">'+txt203+'</a>');
											    }
												contVer--;
											  }
                                            }
                                          } else {
                                            /*console.log(arrayUserOrder.length+" "+backCola.length); */
											for(var hjie=0; hjie<arrayUserOrder.length; hjie++){
											  for(var hjie2=0; hjie2<backCola.length; hjie2++){
												/*
												if(arrayUserOrder[hjie]){
												  console.log(backCola[hjie2][0]+" "+hjie2+" "+hjie+" "+arrayUserOrder[hjie][1]);
												}
												*/
											    if(arrayUserOrder[hjie] && backCola[hjie2][0]==arrayUserOrder[hjie][1]){
												  arrayUserOrder[hjie][0]=true;
											    }
											  }
											}
											for(var rt433=0; rt433<obj.ids.length; rt433++){
                                              
											  if(obj.ids[rt433].substr(0,1)=="E"){
											      $('#'+obj.ids[rt433].substr(1)+'').html(txt212);
											  } else {
											    $('#'+obj.ids[rt433]+'').html('<a style="cursor: pointer;" onclick="bajarS();">'+txt515+'</a>');
											  }
                                              window[""+screenname+"NotFollowingMe"] = window[""+screenname+"NotFollowingMe"]+1;
											  contVer--;
											}
											
                                            $("#siguiendoTools123").html(parseInt($("#siguiendoTools123").html())-1);                                                     
                                            var titleOT = $("#arrayUsersModalLabel").html();
                                            titleOT2 = titleOT.split(":");
                                            $("#arrayUsersModalLabel").html(titleOT2[0] + ': ' + window[""+screenname+"NotFollowingMe"]);
                                            if(optionBack==2 && $("#numNotFollowingMe").html()>0){
                                              $("#numNotFollowingMe").html($("#numNotFollowingMe").html()-1);
                                            }
                                            if(optionBack==3 && $("#siguiendoBots").html()>0){
                                              $("#siguiendoBots").html($("#siguiendoBots").html()-1);
                                            }
                                            if(optionBack==4 && $("#siguiendoInactivas").html()>0){
                                              $("#siguiendoInactivas").html($("#siguiendoInactivas").html()-1);
                                            }
                                            if(optionBack==5 && $("#siguiendoImages").html()>0){
                                              $("#siguiendoImages").html($("#siguiendoImages").html()-1);
                                            }
			                  }
                                        },
					error: function (response) {
					  /*console.log(backCola.length);*/
					  for(var hjie2=0; hjie2<backCola.length; hjie2++){
					    arrayUserOrder[hjie2][0]=true;
						$('#'+backCola[hjie2][1]+'').html(txt212);
						contVer--;
					  }
					}
    });
    /*Resetear cola*/
    //setTimeout(function(){
	  usersCola = Array();
      usersColaCont = 0;
    //},50);
}

function checarCola(screenname,option){
  var guardarUsersColaCont = usersColaCont;
  setTimeout(function(){
    if(guardarUsersColaCont==usersColaCont){
	  if(option==1){
        seguirExec(screenname);
	  } else {
        noSeguirExec(screenname);
	  }
    }
  },3000);
}
function seguirTw(screenname, seguir, id){
  contVer++;
  usersCola[usersColaCont] = Array();
  usersCola[usersColaCont][0]=seguir;
  usersCola[usersColaCont][1]=id;
  usersColaCont++;
  /*console.log(usersCola[usersColaCont-1][0]);*/
  checarCola(screenname,1);
  /*$('#'+id+'').html(loadStats);*/
  loadMaterial(''+id+'','100%');
  var arrayUsers = document.getElementById('arrayUsers');
  bajarS();
}
function seguirExec(screenname){
	var backCola = usersCola;
    $.ajax({		url:   "twitter/thread-tw.php",
					type:  "GET",
					data:{ seguir:JSON.stringify(usersCola), screen_name:screenname.substr(1), option:"postFollow", siguiendo:$("#siguiendoTools123").html(), seguidores:$("#seguidoresTools123").html(), id_token:id_token },

					success:  function (response) {
                                          obj = JSON.parse(response);
                                          //console.log(hojaBack+" "+hojaBack2);
                                          if(obj.errors){
                                            if(obj.errors[0].message.indexOf("You are unable to follow more people at this time")!=-1){
											  
                                              toastr["error"](txt251, "ERROR");
                                              for(var rt433=0; rt433<obj.ids.length; rt433++){
											    $('#'+obj.ids[rt433]+'').html(txt212);
												if(obj.ids[rt433].substr(0,1)=="E"){
											      $('#'+obj.ids[rt433].substr(1)+'').html(txt212);
												} else {
											      $('#'+obj.ids[rt433]+'').html('<a style="cursor: pointer;" onclick="bajarS();">'+txt203+'</a>');
											    }
												contVer--;
											  }

											
                                            } else {
                                              toastr["error"](obj.errors[0].message, "ERROR");
                                              for(var rt433=0; rt433<obj.ids.length; rt433++){
											    $('#'+obj.ids[rt433]+'').html(txt212);
												if(obj.ids[rt433].substr(0,1)=="E"){
											      $('#'+obj.ids[rt433].substr(1)+'').html(txt212);
												} else {
											      $('#'+obj.ids[rt433]+'').html('<a style="cursor: pointer;" onclick="bajarS();">'+txt203+'</a>');
											    }
												contVer--;
											  }
                                            }
                                          } else {
											/*console.log(arrayUserOrder.length+" "+backCola.length); */
											for(var hjie=0; hjie<arrayUserOrder.length; hjie++){
											  for(var hjie2=0; hjie2<backCola.length; hjie2++){
												/*
												if(arrayUserOrder[hjie]){
												  console.log(backCola[hjie2][0]+" "+hjie2+" "+hjie+" "+arrayUserOrder[hjie][1]);
												}
												*/
											    if(arrayUserOrder[hjie] && backCola[hjie2][0]==arrayUserOrder[hjie][1]){
												  arrayUserOrder[hjie][0]=true;
											    }
											  }
											}
											for(var rt433=0; rt433<obj.ids.length; rt433++){
                                              
											  if(obj.ids[rt433].substr(0,1)=="E"){
											      $('#'+obj.ids[rt433].substr(1)+'').html(txt212);
											  } else {
											    $('#'+obj.ids[rt433]+'').html('<a style="cursor: pointer;" onclick="bajarS();">'+txt203+'</a>');
											  }
                                              window[""+screenname+"SS"] = window[""+screenname+"SS"] +1;
											  contVer--;
											}
                                            
                                            
                                            $("#siguiendoTools123").html(parseInt($("#siguiendoTools123").html())+1);   
                                            var titleOT = $("#arrayUsersModalLabel").html();
                                            titleOT2 = titleOT.split(":");
                                            $("#arrayUsersModalLabel").html(titleOT2[0] + ': ' + window[""+screenname+"SS"]);
			                  }
                                        },
					error: function (response) {
				      /*console.log(backCola.length);*/
                      for(var hjie2=0; hjie2<backCola.length; hjie2++){
					    arrayUserOrder[hjie2][0]=true;
						$('#'+backCola[hjie2][1]+'').html(txt212);
						contVer--;
					  }
					}
    });
    /*Resetear cola*/
    //setTimeout(function(){
	  usersCola = Array();
      usersColaCont = 0;
    //},50);
}
function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  var shortdate = time_value.substr(4,2) + " " + time_value.substr(0,3);
  delta = delta + (relative_to.getTimezoneOffset() * 60);
 
  if (delta < 60) {
	return '1m';
  } else if(delta < 120) {
	return '1m';
  } else if(delta < (60*60)) {
	return (parseInt(delta / 60)).toString() + 'm';
  } else if(delta < (120*60)) {
	return '1h';
  } else if(delta < (24*60*60)) {
	return (parseInt(delta / 3600)).toString() + 'h';
  } else if(delta < (48*60*60)) {
	//return '1 day';
	return shortdate;
  } else {
	return shortdate;
  }
}
function selectFiltro(screenname, hoja, option){
  var tutnde23 = document.getElementById('option124e').value;
  orderSS(screenname,hoja,tutnde23,option);
  /*console.log(tutnde23);*/
}
function buscarArraUser(){
 var palabraArra12 = quitarAcentos($('#palabraArrayUser').val()).toUpperCase();
  var arrayUsersHtml = '';
	  arrayUsersHtml += '<div style="height: 50px; margin-bottom: 4px; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); background-color: #FFFFFF;" class="row">';
		arrayUsersHtml += '<div style="margin-top: 14px;" class="col-xs-12">';
		  arrayUsersHtml += '<select onchange="selectFiltro('+comilla+''+screennameBack+''+comilla+', '+comilla+''+hojaBack+''+comilla+', '+comilla+''+optionBack+''+comilla+');" id="option124e">';
			arrayUsersHtml += '<option>';
			  arrayUsersHtml += 'Ordenar Por:';
			arrayUsersHtml += '</option>';
			arrayUsersHtml += '<option value="1">';
			  arrayUsersHtml += 'Ubicación';
			arrayUsersHtml += '</option>';
			arrayUsersHtml += '<option value="2">';
			  arrayUsersHtml += 'Último Tweet';
			arrayUsersHtml += '</option>';
			arrayUsersHtml += '<option value="3">';
			  arrayUsersHtml += 'Idioma';
			arrayUsersHtml += '</option>';
			arrayUsersHtml += '<option value="5">';
			  arrayUsersHtml += 'Tweets';
			arrayUsersHtml += '</option>';
			arrayUsersHtml += '<option value="6">';
			  arrayUsersHtml += 'Followers';
			arrayUsersHtml += '</option>';
			arrayUsersHtml += '<option value="7">';
			  arrayUsersHtml += 'Following';
			arrayUsersHtml += '</option>';
		  arrayUsersHtml += '</select>';
		arrayUsersHtml += '</div>';
	  arrayUsersHtml += '</div>';		
						
  arrayUsersHtml += '<div id="tableUsersFollow" class="col-xs-12">';
	arrayUsersHtml += '<div class="row">';

	for(var cont2131=0; cont2131<arrayUserOrder.length; cont2131++){

		  if(arrayUserOrder[cont2131] && arrayUserOrder[cont2131][1]!=null && arrayUserOrder[cont2131][11]==false &&
		        (quitarAcentos(utf8_decode(arrayUserOrder[cont2131][0])).toUpperCase().indexOf(palabraArra12)!="-1" ||
			 quitarAcentos(utf8_decode(arrayUserOrder[cont2131][1])).toUpperCase().indexOf(palabraArra12)!="-1" ||
			 quitarAcentos(utf8_decode(arrayUserOrder[cont2131][3])).toUpperCase().indexOf(palabraArra12)!="-1" ||
			 quitarAcentos(utf8_decode(arrayUserOrder[cont2131][4])).toUpperCase().indexOf(palabraArra12)!="-1" ||
			 quitarAcentos(utf8_decode(arrayUserOrder[cont2131][5])).toUpperCase().indexOf(palabraArra12)!="-1" ||
			 quitarAcentos(utf8_decode(arrayUserOrder[cont2131][6])).toUpperCase().indexOf(palabraArra12)!="-1" ||
			 quitarAcentos(utf8_decode(arrayUserOrder[cont2131][7])).toUpperCase().indexOf(palabraArra12)!="-1" ||
			 quitarAcentos(utf8_decode(arrayUserOrder[cont2131][8])).toUpperCase().indexOf(palabraArra12)!="-1" ||
			 quitarAcentos(utf8_decode(arrayUserOrder[cont2131][9])).toUpperCase().indexOf(palabraArra12)!="-1" ||
			 quitarAcentos(utf8_decode(arrayUserOrder[cont2131][10])).toUpperCase().indexOf(palabraArra12)!="-1")){
			arrayUsersHtml += '<div class="colorEven row" style="box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); margin-bottom: 4px; height: 125px;">';
			  arrayUsersHtml += '<div class="container-fluid col-xs-12">';
				arrayUsersHtml += '<div class="row">';
				  arrayUsersHtml += '<div class="col-xs-12">';
					arrayUsersHtml += '<div class="col-xs-4" style="margin-top: 1em; text-align: center;">';
					  arrayUsersHtml += '<div class="row">';
						arrayUsersHtml += '<img src="'+arrayUserOrder[cont2131][2]+'" class="img-circle" style="box-shadow: rgba(0, 0, 0, 0.137255) 0px 2px 2px 0px, rgba(0, 0, 0, 0.2) 0px 3px 1px -2px, rgba(0, 0, 0, 0.117647) 0px 1px 5px 0px; width: 40px"><br />';
						/*arrayUsersHtml += '<h6 style="font-family: Helvetica,Arial,sans-serif; padding: 0; margin: 0; font-weight: bold;">@'+arrayUserOrder[cont2131][8]+'</h6>';*/
						if(arrayUserOrder[cont2131][3])
						  arrayUsersHtml += '<h6 style="padding: 10px 0 0 0; font: 400 12px/16px Roboto,sans-serif !important; margin: 0;" class="hidden-xs">'+utf8_decode(arrayUserOrder[cont2131][3].substring(0,23))+'</h6>';
						else
						  arrayUsersHtml += '<h6 style="padding-top: 10px; font: 400 12px/16px Roboto,sans-serif !important; margin: 0;" class="hidden-xs">Sin Ubicación</h6>';
					  arrayUsersHtml += '</div>';
					  arrayUsersHtml += '<div style="padding-left: 30px; padding-right: 30px; margin-top: 10px;" id="BS'+(contTabla+cont2131)+'" class="row">';
						if(arrayUserOrder[cont2131][0]=="BlackList"){
						  arrayUsersHtml += '<a style="margin-top: 10px; cursor: pointer;" onclick="bajarS();">'+txt517+'</a>';
						} else if(arrayUserOrder[cont2131][0]==true && optionBack==1){
						  arrayUsersHtml += '<a style="margin-top: 10px; cursor: pointer;" onclick="bajarS();">'+txt203+'</a>';
						} else if(optionBack==1) {
						  arrayUsersHtml += '<button style="margin-top: 0px;" onclick="seguirTw('+comilla+''+screennameBack+''+comilla+','+comilla+''+arrayUserOrder[cont2131][1]+''+comilla+','+comilla+'BS'+(contTabla+cont2131)+''+comilla+');" class="btn btn-success btn-xs">'+txt298+'</button>';
						} else if(arrayUserOrder[cont2131][0]==true && optionBack!=1){
						  arrayUsersHtml += '<button style="margin-top: 0px;" onclick="dejaSeguirTw('+comilla+''+screennameBack+''+comilla+','+comilla+''+arrayUserOrder[cont2131][1]+''+comilla+','+comilla+'BS'+(contTabla+cont2131)+''+comilla+');" class="btn btn-danger btn-xs">- Unfollow</button>';
						} else {
						  arrayUsersHtml += '<a style="margin-top: 20px; cursor: pointer;" onclick="bajarS();">'+txt515+'</a>';
						} 
				  arrayUsersHtml += '</div><!--class row-->';
				arrayUsersHtml += '</div><!--col-xs-4-->';
				arrayUsersHtml += '<div class="col-xs-8">';
				  arrayUsersHtml += '<div class="row">';
					arrayUsersHtml += '<div class="col-xs-12">';
					  arrayUsersHtml += '<h6 style="margin-bottom: 0; font: 600 14px/16px Roboto,sans-serif  !important; padding-left: 0; margin-left: 0;" class="col-xs-6 text-left">@'+arrayUserOrder[cont2131][1]+'</h6>';
						arrayUsersHtml += '<h6 style="margin-bottom: 0; font: 400 14px/16px Roboto,sans-serif  !important; color: #777;" class="col-xs-6 text-right">';
						  if(!arrayUserOrder[cont2131][4]){
							arrayUsersHtml += 'N/A';
						  } else if(arrayUserOrder[cont2131][4]=="a Apr 19 00:00:00 1999 1999"){
							arrayUsersHtml += txt210;
						  } else {
							var rel = relative_time(arrayUserOrder[cont2131][4]);
							if(rel!="fi und"){
							  arrayUsersHtml += ''+rel+'';
							} else {
							  arrayUsersHtml += txt210;
							}                        
						  }
						arrayUsersHtml += '</h6>';
					  arrayUsersHtml += '</div>';
					arrayUsersHtml += '</div>';
					arrayUsersHtml += '<div style="margin-top: 5px; height: 50px;" class="row">';
						arrayUsersHtml += '<div class="hidden-xs col-xs-12 text-left">';
						if(arrayUserOrder[cont2131][10])
						  arrayUsersHtml += '<h6 style="font: 400 12px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">'+utf8_decode(arrayUserOrder[cont2131][10].replace(",", "").substring(0,100))+'</h6>';
						else
						  arrayUsersHtml += '<h6 style="font: 400 12px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Sin Descripción</h6>';
						arrayUsersHtml += '</div>';
					arrayUsersHtml += '</div>';
					arrayUsersHtml += '<div class="row">';
					  arrayUsersHtml += '<div class="col-xs-12">';
						arrayUsersHtml += '<div class="col-xs-4 text-center">';
							arrayUsersHtml += '<h6 style="font: 400 15px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Tweets</h6>';
							arrayUsersHtml += '<h6 style="font: 600 14px/16px Roboto,sans-serif  !important; padding: 0; margin: 0; color: #0084B4;">'+arrayUserOrder[cont2131][5]+'</h6>';
						arrayUsersHtml += '</div>';
						arrayUsersHtml += '<div class="col-xs-4 text-center">';
							arrayUsersHtml += '<h6 style="font: 400 15px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Following</h6>';
							arrayUsersHtml += '<h6 style="font: 600 14px/16px Roboto,sans-serif  !important; padding: 0; margin: 0; color: #0084B4;">'+arrayUserOrder[cont2131][7]+'</h6>';
							
						arrayUsersHtml += '</div>';
						arrayUsersHtml += '<div class="col-xs-4 text-center">';
							arrayUsersHtml += '<h6 style="font: 400 15px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Followers</h6>';
							arrayUsersHtml += '<h6 style="font: 600 14px/16px Roboto,sans-serif  !important; padding: 0; margin: 0; color: #0084B4;">'+arrayUserOrder[cont2131][6]+'</h6>';
						arrayUsersHtml += '</div>';
					  arrayUsersHtml += ' </div>';
					arrayUsersHtml += '</div><!--fin row-->';
				  arrayUsersHtml += '</div><!--col-xs-5-->';
				arrayUsersHtml += '</div><!--col-xs-7-->';
			  arrayUsersHtml += '</div><!--fin row-->';
			arrayUsersHtml += '</div><!--fin container-->';
		  arrayUsersHtml += '</div><!--colorEven row-->';
		  }//fin if
	}//fin for
					      arrayUsersHtml += '<div style="height: 50px; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); background-color: #FFFFFF;" class="row">';
						    arrayUsersHtml += '<div class="col-xs-12">';
							  arrayUsersHtml += '<nav><ul style="margin-top: 8px;" class="pagination">';
							  var next123 = parseInt(hojaBack)-1;
							  if(next123!=0){
						        arrayUsersHtml += '<li><a href="#" aria-label="Previous"><span onclick="continuarSS('+comilla+''+screennameBack+''+comilla+','+comilla+''+next123+''+comilla+','+comilla+''+optionBack+''+comilla+');" aria-hidden="true">«</span></a></li>';
							  }
						      arrayUsersHtml += '<li><a style="padding: 0; margin: 0; padding-top: 4px; padding-bottom: 4px;" href="#"><input id="cont1Ant" style="border: 0px; width: 50px;" type="text" value="'+hojaBack+'"></a></li><li><a href="#">de</a></li><li><a style="padding: 0; margin: 0; padding-top: 4px; padding-bottom: 4px;" href="#"><input id="cont1Des" style="border: 0px; width: 50px;" type="text" value=""></a></li>';
							  var next123 = parseInt(hojaBack) +1;
						      arrayUsersHtml += '<li><a onclick="continuarSS('+comilla+''+screennameBack+''+comilla+','+comilla+''+next123+''+comilla+','+comilla+''+optionBack+''+comilla+');" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>';
					      arrayUsersHtml += '</ul></nav>';
					    arrayUsersHtml += '</div>';
					  arrayUsersHtml += '</div>';
						  
	  $("#arrayUsersContent").html(arrayUsersHtml);
          $(".colorEven:even").css("background-color","#FFFFFF");
	  $(".colorEven").hover(function(){
	    $(this).css("background-color", "#f1f1f1");
	  }, function(){
	    $(".colorEven:odd").css("background-color","#FFFFFF");
	    $(".colorEven:even").css("background-color","#FFFFFF");
	  });
          if(optionBack==1){
	    var parametros = {screen_name:screennameBack.substr(1), option:"getTwitterSS"};
          } else {
	    var parametros = {screen_name:screennameBack.substr(1), option:"getTwitterNotFollowingMe", option2:optionBack};
          }  
	  $.ajax({data:  parametros,
		url:   "twitter/thread-tw.php",
		type:  "GET",
		success:  function (response) {
		  obj = JSON.parse(response);
		  if(obj.cursor==null && obj.hojaNumber<100){
                    if(obj.hojaNumber<100){
			document.getElementById('cont1Des').value=1;
                    } else {
			document.getElementById('cont1Des').value=parseInt((obj.hojaNumber/100));
                    }
		  } else {
			if(obj.hojaNumber<100){
	document.getElementById('cont1Des').value=1;
			} else {
			  document.getElementById('cont1Des').value=parseInt((obj.hojaNumber/100)+1);
            }
		  }
		},
		error: function (response){
		}
	  });
}
function orderSS(screenname, hoja, order, option){
  hojaBack = hoja;
  if(option==1){
    var titleOT = $("#arrayUsersModalLabel").html();
    titleOT2 = titleOT.split(":");
    $("#arrayUsersModalLabel").html(titleOT2[0]+ ': ' + window[""+screenname+"SS"]);
  } else {
    var titleOT = $("#arrayUsersModalLabel").html();
    titleOT2 = titleOT.split(":");
    $("#arrayUsersModalLabel").html(titleOT2[0]+ ': ' + window[""+screenname+"NotFollowingMe"]);
  }
  if(order==1){
    arrayUserOrder.sort(function(a, b){
	  if(a[3] < b[3]) return -1;
      if(a[3] > b[3]) return 1;
    });
  }
  if(order==2){
	arrayUserOrder.sort(function(a, b){

		if(!a[4] || a[4]==txt210 || a[4]=="N/A" || a[4]=="" || a[4].indexOf(" ")==-1 || typeof a[4]===undefined || typeof a[4]==undefined || 
                   typeof a[4]==="undefined" || typeof a[4]=="undefined" || a[4]===undefined || a[4]==undefined || a[4]==="undefined" || a[4]=="undefined"){
		  a[4] = "a Apr 19 00:00:00 1999 1999";
		}
                if(!b[4] || b[4]==txt210 || b[4]=="N/A" || b[4]=="" || b[4].indexOf(" ")==-1 || typeof b[4]===undefined || typeof b[4]==undefined ||
                   typeof b[4]==="undefined" || typeof b[4]=="undefined" || b[4]===undefined || b[4]==undefined || b[4]==="undefined" || b[4]=="undefined") {
		   b[4] = "a Apr 19 00:00:00 1999 1999";
		} 

		var aF3 = a[4].split(" ");
		aF31 = aF3[1] + " " + aF3[2] + " " + aF3[5] + " " + aF3[3];   
	  
		var bF3 = b[4].split(" ");
		bF31 = bF3[1] + " " + bF3[2] + " " + bF3[5] + " " + bF3[3];
	  
		a = new Date(aF31);
		b = new Date(bF31);
		return a>b ? -1 : a<b ? 1 : 0;
    });
  }
  if(order==5 || order==6 || order==7){
	arrayUserOrder.sort(function(a, b){
      return a[order] - b[order];
    });
  }
  if(order==8){
	arrayUserOrder.sort(function(a, b){
	  if(a[8] < b[8]) return -1;
      if(a[8] > b[8]) return 1;
    });
  }
var arrayUsersHtml = '';
  arrayUsersHtml += '<div style="height: 50px; margin-bottom: 4px; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); background-color: #FFFFFF;" class="row">';
	arrayUsersHtml += '<div style="margin-top: 14px;" class="col-xs-12">';
	  arrayUsersHtml += '<select onchange="selectFiltro('+comilla+''+screenname+''+comilla+', '+comilla+''+hoja+''+comilla+', '+comilla+''+option+''+comilla+');" id="option124e">';
		arrayUsersHtml += '<option>';
		  arrayUsersHtml += 'Ordenar Por:';
		arrayUsersHtml += '</option>';
		arrayUsersHtml += '<option value="1">';
		  arrayUsersHtml += 'Ubicación';
		arrayUsersHtml += '</option>';
		arrayUsersHtml += '<option value="2">';
		  arrayUsersHtml += 'Último Tweet';
		arrayUsersHtml += '</option>';
		arrayUsersHtml += '<option value="3">';
		  arrayUsersHtml += 'Idioma';
		arrayUsersHtml += '</option>';
		arrayUsersHtml += '<option value="5">';
		  arrayUsersHtml += 'Tweets';
		arrayUsersHtml += '</option>';
		arrayUsersHtml += '<option value="6">';
		  arrayUsersHtml += 'Followers';
		arrayUsersHtml += '</option>';
		arrayUsersHtml += '<option value="7">';
		  arrayUsersHtml += 'Following';
		arrayUsersHtml += '</option>';
	  arrayUsersHtml += '</select>';
	arrayUsersHtml += '</div>';
  arrayUsersHtml += '</div>';	
						
  arrayUsersHtml += '<div id="tableUsersFollow" class="col-xs-12">';
	arrayUsersHtml += '<div class="row">';
	for(var cont2131=0; cont2131<arrayUserOrder.length; cont2131++){
		  if(arrayUserOrder[cont2131] && arrayUserOrder[cont2131][1]!=null && arrayUserOrder[cont2131][11]==false){
			arrayUsersHtml += '<div class="colorEven row" style="box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); margin-bottom: 4px; height: 125px;">';
			  arrayUsersHtml += '<div class="container-fluid col-xs-12">';
				arrayUsersHtml += '<div class="row">';
				  arrayUsersHtml += '<div class="col-xs-12">';
					arrayUsersHtml += '<div class="col-xs-4" style="margin-top: 1em; text-align: center;">';
					  arrayUsersHtml += '<div class="row">';
						arrayUsersHtml += '<img src="'+arrayUserOrder[cont2131][2]+'" class="img-circle" style="box-shadow: rgba(0, 0, 0, 0.137255) 0px 2px 2px 0px, rgba(0, 0, 0, 0.2) 0px 3px 1px -2px, rgba(0, 0, 0, 0.117647) 0px 1px 5px 0px; width: 40px"><br />';
						/*arrayUsersHtml += '<h6 style="font-family: Helvetica,Arial,sans-serif; padding: 0; margin: 0; font-weight: bold;">@'+arrayUserOrder[cont2131][8]+'</h6>';*/
						if(arrayUserOrder[cont2131][3])
						  arrayUsersHtml += '<h6 style="padding: 10px 0 0 0; font: 400 12px/16px Roboto,sans-serif !important; margin: 0;" class="hidden-xs">'+utf8_decode(arrayUserOrder[cont2131][3].substring(0,23))+'</h6>';
						else
						  arrayUsersHtml += '<h6 style="padding-top: 10px; font: 400 12px/16px Roboto,sans-serif !important; margin: 0;" class="hidden-xs">Sin Ubicación</h6>';
					  arrayUsersHtml += '</div>';
					  arrayUsersHtml += '<div style="padding-left: 30px; padding-right: 30px; margin-top: 10px;" id="BS'+(contTabla+cont2131)+'" class="row">';
						if(arrayUserOrder[cont2131][0]=="BlackList"){
						  arrayUsersHtml += '<a style="font: 400 16px/16px Roboto,sans-serif  !important;  margin-top: 10px; cursor: pointer;" onclick="bajarS();">'+txt517+'</a>';
						} else if(arrayUserOrder[cont2131][0]==true && option==1){
						  arrayUsersHtml += '<a style="font: 400 16px/16px Roboto,sans-serif  !important; margin-top: 10px; cursor: pointer;" onclick="bajarS();">'+txt203+'</a>';
						} else if(option==1) {
						  arrayUsersHtml += '<button style="margin-top: 0px;" onclick="seguirTw('+comilla+''+screenname+''+comilla+','+comilla+''+arrayUserOrder[cont2131][1]+''+comilla+','+comilla+'BS'+(contTabla+cont2131)+''+comilla+');" class="btn btn-success btn-xs">'+txt298+'</button>';
						} else if(arrayUserOrder[cont2131][0]==true && option!=1){
						  arrayUsersHtml += '<button style="margin-top: 0px;" onclick="dejaSeguirTw('+comilla+''+screenname+''+comilla+','+comilla+''+arrayUserOrder[cont2131][1]+''+comilla+','+comilla+'BS'+(contTabla+cont2131)+''+comilla+');" class="btn btn-danger btn-xs">- Unfollow</button>';
						} else {
						  arrayUsersHtml += '<a style="margin-top: 20px; cursor: pointer;" onclick="bajarS();">'+txt515+'</a>';
						}  
				  arrayUsersHtml += '</div><!--class row-->';
				arrayUsersHtml += '</div><!--col-xs-4-->';
				arrayUsersHtml += '<div class="col-xs-8">';
				  arrayUsersHtml += '<div class="row">';
					arrayUsersHtml += '<div class="col-xs-12">';
					  arrayUsersHtml += '<h6 style="margin-bottom: 0; font: 600 14px/16px Roboto,sans-serif  !important; padding-left: 0; margin-left: 0;" class="col-xs-6 text-left">@'+arrayUserOrder[cont2131][1]+'</h6>';
						arrayUsersHtml += '<h6 style="margin-bottom: 0; font: 400 14px/16px Roboto,sans-serif  !important; color: #777;" class="col-xs-6 text-right">';
						  if(!arrayUserOrder[cont2131][4]){
							arrayUsersHtml += 'N/A';
						  } else if(arrayUserOrder[cont2131][4]=="a Apr 19 00:00:00 1999 1999"){
							arrayUsersHtml += txt210;
						  } else {
							var rel = relative_time(arrayUserOrder[cont2131][4]);
							if(rel!="fi und"){
							  arrayUsersHtml += ''+rel+'';
							} else {
							  arrayUsersHtml += txt210;
							}                        
						  }
						arrayUsersHtml += '</h6>';
					  arrayUsersHtml += '</div>';
					arrayUsersHtml += '</div>';
					arrayUsersHtml += '<div style="margin-top: 5px; height: 50px;" class="row">';
						arrayUsersHtml += '<div class="hidden-xs col-xs-12 text-left">';
						if(arrayUserOrder[cont2131][10])
						  arrayUsersHtml += '<h6 style="font: 400 12px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">'+utf8_decode(arrayUserOrder[cont2131][10].replace(",", "").substring(0,100))+'</h6>';
						else
						  arrayUsersHtml += '<h6 style="font: 400 12px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Sin Descripción</h6>';
						arrayUsersHtml += '</div>';
					arrayUsersHtml += '</div>';
					arrayUsersHtml += '<div class="row">';
					  arrayUsersHtml += '<div class="col-xs-12">';
						arrayUsersHtml += '<div class="col-xs-4 text-center">';
							arrayUsersHtml += '<h6 style="font: 400 15px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Tweets</h6>';
							arrayUsersHtml += '<h6 style="font: 600 14px/16px Roboto,sans-serif  !important; padding: 0; margin: 0; color: #0084B4;">'+arrayUserOrder[cont2131][5]+'</h6>';
						arrayUsersHtml += '</div>';
						arrayUsersHtml += '<div class="col-xs-4 text-center">';
							arrayUsersHtml += '<h6 style="font: 400 15px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Following</h6>';
							arrayUsersHtml += '<h6 style="font: 600 14px/16px Roboto,sans-serif  !important; padding: 0; margin: 0; color: #0084B4;">'+arrayUserOrder[cont2131][7]+'</h6>';
							
						arrayUsersHtml += '</div>';
						arrayUsersHtml += '<div class="col-xs-4 text-center">';
							arrayUsersHtml += '<h6 style="font: 400 15px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Followers</h6>';
							arrayUsersHtml += '<h6 style="font: 600 14px/16px Roboto,sans-serif  !important; padding: 0; margin: 0; color: #0084B4;">'+arrayUserOrder[cont2131][6]+'</h6>';
						arrayUsersHtml += '</div>';
					  arrayUsersHtml += ' </div>';
					arrayUsersHtml += '</div><!--fin row-->';
				  arrayUsersHtml += '</div><!--col-xs-5-->';
				arrayUsersHtml += '</div><!--col-xs-7-->';
			  arrayUsersHtml += '</div><!--fin row-->';
			arrayUsersHtml += '</div><!--fin container-->';
		  arrayUsersHtml += '</div><!--colorEven row-->';
		  }//fin if
	}//fin for
					      arrayUsersHtml += '<div style="height: 50px; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); background-color: #FFFFFF;" class="row">';
						    arrayUsersHtml += '<div class="col-xs-12">';
							  arrayUsersHtml += '<nav><ul style="margin-top: 8px;" class="pagination">';
							  var next123 = parseInt(hoja)-1;
							  if(next123!=0){
						        arrayUsersHtml += '<li><a href="#" aria-label="Previous"><span onclick="continuarSS('+comilla+''+screenname+''+comilla+','+comilla+''+next123+''+comilla+','+comilla+''+option+''+comilla+');" aria-hidden="true">«</span></a></li>';
							  }
						      arrayUsersHtml += '<li><a style="padding: 0; margin: 0; padding-top: 4px; padding-bottom: 4px;" href="#"><input id="cont1Ant" style="border: 0px; width: 50px;" type="text" value="'+hoja+'"></a></li><li><a href="#">de</a></li><li><a style="padding: 0; margin: 0; padding-top: 4px; padding-bottom: 4px;" href="#"><input id="cont1Des" style="border: 0px; width: 50px;" type="text" value=""></a></li>';
							  var next123 = parseInt(hoja) +1;
						      arrayUsersHtml += '<li><a onclick="continuarSS('+comilla+''+screenname+''+comilla+','+comilla+''+next123+''+comilla+','+comilla+''+option+''+comilla+');" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>';
					      arrayUsersHtml += '</ul></nav>';
					    arrayUsersHtml += '</div>';
					  arrayUsersHtml += '</div>';
						  
	  $("#arrayUsersContent").html(arrayUsersHtml);
          $(".colorEven:even").css("background-color","#FFFFFF");
          $(".colorEven").hover(function(){
            $(this).css("background-color", "#f1f1f1");
          }, function(){
            $(".colorEven:odd").css("background-color","#FFFFFF");
            $(".colorEven:even").css("background-color","#FFFFFF");
          });
          if($('#palabraArrayUser').val().length==0){
          if(option==1){
	    var parametros = {screen_name:screenname.substr(1), option:"getTwitterSS"};
          } else {
	    var parametros = {screen_name:screenname.substr(1), option:"getTwitterNotFollowingMe", option2:option};
          } 
	    $.ajax({data:  parametros,
		    url:   "twitter/thread-tw.php",
		    type:  "GET",
		    success:  function (response) {
		      obj = JSON.parse(response);
		      if(obj.cursor==null && obj.hojaNumber<100){
                        if(obj.hojaNumber<100){
			  document.getElementById('cont1Des').value=1;
                        } else {
			document.getElementById('cont1Des').value=parseInt((obj.hojaNumber/100));
                        }
		      } else {
                        if(obj.hojaNumber<100){
			  document.getElementById('cont1Des').value=1;
                        } else {
			  document.getElementById('cont1Des').value=parseInt((obj.hojaNumber/100)+1); 
                        }
		      }
		    }, error: function (response){
		    }
	    });
          } else {
            buscarArraUser();
          }
}
function continuarSS(screenname, hoja, option){
  if(contVer==0){
    getDetails(screenname,2);
	hojaBack = hoja;
	screennameBack = screenname;
	optionBack = option;
    $('#loadingModal').modal('show');
    $('#arrayUsersModal').modal('hide');
        if(document.getElementById('userSS').value.substr(0,1)=="@")
	  var userSS = document.getElementById('userSS').value.substr(1);
        else
          var userSS = document.getElementById('userSS').value;
	if((userSS.length>1 && userSS.indexOf(" ")==-1) || option!=1){
	  if(option==1){
	    var url123asd =  "twitter/get-followers-other.php";
	    var parametros = { screen_name:screenname.substr(1), other:userSS, hoja:hoja};
	  }
	  if(option!=1){
	    var url123asd =  "twitter/get-notFollowingMe.php";
	    var parametros = { screen_name:screenname.substr(1), hoja:hoja, option:option};
	  }
	  $.ajax({  data: parametros,
	            url: url123asd,
				type: "GET",
				success: function (response) {
				  if(response=="Rate limit exceeded"){
				    toastr["error"](txt204, "ERROR");
				  } else if(JSON.parse(response).fin=="fin"){
				    toastr["error"](txt205, "ERROR");
				  } else if(response=="No user matches for specified terms"){
				    toastr["error"](txt206, "ERROR");
				  } else if(response=="[]"){
                                    if(hoja==1){
                                      toastr["error"](txt207, "ERROR");
                                    } else {
                                      toastr["error"](txt205, "ERROR");
                                    }
				  } else if(response!=""){
				    obj = JSON.parse(response);
                                          $(".ui-dialog-titlebar-close").show();
					  $("#arrayUsersModal").modal('show');
                                          if(option==1)                                                       
					    $("#arrayUsersModalLabel").html(txt208+ '' + userSS + '' +txt209+ '' +window[""+screenname+"SS"]);
                                          else
					    $("#arrayUsersModalLabel").html(txt516 + ": " +window[""+screenname+"NotFollowingMe"]);                                          
					  var arrayUsersHtml = '';
					  	  arrayUsersHtml += '<div style="height: 50px; margin-bottom: 4px; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); background-color: #FFFFFF;" class="row">';
						    arrayUsersHtml += '<div style="margin-top: 14px;" class="col-xs-12">';
							  arrayUsersHtml += '<select onchange="selectFiltro('+comilla+''+screenname+''+comilla+', '+comilla+''+hoja+''+comilla+', '+comilla+''+option+''+comilla+');" id="option124e">';
							    arrayUsersHtml += '<option>';
								  arrayUsersHtml += 'Ordenar Por:';
								arrayUsersHtml += '</option>';
							    arrayUsersHtml += '<option value="1">';
								  arrayUsersHtml += 'Ubicación';
								arrayUsersHtml += '</option>';
								arrayUsersHtml += '<option value="2">';
								  arrayUsersHtml += 'Último Tweet';
								arrayUsersHtml += '</option>';
								arrayUsersHtml += '<option value="3">';
								  arrayUsersHtml += 'Idioma';
								arrayUsersHtml += '</option>';
								arrayUsersHtml += '<option value="5">';
								  arrayUsersHtml += 'Tweets';
								arrayUsersHtml += '</option>';
								arrayUsersHtml += '<option value="6">';
								  arrayUsersHtml += 'Followers';
								arrayUsersHtml += '</option>';
								arrayUsersHtml += '<option value="7">';
								  arrayUsersHtml += 'Following';
								arrayUsersHtml += '</option>';
							  arrayUsersHtml += '</select>';
					  	    arrayUsersHtml += '</div>';
						  arrayUsersHtml += '</div>';	
						  						
					      arrayUsersHtml += '<div id="tableUsersFollow" class="col-xs-12">';
						    arrayUsersHtml += '<div class="row">';

					arrayUserOrder = new Array();
				    for(var cont2131=0; cont2131<obj.length; cont2131++){
						  //console.log(contTabla+cont2131 + " " + cont2131);
					      if(obj[cont2131].screen_name!=null && obj[cont2131].protected==false){
							arrayUserOrder[cont2131] = new Array();
							arrayUserOrder[cont2131][0] = obj[cont2131].following;
							arrayUserOrder[cont2131][1] = obj[cont2131].screen_name;
							arrayUserOrder[cont2131][2] = obj[cont2131].profile_image_url;
							arrayUserOrder[cont2131][3] = obj[cont2131].location;
							if(obj[cont2131].status){
							  arrayUserOrder[cont2131][4] = obj[cont2131].status.created_at;
							}
							arrayUserOrder[cont2131][5] = obj[cont2131].statuses_count;
							arrayUserOrder[cont2131][6] = obj[cont2131].followers_count;
							arrayUserOrder[cont2131][7] = obj[cont2131].friends_count;
							arrayUserOrder[cont2131][8] = obj[cont2131].lang;
							arrayUserOrder[cont2131][9] = obj[cont2131].verified;
							arrayUserOrder[cont2131][10] = obj[cont2131].description.replace(",", "");
							arrayUserOrder[cont2131][11] = obj[cont2131].protected;
							
							arrayUsersHtml += '<div class="colorEven row" style="box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); margin-bottom: 4px; height: 125px;">';
							  arrayUsersHtml += '<div class="container-fluid col-xs-12">';
	  						    arrayUsersHtml += '<div class="row">';
								  arrayUsersHtml += '<div class="col-xs-12">';
									arrayUsersHtml += '<div class="col-xs-4" style="margin-top: 1em; text-align: center;">';
									  arrayUsersHtml += '<div class="row">';
									    arrayUsersHtml += '<img src="'+arrayUserOrder[cont2131][2]+'" class="img-circle" style="box-shadow: rgba(0, 0, 0, 0.137255) 0px 2px 2px 0px, rgba(0, 0, 0, 0.2) 0px 3px 1px -2px, rgba(0, 0, 0, 0.117647) 0px 1px 5px 0px; width: 40px"><br />';
									    /*arrayUsersHtml += '<h6 style="font-family: Helvetica,Arial,sans-serif; padding: 0; margin: 0; font-weight: bold;">@'+arrayUserOrder[cont2131][8]+'</h6>';*/
									    if(arrayUserOrder[cont2131][3])
									      arrayUsersHtml += '<h6 style="padding: 10px 0 0 0; font: 400 12px/16px Roboto,sans-serif !important; margin: 0;" class="hidden-xs">'+utf8_decode(arrayUserOrder[cont2131][3].substring(0,23))+'</h6>';
									    else
									      arrayUsersHtml += '<h6 style="padding-top: 10px; font: 400 12px/16px Roboto,sans-serif !important; margin: 0;" class="hidden-xs">Sin Ubicación</h6>';
									  arrayUsersHtml += '</div>';
									  arrayUsersHtml += '<div style="padding-left: 30px; padding-right: 30px; margin-top: 10px;" id="BS'+(contTabla+cont2131)+'" class="row">';
									    if(arrayUserOrder[cont2131][0]=="BlackList"){
		                                  arrayUsersHtml += '<a style="font: 400 16px/16px Roboto,sans-serif  !important;  margin-top: 10px; cursor: pointer;" onclick="bajarS();">'+txt517+'</a>';
									    } else if(arrayUserOrder[cont2131][0]==true && option==1){
										  arrayUsersHtml += '<a style="font: 400 16px/16px Roboto,sans-serif  !important; margin-top: 10px; cursor: pointer;" onclick="bajarS();">'+txt203+'</a>';
									    } else if(option==1) {
										  arrayUsersHtml += '<button style="margin-top: 0px;" onclick="seguirTw('+comilla+''+screenname+''+comilla+','+comilla+''+arrayUserOrder[cont2131][1]+''+comilla+','+comilla+'BS'+(contTabla+cont2131)+''+comilla+');" class="btn btn-success btn-xs">'+txt298+'</button>';
									    } else if(arrayUserOrder[cont2131][0]==true && option!=1){
										  arrayUsersHtml += '<button style="margin-top: 0px;" onclick="dejaSeguirTw('+comilla+''+screenname+''+comilla+','+comilla+''+arrayUserOrder[cont2131][1]+''+comilla+','+comilla+'BS'+(contTabla+cont2131)+''+comilla+');" class="btn btn-danger btn-xs">- Unfollow</button>';
									    } else {
								          arrayUsersHtml += '<a style="margin-top: 20px; cursor: pointer;" onclick="bajarS();">'+txt515+'</a>';
									    }  
								  arrayUsersHtml += '</div><!--class row-->';
								arrayUsersHtml += '</div><!--col-xs-4-->';
								arrayUsersHtml += '<div class="col-xs-8">';
								  arrayUsersHtml += '<div class="row">';
									arrayUsersHtml += '<div class="col-xs-12">';
									  arrayUsersHtml += '<h6 style="margin-bottom: 0; font: 600 14px/16px Roboto,sans-serif  !important; padding-left: 0; margin-left: 0;" class="col-xs-6 text-left">@'+arrayUserOrder[cont2131][1]+'</h6>';
									    arrayUsersHtml += '<h6 style="margin-bottom: 0; font: 400 14px/16px Roboto,sans-serif  !important; color: #777;" class="col-xs-6 text-right">';
										if(!obj[cont2131].status || arrayUserOrder[cont2131][4]==null){
									      arrayUsersHtml += 'N/A';
										} else {
										  var rel = relative_time(arrayUserOrder[cont2131][4]);
										  if(rel!="fi und"){
										    arrayUsersHtml += ''+rel+'';
										  } else {             
										    arrayUsersHtml += txt210;
										  }                        
										}
									    arrayUsersHtml += '</h6>';
									  arrayUsersHtml += '</div>';
									arrayUsersHtml += '</div>';
									arrayUsersHtml += '<div style="margin-top: 5px; height: 50px;" class="row">';
										arrayUsersHtml += '<div class="hidden-xs col-xs-12 text-left">';
										if(arrayUserOrder[cont2131][10])
										  arrayUsersHtml += '<h6 style="font: 400 12px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">'+utf8_decode(arrayUserOrder[cont2131][10].replace(",", "").substring(0,100))+'</h6>';
										else
										  arrayUsersHtml += '<h6 style="font: 400 12px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Sin Descripción</h6>';
										arrayUsersHtml += '</div>';
									arrayUsersHtml += '</div>';
									arrayUsersHtml += '<div class="row">';
									  arrayUsersHtml += '<div class="col-xs-12">';
										arrayUsersHtml += '<div class="col-xs-4 text-center">';
											arrayUsersHtml += '<h6 style="font: 400 15px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Tweets</h6>';
											arrayUsersHtml += '<h6 style="font: 600 14px/16px Roboto,sans-serif  !important; padding: 0; margin: 0; color: #0084B4;">'+arrayUserOrder[cont2131][5]+'</h6>';
										arrayUsersHtml += '</div>';
										arrayUsersHtml += '<div class="col-xs-4 text-center">';
											arrayUsersHtml += '<h6 style="font: 400 15px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Following</h6>';
											arrayUsersHtml += '<h6 style="font: 600 14px/16px Roboto,sans-serif  !important; padding: 0; margin: 0; color: #0084B4;">'+arrayUserOrder[cont2131][7]+'</h6>';
											
										arrayUsersHtml += '</div>';
										arrayUsersHtml += '<div class="col-xs-4 text-center">';
											arrayUsersHtml += '<h6 style="font: 400 15px/16px Roboto,sans-serif  !important; padding: 0; margin: 0;">Followers</h6>';
											arrayUsersHtml += '<h6 style="font: 600 14px/16px Roboto,sans-serif  !important; padding: 0; margin: 0; color: #0084B4;">'+arrayUserOrder[cont2131][6]+'</h6>';
										arrayUsersHtml += '</div>';
									  arrayUsersHtml += ' </div>';
								    arrayUsersHtml += '</div><!--fin row-->';
								  arrayUsersHtml += '</div><!--col-xs-5-->';
							    arrayUsersHtml += '</div><!--col-xs-7-->';
						      arrayUsersHtml += '</div><!--fin row-->';
						    arrayUsersHtml += '</div><!--fin container-->';
                          arrayUsersHtml += '</div><!--colorEven row-->';
						  }//fin if
					}//fin for
					contTabla = cont2131;
					      arrayUsersHtml += '<div style="height: 50px; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); background-color: #FFFFFF;" class="row">';
						    arrayUsersHtml += '<div class="col-xs-12">';
							  arrayUsersHtml += '<nav><ul style="margin-top: 8px;" class="pagination">';
							  var next123 = parseInt(hoja)-1;
							  if(next123!=0){
						        arrayUsersHtml += '<li><a href="#" aria-label="Previous"><span onclick="continuarSS('+comilla+''+screenname+''+comilla+','+comilla+''+next123+''+comilla+','+comilla+''+option+''+comilla+');" aria-hidden="true">«</span></a></li>';
							  }
						      arrayUsersHtml += '<li><a style="padding: 0; margin: 0; padding-top: 4px; padding-bottom: 4px;" href="#"><input id="cont1Ant" style="border: 0px; width: 50px;" type="text" value="'+hoja+'"></a></li><li><a href="#">de</a></li><li><a style="padding: 0; margin: 0; padding-top: 4px; padding-bottom: 4px;" href="#"><input id="cont1Des" style="border: 0px; width: 50px;" type="text" value=""></a></li>';
							  var next123 = parseInt(hoja) +1;
						      arrayUsersHtml += '<li><a onclick="continuarSS('+comilla+''+screenname+''+comilla+','+comilla+''+next123+''+comilla+','+comilla+''+option+''+comilla+');" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>';
					      arrayUsersHtml += '</ul></nav>';
					    arrayUsersHtml += '</div>';
					  arrayUsersHtml += '</div>';
						  
					      $("#arrayUsersContent").html(arrayUsersHtml);
                                              $(".colorEven:even").css("background-color","#FFFFFF");
	                                      $(".colorEven").hover(function(){
	                                        $(this).css("background-color", "#f1f1f1");
	                                      }, function(){
	                                        $(".colorEven:odd").css("background-color","#FFFFFF");
	                                        $(".colorEven:even").css("background-color","#FFFFFF");
	                                      });
                                              /*get hoja*/
                                              if($('#palabraArrayUser').val().length==0){
                                                if(option==1){
					          var parametros = {screen_name:screenname.substr(1), option:"getTwitterSS"};
                                                } else {

					          var parametros = {screen_name:screenname.substr(1), option:"getTwitterNotFollowingMe", option2:option};
                                                }                                                                                                         
					        $.ajax({data:  parametros,
							url:   "twitter/thread-tw.php",
							type:  "GET",
							success:  function (response) {
							  obj = JSON.parse(response);
							  if(obj.cursor==null && obj.hojaNumber<100){
										if(obj.hojaNumber<100){
							  document.getElementById('cont1Des').value=1;
										} else {
							  document.getElementById('cont1Des').value=parseInt((obj.hojaNumber/100));
										}
							  } else {
								if(obj.hojaNumber<100){
					  		      document.getElementById('cont1Des').value=1;
								} else {
								  document.getElementById('cont1Des').value=parseInt((obj.hojaNumber/100)+1);
								}
							  }
							},
							error: function (response){
							}
					        });
                                              } else {
                                                buscarArraUser();
                                              }
				  } else {

				    toastr["error"](txt205, "ERROR");
				    document.getElementById('cont1Des').value = document.getElementById('cont1Ant').value
				  }
				  var arrayUsers = document.getElementById('arrayUsers');
				  $("#modal-body").scrollTop(0);
				  $("#cargando").dialog("close");
                                  $(".ui-dialog-titlebar-close").show();
				  $('#loadingModal').modal('hide');
                                  $('#arrayUsersModal').modal('show');
				},
				error: function (response){

				  toastr["error"](txt92);
                                  $("#cargando").dialog("close");
                                  $(".ui-dialog-titlebar-close").show();
				  $('#loadingModal').modal('hide');
                                  $('#arrayUsersModal').modal('show');
				}
				
	  });
	} else {
          $("#cargando").dialog("close");
	  toastr["warning"](txt214);
	}
  } else {
     toastr["warning"]("Espere a que se termine de seguir o de dejar de seguir a los usuarios");
  }
}
/*
var terminarDejarde = 0;
function dejaDeSeguirStart(screenname,option){
          if(terminarDejarde==0){
            toastr["info"](txt485);
            openDialog();
	    $.ajax({url: "twitter/thread-tw.php?screen_name="+screenname.substr(1)+"&option=spam&spam=3",
		  type: "GET",
                  cache: false,
		  success: function(response) {
                  }, error: function(response){
                  }
            });
          }
          terminarDejarde++;
	  $.ajax({url: "twitter/thread-tw.php?screen_name="+screenname.substr(1)+"&option=unFollowingMe&quitar="+option,
		  type: "GET",
                  cache: false,
		  success: function(response) {

	                  obj = JSON.parse(response);
	
			  if(obj.status=="success"){
                              if(option==1){
				var parametros = { screen_name:screenname.substr(1) };
				$.ajax({    data:  parametros,
							url:   "scripts/get-twitter-numberNotFollowingMe.php",
							type:  "post",
                                                        cache: false,
							success:  function (response) {
							  if(response>0){
								$('#numNotFollowingMe').html(response);
								dejaDeSeguirStart(screenname,option);
							  } else {
							    $('#numNotFollowingMe').html('<center><font color="green">'+response+'</font></center>');
							    toastr["info"](txt211);

                                                            terminarDejarde = 0;
			                                    $("#cargando").dialog("close");
							  }
							},
							error: function (response){
							  toastr["error"](txt92);
			                                  $("#cargando").dialog("close");
							}
				});
                              } else if(option==2){
                                if($("#siguiendoBots").html()-200>0){
                                  $("#siguiendoBots").html($("#siguiendoBots").html()-200); 
                                  dejaDeSeguirStart(screenname,option);
                                } else {
                                  $("#siguiendoBots").html("0");
                                  toastr["info"](txt211);
                                  terminarDejarde = 0;
			          $("#cargando").dialog("close");
                                }
                              } else if(option==3){
                                if($("#siguiendoInactivas").html()-200>0){
                                  $("#siguiendoInactivas").html($("#siguiendoInactivas").html()-200); 
                                  dejaDeSeguirStart(screenname,option);
                                } else {
                                  $("#siguiendoInactivas").html("0");
                                  toastr["info"](txt211);
                                  terminarDejarde = 0;
			          $("#cargando").dialog("close");
                                }
                              } else if(option==4){
                                if($("#siguiendoImages").html()-200>0){
                                  $("#siguiendoImages").html($("#siguiendoImages").html()-200); 
                                  dejaDeSeguirStart(screenname,option);
                                } else {
                                  $("#siguiendoImages").html("0");
                                  toastr["info"](txt211);
                                  terminarDejarde = 0;
			          $("#cargando").dialog("close");
                                }
                              }
			  } else {
				$("#cargando").dialog("close");
				$("#numNotFollowingMe").html('<center><font color="red">'+txt92+'</font></center>');
			  }
			},
			error: function (response) {
				$("#cargando").dialog("close");
				$("#numNotFollowingMe").html('<center><font color="red">'+txt92+'</font></center>');
			}
	});
}
*/
function deleteDm(screenname){
            toastr["info"](txt485);
	    openDialog();
	    $.ajax({url: "twitter/thread-tw.php?screen_name="+screenname.substr(1)+"&option=spam&spam=2",
		  type: "GET",
                  cache: false,
		  success: function(response) {
                  }, error: function(response){
                  }
            });            
            $.ajax({		url:   "twitter/thread-tw.php?option=delDms&screen_name="+screenname.substr(1),
						type:  "GET",
						success:  function (response) {
						  $("#cargando").dialog("close");
						  toastr["info"](txt211);
						},
						error: function (response){
						  $("#cargando").dialog("close");
					          toastr["error"](txt92);
						}
            });
}
/*
function bigFollow(){
	if(document.getElementById('geneSeguiUser').value1!="" &&
	   document.getElementById('geneSeguiPass').value!=""){
		openDialog();
		var parametros = { username:document.getElementById('geneSeguiUser').value, 
						   password:document.getElementById('geneSeguiPass').value,
						   uf:'df'};
		$.ajax({	data:  parametros,
					url:   "http://www.bigfollow.net/ganhar-seguidores/sistema.php",
					type:  "post",
					success:  function (response) {
					  $("#cargando").dialog("close");
					  toastr["info"](txt211);
					} , error: function(response){
				      $("#cargando").dialog("close");
					  toastr["error"](txt92);
					}
		});
	} else {
          toastr["warning"]("Completa Todos Los campos");
	}
}
*/
function getAutoDmDetails(screenname){
$.ajax({	url:   "twitter/get-AutoDmDetails.php?screen_name="+screenname,
			type:  "post",
			success:  function (response) {
                          obj = JSON.parse(response);
			  if(obj.error!="false"){
 				if(obj.active!="null" && obj.active[0]!="" && 
				    obj.active!="0" && obj.active[0]!="NULL")
				  document.getElementById("autoDMActivate").checked = true;
				if(obj.dm!="" && obj.dm!="null" && obj.dm!="NULL")
				  document.getElementById("comparteDm").value = obj.dm;
				  document.getElementById("contadorDm").value=charTool-document.getElementById("comparteDm").value.length;
			  } else {
                          }
			},
			error: function (response){
			}
});
}
function saveAutoDm(screenname){
	if(document.getElementById("contadorDm").value==charTool){
	  toastr["warning"](txt67);
	} else if(document.getElementById("contadorDm").value>=0){
		if(document.getElementById("autoDMActivate").checked==true)
		  var activateDM = 1;
		else
		  var activateDM = 0;

		var parametros = { activate:activateDM, DM:document.getElementById("comparteDm").value};
		$.ajax({    data:  parametros,
					url:   "twitter/post-AutoDmDetails.php?screen_name="+screenname,
					type:  "post",
					success:  function (response) {
					  toastr["success"](txt194);
					  getAutoDmDetails(screenname);
					},
					error: function (response){
					  toastr["error"](txt92);
					}
		});
	} else {
		toastr["warning"](txt193);
	}
}
function comparteDm()
{ if(document.getElementById("comparteDm").value==txt215)
   document.getElementById("comparteDm").value="";
  var elem = document.getElementById("contadorDm");
  elem.style.color = "white";
}
function teclasDm()
{ var contador = document.getElementById("comparteDm").value;
  document.getElementById("contadorDm").value=charTool-contador.length;
  if(charTool-contador.length<0)
  { var elem = document.getElementById("contadorDm");
	elem.style.color = "red";
  }
  else
  { var elem = document.getElementById("contadorDm");
	elem.style.color = "white";
  }
}
function findFriendship(screenname){
  if(screenname.substr(0,1)=="@")
    var screen_name123 = screenname.substr(1);
  else
    var screen_name123 = screenname.val();
  if($("#source_screen_name").val().substr(0,1)=="@")
    var source123 = $("#source_screen_name").val().substr(1);
  else
    var source123 = $("#source_screen_name").val();
  if($("#target_screen_name").val().substr(0,1)=="@")
    var target123 = $("#target_screen_name").val().substr(1);
  else
    var target123 = $("#target_screen_name").val();
  openDialog();
  $.ajax({  url:   "twitter/get-friendship.php?screen_name="+screen_name123+"&source_screen_name="+source123+"&target_screen_name="+target123,
					type:  "post",
					success:  function (response) {
                                          //falta validar seguimiento
                                          obj = JSON.parse(response);
                                          if(obj.relationship){
                                            var d2323ew = obj.relationship;
                                            if(d2323ew.source.following==true){
                                              $("#contentFriendship").html('<img style="display: inline-block;" src="images/palomaTools.png"><p style="display: inline-block; color: white;">'+d2323ew.source.screen_name+'</p> <p style="display: inline-block; color: green;"> Sigue a</p> <p style="display: inline-block; color: white;"> '+d2323ew.target.screen_name+'</p><br />');
                                            } else {
                                              $("#contentFriendship").html('<img style="display: inline-block;" src="images/tacheTools.png"><p style="display: inline-block; color: white;">'+d2323ew.source.screen_name+'</p> <p style="display: inline-block; color: red;"> No Sigue</p> <p style="display: inline-block; color: white;"> a '+d2323ew.target.screen_name+'</p><br />');
                                            }
                                            if(d2323ew.target.following==true){
                                              $("#contentFriendship").append('<img style="display: inline-block;" src="images/palomaTools.png"><p style="display: inline-block; color: white;">'+d2323ew.target.screen_name+'</p> <p style="display: inline-block; color: green;"> Sigue a</p> <p style="display: inline-block; color: white;"> '+d2323ew.source.screen_name+'</p>');
                                            } else {
                                              $("#contentFriendship").append('<img style="display: inline-block;" src="images/tacheTools.png"><p style="display: inline-block; color: white;">'+d2323ew.target.screen_name+'</p> <p style="display: inline-block; color: red;"> No Sigue</p> <p style="display: inline-block; color: white;">a '+d2323ew.source.screen_name+'</p> ');
                                            }
                                            //screen_name:"codelogman", following:true, followed_by:true
                                          } else {
                                            toastr["error"](obj.errors[0].message, "ERROR");
                                          } 
                                          $("#cargando").dialog("close");
			                },
					error: function (response) {
                                          toastr["error"](txt92);
                                          $("#cargando").dialog("close");
					}
  });
  
}
function getDetails(screenname,option){
            $.ajax({		url:   "twitter/thread-tw.php?id_token="+id_token+"&option=details&screen_name="+screenname.substr(1)+"&options="+option,
						type:  "GET",
						success:  function (response) {
                                                  obj = JSON.parse(response);                                  
                                                  $("#mostrarDetallesTools").css("display","block");
                                                  if(option==1){
						    $("#seguidoresTools123").html(obj.followers);
						    $("#siguiendoTools123").html(obj.following);
                                                  }
						  $("#limSiguiendoTools123").html(obj.following_limit + " - " + obj.top_following_limit);
						  $("#limiteUnfollowsTools123").html(obj.unfollowing_limit + " - " + obj.top_unfollowing_limit);
						},
						error: function (response){
						}
            });

}
function getTwitterTool1(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,screenname){
	/*$('#main-feed'+feedMain+'').html(loadStats);*/
	loadMaterial('main-feed'+feedMain+'','200px');
	$('#main-feed'+feedMain+'Text').html(txt286);
	var htmlTool = '';
	    htmlTool += '<div style="display: table-inline;" id="auto_dm">';
              htmlTool += '<div style="background-color: #3A8CE7; display: table-inline; width: 100%;">';
                htmlTool += '<img style="width: 10em;" src="images/ventana1Tools.png" />';
              htmlTool += '</div>';
              htmlTool += '<div style="background-color: #486586; display: table-inline; width: 100%;">';
                htmlTool += '<p style="font-size: 1em; color: #FFFFFF;">'+txt419+'</p>';
              htmlTool += '</div>';
	        htmlTool += '<textarea id="comparteDm" style="resize: none; width: 80%; height: 5em; margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px;" type="text" name="comparteDm" onkeyup="teclasDm()" onclick="comparteDm()">'+txt215+'</textarea><br />';
              htmlTool += '<div style="margin-top: 1em; display: table-inline; width: 100%;">';
		htmlTool += '<div style="cursor: pointer; vertical-align: top; cursor: pointer; display: inline-block; color: #FFFFFF; height: 1.7em; width: 4.0em; background: url('+comilla+'images/texto-escribir2.png'+comilla+') no-repeat center center;" onclick="helpEscribir('+comilla+'3'+comilla+','+comilla+'escribirNum'+comilla+');" title="Texto Escrito"><input onclick="helpEscribir('+comilla+'3'+comilla+','+comilla+'escribirNum'+comilla+');" id="contadorDm" type="text" disabled="disabled" name="contadorDm" value="'+charTool+'" style="margin-left: 1em; cursor: pointer; height: 25px; text-align: center; width: 35px; background-color: transparent; border: 0px none; color: white;" /></div>';
		htmlTool += '<div style="display: inline-block; margin-left:1em;"><input type="checkbox" id="autoDMActivate" name="autoDMActivate" value="autoDMActivate" /> '+txt287+'</div>';
              htmlTool += '</div>';
            htmlTool += '</div>';
		htmlTool += '<div style="vertical-align: middle; text-align: center;">';
                  htmlTool += '<div style="display: inline-block; width: 7em; text-align: center;"></div>';
                  htmlTool += '<button type="button" class="btn btn-success" onclick="saveAutoDm('+comilla+''+screenname.substr(1)+''+comilla+')" style="inline-block; vertical-align: middle; margin-top: 0.5em;">'+txt57+'</button>';
                  htmlTool += '<img style="display: inline-block; width: 7em; float: right; cursor: pointer;" onclick="helpEscribir('+comilla+'2'+comilla+','+comilla+'escribirNum'+comilla+');" src="images/tips.png" />';
		htmlTool += '</div>';
		htmlTool += '</div>';
	$('#main-feed'+feedMain+'').html(htmlTool);
	getAutoDmDetails(screenname.substr(1));
        $('.imgIcon'+feedMain+'').attr("src","images/iconoTools1.png");
        $('.imgIcon'+feedMain+'').css("width","1.55em");
}
function getTwitterTool2(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,screenname){
	/*$('#main-feed'+feedMain+'').html(loadStats);*/
	loadMaterial('main-feed'+feedMain+'','200px');
	$('#main-feed'+feedMain+'Text').html(txt217);
	var htmlTool = '';
        htmlTool += '<div style="background-color: #3A8CE7; display: table-inline; width: 100%;">';
          htmlTool += '<img style="width: 9.4em;" src="images/ventana2Tools.png" />';
        htmlTool += '</div>';
        htmlTool += '<div style="background-color: #486586; display: table-inline; width: 100%;">';
          htmlTool += '<p style="font-size: 1em; color: #FFFFFF;">'+txt197+'</p>';
        htmlTool += '</div>';
        htmlTool += '<button style="margin-bottom: 1em; margin-top: 1em;" class="btn btn-danger" onclick="deleteDm('+comilla+''+screenname+''+comilla+');"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+txt198+'</button><br /><div class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>';
		htmlTool += '';
	$('#main-feed'+feedMain+'').html(htmlTool);
        $('.imgIcon'+feedMain+'').attr("src","images/iconoTools2.png");
        $('.imgIcon'+feedMain+'').css("width","1.55em");
}
function getTwitterTool3(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,screenname){
	/*$('#main-feed'+feedMain+'').html(loadStats);*/
	loadMaterial('main-feed'+feedMain+'','200px');
	/*
	$('#main-feed'+feedMain+'Text').html("Generador De Seguidores");
	var htmlTool = '';
	    htmlTool += '<br />';
	    htmlTool += '<div style="display: table-inline;">';
	      htmlTool += '<div style="display: table-row;">';
		    htmlTool += '<div style="padding-left: 2em; text-align: left; width: 30%; display: table-cell;">';
	          htmlTool += 'Usuario: ';
			htmlTool += '</div>';
		    htmlTool += '<div style="padding-left: 2em; text-align: left; width: 70%; display: table-cell;">';
			  htmlTool += '<input id="geneSeguiUser" type="text" />';
		    htmlTool += '</div>';
		  htmlTool += '</div>';
		  htmlTool += '<div style="display: table-row;">';
	        htmlTool += '<div style="padding-left: 2em; text-align: left; width: 30%; display: table-cell;">';
		      htmlTool += 'Password: '; 
			htmlTool += '</div>';
			htmlTool += '<div style="padding-left: 2em; text-align: left; width: 70%; display: table-cell;">';
			  htmlTool += '<input id="geneSeguiPass" type="password" />';
		    htmlTool += '</div>';
		  htmlTool += '</div>';
		htmlTool += '</div>';
		  htmlTool += '<br /><button class="btn btn-success" onclick="bigFollow();">Conseguir Seguidores</button><br />';
		htmlTool += '<p style="text-align: left;"><br />No será posible si no fuera gracias a <a href="http://bigfollow.net">BigFollow</a><br /><br />Nota: Para mejor uso de éste servicio cambie su contraseña despues de utilizarlo.<br /><br />Bamboostr es una empresa la cuál se lleva por las mejores práticas de valores por la cual no almacena ni hace uso de datos confidenciales.</p>';
		htmlTool += '';
		*/
	var htmlTool = '';
        htmlTool += '<div style="background-color: #3A8CE7; display: table-inline; width: 100%;">';
          htmlTool += '<img style="width: 9.4em;" src="images/ventana3Tools.png" />';
        htmlTool += '</div>';
        htmlTool += '<div style="background-color: #486586; display: table-inline; width: 100%;">';
          htmlTool += '<p style="font-size: 1em; color: #FFFFFF;">'+txt473+'</p>';
        htmlTool += '</div>';
		htmlTool += '<div id="siguiendoBots" style="padding-right: 100px; padding-left: 100px; padding-bottom: 50px; padding-top: 40px; height: 110px; background: url('+comilla+'images/ventana4Tools.png'+comilla+') no-repeat center center; font-size: 2em; color: red; align: center;">'+loadStats+'</div>';
		htmlTool += '<!--<div style="display: block;"><button class="btn btn-danger" style="margin-top: 1em; margin-bottom: 1em;" id="button_tw" onclick="dejaDeSeguirStart('+comilla+''+screenname+''+comilla+',2);"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+txt218+'</button></div>-->';
		htmlTool += '<div style="display: block;"><button class="btn btn-danger" style="margin-top: 1em; margin-bottom: 1em;" id="button_tw" onclick="continuarSS('+comilla+''+screenname+''+comilla+',1,3)"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+txt514+'</button></div>';
		//htmlTool += '<div style="display: block;">En mantenimiento :(</div>';
		htmlTool += '';

        $('#main-feed'+feedMain+'Text').html(txt472);
	$('#main-feed'+feedMain+'').html(htmlTool);
	loadMaterial('siguiendoBots','200px');
    $('.imgIcon'+feedMain+'').attr("src","images/iconoTools3.png");
    $('.imgIcon'+feedMain+'').css("width","1.55em");

}
function getTwitterTool4(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,screenname){
	/*$('#main-feed'+feedMain+'').html(loadStats);*/
	loadMaterial('main-feed'+feedMain+'','200px');
	$('#main-feed'+feedMain+'Text').html(txt97.substr(9));
	var htmlTool = '';
        htmlTool += '<div style="background-color: #3A8CE7; display: table-inline; width: 100%;">';
          htmlTool += '<img style="width: 9.4em;" src="images/ventana3Tools.png" />';
        htmlTool += '</div>';
        htmlTool += '<div style="background-color: #486586; display: table-inline; width: 100%;">';
          htmlTool += '<p style="font-size: 1em; color: #FFFFFF;">'+txt413+'</p>';
        htmlTool += '</div>';
		htmlTool += '<div id="numNotFollowingMe" style="padding-right: 100px; padding-left: 100px; padding-bottom: 50px; padding-top: 40px; height: 110px; background: url('+comilla+'images/ventana4Tools.png'+comilla+') no-repeat center center; font-size: 2em; color: red; align: center;">'+loadStats+'</div>';
		htmlTool += '<!--<div style="display: block;"><button class="btn btn-danger" style="margin-top: 1em; margin-bottom: 1em;" id="button_tw" onclick="dejaDeSeguirStart('+comilla+''+screenname+''+comilla+',1)"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+txt218+'</button></div>-->';
		htmlTool += '<div style="display: block;"><button class="btn btn-danger" style="margin-top: 1em; margin-bottom: 1em;" id="button_tw" onclick="continuarSS('+comilla+''+screenname+''+comilla+',1,2)"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+txt514+'</button></div>';
		//htmlTool += '<div style="display: block;">En mantenimiento :(</div>';
		htmlTool += '';
	$('#main-feed'+feedMain+'').html(htmlTool);
    loadMaterial('numNotFollowingMe','200px');
	var parametros = { screen_name:screenname.substr(1) };
	$.ajax({    data:  parametros,
				url:   "scripts/get-twitter-numberNotFollowingMe.php",
				type:  "post",
				success:  function (response) {
				  $('#numNotFollowingMe').html(response);
				},
				error: function (response){
				  toastr["error"](txt92);
				}
	});
    $('.imgIcon'+feedMain+'').attr("src","images/iconoTools3.png");
    $('.imgIcon'+feedMain+'').css("width","1.55em");
}
function getTwitterTool5(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,screenname){
        window[""+screenname+"SS"] = 0;
        window[""+screenname+"NotFollowingMe"] = 0;
	/*$('#main-feed'+feedMain+'').html(loadStats);*/
	loadMaterial('main-feed'+feedMain+'','200px');
	$('#main-feed'+feedMain+'Text').html(txt195);
	var htmlTool = '';
        htmlTool += '<div style="background-color: #3A8CE7; display: table-inline; width: 100%;">';
          htmlTool += '<img style="width: 5.46em;" src="images/ventana5Tools.png" />';
        htmlTool += '</div>';
        htmlTool += '<div style="background-color: #486586; display: table-inline; width: 100%;">';
          htmlTool += '<p style="font-size: 1em; color: #FFFFFF;">'+txt414+'</p>';
        htmlTool += '</div>';
        htmlTool += '<div style="width: 100%; vertical-align: middle;">';
          htmlTool += '<p style="padding-left: 1em; width: 100%; color: #486586; text-align: left;">'+txt415+'</p>';
          htmlTool += '<div class="input-group">';
            htmlTool += '<span class="input-group-addon" id="basic-addon1">@</span>';
	    htmlTool += '<input style="cursor: text; width: 100%; align-text: left;" id="userSS" type="text" placeholder="Escribir Cuenta de Twitter" />';
          htmlTool += '</div>';
	  htmlTool += '<br /><button type="button" class="btn btn-success" style="margin-top: 1em; margin-bottom: 1em;" onclick="continuarSS('+comilla+''+screenname+''+comilla+','+comilla+'1'+comilla+','+comilla+'1'+comilla+');"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-search" aria-hidden="true"></span>'+txt200+'</button>';
	htmlTool += '</div>';
	$('#main-feed'+feedMain+'').html(htmlTool);
        $('.imgIcon'+feedMain+'').attr("src","images/iconoTools4.png");
        $('.imgIcon'+feedMain+'').css("width","1.55em");
}
function getTwitterTool6(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,screenname){
        window[""+screenname+"SSE"] = 0;
	var htmlTool = '';
        htmlTool += '<div style="background-color: #3A8CE7; display: table-inline; width: 100%;">';
          htmlTool += '<img style="width: 9.4em;" src="images/ventana3Tools.png" />';
        htmlTool += '</div>';
        htmlTool += '<div style="background-color: #486586; display: table-inline; width: 100%;">';
          htmlTool += '<p style="font-size: 1em; color: #FFFFFF;">'+txt475+'</p>';
        htmlTool += '</div>';
		htmlTool += '<div id="siguiendoInactivas" style="padding-right: 100px; padding-left: 100px; padding-bottom: 50px; padding-top: 40px; height: 110px; background: url('+comilla+'images/ventana4Tools.png'+comilla+') no-repeat center center; font-size: 2em; color: red; align: center;">'+loadStats+'</div>';
		htmlTool += '<!--<div style="display: block;"><button class="btn btn-danger" style="margin-top: 1em; margin-bottom: 1em;" id="button_tw" onclick="dejaDeSeguirStart('+comilla+''+screenname+''+comilla+',3);"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+txt218+'</button></div>-->';
		htmlTool += '<div style="display: block;"><button class="btn btn-danger" style="margin-top: 1em; margin-bottom: 1em;" id="button_tw" onclick="continuarSS('+comilla+''+screenname+''+comilla+',1,4)"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+txt514+'</button></div>';
		//htmlTool += '<div style="display: block;">En mantenimiento :(</div>';
		htmlTool += '';

	$('#main-feed'+feedMain+'Text').html(txt474);
	$('#main-feed'+feedMain+'').html(htmlTool);
	loadMaterial('siguiendoInactivas','200px');
    $('.imgIcon'+feedMain+'').attr("src","images/iconoTools3.png");
    $('.imgIcon'+feedMain+'').css("width","1.55em");
}
function getTwitterTool7(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,screenname){
	/*$('#main-feed'+feedMain+'').html(loadStats);*/
	loadMaterial('main-feed'+feedMain+'','200px');
	$('#main-feed'+feedMain+'Text').html(txt199);
	var htmlTool = '';
        htmlTool += '<div style="background-color: #3A8CE7; display: table-inline; width: 100%;">';
          htmlTool += '<img style="width: 5.46em;" src="images/ventana6Tools.png" />';
        htmlTool += '</div>';
        htmlTool += '<div style="background-color: #486586; display: table-inline; width: 100%;">';
          htmlTool += '<p style="font-size: 1em; color: #FFFFFF;">'+txt416+'</p>';
        htmlTool += '</div>';
        htmlTool += '<p style="padding-left: 1em; width: 100%; color: #486586; text-align: left;">'+txt417+'</p>';
        htmlTool += '<div class="input-group">';
            htmlTool += '<span class="input-group-addon" id="basic-addon1">@</span>';
	    htmlTool += '<input style="cursor: text; width: 100%; align-text: left;" id="source_screen_name" type="text" placeholder="Cuenta de Twitter" />';
        htmlTool += '</div>';
       htmlTool += '<p style="padding-left: 1em; width: 100%; color: #486586; text-align: left;">'+txt418+'</p>';
       htmlTool += '<div class="input-group">';
            htmlTool += '<span class="input-group-addon" id="basic-addon1">@</span>';
	    htmlTool += '<input style="cursor: text; width: 100%; align-text: left;" id="target_screen_name" type="text" placeholder="Cuenta de Twitter" />';

        htmlTool += '</div>';
                htmlTool += '<button style="margin-top: 0.5em;" class="btn btn-success" onclick="findFriendship('+comilla+''+screenname+''+comilla+')"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-search" aria-hidden="true"></span>'+txt200+'</button><br /><br />';
                htmlTool += '<div id="contentFriendship" style="background-color: #3A8CE7;"></div>';
	$('#main-feed'+feedMain+'').html(htmlTool);
    $('.imgIcon'+feedMain+'').attr("src","images/iconoTools5.png");
    $('.imgIcon'+feedMain+'').css("width","1.55em");
}
function getTwitterTool8(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,screenname){
	var htmlTool = '';
        htmlTool += '<div style="background-color: #3A8CE7; display: table-inline; width: 100%;">';
          htmlTool += '<img style="width: 9.4em;" src="images/ventana3Tools.png" />';
        htmlTool += '</div>';
        htmlTool += '<div style="background-color: #486586; display: table-inline; width: 100%;">';
          htmlTool += '<p style="font-size: 1em; color: #FFFFFF;">'+txt477+'</p>';
        htmlTool += '</div>';
		htmlTool += '<div id="siguiendoImages" style="padding-right: 100px; padding-left: 100px; padding-bottom: 50px; padding-top: 40px; height: 110px; background: url('+comilla+'images/ventana4Tools.png'+comilla+') no-repeat center center; font-size: 2em; color: red; align: center;">'+loadStats+'</div>';
		htmlTool += '<!--<div style="display: block;"><button class="btn btn-danger" style="margin-top: 1em; margin-bottom: 1em;" id="button_tw" onclick="dejaDeSeguirStart('+comilla+''+screenname+''+comilla+',4);"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+txt218+'</button></div>-->';
		htmlTool += '<div style="display: block;"><button class="btn btn-danger" style="margin-top: 1em; margin-bottom: 1em;" id="button_tw" onclick="continuarSS('+comilla+''+screenname+''+comilla+',1,5)"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-remove" aria-hidden="true"></span>'+txt514+'</button></div>';
		//htmlTool += '<div style="display: block;">En mantenimiento :(</div>';
		htmlTool += '';

	$('#main-feed'+feedMain+'Text').html(txt476);
	$('#main-feed'+feedMain+'').html(htmlTool);
	loadMaterial('siguiendoImages','200px');
    $('.imgIcon'+feedMain+'').attr("src","images/iconoTools3.png");
    $('.imgIcon'+feedMain+'').css("width","1.55em");
}
function getTwitterTool9(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,screenname){
	/*$('#main-feed'+feedMain+'').html(loadStats);*/
	loadMaterial('main-feed'+feedMain+'','200px');
	$('#main-feed'+feedMain+'Text').html(txt400);
        var mantenimientoHTML = '<img style="width: 18.5em;" src="images/mantenimiento.png" />';
	$('#main-feed'+feedMain+'').html(mantenimientoHTML);
        $('.imgIcon'+feedMain+'').attr("src","images/manIcon.png");
        $('.imgIcon'+feedMain+'').css("width","1.55em");
}