<?php
session_start();
error_reporting(0);
require 'conexion.php';
include 'funciones.php';
include('dbconect.php');
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

require('config0.php');

$rut = $_POST["rut11"];
$separada = explode('-', $rut);
$rt = $separada['0'];
$dv = $separada['1'];
//$rut = $_POST['rut1'];
//$centroc = $_POST['centroc'];
//$unidad = $_POST['unidada'];

$fecha2 = date("Y/m/d");

$where =" 1=1 ";


if ($rt <> "") { $where .=" AND RUT= '$rt'"; }
//if ($fecha <> "") { $where .=" AND FECHA BETWEEN '$fechaini' AND '$fecha' "; } 
//if ($centroc <> "") { $where .= " AND CENTROCOSTOS = '$centroc' "; }

$result0 = $connexion->query('SELECT count(*) as total_products FROM funcionarios WHERE ' .$where);
//$result0 = $connexion->query('SELECT COUNT(*) as total_products FROM carga_amipass WHERE '.$where);
$rows = $result0->fetch_assoc();
$num_total_rows = $rows['total_products'];



//$titulo = $rt ? 'Registro carga Amipass (' . $rt  . ')' : 'Registro carga Amipass';
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
    <?php include("modal_horaextra.php");?>  
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script type="text/javascript">
      function extras_funcionario(rut) {
        $("#modalForm").modal("show");
        $("#inputRut").val(rut); 
      }

      function abremodal(rut, nombre){
        $('#dataRegister').modal('show');
        //$('#modalForm').modal("show");
         $("#inputRut").val(rut);
         $("#inputName").val(nombre);
         //location.index = './modal_horaextra.php?url='+rut;

         
      }

      function imprimir() {
        var rut=document.getElementById("rutt").value;       
            //var pizza = "porción1 porción2 porción3 porción4 porción5 porción6";
            var porciones = rut.split('-');
            var ruut =  porciones[0]; 
            var fecha = $("#feecha").val();
            var centroc =$('#centrocc2').val();
            //var centroc = document.getElementById("centrocc").value; 
            //var fechaini=document.getElementById("fechaini").value;
            //var fechafin=document.getElementById("fechafin").value;
            //var dia=$("#dia").val();


       // location.href="actiongrabar.php?rut="+ruut;
      window.open("../production/fpdf/imprimecargaamipass.php?rut="+ruut+"&fecha="+fecha+"&centroc="+centroc);
    }

    function imprimecc(){
          //var rut =  document.getElementById("rutt").value;
          //var porcion = rut.split('-');
          //var ruut = porcion[0];
          var fecha = $('#feecha').val();
          var fechaini = $('#feechaini').val();
          var centroc = $('#centrocc2').val();

          window.open("../production/fpdf/imprimecentrocostos.php?fecha="+fecha+"&fechaini="+fechaini);
    }

    function imprimecr(){
      var fecha = $('#feecha').val();
      var fechaini = $('#feechaini').val();

      window.open("../production/fpdf/imprimecentrorespons.php?fecha="+fecha+"&fechaini="+fechaini);

    }

    function cargadatos(rut){
      $('#inputRut').val(rut);
      $('#inputName').val(nombre);
      $('#inputUnidad').val(unidad);
      $('#inputDv').val(dv);

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

            <input type="hidden" id="rutt" value="<?php echo mostrar($rut); ?>">
             <input type="hidden" id="feechaini" value="<?php echo mostrar($fechaini); ?>">
             <input type="hidden" id="feecha" value="<?php echo mostrar($fecha); ?>">
             <input type="hidden" id="centrocc2" value="<?php echo mostrar($centroc); ?>">
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
                

                           <a class="btn btn" href="excelhorasextras.php">
                               <img class="text-center" src="images/555.png" width="180px" alt="Cargando imagen..."  > 
                               <label></label>
                              <h5 class="text-center">Imprime Centro de Costos</h5>
                        </a>

                             
                         
                           
                            
                           
                    </div>

                              <div class="container">
  <div class="row">
    <div class="col-md-12">
      <!-- <a href="crear.php"  class="btn btn-primary mt-4">Crear alumno</a>-->
    
      <form method="post" class="form-inline">
        <div class="form-group mr-3">
          <input type="text" name="rut11" id="rut11" class="form-control-sm" placeholder="Ingrese Rut" oninput="checkRut(this)" maxlength="10">
        </div>
        <div class="form-group mr-3">
          <input type="text" id="unidada" name="unidada" class="form-control-sm" placeholder="Ingrese Unidad">
        </div>


        <div class="form-group mr-3">
       
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

   
  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->
    
    
    
<p></p><p></p><br>
         
<?php
    $sqlSelect = "SELECT * FROM personal WHERE " .$where;
    //$sqlSelect = "SELECT * FROM carga_amipass WHERE " .$where;
    $result = mysqli_query($con, $sqlSelect);

if (mysqli_num_rows($result))
{
?>
        
   <table class="table table-responsvive">
                 <thead>
                <tr>
                    <td>ID</td>
                    <td>NOMBRE</td>
                    <td>RUT</td>
                    <td>Acción</td>
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




 
  //  echo '<h3>En cada pagina se muestra '.NUM_ITEMS_BY_PAGE.' registros ordenados por fecha en formato descendente.</h3>';
   // echo '<h3>Mostrando la pagina '.$page.' de ' .$total_pages.' paginas.</h3>';

   // $result = $connexion->query( 'SELECT * FROM product p  LEFT JOIN product_lang pl ON (pl.id_product = p.id_product AND pl.id_lang = 1)  LEFT JOIN `image` i ON (i.id_product = p.id_product AND cover = 1)  WHERE active = 1  ORDER BY date_upd DESC LIMIT '.$start.', '.NUM_ITEMS_BY_PAGE);

    $result = $connexion->query('SELECT * from funcionarios WHERE '.$where.' ORDER BY RUT DESC LIMIT '.$start.', '.NUM_ITEMS_BY_PAGE);
    //$result = $connexion->query('SELECT * from carga_amipass WHERE '.$where.' ORDER BY ID DESC LIMIT '.$start.', '.NUM_ITEMS_BY_PAGE);
    if ($result->num_rows > 0) {
        echo '<ul class="row items">';
        while ($row = $result->fetch_assoc()) {
        $ruut1 = $row['RUT'];
      $rut1 = ($row['RUT'].'-'.$row['DV']);
      $dv2 = $row['DV'];
      //$nomb222 = $row['NOMBREFUNCIONARIO'];
      $nomb222 = $row['NOMBRE']. ' ' .$row['APEPAT'].' '.$row['APEMAT'];

      if ($row['UNIDAD'] == '') {
          $unidad = '<font color="#FF1300" >SIN UNIDAD ASIGNADA</font> ';
      }else{
          $unidad = $row['UNIDAD'];
      }

      /*$nom1 = utf8_encode($row['NOMBREFUNCIONARIO']);
            echo "<tr>";
            echo "<td>".$row['ID']."</td>";
            echo "<td>".($row['NOMBREFUNCIONARIO'])."</td>";
            echo "<td>".$row['RUT']."-".$row['DV']."</td>";

            echo '<td>'.$row["UNIDAD"].'</td>';
            echo '<td><button class="btn btn-success"  onclick="abremodal('.$rut1.')">Abrir</button></td>';
            echo "</tr>";*/

                  echo "<tr>";
                  echo "<td>".$rut1."</td>";
                  echo "<td>".$nomb222."</td>";
                  echo "<td>".$unidad."</td>";?>
                  <td><button class="btn btn-success"  data-toggle="modal"  onclick="abremodal('<?php echo mostrar($rut1) ?>', '<?php echo mostrar($nomb222) ?>', )">Abrir</button></td>
            <?php echo "</tr>";
            
        }
        echo '</ul>';
    }

    echo '<nav>';
    echo '<ul class="pagination">';

        $fecha12 = $_POST['feecha'];
    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="horaextras.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="horaextras.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="horaextras.php?page='.($page+1).'&fecha="'.$fecha.'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';
}
?>



      <tr>
        
        <td></td>
        <td></td>
        <td></td>
        <td></td>

      </tr>
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

<?php 
$rutrut = $_GET["inputRut"];

$query23 = $connexion->query("SELECT * FROM personal WHERE RUT = '$rutrut'");
$row123 = $query23->fetch_assoc();
$num_total_rows2 = $row123['NOMBRE'];
$roout = $row123['RUT'];


?>



<!-- modal contenido 
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
    
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
               
            </div>

            <div class="modal-body">
                <h2>Ingreso Horas Extras</h2>
                <form role="form" method="POST" action="guardarhextras.php">
                    <div class="form-group">
                        <label for="inputRut">Rut</label>
                        <input type="text" class="form-control" id="inputRut" name="inputRut" readonly="" /> 
                    </div>
          
                    <div class="form-group">
                        <label for="inputHE100">Horas Extras 100%</label>
                        <input class="form-control" id="he100" name="he100">
                    </div>
                    <div class="form-group">
                        <label for="inputHE125">Horas Extras 125%</label>
                        <input class="form-control" id="he125" name="he125">
                    </div>
                    <div class="form-group">
                        <label for="inputHE150">Horas Extras 150%</label>
                        <input class="form-control" id="he150" name="he150">
                    </div>

                
            </div>
            
          
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary submitBtn" >Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>-->

