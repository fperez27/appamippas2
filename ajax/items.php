<?php
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	/*if (isset($_REQUEST['id'])){
		$id=intval($_REQUEST['id']);
		$delete=mysqli_query($con,"delete from tmp where id='$id'");
	}*/
	
	$rut = $_GET['ruut'];
	//$candidato = $_POST['candidato'];
	$fecha = date("Y/m/d");

		
	$cons2 = "SELECT * FROM  personal where RUT='$rut'";
	$res2 = mysqli_query($con, $cons2);
	if (mysqli_num_rows($res2)>0){
					$consulta = " SELECT * FROM solicitud_alimentacion WHERE RUT='$rut' AND FECHA = '$fecha'";
					$rs_tabla = mysqli_query($con, $consulta);
					if (mysqli_num_rows($rs_tabla) ==0) {
						

						$consulta2="SELECT * FROM personal WHERE RUT= '$rut'";
						$rs_query=mysqli_query($con, $consulta2);
						//$rut1=mysqli_result($rs_query,"NOMBRE");
						//$seccion=mysqli_result($rs_query,"SECCION");
						//$iva=mysql_result($rs_query,0,"iva");
						//$orden=mysql_result($rs_query,0,"orden");
						$sql2 = "INSERT INTO solicitud_alimentacion (ESTADO, SECCION, TIPO, RUT, FECHA) VALUES ('1', '2', '2', '$rut', '$fecha')";
						$res2 = mysqli_query($con, $sql2);
						
						if($res2){
						echo "<script>window.alert('REGISTRO CORRECTO');window.open('index.php','_self',null,true);</script>";
					}
					} else { 

							echo "<script>window.alert('IMPOSIBLE ACEPTAR SU SOLICITUD, YA SE REGISTRO EL DIA DE HOY'); window.open('index.php','_self',null,true);</script>";
						
						
					//$res2 = mysqli_query($Conn,$sql2);
							 }
		
	}else{
		echo "<script>window.alert('RUT NO ENCONTRADO, FAVOR CONTACTAR AL ADMINISTRADOR');window.open('index.php','_self',null,true);</script>";
	}






















	/*if (isset($_POST['descripcion'])){
		
		$descripcion=mysqli_real_escape_string($con,$_POST['descripcion']);
		$cantidad=intval($_POST['cantidad']);
		$precio=floatval($_POST['precio']);
		$unidad=mysqli_real_escape_string($con,$_POST['unidad']);
		$sql="INSERT INTO `tmp` (`id`, `descripcion`, `cantidad`, `precio`,unidad) VALUES (NULL, '$descripcion', '$cantidad', '$precio','$unidad');";
		$insert=mysqli_query($con,$sql);
	}*/
	
	$query=mysqli_query($con,"SELECT A.RUT, A.FECHA, A.ID_SOL, B.DV, B.NOMBRE, B.APEPAT, B.APEMAT, B.SECCION FROM solicitud_alimentacion A, PERSONAL B WHERE A.RUT = B.RUT AND A.FECHA = '$fecha'");
	$items=1;
	$suma=0;
	while($row=mysqli_fetch_array($query)){
			//$total=$row['cantidad']*$row['precio'];
			//$total=number_format($total,2,'.','');
		?>
	<tr>
		<td class='text-center'><?php echo $items;?></td>
		<td class='text-center'><?php echo $row['ID_SOL'];?></td>
		<td class='text-center'><?php echo $row['RUT'];?>-<?php echo $row['DV'];?></td>
		<td><?php echo $row['NOMBRE'];?></td>
		<td class='text-right'><?php echo $row['APEPAT'];?></td>
		<td class='text-right'><?php echo $row['APEMAT'];?></td>
		<td class='text-right'><a href="#" onclick="eliminar_item('<?php echo $row['id']; ?>')" ><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAeFBMVEUAAADnTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDznTDx+VWpeAAAAJ3RSTlMAAQIFCAkPERQYGi40TVRVVlhZaHR8g4WPl5qdtb7Hys7R19rr7e97kMnEAAAAaklEQVQYV7XOSQKCMBQE0UpQwfkrSJwCKmDf/4YuVOIF7F29VQOA897xs50k1aknmnmfPRfvWptdBjOz29Vs46B6aFx/cEBIEAEIamhWc3EcIRKXhQj/hX47nGvt7x8o07ETANP2210OvABwcxH233o1TgAAAABJRU5ErkJggg=="></a></td>
	</tr>	
		<?php
		$items++;
		//$suma+=$total;
	}
	?>


<?php

}