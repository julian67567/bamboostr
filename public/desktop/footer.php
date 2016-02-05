<?PHP
function footer($footer_bottom, $deviceType){
?>
<footer>
  <div class="container">
    <div class="row">
      <div class="col col-md-6 col-sm-6 col-xs-6 col-xxs">
        <?PHP
		  if($deviceType=="computer" || $deviceType=="tablet"){
		  ?>
          <table>
            <tr>
              <td style="vertical-align: middle; padding: 0px 0px 0px 0px;"><a href="http://bamboostr.com" style="vertical-align: middle; padding: 0px 15px 0px 0px;"><img width="70" src="images/logo-bamboostr.png" /> </a></td>
              <td><a href="http://bamboostr.com"><img style="width: 230px;" src="images/texto-bamboostr.png" /></a></td>
              <td><a href="http://boogapp.com"> <img src="http://boogapp.com/images/footer.png" title="Powered by boogapp" alt="powered by boogapp" /> </a></td>
          </tr>
        </table>
          <?PHP
		  } else if($deviceType=="phone") {
		  ?>
		  <table>
          <tr>
            <td style="width: 15%; text-align: center; vertical-align: middle; padding-top: 15px;"><a href="#" style="vertical-align: middle; padding: 0px 0px 0px 0px;"> <a href="http://bamboostr.com"><img width="45" src="images/logo-bamboostr.png" /> </a></td>
              <td style="width: 70%; text-align: center; padding: 0px 15px 0px 0px; vertical-align: middle; padding-top: 15px;"><a href="http://bamboostr.com"><img width="200" src="images/texto-bamboostr.png" /></a></td>
          </tr>
          <tr>
            <td style="text-align: center;"><a href="http://boogapp.com"> <img src="http://boogapp.com/images/footer.png" title="Powered by boogapp" alt="powered by boogapp" /> </a></td>
          </tr>
        </table>
		  <?PHP
		  }
		  ?>
        <div id="_copyright"> Copyright © 2014 <a href="http://bamboostr.com">Bamboostr</a> | <a href="http://bamboostr.com"><?PHP echo $footer_bottom[1]; ?></a> | <a href="http://bamboostr.com"><?PHP echo $footer_bottom[2]; ?></a></div>
      </div>
      <div class="col col-md-6 col-sm-6 col-xs-6 col-xxs">
        <div class="pull-right">
          <div class="social_buttons"> <a href="#" rel="nofollow" class="icon-button facebook"><i class="fa fa-facebook"></i></a> <a href="http://twitter.com/bamboostr" rel="nofollow" class="icon-button twitter"><i class="fa fa-twitter"></i></a> <a href="#" rel="nofollow" class="icon-button youtube"><i class="fa fa-youtube"></i></a> </div>
          <a href="#" id="go-top">
          <div class="back_to_top"><?PHP echo $footer_bottom[0]; ?></div>
          </a> </div>
      </div>
    </div>
  </div>
</footer>
<?PHP
}
?>
