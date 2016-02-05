// JavaScript Document
var objetoNot123;
var objetoNot1234;
var notInterval = 100000;
function abrirNot(cont, option){
  var obj = objetoNot123.data[cont];
  console.log("Abrir Notificacion Nueva");
  console.log(obj);
  console.log(option);
  /*Ajax para marcar leído*/
  if(obj.read==0){
    var parametros = { id:obj.id};
	$.ajax({	data:  parametros,
				url:   "scripts/leidoNotificacion.php",
				type:  "post",
				success:  function (response) {
				} , error: function(response){
				}
	       });
  } 
  $("#notificacionesAbrir").modal("show");
	var htmlMail = '<html>';
	   htmlMail += '<head>';
	   htmlMail += '<meta charset="UTF-8">';
	   htmlMail += '</head>';
	   htmlMail += '<body style="text-align: center;">';
	   htmlMail += '<div style="width: 100%; text-align: center;" id="contenedor">';
	   htmlMail += '  <a href="http://bamboostr.com"><img style="width: 100%;" src="http://bamboostr.com/images/mails/bamboostr7.png" /></a><br /><br />';
	   htmlMail += '  <img style="width: 100%;" src="http://bamboostr.com/images/mails/image.png" />';
	   htmlMail += '  <div id="contenedor_ciudad" style="background: url('+comilla+'http://bamboostr.com/images/mails/ciudad.png'+comilla+') no-repeat; text-align: center;">';
	   htmlMail += '    <p style="padding-bottom: 1em; font-size: 1em; color: white; text-align: left; width: 100%; padding-top: 4em; padding-left: 2em;">';
                            if(obj.titulo=="Mensaje Programado"){
                              htmlMail += 'Abrir App Móvil';
                            } else {
	   htmlMail += '    '+obj.mensaje+'</p>';
                            }
	   htmlMail += '  </div>';
	   htmlMail += '  <img style="width: 100%" src="http://bamboostr.com/images/mails/image.png" />';
	   htmlMail += '  <div style="width: 100%; padding-top: .5em; text-align: center; display: table;">';
	   htmlMail += '      <div style="text-align: center; display: table-row;">';
	   htmlMail += '        <div style="width: 50%; text-align: center; display: table-cell;">';
	   htmlMail += '          <a href="http://bamboostr.com"><img style="width: 100%;" src="http://bamboostr.com/images/mails/bamboostr7.png" /></a>';
	   htmlMail += '        </div>';
	   htmlMail += '        <div style="width: 50%; vertical-align: top; text-align: center; display: table-cell;">';
	   htmlMail += '          <p>Síguenos en Redes Sociales</p>';
	   htmlMail += '        </div>';
	   htmlMail += '      </div>';
	   htmlMail += '      <div style="text-align: center; display: table-row;">';
	   htmlMail += '        <div style="width: 50%; text-align: center; display: table-cell;">';
	   htmlMail += '          <i style="color: blue;">Copyright © 2015 Bamboostr, All rights reserved.</i>';
	   htmlMail += '        </div>';
	   htmlMail += '        <div style="width: 50%; text-align: center; display: table-cell;">';
	   htmlMail += '          <a href="https://facebook.com/bamboostr"><img src="http://bamboostr.com/images/mails/facebook.png" /></a>';
	   htmlMail += '          <a href="https://twitter.com/bamboostr"><img src="http://bamboostr.com/images/mails/twitter.png" /></a>';
	   htmlMail += '          <a href="https://instagram.com/bamboostr"><img src="http://bamboostr.com/images/mails/instagram.png" /></a>';
	   htmlMail += '        </div>';
	   htmlMail += '      </div>';
	   htmlMail += '  </div>';
	   htmlMail += '</div>';
	   htmlMail += '</body>';
	   htmlMail += '</html>';
  $("#notificacionesBody").html(htmlMail);
  $("#notificacionesLabel").html(obj.title);
}

function delNot(mensaje){
  var parametros = { id:mensaje};
	$.ajax({	data:  parametros,
				url:   "scripts/eliminarNotificacion.php",
				type:  "post",
				success:  function (response) {
                                  notificaciones();
				  toastr["success"](txt146);
				} , error: function(response){
				  toastr["error"](txt92);
				}
			});
}

function notificaciones(option){
  $.ajax({ url:   "thread-sys.php?identify="+identify+"&red="+red+"&option=notificaciones&option3="+option+"&id_token="+id_token+"",
	   type:  "GET",
	   success:  function(response) {
             obj = JSON.parse(response);
             if(option==1)
               objetoNot123 = obj;
             if(option==2)
               objetoNot1234 = obj;
             if(obj.data){
               if(option==1)
                 $("#notBadget").html(obj.cont);
               else {
                 //$("#notBadget2").html('{{inboxHeader.length}}'+obj.cont);
			   }
               var htmlNot = '';

                 var contNot123 = 0;
                 for(var aweor478=0; aweor478<obj.data.length; aweor478++){

                        htmlNot +='<a class="lv-item" style="cursor: pointer;" onclick="abrirNot('+aweor478+','+comilla+''+option+''+comilla+');">';
							htmlNot +='<div class="media">';
								htmlNot +='<div class="pull-left">';
								if(obj.data[aweor478].read==null || obj.data[aweor478].read==0){
								   htmlNot += '<i style="font-size: 15px;" class="fa fa-envelope-o"></i>';
								   contNot123++;
								 } else {
								   htmlNot += '<img style="width: 15px;" src="images/openEnvelop.png" />';
								 }
								htmlNot +='</div>';
								htmlNot +='<div class="media-body">';
									htmlNot +='<div class="lv-title">'+obj.data[aweor478].titulo+'</div>';
									htmlNot +='<small class="lv-small">'+normalize(obj.data[aweor478].mensaje)+'</small>';
								htmlNot +='</div>';
							htmlNot +='</div>';
						htmlNot +='</a>';
						
                 } /* fin for */
                 if(option==1)
                   $('#notBody').html(htmlNot);
                 else {
                   //$('#notBody2').html(htmlNot+""+$('#notBody2').html());
                 }

                 if(contNot123!="0"){
                   document.title = "(" + contNot123 + ") " + "" + txt145 + "" + screen_name_bamboostr;
                   if(option==1)
                     $("#notBadget").html(contNot123);
                   else {
                     //$("#notBadget2").html('{{inboxHeader.length}}'+contNot123);
				   }
                 } else {
                   if(option==1)
                     $("#notBadget").html(contNot123);
                   else {
                     //$("#notBadget2").html('{{inboxHeader.length}}');
				   }
                   
                 }
             } else if(obj.error){
                 var htmlNot = '';
                 if(option==1)
                   $('#notBody').html(htmlNot);
                 else {
                   //$('#notBody2').html($('#notBody2').html());
                 }
                 document.title = "" + txt145 + "" + screen_name_bamboostr;
                 
             }
           }, error: function(response) {
           }
  });
}

$(document).ready(function(){
  notificaciones(1);
  //notificaciones(2);
});
  setInterval(function(){
    notificaciones(1);
   //notificaciones(2);
}, notInterval);