<?php
include ''.dirname(__FILE__).'/config.php';
include ''.dirname(__FILE__).'/../funciones.php';
scriptConMasTiempo();
$search = rawurlencode($_GET["search"]);
$hoja = $_GET["hoja"];
$api_key = $api_key_flicker;
//17294e6545f4bab8
 
$tag = $search;
$perPage = 1000;
$url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search';
$url.= '&api_key='.$api_key;
$url.= '&tags='.$tag;
$url.= '&per_page='.$perPage;
$url.= '&format=json';
$url.= '&nojsoncallback=1';

$response = json_decode(file_get_contents($url));
$single_photo = $response->photos->photo;
 
$response_array = array();
if(count($single_photo)<$hoja){
  $hoja = count($single_photo);
}
//create the multiple cURL handle
$mh = curl_multi_init();
$photo_url_back = array();
$ch = array();
for($dfew=0; $dfew<$hoja; $dfew++){
    $num213 = rand(0, count($single_photo)); 
	$farm_id = $single_photo[$num213]->farm;
	$server_id = $single_photo[$num213]->server;
	$photo_id = $single_photo[$num213]->id;
	$secret_id = $single_photo[$num213]->secret;
	$size = 's';
	
	$title = $single_photo[$dfew]->title;
	$photo_url_back[$dfew] = 'http://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'_'.$size.'.'.'jpg';
        $c=0;
        $code ="photo_unavailable";
        while(strpos($code,"photo_unavailable")!==false && $c<=0){
          if($c==0)
            $size = 'b';
          $photo_url = 'http://farm'.$farm_id.'.staticflickr.com/'.$server_id.'/'.$photo_id.'_'.$secret_id.'_'.$size.'.'.'jpg';
           $ch[$dfew] = curl_init($photo_url);
            curl_setopt($ch[$dfew],CURLOPT_FOLLOWLOCATION,true);
            curl_setopt($ch[$dfew],CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch[$dfew], CURLOPT_NOBODY, true);
            curl_setopt($ch[$dfew], CURLOPT_CONNECTTIMEOUT,1);
            curl_setopt($ch[$dfew], CURLOPT_TIMEOUT, 1);
            //add the two handles
			curl_multi_add_handle($mh,$ch[$dfew]);
          $c++;
        }
}
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
$code = array();
for($dfew=0; $dfew<$hoja; $dfew++){
	$code[$dfew] = curl_getinfo($ch[$dfew], CURLINFO_EFFECTIVE_URL);
	if(strpos($code[$dfew],"photo_unavailable")!==false){
		$photo_url = $photo_url_back[$dfew];
	 } else {
	   $photo_url = $code[$dfew];
	 }
	//close the handles
	curl_multi_remove_handle($mh, $ch[$dfew]);
	$obj = new stdclass(); 
	$obj->imagenS = $photo_url_back[$dfew];
    $obj->imagenGrande = $photo_url;
    $response_array[$dfew] = $obj;
}
curl_multi_close($mh);
$response = new stdclass();
$response->data = $response_array;
echo json_encode($response);
 
?>