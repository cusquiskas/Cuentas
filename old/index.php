<?php
 error_reporting(E_ALL ^ E_NOTICE);
 session_start();
 require_once('MVC/home.php');
?>
<!DOCTYPE HTML>
<html lang="es">
 <head>
  <!--<link href="img/fijas/logo.png" rel="shortcut icon" type="image/png">-->
  <link href='img/fijas/Thrawn.ico' rel='shortcut icon' type='image/x-icon'>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <!-- BOOTSTROP 3 -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="css/datetimepicker.css" rel="stylesheet" type="text/css">
  <link href="css/style.css" rel="stylesheet" type="text/css">

  <script src="js/datetimepicker.js" type="text/javascript"></script>
  <script src="js/bootbox.min.js" type="text/javascript"></script>
  <!-- http://bootboxjs.com/examples.html -->
  <script src="js/funciones.js" type="text/javascript"></script>
  <script><?php echo "var PHPSESSION='".session_id()."';"; ?></script>
  <?php 
   if ($Enlace->getEnlace()=='NuevoRegistro')       echo '<script src="js/registro.js" type="text/javascript"></script>';
   if ($Enlace->getEnlace()=='EliminaMovimiento')   echo '<script src="js/registro.js" type="text/javascript"></script>';
   if ($Enlace->getEnlace()=='GestionaEtiqueta')    echo '<script src="js/etiquetas.js" type="text/javascript"></script>';
   if ($Enlace->getEnlace()=='GestionaTarjetas')    echo '<script src="js/tarjeta.js" type="text/javascript"></script>';
   if ($Enlace->getEnlace()=='GestionaPropietario') echo '<script src="js/propietario.js" type="text/javascript"></script>';
   if ($Enlace->getEnlace()=='GestionaPiso')        echo '<script src="js/piso.js" type="text/javascript"></script>';
   if ($Enlace->getEnlace()=='AsignaEtiqueta')      echo '<script src="js/etiquetado.js" type="text/javascript"></script>';
   if ($Enlace->getEnlace()=='AsignaEtiquetaSplit') echo '<script src="js/etiquetado.js" type="text/javascript"></script>';
   if ($Enlace->getEnlace()=='CambiaNombre')        echo '<script src="js/renombra.js" type="text/javascript"></script>';
   if ($Enlace->getEnlace()=='VerEstadistica')      echo '<script src="js/estadistica.js" type="text/javascript"></script>';
   if ($Enlace->getEnlace()=='Split')               echo '<script src="js/split.js" type="text/javascript"></script>';
   if ($Usuario->getId() == "")                     echo '<script src="js/login.js" type="text/javascript"></script>';
  ?>
 </head>
 <body onLoad='<?php if ($controlError->hayError() > 0) echo '$("#modalMuestraErrores").modal();'; ?>'>
 <?php if ($Usuario->getId() == "") require ('login.php'); else require ('home.php'); ?>
 <script>
  <?php if ($Enlace->getScroll() > 0) { ?> if (typeof (document.body.scrollTop) == 'undefined') document.documentElement.scrollTop = <?php echo $Enlace->getScroll(); ?>; else document.body.scrollTop = <?php echo $Enlace->getScroll(); } ?>;
 </script>
 </body>
</html>
