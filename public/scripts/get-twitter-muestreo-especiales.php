<?PHP
/**************************************************************************/
/************************Seguidores Estadísticas***************************/
/**********sinImagenPerfil, inactivas, bots, verificadas, protected********/
/**************************************************************************/
ini_set('max_execution_time', 900000);
include '../../conexioni.php';
include '../../scripts/funciones.php';
$identify=$argv[1];
$red=$argv[2];
$query=$conn->query("SELECT screen_name FROM token
		     WHERE identify='".$identify."' AND red='".$red."'");
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
	$archivo = fopen("../usuarios/".$screen_name."/muestreo.txt", "rb");
	$muestras = stream_get_contents($archivo);
	$muestras_array = explode("\n",$muestras);
	fclose($archivo);
	
	$grupo_cont_prot = 0;
	$grupo_cont_veri = 0;
	$grupo_cont_image = 0;
	$grupo_cont_inactivas = 0;
	$grupo_cont_bots = 0;
	
	foreach($muestras_array as $item2){
	
	  $muestras_array2 = explode("|",$item2);
	
	  if($muestras_array2[3]==1){
	    $grupo_cont_prot++;
	  }
	  if($muestras_array2[4]==1){
	    $grupo_cont_veri++;
	  }
	  if(strtotime($muestras_array2[7])<=strtotime('now -90 Days')){
		$grupo_cont_inactivas++;
	  }
	  if(strpos($muestras_array2[6],"default_profile_")!==false){
	    $grupo_cont_image=$grupo_cont_image+1;
            if($muestras_array2[8]<=10){
              //followers
              if($muestras_array2[9]<=2000){
                //following
                if(strtotime($muestras_array2[7])<=strtotime('now -180 Days')){
                  $grupo_cont_bots++;
                }
              }
            }
	  }
	} //fin for each
	
	$obj = new stdclass();
	$obj->sinImagenPerfil->cont = $grupo_cont_image;
	$obj->inactivas->cont = $grupo_cont_inactivas;
	$obj->bots->cont = $grupo_cont_bots;
	$obj->protected->cont = $grupo_cont_prot;
	$obj->verified->cont = $grupo_cont_veri;

	//Sin Imágen de perfil
	//echo 'Sin Imagen de Perfil Contador '.$grupo_cont_image.'<br />';
	//echo '<br />';
	//imprime usuario Protected
	//echo 'Protected: TRUE Contador '.$grupo_cont_prot.'<br />';
	//echo '<br />';
	
	//imprime usuario Verified When true, indicates that the user has a verified account
	//echo 'Verified: TRUE Contador '.$grupo_cont_veri.'<br />';
	//echo '<br />';

	
    echo json_encode($obj);

}

?>