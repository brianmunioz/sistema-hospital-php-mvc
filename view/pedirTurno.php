<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();


if (!isset($_SESSION["user"])) {
    header("location: index.php");
} else {
    if ($_SESSION["user"] && $_SESSION["user"][0]["rol"] != "paciente") {
        header("location: index.php");
    }
}
require("../controller/TurnosController.php");
require("../controller/UsersController.php");

$controladorusuario = new UsersController();
$medicos = $controladorusuario->getMedicos();

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $datosaenviar = array(
        "dia" => $_POST["dia"],
        "hora" => $_POST["hora"],
        "medicoid" => intval($_POST["medico"]),
        "causa" => $_POST["causa"],
        "pacienteid" => intval($_SESSION["user"][0]["id"]),
    );


    $controladorturno = new TurnosController();
     $enviar = $controladorturno -> agregarTurno($datosaenviar);

    var_dump($enviar);
}


?>



<!DOCTYPE html>
<html lang="es">

<?php include("./includes/head.php"); ?>

<body>
    <?php include("./includes/menu.php"); ?>

    <div class="container">
        <h1 class="text-center">Registrar turno</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="mb-3">
                <label for="dia" class="form-label">Dia</label>
                <input type="date" class="form-control border-dark" id="dia" name="dia"
                    min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">

            </div>
            <div class="mb-3">
                <label for="hora">Selecciona un horario:</label>
                <select name="hora" id="hora">
                    <option value="10:00">10:00 AM</option>
                    <option value="10:30">10:30 AM</option>
                    <option value="11:00">11:00 AM</option>
                    <option value="11:30">11:30 AM</option>
                    <option value="12:00">12:00 PM</option>
                    <option value="12:30">12:30 PM</option>
                    <option value="13:00">01:00 PM</option>
                    <option value="13:30">01:30 PM</option>
                    <option value="14:00">02:00 PM</option>
                    <option value="14:30">02:30 PM</option>
                    <option value="15:00">03:00 PM</option>
                    <option value="15:30">03:30 PM</option>
                    <option value="16:00">04:00 PM</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="medico">Médico: </label>
                <select name="medico" id="medico">
                    <?php
                    if ($medicos) {
                        foreach ($medicos as $medico) {
                            echo "<option value='" . $medico["id"] . "'> DR." . $medico["nombre"] . " " . $medico["apellido"] . "</li>";

                        }
                    } else {
                        echo " <option value='novalue'>No hay medicos</option>";

                    }



                    ?>

                </select>
            </div>
            <div class="mb-3">
                <label for="tratamientos" class="form-label">Causa</label>
                <input type="text" class="form-control border-dark" name="causa" id="causa">
            </div>


            <button type="submit " name="submit" class="btn btn-primary">Crear turno</button>
        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>