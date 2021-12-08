<?php
    session_start();
    error_reporting(E_ALL & ~E_NOTICE);

    if (!isset($_SESSION['data'])) {
        $_SESSION['data'] = [];
    }
    if (!isset($_SESSION['data']['user'])) {
        $_SESSION['data']['user'] = [];
    }

    require_once '../../conex/conf.php';  //información crítica del sistema
    require_once '../../conex/dao.php';   //control de comunicación con la base de datos MySQL
    require_once '../../tabla/controller.php';

    header('Content-Type: application/json; charset=utf-8');

    $filtro = [
            0 => ['tipo' => 's', 'dato' => session_id()],
            1 => ['tipo' => 's', 'dato' => $_POST['password']],
    ];
    $query = 'select count(0) num, id
                        from usuario
                    where MD5(CONCAT(id,CONCAT(?,clave))) = ?';
    $link = new ConexionSistema();
    $reg = $link->consulta($query, $filtro);
    $link->close();

    $manUsuario = ControladorDinamicoTabla::set('usuario');

    if ($reg[0]['num'] == 1) {
        $manUsuario->give(['id' => $reg[0]['id']]);
        $reg = $manUsuario->getArray();
        $_SESSION['data']['user']['id'] = $reg[0]['id'];
        $_SESSION['data']['user']['nombre'] = $reg[0]['nombre'];

        echo json_encode(['success' => true, 'root' => ['tipo' => 'Sesion', 'Detalle' => $_SESSION['data']['user']]]);
    } else {
        echo json_encode(['success' => false, 'root' => [['tipo' => 'Sesion', 'Detalle' => 'Usuario o contraseña no válido']]]);
    }

    unset($manUsuario);
    unset($link);
    unset($reg);
?>

    