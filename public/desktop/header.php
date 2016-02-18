<?PHP
function header_desktop($tittle)
{  
    include ''.dirname(__FILE__).'/../config.php';
    ?>




































































<!DOCTYPE html>
<html ng-app="app">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title ng-controller="titleCtrl">{{title}}</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--Escala web a tamaño de la pantalla-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=100">
<meta name="description" content="" />
<meta name="author" content="">
<link href='css/fonts.css' rel='stylesheet' type='text/css'>

<!--Jquery Support-->
<script type="text/javascript" src="js/jquery.support.js"></script>
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<!--Fin Jquery Support-->

<!--Bootstrap-->
<script src="js/bootstrap.min.js"></script>

<!--toastr-->
<script type="text/javascript" src="toastr/toastr.js"></script>
<!--Fin toastr-->

<script>
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>

<!--Angular-->
<script src="angular/angular.min.js"></script>
<script src="angular/angular-sanitize.js"></script>
<script src="angular/lib/title.js"></script>

<!-- Javascript Libraries -->
<script src="js/functions.js"></script>

<!--Box Images-->
<script type="text/javascript" src="box-images/js/fresco.js"></script>
<link rel="stylesheet" type="text/css" href="box-images/css/fresco.css" />
<!--Fin Box Images->

<!--Loader-->
<script src="loader/js/time.js"></script>
<link rel="stylesheet" href="loader/css/main.css">
<!--Fin Loader-->


<!--Material Design-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!--Fin Material Design-->

<!-- Custom -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="slider/flexslider.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/_style.css" rel="stylesheet" type="text/css">
<!-- Custom -->

<!--icon-->
<link rel="icon" href="images/logo-bamboostr.ico" /> 
<link rel="shortcut icon" href="images/logo-bamboostr.ico" type="image/x-icon" />
<!--fin icon-->

<!-- calendar css -->
<link href='calendar/fullcalendar.css' rel='stylesheet' />
<!--  fin calendar  -->

<!--Bootstrap Tour-->
<link href="bootstrap/css/bootstrap-tour.min.css" rel="stylesheet">
<script src="bootstrap/js/bootstrap-tour.min.js"></script>
<link href="bootstrap/css/bootstrap-tour-standalone.min.css" rel="stylesheet">
<script src="bootstrap/js/bootstrap-tour-standalone.min.js"></script>
<!--Fin Bootstrap Tour-->


<!--Jquery UI like Datepicker, slider, spinner, etc-->
<script type="text/javascript" src="js/jQuery-UI-v1.11.2.js"></script>
<link rel="stylesheet" href="css/jQuery-UI-v1.11.2.css">

<!--Jquery UI Plugs-->
<!--$('#timepicker').timepicker({ 'scrollDefault': 'now', 'step': 15 });-->
<script type="text/javascript" src="js/timepicker.js"></script>
<link rel="stylesheet" href="css/timepicker.css">
<script src="slider/modernizr.js"></script>
<!--Fin Jquery UI Plugs-->

<!--Bootstrap-->
<script src="bootstrap/js/bootstrap-typeahead.js"></script>
<!--Fin Bootstrap-->

<!-- calendar -->
<script src='calendar/lib/moment.min.js'></script>
<script src='calendar/fullcalendar.min.js'></script>
<!--fin calendar-->

<!--   LiveChat    -->
<script type="text/javascript">
/*
    var LiveHelpSettings = {};
    LiveHelpSettings.server = 'www.<?PHP echo $_SERVER['HTTP_HOST']; ?>';
    LiveHelpSettings.embedded = true;
    (function($) {
        // JavaScript
        LiveHelpSettings.server = LiveHelpSettings.server.replace(/[a-z][a-z0-9+\-.]*:\/\/|\/livehelp\/*(\/|[a-z0-9\-._~%!$&'()*+,;=:@\/]*(?![a-z0-9\-._~%!$&'()*+,;=:@]))|\/*$/g, '');
        var LiveHelp = document.createElement('script'); LiveHelp.type = 'text/javascript'; LiveHelp.async = true;
        LiveHelp.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + LiveHelpSettings.server + '/livehelp/scripts/jquery.livehelp.min.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(LiveHelp, s);
    })(jQuery);
*/
</script>
<!--   LiveChat    -->

<!--Tag In
<link href="tag-it/css/jquery.css" rel="stylesheet" type="text/css">
<link href="tag-it/css/tagit.css" rel="stylesheet" type="text/css">
<script src="tag-it/js/tag-it.js" type="text/javascript" charset="utf-8"></script>-->
<!--Fin Tag In-->

<!-- analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-66347903-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- fin analytics -->


    <!--Materilized-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>

    <!--Font Awesome-->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

    <!-- Vendor CSS -->
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/material-design-iconic-font.min.css" rel="stylesheet">
      
    <!-- CSS -->
    <link href="css/app.min.1.css" rel="stylesheet">
    <link href="css/app.min.2.css" rel="stylesheet">
    
    <!--Font Brenda-->
    <link href="font-brenda/style.css" rel="stylesheet">

    <!--Bootstrap CSS-->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">

<!--toastr-->
<link rel="stylesheet" type="text/css" href="toastr/toastr.css" />
<!--Fin toastr-->

    <!-- Adobe Editor -->
    <script type="text/javascript" src="http://feather.aviary.com/imaging/v2/editor.js"></script>

    <!-- Instantiate the widget -->
    <script type="text/javascript">

    var featherEditor = new Aviary.Feather({
        tools: ['effects', 'frames', 'overlays', 'stickers', 'orientation', 'crop', 'resize', 'lighting', 'color', 'focus', 'vignette', 'draw', 'colorsplash', 'text', 'meme'],
        apiKey: '<?PHP echo $api_key_adobe; ?>',
        onSave: function(imageID, newURL) {
            var id424 = "";
            id424 = imageID.replace('image', '');
            console.log("Id Image Save Adobe");
            console.log(id424);
            var img = document.getElementById(imageID);
            imagenesAgregadasArray=imagenesAgregadas.split(",");
            imagenesAgregadas = "";
            for(var irewr23=0; irewr23<imagenesAgregadasArray.length-1; irewr23++){
                if(img.src==imagenesAgregadasArray[irewr23]){
                    imagenesAgregadas += ""+newURL+","; 
                } else {
                    imagenesAgregadas += ""+imagenesAgregadasArray[irewr23]+","; 
                }
            }/*fin for*/
            img.src = newURL;
            reemplazarFuncionesImage(id424,newURL);
            featherEditor.close();
	}
    });

    function launchEditor(id, src) {
        featherEditor.launch({
            image: id,
            url: src
        });
        return false;
    }

</script> 
<!--Fin Adobe Editor-->

<!--Feedback-->
<script>
var _vengage = _vengage || [];
$(document).ready(function(){
              (function(){
              var a, b, c;
              a = function (f) {
              return function () {
              _vengage.push([f].concat(Array.prototype.slice.call(arguments, 0)));
            };
          };
          b = ['load', 'addRule', 'addVariable', 'getURLParam', 'addRuleByParam', 'addVariableByParam', 'trackAction', 'submitFeedback', 'submitResponse', 'close', 'minimize', 'openModal', 'helpers'];
          for (c = 0; c < b.length; c++) {
          _vengage[b[c]] = a(b[c]);
        }
        var t = document.createElement('script'),
        s = document.getElementsByTagName('script')[0];
        t.async = true;
        t.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://s3.amazonaws.com/vetrack/init.min.js';
        s.parentNode.insertBefore(t, s);
        _vengage.push(['pubkey', '973b7689-4a5d-41b0-bbe7-9e2b9fa68b60']);
      })();
});
      </script>
<!--Fin Feedback-->

<!--Mercado Pago-->
<script type="text/javascript">
(function(){function $MPBR_load(){window.$MPBR_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = ("https:"==document.location.protocol?"https://www.mercadopago.com/org-img/jsapi/mptools/buttons/":"http://mp-tools.mlstatic.com/buttons/")+"render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPBR_loaded = true;})();}window.$MPBR_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPBR_load) : window.addEventListener('load', $MPBR_load, false)) : null;})();
</script>
<!--Fin Mercado Pago-->

<?PHP
}
$totalIconosMenu=10;
$backgroundColor = "#C5D5DD";
   ?>