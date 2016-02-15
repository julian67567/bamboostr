<?PHP
function headerMenu($user_image){
?>
<header ng-controller="notsCtrl" style="background-color: #2167a3;" id="header">
            <ul class="header-inner">
                <li id="menu-trigger" data-trigger="#sidebar" class="">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>
            
                <li class="logo hidden-xs">
                  <div>
                    <a ng-click="rastrearHeaders('logo');" href="system.php">
                      <img style="width:150px;" src="images/bamboostr7-blanco.png"/>
                    </a>
                  </div>
                </li>
                
                <li style="height: 38px;" class="pull-right hidden-xs">
                  <a ng-click="rastrearHeaders('ayuda');" href="ayuda.php">
                    <div style="height: 38px; margin-top: 5px; margin-left: 15px; margin-right: 15px; color: white;" class="pull-right">
                      <span style="padding-top: 0px; font-size: 20px; display: inline-block;" class="fa fa-question-circle"></span>
                      <p style="display: inline-block;">¿Necesitas Ayuda?</p>
                    </div>
                  </a>
                </li>
                
                <li class="pull-right">
                <ul class="top-menu">
                    <li style="width: 50px; top: 4px;  height: 35px; vertical-align: top;">
                      <div ng-click="rastrearHeaders('profile');" id="profileButton" style="text-align: center;" class="dropdown">
                        <img onerror="this.src='images/logo-bamboostr.png'" class="round dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" alt="Perfil" title="Perfil" style="cursor: pointer; height: 30px; width: 30px;" src="<?PHP echo $user_image; ?>" />
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a ng-click="rastrearHeaders('profileProfile');" style="cursor: pointer;" href="profiles.php">Perfil</a></li>
                            <li><a ng-click="rastrearHeaders('profileAgregarRed');" style="cursor: pointer;" onclick="abrirSignUpModal();">Agregar otra red social</a></li>  
                            <li><a ng-click="rastrearHeaders('profileNews');" class="modal-trigger" data-target="news" style="cursor: pointer;">News<span id="notBadget" class="new badge">4</span></a></li>         
                            <!--<li><a style="cursor: pointer;" id="logOut123">Salir</a></li> -->
                        </ul>
                      </div>
                    </li>
                    <!--
                    <li id="top-search">
                        <a class="tm-search" href=""></a>
                    </li>
                    -->
                    <li ng-click="rastrearHeaders('ai');" id="aiButton" style="cursor: pointer;" class="dropdown">
                        <a style="color: white; font-size: 20px; margin-top: 8px; text-align: center; background: url('images/panda-as.png') no-repeat top center / 30px 24px transparent;" data-toggle="dropdown">
                          <i ng-show="(notificationsMessages3 | filter: { read:0, tipo:'asistente'}).length" class="tmn-counts">{{notificationsMessages4.length}}</i>
                          <i ng-show="!(notificationsMessages3 | filter: { read:0, tipo:'asistente'}).length" class="tmn-counts">0</i>
                        </a>
                        <div style="height: 300px; overflow-y: scroll;" class="dropdown-menu dropdown-menu-lg pull-right">
                            <div class="listview" id="notifications">
                                <div class="lv-header">
                                    Asistente Inteligente
                    
                                    <ul class="actions">
                                        <li class="dropdown">
                                            <a href="" data-clear="notification">
                                                <i class="zmdi zmdi-check-all"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="lv-body">
                                  <a ng-if="z.read=='0'" ng-repeat="z in notificationsMessages4 = (notificationsMessages3 | filter: { read:0, tipo:'asistente'})" class="lv-item" style="cursor: pointer;" ng-click="abrirNotMsg23D(z,3)">
                                    <div class="media">
                                      <div class="pull-left">
                                        <i ng-if="z.read=='0'" style="font-size: 15px;" class="fa fa-envelope-o"></i>
                                        <img ng-if="z.read=='1'" style="width: 15px;" src="images/openEnvelop.png">
                                      </div>
                                      <div class="media-body">
                                        <div class="lv-title">
                                          {{z.titulo}}
                                        </div>
                                        <small ng-if="z.tipo=='asistente'" class="lv-small">Asistente</small>
                                        <small ng-if="z.tipo=='asistente'" class="lv-small">{{z.mensaje}}</small>
                                      </div>
                                    </div>
                                  </a>

                                </div>
                            </div>
                    
                        </div>
                    </li>
                    <li style="height: 38px; vertical-align: top;">
                      <a ng-click="rastrearHeaders('home');" href="system.php" style="cursor: pointer; text-align: center; font-size: 21px; top: 7px; color: white;" class="fa fa-home"></a>
                    </li>
                    <li style="height: 38px; vertical-align: top;">
                      <a ng-click="rastrearHeaders('escribir');" href="escribir.php" style="cursor: pointer; text-align: center; font-size: 21px; top: 7px; color: white;" class="fa fa-pencil"></a>
                    </li>
                    <li ng-click="rastrearHeaders('nots');" id="notsButton" style="cursor: pointer; vertical-align: top;" class="dropdown">
                        <a style="color: white; font-size: 20px; margin-top: 8px; text-align: center;" data-toggle="dropdown" class="fa fa-envelope">
                          <i ng-show="(inboxHeader | filter: { read:0}).length && (notificationsMessages | filter: { read:0}).length" class="tmn-counts">{{inboxHeader2.length + notificationsMessages2.length}}</i>
                          <i ng-show="(inboxHeader | filter: { read:0}).length && !(notificationsMessages | filter: { read:0}).length" class="tmn-counts">{{inboxHeader2.length}}</i>
                          <i ng-show="!(inboxHeader | filter: { read:0}).length && (notificationsMessages | filter: { read:0}).length" class="tmn-counts">{{notificationsMessages2.length}}</i>
                          <i ng-show="!(inboxHeader | filter: { read:0}).length && !(notificationsMessages | filter: { read:0}).length" class="tmn-counts">0</i>
                        </a>
                        <div style="height: 300px; overflow-y: scroll;" class="dropdown-menu dropdown-menu-lg pull-right">
                            <div class="listview" id="notifications">
                                <div class="lv-header">
                                    Notifications
                    
                                    <ul class="actions">
                                        <li class="dropdown">
                                            <a href="" data-clear="notification">
                                                <i class="zmdi zmdi-check-all"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="lv-body">
                                  <a ng-if="x.read=='0'" ng-repeat="x in notificationsMessages2 = (notificationsMessages | filter: { read:0})" class="lv-item" style="cursor: pointer;" ng-click="abrirNotMsg23D(x,2)">
                                    <div class="media">
                                      <div class="pull-left">
                                        <i ng-if="x.read=='0'" style="font-size: 15px;" class="fa fa-envelope-o"></i>
                                        <img ng-if="x.read=='1'" style="width: 15px;" src="images/openEnvelop.png">
                                      </div>
                                      <div class="media-body">
                                        <div class="lv-title">
                                          {{x.titulo}}
                                        </div>
                                        <small ng-if="x.tipo=='instagram'" class="lv-small">Instagram a atender</small>
                                        <small ng-if="x.tipo=='instagram'" class="lv-small">{{x.mensaje}}</small>
                                      </div>
                                    </div>
                                  </a>

                                  <a ng-if="y.read=='0'" ng-repeat="y in inboxHeader2 = (inboxHeader | filter: { read:0})" class="lv-item" style="cursor: pointer;" href="responder.php">
                                    <div class="media">
                                      <div class="pull-left">
                                        <i ng-if="y.read=='0'" style="font-size: 15px;" class="fa fa-envelope-o"></i>
                                        <img ng-if="y.read=='1'" style="width: 15px;" src="images/openEnvelop.png">
                                      </div>
                                      <div class="media-body">
                                        <div class="lv-title">
                                          {{y.screen_name}}
                                        </div>
                                        <small class="lv-small">{{y.mensaje}}</small>
                                      </div>
                                    </div>
                                  </a>
                                </div>
                                <a class="lv-footer" href="responder.php">Ver Todos</a>
                            </div>
                    
                        </div>
                    </li>
            </ul>
            
            
            <!-- Top Search Content
            <div id="top-search-wrap">
                <input type="text">
                <i id="top-search-close">×</i>
            </div>-->
        </header>
<?PHP
}
?>