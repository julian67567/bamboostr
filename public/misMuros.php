<?PHP
require_once('session.php');
if($status=="OK"){
	if($_SESSION['identify'])
	  $identify = $_SESSION['identify'];
	if($_SESSION['user'])
	  $screen_name = $_SESSION['user'];
	if($_SESSION['user_image'])
	  $user_image = $_SESSION['user_image'];
	if($_SESSION['sessionid'])
	  $ssid = $_SESSION['sessionid'];
	include 'desktop/header.php';
	if(getUserLanguage()=="es")
	  include 'lenguajes/espanol.php';
	else
	  include 'lenguajes/ingles.php';
	header_desktop("".$txt["titulo3"]." ".$screen_name."");
	?>
<?PHP
$query=$conn->query("SELECT social_networks FROM token WHERE identify='".$identify."' AND red='".$redSocial."'");
$row=$query->fetch_assoc();
$social_networks=$row["social_networks"];
$social_networks_parts=explode(",",$social_networks);
$c=0;
$totalFeedColumns = 0;
$grupos=0;
foreach($social_networks_parts as &$item){
  if($item!=""){
	  if($grupos==0){
		$query2=$conn->query("SELECT id,foto,feed_noticias,feed_perfil,feed_dms,feed_mentions,feed_events,feed_programados,feed_drafts,feed_refresh,red,screen_name,identify 
                                     FROM token WHERE identify='".substr($item,2,strlen($item))."' AND red='".$redSocial."'");
		$row2=$query2->fetch_assoc();
		$id_token=$row2["id"];
		$feed_programados=$row2["feed_programados"];
		$feed_drafts=$row2["feed_drafts"];
		$feed_refresh=$row2["feed_refresh"];
		$grupos++;
		$query3=$conn->query("SELECT ss.feed_perfil,ss.feed_dms,ss.identify,ss.identify_account,ss.name,ss.red
							   FROM social_share as ss WHERE ss.id_token='".$id_token."' AND ss.tipo='page'
							   ORDER BY ss.id_token ASC");
                while($row3=$query3->fetch_assoc()){
                  echo "<!--".$row3["name"]."-->";
	          $feed_array[$c][0]=0;
		  $feed_array[$c][1]=$row3["feed_perfil"];
	          $feed_array[$c][2]=$row3["feed_dms"];
		  $feed_array[$c][3]=0;
	          $feed_array[$c][8]=0;
		  $feed_array[$c][4]=$row3["red"];
		  $feed_array[$c][5]=$row3["name"];
		  $feed_array[$c][6]=$row3["identify_account"];
		  $feed_array[$c][9]=$row3["identify"];
	          $feed_array[$c][7]="";
		  if($row3["feed_perfil"]==1)
			$totalFeedColumns++;
		  if($row3["feed_dms"]==1)
			$totalFeedColumns++;
		  $c++;
                }
	  } else {
	       $query2=$conn->query("SELECT tok.id,tok.identify,tok.screen_name,tok.red,tok.foto,gr.feed_noticias,gr.feed_perfil,gr.feed_dms,gr.feed_mentions,gr.feed_events
							   FROM token AS tok INNER JOIN grupos AS gr 
							   ON  tok.identify='".substr($item,2,strlen($item))."'
							   AND tok.social_networks like ('%".$item."%')
							   AND gr.grupo='".$identify."'
							   AND gr.id_token='".$id_token."'
							   ORDER BY gr.id ASC
							   LIMIT ".($grupos-1).",1");
	       unset($row2);					 
	       $row2=$query2->fetch_assoc();
	       $id_token23=$row2["id"];
	       $grupos++;
	  }
          if($row2["red"]=="facebook"){
            $feed_array[$c][0]=0;
          } else {
            $feed_array[$c][0]=$row2["feed_noticias"];
          }
	  $feed_array[$c][1]=$row2["feed_perfil"];
          if($row2["red"]=="facebook"){
            $feed_array[$c][2]=0;
          } else {
            $feed_array[$c][2]=$row2["feed_dms"];
          }
	  $feed_array[$c][3]=$row2["feed_mentions"];
          if($row2["red"]=="facebook"){
            $feed_array[$c][8]=$row2["feed_events"];
          } else {
            $feed_array[$c][8]=0;
          }
	  $feed_array[$c][4]=$row2["red"];
	  $feed_array[$c][5]=$row2["screen_name"];
	  $feed_array[$c][6]=$row2["identify"];
          $feed_array[$c][7]=$row2["foto"];
	  $feed_array[$c][9]="";
	  if($row2["feed_noticias"]==1)
		$totalFeedColumns++;
	  if($row2["feed_perfil"]==1)
		$totalFeedColumns++;
	  if($row2["feed_dms"]==1)
		$totalFeedColumns++;
	  if($row2["feed_mentions"]==1)
		$totalFeedColumns++;
          if($row2["feed_events"]==1 && $row2["red"]=="facebook")
		$totalFeedColumns++;
	  $c++;
  }
}//fin foreach
$c=0;
include 'scripts/query-write.php';
?>
<!--GetTweets Style-->
<link href="twitter/css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/escribir.css" rel="stylesheet" media="all" />
<style>
<?PHP
$c=1;
while($c<=$totalFeedColumns+2){
	?>
	#main-feed<?PHP echo $c; ?> {
		width: 19em;
		margin:auto;
		font-family: Arial;
		margin: 0px;
		padding: 0px;
		border-radius: 0px;
		background-color:#FFF;
		color:#333;
	} 
	#main-feed<?PHP echo $c; ?> h1 {
		color:#5F5F5F;
		margin:0px;
		padding:9px 0px 9px 0px;
		font-size:18px;
		font-weight:lighter;   
	}
	#loading-container<?PHP echo $c; ?> {
		padding:16px 0px 16px 0px;
		text-align:center; 
    }
	.twitter-article<?PHP echo $c; ?>, #loading-container {
		width:100%;
		float:left; 
		padding-top: 15px;
		padding-bottom: 15px;
	} 
	.twitter-article<?PHP echo $c; ?> {
		border-bottom:1px dotted #CCC;
		top:0px;
	}
	
	<?PHP
$c++;
}
?>
</style>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/huso-horario.js"></script>
<script type="text/javascript">
  var identify = '<?PHP echo $identify; ?>';
  var screen_name = '<?PHP echo $screen_name; ?>';
  var ssid = '<?PHP echo $ssid; ?>';
  var red = '<?PHP echo $redSocial; ?>';
  var id_token = '<?PHP echo $_SESSION['id_token']; ?>';
  var urlPathActual = 'system';
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#login').click(function(){
	  window.location = "login.php";
   });
});
</script>
<script type="text/javascript">
//JQUERY
$(document).ready(function(){
  var intervalo = 300000;
  var intervalo2 = 4200;
  $('#tableSys1').css("border-left","5px solid #FFF");
  <?PHP
	$c=1;
	while($c!=$totalIconosMenu){
  ?>
  $('#textosSys<?PHP echo $c; ?>').css("display","none");
  $('#textosSys<?PHP echo $c; ?>').css("width","0%");
  <?PHP
	  $c++;
	}
  ?>
  <?PHP
  $c=1;
  while($c!=$totalIconosMenu){
  ?>
  $('#tableSys<?PHP echo $c; ?>').hover(function(){
	 $('#tableSys<?PHP echo $c; ?>').css("border-left","5px solid #FFF");
	 $('#tableSys<?PHP echo $c; ?>').css("cursor","pointer");
	 $('#expandirSys').css("width","20%");
  }, function(){
	 $('#tableSys<?PHP echo $c; ?>').css("border-left","5px solid #283147");
	 $('#tableSys1').css("border-left","5px solid #FFF");
  });
  <?PHP
	  $c++;
	}
  ?>
  $('#expandirSys').hover(function(){
  <?PHP
	$c=1;
	while($c!=$totalIconosMenu){
  ?>
	  $('#botonesSys<?PHP echo $c; ?>').css("width","50px");
	  $('#textosSys<?PHP echo $c; ?>').css("display","block");
	  $('#textosSys<?PHP echo $c; ?>').css("width","95%");
  <?PHP
	  $c++;
	}
  ?>
      $('#expandirSys').css("z-index","3");
      $('#expandirSys').css("width","20%");
	  }, function(){
  <?PHP
	$c=1;
	while($c!=$totalIconosMenu){
  ?>
		$('#botonesSys<?PHP echo $c; ?>').css("width","50px");
		$('#textosSys<?PHP echo $c; ?>').css("display","none");
		$('#textosSys<?PHP echo $c; ?>').css("width","0%");
  <?PHP
	  $c++;
	}
  ?>
    $('#expandirSys').css("z-index","1");
	$('#expandirSys').css("width","50px");
  });
  <?PHP
    include 'menu-javaScript.php';
  ?>
  
  <?PHP
	$c=1;
	while($c<=$totalRedes){
	  ?>
	  $('#redes<?PHP echo $c; ?>').hover(function(){
		$('#redes<?PHP echo $c; ?>').css("background-color","#283147");
		$('#redes<?PHP echo $c; ?>').css("color","#FFFFFF");
	  },function(){
		$('#redes<?PHP echo $c; ?>').css("background-color","#FFFFFF");
		$('#redes<?PHP echo $c; ?>').css("color","#000000");
	  });
	  <?PHP
	  $c++;
	}
  ?>

  <!--Llamadas iniciales a las funciones-->

  <?PHP
  $c=0;
  $col=1;
  foreach($feed_array as $item){
	  $c2=0;
	  while($c2<5){
                  if($c2==4)
                    $c2=8;
		  if($feed_array[$c][$c2]==1){
			  if($c2==0)
			    $optTemp = 2;
			  if($c2==1)
			    $optTemp = 1;
			  if($c2==2)
			    $optTemp = 3;
			  if($c2==3)
			    $optTemp = 4;
                          if($c2==8)
			    $optTemp = 5;
			  if($feed_array[$c][4]=="twitter"){
				  ?>
				  
                                  getTwitter(<?PHP echo $optTemp; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>");
                                  /*si condiciones refrescarlisto==0 no jalan los refresh*/
				  <?PHP
                                  if($feed_refresh==1){
                                  ?>
				    setInterval(function(){
					  if($("#columna<?PHP echo $col; ?>").scrollTop()==0 && document.getElementById("main-feed<?PHP echo $col; ?>").innerHTML!=""){
						refrescarListo=1;
						feedColumna<?PHP echo $col; ?> = 0;
						$("#main-feed<?PHP echo $col; ?>").html("");
						getTwitter(<?PHP echo $optTemp; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>");
					  }
				    }, intervalo);
                                  <?PHP
                                  }
                                  ?>
				  <?PHP
			  } else if($feed_array[$c][4]=="facebook"){
			      ?>
				  
                                  getFacebook(<?PHP echo $optTemp; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][9]; ?>");
				  <?PHP
                                  if($feed_refresh==1){
                                  ?>
				    setInterval(function(){
					  if($("#columna<?PHP echo $col; ?>").scrollTop()==0 && document.getElementById("main-feed<?PHP echo $col; ?>").innerHTML!=""){
						refrescarListo=1;
						feedColumna<?PHP echo $col; ?> = 0;
                                                window["feedColumnaId" + <?PHP echo $col; ?>] =0;
						$("#main-feed<?PHP echo $col; ?>").html("");
						getFacebook(<?PHP echo $optTemp; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][9]; ?>");
					  }
				    }, intervalo);
                                  <?PHP
                                  }
                                  ?>
				  <?PHP
			  } 
			  $col++;
		  }
		  $c2++;
	  }
	  $c++;
  }
  ?>
  
  $(function() {
    $("#help").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	});

    $("#dialog").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	});

    $("#cargando").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	});

    $("#retweets").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	});

    $("#favorites").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	});

    $("#likes").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	});

    $("#recordatorioMail").dialog({
	  autoOpen: false,
	  position: {my: "center", at: "center", to: window},
	  modal: true,
	});
    recordatorioMail();
  });

  <?PHP
  
  if($feed_programados==1){
  ?>
    
    window["feedMsgsProgramCol"] = <?PHP echo $col; ?>;
    getMsgsProgram(''+window["feedMsgsProgramCol"]+'');
  <?PHP
    $col++;
  }
  if($feed_drafts==1){
  ?>
    window["feedDraftsProgramCol"] = <?PHP echo $col; ?>;
    getDraftsProgram(''+window["feedDraftsProgramCol"]+'');
  <?PHP
    $col++;
  }
  ?>

  intervalo2 = intervalo2 * <?PHP echo $c; ?>;
  setTimeout(function(){
    var columnasRefrescar = setInterval(function(){
	  //confunde a los refresh de 5 min el tiempo lo soluciono quiere decir que se estan confundiendo
	  //este refresca las columnas cuando el scroll esta abajo
      autoRefresh();
    }, 3000);
  },intervalo2);
  
  <!-- getUserDetails(); -->
  <!-- dejaDeSeguirCont(); -->
  <!-- getAutoDmDetails(); -->
});
</script>
<script type="text/javascript" src="js/rastreo.js"></script>
<script type="text/javascript">
<?PHP include 'textos.php' ?>
</script>
<script type="text/javascript">
//FUNCIONES
<?PHP
if($_GET["agregarRed"]=="error"){
  ?>toastr["warning"](txt521);<?PHP
}
if($_GET["agregarRed"]=="errorBasic"){
  ?>toastr["warning"](txt522);<?PHP
}
if($_GET["agregarRed"]=="errorPro"){
  ?>toastr["warning"](txt523);<?PHP
}
?>
	var refrescarListo=0;
	var auxHeight;
	<?PHP
	  $c=1;
	  while($c<=$totalFeedColumns){
	    ?>var feedColumna<?PHP echo $c; ?> = 0;<?PHP
	  $c++;
	  }
	?>
        <?PHP
        if($feed_programados==1){
        ?>
	  function imgRefreshMsgsProgram(feedMsgsProgram){
		getMsgsProgram(feedMsgsProgram);
	  }
        <?PHP
        }
        if($feed_drafts==1){
        ?>
          function imgRefreshDraftsProgram(feedDraftsProgram){
		getDraftsProgram(feedDraftsProgram);
	  }
        <?PHP
        }
        ?>
	function imgRefreshTwitter(option, feed, user){
		window["feedColumna" + feed] = 0;
		$("#main-feed"+feed+"").html("");
		getTwitter(option,feed, user);
	}
	function imgRefreshFacebook(option, feed, user, userId, userPage){
		window["feedColumna" + feed] = 0;
                window["feedColumnaId" + feed] =0;
		$("#main-feed"+feed+"").html("");
		getFacebook(option,feed, user, userId,userPage);
	}
	function autoRefresh(){
	  <?PHP
		  $c=0;
		  $col=1;
		  foreach($feed_array as $item){
			  $c2=0;
			  while($c2<5){
                                  if($c2==4)
                                    $c2=8;
				  if($feed_array[$c][$c2]==1){
					  if($c2==0){
						?>
						if(feedColumna<?PHP echo $col; ?>!=-1){
                                                  <?PHP
                                                  if($feed_array[$c][4]=="facebook"){
                                                  ?>
						    refrescarMensajes(<?PHP echo 2; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][4]; ?>","<?PHP echo $feed_array[$c][9]; ?>");
                                                  <?PHP
                                                  } else if($feed_array[$c][4]=="twitter") {
                                                  ?>
						    refrescarMensajes(<?PHP echo 2; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][4]; ?>");
                                                  <?PHP
                                                  }
                                                  ?>
                                                }
                                                if(feedColumna<?PHP echo $col; ?>==-1 && $("#columna<?PHP echo $col; ?>").scrollTop()==0)
                                                  $("#loading-container<?PHP echo $col; ?>").css("display","none");
						<?PHP
					  }
					  if($c2==1){
						?>
						if(feedColumna<?PHP echo $col; ?>!=-1){
                                                  <?PHP
                                                  if($feed_array[$c][4]=="facebook"){
                                                  ?>
						    refrescarMensajes(<?PHP echo 1; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][4]; ?>","<?PHP echo $feed_array[$c][9]; ?>");
                                                  <?PHP
                                                  } else if($feed_array[$c][4]=="twitter") {
                                                  ?>
						    refrescarMensajes(<?PHP echo 1; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][4]; ?>");
                                                  <?PHP
                                                  }
                                                  ?>
                                                }
                                                if(feedColumna<?PHP echo $col; ?>==-1 && $("#columna<?PHP echo $col; ?>").scrollTop()==0)
                                                  $("#loading-container<?PHP echo $col; ?>").css("display","none");
						<?PHP
					  }
					  if($c2==2){
						?>
						if(feedColumna<?PHP echo $col; ?>!=-1){
                                                  <?PHP
                                                  if($feed_array[$c][4]=="facebook"){
                                                  ?>
                                                    
						    refrescarMensajes(<?PHP echo 3; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][4]; ?>","<?PHP echo $feed_array[$c][9]; ?>");
                                                  <?PHP
                                                  } else if($feed_array[$c][4]=="twitter") {
                                                  ?>
						    refrescarMensajes(<?PHP echo 3; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][4]; ?>");
                                                  <?PHP
                                                  }
                                                  ?>
                                                }
                                                if(feedColumna<?PHP echo $col; ?>==-1 && $("#columna<?PHP echo $col; ?>").scrollTop()==0)
                                                  $("#loading-container<?PHP echo $col; ?>").css("display","none");
						<?PHP
					  }
					  if($c2==3){
						?>
						if(feedColumna<?PHP echo $col; ?>!=-1){
                                                  <?PHP
                                                  if($feed_array[$c][4]=="facebook"){
                                                  ?>
						    refrescarMensajes(<?PHP echo 4; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][4]; ?>","<?PHP echo $feed_array[$c][9]; ?>");
                                                  <?PHP
                                                  } else if($feed_array[$c][4]=="twitter") {
                                                  ?>
						    refrescarMensajes(<?PHP echo 4; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][4]; ?>");
                                                  <?PHP
                                                  }
                                                  ?>
                                                }
                                                if(feedColumna<?PHP echo $col; ?>==-1 && $("#columna<?PHP echo $col; ?>").scrollTop()==0)
                                                  $("#loading-container<?PHP echo $col; ?>").css("display","none");
						<?PHP
					  }
                                          if($c2==8){
						?>
						if(feedColumna<?PHP echo $col; ?>!=-1){
                                                  <?PHP
                                                  if($feed_array[$c][4]=="facebook"){
                                                  ?>
						    refrescarMensajes(<?PHP echo 5; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][4]; ?>","<?PHP echo $feed_array[$c][9]; ?>");
                                                  <?PHP
                                                  } else if($feed_array[$c][4]=="twitter") {
                                                  ?>
						    refrescarMensajes(<?PHP echo 5; ?>,<?PHP echo $col; ?>,"<?PHP echo $feed_array[$c][5]; ?>","<?PHP echo $feed_array[$c][6]; ?>","<?PHP echo $feed_array[$c][4]; ?>");
                                                  <?PHP
                                                  }
                                                  ?>
                                                }
                                                if(feedColumna<?PHP echo $col; ?>==-1 && $("#columna<?PHP echo $col; ?>").scrollTop()==0)
                                                  $("#loading-container<?PHP echo $col; ?>").css("display","none");
						<?PHP
					  }
					  $col++;
				  }
				  $c2++;
			  }
			  $c++;
		  }
		  ?>
	}
	function refrescarMensajes(option,feed,user,userId,red,userPage){
	  if(refrescarListo==0 && document.getElementById("columna"+feed+"")!=null){
		var scrollHeight = document.getElementById("columna"+feed+"").scrollHeight;
		var scrollTop = $("#columna"+feed+"").scrollTop();
		if(Math.abs(scrollHeight-scrollTop)<450){
	      auxHeight = scrollTop;
		  refrescarListo=1;
		  if(red=="twitter")
		    getTwitter(option,feed,user); 
		  else if(red="facebook")
		    getFacebook(option,feed,user,userId,userPage);
		}
	  }
	}
	  var seguidores = '';
	  var siguiendo = '';
	
