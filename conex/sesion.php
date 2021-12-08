<?php

    $manejador = ControladorDinamicoTabla::set('usuario');

    class ctrlSesion extends Tabla_usuario
    {
        public function login($token)
        {
            $link = new ConexionSistema();
            $login = $link->consulta("select id 
                                        from usuario
                                    where usr_id+usr_passw = '$token'", []);
        }
    }
