<?PHP
$url = $_GET["url"];
$id_token = $_GET["id_token"];
include '../conexioni.php';
$obj = new stdclass();
if( (strpos($url,"http://")!==false || strpos($url,"https://")!==false || strpos($url,"www.")!==false) && strpos($url,".")!==false && strlen($url)>6){
  do { 
          $c=0;
          $shrink="";
	  while($c<6){
	    $x=rand(0,2);
	    if($x==0)
	      $shrink = ''.$shrink.''.rand(0,9).'';
	    if($x==1){
	      $n=rand(1,23);
	      if($n==1){
	        $shrink = ''.$shrink.'a';
	      }
	      if($n==2){
	        $shrink = ''.$shrink.'b';
	      }
	      if($n==3){
	        $shrink = ''.$shrink.'c';
	      }
	      if($n==4){
	        $shrink = ''.$shrink.'d';
	      }
	      if($n==5){
	        $shrink = ''.$shrink.'e';
	      }
	      if($n==6){
	        $shrink = ''.$shrink.'f';
	      }
	      if($n==7){
	        $shrink = ''.$shrink.'g';
	      }
	      if($n==8){
	        $shrink = ''.$shrink.'h';
	      }
	      if($n==9){
	        $shrink = ''.$shrink.'i';
	      }
	      if($n==10){
	        $shrink = ''.$shrink.'j';
	      }
	      if($n==11){
	        $shrink = ''.$shrink.'k';
	      }
	      if($n==12){
	        $shrink = ''.$shrink.'l';
	      }
	      if($n==13){
	        $shrink = ''.$shrink.'m';
	      }
	      if($n==14){
	        $shrink = ''.$shrink.'n';
	      }
	      if($n==15){
	        $shrink = ''.$shrink.'o';
	      }
	      if($n==16){
	        $shrink = ''.$shrink.'p';
	      }
	      if($n==17){
	        $shrink = ''.$shrink.'q';
	      }
	      if($n==18){
	        $shrink = ''.$shrink.'r';
	      }
	      if($n==19){
	        $shrink = ''.$shrink.'s';
	      }
	      if($n==20){
	        $shrink = ''.$shrink.'t';
	      }
	      if($n==21){
	        $shrink = ''.$shrink.'u';
	      }
	      if($n==22){
	        $shrink = ''.$shrink.'v';
	      }
	      if($n==23){
	        $shrink = ''.$shrink.'w';
	      }
	      if($n==24){
	        $shrink = ''.$shrink.'x';
	      }
	      if($n==25){
	        $shrink = ''.$shrink.'y';
	      }
	      if($n==26){
	        $shrink = ''.$shrink.'z';
	      }
	    }
	    if($x==2){
	      $n=rand(1,23);
	      if($n==1){
	        $shrink = ''.$shrink.'A';
	      }
	      if($n==2){
	        $shrink = ''.$shrink.'B';
	      }
	      if($n==3){
	        $shrink = ''.$shrink.'C';
	      }
	      if($n==4){
	        $shrink = ''.$shrink.'D';
	      }
	      if($n==5){
	        $shrink = ''.$shrink.'E';
	      }
	      if($n==6){
	        $shrink = ''.$shrink.'F';
	      }
	      if($n==7){
	        $shrink = ''.$shrink.'G';
	      }
	      if($n==8){
	        $shrink = ''.$shrink.'H';
	      }
	      if($n==9){
	        $shrink = ''.$shrink.'I';
	      }
	      if($n==10){
	        $shrink = ''.$shrink.'J';
	      }
	      if($n==11){
	        $shrink = ''.$shrink.'K';
	      }
	      if($n==12){
	        $shrink = ''.$shrink.'L';
	      }
	      if($n==13){
	        $shrink = ''.$shrink.'M';
	      }
	      if($n==14){
	        $shrink = ''.$shrink.'N';
	      }
	      if($n==15){
	        $shrink = ''.$shrink.'O';
	      }
	      if($n==16){
	        $shrink = ''.$shrink.'P';
	      }
	      if($n==17){
	        $shrink = ''.$shrink.'Q';
	      }
	      if($n==18){
	        $shrink = ''.$shrink.'R';
	      }
	      if($n==19){
	        $shrink = ''.$shrink.'S';
	      }
	      if($n==20){
	        $shrink = ''.$shrink.'T';
	      }
	      if($n==21){
	        $shrink = ''.$shrink.'U';
	      }
	      if($n==22){
	        $shrink = ''.$shrink.'V';
	      }
	      if($n==23){
	        $shrink = ''.$shrink.'W';
	      }
	      if($n==24){
	        $shrink = ''.$shrink.'X';
	      }
	      if($n==25){
	        $shrink = ''.$shrink.'Y';
	      }
	      if($n==26){
	        $shrink = ''.$shrink.'Z';
	      }
	    }
	    $c++;
	  }//fin while
	  
    $query = $conn->query("SELECT id FROM acortador WHERE shrink COLLATE utf8_bin='".$shrink."'");
    if($query->num_rows>0){
      $repetir=1;
    } else {
      $repetir=0;
    }
  }
  while($repetir==1); // fin do while
  $conn->query("INSERT INTO acortador (url,shrink,id_token) VALUES ('".$url."','".$shrink."','".$id_token."')");
  $obj->shrink = $shrink;
  echo json_encode($obj);
} else {
  $obj->error = "Error no es una URL";
  echo json_encode($obj);
}
?>