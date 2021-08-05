

<?php
include 'funciones.php';

csrf();
if (isset($_POST['submit']) && !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
  die();
}
$fecha = date("Y/m/d"); 
$error = false;
$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

 
  $consultaSQL = 'SELECT ID_SOL, CONCAT(A.RUT, "-",B.DV)AS RUT, CONCAT(B.NOMBRE, " ", B.APEPAT) AS NOMBRE, A.FECHA, B.SECCION,A.HORA, A.TIPO FROM solicitud_alimentacion AS A, personal AS B WHERE A.RUT = B.RUT AND A.FECHA = "'.$fecha.'" order by ID_SOL DESC';

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $alumnos = $sentencia->fetchAll();

} catch(PDOException $error) {
  $error= $error->getMessage();
}

$titulo =  'Registro Alimentación ';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sistema Registro de Alimentacion</title>
  <meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/sweetalert2/6.0.1/sweetalert2.min.css" rel="stylesheet"/>

<script src="https://cdn.jsdelivr.net/sweetalert2/6.0.1/sweetalert2.min.js"></script>
    <?php include("modal_agregar.php");?>
  
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">-->
    <link href="build/toastr.css" rel="stylesheet" type="text/css" />
  

  


  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="js/validarRUT.js"></script>
  <script type="text/javascript"> 
      function registra(){

            var ruut = $('#rut').val(); 
            var tipo = $('input[name="tipo"]:checked').val();
        location.href="actionalimentacion.php?rut="+ruut+"&tipo="+tipo;

      }
  </script>

</head>
<body>

  <div class="container outer-section" >
     <input type="radio" id="alm" name="tipo" value="1" checked="checked">
                <label style="cursor:pointer" for="alm"><span></span>ALMUERZO</label><span class="fa fa-money"></span>

      <input type="radio" value="2" id="cen" name="tipo">
                <label style="cursor:pointer" for="cen"><span></span>CENA</label><span class="fa fa-credit-card"></span>

        <input id="showEasing" type="hidden" placeholder="swing, linear" class="input-mini" value="swing" />
                        <input id="hideEasing" type="hidden" placeholder="swing, linear" class="input-mini" value="linear" />
                        <input id="showMethod" type="hidden" placeholder="show, fadeIn, slideDown" class="input-mini" value="fadeIn" />
                        <input id="hideMethod" type="hidden" placeholder="hide, fadeOut, slideUp" class="input-mini" value="fadeOut" />
                        <input id="showDuration" type="hidden" placeholder="ms" class="input-mini" value="300"     />
                        <input id="hideDuration" type="hidden" placeholder="ms" class="input-mini" value="1000" />
                        <input id="timeOut" type="hidden" placeholder="ms" class="input-mini" value="5000" />
                        <input id="extendedTimeOut" type="hidden" placeholder="ms" class="input-mini" value="1000" />
       <form class="form-horizontal" role="form"  >
        <div id="print-area">

       <h2>Registro</h2>
  <p></p>
  <form class="form-inline" id="guardar_item" name="guardar_item" method="post">
    <div class="form-group">
      <label for="rut"></label>
      <input type="text" class="form-control" id="rut" name="rut" equired  placeholder="Ingrese RUT" maxlength="10" onkeyup="registra();" autofocus>
    </div>
    <!--<div class="form-group">
      <label for="pwd">Fecha</label>
      <input type="text" class="form-control"  placeholder="Enter password" name="pwd">
    </div>-->
    <!--<div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>-->
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#dataRegister"><i class='glyphicon glyphicon-plus'></i> Registrar Rut</button>
  </form>
            
            

           
            
         
           <!-- <div class="row">
      <hr />
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped  table-hover">
                            <thead>
                                <tr style="background-color:#c0392b;color:white;">
                                    <th class='text-center'>Item</th>
                  <th class='text-center'>Cantidad</th>
                  <th class='text-center'>Unidad</th>
                  <th>Descripción</th>
                  <th class='text-right'>Costo unitario</th>
                                    <th class='text-right'>Total</th>
                  <th class='text-right'></th>
                                </tr> 
                            </thead>
                            <tbody class='items'>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>-->
  <!--  BOTON DURA 5 SEG        
