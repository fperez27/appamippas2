<?php
error_reporting(0);
include 'funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}


$error = false;
$config = include 'config.php';

$usuario = $_POST['usuario'];
$pass = $_POST['pass'];




  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);


    $consultaSQL = "SELECT * FROM usuari_amipass where USUARIO = '$usuario'";
    $resultado2 = mysqli_query($conexion, $consultaSQL);

    if (mysqli_num_rows($resultado2) == 0){
  echo "<script type='text/javascript'>
    alert('El usuario ".$usuario." no existe en  la base de datos');
    window.location='login.html';
  </script>";
}else{
  echo "<script type='text/javascript'>
    alert('El usuario ".$usuario."  existe en  la base de datos');
    window.location='index.html';
  </script>";
}








  //$error= $error->getMessage();





?>