<form method="post">
<input type="hidden" name="irA" value="ListadoMovimiento">
<p>
  <div class="input-group date" id="calculaDia">
  <input type='text' class="form-control" name="calculaDia"  value="<?php echo $Buscar->getDia(); ?>" onBlur="this.parentNode.parentNode.submit()">
  <span class="input-group-addon">
   <span class="glyphicon glyphicon-calendar"></span>
  </span>
 </div> 
</p>

<p>Saldo real: <?php echo number_format($Movimiento->saldoReal($Usuario->getId(), $Buscar->getDia()),2,',','.'); ?> €</p>
<p>Saldo Estimado: <?php echo number_format($Movimiento->saldoEstimado($Usuario->getId(), $Buscar->getDia()),2,',','.'); ?> €</p>
<br>
<p>Mes: <select name="muestraMes" onChange="this.parentNode.parentNode.submit()">
         <option value="01" <?php if ($Buscar->getMes() == '01') echo 'selected'; ?>>Enero</option>
         <option value="02" <?php if ($Buscar->getMes() == '02') echo 'selected'; ?>>Febrero</option>
         <option value="03" <?php if ($Buscar->getMes() == '03') echo 'selected'; ?>>Marzo</option>
         <option value="04" <?php if ($Buscar->getMes() == '04') echo 'selected'; ?>>Abril</option>
         <option value="05" <?php if ($Buscar->getMes() == '05') echo 'selected'; ?>>Mayo</option>
         <option value="06" <?php if ($Buscar->getMes() == '06') echo 'selected'; ?>>Junio</option>
         <option value="07" <?php if ($Buscar->getMes() == '07') echo 'selected'; ?>>Julio</option>
         <option value="08" <?php if ($Buscar->getMes() == '08') echo 'selected'; ?>>Agosto</option>
         <option value="09" <?php if ($Buscar->getMes() == '09') echo 'selected'; ?>>Septiembre</option>
         <option value="10" <?php if ($Buscar->getMes() == '10') echo 'selected'; ?>>Octubre</option>
         <option value="11" <?php if ($Buscar->getMes() == '11') echo 'selected'; ?>>Noviembre</option>
         <option value="12" <?php if ($Buscar->getMes() == '12') echo 'selected'; ?>>Diciembre</option>
        </select>
</p>
<p>Año: <select name="muestraAnyo" onChange="this.parentNode.parentNode.submit()">
         <option value="2015" <?php if ($Buscar->getAño() == '2015') echo 'selected'; ?>>2015</option>
         <option value="2016" <?php if ($Buscar->getAño() == '2016') echo 'selected'; ?>>2016</option>
         <option value="2017" <?php if ($Buscar->getAño() == '2017') echo 'selected'; ?>>2017</option>
         <option value="2018" <?php if ($Buscar->getAño() == '2018') echo 'selected'; ?>>2018</option>
         <option value="2019" <?php if ($Buscar->getAño() == '2019') echo 'selected'; ?>>2019</option>
        </select>

</p>
<br><br>
<h4>Acciones:</h4>
<p><button class="btn btn-default" type="button" onClick="navegarA('CreaRecordatorio'  ,0)">Nuevo Recordatorio</button></p>
<p><button class="btn btn-default" type="button" onClick="navegarA('GestionaMovimiento',0)">Inserta Movimiento</button></p>
<p><button class="btn btn-default" type="button" onClick="navegarA('CargaMovimento'    ,0)">Carga Automática  </button></p>
</form>

<script>
// _ctrlFecha.change = function() {alert('hola')};
$(function () {
    $('#calculaDia').datetimepicker(_ctrlFecha);
    $("#calculaDia").on("dp.change", function(e) { this.parentNode.submit(); });
});
</script>