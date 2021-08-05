<?php
include 'config.php';
include 'plantilla.php';
	require 'conexion.php';

	$rut = $_GET['rut'];
	$fechaini = $_GET['fechaini'];
	$fechafin = $_GET['fechafin'];	
	
	$where  = ' 1=1';

	if ($fechaini <> "" && $fechafin <> "") {
		$where .=" AND FECHA BETWEEN '$fechaini' AND '$fechafin'  ";	
	} 

	//$where=" ORDER BY FECHA DESC";
	$query = "SELECT DISTINCT(CENTROCOSTOS), CODCC, (SELECT sum(MONTO) FROM carga_amipass AS b WHERE b.CENTROCOSTOS = A.CENTROCOSTOS AND ".$where." ) AS tota FROM carga_amipass AS A WHERE ".$where."  GROUP BY CENTROCOSTOS  ";
	$res2 = mysqli_query($conexion, $query);




$salida = "<table><thead><th>COD CC</th><th>CENTRO COSTO</th><th>TOTAL</th></thead><tbody>";


while($r=$res2->fetch_Object()){


$salida .= 	"<tr><td>".$r->CENTROCOSTOS."</td>
			<td>".$r->CODCC."</td>
			<td>".$r->tota."</td>
			</tr>";
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