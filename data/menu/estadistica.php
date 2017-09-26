
    <form name="frmEstadistica" method="post">
     <input type="hidden" name="irA" value="<?php echo $Enlace->getEnlace(); ?>">
     <input type="hidden" name="etiqueta1" value="<?php echo $Estadistica->getEtiqueta1(); ?>">
     <input type="hidden" name="etiqueta2" value="<?php echo $Estadistica->getEtiqueta2(); ?>">
     <input type="hidden" name="etiqueta3" value="<?php echo $Estadistica->getEtiqueta3(); ?>">
     <input type="hidden" name="exceso" value="">
     <p>
        <label for="consultaAnyo">Año Datos:</label>
        <select name="consultaAnyo" onChange="form.submit()">
         <option value="2015" <?php if ($Estadistica->getAño() == '2015') echo 'selected'; ?>>2015</option>
         <option value="2016" <?php if ($Estadistica->getAño() == '2016') echo 'selected'; ?>>2016</option>
         <option value="2017" <?php if ($Estadistica->getAño() == '2017') echo 'selected'; ?>>2017</option>
         <option value="2018" <?php if ($Estadistica->getAño() == '2018') echo 'selected'; ?>>2018</option>
         <option value="2019" <?php if ($Estadistica->getAño() == '2019') echo 'selected'; ?>>2019</option>
        </select>
      </p>
      <br>
      <p>
       <label for="consultaAnyo">Agrupadores:</label><br>
       <?php 
       		
       		$Eti = new Etiqueta();
	  		$Eti->setUsuario($Usuario->getId());
       		
			if ($Estadistica->getEtiqueta1()!="") {
       			$Eti->setId($Estadistica->getEtiqueta1());
       			$dat = $Eti->listaEtiqueta();
       			echo '<p><button onClick="delEtiqueta(value);" type="button" class="btn btn-warning" value="'.$dat[0]["id"].'">'.$dat[0]["descripcion"].'</button></p>';
       		}
       		if ($Estadistica->getEtiqueta2()!="") {
       			$Eti->setId($Estadistica->getEtiqueta2());
       			$dat = $Eti->listaEtiqueta();
       			echo '<p><button onClick="delEtiqueta(value);" type="button" class="btn btn-warning" value="'.$dat[0]["id"].'">'.$dat[0]["descripcion"].'</button></p>';
       		}
       		if ($Estadistica->getEtiqueta3()!="") {
       			$Eti->setId($Estadistica->getEtiqueta3());
       			$dat = $Eti->listaEtiqueta();
       			echo '<p><button onClick="delEtiqueta(value);" type="button" class="btn btn-warning" value="'.$dat[0]["id"].'">'.$dat[0]["descripcion"].'</button></p>';
       		}
       ?>
      </p> 
   </form>
   