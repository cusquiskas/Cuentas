  <div id="modalGestionRecordatorio" class="modal" role="dialog">
   <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header btn-primary">
	   <h4 class="modal-title">Etiquetado del Movimiento</h4>
	  </div>
	  <form role="form" method="post">
	  <div class="modal-body">
	  <?php 
	   $Eti = new Etiqueta();
	   $Eti->setUsuario($Usuario->getId());
	   $Eti->setActivo('S');
	   $data = $Eti->listaEtiqueta(); 
	   $MovEti = ($Enlace->getEnlace()=='AsignaEtiqueta')?new movimientoEtiqueta():new SplitEtiqueta();
	   $MovEti->setUsuario($Usuario->getId());
	   if ($Enlace->getEnlace()=='AsignaEtiqueta')
	    $MovEti->setMov($Enlace->getExtra());
	   else
	   	$MovEti->setSpl($Enlace->getExtra());
	   foreach ($data as $reg) {
	   	$MovEti->setEti($reg['id']);
	   	$asg = $MovEti->existe();
	   	$css=($asg)?"btn btn-success":"btn btn-default";
	   	$chk=($asg)?'checked':'';
	   	echo '<button type="button" class="'.$css.'" onClick="cambiaEstilo(this)" >
	   		   <label class="checkbox-inline">
	   		    <input class="oculto" name="EtqSel[]" '.$chk.' type="checkbox" value="'.$reg["id"].'">'.$reg["descripcion"].'
	   		   </label>
	   		  </button>';
	   }
	  ?>
	  </div>
	  <div class="modal-footer">
	    <input type="hidden" name="movimiento" value="<?php echo $Enlace->getExtra(); ?>">
	    <button type="submit" name="accion" value="<?php echo (($Enlace->getEnlace()=='AsignaEtiqueta')?'GuardarEtiquetado':'GuardarEtiquetadoSplit'); ?>" class="btn btn-default">Guardar</button>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	  </div>
	 </form> 
	</div>
   </div>
  </div>
  <script> $("#modalGestionRecordatorio").modal(); </script>


