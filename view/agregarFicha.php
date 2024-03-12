<?php 
session_start();
if(isset($_SESSION["user"])){
  if($_SESSION["user"][0]["rol"] != "medico"){
    header("location: index.php");  
  }
}else{
  header("location: index.php");
}
require("../controller/UsersController.php");
require("../controller/FichasController.php");



if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
    $controladorusuario = new UsersController();
    $controladorficha = new FichasController();

    $usuario = $controladorusuario->obtenerusuario(intval($_POST["dni"]));
    $existeficha = sizeof($controladorficha->obtenerficha(intval($usuario[0]["id"]))) >0 ? true : false;
    if(!$existeficha){
        $dniUsuario = intval($usuario[0]["id"]);
        $datosaenviar = array(
        "pacienteid" => $dniUsuario,
        "diagnosticos" => $_POST["diagnosticos"],
        "tratamientos" => $_POST["tratamientos"],
        "medicamentos" => $_POST["medicamentos"],
        "alergias" => $_POST["alergias"],
       ); 
       
       
       
        $respuesta = $controladorficha -> agregarficha($datosaenviar);
        echo $respuesta;
    }else{
        echo "<div class='alert alert-danger' role='alert'>El dni ya tiene ficha registrada</div>";
    }
    
} 


?>



<!DOCTYPE html>
<html lang="es">

<?php include("./includes/head.php"); ?>

<body>
   <?php include("./includes/menu.php"); ?>
   
<div class="container">  
<h1 class="text-center">Agregar ficha</h1>   

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

  <div class="mb-3">
    <label for="dni" class="form-label">DNI de paciente</label>
    <input type="number" class="form-control border-dark" name= "dni" id="dni" >
  </div>
  <div class="mb-3">
    <label for="tratamientos" class="form-label">tratamientos</label>
    <input type="text" class="form-control border-dark" name= "tratamientos" id="tratamientos"  >
  </div>
  <div class="mb-3">
    <label for="alergias" class="form-label">alergias</label>
    <input type="text" class="form-control border-dark"  name= "alergias" id="alergias" >
  </div>
  <div class="mb-3">
    <label for="diagnosticos" class="form-label">diagnosticos</label>
    <input type="text" class="form-control border-dark" name= "diagnosticos"  id="diagnosticos" >
  </div>
  <div class="mb-3">
    <label for="medicamentos" class="form-label">medicamentos</label>
    <input type="text" class="form-control border-dark" name= "medicamentos"  id="medicamentos" >
  </div>
  <button type="submit" name="submit"class="btn btn-primary">Crear Ficha</button>
</form>

</div>

        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>