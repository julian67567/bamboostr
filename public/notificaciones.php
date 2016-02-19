<?PHP
?>

<!-- Modal Sheet -->
  <div id="news" class="modal bottom-sheet">
    <div class="modal-content">
      <h4 style="text-align: center;">Actualizaciones nuevas en bamboostr</h4>
      <div id="notBody"></div>
    </div>
  </div>

<!-- Marca de agua -->
    <div style="width: 100%;" class="modal modal-signup" id="watermark" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin: 0px; padding: 0px; margin-top: 20px;">
            <div class="modal-content" style="height: 400px; overflow-y: auto;">
                <div class="modal-header">
                    <button style="float: left; color: red; opacity: 1;" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 style="text-align: center;" class="modal-title text-center">Agregar Marca de agua.</h4>
                    <!--<p class="intro text-center">It only takes 3 minutes!</p>-->
                    <p></p>
                </div>
                <div class="modal-body col-md-12">
                  <div clas="row">
                    <div class="text-center col-md-12">                        
                      <div class="social-login text-center">                        
                        <ul class="list-unstyled social-login">
                            <li>
                              <input class="radioWatermark" onchange="subirImageWatermark()" id="watermarkUpload" type="file" style="width: 100%;" />
                            </li>
                            <li class="waterMarkOption" style="visibility: hidden; margin-top: 10px;">
                              <input class="radioWatermark" onchange="radioWatermark()" value="upper-left" id="test11" style="float: left;" type="radio" name="group2" checked /><label style="float: left;" for="test11">Upper Left</label>
                              <input class="radioWatermark" onchange="radioWatermark()" value="upper-right" id="test12" type="radio" name="group2" /><label for="test12">Upper Right</label>
                            </li>
                            <li class="waterMarkOption row" style="padding: 0; margin: 0; visibility: hidden;">
                              <input class="radioWatermark" onchange="radioWatermark()" value="center" id="test13" style="float: left;" type="radio" name="group2" /><label style="float: left;" for="test13">Center</label>
                            </li>
                            <li class="waterMarkOption" style="visibility: hidden;">
                              <input class="radioWatermark" onchange="radioWatermark()" value="lower-left" id="test15" style="float: left;" type="radio" name="group2" /><label style="float: left;" for="test15">Lower Left</label>
                              <input class="radioWatermark" onchange="radioWatermark()" value="lower-right" id="test16" type="radio" name="group2" /><label for="test16">Lower Right</label>
                            </li>
                            <li class="waterMarkOption" style="visibility: hidden;">
                              <p style="float: left;">Tamaño</p>
                              <p class="range-field"><input type="range" id="size" min="0.1" max="2.0" step="0.1"></p>
                            </li>
                            <li style="margin-top: 10px;">
                              <img id="inputImage" src="" style="overflow: scroll; display: none;" />
                              <img id="outputImage" style="display: none;" />
                              <img class="watermark" id="preWatermark" src="" style="overflow: scroll;" />
                            </li>
                            <li style="padding-top: 20px;">
                              <button id="saveWatermark" style="background-color: #26A8FF; margin-left: 50px;" class="btn waves-effect waves-light" name="action">Guardar</button> 
                            </li>
                        </ul>
                      </div>
                    </div>
                    
                    <!--<div class="divider"><span>Or</span></div>--->
                  </div> <!--fin row-->
                </div><!--//modal-body-->
                <!--
                <div class="modal-footer">
                    <p>Already have an account? <a class="login-link" id="login-link" href="http://themes.3rdwavemedia.com/tempo/1.4/#">Log in</a></p>                    
                </div>--><!--//modal-footer-->
            </div><!--//modal-content-->
        </div><!--//modal-dialog col-md-8-->
        <div class="col-md-2"></div>
    </div><!--//modal-->

