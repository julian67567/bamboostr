var redesAdd = new Array();
var imagenesAgregadas = '';

function programarFecha(opcion){
  if(opcion==1){
    $("#programar435f").css("display","block");
    calendarioInit();
  } else {
    $("#programar435f").css("display","none");
  }
}

function abrirEscribir4e(){
  ga('send', 'event', 'Escribir', 'click', 'Escribir');
  $('#signup-modal').modal('show');
}

var option = 0;
function trends(country){
	var i=0;
        var screenName2 = '';
	while(i<redesAdd.length){
		if(redesAdd[i]['name'].substring(0,1)=="@"){
                  screenName2 = redesAdd[i]['name'].substring(1,redesAdd[i]['name'].length);
                  i = redesAdd.length;
                }
		i++;
	}
  if(screenName2!=""){
    $("#trendingTopicD").css("display","block");
    $.ajax({url:   'twitter/thread-tw.php?option=trends&screen_name='+screenName2+'&country='+country,
	  type:  'GET',
	  success:  function (response) { 
            if(response){
	      obj = JSON.parse(response);
              var trendingHTML = '';
              for(var gvjsp2=0; gvjsp2<10; gvjsp2++){
                trendingHTML += '<a style="padding-right: 20px" target="_blank" href="'+obj[gvjsp2].url+'">'+obj[gvjsp2].name+'</a>';
              }
              $("#trending").html(trendingHTML);
            } else {
              $("#trending").html(txt117);
            }
	  }, error: function (response){
	    toastr["error"](txt117, "ERROR");
	  }
    });
  } else {
    $("#trendingTopicD").css("display","none");
  }
}

function trends_block(){
      getCat(9);
      $("#contenido").css("display","block");
      if(option == 0)
      {   trends('23424900');
          option = 1;
          
      }
      else
      {
          $("#trendingTopicD").css("display","none");
          $("#contenido").css("display","none");
          option = 0;
      }
}

var option2 = 0;
function imagenes_block(){
      
      if(option2 == 0)
      {   $("#imagenes").css("display","block");
          buscar_imagen(1);
          option2 = 1;
          
      }
      else
      {
          $("#imagenes").css("display","none");
          option2 = 0;
      }
}

function imagenesHover(total){
  for(var cont3234=1; cont3234<=total; cont3234++){
	var sheet = document.createElement('style')
	sheet.innerHTML = "div#image2Div"+cont3234+" { position: relative; margin:5px; }";
	sheet.innerHTML += "div#image2Div"+cont3234+":hover img{ opacity:0.7; }";
	/*zoom*/
	sheet.innerHTML += "div#image2Div"+cont3234+":hover #imageZoom"+cont3234+" { padding-top: 5px; padding-left: 0px; background-position: center center; width: 25px; height: 25px; background-color: rgba(204,204,204,0.7); cursor: pointer; z-index: 1; top: 70px; left: 10px; display: block; }";
	sheet.innerHTML += "div#image2Div"+cont3234+":hover #imageZoom"+cont3234+":hover { padding-top: 8px; padding-left: 1px; width: 30px; height: 30px; background-color: rgba(204,204,204,0.7); cursor: pointer; z-index: 1; top: 67px; left: 7px; display: block; }";
	/*Add*/
	sheet.innerHTML += "div#image2Div"+cont3234+":hover #imageAdd"+cont3234+" { padding-left: 0px; padding-top: 5px; width: 25px; height: 25px; cursor: pointer; z-index: 1;  top: 70px; left: 65px; display: block; background-color: rgba(204,204,204,0.7); }";
	sheet.innerHTML += "div#image2Div"+cont3234+":hover #imageAdd"+cont3234+":hover { padding-left: 1px; padding-top: 7px; width: 30px; height: 30px; cursor: pointer; z-index: 1; top: 68px;  left: 62px; display: block; background-color: rgba(204,204,204,0.7); }";
	sheet.innerHTML += "div#image2Div"+cont3234+" div { position:absolute; display:none; }";
	document.body.appendChild(sheet);
	$('.tooltipped').tooltip({delay: 50});
  }
}

var buscar = "";
function buscar_imagen(option69){
     var htmlB = '';
        htmlB = '<div class="Knight-Rider-loader animate">'
	         +'<div class="Knight-Rider-bar"></div>'
	         +'<div class="Knight-Rider-bar"></div>'
	         +'<div class="Knight-Rider-bar"></div>'
	        +'</div>';
        $("#imagenes_bus").html(htmlB);
       
        if(option69 == 1)
          buscar = "food";
        else
        { 
          buscar = $("#buscador_imagenes").val();
          if(buscar == "")
            buscar = "food";
        }
        
          $.ajax({data:  {search:buscar, hoja:12},
          url:   'scripts/flicker/search.php',
          type:  'GET', 
          success:  function (response) { 
          obj = JSON.parse(response); 
           
            if(obj.data.length<12){
               $("#imagenes_bus").html("No se encontró una imagen");
            }
            else
            {
            var imageBamRe = "'images/logo-bamboostr.png'";
            htmlB = '<div class="col-md-12">'
                        +'<div class="col-md-2">'
                          +'<center><div style="width: 100px;" id="image2Div1"><a href="'+obj.data[0].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom1" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd1" onclick="add2('+comilla+'1'+comilla+','+comilla+''+obj.data[0].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[0].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image21"></div></center>'
                        +'</div>'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div2"><a href="'+obj.data[1].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom2" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd2" onclick="add2('+comilla+'2'+comilla+','+comilla+''+obj.data[1].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[1].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image22"></div></center>'
                        +'</div>'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div3"><a href="'+obj.data[2].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom3" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd3" onclick="add2('+comilla+'3'+comilla+','+comilla+''+obj.data[2].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[2].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image23"></div></center>'
                        +'</div>'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div4"><a href="'+obj.data[3].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom4" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd4" onclick="add2('+comilla+'4'+comilla+','+comilla+''+obj.data[3].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[3].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image24"></div></center>'
                        +'</div>'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div5"><a href="'+obj.data[4].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom5" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd5" onclick="add2('+comilla+'5'+comilla+','+comilla+''+obj.data[4].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[4].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image25"></div></center>'
                        +'</div>'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div6"><a href="'+obj.data[5].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom6" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd6" onclick="add2('+comilla+'6'+comilla+','+comilla+''+obj.data[5].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[5].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image26"></div></center>'
                        +'</div>'
                      +'</div>'
                      +'<div class="col-md-12" style="padding-top:10px;">'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div7"><a href="'+obj.data[6].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom7" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd7" onclick="add2('+comilla+'7'+comilla+','+comilla+''+obj.data[6].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[6].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image27"></div></center>'
                        +'</div>'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div8"><a href="'+obj.data[7].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom8" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd8" onclick="add2('+comilla+'8'+comilla+','+comilla+''+obj.data[7].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[7].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image28"></div></center>'
                        +'</div>'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div9"><a href="'+obj.data[8].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom9" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd9" onclick="add2('+comilla+'9'+comilla+','+comilla+''+obj.data[8].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[8].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image29"></div></center>'
                        +'</div>'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div10"><a href="'+obj.data[9].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom10" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd10" onclick="add2('+comilla+'10'+comilla+','+comilla+''+obj.data[9].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[9].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image210"></div></center>'
                        +'</div>'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div11"><a href="'+obj.data[10].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom11" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd11" onclick="add2('+comilla+'11'+comilla+','+comilla+''+obj.data[10].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[10].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image211"></div></center>'
                        +'</div>'
                        +'<div class="col-md-2" style="text-align:center">'
                          +'<center><div style="width: 100px;" id="image2Div12"><a href="'+obj.data[11].imagenGrande+'" style="color: black;" class="fresco" data-fresco-group="example"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoom12" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div data-position="top" data-tooltip="Agregar Imagen" id="imageAdd12" onclick="add2('+comilla+'12'+comilla+','+comilla+''+obj.data[11].imagenGrande+''+comilla+');" class="img-circle glyphicon glyphicon-plus tooltipped"></div><img src="' + obj.data[11].imagenS + '" onerror="this.src='+imageBamRe+'" class="recoImages2" id="image212"></div></center>'
                        +'</div>'
                      +'</div>'

                        
                        +'<div class="col-md-12">'

                          +'<div class="col-md-3">'
                          +'</div>'

                          +'<div class="col-md-6" style="text-align: center; padding-top:15px;">'
                            +'<a onclick="buscar_imagen(2);" style="background-color:#26A8FF; width:250px;" class="waves-effect waves-light btn">Más imágenes</a>'
                          +'</div>'

                          +'<div class="col-md-3">'
                          +'</div>'

                        +'</div>';

                      $("#imagenes_bus").html(htmlB);
                      imagenesHover(12);
                  }

          }, error: function (response){
               toastr["error"]("Inténtalo de nuevo más tarde", "ERROR");
             }
        });
}

