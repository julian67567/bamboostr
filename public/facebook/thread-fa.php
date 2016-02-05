<?PHP
$identify = escapeshellarg($_GET["identify"]);
$count = escapeshellarg($_GET["count"]);
$until = escapeshellarg($_GET["until"]);
$option = escapeshellarg($_GET["option"]);
$userId = escapeshellarg($_GET["userId"]);
$userPage = escapeshellarg($_GET["userPage"]);
$search = escapeshellarg($_GET["search"]);
$type = escapeshellarg($_GET["type"]);
$id_message = escapeshellarg($_GET["id_message"]);
$message = escapeshellarg($_GET["message"]);
$identify_sender = escapeshellarg($_GET["identify_sender"]);
$i = escapeshellarg($_GET["i"]);
if($_GET["i"]!=""){
  $exec_query=exec('php-cli -f thread-get-image.php '.$identify.' '.$userId.' '.$i.' /dev/null 2>&1',$response,$exit);
} else if(strpos($option,"getMsgs")!==false || strpos($option,"getFeeds")!==false || strpos($option,"getInbox")!==false || strpos($option,"getMentions")!==false || strpos($option,"getEvents")!==false) {
  $exec_query=exec('php-cli -f thread-get.php '.$option.' '.$identify.' '.$count.' '.$until.' '.$userPage.' /dev/null 2>&1',$response,$exit);
} else if(strpos($option,"postInbox")!==false) {
  $exec_query=exec('php-cli -f thread-get.php '.$option.' '.$identify.' '.$id_message.' '.$message.' '.$identify_sender.' /dev/null 2>&1',$response,$exit);
} else if(strpos($option,"getSearch")!==false) {
  $exec_query=exec('php-cli -f thread-get.php '.$option.' '.$search.' '.$identify.' '.$type.' /dev/null 2>&1',$response,$exit);
}
print_r($response[0]);
?>