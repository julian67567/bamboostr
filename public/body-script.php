<body oncontextmenu="return false" onkeydown="return bloquearTecla(event);" style="background-color: #C5D5DD;">
  <header style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);width: 100%; position: fixed; z-index: 1; background-color: #fff; padding: 0;" id="header" class="header"> 
    <div class="container">
      <nav id="main-nav" style="border-bottom: 0em; left: 0em; background: #fff; z-index: 2; min-height: 45px;" class="main-nav" role="navigation">  
      
        <div style="font-size: 16px; margin-top: 6px; vertical-align: middle; color: red;" class="pull-left">
          <button type="button" class="btn btn-danger">BETA</button>
        </div>

        <div class="dropdown pull-left">
        
          <img class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" alt="<?PHP echo $txt["txt44"]; ?>" title="<?PHP echo $txt["txt44"]; ?>" style="cursor: pointer; margin-top: 8px; margin-left: 1em; width: 30px;" src="<?PHP echo $user_image; ?>" />
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="profile"><?PHP echo $txt["txt44"]; ?></a></li>
            <li><a style="cursor: pointer;" id="logOut123"><?PHP echo $txt["txt49"]; ?></a></li> 
          </ul>
        </div>

        <div id="notHeaderTop" style="vertical-align: middle;" class="pull-left">
                  <img onclick="verNots();" class="imgNoRadius iconHeader" alt="<?PHP echo $txt["txt44"]; ?>" title="<?PHP echo $txt["txt44"]; ?>" style="cursor: pointer; margin-top: 12px; margin-left: 1em; width: 30px;" src="images/not123.png" />
        </div><!--//notificaciones-->

        <div style="vertical-align: middle;" class="pull-left">
                  <img data-toggle="modal" data-target="#signup-modal" class="imgNoRadius iconHeader" alt="<?PHP echo $txt["txt44"]; ?>" title="<?PHP echo $txt["txt44"]; ?>" style="cursor: pointer; margin-top: 3px; margin-left: 1em; width: 36px;" src="images/pencil.png" />
        </div><!--//escribir-->

        <div class="navbar-header">
            <button style="margin-top: 0.5em;" class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button><!--//nav-toggle-->
        </div><!--//navbar-header-->            
        <div class="navbar-collapse collapse" id="navbar-collapse">
            <ul class="visible-xs nav navbar-nav">
                <li class="nav-item"><a href="/system"><?PHP echo $txt["txt41"]; ?></a></li>
                <li class="nav-item"><a href="/statistics"><?PHP echo $txt["txt45"]; ?></a></li>
                <li class="nav-item"><a href="/share"><?PHP echo $txt["txt494"]; ?></a></li>
                <li class="nav-item"><a href="/tools"><?PHP echo $txt["txt47"]; ?></a></li>
                <li class="nav-item"><a href="/crm"><?PHP echo $txt["txt326"]; ?></a></li>
                <!-- DROPDOWN-->
                <!--
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="http://themes.3rdwavemedia.com/tempo/1.4/blog.html">Características</a>
                    <ul class="dropdown-menu">
                        <li><a href="http://themes.3rdwavemedia.com/tempo/1.4/blog.html">Portabilidad</a></li>
                        <li><a href="http://themes.3rdwavemedia.com/tempo/1.4/blog-single.html">Publica</a></li>
                        <li><a href="http://themes.3rdwavemedia.com/tempo/1.4/email-templates/tempo-email-color-1.html">Blog</a></li>           
                    </ul>
                </li>-->                         
                <!--<li class="nav-item nav-item-cta last"><button type="button" class="btn btn-cta btn-cta-primary" data-toggle="modal" data-target="#signup-modal">Empecemos</button></li>-->
            </ul><!--//nav-->
        </div><!--//navabr-collapse-->
        
        <!--MENU-->
      <div> 
        <?PHP  include 'escribir-menu.php'; ?>
      </div>
    </nav>
  </div>
