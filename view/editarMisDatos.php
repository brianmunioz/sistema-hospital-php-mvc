<?php
session_start();
if(isset($_SESSION["user"])){
    if($_SESSION["user"][0]["rol"] != "paciente"){
      header("location: index.php");  
    }
  }else{
    header("location: index.php");
  }
require("../controller/UsersController.php");
$controladorUsuarios = new UsersController();
$dni = intval($_SESSION["user"][0]["dni"]);
$datosPaciente = null;


    $controladorUsuarios = new UsersController();
    $datosPaciente = $controladorUsuarios->obtenerusuario($dni);


if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($datosPaciente[0]["id"]);
    $dniAenviar = intval($_POST["dni"]);
    $datosaenviar = array(
        "password" => $_POST["password"],
        "mail" => $_POST["email"],
        "id" => intval($_SESSION["user"][0]["id"])
    );
    $enviar = $controladorUsuarios->editarpaciente($datosaenviar);
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
           

            <button type="submit" name="submit" class="btn btn-primary">Editar tus datos</button>
        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>