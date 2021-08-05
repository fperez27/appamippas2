<?php
error_reporting(0);

include 'funciones.php';
include('dbconect.php');
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

require('config0.php');


//$rut = $_POST["rut"];
//$separada = explode('-', $rut);
//$rt = $separada['0'];


$rut = $_POST["rut"];
$separada = explode('-', $rut);
$rt = $separada['0'];
$fecha = $_POST["fecha"];

$fecha2 = date("Y/m/d");

$where =" AND 1=1";


if ($rt <> "") { $where .=" AND B.RUT= '$rt'"; }
if ($fecha <> "") { $where .=" AND A.FECHA='$fecha'"; } 




$result0 = $connexion ->query("SELECT count(*) as total_products  FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT ".$where);
//$result0 = $connexion->query('SELECT COUNT(*) as total_products FROM carga_amipass WHERE '.$where);
$row = $result0->fetch_assoc();
$num_total_rows = $row['total_products'];







$titulo = $rt ? 'Registro carga Amipass (' . $rt  . ')' : 'Registro carga Amipass';






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
        var rut=document.getElementById("rutt").value;       
            //var pizza = "porción1 porción2 porción3 porción4 porción5 porción6";
            var porciones = rut.split('-');
            var ruut =  porciones[0]; 
            var fecha = $("#feecha").val();
            //var fechaini=document.getElementById("fechaini").value;
            //var fechafin=document.getElementById("fechafin").value;
            //var dia=$("#dia").val();


       // location.href="actiongrabar.php?rut="+ruut;
      window.open("../production/fpdf/imprimir.php?rut="+ruut+"&fecha="+fecha);
    }</script>
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

            <input type="hidden" id="rutt" value="<?php echo mostrar($rut); ?>">
             <input type="hidden" id="feecha" value="<?php echo mostrar($fecha); ?>">
             <input type="hidden" id="feechaini" value="<?php echo mostrar($fechaini); ?>">
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
                       <li><a href="perchnormales.php">Horas Normales</a> </li>
                      <li><a href="import21.php">Importar Amipass </a></li>
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
                            <h4 class="text-center">X Persona</h4>
                          </a>
                             <a href="excelpersonas.php?rut=<?php echo mostrar($rt);?>&fecha=<?php echo $fecha;?>" class="btn btn">
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
        <div class="form-group mr-3">
          <input type="date" id="fecha" name="fecha" class="form-control-sm">
        </div>


        <input name="csrf" type="hidden" value="<?php echo mostrar($_SESSION['csrf']); ?>">
        <button type="submit"  class="btn btn-primary">Ver resultados</button>
      </form>
    </div>
  </div>
</div>

<!-- -->
<!-- -->

<div class="container">
  
    <hr>
  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->


<p></p><p></p><br>
         
<?php
    $sqlSelect = "SELECT B.SECCION, A.ID_SOL,A.HORA, A.FECHA, CONCAT(A.RUT, '-' ,B.DV ) AS RUT, CONCAT(B.NOMBRE, ' ',B.APEPAT, ' ',B.APEMAT) AS FULLNAME   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT " .$where ;
    $result = mysqli_query($con, $sqlSelect);

if (mysqli_num_rows($result))
{
?>
        
   <table class="table table-responsvive">
                 <thead>
                <tr>
                    <td>ID</td>
                    <td>RUT</td>
                    <td>NOMBRE</td>
                    <td>FECHA</td>
                    <td>HORA</td>
                    <td>SECCION</td>
            </tr>
             </thead>
            <tbody>
<?php
if ($num_total_rows > 0) {
    $page = false;

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    }

    if (!$page) {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
    }
    //calculo el total de paginas
    $total_pages = ceil($num_total_rows / NUM_ITEMS_BY_PAGE);

    //'SELECT sum(MONTO) as tmonto FROM carga_amipass WHERE ' .$where. ' ORDER BY ID DESC LIMIT '.$start.', '.NUM_ITEMS_BY_PAGE
    $result = $connexion->query('SELECT B.SECCION, A.ID_SOL, A.HORA, A.FECHA, CONCAT(A.RUT, "-", B.DV) AS RUT, CONCAT(B.NOMBRE, " ", B.APEPAT, " ", B.APEMAT) AS FULLNAME FROM solicitud_alimentacion AS A, personal AS B WHERE A.RUT = B.RUT '.$where.' ORDER BY A.ID_SOL DESC LIMIT '.$start.', '.NUM_ITEMS_BY_PAGE );
    //$result = $connexion->query("SELECT B.SECCION, A.ID_SOL,A.HORA, A.FECHA, CONCAT(A.RUT, '-' ,B.DV ) AS RUT, CONCAT(B.NOMBRE, ' ',B.APEPAT, ' ',B.APEMAT) AS FULLNAME   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT " .$where." ORDER BY ID DESC LIMIT ".$start.", ".NUM_ITEMS_BY_PAGE);
    //$result = $connexion->query('SELECT * from carga_amipass WHERE '.$where.' ORDER BY ID DESC LIMIT '.$start.', '.NUM_ITEMS_BY_PAGE);
    if ($result->num_rows > 0) {
      $o=1;
        echo '<ul class="row items">';
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$o."</td>";
            echo "<td>".$row['RUT']."</td>";
            echo "<td>".$row['FULLNAME']."</td>";
            echo "<td>".$row['FECHA']."</td>";
            echo "<td>".$row['HORA']."</td>";
            echo "<td>".$row['SECCION']."</td>";
            echo "</tr>";

             
            $o++;

        }
        echo '</ul>';
    }

    echo '<nav>';
    echo '<ul class="pagination">';

        $fecha12 = $_POST['feecha'];
    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="xxpersona2.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="xxpersona2.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="xxpersona2.php?page='.($page+1).'&fecha="'.$fecha.'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';
}
?>


        </tbody>
    </table>
<?php 
} 
?>
      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 

  
</div>








                   

<!-- -->
<!-- -->
                    
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

