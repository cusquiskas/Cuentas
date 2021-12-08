   <form id="navegador" method="post"><input type="hidden" name="irA"><input type="hidden" name="extra"><input type="hidden" name="scroll"></form>
   <div class="container-fluid">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src="img/fijas/imagen.gif" style="height:30px;"></a>
     </div>
    
    <div class="collapse navbar-collapse" id="myNavbar">
       <ul class="nav navbar-nav">
        <li class="<?php if ($Enlace->getMenu()=='Movimiento') echo 'active'; ?>"><a href="#" onClick="getForm('navegador').irA.value='ListadoMovimiento';getForm('navegador').submit();">Movimientos</a></li>
        <!--<li class="<?php if ($Enlace->getMenu()=='Carga') echo 'active'; ?>"><a href="#" onClick="getForm('navegador').irA.value='GestionaMovimiento';getForm('navegador').submit();">Cargas</a></li>-->
        <li class="<?php if ($Enlace->getMenu()=='Maestro') echo 'active'; ?>"><a href="#" onClick="getForm('navegador').irA.value='GestionaEtiqueta';getForm('navegador').submit();">Maestros</a></li>
        <li class="<?php if ($Enlace->getMenu()=='Estadistica') echo 'active'; ?>"><a href="#" onClick="getForm('navegador').irA.value='VerEstadistica';getForm('navegador').submit();">Estadísticas</a></li>
       </ul>
       <ul class="nav navbar-nav navbar-right">
        <li><form method="post"><button type="submit" name="accion" value="logout"><span class="glyphicon glyphicon-log-in"></span> LogOut</button></form></li>
       </ul>
    </div>
   </div>
