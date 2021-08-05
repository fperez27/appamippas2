<?php


error_reporting(0);
include 'funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}


$error = false;
$config = include 'config.php';
//$fecha = '';
try {
$rut = $_GET['rut'];


  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);


    $consultaSQL = "SELECT RUT, DV, NOMBRE , APEPAT, APEMAT, SECCION   FROM  personal  WHERE RUT='$rut'";
 

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  

  $alumnos = $sentencia->fetchAll();

   if ($alumnos && $sentencia->rowCount() > 0) {
    foreach ($alumnos as $fila) {
      //$nombre = $alumnos['NOMBRE'];
       $nombre=  mostrar($fila["NOMBRE"]);
       $apepat=  mostrar($fila["APEPAT"]);
       $apemat=  mostrar($fila["APEMAT"]);
       $unidad=  mostrar($fila["SECCION"]);
       $dv=  mostrar($fila["DV"]);
    }
   }

} catch(PDOException $error) {
  $error= $error->getMessage();
}
$newDate = date("d/m/Y", strtotime($fecha));

$titulo = $fecha ? 'Registro de alimentación (' . $fecha  . ')' : 'Registro de alimentación';
?>


<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/lafavicon.ico" type="image/ico" />
    <title>Registro Alimentacion</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <script src="js/validarRUT.js"></script>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script type="text/javascript">  
      function imprimir() {

            var fecha=document.getElementById("rutt").value;

       // location.href="actiongrabar.php?rut="+ruut;
      window.open("../production/fpdf/imprimirdiario.php?fecha="+fecha);
    }

    function cancelar() {
      location.href="./listperson.php";
    }
  </script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-list"></i> <span></span></a>
            </div>

            <div class="clearfix"></div>
           
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
               
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-desktop"></i>Modulo Ingreso<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ingresonuevo.php">Nuevo Funcionario</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file-text"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="xpersona.php">X Persona</a></li>
                      <li><a href="rangofecha.php">X Rango de fecha</a></li>
                      <li><a href="diario.php">Diario</a></li>
                      <li><a href="seccion.php">Unidad</a></li>
                      <li><a href="listperson.php">Listado Personas</a></li>
                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-file-text"></i>Amipass <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="importaamipass22.php">Ver Registros Amipass </a></li>
                    </ul>
                  </li>
                  
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>


        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

                   


                    <div class="container">
  <div class="row">
    <div class="col-md-12">
      <!-- <a href="crear.php"  class="btn btn-primary mt-4">Crear alumno</a>-->
      <hr>
      <form role="form" action="actualiza.php" method="POST" >
              <div class="modal-body">
                    <div id="datos_ajax"></div>
                        <div class="form-group">
                          <label for="codigo" class="control-label">Rut</label>
                          <input type="text" class="form-control" id="rut" name="rut" value="<?php echo $rut;?>-<?php echo $dv?>" required style="width:350px" readonly>
                    
                        </div>
                    <div class="form-group">
                          <label for="nombre" class="control-label">Nombre:</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre?>" required style="width:350px">
                        </div>
                    <div class="form-group">
                          <label for="moneda" class="control-label">Apellido Paterno:</label>
                          <input type="text" class="form-control" id="apepat" name="apepat" value="<?php echo $apepat?>" required style="width:350px">
                        </div>
                    <div class="form-group">
                          <label for="capital" class="control-label">Apellido Materno:</label>
                          <input type="text" class="form-control" id="apemat" name="apemat" value="<?php echo $apemat?>" required style="width:350px"> 
                        </div>
                         <?php
                            $mysqli = new mysqli('localhost', 'root', '', 'amipass');

                          ?>
                        <div class="form-group">
                          <label for="continente" class="control-label">Unidad:</label>
                         <select class="form-control-sm" id="unidad" name="unidad"  >
                                                      <option value="<?php  echo $unidad?>"><?php  echo $unidad?></option>
                                                      <?php
                                                  $query = $mysqli -> query ("SELECT * FROM servicios");
                                                  while ($valores = mysqli_fetch_array($query)) {
                                                    echo '<option value="'.$valores['NOMBRE'].'">'.$valores['NOMBRE'].'</option>';
                                                  }
                                                ?>
                                                    </select>


                                                 <!-- <option value="<?php  //echo $ss2015 apunidad?>"><?php  //echo $unidad?></option>
                                                  <option value="ADMISION">ADMISION</option>
                                                  <option value="ALCOHOL Y DROGAS">ALCOHOL Y DROGAS</option>
                                                  <option value="ASESORIAS">ASESORIAS</option>
                                                  <option value="BANCO DE SANGRE">BANCO DE SANGRE</option>
                                                  <option value="BIBLIOTECA">BIBLIOTECA</option>
                                                  <option value="CENTRAL ALIMENTACION">CENTRAL ALIMENTACION</option>
                                                  <option value="CENTRAL TELEFONICA">CENTRAL TELEFONICA</option>
                                                  <option value="CENTRO TRATAMIENTO ADICCIONES">CENTRO TRATAMIENTO ADICCIONES</option>
                                                  <option value="CONTROL CENTRALIZADO">CONTROL CENTRALIZADO</option>
                                                  <option value="CONTROL DE GESTION">CONTROL DE GESTION</option>
                                                  <option value="COORD. PROG. PUEBLOS INDIGENAS">COORD. PROG. PUEBLOS INDIGENAS</option>
                                                  <option value="COORDINACION RED DE URGENCIA">COORDINACION RED DE URGENCIA</option>
                                                  <option value="DEPARTAMENTO DE AUDITORIA">DEPARTAMENTO DE AUDITORIA</option>
                                                  <option value="DEPARTAMENTO DE FINANZAS">DEPARTAMENTO DE FINANZAS</option>
                                                  <option value="DEPARTAMENTO DE INFORMATICA">DEPARTAMENTO DE INFORMATICA</option>
                                                  <option value="DEPARTAMENTO DE PROYECTO">DEPARTAMENTO DE PROYECTO</option>
                                                  <option value="DEPARTAMENTO JURIDICO">DEPARTAMENTO JURIDICO</option>
                                                  <option value="DEPTO DESARROLLO LAS PERSONAS">DEPTO DESARROLLO LAS PERSONAS</option>
                                                  <option value="DEPTO GESTION DE MODELOS APS">DEPTO GESTION DE MODELOS APS</option>
                                                  <option value="DEPTO GESTION E INFORMACION">DEPTO GESTION E INFORMACION</option>
                                                  <option value="DEPTO GESTION GES Y COORD RED">DEPTO GESTION GES Y COORD RED</option>
                                                  <option value="DEPTO RECURSOS HUMANOS">DEPTO RECURSOS HUMANOS</option>
                                                  <option value="DEPTO GESTION INF. ESTADISTICAS">DEPTO GESTION INF. ESTADISTICAS</option>
                                                  <option value="DEPTO. RECURSOS FISICOS FINANCIEROS">DEPTO. RECURSOS FISICOS FINANCIEROS</option>
                                                  <option value="DERMATOLOGIA">DERMATOLOGIA</option>
                                                  <option value="DIALISIS">DIALISIS</option>
                                                  <option value="DIRECCION DE HOSPITAL">DIRECCION DE HOSPITAL</option>
                                                  <option value="DIRECCION SERVICIO">DIRECCION SERVICIO</option>
                                                  <option value="DEPTO GESTION ASISTENCIAL">DEPTO GESTION ASISTENCIAL</option>
                                                  <option value="DEPTO GESTION E INVERSION">DEPTO GESTION E INVERSION</option>
                                                  <option value="DEPTO GESTION SOCIAL Y PARTICIPACION">DEPTO GESTION SOCIAL Y PARTICIPACION</option>                     
                          </select>-->
                          <!--<input type="text" class="form-control" id="unidad" name="unidad" value="<?php  //echo $unidad?>" required style="width:350px">-->
                        </div>
                        
                      
                    </div>
                    <div class="form-group">
                        <button type="submit"  class="btn btn-success">Guardar</button>
                         <button type="button"  class="btn btn-danger" onclick="cancelar();">Volver</button>
                        </div>
                        
            </form>
                    </div>
            
                </div>
              </div>



        <!-- footer content -->

      </div>
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
      </ul>
      <div class="clearfix"></div>
      <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  
  </body>
</html>

