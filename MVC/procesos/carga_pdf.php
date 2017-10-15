<?php 
$fpPDF = fopen($fileName, "rb"); // leo el pdf
$tamanio = filesize($fileName); // calculo el tamanio
$contenido = fread($fpPDF, $tamanio); // leo el contendio
$contenido = addslashes($contenido); // formateo
echo var_export($contenido,true);
fclose($fpPDF); // cierro el pdf 
?>