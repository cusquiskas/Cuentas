    <div class="container" style="width:300px">

    <?php if($controlError->hayError() > 0) { 
	   while ($controlError->hayError() > 0){
	    $error = $controlError->getError();
	    echo '<div class="alert alert-'.$error->getTipo().'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '.$error->getMessage().'.</div>';
	   }
      echo "<br>";
     }
     
     ?>
<h3>wellcome webhook github</h3>
      <form name="fake" method="post" class="form-signin">
        <h2 class="form-signin-heading">Identifícate</h2>
        <label for="inputEmail" class="sr-only">Correo Electrónico</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Correo Electrónico" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" onkeypress="if (event.keyCode==13) submita();" required>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="button" onClick="submita();">Entrar</button>
      </form>
      
      <form name="valida" method="post" style="display:none">
        <input type="password" name="password" required>
        <input type="hidden" name="accion" value="identificacion">
      </form>
      

    </div>