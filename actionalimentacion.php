<?php
	session_start();
	//include 'Auth.php';
	$con=mysqli_connect('localhost', 'root', 'ss2015ap','amipass') or die(mysqli_error());
	#servidor //$con=mysqli_connect('localhost', 'root', 'ss2015ap','amipass') or die(mysqli_error());
	//require 'Connection.php';
	
	$rut = $_GET['rut'];
	$tipo = $_GET['tipo'];
	//$candidato = $_POST['candidato'];
	$fecha = date("Y/m/d");

	date_default_timezone_set("America/Santiago");
	//$hora = date('h:i:s A');
	$hora  =date("G:i:s");
		
	$cons2 = "SELECT * FROM  personal where RUT='$rut'";
	$res2 = mysqli_query($con, $cons2);
	if (mysqli_num_rows($res2)>0){
					$consulta = " SELECT * FROM solicitud_alimentacion WHERE RUT='$rut' AND FECHA = '$fecha' and TIPO='$tipo'";
					$rs_tabla = mysqli_query($con, $consulta);
					if (mysqli_num_rows($rs_tabla) ==0) {
						

						$sql2 = "INSERT INTO solicitud_alimentacion (ESTADO, SECCION, TIPO, RUT, FECHA, HORA) VALUES ('1', '2', '$tipo', '$rut', '$fecha', '$hora')";
						$res2 = mysqli_query($con, $sql2);
						
						if($res2){
						echo "<script>alert('REGISTRO CORRECTO');window.open('index.php','_self',null,true);</script>";
					}
					} else { 

							echo "<script>window.alert('IMPOSIBLE ACEPTAR SU SOLICITUD, YA SE REGISTRO EL DIA DE HOY');window.open('index.php','_self',null,true);</script>";
						
						
					//$res2 = mysqli_query($Conn,$sql2);
							 }
		
	}else{
		echo "<script>window.alert('RUT NO ENCONTRADO, FAVOR CONTACTAR AL ADMINISTRADOR');window.open('index.php','_self',null,true);</script>";

	}
					 ?>





