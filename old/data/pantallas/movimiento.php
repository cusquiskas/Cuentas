
     <div id="modalGestionRecordatorio" class="modal" role="dialog">
      <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header btn-primary">
	   <h4 class="modal-title">Insertar Movimiento</h4>
	  </div>
	  <form role="form" method="post">
	  <div class="modal-body">
	    <div class="row">
	      <div class="col-sm-4">
	       <div class="form-group">
		<label for="visa">Selecciona Tarjeta:</label>
		<select class="form-control" name="visa" id="visa" required> 
		<option value=""/>
		<?php 
		 $Visa = new Visa();
		 $Visa->setUsuario($Usuario->getId());
		 $data = $Visa->listado();
		 foreach ($data as $reg)
		  echo '<option value="'.$reg['id'].'">'.$reg['descripcion'].'</option>';
		?> 
		</select>
	       </div>
	      </div>
	      <div class="col-sm-4">
	       <label for="fecha">Fecha:</label>
	       <div class="input-group date" id="fecha" >
			<input class="form-control" name="fecha" type="text" required>
			<span class="input-group-addon">
   				<span class="glyphicon glyphicon-calendar"></span>
  			</span>
	       </div>
	      </div>
	      <div class="col-sm-4">
	       <div class="form-group">
		<label for="importe">Importe:</label>
		<input class="form-control" name="importe" id="importe" type="number" step="0.01" required>
	       </div>
	      </div>
	    </div>
	    <div class="row">
	      <div class="col-sm-12">
	       <div class="form-group">
		<label for="descripcion">Descripción:</label>
		<input class="form-control" name="descripcion" id="descripcion" type="text" required>
	       </div>
	      </div>
	    </div>
	  </div>
	  <div class="modal-footer">
	    <input type="hidden" name="irA" value="ListadoMovimiento">
	    <button type="submit" name="accion" value="GuardarMovimiento" class="btn btn-default">Guardar</button>
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