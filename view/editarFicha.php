<?php
session_start();
if(isset($_SESSION["user"])){
    if($_SESSION["user"][0]["rol"] != "medico"){
      header("location: index.php");  
    }
    if($_GET["pacienteid"] == null){
        header("location: index.php");  

    }
  }else{
    header("location: index.php");
  }
require("../controller/FichasController.php");

$controladorFichas = new FichasController();
$datosFicha = $controladorFichas->obtenerficha(intval($_GET["pacienteid"]));
 if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $datosaenviar = array(
        "medicamentos" => $_POST["medicamentos"],
        "tratamientos" => $_POST["tratamientos"],
        "alergias" => $_POST["alergias"],
        "diagnosticos" => $_POST["diagnosticos"],
        "pacienteid" => intval($_GET["pacienteid"]));
    $enviar = $controladorFichas->editarficha($datosaenviar);
    var_dump($enviar);

}


?>



<!DOCTYPE html>
<html lang="es">

<?php include("./includes/head.php"); ?>

<body>
    <?php include("./includes/menu.php"); ?>

    <div class="container">
        <h1 class="text-center">Agregar usuario</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?pacienteid=".intval($_GET["pacienteid"])  ?>" method="post">

            
            <div class="mb-3">
                <label for="tratamientos" class="form-label">tratamientos</label>
                <input type="text" class="form-control border-dark" name="tratamientos" id="tratamientos"
                    value="<?php echo $datosFicha[0]["tratamientos"] ?>" >
            </div>
            <div class="mb-3">
                <label for="diagnosticos" class="form-label">diagnosticos</label>
                <input type="text" class="form-control border-dark" name="diagnosticos" id="diagnosticos"
                    value="<?php echo $datosFicha[0]["diagnosticos"] ?>" >
            </div>
            <div class="mb-3">
                <label for="medicamentos" class="form-label">medicamentos</label>
                <input type="text" class="form-control border-dark" name="medicamentos" id="medicamentos"
                    value="<?php echo $datosFicha[0]["medicamentos"] ?>" >
            </div>
            <div class="mb-3">
                <label for="alergias" class="form-label">alergias</label>
                <input type="text" class="form-control border-dark" name="alergias" id="alergias"
                    value="<?php echo $datosFicha[0]["alergias"] ?>" >
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Editar ficha</button>
        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>