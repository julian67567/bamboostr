<?php 
/*Creamos una función que detecte el idioma del navegador del cliente.*/
function getUserLanguage() { 
   $idioma=substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
   //return $idioma; 
   return "es";
}
?>