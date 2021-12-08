  <nav class="navbar navbar-inverse">
   <?php require_once('data/header.php'); ?>
  </nav>

  <div class="container-fluid text-center">    
  
    <!-- Modal Sólo cargamos el modal si hay mensajes -->
    <?php if($controlError->hayError() > 0) { ?>
    <div id="modalMuestraErrores" class="modal fade" role="dialog">
      <div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
	  <div class="modal-header">
	   <button type="button" class="close" data-dismiss="modal">&times;</button>
	   <h4 class="modal-title">Mensajes de la Aplicación</h4>
	  </div>
	  <div class="modal-body">
           <?php
	   while ($controlError->hayError() > 0){
	    $error = $controlError->getError();
	    echo '<div class="alert alert-'.$error->getTipo().'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '.$error->getMessage().'.</div>';
	   }
	  ?>
	  </div>
	  <div class="modal-footer">
	    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  </div>
	</div>
	<!-- Modal content-->
      </div>
    </div>
    <?php } ?>
    <!-- Modal -->
  
   <div class="row content">
    <?php require_once('data/body.php'); ?>
   </div>
  </div>
  
  <footer class="container-fluid text-center">
   <p>Footer Text</p>
  </footer> 
