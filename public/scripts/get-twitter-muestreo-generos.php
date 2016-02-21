<?PHP
/******************************************************************************/
/********************************Seguidores************************************/
/**************************Géneros Estadísticas********************************/
/******************************************************************************/
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

    $archivo = fopen("../usuarios/".$screen_name."/muestreo.txt", "w+");
	foreach($muestras_array as $item2){
	  $hombresBan = 0;
	  $mujeresBan = 0;
	  $muestras_array2 = explode("|",$item2);
	  if(!$muestras_array2[12]){
		/*si no hay gender que calcule*/
	    $nombre_tw="";
	    $nombre_tw = "".strtoupper(quitar_acentos(quitar_espacios_extras(sanear_string_con_espacios(quitarHtml(utf8_decode($muestras_array2[5]))))))."";
		$partirNombre_tw = explode(" ",$nombre_tw);
	    if($nombre_tw!="" && $nombre_tw){
		  foreach($hombres as $hombres2){
			foreach($partirNombre_tw as $dsfdsf34){
		      if($hombres2==$dsfdsf34 && $hombresBan==0){
                //echo 'Hombre: '.$nombre_tw.' -> '.$dsfdsf34.' contH: '.$hombresBan.' contM: '.$mujeresBan.'|';
			    $hombresBan++;
			    break;
			  }
			}/*fin foreach*/
	      }/*fin foreach*/

		  foreach($mujeres as $mujeres2){
	        foreach($partirNombre_tw as $dsfdsf34){
		      if($mujeres2==$dsfdsf34 && $mujeresBan==0){
                //echo 'Mujer: '.$nombre_tw.' -> '.$dsfdsf34.' contH: '.$hombresBan.' contM: '.$mujeresBan.'|';
			    $mujeresBan++;
			    break;
			  }
			}/*fin foreach*/
		  }
		  if($hombresBan==1 && $mujeresBan==0){
			$hombresCont++;
		    fwrite($archivo, ''.$item2.'hombre'.PHP_EOL.'');
		  }
		  if($mujeresBan==1 && $hombresBan==0){
			$mujeresCont++;
		    fwrite($archivo, ''.$item2.'mujer'.PHP_EOL.'');
		  }
		  /*Ingresa al usuario en la BD si no es hombre ni mujer*/
		  if($mujeresBan==0 && $hombresBan==0){
		    fwrite($archivo, ''.$item2.'no'.PHP_EOL.'');
		  }
		  if($mujeresBan==1 && $hombresBan==1){
		    fwrite($archivo, ''.$item2.'doblegenero'.PHP_EOL.'');
		  }
	    } else {
         fwrite($archivo, ''.$item2.'no'.PHP_EOL.'');
	    }/*Fin if */
	  } else {
		/*si hay gender no calcula pero hay que contar*/
		if($muestras_array2[12]=="hombre"){
	      $hombresCont++;
		}
		if($muestras_array2[12]=="mujer"){
	      $mujeresCont++;
		}
		fwrite($archivo, ''.$item2.''.PHP_EOL.'');
	  }/*Fin if detect gender*/
	} /*fin for each*/
	
        //fclose($archivo);

	$porGH =  ($hombresCont/($hombresCont+$mujeresCont))*100;
	$porGM =  ($mujeresCont/($hombresCont+$mujeresCont))*100;
	
	//echo '<br />'.date("H:i").' Hombres: '.$porGH.' Mujeres: '.$porGM.''
        $obj = new stdclass();
        $obj->hombres->cont = $porGH;
        $obj->hombresCont->cont = $hombresCont;
        $obj->mujeres->cont = $porGM;
        $obj->mujeresCont->cont = $mujeresCont;
                

        echo json_encode($obj);

}
?>