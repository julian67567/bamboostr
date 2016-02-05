<?PHP
ini_set('max_execution_time', 9000);
include 'conexioni.php';
$query = $conn->query("SELECT tipo,identify,id,screen_name,DM FROM token WHERE automatize='1' order by id");
if($query->num_rows>0){
  $c=0;
  while($row=$query->fetch_assoc()){
    $tipo[$c] = $row["tipo"];
    $query2=$conn->query("SELECT tipo FROM grupos WHERE user='".$row["identify"]."'");
    while($row2=$query2->fetch_assoc()){
      if($tipo[$c]=="" && $row2["tipo"]=="basic")
        $tipo[$c]="basic";
      if(($tipo[$c]=="" || $tipo[$c]=="basic") && $row2["tipo"]=="pro")
        $tipo[$c]="pro";
      if(($tipo[$c]=="" || $tipo[$c]=="basic" || $tipo[$c]=="pro") && $row2["tipo"]=="ent")
        $tipo[$c]="ent";
    }
    if($tipo[$c]=="ent"){
      $ids[]=$row["id"];
      $users[]=$row["screen_name"];
      $content[]=$row["DM"];
      echo "".$row["screen_name"]." ".$tipo[$c]."<br />";
    }
    $c++;
  }
  $conn->close();
  $c=0;
  foreach($users as &$item){
	unset($cadena);
	$url='http://bamboostr.com/twitter/get-new-followers-arroba.php?screen_name='.$item.'';
	//abrimos la url y que la lea que contiene
	$fo= fopen($url,"r") or die ("false");
	while (!feof($fo)) {
		$cadena .= fgets($fo, 5000);
	}
	if (!file_exists("usuarios/".$item.""))
	   mkdir("usuarios/".$item."", 0777);
	if (!file_exists("usuarios/".$item."/dm.txt")){
	  //Creacion del archivo de datos nuevo
	  $archivo = fopen("usuarios/".$item."/dm.txt", "w+");
	  unset($twitter_users);
	  $twitter_users=explode("@",$cadena);
	  foreach($twitter_users as &$item2){
	    if($item2!=""){
		  //mandar DM $item2
		  $url2='http://bamboostr.com/twitter/post-dm.php?screen_name='.$item.'&txt='.rawurlencode(utf8_encode($content[$c])).'&dm_name='.$item2.'';
		  fopen($url2,"r") or die ("false");
	      fwrite($archivo, "@".$item2."");
		}
	  }
	  fclose($archivo);
	}
	else{
	  $archivo = fopen("usuarios/".$item."/dm.txt", "r");
	  unset($contenido);
	  unset($twitter_users_2);
	  unset($twitter_users);
	  $contenido = fread($archivo, filesize("usuarios/".$item."/dm.txt"));
	  fclose($archivo);
	  $archivo = fopen("usuarios/".$item."/dm.txt", "a+");
	  $twitter_users_2=explode("@",$contenido); 
	  $twitter_users=explode("@",$cadena); 
	  unset($arrB);
	  $arrB = array();
	  foreach($twitter_users_2 as &$key) 
	    $arrB[$key] = 1;
	  foreach($twitter_users as &$item2){
	    //Performance in_array por hash
		//if(!in_array($item2, $twitter_users_2)){
		if(!isset($arrB[$item2])){
		  //mandar DM $item2
		  $url2='http://bamboostr.com/twitter/post-dm.php?screen_name='.$item.'&txt='.rawurlencode(utf8_encode($content[$c])).'&dm_name='.$item2.'';
		  fopen($url2,"r") or die ("false");
          fwrite($archivo, "@".$item2."");
		}
	  }
	  fclose($archivo);
	}
	$c++;
  }
  $ewr3=0;
  foreach($users as &$item){
    echo ''.($ewr3+1).' '.$ids[$ewr3].' '.$item.'<br />';
    $ewr3++;
  }
} else {
  $conn->close();
  echo "false";
}
?>