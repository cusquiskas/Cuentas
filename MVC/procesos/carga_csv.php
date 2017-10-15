<?php
 require_once 'Classes/PHPExcel/IOFactory.php';
 
 
 $fileType = PHPExcel_IOFactory::identify($fileName);
 $objReader = PHPExcel_IOFactory::createReader($fileType);
 $objPHPExcel = $objReader->load($fileName);
 $XLSheet = $objPHPExcel->getSheet();
 
 $Visa = new Visa();
 $Visa->setUsuario($Usuario->getId());
 $Visa->setId($_POST["visa"]);
 $dat = $Visa->listado();
 $dat = $dat[0];
 
 $sheetRow = (int)$dat["fila"];
 while ($XLSheet->getCell(strtoupper($dat["c_fecha"].$sheetRow))->getValue() != "") {
 	$importe = $XLSheet->getCell(strtoupper($dat["c_importe"].$sheetRow))->getValue();
 	if ($dat["c_separador_d"]===',') $importe = preg_replace("/,/is",".",$importe);
 	#$importe = explode(' ',$importe);
 	#for ($i=0;$i<count($importe);$i++) { if (is_float($importe[$i]+0)) { $importe = $importe[$i]; $i = 99; } }
 	$regCSV = array ("fecha"=>      $XLSheet->getCell(strtoupper($dat["c_fecha"].$sheetRow))->getValue(),
		 			 "descripcion"=>$XLSheet->getCell(strtoupper($dat["c_descripcion"].$sheetRow))->getValue(),
		 			 "importe"=>    $importe,
		 			 "visa"=>       $dat["id"],
 	                 "concepto1"=>  ($dat["c_concepto1"]=="")?"":$XLSheet->getCell(strtoupper($dat["c_concepto1"].$sheetRow))->getValue(),
		 			 "concepto2"=>  ($dat["c_concepto2"]=="")?"":$XLSheet->getCell(strtoupper($dat["c_concepto2"].$sheetRow))->getValue(),
		 			 "concepto3"=>  ($dat["c_concepto3"]=="")?"":$XLSheet->getCell(strtoupper($dat["c_concepto3"].$sheetRow))->getValue(),
		 			 "concepto4"=>  ($dat["c_concepto4"]=="")?"":$XLSheet->getCell(strtoupper($dat["c_concepto4"].$sheetRow))->getValue(),
		 			 "concepto5"=>  "null", "concepto6"=>"null",
		 			 "usuario"=>$Usuario->getId(), "usuario_id"=>$Usuario->getId(), "sistema"=>"S",
		 			 "recordatorio"=>"",
 	);
 	if (@gettype((int)$regCSV['fecha']) == 'integer') $dat["mascara"]="numero";
 	if ($dat["mascara"]=="numero") {
 	    $cadenaFecha = date("d/m/Y", ((int)$regCSV['fecha']-25569)*24*60*60);
 	    $regCSV['fecha'] = $cadenaFecha;
 	} else {
 	    if ($dat["mascara"]!="dd/mm/yyyy") {
 	        $cadenaFecha = substr($regCSV['fecha'],strpos($dat["mascara"],'dd'),2).'/';
 	        $cadenaFecha.= substr($regCSV['fecha'],strpos($dat["mascara"],'mm'),2).'/';
 	        $cadenaFecha.= substr($regCSV['fecha'],strpos($dat["mascara"],'yy'),4).'/';
 	        $regCSV['fecha'] = $cadenaFecha;
 	    }
 	}
 	if ($Movimiento->guardar($regCSV)) {
 		$newFecha = $Visa->fechaRecordatorio($regCSV['fecha']);
 		if ($newFecha != null) {
 			$regCSV["recordatorio"] = $newFecha;
 			$regCSV["fecha"] = $newFecha;
 			$regCSV['descripcion'] = 'Pendiente tarjeta '.$dat['descripcion'];
 			$Recordatorio->guardar($regCSV);
 		}
 	}
 	$sheetRow++;
 }
 
 $XLSheet->__destruct();
 $objPHPExcel->__destruct();
 unset($XLSheet);
 unset($objPHPExcel);
 
?>


