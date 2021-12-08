<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE);

    session_regenerate_id(true);

    if (isset($_SESSION['data'])) {
        unset($_SESSION['data']);
    }

    header('Content-Type: application/json; charset=utf-8');

    echo json_encode(['success' => true, 'root' => [['tipo' => 'Sesion', 'Detalle' => 'Sesión cerrada correctamente']]]);
?>


 

