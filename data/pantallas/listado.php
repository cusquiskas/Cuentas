<div class="table-responsive">
<table class="table">
 <thead>
 <tr>
  <th>&nbsp;</th>
  <th>Fecha</th>
  <th>Descripción</th>
  <th>Etiquetas</th>
  <th>Importe</th>
 </tr>
 </thead>
 <tbody>
 <?php 
 $data = $Movimiento->listaMovimiento($Usuario->getId(), $Buscar->getMes(), $Buscar->getAño());
 $Eti = new Etiqueta();
 $Visa = new Visa();
 $Visa->setUsuario($Usuario->getId());
 foreach ($data as $reg) {
 	$color = "";
 	$etiqt = "&nbsp;";
 	$subcad = "";
 	switch ($reg["VISA"]) {
 		case -1:  #es un split
 			$color = 'warning'; 
 			$subcad = "<button type='button' onClick='irA(\"AsignaEtiquetaSplit\",".$reg["split"].");'><span class='glyphicon glyphicon-tags'></span></button>";
 		    $subcad.= "<button type='button' onClick='borrarSplit(\"".$reg["ID"]."\");'><span class='glyphicon glyphicon-resize-small'></span></button>";
 			$rug = $Eti->BuscaIdSplit(array("usuario"=>$Usuario->getId(), "id"=>$reg["split"]));
 			for ($b=0;$b<count($rug);$b++) $etiqt.= '<label class="badge">'.$rug[$b]["descripcion"].'</label>';
 			break;
 		case  0:  #es un recordatorio
 			$color = 'info'; 
 			$subcad = "<button type='button' onClick='irA(\"CreaRecordatorio\",".$reg["ID"].");'><span class='glyphicon glyphicon-pencil'></span></button>";
 			break;
 		default:  #resto de movimientos (Visa y Cuenta)
 			$subcad = "<button type='button' onClick='irA(\"AsignaEtiqueta\",".$reg["ID"].");'><span class='glyphicon glyphicon-tags'></span></button>";
 			$subcad.= "<button type='button' onClick='irA(\"Split\",".$reg["ID"].");'><span class='glyphicon glyphicon-resize-full'></span></button>";
 			$subcad.= "<button type='button' onClick='irA(\"CambiaNombre\",".$reg["ID"].");'><span class='glyphicon glyphicon-text-size'></span></button>";
 			$rug = $Eti->BuscaId(array("usuario"=>$Usuario->getId(), "id"=>$reg["ID"]));
 			for ($b=0;$b<count($rug);$b++) $etiqt.= '<label class="badge">'.$rug[$b]["descripcion"].'</label>';
 			$Visa->setId($reg["VISA"]);
 			if ($Visa->diaRecordatorio() > 0) $color = "success"; #es una visa y está en el recordatorio
 	}
 	echo '<tr class="'.$color.'" id="'.$reg["ID"].'">
 			<td>'.$subcad.'</td>
 			<td>'.$reg["FECHA"].'</td>
            <td>'.$reg["DESCRIPCION"].'</td>
 			<td>'.$etiqt.'</td>
 			<td align="right"><font color="'.(($reg["IMPORTE"]<0)?'red':'black').'">'.number_format($reg["IMPORTE"],2,',','.').'€</font></td>
          </tr>';
 }
 unset($Visa);
 unset($Eti);
 ?>
 </tbody>
</table>
</div>
<div style="display: none">
<form name='frmBorraSplit' method='post'><input name='mov_id'><input name='accion' value='BorrarSplit'></form>
</div>

<?php 
if ($Enlace->getEnlace() == "AsignaEtiqueta")     { require('etiquetado.php');   }
if ($Enlace->getEnlace() == "AsignaEtiquetaSplit"){ require('etiquetado.php');   }
if ($Enlace->getEnlace() == "CreaRecordatorio")   { require('recordatorio.php'); }
if ($Enlace->getEnlace() == "CargaMovimento")     { require('carga.php');        }
if ($Enlace->getEnlace() == "GestionaMovimiento") { require('movimiento.php');   }
if ($Enlace->getEnlace() == "CambiaNombre")       { require('renombra.php');     }
if ($Enlace->getEnlace() == "Split")              { require('split.php');        }
?>