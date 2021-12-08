  <div id="modalGestionRecordatorio" class="modal" role="dialog">
   <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header btn-primary">
	   <h4 class="modal-title">Etiquetado del Movimiento</h4>
	  </div>
	  <form role="form" method="post">
	  <div class="modal-body">
	  <?php 
	  $piso = new Piso();
	  $piso->setUsuario($Usuario->getId());
	  $data = $piso->listado();
	  unset($piso);
	  $MovPiso = ($Enlace->getEnlace()=='AsignaEtiqueta')?new MovimientoPiso():new SplitPiso();
	  $MovPiso->setUsuario($Usuario->getId());
	  if ($Enlace->getEnlace()=='AsignaEtiqueta')
	  	$MovPiso->setMovId($Enlace->getExtra());
  	  else
  		$MovPiso->setSplId($Enlace->getExtra());
  	  $Propi = new Propietario();
  	  $Propi->setUsuario($Usuario->getId());
  	  foreach ($data as $reg) {
  		$MovPiso->setPisoId($reg['id']);
  		$asg = $MovPiso->existe();
  		$css=($asg)?"btn btn-success":"btn btn-default";
  		$chk=($asg)?'checked':'';
  		$Propi->setId($reg["propietario"]);
  		$name = $Propi->listado();
  		echo '<button type="button" class="'.$css.'" onClick="cambiaEstilo(this)" >
   		   <label class="checkbox-inline">
   		    <input class="oculto" name="PisoSel[]" '.$chk.' type="checkbox" value="'.$reg["id"].'">'.$reg["nombre"].' - '.$name[0]['nombre'].'
   		   </label>
   		  </button>';
  	   }
  	   unset($Propi);
  	   unset($MovPiso);
  	   if (count($data)>0) echo "<hr>";
	   
	   $Eti = new Etiqueta();
	   $Eti->setUsuario($Usuario->getId());
	   $Eti->setActivo('S');
	   $data = $Eti->listaEtiqueta(); 
	   unset($Eti);
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
	   unset($MovEti);
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


