<?php
session_start();
if(isset($_SESSION["user"]) && sizeof($_SESSION["user"][0]) == 7){
header("location:index.php");
exit();
}
include("../controller/UsersController.php");
$controladorUsuarios = new UsersController();

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $dniAenviar = intval($_POST["dni"]);
    $datosaenviar = array(
        "dni" => $_POST["dni"],
        "password" => $_POST["password"]
    );
    $logueado = $controladorUsuarios->login($datosaenviar);
    if (sizeof($logueado) > 0){
        $_SESSION["user"] = $logueado;
       echo " <div class='alert alert-success' role='alert'>
            Logueado correctamente
            </div>";
            header("location:login.php");
            exit();

    }else{
echo "<div class='alert alert-danger' role='alert'>
datos incorrectos
</div>";
    }
  

}


?>



<!DOCTYPE html>
<html lang="es">

<?php include("./includes/head.php"); ?>

<body>
    <?php include("./includes/menu.php"); ?>

    <div class="container">
        <h1 class="text-center">Agregar usuario</h1>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])  ?>" method="post">

  <div class="form-group">
    <label for="dni">DNI: </label>
    <input type="number" class="form-control" id="dni" name="dni"  placeholder="dni">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
  </div>

  <button type="submit" name="submit"class="btn btn-primary">Submit</button>
</form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

</body>

</html>