/*Se puede arreglar el loading pero es un desmadre*/
function getFacebook(option, feed, user, userId, userPage){
	$("#main-feed"+feed+"").css("display", "block");
	// ------------ Twitter Feed Variables	------------	
	if(option==1)
	  var nameFeed = txt59;
	if(option==2)
	  var nameFeed = txt50;
	if(option==3)
	  var nameFeed = txt60;
	if(option==4)
	  var nameFeed = txt51;
        if(option==5){
          var nameFeed = txt309;
        }
	if(option!=3){
          /*10 es muy poco no aplica*/
	  var totalmensajes = 15;
        }
	else
	  var totalmensajes = 20;
	var facebookprofile = screen_name;
	var screenname = screen_name;
	var showdirectmensajes = false;
	var showremensajes = false;      
	var showmensajeslinks = true;   /*links activos?*/
	var showprofilepic = true;   /*imagenes de perfil?*/
	if(option==3)
	  var showmensajesactions = false;  /*Acciones del tweet?*/
	else
	  var showmensajesactions = true;   /*Acciones del tweet?*/
	var showremensajesindicator = false;
	var urlGetMensajes  = "";
	var urlGetMensajes = "facebook/";
	if(option==1 && window["feedColumna" + feed]==0)
	  urlGetMensajes += "thread-fa.php?identify="+userId+"&count="+totalmensajes+"&option=getMsgs&id_token="+id_token+"&userPage="+userPage;
	else if(option==1)
	  urlGetMensajes += "thread-fa.php?identify="+userId+"&count="+totalmensajes+"&id_token="+id_token+"&until="+window["feedColumna" + feed]+"&option=getMsgs&userPage="+userPage;
	if(option==2 && window["feedColumna" + feed]==0)
	  urlGetMensajes += "thread-fa.php?identify="+userId+"&count="+totalmensajes+"&option=getFeeds&id_token="+id_token+"";
	else if(option==2)
	  urlGetMensajes += "thread-fa.php?identify="+userId+"&count="+totalmensajes+"&id_token="+id_token+"&until="+window["feedColumna" + feed]+"&option=getFeeds";
	if(option==3 && window["feedColumna" + feed]==0)
	  urlGetMensajes += "thread-fa.php?identify="+userId+"&count="+totalmensajes+"&option=getInbox&id_token="+id_token+"&userPage="+userPage;
	else if(option==3)
	  urlGetMensajes += "thread-fa.php?identify="+userId+"&count="+totalmensajes+"&id_token="+id_token+"&until="+window["feedColumna" + feed]+"&option=getInbox&userPage="+userPage;
	if(option==4 && window["feedColumna" + feed]==0)
	  urlGetMensajes += "thread-fa.php?identify="+userId+"&count="+totalmensajes+"&option=getMentions&id_token="+id_token+"";
	else if(option==4)
	  urlGetMensajes += "thread-fa.php?identify="+userId+"&count="+totalmensajes+"&id_token="+id_token+"&until="+window["feedColumna" + feed]+"&option=getMentions";
        if(option==5){
          urlGetMensajes += "thread-fa.php?identify="+userId+"&count="+totalmensajes+"&id_token="+id_token+"&until="+window["feedColumna" + feed]+"&option=getEvents";
        }
	/* ------------ Facebook Carousel Variables	------------ */
	var feedheight = 425; 
	var pausetime = 5000;
	var slidetime = 0;	
	var facebookshift = 0; 
	var slideinitial = false;
	var headerHTML = '';
	var loadingHTML = '';
	<!--headerHTML += '<div id="facebook-header'+feed+'" style="z-index: 0px;"><table style="width: 100%;"><tr><td style="width: 15%; text-align: center;"><center><img src="images/f.png" width="50" style="float:left; padding:3px 12px 0px 6px" alt="facebook bird" /></td><td style="width: 70%; text-align: center;">'+nameFeed+'</td><td style="width: 15%; text-align: center;"><img onclick="imgRefreshFacebook('+option+','+feed+','+comilla+''+user+''+comilla+','+comilla+''+userId+''+comilla+','+comilla+''+userPage+''+comilla+')" src="images/refresh.gif" style="width: 30px; cursor: pointer;" alt="'+txt73+'" title="'+txt73+'" /></h1></td></tr></table></center></div>';-->
	headerHTML += '<div id="facebook-header'+feed+'" style="z-index: 0px;"><table style="width: 100%;"><tr><td style="width: 15%; text-align: center;"></td><td style="font-weight: bold; width: 70%; text-align: center;">'+nameFeed+'</td><td style="width: 15%; text-align: center;"></td></tr></table></center></div>';
	loadingHTML += '<div style="display: table; width: 100%;" id="loading-container'+feed+'"><br /><div class="Knight-Rider-loader animate"><div class="Knight-Rider-bar"></div><div class="Knight-Rider-bar"></div><div class="Knight-Rider-bar"></div></div><br /></div>';
	 
	//cargar cuando no haya nada en las columnas
	if(window["feedColumna" + feed]==0){
	  $('#main-feed'+feed+'').html(headerHTML + loadingHTML);
	}
	$.ajax({	url:   urlGetMensajes,
				dataType: "json",
				type:  "GET",
				success:  function (feeds) {
					var feedHTML = '';
					var displayCounter = 1;
					/*si no hay mensajes y las columnas vacías no hay información en facebook*/
					if(feeds.toString()=="false"){
					                 feedHTMLP = document.getElementById("main-feed"+feed+"").innerHTML;
								feedHTMLA = feedHTMLP.split('<div style="display: table; width: 100%;" id="loading-container');
								if(feedHTMLA[1])
								  feedHTML += feedHTMLA[0];
								else{
								  feedHTMLA = feedHTMLP.split('<div id="loading-container');
								  feedHTML += feedHTMLA[0];
								}
								feedHTML += '<div style="width: 100%; text-align: center;"><br />'+txt52+'</div>';
                                                          feedHTML += '<div style="width: 100%; text-align: center;"><img onclick="imgRefreshFacebook('+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+userId+''+comilla+','+comilla+''+userPage+''+comilla+')" src="images/refresh.gif" style="cursor: pointer;" /></div>';
								window["feedColumna" + feed] = -1;
								feeds="";
					} else if(feeds.errors && feeds.errors.indexOf("Session has expired")!="-1"){
                                          feedHTML += headerHTML;
                                          feedHTML += '<div style="width: 100%; text-align: center;"><br />'+txt68+'</div>';
                                          window["feedColumna" + feed] = -1;
                                          feeds="";
                                        }
					if(feeds.length==0){
						if(window["feedColumna" + feed]==0){
							feedHTML += headerHTML;
							if(typeof feeds.errors=="object"){
							  feedHTML += '<div style="width: 100%; text-align: center;"><br />'+txt68+'</div>';
							} else {
							  feedHTML += '<div style="width: 100%; text-align: center;"><br />'+txt52+'</div>';
                                                          feedHTML += '<div style="width: 100%; text-align: center;"><img onclick="imgRefreshFacebook('+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+userId+''+comilla+','+comilla+''+userPage+''+comilla+')" src="images/refresh.gif" style="cursor: pointer;" /></div>';
							}
							window["feedColumna" + feed] = -1;
						  }
						  
						  //Si hay información en columna y ya no hay más información en facebook
						  if (window["feedColumna" + feed]!=0 && refrescarListo==1){
								feedHTMLP = document.getElementById("main-feed"+feed+"").innerHTML;
								feedHTMLA = feedHTMLP.split('<div style="display: table; width: 100%;" id="loading-container');
								if(feedHTMLA[1])
								  feedHTML += feedHTMLA[0];
								else{
								  feedHTMLA = feedHTMLP.split('<div id="loading-container');
								  feedHTML += feedHTMLA[0];
								}
								window["feedColumna" + feed] = -1;
						  }
					}
					
					//Si hay información en columna y hay más información en facebook
					if (window["feedColumna" + feed]!=0 && refrescarListo==1 && feeds.length!=0){
						feedHTMLP = document.getElementById("main-feed"+feed+"").innerHTML;
						feedHTMLA = feedHTMLP.split('<div style="display: table; width: 100%;" id="loading-container');
						if(feedHTMLA[1])
						  feedHTML += feedHTMLA[0];
						else{
						  feedHTMLA = feedHTMLP.split('<div id="loading-container');
						  feedHTML += feedHTMLA[0];
						}
					}
					var entroImage = 0;
					for (var i=0; i<feeds.length; i++) {
                                          if(option==5){
                                            entroImage++;
                                            if (displayCounter == 1) {
						if (window["feedColumna"+feed]==0){
						  feedHTML += headerHTML;
						  feedHTML += '<div id="columna'+feed+'" style="position:relative; height:'+feedheight+'px; overflow-y: auto;">';
						}
					    }
					    
					    if(!window["contImageFacebook" + feed] || window["contImageFacebook" + feed]==0){
						  window["contImageFacebook" + feed] = 1;
						}
						else
						  window["contImageFacebook" + feed] = window["contImageFacebook" + feed]+1;
						
						if(entroImage==1){
							window["Imagemensajesusername"+feed] = feeds[i].id+",";
							window["ImagecontImageFacebook"+feed] = ""+window["contImageFacebook"+feed]+",";
						  } else {
							window["Imagemensajesusername"+feed] = window["Imagemensajesusername" + feed] +""+feeds[i].id+",";
							window["ImagecontImageFacebook"+feed] = window["ImagecontImageFacebook" +feed] +""+window["contImageFacebook"+feed]+",";
						}
						
						var tiempoJSFa = feeds[i].start_time.split("T");
					    
                                            feedHTML += '<div class="twitter-article'+feed+'" style="display: table-row;">'; 										                 
						feedHTML += '<div class="twitter-pic" style="display: table-cell;"><a href="https://facebook.com/events/'+feeds[i].id+'" target="_blank"><img id="profileImage'+window["contImageFacebook" + feed]+''+feed+'" src="images/f.png" width="42" height="42" alt="Profile" /></a></div>';                                  
					      if(tiempoJSFa[0] && tiempoJSFa[1]){
						feedHTML += '<div class="twitter-text" style="display: table-cell;"><p><span class="tweetprofilelink"><strong><a href="https://facebook.com/events/'+feeds[i].id+'" target="_blank">'+feeds[i].name+'</a></strong></span><span class="tweet-time"><a href="https://facebook.com/events/'+feeds[i].id+'" target="_blank">'+tiempoJSFa[0]+' '+tiempoJSFa[1].substr(0,8)+'</a></span><br/>';
						feedHTML += '<br /><div style="display: table-row; width: 100%;">'+txt312+' '+tiempoJSFa[0]+' '+tiempoJSFa[1].substr(0,8)+'</div>';
					       } else {
					         feedHTML += '<div class="twitter-text" style="display: table-cell;"><p><span class="tweetprofilelink"><strong><a href="https://facebook.com/events/'+feeds[i].id+'" target="_blank">'+feeds[i].name+'</a></strong></span><span class="tweet-time"><a href="https://facebook.com/events/'+feeds[i].id+'" target="_blank">Ver</a></span><br/>';
						feedHTML += '<br /><div style="display: table-row; width: 100%;">'+txt312+' '+txt311+'</div>';
					       }

                                                
                                                
						if(typeof feeds[i].location!="undefined"){
						  feedHTML += '<div style="display: table-row; width: 100%;">'+txt310+': '+feeds[i].location+'.</div>';
						} else {
						  feedHTML += '<div style="display: table-row; width: 100%;">'+txt310+': '+txt311+'.</div>';
						}
						
						if (showmensajesactions == true) {
							
							feedHTML += '<div style="width: 100%; float: left; display: none;" id="twitter-actions'+feed+'"><br /><div style="padding: 0px 5px 0px 1px; display: table-cell;"><a href="https://facebook.com/events/'+feeds[i].id+'" style="color: #00acee; cursor: pointer;">Responder</a></div>';
	                                                feedHTML += '</div>';
						}
						
						feedHTML += '</div>';
						feedHTML += '</div>';
                                            
					    displayCounter++;
					    window["feedColumna" + feed] = -1;
					  }// fin option 5
					  
					  if((!feeds[i].story || feeds[i].story.indexOf("shared")!="-1") &&
						 (!feeds[i].story || feeds[i].story.indexOf("commented")=="-1") &&
						 (!feeds[i].story || feeds[i].story.indexOf("likes")=="-1") && 
						 (feeds[i].story || feeds[i].message || 
						   (option==3 && userPage=="" && feeds[i].to.data.length>1) || 
                                                   (option==3 && userPage!="" && feeds[i].participants.data.length>1)) && feeds[i].id!=window["feedColumnaId" + feed]){
						   entroImage++;
                                                   /*******************NOTIFICATIONS******************/
                                                   /*
						   if((window["feedColumna" + feed]==0 || !window["feedColumna" + feed]) &&                                        displayCounter==1 && i==0){
					                  timenotifications = feeds[0].updated_time.split("+");
							  if(option==4){
								  var parametros = { option:4, 
											 identify:userId, 
											 last_mention:timenotifications[0] };
								  $.ajax({	data:  parametros,
											url:   "facebook/post-notifications.php",
											type:  "post",
											success:  function (response) {
											} , error: function(response){
											}
								  });
							  }
							  if(option==3){
								  var parametros = { option:3, 
											 identify:userId, 
											 last_mention:timenotifications[0] };
								  $.ajax({	data:  parametros,
											url:   "facebook/post-notifications.php",
											type:  "post",
											success:  function (response) {
											} , error: function(response){
											}
								  });
							  }
							}
                                                        */
							if(!window["contImageFacebook" + feed] || window["contImageFacebook" + feed]==0){
							  window["contImageFacebook" + feed] = 1;
							}
							else
							  window["contImageFacebook" + feed] = window["contImageFacebook" + feed]+1;
							if(option==3 && userPage==""){
							  if(feeds[i].to.data[1].name!=user){
								var mensajescreenname = feeds[i].to.data[1].name;
								var mensajesusername = feeds[i].to.data[1].id;
							  } else {
								var mensajescreenname = feeds[i].to.data[0].name;
								var mensajesusername = feeds[i].to.data[0].id;
							  }
							}
							if(option==3 && userPage!=""){
							  if(feeds[i].participants.data[1].name!=user){
								var mensajescreenname = feeds[i].participants.data[1].name;
								var mensajesusername = feeds[i].participants.data[1].id;
							  } else {
								var mensajescreenname = feeds[i].participants.data[0].name;
								var mensajesusername = feeds[i].participants.data[0].id;
							  }
							}
                                                        if(option!=3){
							  var mensajescreenname = feeds[i].from.name;
							  var mensajesusername = feeds[i].from.id;
							}
							
							
							if(entroImage==1){
								window["Imagemensajesusername"+feed] = mensajesusername+",";
								window["ImagecontImageFacebook"+feed] = ""+window["contImageFacebook"+feed]+",";
							  } else {
								window["Imagemensajesusername"+feed] = window["Imagemensajesusername" + feed] +""+mensajesusername+",";
								window["ImagecontImageFacebook"+feed] = window["ImagecontImageFacebook" +feed] +""+window["contImageFacebook"+feed]+",";
							}
							  
							if(typeof feeds[i].message!="undefined")
							  var status = feeds[i].message; 
							if(option==3 && userPage==""){
							  var status = '';
							  for(var contStatus=((feeds[i].comments.data.length)-1); 
								  contStatus>=0; 
								  contStatus--){
								if(feeds[i].comments.data[contStatus].message && feeds[i].comments.data[contStatus].from)
								  status += '<b>'+feeds[i].comments.data[contStatus].from.name+':</b> '+feeds[i].comments.data[contStatus].message+'<br />';
							  }
							}
                                                        if(option==3 && userPage!=""){
                                                          var status = '<b>'+feeds[i].messages.data[0].from.name+':</b> '+feeds[i].snippet+'<br />';
                                                          if(feeds[i].messages.data.length>1){
                                                            for(var efgrr=1; efgrr<feeds[i].messages.data.length; efgrr++)
                                                              status += '<b>'+feeds[i].messages.data[efgrr].from.name+':</b> '+feeds[i].messages.data[efgrr].message+'<br />';
                                                          }
                                                        }
							var isaremensajes = false;
							var isdirect = false;
							var mensajesid = feeds[i].id;
							var linkPostArray = mensajesid.split("_");
							var mensajeslinkpost = "https://www.facebook.com/"+linkPostArray[0] + "/posts/" +linkPostArray[1];
							var timemensajes = feeds[i].updated_time.split("T");
							timemensajes2 = timemensajes[1].split("+");
							
							 var pb = "";
							 if (showremensajesindicator == true) {
								pb = 'style="padding-bottom: 20px;"';
							 }
							 
							//console.log(feeds[i]);
							 //Generate twitter feed HTML based on selected options
							 //Mensajes Duplicados
							 if ( (showremensajes == true || (isaremensajes == false && showremensajes == false)) && (showdirectmensajes == true || (showdirectmensajes == false && isdirect == false )) && feeds[i].id!=window["feedColumnaId" + feed] ) {
									if (displayCounter <= totalmensajes) {             
										if (showmensajeslinks == true && status) {
											status = addlinks(status);
										}
										if (displayCounter == 1) {
											if (window["feedColumna"+feed]==0){
											  feedHTML += headerHTML;
											  feedHTML += '<div id="columna'+feed+'" style="position:relative; height:'+feedheight+'px; overflow-y: auto;">';
											}
										}
								 
										//console.log(userId+":"+mensajesusername);
										feedHTML += '<div class="twitter-article'+feed+'" style="display: table-row;">'; 										                 
										feedHTML += '<div class="twitter-pic" style="display: table-cell;"><a href="https://facebook.com/'+mensajesusername+'" target="_blank"><img id="profileImage'+window["contImageFacebook" + feed]+''+feed+'" src="images/f.png" width="42" height="42" alt="Profile" /></a></div>';
										feedHTML += '<div class="twitter-text" style="display: table-cell;"><p><span class="tweetprofilelink"><strong><a href="https://facebook.com/'+mensajesusername+'" target="_blank">'+mensajescreenname+'</a></strong></span><span class="tweet-time"><a href="'+mensajeslinkpost+'" target="_blank">'+timemensajes[0]+' '+timemensajes2[0]+'</a></span><br/>';
										if(feeds[i].picture && !feeds[i].name){
										  if(typeof feeds[i].message!="undefined")
											feedHTML += ''+status+'<br />';
										  feedHTML += '<div style="display: table-row; width: 100%;"><div style="display: table-cell; width: 100%;"><a target="_blank" href="'+feeds[i].link+'"><img style="width: 100%;" src="'+feeds[i].picture+'"></a></div></div></p><br />';
										} else if(feeds[i].picture && 
feeds[i].name){
										  if(typeof feeds[i].message!="undefined")
											feedHTML += ''+status+'<br />';
										  feedHTML += '<div style="display: table-row; width: 100%;"><div style="display: table-cell; width: 40%;"><a target="_blank" href="'+feeds[i].link+'"><img style="width: 100%;" src="'+feeds[i].picture+'"></a></div><div style="padding-left: 5px; vertical-align: top; display: table-cell; width: 60%;"><a target="_blank" href="'+feeds[i].link+'">'+feeds[i].name+'</a></div></div></p><br />';
										} else if(status){
										  feedHTML += ''+status+'</p>';
										}						
										if (showmensajesactions == true) {
											var likeYo = 0;
											if(typeof feeds[i].likes!="undefined"){
											 var tLikes = feeds[i].likes.data.length;
											 for(var erew=0; erew<feeds[i].likes.data.length; erew++){
											   if(feeds[i].likes.data[erew].id==userId){
											     likeYo=1;
											   }
											 }
											} else {
											  var tLikes = 0;
											}
											feedHTML += '<div style="width: 100%; float: left; display: none;" id="twitter-actions'+feed+'"><br /><div style="padding: 0px 5px 0px 1px; display: table-cell;"><img src="twitter/images/like.png" style="padding-bottom: 4px; padding-right: 5px;" /><a href="'+mensajeslinkpost+'" style="color: #00acee; cursor: pointer;">'+tLikes+'</a></div>';
											if(tLikes==0 || likeYo==0){
											  feedHTML += '<div style="display: table-cell;"><a onclick="abrirDeckFa('+comilla+''+mensajesid+''+comilla+','+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+userId+''+comilla+','+comilla+''+userPage+''+comilla+');" target="_blank" href="" title="Me Gusta">Me Gusta</a> · </div>';
											} else {
											  feedHTML += '<div style="display: table-cell;"><a target="_blank" onclick="quitarLike('+comilla+''+mensajesusername+''+comilla+','+comilla+''+mensajesid+''+comilla+','+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+userId+''+comilla+','+comilla+''+userPage+''+comilla+');" href="" title="Ya no me gusta">Ya no me gusta</a> · </div>';
											}
											feedHTML += '<div style="display: table-cell;"><img src="twitter/images/comment.png" /><a target="_blank" href="'+mensajeslinkpost+'" title="Comentar"> Comentar</a></div>';
                                                                                        if(userId==mensajesusername){
                                                                                          feedHTML += '<div style="display: table-cell;"> · <a target="_blank" onclick="eliminarMsgPost('+comilla+''+mensajesid+''+comilla+','+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+userId+''+comilla+','+comilla+''+userPage+''+comilla+');" href="" title="Eliminar"><img style="cursor: pointer; width: 1em;" src="images/eliminar2.png" /></a></div>';
                                                                                        }
                                                                                        if(userId!=mensajesusername){
                                                                                          feedHTML += '<br /><button onclick="agregarClienteMonitor('+comilla+''+mensajesusername+''+comilla+','+comilla+'facebook'+comilla+','+comilla+''+mensajescreenname+''+comilla+','+comilla+''+comilla+');" class="btn btn-success">'+txt397+'</button>';
                                                                                        }
                                                                                        feedHTML += '</div>';
										}
										
										feedHTML += '</div>';
										feedHTML += '</div>';
										
										displayCounter++;
									}   
							 }
                                                         
							 var iAux = i;
                                            window["feedColumnaId" + feed] = feeds[i].id;
					  }// if general
                                          //quitar mensajes duplicados
                                          if(feeds[i].id==window["feedColumnaId" + feed]){
                                            window["feedColumna" + feed] = -1;
                                          }
					  if(option!=5 && feeds[i].id!=window["feedColumnaId" + feed] && feeds[i].updated_time){
					    var timemensajesfeed = feeds[i].updated_time.split("+");
					  }
					  
					} //fin del for
				 if(window["Imagemensajesusername"+feed] && window["ImagecontImageFacebook"+feed]){
					$.ajax({  url:   "facebook/thread-fa.php?identify="+userId+"&userId="+window["Imagemensajesusername"+feed]+"&i="+window["ImagecontImageFacebook"+feed],
								type:  "GET",
								success:  function (response) {
								     //console.log(response.toString());
                                                                     if( response.toString().indexOf("Failed to connect to")=="-1" && response.toString().indexOf("Network is unreachable")=="-1" && response.toString().indexOf("SSL connection timeout")=="-1") {
								        obj=JSON.parse(response);
									if(response.indexOf("Base de datos")!="-1"){
									  bEI = window["ImagecontImageFacebook"+feed].split(",");
									  for(var eyrt3=0; eyrt3<bEI.length ; eyrt3++){
									    if(bEI[eyrt3]!=""){
										  $('#profileImage'+bEI[eyrt3]+''+feed+'').attr("src","images/f.png");
										}
									  }
									} else {
										  if(obj.data.length!=0){
											for(var fwerewr=0; fwerewr<obj.data.length; fwerewr++){
											  $('#profileImage'+obj.data[fwerewr].i+''+feed+'').attr("src",obj.data[fwerewr].url);
										        }
										  } 
									        }
                                                                      }
								} , error: function(response){
									
								}
					});
				}
				      if(feeds.length!=0){
					if(option==1){
					  if(timemensajesfeed){
					    window["feedColumna" + feed] = timemensajesfeed[0];
					  }
					  window["feedColumnaTmp" + feed] = feeds[0].id;
					  if(iAux){
						window["feedColumnaId" + feed] = feeds[iAux].id;
					  } else if(!iAux && feeds.length==1 && 
								feeds[0].id==window["feedColumnaTmp" + feed]) {
						  var timemensajesfeed1 = timemensajesfeed[0].split("T");
						  var timemensajesfeed2 = timemensajesfeed1[1].split(":");
						  if(timemensajesfeed2[0]!="00" && timemensajesfeed2[0]!="0"){
							timemensajesfeed2[0] = timemensajesfeed2[0] -1;
							window["feedColumna" + feed] = timemensajesfeed1[0] + "T" +
														   timemensajesfeed2[0] + ":" +
														   timemensajesfeed2[1] + ":" +
														   timemensajesfeed2[2];
                                                        window["feedColumna" + feed] = -1;
						  } else {
							feedHTMLP = document.getElementById("main-feed"+feed+"").innerHTML;
							feedHTMLA = feedHTMLP.split('<div style="display: table; width: 100%;" id="loading-container');
							if(feedHTMLA[1]){
							  feedHTMLA = feedHTMLP.split('<div id="loading-container');
							  feedHTML += feedHTMLA[0];
							}
							window["feedColumna" + feed] = -1;
						  }
					  }
					} else if(option==2) {
						if(timemensajesfeed){
					          window["feedColumna" + feed] = timemensajesfeed[0];
					        }
						if(iAux){
						  window["feedColumnaId" + feed] = feeds[iAux].id;
						}
					} else if(option==3){
						if(timemensajesfeed){
					          window["feedColumna" + feed] = timemensajesfeed[0];
					        }
						if(iAux){
						  window["feedColumnaId" + feed] = feeds[iAux].id;
						}
						if(iAux==0){
							feedHTMLP = document.getElementById("main-feed"+feed+"").innerHTML;
							feedHTMLA = feedHTMLP.split('<div style="display: table; width: 100%;" id="loading-container');
							if(feedHTMLA[1]) {
							  feedHTML += feedHTMLA[0];
							} else {
							  feedHTMLA = feedHTMLP.split('<div id="loading-container');
							  feedHTML += feedHTMLA[0];
							}
							feedHTML += '<div style="width: 100%; text-align: center; display: table;"><div style="width: 100%; text-align: center; display: table-row;"><div style="width: 100%; text-align: center; display: table-cell;"><br />'+txt63+'</div></div></div>';
							window["feedColumna" + feed] = -1;
						}
					} else if(option==4){
						if(timemensajesfeed){
					          window["feedColumna" + feed] = timemensajesfeed[0];
					        }
						if(iAux){
						  window["feedColumnaId" + feed] = feeds[iAux].id;
						}
					}
				      }
					
					if(feeds.length!=0 && option!=5){
					  feedHTML += loadingHTML;
					}
					feedHTML += '</div>';
					 
					$('#main-feed'+feed+'').html(feedHTML);
					  if(window["feedColumna" + feed] && refrescarListo==1){
						if(auxHeight!=0)
						  document.getElementById("columna"+feed+"").scrollTop = auxHeight;
					  }
					  //cuando hay un mensaje y ya no hay info en facebook
					  if(typeof feeds.errors!="object"){
						  if(feeds.length != 0 && feeds[0]){
							  if(feeds[0].id==window["feedColumna" + feed] && displayCounter==1){
									feedHTMLP = document.getElementById("main-feed"+feed+"").innerHTML;
									feedHTMLA = feedHTMLP.split('<div style="display: table; width: 100%;" id="loading-container');
									if(feedHTMLA[1]) {
									  feedHTML = feedHTMLA[0];
									} else {
									  feedHTMLA = feedHTMLP.split('<div id="loading-container');
									  feedHTML = feedHTMLA[0];
									}
									if(window["feedColumna" + feed]==0 || !window["feedColumna" + feed]){
									  feedHTML += '<div style="width: 100%; text-align: center; display: table;"><div style="width: 100%; text-align: center; display: table-row;"><div style="width: 100%; text-align: center; display: table-cell;"><br />'+txt64+'</div></div></div>';
									} else {
									  feedHTML += '<div style="width: 100%; text-align: center; display: table;"><div style="width: 100%; text-align: center; display: table-row;"><div style="width: 100%; text-align: center; display: table-cell;"><br />'+txt63+'</div></div></div>';
									}
									window["feedColumna" + feed] = -1;
							  }
						 }
					} else {
						$('#loading-container'+feed+'').html("");
					}
					//Add twitter action animation and rollovers
					if (showmensajesactions == true) {				
						$('.twitter-article'+feed+'').hover(function(){
							$(this).find('#twitter-actions'+feed+'').css({'float':'left', 'display':'table-row', 'opacity':0, 'margin-top':-20});
							$(this).find('#twitter-actions'+feed+'').animate({'opacity':1, 'margin-top':0},200);
						}, function() {
							$(this).find('#twitter-actions'+feed+'').animate({'opacity':0, 'margin-top':-20},120, function(){
								$(this).css('display', 'none');
							});
						});			
					
						//Add new window for action clicks
					
						$('#twitter-actions'+feed+' a').click(function(){
					          var url = $(this).attr('href');
                                                  if(url!=""){
						    window.open(url, 'mensaje action window', 'width=580,height=500');
						  }
                                                  return false;
						});
					}
					
					//Function modified from Stack Overflow
					function addlinks(data) {
						//Add link to all http:// links within tweets
						 data = data.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
							return '<a target="_blank" href="'+url+'" >'+url+'</a>';
						});
							 
						//Add link to @usernames used within tweets
						data = data.replace(/\B@([_a-z0-9]+)/ig, function(reply) {
							return '<a href="http://twitter.com/'+reply.substring(1)+'" style="font-weight:lighter;" target="_blank">'+reply.charAt(0)+reply.substring(1)+'</a>';
						});
						//Add link to #hastags used within tweets
						data = data.replace(/\B#([_a-z0-9]+)/ig, function(reply) {
							return '<a href="https://twitter.com/search?q='+reply.substring(1)+'" style="font-weight:lighter;" target="_blank">'+reply.charAt(0)+reply.substring(1)+'</a>';
						});
						return data;
					}
					refrescarListo=0;
					 
				} , error: function(response){
				  //ERROR
				  if(window["feedColumnaTmp" + feed] && 
					 window["feedColumna" + feed] &&
					 window["feedColumnaId" + feed]){
					 var timemensajesfeed = window["feedColumna" + feed].split("+");
					 var timemensajesfeed1 = timemensajesfeed[0].split("T");
							var timemensajesfeed2 = timemensajesfeed1[1].split(":");
								var feedHTML = '';
								feedHTMLP = document.getElementById("main-feed"+feed+"").innerHTML;
								feedHTMLA = feedHTMLP.split('<div style="display: table; width: 100%;" id="loading-container');
								if(feedHTMLA[1])
								  feedHTML += feedHTMLA[0];
								else{
								  feedHTMLA = feedHTMLP.split('<div id="loading-container');
								  feedHTML += feedHTMLA[0];
								}
								feedHTML += '<div style="width: 100%; text-align: center; display: table;"><div style="width: 100%; text-align: center; display: table-row;"><div style="width: 100%; text-align: center; display: table-cell;"><br />'+txt62+'</div></div></div>';
								var scrollTop = $("#columna"+feed+"").scrollTop();
								$('#main-feed'+feed+'').html(feedHTML);
								document.getElementById("columna"+feed+"").scrollTop = scrollTop;
								window["feedColumna" + feed] = -1;
				  }//fin if
				  
				  if((option==1 || option==2 || option==3 || option==4) && 
					 (!window["feedColumna" + feed] || window["feedColumna" + feed]==0)){
					var feedHTML = '';
					feedHTMLP = document.getElementById("main-feed"+feed+"").innerHTML;
					feedHTMLA = feedHTMLP.split('<div style="display: table; width: 100%;" id="loading-container');
					if(feedHTMLA[1])
					  feedHTML += feedHTMLA[0];
					else{
					  feedHTMLA = feedHTMLP.split('<div id="loading-container');
					  feedHTML += feedHTMLA[0];
					}
					if(window["feedColumna" + feed]==0 || !window["feedColumna" + feed]){
					  if(response.responseText.indexOf("Session has expired")!="-1"){
						feedHTML += '<div style="width: 100%; text-align: center; display: table;"><div style="width: 100%; text-align: center; display: table-row;"><div style="width: 100%; text-align: center; display: table-cell;"><br />'+txt68+'</div></div></div>';
					  } else { 
					    feedHTML += '<div style="width: 100%; text-align: center; display: table;"><div style="width: 100%; text-align: center; display: table-row;"><div style="width: 100%; text-align: center; display: table-cell;"><br />'+txt52+'</div></div></div>';
						feedHTML += '<div style="width: 100%; text-align: center;"><img onclick="imgRefreshFacebook('+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+userId+''+comilla+','+comilla+''+userPage+''+comilla+')" src="images/refresh.gif" style="cursor: pointer;" /></div>';
					  }
					} else {
					  feedHTML += '<div style="width: 100%; text-align: center; display: table;"><div style="width: 100%; text-align: center; display: table-row;"><div style="width: 100%; text-align: center; display: table-cell;"><br />'+txt62+'</div></div></div>';
					}
					$('#main-feed'+feed+'').html(feedHTML);
					window["feedColumna" + feed] = -1;
				  } else {// fin if
				    var feedHTML = '';
					feedHTMLP = document.getElementById("main-feed"+feed+"").innerHTML;
					feedHTMLA = feedHTMLP.split('<div style="display: table; width: 100%;" id="loading-container');
					if(feedHTMLA[1])
					  feedHTML += feedHTMLA[0];
					else{
					  feedHTMLA = feedHTMLP.split('<div id="loading-container');
					  feedHTML += feedHTMLA[0];
					}
				    $('#main-feed'+feed+'').html(feedHTML);
					window["feedColumna" + feed] = -1;
				  }
				  refrescarListo=0;
				}//fin error
	});
}