$(document).keydown(function(e){
    /* alert(e.keyCode); */
    if(e.which==13){   
      if($("#buscador_imagenes").is(":focus")==true){
          buscar_imagen(2);
        
      }
    }
});

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
              var htmlC = '';
              /*for(var hgn=1; hgn<=50; hgn++){
                $("#main-feed"+hgn+"").parent().parent().css("display","none");
              }*/
                        htmlC = '<div class="col-lg-12">'
                          +'<div class="col-lg-6">'
                              +'<div class="col-lg-3" style="vertical-align: top; padding:0;">'
                                +'<img src="' + obj[0].img + '" class="recoImages" id="">'
                              +'</div>'
                              +'<a href="' + obj[0].link + '" target="_blank"><div class="col-lg-9" style="cursor:pointer; padding:0;">'
                                +'<div style="margin-bottom: 0; padding-left: 25px;" class="row">'
                                  +'<span style="color: #0a6ebd; padding-top: 3px; padding-left: 0px; font-size: 18px;" id="">' + obj[0].title + '</span>'
                                +'</div>'
                                +'<div class="row" style="padding-left: 25px;">'
                                  +'<span style="color: #929292; padding-top: 3px; padding-left: 0px; font-size: 16px;" id="">';
                                    if(obj[0].description.length>50)
                                       htmlC += '' + obj[0].description.substr(0,50) + '...';
                                    else
                                       htmlC += '' + obj[0].description.substr(0,50);
                                 htmlC += '</span>'
                                +'</div>'
                              +'</div></a>'
                            +'</div>'

                            +'<div class="col-lg-6">'
                              +'<div class="col-lg-3" style="vertical-align: top; padding:0;">'
                                +'<img src="' + obj[1].img + '" class="recoImages" id="">'
                              +'</div>'
                              +'<a href="' + obj[1].link + '" target="_blank"><div class="col-lg-9" style="cursor:pointer; padding:0;">'
                                +'<div style="margin-bottom: 0; padding-left: 25px;" class="row">'
                                  +'<span style="color: #0a6ebd; padding-top: 3px; padding-left: 0px; font-size: 18px;" id="">' + obj[1].title + '</span>'
                                +'</div>'
                                +'<div class="row" style="padding-left: 25px;">'
                                  +'<span style="color: #929292; padding-top: 3px; padding-left: 0px; font-size: 16px;" id="">';
                                    if(obj[1].description.length>50)
                                       htmlC += '' + obj[1].description.substr(0,50) + '...';
                                    else
                                       htmlC += '' + obj[1].description.substr(0,50);
                                 htmlC += '</span>'
                                +'</div>'

                              +'</div></a>'
                            +'</div>'
                          +'</div>'
                                  
                          +'<div class="col-lg-12">'  
                            +'<div class="col-lg-6">'
                              +'<div class="col-lg-3" style="vertical-align: top; padding:0;">'
                                +'<img src="' + obj[2].img + '" class="recoImages" id="">'
                              +'</div>'
                              +'<a href="' + obj[2].link + '" target="_blank"><div class="col-lg-9" style="cursor:pointer; padding:0;">'
                                +'<div style="margin-bottom: 0; padding-left: 25px;" class="row">'
                                  +'<span style="color: #0a6ebd; padding-top: 3px; padding-left: 0px; font-size: 18px;" id="">' + obj[2].title + '</span>'
                                +'</div>'
                                +'<div class="row" style="padding-left: 25px;">'
                                  +'<span style="color: #929292; padding-top: 3px; padding-left: 0px; font-size: 16px;" id="">';
                                    if(obj[2].description.length>50)
                                       htmlC += '' + obj[2].description.substr(0,50) + '...';
                                    else
                                       htmlC += '' + obj[2].description.substr(0,50);
                                 htmlC += '</span>'
                                +'</div>'
                              +'</div></a>'
                            +'</div>'

                            +'<div class="col-lg-6">'
                              +'<div class="col-lg-3" style="vertical-align: top; padding:0;">'
                                +'<img src="' + obj[3].img + '" class="recoImages" id="">'
                              +'</div>'
                              +'<a href="' + obj[3].link + '" target="_blank"><div class="col-lg-9" style="cursor:pointer; padding:0;">'
                                +'<div style="margin-bottom: 0; padding-left: 25px;" class="row">'
                                  +'<span style="color: #0a6ebd; padding-top: 3px; padding-left: 0px; font-size: 18px;" id="">' + obj[3].title + '</span>'
                                +'</div>'
                                +'<div class="row" style="padding-left: 25px;">'
                                  +'<span style="color: #929292; padding-top: 3px; padding-left: 0px; font-size: 16px;" id="">';
                                    if(obj[3].description.length>50)
                                       htmlC += '' + obj[3].description.substr(0,50) + '...';
                                    else
                                       htmlC += '' + obj[3].description.substr(0,50);
                                 htmlC += '</span>'
                                +'</div>'
                              +'</div></a>'
                            +'</div>'
                          +'</div>';

        $("#articulo").html(htmlC);
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

