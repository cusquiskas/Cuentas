<?php 
    class Obligacion {
        private $id;
        private $nombre;
        private $usuario;
        private $id_piso;
        private $importe;
        
        function setId     ($valor) { $this->id      =    (int)$valor; }
        function setNombre ($valor) { $this->nombre  = (string)$valor; }
        function setUsuario($valor) { $this->usuario = (string)$valor; }
        function setIdPiso ($valor) { $this->usuario =    (int)$valor; }
        function setImporte($valor) { $this->usuario =  (float)$valor; }
        
        function getId     () { return $this->id;      }
        function getNombre () { return $this->nombre;  }
        function getUsuario() { return $this->usuario; }
        function getIdPiso () { return $this->id_piso; }
        function getImporte() { return $this->importe; }
        
        function setDatos($objeto) {
            $this->setId     ($objeto['id']     );
            $this->setNombre ($objeto['nombre'] );
            $this->setUsuario($objeto['usuario']);
            $this->setIdPiso ($objeto['id_piso']);
            $this->setImporte($objeto['importe']);
        }
        
        private function insert () {
            $datos = array(
                        array("tipo"=>"s", "dato"=>$this->getNombre()),
                        array("tipo"=>"s", "dato"=>$this->getUsuario()),
                        array("tipo"=>"s", "dato"=>$this->getIdPiso()),
                        array("tipo"=>"s", "dato"=>$this->getImporte())
                     );
            $query = "insert
				        into obligacion
				         (nombre, usuario, id_piso, importe)
				  values (?,      ?,       ?,       ?)";
            $link = new Conexion();
            $link->ejecuta($query, $datos);
            $link->close();
            return (!$link->hayError());
        }
        
        private function update () {
            $datos = array(
                array("tipo"=>"s", "dato"=>$this->getNombre()),
                array("tipo"=>"i", "dato"=>$this->getIdPiso()),
                array("tipo"=>"d", "dato"=>$this->getImporte()),
                array("tipo"=>"i", "dato"=>$this->getId()),
                array("tipo"=>"s", "dato"=>$this->getUsuario())
            );
            $query = "update obligacion
				         set nombre = ?,
                             id_piso = ?,
                             importe = ?
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
                array("tipo"=>"i", "dato"=>$this->getIdPiso()),
                array("tipo"=>"s", "dato"=>$this->getUsuario())
            );
            $query = "select *
                        from obligacion
				       where id = IFNULL(?, id)
                         and id_piso = IFNULL(?, id_piso)
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