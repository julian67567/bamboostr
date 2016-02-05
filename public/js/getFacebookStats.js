function cleanMainsFa(){
  for(var aer=1; aer<=13; aer++){
    $("#main-feed"+aer+"").html("");
	$("#main-feed"+aer+"Text").html("");
	$("#main-feed"+aer+"Text").parent().parent().css("display","block");
        $("#main-feed"+aer).siblings().find(".acercaSR").attr('onclick','help('+comilla+''+aer+''+comilla+','+comilla+'faStatistics'+comilla+');');
  }
  for(var aer=10; aer<=15; aer++){
    $("#main-feed"+aer+"").html("");
    $("#main-feed"+aer+"Text").html("");
    $("#main-feed"+aer+"Text").parent().parent().css("display","none");
  }
}
function iniFaStats(identifyLocal,identifyOther,redLocal,imagenRed,tipo){
	cleanMainsFa();
        //getFacebookStatsGeneral(identifyLocal,identifyOther,redLocal,imagenRed,0,tipo);
	getFacebookStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,1,tipo);
	getFacebookStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,2,tipo);
	getFacebookStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,4,tipo);
	getFacebookStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,6,tipo);
	getFacebookStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,8,tipo);
	//no poner list dialog debido al tiempo de carga del total windows data-1
}
function getFacebookStatsGeneral(identifyLocal,identifyOther,redLocal,imagenRed,feedMain){
  var loadStats = '<div class="Knight-Rider-loader animate">';
         loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
	  loadStats += '</div>';
	$('#main-feed'+feedMain+'').html(loadStats);
        $('#main-feed'+feedMain+'').parent().css("background-color","#2E70B9");
        $('#main-feed'+feedMain+'').css("background-color","#2E70B9");
        $('#main-feed'+feedMain+'Text').html(txt220);
        $('.imgIcon'+feedMain+'').attr("src","images/iconoS0General.png");

        var htmlGeneralS = '';
           htmlGeneralS += '<div style="display: table; width: 100%;">';
             htmlGeneralS += '<div style="display: table-row;">';
               htmlGeneralS += '<div style="display: table-cell;">';
                 htmlGeneralS += '<p style="color: #FFFFFF; text-align: center;">'+txt387+'</p>';
               htmlGeneralS += '</div>';
             htmlGeneralS += '</div>';
           htmlGeneralS += '</div>';
           htmlGeneralS += '<div style="margin-top: 1em; display: table; width: 100%; text-align: center;">';
             htmlGeneralS += '<div style="display: table-row;">';
               htmlGeneralS += '<div style="display: table-cell; width: 100%;">';
                 htmlGeneralS += '<div style="display: table; width: 100%;">';
                   htmlGeneralS += '<div style="display: table-row;">';
                     htmlGeneralS += '<div style="display: table-cell;"></div>';
                     htmlGeneralS += '<div style="vertical-align: middle; text-align: center; height: 7.3em; width: 8.7em; background: url(images/generalProfileTop1.png); no-repeat center center; display: table-cell;">';
                       htmlGeneralS += '<img src="'+imagenRed+'">';
                     htmlGeneralS += '</div>';
                     htmlGeneralS += '<div style="vertical-align: top; text-align: center; height: 7.3em; width: 8.0em; background: url(images/generalProfileTop2.png); no-repeat center center; display: table-cell;">';
                       if(redLocal=="facebook")
                         htmlGeneralS += '<img style="margin-top: 0.25em; width: 3em;" src="images/f.png">';
                       else
                         htmlGeneralS += '<img style="margin-top: 0.25em; width: 3em;" src="images/t.png">';
                     htmlGeneralS += '<p style="margin-top: 2em; color: white;">'+txt361+'</p>';
                     htmlGeneralS += '</div>';
                     htmlGeneralS += '<div style="display: table-cell;"></div>';
                   htmlGeneralS += '</div>';
                 htmlGeneralS += '</div>';
               htmlGeneralS += '</div>';
             htmlGeneralS += '</div>';
           htmlGeneralS += '</div>';
           htmlGeneralS += '<div style="margin-top: 1em; display: table; width: 100%; text-align: center;">';
             htmlGeneralS += '<div style="display: table-row;  text-align: center;">';
               htmlGeneralS += '<div style="display: table; width: 100%;  text-align: center;">';
               for(var zxc128=1; zxc128<=5; zxc128++){
                 htmlGeneralS += '<div class="renglonG1" style="display: table-row; text-align: center;">';
                   htmlGeneralS += '<div style="width: 2em; display: table-cell;  text-align: center;">';
                     htmlGeneralS += '<img style="width: 2em;" id="imgIconG'+zxc128+'" src="images/statics.png" />';
                   htmlGeneralS += '</div>';
                   htmlGeneralS += '<div style="width: 5em; display: table-cell;  text-align: center;">';
                     htmlGeneralS += '<p id="dataIconG'+zxc128+'" style="color: #FFFFFF; text-align: center;"></p>';
                   htmlGeneralS += '</div>';
                   htmlGeneralS += '<div style="padding-left: 1em; display: table-cell;  text-align: left;">';
                     htmlGeneralS += '<p id="nameIconG'+zxc128+'" style="color: #FFFFFF; text-align: left;"></p>';
                   htmlGeneralS += '</div>';
                 htmlGeneralS += '</div>';
               }
               htmlGeneralS += '</div>';
             htmlGeneralS += '</div>';
           htmlGeneralS += '</div>';
        $('#main-feed'+feedMain+'').html(htmlGeneralS);
        $('.renglonG1:even').css("background-color","#ABC6E3");
}
function graficaDialogFacebook(option){
  $("#xchart").dialog("open");
  $("#stats").html("");
  $("#stats").css("height", 300);
  if(option==1)
    $("#xchart").dialog('option', 'title', txt229);
  else if(option==2)
    $("#xchart").dialog('option', 'title', txt230);
  else if(option==4)
    $("#xchart").dialog('option', 'title', txt231);
  else if(option==6)
    $("#xchart").dialog('option', 'title', txt232);
  else if(option==8)
    $("#xchart").dialog('option', 'title', txt233);
  else if(option==9)
    $("#xchart").dialog('option', 'title', txt100);
  $("#stats").css("height", 350);
  if(option!=10){
	$("#stats").css("width", 1200);
	var myChart = new xChart('line-dotted', window["data" + option], '#stats', opts);
  } else {
	$("#stats").css("width", 4000);
    var myChart = new xChart('bar', window["data" + option], '#stats');
  }
  $("#xchart").dialog('option', 'width', 1200);
  $("#xchart").dialog('option', 'width', 800);
  $("#xchart").dialog('option', 'height', 420);
}
function listDialogFacebook(identifyLocal,identifyOther,redLocal,imagenRed,feedMain){
    var parametros = { redP:red, redS:redLocal, identifyP:identify, identifyS:identifyLocal, identifyOther:identifyOther
			         };
	var loadStats = '<div class="Knight-Rider-loader animate">';
         loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
	  loadStats += '</div>';
	$('#main-feed'+feedMain+'').html(loadStats);
    if(feedMain==3)
	  var urlTw = "scripts/get-facebook-groups-name.php";
	if(feedMain==5)
	  var urlTw = "scripts/get-facebook-pages-name.php";
	if(feedMain==7)
	  var urlTw = "scripts/get-facebook-likes-name.php";
	if(feedMain==9)
	  var urlTw = "scripts/get-facebook-friendslists-name.php";
	$.ajax({    data:  parametros,
				url:   urlTw,
				type:  'GET',
				success:  function (response) {
					if(feedMain==3)
					  $('#main-feed'+feedMain+'Text').html(txt234);
					if(feedMain==5)
					  $('#main-feed'+feedMain+'Text').html(txt235);
					if(feedMain==7)
					  $('#main-feed'+feedMain+'Text').html(txt236);
					if(feedMain==9)
					  $('#main-feed'+feedMain+'Text').html(txt237);
					if(response.indexOf("FALSE")!="-1"){
						$('#main-feed'+feedMain+'').html(txt103);
					} else if(response==""){
						htmlRef = txt104;
						htmlRef += '<img style="width: 250px;" src="images/relojIcon.png" />';
						$('#main-feed'+feedMain+'').html(htmlRef);
					} else {
						//obtengo Datos
						var responseArray=response.split(",");
										                          
						  var htmlMain = '<div style="display: table; width: 100%;">';
						        htmlMain += '<div style="display: table-row; width: 100%;">';
								  htmlMain += '<div style="display: table-cell; width: 100%; text-align: center;">';
								    htmlMain += '<div style="display: inline-block; width: 100%; text-align: left; overflow: auto; height: 396px;">';
									if(feedMain==3){
									  var tempList = window["data" + (feedMain-1)];
									  tempList2 = tempList["main"][0]["data"];
									  htmlMain += '<center><a style="text-decoration:none; color: #428bca; font-size: 40px;">'+tempList2[tempList2.length-1]["y"]+'</a></center><br />';
									}
									if(feedMain==5){
									  htmlMain += '<center><a style="text-decoration:none; color: #428bca; font-size: 40px;">'+(responseArray.length-1)+'</a></center><br />';
									}
									if(feedMain==7){
									  htmlMain += '<center><a style="text-decoration:none; color: #428bca; font-size: 40px;">'+(responseArray.length-1)+'</a></center><br />';
									}
									if(feedMain==9){
									  htmlMain += '<center><a style="text-decoration:none; color: #428bca; font-size: 40px;">'+(responseArray.length-1)+'</a></center><br />';
									}
								      for(var i=0; i<responseArray.length-1; i++){
										responsePart = responseArray[i].split("|");
										if(feedMain!=9){
									      htmlMain += '<a style="cursor: pointer; text-decoration:none; color: #428bca;" target="_blank" href="http://facebook.com/'+responsePart[1]+'">';
										} else {
										  htmlMain += '<a style="cursor: pointer; text-decoration:none; color: #428bca;" target="_blank" href="http://facebook.com/lists/'+responsePart[1]+'">';
										}
										  htmlMain += ''+responsePart[0]+'';
										htmlMain += '</a><br />';
									  }
							       htmlMain += '</div>';
							     htmlMain += '</div>';
							   htmlMain += '</div>';
							 htmlMain += '</div>';
						$('#main-feed'+feedMain+'').html(htmlMain);
					}
				},
				error: function (response){
				    if(feedMain==3)
					  $('#main-feed'+feedMain+'Text').html(txt234);
					if(feedMain==5)
					  $('#main-feed'+feedMain+'Text').html(txt235);
					if(feedMain==7)
					  $('#main-feed'+feedMain+'Text').html(txt236);
					if(feedMain==9)
					  $('#main-feed'+feedMain+'Text').html(txt237);
					$('#main-feed'+feedMain+'').html(txt103);
				}
	});
}
function getFacebookStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,tipo){
var loadStats = '<div class="Knight-Rider-loader animate">';
         loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
	  loadStats += '</div>';
	if(feedMain==2){
	  $('#main-feed'+feedMain+'').html(loadStats);
	  $('#main-feed3').html(loadStats);
	} else if(feedMain==4){
	  $('#main-feed'+feedMain+'').html(loadStats);
	  $('#main-feed5').html(loadStats);
	} else if(feedMain==6){
	  $('#main-feed'+feedMain+'').html(loadStats);
	  $('#main-feed7').html(loadStats);
	} else if(feedMain==8){
	  $('#main-feed'+feedMain+'').html(loadStats);
	  $('#main-feed9').html(loadStats);
	} else {
	  $('#main-feed'+feedMain+'').html(loadStats);
	}
    var parametros = { redP:red, redS:redLocal, identifyP:identify, identifyS:identifyLocal, identifyOther:identifyOther
					 };
	if(feedMain==1)
	  var urlTw = "scripts/get-facebook-count-friends.php";
	else if(feedMain==2)
	  var urlTw = "scripts/get-facebook-groups.php";
	else if(feedMain==4)
	  var urlTw = "scripts/get-facebook-pages.php";
	else if(feedMain==6)
	  var urlTw = "scripts/get-facebook-likes-to-pages.php";
	else if(feedMain==8)
	  var urlTw = "scripts/get-facebook-friendslists.php";
	else if(feedMain==9)
	  var urlTw = "scripts/get-twitter-tus-favoritos.php";
	else if(feedMain==11)
      var urlTw = "scripts/get-twitter-send-dms.php";
	$.ajax({    data:  parametros,
				url:   urlTw,
				type:  'GET',
				success:  function (response) {
					if(feedMain==1){
					  $('#main-feed'+feedMain+'Text').html(txt229);
                                          $('#nameIconG1').html(txt229);
                                        }
					else if(feedMain==2){
					  $('#main-feed'+feedMain+'Text').html(txt230);
                                          $('#nameIconG2').html(txt230);
                                        }
					else if(feedMain==4){
					  $('#main-feed'+feedMain+'Text').html(txt231);
                                          $('#nameIconG3').html(txt231);
                                        }
					else if(feedMain==6){
					  $('#main-feed'+feedMain+'Text').html(txt232);
                                          $('#nameIconG4').html(txt232);
                                        }
					else if(feedMain==8){
					  $('#main-feed'+feedMain+'Text').html(txt233);
                                          $('#nameIconG5').html(txt233);
                                        }
					else if(feedMain==9){
					  $('#main-feed'+feedMain+'Text').html(txt100.substr(9));
                                        }
					if(response.indexOf("FALSE")!="-1"){
						$('#main-feed'+feedMain+'').html(txt105);
					} else if(response==""){
						htmlRef = txt104;
						htmlRef += '<img style="width: 250px;" src="images/relojIcon.png" />';
						$('#main-feed'+feedMain+'').html(htmlRef);
					} else {
						//obtengo Datos
						responseArray=response.split(",");
						responseArrayL = responseArray.length;
						var followers = new Array();
						for(var i=0; i<responseArrayL-1; i++){
						  responseArray2=responseArray[i].split("|");
						  responseArray3=responseArray2[1].split(":");
						  followers[i] = new Array();
						  followers[i]['num'] = parseInt(responseArray2[0]);
						  followers[i]['date'] = responseArray3[0];
						}
						//día
						if(responseArrayL>=3){
						  var dif = followers[responseArrayL-2]['num'] - followers[responseArrayL-3]['num'];
						  var diaIncremento = dif;
                                                  if(feedMain==1){
                                                    $("#dataIconG"+feedMain+"").html(diaIncremento);
                                                  }
                                                  if(feedMain==2){
                                                    $("#dataIconG"+feedMain+"").html(diaIncremento);
                                                  }
                                                  if(feedMain==4){
                                                    $("#dataIconG3").html(diaIncremento);
                                                  }
                                                  if(feedMain==6){
                                                    $("#dataIconG4").html(diaIncremento);
                                                  }
                                                  if(feedMain==8){
                                                    $("#dataIconG5").html(diaIncremento);
                                                  }
	                      var diaRendimiento = Math.log(followers[responseArrayL-2]['num']/followers[responseArrayL-3]['num']).toFixed(2);
						  if(isNaN(diaRendimiento)){
						    diaRendimiento = 0;
						  } 
						  diaRendimiento = diaRendimiento + "%";
						}
						else{
						  var diaIncremento = "N/A";
						  var diaRendimiento = "N/A";
						}
						//semana
						if(responseArrayL>=9){
						  var dif = followers[responseArrayL-2]['num'] - followers[responseArrayL-8]['num'];
						  var semIncremento = dif;
	                      var prom3ee3sem = 0;
						  for(var ewrqw12=3;  ewrqw12<=9;  ewrqw12++){
							  prom3ee3sem = prom3ee3sem + Math.log(followers[responseArrayL-(ewrqw12-1)]['num']/followers[responseArrayL-ewrqw12]['num']);
						  }
						  prom3ee3sem = prom3ee3sem/7;
	                      var semRendimiento = ((Math.pow(prom3ee3sem+1,7)-1)*100).toPrecision(2);
						  if(isNaN(semRendimiento)){
						    semRendimiento = 0;
						  }
						  semRendimiento = semRendimiento + "%";	
						} else {
						  var semIncremento = "N/A";
						  var semRendimiento = "N/A";
						}
						//mes
						if(responseArrayL>=32){
						  var dif = followers[responseArrayL-2]['num'] - followers[responseArrayL-30]['num'];
						  var mesIncremento = dif;
	                      var prom3ee3sem = 0;
						  for(var ewrqw12=3;  ewrqw12<=32;  ewrqw12++){
							  prom3ee3sem = prom3ee3sem + Math.log(followers[responseArrayL-(ewrqw12-1)]['num']/followers[responseArrayL-ewrqw12]['num']);
						  }
						  prom3ee3sem = prom3ee3sem/30;
	                      var mesRendimiento = ((Math.pow(prom3ee3sem+1,7)-1)*100).toPrecision(2);
						  if(isNaN(mesRendimiento)){
						    mesRendimiento = 0;
						  } 
						  mesRendimiento = mesRendimiento + "%";
						} else {
						  var mesIncremento = "N/A";
						  var mesRendimiento = "N/A";
						}
						//año
						if(responseArrayL>=362){
						  var dif = followers[responseArrayL-2]['num'] - followers[responseArrayL-365]['num'];
						  var anoIncremento = dif;
	                      var prom3ee3sem = 0;
						  for(var ewrqw12=3;  ewrqw12<=362;  ewrqw12++){
							  prom3ee3sem = prom3ee3sem + Math.log(followers[responseArrayL-(ewrqw12-1)]['num']/followers[responseArrayL-ewrqw12]['num']);
						  }
						  prom3ee3sem = prom3ee3sem/360;
	                      var anoRendimiento = ((Math.pow(prom3ee3sem+1,7)-1)*100).toPrecision(2);
						  if(isNaN(anoRendimiento)){
						    anoRendimiento = 0;
						  } 
						  anoRendimiento = anoRendimiento + "%";
						} else {
						  var anoIncremento = "N/A";
						  var anoRendimiento = "N/A";
						}
										                          
						  var htmlMain = '<div style="display: table; width: 100%;">';
							   htmlMain += '<div style="color: white; background-color: #2e70b9; display: table-row; width: 100%;">';
							     htmlMain += '<div style="text-align: left; display: table-cell; width: 50px;"></div>';
								 htmlMain += '<div title="'+txt106+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += 'D</div>';
								 htmlMain += '<div title="'+txt107+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += 'S</div>';
								 htmlMain += '<div title="'+txt108+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += 'M</div>';
								 htmlMain += '<div title="'+txt109+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += 'A</div>';
							   htmlMain += '</div>';
							   htmlMain += '<div style="border-bottom: 2px solid #2a3047; background-color: #D1D9E1; display: table-row; width: 100%;">';
								 htmlMain += '<div title="'+txt110+'" style="text-align: left; display: table-cell; width: 50px;">';
								 htmlMain += '<img src="images/incremento.png" /></div>';
						         htmlMain += '<div title="'+txt110+' '+txt106+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += ''+diaIncremento+'</div>';
								 htmlMain += '<div title="'+txt110+' '+txt111+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += ''+semIncremento+'</div>';
								 htmlMain += '<div title="'+txt110+' '+txt112+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += ''+mesIncremento+'</div>';
								 htmlMain += '<div title="'+txt110+' '+txt113+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += ''+anoIncremento+'</div>';
							   htmlMain += '</div>';
							   htmlMain += '<div style="background-color: #D1D9E1; display: table-row; width: 100%;">';
								 htmlMain += '<div title="'+txt114+'" style="text-align: left; display: table-cell; width: 50px;">';
								 htmlMain += '<img src="images/rendimiento.png" /></div>';
								 htmlMain += '<div title="'+txt114+' '+txt106+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += ''+diaRendimiento+'</div>';
								 htmlMain += '<div title="'+txt114+' '+txt111+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += ''+semRendimiento+'</div>';
								 htmlMain += '<div title="'+txt114+' '+txt112+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += ''+mesRendimiento+'</div>';
								 htmlMain += '<div title="'+txt114+' '+txt113+'" style="text-align: center; display: table-cell; width: 80px;">';
								 htmlMain += ''+anoRendimiento+'</div>';
							   htmlMain += '</div>';
							   htmlMain += '<div style="display: table-row; width: 100%;">';
							   htmlMain += '</div>';
							 htmlMain += '</div>';
							 htmlMain += '<div style="display: table; width: 100%;">';
							   htmlMain += '<div style="display: table-row; width: 100%;">';
								 htmlMain += '<div style="border-left: 5px solid #009966; border-bottom: 5px solid #006699; text-align: center; display: table-cell; width: 100%;">';
								   htmlMain += '<article onclick="graficaDialogFacebook('+comilla+''+feedMain+''+comilla+');" class="example">';
                                     htmlMain += '<figure style="padding-top: 10px; cursor: pointer; height: 15em; width: 25em;" id="main-feed'+feedMain+'StatsPre"></figure>';
                                   htmlMain += '</article>';
								 htmlMain += '</div>';
							   htmlMain += '</div>';
                                                         htmlMain += '</div>';
                                                         htmlMain += '<div style="display: table; width: 100%;">';
                                                           htmlMain += '<div style="display: table-row; width: 100%;">';
                                                             htmlMain += '<div style="text-align: left; display: table-cell; width: 100%;">';
                                                               htmlMain += '<div style="color: #1A3F68; display: table; width: 100%;">';
                                                                 htmlMain += '<div style="display: table-row; width: 100%;">';
                                                                   htmlMain += '<div style="background-color: #A3B2C3; text-align: center; display: table-cell; width: 5em;">';
                                                                     htmlMain += '<img src="images/simbologia.png" /><br />'+txt385+'';
                                                                   htmlMain += '</div>';
                                                                   htmlMain += '<div style="padding-left: 2em; background-color: #D1D9E1; text-align: left; display: table-cell; width: 7em;">';
                                                                     htmlMain += '<div style="display: table; width: 100%;">';
                                                                       htmlMain += '<div style="display: table-row; width: 100%;">';
                                                                         htmlMain += '<div style="border-bottom: 2px solid #2a3047; margin-left: 0.5em; text-align: left; display: table-cell;">';
                                                                           htmlMain += '<img style="margin-left: 0.4em; display: inline-block;" src="images/incremento2.png" /> <p style="display: inline-block;">'+txt110+'</p>';
                                                                         htmlMain += '</div>';
                                                                       htmlMain += '</div>';
                                                                       htmlMain += '<div style="display: table-row; width: 100%;">';
                                                                         htmlMain += '<div style="text-align: left; display: table-cell;">';
                                                                           htmlMain += '<img style="display: inline-block;" src="images/rendimiento2.png" />  <p style="display: inline-block;">'+txt114+'</p>';
                                                                         htmlMain += '</div>';
                                                                       htmlMain += '</div>';
                                                                     htmlMain += '</div>';
                                                                   htmlMain += '</div>';
                                                                   htmlMain += '<div style="background-color: #D1D9E1; text-align: center; display: table-cell; width: 4em;">';
                                                                     htmlMain += '<img style="width: 1.5em; display: inline-block;" class="imgIcon'+feedMain+'" />';
                                                                     htmlMain += '<img style="display: inline-block;" src="images/sim2.png" /><br />'+txt386+'';
                                                                   htmlMain += '</div>';
                                                                 htmlMain += '</div>';
                                                               htmlMain += '</div>';
                                                             htmlMain += '</div>';
							   htmlMain += '</div>';
							 htmlMain += '</div>';
						tt = document.createElement('div'),
						leftOffset = -(~~$('html').css('padding-left').replace('px', '') + ~~$('body').css('margin-left').replace('px', '')),
						topOffset = -32;
						tt.className = 'ex-tooltip';
					    document.body.appendChild(tt);
						
                        window["data"+feedMain] = {
						  "xScale": "time",
						  "yScale": "linear",
						  "main": [
							{ "className": ".grafica"
							}
						  ]
						};
						
						var fechaStats = '';
						window["data"+feedMain]["main"][0]["data"] = new Array();
						
						//grafica lo últimos 30 valores
						if(followers.length<30){
						  //si hay menos de 30 datos
						  var wertecsd=0;
						  var limitasad = followers.length;
						} else {
						  //si hay mas de 30 datos
						  var wertecsd=followers.length-30;
						  var limitasad = 30;
						}
						
						for(var i=0; i<limitasad; i++){
						  fechaStats = followers[wertecsd]["date"].split("-");
						  window["data"+feedMain]["main"][0]["data"][i] = new Object();
						  window["data"+feedMain]["main"][0]["data"][i]["x"] = ""+fechaStats[2]+"-"+fechaStats[1]+"-"+fechaStats[0]+"";
						  window["data"+feedMain]["main"][0]["data"][i]["y"] = followers[wertecsd]["num"];
						  wertecsd++;
						}
						
						if(feedMain==2){
						  listDialogFacebook(identifyLocal,identifyOther,redLocal,imagenRed,3);
						}
						if(feedMain==4){
						  listDialogFacebook(identifyLocal,identifyOther,redLocal,imagenRed,5);
						}
						if(feedMain==6){
						  listDialogFacebook(identifyLocal,identifyOther,redLocal,imagenRed,7);
						}
						if(feedMain==8){
						  listDialogFacebook(identifyLocal,identifyOther,redLocal,imagenRed,9);
						}
						opts = {  "dataFormatX": function (x) { return d3.time.format('%Y-%m-%d').parse(x); },
								  "tickFormatX": function (x) { return d3.time.format('%d-%m')(x); },
								  "mouseover": function (d, i) {
									var pos = $(this).offset();
									$(tt).text(d3.time.format('%d-%m-%Y')(d.x) + ' (' + d3.time.format('%A')(d.x) + ')' + ' : ' +d.y)
									  .css({top: topOffset + pos.top, left: pos.left + leftOffset})
									  .show();
								  },
								  "mouseout": function (x) {
									$(tt).hide();
								  }
								};
						$('#main-feed'+feedMain+'').html(htmlMain);
                                                if(feedMain==1){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS1Amigos.png");
                                                  $('#imgIconG'+feedMain+'').attr("src","images/iconoS1Amigos.png");
                                                }
                                                if(feedMain==2){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS2Grupos.png");
                                                  $('.imgIcon3').attr("src","images/iconoS2Grupos.png");
                                                  $('#imgIconG'+feedMain+'').attr("src","images/iconoS2Grupos.png");
                                                }
                                                if(feedMain==4){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS3Fans.png");
                                                  $('.imgIcon5').attr("src","images/iconoS3Fans.png");
                                                  $('#imgIconG3').attr("src","images/iconoS3Fans.png");
                                                }
                                                if(feedMain==6){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS4FansLikes.png");
                                                  $('.imgIcon7').attr("src","images/iconoS4FansLikes.png");
                                                  $('#imgIconG4').attr("src","images/iconoS4FansLikes.png");
                                                }
                                                if(feedMain==8){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS5ListaAmigos.png");
                                                  $('.imgIcon9').attr("src","images/iconoS5ListaAmigos.png");
                                                  $('#imgIconG5').attr("src","images/iconoS5ListaAmigos.png");
                                                }
						var myChart = new xChart('line-dotted', window["data"+feedMain], '#main-feed'+feedMain+'StatsPre', opts);
					}
				},
				error: function (response){
					if(feedMain==1)
					  $('#main-feed'+feedMain+'Text').html(txt229);
					else if(feedMain==2)
					  $('#main-feed'+feedMain+'Text').html(txt230);
					else if(feedMain==4)
					  $('#main-feed'+feedMain+'Text').html(txt231);
					else if(feedMain==6)
					  $('#main-feed'+feedMain+'Text').html(txt232);
					else if(feedMain==8)
					  $('#main-feed'+feedMain+'Text').html(txt233);
					else if(feedMain==9)
					  $('#main-feed'+feedMain+'Text').html(txt100.substr(9));
					$('#main-feed'+feedMain+'').html(txt105);
				}
	});
}