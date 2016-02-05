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

function compartirShare(texto, link){
  $('#verRedesAgregarRow').css("display","table");
  $('#redesAgregadas').css("display","block");
  $('#adjuntarDiv').css("display","inline-block");
  document.getElementById("comparte").value = ""+texto+" ";
  $(document).scrollTop(0);
  $("#comparte").focus();
  comparte();
  acortar('2',link);
}

function iniShare(cat){
  getCat(cat);
}

function getCat(categoria){
  var parametros = { categoria:categoria, lengua:"es" };
  $.ajax({data:  parametros,
	  url:   'scripts/get-rssFeed.php',
	  type:  'POST',
	  success:  function (response) { 
	    obj = JSON.parse(response);
	    if(obj.length>0){
	      var ShareHtml12 = '';
              var faltan = 0;
              for(var hgn=1; hgn<=50; hgn++){
                $("#main-feed"+hgn+"").parent().parent().css("display","none");
              }
	      for(var hgn=0; hgn<obj.length; hgn++){
                $("#main-feed"+hgn+"").parent().parent().css("display","inline-block");
                if(obj[hgn].description!=null){
	                var linkShare = obj[hgn].link;
                        $('#main-feed'+(hgn+1-faltan)+'Text').html('<a target="_blank" href="'+linkShare+'">'+obj[hgn].dominio+'</a>');
                        $('#tituloShare'+(hgn+1-faltan)+'').html('<a target="_blank" href="'+linkShare+'">'+utf8_decode(obj[hgn].title)+'</a>');
                        $('#imageShare'+(hgn+1-faltan)+'').attr("src",obj[hgn].img);
                        if(!obj[hgn].description || obj[hgn].description.length<150){
                          $('#descripcionShare'+(hgn+1-faltan)+'').html(utf8_decode(obj[hgn].description));
                        } else {
                          $('#descripcionShare'+(hgn+1-faltan)+'').html(utf8_decode(obj[hgn].description.substr(0,150)+"..."));
                        }
                        $('#fechaShare'+(hgn+1-faltan)+'').html('<a target="_blank" href="'+linkShare+'">'+relative_time(obj[hgn].fecha)+'</a>');
                        $('#likeShare'+(hgn+1-faltan)+'').html('<a target="_blank" href="'+linkShare+'"><img title="'+txt382+'" style="cursor: pointer; width: 2em; margin-right: 1em;" src="images/like-100.png" /></a>');
                        $('#footerShare'+(hgn+1-faltan)+'').html('<button style="margin-bottom: 1em; margin-top: 1em;" class="btn btn-primary" onclick="compartirShare('+comilla+''+utf8_decode(obj[hgn].title)+''+comilla+','+comilla+''+linkShare+''+comilla+');"><span style="padding-right: 0.7em;" class="glyphicon glyphicon-share" aria-hidden="true"></span>'+txt46+'</button>');
	        } else {
                  faltan++;
                } 
	      }//fin for
	      $("#sharing").html(ShareHtml12);
	    } else {
	      toastr["error"](txt117, "ERROR");
	    }
	    $("#cargando").closest('.ui-dialog-content').dialog('close'); 
	    $(".ui-dialog-titlebar-close").show();
	  }, error: function (response){
	    $("#cargando").closest('.ui-dialog-content').dialog('close'); 
	    $(".ui-dialog-titlebar-close").show();
	    toastr["error"](txt117, "ERROR");
	  }
	 });
}