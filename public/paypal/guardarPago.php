<?PHP

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

include '../conexioni.php';
session_start();
require_once 'autoload.php';
require_once 'config.php';

$apiContext = new ApiContext(new OAuthTokenCredential(
		$clientPayPal,$secretPayPal
));
if(isset($_GET["paypal"])){
  if($_GET["paypal"]=="success"){
    $payerId = $_GET["PayerID"];

    $query = $conn->query("SELECT payment_id FROM pagos WHERE hash='".$_SESSION["paypal_hash"]."'");
    $row=$query->fetch_assoc();
    //get paypal payment
    $payment = Payment::get($row["payment_id"], $apiContext);
    $execution = new PaymentExecution();
    $execution->setPayerId($payerId);
    //execute paypal payment charge
    $payment->execute($execution, $apiContext);
    unset($_SESSION["paypal_hash"]);
    //update to payment to complete
    //update id_token to the package
        

    header('Location: http://'.$_SERVER['HTTP_HOST'].'/account?paypal=success');
    die();
  } else {
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/account?paypal=error');
    die();
  }
} else {
  header('Location: http://'.$_SERVER['HTTP_HOST'].'/account?paypal=error');
  die();
}
?>