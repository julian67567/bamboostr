var arrayAds = [];
var longitudAds;
var identifyLocalL,identifyOtherL,redLocalL,imagenRedL,tipoL,screennameL;
var idiomaTextAds = "es";
var idiomaKeyAds = 23;
var paisKeyAds = "MX";
var interesesString = "";
var dinero = 25;
var genero = 0;
var edad1 = 13;
var edad2 = 65;
window["idTmp"] = [];
function edadAds(){
  if($("#edad1").val()>$("#edad2").val()){
    $("#edad1").val($("#edad2").val());
  }
  edad1 = $("#edad1").val();
  edad2 = $("#edad2").val(); 
  console.log(edad1 + " " + edad2);
  adsEstimate();
}
function generoAds(option){
   if(option==1)
    genero = 0;
   else if(option==3)
    genero = 1;
   else if(option==2)
    genero = 2;
   $("#genero1").attr("class","btn btn-default");
   $("#genero2").attr("class","btn btn-default");
   $("#genero3").attr("class","btn btn-default");
   $("#genero"+option+"").attr("class","btn btn-success");
   console.log("genero: "+genero);
   adsEstimate();
}
function dineroAds(option){
  if(option==4){
    dinero = $("#dinero4").val();
  } else {
    dinero = $("#dinero"+option+"").val();
    $("#dinero1").attr("class","btn btn-default");
    $("#dinero2").attr("class","btn btn-default");
    $("#dinero3").attr("class","btn btn-default");
    $("#dinero"+option+"").attr("class","btn btn-success");
  }
  console.log(dinero);
  adsEstimate();
}
function back(){
  $("#patrocinar").css("display","none");
  for(var vbvn4=0; vbvn4<longitudAds ;vbvn4++)
    $("#main-feed"+vbvn4+"").parent().css("display","block");
  
}

