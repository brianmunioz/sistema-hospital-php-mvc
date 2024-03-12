<?php
session_start();
require("../controller/TurnosController.php");

$turnosControladores = new TurnosController();
$turnos = [];

if (!isset($_SESSION["user"])) {
    header("location: index.php");
} else {
    if ($_SESSION["user"] && $_SESSION["user"][0]["rol"] == "admin" ) {
        header("location: index.php");
    }
}
if($_SESSION["user"][0]["rol"] == "paciente"){
    $turnos = $turnosControladores->getTurnosPaciente(intval($_SESSION["user"][0]["id"]));

}elseif($_SESSION["user"][0]["rol"] == "medico"){
    $turnos = $turnosControladores->getTurnosMedico(intval($_SESSION["user"][0]["id"]));

}
var_dump($turnos);




?>



<!DOCTYPE html>
<html lang="es">

<?php include("./includes/head.php"); ?>

<body>
    <?php include("./includes/menu.php"); ?>

    <div class="container">
        <h1 class="text-center">Mis turnos</h1>
        <div class="d-flex flex-column w-90 justify-content-center">
        <?php

foreach($turnos as $turno){
    echo "<div class='card border-black mb-3' style='max-width: 18rem;'>
    <div class='card-header bg-transparent border-black'> Hora ".$turno["hora"]."</div>
    <div class='card-body text-black'>
      <h5 class='card-title'>dia ".$turno["dia"]."</h5>
      
    </div>
    <div class='card-footer bg-transparent border-black'>medico ".$turno["nombre"]." ".$turno["apellido"]."</div>
  </div>";
}



        ?>
        </div>
        
      
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>