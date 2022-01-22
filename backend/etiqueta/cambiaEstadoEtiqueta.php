<?php

    session_start();
    error_reporting(E_ALL & ~E_NOTICE);

    header('Content-Type: application/json; charset=utf-8');

    if (!isset($_SESSION['data']) || !isset($_SESSION['data']['user']) || !isset($_SESSION['data']['user']['id']) || $_SESSION['data']['user']['id'] == '') {
        die(json_encode(['success' => false, 'root' => [['tipo' => 'Sesion', 'Detalle' => 'Sesión no válida']]]));
    }

    require_once '../../conex/conf.php';  //información crítica del sistema
    require_once '../../conex/dao.php';   //control de comunicación con la base de datos MySQL
    require_once '../../tabla/controller.php';

    $manEtiqueta = ControladorDinamicoTabla::set('etiqueta');

    $registro = $_POST;
    $registro['usuario'] = $_SESSION['data']['user']['id'];

    if ($manEtiqueta->save($registro) == 0) {
        echo json_encode(['success' => true, 'root' => ['tipo' => 'Respuesta', 'Detalle' => 'Registro modificado correctamente']]);
    } else {
        $reg = $manEtiqueta->getListaErrores();
        echo json_encode(['success' => false, 'root' => ['tipo' => 'Respuesta', 'Detalle' => $reg]]);
    }

    unset($_POST);
    unset($registro);
    unset($reg);
    unset($manEtiqueta);
