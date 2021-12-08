<?php

class MovimientoPiso {
	# valores del modelo #
	private $usuario;
	private $mov_id;
	private $piso_id;
	
	# functiones del modelo #
	function setUsuario($valor) { $this->usuario = (string)$valor; }
	function setMovId  ($valor) { $this->mov_id  =    (int)$valor; }
	function setPisoId ($valor) { $this->piso_id =    (int)$valor; }
	
	function getUsuario() { return $this->usuario; }
	function getMovId  () { return $this->mov_id;  }
	function getPisoId () { return $this->piso_id; }
	
	function setDatos ($datos) {
		$this->setUsuario($datos['usuario']);
		$this->setMovId  ($datos['mov_id'] );
		$this->setPisoId ($datos['piso_id']);
	}
	
	# servicio DAO #
	private function insert() {
		$datos = array(
				array("tipo"=>"s", "dato"=>$this->getUsuario()),
				array("tipo"=>"i", "dato"=>$this->getMovId()  ),
				array("tipo"=>"i", "dato"=>$this->getPisoId() )
		);
		$query = "insert into movimiento_piso (usuario, mov_id, piso_id) values (?, ?, ?)";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	private function delete() {
		$datos = array(
				array("tipo"=>"s", "dato"=>$this->getUsuario()),
				array("tipo"=>"i", "dato"=>$this->getMovId()  )
		);
		$query = "delete from movimiento_piso where usuario = ? and mov_id = ?";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	private function recupera() {
		$datos = array(
				array("tipo"=>"s", "dato"=>$this->getUsuario()),
				array("tipo"=>"i", "dato"=>$this->getMovId()  ),
				array("tipo"=>"i", "dato"=>$this->getPisoId() )
		);
		$query = "select *
				    from movimiento_piso
				   where usuario = ?
				     and mov_id  = IFNULL(?,mov_id)
				     and piso_id = IFNULL(?,piso_id)";
		$link = new Conexion();
		$data = $link->consulta($query, $datos);
		$link->close();
		return $data;
	}
	
	# controlador de movimiento_etiqueta #
	public function existe() {
		$datos = $this->recupera();
		return (count($datos)==1);
	}
	public function limpiaMovimiento(){
		return $this->delete();
	}
	public function guardaAsignacion() {
		return $this->insert();
	}
	public function listaMovimientoPiso() {
		return $this->recupera();
	}
	
	
	
}

?>