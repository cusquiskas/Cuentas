<?php 
 $infoRecord = $Recordatorio->buscaId(array('id'=>$Enlace->getExtra(), 'usuario_id'=>$Usuario->getId()));
?>
     <div id="modalGestionRecordatorio" class="modal fade" role="dialog">
      <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header btn-primary">
	   <h4 class="modal-title">Gestión Recordatorio</h4>
	  </div>
	  <form role="form" method="post">
	  <div class="modal-body">
	    <input type="hidden" name="id" value="<?php echo $infoRecord["id"]; ?>"><input type="hidden" name="sistema" value="<?php echo $infoRecord["sistema"]; ?>">
	    <input type="hidden" name="irA" value="ListadoMovimiento">
	    <label for="fecha">Fecha:</label>
	    <div class="input-group date" id="fecha">
	      
	      <input type="text" class="form-control" name="fecha" required value="<?php echo $infoRecord["fecha"]; ?>">
	      <span class="input-group-addon">
		   <span class="glyphicon glyphicon-calendar"></span>
		  </span>
	    </div>
	    <div class="form-group">
	      <label for="descripcion">Descripción:</label>
	      <input type="text" class="form-control" name="descripcion" id="descripcion" required value="<?php echo $infoRecord["descripcion"]; ?>">
	    </div>
	    <div class="form-group">
	      <label for="importe">Importe:</label>
	      <input type="number" class="form-control" step="0.01" name="importe" id="importe" required value="<?php echo $infoRecord["importe"]; ?>">
	    </div>
	    
	  </div>
	  <div class="modal-footer">
	    <button type="submit" class="btn btn-default" name="accion" value="GuardarRecordatorio">Guardar</button>
	    <button type="submit" class="btn btn-default" name="accion" value="BorrarRecordatorio">Borrar</button>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	  </div>
	 </form> 
	</div>
      </div>
    </div>
    <script>
     $("#modalGestionRecordatorio").modal();
     $('#fecha').datetimepicker(_ctrlFecha);
    </script>


