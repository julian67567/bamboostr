<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
$identifyP=$_GET["identifyP"];
$identifyS=$_GET["identifyS"];
$identifyOther=$_GET["identifyOther"]; //no limpio
$redP=$_GET["redP"];
$redS=$_GET["redS"];
$query=$conn->query("SELECT id FROM token
				    WHERE identify='".$identifyP."' AND red='".$redP."'") or die(mysqli_error($conn));
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $id_token=$row["id"];
} else {
  echo "FALSE";
}
$c=0;
$response_array = array();
$query=$conn->query("SELECT top_tweets FROM estadisticas_".$redS."
				    WHERE identify='".$identifyS."' AND red='".$redS."' AND id_token='".$id_token."'") or die(mysqli_error($conn));
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $top_tweets_array=explode(",",$row["top_tweets"]);
  foreach($top_tweets_array as &$item){
	if($item!=""){
	  $top_tweets_array2=explode("|",$item);
	  $obj = new stdclass();
      $obj->screen_name = $top_tweets_array2[0];
	  $obj->id = $top_tweets_array2[1];
	  $obj->retweet_count = $top_tweets_array2[2];
	  $obj->mensaje = $top_tweets_array2[3];
	  $obj->fecha = $top_tweets_array2[4];
          $obj->favorite_count = $top_tweets_array2[5];
	  $response_array[$c] = new stdclass();
	  $response_array[$c] = $obj;
	}
	$c++;
  }
  $response = new stdclass();
  $response->data = $response_array;
  echo json_encode($response);
} else {
  echo "FALSE";
}
?>