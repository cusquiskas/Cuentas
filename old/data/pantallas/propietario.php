<h1>Propietarios</h1>
<form name="frmPropietario" method="post">
<input type="hidden" name="id" value="">
<div class="row">
<div class="col-sm-3" style="">
<div class="form-group">
<label for="txt1">Nombre del Propietario:</label>
<input type="text" class="form-control" id="txt1" name="nombre" value="" required>
</div>
</div>

</div>
<div class="row">
<div class="col-sm-1" style="">
<div class="form-group">
&nbsp;
</div>
</div>
<div class="col-sm-3" style="">
<div class="form-group">
<br>
<button class="btn btn-default" type="submit" name="accion" value="GuardarPropietario">Guardar</button>
<button class="btn btn-default" type="button" onClick="form.submit()" >Limpiar</button>
</div>
</div>
</div>
</form>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="sel1">Lista de Propietarios:</label>
<select class="form-control" size="15" id="sel1" onClick="muestraDatos(this)" onChange="muestraDatos(this)">
<?php
$Propi = new Propietario();
$Propi->setUsuario($Usuario->getId());
$data = $Propi->listado();
unset($propi);
foreach ($data as $reg) echo '<option value="'.$reg["id"].'" texto="'.$reg["nombre"].'">'.$reg["nombre"].'</option>';
?>
	</select>
      </div>
    </div>
 </div>
