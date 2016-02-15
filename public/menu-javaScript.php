<?PHP
$c=0;
while($c!=12){
?>
    $('#tableSys<?PHP echo $c; ?>').click(function(){
      <?PHP
        if($c==1){
          ?>
            ga('send', 'event', 'Menu Izquierdo System', 'click', 'Menu Izquierdo System');
            window.location = "system.php";
          <?PHP
        } else if($c==2){
          ?>
            ga('send', 'event', 'Menu Izquierdo Escribir', 'click', 'Menu Izquierdo Escribir');
            window.location = "escribir.php";
          <?PHP
        } else if($c==3){
          ?>
            ga('send', 'event', 'Menu Izquierdo Calendario', 'click', 'Menu Izquierdo Calendario');
            window.location = "calendario.php";
          <?PHP
        } else if($c==4){
          ?>
            ga('send', 'event', 'Menu Izquierdo Responder', 'click', 'Menu Izquierdo Responder');
            window.location = "responder.php";
          <?PHP
        } else if($c==5){
          ?>
            ga('send', 'event', 'Menu Izquierdo Crm', 'click', 'Menu Izquierdo Crm');
            window.location = "/crm";
          <?PHP
        } else if($c==8){
          ?>
            ga('send', 'event', 'Menu Izquierdo Ayuda', 'click', 'Menu Izquierdo Ayuda');
            window.location = "ayuda.php";
          <?PHP
        }  else if($c==10 && $redSocial=="no"){
          ?>
            ga('send', 'event', 'Menu Izquierdo Salir', 'click', 'Menu Izquierdo Salir');
            window.location = "twitter/clearsessions.php";
          <?PHP
        } else if($c==10 && $redSocial=="twitter"){
           ?>
             ga('send', 'event', 'Menu Izquierdo Salir', 'click', 'Menu Izquierdo Salir');
             window.location = "twitter/clearsessions.php";
           <?PHP
        } else if($c==10 && $redSocial=="facebook"){
          ?>
            ga('send', 'event', 'Menu Izquierdo Salir', 'click', 'Menu Izquierdo Salir');
            window.location = "facebook/clearsessions.php?access_token=<?PHP echo $_SESSION['access_token'] ?>&redirect=1";
          <?PHP
        } else if($c==11){
          ?>
            ga('send', 'event', 'Menu Izquierdo Pago', 'click', 'Menu Izquierdo Pago');
            window.location = "https://www.mercadopago.com/mlm/debits/new?preapproval_plan_id=4a535e7b68be493ba1732ef2fab2e0d2";
          <?PHP
        } else {
          ?>toastr["info"](txt143);<?PHP
        }
      ?>
    });
<?PHP
    $c++;
}
?>