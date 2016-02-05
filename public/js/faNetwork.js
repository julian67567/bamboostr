var identifyShare;
function cleanShareFa(){
  for(var aer=1; aer<=1; aer++){
        $("#main-feed"+aer+"").html("");
	$("#main-feed"+aer+"Text").html("");
	$("#main-feed"+aer+"Text").parent().parent().css("display","block");
        $("#main-feed"+aer).siblings().find(".acercaSR").attr('onclick','help('+comilla+''+aer+''+comilla+','+comilla+'faShare'+comilla+');');
  }
  for(var aer=2; aer<=3; aer++){
        $("#main-feed"+aer+"").html("");
	$("#main-feed"+aer+"Text").html("");
	$("#main-feed"+aer+"Text").parent().parent().css("display","none");
  }
}
function iniShareFa(identifyLocal,identifyOther,redLocal,imagenRed,tipo){
        identifyShare = identifyLocal;
	cleanShareFa();
	getFacebookShare1(identifyLocal,identifyOther,redLocal,imagenRed,1,tipo);
        $("#cargando").dialog("close");
        $(".ui-dialog-titlebar-close").show(); 
	//no poner list dialog debido al tiempo de carga del total windows data-1
}
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
function getAutoRssDetails(screenname){
$.ajax({	url:   "twitter/get-AutoRssDetails.php?screen_name="+screenname,
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
function saveAutoRss(screenname){
	if(document.getElementById("contadorDm").value==charTool){
	  toastr["warning"](txt67);
	} else if(document.getElementById("contadorDm").value>=0){
		if(document.getElementById("autoDMActivate").checked==true)
		  var activateDM = 1;
		else
		  var activateDM = 0;
		var parametros = { activate:activateDM, DM:document.getElementById("comparteDm").value};
		$.ajax({    data:  parametros,
					url:   "twitter/post-AutoRssDetails.php?screen_name="+screenname,
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
function getFacebookShare1(identifyLocal,identifyOther,redLocal,imagenRed,num,tipo){
  openDialog();
  $('#main-feed'+num+'Text').html(txt376);
  var loadStats = '<div class="Knight-Rider-loader animate">';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '</div>';
	$('#main-feed'+num+'').html(loadStats);
	var htmlShare = '';
	    htmlShare += '<div style="display: table-inline;" id="auto_rss">';
	    htmlShare += '<textarea id="comparteRss" style="resize: none; width: 80%; height: 5em; margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px;" type="text" name="comparteRss" onclick="comparteRss()" placeholder="'+txt378+'"></textarea><br /><br />';
            htmlShare += 'Intervalo de Tiempo cada:<br />';
            htmlShare += '<select name="frecuencia">';
            htmlShare += '<option name="24" value="1">24 Horas</option>';
            htmlShare += '<option name="12" value="1">12 Horas</option>';
            htmlShare += '<option name="6" value="1">6 Horas</option>';
            htmlShare += '<option name="6" value="1">3 Horas</option>';
            htmlShare += '<option name="2" value="1">2 Horas</option>';
            htmlShare += '<option name="1" value="1">1 Hora</option>';
            htmlShare += '</select><br /><br />';
            htmlShare += 'Número de Mensajes<br />';
            htmlShare += '<select name="posts">';
            htmlShare += '<option name="1" value="1">1 Cada Día</option>';
            htmlShare += '<option name="2" value="2">2 veces al Día al mismo tiempo</option>';
            htmlShare += '<option name="3" value="3">3 veces al Día al mismo tiempo</option>';
            htmlShare += '<option name="4" value="4">4 veces al Día al mismo tiempo</option>';
            htmlShare += '<option name="5" value="5">5 veces al Día al mismo tiempo</option>';
            htmlShare += '</select><br /><br />';
            htmlShare += 'Anteponer Texto a cada Mensaje 20 Caracteres<br />';
            htmlShare += '<textarea id="anteRss" style="resize: none; width: 80%; height: 5em; margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px;" type="text" name="comparteRss" onclick="comparteAnteRss()"></textarea><br /><br />';
	    htmlShare += '<input type="checkbox" id="autoDMActivate" name="autoDMActivate" value="autoDMActivate" /> '+txt377+'<br />';
	    htmlShare += '<button class="btn btn-success" onclick="saveAutoRss()" style="margin: 10px 0px 0px 0px; type="button">Save</button><br /><br />';
	    htmlShare += '</div>';
  $("#main-feed"+num+"").html(htmlShare);
  $(".ui-dialog-titlebar-close").show();
  $("#cargando").dialog("close");
}