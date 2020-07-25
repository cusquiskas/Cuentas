<?php

/* módulo de inicio */
require_once 'MVC/servicio/excepcion.php';
require_once 'MVC/modelo/iniciador.php';

require_once 'MVC/usuario.php';
require_once 'MVC/enlace.php';
require_once 'MVC/busqueda.php';
require_once 'MVC/recordatorio.php';
require_once 'MVC/etiqueta.php';
//require_once 'MVC/tarjeta.php';
require_once 'MVC/visa.php';
require_once 'MVC/movimiento.php';
require_once 'MVC/movimiento_etiqueta.php';
require_once 'MVC/movimiento_piso.php';
require_once 'MVC/split.php';
require_once 'MVC/split_etiqueta.php';
require_once 'MVC/split_piso.php';
require_once 'MVC/propietario.php';
require_once 'MVC/piso.php';

/* restos de la antigua estructura */
require_once 'MVC/servicio/estructura.php';

 if (isset($_POST['irA'])) {
     $Enlace->setEnlace($_POST['irA'], $_POST['scroll'], $_POST['extra']);
 }

 if (isset($_POST['muestraMes'])) {
     $Buscar->setMes($_POST['muestraMes']);
     $Buscar->setAño($_POST['muestraAnyo']);
     $Buscar->setDia($_POST['calculaDia']);
 }

 if (isset($_POST['consultaAnyo'])) {
     if ($_POST['exceso'] === 'S') {
         new Excepcion('Límite de 3 agrupadores alcanzado', 1);
     }
     $Estadistica->setAño($_POST['consultaAnyo']);
     $Estadistica->setEtiqueta1($_POST['etiqueta1']);
     $Estadistica->setEtiqueta2($_POST['etiqueta2']);
     $Estadistica->setEtiqueta3($_POST['etiqueta3']);
 }

 if (isset($_POST['accion'])) {
     switch ($_POST['accion']) {
   case 'logout':
    $Usuario->setUsuario();
    unset($_SESSION['data']);
    break;

   case 'identificacion':
    $Usuario->valida(['clave' => $_POST['password']]);
    break;
   case 'EliminaRegistro':
    $Movimiento->delete(array('usuario' => $Usuario->getId(), 'id' => (int) $_POST['id']));
    $Enlace->setEnlace('EliminaMovimiento');
    break;

   case 'GuardarRecordatorio':
    $Recordatorio->guardar(array('id' => $_POST['id'],
                                 'descripcion' => $_POST['descripcion'],
                                 'fecha' => $_POST['fecha'],
                                 'importe' => $_POST['importe'],
                                 'sistema' => (empty($_POST['sistema']) ? 'N' : $_POST['sistema']),
                                 'usuario_id' => $Usuario->getId(),
                                 'visa' => 0,
                          ));
    break;

   case 'BorrarRecordatorio':
    if (isset($_POST['id']) && $_POST['id'] != '') {
        $Recordatorio->borrar(array('usuario_id' => $Usuario->getId(), 'id' => $_POST['id']));
    }
    break;
   case 'GuardarEtiquetado':
    $MovEti = new MovimientoEtiqueta();
    $MovEti->setUsuario($Usuario->getId());
    $MovEti->setMov($_POST['movimiento']);
    if ($MovEti->limpiaMovimiento()) {
        if (isset($_POST['EtqSel'])) {
            foreach ($_POST['EtqSel'] as $etq) {
                $MovEti->setEti($etq);
                $MovEti->guardaAsignacion();
            }
        }
        $Enlace->setEnlace('ListadoMovimiento', $Enlace->getScroll());
    } else {
        new Excepcion('No se ha podido realizar la operación (Etiqueta)', 1);
    }
    unset($MovEti);
    $MovPiso = new MovimientoPiso();
    $MovPiso->setUsuario($Usuario->getId());
    $MovPiso->setMovId($_POST['movimiento']);
    if ($MovPiso->limpiaMovimiento()) {
        if (isset($_POST['PisoSel'])) {
            foreach ($_POST['PisoSel'] as $piso) {
                $MovPiso->setPisoId($piso);
                $MovPiso->guardaAsignacion();
            }
        }
        $Enlace->setEnlace('ListadoMovimiento', $Enlace->getScroll());
    } else {
        new Excepcion('No se ha podido realizar la operación (Propiedad)', 1);
    }
    unset($MovPiso);

    break;
   case 'GuardarEtiquetadoSplit':
    $SplEti = new SplitEtiqueta();
    $SplEti->setUsuario($Usuario->getId());
    $SplEti->setSpl($_POST['movimiento']);
    if ($SplEti->limpiaSplit()) {
        if (isset($_POST['EtqSel'])) {
            foreach ($_POST['EtqSel'] as $etq) {
                $SplEti->setEti($etq);
                $SplEti->guardaAsignacion();
            }
        }
        $Enlace->setEnlace('ListadoMovimiento', $Enlace->getScroll());
    } else {
        new Excepcion('No se ha podido realizar la operación (Etiqueta)', 1);
    }
    unset($SplEti);
    $SplPiso = new SplitPiso();
    $SplPiso->setUsuario($Usuario->getId());
    $SplPiso->setSplId($_POST['movimiento']);
    if ($SplPiso->limpiaSplit()) {
        if (isset($_POST['PisoSel'])) {
            foreach ($_POST['PisoSel'] as $piso) {
                $SplPiso->setPisoId($piso);
                $SplPiso->guardaAsignacion();
            }
        }
        $Enlace->setEnlace('ListadoMovimiento', $Enlace->getScroll());
    } else {
        new Excepcion('No se ha podido realizar la operación (Propiedad)', 1);
    }
    unset($SplPiso);
    break;
   case 'GuardarEtiqueta':
    $Eti = new Etiqueta();
    $Eti->setUsuario($Usuario->getId());
    $Eti->setId($_POST['id']);
    $Eti->cargaId();
    $Eti->setDescripcion($_POST['descripcion']);
    $Eti->guardaEtiqueta();
    unset($Eti);
    break;
   case 'GuardarPropietario':
    $Propi = new Propietario();
    $Propi->setDatos($_POST);
    $Propi->setUsuario($Usuario->getId());
    $Propi->guarda();
    unset($Propi);
    break;
   case 'GuardarPiso':
    $Piso = new Piso();
    $Piso->setDatos($_POST);
    $Piso->setUsuario($Usuario->getId());
    $Piso->guarda();
    unset($Piso);
    break;
   case 'DesactivaEtiqueta':
    $Eti = new Etiqueta();
    $Eti->setUsuario($Usuario->getId());
    $Eti->setId($_POST['id']);
    $Eti->cargaId();
    $Eti->setActivo('N');
    $Eti->guardaEtiqueta();
    unset($Eti);
    break;
   case 'ActivaEtiqueta':
    $Eti = new Etiqueta();
    $Eti->setUsuario($Usuario->getId());
    $Eti->setId($_POST['id']);
    $Eti->cargaId();
    $Eti->setActivo('S');
    $Eti->guardaEtiqueta();
    unset($Eti);
    break;
   case 'GuardarVisa':
    $Visa = new Visa();
    $Visa->setDatos($_POST);
    $Visa->setUsuario($Usuario->getId());
    $Visa->guarda();
    unset($Visa);
    break;
   case 'GuardarMovimiento':
    $regCSV = array('fecha' => $_POST['fecha'],
                     'descripcion' => $_POST['descripcion'],
                     'importe' => $_POST['importe'],
                     'visa' => $_POST['visa'],
                     'concepto1' => 'null', 'concepto2' => 'null', 'concepto3' => 'null',
                     'concepto4' => 'null', 'concepto5' => 'null', 'concepto6' => 'null',
                     'sistema' => 'S', 'recordatorio' => '',
                     'usuario' => $Usuario->getId(),
                     'usuario_id' => $Usuario->getId(),
                    );
    if ($Movimiento->guardar($regCSV)) {
        $Visa = new Visa();
        $Visa->setUsuario($Usuario->getId());
        $Visa->setId($regCSV['visa']);
        $newFecha = $Visa->fechaRecordatorio($regCSV['fecha']);
        if ($newFecha != null) {
            $regCSV['recordatorio'] = $newFecha;
            $regCSV['fecha'] = $newFecha;
            $regCSV['descripcion'] = 'Pendiente tarjeta '.$Visa->getDescripcion();
            $Recordatorio->guardar($regCSV);
        }
    }
    unset($Visa);
    break;
   case 'GuardarDescripcion':
    $regCSV = $Movimiento->datosMovimiento($Usuario->getId(), $_POST['movimiento']);
    $regCSV['concepto6'] = $_POST['concepto6'];
    $Movimiento->guardar($regCSV);
    break;
   case 'procesaArchivo':
    if ($_FILES['userfile']['name'] == '') {
        new Excepcion('No se ha seleccionado ningún archivo', 1);
    }
    if ($controlError->hayError() == 0) {
        if ($_FILES['userfile']['size'] == 0) {
            new Excepcion('El tamaño del archivo es 0 (cero)', 1);
        }
    }
    if ($controlError->hayError() == 0) {
        //if (strtolower(substr($_FILES['userfile']['name'],-4)) != '.csv') new Excepcion('La extensión del archivo no es CSV', 1);
        $fileExtension = strtolower(substr($_FILES['userfile']['name'], strrpos($_FILES['userfile']['name'], '.')));
        $fileName = $modeloConfiguracion->getHome().session_id().$fileExtension;
        if ($fileExtension != '.xls' && $fileExtension != '.xlsx' && $fileExtension != '.pdf') {
            new Excepcion('No tiene extensión válida [Excel, PDF]', 1);
        }
    }
    if ($controlError->hayError() == 0) {
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $fileName)) {
            echo "<li>fileExtension: $fileExtension</li>";
            if ($fileExtension != '.pdf') {
                require_once 'MVC/procesos/carga_csv.php';
            } else {
                require_once 'MVC/procesos/carga_pdf.php';
            }

            unlink($fileName);
            $Enlace->setEnlace('ListadoMovimiento');
        } else {
            new Excepcion('No se ha podido mover el archivo a la carpeta de proceso', 1);
        }
    }
    break;
   case 'GuardarSplit':
    $MovEti = new MovimientoEtiqueta();
    $MovEti->setUsuario($Usuario->getId());
    $MovEti->setMov($_POST['mov_id']);
    $MovEti->limpiaMovimiento();
    unset($MovEti);
    $Spliter = new Split();
    $Spliter->setUsuario($Usuario->getId());
    $Spliter->setMovId($_POST['mov_id']);
    $Spliter->borrar();
    $Spliter->setFecha($_POST['fecha']);
    for ($i = 0; $i < count($_POST['importe']); ++$i) {
        $Spliter->setId('');
        $Spliter->setDescripcion($_POST['descripcion'][$i]);
        $Spliter->setImporte($_POST['importe'][$i]);
        $Spliter->guardar();
    }
    unset($Spliter);
    break;
   case 'BorrarSplit':
    $Spliter = new Split();
    $Spliter->setUsuario($Usuario->getId());
    $Spliter->setMovId($_POST['mov_id']);
    $Spliter->borrar();
    unset($Spliter);
    break;
  }
 }
