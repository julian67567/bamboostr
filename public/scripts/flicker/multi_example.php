<?php
// create both cURL resources
$ch1 = curl_init();
$ch2 = curl_init();

// set URL and other appropriate options
curl_setopt($ch1, CURLOPT_URL, "http://farm1.staticflickr.com/664/23564035219_3255e41c44_b.jpg");
curl_setopt($ch1,CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch1,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch1, CURLOPT_NOBODY, true);
curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT,1);
curl_setopt($ch1, CURLOPT_TIMEOUT, 1);
curl_setopt($ch2, CURLOPT_URL, "http://farm1.staticflickr.com/664/23564035219_3255e41c44_b.jpg");
curl_setopt($ch2,CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch2,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch2, CURLOPT_NOBODY, true);
curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT,1);
curl_setopt($ch2, CURLOPT_TIMEOUT, 1);

//create the multiple cURL handle
$mh = curl_multi_init();

//add the two handles
curl_multi_add_handle($mh,$ch1);
curl_multi_add_handle($mh,$ch2);

$active = null;
//execute the handles
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc == CURLM_CALL_MULTI_PERFORM);

while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) == -1) {
        usleep(100);
    }
    do {
        $mrc = curl_multi_exec($mh, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);
}
$code1 = curl_getinfo($ch1, CURLINFO_EFFECTIVE_URL);
$code2 = curl_getinfo($ch2, CURLINFO_EFFECTIVE_URL);
print_r($code1);
print_r($code2);
//close the handles
curl_multi_remove_handle($mh, $ch1);
curl_multi_remove_handle($mh, $ch2);
curl_multi_close($mh);

?>