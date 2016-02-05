var arrayUserOrder;
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
function altaMovCli(){
  $('#tabs').tabs({ active: 1 });
  altaClientes(0);
}
function mapa(){
	google.load("visualization", "1", {packages:["geochart"]});
        google.setOnLoadCallback(drawRegionsMap);
	
	function drawRegionsMap() {
	
	  var data = google.visualization.arrayToDataTable([
	    ['Country', txt326],
	  ]);
	
	  var options = {};
	
	  var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
	
	  chart.draw(data, options);
	}
}
function getMapa(){
  openDialog();
  var parametros = { id_token:id_token };
  $.ajax({data:parametros,
          url:'scripts/CRM/get-mapa.php',
	  type:'POST',
	  success:  function (response) { 
	    obj = JSON.parse(response);
            console.log(obj.length);
            if(obj.length==0){
	      var data = google.visualization.arrayToDataTable([
	        ['Country', txt326],
	      ]);
	      var options = {};
	      var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
              chart.draw(data, options);
              toastr["error"](txt399, "ERROR");
            } else if(obj.error){
              var data = google.visualization.arrayToDataTable([
	        ['Country', txt326],
	      ]);
	      var options = {};
	      var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
              chart.draw(data, options);
              toastr["error"](txt399, "ERROR");   
            } else {
                var data = [["Country",txt326]];
                for(var ljoep=1; ljoep<obj.length; ljoep++){
                  var item = [Object.keys(obj[ljoep]).toString(),obj[ljoep][Object.keys(obj[ljoep])]];
                  data.push(item);
                }
		var data = google.visualization.arrayToDataTable(data);
		
		var options = {};
		
		var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
		
		chart.draw(data, options);
            }
	    $(".ui-dialog-titlebar-close").show();
  	    $("#cargando").dialog("close");    
	  },
	  error: function (response){
	    toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
	    $(".ui-dialog-titlebar-close").show();
  	    $("#cargando").dialog("close");
 	  }
  });
}
function getCalendar(){
  openDialog();
  var parametros = { id_token:id_token };
  $.ajax({data:parametros,
          url:'scripts/CRM/get-calendar.php',
	  type:'POST',
	  success:  function (response) { 
	    obj = JSON.parse(response);
	    if(obj[0]){
	      $('#calendario').fullCalendar('removeEvents');
	      $('#calendario').fullCalendar('addEventSource', obj);
	      $('#calendario').fullCalendar('refetchEvents');
	    } else if(obj.error){
              $('#calendario').fullCalendar('removeEvents');
	      $('#calendario').fullCalendar('addEventSource', obj);
	      $('#calendario').fullCalendar('refetchEvents');
              toastr["error"](txt396, "ERROR");
            } else {
              $('#calendario').fullCalendar('removeEvents');
	      $('#calendario').fullCalendar('addEventSource', obj);
	      $('#calendario').fullCalendar('refetchEvents');
	      toastr["error"](txt396, "ERROR");
	    }
	    $(".ui-dialog-titlebar-close").show();
  	    $("#cargando").dialog("close");
	    
	  },
	  error: function (response){
	    toastr["error"]("Inténtelo de nuevo más tarde", "ERROR");
	    $(".ui-dialog-titlebar-close").show();
  	    $("#cargando").dialog("close");
 	  }
  });
}
function delCRM(mensaje){
  openDialog();
	$.ajax({	data:  { id:mensaje},
				url:   "scripts/CRM/eliminar.php",
				type:  "post",
				success:  function (response) {
				  toastr["info"](txt375);
                                  consultaClientes();
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				} , error: function(response){
				  toastr["error"](txt92);
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				}
		});
}
function orderSS(option){
      if(option==1){
        arrayUserOrder.sort(function(a, b){
	  if(a[1].toUpperCase() < b[1].toUpperCase()) return -1;
          if(a[1].toUpperCase() > b[1].toUpperCase()) return 1;
        });
      }
      if(option==2){
        arrayUserOrder.sort(function(a, b){
	  if(a[2].toUpperCase() < b[2].toUpperCase()) return -1;
          if(a[2].toUpperCase() > b[2].toUpperCase()) return 1;
        });
      }
      if(option==3){
        arrayUserOrder.sort(function(a, b){
	  if(a[3].toUpperCase() < b[3].toUpperCase()) return -1;
          if(a[3].toUpperCase() > b[3].toUpperCase()) return 1;
        });
      }
      if(option==6){
        arrayUserOrder.sort(function(a, b){
	  if(a[6].toUpperCase() < b[6].toUpperCase()) return -1;
          if(a[6].toUpperCase() > b[6].toUpperCase()) return 1;
        });
      }
      if(option==7){
        arrayUserOrder.sort(function(a, b){
	  if(a[7].toUpperCase() < b[7].toUpperCase()) return -1;
          if(a[7].toUpperCase() > b[7].toUpperCase()) return 1;
        });
      }
      if(option==8){
        arrayUserOrder.sort(function(a, b){
	  if(a[8].toUpperCase() < b[8].toUpperCase()) return -1;
          if(a[8].toUpperCase() > b[8].toUpperCase()) return 1;
        });
      }
      if(option==9){
        arrayUserOrder.sort(function(a, b){
	  if(a[9].toUpperCase() < b[9].toUpperCase()) return -1;
          if(a[9].toUpperCase() > b[9].toUpperCase()) return 1;
        });
      }
      if(option==10){
        arrayUserOrder.sort(function(a, b){
	  if(a[10].toUpperCase() < b[10].toUpperCase()) return -1;
          if(a[10].toUpperCase() > b[10].toUpperCase()) return 1;
        });
      }
      /* order fechas
      if(option==13){
        arrayUserOrder.sort(function(a, b){
          var aa = a[13].split("-");
          var bb = b[13].split("-");

          var aaa = aa[2].split(" ");
          var bbb = bb[2].split(" ");  

          var aaaa = aaa[0] +"-"+ aa[1] +"-"+ aa[0]; 
          var bbbb = bbb[0] +"-"+ bb[1] +"-"+ bb[0]; 

	  if(aaaa < bbbb) return -1;
          if(aaaa > bbbb) return 1;
        });
      }
      */
      if(option==14){
        arrayUserOrder.sort(function(a, b){
	  if(a[15].toUpperCase() < b[15].toUpperCase()) return -1;
          if(a[15].toUpperCase() > b[15].toUpperCase()) return 1;
        });
      }
      openDialog();
      var htmlCRM = '<div style="display: table-row;">';
	  htmlCRM += '<div style="text-align: center; width: 2em; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 2em; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt353 + ' ' + '<img onclick="orderSS(1);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt359 + ' ' + '<img onclick="orderSS(2);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt360 + ' ' + '<img onclick="orderSS(3);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 150px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';	
	  htmlCRM += txt354;
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt356;
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt362 + ' ' + '<img onclick="orderSS(8);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt288 + ' ' + '<img onclick="orderSS(9);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt394 + ' ' + '<img onclick="orderSS(14);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 150px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt366 + ' ' + '<img onclick="orderSS(10);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt361 + ' ' + '<img onclick="orderSS(6);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt363 + ' ' + '<img onclick="orderSS(7);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 250px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt355;
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 200px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt365;
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 1100px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt371;
	  htmlCRM += '</div>';
	htmlCRM += '</div>';
	for(var zxc1=0; zxc1<arrayUserOrder.length; zxc1++){
		htmlCRM += '<div class="colorEven" style="height: 28px; display: table-row;">';
		  htmlCRM += '<div style="cursor: pointer; vertical-align: middle; font-size: .7em; display: table-cell;" onclick="delCRM('+comilla+''+arrayUserOrder[zxc1][0]+''+comilla+');">';
		    htmlCRM += '<img src="images/del2.png" style="width: 2em;">';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="cursor: pointer; vertical-align: middle; font-size: .7em; display: table-cell;" onclick="altaClientes('+comilla+''+arrayUserOrder[zxc1][0]+''+comilla+');">';
		    htmlCRM += '<img src="images/edit2.png" style="width: 2em;">';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][1];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][2];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][3];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][11];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][12];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][8];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][9];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][15];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][10];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][6];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][7];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][4];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][5];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][14];
		  htmlCRM += '</div>';
		htmlCRM += '</div>';
	}//fin for
	htmlCRM += '</div>';
	$("#tab1Sub").html(htmlCRM);
	$(".colorEven:even").css("background-color","#EEEEEE"); 
	$(".ui-dialog-titlebar-close").show();
	$("#cargando").dialog("close");
}
function buscarArraUser(){
        openDialog();
        var palabraArra12 = quitarAcentos($('#palabraArrayUser').val()).toUpperCase();
	var htmlCRM = '<div style="display: table-row;">';
	  htmlCRM += '<div style="text-align: center; width: 2em; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 2em; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt353 + ' ' + '<img onclick="orderSS(1);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt359 + ' ' + '<img onclick="orderSS(2);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt360 + ' ' + '<img onclick="orderSS(3);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 150px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';	
	  htmlCRM += txt354;
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt356;
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt362 + ' ' + '<img onclick="orderSS(8);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt288 + ' ' + '<img onclick="orderSS(9);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt394 + ' ' + '<img onclick="orderSS(14);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 150px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt366 + ' ' + '<img onclick="orderSS(10);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt361 + ' ' + '<img onclick="orderSS(6);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt363 + ' ' + '<img onclick="orderSS(7);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
	  htmlCRM += '</div>';
          htmlCRM += '<div style="text-align: center; width: 250px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt355;
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 200px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt365;
	  htmlCRM += '</div>';
	  htmlCRM += '<div style="text-align: center; width: 1100px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
	  htmlCRM += txt371;
	  htmlCRM += '</div>';
	htmlCRM += '</div>';
	for(var zxc1=0; zxc1<arrayUserOrder.length; zxc1++){
          if( (quitarAcentos(arrayUserOrder[zxc1][0]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][1]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][2]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][3]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][4]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][5]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][6]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][7]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][8]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][9]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][10]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][11]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][12]).toUpperCase().indexOf(palabraArra12)!="-1") ||
              (quitarAcentos(arrayUserOrder[zxc1][15]).toUpperCase().indexOf(palabraArra12)!="-1")){
		htmlCRM += '<div class="colorEven" style="height: 28px; display: table-row;">';
		  htmlCRM += '<div style="cursor: pointer; vertical-align: middle; font-size: .7em; display: table-cell;" onclick="delCRM('+comilla+''+arrayUserOrder[zxc1][0]+''+comilla+');">';
		    htmlCRM += '<img src="images/del2.png" style="width: 2em;">';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="cursor: pointer; vertical-align: middle; font-size: .7em; display: table-cell;" onclick="altaClientes('+comilla+''+arrayUserOrder[zxc1][0]+''+comilla+');">';
		    htmlCRM += '<img src="images/edit2.png" style="width: 2em;">';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][1];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][2];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][3];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][11];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][12];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][8];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][9];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][15];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][10];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][6];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][7];
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][4];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][5];
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
		    htmlCRM += arrayUserOrder[zxc1][14];
		  htmlCRM += '</div>';
		htmlCRM += '</div>';
          }//fin if
	}//fin for
	htmlCRM += '</div>';
	$("#tab1Sub").html(htmlCRM);
	$(".colorEven:even").css("background-color","#EEEEEE"); 
	$(".ui-dialog-titlebar-close").show();
	$("#cargando").dialog("close");
}
function consultaClientes(){
  openDialog();
  var parametros = { id_token:id_token };
  $.ajax({  data:  parametros,
	    url:   "scripts/CRM/consultar.php",
	    type:  "POST",
	    success:  function (response) {
              var htmlCRM = '';
              obj = JSON.parse(response);
		htmlCRM += '<div style="display: table-row;">';
		  htmlCRM += '<div style="text-align: center; width: 2em; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="text-align: center; width: 2em; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt353 + ' ' + '<img onclick="orderSS(1);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt359 + ' ' + '<img onclick="orderSS(2);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt360 + ' ' + '<img onclick="orderSS(3);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="text-align: center; width: 150px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';	
		  htmlCRM += txt354;
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt356;
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt362 + ' ' + '<img onclick="orderSS(8);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt288 + ' ' + '<img onclick="orderSS(9);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt394 + ' ' + '<img onclick="orderSS(14);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="text-align: center; width: 150px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt366 + ' ' + '<img onclick="orderSS(10);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt361 + ' ' + '<img onclick="orderSS(6);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="text-align: center; width: 400px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt363 + ' ' + '<img onclick="orderSS(7);" src="images/order.png" style="width: 20px; cursor: pointer;" />';
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="text-align: center; width: 250px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt355;
		  htmlCRM += '</div>';
		  htmlCRM += '<div style="text-align: center; width: 200px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt365;
		  htmlCRM += '</div>';
                  htmlCRM += '<div style="text-align: center; width: 1100px; color: #FFFFFF; background-color: #2e70b9; display: table-cell;">';
		  htmlCRM += txt371;
		  htmlCRM += '</div>';
		htmlCRM += '</div>';
              arrayUserOrder = new Array();
              for(var zxc1=0; zxc1<obj.length; zxc1++){
                arrayUserOrder[zxc1] = new Array();
                arrayUserOrder[zxc1][0] = obj[zxc1].id;
		arrayUserOrder[zxc1][1] = obj[zxc1].nombre;
		arrayUserOrder[zxc1][2] = obj[zxc1].apellidoPaterno;
		arrayUserOrder[zxc1][3] = obj[zxc1].apellidoMaterno;
		arrayUserOrder[zxc1][4] = obj[zxc1].sexo;
		arrayUserOrder[zxc1][5] = obj[zxc1].edad;
		arrayUserOrder[zxc1][6] = obj[zxc1].red_social;
		arrayUserOrder[zxc1][7] = obj[zxc1].nombre_de_usuario;
		arrayUserOrder[zxc1][8] = obj[zxc1].empresa;
		arrayUserOrder[zxc1][15] = obj[zxc1].country;
		arrayUserOrder[zxc1][9] = obj[zxc1].estado;
		arrayUserOrder[zxc1][10] = obj[zxc1].direccion;
		arrayUserOrder[zxc1][11] = obj[zxc1].mail;
		arrayUserOrder[zxc1][12] = obj[zxc1].telefono;
		arrayUserOrder[zxc1][14] = obj[zxc1].observaciones;
                htmlCRM += '<div class="colorEven" style="height: 28px; display: table-row;">';
                  htmlCRM += '<div style="cursor: pointer; vertical-align: middle; font-size: .7em; display: table-cell;" onclick="delCRM('+comilla+''+obj[zxc1].id+''+comilla+');">';
                    htmlCRM += '<img src="images/del2.png" style="width: 2em;">';
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="cursor: pointer; vertical-align: middle; font-size: .7em; display: table-cell;" onclick="altaClientes('+comilla+''+obj[zxc1].id+''+comilla+');">';
                    htmlCRM += '<img src="images/edit2.png" style="width: 2em;">';
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].nombre;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].apellidoPaterno;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].apellidoMaterno;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].mail;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].telefono;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].empresa;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].estado;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].country;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].direccion;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].red_social;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].nombre_de_usuario;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].sexo;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].edad;
                  htmlCRM += '</div>';
                  htmlCRM += '<div style="vertical-align: middle; font-size: .7em; display: table-cell;">';
                    htmlCRM += obj[zxc1].observaciones;
                  htmlCRM += '</div>';
                htmlCRM += '</div>';
              }
              htmlCRM += '</div>';
              $("#tab1Sub").html(htmlCRM);
              $(".colorEven:even").css("background-color","#EEEEEE"); 
	      $(".ui-dialog-titlebar-close").show();
              $("#cargando").dialog("close");
	    }, error:  function (response) {
              toastr["error"](txt92);
	      $(".ui-dialog-titlebar-close").show();
              $("#cargando").dialog("close");
	    }
          });
}
function mostrarCRM(datos){
  if($("#redCRM").val()=="no"){
    $("#nombreUsuarioCRM").val("");
    $("#nombreUsuarioCRM").html("");
    $("#nombreUsuarioCRM").css("display","none");
  } else {
    $("#nombreUsuarioCRM").css("display","block");
    var htmlNUCRM = '';
    if(datos && datos!="undefined")
      htmlNUCRM += ''+txt363+': <input type="text" style="width: 100%;" id="nombreUsuario2CRM" value="'+datos+'" />';
    else
      htmlNUCRM += ''+txt363+': <input type="text" style="width: 100%;" id="nombreUsuario2CRM" value="" />';
    $("#nombreUsuarioCRM").html(htmlNUCRM);
  }
}
function guardarClientes(option, id){
  openDialog();
  /*
  if(!$("#nombreCRM").val()){
    toastr["warning"](txt367);
  } else if(!$("#apellidoPaternoCRM").val()){
    toastr["warning"](txt367);
  } else if(!$("#apellidoMaternoCRM").val()){
    toastr["warning"](txt367);
  } else if(!$("#sexoCRM").val()){
    toastr["warning"](txt367);
  } else if(!$("#edadCRM").val()){
    toastr["warning"](txt367);
  } else if(!$("#redCRM").val()){
    toastr["warning"](txt367);
  } else if(!$("#nombreUsuarioCRM").val() && $("#redCRM").val()!="no"){
    toastr["warning"](txt367);
  } else if(!$("#empresaCRM").val()){
    toastr["warning"](txt367);
  } else if(!$("#estadoCRM").val()){
    toastr["warning"](txt367);
  } else if(!$("#direccionCRM").val()){
    toastr["warning"](txt367);
  }  else if(!$("#mailCRM").val()){
    toastr["warning"](txt367);
  } else if(!$("#telefonoCRM").val()){
    toastr["warning"](txt367);
  } else if(!$("#observacionesCRM").val()){
    toastr["warning"](txt367);
  } */
  if(true){
    var parametros = { id:id,
                       id_token:id_token,
                       nombre:$("#nombreCRM").val(),
                       apellidoPaterno:$("#apellidoPaternoCRM").val(),
                       apellidoMaterno:$("#apellidoMaternoCRM").val(),
                       sexo:$("#sexoCRM").val(),
                       edad:$("#edadCRM").val(),
                       red:$("#redCRM").val(),
                       nombreUsuario:$("#nombreUsuario2CRM").val(),
                       empresa:$("#empresaCRM").val(),
                       country:$("#CountryCRM").val(),
                       estado:$("#estadoCRM").val(),
                       direccion:$("#direccionCRM").val(),
                       mail:$("#mailCRM").val(),
                       telefono:$("#telefonoCRM").val(),
                       observaciones:$("#observacionesCRM").val()};
    if(option==0)
      var urlCRM = 'scripts/CRM/agregar.php';
    if(option==1)
      var urlCRM = 'scripts/CRM/agregar_mod.php';
    $.ajax({data:  parametros,
	    url:   urlCRM,
	    type:  "POST",
	    success:  function (response) {
              toastr["success"](txt194);
              $('#tabs').tabs({ active: 0 });
              consultaClientes();
	      $(".ui-dialog-titlebar-close").show();
              $("#cargando").dialog("close");
	    }, error:  function (response) {
              toastr["error"](txt92);
	      $(".ui-dialog-titlebar-close").show();
              $("#cargando").dialog("close");
	    }
    });
  }
}
function guardarEvento(option, id){
  openDialog();
  if(document.getElementById("timepicker2").value && document.getElementById("datepicker2").value) {
    var timePrArray = document.getElementById("timepicker2").value;
	timePr = timePrArray.split(":");
	timePrH = timePr[0];
	timePrMArray = timePr[1].split(" ");
	timePrM = timePrMArray[0];
	timeP = timePrH + "" +timePrM;
	var date = new Date();
	timeRFecha = date.getDate() + "/" +(date.getMonth()+1) + "/" +  date.getFullYear();
	timeR = date.getHours() + "" +date.getMinutes() + " ";
	
	timeRFechaParse = monthNames[parseInt(date.getMonth())] + " " +date.getDate() + ", " +  date.getFullYear();
	timePFechaArray = document.getElementById("datepicker").value.split("-");
	timePFechaParse = monthNames[parseInt(timePFechaArray[1]-1)] + " " +timePFechaArray[0] + ", " +  timePFechaArray[2];

    var fecha = document.getElementById("datepicker2").value + " " + 
						timePrH + ":" +timePrM;
    if(document.getElementById("timepicker3").value && document.getElementById("datepicker3").value) {
      var timePrArray = document.getElementById("timepicker3").value;
	timePr = timePrArray.split(":");
	timePrH = timePr[0];
	timePrMArray = timePr[1].split(" ");
	timePrM = timePrMArray[0];
	timeP = timePrH + "" +timePrM;
	var date = new Date();
	timeRFecha = date.getDate() + "/" +(date.getMonth()+1) + "/" +  date.getFullYear();
	timeR = date.getHours() + "" +date.getMinutes() + " ";
	
	timeRFechaParse = monthNames[parseInt(date.getMonth())] + " " +date.getDate() + ", " +  date.getFullYear();
	timePFechaArray = document.getElementById("datepicker").value.split("-");
	timePFechaParse = monthNames[parseInt(timePFechaArray[1]-1)] + " " +timePFechaArray[0] + ", " +  timePFechaArray[2];

      var fecha2 = document.getElementById("datepicker3").value + " " + 
						timePrH + ":" +timePrM;
    } 
  } else if((document.getElementById("timepicker2").value && !document.getElementById("datepicker2").value) ||
            (!document.getElementById("timepicker2").value && document.getElementById("datepicker2").value)) {
    var fecha = '';
    toastr["warning"](txt369);
    $(".ui-dialog-titlebar-close").show();
    $("#cargando").dialog("close");
  }  else if((document.getElementById("timepicker3").value && !document.getElementById("datepicker3").value) ||
            (!document.getElementById("timepicker3").value && document.getElementById("datepicker3").value)) {
    var fecha2 = '';
    toastr["warning"](txt369);
    $(".ui-dialog-titlebar-close").show();
    $("#cargando").dialog("close");
  } 
  if($("#tituloEvento").val()==""){
    toastr["warning"](txt405);
    $(".ui-dialog-titlebar-close").show();
    $("#cargando").dialog("close");
  }
  if( (document.getElementById("timepicker2").value && document.getElementById("datepicker2").value) ||
      ( (document.getElementById("timepicker2").value && document.getElementById("datepicker2").value) &&
      ( (document.getElementById("timepicker3").value && !document.getElementById("datepicker3").value)|| 
        (!document.getElementById("timepicker3").value && document.getElementById("datepicker3").value))) && $("#tituloEvento").val()){
    var parametros = { id:id,
                       id_token:id_token,
                       titulo:$("#tituloEvento").val(),
                       ubicacion:$("#ubicacionEvento").val(),
                       color:$("#colorEvento").val(),
                       fecha:fecha,
                       fecha2:fecha2};
    if(option==0)
      var urlCRM = 'scripts/CRM/agregarEvento.php';
    if(option==1)
      var urlCRM = 'scripts/CRM/agregarEvento_mod.php';
    $.ajax({data:  parametros,
	    url:   urlCRM,
	    type:  "POST",
	    success:  function (response) {
              toastr["success"](txt194);
              getCalendar();
              $("#ventana").dialog("close");
	      $(".ui-dialog-titlebar-close").show();
              $("#cargando").dialog("close");
	    }, error:  function (response) {
              toastr["error"](txt92);
              getCalendar();
              $("#ventana").dialog("close");
	      $(".ui-dialog-titlebar-close").show();
              $("#cargando").dialog("close");
	    }
    });
  }
}
function eliminarEvento(mensaje){
  openDialog();
	$.ajax({	data:  { id:mensaje},
				url:   "scripts/CRM/eliminarEvento.php",
				type:  "post",
				success:  function (response) {
				  toastr["info"](txt406);
                                  getCalendar();
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
                                  $("#ventana").dialog("close");
				} , error: function(response){
				  toastr["error"](txt92);
                                  $(".ui-dialog-titlebar-close").show();
  		                  $("#cargando").dialog("close");
				}
		});
}
function changeDate(){
  $("#datepicker3").val($("#datepicker2").val());
  $("#timepicker3").val($("#timepicker2").val());
}
function agregarEvento(mensaje){
  openDialog();
  $('.ui-dialog-content').show();
  $("#ventana").dialog("open");
  $("#ventana").dialog('option', 'title', txt402);
  $("#ventana").dialog('option', 'width', 800);
  var eventoHTML = '';
  if(mensaje==0){
       eventoHTML += ''+txt403+': <input type="text" style="width: 100%;" id="tituloEvento" value="" />';
       eventoHTML += ''+txt404+': <input type="text" style="width: 100%;" id="ubicacionEvento" value="" />';
       eventoHTML += ''+txt393+': <select style="width: 100%;" id="colorEvento"><option>black</option><option>green</option><option>grey</option><option>blue</option><option>red</option><option>yellow</option><option>purple</option></select>'; 
       eventoHTML += ''+txt368+': <br />'+txt389+': '+txt79+': <input onchange="changeDate();" type="text" style="width: 10em; margin-left: 3.05em;" id="datepicker2" value="" /> '+txt80+': <input onchange="changeDate();" type="text" style="width: 10em;" id="timepicker2" value="08:00 AM" /><br />'+txt390+': '+txt79+': <input type="text" style="width: 10em;" id="datepicker3" value="" /> '+txt80+': <input type="text" style="width: 10em;" id="timepicker3" value="08:00 AM" /><br />'; 
       eventoHTML += '<button class="btn btn-success" onclick="guardarEvento(0,'+comilla+''+comilla+');" style="text-align: center; margin-top: 1em; width: 7em; float: left;">'+txt57+'</button>';
    $("#cargando").dialog("close");
    $(".ui-dialog-titlebar-close").show();
	  $("#ventana").html(eventoHTML);
	  $(function() {
	    $("#datepicker2").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      "dateFormat": 'dd-mm-yy',
	      minDate: 0,
	      showOn: "both",
	      buttonImage: "images/calendar.gif",
	      buttonImageOnly: false,
	      buttonText: "Select date"
	    });
	    $("#datepicker3").datepicker({
	      changeMonth: true,
	      changeYear: true,
	      "dateFormat": 'dd-mm-yy',
	      minDate: 0,
	      showOn: "both",
	      buttonImage: "images/calendar.gif",
	      buttonImageOnly: false,
	      buttonText: "Select date"
	    });
	  });
	  if($("#datepicker2").val()==""){
	    $("#datepicker2").datepicker('setDate',new Date());
	    $("#datepicker3").datepicker('setDate',new Date());
	  }
	  $('#timepicker2').timepicker({ 'scrollDefault': 'now', 'step': 15, 'timeFormat': 'H:i A' });
	  $('#timepicker3').timepicker({ 'scrollDefault': 'now', 'step': 15, 'timeFormat': 'H:i A' });
  } else {
    var parametros = { id:mensaje };
    $.ajax({  data:  parametros,
	      url:   "scripts/CRM/modificarEvento.php",
	      type:  "POST",
	      success:  function (response) {
                obj = JSON.parse(response);
                if(obj[0]){
	                eventoHTML += ''+txt403+': <input type="text" style="width: 100%;" id="tituloEvento" value="'+obj[0].titulo+'" />';
	                eventoHTML += ''+txt404+': <input type="text" style="width: 100%;" id="ubicacionEvento" value="'+obj[0].ubicacion+'" />';
	                eventoHTML += ''+txt393+': <select style="width: 100%;" id="colorEvento"><option selected="selected">'+obj[0].color+'</option><option>black</option><option>green</option><option>grey</option><option>blue</option><option>red</option><option>yellow</option><option>purple</option></select>'; 
	                var fechaEvento = obj[0].fecha.split(" ");
	                if(fechaEvento[0] && fechaEvento[0]!="undefined"){
			  eventoHTML += ''+txt368+': <br />'+txt389+': '+txt79+': <input onchange="changeDate();" type="text" style="width: 10em; margin-left: 3.05em;" id="datepicker2" value="'+fechaEvento[0]+'" /> '+txt80+': <input type="text" style="width: 10em;" id="timepicker2" value="'+fechaEvento[1]+'" /><br />';  
	                } else {
	                  eventoHTML += ''+txt368+': <br />'+txt389+': '+txt79+': <input onchange="changeDate();" type="text" style="width: 10em; margin-left: 3.05em;" id="datepicker2" value="" /> '+txt80+': <input type="text" style="width: 10em;" id="timepicker2" value="08:00 AM" /><br />';  
	                }
	                var fecha2Evento = obj[0].fecha2.split(" ");
	                if(fecha2Evento[0] && fecha2Evento[0]!="undefined"){
			  eventoHTML += ''+txt390+': '+txt79+': <input type="text" style="width: 10em;" id="datepicker3" value="'+fecha2Evento[0]+'" /> '+txt80+': <input type="text" style="width: 10em;" id="timepicker3" value="'+fecha2Evento[1]+'" /><br />';  
	                } else {
	                  eventoHTML += ''+txt390+': '+txt79+': <input type="text" style="width: 10em;" id="datepicker3" value="" /> '+txt80+': <input type="text" style="width: 10em;" id="timepicker3" value="08:00 AM" /><br />';  
	                }
	                eventoHTML += '<button  class="btn btn-success" onclick="guardarEvento(1, '+comilla+''+obj[0].id+''+comilla+');" style="text-align: center; margin-top: 1em; width: 7em; float: left;">'+txt57+'</button><button  class="btn btn-danger" onclick="eliminarEvento('+comilla+''+obj[0].id+''+comilla+');" style="text-align: center; margin-top: 1em; width: 7em; float: right;">'+txt58+'</button>';
	                $("#cargando").dialog("close");
	                $(".ui-dialog-titlebar-close").show();
	              $("#ventana").html(eventoHTML);
			  $(function() {
			    $("#datepicker2").datepicker({
			      changeMonth: true,
			      changeYear: true,
			      "dateFormat": 'dd-mm-yy',
			      minDate: 0,
			      showOn: "both",
			      buttonImage: "images/calendar.gif",
			      buttonImageOnly: false,
			      buttonText: "Select date"
			    });
			    $("#datepicker3").datepicker({
			      changeMonth: true,
			      changeYear: true,
			      "dateFormat": 'dd-mm-yy',
			      minDate: 0,
			      showOn: "both",
			      buttonImage: "images/calendar.gif",
			      buttonImageOnly: false,
			      buttonText: "Select date"
			    });
			  });
			  if($("#datepicker2").val()==""){
			    $("#datepicker2").datepicker('setDate',new Date());
			    $("#datepicker3").datepicker('setDate',new Date());
			  }
			  $('#timepicker2').timepicker({ 'scrollDefault': 'now', 'step': 15, 'timeFormat': 'H:i A' });
			  $('#timepicker3').timepicker({ 'scrollDefault': 'now', 'step': 15, 'timeFormat': 'H:i A' });
	        } else {
	          $("#cargando").dialog("close");
	          $(".ui-dialog-titlebar-close").show();
	        }
              }, error: function (response){
                toastr["error"](txt92);
                $("#cargando").dialog("close");
                $(".ui-dialog-titlebar-close").show();
              }
           });
  }
}
function altaClientes(mensaje){
        var htmlCRM = '<p style="text-align: center; width: 100%;">'+txt410+'</p>';
	if(mensaje==0){
	  openDialog();
	  htmlCRM += ''+txt353+': <input type="text" style="width: 100%;" id="nombreCRM" value="" />';
	  htmlCRM += ''+txt359+': <input type="text" style="width: 100%;" id="apellidoPaternoCRM" value="" />';
	  htmlCRM += ''+txt360+': <input type="text" style="width: 100%;" id="apellidoMaternoCRM" value="" />';
	  htmlCRM += ''+txt355+': <select style="width: 100%;" id="sexoCRM" name="sexo"><option value="H" name="H">'+txt357+'</option><option value="M" name="M">'+txt358+'</option></select>';
	  htmlCRM += ''+txt365+': <select style="width: 100%;" id="edadCRM" name="edad">';	  htmlCRM += '<option value="no" name="no">no</option>';
	  for(var zzz12=10; zzz12<99; zzz12++){
	    htmlCRM += '<option value="'+zzz12+'" name="'+zzz12+'">'+zzz12+'</option>';
	  }  
	  htmlCRM += '</select>';
	  htmlCRM += ''+txt361+': <select onchange="mostrarCRM();"; style="width: 100%;" id="redCRM" name="red"><option value="facebook" name="facebook">Facebook</option><option name="twitter" value="twitter">Twitter</option><option value="no" name="no">No</option></select>';
	  htmlCRM += '<div style="display: none;" id="nombreUsuarioCRM"></div>';
	  htmlCRM += ''+txt362+': <input type="text" style="width: 100%;" id="empresaCRM" value="" />';
          htmlCRM += ''+txt394+': <select style="width: 100%;" id="CountryCRM" name="Country"><option selected="selected" value="Mexico">Mexico</option><option value="United States">United States</option><option value="Canada">Canada</option><option value="United Kingdom" >United Kingdom</option><option value="Ireland" >Ireland</option><option value="Australia" >Australia</option><option value="New Zealand" >New Zealand</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote Divoire">Cote Divoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-bissau">Guinea-bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option><option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea">Korea</option><option value="Korea">Korea</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao Peoples Democratic Republic">Lao Peoples Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option> <option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian">Palestinian</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia and Montenegro">Serbia and Montenegro</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Timor-leste">Timor-leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Viet Nam">Viet Nam</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>';
	  htmlCRM += ''+txt288+': <select style="width: 100%;" id="estadoCRM" name="estado"><option value="'+txt372+'" name="'+txt372+'">'+txt372+'</option><option name="'+txt373+'" value="'+txt373+'">'+txt373+'</option><option value="'+txt374+'" name="'+txt374+'">'+txt374+'</option><option value="'+txt374+'" name="'+txt409+'">'+txt409+'</option></select>';
	  htmlCRM += ''+txt366+': <input type="text" style="width: 100%;" id="direccionCRM" value="" />';
	  htmlCRM += ''+txt354+': <input type="text" style="width: 100%;" id="mailCRM" value="" />';
	  htmlCRM += ''+txt356+': <input type="text" style="width: 100%;" id="telefonoCRM" value="" />'; 
                       
	  htmlCRM += ''+txt364+': <textarea style="width: 100%;" id="observacionesCRM"></textarea>'; 
	  htmlCRM += '<button class="btn btn-success" onclick="guardarClientes(0,'+comilla+''+comilla+');" style="text-align: center; margin-top: 1em; width: 7em; float: left;">'+txt57+'</button>';
	  $("#tab2").html(htmlCRM);
	  mostrarCRM();
	  $(".ui-dialog-titlebar-close").show();
	  $("#cargando").dialog("close");
	} else {
	  openDialog();
	  var parametros = { id:mensaje };
	  $.ajax({  data:  parametros,
		    url:   "scripts/CRM/modificar.php",
		    type:  "POST",
		    success:  function (response) {
	              obj = JSON.parse(response);
			htmlCRM += ''+txt353+': <input type="text" style="width: 100%;" id="nombreCRM" value="'+obj[0].nombre+'" />';
			htmlCRM += ''+txt359+': <input type="text" style="width: 100%;" id="apellidoPaternoCRM" value="'+obj[0].apellidoPaterno+'" />';
			htmlCRM += ''+txt360+': <input type="text" style="width: 100%;" id="apellidoMaternoCRM" value="'+obj[0].apellidoMaterno+'" />';
			htmlCRM += ''+txt355+': <select style="width: 100%;" id="sexoCRM" name="sexo"><option selected="selected">'+obj[0].sexo+'</option><option value="H" name="H">'+txt357+'</option><option value="M" name="M">'+txt358+'</option></select>';
			htmlCRM += ''+txt365+': <select style="width: 100%;" id="edadCRM" name="edad">';
			htmlCRM += '<option selected="selected">'+obj[0].edad+'</option><option value="no" name="no">no</option>';
			for(var zzz12=10; zzz12<99; zzz12++){
			htmlCRM += '<option value="'+zzz12+'" name="'+zzz12+'">'+zzz12+'</option>';
			}  
			htmlCRM += '</select>';
			htmlCRM += ''+txt361+': <select onchange="mostrarCRM('+comilla+''+obj[0].nombre_de_usuario+''+comilla+');" style="width: 100%;" id="redCRM" name="red"><option selected="selected">'+obj[0].red_social+'</option><option value="facebook" name="facebook">Facebook</option><option name="twitter" value="twitter">Twitter</option><option value="no" name="no">No</option></select>';
                        if(obj[0].red_social!="no"){
                          htmlCRM += '<div style="display: none;" id="nombreUsuarioCRM">';
                            htmlCRM += ''+txt363+': <input type="text" style="width: 100%;" id="nombreUsuario2CRM" value="'+obj[0].nombre_de_usuario+'" />';
                          htmlCRM += '</div>';
                        } else {
			  htmlCRM += '<div style="display: none;" id="nombreUsuarioCRM"></div>';
                        }
			htmlCRM += ''+txt362+': <input type="text" style="width: 100%;" id="empresaCRM" value="'+obj[0].empresa+'" />';
                        htmlCRM += ''+txt394+': <select style="width: 100%;" id="CountryCRM" name="Country"><option value="'+obj[0].country+'" selected="selected">'+obj[0].country+'</option><option value="Mexico">Mexico</option><option value="United States">United States</option><option value="Canada">Canada</option><option value="United Kingdom" >United Kingdom</option><option value="Ireland" >Ireland</option><option value="Australia" >Australia</option><option value="New Zealand" >New Zealand</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote Divoire">Cote Divoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-bissau">Guinea-bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option><option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea">Korea</option><option value="Korea">Korea</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao Peoples Democratic Republic">Lao Peoples Democratic Republic</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option> <option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestinian">Palestinian</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia and Montenegro">Serbia and Montenegro</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Timor-leste">Timor-leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Viet Nam">Viet Nam</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>';
			htmlCRM += ''+txt288+': <select style="width: 100%;" id="estadoCRM" name="estado"><option value="'+obj[0].estado+'" selected="selected">'+obj[0].estado+'</option><option value="'+txt372+'" name="'+txt372+'">'+txt372+'</option><option name="'+txt373+'" value="'+txt373+'">'+txt373+'</option><option value="'+txt374+'" name="'+txt374+'">'+txt374+'</option><option value="'+txt409+'" name="'+txt409+'">'+txt409+'</option></select>';
			htmlCRM += ''+txt366+': <input type="text" style="width: 100%;" id="direccionCRM" value="'+obj[0].direccion+'" />';
			htmlCRM += ''+txt354+': <input type="text" style="width: 100%;" id="mailCRM" value="'+obj[0].mail+'" />';
			htmlCRM += ''+txt356+': <input type="text" style="width: 100%;" id="telefonoCRM" value="'+obj[0].telefono+'" />';
			htmlCRM += ''+txt364+': <textarea style="width: 100%;" id="observacionesCRM">'+obj[0].observaciones+'</textarea>'; 
			htmlCRM += '<button  class="btn btn-success" onclick="guardarClientes(1, '+comilla+''+obj[0].id+''+comilla+');" style="text-align: center; margin-top: 1em; width: 7em; float: left;">'+txt57+'</button>';
			$("#tab2").html(htmlCRM);
                        $('#tabs').tabs({ active: 1 });
			mostrarCRM(''+obj[0].nombre_de_usuario+'');
                      $(".ui-dialog-titlebar-close").show();
	              $("#cargando").dialog("close");
		    }, error:  function (response) {
                      toastr["error"](txt92);
	              $(".ui-dialog-titlebar-close").show();
                      $("#cargando").dialog("close");
	            }
		 });
	}
}