<div class="row">
            
            <input type="button" value="Show Toast" id="showtoast" class="btn btn-primary">
        </div> -->

          <div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3"><?= $titulo ?></h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>RUT</th>
            <th>NOMBRE</th>
            <th>FECHA</th>
            <th>HORA</th>
            <th>UNIDAD</th>
            <th>TIPO</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=1;
          if ($alumnos && $sentencia->rowCount() > 0) {
            foreach ($alumnos as $fila) {
              $fech = $fila["FECHA"];
              $newDate = date("d/m/Y", strtotime($fech));
              //$tipo = $fila['TIPO'];
              if ($fila['TIPO']==1) {
                  $tipo = 'ALMUERZO';
              }else{
                  $tipo='CENA';
              }
              ?>
              <tr>
                <td><?php echo mostrar($i); ?></td>
                <td><?php echo mostrar($fila["RUT"]); ?></td>
                <td><?php echo mostrar($fila["NOMBRE"]); ?></td>
                <td><?php echo mostrar($newDate); ?></td>
                <td><?php echo mostrar($fila["HORA"]); ?></td>
                <td><?php echo mostrar($fila["SECCION"]); ?></td>
                <td><?php echo mostrar($tipo); ?></td>
                <td>

                </td>
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
           
            
    
        </div>
       <div class="row"> <hr /></div>
        <div class="row pad-bottom  pull-right">
    
            
        </div>
    </form>
    </div>

<!-- <div class="container outer-section">
  <h2>Registro</h2>
  <p></p>
  <form class="form-inline"  >
    <div class="form-group">
      <label for="rut"></label>
      <input type="text" class="form-control" id="rut" name="rut" equired oninput="checkRut(this)"  placeholder="Ingrese RUT" maxlength="10" onchange="registra();" >
    </div> -->
    <!--<div class="form-group">
      <label for="pwd">Fecha</label>
      <input type="text" class="form-control"  placeholder="Enter password" name="pwd">
    </div>-->
    <!--<div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>-->






</body>
</html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="toastr.js"></script>
<script type="text/javascript">
mostrar_items();
  function mostrar_items(){
    var rut=document.getElementById("rut").value;
        var rut2 = rut.replace(/^\.|\./gm,'');
            //var pizza = "porción1 porción2 porción3 porción4 porción5 porción6";
            var porciones = rut2.split('-');
            var ruut =  porciones[0]; 

    var parametros={"action":"ajax"};
    $.ajax({
      type: "POST",
      url:'ajax/items.php',
      data: {ruut:ruut},
       beforeSend: function(objeto){
       $('.items').html('Cargando...');
      },
      success:function(data){
        $(".items").html(data).fadeIn('slow');
    }
    })
  }
$( "#guardar_item" ).submit(function( event ) {
  var rut=document.getElementById("rut").value;
        var rut2 = rut.replace(/^\.|\./gm,'');
            //var pizza = "porción1 porción2 porción3 porción4 porción5 porción6";
            var porciones = rut2.split('-');
            var ruut =  porciones[0]; 

    parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url:'ajax/items.php',
      data: {ruut:ruut},
       beforeSend: function(objeto){
         $('.items').html('Cargando...');
        },
      success:function(data){
        $(".items").html(data).fadeIn('slow');
        $("#myModal").modal('hide');
      }
    })
    
    event.preventDefault();
  })

$('#alert').fadeIn();     
  setTimeout(function() {
       $('#alert').fadeOut();           
  },2000);




$(function () {
        //var i = -1;
        var toastCount = 0;
        $('#showtoast').click(function () {
            var shortCutFunction = 'success';
            var msg = 'ingresado correctamente';
            var title = 'Ingresado correctamente 2';
            var $showDuration = $('#showDuration');
            var $hideDuration = $('#hideDuration');
            var $timeOut = $('#timeOut');
            var $extendedTimeOut = $('#extendedTimeOut');
            var $showEasing = $('#showEasing');
            var $hideEasing = $('#hideEasing');
            var $showMethod = $('#showMethod');
            var $hideMethod = $('#hideMethod');
            var toastIndex = toastCount++;
            var addClear = $('#addClear').prop('checked');

            toastr.options = {
                closeButton: $('#closeButton').prop('checked'),
                debug: $('#debugInfo').prop('checked'),
                newestOnTop: $('#newestOnTop').prop('checked'),
                progressBar: $('#progressBar').prop('checked'),
                rtl: $('#rtl').prop('checked'),
                positionClass: 'toast-top-full-width',
                preventDuplicates: $('#preventDuplicates').prop('checked'),
                onclick: null
            };
            if ($showDuration.val().length) {
                toastr.options.showDuration = '300';
            }

            if ($hideDuration.val().length) {
                toastr.options.hideDuration ='1000';
            }

            if ($timeOut.val().length) {
                toastr.options.timeOut = addClear ? 0 : '1000';
            }

            if ($extendedTimeOut.val().length) {
                toastr.options.extendedTimeOut = addClear ? 0 : '1000';
            }

            if ($showEasing.val().length) {
                toastr.options.showEasing = 'swing';
            }

            if ($hideEasing.val().length) {
                toastr.options.hideEasing = 'linear';
            }
            var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
            $toastlast = $toast;
            });
    })

</script>