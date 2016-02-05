<?php
include '../../scripts/funciones.php';
include '../config-sample.php';
require 'src/Instagram.php';
use MetzWeb\Instagram\Instagram;

// initialize class
$instagram = new Instagram(array(
    'apiKey' => $CLIENT_ID_INSTAGRAM,
    'apiSecret' => $CLIENT_SECRET_INSTAGRAM,
    'apiCallback' => 'http://".getDirUrl(1)."/system.php?agregarRed=instagram' // must point to success.php
));

// grab OAuth callback code
//$data = $instagram->getOAuthToken($_GET['code']);

//185693242.1785b2c.2cd7b302eb984b9bab20674f41d92976 -> alonso
    $instagram->setAccessToken("185693242.1785b2c.2cd7b302eb984b9bab20674f41d92976");
    // now you have access to all authenticated user methods
    $result = $instagram->getUserMedia();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram - photo stream</title>
</head>
<body>
<div class="container">
    <header class="clearfix">
      <h1>Instagram photos <span>taken by <?php echo $data->user->username ?></span></h1>
    </header>
    <div class="main">
        <ul class="grid">
            <?php
            // display all user likes
            foreach ($result->data as $media) {
                $content = '<li>';
                // output media
                if ($media->type === 'video') {
                    // video
                    $poster = $media->images->low_resolution->url;
                    $source = $media->videos->standard_resolution->url;
                    $content .= "<video class=\"media video-js vjs-default-skin\" width=\"250\" height=\"250\" poster=\"{$poster}\"
                           data-setup='{\"controls\":true, \"preload\": \"auto\"}'>
                             <source src=\"{$source}\" type=\"video/mp4\" />
                           </video>";
                } else {
                    // image
                    $image = $media->images->low_resolution->url;
                    $content .= "<img class=\"media\" src=\"{$image}\"/>";
                }
                // create meta section
                $avatar = $media->user->profile_picture;
                $username = $media->user->username;
                $comment = $media->caption->text;
                $content .= "<div class=\"content\">
                           <div class=\"avatar\" style=\"background-image: url({$avatar})\"></div>
                           <p>{$username}</p>
                           <div class=\"comment\">{$comment}</div>
                         </div>";
                // output media
                echo $content . '</li>';
            }
            ?>
        </ul>
    </div>
</div>
</body>
</html>