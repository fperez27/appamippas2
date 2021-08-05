<?php

include 'plantilla.php';
require 'conexion.php';

	//$rut = $_GET['rut'];
	$rut = $_GET['rut'];	
	
	$where  = ' 1=1 AND';
	
	if ($rut <> "") {
		$where .="  A.RUT = '$rut' AND ";	
	} 

	//$where=" ORDER BY FECHA DESC";
	$consultaSQL = "SELECT DISTINCTROW (A.RUT), B.DV, B.NOMBRE, B.APEPAT, B.APEMAT, B.SECCION, CONCAT(A.RUT, '-' ,B.DV ) AS RUT, CONCAT(B.NOMBRE, ' ',B.APEPAT, ' ',B.APEMAT) AS FULLNAME, A.FECHA, A.HORA, A.TIPO FROM solicitud_alimentacion AS A, personal AS B WHERE ".$where."   A.RUT = B.RUT ORDER BY RUT ASC ";
//query ="SELECT A.FECHA, A.HORA, A.TIPO, B.SECCION, CONCAT(A.RUT, '-' ,B.DV ) AS RUT, CONCAT(B.NOMBRE, ' ',B.APEPAT, ' ',B.APEMAT) AS FULLNAME   FROM solicitud_alimentacion as A, personal as B WHERE" .$where. 	" A.RUT=B.RUT ";
	$res2 = mysqli_query($conexion, $consultaSQL);




$salida = "<table><thead><th>FECHA</th><th>HORA</th><th>UNIDAD</th><th>TIPO</th><th>RUT</th><th>NOMBRE</th></thead><tbody>";


while($r=$res2->fetch_Object()){

	if ($r->TIPO==1) {
			$tip = 'ALMUERZO';
		}else if ($r->TIPO==2) {
			$tip = 'CENA';
		}
		$nombre = utf8_decode($r->FULLNAME);
$salida .= 	"<tr><td>".$r->FECHA."</td>
			<td>".$r->HORA."</td>
			<td>".$r->SECCION."</td>
			<td>".$tip."</td>
			<td>".$r->RUT."</td>
			<td>".$nombre."</td></tr>";
}

$salida .="<tr>
			<td></td>
			<td></td>
			<td></td></tr>";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=report.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;
?>