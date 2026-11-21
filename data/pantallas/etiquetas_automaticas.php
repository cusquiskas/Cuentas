<h1>Etiquetas Automáticas</h1>
<form name="frmEtiquetaAutomatica" method="post">
 <input type="hidden" name="irA" value="GestionaEtiquetasAutomaticas">
 <input type="hidden" name="id" value="">
 <div class="row">
  <div class="col-sm-4">
   <div class="form-group">
    <label for="nombreAutomatico">Nombre:</label>
    <input type="text" class="form-control" id="nombreAutomatico" name="nombre" required>
   </div>
  </div>
  <div class="col-sm-4">
   <div class="form-group">
    <label for="etiquetaAutomatica">Etiqueta:</label>
    <select class="form-control" id="etiquetaAutomatica" name="idetiqueta" required>
     <option value="">Seleccione una etiqueta</option>
     <?php
      $Eti = new Etiqueta();
      $Eti->setUsuario($Usuario->getId());
      $Eti->setActivo(1);
      foreach ($Eti->listaEtiqueta() as $reg) {
       echo '<option value="'.$reg["id"].'">'.htmlspecialchars($reg["descripcion"], ENT_QUOTES, 'UTF-8').'</option>';
      }
     ?>
    </select>
   </div>
  </div>
 </div>
 <div class="row">
  <div class="col-sm-8">
   <div class="form-group">
    <label for="patronAutomatico">Patrones:</label>
    <textarea class="form-control" id="patronAutomatico" name="patron" rows="4"
     placeholder="mercadona, carrefour, eroski" required></textarea>
    <small class="help-block">Separe varios patrones con comas, punto y coma o líneas nuevas.</small>
   </div>
   <button type="submit" name="accion" value="GuardarEtiquetaAutomatica" class="btn btn-success">Guardar</button>
   <button type="button" class="btn btn-default" onclick="limpiaEtiquetaAutomatica()">Limpiar</button>
  </div>
 </div>
</form>

<div class="row">
 <div class="col-sm-12">
  <label>Reglas actuales:</label>
  <table class="table table-striped">
   <thead><tr><th>Nombre</th><th>Patrones</th><th>Etiqueta</th><th></th></tr></thead>
   <tbody>
    <?php
     $Auto = new EtiquetaAutomatica();
     $Auto->setUsuario($Usuario->getId());
     foreach ($Auto->lista() as $reg) {
      $Eti = new Etiqueta();
      $Eti->setUsuario($Usuario->getId());
      $Eti->setId((int)$reg["IDETIQUETA"]);
      $Eti->setActivo(null);
      $Eti->cargaId();
      echo '<tr>';
      echo '<td>'.htmlspecialchars($reg["NOMBRE"], ENT_QUOTES, 'UTF-8').'</td>';
      echo '<td>'.htmlspecialchars($reg["PATRON"], ENT_QUOTES, 'UTF-8').'</td>';
      echo '<td>'.htmlspecialchars((string)$Eti->getDescripcion(), ENT_QUOTES, 'UTF-8').'</td>';
      echo '<td>'
         .'<button type="button" class="btn btn-primary btn-xs"'
         .' data-edita-automatico'
         .' data-id="'.$reg["ID"].'"'
         .' data-nombre="'.htmlspecialchars((string)$reg["NOMBRE"], ENT_QUOTES, 'UTF-8').'"'
         .' data-patron="'.htmlspecialchars((string)$reg["PATRON"], ENT_QUOTES, 'UTF-8').'"'
         .' data-etiqueta="'.$reg["IDETIQUETA"].'">Editar</button> '
         .'<form method="post" style="margin:0;display:inline">'
         .'<input type="hidden" name="irA" value="GestionaEtiquetasAutomaticas">'
         .'<input type="hidden" name="id" value="'.$reg["ID"].'">'
         .'<button type="submit" name="accion" value="EliminarEtiquetaAutomatica" class="btn btn-danger btn-xs">Eliminar</button>'
         .'</form></td>';
      echo '</tr>';
     }
    ?>
   </tbody>
  </table>
 </div>
</div>
