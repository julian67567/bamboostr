<?php
include ''.dirname(__FILE__).'/config.php';
/*
$servername = "localhost";
//$username = "scrapell_112372";
//$password = "ASD0374lajdfg";
$username = "root";
$password = "";
$mydb = "scrapell_twitter";
*/

// Create connection
$conn = new mysqli($servername, $username, $password, $mydb);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: ".$conn->connect_error);
} 

?>