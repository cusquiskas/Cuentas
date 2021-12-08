<?php $reg = $Movimiento->datosMovimiento($Usuario->getId(), $Enlace->getExtra()); ?>
  <div id="modalGestionSplit" class="modal" role="dialog">
   <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header btn-primary">
	   <h4 class="modal-title">Split del Movimiento</h4>
	  </div>
	  <form role="form" name="frmSplitMovimiento" method="post">
	  <div class="modal-body" id="cuerpo_formulario">
	    <div class="row">
	      <div class="col-sm-1">
	       <label>&nbsp;</label>
	      </div>
	      <div class="col-sm-8">
	       <div class="form-group">
	      <label for="descripcion">Descripción:</label>
	      <input type="text" class="form-control" name="descripcion[]" required value="<?php echo $reg["descripcion"];?>">
	    </div>
	      </div>
	      <div class="col-sm-3">
	       <div class="form-group">
		<label for="importe">Importe:</label>
		<input class="form-control dissabled" name="importe[]" type="number" step="0.01" readonly value="<?php echo $reg["importe"];?>">
	       </div>
	      </div>
	   </div>
	   <div class="row">
	      <div class="col-sm-1">
	       <div class="form-group">
	       <label>&nbsp;</label>
	       <button onClick="clonar()" type="button" class="glyphicon glyphicon-plus"></button>
	       </div>
	      </div>
	      <div class="col-sm-8">
	       <div class="form-group">
	      <label for="descripcion">Descripción:</label>
	      <input type="text" class="form-control" name="descripcion[]" value="">
	    </div>
	      </div>
	      <div class="col-sm-3">
	       <div class="form-group">
		<label for="importe">Importe:</label>
		<input class="form-control" name="importe[]" type="number" step="0.01" onChange="recalculaForm()">
	       </div>
	      </div>
	   </div> 
	  </div>
	  <div class="modal-footer">
	    <input type="hidden" name="irA" value="ListadoMovimiento">
	    <input type="hidden" name="mov_id" value="<?php echo $Enlace->getExtra();?>">
	    <input type="hidden" name="fecha" value="<?php echo $reg["fecha"];?>">
	    <button type="submit" name="accion" value="GuardarSplit" class="btn btn-default">Guardar</button>
	    <button type="submit" name="accion" value="BorrarSplit"  class="btn btn-default">Borrar</button>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	  </div>
	 </form> 
	</div>
   </div>
  </div>
  <script> 
  	$("#modalGestionSplit").modal();
  	initImporte(<?php echo $reg["importe"];?>); 
  </script>
