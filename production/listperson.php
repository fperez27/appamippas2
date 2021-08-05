<?php
error_reporting(0);


include 'funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}


$error = false;
$config = include 'config.php';
try {

$rut = $_POST["rut"];
$separada = explode('-', $rut);
$rt = $separada['0'];
$fecha = $_POST['fecha'];


$where ="1=1";

if ($rt <> "") { $where .=" AND B.RUT= '$rt'"; }

  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

 
    $consultaSQL = "SELECT DISTINCTROW (A.RUT), B.DV, B.NOMBRE, B.APEPAT, B.APEMAT, B.SECCION FROM solicitud_alimentacion AS A, personal AS B WHERE ".$where."  AND A.RUT = B.RUT ORDER BY RUT ASC ";

//$consultaSQL = "SELECT B.SECCION, A.ID_SOL,A.HORA, A.FECHA, CONCAT(A.RUT, '-' ,B.DV ) AS RUT, CONCAT(B.NOMBRE, ' ',B.APEPAT, ' ',B.APEMAT) AS FULLNAME   FROM solicitud_alimentacion as A, personal as B WHERE ".$where." AND A.RUT=B.RUT ";





  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $alumnos = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
}

$titulo = $seccion ? 'Registro de alimentación (' . $seccion  . ')' : 'Registro de alimentación';
?>

<!DOCTYPE html>
<html lang="es">

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
        //var seccion=$('#secci').val();       
            //var pizza = "porción1 porción2 porción3 porción4 porción5 porción6";



       // location.href="actiongrabar.php?rut="+ruut;
      window.open("../production/fpdf/imprimirlistado.php");
    }

    function modificar_funcionario(rut) {
      parent.location.href="modificar_funcionario.php?rut=" + rut;
    }
  </script>
  </head>

  <body class="nav-md">
      <?php include("modal_modificar.php");?>
  <?php include("modal_eliminar.php");?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-list"></i> <span></span></a>
            </div>

            <div class="clearfix"></div>

            <input type="hidden" id="secci" value="<?php echo mostrar($seccion); ?>">
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
                      <li><a href="import21.php">Importar Amipass </a></li>
                    </ul>
                  </li>

                   <li><a><i class="fa fa-file-text"></i>PERC <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="perchnormales.php">Horas Normales</a> </li>
                      <li><a href="horaextras.php">Horas Extras</a></li>
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
 <form  method = "POST">
            <div class="clearfix"></div>
              <div class="col-md-6 col-sm-6  form-group has-feedback">
                      <a class="btn btn" >
                              <img class="text-center" src="images/pdf2.png" width="180px" alt="Cargando imagen..." onclick="imprimir();" >
                       
                            <h4 class="text-center">Listado</h4>
                            </a>
                             <a href="excellistperson.php?rut=<?php echo mostrar($rt);?>">
                               <img class="text-center" src="images/555.png" width="160px" alt="Cargando imagen..."  > 
                            
                           
                          </a>
                    </div>


                              <div class="container">
  <div class="row">
    <div class="col-md-12">
      <!-- <a href="crear.php"  class="btn btn-primary mt-4">Crear alumno</a>-->
      <hr>
      <form method="post" class="form-inline">
        <div class="form-group mr-3">
          <input type="text" id="rut" name="rut" placeholder="Buscar por rut" class="form-control-sm" equired oninput="checkRut(this)" maxlength="10">
        </div>
        


        <input name="csrf" type="hidden" value="<?php echo mostrar($_SESSION['csrf']); ?>">
        <button type="submit"  class="btn btn-primary">Ver resultados</button>

        
      </form>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3"><?= $titulo ?></h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Rut</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Unidad</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=1;
          if ($alumnos && $sentencia->rowCount() > 0) {
            foreach ($alumnos as $fila) {
              $rut = $fila['RUT'];
              ?>
              <tr>
                <td><?php echo mostrar($i); ?></td>
                <td><?php echo mostrar($fila["RUT"]); ?></td>
                <td><?php echo mostrar(utf8_encode($fila["NOMBRE"])); ?></td>
                <td><?php echo mostrar($fila["APEPAT"]); ?></td>
                <td><?php echo mostrar($fila["APEMAT"]); ?></td>
                <td><?php echo mostrar($fila["SECCION"]); ?></td>
                <td><button type="button" class="btn btn-info" onclick="modificar_funcionario(<?php echo $rut;?>);" data-toggle="modal" ><i class='glyphicon glyphicon-edit'></i> Modificar</button>
           
              </tr>
              <?php
              $i++;
            }
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>





                   


                    
                  </form>
            
                </div>
              </div>




          <!------ --->


        <!-- footer content -->
        <footer>
          <div class="pull-right">
            
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
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

