<?php
session_start();
if(isset($_SESSION["user"])){
    if($_SESSION["user"][0]["rol"] != "admin"){
      header("location: index.php");  
    }
  }else{
    header("location: index.php");
  }
require("../controller/UsersController.php");
$controladorUsuarios = new UsersController();
$dni = isset($_GET["dni"]) ? $_GET["dni"] : null;
$datosPaciente = null;

if ($dni !== null) {
    $controladorUsuarios = new UsersController();
    $datosPaciente = $controladorUsuarios->obtenerusuario($dni);
}

if ($datosPaciente === null || sizeof($datosPaciente) <= 0) {
    echo "No hay usuario";
}
if (sizeof($datosPaciente) <= 0) {
    echo "no hay usuario";
}
if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($datosPaciente[0]["id"]);
    $dniAenviar = intval($_POST["dni"]);
    $datosaenviar = array(
        "nombre" => $_POST["nombre"],
        "password" => $_POST["password"],
        "apellido" => $_POST["apellido"],
        "rol" => $_POST["rol"],
        "dni" => $dniAenviar,
        "mail" => $_POST["email"],
        "id" => $id
    );
    $enviar = $controladorUsuarios->editarusuario($datosaenviar);
    echo ($enviar);
    $datosPaciente = $controladorUsuarios->obtenerusuario($dni);

}


?>



<!DOCTYPE html>
<html lang="es">

<?php include("./includes/head.php"); ?>

<body>
    <?php include("./includes/menu.php"); ?>

    <div class="container">
        <h1 class="text-center">Agregar usuario</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?dni=" . $dni; ?>" method="post">

            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="number" class="form-control border-dark"
                    value="<?php echo intval($datosPaciente[0]["dni"]) ?>" name="dni" id="dni"
                    aria-describedby="dnihelp">
                <div id="dnihelp" class="form-text">El dni debe tener 8 digitos</div>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">nombre</label>
                <input type="text" class="form-control border-dark" name="nombre" id="nombre"
                    value="<?php echo $datosPaciente[0]["nombre"] ?>" aria-describedby="nombrehelp">
                <div id="nombrehelp" class="form-text">El nombre es un campo obligatorio</div>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">apellido</label>
                <input type="text" class="form-control border-dark" value="<?php echo $datosPaciente[0]["apellido"] ?>"
                    name="apellido" id="apellido" aria-describedby="apellidohelp">
                <div id="apellidohelp" class="form-text">El apellido es un campo obligatorio</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">mail</label>
                <input type="email" class="form-control border-dark" name="email"
                    value="<?php echo $datosPaciente[0]["mail"] ?>" id="email" aria-describedby="emailhelp">
                <div id="emailHelp" class="form-text">El email es un campo obligatorio</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="text" class="form-control border-dark" value="<?php echo $datosPaciente[0]["password"] ?>"
                    name="password" id="password" aria-describedby="passhelp">
                <div id="passhelp" class="form-text">El password es un campo obligatorio</div>
            </div>
            <div class="mb-3">
                <label for="rol" name="rol" selected="<?php echo $datosPaciente[0]["rol"] ?>"
                    class="form-label">rol</label>

                <select class="form-select border-dark" name="rol" id="rol" aria-label="paciente">
                    <?php if ($datosPaciente[0]["rol"] == "paciente"): ?>
                        <option value="paciente" selected>paciente</option>
                    <?php else: ?>
                        <option value="paciente">paciente</option>
                    <?php endif; ?>
                    <?php if ($datosPaciente[0]["rol"] == "medico"): ?>
                        <option value="medico" selected>medico</option>
                    <?php else: ?>
                        <option value="medico">medico</option>
                    <?php endif; ?>
                    <?php if ($datosPaciente[0]["rol"] == "admin"): ?>
                        <option value="admin" selected>admin</option>
                    <?php else: ?>
                        <option value="admin">admin</option>
                    <?php endif; ?>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Editar usuario</button>
        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>