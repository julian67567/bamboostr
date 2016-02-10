<?PHP
function menu(){
	?>
  <ul class="main-menu">
                        <li style="text-align: center;">
                          <button onclick="abrirSignUpModal();" style="background-color: #26A8FF;" class="btn waves-effect waves-light" type="submit" name="action">Agrega otra red social
                            <span class="fa fa-plus"></span>
                          </button>
                        </li>
                        <li style="padding-top: 10px;">
                            <a href="system.php" style="cursor: pointer;" id="tableSys1"><i class="fa fa-home"></i> Inicio</a>
                        </li>
                        <li>
                            <a href="escribir.php" style="cursor: pointer;" id="tableSys2"><i class="fa fa-pencil"></i> Escribir una publicación nueva</a>
                        </li>
                        <li>
                            <a href="calendario.php" style="cursor: pointer;" id="tableSys3"><i class="fa fa-calendar"></i> Ver calendario de publicaciones</a>
                        </li>
                        <li>
                            <a href="responder.php" style="cursor: pointer;" id="tableSys4"><i class="fa fa-envelope"></i> Mis mensajes</a>
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
                        <li>
                            <a href="ayuda.php" style="cursor: pointer;" id="tableSys8"><i class="fa fa-question-circle"></i> Necesito ayuda</a>
                        </li>
                        <li>
                            <a href="" style="cursor: pointer;" id="tableSys9"><i class="icon-subirpremium"></i> Conviértete a GOLD</a>
                        </li>
                        <li>
                            <a href="" style="cursor: pointer;" id="tableSys10"><i class="icon-salir"></i> Salir de bamboostr</a>
                        </li>
                    </ul>
<?PHP
}
?>