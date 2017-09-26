<?php
	class Split {
		private $usuario;
		private $id;
		private $mov_id;
		private $fecha;
		private $descripcion;
		private $importe;
		
		public function getUsuario()     { return $this->usuario;     }
		public function getId()          { return $this->id;          }
		public function getMovId()       { return $this->mov_id;      }
		public function getFecha()       { return $this->fecha;       }
		public function getDescripcion() { return $this->descripcion; }
		public function getImporte()     { return $this->importe;     }
		public function get() {
			return array(
						"usuario"	 => $this->getUsuario(),
						"id"		 => $this->getId(),
						"mov_id"	 => $this->getMovId(),
						"fecha"		 => $this->getFecha(),
						"descripcion"=> $this->getDescripcion(),
						"importe"	 => $this->getImporte()
					);
		}
		
		public function setUsuario($valor)     { $this->usuario     = (string)$valor; }
		public function setId($valor)          { $this->id          =    (int)$valor; }
		public function setMovId($valor)       { $this->mov_id      =    (int)$valor; }
		public function setFecha($valor)       { $this->fecha       = (string)$valor; }
		public function setDescripcion($valor) { $this->descripcion = (string)$valor; }
		public function setImporte($valor)     { $this->importe     =  (float)$valor; }
		public function set($array) {
			if (isset($array["usuario"])) 	  $this->setUsuario    ($array["usuario"]);
			if (isset($array["id"])) 		  $this->setId         ($array["id"]);
			if (isset($array["mov_id"])) 	  $this->setMovId      ($array["mov_id"]);
			if (isset($array["fecha"])) 	  $this->setFecha      ($array["fecha"]);
			if (isset($array["descripcion"])) $this->setDescripcion($array["descripcion"]);
			if (isset($array["importe"]))     $this->setImporte    ($array["importe"]);
		}
		
		private function insert() {
			$datos = array(
						0=>array("tipo"=>'s', "dato"=>$this->getUsuario()),
						1=>array("tipo"=>'i', "dato"=>$this->getMovId()),
						2=>array("tipo"=>'s', "dato"=>$this->getFecha()),
						3=>array("tipo"=>'s', "dato"=>$this->getDescripcion()),
						4=>array("tipo"=>'d', "dato"=>$this->getImporte())
				 	);
			$query = "INSERT 
					    INTO split 
					         (USUARIO,MOV_ID,FECHA,
				    	      DESCRIPCION,IMPORTE) 
				  	VALUES (?,      ?,     STR_TO_DATE(?, '%d/%m/%Y'),    
				    	      ?,          ?)";
			$link = new Conexion();
			$link->ejecuta($query, $datos);
			$link->close();
			return (!$link->hayError());
		}
		private function update () {
			$datos = array(
						0=>array("tipo"=>'i', "dato"=>$this->getMovId()),
						1=>array("tipo"=>'s', "dato"=>$this->getFecha()),
						2=>array("tipo"=>'s', "dato"=>$this->getDescripcion()),
						3=>array("tipo"=>'d', "dato"=>$this->getImporte()),
						5=>array("tipo"=>'i', "dato"=>$this->getId()),
						4=>array("tipo"=>'s', "dato"=>$this->getUsuario())
						
				 	);
			$query = "UPDATE split 
					     SET MOV_ID = ?,
					         FECHA = STR_TO_DATE(?, '%d/%m/%Y'),
					         DESCRIPCION = ?,
							 IMPORTE = ?
					   WHERE ID = ? 
					     AND USUARIO = ?";
			$link = new Conexion();
			$link->ejecuta($query, $datos);
			$link->close();
			return (!$link->hayError());
		}
		private function delete() {
			$datos = array(
					0=>array("tipo"=>'i', "dato"=>$this->getId()),
					1=>array("tipo"=>'i', "dato"=>$this->getMovId()),
					2=>array("tipo"=>'s', "dato"=>$this->getUsuario())
					
			);
			$query = "DELETE 
					    FROM split
					   WHERE ID = IFNULL(?, ID)
					     AND MOV_ID = IFNULL(?, MOV_ID)
					     AND USUARIO = ?";
			$link = new Conexion();
			$link->ejecuta($query, $datos);
			$link->close();
			return (!$link->hayError());
		}
		private function recupera() {
			$datos = array(
						0=>array("tipo"=>"s", "dato"=>$this->getUsuario()),
						1=>array("tipo"=>"i", "dato"=>$this->getId()),
						2=>array("tipo"=>"i", "dato"=>$this->getMovId())
					 );
			$query = "select *
					    from split
				       where usuario = ?
					     and id = IFNULL(?, id)
					     and mov_id = IFNULL(?, mov_id)
					   order
					      by id";
			$link = new Conexion();
			$data = $link->consulta($query,$datos);
			$link->close();
			return $data;
		}
		
		public function guardar() {
			if ($this->getId() == "") {
				if ($this->insert()) new Excepcion("Se ha guardado el split",0);
			} else {
				if ($this->update()) new Excepcion("Se ha actualizado el split",0);
			}
		}
		public function borrar() {
			$SplEti  = new SplitEtiqueta();
			$SplEti->setUsuario($this->getUsuario());
			$data = $this->listaSplit();
			for ($i=0; $i<count($data);$i++) {
				$SplEti->setSpl($data[$i]["id"]);
				$SplEti->limpiaSplit();
			}
			unset($SplEti);
			$this->delete();
		}
		public function listaSplit() {
			return $this->recupera();
		}
	}
?>