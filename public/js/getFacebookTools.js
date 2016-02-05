var identifyShare;
function cleanMainsFa(){
  for(var aer=1; aer<=9; aer++){
    $("#main-feed"+aer+"").html("");
	$("#main-feed"+aer+"Text").html("");
	$("#main-feed"+aer+"Text").parent().parent().css("display","block");
        $("#main-feed"+aer).siblings().find(".acercaSR").attr('onclick','help('+comilla+''+aer+''+comilla+','+comilla+'faTools'+comilla+');');
  }
  for(var aer=3; aer<=9; aer++){
    $("#main-feed"+aer+"").html("");
	$("#main-feed"+aer+"Text").html("");
	$("#main-feed"+aer+"Text").parent().parent().css("display","none");
  }
}
function iniFaTools(identifyLocal,identifyOther,redLocal,imagenRed,tipo){
        $("#mostrarDetallesTools").css("display","none");
        identifyShare = identifyLocal;
	cleanMainsFa();
        getFacebookTool1(identifyLocal,identifyOther,redLocal,imagenRed,1,tipo);
        getFacebookTool2(identifyLocal,identifyOther,redLocal,imagenRed,2,tipo);
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
$(document).keydown(function(e){
    <!-- alert(e.keyCode); -->
    if(e.which == 13){
      if($("#buscarShare").is(":focus")==true){
	      openDialog();
	      var checkedBu;
	      var checkedBuName;
	         if(document.getElementById("userBuShare").checked==true){
	           checkedBu = "user";
	           checkedBuName = txt315;
	         }
	         if(document.getElementById("pageBuShare").checked==true){
	           checkedBu = "page";
	           checkedBuName = "Fan Pages";
	         }
	         if(document.getElementById("eventBuShare").checked==true){
	           checkedBu = "event";
	           checkedBuName = txt316;
	         }
	         if(document.getElementById("groupBuShare").checked==true){
	           checkedBu = "group";
	           checkedBuName = txt63;
	         }
	         if(document.getElementById("placeBuShare").checked==true){
	           checkedBu = "place";
	           checkedBuName = txt317;
	         }
	         $.ajax({url:   "facebook/thread-fa.php?option=getSearch&search="+$("#buscarShare").val()+"&identify="+identifyShare+"&type="+checkedBu+"",
			  type:  "GET",
			  success:  function (response) {
	                    if(response.indexOf("Post search has been deprecated")!="-1"){
	                      toastr["error"](txt320, "ERROR");
	                    } else {
				    obj=JSON.parse(response);
				    if(obj.errors){
                                      toastr["error"](obj.errors[0].message, "ERROR");
				    } else if(obj.toString()=="" || obj.toString()=="[]"){
		                      toastr["error"](txt320, "ERROR");
		                    } else if(checkedBu=="group") {
		                      var htmlSearch = '<div style="display: table;">';
		                            htmlSearch += '<div style="display: table-row;">';
				               htmlSearch += '<div style="width: 100px; text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt63.substr(0,5);
				               htmlSearch += '</div>';
		                               htmlSearch += '<div style="width: 100px; text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt288;
				               htmlSearch += '</div>';
		                               htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt36;
				               htmlSearch += '</div>';
				             htmlSearch += '</div>';
				      for(var er34nbv=0; er34nbv<obj.length; er34nbv++){
		                             htmlSearch += '<div class="colorEven" style="display: table-row;">';
		                               htmlSearch += '<div style="width: 100px; text-align: center; display: table-cell;">';
		                                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
				                   htmlSearch += '<img style="width: 4em;" src="images/grupos-facebook.png" />';
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
		                               htmlSearch += '<div style="width: 100px; text-align: center; display: table-cell;">';
		                               if(obj[er34nbv].status==true){
				                 htmlSearch += '<button class="btn btn-success" onclick="window.open('+comilla+'http://facebook.com/'+obj[er34nbv].id+''+comilla+','+comilla+'_blank'+comilla+');" type="button">'+txt321+'</button>';
		                               } else {
		                                 htmlSearch += txt323;
		                               }
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="font-size: .9em; width: 500px; text-align: left; display: table-cell;">';
				                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
		                                   if(obj[er34nbv].name.length>50)
				                     htmlSearch += obj[er34nbv].name.substr(0,50) + "...";
		                                   else
		                                     htmlSearch += obj[er34nbv].name;
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
				             htmlSearch += '</div>';
				           htmlSearch += '';
				           htmlSearch += '';
				           htmlSearch += '';
		                      }
		                      $("#ventana").dialog("open");
				    } else if(checkedBu=="page") {
		                       var htmlSearch = '<div style="width: 1500px; display: table;">';
		                            htmlSearch += '<div style="display: table-row;">';
				               htmlSearch += '<div style="width: 100px; text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += 'Fan Page';
				               htmlSearch += '</div>';
		                               htmlSearch += '<div style="width: 100px; text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt288;
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt325;
				               htmlSearch += '</div>';
		                               htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt36;
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt291;
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt297;
				               htmlSearch += '</div>';
				             htmlSearch += '</div>';
				      for(var er34nbv=0; er34nbv<obj.length; er34nbv++){
		                             htmlSearch += '<div class="colorEven" style="display: table-row;">';
		                               htmlSearch += '<div style="width: 100px; vertical-align: middle; text-align: center; display: table-cell;">';
		                                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
				                   htmlSearch += '<img style="width: 4em;" src="images/fan-page.png" />';
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
		                               htmlSearch += '<div style="width: 100px; vertical-align: middle;  text-align: center; display: table-cell;">';
		                               if(obj[er34nbv].status==true){
				                 htmlSearch += '<button class="btn btn-success" onclick="window.open('+comilla+'http://facebook.com/'+obj[er34nbv].id+''+comilla+','+comilla+'_blank'+comilla+');" type="button">'+txt322+'</button>';
		                               } else {
		                                 htmlSearch += txt324;
		                               }
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="width: 100px; font-size: .9em; vertical-align: middle;  text-align: left; display: table-cell;">';
				                 htmlSearch += obj[er34nbv].likes;
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="width: 400px; font-size: .9em; vertical-align: middle; text-align: left; display: table-cell;">';
				                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
		                                   if(obj[er34nbv].name.length>50)
				                     htmlSearch += obj[er34nbv].name.substr(0,50) + "...";
		                                   else
		                                     htmlSearch += obj[er34nbv].name;
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="width: 200px; font-size: .9em; vertical-align: middle; text-align: left; display: table-cell;">';
				               if(obj[er34nbv].location!="null" && obj[er34nbv].location!=null)
				                 htmlSearch += obj[er34nbv].location;
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="font-size: .9em; vertical-align: middle; text-align: left; display: table-cell;">';
				               if(obj[er34nbv].description!="null" && obj[er34nbv].description!=null)
				                 htmlSearch += obj[er34nbv].description;
				               htmlSearch += '</div>';
				             htmlSearch += '</div>';
				           htmlSearch += '';
				           htmlSearch += '';
				           htmlSearch += '';
		                      }//fin for
		                      $("#ventana").dialog("open");
	                            } else if(checkedBu=="user") {
		                      var htmlSearch = '<div style="display: table;">';
		                            htmlSearch += '<div style="display: table-row;">';
				               htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt290;
				               htmlSearch += '</div>';
		                               htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt36;
				               htmlSearch += '</div>';
				             htmlSearch += '</div>';
				      for(var er34nbv=0; er34nbv<obj.length; er34nbv++){
		                             htmlSearch += '<div class="colorEven" style="display: table-row;">';
		                               htmlSearch += '<div style="width: 100px; text-align: center; display: table-cell;">';
		                                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
				                   htmlSearch += '<img style="width: 3.5em;" src="images/f.png" />';
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="font-size: .9em; width: 500px; text-align: left; display: table-cell;">';
				                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
		                                   if(obj[er34nbv].name.length>50)
				                     htmlSearch += obj[er34nbv].name.substr(0,50) + "...";
		                                   else
		                                     htmlSearch += obj[er34nbv].name;
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
				             htmlSearch += '</div>';
				           htmlSearch += '';
				           htmlSearch += '';
				           htmlSearch += '';
		                      }
		                      $("#ventana").dialog("open");
				    } else if(checkedBu=="event") {
		                      var htmlSearch = '<div style="display: table;">';
		                            htmlSearch += '<div style="display: table-row;">';
				               htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt290;
				               htmlSearch += '</div>';
	                                       htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt36;
				               htmlSearch += '</div>';
		                               htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt312;
				               htmlSearch += '</div>';
	                                       htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt310;
				               htmlSearch += '</div>';
				             htmlSearch += '</div>';
				      for(var er34nbv=0; er34nbv<obj.length; er34nbv++){
		                             htmlSearch += '<div class="colorEven" style="display: table-row;">';
		                               htmlSearch += '<div style="width: 100px; text-align: center; display: table-cell;">';
		                                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
				                   htmlSearch += '<img style="width: 3.5em;" src="images/eventos-facebook.png" />';
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
	                                       htmlSearch += '<div style="font-size: .9em; width: 500px; text-align: left; display: table-cell;">';
				                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
		                                   if(obj[er34nbv].name.length>50)
				                     htmlSearch += obj[er34nbv].name.substr(0,50) + "...";
		                                   else
		                                     htmlSearch += obj[er34nbv].name;
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="font-size: .9em; width: 500px; text-align: left; display: table-cell;">';
				                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
		                                   htmlSearch += obj[er34nbv].start_time.substr(0,10) + " " +obj[er34nbv].start_time.substr(11,5);
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
	                                       htmlSearch += '<div style="font-size: .9em; width: 500px; text-align: left; display: table-cell;">';
				                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
				               if(obj[er34nbv].location!="null" && obj[er34nbv].location!=null)
				                 htmlSearch += obj[er34nbv].location;
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
				             htmlSearch += '</div>';
				           htmlSearch += '';
				           htmlSearch += '';
				           htmlSearch += '';
		                      } //fin for
	                              $("#ventana").dialog("open");
				    } else if(checkedBu=="place") {
		                      var htmlSearch = '<div style="width: 1500px; display: table;">';
		                            htmlSearch += '<div style="display: table-row;">';
				               htmlSearch += '<div style="width: 100px; text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt317;
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="width: 100px; text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt325;
				               htmlSearch += '</div>';
		                               htmlSearch += '<div style="text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt36;
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="width: 200px; text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt291;
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="width: 900px; text-align: center; color: white; background-color: #2e70b9; display: table-cell;">';
				                 htmlSearch += txt297;
				               htmlSearch += '</div>';
				             htmlSearch += '</div>';
				      for(var er34nbv=0; er34nbv<obj.length; er34nbv++){
		                             htmlSearch += '<div class="colorEven" style="display: table-row;">';
		                               htmlSearch += '<div style="width: 100px; text-align: center; display: table-cell;">';
		                                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
				                   htmlSearch += '<img style="width: 4em;" src="images/f.png" />';
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="font-size: .9em; text-align: left; display: table-cell;">';
				                 htmlSearch += obj[er34nbv].likes;
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="font-size: .9em; width: 400px; text-align: left; display: table-cell;">';
				                 htmlSearch += '<a target="_blank" href="http://facebook.com/'+obj[er34nbv].id+'">';
		                                   if(obj[er34nbv].name.length>50)
				                     htmlSearch += obj[er34nbv].name.substr(0,50) + "...";
		                                   else
		                                     htmlSearch += obj[er34nbv].name;
		                                 htmlSearch +=  '</a>';
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="font-size: .9em; text-align: left; display: table-cell;">';
				               if(obj[er34nbv].location!="null" && obj[er34nbv].location!=null)
				                 htmlSearch += obj[er34nbv].location;
				               htmlSearch += '</div>';
				               htmlSearch += '<div style="font-size: .9em; text-align: left; display: table-cell;">';
				               if(obj[er34nbv].description!="null" && obj[er34nbv].description!=null)
				                 htmlSearch += obj[er34nbv].description;
				               htmlSearch += '</div>';
				             htmlSearch += '</div>';
				           htmlSearch += '';
				           htmlSearch += '';
				           htmlSearch += '';
		                      }//fin for
		                      $("#ventana").dialog("open");
	                            }
	                      
			    }
	                    htmlSearch += '</div>';
	                    $("#ventana").dialog('option', 'title', txt319+' '+checkedBuName+': '+$("#buscarShare").val());
	                    $("#ventana").dialog('option', 'width', 800);
	                    $("#ventana").dialog('option', 'height', 400);
			    $("#ventana").html(htmlSearch);
	                    $(".colorEven:even").css("background-color","#EEEEEE");
                            $(".colorEven").hover(function(){
                              $(this).css("background-color", "#c5cde0");
                            }, function(){
                              $(".colorEven:odd").css("background-color","#FFFFFF");
                              $(".colorEven:even").css("background-color","#EEEEEE");
                            });
			    $(".ui-dialog-titlebar-close").show();
	                    $("#cargando").dialog("close");
	                  },
			  error: function (response) {
	                    toastr["error"](txt92);
	                    $(".ui-dialog-titlebar-close").show();
	                    $("#cargando").dialog("close");
			  }
	  	 });
	    }
    }
});

function getFacebookTool1(identifyLocal,identifyOther,redLocal,imagenRed,num,tipo){
  openDialog();
  $('#main-feed'+num+'Text').html(txt318);
  var htmlShare = '';
  htmlShare += '<div style="width: 100%; display: table;">';
    htmlShare += '<div style="display: table-row;">';
      htmlShare += '<div style="text-align: center; display: table-cell;">';
        htmlShare += '<input style="margin-top: 5px; width: 80%;" placeholder="'+txt301.substr(0,txt301.length-2)+'" type="text" id="buscarShare" />';
      htmlShare += '</div>';
    htmlShare += '</div>';
  htmlShare += '</div>';
  htmlShare += '</div><br />';
  htmlShare += '<div style="display: table;">';
    htmlShare += '<div style="display: table-row;">';
      htmlShare += '<div style="padding-left: 5em; text-align: left; display: table-cell;">';
        htmlShare += ''+txt63+':';
      htmlShare += '</div>';
      htmlShare += '<div style="padding-left: 5em; display: table-cell;">';
        htmlShare += '<input type="radio" value="group" name="opcionBShare" id="groupBuShare" checked />';
      htmlShare += '</div>';
    htmlShare += '</div>';
    htmlShare += '<div style="display: table-row;">';
      htmlShare += '<div style="padding-left: 5em; text-align: left; display: table-cell;">';
        htmlShare += 'Fan Pages:';
      htmlShare += '</div>';
      htmlShare += '<div style="padding-left: 5em; display: table-cell;">';
        htmlShare += '<input type="radio" value="page" name="opcionBShare" id="pageBuShare" />';
      htmlShare += '</div>';
    htmlShare += '</div>';
    htmlShare += '<div style="padding-left: 5em; display: table-row;">';
      htmlShare += '<div style="padding-left: 5em; text-align: left; display: table-cell;">';
        htmlShare += ''+txt315+':';
      htmlShare += '</div>';
      htmlShare += '<div style="padding-left: 5em; display: table-cell;">';
        htmlShare += '<input type="radio" value="user" name="opcionBShare" id="userBuShare" />';
      htmlShare += '</div>';
    htmlShare += '</div>';
    htmlShare += '<div style="padding-left: 5em; display: table-row;">';
      htmlShare += '<div style="padding-left: 5em; text-align: left; display: table-cell;">';
        htmlShare += ''+txt316+':';
      htmlShare += '</div>';
      htmlShare += '<div style="padding-left: 5em; display: table-cell;">';
        htmlShare += '<input type="radio" value="event" name="opcionBShare" id="eventBuShare" />';
      htmlShare += '</div>';
    htmlShare += '</div>';
    htmlShare += '<div style="padding-left: 5em; display: table-row;">';
      htmlShare += '<div style="padding-left: 5em; text-align: left; display: table-cell;">';
        htmlShare += ''+txt317+':';
      htmlShare += '</div>';
      htmlShare += '<div style="padding-bottom: 4em; padding-left: 5em; text-align: left; display: table-cell;">';
        htmlShare += '<input type="radio" value="place" name="opcionBShare" id="placeBuShare" />';
      htmlShare += '</div>';
    htmlShare += '</div>';
  htmlShare += '</div>';
  htmlShare += '';
  $("#main-feed1").html(htmlShare);
  $('.imgIcon'+num+'').attr("src","images/engrane.png");
  $(".ui-dialog-titlebar-close").show();
  $("#cargando").dialog("close");
}
function getFacebookTool2(identifyLocal,identifyOther,redLocal,imagenRed,feedMain,tipo){
	var loadStats = '<div class="Knight-Rider-loader animate">';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '</div>';
	$('#main-feed'+feedMain+'').html(loadStats);
	$('#main-feed'+feedMain+'Text').html(txt400);
        var mantenimientoHTML = '<img style="width: 18.5em;" src="images/mantenimiento.png" />';
	$('#main-feed'+feedMain+'').html(mantenimientoHTML);
        $('.imgIcon'+feedMain+'').attr("src","images/manIcon.png");
        $('.imgIcon'+feedMain+'').css("width","1.55em");
}