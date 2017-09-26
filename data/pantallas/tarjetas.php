 <h1>Tarjetas</h1>
 <form name="frmTarjeta" method="post">
 	<input type="hidden" name="id" value="">
 	<div class="row">
    	<div class="col-sm-3" style="">
    		<div class="form-group">
      			<label for="txt1">Nombre de la Tarjeta:</label>
      			<input type="text" class="form-control" id="txt1" name="descripcion" value="" required>
      		</div>
    	</div>
    	<div class="col-sm-2" style="">
	    	<div class="form-group">
      			<label for="txt3">Día de corte:</label>
      			<input type="number" class="form-control" id="txt3" min="0" name="d_corte" required>
      		</div>
    	</div>
    	<div class="col-sm-2" style="">
    		<div class="form-group">
      			<label for="txt4">Día recordatorio:</label>
      			<input type="number" class="form-control" id="txt4" min="0" name="d_recordatorio" value="" required>
      		</div>
    	</div>
    	
  	</div>
  	<div class="row">
    	<div class="col-sm-2" style="">
    		<div class="form-group">
      			<label for="txt2">Primera Fila (CSV):</label>
      			<input type="number" class="form-control" id="txt2" min="0" name="fila" required>
      		</div>
    	</div>
    	<div class="col-sm-2" style="">
    		<div class="form-group">
      			<label for="txt5">Col. Fecha:</label>
      			<input type="text" class="form-control" id="txt5" name="c_fecha" maxlength="1" style="text-transform:uppercase" >
      		</div>
    	</div>
    	<div class="col-sm-2" style="">
    		<div class="form-group">
      			<label for="txt6">Col. Descripción:</label>
      			<input type="text" class="form-control" id="txt6" name="c_descripcion" maxlength="1" style="text-transform:uppercase" >
      		</div>
    	</div>
    	<div class="col-sm-2" style="">
	    	<div class="form-group">
      			<label for="txt7">Col. Importe:</label>
      			<input type="text" class="form-control" id="txt7" name="c_importe" maxlength="1" style="text-transform:uppercase" >
      		</div>
    	</div>
    </div>
  	<div class="row">
    	<div class="col-sm-2" style="">
	    	<div class="form-group">
      			<label for="txt8">Col. Concepto (1):</label>
      			<input type="text" class="form-control" id="txt8" name="c_concepto1" maxlength="1" style="text-transform:uppercase">
      		</div>
    	</div>
    	<div class="col-sm-2" style="">
	    	<div class="form-group">
      			<label for="txt9">Col. Concepto (2):</label>
      			<input type="text" class="form-control" id="txt9" name="c_concepto2" maxlength="1" style="text-transform:uppercase">
      		</div>
    	</div>
    	<div class="col-sm-2" style="">
	    	<div class="form-group">
      			<label for="txt9">Col. Concepto (3):</label>
      			<input type="text" class="form-control" id="txt9" name="c_concepto3" maxlength="1" style="text-transform:uppercase">
      		</div>
    	</div>
    	<div class="col-sm-2" style="">
	    	<div class="form-group">
      			<label for="txt9">Col. Concepto (4):</label>
      			<input type="text" class="form-control" id="txt9" name="c_concepto4" maxlength="1" style="text-transform:uppercase">
      		</div>
    	</div>
    </div>
    <div class="row">
    	<div class="col-sm-2" style="">
	    	<div class="form-group">
      			<label for="txt9">Sep. Decimal:</label>
      			<input type="text" class="form-control" id="txt9" name="c_separador_d" maxlength="1" style="text-transform:uppercase">
      		</div>
    	</div>
    	<div class="col-sm-2" style="">
	    	<div class="form-group">
      			<label for="txt9">Sep. Columnas:</label>
      			<input type="text" class="form-control" id="txt9" name="c_separador_c" maxlength="1" style="text-transform:uppercase">
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
      			<button class="btn btn-default" type="submit" name="accion" value="GuardarVisa">Guardar</button>
			    <button class="btn btn-default" type="button" onClick="form.submit()" >Limpiar</button>
      		</div>
    	</div>
  	</div>
</form>
 <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
	<label for="sel1">Lista de tarjetas:</label>
	<select class="form-control" size="15" id="sel1" onClick="muestraDatos(this)" onChange="muestraDatos(this)">
	  <?php 
    	$Visa = new Visa();
    	$Visa->setUsuario($Usuario->getId());
    	$data = $Visa->listado();
    	foreach ($data as $reg) echo '<option value="'.$reg["id"].'" texto="'.$reg["descripcion"].'" fila="'.$reg["fila"].'" c_fecha="'.$reg["c_fecha"].'" c_descripcion="'.$reg["c_descripcion"].'" c_importe="'.$reg["c_importe"].'" c_concepto1="'.$reg["c_concepto1"].'" c_concepto2="'.$reg["c_concepto2"].'" c_concepto3="'.$reg["c_concepto3"].'" c_concepto4="'.$reg["c_concepto4"].'" d_corte="'.$reg["d_corte"].'" d_recordatorio="'.$reg["d_recordatorio"].'" c_separador_d="'.$reg["c_separador_d"].'" c_separador_c="'.$reg["c_separador_c"].'">'.$reg["descripcion"].'</option>'; 
	  ?>
	</select>
      </div>
    </div>
 </div>

 
