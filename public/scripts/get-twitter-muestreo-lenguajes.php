<?PHP
/**************************************************************************/
/************************Seguidores Estadísticas***************************/
/*******************************lenguajes**********************************/
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
	
	$grupo_cont_lang = array();
	$grupo_name_lang = array();
	
	foreach($muestras_array as $item2){
	
	  $muestras_array2 = explode("|",$item2);
	
	  if(!isset($grupo_cont_lang["".$muestras_array2[1].""])){
	    $grupo_cont_lang["".$muestras_array2[1].""] = 1;
	    $grupo_name_lang[] = $muestras_array2[1];
	  } else {
	    $grupo_cont_lang["".$muestras_array2[1].""] = $grupo_cont_lang["".$muestras_array2[1].""] + 1;
	  }
	} //fin for each
	
	//imprimir banderas
    $contB = 0;
    $arreglo_json = array();
	foreach($grupo_name_lang as &$item2){
		if($item2!=""){
			//echo 'Idioma: '.$item2.' Contador '.$grupo_cont_lang[$item2].'<br />';
	
			$obj2 = new stdclass();
			$obj2->idioma = $item2;
			$obj2->cont = $grupo_cont_lang[$item2];
	
			$arreglo_json[$contB] = new stdclass();
			$arreglo_json[$contB] = $obj2;
			$contB++;
		  }
	}
    $obj->idioma = $arreglo_json;
	//echo '<br />';
	
	
    echo json_encode($obj);

}

?>