function regresarRed(image, id, c, name, idAccount){
	$('#'+id+''+idAccount+'').css("display","none");
	var i=0;
	while(i<redesAdd.length){
		if(redesAdd[i]['id']==id && redesAdd[i]['idAccount']==idAccount){
                        $('#redes'+c+'').css("background",""); 
                        $('#redesImg'+c+'').css("opacity","1");
                        $('#redes'+c+'').attr("onclick","agregarRedSocial('"+image+"','"+id+"','"+c+"','"+name+"','"+idAccount+"');");
			redesAdd.splice(i, 1);
			i=redesAdd.length;
		}
		i++;
	}
	$('#redes'+c+'').css("display","block");
        $("#trendingTopicD").css("display","none"); 
        //if(option == 1)
          //trends('23424900');
	contadorTeclasCalc();
}
function agregarRedSocial(image, id, c, name, idAccount){
	/*$('#redes'+c+'').css("display","none");*/
        $('#redes'+c+'').css("color","#FFFFFF");
        $('#redesImg'+c+'').css("opacity","0.1");
        $('#redes'+c+'').css("background","url(http://bamboostr.com/images/palomita.png) center center / 35px 35px no-repeat #8a8a8a");
        $('#redes'+c+'').attr("onclick","regresarRed('"+image+"','"+id+"','"+c+"','"+name+"','"+idAccount+"');");

	if(redesAdd.length==25)
	  toastr["warning"](txt85);
	if(redesAdd.length==10 && document.getElementById("comparte").value!="" &&
	   document.getElementById("comparte").value!=txt64)
	  toastr["warning"](txt127);
	redesAdd[redesAdd.length] = new Array();
	redesAdd[redesAdd.length-1]['id'] = id;
	redesAdd[redesAdd.length-1]['idAccount'] = idAccount;
	redesAdd[redesAdd.length-1]['name'] = name;
	redesAdd[redesAdd.length-1]['image'] = image;
	var a = '';
	for(var i=0; i<redesAdd.length; i++){
		a = a + redesAdd[i]['img'];
	}
	$('#redesAgregadas').html(a);
	contadorTeclasCalc();
        if(option == 1)
          trends('23424900');
}
function contadorTeclasCalc(){
	var faDisplay = 0;
	var twDisplay = 0;
	var inDisplay = 0;
	for(var i=0; i<redesAdd.length; i++){
      if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="fa")
	    faDisplay=1;
      if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="tw")
	    twDisplay=1;
      if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="in")
	    inDisplay=1;
	}
	 
	if(faDisplay==1){
	  $('#contFa').css("display","block");
	  teclas();
	} else {
	  $('#contFa').css("display","none");
	}
	if(twDisplay==1){
	  $('#contTw').css("display","block");
	  teclas();
	} else {
	  $('#contTw').css("display","none");
	}
	if(inDisplay==1){
	  $('#contIn').css("display","block");
	  teclas();
	} else {
	  $('#contIn').css("display","none");
	}
	if(typeof redesAdd[0]=="undefined"){
	  $('#contIn').css("display","none");
	  $('#contFa').css("display","none");
	  $('#contTw').css("display","none");
	}
}
function enviarBotonComenta2(opcion){
  $('body').attr("class","loading");
  if(document.getElementById("timepicker").value && $("input[name=horasp]:checked").val()=="Otro"){
    horaGlobalProgramada = document.getElementById("timepicker").value;
  }
  console.log(fechaGlobalProgramada + " " + horaGlobalProgramada);
  $('#enviarBotonComenta').css('display','none');
  $('#loadingEscribir').css('display','inline-block');
  var finishSend = 0;
  
  var contador = document.getElementById("comparte").value;
  imagenesAgregadasArray=imagenesAgregadas.split(",");
  if(typeof redesAdd[0]=="undefined"){
	toastr["warning"](txt65);
	$('#enviarBotonComenta').css("display","inline-block");
	$('#loadingEscribir').css('display','none');
    $('body').addClass('loaded');
  } else if((contador.length==0 || contador==txt64) && imagenesAgregadasArray.length==1){
	toastr["warning"](txt67);
	$('#enviarBotonComenta').css("display","inline-block");
	$('#loadingEscribir').css('display','none');
    $('body').addClass('loaded');
  } else if($("#contIn").css("display")=="block" && imagenesAgregadasArray.length==1){
    toastr["warning"]("Instagram necesita mínimo una imágen.");
    $('body').addClass('loaded');
  } else if ( ((contador.length>=141 || contador.length<0) && $("#contTw").css("display")=="block") || ((imagenesAgregadas!="" && contador.length+24>=141) && $("#contTw").css("display")=="block")){
	toastr["warning"](txt66);
	$('#enviarBotonComenta').css("display","inline-block");
	$('#loadingEscribir').css('display','none');
    $('body').addClass('loaded');
  } else if( ((contador.length>=2001 || contador.length<0) && $("#contFa").css("display")=="block") ){
	toastr["warning"](txt66);
	$('#enviarBotonComenta').css("display","inline-block");
	$('#loadingEscribir').css('display','none');
    $('body').addClass('loaded');
  }  else if( ((contador.length>=2001 || contador.length<0) && $("#contIn").css("display")=="block") ){
	toastr["warning"](txt66);
	$('#enviarBotonComenta').css("display","inline-block");
	$('#loadingEscribir').css('display','none');
    $('body').addClass('loaded');
  } else if((!fechaGlobalProgramada && horaGlobalProgramada) || 
            (fechaGlobalProgramada && !horaGlobalProgramada)){
	toastr["warning"](txt83);
	$('#enviarBotonComenta').css("display","inline-block");
	$('#loadingEscribir').css('display','none');
    $('body').addClass('loaded');
  }
  else if($("input[name=group1]:checked").val()=="ahora" && opcion==1){
        ga('send', 'event', 'Mensaje Normal', 'click', 'Mensaje Normal');
        //normales
	var contSpamDescText = 0;
	//Si dice escribir ponemos el mensaje vacío
	if(contador==txt64)
	  contador="";
	for(var i=0; i<redesAdd.length; i++){
		var idAccountAdd = '';
		var userTempName = '';
		if(typeof redesAdd[i]['idAccount']!="undefined"){
		  idAccountAdd = redesAdd[i]['idAccount'];
		}
		if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="tw"){
		    var urlPostMassive = 'twitter/post-media.php';
			userTempName = redesAdd[i]['name'].substr(1);
	    }
	    else if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="fa"){
		    var urlPostMassive = 'facebook/post-message.php';
			userTempName = redesAdd[i]['name'];
			if(contSpamDescText>4 && imagenesAgregadas!=""){
			  contador='';
			}
			contSpamDescText++;
		} else if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="in"){
		    var urlPostMassive = 'instagram/post-message.php';
			userTempName = redesAdd[i]['name'];
		}
	    var parametros = { images:imagenesAgregadas, description:contador,
	    				   identify:redesAdd[i]['id'].substr(0, redesAdd[i]['id'].length-2),
	    				   idPost:idAccountAdd.substr(0, idAccountAdd.length-2),
						   screen_name:userTempName, id_token:id_token
						 };
		$.ajax({    data:  parametros,
					url:   urlPostMassive,
					type:  'GET',
					success:  function (response) {
						responseArray = response.split("|");
						if(response.indexOf("does not have permission to post photos on this page")!="-1"){
						  toastr["error"](txt86 +" "+ responseArray[1]);
						} else if(response.indexOf("misusing this feature")!="-1"){
						  toastr["error"](txt87 +" "+ responseArray[1]);
						} else if(response.indexOf("Permissions error")!="-1"){
						  toastr["error"](txt88 +" "+ responseArray[1]);
						} else if(response.indexOf("Unsupported post request")!="-1"){
						  toastr["error"](txt89 +" "+ responseArray[1]);
						} else if(response.indexOf("An unknown error")!="-1"){
						  toastr["error"](txt119 +" "+ responseArray[1]);
						} else if(response.indexOf("This app has been restricted from uploading photos")!="-1"){
						  toastr["error"](txt120 +" "+ responseArray[1]);
						} else if(response.indexOf("Status is over 140 characters")!="-1"){
						  toastr["error"](txt184 +" "+ responseArray[1]);
						} else if(response.indexOf("false")!="-1" && response.indexOf("created_at")=="-1") {
						  toastr["error"](txt90 +" "+ responseArray[1]);
						} 
						 finishSend++;
						if(finishSend==redesAdd.length){
                          rastrear('publicaciones');
                          $('body').addClass('loaded');
						  toastr["success"]("",txt91);
						  $('#enviarBotonComenta').css("display","inline-block");
						  $('#loadingEscribir').css('display','none');
                          document.getElementById("comparte").value = "";
                          imagenesAgregadas = '';
                          $('#ImagesUploaded').html("");
						}
					},
					error: function (response){
                      $('body').addClass('loaded');
					  toastr["error"](txt92);
					  $('#enviarBotonComenta').css("display","inline-block");
					  $('#loadingEscribir').css('display','none');
					  finishSend++;
					}
		});
	}
  } else if(opcion==1){
        ga('send', 'event', 'Mensaje Programado', 'click', 'Mensaje Programado');
        //programados
	var timePrArray = horaGlobalProgramada;
	timePr = timePrArray.split(":");
	timePrH = timePr[0];
	timePrMArray = timePr[1].split(" ");
	timePrM = timePrMArray[0];
	timeP = timePrH + "" +timePrM;
	var date = new Date();
	timeRFecha = date.getDate() + "/" +(date.getMonth()+1) + "/" +  date.getFullYear();
	timeR = date.getHours() + "" +date.getMinutes() + " ";
	
	timeRFechaParse = monthNames[parseInt(date.getMonth())] + " " +date.getDate() + ", " +  date.getFullYear();
	timePFechaArray = fechaGlobalProgramada.split("-");
	timePFechaParse = monthNames[parseInt(timePFechaArray[1]-1)] + " " +timePFechaArray[0] + ", " +  timePFechaArray[2];
	
	if(Date.parse(timePFechaParse)>=Date.parse(timeRFechaParse)){
	  if(parseInt(timeP)>parseInt(timeR) && (Date.parse(timePFechaParse)==Date.parse(timeRFechaParse)) || (Date.parse(timePFechaParse)>Date.parse(timeRFechaParse))){
	    var contSpamDescText = 0;
		//Si dice escribir ponemos el mensaje vacío
		if(contador==txt64)
		  contador="";
		for(var i=0; i<redesAdd.length; i++){
			var idAccountAdd = '';
			var userTempName = '';
			var redMsg = '';
			if(typeof redesAdd[i]['idAccount']!="undefined"){
			  idAccountAdd = redesAdd[i]['idAccount'];
			}
			if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="tw"){
                if(opcion==1){
                    var urlPostMassive = 'scripts/post-program-message.php';
                } else {
                    var urlPostMassive = 'scripts/post-draft-message.php';
                } 
				userTempName = redesAdd[i]['name'].substr(1);
				redMsg = 'twitter';
			} else if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="fa"){
				if(opcion==1){
				  var urlPostMassive = 'scripts/post-program-message.php';
                } else {
                    var urlPostMassive = 'scripts/post-draft-message.php';
                }
				userTempName = redesAdd[i]['name'];
				redMsg = 'facebook';
				if(contSpamDescText>4 && imagenesAgregadas!=""){
			      contador='';
			    }
			    contSpamDescText++;
			} else if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="in"){
				if(opcion==1){
				  var urlPostMassive = 'scripts/post-program-message.php';
                } else {
                  var urlPostMassive = 'scripts/post-draft-message.php';
                }
				userTempName = redesAdd[i]['name'];
				redMsg = 'instagram';
			    toastr["success"]("Para poder lanzar el mensaje programado de instagram, necesitas descargar la APP móvil de bamboostr Disponible en App Store y Play Store.");
            }
			var fecha = fechaGlobalProgramada + " " + 
						timePrH + ":" +timePrM;
			var parametros = { images:imagenesAgregadas, description:contador,
							   identify:redesAdd[i]['id'].substr(0, redesAdd[i]['id'].length-2),
							   idPost:idAccountAdd.substr(0, idAccountAdd.length-2),
							   screen_name:userTempName, fecha:fecha, red:redMsg, id_token:id_token,
							   horario:husoHorario, image_profile:redesAdd[i]['image']
							 };
			$.ajax({    data:  parametros,
						url:   urlPostMassive,
						type:  'GET',
						success:  function (response) {
                                                        
							finishSend++;
							if(finishSend==redesAdd.length){
                              rastrear('publicaciones');
                              $('body').addClass('loaded');
							  if(urlPathActual=="system")
							    getMsgsProgram(''+window["feedMsgsProgramCol"]+'');
							  toastr["success"](txt84);
							  $('#enviarBotonComenta').css("display","inline-block");
							  $('#loadingEscribir').css('display','none');
                              document.getElementById("comparte").value = "";
                              imagenesAgregadas = '';
                              $('#ImagesUploaded').html("");
                              window.location="calendario.php";
							}
						},
						error: function (response){
                          $('body').addClass('loaded');
						  toastr["error"](txt92);
						  $('#enviarBotonComenta').css("display","inline-block");
						  $('#loadingEscribir').css('display','none');
						  finishSend++;
						}
			});
		}//fin for
	  } else {
        $('body').addClass('loaded');
	    toastr["warning"](txt124);
		$('#enviarBotonComenta').css("display","inline-block");
	    $('#loadingEscribir').css('display','none');
	  }
	} else {
      $('body').addClass('loaded');
	  toastr["warning"](txt132);
	  $('#enviarBotonComenta').css("display","inline-block");
	  $('#loadingEscribir').css('display','none');
	}
  } else if(opcion==2){
      ga('send', 'event', 'Mensaje Borrador', 'click', 'Mensaje Borrador');
      //drafts
      if(horaGlobalProgramada){
        var timePrArray = horaGlobalProgramada;
	timePr = timePrArray.split(":");
	timePrH = timePr[0];
	timePrMArray = timePr[1].split(" ");
	timePrM = timePrMArray[0];
	timeP = timePrH + "" +timePrM;
	var date = new Date();
	timeRFecha = date.getDate() + "/" +(date.getMonth()+1) + "/" +  date.getFullYear();
	timeR = date.getHours() + "" +date.getMinutes() + " ";
	
	timeRFechaParse = monthNames[parseInt(date.getMonth())] + " " +date.getDate() + ", " +  date.getFullYear();
	timePFechaArray = fechaGlobalProgramada.split("-");
	timePFechaParse = monthNames[parseInt(timePFechaArray[1]-1)] + " " +timePFechaArray[0] + ", " +  timePFechaArray[2];
      }

	    var contSpamDescText = 0;
		//Si dice escribir ponemos el mensaje vacío
		if(contador==txt64)
		  contador="";
		for(var i=0; i<redesAdd.length; i++){
			var idAccountAdd = '';
			var userTempName = '';
			var redMsg = '';
			if(typeof redesAdd[i]['idAccount']!="undefined"){
			  idAccountAdd = redesAdd[i]['idAccount'];
			}
			if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="tw"){
                                if(opcion==1){
				  var urlPostMassive = 'scripts/post-program-message.php';
                                } else {
                                  var urlPostMassive = 'scripts/post-draft-message.php';
                                } 
				userTempName = redesAdd[i]['name'].substr(1);
				redMsg = 'twitter';
			}
			else if(redesAdd[i]['id'].substr(redesAdd[i]['id'].length-2, redesAdd[i]['id'].length)=="fa"){
				if(opcion==1){
				  var urlPostMassive = 'scripts/post-program-message.php';
                                } else {
                                  var urlPostMassive = 'scripts/post-draft-message.php';
                                }
				userTempName = redesAdd[i]['name'];
				redMsg = 'facebook';
				if(contSpamDescText>4 && imagenesAgregadas!=""){
			      contador='';
			    }
			    contSpamDescText++;
			}
                      if(fechaGlobalProgramada){
			var fecha = fechaGlobalProgramada + " " + 
						timePrH + ":" +timePrM;
                      } else {
                        var fecha = ' ';
                      }
			var parametros = { images:imagenesAgregadas, description:contador,
							   identify:redesAdd[i]['id'].substr(0, redesAdd[i]['id'].length-2),
							   idPost:idAccountAdd.substr(0, idAccountAdd.length-2),
							   screen_name:userTempName, fecha:fecha, red:redMsg, id_token:id_token,
							   horario:husoHorario, image_profile:redesAdd[i]['image']
							 };
			$.ajax({    data:  parametros,
						url:   urlPostMassive,
						type:  'GET',
						success:  function (response) {
                                                        
							finishSend++;
							if(finishSend==redesAdd.length){
                              $('body').addClass('loaded');
							  if(urlPathActual=="system")
							    getDraftsProgram(''+window["feedDraftsProgramCol"]+'');
							  toastr["success"](txt142);
							  $('#enviarBotonComenta').css("display","inline-block");
							  $('#loadingEscribir').css('display','none');
                              document.getElementById("comparte").value = "";
                              imagenesAgregadas = '';
                              $('#ImagesUploaded').html("");
                              window.location="calendario.php";
							}
						},
						error: function (response){
                          $('body').addClass('loaded');
						  toastr["error"](txt92);
						  $('#enviarBotonComenta').css("display","inline-block");
						  $('#loadingEscribir').css('display','none');
						  finishSend++;
						}
			});
		}//fin for
  }
}
function comparte(){ 
  $("#comparte").css("font-size","0.9em");
  $("#comparte").css("height","5.9em");
  if(document.getElementById("comparte").value==txt64){
	document.getElementById("comparte").value="";
    
	var elem = document.getElementById("contadorFa");
	elem.style.color = "black";
	var elem = document.getElementById("contadorTw");
	elem.style.color = "black";
        
  }
}
function teclas(){
    var contadorT = document.getElementById("comparte").value.length;
    $("#compartirTxt").html(contadorT);
	teclasFa();
	teclasTw();
    teclasIn();
}
function teclasFa(){ 
  if(typeof redesAdd[0]!="undefined"){
	  var contador = document.getElementById("comparte").value;
	  document.getElementById("contadorFa").innerHTML=redesTeclasFa-contador.length;
	  if((redesTeclasFa-contador.length<0 && imagenesAgregadas=="") || (redesTeclasFa-(contador.length+24)<0 && imagenesAgregadas!=""))
	  { var elem = document.getElementById("contadorFa");
		elem.style.color = "red";
	  }
	  else
	  { var elem = document.getElementById("contadorFa");
		elem.style.color = "black";
	  }
  }
}
function teclasIn(){ 
  if(typeof redesAdd[0]!="undefined"){
	  var contador = document.getElementById("comparte").value;
	  document.getElementById("contadorIn").innerHTML=redesTeclasIn-contador.length;
	  if((redesTeclasIn-contador.length<0 && imagenesAgregadas=="") || (redesTeclasIn-(contador.length+24)<0 && imagenesAgregadas!=""))
	  { var elem = document.getElementById("contadorIn");
		elem.style.color = "red";
	  }
	  else
	  { var elem = document.getElementById("contadorIn");
		elem.style.color = "black";
	  }
  }
}
function teclasTw(){ 
  //if(typeof redesAdd[0]!="undefined"){
	  var contador = document.getElementById("comparte").value;
	  if(imagenesAgregadas!=""){
        document.getElementById("contadorTw").innerHTML=redesTeclasTw-(contador.length+24);
	  } else {
		document.getElementById("contadorTw").innerHTML=redesTeclasTw-contador.length;
	  }
	  if((redesTeclasTw-contador.length<0 && imagenesAgregadas=="") || (redesTeclasTw-(contador.length+24)<0 && imagenesAgregadas!=""))
	  { var elem = document.getElementById("contadorTw");
		elem.style.color = "red";
	  } else
	  { var elem = document.getElementById("contadorTw");
		elem.style.color = "black";
	  }
  //}
}

