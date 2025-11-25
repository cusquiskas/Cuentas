
    <form name="frmEstadistica" method="post">
     <input type="hidden" name="irA" value="<?php echo $Enlace->getEnlace(); ?>">
     <input type="hidden" name="etiqueta1" value="<?php echo $Estadistica->getEtiqueta1(); ?>">
     <input type="hidden" name="etiqueta2" value="<?php echo $Estadistica->getEtiqueta2(); ?>">
     <input type="hidden" name="etiqueta3" value="<?php echo $Estadistica->getEtiqueta3(); ?>">
     <input type="hidden" name="exceso" value="">
     <p>
        <label for="consultaAnyo">Año Datos:</label>
        <select name="consultaAnyo" onChange="form.submit()">
         <option value="2025" <?php if ($Estadistica->getAño() == '2025') echo 'selected'; ?>>2025</option>
         <option value="2026" <?php if ($Estadistica->getAño() == '2026') echo 'selected'; ?>>2026</option>
         <option value="2027" <?php if ($Estadistica->getAño() == '2027') echo 'selected'; ?>>2027</option>
         <option value="2028" <?php if ($Estadistica->getAño() == '2028') echo 'selected'; ?>>2028</option>
         <option value="2029" <?php if ($Estadistica->getAño() == '2029') echo 'selected'; ?>>2029</option>
         <option value="2030" <?php if ($Estadistica->getAño() == '2030') echo 'selected'; ?>>2030</option>
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
   