<!-- Signup Modal -->
    <div style="width: 100%;" class="modal modal-signup" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin: 0px; padding: 0px; margin-top: 20px;">
            <div class="modal-content" style="height: 500px; overflow-y: auto;">
                <div class="modal-header">
                    <button style="float: left; color: red; opacity: 1;" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 style="text-align: center;" id="signupModalLabel" class="modal-title text-center">Ingresa con alguna de las siguientes redes sociales.</h4>
                    <!--<p class="intro text-center">It only takes 3 minutes!</p>-->
                    <p></p>
                </div>
                <div class="modal-body col-md-12">
                  <div clas="row">
                    <div class="text-center col-md-12">                        
                      <div class="social-login text-center">                        
                        <ul class="list-unstyled social-login">
                            <li style="margin: 0;">
                                <button style="background-color: #2d4373; height: 42px; width: 250px; margin-bottom: 10px;" onclick="rastrearLogR('faConditions');" class="btn" type="button">
                                <img style="margin-left: 6px; float: left; width: 10px; margin-right: 1em;" src="images/redes_sociales/f.png" />Sign up with Facebook</button>
                            </li>
                            <li style="margin: 0;">
                                <button style="background-color: #2795e9; height: 42px; width: 250px; margin-bottom: 10px;" onclick="rastrearLogR('twConditions');" class="btn" type="button">
                                <img style="float: left; width: 25px;" src="images/redes_sociales/t.png" />Sign up with Twitter</button>
                            </li>
                            <li style="margin: 0;">
                                <button style="height: 42px; width: 250px; margin-bottom: 10px; background-color: #ee8102;" onclick="rastrearLogR('inConditions');" class="btn" type="button">
                                <img style="float: left; width: 25px; margin-right: 1em;" src="images/insta.png" />Sign up with Instagram</button>
                            </li>
                            <!--<li><button class="google-btn btn" type="button"><i class="fa fa-google-plus"></i>Sign up with Google</button></li>-->
                        </ul>
                        <p style="padding-top: 20px; text-align: center;" class="note">No te preocupes. Nosotros no publicamos nada sin tu permiso y no almacenamos contraseñas.</p>
                      </div>  
                    </div>
                    
                    <!--<div class="divider"><span>Or</span></div>--->
                  </div> <!--fin row-->
                </div><!--//modal-body-->
                <!--
                <div class="modal-footer">
                    <p>Already have an account? <a class="login-link" id="login-link" href="http://themes.3rdwavemedia.com/tempo/1.4/#">Log in</a></p>                    
                </div>--><!--//modal-footer-->
            </div><!--//modal-content-->
        </div><!--//modal-dialog col-md-8-->
        <div class="col-md-2"></div>
    </div><!--//modal-->


<!-- Notifications Modal -->
    <div style="width: 100%;" class="modal modal-signup" id="notificacionesAbrir" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin: 0px; padding: 0px; margin-top: 20px;">
            <div class="modal-content" style="height: 500px; overflow-y: auto; ">
                <div class="modal-header">
                    <button style="float: left; color: red; opacity: 1;" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <!--<p class="intro text-center">It only takes 3 minutes!</p>-->
                    <p></p>
                </div>
                <div class="modal-body col-md-12">
                  <div clas="row">
                    <div class="text-center col-md-12">                        
                        <div class="social-login text-center">    
                            <p id="notificacionesBody" style="padding-top: 0px; text-align: center;" class="note"></p>
                        </div>   
                    </div>
                    
                    <!--<div class="divider"><span>Or</span></div>--->
                  </div> <!--fin row-->
                </div><!--//modal-body-->
                <!--
                <div class="modal-footer">
                    <p>Already have an account? <a class="login-link" id="login-link" href="http://themes.3rdwavemedia.com/tempo/1.4/#">Log in</a></p>                    
                </div>--><!--//modal-footer-->
            </div><!--//modal-content-->
        </div><!--//modal-dialog col-md-8-->
        <div class="col-md-2"></div>
    </div><!--//modal-->