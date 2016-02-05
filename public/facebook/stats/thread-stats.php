<?PHP
$identify_account = escapeshellarg($_GET["identify_account"]);
$identify = escapeshellarg($_GET["identify"]);
$red = escapeshellarg($_GET["red"]);
$option = $_GET["option"];
//echo getcwd();
if($option=="1"){
  $exec_query=exec('php-cli -f thread-stats2.php '.$identify.' '.$identify_account.' '.$red.' '.$option.' /dev/null 2>&1',$response,$exit);
} else if($option=="2"){
  $exec_query=exec('php-cli -f thread-stats2.php '.$identify.' '.$identify_account.' '.$red.' '.$option.' /dev/null 2>&1',$response,$exit);
} else if($option=="3"){
  $exec_query=exec('php-cli -f thread-stats2.php '.$identify.' '.$identify_account.' '.$red.' '.$option.' /dev/null 2>&1',$response,$exit);
} else if($option=="4"){
  $exec_query=exec('php-cli -f thread-stats2.php '.$identify.' '.$identify_account.' '.$red.' '.$option.' /dev/null 2>&1',$response,$exit);
} else if($option=="5"){
  $exec_query=exec('php-cli -f thread-stats2.php '.$identify.' '.$identify_account.' '.$red.' '.$option.' /dev/null 2>&1',$response,$exit);
} else if($option=="6"){
  $exec_query=exec('php-cli -f thread-stats2.php '.$identify.' '.$identify_account.' '.$red.' '.$option.' /dev/null 2>&1',$response,$exit);
} else if($option=="7"){
  $exec_query=exec('php-cli -f thread-stats2.php '.$identify.' '.$identify_account.' '.$red.' '.$option.' /dev/null 2>&1',$response,$exit);
} else if($option=="8"){
  $exec_query=exec('php-cli -f thread-stats2.php '.$identify.' '.$identify_account.' '.$red.' '.$option.' /dev/null 2>&1',$response,$exit);
} else if($option=="9"){
  $exec_query=exec('php-cli -f thread-stats2.php '.$identify.' '.$identify_account.' '.$red.' '.$option.' /dev/null 2>&1',$response,$exit);
} else if($option=="10"){
  $exec_query=exec('php-cli -f thread-stats2.php '.$identify.' '.$identify_account.' '.$red.' '.$option.' /dev/null 2>&1',$response,$exit);
} 
print_r($response[0]);

?>