</header>
<div>
  <div id="cuerpo" style="padding-top: 50px; background-color: <?PHP echo $backgroundColor; ?>;">
    <center>
      <table style="width: 100%;">
        <tr>
          <td class="hidden-xs" id="expandirSys" style="-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); -moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); z-index: 3; height: 100%; position: fixed; background-color: #283147; width: 50px; vertical-align: top; top: 0px; padding-top: 0px;"><div style="width: 100%;">
              <table style="width: 100%; color: <?PHP echo $backgroundColor; ?>;">
                <?PHP
                        $c=0;
                        while($c!=$totalIconosMenu+2){
                          ?>
                <tr>
                  <td><table id="tableSys<?PHP echo $c; ?>" style="border-left: 5px solid #283147; width: 100%; height: 50px;">
                      <tr>
                        <td id="botonesSys<?PHP echo $c; ?>" style="padding: 5px, 5px, 5px, 5px; text-align: center; width: 100%;"><?PHP
						          if($c==0){
                                  ?>
                          <a href="http://bamboostr.com" style="vertical-align: middle; padding: 0px 0px 0px 0px;"><img class="imgNoRadius" style="width: 2.5em;" src="images/logo-bamboostr-blanco.png" /></a>
                          <?PHP
                                  }
                                  if($c==1){
                                  ?>
                          <img class="imgNoRadius" style="width: 35px;" src="images/home2.png" />
                          <?PHP
                                  }
                                  if($c==2){
                                    ?>
                          <img class="imgNoRadius" style="width: 35px;" src="images/estadistica2.png" />
                          <?PHP
                                  }
								  if($c==3){
                                    ?>
                          <img class="imgNoRadius" style="width: 35px;" src="images/share2.png" />
                          <?PHP
                                  }
								  if($c==4){
                                    ?>
                          <img class="imgNoRadius" style="width: 35px;" src="images/engrane2.png" />
                          <?PHP
                                  }                               if($c==5){
                                    ?>
                          <img class="imgNoRadius" style="width: 35px;" src="images/perfil2.png" />
                          <?PHP 
                                  }                               if($c==6){
                                    ?>
                          <img class="imgNoRadius" style="width: 35px;" src="images/ads.png" />
                          <?PHP
                                  }
								  if($c==7){
									?>
                          <img class="imgNoRadius" style="width: 35px;" src="images/llave.png" />
                          <?PHP
                                  }
								  if($c==8){
                                    ?>
                          <img class="imgNoRadius" style="width: 30px;" src="images/informacion2.png" />
                          <?PHP
                                  }
								  if($c==9){
                                    ?>
                          <img class="imgNoRadius" style="width: 35px;" src="images/salir2.png" />
                          <?PHP
                                  }
                                  else {
                                    ?>
                          <?PHP
                                  }  ?></td>
                        <td id="textosSys<?PHP echo $c; ?>" style="vertical-align: middle; text-align: left; padding-top: 15px; padding-left: 5px; display: none; color: #FFFFFF; width: 0%; height: 100%;"><?PHP
                                    if($c==1){
                                    ?>
                          <font class="menuClass"><?PHP echo $txt["txt41"]; ?></font>
                          <?PHP
                                    }
                                    if($c==2){
                                      ?>
                          <font class="menuClass"><?PHP echo $txt["txt45"]; ?></font>
                          <?PHP
                                    }
									if($c==3){
                                      ?>
                          <font class="menuClass"><?PHP echo $txt["txt494"]; ?></font>
                          <?PHP
                                    }
									if($c==4){
                                      ?>
                          <font class="menuClass"><?PHP echo $txt["txt47"]; ?></font>
                          <?PHP
                                    }
                                                                        if($c==5){
                                      ?>
                          <font class="menuClass"><?PHP echo $txt["txt326"]; ?></font>
                          <?PHP 
                                    }                                   
									if($c==6){
                                      ?>
                          <font class="menuClass">ADS</font>
                          <?PHP
                                    }
									if($c==7){
                                      ?>
                          <font class="menuClass"><?PHP echo $txt["txt138"]; ?></font>
                          <?PHP
									}
									if($c==8){
                                      ?>
                          <font class="menuClass"><?PHP echo $txt["txt48"]; ?></font>
                          <?PHP
                                    }
									if($c==9){
                                      ?>
                          <font class="menuClass"><?PHP echo $txt["txt49"]; ?></font>
                          <?PHP
                                    }
                                    else {
                                      ?>
                          <?PHP
                                    }
                                  ?></td>
                      </tr>
                    </table></td>
                </tr>
                <?PHP
                          $c++;
                        }
                      ?>
              </table>
            </div></td>