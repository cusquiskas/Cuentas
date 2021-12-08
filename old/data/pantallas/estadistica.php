 <h1>Estadística</h1>

	<div class="row" style="background-color:#000000; color:#ffffff;">
	    <div class="col-sm-1"><p>Ene.</p></div>
	    <div class="col-sm-1"><p>Feb.</p></div>
	    <div class="col-sm-1"><p>Mar.</p></div>
	    <div class="col-sm-1"><p>Abr.</p></div>
	    <div class="col-sm-1"><p>May.</p></div>
	    <div class="col-sm-1"><p>Jun.</p></div>
	    <div class="col-sm-1"><p>Jul.</p></div>
	    <div class="col-sm-1"><p>Ago.</p></div>
	    <div class="col-sm-1"><p>Sep.</p></div>
	    <div class="col-sm-1"><p>Oct.</p></div>
	    <div class="col-sm-1"><p>Nov.</p></div>
	    <div class="col-sm-1"><p>Dic.</p></div>
	</div>
<?php 
	$datosEti = $Estadistica->listaEtiquetas();
	
	$datos = array();
	foreach ($datosEti as $datEti) {
		$datos[$datEti["etiqueta"]]["des"] = $datEti["descripcion"];
		$datos[$datEti["etiqueta"]]["val"] = $datEti["etiqueta"];
		$datos[$datEti["etiqueta"]][$datEti["mes"]]=$datEti["importe"];
	}
	$i = 1;
	
	foreach ($datos as $dat) {
		if ($Estadistica->getEtiqueta1() != $dat["val"]
		 && $Estadistica->getEtiqueta2() != $dat["val"]
		 && $Estadistica->getEtiqueta3() != $dat["val"]
		) { 
			$color = (++$i % 2 == 0)?'#dadada':'#ffffff'; 
?>
      <div class="row" style="background-color:<?php echo $color; ?>;">
		<div class="col-sm-2"><button onClick="addEtiqueta(value);" type="button" class="btn btn-primary" value="<?php echo $dat["val"]; ?>"><?php echo $dat["des"]; ?></button></div>
		<div class="col-sm-1" style="color: red;text-align: right;"><p><?php echo number_format(($dat["01"]+$dat["02"]+$dat["03"]+$dat["04"]+$dat["05"]+$dat["06"]+$dat["07"]+$dat["08"]+$dat["09"]+$dat["10"]+$dat["11"]+$dat["12"]),2,',','.'); ?></p></div>
	  </div>
      <div class="row" style="background-color:<?php echo $color; ?>;text-align: right;">
	    <div class="col-sm-1"><p><?php echo (isset($dat["01"])?number_format($dat["01"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["02"])?number_format($dat["02"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["03"])?number_format($dat["03"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["04"])?number_format($dat["04"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["05"])?number_format($dat["05"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["06"])?number_format($dat["06"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["07"])?number_format($dat["07"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["08"])?number_format($dat["08"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["09"])?number_format($dat["09"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["10"])?number_format($dat["10"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["11"])?number_format($dat["11"],2,',','.'):''); ?></p></div>
	    <div class="col-sm-1"><p><?php echo (isset($dat["12"])?number_format($dat["12"],2,',','.'):''); ?></p></div>
	  </div>
<?php 
		} else {
			if ($cabecera == "") {
					     
			$cabecera.= '<div class="row" style="background-color:#f5cccc">
						 	<div class="col-sm-3" style="color: red;text-align: right;"><p>'.number_format(($dat["01"]+$dat["02"]+$dat["03"]+$dat["04"]+$dat["05"]+$dat["06"]+$dat["07"]+$dat["08"]+$dat["09"]+$dat["10"]+$dat["11"]+$dat["12"]),2,',','.').'</p></div>
						 </div>
	    				 <div class="row" style="background-color:#f5cccc;text-align: right;">
						    <div class="col-sm-1"><p>'.(isset($dat["01"])?number_format($dat["01"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["02"])?number_format($dat["02"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["03"])?number_format($dat["03"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["04"])?number_format($dat["04"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["05"])?number_format($dat["05"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["06"])?number_format($dat["06"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["07"])?number_format($dat["07"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["08"])?number_format($dat["08"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["09"])?number_format($dat["09"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["10"])?number_format($dat["10"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["11"])?number_format($dat["11"],2,',','.'):'').'</p></div>
						    <div class="col-sm-1"><p>'.(isset($dat["12"])?number_format($dat["12"],2,',','.'):'').'</p></div>
						 </div>
      					';
		
			}
		}
	}
	echo $cabecera;
?>