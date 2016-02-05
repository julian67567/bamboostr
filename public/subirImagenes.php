<?PHP
include 'scripts/funciones.php';
if($_GET["url"]){
  url_to_phpFiles("fileImage", ''.$_GET["url"].'');
  $local = $_FILES["fileImage"]["name"];
  $local_name = $_FILES["fileImage"]["name"];
  if(substr($local,-4)==".jpg" || substr($local,-4)==".gif" || substr($local,-4)==".png"){
    $subir=2;
  }
  if(substr($local,-5)==".jpeg"){
    $subir=2;
  }
} else if($_POST["base"]){
  $rand123 = rand(0,9999999999);
  url_to_phpFiles("fileImage", 'http://'.getDirUrl(1).'/bibliotecaImages/'.base64_to_jpeg($_POST["base"],"".$rand123.".jpeg").'');
  $local = $_FILES["fileImage"]["name"];
  $local_name = $_FILES["fileImage"]["name"];
  if(substr($local,-4)==".jpg" || substr($local,-4)==".gif" || substr($local,-4)==".png"){
    $subir=2;
  }
  if(substr($local,-5)==".jpeg"){
    $subir=2;
  }
} else {
  //los forms por FILE son subido al temporal y se elimina automatica al terminar el script ls -lsa /var/tmp no lo encontrarás.
  $local = $_FILES["fileImage"]["name"];
  $local_name = ''.rand(0, 9999).'-'.$_FILES["fileImage"]["name"].'';
  $local_name = preg_replace('#<#','%3C',$local_name);
  $local_name = preg_replace('#>#','%3E',$local_name);
  $local_name = preg_replace('#´#','%C2%B4',$local_name);
  $local_name = preg_replace("#'#",'"',$local_name);
  $local_name = preg_replace("#á#",'a',$local_name);
  $local_name = preg_replace("#é#",'e',$local_name);
  $local_name = preg_replace("#í#",'i',$local_name);
  $local_name = preg_replace("#ó#",'o',$local_name);
  $local_name = preg_replace("#ú#",'u',$local_name);
  $local_name = preg_replace("#ñ#",'n',$local_name);
  $local_name = preg_replace("#ü#",'u',$local_name);
  //Reemplaza carácteres especiales
  $local_name = preg_replace('/[^\da-z]/i', ' ', $local_name);
  $local_name = preg_replace("#  #", ' ', $local_name);
  $local_name = trim($local_name, ' ');
  $local_name = preg_replace('/[^\da-z]/i', '.', $local_name);
  $local_name = preg_replace("#--#", '-', $local_name);
  if(substr($local,-4)==".jpg" || substr($local,-4)==".gif" || substr($local,-4)==".png"){
    $subir=1;
  }
  if(substr($local,-5)==".jpeg"){
    $subir=1;
  }
}
$remoto = $_FILES["fileImage"]["tmp_name"];
$tama = $_FILES["fileImage"]["size"];  
//ver directorio actual
//echo getcwd();
// Verificamos si no hemos excedido el tamaño del archivo
if ($tama>=5000000){
  echo "ERROR";
} else if($subir=="1") {
	//comprueba si fue subido el archivo en temporal (método POST)
	if(!is_uploaded_file($_FILES["fileImage"]["tmp_name"])){
		echo "ERROR Archivo Temporal No existente";
	}
	//movemos del servidor original tmp to a carpeta (método POST)
	if(move_uploaded_file($remoto, ''.getcwd().'/bibliotecaImages/'.$local_name.'')){
	  echo 'http://'.getDirUrl(1).'/bibliotecaImages/'.$local_name.'';
	} else {
	  echo "ERROR El Archivo temporal no se pudo mover";
	}
} else if($subir=="2") { 
	//movemos del servidor original tmp to a carpeta
	if(file_exists($remoto) && rename($remoto, ''.getcwd().'/bibliotecaImages/'.$local_name.'')){
          if(chmod('bibliotecaImages/'.$local_name.'', 0644)){
	    echo 'http://'.getDirUrl(1).'/bibliotecaImages/'.$local_name.'';
          } else {
            echo "ERROR Permisos no concedidos";
          }
	} else {
	  echo "ERROR El Archivo temporal no se pudo mover";
	}
} else {
  echo "ERROR";
}
?>