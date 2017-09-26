<?php
class Visa {
	private	$usuario; 	
	private	$id; 	
	private	$descripcion; 	
	private	$fila; 	
	private	$c_fecha; 	
	private	$c_descripcion; 	
	private	$c_importe; 	
	private	$c_concepto1; 	
	private	$c_concepto2;
	private	$c_concepto3;
	private	$c_concepto4;
	private	$d_corte; 	
	private	$d_recordatorio;
	private	$c_separador_d;
	private	$c_separador_c;
	private	$mascara;
	
	function setUsuario      ($valor) { $this->usuario        = (string)$valor; }
	function setId           ($valor) { $this->id             =    (int)$valor; }
	function setDescripcion  ($valor) { $this->descripcion    = (string)$valor; }
	function setFila         ($valor) { $this->fila           =    (int)$valor; }
	function setCFecha       ($valor) { $this->c_fecha        = (string)$valor; }
	function setCDescripcion ($valor) { $this->c_descripcion  = (string)$valor; }
	function setCImporte     ($valor) { $this->c_importe      = (string)$valor; }
	function setCConcepto1   ($valor) { $this->c_concepto1    = (string)$valor; }
	function setCConcepto2   ($valor) { $this->c_concepto2    = (string)$valor; }
	function setCConcepto3   ($valor) { $this->c_concepto3    = (string)$valor; }
	function setCConcepto4   ($valor) { $this->c_concepto4    = (string)$valor; }
	function setDCorte       ($valor) { $this->d_corte        =    (int)$valor; }
	function setDRecordatorio($valor) { $this->d_recordatorio =    (int)$valor; }
	function setCSeparadorD  ($valor) { $this->c_separador_d =  (string)$valor; }
	function setCSeparadorC  ($valor) { $this->c_separador_c =  (string)$valor; }
	function setMascara      ($valor) { $this->mascara       =  (string)$valor; }
	
	function getUsuario      () { return $this->usuario;        }
	function getId           () { return $this->id;             }
	function getDescripcion  () { return $this->descripcion;    }
	function getFila         () { return $this->fila;           }
	function getCFecha       () { return $this->c_fecha;        }
	function getCDescripcion () { return $this->c_descripcion;  }
	function getCImporte     () { return $this->c_importe;      }
	function getCConcepto1   () { return $this->c_concepto1;    }
	function getCConcepto2   () { return $this->c_concepto2;    }
	function getCConcepto3   () { return $this->c_concepto3;    }
	function getCConcepto4   () { return $this->c_concepto4;    }
	function getDCorte       () { return $this->d_corte;        }
	function getDRecordatorio() { return $this->d_recordatorio; }
	function getCSeparadorD  () { return $this->c_separador_d;  }
	function getCSeparadorC  () { return $this->c_separador_c;  }
	function getMascara      () { return $this->mascara;  }
	
	function setDatos($valor) {
		$this->setUsuario      ($valor['usuario']       );
		$this->setId           ($valor['id']            );
		$this->setDescripcion  ($valor['descripcion']   );
		$this->setFila         ($valor['fila']          );
		$this->setCFecha       ($valor['c_fecha']       );
		$this->setCDescripcion ($valor['c_descripcion'] );
		$this->setCImporte     ($valor['c_importe']     );
		$this->setCConcepto1   ($valor['c_concepto1']   );
		$this->setCConcepto2   ($valor['c_concepto2']   );
		$this->setCConcepto3   ($valor['c_concepto3']   );
		$this->setCConcepto4   ($valor['c_concepto4']   );
		$this->setDCorte       ($valor['d_corte']       );
		$this->setDRecordatorio($valor['d_recordatorio']);
		$this->setCSeparadorD  ($valor['c_separador_d'] );
		$this->setCSeparadorC  ($valor['c_separador_c'] );
		$this->setMascara      ($valor['mascara']       );
	}
	
