<?php
error_reporting(0);

include 'funciones.php';
include('dbconect.php');
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');


//$rut = $_POST["rut"];
//$separada = explode('-', $rut);
//$rt = $separada['0'];
$fecha = $_POST['fecha'];
//$centroc = $_POST['centroc'];
$fechaini = $_POST['fechaini'];

$fecha2 = date("Y/m/d");

$where ="1=1";


//if ($rt <> "") { $where .=" AND RUT= '$rt'"; }
if ($fecha <> "") { $where .=" AND FECHA BETWEEN '$fechaini' AND '$fecha' "; } 
//if ($centroc <> "") { $where .= " AND CENTROCOSTOS = '$centroc' "; }



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

                $codcc = "";
                if(isset($Row[14])) {
                    $codcc = mysqli_real_escape_string($con,$Row[14]);
                }
                
                if (!empty($id) || !empty($nfactura) || !empty($fecha) || !empty($ntarjeta) || !empty($nombrefuncionario) || !empty($rut) || !empty($monto)) {

                   /* $query0 = "select * from carga_amipass where ID = '$id' AND NFACTURA = '$nfactura' AND FECHA = '$fecha' AND NTARJETA = '$ntarjeta'";
                    $result = mysqli_query($con, $query0);
                    if (mysqli_num_rows($result)==0) {*/
                        



                    $query = "insert into carga_amipass(ID,CENTROCOSTOS, SUCURSAL, NFACTURA, TIPO, FECHA, NTARJETA, NOMBREFUNCIONARIO, RUT, DV, TIPO_EMPLEADO, MONTO, FECHAINGRESO, UNIDAD, CENTRORESPONSABILIDAD, CODCC) values('".$id."','".$nombrecc."','".$sucursal."','".$nfactura."','".$tipo."','".$fecha."','".$ntarjeta."','".$nombrefuncionario."','".$rut."','".$dv."','".$tipo_empleado."','".$monto."', '".$fecha2."', '".$unidad."', '".$centroresponsabilidad."', '".$codcc."' )";
                    $resultados = mysqli_query($con, $query);
                
                    if (! empty($resultados)) {
                        $type = "success";
                        
                        //$message = "Excel importado correctamente";

                       // window.open('index.php');
                    } else {
                        $type = "error";
                        echo "<script>alert('Error al subir planilla, contactese con el administrador.');window.open('importaamipass.php','_self',null,true);</script>";
                        //$message = "Hubo un problema al importar registros";
                      }
                   /* }else{
                      $type = "error";
                        echo "<script>alert('Existen registros duplicados que no se podran subir.');window.open('importaamipass.php','_self',null,true);</script>";

                    }*/
                }
             }
        
         }
         // windows.alert('El archivo se importo con Exito');
         echo "<script>alert('Se ha ingresado correctamente la planilla excel.');<window.open('importaamipass.php','_self',null,true);/script>";
        //   header ("Location: importaamipass.php");
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
                  <li><a><i class="fa fa-file-text"></i>Contratos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="ver_solicitudes.php">Ver Solicitud </a></li>
                      <li><a href="indexsol.html">Solicitud Contrato</a></li>
            
                      
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
        
    <table class='table tutorial-table'>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre Centro Costos</th>
                <th>Sucursal</th>
                <th>N° Factura</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>N° Tarjeta</th>
                <th>Nombre</th>
                <th>Rut</th>
                <th>Monto</th>
                
            </tr>

        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>

        <tr>
            <td><?php  echo $row['ID']; ?></td>
            <td><?php  echo $row['CENTROCOSTOS']; ?></td>
            <td><?php  echo $row['SUCURSAL']; ?></td>
            <td><?php  echo $row['NFACTURA']; ?></td>
            <td><?php  echo $row['TIPO']; ?></td>
            <td><?php  echo $row['FECHA']; ?></td>
            <td><?php  echo $row['NTARJETA']; ?></td>
            <td><?php  echo $row['NOMBREFUNCIONARIO']; ?></td>
            <td><?php  echo $row['RUT'].'-'.$row['DV']; ?></td>
            <td><strong>$<?php  echo number_format($row['MONTO']); ?></strong></td>
        </tr>
<?php
    $sum += $row['MONTO'];
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
	
  </body>
</html>

