<?php

include 'plantilla.php';
	require 'conexion.php';
	//$con=mysqli_connect('localhost', 'root', '','amipass') or die(mysqli_error());
	//$query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";
	//$query ="";
	$rut = $_GET['rut'];
	$fecha = $_GET['fecha'];
	
	$where  = 'AND 1=1';
	if ($rut <> "") {
		$where .= " AND A.RUT=$rut";	
	} 

	if ($fecha <> "") {
		$where .= " AND A.FECHA = '$fecha'";
	}

	

	$query ="SELECT A.FECHA, A.HORA, A.TIPO, B.SECCION, CONCAT(A.RUT, '-' ,B.DV ) AS RUT, CONCAT(B.NOMBRE, ' ',B.APEPAT, ' ',B.APEMAT) AS FULLNAME   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT ".$where;

	$res2 = mysqli_query($conexion, $query);


$salida = "<table><thead><th>FECHA</th><th>HORA</th><th>UNIDAD</th><th>TIPO</th><th>RUT</th><th>NOMBRE</th></thead><tbody>";


while($r=$res2->fetch_Object()){

	if ($r->TIPO==1) {
			$tip = 'ALMUERZO';
		}else if ($r->TIPO==2) {
			$tip = 'CENA';
		}
$salida .= 	"<tr><td>".$r->FECHA."</td>
			<td>".$r->HORA."</td>
			<td>".$r->SECCION."</td>
			<td>".$tip."</td>
			<td>".$r->RUT."</td>
			<td>".$r->FULLNAME."</td></tr>";
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