function reemplazarFuncionesImage(id,url){
  imagenesAgregadasArray=imagenesAgregadas.split(",");
  imagenesAgregadas = "";
  for(var irewr23=0; irewr23<imagenesAgregadasArray.length-1; irewr23++){
    if($("#imageZoomm"+id+"").parent().attr("href")!=imagenesAgregadasArray[irewr23]){
      imagenesAgregadas += ""+imagenesAgregadasArray[irewr23]+","; 
    } else {
      imagenesAgregadas += ""+url+","; 
    }
  }
    
  $("#imageZoomm"+id+"").parent().attr("href",url);
  $("#imageCerrar"+id+"").attr("onclick","cerrarImage2('"+id+"','"+url+"');");
  $("#imageEdit"+id+"").attr("onclick","editImage2('"+id+"','"+url+"');");
  $("#imageMarca"+id+"").attr("onclick","marcaImage2('"+id+"','"+url+"');");
  console.log("Imagenes Agregadas");
  console.log(imagenesAgregadas);
}

var imageS = 0; 
function cerrarImage2(image,url){
  ga('send', 'event', 'Eliminar Imágen', 'click', 'Eliminar Imágen');
  $('.tooltipped').tooltip('remove');
  $('.tooltipped').tooltip({delay: 50});
  $("#imageDiv"+image+"").remove();
  imagenesAgregadasArray=imagenesAgregadas.split(",");
  imagenesAgregadas = "";
  for(var irewr23=0; irewr23<imagenesAgregadasArray.length-1; irewr23++){
    if(url!=imagenesAgregadasArray[irewr23]){
      imagenesAgregadas += ""+imagenesAgregadasArray[irewr23]+","; 
    } 
  }
}

