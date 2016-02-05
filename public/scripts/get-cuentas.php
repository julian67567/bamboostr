<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
$id_token = $_GET["id_token"];
$identify = $_GET["identify"];
$query=$conn->query("SELECT social_networks,red FROM token WHERE id='".$id_token."'") OR DIE(mysqli_error($conn));
$row=$query->fetch_assoc();
$social_networks=$row["social_networks"];
$red=$row["red"];
$redSocial = $red;
$social_networks_parts=explode(",",$social_networks);
$c=0;
//fan pages while para sacar las fan pages de todas tus cuentas facebook secundarias
$query2=$conn->query("SELECT id,tipo,perms,admin,red,name,identify,identify_account,activation FROM social_share 
                            WHERE id_token='".$id_token."'") OR DIE(mysqli_error($conn));
unset($row2);					 
if($query2->num_rows>0){
  while($row2=$query2->fetch_assoc()){
    if(strpos($row2["perms"],"CREATE_CONTENT") || strpos($row2["perms"],"CREATE_ADS") || strpos($row2["perms"],"BASIC_ADMIN") || $row2["admin"]==1 && ($row2["tipo"]=="grupo" || $row2["tipo"]=="page")){
                        $feed_array_escribir[$c][0]=$row2["id"];
        $feed_array_escribir[$c][1]=$row2["red"];
        $feed_array_escribir[$c][2]=str_replace('|', '', $row2["name"]);
        $feed_array_escribir[$c][2]=str_replace('"', '',$feed_array_escribir[$c][2]);
        if($row2["tipo"]=="grupo"){
                $feed_array_escribir[$c][3]="images/grupos-facebook.png";
            $feed_array_escribir[$c][9]="grupo";
        } else {
            $feed_array_escribir[$c][3]="images/fan-page.png";
            $feed_array_escribir[$c][9]="page";
        }
        $feed_array_escribir[$c][7]=$row2["identify"];
        $feed_array_escribir[$c][8]=$row2["identify_account"];
        $feed_array_escribir[$c][10]=$row2["activation"];
        $feed_array_escribir[$c][11]="";
        $feed_array_escribir[$c][12]=$row2["id"];
        $c++;
    }/*fin if perms*/
  }/*fin while*/
}/*fin num_rows*/
/*fin fanpage*/
if($redSocial=="no"){
  $entrafw434 = 0;    
} else {
  $entrafw434 = 1;   
}
foreach($social_networks_parts as &$item){
  if($item!=""){
	  if(($c==0 || $entrafw434==1) && ($redSocial!="no" || $entrafw434==1)){
            $query2=$conn->query("SELECT ssid,id,red,screen_name_bamboostr,foto,oauth_token,oauth_token_secret,access_token,identify FROM token 
                                        WHERE identify='".substr($item,2,strlen($item))."' AND red='".$red."'") OR DIE(mysqli_error($conn));
            $row2=$query2->fetch_assoc();
            if($row2["ssid"]!=""){
                $id_token=$row2["id"];
                $feed_array_escribir[$c][1]=$row2["red"];
                $feed_array_escribir[$c][2]=str_replace('|', '',$row2["screen_name_bamboostr"]);
                $feed_array_escribir[$c][2]=str_replace('"', '',$feed_array_escribir[$c][2]);
                $feed_array_escribir[$c][3]=$row2["foto"];
                if($row2["red"]=="twitter"){
                $feed_array_escribir[$c][4]=$row2["oauth_token"];
                $feed_array_escribir[$c][5]=$row2["oauth_token_secret"];
                } else {
                $feed_array_escribir[$c][4]=$row2["access_token"];
                }
                $feed_array_escribir[$c][7]=$row2["identify"];
                $feed_array_escribir[$c][9]="cuenta";
                $feed_array_escribir[$c][10]=1;
                $feed_array_escribir[$c][11]=$item;
                $c++;
            }/*fin if ssid*/
            $entrafw434 = 0;
	  } else {
		  $query2=$conn->query("SELECT tok.id,tok.red,tok.foto,tok.screen_name_bamboostr,tok.oauth_token,tok.oauth_token_secret,tok.access_token,tok.identify 
							   FROM token AS tok INNER JOIN grupos AS gr 
							   ON  tok.identify='".substr($item,2,strlen($item))."'
							   AND tok.social_networks like ('%".$item."%')
							   AND gr.grupo='".$identify."'
							   AND gr.user='".substr($item,2,strlen($item))."'
							   AND gr.id_token='".$id_token."'") OR DIE(mysqli_error($conn));
		  unset($row2);					 
		  $row2=$query2->fetch_assoc();
		  $id_token2=$row2["id"];
		  $feed_array_escribir[$c][1]=$row2["red"];
		  $feed_array_escribir[$c][2]=str_replace('|', '',$row2["screen_name_bamboostr"]);
		  $feed_array_escribir[$c][2]=str_replace('"', '',$feed_array_escribir[$c][2]);
		  $feed_array_escribir[$c][3]=$row2["foto"];
		  if($row2["red"]=="twitter"){
		    $feed_array_escribir[$c][4]=$row2["oauth_token"];
		    $feed_array_escribir[$c][5]=$row2["oauth_token_secret"];
		  } else {
		    $feed_array_escribir[$c][4]=$row2["access_token"];
		  }
		  $feed_array_escribir[$c][7]=$row2["identify"];
		  $feed_array_escribir[$c][9]="cuenta";
                  $feed_array_escribir[$c][10]=1;
                  $feed_array_escribir[$c][11]=$item;
		  $c++;	
	  }/*fin if else $c==0 */
  }/*if $item!=0*/
}

echo json_encode($feed_array_escribir);

?>