</script>
<script type="text/javascript">
    //Variables Escribir
	var redesTeclasFa = 2000;
	var redesTeclasTw = 140;
</script>  

<script type="text/javascript">
//get-Twitter
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%54%77%69%74%74%65%72%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//get-Facebook
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%46%61%63%65%62%6F%6F%6B%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//get-MsgsProgram
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%4D%73%67%73%50%72%6F%67%72%61%6D%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//getDraftsProgram
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%44%72%61%66%74%73%50%72%6F%67%72%61%6D%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//tweetDeck
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%74%77%65%65%74%44%65%63%6B%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//facebookDeck
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%66%61%63%65%62%6F%6F%6B%44%65%63%6B%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
// recordatorio mail
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%72%65%63%6F%72%64%61%74%6F%72%69%6F%4D%61%69%6C%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//ayuda
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%61%79%75%64%61%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//notificaciones jquery
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%6E%6F%74%69%66%69%63%61%63%69%6F%6E%65%73%2D%6A%71%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//get-notifiaciones
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%67%65%74%4E%6F%74%69%66%69%63%61%63%69%6F%6E%65%73%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//escribir jquery
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%65%73%63%72%69%62%69%72%2D%6A%71%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//escribir
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%65%73%63%72%69%62%69%72%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//sortable jquery
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%73%6F%72%74%61%62%6C%65%2D%6A%71%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
//sortable (ordenador)
document.write(unescape("%3C%73%63%72%69%70%74%20%74%79%70%65%3D%22%74%65%78%74%2F%6A%61%76%61%73%63%72%69%70%74%22%20%73%72%63%3D%22%6A%73%2F%73%6F%72%74%61%62%6C%65%2E%6A%73%22%3E%3C%2F%73%63%72%69%70%74%3E"));
// loading CSS
document.write(unescape("%3C%6C%69%6E%6B%20%74%79%70%65%3D%22%74%65%78%74%2F%63%73%73%22%20%68%72%65%66%3D%22%2E%2E%2F%63%73%73%2F%73%74%79%6C%65%2D%6C%6F%61%64%69%6E%67%2E%63%73%73%22%20%72%65%6C%3D%22%73%74%79%6C%65%73%68%65%65%74%22%20%6D%65%64%69%61%3D%22%61%6C%6C%22%20%2F%3E"));
</script>
<!-Sortable CSS-->
<link type="text/css" href="css/sortable.css" rel="stylesheet" media="all" />
</head>
<?php include 'body-script.php'; ?>
          <td style="vertical-align: top; height: <?PHP echo $alto; ?>px; overflow-y: auto; overflow-x: auto;"><table style="background-color: <?PHP echo $backgroundColor; ?>; width: 100%;">
              <tr>
                <td style="vertical-align: top; width: 100%; padding-top: 15px;">
                  <ul style="padding-left: 45px; width: 100%;" id="sortable">
                <?PHP
				$c=0;
				$nameC = 1;
				foreach($feed_array as $item){
				  if($item!=""){
				          $c2=0;
					  while($c2<5){
                                                  if($c2==4)
                                                    $c2=8;
						  if($feed_array[$c][$c2]==1){
							if($c2==0)
							  $optionRefresh=2;
							if($c2==1)
							  $optionRefresh=1;
							if($c2==2)
							  $optionRefresh=3;
							if($c2==3)
							  $optionRefresh=4;
                                                        if($c2==8)
							  $optionRefresh=5;
							?>
                            <li style="height: auto; width: 21.5em;">
                              <div class="portlet">
                                <div id="portlet-header" class="portlet-header">
                                <?PHP
								if($feed_array[$c][4]=="facebook"){
								  ?><div style="position: absolute; display: inline-block;"><img src="images/f.png" style="width: 2.0em; float:left; padding:0px; top: 0px;" alt="F" /></div>
								    <div onclick="imgRefreshFacebook('<?PHP echo $optionRefresh; ?>','<?PHP echo $nameC; ?>','<?PHP echo $feed_array[$c][5];?>','<?PHP echo $feed_array[$c][6]; ?>','<?PHP echo $feed_array[$c][9]; ?>')" class='ui-icon ui-icon-refresh' title="<?PHP echo $txt["txt73"]; ?>"></div>
									<div class="acercaS" onclick="help('<?PHP echo $optionRefresh; ?>', '<?PHP echo $feed_array[$c][4]; ?>');" title="<?PHP echo $txt["txt48"]; ?>"></div><?PHP
								} else if($feed_array[$c][4]=="twitter"){
								  ?><div style="position: absolute; display: inline-block;"><img src="images/t.png" style="width: 2.0em; float:left; padding:0px; top: 0px;" alt="T" /></div>
								    <div onclick="imgRefreshTwitter('<?PHP echo $optionRefresh; ?>','<?PHP echo $nameC; ?>','<?PHP echo $feed_array[$c][5];?>')" class='ui-icon ui-icon-refresh' title="<?PHP echo $txt["txt73"]; ?>"></div>
									<div class="acercaS" onclick="help('<?PHP echo $optionRefresh; ?>', '<?PHP echo $feed_array[$c][4]; ?>');" title="<?PHP echo $txt["txt48"]; ?>"></div><?PHP
								}
								?>
                                <div class="textoS"><?PHP echo $feed_array[$c][5]; ?></div>
                                <div class='ui-icon ui-icon-minusthick portlet-toggle' title="<?PHP echo $txt["txt72"]; ?>"></div>
                                <div id="portletheaderClose<?PHP echo $nameC; ?>" onclick="portletHeaderClose(this.id);" class="closeS" title="<?PHP echo $txt["txt219"]; ?>"></div>
                                </div>
                                <div id="main-feed<?PHP echo $nameC; ?>" class="portlet-content" style="height: 450px; display: none; z-index: 0; border: 0px solid #283147;"> </div>
						      </div>
                            </li>
								<?PHP
							$nameC++;
						  }
						  $c2++;
					  }
					  $c++;
				  }
				}
				?>
                  <?PHP
                  if($feed_programados==1){
                  ?>
                    <li style="height: auto; width: 21.5em;">
                      <div class="portlet">
                        <div id="portlet-header" class="portlet-header">
                          <div style="position: absolute; display: inline-block;"><img src="images/engrane.png" style="width: 2.0em; float:left; padding:0px; top: 0px;" alt="E" /></div>
                            <div onclick="imgRefreshMsgsProgram('<?PHP echo $nameC; ?>')" class='ui-icon ui-icon-refresh' title="<?PHP echo $txt["txt73"]; ?>"></div>
                        <div class="textoS"><?PHP echo $txt["txt121"]; ?></div>
                        <div class="acercaS" onclick="help('1','msgsProgramados');" title="<?PHP echo $txt["txt48"]; ?>"></div>
                        <div class='ui-icon ui-icon-minusthick portlet-toggle' title="<?PHP echo $txt["txt72"]; ?>"></div>
                        <div id="portletheaderClose<?PHP echo $nameC; ?>" onclick="portletHeaderClose(this.id);" class="closeS" title="<?PHP echo $txt["txt219"]; ?>"></div>
                        </div>
                        <div id="main-feed<?PHP echo $nameC; ?>" class="portlet-content" style="height: 450px; display: block; z-index: 0; border: 0px solid #283147;"> </div>
                      </div>
                    </li>
                  <?PHP
                    $nameC=$nameC+1;
                  }
                  ?>
                  <?PHP
                  if($feed_drafts==1){
                  ?>
                    <li style="height: auto; width: 21.5em;">
                      <div class="portlet">
                        <div id="portlet-header" class="portlet-header">
                          <div style="position: absolute; display: inline-block;"><img src="images/engrane.png" style="width: 2.0em; float: left; padding:0px; top: 0px;" alt="E" /></div>
                            <div onclick="imgRefreshDraftsProgram('<?PHP echo $nameC; ?>')" class='ui-icon ui-icon-refresh' title="<?PHP echo $txt["txt73"]; ?>"></div>
                        <div  class="textoS"><?PHP echo $txt["txt139"]; ?></div>
                        <div class="acercaS" onclick="help('1','drafts');" title="<?PHP echo $txt["txt48"]; ?>"></div>
                        <div class='ui-icon ui-icon-minusthick portlet-toggle' title="<?PHP echo $txt["txt72"]; ?>"></div>
                        <div id="portletheaderClose<?PHP echo $nameC; ?>" onclick="portletHeaderClose(this.id);" class="closeS" title="<?PHP echo $txt["txt219"]; ?>"></div>
                        </div>
                        <div id="main-feed<?PHP echo $nameC; ?>" class="portlet-content" style="height: 450px; display: block; z-index: 0; border: 0px solid #283147;"> </div>
                      </div>
                    </li>
                  <?PHP
                    $nameC=$nameC+1; 
                  }
                  ?>
                  </ul>
                  <div id="recordatorioMail"
                  </div>
                  <div id="help">
                  </div>
                  <div id="dialog">
                  </div>
                  <div id="cargando">
                    <div id="loading-containerDeck" style="text-align: center; display: inline-block; width: 100%;">
                      <div class="Knight-Rider-loader animate">
                      <div class="Knight-Rider-bar"></div>
                      <div class="Knight-Rider-bar"></div>
                      <div class="Knight-Rider-bar"></div>
                    </div>
                  </div>
                  <div style="width: 500px; text-align: left;" id="likes">
                  <?PHP
                  $c=0;
		  foreach($feed_array as $item){
	            if($item!=''){
                      if($feed_array[$c][4]=="facebook" && $feed_array[$c][9]==""){
                      ?>
                        <div style="background: url('images/palomita.png') no-repeat center center / 0px 0px transparent; display: inline-block;" id="li<?PHP echo $c; ?>">
                          <img onerror="this.src='images/logo-bamboostr.png'" title="<?PHP echo $feed_array[$c][5]; ?>" alt="<?PHP echo $feed_array[$c][5]; ?>" id="imgLi<?PHP echo $c; ?>" onclick="agregarADeckFa('<?PHP echo $feed_array[$c][6]; ?>','imgLi<?PHP echo $c; ?>','<?PHP echo $feed_array[$c][5]; ?>','<?PHP echo $c; ?>');" src="<?PHP echo $feed_array[$c][7]; ?>" style="cursor: pointer; width: 3em;">
                        </div>
                      <?PHP
                      }
                    }
                    $c++;
                  }
                  ?>
                    <div style="padding-top: 1em; text-align: center;">
                      <button onclick="mandarLike();" type="button" class="btn btn-success"><?PHP echo $txt["txt186"]; ?></button>
                    </div>
                  </div>
                  <div style="width: 500px; text-align: left;" id="retweets">
                  <?PHP
                  $c=0;
		  foreach($feed_array as $item){
	            if($item!=''){
                      if($feed_array[$c][4]=="twitter"){
                      ?>
                        <div style="background: url('images/palomita.png') no-repeat center center / 0px 0px transparent; display: inline-block;" id="re<?PHP echo $c; ?>">
                          <img onerror="this.src='images/logo-bamboostr.png'" title="<?PHP echo $feed_array[$c][5]; ?>" alt="<?PHP echo $feed_array[$c][5]; ?>" id="imgRe<?PHP echo $c; ?>" onclick="agregarADeck('<?PHP echo $feed_array[$c][6]; ?>','imgRe<?PHP echo $c; ?>','<?PHP echo $feed_array[$c][5]; ?>','<?PHP echo $c; ?>');" src="<?PHP echo $feed_array[$c][7]; ?>" style="cursor: pointer; width: 3em;">
                        </div>
                      <?PHP
                      }
                  }
                  $c++;
           }
                  ?>
                    <div style="padding-top: 1em; text-align: center;">
                      <button onclick="mandarRetweet();" type="button" class="btn btn-success"><?PHP echo $txt["txt187"]; ?></button>
                    </div>
                  </div>
                  <div style="width: 500px; text-align: left;" id="favorites">
                  <?PHP
                  $c=0;
		  foreach($feed_array as $item){
	            if($item!=''){
                      if($feed_array[$c][4]=="twitter"){
                      ?>
                        <div style="background: url('images/palomita.png') no-repeat center center / 0px 0px transparent; display: inline-block;" id="fav<?PHP echo $c; ?>">
                          <img onerror="this.src='images/logo-bamboostr.png'" title="<?PHP echo $feed_array[$c][5]; ?>" alt="<?PHP echo $feed_array[$c][5]; ?>" id="imgFav<?PHP echo $c; ?>" onclick="agregarADeck('<?PHP echo $feed_array[$c][6]; ?>','imgFav<?PHP echo $c; ?>','<?PHP echo $feed_array[$c][5]; ?>','<?PHP echo $c; ?>');" src="<?PHP echo $feed_array[$c][7]; ?>" style="cursor: pointer; width: 3em;">
                        </div>
                      <?PHP
                      }
                    }
                    $c++;
                  }
                  ?>
                    <div style="padding-top: 1em; text-align: center;">
                      <button onclick="mandarFavorito();" type="button" class="btn btn-success" type="button"><?PHP echo $txt["txt185"]; ?></button>
                    </div>
                  </div>
                  <?PHP include 'notificaciones.php' ?>
                </td>
              </tr>
            </table></td>
        </tr>
      </table>
    </center>
  </div>
</div>
</body>
</html><?PHP
} else {
  include 'error.html';
}?>