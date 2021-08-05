
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript">
  function registra2(){

           var rut2=document.getElementById("rut22").value;
            var porciones = rut2.split('-');
            var rut =  porciones[0];
            var fecha = document.getElementById("fecha").value;

            var tipo = $('input[name="tipo"]:checked').val();
        location.href="actionalimentacion2.php?rut="+rut+"&tipo="+tipo+"&fecha="+fecha;

      }
</script>
</head>
<body>
<form id="guardarDatos">
<div class="modal fade" id="dataRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Registro manual alimentación</h4>
      </div>
      <div class="modal-body">
        



        <div class="form-group">
            <label for="fecha" class="control-label">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo date("Y-m-d");?>" >
      <input type="hidden" class="form-control" id="id" name="id">
          </div>
      <div class="form-group">
            <label for="rut" class="control-label">Rut:</label>
             <input class="form-control" class='optional' required oninput="checkRut(this)"  type="text" name="rut22" id="rut22"   maxlength="10">
          </div>




        
                                        
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="registra2();">Guardar datos</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</form>
</body>
</html>
