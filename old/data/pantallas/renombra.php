<?php $reg = $Movimiento->datosMovimiento($Usuario->getId(), $Enlace->getExtra()); ?>
<div id="modalGestionRecordatorio" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header btn-primary">
				<h4 class="modal-title">Nombres Alternativos</h4>
			</div>
			<form role="form" method="post" name="frmRenombra">
 				<input type="hidden" name="irA" value="ListadoMovimiento">
 				<input type="hidden" name="scroll" value="<?php echo $Enlace->getScroll(); ?>">
				<div class="modal-body">
 					<div class="form-group">
	      				<label for="concepto6">Descripción:</label>
	      				<input type="text" class="form-control" name="concepto6" id="concepto6" required value="<?php echo $reg["concepto6"]; ?>">
	    			</div>
	    			<div class="form-group">
						<label for="sel1">Lista de descripciones del banco:</label>
						<select class="form-control" size="6" id="sel1" onClick="muestraDatos(this)" onChange="muestraDatos(this)">
	 						<option><?php echo $reg["descripcion"]; ?></option>
	 						<option><?php echo $reg["concepto1"]; ?></option>
	 						<option><?php echo $reg["concepto2"]; ?></option>
	 						<option><?php echo $reg["concepto3"]; ?></option>
	 						<option><?php echo $reg["concepto4"]; ?></option>
	 						<option><?php echo $reg["concepto5"]; ?></option>
						</select>
	  				</div>
	  			</div>
	  			<div class="modal-footer">
	    			<input type="hidden" name="movimiento" value="<?php echo $Enlace->getExtra(); ?>">
	    			<button type="submit" name="accion" value="GuardarDescripcion" class="btn btn-default">Guardar</button>
	    			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	  			</div>
	 		</form> 
		</div>
	</div>
 </div>
 <script> $("#modalGestionRecordatorio").modal(); </script>

