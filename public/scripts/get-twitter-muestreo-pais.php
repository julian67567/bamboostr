<?PHP
/**************************************************************************/
/************************Seguidores Estadísticas***************************/
/********************************país**************************************/
/**************************************************************************/
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
	$archivo = fopen("../usuarios/".$screen_name."/muestreo.txt", "rb");
	$muestras = stream_get_contents($archivo);
	$muestras_array = explode("\n",$muestras);
	fclose($archivo);
	
	$grupo_cont_loca = array();
	$grupo_name_loca = array();
	
	foreach($muestras_array as $item2){
	
	  $muestras_array2 = explode("|",$item2);
	
	  if(!isset($grupo_cont_loca["".obtenerPais(utf8_decode($muestras_array2[2])).""])){
	    $grupo_cont_loca["".obtenerPais(utf8_decode($muestras_array2[2])).""] = 1;
	    $grupo_name_loca[] = obtenerPais(utf8_decode($muestras_array2[2]));
	  } else {
	    $grupo_cont_loca["".obtenerPais(utf8_decode($muestras_array2[2])).""] = $grupo_cont_loca["".obtenerPais(utf8_decode($muestras_array2[2])).""] + 1;
	  }
	} //fin for each
	
	//imprime localizacion
    $contB = 0;
    $arreglo_json = array();
	foreach($grupo_name_loca as &$item2){
          if($item2!=""){
	         //echo 'Location: '.$item2.' Contador '.$grupo_cont_loca[$item2].'<br />';

            $obj2 = new stdclass();
            $obj2->pais = $item2;
            $obj2->cont = $grupo_cont_loca[$item2];

            $arreglo_json[$contB] = new stdclass();
            $arreglo_json[$contB] = $obj2;
            $contB++;
          }
	}
    $obj->location = $arreglo_json;
	
    echo json_encode($obj);

}

?>