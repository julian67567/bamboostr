function getTopTweets(identifyLocal,identifyOther,redLocal,imagenRed,feedTopTweet){
  if(feedTopTweet==10)
    $('#main-feed'+feedTopTweet+'Text').html(txt265);
  var feedheight = 402; 
  var showmensajesactions = true;
  var showmensajeslinks = true;
  var status = "";
  var loadingHTML = '<center><div style="text-align: center; display: table; width: 100%;" id="loading-container'+feedTopTweet+'"><br /><div class="Knight-Rider-loader animate"><div class="Knight-Rider-bar"></div><div class="Knight-Rider-bar"></div><div class="Knight-Rider-bar"></div></div><br /></div></center>';
  $('#main-feed'+feedTopTweet+'').html(loadingHTML);
  
  var parametros = { redP:red, redS:redLocal, identifyP:identify, identifyS:identifyLocal, identifyOther:identifyOther
			       };
  $.ajax({  url:   "scripts/get-twitter-top-tweets.php",
			type:  "GET",
			data:  parametros,
			success:  function (response) {
			  feedMsgsPro = '';
			  if(response.indexOf("FALSE")!="-1"){
			    $('#main-feed'+feedTopTweet+'').html("<center>"+ txt122 +"</center>");
			  } else if(response.indexOf("Base de datos")!="-1"){
			    $('#main-feed'+feedTopTweet+'').html("<center>"+ txt117 +"</center>");
			  } else {
				obj = JSON.parse(response);
				if(obj.data.length!=0 && obj.data[0].screen_name!=""){
				  for(var i=0; i<obj.data.length; i++){
					status = "";
					if (showmensajeslinks == true && obj.data[i].mensaje) {
						status = addlinks(obj.data[i].mensaje);
					}
					if(i==0){
					  feedMsgsPro += '<div id="columna'+feedTopTweet+'" style="text-align: left; position:relative; height:'+feedheight+'px; overflow-y: auto;">';
					}
					feedMsgsPro += '<div class="twitter-article'+feedTopTweet+'" style="display: table-row;">'; 							
					if(redLocal=="facebook"){	                 
					  feedMsgsPro += '<div class="twitter-pic" style="display: table-cell;"><a href="https://facebook.com/'+identifyLocal+'" target="_blank"><img id="profileImage'+window["contImageMsgPro" + feedTopTweet]+''+feedTopTweet+'" src="'+imagenRed+'" width="42" height="42" alt="Profile" /></a></div>';
					  feedMsgsPro += '<div class="twitter-text" style="display: table-cell;"><p><span class="tweetprofilelink"><strong><a href="https://facebook.com/'+obj.data[i].identify+'" target="_blank">'+obj.data[i].screen_name+'</a></strong></span><span class="tweet-time">'+obj.data[i].fecha+'</span><br/>';
					} else if(redLocal=="twitter"){
					  feedMsgsPro += '<div class="twitter-pic" style="display: table-cell;"><a href="https://twitter.com/'+obj.data[i].screen_name+'" target="_blank"><img id="profileImage'+window["contImageMsgPro" + feedTopTweet]+''+feedTopTweet+'" src="'+imagenRed+'" width="42" height="42" alt="Profile" /></a></div>';
					  feedMsgsPro += '<div class="twitter-text" style="display: table-cell;"><p><span class="tweetprofilelink"><strong><a href="https://twitter.com/'+obj.data[i].screen_name+'" target="_blank">'+obj.data[i].screen_name+'</a></strong></span><span class="tweet-time">'+relative_time(obj.data[i].fecha)+'</span><br/>';
					}
					
					
					feedMsgsPro += ''+status+'<br />';
					
					if (showmensajesactions == true && redLocal=="twitter") {
						feedMsgsPro += '<div style="float: left; display: none;" id="twitter-actions'+feedTopTweet+'"><br /><div class="intent" id="intent-reply"><a href="https://twitter.com/intent/tweet?in_reply_to='+obj.data[i].id+'" title="Reply"></a></div><div style="padding: 0px 5px 0px 1px; display: table-cell;"><a href="https://twitter.com/intent/retweet?tweet_id='+obj.data[i].id+'" style="color: #00acee; cursor: pointer;">'+obj.data[i].retweet_count+'</a></div><div class="intent" id="intent-retweet"><a href="https://twitter.com/intent/retweet?tweet_id='+obj.data[i].id+'" title="Retweet"></a></div><div style="padding: 0px 5px 0px 1px; display: table-cell;"><a href="https://twitter.com/intent/favorite?tweet_id='+obj.data[i].id+'" style="color: #00acee; cursor: pointer;">'+obj.data[i].favorite_count+'</a></div><div class="intent" id="intent-fave"><a href="https://twitter.com/intent/favorite?tweet_id='+obj.data[i].id+'" title="Favourite"></a></div></div>';
					}
					feedMsgsPro += '</div>';
					feedMsgsPro += '</div>';
				  }//fin for
				} else {
				  feedMsgsPro += '<div>'+txt52;
				}
				feedMsgsPro += '</div>';
			    $('#main-feed'+feedTopTweet+'').html(feedMsgsPro);
			  }// fin else
			  
			  //Add twitter action animation and rollovers
			  if (showmensajesactions == true) {				
				$('.twitter-article'+feedTopTweet+'').hover(function(){
					$(this).find('#twitter-actions'+feedTopTweet+'').css({'float':'left', 'display':'table-row', 'opacity':0, 'margin-top':-20});
					$(this).find('#twitter-actions'+feedTopTweet+'').animate({'opacity':1, 'margin-top':0},200);
				}, function() {
					$(this).find('#twitter-actions'+feedTopTweet+'').animate({'opacity':0, 'margin-top':-20},120, function(){
						$(this).css('display', 'none');
					});
				});	
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
			  
			  //Add new window for action clicks
			
				$('#twitter-actions'+feedTopTweet+' a').click(function(){
					var url = $(this).attr('href');
				  window.open(url, 'tweet action window', 'width=580,height=500');
				  return false;
				});
			  
			  //Function modified from Stack Overflow
			  function addlinks(data) {
				//Add link to all http:// links within tweets
				 data = data.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
					return '<a href="'+url+'" >'+url+'</a>';
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
			},
			error: function (response){
			  $('#main-feed'+feedTopTweet+'').html("<center>"+ txt117 +"</center>");
			}
  });
}