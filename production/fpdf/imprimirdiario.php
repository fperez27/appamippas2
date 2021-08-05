<?php
	include 'plantilla.php';
	require '../conexion.php';
	//$con=mysqli_connect('localhost', 'root', '','amipass') or die(mysqli_error());
	//$query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";
	//$query ="";
	$fecha = $_GET['fecha'];
	
	//$dia = $_POST['dia'];
	
	$where  = 'AND 1=1';
	if ($fecha <> "" ) {
		$where=" AND A.FECHA ='$fecha'";	
	} 

		
	 
	//$where=" ORDER BY FECHA DESC";
	$query ="SELECT  A.FECHA,A.HORA, A.TIPO, B.SECCION, CONCAT(A.RUT, '-' ,B.DV ) AS RUT, CONCAT(B.NOMBRE, ' ',B.APEPAT, ' ',B.APEMAT) AS FULLNAME   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT ".$where;
	$resultado = $conexion->query($query);

	
	$query2="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT ".$where;
	$resultado2 = mysqli_query($conexion, $query2);
	$row2 = mysqli_fetch_array($resultado2, MYSQLI_NUM);
	//$count = mysqli_fetch_assoc($resultado2);
	
	
	

	/* $query2 ="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT ".$where;
	$resultado2 = $conexion->query($query2);*/

	$pdf = new FPDF('L','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,6,'FECHA',1,0,'C',1);
	$pdf->Cell(18,6,'HORA',1,0,'C',1);
	$pdf->Cell(80,6,'UNIDAD',1,0,'C',1);
	$pdf->Cell(22,6,'TIPO',1,0,'C',1);
	$pdf->Cell(22,6,'RUT',1,0,'C',1);
	$pdf->Cell(90,6,'NOMBRE',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		if ($row['TIPO']==1) {
			$tip = 'ALMUERZO';
		}else if ($row['TIPO']==2) {
			$tip = 'CENA';
		}


		$nombre = utf8_decode($row['FULLNAME']);
		$pdf->Cell(20,6,utf8_decode($row['FECHA']),1,0,'L');
		$pdf->Cell(18,6,$row['HORA'],1,0,'L');
		$pdf->Cell(80,6,$row['SECCION'],1,0,'L');
		$pdf->Cell(22,6,$tip,1,0,'L');
		$pdf->Cell(22,6,$row['RUT'],1,0,'L');
		$pdf->Cell(90,6,$nombre,1,1,'J');
	}	
		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(50,4,"Conteo Total Raciones");
		$pdf->Cell(28,6,'TOTAL',1,0,'L');
		$pdf->Cell(50,6,utf8_decode($row2[0]),1,1,'J');
	

	//$pdf->Cell(($count));
	$pdf->Output();
?>