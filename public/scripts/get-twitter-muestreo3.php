<?PHP
ini_set('max_execution_time', 900000);
include ''.dirname(__FILE__).'/../conexioni.php';
include ''.dirname(__FILE__).'/../scripts/funciones.php';
$identify=$argv[1];
$red=$argv[2];
$query=$conn->query("SELECT screen_name FROM token
		     WHERE identify='".$identify."' AND red='".$red."'") or die(mysqli_error($conn));
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $screen_name=$row["screen_name"];
} else {
  $obj = new stdclass();
  $obj->error = "false";
  echo json_encode($obj);
}
$conn->close();

if($screen_name){
	$archivo = fopen("../usuarios/".$screen_name."/muestreo2.txt", "rb");
	$muestras = stream_get_contents($archivo);
	$muestras_array = explode("\n",$muestras);
	fclose($archivo);
	

        $grupo_ids_inactivas = array();
	$grupo_ids_bots = array();
	$grupo_ids_image = array();
	$grupo_cont_inactivas = 0;
	$grupo_cont_bots = 0;
	$grupo_cont_image = 0;
	
      foreach($muestras_array as $item2){
        if($item2 && $item2!=""){
	
	  $muestras_array2 = explode("|",$item2);


          if(strtotime($muestras_array2[7])<=strtotime('now -90 Days')){
            $grupo_cont_inactivas++;
            $grupo_ids_inactivas[] = $muestras_array2[0];
          }


	  if(strpos($muestras_array2[6],"default_profile_")!==false){
	    $grupo_cont_image=$grupo_cont_image+1;
            $grupo_ids_image[] = $muestras_array2[0];
            if($muestras_array2[8]<=10){
              //followers
              if($muestras_array2[9]<=2000){
                //following
                if(strtotime($muestras_array2[7])<=strtotime('now -180 Days')){
                  $grupo_cont_bots++;
                  $grupo_ids_bots[] = $muestras_array2[0];
                }
              }
            }
	  }
        }
      } //fin for each

        $archivo = fopen("../usuarios/".$screen_name."/inactivas.txt", "w+");
        foreach($grupo_ids_inactivas as $wetv30){
          fwrite($archivo, ''.$wetv30.''.PHP_EOL.'');
        }
        fclose($archivo);

        $archivo = fopen("../usuarios/".$screen_name."/bots.txt", "w+");
        foreach($grupo_ids_bots as $wetv30){
          fwrite($archivo, ''.$wetv30.''.PHP_EOL.'');
        }
        fclose($archivo);

        $archivo = fopen("../usuarios/".$screen_name."/image.txt", "w+");
        foreach($grupo_ids_image as $wetv30){
          fwrite($archivo, ''.$wetv30.''.PHP_EOL.'');
        }
        fclose($archivo);

        //BlackList
	$archivo = fopen("../usuarios/".$screen_name."/blacklist.txt", "rb");
	$blacklist = stream_get_contents($archivo);
	$blacklist_array = explode("\n",$blacklist);
	fclose($archivo);
	
        $obj = new stdclass();
        $obj->sinImagenPerfil->cont = $grupo_cont_image;
        $obj->inactivas->cont = $grupo_cont_inactivas;
        $obj->bots->cont = $grupo_cont_bots;
        $obj->blacklist = count($blacklist_array)-1;
	
        echo json_encode($obj);

}

?>