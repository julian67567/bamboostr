//cuando quieres actualizar el plan de un admin y se actualizen todos los admins
<?PHP
include 'conexioni.php';
$query = $conn->query("SELECT * FROM token WHERE 1 order by id");
while($row=$query->fetch_assoc()){
  echo "".$row["screen_name"]." ".$row["id"]." ".$row["identify"]." ".$row["tipo"]."<br />";
  $conn->query("UPDATE grupos SET tipo='".$row["tipo"]."' WHERE id_token='".$row["id"]."' AND grupo='".$row["identify"]."'");
  
}
?>