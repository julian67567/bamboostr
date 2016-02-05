var agregarADeckArray = [];
var id_tweetS = '';
var optionT = '';
var feedT = '';
var userT = '';
function mandarRetweet(){
  if(agregarADeckArray.length==0){
    toastr["warning"](txt148);
  } else {
    $("#cargando").dialog("open");
    $(".ui-dialog-titlebar-close").hide();
    $("#cargando").dialog('option', 'title', txt115+"...");
    var mensaje23ew = 0;
    for(var wersq2349=0; wersq2349<agregarADeckArray.length; wersq2349++){
      $('#'+agregarADeckArray[wersq2349]['img']+'').css("opacity","1");
      $('#re'+agregarADeckArray[wersq2349]['c']+'').css("background","url('images/palomita.png') no-repeat center center / 0px 0px transparent");
      $('#fav'+agregarADeckArray[wersq2349]['c']+'').css("background","url('images/palomita.png') no-repeat center center / 0px 0px transparent");
      $.ajax({		url:   "twitter/post-retweet.php?screen_name="+agregarADeckArray[wersq2349]['user']+"&id_tweet="+id_tweetS,
						type:  "post",
						success:  function (response) {
                                                  mensaje23ew++;
                                                  if(mensaje23ew==agregarADeckArray.length){
						    toastr["success"](txt150);
                                                    $("#cargando").dialog("close");
                                                    $(".ui-dialog-titlebar-close").show();
                                                    agregarADeckArray = [];
                                                    imgRefreshTwitter(optionT,feedT,userT);
                                                  }
						},
						error: function (response){
						  toastr["error"](txt92);
                                                  $("#cargando").dialog("close");
                                                  $(".ui-dialog-titlebar-close").show();
                                                  agregarADeckArray = [];
						}
      });
    }
  }
}
function mandarFavorito(){
  if(agregarADeckArray.length==0){
    toastr["warning"](txt148);
  } else {
    $("#cargando").dialog("open");
    $(".ui-dialog-titlebar-close").hide();
    $("#cargando").dialog('option', 'title', txt115+"...");
    var mensaje23ew = 0;
    for(var wersq2349=0; wersq2349<agregarADeckArray.length; wersq2349++){
      $('#'+agregarADeckArray[wersq2349]['img']+'').css("opacity","1");
      $('#re'+agregarADeckArray[wersq2349]['c']+'').css("background","url('images/palomita.png') no-repeat center center / 0px 0px transparent");
      $('#fav'+agregarADeckArray[wersq2349]['c']+'').css("background","url('images/palomita.png') no-repeat center center / 0px 0px transparent");
      $.ajax({		url:   "twitter/post-favorite.php?screen_name="+agregarADeckArray[wersq2349]['user']+"&id_tweet="+id_tweetS,
						type:  "post",
						success:  function (response) {
                                                  mensaje23ew++;
                                                  if(mensaje23ew==agregarADeckArray.length){
						    toastr["success"](txt151);
                                                    $("#cargando").dialog("close");
                                                    $(".ui-dialog-titlebar-close").show();
                                                    agregarADeckArray = [];
                                                    imgRefreshTwitter(optionT,feedT,userT);
                                                  }
						},
						error: function (response){
						  toastr["error"](txt92);
                                                  $("#cargando").dialog("close");
                                                  $(".ui-dialog-titlebar-close").show();
                                                  agregarADeckArray = [];
						}
      });
    }
  }
}
function delFavourite(user,id_tweet123,option,feed,user){
    $("#cargando").dialog("open");
    $(".ui-dialog-titlebar-close").hide();
    $("#cargando").dialog('option', 'title', txt115+"...");
      $.ajax({		url:   "twitter/post-deleteFavourite.php?screen_name="+user+"&id_tweet="+id_tweet123,
						type:  "post",
						success:  function (response) {
                                                  imgRefreshTwitter(option,feed,user);
                                                  toastr["success"](txt152);
                                                  $("#cargando").dialog("close");
                                                  $(".ui-dialog-titlebar-close").show();
						},
						error: function (response){
						  toastr["error"](txt92);
                                                  $("#cargando").dialog("close");
                                                  $(".ui-dialog-titlebar-close").show();
						}
      });
}
function delTweet(user,id_tweet123,option,feed,user){
      $("#cargando").dialog("open");
      $(".ui-dialog-titlebar-close").hide();
      $("#cargando").dialog('option', 'title', txt115+"...");
      $.ajax({		url:   "twitter/post-delete.php?screen_name="+user+"&id_tweet="+id_tweet123,
						type:  "post",
						success:  function (response) {
                                                  imgRefreshTwitter(option,feed,user);
                                                  toastr["success"](txt149);
                                                  $("#cargando").dialog("close");
                                                  $(".ui-dialog-titlebar-close").show();
						},
						error: function (response){
						  toastr["error"](txt92);
                                                  $("#cargando").dialog("close");
                                                  $(".ui-dialog-titlebar-close").show();
						}
      });
}
function agregarADeck(id, img, userName, c){
  var band=-1;
  if(agregarADeckArray.length!=0){
    for(var efweqd=0; efweqd<agregarADeckArray.length; efweqd++){
      if(agregarADeckArray[efweqd]['id']==id){
        agregarADeckArray.splice(efweqd, 1);
        efweqd=agregarADeckArray.length;
        band=1;
        $('#'+img+'').css("opacity","1");
        $('#re'+c+'').css("background","url('images/palomita.png') no-repeat center center / 0px 0px transparent");
        $('#fav'+c+'').css("background","url('images/palomita.png') no-repeat center center / 0px 0px transparent");
      }
    }
  }
  if(band==-1){
    $('#'+img+'').css("opacity","0.5");
    $('#re'+c+'').css("background","url('images/palomita.png') no-repeat center center / 50px 50px transparent");
    $('#fav'+c+'').css("background","url('images/palomita.png') no-repeat center center / 50px 50px transparent");
    agregarADeckArray[agregarADeckArray.length] = [];
    agregarADeckArray[agregarADeckArray.length-1]['id'] = id;  
    agregarADeckArray[agregarADeckArray.length-1]['user'] = userName; 
    agregarADeckArray[agregarADeckArray.length-1]['img'] = img; 
    agregarADeckArray[agregarADeckArray.length-1]['c'] = c; 
  }
}
function abrirDeck(option,option2,feed,user,id_tweet){
  id_tweetS = id_tweet;
  optionT = option2;
  feedT = feed;
  userT = user;
  if(option==1){
    $("#retweets").dialog('option', 'title', txt153);
    $("#retweets").dialog('option', 'width', 500);
    $("#retweets").dialog('option', 'height', 300);
    $("#retweets").dialog("open");
  } else if(option==2) {
    $("#favorites").dialog('option', 'title', txt154);
    $("#favorites").dialog('option', 'width', 500);
    $("#favorites").dialog('option', 'height', 300);
    $("#favorites").dialog("open");
  } 
  //$(".ui-dialog-titlebar-close").hide();
}