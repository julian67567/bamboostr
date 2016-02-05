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
function guardarRecordatorioMail(){
  openDialog();
  if($("#mailRecG").val().indexOf("@")!="-1" && $("#mailRecG").val().indexOf(".")!="-1"){
    $.ajax({      url:   "scripts/recordatorio-mail-guardar.php",
		  type:  "POST",
	   	  data:  {id_token:id_token, mailRecG:$("#mailRecG").val()},
		  success:  function (response) {
                    $("#recordatorioMail").dialog("close");
                    toastr["success"](txt194);
                    $("#cargando").dialog("close");
                    $(".ui-dialog-titlebar-close").show();
		  },
		  error: function (response){
		    toastr["error"](txt117, "ERROR");
                    $("#cargando").dialog("close");
                    $(".ui-dialog-titlebar-close").show();
		  }
    }); 
  } else {
    toastr["error"](txt480, "ERROR");
  }
}
function recordatorioMail(){
  $.ajax({      url:   "thread-sys.php",
		type:  "GET",
		data:  {option:"mail", id_token:id_token},
		success:  function (response) {
                  obj = JSON.parse(response);
                  if(obj.success){
                    $("#recordatorioMail").dialog("open");
                    $("#recordatorioMail").dialog('option', 'title', txt486);
                    $("#recordatorioMail").dialog('option', 'width', 400);
                    $("#recordatorioMail").dialog('option', 'height', 250);
                    var recMailHtml = '';
                    recMailHtml += '<div style="text-align: left; width: 100%;">';
                    recMailHtml += ''+txt487+' <br /><br />';
                    recMailHtml += '</div>';
                    recMailHtml += '<div style="text-align: center; width: 100%;">';
                    recMailHtml += '<input id="mailRecG" placeholder="'+txt478+'" style="width: 100%;" /><br /><br /><button onclick="guardarRecordatorioMail();" class="btn btn-success" type="button" style="text-align: center;">'+txt57+'</button>';
                    recMailHtml += '</div>';
                    $("#recordatorioMail").html(recMailHtml);
                  }
		},
		error: function (response){
		}
  });
}