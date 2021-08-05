<?php
//include 'Auth.php';
session_start();
	$con=mysqli_connect('localhost', 'root', 'ss2015ap','amipass') or die(mysqli_error());
	//$conexion=mysqli_connect('localhost', 'root', '','votacion') or die(mysqli_error());

	//require 'Connection.php';
	
	$rut = $_POST['rut'];
	$porciones = explode("-", $rut);
	$rut2= $porciones[0]; 
	
	$nombre = strtoupper($_POST['nombre']);
	$apepat = strtoupper($_POST['apepat']);
	$apemat = strtoupper($_POST['apemat']);
	$unidad =strtoupper($_POST['unidad']);
	
	if ($rut !='') {
				//UPDATE table_name SET column1=value, column2=value2,... WHERE column_name=id_value
				$sql2 = "UPDATE personal SET NOMBRE='$nombre', APEPAT='$apepat', APEMAT='$apemat', SECCION='$unidad' WHERE RUT = '$rut2'";
								$res2 = mysqli_query($con, $sql2);
								
								if($res2){
								echo "<script>window.alert('Actualización correcta!');window.location='./listperson.php';</script>";
								}else{
									//echo "<script>window.alert(no on on no non nono o');window.location='./listperson.php';</script>";
								}
							//	window.location='./index.php';
	}else{
		echo "<script>window.alert('Error al ingresar datos, favor comunicarce con administrador');window.location='./listperson.php';</script>";
	}
?>