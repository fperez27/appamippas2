<?php
	session_start();
	//include 'Auth.php';
	$con=mysqli_connect('localhost', 'root', 'ss2015ap','amipass') or die(mysqli_error());

	//require 'Connection.php';
	
	$rut = $_GET['rut'];
	//$candidato = $_POST['candidato'];
	$fecha = date("Y/m/d");

		date_default_timezone_set('America/Santiago');
		$hora = date('h:i:s a', time());
		$today = date("H:i:s"); 
		list($hora1, $minuto, $meridiano) = preg_split('/[:| ]/', $today);


	//$hora = time();echo date("(H:i:s)", $time);

		
	$cons2 = "SELECT * FROM  personal where RUT='$rut'";
	$res2 = mysqli_query($con, $cons2);
	if (mysqli_num_rows($res2)>0){
					$consulta = " SELECT * FROM solicitud_alimentacion WHERE RUT='$rut' AND FECHA = '$fecha' ";
					$rs_tabla = mysqli_query($con, $consulta);
					if (mysqli_num_rows($rs_tabla) ==0) {
						
						if ($hora1 < 10) {

							$consulta2="SELECT * FROM personal WHERE RUT= '$rut'";
							$rs_query=mysqli_query($con, $consulta2);
							//$rut1=mysqli_result($rs_query,"NOMBRE");
							//$seccion=mysqli_result($rs_query,"SECCION");
							//$iva=mysql_result($rs_query,0,"iva");
							//$orden=mysql_result($rs_query,0,"orden");
							$sql2 = "INSERT INTO solicitud_alimentacion (ESTADO, SECCION, TIPO, RUT, FECHA, HORA) VALUES ('1', '2', '3', '$rut', '$fecha', '$today')";
							$res2 = mysqli_query($con, $sql2);
							
							if($res2){
									echo "<script>window.alert('REGISTRO CORRECTO');window.open('index.html','_self',null,true);</script>";
								}
							
						}else{
							echo "<script>window.alert('NO ES POSIBLE REGISTRAR PETICION DE ALIMENTACION');window.open('index.html','_self',null,true);</script>";

							}
						} else { 

							echo "<script>window.alert('IMPOSIBLE ACEPTAR SU SOLICITUD, YA SE REGISTRO EL DIA DE HOY'); window.open('index.html','_self',null,true);</script>";	
							//$res2 = mysqli_query($Conn,$sql2);
							 }
		
	}else{
		echo "<script>window.alert('RUT NO ENCONTRADO, FAVOR CONTACTAR AL ADMINISTRADOR');window.open('index.html','_self',null,true);</script>";
	}
					 ?>




