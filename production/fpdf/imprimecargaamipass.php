<?php
	include 'plantilla.php';
	require '../conexion.php';
	//$con=mysqli_connect('localhost', 'root', '','amipass') or die(mysqli_error());
	//$query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";
	//$query ="";
	$rut = $_GET['rut'];
	$fecha = $_GET['fecha'];
	$centroc = $_GET['centroc'];
	
	$where  = ' 1=1 ';
	if ($rut <> "") { $where .= " AND RUT=$rut"; } 
	if ($fecha <> "") { $where .= " AND FECHAINGRESO = '$fecha'"; }	
	if ($centroc <> "") { $where .= " AND CENTROCOSTOS = '$centroc'"; }
		
	 
	//$where=" ORDER BY FECHA DESC";
	$query ="SELECT *  FROM carga_amipass WHERE ".$where;
	$resultado = $conexion->query($query);


	//$query2="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT ".$where;
  //$resultado2 = mysqli_query($conexion, $query2);
 // $row2 = mysqli_fetch_array($resultado2, MYSQLI_NUM);
	
	//$pdf = new PDF();
	$pdf=new FPDF('L','mm','A4');

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(15,6,'ID',1,0,'C',1);
	$pdf->Cell(79,6,'CENTRO COSTOS',1,0,'C',1);
	$pdf->Cell(20,6,utf8_decode('N° FACTURA'),1,0,'C',1);
	$pdf->Cell(20,6,utf8_decode('N° TARJETA'),1,0,'C',1);
	$pdf->Cell(75,6,'FUNCIONARIO',1,0,'C',1);
	$pdf->Cell(22,6,'RUT',1,0,'C',1);
	$pdf->Cell(13,6,'MONTO',1,0,'C',1);
	$pdf->Cell(20,6,'FECHA',1,1,'C',1);

	$pdf->SetFont('Arial','',7);
	
	while($row = $resultado->fetch_assoc())
	{
		
		$pdf->Cell(15,6,utf8_decode($row['ID']),1,0,'C');
		$pdf->Cell(79,6,utf8_decode($row['CENTROCOSTOS']),1,0,'L');
		$pdf->Cell(20,6,utf8_decode($row['NFACTURA']),1,0,'C');
		$pdf->Cell(20,6,utf8_decode($row['NTARJETA']),1,0,'C');
		$pdf->Cell(75,6,utf8_decode($row['NOMBREFUNCIONARIO']),1,0,'J');
		$pdf->Cell(22,6,utf8_decode($row['RUT'].'-'.$row['DV']),1,0,'R');
		$pdf->Cell(13,6,'$'.number_format($row['MONTO']),1,0,'R');
		$pdf->Cell(20,6,utf8_decode($row['FECHAINGRESO']),1,1,'R');
	}


		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(50,6,"Conteo Total Raciones");
		$pdf->Cell(28,6,'TOTAL',1,0,'L');
		//$pdf->Cell(50,6,utf8_decode($row2[0]),1,1,'J');

	$pdf->Output();
?>