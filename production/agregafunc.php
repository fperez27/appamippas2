<?php
	//////session_start();
	//include 'Auth.php';
	$con=mysqli_connect('localhost', 'root', 'ss2015ap','amipass') or die(mysqli_error());
	//$conexion=mysqli_connect('localhost', 'root', '','votacion') or die(mysqli_error());

	//require 'Connection.php';
	
	$rut = $_POST['rut'];
	$porciones = explode("-", $rut);
	$rut2= $porciones[0]; 
	$dv = strtoupper($porciones[1]);
	$nombre = strtoupper($_POST['nombre']);
	$apepat = strtoupper($_POST['apepat']);
	$apemat = strtoupper($_POST['apemat']);
	$unidad = $_POST['tipo'];
	
	if ($rut <> '') {
	$cons  ="SELECT COUNT(RUT) AS suma FROM personal WHERE RUT = '$rut'";
	$resultado2 = mysqli_query($con, $cons);
	$row2 = mysqli_fetch_array($resultado2, MYSQLI_NUM);

			if ($row2[0] == 0) {
				$sql2 = "INSERT INTO personal (RUT, DV, NOMBRE, APEPAT, APEMAT, SECCION) VALUES ('$rut2', '$dv', '$nombre', '$apepat', '$apemat', '$unidad')";
								$res2 = mysqli_query($con, $sql2);
								
								if($res2){
								echo "<script>window.alert('REGISTRO CORRECTO');window.open('ingresonuevo.php','_self',null,true);</script>";
								}else{
									echo "<script>window.alert('Error al ingresar datos');.window.open('ingresonuevo.php', _self, null, true);</script>";
								}
			}else{
				echo "<script>window.alert('RUT INGRESADO YA SE ENCUETRA REGISTRADO, NO SE PUEDE VOLVER A INGRESAR');window.open('ingresonuevo.php','_self',null,true);</script>";
			}



	
		
	
	}else{
		echo "<script>window.alert('Error al ingresar datos, favor comunicarce con administrador');.window.open('ingresonuevo.php', _self, null, true);</script>";
	}
		
					 ?>
	