function adsEstimate(){
        interesesString = $('#eventTags').tagit("assignedTags");
        var interesIdAds = "";
        var veri = 0;
        var rtrfdss=0;
        for(var itfv=0; itfv<interesesString.length; itfv++){
            veri = 0;
            rtrfdss=0;
            while(rtrfdss<window["idTmp"].length){
              if(interesesString[itfv]==window["idTmp"][rtrfdss]["name"] && interesIdAds.indexOf(window["idTmp"][rtrfdss]["id"])=="-1"){
                interesIdAds = ''+interesIdAds+''+window["idTmp"][rtrfdss]["id"]+',';
                veri++;
              }
              rtrfdss++
            }/*fin while 2*/
            if(veri==0)
              interesIdAds = ''+interesIdAds+'0,';
        }/*fin for 1*/
        
	$.ajax({  data:  { identify_account:identifyLocalL, identify:identifyOtherL.substr(0,identifyOtherL.length-2), id_token:id_token, pais:paisKeyAds, idioma:idiomaKeyAds, genero:genero, dinero:dinero, edad1:edad1, edad2:edad2, intereses:interesesString, interesesId:interesIdAds.substring(0,interesIdAds.length-1) },
		  url:   'facebookAds/examples/reachestimate.php',
	   	  type:  'POST',
		  success:  function (response) {
                    obj = JSON.parse(response);
                    $("#reachAds").html(parseInt(obj.estimado_users));
                    $("#reach2Ads").html(parseInt(obj.users));
                    var est23 = parseInt((obj.dinero*100)/(obj.cpc_median));
                    $("#barAds").attr("aria-valuenow",parseInt(est23));
                    $("#barAds").css("width",""+parseInt(est23)+"%");
		  },
		  error: function (response){
		  }
	}); 
}
function adsSearchComplete(value, option){

	$.ajax({  data:  { identify_account:identifyLocalL, identify:identifyOtherL.substr(0,identifyOtherL.length-2), id_token:id_token, search:option, q:value, idioma:idiomaTextAds },
		  url:   'facebookAds/examples/search-keywords.php',
	   	  type:  'POST',
		  success:  function (response) {
                    var arrayPais = [];
                    var arrayIdioma = [];
                    var arrayIntereses = [];
                    obj = JSON.parse(response);
                    obj = obj.data;
                    if(response!="false" && obj.length>0){
                      if(option=="pais"){
                        arrayPais = [];
                      } else if(option=="idioma"){
                        arrayIdioma = [];
                      } else if(option=="intereses"){
                        arrayIntereses = [];
                      }
                      for(var gfd3=0; gfd3<obj.length; gfd3++){ 
                        if(option=="pais"){
                          arrayPais[gfd3] = obj[gfd3].name;
                          if(obj[0].key)
                            paisKeyAds = ""+obj[0].key+"";
                        } else if(option=="idioma"){
                          arrayIdioma[gfd3] = obj[gfd3].name;
                          if(obj[0].key)
                            idiomaKeyAds = ""+obj[0].key+"";
                        } else if(option=="intereses"){
                          arrayIntereses[gfd3] = obj[gfd3].name;
                          window["idTmp"][window["idTmp"].length] = [];
                          window["idTmp"][window["idTmp"].length-1]["id"] = obj[gfd3].id;
                          window["idTmp"][window["idTmp"].length-1]["name"] = obj[gfd3].name;
                          console.log(window["idTmp"].length + ":" + " " + window["idTmp"][window["idTmp"].length-1]["name"] + " " + window["idTmp"][window["idTmp"].length-1]["id"]);
                        }
                      }
                      if(option=="pais"){
                        var autocomplete = $('#arrayPais').typeahead();
                        autocomplete.data('typeahead').source = arrayPais;
                      } else if(option=="idioma"){
                        var autocomplete = $('#arrayIdioma').typeahead();
                        autocomplete.data('typeahead').source = arrayIdioma;
                      } else if(option=="intereses"){
			    //-------------------------------
			    // Tag events
			    //-------------------------------
			    var eventTags = $('#eventTags');
			
			    var addEvent = function(text) {
			        $('#events_container').append(text + '<br>');
			    };
			
			    eventTags.tagit({
			        availableTags: arrayIntereses,
			        beforeTagAdded: function(evt, ui) {
			            if (!ui.duringInitialization) {
			                addEvent('beforeTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
			            }
                                    adsEstimate();
			        },
			        afterTagAdded: function(evt, ui) {
                                    adsEstimate();
			            if (!ui.duringInitialization) {
			                addEvent('afterTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
			            }
                                    adsEstimate();
			        },
			        beforeTagRemoved: function(evt, ui) {
			            addEvent('beforeTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
                                    adsEstimate();
                                    //interesesString = $('#eventTags').tagit("assignedTags");
                                    //if(interesesString==""){
                                    //  window["idTmp"] = [];
                                    //  console.log("borrado");
                                    //}
			        },
			        afterTagRemoved: function(evt, ui) {
			            addEvent('afterTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
                                    adsEstimate();
                                    //interesesString = $('#eventTags').tagit("assignedTags");
                                    //if(interesesString==""){
                                    //  window["idTmp"] = [];
                                    //  console.log("borrado");
                                    //}
			        },
			        onTagClicked: function(evt, ui) {
			            addEvent('onTagClicked: ' + eventTags.tagit('tagLabel', ui.tag));
			        },
			        onTagExists: function(evt, ui) {
			            addEvent('onTagExists: ' + eventTags.tagit('tagLabel', ui.existingTag));
			        }
			    });
                      }
                    }
                    console.log("adsestimado");
                    adsEstimate();
		  },
		  error: function (response){
		  }
	});
}

function patrocinarAd(identifyLocal,identifyOther,redLocal,imagenRed,tipo,screenname,ordenar,id,tamano){
  identifyLocalL = identifyLocal;
  identifyOtherL = identifyOther;
  redLocalL = redLocal;
  imagenRedL = imagenRed;
  tipoL = tipo;
  screennameL = screenname;
  openDialog();
  $(document).scrollTop("0");
  for(var vbvn4=0; vbvn4<tamano ;vbvn4++)
    $("#main-feed"+vbvn4+"").parent().css("display","none");
	$.ajax({  data:  { identify_account:identifyLocal, identify:identifyOther.substr(0,identifyOther.length-2), id_token:id_token, post:id },
		  url:   'facebookAds/examples/get-iframe-preview.php',
	   	  type:  'POST',
		  success:  function (response) {
                    obj = JSON.parse(response);
                    if(obj.data){
                      $("#fb-root").html(obj.data[0].body);
                      $("#patrocinar").css("display","block");
                      $("#fb-root").find("iframe").attr("frameborder","0");
                      $("#fb-root").find("iframe").attr("width","100%");
                      $("#fb-root").find("iframe").attr("height","100%");
                      $("#fb-root").find("iframe").css("height","100%");
                      $("#fb-root").find("iframe").css("width","100%");
                      $("#fb-root").find("iframe").css("overflow","hidden");
                      $("#fb-root").find("iframe").attr("scrolling","no");
                      $("#fb-root").children().contents().find("body").css("background","transparent");
	              $(".ui-dialog-titlebar-close").show();
		      $("#cargando").closest('.ui-dialog-content').dialog('close');
                      adsEstimate();
                    } else {
                      toastr["error"](txt496, "ERROR");
                    }
                    
                  }, error: function (response){
                    toastr["error"](txt92);
	            $(".ui-dialog-titlebar-close").show();
		    $("#cargando").closest('.ui-dialog-content').dialog('close');
                  }
               });
}
function iniFaAds(identifyLocal,identifyOther,redLocal,imagenRed,tipo,screenname,ordenar){
	$.ajax({  data:  { identify_account:identifyLocal, identify:identifyOther.substr(0,identifyOther.length-2), id_token:id_token },
		  url:   'facebook/get-posts-stadistics.php',
	   	  type:  'POST',
		  success:  function (response) {
                    $("#patrocinar").css("display","none");
	            obj = JSON.parse(response);
	            if(obj.length>0){
                      longitudAds = obj.length;
                      for(var vbvn4=0; vbvn4<100 ;vbvn4++){
                        $("#main-feed"+vbvn4+"").parent().css("display","none");
                      }
		      for(var vbvn4=0; vbvn4<obj.length ;vbvn4++){
                        $("#main-feed"+vbvn4+"").parent().css("display","inline-block");
                        arrayAds[vbvn4] = [];
                        arrayAds[vbvn4][0] = obj[vbvn4].id;
                        arrayAds[vbvn4][1] = obj[vbvn4].from.name;
                        arrayAds[vbvn4][2] = obj[vbvn4].picture;
                        arrayAds[vbvn4][3] = obj[vbvn4].link;
                        arrayAds[vbvn4][4] = obj[vbvn4].message;
                        arrayAds[vbvn4][5] = obj[vbvn4].created_time;
                        arrayAds[vbvn4][6] = obj[vbvn4].link;
                        arrayAds[vbvn4][7] = obj[vbvn4].likes;
                        arrayAds[vbvn4][8] = obj[vbvn4].total_reach;
                        arrayAds[vbvn4][9] = obj[vbvn4].engaged_users;
                        arrayAds[vbvn4][10] = obj[vbvn4].clicks;
                        arrayAds[vbvn4][11] = obj[vbvn4].link_clicks;
                      }
                      //ordenar
                      if(ordenar==1){
                        arrayAds.sort(function(a, b){
	                 if(a[7] > b[7]) return -1;
                         if(a[7] < b[7]) return 1;
                        });
                      }
                      if(ordenar==2){
                        arrayAds.sort(function(a, b){
	                 if(a[10] > b[10]) return -1;
                         if(a[10] < b[10]) return 1;
                        });
                      }
                      if(ordenar==3){
                        arrayAds.sort(function(a, b){
	                 if(a[8] > b[8]) return -1;
                         if(a[8] < b[8]) return 1;
                        });
                      }
                      if(ordenar==4){
                        arrayAds.sort(function(a, b){
	                 if(a[9] > b[9]) return -1;
                         if(a[9] < b[9]) return 1;
                        });
                      }
		      for(var vbvn4=0; vbvn4<obj.length ;vbvn4++){
		        $('#main-feed'+(vbvn4+1)+'Text').html(arrayAds[vbvn4][1]);
                        $('.imgIcon'+(vbvn4+1)+'').attr("src","images/fan-page.png");
                        $('#fechaShare'+(vbvn4+1)+'').html('<a target="_blank" href="'+arrayAds[vbvn4][3]+'">'+arrayAds[vbvn4][5].substr(0,10)+'</a>');
                        if(arrayAds[vbvn4][2]!=null){
	 	          $('#imageShare'+(vbvn4+1)+'').attr("src",arrayAds[vbvn4][2]);
                        } else {
	 	          $('#imageShare'+(vbvn4+1)+'').attr("src","images/logo-bamboostr.png");
                        }
                        
                        if(!arrayAds[vbvn4][4] || arrayAds[vbvn4][4].length<80){
	 	          $('#descripcionShare'+(vbvn4+1)+'').html(arrayAds[vbvn4][4]);
                        } else {
	 	          $('#descripcionShare'+(vbvn4+1)+'').html(arrayAds[vbvn4][4].substr(0,80)+"...");
                        }
                        if(arrayAds[vbvn4][7]!=null){
                          $('#likeShare'+(vbvn4+1)+'').html(arrayAds[vbvn4][7]);
                        } else {
                          $('#likeShare'+(vbvn4+1)+'').html("0");
                        }
                        if(arrayAds[vbvn4][8]!=null){
                          $('#reachShare'+(vbvn4+1)+'').html(arrayAds[vbvn4][8]);
                        } else {
                          $('#reachShare'+(vbvn4+1)+'').html("0");
                        }
                        if(arrayAds[vbvn4][9]!=null){
                          $('#engagedShare'+(vbvn4+1)+'').html(arrayAds[vbvn4][9]);
                        } else {
                          $('#engagedShare'+(vbvn4+1)+'').html("0");
                        }
                        if(arrayAds[vbvn4][10]!=null){
                          $('#clickPostShare'+(vbvn4+1)+'').html(arrayAds[vbvn4][10]);
                        } else {
                          $('#clickPostShare'+(vbvn4+1)+'').html("0");
                        }
                        if(arrayAds[vbvn4][11]!=null){
                          $('#clickShare'+(vbvn4+1)+'').html(arrayAds[vbvn4][11]);
                        } else {
                          $('#clickShare'+(vbvn4+1)+'').html("0");
                        }
                        $('#footerShare'+(vbvn4+1)+'').html('<button onclick="patrocinarAd('+comilla+''+identifyLocal+''+comilla+','+comilla+''+identifyOther+''+comilla+','+comilla+''+redLocal+''+comilla+','+comilla+''+imagenRed+''+comilla+','+comilla+''+tipo+''+comilla+','+comilla+''+screenname+''+comilla+','+comilla+''+ordenar+''+comilla+','+comilla+''+arrayAds[vbvn4][0]+''+comilla+','+comilla+''+obj.length+''+comilla+');" class="btn btn-warning" style="margin: 1.5em 0em 2em 0em;">'+txt495+'</button>');
		      }
	            } else {
	              toastr["error"](txt52, "ERROR");
	            }
	            $(".ui-dialog-titlebar-close").show();
		    $("#cargando").closest('.ui-dialog-content').dialog('close');
		  },
		  error: function (response){
		    //error primario
			$("#cargando").closest('.ui-dialog-content').dialog('close');
			toastr["error"](txt493, "ERROR");
			$(".ui-dialog-titlebar-close").show();
		  }
	});
}