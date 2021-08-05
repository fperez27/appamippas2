<?php
//conexion=mysqli_connect('localhost', 'root', '','amipass') or die(mysqli_error());
include 'plantilla.php';
require 'conexion.php';


	//$rut = $_GET['rut'];
	//$seccion = $_GET['seccion'];	
	
	//$where  = ' 1=1 AND';
	


	//$where=" ORDER BY FECHA DESC";
	$query = "SELECT A.RUT , A.NOMBRE, A.APEPAT, A.APEMAT, A.SECCION, B.HORAS100, B.HORAS125, B.HORAS150, B.TOTALHORAS, B.ID FROM personal AS A, horasextras_funcionarios AS B WHERE A.RUT=B.RUT";
	//$query ="SELECT A.FECHA, A.HORA, A.TIPO, B.SECCION, CONCAT(A.RUT, '-' ,B.DV ) AS RUT, CONCAT(B.NOMBRE, ' ',B.APEPAT, ' ',B.APEMAT) AS FULLNAME   FROM solicitud_alimentacion as A, personal as B WHERE" .$where. 	" A.RUT=B.RUT ";
	$res2a = mysqli_query($conexion, $query);




$salida = "<table><thead><th>RUT</th><th>NOMBRE</th><th>UNIDAD</th><th>H. 100</th><th>H. 125</th><th>H. 150</th><th>Total Horas</th><th>65-HOSPITALIZACIÓN PENSIONADOS</th><th>66-HOSPITALIZACIÓN MEDICINA INTERNA</th><th>90-HOSPITALIZACIÓN QUIRÚRGICA</th><th>113-HOSPITALIZACIÓN OBSTETRICIA</th><th>114-HOSPITALIZACIÓN GINECOLOGÍA</th><th>116-HOSPITALIZACIÓN PEDIATRÍA</th><th>117-HOSPITALIZACIÓN NEONATOLOGÍA</th><th>149-HOSPITALIZACIÓN PSIQUIATRÍA</th><th>152-HOSPITALIZACIÓN EN CASA</th><th>159-HOSPITALIZACIÓN DE DIA</th><th>160-HOGAR PROTEGIDO</th><th>166-UNIDAD DE CUIDADOS INTENSIVOS</th><th>195-UNIDAD DE TRATAMIENTO INTENSIVO ADULTO</th><th>196-UNIDAD DE TRATAMIENTO INTENSIVO PEDÍATRICA</th><th>197-UNIDAD DE TRATAMIENTO INTENSIVO NEONATOLOGÍA</th><th>201-EMERGENCIAS</th><th>232-CONSULTA OTROS PROFESIONALES</th><th>237-CONSULTAS MÉDICAS</th><th>273-CONSULTA MEDICINA INTERNA</th><th>274 - CONSULTA NEUROLOGÍA</th><th>276 - CONSULTA CARDIOLOGÍA
</th><th>277 - CONSULTA DERMATOLOGÍA</th><th>279 - CONSULTA VIH</th><th>280 - CONSULTA PSIQUIATRÍA</th><th>281 - CONSULTA ENDOCRINOLOGÍA</th><th>289 - CONSULTA FISIATRÍA</th><th>294 - CONSULTA MANEJO DEL DOLOR</th><th>302 - CONSULTA ENFERMEDADES DE TRANSMISIÓN SEXUAL</th><th>309 - CONSULTA CIRUGÍA GENERAL</th><th>311 - CONSULTA UROLOGÍA
</th><th>317 - CONSULTA OFTALMOLOGÍA</th><th>318 - CONSULTA CIRUGÍA VASCULAR PERIFÉRICA</th><th>319 - CONSULTA OTORRINOLARINGOLOGÍA</th><th>326 - CONSULTA MÉDICA DE TRAUMATOLOGÍA</th><th>328 - CONSULTA PEDIATRÍA GENERAL</th><th>331 - CONSULTA NEUROLOGÍA PEDIÁTRICA</th><th>353 - CONSULTA GINECOLOGICA</th><th>354 - CONSULTA OBSTETRICIA</th><th>356 - CONSULTA ODONTOLOGÍA</th><th>359 - TELEMEDICINA</th><th>464 - QUIRÓFANOS CARDIOVASCULAR</th><th>465 - QUIRÓFANOS DE EMERGENCIA</th><th>467 - QUIRÓFANOS DIGESTIVA</th><th>470 - QUIRÓFANOS GINECOLOGÍA</th><th>477 - QUIRÓFANOS ODONTOLOGICA</th><th>478 - QUIRÓFANOS OFTALMOLOGÍA</th><th>480 - QUIRÓFANOS OTORRINOLARINGOLOGÍA</th><th>485 - QUIRÓFANOS TRAUMATOLOGÍA Y ORTOPEDIA</th><th>486 - QUIRÓFANOS UROLOGÍA</th><th>631 - CENTRO DE COSTOS EXTERNO</th><th>248 - PROCEDIMIENTOS DE CARDIOLOGÍA</th><th>249 - PROCEDIMIENTOS DE DERMATOLOGÍA</th><th>251 - PROCEDIMIENTOS DE GINECOLOGÍA</th><th>252 - PROCEDIMIENTOS DE GINECO - OBSTETRICIA</th><th>256 - PROCEDIMIENTOS DE OBSTETRICIA</th><th>258 - PROCEDIMIENTOS DE OFTALMOLOGÍA</th><th>261 - PROCEDIMIENTOS DE OTORRINOLARINGOLOGÍA</th><th>262 - PROCEDIMIENTOS DE TRAUMATOLOGÍA</th><th>263 - PROCEDIMIENTOS DE UROLOGÍA</th><th>267 - PROCEDIMIENTOS ENDOSCÓPICOS</th><th>269 - PROCEDIMIENTOS NEUROLÓGICOS</th><th>471 - QUIRÓFANOS MAYOR AMBULATORIA</th><th>473 - QUIRÓFANOS MENOR AMBULATORIA</th><th>517 - SALAS DE PARTO</th><th>518 - LABORATORIO CLÍNICO</th><th>537 - ECOCARDIOGRAFÍA</th><th>540 - MAMOGRAFÍA</th><th>541 - TOMOGRAFÍA</th><th>542 - IMAGENOLOGÍA</th><th>544 - ANATOMÍA PATOLÓGICA</th><th>567 - REHABILITACIÓN</th><th>575 - BANCO DE SANGRE</th><th>593 - SERVICIO FARMACEUTICO</th><th>644 - AMBULANCIA</th><th>662 - CENTRAL DE ESTERILIZACIÓN</th><th>652 - SERVICIO DE ALIMENTACIÓN</th><th>654 - SERVICIO DIETÉTICOS DE LECHE</th><th>657 - LAVANDERIA Y ROPERIA</th><th>664- TRANSPORTE GENERAL</th><th>665-MANTENIMIENTO</th><th>670-ADMINISTRACIÓN</th></thead><tbody>";


