<h1>Pisos</h1>
<form name="frmPiso" method="post">
<input type="hidden" name="id" value="">
<div class="row">
<div class="col-sm-3" style="">
<div class="form-group">
<label for="txt1">Nombre del Piso:</label>
<input type="text" class="form-control" id="txt1" name="nombre" value="" required>
</div>
</div>
<div class="col-sm-3" style="">
<div class="form-group">
<label for="sel1">Lista de Propietarios:</label>
<select class="form-control" id="sel1" name="propietario" required>
	<option value="">.. Propietario ..</option>
<?php
$Propi = new Propietario();
$Propi->setUsuario($Usuario->getId());
$data = $Propi->listado();
foreach ($data as $reg) echo '<option value="'.$reg["id"].'">'.$reg["nombre"].'</option>';
?>
</select>

</div>
</div>
<div class="col-sm-3" style="">
<div class="form-group">
<label for="txt3">Porcentaje:</label>
<input type="number" step="0.01" class="form-control" id="txt3" name="porcentaje" value="" required>
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
<button class="btn btn-default" type="submit" name="accion" value="GuardarPiso">Guardar</button>
<button class="btn btn-default" type="button" onClick="form.submit()" >Limpiar</button>
</div>
</div>
</div>
</form>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<label for="sel1">Lista de Pisos:</label>
<select class="form-control" size="15" id="sel1" onClick="muestraDatos(this)" onChange="muestraDatos(this)">
<?php
$Piso = new Piso();
$Piso->setUsuario($Usuario->getId());
$data = $Piso->listado();
unset($piso);
foreach ($data as $reg) {
	$Propi->setId($reg["propietario"]);
	$name = $Propi->listado();
	echo '<option value="'.$reg["id"].'" texto="'.$reg["nombre"].'" propietario="'.$reg["propietario"].'"  porcentaje="'.$reg["porcentaje"].'">'.$reg["nombre"].' - '.$name[0]["nombre"].'</option>';
}
unset($propi);
?>
	</select>
      </div>
    </div>
 </div>