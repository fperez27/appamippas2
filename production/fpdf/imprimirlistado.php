<?php
	include 'plantilla.php';
	require '../conexion.php';


	$query ="SELECT DISTINCTROW (A.RUT), B.DV, B.NOMBRE, B.APEPAT, B.APEMAT, B.SECCION
          FROM solicitud_alimentacion AS A, personal AS B WHERE A.RUT = B.RUT ORDER BY RUT ASC ";
	$resultado = $conexion->query($query);

	
	
	//$count = mysqli_fetch_assoc($resultado2);
	


	$pdf = new FPDF('L','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,6,'RUT',1,0,'C',1);
	$pdf->Cell(55,6,'NOMBRE',1,0,'C',1);
	$pdf->Cell(55,6,'APELLIDO PATERNO',1,0,'C',1);
	$pdf->Cell(55,6,'APELLIDO MATERNO',1,0,'C',1);
	$pdf->Cell(85,6,'UNIDAD',1,1,'C',1);
	//$pdf->Cell(90,6,'NOMBRE',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{



		$pdf->Cell(20,6,utf8_decode($row['RUT']),1,0,'L');
		$pdf->Cell(55,6,utf8_decode($row['NOMBRE']),1,0,'L');
		$pdf->Cell(55,6,utf8_decode($row['APEPAT']),1,0,'L');
		$pdf->Cell(55,6,utf8_decode($row['APEMAT']),1,0,'L');
		$pdf->Cell(85,6,$row['SECCION'],1,1,'L');
		
	}	
		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',10);
		//$pdf->Cell(50,4,"Conteo Total Raciones");
		//$pdf->Cell(28,6,'TOTAL',1,0,'L');
		//$pdf->Cell(50,6,utf8_decode($row2[0]),1,1,'J');
	

	//$pdf->Cell(($count));
	$pdf->Output();
?>