<?php 
require 'conexion.php';
$rut2 = $_POST['inputRut'];
$separada = explode('-', $rut2);
$rut = $separada['0'];


$he100 = $_POST['he100'];
$he125 = $_POST['he125'];
$he150 = $_POST['he150'];
$fecha = date("Y/m/d");
$hora = date('h:i:s');

if ($he100 <>'' && $he150 <>'') {
	$total = $he150 - $he100;
}else if ($he125 <>'' && $he150 <> '' ){
	$total = $he125 + $he150;
}else{
	$total = ($he125 + $he150) - $he100;
}





//INSERT INTO solicitud_alimentacion (ESTADO, SECCION, TIPO, RUT, FECHA, HORA) VALUES ('1', '2', '3', '$rut', '$fecha', '$today')";

//$consulta = "INSERT INTO horasextras_funcionarios (RUT, HORAS100, HORAS125, HORAS150, TOTALHORAS, FECHA) VALUES ('$rut', '$he100', '$he125', '$he150', '$total', '$fecha') ";
//$res = mysqli_query($conexion, $consulta);


$cons2 = "SELECT b.codigo as codigo from funcionarios as a, unidad as b where a.unidad = b.nombre and a.rut = '$rut'";

//$cons2 = "SELECT  b.codigo as codigo FROM personal AS a, unidad AS b WHERE a.seccion = b.nombre AND a.rut = '$rut'";
$res2 = mysqli_query($conexion, $cons2);
$cons21 = mysqli_fetch_array($res2);
$codigouni = $cons21['codigo'];

$contador='';
if ($res2) {
	
					$cons3 = "SELECT COUNT(*) as cont FROM relaunidadxcc WHERE cod_unidad='$codigouni'";
					$res3 = mysqli_query($conexion, $cons3);
					$cons31 = mysqli_fetch_array($res3);
					$canti = $cons31['cont'];




					if ($canti>0) {
						$cantixcc =intdiv($total, $canti);

						$totol = $cantixcc * $canti;

						$restxcc = $total % $canti;

						if ($restxcc <> 0) {
							
							$totoxz = $cantixcc + $restxcc;
						}



							if ($res3){		

									$consulta = "INSERT INTO horasextras_funcionarios (RUT, HORAS100, HORAS125, HORAS150, TOTALHORAS, FECHA, HORA) VALUES ('$rut', '$he100', '$he125', '$he150', '$total', '$fecha', '$hora') ";
									$res1 = mysqli_query($conexion, $consulta);


										$consx = "SELECT MAX(ID) AS ID, TOTALHORAS FROM horasextras_funcionarios where RUT = '$rut' AND FECHA = '$fecha'";
										$resx = mysqli_query($conexion, $consx);
										$consx1 = mysqli_fetch_array($resx);
										$idx = $consx1['ID'];
										$thorasx = $consx1['TOTALHORAS'];
 
										$cons4 = "SELECT * FROM relaunidadxcc WHERE cod_unidad='$codigouni'";
										$res4 = $conexion->query($cons4);

										while($row4 = $res4->fetch_assoc()){

											$query = "INSERT INTO horasxcentroc (RUT, CCOSTO, CANTIDAD, FECHA, IDHEF) VALUES ('$rut', '".$row4["COD_CC"]."', '$cantixcc', '$fecha' , '$idx') ";
											$res22 = mysqli_query($conexion, $query);
											}

											$otro = "SELECT SUM(CANTIDAD) AS SUMA FROM horasxcentroc where RUT = '$rut' AND IDHEF = '$idx' ";
											$otrores = mysqli_query($conexion, $otro);
											$otrocons = mysqli_fetch_array($otrores);
											$sumat = $otrocons['SUMA'];

											$queryuno = "SELECT TOTALHORAS FROM horasextras_funcionarios WHERE RUT = '$rut' AND ID = '$idx' ";
											$unoun = mysqli_query($conexion, $queryuno);
											$unocons = mysqli_fetch_array($unoun);
											$totalhoras = $unocons['TOTALHORAS'];


										
									


											//$consxz = " SELECT MAX(ccosto) AS COSTO FROM horasxcentroc WHERE rut = '$rut' AND IDHEF = 'idx'";
											$consxz = "SELECT ccosto AS COSTO FROM horasxcentroc WHERE rut = '$rut' AND IDHEF = '$idx'  ORDER BY RAND() LIMIT 1";
											$resxz = mysqli_query($conexion, $consxz);
											$consxz1 = mysqli_fetch_array($resxz);
											$cosxz = $consxz1['COSTO'];

											$difxxz = $sumat - $thorasx;
											
										
												
														if ($difxxz > 0) {

																$t = $cantixcc - $difxxz;
																if ($t <> ''  ) {
																	if ($idx <> '') {
																			if ($cosxz <> '') {
																					$actuali = "UPDATE horasxcentroc SET CANTIDAD='$t'  WHERE RUT = '$rut' AND IDHEF='$idx' AND CCOSTO = '$cosxz'";
																					$respxz = mysqli_query($conexion, $actuali);
																					echo "<script>window.alert('no falta nada 1 ');window.open('horaextras.php','_self',null,true);</script>";
																			}else{
																				echo "<script>window.alert('falta num centro costo 1');window.open('horaextras.php','_self',null,true);</script>";
																			}
																	}else{
																		echo "<script>window.alert('falta id de centro cc 1 ');window.open('horaextras.php','_self',null,true);</script>";
																	}
																}else{

																echo "<script>window.alert('error con el total 1 ');window.open('horaextras.php','_self',null,true);</script>";
																}
															}else if ($difxxz < 0) {

																	$to1 = $difxxz * -1;
																	$to2 = $cantixcc + $to1;

																	if ($to2 <> '' ) {
																			if ($rut <> '') {
																					if ($cosxz <> '') {
																						$actuali = "UPDATE horasxcentroc SET CANTIDAD='$to2'  WHERE RUT = '$rut' AND IDHEF='$idx' AND CCOSTO = '$cosxz' ";
																						$respxz = mysqli_query($conexion, $actuali);
																						echo "<script>window.alert('aloja amigos, aloja amigas 2 ');window.open('horaextras.php','_self',null,true);</script>";
																					}else{
																						echo "<script>window.alert('falta num centro costo 2 ');window.open('horaextras.php','_self',null,true);</script>";
																					}
																					
																				}else{
																					echo "<script>window.alert('falta id de centro cc 2 ');window.open('horaextras.php','_self',null,true);</script>";
																				}																		
																	}else{

																	echo "<script>window.alert('error con  el total 2 ');window.open('horaextras.php','_self',null,true);</script>";
																	}

															}


											if ($res22) {

													echo "<script>window.alert('REGISTRO CORRECTO');window.open('horaextras.php','_self',null,true);</script>";
											}				
								}

					}else{
						echo "<script>window.alert('Problemas con la unidad del Funcionario, Revise datos asociados.');window.open('horaextras.php','_self',null,true);</script>";
					}

}else{
	echo "<script>window.alert('Error al asociar ');window.open('horaextras.php','_self',null,true);</script>";
}



?>