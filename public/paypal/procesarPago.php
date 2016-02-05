<?PHP

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;

session_start();

$id_token = $_SESSION["id_token"];
$facturacion = $_GET["facturacion"];
$plan = $_GET["plan"];

include("../conexioni.php");

if($plan==1){
  $letra = "basic";
} else if($plan==2){
  $letra = "professional";
} else if($plan==3){
  $letra = "enterprise";
}
if($facturacion==1){
  $letra = "".$letra."A";
} else {
  $letra = "".$letra."M";
}
$query = $conn->query("SELECT * FROM conf WHERE valor='".$letra."'");
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $obj = new stdclass();
  $obj->pago = $row["valor2"];
} else {
  $obj = new stdclass();
  $obj->errors = "false";
  echo json_encode($obj);
}

require_once 'autoload.php';
require_once 'config.php';

$apiContext = new ApiContext(new OAuthTokenCredential(
		$clientPayPal,$secretPayPal
));

$apiContext->setConfig(array(
        'mode' => 'sandbox',
	'http.ConnectionTimeOut' => 30,
	'http.Retry' => 1,
	'log.LogEnabled' => false,
	'log.FileName' => '../PayPal.log',
	'log.LogLevel' => 'INFO'		
));

$payer = new Payer();
$details = new Details();
$amount = new Amount();
$transaction = new Transaction();
$payment = new Payment();
$redirectUrls = new RedirectUrls();

//Payer
$payer->setPaymentMethod('paypal');

//Details
$details->setShipping('0.00')
        ->setTax('0.00')
        ->setSubtotal(''.$obj->pago.'');

//Amount
$amount->setCurrency('USD')
       ->setTotal(''.$obj->pago.'')
       ->setDetails($details);

//Transaction
$transaction->setAmount($amount)
            ->setDescription('Bamboostr '.substr($letra,0,strlen($letra)-1).'');

//Payment
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions([$transaction]);

//RedirectUrls
$redirectUrls->setReturnUrl('http://'.$_SERVER['HTTP_HOST'].'/paypal/guardarPago.php?paypal=success')
             ->setCancelUrl('http://'.$_SERVER['HTTP_HOST'].'/paypal/guardarPago.php?paypal=error');

$payment->setRedirectUrls($redirectUrls);

try {

  $payment->create($apiContext);
  //Generate and store hash
  //prepare and execute transaction storage

  $hash = md5($payment->getId());
  $_SESSION["paypal_hash"] = $hash;
  $conn->query("INSERT INTO pagos (id_token,payment_id,hash,complete) VALUES ('".$id_token."','".$payment->getId()."','".$hash."',0)");

} catch (PPConnectionException $e) {
  header('Location: http://'.$_SERVER['HTTP_HOST'].'/account?paypal=error');
}

foreach($payment->getLinks() as $link){
  if($link->getRel()=='approval_url'){
    $redirectUrl = $link->getHref();
  }
}

header('Location: '.$redirectUrl.'');
?>