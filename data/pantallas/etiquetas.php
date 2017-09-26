 <h1>Etiquetas</h1>
 <div class="row">
    <div class="col-sm-9" style="">
    <form name="frmEtiqueta" method="post">
  <input type="hidden" name="id" value="">
  <input type="hidden" name="irA" value="<?php echo $Enlace->getEnlace(); ?>">
  <div class="row">
    <div class="col-sm-4" style="">
     <div class="form-group"><label for="txt1">Nombre de etiqueta:</label><input type="text" class="form-control" id="txt1" name="descripcion" value="" required></div>
    </div>
    <div class="col-sm-5" style="">
     <div class="form-group"><label>Acciones posibles:</label><br>
     <button class="btn btn-default" type="submit" name="accion" value="GuardarEtiqueta">Guardar</button>
     <button class="btn btn-default" type="button" onClick="form.submit();" name="accion" value="limpiaFormulario">Limpiar</button>
     <button class="btn btn-danger"  type="submit" id="Desactivar" name="accion" value="DesactivaEtiqueta" style="display:none">Desactivar</button>
     <button class="btn btn-success" type="submit" id="Activar" name="accion" value="ActivaEtiqueta" style="display:none">Activar</button>
     </div>
    </div>
  </div> 
 </form>
    </div>
 </div>
 <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
	<label for="sel1">Lista de etiquetas:</label>
	<select class="form-control" size="15" id="sel1" onClick="muestraDatos(this)" onChange="muestraDatos(this)">
	  <?php 
	  	$Eti = new Etiqueta();
	  	$Eti->setUsuario($Usuario->getId());
	  	$data = $Eti->listaEtiqueta();
	  	foreach ($data as $reg) {
	  		echo '<option value="'.$reg["id"].'" activo="'.$reg["activo"].'" texto="'.$reg["descripcion"].'">'.($reg["activo"]==0?"=== ":"").$reg["descripcion"].($reg["activo"]==0?" ===":"").'</option>';
	  	}
	  	 
	  ?>
	</select>
      </div>
    </div>
 </div>
