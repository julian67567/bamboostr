<?PHP
function menu(){
	?>
  <ul class="main-menu">
                        <li style="text-align: center;">
                          <button onclick="abrirSignUpModal();" style="background-color: #26A8FF;" class="btn waves-effect waves-light" type="submit" name="action">Agrega otra red social
                            <span class="fa fa-plus"></span>
                          </button>
                        </li>
                        <li id="tableSys1" style="padding-top: 10px;">
                            <a href="" style="cursor: pointer;"><i class="fa fa-home"></i> Inicio</a>
                        </li>
                        <li id="tableSys2">
                            <a href="" style="cursor: pointer;"><i class="fa fa-pencil"></i> Escribir una publicación nueva</a>
                        </li>
                        <li id="tableSys3">
                            <a href="" style="cursor: pointer;"><i class="fa fa-calendar"></i> Ver calendario de publicaciones</a>
                        </li>
                        <li id="tableSys4">
                            <a href="" style="cursor: pointer;"><i class="fa fa-envelope"></i> Mis mensajes</a>
                        </li>
                        <li id="tableSys12">
                            <a href="stats.php" style="cursor: pointer;" id="tableSys5"><i class="icon-stats-dots"></i> Mis estadísticas</a>
                        </li>
                        <li id="tableSys11">
                            <a href="" style="cursor: pointer;"><i class="fa fa-shopping-cart"></i> Pagar</a>
                        </li>
                        <li>
                            <a href="" style="cursor: pointer;" id="tableSys7"><i class="fa fa-cogs"></i> Herramientas</a>
                        </li>
                        <li id="tableSys8">
                            <a href="" style="cursor: pointer;"><i class="fa fa-question-circle"></i> Necesito ayuda</a>
                        </li>
                        <li>
                            <a href="" style="cursor: pointer;" id="tableSys9"><i class="icon-subirpremium"></i> Conviértete a GOLD</a>
                        </li>
                        <li id="tableSys10">
                            <a href="" style="cursor: pointer;"><i class="icon-salir"></i> Salir de bamboostr</a>
                        </li>
                    </ul>
<?PHP
}
?>