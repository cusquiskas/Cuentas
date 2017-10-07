 <h1>Últimos Registros</h1>
 <div class="table-responsive">
<table class="table">
 <thead>
 <tr>
  <th>&nbsp;</th>
  <th>Tarjeta</th>
  <th>Fecha</th>
  <th>Descripción</th>
  <th>Importe</th>
 </tr>
 </thead>
 <tbody>
 <?php 
 $data = $Movimiento->listaRegistros($Usuario->getId());
 $Visa = new Visa();
 $Visa->setUsuario($Usuario->getId());
 foreach ($data as $reg) {
 	$subcad = "";
 	$Visa->setId($reg["visa"]);
 	$vis = $Visa->listado();
 	echo '<tr id="'.$reg["ID"].'">
 			<td><button type="button" onClick="confirmacion();"><span class="glyphicon glyphicon-trash"></span></button>
            </td>
 			<td>'.$vis[0]['descripcion'].'</td>
			<td>'.$reg["fecha"].'</td>
            <td>'.$reg["descripcion"].'</td>
 			<td align="right"><font color="'.(($reg["importe"]<0)?'red':'black').'">'.number_format($reg["importe"],2,',','.').'€</font></td>
	      </tr>';
 }
 unset($Visa);
 ?>
 </tbody>
</table>
</div>
    
<div style="display: none">
<form name='frmBorraSplit' method='post'><input name='mov_id'><input name='accion' value='BorrarSplit'></form>
</div>