	private function insert() {
		$datos = array(
					array("tipo"=>"s", "dato"=>$this->getUsuario()),
					array("tipo"=>"s", "dato"=>$this->getDescripcion()),
					array("tipo"=>"i", "dato"=>$this->getFila()),
					array("tipo"=>"s", "dato"=>$this->getCFecha()),
					array("tipo"=>"s", "dato"=>$this->getCDescripcion()),
					array("tipo"=>"s", "dato"=>$this->getCImporte()),
					array("tipo"=>"s", "dato"=>$this->getCConcepto1()),
					array("tipo"=>"s", "dato"=>$this->getCConcepto2()),
					array("tipo"=>"s", "dato"=>$this->getCConcepto3()),
					array("tipo"=>"s", "dato"=>$this->getCConcepto4()),
				    array("tipo"=>"i", "dato"=>$this->getDCorte()),
				    array("tipo"=>"i", "dato"=>$this->getDRecordatorio()),
					array("tipo"=>"s", "dato"=>$this->getCSeparadorD()),
					array("tipo"=>"s", "dato"=>$this->getCSeparadorC()),
					array("tipo"=>"s", "dato"=>$this->getMascara())
		         );
		$query = "insert
				    into visa
				         (usuario, 	
						  descripcion, 	
						  fila, 	
						  c_fecha, 	
						  c_descripcion, 	
						  c_importe, 	
						  c_concepto1, 	
						  c_concepto2, 	
						  c_concepto3, 	
						  c_concepto4, 	
						  d_corte, 	
						  d_recordatorio,
						  c_separador_d,
						  c_separador_c,
						  mascara
				         )
				  values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	
	private function update() {
		$datos = array(
					array("tipo"=>"s", "dato"=>$this->getDescripcion()),
					array("tipo"=>"i", "dato"=>$this->getFila()),
					array("tipo"=>"s", "dato"=>$this->getCFecha()),
					array("tipo"=>"s", "dato"=>$this->getCDescripcion()),
					array("tipo"=>"s", "dato"=>$this->getCImporte()),
					array("tipo"=>"s", "dato"=>$this->getCConcepto1()),
					array("tipo"=>"s", "dato"=>$this->getCConcepto2()),
					array("tipo"=>"s", "dato"=>$this->getCConcepto3()),
					array("tipo"=>"s", "dato"=>$this->getCConcepto4()),
					array("tipo"=>"i", "dato"=>$this->getDCorte()),
				    array("tipo"=>"i", "dato"=>$this->getDRecordatorio()),
					array("tipo"=>"s", "dato"=>$this->getCSeparadorD()),
					array("tipo"=>"s", "dato"=>$this->getCSeparadorC()),
					array("tipo"=>"s", "dato"=>$this->getMascara()),
					array("tipo"=>"s", "dato"=>$this->getUsuario()),
					array("tipo"=>"i", "dato"=>$this->getId())
		);
		$query = "update visa
				     set descripcion = ?,
						 fila = ?,
						 c_fecha = ?,
						 c_descripcion = ?,
						 c_importe = ?,
						 c_concepto1 = ?,
						 c_concepto2 = ?,
						 c_concepto3 = ?,
						 c_concepto4 = ?,
						 d_corte = ?,
						 d_recordatorio = ?,
						 c_separador_d = ?,
						 c_separador_c = ?,
						 mascara = ?
				   where usuario = ?
				     and id = ?";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	
	private function recupera() {
		$datos = array(
				0=>array("tipo"=>"s", "dato"=>$this->getUsuario()),
			    1=>array("tipo"=>"i", "dato"=>$this->getId()),
				2=>array("tipo"=>"i", "dato"=>$this->getFila())
		);
		$query = "select *
				    from visa
				   where usuario = ?
				     and id = IFNULL(?, id)
				     and fila >= IFNULL(?, fila)";
		$link = new Conexion();
		$data = $link->consulta($query, $datos);
		$link->close();
		return $data;
	}
	
	public function guarda() { 
		if ($this->getId() != null) { 
			if ($this->update()) new Excepcion("Se ha actualizado la tarjeta", 0); 
		} else { 
			if ($this->insert()) new Excepcion("Se ha creado la tarjeta", 0);
		}
	}
	
	public function listado()           { return $this->recupera(); }
	public function listadoCarga()      { $this->setFila(1); return $this->listado(); }
	public function diaRecordatorio()   { $data = $this->recupera(); return (int)$data[0]["d_recordatorio"]; }
	public function fechaRecordatorio($fecha) {
		$data = $this->recupera();
		$this->setDatos($data[0]);
		if ($this->getDRecordatorio($fecha) > 0) {
			$fecha = explode("/",$fecha);
			$año = (int)$fecha[2];
			$mes = (int)$fecha[1] + 1;
			$dia = (int)$fecha[0];
			if ($dia>=$this->getDCorte()) $mes++;
			if ($mes>12) {$mes=$mes-12; $año++;}
			$fecha = str_pad($this->getDRecordatorio(), 2, "0", STR_PAD_LEFT)."/".
					str_pad($mes, 2, "0", STR_PAD_LEFT)."/".
					$año;
		} else $fecha = null;
		return $fecha;
	}

} 

?>