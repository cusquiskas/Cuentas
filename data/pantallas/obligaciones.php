<?php #$reg = $Movimiento->datosMovimiento($Usuario->getId(), $Enlace->getExtra()); ?>
   <div id="modalCargarObligacion" class="modal" role="dialog">
    <div class="modal-dialog">
	 <div class="modal-content">
	  <div class="modal-header btn-primary">
	   <h4 class="modal-title">Asignación de Obligaciones</h4>
	  </div>
	  <form role="form" name="frmObligacion" method="post">
	   <div class="modal-body" id="cuerpo_formulario">
	    <div class="row">
	      <div class="col-sm-1">
	       <label>&nbsp;</label>
	      </div>
	      <div class="col-sm-6">
	       <div class="form-group">
	        <label for="descripcion">Concepto:</label>
	        <input type="text" class="form-control" name="descripcion" required value="">
	       </div>
	      </div>
	      <div class="col-sm-4">
	       <label for="FechaVencimiento">Vencimiento:</label>
	       <div class="input-group date" id="FechaVencimiento">
            <input type='text' class="form-control" name="FechaVencimiento" required value="">
            <span class="input-group-addon">
             <span class="glyphicon glyphicon-calendar"></span>
            </span>
           </div> 
	      </div>
	      <div class="col-sm-1">
	       <label>&nbsp;</label>
	      </div> 
	     </div>
	     <div class="row">
	      <div class="col-sm-2">
	       <label>&nbsp;</label>
	      </div>
	      <div class="col-sm-6">
	       <div class="form-group">
	        <label for="descripcion">Piso - Propietario</label>
	       </div>
	      </div>
	      <div class="col-sm-4">
	       <div class="form-group">
		    <label for="importe">Importe</label>
		   </div>
	      </div>
	     </div>
<?php 
    $Piso = new Piso();
    $Piso->setUsuario($Usuario->getId());
    $data = $Piso->listado();
    unset($Piso);
    $Owner = new Propietario();
    $Owner->setUsuario($Usuario->getId());
    foreach ($data as $reg) {
        $Owner->setId($reg['propietario']);
        $rog = $Owner->listado();
        echo '<div class="row">
    	       <div class="col-sm-1">
                <label>&nbsp;</label>
	           </div>
               <div class="col-sm-1">
    	        <div class="form-group">
    	         <span style="cursor:pointer" class="glyphicon glyphicon-ok" piso="'.$reg['id'].'" onClick="cambiaEstilo(this)" >
   		          <label class="checkbox-inline">
   		           <input class="oculto" name="PisoSel[]" checked type="checkbox" id="ck_'.$reg['propietario'].'" value="'.$reg["id"].'">
   		          </label>
   		         </span>
    	        </div>
    	       </div>
    	       <div class="col-sm-6">
    	        <div class="form-group">
    	         <span for="descripcion">'.$reg['nombre'].' - '.$rog[0]['nombre'].'</span>
    	        </div>
    	       </div>
    	       <div class="col-sm-3">
    	        <div class="form-group">
    		     <input class="form-control" name="importe[]" id="im_'.$reg['id'].'" type="number" step="0.01">
    		    </div>
    	       </div>
               <div class="col-sm-1">
                <label>&nbsp;</label>
	           </div>
    	      </div>';
    }
    unset($Owner);
?>	      
	    </div>
	    <div class="modal-footer">
	     <input type="hidden" name="irA" value="ListadoMovimiento">
	     <button type="submit" name="accion" value="GuardarObligacion" class="btn btn-default">Guardar</button>
	     <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	    </div>
	   </form> 
	  </div>
     </div>
    </div>
  <script> 
  	$("#modalCargarObligacion").modal();
  	$('#FechaVencimiento').datetimepicker(_ctrlFecha);
  </script>
