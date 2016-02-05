<?PHP
include '../conexioni.php';
$identify=$_GET["identify"];
$id_token=$_GET["id_token"];
$idPost = $_GET["idPost"];
$messages=$_GET["messages"];
$images=$_GET["images"];
$description=preg_replace("/'/","",$_GET["description"]);
$link=$_GET["link"];
$name=$_GET["screen_name"];
$fecha=$_GET["fecha"];
$red=$_GET["red"];
$horario=$_GET["horario"];
$image_profile=$_GET["image_profile"];
$query=$conn->query("INSERT INTO drafts 
					(id_token,name,identify,id_post,mensaje,images,link,fecha,red,horario,image_profile) VALUES 
					('".$id_token."','".$name."','".$identify."','".$idPost."','".$description."','".$images."','".$link."','".$fecha."','".$red."','".$horario."','".$image_profile."')");
$conn->close();
?>