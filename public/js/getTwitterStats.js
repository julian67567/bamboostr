function cleanMainsTw(){
  for(var aer=1; aer<=16; aer++){
    $("#main-feed"+aer+"").html("");
    $("#main-feed"+aer+"Text").html("");
    $("#main-feed"+aer+"Text").parent().parent().css("display","block");
    $("#main-feed"+aer).siblings().find(".acercaSR").attr('onclick','help('+comilla+''+aer+''+comilla+','+comilla+'twitterStatistics'+comilla+');');
  }
  for(var aer=16; aer<=16; aer++){
    $("#main-feed"+aer+"").html("");
    $("#main-feed"+aer+"Text").html("");
    $("#main-feed"+aer+"Text").parent().parent().css("display","none");
  }
}
function iniTwStats(identifyLocal,identifyOther,redLocal,imagenRed){
        cleanMainsTw();
        //iniciando muestreo
        muestraTxtLoad(identifyLocal,identifyOther,redLocal,imagenRed,12);
        getTwitterStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,1);
	getTwitterStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,2);
	getTwitterStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,3);
	getTwitterStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,4);
	getTwitterStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,6);
	getTwitterStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,7);
	getTwitterStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,8);
	getTwitterStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,9);
	getTopTweets(identifyLocal,identifyOther,redLocal,imagenRed,10);
	getTwitterStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,11);
	//independiente a alguna stat
        //suscripcions a listas
	//listDialogTwitter(identifyLocal,identifyOther,redLocal,imagenRed,12);
        mapa();
}
function muestraTxtLoad(identifyLocal,identifyOther,redLocal,imagenRed,feedMain){
  var loadStats = '<div class="Knight-Rider-loader animate">';
      loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>'; 
      loadStats += '</div>';
      $('#main-feed12').html(loadStats + "<br />Éste proceso puedo tardar Varios Minutos más que las otras estadíticas");
      $('#main-feed13').html(loadStats + "<br />Éste proceso puedo tardar Varios Minutos más que las otras estadíticas");
      $('#main-feed14').html(loadStats + "<br />Éste proceso puedo tardar Varios Minutos más que las otras estadíticas");
      $('#main-feed15').html(loadStats + "<br />Éste proceso puedo tardar Varios Minutos más que las otras estadíticas");  
   
      //Títulos
      $("#main-feed12Text").html(txt469);
      $("#main-feed13Text").html(txt468);
      $("#main-feed14Text").html(txt470);
      $("#main-feed15Text").html(txt471);

      $.ajax({   data:  {identify:identifyLocal, option:'muestreo'},
		  url:   'twitter/stats/thread-stats-tw.php',
	   	  type:  'GET',
		  success:  function (response) {
                        $.ajax({   data:  {red:redLocal, identify:identifyLocal, option:'muestreo3'},
				    url:   'twitter/stats/thread-stats-tw.php',
			   	    type:  'GET',
				    success:  function (response) {
                                                        obj = JSON.parse(response);
                                                        feedMain = 13;
										                          
							 var htmlMain = '<div style="display: table; width: 100%;">';
								   htmlMain += '<div style="background-color: #F97CCF; display: table-row; width: 100%;">';
									 htmlMain += '<div style="height: 2.8em; background: url('+comilla+'images/mujeres.png'+comilla+') no-repeat center center; text-align: center; padding-top: 0.7em; display: table-cell; width: 100%; color: #FFFFFF;">';
										 htmlMain += 'Mujeres';
									 htmlMain += '</div>';
							           htmlMain += '</div>';

                                                                   htmlMain += '<div style="background-color: #CDDDE6; display: table-row; width: 100%;">';
									 htmlMain += '<div style="height: 2.8em; background: url('+comilla+'images/hombre.png'+comilla+') no-repeat center center; text-align: center; padding-top: 0.7em; display: table-cell; width: 100%;">';
										 htmlMain += 'Hombres';
									 htmlMain += '</div>';
							           htmlMain += '</div>';
                                                               

								   htmlMain += '<div style="display: table-row; width: 100%;">';
									 htmlMain += '<div style="border-left: 10px solid #009966; border-bottom: 5px solid #006699; text-align: center; display: table-cell; width: 100%;">';
									   htmlMain += '<div id="canvas-holder">';
										 htmlMain += '<canvas style="cursor: pointer;" onclick="graficaDialogTwitter('+comilla+''+feedMain+''+comilla+','+comilla+'3'+comilla+');" id="chart-area'+feedMain+'Pre" width="280" height="175" />';
									   htmlMain += '</div>';
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
	                                                                           htmlMain += '<div style="display: inline-block; width: 0.5em; height: 0.5em; background-color: #cbdde6; border:1px solid #000000"></div> <p style="display: inline-block;">Hombres</p>';
	                                                                         htmlMain += '</div>';
	                                                                       htmlMain += '</div>';
	                                                                       htmlMain += '<div style="display: table-row; width: 100%;">';
	                                                                         htmlMain += '<div style="text-align: left; display: table-cell;">';
	                                                                           htmlMain += '<div style="display: inline-block; width: 0.5em; height: 0.5em; background-color: #ff82cf;"></div> <p style="display: inline-block;">Mujeres</p>';
	                                                                         htmlMain += '</div>';
	                                                                       htmlMain += '</div>';
	                                                                     htmlMain += '</div>';
	                                                                   htmlMain += '</div>';
	                                                                   htmlMain += '<div style="background-color: #D1D9E1; text-align: center; display: table-cell; width: 4em;">';
	                                                                     htmlMain += '<img style="width: 1.5em; display: inline-block;" class="imgIcon'+feedMain+'" />';
	                                                                     htmlMain += '<img src="images/sim2.png" /><br />'+txt429+'';
	                                                                   htmlMain += '</div>';
	                                                                 htmlMain += '</div>';
	                                                               htmlMain += '</div>';
	                                                             htmlMain += '</div>';
								   htmlMain += '</div>';
								 htmlMain += '</div>';
		
						if(feedMain==13){
							window["data"+feedMain] = new Object();
							window["data"+feedMain]["labels"] = new Array();
							window["data"+feedMain]["datasets"] = new Array();
							window["data"+feedMain]["datasets"][0] = new  Object();
							window["data"+feedMain]["datasets"][0]["fillColor"] = "rgba(255,4,158,0.5)";
							window["data"+feedMain]["datasets"][0]["strokeColor"] = "rgba(255,4,158,0.8)";
							window["data"+feedMain]["datasets"][0]["highlightFill"] = "rgba(255,4,158,0.75)";
							window["data"+feedMain]["datasets"][0]["highlightStroke"] = "rgba(255,4,158,1)";
							window["data"+feedMain]["datasets"][0]["data"] = new Array();
							
							window["data"+feedMain]["datasets"][1] = new  Object();
							window["data"+feedMain]["datasets"][1]["fillColor"] = "rgba(151,187,205,0.5)";
							window["data"+feedMain]["datasets"][1]["strokeColor"] = "rgba(151,187,205,0.8)";
							window["data"+feedMain]["datasets"][1]["highlightFill"] = "rgba(151,187,205,0.75)";
							window["data"+feedMain]["datasets"][1]["highlightStroke"] = "rgba(151,187,205,1)";
							window["data"+feedMain]["datasets"][1]["data"] = new Array();
							window["data"+feedMain]["datasets"][0]["data"][0] = 10;
							window["data"+feedMain]["datasets"][1]["data"][0] = 10;
							window["data"+feedMain]["labels"][0] = "H-M";
						}
						$('#main-feed'+feedMain+'').html(htmlMain);
						
                                                    $('.imgIcon'+feedMain+'').attr("src","images/iconoS15Generos.png");
                                                    $('#imgIconG'+feedMain+'').attr("src","images/iconoS15Generos.png");
                                                
                                                  
						if(obj.hombres.cont==0 && obj.mujeres.cont==0){
						  $('#bar'+feedMain+'').html("<br /><br /><br />"+txt250+"<br /><br /><br /><br />");
						} else {
							      window["data"+feedMain]["datasets"][0]["data"][0] = obj.mujeres.cont.toFixed(2);
							      window["data"+feedMain]["labels"][0] = "% Mujeres - % Hombres";
						   
							      window["data"+feedMain]["datasets"][1]["data"][0] = obj.hombres.cont.toFixed(2);

							var ctx1 = document.getElementById("chart-area"+feedMain+"Pre").getContext("2d");
                            myPie = new Chart(ctx1).Bar(window["data"+feedMain], {
								responsive : true,
								//String - A legend template
                                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
								
							});
						}
                                    }, error: function(response) {
                                    }
                               });
                        $.ajax({   data:  {red:redLocal, identify:identifyLocal, option:'muestreo2'},
				    url:   'twitter/stats/thread-stats-tw.php',
			   	    type:  'GET',
				    success:  function (response) {
                                      feedMain = 12;
                                      obj = JSON.parse(response);
                                      var followers = new Array();

                                      if(obj.bots.cont){
                                        followers[0] = new Array();
				        followers[0]['num'] = parseInt(obj.bots.cont);
				        followers[0]['data'] = txt463;
                                      } else {
                                        followers[0] = new Array();
				        followers[0]['num'] = 0;
				        followers[0]['data'] = txt463;
                                      }
                                      if(obj.sinImagenPerfil.cont){
                                        followers[1] = new Array();
				        followers[1]['num'] = parseInt(obj.sinImagenPerfil.cont);
				        followers[1]['data'] = txt464;
                                      } else {
                                        followers[1] = new Array();
				        followers[1]['num'] = 0;
				        followers[1]['data'] = txt464;
                                      }
                                      if(obj.inactivas.cont){
                                        followers[2] = new Array();
				        followers[2]['num'] = parseInt(obj.inactivas.cont);
				        followers[2]['data'] = txt465;
                                      } else {
                                        followers[2] = new Array();
				        followers[2]['num'] = 0;
				        followers[2]['data'] = txt465;
                                      }
                                      if(obj.protected.cont){
                                        followers[3] = new Array();
				        followers[3]['num'] = parseInt(obj.protected.cont);
				        followers[3]['data'] = txt466;
                                      } else {
                                        followers[3] = new Array();
				        followers[3]['num'] = 0;
				        followers[3]['data'] = txt466;
                                      }
                                      if(obj.verified.cont){
                                        followers[4] = new Array();
				        followers[4]['num'] = parseInt(obj.verified.cont);
				        followers[4]['data'] = txt467;
                                      } else {
                                        followers[4] = new Array();
				        followers[4]['num'] = 0;
				        followers[4]['data'] = txt467;
                                      }
                                if(followers.length==0){
			            var htmlMain = '<div id="bar'+feedMain+'" style="display: table; width: 100%;"></div>';
                                } else {
                                  var htmlMain = '<div style="display: table; width: 100%;">';
                                       htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                         htmlMain += '<div style="text-align: center; background-color: #2e70b9; color: #FFFFFF; display: table-cell; width: 100%;">';
                                           htmlMain += txt462;
                                         htmlMain += '</div>';
                                       htmlMain += '</div>';

                                       htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                         htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                           htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                             htmlMain += '<div style="text-align: center; background-color: #F7464A; color: #FFFFFF; display: table-cell; width: 55%;">';
                                             htmlMain += '</div>';
                                               htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                               htmlMain += txt463;
                                             htmlMain += '</div>';
                                           htmlMain += '</div>';
                                         htmlMain += '</div>';
                                       htmlMain += '</div>';

                                       htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                         htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                           htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                             htmlMain += '<div style="text-align: center; background-color: #46BFBD; color: #FFFFFF; display: table-cell; width: 55%;">';
                                             htmlMain += '</div>';
                                               htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                               htmlMain += txt464;
                                             htmlMain += '</div>';
                                           htmlMain += '</div>';
                                         htmlMain += '</div>';
                                       htmlMain += '</div>';

                                       htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                         htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                           htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                             htmlMain += '<div style="text-align: center; background-color: #FDB45C; color: #FFFFFF; display: table-cell; width: 55%;">';
                                             htmlMain += '</div>';
                                               htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                               htmlMain += txt465;
                                             htmlMain += '</div>';
                                           htmlMain += '</div>';
                                         htmlMain += '</div>';
                                       htmlMain += '</div>';

                                       htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                         htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                           htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                             htmlMain += '<div style="text-align: center; background-color: #949FB1; color: #FFFFFF; display: table-cell; width: 55%;">';
                                             htmlMain += '</div>';
                                               htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                               htmlMain += txt466;
                                             htmlMain += '</div>';
                                           htmlMain += '</div>';
                                         htmlMain += '</div>';
                                       htmlMain += '</div>';

                                       htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                         htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                           htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                             htmlMain += '<div style="text-align: center; background-color: #4D5360; color: #FFFFFF; display: table-cell; width: 55%;">';
                                             htmlMain += '</div>';
                                               htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                               htmlMain += txt467;
                                             htmlMain += '</div>';
                                           htmlMain += '</div>';
                                         htmlMain += '</div>';
                                       htmlMain += '</div>';

                                       htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                         htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                           htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                             htmlMain += '<div style="text-align: center; background-color: #DDDDDD; color: #FFFFFF; display: table-cell; width: 55%;">';
                                             htmlMain += '</div>';
                                               htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                               htmlMain += txt426;
                                             htmlMain += '</div>';
                                           htmlMain += '</div>';
                                         htmlMain += '</div>';
                                       htmlMain += '</div>';

					   htmlMain += '<div style="display: table-row; width: 100%; text-align: center;">';
						 htmlMain += '<div style="padding-top: 1em;text-align: center; display: table-cell; width: 100%;">';
						   htmlMain += '<div id="canvas-holder" style="padding-left: 4em;">';
							 htmlMain += '<canvas style="cursor: pointer;" onclick="graficaDialogTwitter('+comilla+''+feedMain+''+comilla+','+comilla+'2'+comilla+');" id="chart-area'+feedMain+'Pre" width="230" height="230" />';
						   htmlMain += '</div>';
						 htmlMain += '</div>';
					   htmlMain += '</div>';
					 htmlMain += '</div>';


						window["data"+feedMain] = new Array();
						$('#main-feed'+feedMain+'').html(htmlMain);
						if(followers.length==0){
						  $('#bar'+feedMain+'').html("<br /><br /><br />"+txt250+"<br /><br /><br /><br />");
						} else {
							for(var i=0; i<followers.length; i++){
							  window["data"+feedMain][i] = new Object();
							  window["data"+feedMain][i]["value"] = followers[i]["num"]
							  window["data"+feedMain][i]["label"] = ""+followers[i]["data"]+"";
							  if(i==0){
								window["data"+feedMain][i]["color"] = "#F7464A";
								window["data"+feedMain][i]["highlight"] = "#FF5A5E";
							  } else if(i==1){
								window["data"+feedMain][i]["color"] = "#46BFBD";
								window["data"+feedMain][i]["highlight"] = "#5AD3D1";
							  } else if(i==2){
								window["data"+feedMain][i]["color"] = "#FDB45C";
								window["data"+feedMain][i]["highlight"] = "#FFC870";
							  } else if(i==3){
								window["data"+feedMain][i]["color"] = "#949FB1";
								window["data"+feedMain][i]["highlight"] = "#A8B3C5";
							  } else if(i==4){
								window["data"+feedMain][i]["color"] = "#4D5360";
								window["data"+feedMain][i]["highlight"] = "#616774";
							  } else {
								window["data"+feedMain][i]["color"] = "#DDDDDD";
								window["data"+feedMain][i]["highlight"] = "#000000";
							  }
							}
							var ctx = document.getElementById("chart-area"+feedMain+"Pre").getContext("2d");
							if(feedMain==7){
								var myPie = new Chart(ctx).Pie(window["data"+feedMain], {
								  //String - A legend template
								  legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
	
								});
							} else {
							  var myDoughnutChart = new Chart(ctx).Doughnut(window["data"+feedMain], {
								  //String - A legend template
								  legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
	
							  });
							}
						}
                                      }
                                      

                                                feedMain=14;

                                                var zxcOnt = 0;
                                                var zxcOnt2 = 0;
                                                window["data"+feedMain] = [["Country","Porcentaje"]];
                                                for(var zxcOnt=0; zxcOnt<obj.location.length; zxcOnt++){
                                                  if(obj.location[zxcOnt].pais.length>3 && obj.location[zxcOnt].cont>2)
                                                    zxcOnt2 = zxcOnt2 + obj.location[zxcOnt].cont;
                                                }
                                                for(var zxcOnt=0; zxcOnt<obj.location.length; zxcOnt++){
                                                  if(obj.location[zxcOnt].pais.length>3 && obj.location[zxcOnt].cont>2){
                                                    var item = [normalize(obj.location[zxcOnt].pais),((obj.location[zxcOnt].cont/zxcOnt2).toFixed(3)*100)];
					            window["data"+feedMain].push(item);
                                                  }
                                                }
                                            if(zxcOnt==0){
						  var htmlMain = '<div id="bar'+feedMain+'" style="display: table; width: 100%;"></div>';
					    } else {
                                                           
										                          
							 var htmlMain = '<div style="display: table; width: 100%;">';
                                                               

								   htmlMain += '<div style="display: table-row; width: 100%; text-align: center;">';
                                                                         htmlMain += '<div style="padding-top: 1em;text-align: center; display: table-cell; width: 100%;">';
									   htmlMain += '<button onclick="graficaDialogTwitter('+comilla+''+feedMain+''+comilla+','+comilla+'4'+comilla+');" class="btn btn-danger" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true" style="padding-right: 0.7em;"></span>'+txt427+'</button>';
									   
									 htmlMain += '</div>';
								   htmlMain += '</div>';
                                                                   htmlMain += '<div style="display: table-row; width: 100%; text-align: center;">';
									 htmlMain += '<div style="padding-top: 1em;text-align: center; display: table-cell; width: 100%;">';
									   htmlMain += '<div id="regions_div" style="width: 100%; height: 300px;"></div>';
									   
									 htmlMain += '</div>';
								   htmlMain += '</div>';
								 htmlMain += '</div>';

					   }
                                           
                                           $('#main-feed'+feedMain+'').html(htmlMain);

                                                 if(zxcOnt==0){
						    $('#bar'+feedMain+'').html("<br /><br /><br />"+txt250+"<br /><br /><br /><br />");
						  } else {

                                                  var data = google.visualization.arrayToDataTable(window["data"+feedMain]);
							
							var options = {};
							
							var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
							
							chart.draw(data, options);
					       }

                                                feedMain=15;

                                                var zxcOnt = 0;
                                                var zxcOnt2 = 0;

                                                for(var zxcOnt=0; zxcOnt<obj.idioma.length; zxcOnt++){
                                                  zxcOnt2 = zxcOnt2 + obj.idioma[zxcOnt].cont;
                                                }

                                if(zxcOnt==0){
			            var htmlMain = '<div id="bar'+feedMain+'" style="display: table; width: 100%;"></div>';
                                } else {
							 var htmlMain = '<div style="display: table; width: 100%;">';
                                                               htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                 htmlMain += '<div style="text-align: center; background-color: #2e70b9; color: #FFFFFF; display: table-cell; width: 100%;">';
                                                                   htmlMain += txt420;
                                                                 htmlMain += '</div>';
                                                               htmlMain += '</div>';
                                                               htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                 htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                                                   htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                     htmlMain += '<div style="text-align: center; background-color: #F7464A; color: #FFFFFF; display: table-cell; width: 90%;">';
                                                                     htmlMain += '</div>';
                                                                       htmlMain += '<div style="text-align: right; background-color: #F7464A; color: #FFFFFF; display: table-cell; width: 100%;">';
                                                                       htmlMain += txt421;
                                                                     htmlMain += '</div>';
                                                                   htmlMain += '</div>';
                                                                 htmlMain += '</div>';
                                                               htmlMain += '</div>';

                                                               htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                 htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                                                   htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                     htmlMain += '<div style="text-align: center; background-color: #46BFBD; color: #FFFFFF; display: table-cell; width: 75%;">';
                                                                     htmlMain += '</div>';
                                                                       htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                                                       htmlMain += txt422;
                                                                     htmlMain += '</div>';
                                                                   htmlMain += '</div>';
                                                                 htmlMain += '</div>';
                                                               htmlMain += '</div>';

                                                               htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                 htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                                                   htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                     htmlMain += '<div style="text-align: center; background-color: #FDB45C; color: #FFFFFF; display: table-cell; width: 65%;">';
                                                                     htmlMain += '</div>';
                                                                       htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                                                       htmlMain += txt423;
                                                                     htmlMain += '</div>';
                                                                   htmlMain += '</div>';
                                                                 htmlMain += '</div>';
                                                               htmlMain += '</div>';

                                                               htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                 htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                                                   htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                     htmlMain += '<div style="text-align: center; background-color: #949FB1; color: #FFFFFF; display: table-cell; width: 55%;">';
                                                                     htmlMain += '</div>';
                                                                       htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                                                       htmlMain += txt424;
                                                                     htmlMain += '</div>';
                                                                   htmlMain += '</div>';
                                                                 htmlMain += '</div>';
                                                               htmlMain += '</div>';

                                                               htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                 htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                                                   htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                     htmlMain += '<div style="text-align: center; background-color: #4D5360; color: #FFFFFF; display: table-cell; width: 45%;">';
                                                                     htmlMain += '</div>';
                                                                       htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                                                       htmlMain += txt425;
                                                                     htmlMain += '</div>';
                                                                   htmlMain += '</div>';
                                                                 htmlMain += '</div>';
                                                               htmlMain += '</div>';

                                                               htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                 htmlMain += '<div style="text-align: center; display: table; width: 100%;">';
                                                                   htmlMain += '<div style="text-align: center; display: table-row; width: 100%;">';
                                                                     htmlMain += '<div style="text-align: center; background-color: #DDDDDD; color: #FFFFFF; display: table-cell; width: 35%;">';
                                                                     htmlMain += '</div>';
                                                                       htmlMain += '<div style="text-align: right; background-color: #000000; color: #FFFFFF; display: table-cell; width: 100%;">';
                                                                       htmlMain += txt426;
                                                                     htmlMain += '</div>';
                                                                   htmlMain += '</div>';
                                                                 htmlMain += '</div>';
                                                               htmlMain += '</div>';

								   htmlMain += '<div style="display: table-row; width: 100%; text-align: center;">';
									 htmlMain += '<div style="padding-top: 1em;text-align: center; display: table-cell; width: 100%;">';
									   htmlMain += '<div id="canvas-holder" style="padding-left: 4em;">';
										 htmlMain += '<canvas style="cursor: pointer;" onclick="graficaDialogTwitter('+comilla+''+feedMain+''+comilla+','+comilla+'2'+comilla+');" id="chart-area'+feedMain+'Pre" width="230" height="230" />';
									   htmlMain += '</div>';
									 htmlMain += '</div>';
								   htmlMain += '</div>';
								 htmlMain += '</div>';


                                                window["data"+feedMain] = new Array();
                                                for(var i=0; i<obj.idioma.length; i++){
                                                          window["data"+feedMain][i] = new Object();
							  window["data"+feedMain][i]["value"] = ((obj.idioma[i].cont/zxcOnt2).toFixed(3)*100);
							  window["data"+feedMain][i]["label"] = ""+obj.idioma[i].idioma+"";
							  if(i==0){
								window["data"+feedMain][i]["color"] = "#F7464A";
								window["data"+feedMain][i]["highlight"] = "#FF5A5E";
							  } else if(i==1){
								window["data"+feedMain][i]["color"] = "#46BFBD";
								window["data"+feedMain][i]["highlight"] = "#5AD3D1";
							  } else if(i==2){
								window["data"+feedMain][i]["color"] = "#FDB45C";
								window["data"+feedMain][i]["highlight"] = "#FFC870";
							  } else if(i==3){
								window["data"+feedMain][i]["color"] = "#949FB1";
								window["data"+feedMain][i]["highlight"] = "#A8B3C5";
							  } else if(i==4){
								window["data"+feedMain][i]["color"] = "#4D5360";
								window["data"+feedMain][i]["highlight"] = "#616774";
							  } else {
								window["data"+feedMain][i]["color"] = "#DDDDDD";
								window["data"+feedMain][i]["highlight"] = "#000000";
							  }
                                                }// fin for

                                                        $('#main-feed'+feedMain+'').html(htmlMain);
							var ctx = document.getElementById("chart-area"+feedMain+"Pre").getContext("2d");
							if(feedMain==15){
								var myPie = new Chart(ctx).Pie(window["data"+feedMain], {
								  //String - A legend template
								  legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
	
								});
							} else {
							  var myDoughnutChart = new Chart(ctx).Doughnut(window["data"+feedMain], {
								  //String - A legend template
								  legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
	
							  });
							}
                                      }
						
		                    }, error: function (response) {
		                    }
		        });
                  }, error: function (response) {
                     $('#main-feed'+feedMain+'').html(txt105);
                  }
        });
}
function mapa(){
        google.load("visualization", "1", {packages:["geochart"]});
        google.setOnLoadCallback(drawRegionsMap);
	
	function drawRegionsMap() {
	
	}
}
function graficaDialogTwitter(option,stat){
  if(stat==1){
    $("#xchart").dialog("open");
    $("#stats").html("");
    $("#stats").css("height", 300);
    if(option==1)
      $("#xchart").dialog('option', 'title', txt93);
    else if(option==2)
      $("#xchart").dialog('option', 'title', txt94);
    else if(option==3)
      $("#xchart").dialog('option', 'title', txt95);
    else if(option==4)
      $("#xchart").dialog('option', 'title', txt96);
    else if(option==6)
      $("#xchart").dialog('option', 'title', txt97);
    else if(option==7)
      $("#xchart").dialog('option', 'title', txt98);
    else if(option==8)
      $("#xchart").dialog('option', 'title', txt99);
    else if(option==9)
      $("#xchart").dialog('option', 'title', txt100);
    else if(option==11)
      $("#xchart").dialog('option', 'title', txt228);
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
  } else if(stat==2){
    $("#chartsjs").dialog("open");
    $("#stats2").html("");
    $("#stats2").css("height", 300);
    if(option==12)
      $("#chartsjs").dialog('option', 'title', txt469);
    else if(option==15)
      $("#chartsjs").dialog('option', 'title', txt471);
    $("#stats2").empty();
    if(myPieDialog!="")
      myPieDialog.destroy();
    $("#colorTable").empty();
    $("#colorTable").css("padding-left", "30px");
    $("#stats2").css("height", 350);
    $("#stats2").css("width", 350);
    $("#stats2").css("display", "inline-table");
    var htmlDialog2 = '<ul>';
    for(var i=0; i<window["data" + option].length; i++){
      if(i<15){
        htmlDialog2 += '<li style="list-style-type: square; color: '+window["data" + option][i]["color"]+';">'+window["data" + option][i]["value"]+':'+window["data" + option][i]["label"]+'</li>'; 
      } else if(i==16){
	htmlDialog2 += '<li style="list-style-type: square; color: '+window["data" + option][i]["color"]+';">...</li>'; 
      }
    }
    $("#colorTable").html(htmlDialog2+'</ul>');
    var ctx = document.getElementById("stats2").getContext("2d");
    if(option==15){
      myPieDialog = new Chart(ctx).Pie(window["data"+option], {
        //String - A legend template
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
      });
    } else if(option==12){
      myPieDialog = new Chart(ctx).Doughnut(window["data"+option], {
        //String - A legend template
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
      });
    }
    $("#chartsjs").dialog('option', 'width', 800);
    $("#chartsjs").dialog('option', 'height', 420);
  } else if(stat==3){
    $("#chartsjs").dialog("open");
    $("#stats2").html("");
    $("#stats2").css("height", 300);
    if(option==13)
      $("#chartsjs").dialog('option', 'title', txt468);
    $("#stats2").empty();
    if(myPieDialog!="")
      myPieDialog.destroy();
    $("#colorTable").empty();
    $("#colorTable").css("padding-left", 0);
    $("#stats2").css("height", 300);
    $("#stats2").css("width", 700);
    $("#stats2").css("display", "inline-table");
    var ctx = document.getElementById("stats2").getContext("2d");
    myPieDialog = new Chart(ctx).Bar(window["data"+option]);
    if(option==13){
      var htmlColorTable = '<ul>';
      htmlColorTable += '<li style="list-style-type: square; padding-right: 2em; float: left; color: rgba(255,4,158,0.8);">Mujeres</li>';
      htmlColorTable += '<li style="list-style-type: square; float: left; color: rgba(151,187,205,0.8);">Hombres</li>';
      htmlColorTable += '</ul>';
    } 
    if(option==13){
      var htmlColorTable = '';
    }
    $("#colorTable").html(htmlColorTable);
    $("#chartsjs").dialog('option', 'width', 800);
    $("#chartsjs").dialog('option', 'height', 420);
  } else if(stat==4){
    $("#mapa").dialog("open");
    $("#mapa").dialog('option', 'width', 800);
    $("#mapa").dialog('option', 'height', 550);
    $("#mapa").dialog('option', 'title', txt470);
    var data = google.visualization.arrayToDataTable(window["data"+option]);
    var options = {};
    var chart = new google.visualization.GeoChart(document.getElementById('regions_div2'));
    chart.draw(data, options);
  }
}
function listDialogTwitter(identifyLocal,identifyOther,redLocal,imagenRed,feedMain){
    var parametros = { redP:red, redS:redLocal, identifyP:identify, identifyS:identifyLocal, identifyOther:identifyOther
			         };
	var loadStats = '<div class="Knight-Rider-loader animate">';
         loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
	  loadStats += '</div>';
	if(feedMain==4){
	  $('#main-feed'+feedMain+'').html(loadStats);
	  $('#main-feed5').html(loadStats);
	} else {
	  $('#main-feed'+feedMain+'').html(loadStats);
	}
    if(feedMain==5)
	  var urlTw = "scripts/get-twitter-mlists-name.php";
	if(feedMain==15)
	  var urlTw = "scripts/get-twitter-slists-name.php";
	$.ajax({    data:  parametros,
				url:   urlTw,
				type:  'GET',
				success:  function (response) {
					if(feedMain==5)
					  $('#main-feed'+feedMain+'Text').html(txt102);
					if(feedMain==15)
					  $('#main-feed'+feedMain+'Text').html(txt227);
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
									if(feedMain==5){
									  var tempList = window["data" + (feedMain-1)];
									  tempList2 = tempList["main"][0]["data"];
									  htmlMain += '<center><a style="text-decoration:none; color: #428bca; font-size: 40px;">'+tempList2[tempList2.length-1]["y"]+'</a></center><br />';
									}
									if(feedMain==15){
									  htmlMain += '<center><a style="text-decoration:none; color: #428bca; font-size: 40px;">'+(responseArray.length-1)+'</a></center><br />';
									}
								      for(var i=0; i<responseArray.length-1; i++){
										responsePart = responseArray[i].split("|");
									    htmlMain += '<a style="cursor: pointer; text-decoration:none; color: #428bca;" target="_blank" href="http://twitter.com'+responsePart[1]+'">';
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
				    if(feedMain==5)
					  $('#main-feed'+feedMain+'Text').html(txt102);
                    if(feedMain==15)
					  $('#main-feed'+feedMain+'Text').html(txt227);
					$('#main-feed'+feedMain+'').html(txt103);
				}
	});
}
function getTwitterStatsBar(identifyLocal,identifyOther,redLocal,imagenRed,feedMain){
	var loadStats = '<div class="Knight-Rider-loader animate">';
         loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
	  loadStats += '</div>';
	  $('#main-feed'+feedMain+'').html(loadStats);
    var parametros = { redP:red, redS:redLocal, identifyP:identify, identifyS:identifyLocal, identifyOther:identifyOther
					 };
    if(feedMain==10)
      var urlTw = "scripts/get-twitter-top-tweets.php";
	$.ajax({    data:  parametros,
				url:   urlTw,
				type:  'GET',
				success:  function (response) {
					if(feedMain==10)
					  $('#main-feed'+feedMain+'Text').html(txt264);
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
						  followers[i] = new Array();
						  followers[i]['screen_name'] = parseInt(responseArray2[0]);
						  followers[i]['id'] = responseArray2[1];
						  followers[i]['num'] = responseArray2[2];
						  followers[i]['text'] = responseArray2[3];
						  followers[i]['date'] = responseArray2[4];
						}
						
						
										                          
						  var htmlMain = '<div style="display: table; width: 100%;">';
							   htmlMain += '<div style="display: table-row; width: 100%;">';
								 htmlMain += '<div style="text-align: center; display: table-cell; width: 100%;">';
								   htmlMain += '<article onclick="graficaDialogTwitter('+comilla+''+feedMain+''+comilla+','+comilla+'1'+comilla+');" class="example">';
                                     htmlMain += '<figure style="padding-top: 10px; cursor: pointer; height: 200px; width: 400px;" id="main-feed'+feedMain+'StatsPre"></figure>';
                                   htmlMain += '</article>';
								 htmlMain += '</div>';
							   htmlMain += '</div>';
							 htmlMain += '</div>';
						tt = document.createElement('div'),
						leftOffset = -(~~$('html').css('padding-left').replace('px', '') + ~~$('body').css('margin-left').replace('px', '')),
						topOffset = -32;
						tt.className = 'ex-tooltip';
					    document.body.appendChild(tt);
						
                        window["data"+feedMain] = {
						  "xScale": "ordinal",
						  "yScale": "linear",
						  "main": [
							{ "className": ".grafica"
							}
						  ]
						};
						
						var fechaStats = '';
						window["data"+feedMain]["main"][0]["data"] = new Array();
						
						for(var i=0; i<followers.length; i++){
						  window["data"+feedMain]["main"][0]["data"][i] = new Object();
						  window["data"+feedMain]["main"][0]["data"][i]["x"] = '<a href="http://facebook.com">'+followers[i]['text']+'</a>';
						  window["data"+feedMain]["main"][0]["data"][i]["y"] = followers[i]["num"];
						}
						$('#main-feed'+feedMain+'').html(htmlMain);
						var myChart = new xChart('bar', window["data"+feedMain], '#main-feed'+feedMain+'StatsPre');
						
					}
				},
				error: function (response){
					if(feedMain==10)
					  $('#main-feed'+feedMain+'Text').html(txt264);
					$('#main-feed'+feedMain+'').html(txt105);
				}
	});
}
function getTwitterStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,feedMain){
	var loadStats = '<div class="Knight-Rider-loader animate">';
         loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
	  loadStats += '</div>';
	if(feedMain==4){
	  $('#main-feed'+feedMain+'').html(loadStats);
	  $('#main-feed5').html(loadStats);
	} else {
	  $('#main-feed'+feedMain+'').html(loadStats);
	}
    var parametros = { redP:red, redS:redLocal, identifyP:identify, identifyS:identifyLocal, identifyOther:identifyOther
					 };
	if(feedMain==1)
	  var urlTw = "scripts/get-twitter-tweets.php";
	else if(feedMain==2)
	  var urlTw = "scripts/get-twitter-followers.php";
	else if(feedMain==3)
	  var urlTw = "scripts/get-twitter-following.php";
	else if(feedMain==4)
	  var urlTw = "scripts/get-twitter-mlists.php";
	else if(feedMain==6)
	  var urlTw = "scripts/get-twitter-notfollowingme.php";
	else if(feedMain==7)
	  var urlTw = "scripts/get-twitter-fans.php";
	else if(feedMain==8)
	  var urlTw = "scripts/get-twitter-seguimientomutuo.php";
	else if(feedMain==9)
	  var urlTw = "scripts/get-twitter-tus-favoritos.php";
	else if(feedMain==11)
      var urlTw = "scripts/get-twitter-send-dms.php";
	$.ajax({    data:  parametros,
				url:   urlTw,
				type:  'GET',
				success:  function (response) {
					if(feedMain==1)
					  $('#main-feed'+feedMain+'Text').html(txt93.substr(9));
					else if(feedMain==2)
					  $('#main-feed'+feedMain+'Text').html(txt94.substr(9));
					else if(feedMain==3)
					  $('#main-feed'+feedMain+'Text').html(txt95.substr(9));
					else if(feedMain==4)
					  $('#main-feed'+feedMain+'Text').html(txt96.substr(9));
					else if(feedMain==6)
					  $('#main-feed'+feedMain+'Text').html(txt97.substr(9));
					else if(feedMain==7)
					  $('#main-feed'+feedMain+'Text').html(txt98.substr(9));
					else if(feedMain==8)
					  $('#main-feed'+feedMain+'Text').html(txt99.substr(9));
					else if(feedMain==9)
					  $('#main-feed'+feedMain+'Text').html(txt100.substr(9));
					else if(feedMain==11)
                      $('#main-feed'+feedMain+'Text').html(txt228);
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
	                      var diaRendimiento = Math.log(followers[responseArrayL-2]['num']/followers[responseArrayL-3]['num']).toPrecision(2);
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
							   htmlMain += '<div style=" background-color: #D1D9E1; display: table-row; width: 100%;">';
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
								   htmlMain += '<article onclick="graficaDialogTwitter('+comilla+''+feedMain+''+comilla+','+comilla+'1'+comilla+');" class="example">';
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
                                                                     htmlMain += '<img src="images/sim2.png" /><br />'+txt386+'';
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
                                                $('.imgIcon'+feedMain+'').attr("src","images/statics.png");
                                                $('.imgIcon5').attr("src","images/statics.png");
						var myChart = new xChart('line-dotted', window["data"+feedMain], '#main-feed'+feedMain+'StatsPre', opts);
					}
					if(feedMain==4)
					  listDialogTwitter(identifyLocal,identifyOther,redLocal,imagenRed,5);
				},
				error: function (response){
					if(feedMain==1)
					  $('#main-feed'+feedMain+'Text').html(txt93.substr(9));
					else if(feedMain==2)
					  $('#main-feed'+feedMain+'Text').html(txt94.substr(9));
					else if(feedMain==3)
					  $('#main-feed'+feedMain+'Text').html(txt95.substr(9));
					else if(feedMain==4)
					  $('#main-feed'+feedMain+'Text').html(txt96.substr(9));
					else if(feedMain==6)
					  $('#main-feed'+feedMain+'Text').html(txt97.substr(9));
					else if(feedMain==7)
					  $('#main-feed'+feedMain+'Text').html(txt98.substr(9));
					else if(feedMain==8)
					  $('#main-feed'+feedMain+'Text').html(txt99.substr(9));
					else if(feedMain==9)
					  $('#main-feed'+feedMain+'Text').html(txt100.substr(9));
					else if(feedMain==11)
                      $('#main-feed'+feedMain+'Text').html(txt228);
					$('#main-feed'+feedMain+'').html(txt105);
				}
	});
}