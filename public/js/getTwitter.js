function agregarClienteMonitor(nombreUsuario,red,nombre,country){
  $("#cargando").dialog("open");
  $(".ui-dialog-titlebar-close").hide();
  $("#cargando").dialog('option', 'title', "Cargando...");
  $.ajax({	data:  {id_token:id_token, nombreUsuario:nombreUsuario, red:red, nombre:nombre, country:country},
                url:   "scripts/CRM/agregar.php",
		type:  "POST",
		success:  function (response) {
	          toastr["success"](txt398);
	          $("#cargando").dialog("close");
	          $(".ui-dialog-titlebar-close").show();
	        },
		error: function (response) {
	          toastr["error"](txt92);
	          $("#cargando").dialog("close");
	          $(".ui-dialog-titlebar-close").show();
		}
  });
}
function seguirTw2(screenname, seguir, option, feed, user){
  $("#cargando").dialog("open");
  $(".ui-dialog-titlebar-close").hide();
  $("#cargando").dialog('option', 'title', "Cargando...");
  $.ajax({		url:   "twitter/thread-tw.php?screen_name="+screenname+"&seguir="+seguir+"&option=postFollow",
					type:  "GET",
					success:  function (response) {
                                          //falta validar seguimiento
                                          imgRefreshTwitter(option,feed,user);
                                          toastr["info"]("Siguiendo a: "+seguir);
                                          $("#cargando").dialog("close");
                                          $(".ui-dialog-titlebar-close").show();
			                },
					error: function (response) {
                                          toastr["error"](txt92);
                                          $("#cargando").dialog("close");
                                          $(".ui-dialog-titlebar-close").show();
					}
  });
}
function reply(usuario){
  document.getElementById("comparte").value = "@"+usuario+" ";
  /*$(document).scrollTop(0);*/
  $("#signup-modal").modal("show");
  $("#comparte").focus();
  showOptionsWrite(2);
}
function dejarSeguirTw(screenname, dejarSeguir, option, feed, user){
  $("#cargando").dialog("open");
  $(".ui-dialog-titlebar-close").hide();
  $("#cargando").dialog('option', 'title', "Cargando...");
  $.ajax({		url:   "twitter/thread-tw.php?screen_name="+screenname+"&seguir="+dejarSeguir+"&option=postUnfollow",
					type:  "post",
					success:  function (response) {
                                          //falta validar seguimiento
                                          imgRefreshTwitter(option,feed,user);
                                          toastr["info"]("Dejaste de seguir a: "+dejarSeguir);
                                          $("#cargando").dialog("close");
                                          $(".ui-dialog-titlebar-close").show();
			                },
					error: function (response) {
                                          toastr["error"](txt92);
                                          $("#cargando").dialog("close");
                                          $(".ui-dialog-titlebar-close").show();
					}
  });
}
function getTwitter(option, feed, user){
	$("#main-feed"+feed+"").css("display", "block");
	// ------------ Twitter Feed Variables	------------	
	if(option==1)
	  var nameFeed = "Tweets";
	if(option==2)
	  var nameFeed = txt50;
	if(option==3)
	  var nameFeed = "DM's";
	if(option==4)
	  var nameFeed = txt51;
	var totaltweets = 10; //Must be a multiple of tweetshift;
	var twitterprofile = screen_name;
	var screenname = screen_name;
	var showdirecttweets = false;
	var showretweets = true;      
	var showtweetlinks = true;   //links activos?
	var showprofilepic = true;   //imagenes de perfil?
	var showtweetactions = true;   //Acciones del tweet?
	var showretweetindicator = false;
	var urlGetTweets  = "";
	var urlGetTweets = "twitter/";
	if(option==1 && window["feedColumna" + feed]==0)
	  urlGetTweets += "thread-tw.php?screen_name="+user+"&count="+totaltweets+"&option=getTweets";
  	else if(option==1)
	  urlGetTweets += "thread-tw.php?screen_name="+user+"&count="+totaltweets+"&max_id="+window["feedColumna" + feed]+"&option=getTweets";
	if(option==2 && window["feedColumna" + feed]==0)
	   urlGetTweets += "thread-tw.php?screen_name="+user+"&count="+totaltweets+"&option=getFeeds";
	else if(option==2)
	  urlGetTweets += "thread-tw.php?screen_name="+user+"&count="+totaltweets+"&max_id="+window["feedColumna" + feed]+"&option=getFeeds";
	if(option==3 && window["feedColumna" + feed]==0)
	  urlGetTweets += "thread-tw.php?screen_name="+user+"&count="+totaltweets+"&option=getDMS";
	else if(option==3)
	  urlGetTweets += "thread-tw.php?screen_name="+user+"&count="+totaltweets+"&max_id="+window["feedColumna" + feed]+"&option=getDMS";
	if(option==4 && window["feedColumna" + feed]==0)
	  urlGetTweets += "thread-tw.php?screen_name="+user+"&count="+totaltweets+"&option=getMentions";
	else if(option==4)
	  urlGetTweets += "thread-tw.php?screen_name="+user+"&count="+totaltweets+"&max_id="+window["feedColumna" + feed]+"&option=getMentions";
	// ------------ Twitter Carousel Variables	------------
	var feedheight = 425; 
	var pausetime = 5000;
	var slidetime = 0;	
	var tweetshift = 0;                     
        var slideinitial = false;
	var headerHTML = '';
	var loadingHTML = '';
	<!--headerHTML += '<div id="twitter-header'+feed+'" style="z-index: 0px;"><table style="width: 100%;"><tr><td style="width: 15%; text-align: center;"><center><img src="images/t.png" width="50" style="float:left; padding:3px 12px 0px 6px" alt="twitter bird" /></td><td style="width: 70%; text-align: center;">'+nameFeed+'</td><td style="width: 15%; text-align: center;"><img onclick="imgRefreshTwitter('+option+','+feed+','+comilla+''+user+''+comilla+')" src="images/refresh.gif" style="width: 30px; cursor: pointer;" alt="'+txt73+'" title="'+txt73+'" /></h1></td></tr></table></center></div>';-->
	headerHTML += '<div id="twitter-header'+feed+'" style="z-index: 0px;"><table style="width: 100%;"><tr><td style="width: 15%; text-align: center;"></td><td style="font-weight: bold; width: 70%; text-align: center;">'+nameFeed+'</td><td style="width: 15%; text-align: center;"></td></tr></table></center></div>';
	loadingHTML += '<div style="display: table; width: 100%;" id="loading-container'+feed+'"><br /><div class="Knight-Rider-loader animate"><div class="Knight-Rider-bar"></div><div class="Knight-Rider-bar"></div><div class="Knight-Rider-bar"></div></div><br /></div>';
	 
	//cargar cuando no haya nada en las columnas
	if(window["feedColumna" + feed]==0){
	  $('#main-feed'+feed+'').html(headerHTML + loadingHTML);
	}
	$.getJSON(urlGetTweets, 
		function(feeds) {
			var feedHTML = '';
			var displayCounter = 1;
			//si no hay mensajes y las columnas vacías no hay información en twitter
			if(feeds.length==0 || typeof feeds.errors=="object"){
				if(window["feedColumna" + feed]==0){
					feedHTML += headerHTML;
                                        if(feeds.errors && feeds.errors[0].message.indexOf("Rate limit exceeded")!=-1){
                                          feedHTML += '<div style="width: 100%; text-align: center; color: red;"><br />'+txt407+'</div>';
                                        }else if(feeds.errors && feeds.errors[0].message.indexOf("Over capacity")!=-1){
                                          feedHTML += '<div style="width: 100%; text-align: center; color: red;"><br />'+txt408+'</div>';
                                        }else if(typeof feeds.errors=="object"){
					  feedHTML += '<div style="width: 100%; text-align: center;"><br />'+txt68+'</div>';
					} else {
					  feedHTML += '<div style="width: 100%; text-align: center;"><br />'+txt52+'</div>';
					}
					window["feedColumna" + feed] = -1;
				  }
				  
				  //Si hay información en columna y ya no hay más información en twitter
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
			
			//Si hay información en columna y hay más información en twitter
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
			for (var i=0; i<feeds.length; i++) {
                          /***********POST NOTIFICATIONS**********/
                          /*
			  if((window["feedColumna" + feed]==0 || !window["feedColumna" + feed]) &&
				  displayCounter==1 && i==0){
				if(option==4){
					var parametros = { option:4, screen_name:user, last_mention:feeds[0].id_str };
					$.ajax({	data:  parametros,
								url:   "twitter/post-notifications.php",
								type:  "post",
								success:  function (response) {
								} , error: function(response){
								}
					});
				}
				if(option==3){
					var parametros = { option:3, screen_name:user, last_mention:feeds[0].id_str };
					$.ajax({	data:  parametros,
								url:   "twitter/post-notifications.php",
								type:  "post",
								success:  function (response) {
								} , error: function(response){
								}
					});
				}
			  }
                          */
			  if(option==3){
				var tweetscreenname = feeds[i].sender.name;
				var tweetusername = feeds[i].sender.screen_name;
				var profileimage = feeds[i].sender.profile_image_url_https; 
                                var tweetuserlocation = feeds[i].sender.location;
                                var UserIdFollowing = feeds[i].sender.following;
			  } else {
				var tweetscreenname = feeds[i].user.name;
				var tweetusername = feeds[i].user.screen_name;
                                var tweetuserlocation = feeds[i].user.location;
				var profileimage = feeds[i].user.profile_image_url_https;
				if(feeds[i].user){
                                  var UserIdFollowing = feeds[i].user.following;
                                }
			  }
                          var isaretweet = false;
			  var isdirect = false;
			  var tweetid = feeds[i].id_str;
                          var tweetidR = tweetid;
                          var status = feeds[i].text;
                          
				
				//If the tweet has been retweeted, get the profile pic of the tweeter
				if(typeof feeds[i].retweeted_status != 'undefined'){
				   profileimage = feeds[i].retweeted_status.user.profile_image_url_https;
				   tweetscreenname = feeds[i].retweeted_status.user.name;
				   tweetusername = feeds[i].retweeted_status.user.screen_name;
                                   tweetidR = tweetid;
                                   tweetuserlocation = feeds[i].retweeted_status.user.location;
				   tweetid = feeds[i].retweeted_status.id_str;
				   status = feeds[i].retweeted_status.text; 
				   isaretweet = true;
				   var UserIdFollowing = feeds[i].retweeted_status.user.following;
				 };
				 
				 var pb = "";
				 if (showretweetindicator == true) {
					pb = 'style="padding-bottom: 20px;"';
				 }
				 
				//console.log(feeds[i]);
				 //Generate twitter feed HTML based on selected options
				 //Mensajes Duplicados
				 if ( (showretweets == true || (isaretweet == false && showretweets == false)) && (showdirecttweets == true || (showdirecttweets == false && isdirect == false )) && tweetid!=window["feedColumna" + feed] ) {
						if ((feeds[i].text.length > 1) && (displayCounter <= totaltweets)) {             
							if (showtweetlinks == true) {
								status = addlinks(status);
							}
							if (displayCounter == 1) {
								if (window["feedColumna"+feed]==0){
								  feedHTML += headerHTML;
								  feedHTML += '<div id="columna'+feed+'" style="position:relative; height:'+feedheight+'px; overflow-y: auto;">';
								}
							}
					 
							
							feedHTML += '<div class="twitter-article'+feed+'" style="display: table-row;">'; 										                 
							feedHTML += '<div class="twitter-pic" style="display: table-cell;"><a href="https://twitter.com/'+tweetusername+'" target="_blank"><img src="'+profileimage+'"images/main-feed-icon.png" width="42" height="42" alt="Profile" /></a></div>';
							feedHTML += '<div class="twitter-text" style="display: table-cell;"><p><span class="tweetprofilelink"><strong><a href="https://twitter.com/'+tweetusername+'" target="_blank">'+tweetscreenname+'</a></strong> <a href="https://twitter.com/'+tweetusername+'" target="_blank">@'+tweetusername+'</a></span><span class="tweet-time"><a href="https://twitter.com/'+tweetusername+'/status/'+tweetid+'" target="_blank">'+relative_time(feeds[i].created_at)+'</a></span><br/>'+status+'</p>';
							
							if (isaretweet == true && showretweetindicator == true) {
								feedHTML += '<div id="retweet-indicator'+feed+'"></div>';
							}						
							if (showtweetactions == true) {
								feedHTML += '<div style="width: 100%; float: left; display: none;" id="twitter-actions'+feed+'"><br />';
								
								
								feedHTML += '<div class="intent" id="intent-reply"><a onclick="reply('+comilla+''+tweetusername+''+comilla+');" href="" title="Reply"></a></div>';
                                                              if(option!=3){
								feedHTML += '<div style="padding: 0px 5px 0px 1px; display: table-cell; vertical-align: middle;"><a  onclick="abrirDeck(1,'+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+tweetid+''+comilla+');" style="color: #00acee; cursor: pointer;" href="">'+feeds[i].retweet_count+'</a></div>';
								if((feeds[i].retweeted=="true" || feeds[i].retweeted==true)){
								  feedHTML += '<div class="intent" id="intent-retweet"><a onclick="delTweet('+comilla+''+user+''+comilla+','+comilla+''+tweetidR+''+comilla+','+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+');" style="background: url('+comilla+'twitter/images/retweeted-on.png'+comilla+') no-repeat scroll center center / 22px 12px" title="Retweet" href=""></a></div>';
								} else {
							          feedHTML += '<div class="intent" id="intent-retweet"><a onclick="abrirDeck(1,'+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+tweetid+''+comilla+');" title="Retweet" href=""></a></div>';
								}
                                                                if(feeds[i].retweeted_status){
                                                                  feedHTML += '<div style="padding: 0px 5px 0px 5px; display: table-cell; vertical-align: middle;"><a  onclick="abrirDeck(2,'+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+tweetid+''+comilla+');" style="color: #00acee; cursor: pointer;" href="">'+feeds[i].retweeted_status.favorite_count+'</a></div>';
                                                                } else {
                                                                  feedHTML += '<div style="padding: 0px 5px 0px 5px; display: table-cell; vertical-align: middle;"><a  onclick="abrirDeck(2,'+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+tweetid+''+comilla+');" style="color: #00acee; cursor: pointer;" href="">'+feeds[i].favorite_count+'</a></div>';
                                                                }
								if((feeds[i].favorited=="true" || feeds[i].favorited==true)){
								  feedHTML += '<div class="intent" id="intent-fave"><a onclick="delFavourite('+comilla+''+user+''+comilla+','+comilla+''+tweetid+''+comilla+','+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+');" style="background: url('+comilla+'twitter/images/favorite-on.png'+comilla+') no-repeat scroll center center / 16px 15px" href=""></a></div>';
								} else {
								  feedHTML += '<div class="intent" id="intent-fave"><a onclick="abrirDeck(2,'+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+','+comilla+''+tweetid+''+comilla+');" title="Favourite" href=""></a></div>';
								}
                                                              }
                                                                if(tweetusername==user){
							          feedHTML += '<div class="intent" id="intent-eli"><a onclick="delTweet('+comilla+''+user+''+comilla+','+comilla+''+tweetid+''+comilla+','+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+')" title="Eliminar" style="background: url('+comilla+'images/eliminar2.png'+comilla+') no-repeat scroll center center / 15px 15px" href=""></a></div>';
                                                                }
                                                               feedHTML += '<br /><div style="width: 100%; display: table;">';
                                                                if((UserIdFollowing=="false" || UserIdFollowing==false) && tweetusername!=user){
                                                                  feedHTML += '<button onclick="seguirTw2('+comilla+''+user+''+comilla+','+comilla+''+tweetusername+''+comilla+','+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+');" class="btn btn-success" style="display: inline-block;">+ Follow</button>';
                                                                } else if(tweetusername!=user) {
                                                                  feedHTML += '<button onclick="dejarSeguirTw('+comilla+''+user+''+comilla+','+comilla+''+tweetusername+''+comilla+','+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+');" class="btn btn-danger" style="display: inline-block;">- Unfollow</button>';
                                                                }
                                                                if(tweetusername!=user){
                                                                  feedHTML += '<button style="margin-left:1em; display: inline-block;" onclick="agregarClienteMonitor('+comilla+''+tweetusername+''+comilla+','+comilla+'twitter'+comilla+','+comilla+''+tweetscreenname+''+comilla+','+comilla+''+tweetuserlocation+''+comilla+');" class="btn btn-success">'+txt397+'</button>';
                                                                }
								feedHTML += '</div></div>';
							}
							
							feedHTML += '</div>';
							feedHTML += '</div>';
							
							displayCounter++;
						}   
				 }
				 //llegas al final del arreglo y guardas siguiente ID de tweets
				if(i==feeds.length-1){
				  window["feedColumna" + feed] = feeds[feeds.length-1].id_str;
				}
			}//fin for
			
			if(feeds.length!=0)
			  feedHTML += loadingHTML;
			feedHTML += '</div>';
			 
			$('#main-feed'+feed+'').html(feedHTML);
			  if(window["feedColumna" + feed] && refrescarListo==1){
				if(auxHeight!=0 && document.getElementById("columna"+feed+""))
				  document.getElementById("columna"+feed+"").scrollTop = auxHeight;
			  }
			  //cuando hay un mensaje y ya no hay info en twitter
			  if(typeof feeds.errors!="object"){
				  if(feeds.length != 0){
					  if(feeds[0].id==window["feedColumna" + feed] && displayCounter==1){
							feedHTMLP = document.getElementById("main-feed"+feed+"").innerHTML;
							feedHTMLA = feedHTMLP.split('<div style="display: table; width: 100%;" id="loading-container');
							if(feedHTMLA[1])
							  feedHTML = feedHTMLA[0];
							else{
							  feedHTMLA = feedHTMLP.split('<div id="loading-container');
							  feedHTML = feedHTMLA[0];
							}
							$('#main-feed'+feed+'').html(feedHTML);
							window["feedColumna" + feed] = -1;
					  }
				 }
			} else {
				$('#loading-container'+feed+'').html("");
			}
			//Add twitter action animation and rollovers
			if (showtweetactions == true) {				
				$('.twitter-article'+feed+'').hover(function(){
					$(this).find('#twitter-actions'+feed+'').css({'display':'block', 'opacity':0, 'margin-top':-20, 'width':'100%'});
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
				    window.open(url, 'tweet action window', 'width=580,height=500');
                                  }
				  return false;
				});
			}
		refrescarListo=0;	
			
	}).error(function(jqXHR, textStatus, errorThrown) {
		var error = "";
			 if (jqXHR.status === 0) {
			   error = 'Connection problem. Check file path and www vs non-www in getJSON request';
			} else if (jqXHR.status == 404) {
				error = 'Requested page not found. [404]';
			} else if (jqXHR.status == 500) {
				error = 'Internal Server Error [500].';
			} else {
				error = 'Uncaught Error.\n' + jqXHR.responseText;
			}	
			//alert("error: " + error);
			$('#loading-container'+feed+'').css("display","none");
			$('#main-feed'+feed+'').html("<center>"+ txt92 +"</center>");
			$('#main-feed'+feed+'').html($('#main-feed'+feed+'').html() + '<div style="width: 100%; text-align: center;"><img onclick="imgRefreshTwitter('+comilla+''+option+''+comilla+','+comilla+''+feed+''+comilla+','+comilla+''+user+''+comilla+')" src="images/refresh.gif" style="cursor: pointer;" /></div>');
			refrescarListo=0;
	});//fin error
	
	//Function modified from Stack Overflow
	function addlinks(data) {
		//Add link to all http:// links within tweets
		 data = data.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
			return '<a target="_blank" href="'+url+'" >'+url+'</a>';
		});
			 
		//Add link to @usernames used within tweets
		data = data.replace(/\B@([_a-z0-9]+)/ig, function(reply) {
			return '<a target="_blank" href="http://twitter.com/'+reply.substring(1)+'" style="font-weight:lighter;" target="_blank">'+reply.charAt(0)+reply.substring(1)+'</a>';
		});
		//Add link to #hastags used within tweets
		data = data.replace(/\B#([_a-z0-9]+)/ig, function(reply) {
			return '<a target="_blank" href="https://twitter.com/search?q='+reply.substring(1)+'" style="font-weight:lighter;" target="_blank">'+reply.charAt(0)+reply.substring(1)+'</a>';
		});
		return data;
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
}// fin get tweet