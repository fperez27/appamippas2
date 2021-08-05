<?php
$con=mysqli_connect('localhost', 'root', '','amipass') or die(mysqli_error());

 

$usuario = mysqli_real_escape_string($con,$_POST['usuario']);
$pass = mysqli_real_escape_string($con,$_POST['pass']);

//$_SESSION["usuario"]='logeado';
if ($usuario <> '' && $pass <> '') {
	  	$consultaSQL =" SELECT * FROM usuari_amipass where USUARIO = '".$usuario."' ";
    	//$resultado2 = mysqli_query($con, $consultaSQL);

    	$resultado2 = mysqli_query($con, $consultaSQL);
      //$row = mysqli_fetch_array($resultado2,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($resultado2);




    	if ($count==1) {
    					$cons =" SELECT * FROM usuari_amipass where USUARIO = '".$usuario."' AND PASS = '".$pass."'";
    					$resul2 = mysqli_query($con, $cons);
      					//$row2 = mysqli_fetch_array($resul2,MYSQLI_ASSOC);
      					$cuenta = mysqli_num_rows($resul2);

      					if ($cuenta==1) {
      							echo "<script type='text/javascript'>	
						    	window.location='ingresonuevo.php';
						  		</script>";
      					}else{
      							echo "<script type='text/javascript'>
						    	alert('El Nombre de Usuario ".$usuario." no coincide con la contraseña');
						    	window.location='login.html';
						  		</script>";
      					}
    			
    	}else{
    		echo "<script type='text/javascript'>
    	alert('El Nombre de Usuario ".$usuario." no existe en  la base de datos');
    	window.location='login.html';
  		</script>";
    	}

}else{
	
	 	echo "<script type='text/javascript'>
    	alert('el usuario ".$usuario." no existe en  la base de datos');
    	window.location='login.html';
  		</script>";
}

?>