function editImage2(image,url){
  ga('send', 'event', 'Editar Imágen', 'click', 'Editar Imágen');
  launchEditor('image'+image+'', url);
  $('.tooltipped').tooltip('remove');
  $('.tooltipped').tooltip({delay: 50});
}

var imageWatermark = "";
var imageBackWatermark = "";

function marcaImage2(image,url){
  imageBackWatermark = $('#image'+image+'').attr("src");
  $("#watermark").modal("show");
  $("#preWatermark").attr("src",url);
  $("#saveWatermark").attr("onclick","saveWatermark('"+image+"')");
  radioWatermark();
}

function radioWatermark(){
  if(imageWatermark!=""){
    console.log("Radio " + $('input[name=group2]:checked').val() + " Imagen: " + imageWatermark);
    $('#preWatermark').attr("src",""+imageBackWatermark+"");
    console.log($("#outputImage").attr("src"));
    if($('input[name=group2]:checked').val()=="lower-right"){
        watermark([$(".watermark").attr("src"), $("#outputImage").attr("src")])
        .image(watermark.image.lowerRight(0.5))
        .then(function (img) {
            $(".watermark").attr("src",img.src);
        });
    } else if($('input[name=group2]:checked').val()=="lower-left"){
        watermark([$(".watermark").attr("src"), $("#outputImage").attr("src")])
        .image(watermark.image.lowerLeft(0.5))
        .then(function (img) {
            $(".watermark").attr("src",img.src);
        });
    }  else if($('input[name=group2]:checked').val()=="center"){
        watermark([$(".watermark").attr("src"), $("#outputImage").attr("src")])
        .image(watermark.image.center(0.5))
        .then(function (img) {
            $(".watermark").attr("src",img.src);
        });
    }  else if($('input[name=group2]:checked').val()=="upper-left"){
        watermark([$(".watermark").attr("src"), $("#outputImage").attr("src")])
        .image(watermark.image.upperLeft(0.5))
        .then(function (img) {
            $(".watermark").attr("src",img.src);
        });
    }  else if($('input[name=group2]:checked').val()=="upper-right"){
        watermark([$(".watermark").attr("src"), $("#outputImage").attr("src")])
        .image(watermark.image.upperRight(0.5))
        .then(function (img) {
            $(".watermark").attr("src",img.src);
        });
    }  else {
        watermark([$(".watermark").attr("src"), $("#outputImage").attr("src")])
        .image(watermark.image.lowerLeft(0.5))
        .then(function (img) {
            $(".watermark").attr("src",img.src);
        });
    }
  } else {
    console.log("no hay imagen de agua");
  }
}
function subirImageWatermark(){
  ga('send', 'event', 'Marca de Agua Upload', 'click', 'Marca de Agua Upload');
  var rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
  if (document.getElementById("watermarkUpload").files.length === 0) { return; }
  var oFile = document.getElementById("watermarkUpload").files[0];
  imageWatermark=document.getElementById("watermarkUpload").files[0];
  watermark([$(".watermark").attr("src"), imageWatermark])
      .image(watermark.image.lowerRight(0.5))
      .then(function (img) {
        $(".watermark").attr("src",img.src);
  });
  if (!rFilter.test(oFile.type)) 
  { toastr["warning"](txt125);
	return; 
  }
  var fd = new FormData();
  fd.append("fileImage", oFile);
  $.ajax({  url:   'subirImagenes.php',
			type:  'POST',
			data:   fd,
			processData: false,
			contentType: false,
			success:  function (response) {
				if(response.indexOf("ERROR")=="-1"){
                    //imageWatermark = response;
                    $("#inputImage").attr("src", ""+response+"");  
                    $(".waterMarkOption").css("visibility","visible");
                    $("#size").trigger("change");
				} else {
				  toastr["warning"](txt126);
                }
			}
  });
}
function add2(numImageDiv, imagenGrande){
  ga('send', 'event', 'Agregar Imágen Recomendada', 'click', 'Agregar Imágen Recomendada');
  console.log("Agregar Imágen Recomendada");
  $('#fileImageMas').css("display","none");
  $('#cargandoFileImage').css("display","table");
  $.ajax({  url:   'subirImagenes.php',
			type:  'GET',
			data: { url: imagenGrande},
			success:  function (response) {
              if(response.indexOf("ERROR")=="-1"){
				  $('#cargandoFileImage').css("display","none");
				  $('#fileImageMas').css("display","inline-block");
				  $('#ImagesUploaded').css("display","inline-block");
                  imageS++;
                  $('#ImagesUploaded').html(document.getElementById("ImagesUploaded").innerHTML+'<div id="imageDiv'+imageS+'" style="display: table-cell;"><a href="'+response+'" style="color: black;" class="fresco" data-fresco-group="upload"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoomm'+imageS+'" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div onclick="editImage2('+comilla+''+imageS+''+comilla+','+comilla+''+response+''+comilla+');" data-position="top" data-tooltip="Editar Imagen" id="imageEdit'+imageS+'" class="img-circle glyphicon glyphicon-pencil tooltipped"></div><div data-position="top" data-tooltip="Eliminar" id="imageCerrar'+imageS+'" onclick="cerrarImage2('+comilla+''+imageS+''+comilla+','+comilla+''+response+''+comilla+');" class="img-circle glyphicon glyphicon-remove tooltipped"></div><div data-position="top" data-tooltip="Marca de Agua" id="imageMarca'+imageS+'" onclick="marcaImage2('+comilla+''+imageS+''+comilla+','+comilla+''+response+''+comilla+');" class="img-circle glyphicon glyphicon-picture tooltipped"></div><img id="image'+imageS+'" src="'+response+'" style="width: 100px; height: 100px;" /></div>');
				  $('#fileImage').val("");
var sheet = document.createElement('style') 
sheet.innerHTML = "div#imageDiv"+imageS+" { position: relative; float:left; margin:5px; }";
sheet.innerHTML += "div#imageDiv"+imageS+":hover img{ opacity:0.7; }";
/*zoom*/
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageZoomm"+imageS+" { padding-top: 5px; padding-left: 5px; background-position: center center; width: 25px; height: 25px; background-color: rgba(204,204,204,0.7); cursor: pointer; z-index: 1; top: 5px; left: 10px; display: block; }";
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageZoomm"+imageS+":hover { padding-top: 8px; padding-left: 8px; width: 30px; height: 30px; background-color: rgba(204,204,204,0.7); cursor: pointer; z-index: 1; top: 2px; left: 7px; display: block; }";
/*editar*/
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageEdit"+imageS+" { padding-top: 5px; padding-left: 5px; background-position: center center; width: 25px; height: 25px; background-color: rgba(204,204,204,0.7); cursor: pointer; z-index: 1; top: 70px; left: 10px; display: block; }";
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageEdit"+imageS+":hover { padding-top: 8px; padding-left: 8px; width: 30px; height: 30px; background-color: rgba(204,204,204,0.7); cursor: pointer; z-index: 1; top: 67px; left: 7px; display: block; }";
/*cerrar*/
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageCerrar"+imageS+" { padding-left: 5px; padding-top: 5px;  width: 25px; height: 25px; cursor: pointer; z-index: 1;  left: 65px; top: 5px; display: block; background-color: rgba(204,204,204,0.7); }";
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageCerrar"+imageS+":hover { padding-left: 8px; padding-top: 8px; width: 30px; height: 30px; cursor: pointer; z-index: 1;  left: 62px; top: 2px; display: block; background-color: rgba(204,204,204,0.7); }";
/*marca de agua*/
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageMarca"+imageS+" { padding-left: 5px; padding-top: 5px; width: 25px; height: 25px; cursor: pointer; z-index: 1;  top: 70px; left: 65px; display: block; background-color: rgba(204,204,204,0.7); }";
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageMarca"+imageS+":hover { padding-left: 8px; padding-top: 7px; width: 30px; height: 30px; cursor: pointer; z-index: 1; top: 68px;  left: 62px; display: block; background-color: rgba(204,204,204,0.7); }";
sheet.innerHTML += "div#imageDiv"+imageS+" div { position:absolute; display:none; }";
document.body.appendChild(sheet);
                  $('.tooltipped').tooltip('remove');
                  $('.tooltipped').tooltip({delay: 50});
				  imagenesAgregadas = imagenesAgregadas + ''+response+',';
				  contadorTeclasCalc();
				} else {
				  toastr["warning"](txt126);
                }
				 $('#cargandoFileImage').css("display","none");
				 $('#fileImageMas').css("display","table-cell");
				 $('#fileImage').val("");
			}
  });
}
function saveWatermark(image){
  ga('send', 'event', 'Marca de Agua Save', 'click', 'Marca de Agua Save');
  $("#watermark").modal("hide"); 
  $('#fileImageMas').css("display","none");
  $('#cargandoFileImage').css("display","table");
  console.log($('#preWatermark').attr("src"));
  $.ajax({  url:   'subirImagenes.php',
			type:  'POST',
			data: { base: $('#preWatermark').attr("src")},
                        contentType: "application/x-www-form-urlencoded",
			success:  function (response) {
                    $('.tooltipped').tooltip('remove');
                    $('.tooltipped').tooltip({delay: 50});
				if(response.indexOf("ERROR")=="-1"){
                    console.log(response);
                    $("#image"+image+"").attr("src",""+response+"");
                    reemplazarFuncionesImage(image,response);
				} else {
				  toastr["warning"](txt126);
                }
                $('#cargandoFileImage').css("display","none");
				$('#fileImageMas').css("display","inline-block");
				$('#fileImage').val("");
			}
  });
}
function subirImage(){
  ga('send', 'event', 'Subir Imágen', 'click', 'Subir Imágen');
  $('#fileImageMas').css("display","none");
  $('#cargandoFileImage').css("display","table");
  var rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
  if (document.getElementById("fileImage").files.length === 0) { return; }
  var oFile = document.getElementById("fileImage").files[0];
  if (!rFilter.test(oFile.type)) 
  { alert(txt125);
	$('#cargandoFileImage').css("display","none");
	$('#fileImageMas').css("display","inline-block");
	$('#fileImage').val("");
	return; 
  }
  var fd = new FormData();
  fd.append("fileImage", oFile);
  console.log(fd);
  $.ajax({  url:   'subirImagenes.php',
			type:  'POST',
			data:   fd,
			processData: false,
			contentType: false,
			success:  function (response) {
				if(response.indexOf("ERROR")=="-1"){
				  $('#cargandoFileImage').css("display","none");
				  $('#fileImageMas').css("display","inline-block");
				  $('#ImagesUploaded').css("display","inline-block");
                                  imageS++;
                                  $('#ImagesUploaded').html(document.getElementById("ImagesUploaded").innerHTML+'<div id="imageDiv'+imageS+'" style="display: table-cell;"><a href="'+response+'" style="color: black;" class="fresco" data-fresco-group="upload"><div style="" data-position="top" data-tooltip="Zoom" id="imageZoomm'+imageS+'" class="img-circle glyphicon glyphicon-search tooltipped"></div></a><div onclick="editImage2('+comilla+''+imageS+''+comilla+','+comilla+''+response+''+comilla+');" data-position="top" data-tooltip="Editar Imagen" id="imageEdit'+imageS+'" class="img-circle glyphicon glyphicon-pencil tooltipped"></div><div data-position="top" data-tooltip="Eliminar" id="imageCerrar'+imageS+'" onclick="cerrarImage2('+comilla+''+imageS+''+comilla+','+comilla+''+response+''+comilla+');" class="img-circle glyphicon glyphicon-remove tooltipped"></div><div data-position="top" data-tooltip="Marca de Agua" id="imageMarca'+imageS+'" onclick="marcaImage2('+comilla+''+imageS+''+comilla+','+comilla+''+response+''+comilla+');" class="img-circle glyphicon glyphicon-picture tooltipped"></div><img id="image'+imageS+'" src="'+response+'" style="width: 100px; height: 100px;" /></div>');
				  $('#fileImage').val("");
var sheet = document.createElement('style')
sheet.innerHTML = "div#imageDiv"+imageS+" { position: relative; float:left; margin:5px; }";
sheet.innerHTML += "div#imageDiv"+imageS+":hover img{ opacity:0.7; }";
/*zoom*/
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageZoomm"+imageS+" { padding-top: 5px; padding-left: 5px; background-position: center center; width: 25px; height: 25px; background-color: rgba(204,204,204,0.7); cursor: pointer; z-index: 1; top: 5px; left: 10px; display: block; }";
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageZoomm"+imageS+":hover { padding-top: 8px; padding-left: 8px; width: 30px; height: 30px; background-color: rgba(204,204,204,0.7); cursor: pointer; z-index: 1; top: 2px; left: 7px; display: block; }";
/*editar*/
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageEdit"+imageS+" { padding-top: 5px; padding-left: 5px; background-position: center center; width: 25px; height: 25px; background-color: rgba(204,204,204,0.7); cursor: pointer; z-index: 1; top: 70px; left: 10px; display: block; }";
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageEdit"+imageS+":hover { padding-top: 8px; padding-left: 8px; width: 30px; height: 30px; background-color: rgba(204,204,204,0.7); cursor: pointer; z-index: 1; top: 67px; left: 7px; display: block; }";
/*cerrar*/
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageCerrar"+imageS+" { padding-left: 5px; padding-top: 5px;  width: 25px; height: 25px; cursor: pointer; z-index: 1;  left: 65px; top: 5px; display: block; background-color: rgba(204,204,204,0.7); }";
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageCerrar"+imageS+":hover { padding-left: 8px; padding-top: 8px; width: 30px; height: 30px; cursor: pointer; z-index: 1;  left: 62px; top: 2px; display: block; background-color: rgba(204,204,204,0.7); }";
/*marca de agua*/
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageMarca"+imageS+" { padding-left: 5px; padding-top: 5px; width: 25px; height: 25px; cursor: pointer; z-index: 1;  top: 70px; left: 65px; display: block; background-color: rgba(204,204,204,0.7); }";
sheet.innerHTML += "div#imageDiv"+imageS+":hover #imageMarca"+imageS+":hover { padding-left: 8px; padding-top: 7px; width: 30px; height: 30px; cursor: pointer; z-index: 1; top: 68px;  left: 62px; display: block; background-color: rgba(204,204,204,0.7); }";
sheet.innerHTML += "div#imageDiv"+imageS+" div { position:absolute; display:none; }";
document.body.appendChild(sheet);
                                  $('.tooltipped').tooltip('remove');
                                  $('.tooltipped').tooltip({delay: 50});
				  imagenesAgregadas = imagenesAgregadas + ''+response+',';
				  contadorTeclasCalc();
				} else {
				  toastr["warning"](txt126);
                }
				 $('#cargandoFileImage').css("display","none");
				 $('#fileImageMas').css("display","inline-block");
				 $('#fileImage').val("");
			}
  });
}
function acortar(opcion, link){
  ga('send', 'event', 'Acortador', 'click', 'Acortador');
  $("#cargando").dialog("open");
  $("#cargando").dialog('option', 'title', 'Cargando');
  var loadStats = '<div class="Knight-Rider-loader animate">';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '<div class="Knight-Rider-bar"></div>';
	    loadStats += '</div>';
  $("#cargando").html("Realizando Proceso....Por favor Espere<br /><br />"+loadStats);
  if(opcion==2){
    var url123tr = link;
  } else {
    var url123tr = $("#nombreURL").val();
  }
  if((url123tr.indexOf("http://")!="-1" || url123tr.indexOf("https://")!="-1" || url123tr.indexOf("www.")!="-1") && url123tr.indexOf(".")!="-1" && url123tr.length>6){
	$.ajax({data:  { url:url123tr, id_token:id_token },
		url:   "scripts/acortador.php",
		type:  "GET",
		success:  function (response) {
		  obj = JSON.parse(response);
		  if(obj.shrink){
		    $("#nombreURL").val("http://bbo.st/"+obj.shrink+"");
                    if($("#comparte").val()==txt64){
                      $("#comparte").val("http://bbo.st/"+obj.shrink+"");
                    } else {  
                      $("#comparte").val($("#comparte").val()+" http://bbo.st/"+obj.shrink+"");
                    }
                    comparte();
                    teclas();
		    $("#nombreURL").css("color","black");
		  } else {
		    toastr["error"](txt92);
		  }
                  $("#cargando").dialog("close");
		} , error: function(response){
		  toastr["error"](txt92);
                  $("#cargando").dialog("close");
		}
        });
  } else {
    toastr["error"]("URL Incorrecta", "ERROR");
    $("#cargando").dialog("close");
  }
}

