<?PHP
include ''.dirname(__FILE__).'/../../conexioni.php';
include ''.dirname(__FILE__).'/../../lenguajes/espanol.php';
$id_token = $_POST["id_token"];
$query = $conn->query("SELECT country FROM crm WHERE id_token='".$id_token."'") or die(mysqli_error($conn));
$c=1;
$response_array = array();
$obj = new stdclass();
$obj->Country = ''.$txt["txt326"].'';
$response_array[0] = new stdclass();
$response_array[0] = $obj;
if($query->num_rows>0){
  while($row=$query->fetch_assoc()){
    if($row["country"]){
      $entra=1;
      //busca que no existe el país
      for($c2=0; $c2<$c; $c2++){
        foreach($response_array[$c2] as $key => $value) {
          if($key==utf8_encode($row["country"])){
            $entra=-1;
            $auxCont = $c2;
          } 
          //print "$key => $value\n";
        }
      }//fin for
      $obj = new stdclass();
      if($entra==1){
        $obj->{''.utf8_encode($row["country"]).''} = 1;
        $response_array[$c] = new stdclass();
        $response_array[$c] = $obj;
        $c++;
      } else {
        $response_array[$auxCont]->{''.utf8_encode($row["country"]).''} = $response_array[$auxCont]->{''.utf8_encode($row["country"]).''}+1;
      }
    }//fin if
  }//fin while
  $response = new stdclass();
  $response->data = $response_array; 
  echo json_encode($response->data); 
} else {
  $obj = new stdclass();
  $obj->error = "false";
  echo json_encode($obj);
}
?>