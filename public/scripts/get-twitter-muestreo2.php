<?PHP
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
	

	$grupo_name_name = array();
	
	foreach($muestras_array as $item2){
	  $muestras_array2 = explode("|",$item2);
          $nombre_tw="";
          $nombre_tw = "".strtoupper(quitar_acentos(quitar_espacios_extras(sanear_string(quitarHtml(utf8_decode($muestras_array2[5]))))))."";
	  if($nombre_tw!="" && $nombre_tw){
	    $grupo_name_name[] = "".$nombre_tw."";
	  }
	} //fin for each
	
        $obj = new stdclass();
        
        unset($muestras_array);

	//hombres
	$archivo = fopen("../../generos/hombres.txt", "rb");
	$contenido_siguiendo = utf8_decode(stream_get_contents($archivo));
	$hombres = explode("\n",$contenido_siguiendo);
	fclose($archivo);
	
	//mujeres
	$archivo = fopen("../../generos/mujeres.txt", "rb");
	$contenido_siguiendo = utf8_decode(stream_get_contents($archivo));
	$mujeres = explode("\n",$contenido_siguiendo);
	fclose($archivo);	
	
	$hombresCont = 0;
	$mujeresCont = 0;



	foreach($grupo_name_name as $item2){

            foreach($hombres as $hombres2){
	      if(strpos($item2,$hombres2)!==false){
	        $hombresCont++;
	        break;
              }
            }

	    foreach($mujeres as $mujeres2){
	      if(strpos($item2,$mujeres2)!==false){
	        $mujeresCont++;
	        break;
              }
	    }
        } 

	$porGH =  ($hombresCont/($hombresCont+$mujeresCont))*100;
	$porGM =  ($mujeresCont/($hombresCont+$mujeresCont))*100;
	
	//echo '<br />'.date("H:i").' Hombres: '.$porGH.' Mujeres: '.$porGM.''

        $obj->hombres->cont = $porGH;
        $obj->mujeres->cont = $porGM;
                

        echo json_encode($obj);

}

?>