var fechaGlobalProgramada = "";

function calendarioInit()
{
   var date = new Date();
   var d = date.getDate();
   var m = date.getMonth();
   var y = date.getFullYear();

   var cId = $('#calendario'); //Change the name if you want. I'm also using thsi add button for more actions

   //Generate the Calendar
   cId.fullCalendar({
      height: 10,
      header: {
        right: '',
        center: 'prev, title, next',
        left: ''
      },
    
      theme: true, //Do not remove this as it ruin the design
      selectable: true,
      selectHelper: true,
      unselectAuto: false,
      editable: true,
      dayClick: function(date, jsEvent, view) {
        var fechaI = new Date(date);
        var fechaReal = moment(fechaI).add(1,'days').toString().split(" ");
        fechaReal = "" + fechaReal[2] + "-" + monthNames2[fechaReal[1]] + "-" + fechaReal[3];
        //var fecha = ''+fechaII.getFullYear()+'-'+fechaII.getMonth()+'-'+fechaII.getDay()+'';
        //$('#tabs').tabs({ active: 1 });
        //agregarEvento(0);
        //$("#datepicker2").val(fechaReal[2] + "-" + monthNames2[fechaReal[1]] + "-" + fechaReal[3]);
        //$('#calendario').fullCalendar('addEventSource', [{title: "lesson", start: date}]);
        fechaGlobalProgramada = fechaReal;
      },
      eventClick: function(calEvent, jsEvent, view) {
          //var fechaI = new Date(calEvent.start);
        //var fechaReal = moment(fechaI).toString().split(" ");
          //var fechaTxt = fechaReal[2] + "-" + monthNames2[fechaReal[1]] + "-" + fechaReal[3];
        //alert(txt391 + ": " + calEvent.title + " " + txt389 + ": " + fechaTxt + " a las: " + fechaReal[4] +" ");
        // change the border color just for fun
        //$(this).css('border-color', 'red');
        //agregarEvento(calEvent.id);
        //editarMsg(calEvent);
      },
      eventDrop: function(calEvent,dayDelta,minuteDelta,allDay,revetFunc) {      
      }
  });/*fin calendar*/

  //Create and ddd Action button with dropdown in Calendar header. 
  /*var actionMenu = '<ul class="actions actions-alt" id="fc-actions">' +
                      '<li class="dropdown">' +
                          '<a href="" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>' +
                          '<ul class="dropdown-menu dropdown-menu-right">' +
                              '<li class="active">' +
                                  '<a data-view="month" href="">Month View</a>' +
                              '</li>' +
                              '<li>' +
                                  '<a data-view="basicWeek" href="">Week View</a>' +
                              '</li>' + 
                              '<li>' +
                                  '<a data-view="agendaWeek" href="">Agenda Week View</a>' +
                              '</li>' +
                              '<li>' +
                                  '<a data-view="basicDay" href="">Day View</a>' +
                              '</li>' +
                              '<li>' +
                                  '<a data-view="agendaDay" href="">Agenda Day View</a>' +
                              '</li>' +
                          '</ul>' +
                      '</div>' +
                  '</li>';


    cId.find('.fc-toolbar').append(actionMenu);*/

    //Event Tag Selector
    (function(){
        $('body').on('click', '.event-tag > span', function(){
            $('.event-tag > span').removeClass('selected');
            $(this).addClass('selected'); 
        });
    })();  

    //Calendar views
    $('body').on('click', '#fc-actions [data-view]', function(e){
        e.preventDefault();
        var dataView = $(this).attr('data-view');
        
        $('#fc-actions li').removeClass('active');
        $(this).parent().addClass('active');

        cId.fullCalendar('changeView', dataView);  
    });/*full calendar*/  
    $('.fc').css('font-size','0.8em');                     
}
var horaGlobalProgramada = "";
function otraHoraB(){
  $('#otra_hora').css('display','block');
}

function otraHoraN(){
  horaGlobalProgramada = $("input[name=horasp]:checked").val();
  $('#otra_hora').css('display','none');
}