while($r=$res2a->fetch_Object()){

	$ruut = $r->RUT.'-'.$r->RUT;
	$nombre = $r->NOMBRE.' '.$r->APEPAT.' '.$r->APEMAT;
	$id = $r->ID;

$salida .= 	"<tr><td>".$ruut."</td>
			<td>".utf8_decode($nombre)." </td>
			<td>".$r->SECCION."</td>
			<td>".$r->HORAS100."</td>
			<td>".$r->HORAS125."</td>
			<td>".$r->HORAS150."</td>
			<td>".$r->TOTALHORAS."</td>";
			$cons1 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='65' AND RUT= '$ruut' AND IDHEF='$id'";
			$res1 = mysqli_query($conexion, $cons1);
			
			$cons11 = mysqli_fetch_array($res1);
			if ($cons11 <> '') {
			$resp1 = $cons11['CANTIDAD'];
			$salida .= "<td>".$resp1."</td>";
			}else{
				$salida .= "<td></td>";
			}
			$cons2 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='66' AND RUT= '$ruut' AND IDHEF='$id'";
			$res2 = mysqli_query($conexion, $cons2);
			$cons12 = mysqli_fetch_array($res2);
			if ($cons12 <> '') {
			$resp2 = $cons12['CANTIDAD'];
			$salida .= "<td>".$resp2."</td>";
			}else{
				$salida .= "<td></td>";
			}
			$cons3 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='90' AND RUT= '$ruut' AND IDHEF='$id'";
			$res3 = mysqli_query($conexion, $cons3);
			$cons13 = mysqli_fetch_array($res3);
			if ($cons13 <> '') {
			$resp3 = $cons13['CANTIDAD'];
			$salida .= "<td>".$resp3."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons4 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='113' AND RUT= '$ruut' AND IDHEF='$id'";
			$res4 = mysqli_query($conexion, $cons4);
			$cons14 = mysqli_fetch_array($res4);
			if ($cons14 <> '') {
			$resp4 = $cons14['CANTIDAD'];
			$salida .= "<td>".$resp4."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons5 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='114' AND RUT= '$ruut' AND IDHEF='$id'";
			$res5 = mysqli_query($conexion, $cons5);
			$cons15 = mysqli_fetch_array($res5);
			if ($cons15 <> '') {
			$resp5 = $cons15['CANTIDAD'];
			$salida .= "<td>".$resp5."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons6 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='116' AND RUT= '$ruut' AND IDHEF='$id'";
			$res6 = mysqli_query($conexion, $cons6);
			$cons16 = mysqli_fetch_array($res6);
			if ($cons16 <> '') {
			$resp6 = $cons16['CANTIDAD'];
			$salida .= "<td>".$resp6."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons7 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='117' AND RUT= '$ruut' AND IDHEF='$id'";
			$res7 = mysqli_query($conexion, $cons7);
			$cons17 = mysqli_fetch_array($res7);
			if ($cons17 <> '') {
			$resp7 = $cons17['CANTIDAD'];
			$salida .= "<td>".$resp7."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons8 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='149' AND RUT= '$ruut' AND IDHEF='$id'";
			$res8 = mysqli_query($conexion, $cons8);
			$cons18 = mysqli_fetch_array($res8);
			if ($cons18 <> '') {
			$resp8 = $cons18['CANTIDAD'];
			$salida .= "<td>".$resp8."</td>";
			}else{
				$salida .= "<td></td>";
			}

			/*$cons8 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='149' AND RUT= '$r->RUT' ";
			$res8 = mysqli_query($conexion, $cons8);
			$cons18 = mysqli_fetch_array($res8);
			$resp8 = $cons18['CANTIDAD'];
			if ($resp8 <> '') {
			$salida .= "<td>".$resp8."</td>";
			}else{
				$salida .= "<td></td>";
			}*/

			$cons9 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='152' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res9 = mysqli_query($conexion, $cons9);
			$cons19 = mysqli_fetch_array($res9);
			if ($cons19 <> '') {
			$resp9 = $cons19['CANTIDAD'];
			$salida .= "<td>".$resp9."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons10 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='159' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res10 = mysqli_query($conexion, $cons10);
			$cons110 = mysqli_fetch_array($res10);
			if ($cons110 <> '') {
			$resp10 = $cons110['CANTIDAD'];
			$salida .= "<td>".$resp10."</td>";
			}else{
				$salida .= "<td></td>";
			}


			$cons11 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='160' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res11 = mysqli_query($conexion, $cons11);
			$cons111 = mysqli_fetch_array($res11);
			if ($cons111 <> '') {
			$resp11 = $cons111['CANTIDAD'];
			$salida .= "<td>".$resp11."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons12= "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='166' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res12 = mysqli_query($conexion, $cons12);
			$cons112 = mysqli_fetch_array($res12);
			if ($cons112 <> '') {
			$resp12 = $cons112['CANTIDAD'];
			$salida .= "<td>".$resp12."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons13 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='195' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res13 = mysqli_query($conexion, $cons13);
			$cons113 = mysqli_fetch_array($res13);
			if ($cons113 <> '') {
			$resp13 = $cons113['CANTIDAD'];
			$salida .= "<td>".$resp13."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons14 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='196' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res14 = mysqli_query($conexion, $cons14);
			$cons114 = mysqli_fetch_array($res14);
			if ($cons114 <> '') {
			$resp14 = $cons114['CANTIDAD'];
			$salida .= "<td>".$resp14."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons15 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='197' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res15 = mysqli_query($conexion, $cons15);
			$cons115 = mysqli_fetch_array($res15);
			if ($cons115 <> '') {
			$resp15 = $cons115['CANTIDAD'];
			$salida .= "<td>".$resp15."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons16 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='201' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res16 = mysqli_query($conexion, $cons16);
			$cons116 = mysqli_fetch_array($res16);
			if ($cons116 <> '') {
			$resp16 = $cons116['CANTIDAD'];
			$salida .= "<td>".$resp16."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons17 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='232' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res17 = mysqli_query($conexion, $cons17);
			$cons117 = mysqli_fetch_array($res17);
			if ($cons117 <> '') {
			$resp17 = $cons117['CANTIDAD'];
			$salida .= "<td>".$resp17."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons18 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='237' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res18 = mysqli_query($conexion, $cons18);
			$cons118 = mysqli_fetch_array($res18);
			if ($cons118 <> '') {
			$resp18 = $cons118['CANTIDAD'];
			$salida .= "<td>".$resp18."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons19 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='273' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res19 = mysqli_query($conexion, $cons19);
			$cons119 = mysqli_fetch_array($res19);
			if ($cons119 <> '') {
			$resp19 = $cons119['CANTIDAD'];
			$salida .= "<td>".$resp19."</td>";
			}else{
				$salida .= "<td></td>";
			}


			$cons20 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='274' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res20 = mysqli_query($conexion, $cons20);
			$cons120 = mysqli_fetch_array($res20);
			if ($cons120 <> '') {
			$resp20 = $cons120['CANTIDAD'];
			$salida .= "<td>".$resp20."</td>";
			}else{
				$salida .= "<td></td>";
			}


			$cons21 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='276' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res21 = mysqli_query($conexion, $cons21);
			$cons121 = mysqli_fetch_array($res21);
			if ($cons121 <> '') {
			$resp21 = $cons121['CANTIDAD'];
			$salida .= "<td>".$resp21."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons22 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='277' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res22 = mysqli_query($conexion, $cons22);
			$cons122 = mysqli_fetch_array($res22);
			if ($cons122 <> '') {
			$resp22 = $cons122['CANTIDAD'];
			$salida .= "<td>".$resp22."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons23 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='279' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res23 = mysqli_query($conexion, $cons23);
			$cons123 = mysqli_fetch_array($res23);
			if ($cons123 <> '') {
			$resp23 = $cons123['CANTIDAD'];
			$salida .= "<td>".$resp23."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons24 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='280' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res24 = mysqli_query($conexion, $cons24);
			$cons124 = mysqli_fetch_array($res24);
			if ($cons124 <> '') {
			$resp24 = $cons124['CANTIDAD'];
			$salida .= "<td>".$resp24."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons25 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='281' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res25 = mysqli_query($conexion, $cons25);
			$cons125 = mysqli_fetch_array($res25);
			if ($cons125 <> '') {
			$resp25 = $cons125['CANTIDAD'];
			$salida .= "<td>".$resp25."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons26 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='289' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res26 = mysqli_query($conexion, $cons26);
			$cons126 = mysqli_fetch_array($res26);
			if ($cons126 <> '') {
			$resp26 = $cons126['CANTIDAD'];
			$salida .= "<td>".$resp26."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons27 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='294' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res27 = mysqli_query($conexion, $cons27);
			$cons127 = mysqli_fetch_array($res27);
			if ($cons127 <> '') {
			$resp27 = $cons127['CANTIDAD'];
			$salida .= "<td>".$resp27."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons28 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='302' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res28 = mysqli_query($conexion, $cons28);
			$cons128 = mysqli_fetch_array($res28);
			if ($cons128 <> '') {
			$resp28 = $cons128['CANTIDAD'];
			$salida .= "<td>".$resp28."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons29 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='309' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res29 = mysqli_query($conexion, $cons29);
			$cons129 = mysqli_fetch_array($res29);
			if ($cons129 <> '') {
			$resp29 = $cons129['CANTIDAD'];
			$salida .= "<td>".$resp29."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons30 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='311' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res30 = mysqli_query($conexion, $cons30);
			$cons130 = mysqli_fetch_array($res30);
			if ($cons130 <> '') {
			$resp30 = $cons130['CANTIDAD'];
			$salida .= "<td>".$resp30."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons31 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='317' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res31 = mysqli_query($conexion, $cons31);
			$cons131 = mysqli_fetch_array($res31);
			if ($cons131 <> '') {
			$resp31 = $cons131['CANTIDAD'];
			$salida .= "<td>".$resp31."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons32 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='318' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res32 = mysqli_query($conexion, $cons32);
			$cons132 = mysqli_fetch_array($res32);
			if ($cons132 <> '') {
			$resp32 = $cons132['CANTIDAD'];
			$salida .= "<td>".$resp32."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons33 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='319' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res33 = mysqli_query($conexion, $cons33);
			$cons133 = mysqli_fetch_array($res33);
			if ($cons133 <> '') {
			$resp33 = $cons133['CANTIDAD'];
			$salida .= "<td>".$resp33."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons34 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='326' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res34 = mysqli_query($conexion, $cons34);
			$cons134 = mysqli_fetch_array($res34);
			if ($cons134 <> '') {
			$resp34 = $cons134['CANTIDAD'];
			$salida .= "<td>".$resp34."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons35 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='328' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res35 = mysqli_query($conexion, $cons35);
			$cons135 = mysqli_fetch_array($res35);
			if ($cons135 <> '') {
			$resp35 = $cons135['CANTIDAD'];
			$salida .= "<td>".$resp35."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons36 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='331' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res36 = mysqli_query($conexion, $cons36);
			$cons136 = mysqli_fetch_array($res36);
			if ($cons136 <> '') {
			$resp36 = $cons136['CANTIDAD'];
			$salida .= "<td>".$resp36."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons37 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='353' AND RUT= '$r->RUT'AND IDHEF='$id' ";
			$res37 = mysqli_query($conexion, $cons37);
			$cons137 = mysqli_fetch_array($res37);
			if ($cons137 <> '') {
			$resp37 = $cons137['CANTIDAD'];
			$salida .= "<td>".$resp37."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons38 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='354' AND RUT= '$r->RUT' AND IDHEF='$id' ";
			$res38 = mysqli_query($conexion, $cons38);
			$cons138 = mysqli_fetch_array($res38);
			if ($cons138 <> '') {
			$resp38 = $cons138['CANTIDAD'];
			$salida .= "<td>".$resp38."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons39 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='356' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res39 = mysqli_query($conexion, $cons39);
			$cons139 = mysqli_fetch_array($res39);
			if ($cons139 <> '') {
			$resp39 = $cons139['CANTIDAD'];
			$salida .= "<td>".$resp39."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons40 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='359' AND RUT= '$r->RUT' AND IDHEF='$id' ";
			$res40 = mysqli_query($conexion, $cons40);
			$cons140 = mysqli_fetch_array($res40);
			if ($cons140 <> '') {
			$resp40 = $cons140['CANTIDAD'];
			$salida .= "<td>".$resp40."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons41 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='464' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res41 = mysqli_query($conexion, $cons41);
			$cons141 = mysqli_fetch_array($res41);
			if ($cons141 <> '') {
			$resp41 = $cons141['CANTIDAD'];
			$salida .= "<td>".$resp41."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons42 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='465' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res42 = mysqli_query($conexion, $cons42);
			$cons142 = mysqli_fetch_array($res42);
			if ($cons142 <> '') {
			$resp42 = $cons142['CANTIDAD'];
			$salida .= "<td>".$resp42."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons43 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='467' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res43 = mysqli_query($conexion, $cons43);
			$cons143 = mysqli_fetch_array($res43);
			if ($cons143 <> '') {
			$resp43 = $cons143['CANTIDAD'];
			$salida .= "<td>".$resp43."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons44 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='470' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res44 = mysqli_query($conexion, $cons44);
			$cons144 = mysqli_fetch_array($res44);
			if ($cons144 <> '') {
			$resp44 = $cons144['CANTIDAD'];
			$salida .= "<td>".$resp44."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons45 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='477' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res45 = mysqli_query($conexion, $cons45);
			$cons145 = mysqli_fetch_array($res45);
			if ($cons145 <> '') {
			$resp45 = $cons145['CANTIDAD'];
			$salida .= "<td>".$resp45."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons46 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='478' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res46 = mysqli_query($conexion, $cons46);
			$cons146 = mysqli_fetch_array($res46);
			if ($cons146 <> '') {
			$resp46 = $cons146['CANTIDAD'];
			$salida .= "<td>".$resp46."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons47 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='480' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res47 = mysqli_query($conexion, $cons47);
			$cons147 = mysqli_fetch_array($res47);
			if ($cons147 <> '') {
			$resp47 = $cons147['CANTIDAD'];
			$salida .= "<td>".$resp47."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons48 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='485' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res48 = mysqli_query($conexion, $cons48);
			$cons148 = mysqli_fetch_array($res48);
			if ($cons148 <> '') {
			$resp48 = $cons148['CANTIDAD'];
			$salida .= "<td>".$resp48."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons49 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='486' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res49 = mysqli_query($conexion, $cons49);
			$cons149 = mysqli_fetch_array($res49);
			if ($cons149 <> '') {
			$resp49 = $cons149['CANTIDAD'];
			$salida .= "<td>".$resp49."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons50 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='631' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res50 = mysqli_query($conexion, $cons50);
			$cons150 = mysqli_fetch_array($res50);
			if ($cons150 <> '') {
			$resp50 = $cons150['CANTIDAD'];
			$salida .= "<td>".$resp50."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons51 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='248' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res51 = mysqli_query($conexion, $cons51);
			$cons151 = mysqli_fetch_array($res51);
			if ($cons151 <> '') {
			$resp51 = $cons151['CANTIDAD'];
			$salida .= "<td>".$resp51."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons52 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='249' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res52 = mysqli_query($conexion, $cons52);
			$cons152 = mysqli_fetch_array($res52);
			if ($cons152 <> '') {
			$resp52 = $cons152['CANTIDAD'];
			$salida .= "<td>".$resp52."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons53 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='251' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res53 = mysqli_query($conexion, $cons53);
			$cons153 = mysqli_fetch_array($res53);
			if ($cons153 <> '') {
			$resp53 = $cons153['CANTIDAD'];
			$salida .= "<td>".$resp53."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons54 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='252' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res54 = mysqli_query($conexion, $cons54);
			$cons154 = mysqli_fetch_array($res54);
			if ($cons154 <> '') {
			$resp54 = $cons154['CANTIDAD'];
			$salida .= "<td>".$resp54."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons55 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='256' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res55 = mysqli_query($conexion, $cons55);
			$cons155 = mysqli_fetch_array($res55);
			if ($cons155 <> '') {
			$resp55 = $cons155['CANTIDAD'];
			$salida .= "<td>".$resp55."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons56 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='258' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res56 = mysqli_query($conexion, $cons56);
			$cons156 = mysqli_fetch_array($res56);
			if ($cons156 <> '') {
			$resp56 = $cons156['CANTIDAD'];
			$salida .= "<td>".$resp56."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons57 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='261' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res57 = mysqli_query($conexion, $cons57);
			$cons157 = mysqli_fetch_array($res57);
			if ($cons157 <> '') {
			$resp57 = $cons157['CANTIDAD'];
			$salida .= "<td>".$resp57."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons58 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='262' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res58 = mysqli_query($conexion, $cons58);
			$cons158 = mysqli_fetch_array($res58);
			if ($cons158 <> '') {
			$resp58 = $cons158['CANTIDAD'];
			$salida .= "<td>".$resp58."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons59 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='263' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res59 = mysqli_query($conexion, $cons59);
			$cons159 = mysqli_fetch_array($res59);
			if ($cons159 <> '') {
			$resp59 = $cons159['CANTIDAD'];
			$salida .= "<td>".$resp59."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons60 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='267' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res60 = mysqli_query($conexion, $cons60);
			$cons160 = mysqli_fetch_array($res60);
			if ($cons160 <> '') {
			$resp60 = $cons160['CANTIDAD'];
			$salida .= "<td>".$resp60."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons61 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='269' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res61 = mysqli_query($conexion, $cons61);
			$cons161 = mysqli_fetch_array($res61);
			if ($cons161 <> '') {
			$resp61 = $cons161['CANTIDAD'];
			$salida .= "<td>".$resp61."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons62 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='471' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res62 = mysqli_query($conexion, $cons62);
			$cons162 = mysqli_fetch_array($res62);
			if ($cons162 <> '') {
			$resp62 = $cons162['CANTIDAD'];
			$salida .= "<td>".$resp62."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons63 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='473' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res63 = mysqli_query($conexion, $cons63);
			$cons163 = mysqli_fetch_array($res63);
			if ($cons163 <> '') {
			$resp63 = $cons163['CANTIDAD'];
			$salida .= "<td>".$resp63."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons64 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='517' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res64 = mysqli_query($conexion, $cons64);
			$cons164 = mysqli_fetch_array($res64);
			if ($cons164 <> '') {
			$resp64 = $cons164['CANTIDAD'];
			$salida .= "<td>".$resp64."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons65 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='518' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res65 = mysqli_query($conexion, $cons65);
			$cons165 = mysqli_fetch_array($res65);
			if ($cons165 <> '') {
			$resp65 = $cons165['CANTIDAD'];
			$salida .= "<td>".$resp65."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons66 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='537' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res66 = mysqli_query($conexion, $cons66);
			$cons166 = mysqli_fetch_array($res66);
			if ($cons166 <> '') {
			$resp66 = $cons166['CANTIDAD'];
			$salida .= "<td>".$resp66."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons67 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='540' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res67 = mysqli_query($conexion, $cons67);
			$cons167 = mysqli_fetch_array($res67);
			if ($cons167 <> '') {
			$resp67 = $cons167['CANTIDAD'];
			$salida .= "<td>".$resp67."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons68 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='541' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res68 = mysqli_query($conexion, $cons68);
			$cons168 = mysqli_fetch_array($res68);
			if ($cons168 <> '') {
			$resp68 = $cons168['CANTIDAD'];
			$salida .= "<td>".$resp68."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons69 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='542' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res69 = mysqli_query($conexion, $cons69);
			$cons169 = mysqli_fetch_array($res69);
			if ($cons169 <> '') {
			$resp69 = $cons169['CANTIDAD'];
			$salida .= "<td>".$resp69."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons70 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='544' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res70 = mysqli_query($conexion, $cons70);
			$cons170 = mysqli_fetch_array($res70);
			if ($cons170 <> '') {
			$resp70 = $cons170['CANTIDAD'];
			$salida .= "<td>".$resp70."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons71 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='567' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res71 = mysqli_query($conexion, $cons71);
			$cons171 = mysqli_fetch_array($res71);
			if ($cons171 <> '') {
			$resp71 = $cons171['CANTIDAD'];
			$salida .= "<td>".$resp71."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons72 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='575' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res72 = mysqli_query($conexion, $cons72);
			$cons172 = mysqli_fetch_array($res72);
			if ($cons172 <> '') {
			$resp72 = $cons172['CANTIDAD'];
			$salida .= "<td>".$resp72."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons73 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='593' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res73 = mysqli_query($conexion, $cons73);
			$cons173 = mysqli_fetch_array($res73);
			if ($cons173 <> '') {
			$resp73 = $cons173['CANTIDAD'];
			$salida .= "<td>".$resp73."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons74 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='644' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res74 = mysqli_query($conexion, $cons74);
			$cons174 = mysqli_fetch_array($res74);
			if ($cons174 <> '') {
			$resp74 = $cons174['CANTIDAD'];
			$salida .= "<td>".$resp74."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons75 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='662' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res75 = mysqli_query($conexion, $cons75);
			$cons175 = mysqli_fetch_array($res75);
			if ($cons175 <> '') {
			$resp75 = $cons175['CANTIDAD'];
			$salida .= "<td>".$resp75."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons76 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='652' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res76 = mysqli_query($conexion, $cons76);
			$cons176 = mysqli_fetch_array($res76);
			if ($cons176 <> '') {
			$resp76 = $cons176['CANTIDAD'];
			$salida .= "<td>".$resp76."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons77 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='654' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res77 = mysqli_query($conexion, $cons77);
			$cons177 = mysqli_fetch_array($res77);
			if ($cons177 <> '') {
			$resp77 = $cons177['CANTIDAD'];
			$salida .= "<td>".$resp77."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons78 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='657' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res78 = mysqli_query($conexion, $cons78);
			$cons178 = mysqli_fetch_array($res78);
			if ($cons178 <> '') {
			$resp78 = $cons178['CANTIDAD'];
			$salida .= "<td>".$resp78."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons79 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='664' AND RUT= '$r->RUT'AND IDHEF='$id' ";
			$res79 = mysqli_query($conexion, $cons79);
			$cons179 = mysqli_fetch_array($res79);
			if ($cons179 <> '') {
			$resp79 = $cons179['CANTIDAD'];
			$salida .= "<td>".$resp79."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons80 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='665' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res80 = mysqli_query($conexion, $cons80);
			$cons180 = mysqli_fetch_array($res80);
			if ($cons180 <> '') {
			$resp80 = $cons180['CANTIDAD'];
			$salida .= "<td>".$resp80."</td>";
			}else{
				$salida .= "<td></td>";
			}

			$cons81 = "SELECT CANTIDAD FROM horasxcentroc WHERE CCOSTO='670' AND RUT= '$r->RUT' AND IDHEF='$id'";
			$res81 = mysqli_query($conexion, $cons81);
			$cons181 = mysqli_fetch_array($res81);
			if ($cons181 <> '') {
			$resp81 = $cons181['CANTIDAD'];
			$salida .= "<td>".$resp81."</td>";
			}else{
				$salida .= "<td></td>";
			}





$salida .= "</tr>";
}

$salida .="</table>";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=report.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $salida;
?>