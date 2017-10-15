<?php 
    class Propietario {
        private $id;
        private $nombre;
        private $usuario;
        
        function setId     ($valor) { $this->id      =    (int)$valor; }
        function setNombre ($valor) { $this->nombre  = (string)$valor; }
        function setUsuario($valor) { $this->usuario = (string)$valor; }
        
        function getId     () { return $this->id;      }
        function getNombre () { return $this->nombre;  }
        function getUsuario() { return $this->usuario; }
        
        function setDatos($objeto) {
            $this->setId     ($objeto['id']     );
            $this->setNombre ($objeto['nombre'] );
            $this->setUsuario($objeto['usuario']);
        }
        
        private function insert () {
            $datos = array(
                        array("tipo"=>"s", "dato"=>$this->getNombre()),
                        array("tipo"=>"s", "dato"=>$this->getUsuario())
                     );
            $query = "insert
				        into propietario
				         (nombre, usuario)
				  values (?,      ?)";
            $link = new Conexion();
            $link->ejecuta($query, $datos);
            $link->close();
            return (!$link->hayError());
        }
        
        private function update () {
            $datos = array(
                array("tipo"=>"s", "dato"=>$this->getNombre()),
                array("tipo"=>"i", "dato"=>$this->getId()),
                array("tipo"=>"s", "dato"=>$this->getUsuario())
            );
            $query = "update propietario
				         set nombre = ?
                       where id = ?
				         and usuario = ?";
            $link = new Conexion();
            $link->ejecuta($query, $datos);
            $link->close();
            return (!$link->hayError());
        }
        
        private function recupera () {
            $datos = array(
                array("tipo"=>"i", "dato"=>$this->getId()),
                array("tipo"=>"s", "dato"=>$this->getUsuario())
            );
            $query = "select *
                        from propietario
				       where id = IFNULL(?, id)
				         and usuario = ?";
            $link = new Conexion();
            $data = $link->consulta($query, $datos);
            $link->close();
            return $data;
        }
        
        public function guarda() {
            if ($this->getId() != null) {
                if ($this->update()) new Excepcion("Se ha actualizado el propietario", 0);
            } else {
                if ($this->insert()) new Excepcion("Se ha creado el propietario", 0);
            }
        }
        
        public function listado() { return $this->recupera(); }
        
    }
?>