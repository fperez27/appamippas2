<?php
	include 'plantilla.php';
	require '../conexion.php';
	//$con=mysqli_connect('localhost', 'root', '','amipass') or die(mysqli_error());
	//$query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";
	//$query ="";
	$fechaini ='2021-05-01';
	$fechafin = '2021-05-30';
	$fechafin2 = date('d/m/Y',strtotime($fechafin));
	$fechaini2 = date('d/m/Y',strtotime($fechaini));
	
	$where  = 'AND 1=1';
	if ($fechaini <> "" && $fechafin <> "") {
		$where .=" AND A.FECHA BETWEEN '$fechaini' AND '$fechafin'";	
	} 
	/*if ($rut <> "") {
		$where .= " AND A.RUT = '$rut'";
	}
*/


		
	 
	//$where=" ORDER BY FECHA DESC";
	$query ="SELECT A.FECHA, A.HORA, A.TIPO, B.SECCION, CONCAT(A.RUT, '-' ,B.DV ) AS RUT, CONCAT(B.NOMBRE, ' ',B.APEPAT, ' ',B.APEMAT) AS FULLNAME   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT ".$where;
	$resultado = $conexion->query($query);






	$pdf = new FPDF('L','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();


	    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(180,12, 'Rango: ' .$fechaini2.' hasta '.$fechafin2, 0, 1, 'R');
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(180,10, 'Listado segun centro de costos ', 0, 1, 'C');
    $pdf->Ln(8);


	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(100,6,'Centro de Costos',1,0,'C',1);
	$pdf->Cell(50,6,'Cantidad',1,0,'C',1);
	
	
	$pdf->SetFont('Arial','',10);
	

	$query2="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =66 ".$where;
	$resultado2 = mysqli_query($conexion, $query2);
	$row2 = mysqli_fetch_array($resultado2, MYSQLI_NUM);

	$pdf->Ln(15);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("HOSPITALIZACIÓN MEDICINA INTERNA"),1,0,'J');
		
		$pdf->Cell(50,6,$row2[0],1,1,'R');

	$query1="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =90 ".$where;
	$resultado1 = mysqli_query($conexion, $query1);
	$row1 = mysqli_fetch_array($resultado1, MYSQLI_NUM);


		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("HOSPITALIZACIÓN QUIRÚRGICA"),1,0,'J');		
		$pdf->Cell(50,6,$row1[0],1,1,'R');

	$query3="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =113 ".$where;
	$resultado3 = mysqli_query($conexion, $query3);
	$row3 = mysqli_fetch_array($resultado3, MYSQLI_NUM);
		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("HOSPITALIZACIÓN OBSTETRICIA"),1,0,'J');		
		$pdf->Cell(50,6,$row3[0],1,1,'R');

	$query4="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =114 ".$where;
	$resultado4 = mysqli_query($conexion, $query4);
	$row4 = mysqli_fetch_array($resultado4, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("HOSPITALIZACIÓN GINECOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row4[0],1,1,'R');


	$query5="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =116 ".$where;
	$resultado5 = mysqli_query($conexion, $query5);
	$row5 = mysqli_fetch_array($resultado5, MYSQLI_NUM);

$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("HOSPITALIZACIÓN PEDIATRÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row5[0],1,1,'R');


	$query6="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =117 ".$where;
	$resultado6 = mysqli_query($conexion, $query6);
	$row6 = mysqli_fetch_array($resultado6, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("HOSPITALIZACIÓN NEONATOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row6[0],1,1,'R');


	$query7="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =149 ".$where;
	$resultado7 = mysqli_query($conexion, $query7);
	$row7 = mysqli_fetch_array($resultado7, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("HOSPITALIZACIÓN PSIQUIATRÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row7[0],1,1,'R');



	$query8="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =152 ".$where;
	$resultado8 = mysqli_query($conexion, $query8);
	$row8 = mysqli_fetch_array($resultado8, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("HOSPITALIZACIÓN EN CASA"),1,0,'J');		
		$pdf->Cell(50,6,$row8[0],1,1,'R');



	$query9="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =159 ".$where;
	$resultado9 = mysqli_query($conexion, $query9);
	$row9 = mysqli_fetch_array($resultado9, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("HOSPITALIZACIÓN DE DIA"),1,0,'J');		
		$pdf->Cell(50,6,$row9[0],1,1,'R');


	$query10="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =160 ".$where;
	$resultado10 = mysqli_query($conexion, $query10);
	$row10 = mysqli_fetch_array($resultado10, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("HOGAR PROTEGIDO"),1,0,'J');		
		$pdf->Cell(50,6,$row10[0],1,1,'R');



	$query11="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =166 ".$where;
	$resultado11 = mysqli_query($conexion, $query11);
	$row11 = mysqli_fetch_array($resultado11, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("UNIDAD DE CUIDADOS INTENSIVOS"),1,0,'J');		
		$pdf->Cell(50,6,$row11[0],1,1,'R');

	$query12="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =195 ".$where;
	$resultado12 = mysqli_query($conexion, $query12);
	$row12 = mysqli_fetch_array($resultado12, MYSQLI_NUM);

			$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("UNIDAD DE TRATAMIENTO INTENSIVO ADULTO"),1,0,'J');		
		$pdf->Cell(50,6,$row12[0],1,1,'R');



	$query13="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =196 ".$where;
	$resultado13 = mysqli_query($conexion, $query13);
	$row13 = mysqli_fetch_array($resultado13, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("UNIDAD DE TRATAMIENTO INTENSIVO PEDÍATRICA"),1,0,'J');		
		$pdf->Cell(50,6,$row13[0],1,1,'R');


	$query14="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =197 ".$where;
	$resultado14 = mysqli_query($conexion, $query14);
	$row14 = mysqli_fetch_array($resultado14, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("UNIDAD DE TRATAMIENTO INTENSIVO NEONATOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row14[0],1,1,'R');


	$query15="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =201 ".$where;
	$resultado15 = mysqli_query($conexion, $query15);
	$row15 = mysqli_fetch_array($resultado15, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("EMERGENCIAS"),1,0,'J');		
		$pdf->Cell(50,6,$row15[0],1,1,'R');


	$query16="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =232 ".$where;
	$resultado16 = mysqli_query($conexion, $query16);
	$row16 = mysqli_fetch_array($resultado16, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA OTROS PROFESIONALES"),1,0,'J');		
		$pdf->Cell(50,6,$row16[0],1,1,'R');


	$query17="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =237 ".$where;
	$resultado17 = mysqli_query($conexion, $query17);
	$row17 = mysqli_fetch_array($resultado17, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTAS MÉDICAS"),1,0,'J');		
		$pdf->Cell(50,6,$row17[0],1,1,'R');


	$query18="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =273 ".$where;
	$resultado18 = mysqli_query($conexion, $query18);
	$row18 = mysqli_fetch_array($resultado18, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA MEDICINA INTERNA"),1,0,'J');		
		$pdf->Cell(50,6,$row18[0],1,1,'R');


	$query19="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =274 ".$where;
	$resultado19 = mysqli_query($conexion, $query19);
	$row19 = mysqli_fetch_array($resultado19, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA NEUROLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row19[0],1,1,'R');


	$query20="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =276 ".$where;
	$resultado20 = mysqli_query($conexion, $query20);
	$row20 = mysqli_fetch_array($resultado20, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode(" CONSULTA CARDIOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row20[0],1,1,'R');


	$query21="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =277 ".$where;
	$resultado21 = mysqli_query($conexion, $query21);
	$row21 = mysqli_fetch_array($resultado21, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA DERMATOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row21[0],1,1,'R');


	$query22="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =279 ".$where;
	$resultado22 = mysqli_query($conexion, $query22);
	$row22 = mysqli_fetch_array($resultado22, MYSQLI_NUM);

			$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA VIH"),1,0,'J');		
		$pdf->Cell(50,6,$row22[0],1,1,'R');

	$query23="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =280 ".$where;
	$resultado23 = mysqli_query($conexion, $query23);
	$row23 = mysqli_fetch_array($resultado23, MYSQLI_NUM);

			$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA PSIQUIATRÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row23[0],1,1,'R');


	$query24="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =281 ".$where;
	$resultado24 = mysqli_query($conexion, $query24);
	$row24 = mysqli_fetch_array($resultado24, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA ENDOCRINOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row24[0],1,1,'R');

	$query25="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =289 ".$where;
	$resultado25 = mysqli_query($conexion, $query25);
	$row25 = mysqli_fetch_array($resultado25, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA FISIATRÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row25[0],1,1,'R');

	$query26="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =294 ".$where;
	$resultado26 = mysqli_query($conexion, $query26);
	$row26 = mysqli_fetch_array($resultado26, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA MANEJO DEL DOLOR"),1,0,'J');		
		$pdf->Cell(50,6,$row26[0],1,1,'R');


	$query27="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =302 ".$where;
	$resultado27 = mysqli_query($conexion, $query27);
	$row27 = mysqli_fetch_array($resultado27, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA ENFERMEDADES DE TRANSMISIÓN SEXUAL"),1,0,'J');		
		$pdf->Cell(50,6,$row27[0],1,1,'R');


	$query28="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =309 ".$where;
	$resultado28 = mysqli_query($conexion, $query28);
	$row28 = mysqli_fetch_array($resultado28, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA CIRUGÍA GENERAL"),1,0,'J');		
		$pdf->Cell(50,6,$row28[0],1,1,'R');


	$query29="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =311 ".$where;
	$resultado29 = mysqli_query($conexion, $query29);
	$row29 = mysqli_fetch_array($resultado29, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA UROLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row29[0],1,1,'R');


	$query30="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =317 ".$where;
	$resultado30 = mysqli_query($conexion, $query30);
	$row30 = mysqli_fetch_array($resultado30, MYSQLI_NUM);


	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA OFTALMOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row30[0],1,1,'R');


	$query31="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =318 ".$where;
	$resultado31 = mysqli_query($conexion, $query31);
	$row31 = mysqli_fetch_array($resultado31, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA CIRUGÍA VASCULAR PERIFÉRICA"),1,0,'J');		
		$pdf->Cell(50,6,$row31[0],1,1,'R');



	$query32="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =319 ".$where;
	$resultado32 = mysqli_query($conexion, $query32);
	$row32 = mysqli_fetch_array($resultado32, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA OTORRINOLARINGOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row32[0],1,1,'R');



	$query33="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =326 ".$where;
	$resultado33 = mysqli_query($conexion, $query33);
	$row33 = mysqli_fetch_array($resultado33, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA MÉDICA DE TRAUMATOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row33[0],1,1,'R');



	$query34="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =328 ".$where;
	$resultado34 = mysqli_query($conexion, $query34);
	$row34 = mysqli_fetch_array($resultado34, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA PEDIATRÍA GENERAL"),1,0,'J');		
		$pdf->Cell(50,6,$row34[0],1,1,'R');



	$query35="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =331 ".$where;
	$resultado35 = mysqli_query($conexion, $query35);
	$row35 = mysqli_fetch_array($resultado35, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA NEUROLOGÍA PEDIÁTRICA"),1,0,'J');		
		$pdf->Cell(50,6,$row35[0],1,1,'R');


	$query36="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =353 ".$where;
	$resultado36 = mysqli_query($conexion, $query36);
	$row36 = mysqli_fetch_array($resultado36, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA GINECOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row36[0],1,1,'R');


	$query37="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =354 ".$where;
	$resultado37 = mysqli_query($conexion, $query37);
	$row37 = mysqli_fetch_array($resultado37, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA OBSTETRICIA"),1,0,'J');		
		$pdf->Cell(50,6,$row37[0],1,1,'R');


	$query38="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =356 ".$where;
	$resultado38 = mysqli_query($conexion, $query38);
	$row38 = mysqli_fetch_array($resultado38, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CONSULTA ODONTOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row38[0],1,1,'R');


	$query39="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =359 ".$where;
	$resultado39 = mysqli_query($conexion, $query39);
	$row39 = mysqli_fetch_array($resultado39, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("TELEMEDICINA"),1,0,'J');		
		$pdf->Cell(50,6,$row39[0],1,1,'R');


	$query40="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =464 ".$where;
	$resultado40 = mysqli_query($conexion, $query40);
	$row40 = mysqli_fetch_array($resultado40, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS CARDIOVASCULAR"),1,0,'J');		
		$pdf->Cell(50,6,$row40[0],1,1,'R');


	$query41="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =465 ".$where;
	$resultado41 = mysqli_query($conexion, $query41);
	$row41 = mysqli_fetch_array($resultado41, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS DE EMERGENCIA"),1,0,'J');		
		$pdf->Cell(50,6,$row41[0],1,1,'R');


	$query42="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =467 ".$where;
	$resultado42 = mysqli_query($conexion, $query42);
	$row42 = mysqli_fetch_array($resultado42, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS DIGESTIVA"),1,0,'J');		
		$pdf->Cell(50,6,$row42[0],1,1,'R');


	$query43="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =470 ".$where;
	$resultado43 = mysqli_query($conexion, $query43);
	$row43 = mysqli_fetch_array($resultado43, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS GINECOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row43[0],1,1,'R');

	$query44="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =477 ".$where;
	$resultado44 = mysqli_query($conexion, $query44);
	$row44 = mysqli_fetch_array($resultado44, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS ODONTOLÓGICA"),1,0,'J');		
		$pdf->Cell(50,6,$row44[0],1,1,'R');

	$query45="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =478 ".$where;
	$resultado45 = mysqli_query($conexion, $query45);
	$row45 = mysqli_fetch_array($resultado45, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS OFTALMOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row45[0],1,1,'R');

	$query46="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =480 ".$where;
	$resultado46 = mysqli_query($conexion, $query46);
	$row46 = mysqli_fetch_array($resultado46, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS OTORRINOLARINGOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row46[0],1,1,'R');

	$query47="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =485 ".$where;
	$resultado47 = mysqli_query($conexion, $query47);
	$row47 = mysqli_fetch_array($resultado47, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS TRAUMATOLOGÍA Y ORTOPEDIA"),1,0,'J');		
		$pdf->Cell(50,6,$row47[0],1,1,'R');

	$query48="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =486 ".$where;
	$resultado48 = mysqli_query($conexion, $query48);
	$row48 = mysqli_fetch_array($resultado48, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS UROLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row48[0],1,1,'R');

	$query49="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =631 ".$where;
	$resultado49 = mysqli_query($conexion, $query49);
	$row49 = mysqli_fetch_array($resultado49, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CENTRO DE COSTO EXTERNO"),1,0,'J');		
		$pdf->Cell(50,6,$row49[0],1,1,'R');

	$query50="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =248 ".$where;
	$resultado50 = mysqli_query($conexion, $query50);
	$row50 = mysqli_fetch_array($resultado50, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS DE CARDIOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row50[0],1,1,'R');

	$query51="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =249 ".$where;
	$resultado51 = mysqli_query($conexion, $query51);
	$row51 = mysqli_fetch_array($resultado51, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS DE DERMATOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row51[0],1,1,'R');

	$query52="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =251 ".$where;
	$resultado52 = mysqli_query($conexion, $query52);
	$row52 = mysqli_fetch_array($resultado52, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS DE GINECOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row52[0],1,1,'R');


	$query53="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =252 ".$where;
	$resultado53 = mysqli_query($conexion, $query53);
	$row53 = mysqli_fetch_array($resultado53, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS DE GINECO-OBSTETRICIA"),1,0,'J');		
		$pdf->Cell(50,6,$row53[0],1,1,'R');


	$query54="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =256 ".$where;
	$resultado54 = mysqli_query($conexion, $query54);
	$row54 = mysqli_fetch_array($resultado54, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS DE OBTETRICIA"),1,0,'J');		
		$pdf->Cell(50,6,$row54[0],1,1,'R');


	$query55="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =258 ".$where;
	$resultado55 = mysqli_query($conexion, $query55);
	$row55 = mysqli_fetch_array($resultado55, MYSQLI_NUM);


		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS DE OFTALMOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row55[0],1,1,'R');

	$query56="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =261 ".$where;
	$resultado56 = mysqli_query($conexion, $query56);
	$row56 = mysqli_fetch_array($resultado56, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS DE OTORRINOLARINGOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row56[0],1,1,'R');



	$query57="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =262 ".$where;
	$resultado57 = mysqli_query($conexion, $query57);
	$row57 = mysqli_fetch_array($resultado57, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS DE TRAUMATOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row57[0],1,1,'R');



	$query58="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =263 ".$where;
	$resultado58 = mysqli_query($conexion, $query58);
	$row58 = mysqli_fetch_array($resultado58, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS DE UROLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row58[0],1,1,'R');


	$query59="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =267 ".$where;
	$resultado59 = mysqli_query($conexion, $query59);
	$row59 = mysqli_fetch_array($resultado59, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS ENDOSCÓPICOS"),1,0,'J');		
		$pdf->Cell(50,6,$row59[0],1,1,'R');


	$query60="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =269 ".$where;
	$resultado60 = mysqli_query($conexion, $query60);
	$row60 = mysqli_fetch_array($resultado60, MYSQLI_NUM);


		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("PROCEDIMIENTOS NEUROLÓGICOS"),1,0,'J');		
		$pdf->Cell(50,6,$row60[0],1,1,'R');

	$query61="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =471 ".$where;
	$resultado61 = mysqli_query($conexion, $query61);
	$row61 = mysqli_fetch_array($resultado61, MYSQLI_NUM);


		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS MAYOR AMBULATORIA"),1,0,'J');		
		$pdf->Cell(50,6,$row61[0],1,1,'R');

	$query62="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =473 ".$where;
	$resultado62 = mysqli_query($conexion, $query62);
	$row62 = mysqli_fetch_array($resultado62, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("QUIRÓFANOS MENOR AMBULATORIA"),1,0,'J');		
		$pdf->Cell(50,6,$row62[0],1,1,'R');


	$query63="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =517 ".$where;
	$resultado63 = mysqli_query($conexion, $query63);
	$row63 = mysqli_fetch_array($resultado63, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("SALAS DE PARTO"),1,0,'J');		
		$pdf->Cell(50,6,$row63[0],1,1,'R');


	$query64="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =518 ".$where;
	$resultado64 = mysqli_query($conexion, $query64);
	$row64 = mysqli_fetch_array($resultado64, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("LABORATORIO CLÍNICO"),1,0,'J');		
		$pdf->Cell(50,6,$row64[0],1,1,'R');


	$query65="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =537 ".$where;
	$resultado65 = mysqli_query($conexion, $query65);
	$row65 = mysqli_fetch_array($resultado65, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("ECOCARDIOGRAFÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row65[0],1,1,'R');


	$query66="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =540 ".$where;
	$resultado66 = mysqli_query($conexion, $query66);
	$row66 = mysqli_fetch_array($resultado66, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("MAMOGRAFIA"),1,0,'J');		
		$pdf->Cell(50,6,$row66[0],1,1,'R');


	$query67="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =541 ".$where;
	$resultado67 = mysqli_query($conexion, $query67);
	$row67 = mysqli_fetch_array($resultado67, MYSQLI_NUM);


		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("TOMOGRAFÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row67[0],1,1,'R');


	$query68="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =542 ".$where;
	$resultado68 = mysqli_query($conexion, $query68);
	$row68 = mysqli_fetch_array($resultado68, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("IMAGENOLOGÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row68[0],1,1,'R');


	$query69="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =544 ".$where;
	$resultado69 = mysqli_query($conexion, $query69);
	$row69 = mysqli_fetch_array($resultado69, MYSQLI_NUM);


		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("ANATOMÍA PATOLÓGICA"),1,0,'J');		
		$pdf->Cell(50,6,$row69[0],1,1,'R');


	$query100="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =567 ".$where;
	$resultado100 = mysqli_query($conexion, $query100);
	$row100 = mysqli_fetch_array($resultado100, MYSQLI_NUM);

			$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("REHABILITACIÓN"),1,0,'J');		
		$pdf->Cell(50,6,$row100[0],1,1,'R');


	$query71="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =575 ".$where;
	$resultado71 = mysqli_query($conexion, $query71);
	$row71 = mysqli_fetch_array($resultado71, MYSQLI_NUM);

		$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("BANCO DE SANGRE"),1,0,'J');		
		$pdf->Cell(50,6,$row71[0],1,1,'R');



	$query72="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =593 ".$where;
	$resultado72 = mysqli_query($conexion, $query72);
	$row72 = mysqli_fetch_array($resultado72, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("SERVICIO FARMACÉUTICO"),1,0,'J');		
		$pdf->Cell(50,6,$row72[0],1,1,'R');	



	$query73="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =644 ".$where;
	$resultado73 = mysqli_query($conexion, $query73);
	$row73 = mysqli_fetch_array($resultado73, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("AMBULANCIA"),1,0,'J');		
		$pdf->Cell(50,6,$row73[0],1,1,'R');



	$query74="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =662 ".$where;
	$resultado74 = mysqli_query($conexion, $query74);
	$row74 = mysqli_fetch_array($resultado74, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("CENTRAL DE ESTERILIZACIÓN"),1,0,'J');		
		$pdf->Cell(50,6,$row74[0],1,1,'R');



	$query75="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =652 ".$where;
	$resultado75 = mysqli_query($conexion, $query75);
	$row75 = mysqli_fetch_array($resultado75, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("SERVICIO DE ALIMENTACIÓN"),1,0,'J');		
		$pdf->Cell(50,6,$row75[0],1,1,'R');



	$query76="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =654 ".$where;
	$resultado76 = mysqli_query($conexion, $query76);
	$row76 = mysqli_fetch_array($resultado76, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("SERVICIOS DIETÉTICOS DE LECHE"),1,0,'J');		
		$pdf->Cell(50,6,$row76[0],1,1,'R');



	$query77="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =657 ".$where;
	$resultado77 = mysqli_query($conexion, $query77);
	$row77 = mysqli_fetch_array($resultado77, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("LAVANDERÍA Y ROPERÍA"),1,0,'J');		
		$pdf->Cell(50,6,$row77[0],1,1,'R');



	$query78="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =664 ".$where;
	$resultado78 = mysqli_query($conexion, $query78);
	$row78 = mysqli_fetch_array($resultado78, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("TRANSPORTE GENERAL"),1,0,'J');		
		$pdf->Cell(50,6,$row78[0],1,1,'R');



	$query79="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =665 ".$where;
	$resultado79 = mysqli_query($conexion, $query79);
	$row79 = mysqli_fetch_array($resultado79, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("MANTENIMIENTO"),1,0,'J');		
		$pdf->Cell(50,6,$row79[0],1,1,'R');



	$query80="SELECT COUNT(*) AS TT   FROM solicitud_alimentacion as A, personal as B WHERE A.RUT=B.RUT AND B.CENTRO_COSTO =670 ".$where;
	$resultado80 = mysqli_query($conexion, $query80);
	$row80 = mysqli_fetch_array($resultado80, MYSQLI_NUM);

	$pdf->Ln(3);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(100,6,utf8_decode("ADMINISTRACIÓN"),1,0,'J');		
		$pdf->Cell(50,6,$row80[0],1,1,'R');
	

		

		

		


		


	$pdf->Output();
?>