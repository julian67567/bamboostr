<?PHP
ini_set('max_execution_time', 90000000);
$categoria = $_POST["categoria"];
$lengua = $_POST["lengua"];
$categoria = 1;
$lengua = "es";
include '../conexioni.php';
include 'funciones.php';

// Change character set to utf8
mysqli_set_charset($conn,"utf8");

$query = $conn->query("SELECT id FROM rss_content ORDER BY id DESC LIMIT 1");
$row2=$query->fetch_assoc();

while($categoria<=10){
	$query = $conn->query("SELECT * FROM rss WHERE categoria='".$categoria."' AND idioma='".$lengua."' ORDER BY likes DESC");
	if($query->num_rows>0){
	  while($row=$query->fetch_assoc()){
	
		$articulos = simplexml_load_string(file_get_contents($row["url"]));
		$num_noticia=1;
		$max_noticias=2;
		foreach($articulos->channel->item as $noticia){ 
	
		  if(strlen($noticia->title)>6 && $noticia->link && strpos($noticia->link,"eleconomista")===false && strpos($noticia->link,"elfinanciero")===false && strlen(utf8_encode(strip_tags(quitar_espacios_extras($noticia->description))))>50 && $noticia->pubDate){
			$obj = new stdclass();
			$obj->id = $row["id"];
			$obj->link = utf8_encode($noticia->link);
			$obj->dominio = extraer_dominio($noticia->link); 
			if($obj->dominio=="") 
			  $obj->dominio = extraer_dominio($row["url"]);
			if(extraer_dominio($obj->link)=="")
			  $obj->link = "http://".$obj->dominio."".utf8_encode($noticia->link)."";
			$obj->title = utf8_encode(reemplazar_en_cadena("'",$noticia->title));
			//$obj->largaDesc=quitar_espacios_extras($noticia->description);
			$imagen = extraer_imagen(quitar_espacios_extras($noticia->description));
			if(strpos($row["url"],"lajornada")!==false || strpos($row["url"],"babygourmetblog")!==false || strpos($row["url"],"altonivel")!==false || strpos($row["url"],"clarin")!==false || strpos($row["url"],"elespectador")!==false || strpos($row["url"],"amigoslarevista")!==false || strpos($row["url"],"cafeparamamas")!==false || strpos($row["url"],"criarenfamilia.wordpress.com")!==false || strpos($row["url"],"biannapena")!==false || strpos($row["url"],"onmywaytravel")!==false){
			  $obj->img = $row["img"];
			}
			else if($imagen!="."){
			  $obj->img = $imagen;
			} else {
			  $obj->img = $row["img"];
			}
			if(strlen(utf8_encode(strip_tags(quitar_espacios_extras($noticia->description))))>500)
			  $obj->description = ''.substr(utf8_encode(strip_tags(quitar_espacios_extras($noticia->description))),0,500).'...';
			else
			  $obj->description = utf8_encode(strip_tags(quitar_espacios_extras($noticia->description)));
			$obj->fecha = date("D M d -0000 H:i:s Y", strtotime($noticia->pubDate));
			$conn->query("INSERT INTO rss_content (categoria,link,dominio,title,img,description,fecha,idioma) VALUES ('".$categoria."','".utf8_decode($obj->link)."','".$obj->dominio."','".utf8_decode($obj->title)."','".$obj->img."','".msword_conversion(utf8_decode($obj->description))."','".$obj->fecha."','".$lengua."')");
	
		  } 
	
		  $num_noticia++;
		  if($num_noticia > $max_noticias){
			break;
		  }
		}//fin foreach
	  }//fin while
          $conn->query("DELETE FROM rss_content WHERE categoria='".$categoria."' AND idioma='".$lengua."' AND id<'".($row2["id"]+1)."'") OR die("Error: ".mysqli_error($conn));
	} /*fin if*/
  $categoria++;
}/*fin while*/
?>