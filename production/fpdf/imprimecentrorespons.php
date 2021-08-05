<?php
	include 'plantilla.php';
	require '../conexion.php';
	//$con=mysqli_connect('localhost', 'root', '','amipass') or die(mysqli_error());
	//$query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";
	//$query ="";
	$fechaini = $_GET['fechaini'];
	$newfechaini = date("d-m-Y", strtotime($fechaini));
	$fecha = $_GET['fecha'];
	$newfecha = date("d-m-Y", strtotime($fecha));

	//$centroc = $_GET['centroc'];
	
	$where  = ' 1=1 ';
	//if ($rut <> "") { $where .= " AND RUT=$rut"; } 
	if ($fecha <> "") { $where .= " AND FECHA BETWEEN '$fechaini' AND '$fecha' "; }	
	//if ($centroc <> "") { $where .= " AND CENTROCOSTOS = '$centroc'"; }
		
	 
	//$where=" ORDER BY FECHA DESC";
	$query = "SELECT DISTINCT(CENTRORESPONSABILIDAD), (SELECT sum(MONTO) FROM carga_amipass AS b WHERE b.CENTRORESPONSABILIDAD = A.CENTRORESPONSABILIDAD AND ".$where.") AS tota FROM carga_amipass AS A WHERE ".$where." GROUP BY CENTROCOSTOS ORDER BY CENTRORESPONSABILIDAD ASC" ;
	//$query ="SELECT *  FROM carga_amipass WHERE ".$where;
	$resultado = $conexion->query($query);

	//$query2 = "SELECT SUM(monto) FROM carga_amipass AS sumtotal";
	//	$res = $conexion->query($query2);

	//$query2="SELECT sum(MONTO) as total2    FROM carga_amipass  ";
	//$fila = mysqli_num_rows($conexion, $query2);
  //$resultado2 = mysqli_query($conexion, $query2);
  //$row2 = mysqli_fetch_row($resultado2, MYSQLI_NUM);

	$query ="SELECT sum(MONTO) as total2    FROM carga_amipass WHERE " .$where;
$res = mysqli_query($conexion, $query);
$cons21 = mysqli_fetch_array($res);


	
	//$pdf = new PDF();
	$pdf=new FPDF('P','mm','A4');

	$pdf->AliasNbPages();
	$pdf->AddPage();
		//$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	//$pdf->Cell(85,10, 'Registro Alimentacion',0,0,'C');
	if ($newfechaini == $newfecha ) {
		$pdf->MultiCell(150,6,"Listado ",0,'C',0);
	}else{
		$pdf->MultiCell(150,6,"Listado Entre el ".$newfechaini." y el ".$newfecha,0,'C',0);

	}

	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(79,6,'CENTRO RESPONSABILIDAD',1,0,'C',1);
	$pdf->Cell(20,6,'MONTO',1,1,'C',1);
	

	$pdf->SetFont('Arial','',7);
	
	while($row = $resultado->fetch_assoc())
	{
			//	$sum += $row['MONTO'];
		
		$pdf->Cell(79,6,($row['CENTRORESPONSABILIDAD']),1,0,'l');
		$pdf->Cell(20,6,'$'.number_format($row['tota']),1,1,'R');
		//$sum = $sum + $row['tota'];
	}


		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(50,6,"");
		$pdf->Cell(28,6,'TOTAL',1,0,'L');
		$pdf->Cell(50,6,'$'.number_format($cons21['total2']),1,1,'J');

	$pdf->Output();
?>