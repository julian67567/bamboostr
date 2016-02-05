<?PHP
$articulos = simplexml_load_string(file_get_contents("http://infomundo.org/.xml/?type=rss"));
$num_noticia=1;
$max_noticias=10;
foreach($articulos->channel->item as $noticia){ 
  ?>
    <article>
      <h1><a href="<?PHP echo $noticia->link; ?>"><? echo $noticia->title; ?></a></h1>
      <?PHP echo $noticia->description; ?>
    </article>
  <?PHP 
  $num_noticia++;
  if($num_noticia > $max_noticias){
    break;
  }
}
?>