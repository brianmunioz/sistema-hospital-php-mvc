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


if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
 $datosaenviar = array(
 "nombre" => $_POST["nombre"],
 "password" => $_POST["password"],
 "apellido" => $_POST["apellido"],
 "rol" => $_POST["rol"],
 "dni" => $_POST["dni"],
 "mail"=> $_POST["email"],); 


 $controladorusuario = new UsersController();
 $controladorusuario -> agregarusuario($datosaenviar);
 var_dump($datosaenviar);
} 


?>



<!DOCTYPE html>
<html lang="es">

<?php include("./includes/head.php"); ?>

<body>
   <?php include("./includes/menu.php"); ?>
   
<div class="container">  
<h1 class="text-center">Agregar usuario</h1>   

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

  <div class="mb-3">
    <label for="dni" class="form-label">DNI</label>
    <input type="number" class="form-control border-dark" name= "dni" id="dni" aria-describedby="dnihelp">
    <div id="dnihelp" class="form-text">El dni debe tener 8 digitos</div>
  </div>
  <div class="mb-3">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" class="form-control border-dark" name= "nombre" id="nombre" aria-describedby="nombrehelp" >
    <div id="nombrehelp" class="form-text">El nombre es un campo obligatorio</div>
  </div>
  <div class="mb-3">
    <label for="apellido" class="form-label">apellido</label>
    <input type="text" class="form-control border-dark"  name= "apellido" id="apellido" aria-describedby="apellidohelp">
    <div id="apellidohelp" class="form-text">El apellido es un campo obligatorio</div>
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">mail</label>
    <input type="email" class="form-control border-dark" name= "email"  id="email" aria-describedby="emailhelp">
    <div id="emailHelp" class="form-text">El email es un campo obligatorio</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">password</label>
    <input type="password" class="form-control border-dark" name= "password"  id="password" aria-describedby="passhelp">
    <div id="passhelp" class="form-text">El password es un campo obligatorio</div>
  </div>
  <div class="mb-3">
  <label for="rol" name="rol" class="form-label">rol</label>

  <select class="form-select border-dark"  id="rol" aria-label="paciente">
  <option value="paciente" selected>paciente</option>
  <option value="medico">medico</option>
  <option value="admin">admin</option>
</select>
  </div>
 
  <button type="submit" name="submit"class="btn btn-primary">Registrar usuario</button>
</form>

</div>

        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>