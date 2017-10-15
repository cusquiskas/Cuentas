<?php 
    class Piso {
        private $id;
        private $nombre;
        private $usuario;
        private $propietario;
        private $porcentaje;
        
        function setId         ($valor) { $this->id          =    (int)$valor; }
        function setNombre     ($valor) { $this->nombre      = (string)$valor; }
        function setUsuario    ($valor) { $this->usuario     = (string)$valor; }
        function setPropietario($valor) { $this->propietario =    (int)$valor; }
        function setPorcentaje ($valor) { $this->porcentaje  =  (float)$valor; }
        
        function getId         () { return $this->id;          }
        function getNombre     () { return $this->nombre;      }
        function getUsuario    () { return $this->usuario;     }
        function getPropietario() { return $this->propietario; }
        function getPorcentaje () { return $this->porcentaje;  }
        
        function setDatos($objeto) {
            $this->setId         ($objeto['id']         );
            $this->setNombre     ($objeto['nombre']     );
            $this->setUsuario    ($objeto['usuario']    );
            $this->setPropietario($objeto['propietario']);
            $this->setPorcentaje ($objeto['porcentaje'] );
        }
        
        private function insert () {
            $datos = array(
                        array("tipo"=>"s", "dato"=>$this->getNombre()),
                        array("tipo"=>"s", "dato"=>$this->getUsuario()),
                        array("tipo"=>"i", "dato"=>$this->getPropietario())
                        array("tipo"=>"d", "dato"=>$this->getPorcentaje())
                     );
            $query = "insert
				        into piso
				         (nombre, usuario, propietario, porcentaje)
				  values (?,      ?,       ?,           ?)";
            $link = new Conexion();
            $link->ejecuta($query, $datos);
            $link->close();
            return (!$link->hayError());
        }
        
        private function update () {
            $datos = array(
                array("tipo"=>"s", "dato"=>$this->getNombre()),
                array("tipo"=>"s", "dato"=>$this->getPropietario()),
                array("tipo"=>"s", "dato"=>$this->getPorcentaje()),
                array("tipo"=>"i", "dato"=>$this->getId()),
                array("tipo"=>"s", "dato"=>$this->getUsuario())
            );
            $query = "update piso
				         set nombre = ?,
                             propietario = ?,
                             porcentaje = ?
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
                        from piso
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