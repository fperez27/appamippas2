<?php
session_start();
error_reporting(0);  
$nombreServidor = "localhost";
  $nombreUsuario = "root";
  $passwordBaseDeDatos = "";
  $nombreBaseDeDatos = "amipass";
  
  // Crear conexión con la base de datos.
  $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);

  // Obtengo los datos cargados en el formulario de login.
  $usuario = $_POST['usuario'];
  $password = $_POST['pass'];
   
  
  // Validar la conexión de base de datos.
  if ($conn->connect_error) {
    die("Connection failed: " . $conn ->connect_error);
  }
   
  // Consulta segura para evitar inyecciones SQL.
  //$sql = sprintf("SELECT * FROM usuari_amipass WHERE USUARIO='%s' AND PASS = %s", mysql_real_escape_string($usuario), mysql_real_escape_string($password));
  $sql = "SELECT * FROM usuari_amipass WHERE USUARIO='usuario'";
  $resultado = $conn->query($sql);
   
  // Verificando si el usuario existe en la base de datos.
  if($resultado){
             echo "<script type='text/javascript'>
                  alert('El usuario y el pass ingresados no conciden');
                  window.location='index.html';
                </script>";

    // Redirecciono al usuario a la página principal del sitio.
  }else{
    echo "<script type='text/javascript'>
    alert('El usuario ".$_POST["usuario"]." no existe en  la base de datos');
    window.location='login.html';
  </script>";
  }




?>
