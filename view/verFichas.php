<?php
session_start();
require("../controller/UsersController.php");
require("../controller/FichasController.php");

$turnosControladores = new FichasController();
$controladorusuario = new UsersController();
$ficha = [];

if (!isset($_SESSION["user"])) {
    header("location: index.php");
} else {
    if ($_SESSION["user"] && $_SESSION["user"][0]["rol"] != "medico") {
        header("location: index.php");
    }
}

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST" && $_POST["dni"] != null) {

    $usuario = $controladorusuario->obtenerusuario(intval($_POST["dni"]));
    $iduser = intval($usuario[0]["id"]);
    $ficha = $turnosControladores->obtenerficha($iduser);
    if(sizeof($ficha)<=0){
        echo "<div class='alert alert-danger' role='alert'>El paciente no se encuentra con fichas registradas en el sistema</div>";
 
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<?php include("./includes/head.php"); ?>

<body>
    <?php include("./includes/menu.php"); ?>

    <div class="container">
        <h1 class="text-center">Fichas</h1>

        <div class="d-flex flex-column w-90 justify-content-center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <div class="mb-3">
                    <label for="dni" class="form-label">DNI de paciente</label>
                    <input type="number" class="form-control border-dark" name="dni" id="dni">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Buscar Ficha</button>
            </form>


            <?php if (sizeof($ficha) > 0): ?>
                <div class='card border-black mb-3' style='max-width: 18rem;'>
                    <div class='card-header bg-transparent border-black'>
                        <h5 class='card-title'>DNI:
                            <?php echo $ficha[0]["dni"] ?>
                        </h5>
                        <br>
                        Nombre y apellido:
                        <?php echo $ficha[0]["nombre"] . "  " . $ficha[0]["apellido"] ?>
                    </div>
                    <div class='card-body text-black'>

                        <p>DIAGNOSTICOS:
                            <?php echo $ficha[0]["diagnosticos"] ?>
                        </p>
                        <p>TRATAMIENTOS:
                            <?php echo $ficha[0]["tratamientos"] ?>
                        </p>
                        <p>ALERGIAS:
                            <?php echo $ficha[0]["alergias"] ?>
                        </p>
                        <p>MEDICAMENTOS:
                            <?php echo $ficha[0]["medicamentos"] ?>
                        </p>

                    </div>
                    <div class='card-footer bg-transparent border-black'>

                        <a href="<?php echo "editarFicha.php?pacienteid=" . $ficha[0]["id"] ?>"
                            class="btn btn-primary">editar</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <h1>Ingrese número dni para buscar ficha del paciente</h1>
        <?php endif; ?>



    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>