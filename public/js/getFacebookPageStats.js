var myPieDialog="";
function cleanMainsFaPa(){
  for(var aer=1; aer<=13; aer++){
        $("#main-feed"+aer+"").html("");
	$("#main-feed"+aer+"Text").html("");
	$("#main-feed"+aer+"Text").parent().parent().css("display","block");
        $("#main-feed"+aer).siblings().find(".acercaSR").attr('onclick','help('+comilla+''+aer+''+comilla+','+comilla+'faPageStatistics'+comilla+');');
  }
  for(var aer=13; aer<=15; aer++){
        $("#main-feed"+aer+"").html("");
	$("#main-feed"+aer+"Text").html("");
	$("#main-feed"+aer+"Text").parent().parent().css("display","none");
  }
}
function iniFaPaStats(identifyLocal,identifyOther,redLocal,imagenRed,tipo){
	cleanMainsFaPa();
	getFacebookPageStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,1,tipo);
	getFacebookPageStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,2,tipo);
	getFacebookPageStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,3,tipo);
	getFacebookPageStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,4,tipo);
	getFacebookPageStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,5,tipo);
	getFacebookPageStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,6,tipo);
	getFacebookPageStatsPastel(identifyLocal,identifyOther,redLocal,imagenRed,7,tipo);
	getFacebookPageStatsPastel(identifyLocal,identifyOther,redLocal,imagenRed,8,tipo);
	//getFacebookPageStatsPastel(identifyLocal,identifyOther,redLocal,imagenRed,9,tipo);
        getFacebookPageStatsMapa(identifyLocal,identifyOther,redLocal,imagenRed,9,tipo);
        mapa();
	getFacebookStatsBar2(identifyLocal,identifyOther,redLocal,imagenRed,10,tipo);
	getFacebookStatsBar2(identifyLocal,identifyOther,redLocal,imagenRed,11,tipo);
	getFacebookPageStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,12,tipo);
	//no poner list dialog debido al tiempo de carga del total windows data-1
}
function graficaDialogFacebookPage(option, stat){
  if(stat==1){
    $("#xchart").dialog("open");
    $("#stats").html("");
    $("#stats").css("height", 300);
    if(option==1)
      $("#xchart").dialog('option', 'title', txt238);
    else if(option==2)
      $("#xchart").dialog('option', 'title', txt239);
    else if(option==3)
      $("#xchart").dialog('option', 'title', txt240);
    else if(option==4)
      $("#xchart").dialog('option', 'title', txt241);
    else if(option==5)
      $("#xchart").dialog('option', 'title', txt242);
    else if(option==6)
      $("#xchart").dialog('option', 'title', txt243);
    else if(option==12)
	  $("#xchart").dialog('option', 'title', txt244);
  } else if(stat==2){
	$("#chartsjs").dialog("open");
    $("#stats2").html("");
    $("#stats2").css("height", 300);
    if(option==7)
	  $("#chartsjs").dialog('option', 'title', txt245);
	else if(option==8)
	  $("#chartsjs").dialog('option', 'title', txt246);
  } else if(stat==3){
	$("#chartsjs").dialog("open");
    $("#stats2").html("");
    $("#stats2").css("height", 300);
    if(option==10)
	  $("#chartsjs").dialog('option', 'title', txt248);
	if(option==11)
	  $("#chartsjs").dialog('option', 'title', txt249);
  }
  if(stat==1){
    $("#stats").css("height", 350);
    if(option!=10){
	  $("#stats").css("width", 1200);
	  var myChart = new xChart('line-dotted', window["data" + option], '#stats', opts);
    } else {
	  $("#stats").css("width", 4000);
      var myChart = new xChart('bar', window["data" + option], '#stats');
    }
    $("#xchart").dialog('option', 'width', 800);
    $("#xchart").dialog('option', 'height', 420);
  } else if(stat==2){
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
	if(option==7){
		myPieDialog = new Chart(ctx).Pie(window["data"+option], {
		  //String - A legend template
		  legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

		});
	} else {
	  myPieDialog = new Chart(ctx).Doughnut(window["data"+option], {
		  //String - A legend template
		  legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"

	  });
	}
    $("#chartsjs").dialog('option', 'width', 800);
    $("#chartsjs").dialog('option', 'height', 420);
  } else if(stat==3){
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
	if(option==10){
		var htmlColorTable = '<ul>';
			  htmlColorTable += '<li style="list-style-type: square; padding-right: 2em; float: left; color: rgba(255,4,158,0.8);">Mujeres</li>';
			  htmlColorTable += '<li style="list-style-type: square; float: left; color: rgba(151,187,205,0.8);">Hombres</li>';
			htmlColorTable += '</ul>';
	} 
	if(option==11){
    	var htmlColorTable = '';
	}
    $("#colorTable").html(htmlColorTable);
    $("#chartsjs").dialog('option', 'width', 800);
    $("#chartsjs").dialog('option', 'height', 420);
  } else if(stat==4){
    $("#mapa").dialog("open");
    $("#mapa").dialog('option', 'width', 800);
    $("#mapa").dialog('option', 'height', 550);
    $("#mapa").dialog('option', 'title', txt247);
    var data = google.visualization.arrayToDataTable(window["data"+option]);
    var options = {};
    var chart = new google.visualization.GeoChart(document.getElementById('regions_div2'));
    chart.draw(data, options);
  }
}
function listDialogFacebookPage(identifyLocal,identifyOther,redLocal,imagenRed,feedMain){
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
function mapa(){
        google.load("visualization", "1", {packages:["geochart"]});
        google.setOnLoadCallback(drawRegionsMap);
	
	function drawRegionsMap() {
	
	}
}
function getFacebookPageStatsMapa(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,tipo){
    var loadStats = '<div class="Knight-Rider-loader animate">';
         loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
	  loadStats += '</div>';
  if(feedMain==8){
	  $('#main-feed'+feedMain+'').html(loadStats);
	  $('#main-feed9').html(loadStats);
	} else {
	  $('#main-feed'+feedMain+'').html(loadStats);
	}
    var parametros = { redP:red, redS:redLocal, identifyP:identify, identifyS:identifyLocal, identifyOther:identifyOther
					 };
	if(feedMain==9)
	  var urlTw = "scripts/get-page-fans-country.php";
	$.ajax({    data:  parametros,
				url:   urlTw,
				type:  'GET',
				success:  function (response) {
					if(feedMain==9)
					 $('#main-feed'+feedMain+'Text').html(txt247);
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
						for(var i=0; i<responseArrayL-2; i++){
						  responseArray2=responseArray[i].split("|");
						  followers[i] = new Array();
						  followers[i]['num'] = parseInt(responseArray2[0]);
						  followers[i]['data'] = responseArray2[1];
						}
					    if(followers.length==0){
						  var htmlMain = '<div id="bar'+feedMain+'" style="display: table; width: 100%;"></div>';
					    } else {
                                                           
										                          
							 var htmlMain = '<div style="display: table; width: 100%;">';
                                                               

								   htmlMain += '<div style="display: table-row; width: 100%; text-align: center;">';
                                                                         htmlMain += '<div style="padding-top: 1em;text-align: center; display: table-cell; width: 100%;">';
									   htmlMain += '<button onclick="graficaDialogFacebookPage('+comilla+''+feedMain+''+comilla+','+comilla+'4'+comilla+');" class="btn btn-danger" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true" style="padding-right: 0.7em;"></span>'+txt427+'</button>';
									   
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
						if(followers.length==0){
						  $('#bar'+feedMain+'').html("<br /><br /><br />"+txt250+"<br /><br /><br /><br />");
						} else {
						  window["data"+feedMain] = [["Country",txt238]];
                                                  for(var i=0; i<followers.length; i++){
					                var item = [followers[i]["data"]+"",followers[i]["num"]];
					                window["data"+feedMain].push(item);
                                                  }
                                                  var data = google.visualization.arrayToDataTable(window["data"+feedMain]);
							
							var options = {};
							
							var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
							
							chart.draw(data, options);
					       }
						
					}
                                        if(feedMain==9){
                                          $('.imgIcon'+feedMain+'').attr("src","images/iconoS13Paises.png");
                                        }        
				},
				error: function (response){
					if(feedMain==9)
					  $('#main-feed'+feedMain+'Text').html(txt247);
					$('#main-feed'+feedMain+'').html(txt105);
				}
	});
}
function getFacebookPageStatsPastel(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,tipo){
    var loadStats = '<div class="Knight-Rider-loader animate">';
         loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
	  loadStats += '</div>';
	if(feedMain==8){
	  $('#main-feed'+feedMain+'').html(loadStats);
	  $('#main-feed9').html(loadStats);
	} else {
	  $('#main-feed'+feedMain+'').html(loadStats);
	}
    var parametros = { redP:red, redS:redLocal, identifyP:identify, identifyS:identifyLocal, identifyOther:identifyOther
					 };
	if(feedMain==7)
	  var urlTw = "scripts/get-page-fans-locale.php";
	else if(feedMain==8)
	  var urlTw = "scripts/get-page-fans-city.php";
	else if(feedMain==9)
	  var urlTw = "scripts/get-page-fans-country.php";
	$.ajax({    data:  parametros,
				url:   urlTw,
				type:  'GET',
				success:  function (response) {
					if(feedMain==7)
					  $('#main-feed'+feedMain+'Text').html(txt245);
					if(feedMain==8)
					  $('#main-feed'+feedMain+'Text').html(txt246);
					if(feedMain==9)
					  $('#main-feed'+feedMain+'Text').html(txt247);
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
						for(var i=0; i<responseArrayL-2; i++){
						  responseArray2=responseArray[i].split("|");
						  followers[i] = new Array();
						  followers[i]['num'] = parseInt(responseArray2[0]);
						  followers[i]['data'] = responseArray2[1];
						}
						if(followers.length==0){
						  var htmlMain = '<div id="bar'+feedMain+'" style="display: table; width: 100%;"></div>';
					    } else {
                                                           
                                                        /*Importancia de colores*/
										                          
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
										 htmlMain += '<canvas style="cursor: pointer;" onclick="graficaDialogFacebookPage('+comilla+''+feedMain+''+comilla+','+comilla+'2'+comilla+');" id="chart-area'+feedMain+'Pre" width="230" height="230" />';
									   htmlMain += '</div>';
									 htmlMain += '</div>';
								   htmlMain += '</div>';
								 htmlMain += '</div>';
						}
                        
						var fechaStats = '';
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
						/*
						if(feedMain==2){
						  listDialogFacebookPage(identifyLocal,identifyOther,redLocal,imagenRed,3);
						} */
						
					}
                                        if(feedMain==7){
                                          $('.imgIcon'+feedMain+'').attr("src","images/iconoS12Idiomas.png");
                                        }
                                        if(feedMain==8){
                                          $('.imgIcon'+feedMain+'').attr("src","images/iconoS14Ciudades.png");
                                        }            
				},
				error: function (response){
					if(feedMain==7)
					  $('#main-feed'+feedMain+'Text').html(txt245);
					if(feedMain==8)
					  $('#main-feed'+feedMain+'Text').html(txt246);
					if(feedMain==9)
					  $('#main-feed'+feedMain+'Text').html(txt247);
					$('#main-feed'+feedMain+'').html(txt105);
				}
	});
}
function getFacebookStatsBar2(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,tipo){
  var loadStats = '<div class="Knight-Rider-loader animate">';
         loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
	  loadStats += '</div>';
	if(feedMain==8){
	  $('#main-feed'+feedMain+'').html(loadStats);
	  $('#main-feed9').html(loadStats);
	} else {
	  $('#main-feed'+feedMain+'').html(loadStats);
	}
    var parametros = { redP:red, redS:redLocal, identifyP:identify, identifyS:identifyLocal, identifyOther:identifyOther
					 };
	if(feedMain==10)
	  var urlTw = "scripts/get-page-fans-gender-age.php";
	if(feedMain==11)
	  var urlTw = "scripts/get-page-fans-online.php";
	$.ajax({    data:  parametros,
				url:   urlTw,
				type:  'GET',
				success:  function (response) {
					if(feedMain==10)
					  $('#main-feed'+feedMain+'Text').html(txt248);
					if(feedMain==11)
					  $('#main-feed'+feedMain+'Text').html(txt249);
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
						for(var i=0; i<responseArrayL-2; i++){
						  responseArray2=responseArray[i].split("|");
						  followers[i] = new Array();
						  followers[i]['num'] = parseInt(responseArray2[0]);
						  followers[i]['data'] = responseArray2[1];
						}
						if(followers.length==0){
						  var htmlMain = '<div id="bar'+feedMain+'" style="display: table; width: 100%;"></div>';
					    } else {
										                          
							 var htmlMain = '<div style="display: table; width: 100%;">';
                                                               if(feedMain=="10"){
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
                                                               }
                                                               
                                                               if(feedMain=="11"){
								   htmlMain += '<div style="background-color: #CDDDE6; display: table-row; width: 100%;">';
									 htmlMain += '<div style="height: 2.8em; display: table-cell; width: 100%; color: #FFFFFF;">';
										 htmlMain += '<img style="width: 18.1em;" src="images/horariosReloj.png" />';
									 htmlMain += '</div>';
							           htmlMain += '</div>';
                                                               }

								   htmlMain += '<div style="display: table-row; width: 100%;">';
									 htmlMain += '<div style="border-left: 10px solid #009966; border-bottom: 5px solid #006699; text-align: center; display: table-cell; width: 100%;">';
									   htmlMain += '<div id="canvas-holder">';
										 htmlMain += '<canvas style="cursor: pointer;" onclick="graficaDialogFacebookPage('+comilla+''+feedMain+''+comilla+','+comilla+'3'+comilla+');" id="chart-area'+feedMain+'Pre" width="280" height="175" />';
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
	                                                                           htmlMain += '<div style="display: inline-block; width: 0.5em; height: 0.5em; background-color: #009966;"></div> <p style="display: inline-block;">'+txt430+'</p>';
	                                                                         htmlMain += '</div>';
	                                                                       htmlMain += '</div>';
	                                                                       htmlMain += '<div style="display: table-row; width: 100%;">';
	                                                                         htmlMain += '<div style="text-align: left; display: table-cell;">';
	                                                                         if(feedMain==10){
	                                                                           htmlMain += '<div style="display: inline-block; width: 0.5em; height: 0.5em; background-color: #006699;"></div> <p style="display: inline-block;">'+txt428+'</p>';
	                                                                         }
	                                                                         if(feedMain==11){
	                                                                           htmlMain += '<div style="display: inline-block; width: 0.5em; height: 0.5em; background-color: #006699;"></div> <p style="display: inline-block;">'+txt431+'</p>';
	                                                                         }
	                                                                         htmlMain += '</div>';
	                                                                       htmlMain += '</div>';
	                                                                     htmlMain += '</div>';
	                                                                   htmlMain += '</div>';
	                                                                   htmlMain += '<div style="background-color: #D1D9E1; text-align: center; display: table-cell; width: 4em;">';
	                                                                     htmlMain += '<img style="width: 1.5em; display: inline-block;" class="imgIcon'+feedMain+'" />';
	                                                                   if(feedMain==10)
	                                                                     htmlMain += '<img src="images/sim2.png" /><br />'+txt428+'';
	                                                                   if(feedMain==11)
	                                                                     htmlMain += '<img src="images/sim2.png" /><br />'+txt429+'';
	                                                                   htmlMain += '</div>';
	                                                                 htmlMain += '</div>';
	                                                               htmlMain += '</div>';
	                                                             htmlMain += '</div>';
								   htmlMain += '</div>';
								 htmlMain += '</div>';
						}
		
						var fechaStats = '';
						if(feedMain==10){
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
							window["data"+feedMain]["datasets"][0]["data"][0] = 0;
							window["data"+feedMain]["datasets"][1]["data"][0] = 0;
							window["data"+feedMain]["labels"][0] = "13-17";
							window["data"+feedMain]["datasets"][0]["data"][1] = 0;
							window["data"+feedMain]["datasets"][1]["data"][1] = 0;
							window["data"+feedMain]["labels"][1] = "18-24";
							window["data"+feedMain]["datasets"][0]["data"][2] = 0;
							window["data"+feedMain]["datasets"][1]["data"][2] = 0;
							window["data"+feedMain]["labels"][2] = "25-34";
							window["data"+feedMain]["datasets"][0]["data"][3] = 0;
							window["data"+feedMain]["datasets"][1]["data"][3] = 0;
							window["data"+feedMain]["labels"][3] = "35-44";
							window["data"+feedMain]["datasets"][0]["data"][4] = 0;
							window["data"+feedMain]["datasets"][1]["data"][4] = 0;
							window["data"+feedMain]["labels"][4] = "45-54";
							window["data"+feedMain]["datasets"][0]["data"][5] = 0;
							window["data"+feedMain]["datasets"][1]["data"][5] = 0;
							window["data"+feedMain]["labels"][5] = "55-64";
							window["data"+feedMain]["datasets"][0]["data"][6] = 0;
							window["data"+feedMain]["datasets"][1]["data"][6] = 0;
							window["data"+feedMain]["labels"][6] = "65+";
						}
						if(feedMain==11){
							window["data"+feedMain] = new Object();
							window["data"+feedMain]["labels"] = new Array();
							window["data"+feedMain]["datasets"] = new Array();
							window["data"+feedMain]["datasets"][0] = new  Object();
							window["data"+feedMain]["datasets"][0]["fillColor"] = "rgba(255,4,158,0.5)";
							window["data"+feedMain]["datasets"][0]["strokeColor"] = "rgba(255,4,158,0.8)";
							window["data"+feedMain]["datasets"][0]["highlightFill"] = "rgba(255,4,158,0.75)";
							window["data"+feedMain]["datasets"][0]["highlightStroke"] = "rgba(255,4,158,1)";
							window["data"+feedMain]["datasets"][0]["data"] = new Array();
							window["data"+feedMain]["datasets"][0]["data"][0] = 0;
							window["data"+feedMain]["datasets"][0]["data"][1] = 0;
							window["data"+feedMain]["datasets"][0]["data"][2] = 0;
							window["data"+feedMain]["datasets"][0]["data"][3] = 0;
							window["data"+feedMain]["datasets"][0]["data"][4] = 0;
							window["data"+feedMain]["datasets"][0]["data"][5] = 0;
							window["data"+feedMain]["datasets"][0]["data"][6] = 0;
							window["data"+feedMain]["datasets"][0]["data"][7] = 0;
							window["data"+feedMain]["datasets"][0]["data"][8] = 0;
							window["data"+feedMain]["datasets"][0]["data"][9] = 0;
							window["data"+feedMain]["datasets"][0]["data"][10] = 0;
							window["data"+feedMain]["datasets"][0]["data"][11] = 0;
							window["data"+feedMain]["datasets"][0]["data"][12] = 0;
							window["data"+feedMain]["datasets"][0]["data"][13] = 0;
							window["data"+feedMain]["datasets"][0]["data"][14] = 0;
							window["data"+feedMain]["datasets"][0]["data"][15] = 0;
							window["data"+feedMain]["datasets"][0]["data"][16] = 0;
							window["data"+feedMain]["datasets"][0]["data"][17] = 0;
							window["data"+feedMain]["datasets"][0]["data"][18] = 0;
							window["data"+feedMain]["datasets"][0]["data"][19] = 0;
							window["data"+feedMain]["datasets"][0]["data"][20] = 0;
							window["data"+feedMain]["datasets"][0]["data"][21] = 0;
							window["data"+feedMain]["datasets"][0]["data"][22] = 0;
							window["data"+feedMain]["datasets"][0]["data"][23] = 0;
							window["data"+feedMain]["labels"][0] = "24AM";
							window["data"+feedMain]["labels"][1] = "1AM";
							window["data"+feedMain]["labels"][2] = "2AM";
							window["data"+feedMain]["labels"][3] = "3AM";
							window["data"+feedMain]["labels"][4] = "4AM";
							window["data"+feedMain]["labels"][5] = "5AM";
							window["data"+feedMain]["labels"][6] = "6AM";
							window["data"+feedMain]["labels"][7] = "7AM";
							window["data"+feedMain]["labels"][8] = "8AM";
							window["data"+feedMain]["labels"][9] = "9AM";
							window["data"+feedMain]["labels"][10] = "10AM";
							window["data"+feedMain]["labels"][11] = "11AM";
							window["data"+feedMain]["labels"][12] = "12PM";
							window["data"+feedMain]["labels"][13] = "13PM";
							window["data"+feedMain]["labels"][14] = "14PM";
							window["data"+feedMain]["labels"][15] = "15PM";
							window["data"+feedMain]["labels"][16] = "16PM";
							window["data"+feedMain]["labels"][17] = "17PM";
							window["data"+feedMain]["labels"][18] = "18PM";
							window["data"+feedMain]["labels"][19] = "19PM";
							window["data"+feedMain]["labels"][20] = "20PM";
							window["data"+feedMain]["labels"][21] = "21PM";
							window["data"+feedMain]["labels"][22] = "22PM";
							window["data"+feedMain]["labels"][23] = "23PM";
						}
						$('#main-feed'+feedMain+'').html(htmlMain);
						
						if(feedMain==10){
                                                    $('.imgIcon'+feedMain+'').attr("src","images/iconoS15Generos.png");
                                                    $('#imgIconG'+feedMain+'').attr("src","images/iconoS15Generos.png");
                                                }
                                                
                                                if(feedMain==11){
                                                    $('.imgIcon'+feedMain+'').attr("src","images/iconoS16Horarios.png");
                                                    $('#imgIconG'+feedMain+'').attr("src","images/iconoS16Horarios.png");
                                                }
                                                  
						if(followers.length==0){
						  $('#bar'+feedMain+'').html("<br /><br /><br />"+txt250+"<br /><br /><br /><br />");
						} else {
							for(var i=0; i<followers.length; i++){
							  if(followers[i]["data"].substr(0,1)!="U" && feedMain==10){
								if(followers[i]["data"].substr(2,5)=="13-17" && 
								   followers[i]["data"].substr(0,1)=="F"){
							      window["data"+feedMain]["datasets"][0]["data"][0] = followers[i]["num"];
							      window["data"+feedMain]["labels"][0] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
						   
							    } else if(followers[i]["data"].substr(2,5)=="13-17" && 
								   followers[i]["data"].substr(0,1)=="M"){
							      window["data"+feedMain]["datasets"][1]["data"][0] = followers[i]["num"];
								  window["data"+feedMain]["labels"][0] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } 
								if(followers[i]["data"].substr(2,5)=="18-24" && 
								   followers[i]["data"].substr(0,1)=="F"){
							    window["data"+feedMain]["datasets"][0]["data"][1] = followers[i]["num"];
							    window["data"+feedMain]["labels"][1] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } else if(followers[i]["data"].substr(2,5)=="18-24" && 
								   followers[i]["data"].substr(0,1)=="M"){
							    window["data"+feedMain]["datasets"][1]["data"][1] = followers[i]["num"];
								window["data"+feedMain]["labels"][1] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } 
								if(followers[i]["data"].substr(2,5)=="25-34" && 
								   followers[i]["data"].substr(0,1)=="F"){
							      window["data"+feedMain]["datasets"][0]["data"][2] = followers[i]["num"];
							      window["data"+feedMain]["labels"][2] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } else if(followers[i]["data"].substr(2,5)=="25-34" && 
								   followers[i]["data"].substr(0,1)=="M"){
							      window["data"+feedMain]["datasets"][1]["data"][2] = followers[i]["num"];                         
								  window["data"+feedMain]["labels"][2] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } 
								if(followers[i]["data"].substr(2,5)=="35-44" && 
								   followers[i]["data"].substr(0,1)=="F"){
							      window["data"+feedMain]["datasets"][0]["data"][3] = followers[i]["num"];
							      window["data"+feedMain]["labels"][3] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } else if(followers[i]["data"].substr(2,5)=="35-44" && 
								   followers[i]["data"].substr(0,1)=="M"){
							      window["data"+feedMain]["datasets"][1]["data"][3] = followers[i]["num"];
								  window["data"+feedMain]["labels"][3] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } 
								if(followers[i]["data"].substr(2,5)=="45-54" && 
								   followers[i]["data"].substr(0,1)=="F"){
							      window["data"+feedMain]["datasets"][0]["data"][4] = followers[i]["num"];
							      window["data"+feedMain]["labels"][4] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } else if(followers[i]["data"].substr(2,5)=="45-54" && 
								   followers[i]["data"].substr(0,1)=="M"){
							      window["data"+feedMain]["datasets"][1]["data"][4] = followers[i]["num"];
								  window["data"+feedMain]["labels"][4] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    }
								if(followers[i]["data"].substr(2,5)=="55-64" && 
								   followers[i]["data"].substr(0,1)=="F"){
							      window["data"+feedMain]["datasets"][0]["data"][5] = followers[i]["num"];
							      window["data"+feedMain]["labels"][5] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } else if(followers[i]["data"].substr(2,5)=="55-64" && 
								   followers[i]["data"].substr(0,1)=="M"){
							      window["data"+feedMain]["datasets"][1]["data"][5] = followers[i]["num"];
								  window["data"+feedMain]["labels"][5] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    }
								if(followers[i]["data"].substr(2,5)=="65+" && 
								   followers[i]["data"].substr(0,1)=="F"){
							      window["data"+feedMain]["datasets"][0]["data"][6] = followers[i]["num"];
							      window["data"+feedMain]["labels"][6] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } else if(followers[i]["data"].substr(2,5)=="65+" && 
								   followers[i]["data"].substr(0,1)=="M"){
							      window["data"+feedMain]["datasets"][1]["data"][6] = followers[i]["num"];
								  window["data"+feedMain]["labels"][6] = ""+followers[i]["data"].substr(2,followers[i]["data"].length)+"";
							    } 
							  }//fin if 10
							  if(feedMain==11){
							    if(followers[i]["data"]==0)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==1)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==2)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==3)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==4)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==5)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==6)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==7)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==8)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==9)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==10)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==11)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==12)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==13)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==14)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==15)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==16)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==17)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==18)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==19)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==20)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==21)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==22)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								if(followers[i]["data"]==23)
								   window["data"+feedMain]["datasets"][0]["data"][followers[i]["data"]] = followers[i]["num"];
								   
							  }//fin if 11
							}//fin for
							var ctx1 = document.getElementById("chart-area"+feedMain+"Pre").getContext("2d");
                            myPie = new Chart(ctx1).Bar(window["data"+feedMain], {
								responsive : true,
								//String - A legend template
                                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
								
							});
						}
						/*
						if(feedMain==2){
						  listDialogFacebookPage(identifyLocal,identifyOther,redLocal,imagenRed,3);
						} */
						
					}
				},
				error: function (response){
					if(feedMain==10)
					  $('#main-feed'+feedMain+'Text').html(txt248);
					if(feedMain==11)
					  $('#main-feed'+feedMain+'Text').html(txt249);
					$('#main-feed'+feedMain+'').html(txt105);
				}
	});
}
function getFacebookPageStatsLine(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,tipo){
  var loadStats = '<div class="Knight-Rider-loader animate">';
         loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
		 loadStats += '<div class="Knight-Rider-bar"></div>';
	  loadStats += '</div>';
	if(feedMain==8){
	  $('#main-feed'+feedMain+'').html(loadStats);
	  $('#main-feed9').html(loadStats);
	} else {
	  $('#main-feed'+feedMain+'').html(loadStats);
	}
    var parametros = { redP:red, redS:redLocal, identifyP:identify, identifyS:identifyLocal, identifyOther:identifyOther
					 };
	if(feedMain==1)
	  var urlTw = "scripts/get-page-lifetime.php";
	else if(feedMain==2)
	  var urlTw = "scripts/get-page-likes-total.php";
	else if(feedMain==3)
	  var urlTw = "scripts/get-page-likes-paid.php";
	else if(feedMain==4)
	  var urlTw = "scripts/get-page-likes-unpaid.php";
	else if(feedMain==5)
	  var urlTw = "scripts/get-page-likes-remove.php";
	else if(feedMain==6)
	  var urlTw = "scripts/get-page-admin-num-posts.php";
	else if(feedMain==12)
	  var urlTw = "scripts/get-page-fans-online-per.php";
	$.ajax({    data:  parametros,
				url:   urlTw,
				type:  'GET',
				success:  function (response) {
					if(feedMain==1)
					  $('#main-feed'+feedMain+'Text').html(txt238);
					else if(feedMain==2)
					  $('#main-feed'+feedMain+'Text').html(txt239);
					else if(feedMain==3)
					  $('#main-feed'+feedMain+'Text').html(txt240);
					else if(feedMain==4)
					  $('#main-feed'+feedMain+'Text').html(txt241);
					else if(feedMain==5)
					  $('#main-feed'+feedMain+'Text').html(txt242);
					else if(feedMain==6)
					  $('#main-feed'+feedMain+'Text').html(txt243);
					else if(feedMain==12)
					  $('#main-feed'+feedMain+'Text').html(txt244);
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
								   htmlMain += '<article onclick="graficaDialogFacebookPage('+comilla+''+feedMain+''+comilla+','+comilla+'1'+comilla+');" class="example">';
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
						/*
						if(feedMain==2){
						  listDialogFacebookPage(identifyLocal,identifyOther,redLocal,imagenRed,3);
						} */
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
                                                if(feedMain==1){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS6LikesOb.png");
                                                  $('#imgIconG'+feedMain+'').attr("src","images/iconoS6LikesOb.png");
                                                }
                                                if(feedMain==2){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS7Likes.png");
                                                  $('#imgIconG'+feedMain+'').attr("src","images/iconoS7Likes.png");
                                                }
                                                if(feedMain==3){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS8LikesP.png");
                                                  $('#imgIconG'+feedMain+'').attr("src","images/iconoS8LikesP.png");
                                                }
                                                if(feedMain==4){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS9LikesOr.png");
                                                  $('#imgIconG'+feedMain+'').attr("src","images/iconoS9LikesOr.png");
                                                }
                                                if(feedMain==5){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS10LikesPe.png");
                                                  $('#imgIconG'+feedMain+'').attr("src","images/iconoS10LikesPe.png");
                                                }
                                                if(feedMain==6){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS11AdminP.png");
                                                  $('#imgIconG'+feedMain+'').attr("src","images/iconoS11AdminP.png");
                                                }
                                                if(feedMain==12){
                                                  $('.imgIcon'+feedMain+'').attr("src","images/iconoS17Fans.png");
                                                  $('#imgIconG'+feedMain+'').attr("src","images/iconoS17Fans.png");
                                                }
						var myChart = new xChart('line-dotted', window["data"+feedMain], '#main-feed'+feedMain+'StatsPre', opts);
					}
				},
				error: function (response){
					if(feedMain==1)
					  $('#main-feed'+feedMain+'Text').html(txt238);
					else if(feedMain==2)
					  $('#main-feed'+feedMain+'Text').html(txt239);
					else if(feedMain==3)
					  $('#main-feed'+feedMain+'Text').html(txt240);
					else if(feedMain==4)
					  $('#main-feed'+feedMain+'Text').html(txt241);
					else if(feedMain==5)
					  $('#main-feed'+feedMain+'Text').html(txt242);
					else if(feedMain==6)
					  $('#main-feed'+feedMain+'Text').html(txt243);
					else if(feedMain==12)
					  $('#main-feed'+feedMain+'Text').html(txt244);
					$('#main-feed'+feedMain+'').html(txt105);
				}
	});
}