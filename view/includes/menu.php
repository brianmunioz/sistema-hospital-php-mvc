<?php
session_start();

?>
<hr>
<a href="index.php" class="btn btn-default">Inicio</a>
<?php if(isset($_SESSION["user"] )&& $_SESSION["user"][0]["rol"] == "admin"): ?>
<a href="agregarUsuario.php" class="btn btn-default">Agregar usuario</a>
<a href="editarUsuario.php" class="btn btn-default">Editar Usuario</a>


<?php endif; ?>
<?php if(isset($_SESSION["user"] )&& $_SESSION["user"][0]["rol"] == "medico"): ?>

<a href="agregarFicha.php" class="btn btn-default">Agregar Ficha</a>
<a href="verFichas.php" class="btn btn-default">Ver Fichas</a>
<?php endif; ?>
<?php if(isset($_SESSION["user"] )&& $_SESSION["user"][0]["rol"] == "paciente"): ?>

<a href="editarMisDatos.php" class="btn btn-default">Editar mis datos</a>
<a href="pedirTurno.php" class="btn btn-default">Pedir Turno</a>
<?php endif; ?>
<?php if(isset($_SESSION["user"] )&& $_SESSION["user"][0]["rol"] != "admin"): ?>

<a href="verMisTurnos.php" class="btn btn-default">Ver Turnos</a>
<?php endif; ?>



<?php if(isset($_SESSION["user"] )&& sizeof($_SESSION["user"][0]) == 7): ?>

<a href="logout.php" class="btn btn-danger">logout</a>
<?php else: ?>
    <a href="login.php" class="btn btn-success">Login</a>

<?php endif; ?>
<hr>
