<?PHP
$c=0;
while($c!=12){
?>
    $('#tableSys<?PHP echo $c; ?>').click(function(){
      <?PHP
        if($c==1){
          ?>window.location = "/system";<?PHP
        }
        else if($c==2){
        ?>window.location = "/statistics";<?PHP
        }
        else if($c==3){
        ?>window.location = "/share";<?PHP
        }
        else if($c==4){
        ?>window.location = "/tools";<?PHP
        }
        else if($c==5){
        ?>window.location = "/crm";<?PHP
        }
        else if($c==10 && $redSocial=="no"){
            ?>window.location = "twitter/clearsessions.php";<?PHP
        }
        else if($c==10 && $redSocial=="twitter"){
            ?>window.location = "twitter/clearsessions.php";<?PHP
        }
        else if($c==10 && $redSocial=="facebook"){
            ?>window.location = "facebook/clearsessions.php?access_token=<?PHP echo $_SESSION['access_token'] ?>&redirect=1";<?PHP
        }
        else if($c==11){
            ?>window.location = "https://www.mercadopago.com/mlm/debits/new?preapproval_plan_id=4a535e7b68be493ba1732ef2fab2e0d2";<?PHP
        }
        else{
            ?>toastr["info"](txt143);<?PHP
        }
      ?>
    });
<?PHP
    $c++;
}
?>
$('#logOut123').click(function(){
  <?PHP
        if($redSocial=="twitter"){
          ?>window.location = "twitter/clearsessions.php";<?PHP
        } else if($redSocial=="facebook"){
          ?>window.location = "facebook/clearsessions.php?access_token=<?PHP echo $_SESSION['access_token'] ?>&redirect=1";<?PHP
        }
  ?>
});