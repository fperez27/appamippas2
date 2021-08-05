<?php
                            $mysqli = new mysqli('localhost', 'root', '', 'amipass');

                          ?>

<!DOCTYPE html>
<html>
<head>
 
  <meta http-equiv=”Content-Type” content=”text/html; charset=ISO-8859-1″ />
  <script type="text/javascript">



</script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

<div class="modal" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Solicitud de Contrato</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
                <form role="form" method="POST" action="guardarhextras.php">

            <div class="modal-body">
                <h2>Ingreso Horas Extras</h2>
                    <div class="form-group">
                        <label for="inputRut">Rut</label>
                        <input type="text" class="form-control" id="inputRut" name="inputRut" readonly="" /> 
                    </div>
                     <div class="form-group">
                        <label for="inputNAME">Nombre</label>
                        <input type="text" class="form-control" id="inputName" name="inputName" readonly="" /> 
                    </div>
                           


                    <!--<div class="form-group">
                        <label for="inputUNIDAD">Unidad</label>
                        <select id="unidad" class="form-control"  >
                            <option value="">Seleccione...</option>
                             <?php
                            //$cons1 = $mysqli->query("SELECT * FROM unidad");
                            //while ($val = mysqli_fetch_array($cons1)) {
                                //echo '<option value="'.$val['NOMBRE'].'">'.$val['NOMBRE'].'</option>';
                            //}
                            ?> 
                        </select>
                         
                    </div>-->
          
                    <div class="form-group">
                        <label for="inputHE100">Horas Extras 100%</label>
                        <input class="form-control" id="he100" name="he100">
                    </div>
                    <div class="form-group">
                        <label for="inputHE125">Horas Extras 125%</label>
                        <input class="form-control" id="he125" name="he125">
                    </div>
                    <div class="form-group">
                        <label for="inputHE150">Horas Extras 150%</label>
                        <input class="form-control" id="he150" name="he150">
                    </div>

                
            </div>

     
      <div class="modal-footer">
       <button type="submit" class="btn btn-primary submitBtn" >Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</form>
      </div>
    </div>
  </div>
</div>
</body>

</html>