<?php
error_reporting(0);

//include 'funciones.php';
include('dbconect.php');
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

require('config0.php');


//$rut = $_POST["rut"];
//$separada = explode('-', $rut);
//$rt = $separada['0'];
$fecha = $_POST['fecha'];
//$centroc = $_POST['centroc'];
$fechaini = $_POST['fechaini'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];

$fecha2 = date("Y/m/d");

$where ="1=1";


//if ($ano <> "") { $where .=" AND RUT= '$rt'"; }
if ($fecha <> "") { $where .=" AND FECHA BETWEEN '$fechaini' AND '$fecha' "; } 
//if ($centroc <> "") { $where .= " AND CENTROCOSTOS = '$centroc' "; }





$result0 = $connexion->query('SELECT COUNT(*) as total_products FROM carga_amipass WHERE '.$where);
$row = $result0->fetch_assoc();
$num_total_rows = $row['total_products'];




if (isset($_POST["import"]))
{
    
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'subidas/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $id = "";
                if(isset($Row[0])) {
                    $id = mysqli_real_escape_string($con,$Row[0]);
                }
                
                $nombrecc = "";
                if(isset($Row[1])) {
                    $nombrecc = mysqli_real_escape_string($con,$Row[1]);
                }
        
                $sucursal = "";
                if(isset($Row[2])) {
                    $sucursal = mysqli_real_escape_string($con,$Row[2]);
                }
        
                $nfactura = "";
                if(isset($Row[3])) {
                    $nfactura = mysqli_real_escape_string($con,$Row[3]);
                }

                $tipo = "";
                if(isset($Row[4])) {
                    $tipo = mysqli_real_escape_string($con,$Row[4]);
                }

                $fecha = "";
                if(isset($Row[5])) {
                    $fecha = mysqli_real_escape_string($con,$Row[5]);
                }

                $ntarjeta = "";
                if(isset($Row[6])) {
                    $ntarjeta = mysqli_real_escape_string($con,$Row[6]);
                }

                $nombrefuncionario = "";
                if(isset($Row[7])) {
                    $nombrefuncionario = mysqli_real_escape_string($con,$Row[7]);
                }

                $rut = "";
                if(isset($Row[8])) {
                    $rut = mysqli_real_escape_string($con,$Row[8]);
                }

                $dv = "";
                if(isset($Row[9])) {
                    $dv = mysqli_real_escape_string($con,$Row[9]);
                }

                $tipo_empleado = "";
                if(isset($Row[10])) {
                    $tipo_empleado = mysqli_real_escape_string($con,$Row[10]);
                }

                $monto = "";
                if(isset($Row[11])) {
                    $monto = mysqli_real_escape_string($con,$Row[11]);
                }

                $unidad = "";
                if(isset($Row[12])) {
                    $unidad = mysqli_real_escape_string($con,$Row[12]);
                }                

                $centroresponsabilidad = "";
                if(isset($Row[13])) {
                    $centroresponsabilidad = mysqli_real_escape_string($con,$Row[13]);
                }
                
                if (!empty($id) || !empty($nfactura) || !empty($fecha) || !empty($ntarjeta) || !empty($nombrefuncionario) || !empty($rut) || !empty($monto) ) {

                  /*  $query0 = "select * from carga_amipass where ID = '$id' AND NFACTURA = '$nfactura' AND FECHA = '$fecha' AND NTARJETA = '$ntarjeta' AND RUT = '$rut' AND CENTRORESPONSABILIDAD=' $centroresponsabilidad' AND UNIDAD = '$unidad' ";
                    $result = mysqli_query($con, $query0);
                    if (mysqli_num_rows($result)==0) {*/
                        



                    $query = "insert into carga_amipass(ID,CENTROCOSTOS, SUCURSAL, NFACTURA, TIPO, FECHA, NTARJETA, NOMBREFUNCIONARIO, RUT, DV, TIPO_EMPLEADO, MONTO, FECHAINGRESO, UNIDAD, CENTRORESPONSABILIDAD) values('".$id."','".$nombrecc."','".$sucursal."','".$nfactura."','".$tipo."','".$fecha."','".$ntarjeta."','".$nombrefuncionario."','".$rut."','".$dv."','".$tipo_empleado."','".$monto."', '".$fecha2."', '".$unidad."', '".$centroresponsabilidad."' )";
                    $resultados = mysqli_query($con, $query);
                
                    if (! empty($resultados)) {
                        $type = "success";
                        echo "<script>alert('Excel importado correctamente.');window.open('importaamipass22.php','_self',null,true);</script>";
                         //header ("Location: importaamipass22.php");
                         //echo '<script>swal("Good job!", "You clicked the button!", "success");</script>';
                        //$message = "Excel importado correctamente";

                       // window.open('index.php');
                    } else {
                        $type = "error";
                        echo "<script>alert('Error al subir planilla, contactese con el administrador.');window.open('importaamipass22.php','_self',null,true);</script>";
                        //$message = "Hubo un problema al importar registros";
                      }
                    /*}else{
                      $type = "error";
                       //echo '<script>swal("Aviso!", "Existen registros duplicados que no se podran subir!", "error");</script>';
                       //echo "<script>swal.fire('Aviso', 'Existen registros duplicados que no se podran subir ', 'success');window.open('importaamipass.php','_self',null,true);</script>";
                         //echo "<script> swal({   title: '¡ERROR!',   text: 'Esto es un mensaje de error',   type: 'error', });</script>";
                        echo "<script>alert('Existen registros duplicados que no se podran subir.');</script>";
                         header ("Location: importaamipass22.php");
                    }*/
                }else{
                  echo "<script>alert('Falta Datos, No se puede importar el archivo.');window.open('importaamipass22.php','_self',null,true);</script>";
                         //header ("Location: importaamipass22.php");

                   //echo '<script>swal("Aviso!", "o se puede importar achivo, falta datos...!", "warning");</script>';
                  //echo "<script>swal('Aviso', 'No se puede importar achivo, falta datos...!', 'warning')</script>";
                }
             }
        
         }
         // windows.alert('El archivo se importo con Exito');
         echo "<script>alert('Se ha ingresado correctamente la planilla excel.');window.open('importaamipass22.php','_self',null,true);/script>";
         //header ("Location: importaamipass.php");
  }
  else
  { 
        $type = "error";
        $message = "El archivo enviado es invalido. Por favor vuelva a intentarlo";
  }
}



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

    <!-- Font Awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

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
                  <li><a><i class="fa fa-file-text"></i>Importa Amipass <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="importaamipass22.php">Importar Amipass </a></li>
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
                              <img class="text-center" src="images/pdf2.png" width="180px" alt="Cargando imagen..." onclick="imprimecc();" >
                              <label></label>
                            <h5 class="text-center">imprime centro de costos</h5>
                          </a>

                             <a class="btn btn" >
                              <img class="text-center" src="images/pdf2.png" width="180px" alt="Cargando imagen..." onclick="imprimecr();" >
                              <label></label>
                            <h5 class="text-center">imprime centro de Responsabilidad</h5>
                          </a>
                           
                            
                           
                    </div>


                              <div class="container">
  <div class="row">
    <div class="col-md-12">
      <!-- <a href="crear.php"  class="btn btn-primary mt-4">Crear alumno</a>-->
      <hr>
      <form method="post" class="form-inline">
        <div class="form-group mr-3">
          <input type="date" name="fechaini" id="fechaini" class="form-control-sm">
        </div>
        <div class="form-group mr-3">
          <input type="date" id="fecha" name="fecha" class="form-control-sm">
        </div>

        <div class="form-group mr-3">
          <select id="mes" name="mes" class="form-control-sm" >
            <option>Seleccione mes...</option>
            <option value="1">Enero</option>
            <option value="2">Febrero
            </option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select>
        </div>
         <?php
                                $mysqli = new mysqli('localhost', 'root', '', 'amipass');
                              ?>
        <div class="form-group mr-3">

          <select id="ano" name="ano" class="form-control-sm" >
            <option>Seleccione Año...</option>
               <?php
                                                  $query = $mysqli -> query ("SELECT distinct(YEAR(fecha)) as ANO FROM carga_amipass; ");
                                                  while ($valores = mysqli_fetch_array($query)) {
                                                    echo '<option value="'.$valores['ANO'].'">'.$valores['ANO'].'</option>';
                                                  }
                                                ?>

          </select>
        </div>
                             <?php
                                //$mysqli = new mysqli('localhost', 'root', '', 'amipass');
                              ?>
        <div class="form-group mr-3">
         <!-- <select class="form-control-sm" id="centroc" name="centroc">
            <option value="">Seleccione...</option>
                                                      <?php/*
                                                  $query = $mysqli -> query ("SELECT DISTINCT(CENTROCOSTOS) FROM carga_amipass ");
                                                  while ($valores = mysqli_fetch_array($query)) {
                                                    echo '<option value="'.$valores['CENTROCOSTOS'].'">'.$valores['CENTROCOSTOS'].'</option>';
                                                  }*/
                                                ?>
          </select>-->
        </div>


        <input name="csrf" type="hidden" value="<?php echo mostrar($_SESSION['csrf']); ?>">
        <button type="submit"  class="btn btn-primary">Ver resultados</button>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <h3 class="mt-5">Importar archivo</h3>
  <hr>
  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->
    
    <div class="outer-container">
        <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Elija Archivo Excel</label> <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import"
                    class="btn-submit">Importar Registros</button>
        
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
<p></p><p></p><br>
         
