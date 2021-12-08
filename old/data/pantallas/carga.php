     <div id="modalGestionRecordatorio" class="modal" role="dialog">
      <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header btn-primary">
	   <h4 class="modal-title">Cargar Movimientos</h4>
	  </div>
	  <form method="post" enctype="multipart/form-data">
	  <div class="modal-body">
           <div class="form-group">
            <label for="visa">Selecciona el punto de Carga:</label>
            <select class="form-control" name="visa" id="visa" required> 
             <option value=""/>
             <?php
               $Visa = new Visa();
			   $Visa->setUsuario($Usuario->getId());
			   $data = $Visa->listadoCarga();
			   foreach ($data as $reg)
             	 echo '<option value="'.$reg['id'].'">'.$reg['descripcion'].'</option>';
     		 ?> 
            </select>
           </div>
	   <div class="form-group">
            <label for="userfile">Archivo a procesar:</label>
	    <input class="form-control" name="userfile" id="userfile" type="file" required>
	   </div>
	  </div>
	  <div class="modal-footer">
	    <input type="hidden" name="irA" value="ListadoMovimiento">
	    <button type="submit" class="btn btn-default" name="accion" value="procesaArchivo">Procesar</button>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	  </div>
	  </form>
	</div>
      </div>
    </div>
    <script> $("#modalGestionRecordatorio").modal(); </script>