<?php
    $sqlSelect = "SELECT * FROM carga_amipass WHERE " .$where;
    $result = mysqli_query($con, $sqlSelect);

if (mysqli_num_rows($result) > 0)
{
?>
        
   <table class="table table-responsvive">
                 <thead>
                <tr>
                    <td>ID</td>
                    <td>NOMBRE</td>
                    <td>RUT</td>
                    <td>NUMERO FACTURA</td>
                    <td>N° TARJETA</td>
                    <td>MONTO</td>
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





    //pongo el n�mero de registros total, el tama�o de p�gina y la p�gina que se muestra

    $result0 = $connexion->query('SELECT sum(MONTO) as tmonto FROM carga_amipass WHERE '.$where);
$row = $result0->fetch_assoc();
$monto0 = $row['tmonto'];




    echo '<h3>Total: $'.number_format($monto0).'</h3>';
    echo '<h3>En cada pagina se muestra '.NUM_ITEMS_BY_PAGE.' articulos ordenados por fecha en formato descendente.</h3>';
    echo '<h3>Mostrando la pagina '.$page.' de ' .$total_pages.' paginas.</h3>';

   // $result = $connexion->query( 'SELECT * FROM product p  LEFT JOIN product_lang pl ON (pl.id_product = p.id_product AND pl.id_lang = 1)  LEFT JOIN `image` i ON (i.id_product = p.id_product AND cover = 1)  WHERE active = 1  ORDER BY date_upd DESC LIMIT '.$start.', '.NUM_ITEMS_BY_PAGE);


    $result = $connexion->query('SELECT * from carga_amipass WHERE '.$where.' ORDER BY ID DESC LIMIT '.$start.', '.NUM_ITEMS_BY_PAGE);
    if ($result->num_rows > 0) {
        echo '<ul class="row items">';
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['ID']."</td>";
            echo "<td>".$row['NOMBREFUNCIONARIO']."</td>";
            echo "<td>".$row['RUT']."-".$row['DV']."</td>";
            echo "<td>".$row['NFACTURA']."</td>";
            echo "<td>".$row['NTARJETA']."</td>";
            echo "<td>$".number_format($row['MONTO'])."</td>";
            echo "</tr>";

             $sum += $row['MONTO'];

            /*echo '<li class="col-lg-4">';
            echo '<div class="item">';
            echo '<img class="img-fluid mx-auto d-block" src="https://www.jose-aguilar.com/modulos-prestashop/'.$row['CENTROCOSTOS'].'-home_default/'.$row['ID'].'.jpg" width="100" height="100" />';
            echo '<h3>'.utf8_encode($row['NOMBREFUNCIONARIO']).'</h3>';
            echo '<p class="description_short">'.strip_tags(utf8_encode($row['RUT'].'-'.$row['DV'])).'</p>';
            echo '<p class="price">$'.number_format($row['MONTO'], 2).'</p>';
            echo '<p>'.$row['NTARJETA'].'</p>';
            echo '</div>';
            echo '</li>';*/
        }
        echo '</ul>';
    }

    echo '<nav>';
    echo '<ul class="pagination">';

        $fecha12 = $_POST['feecha'];
    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="importaamipass22.php?page='.($page-1).'&fecha="'.$fecha.'"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="importaamipass22.php?page='.$i.'&fecha="'.$fecha12.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="importaamipass22.php?page='.($page+1).'&fecha="'.$fecha.'"><span aria-hidden="true">&raquo;</span></a></li>';
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Total</td>
        <td><strong>$<?php echo number_format($sum); ?></strong></td>
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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
	
  </body>
</html>

