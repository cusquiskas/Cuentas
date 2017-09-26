<?php

class MovimientoEtiqueta {
	# valores del modelo #
	private $usuario;
	private $mov_id;
	private $eti_id;
	
	# functiones del modelo #
	function setUsuario($valor) { $this->usuario = (string)$valor; }
	function setMov ($valor) { $this->mov_id = (int)$valor; }
	function setEti ($valor) { $this->eti_id = (int)$valor; }
	
	function getUsuario() { return $this->usuario; }
	function getMov () { return $this->mov_id; }
	function getEti () { return $this->eti_id; }

	function setMovEti ($MovEti) {
		$this->setUsuario($MovEti['usuario']);
		$this->setMov($MovEti['mov_id']);
		$this->setEti($MovEti['eti_id']);
	}
	
	# servicio DAO #
	private function insert() {
		$datos = array(
					0=> array("tipo"=>"s", "dato"=>$this->getUsuario()),
					1=> array("tipo"=>"i", "dato"=>$this->getMov()),
					2=> array("tipo"=>"i", "dato"=>$this->getEti())
				 );
		$query = "insert into movimiento_etiqueta (usuario, mov_id, eti_id) values (?, ?, ?)";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	private function delete() {
		$datos = array(
				0=> array("tipo"=>"s", "dato"=>$this->getUsuario()),
				1=> array("tipo"=>"i", "dato"=>$this->getMov())
		);
		$query = "delete from movimiento_etiqueta where usuario = ? and mov_id = ?";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	private function recupera() {
		$datos = array(
					0=> array("tipo"=>"s", "dato"=>$this->getUsuario()),
					1=> array("tipo"=>"i", "dato"=>$this->getMov()),
					2=> array("tipo"=>"i", "dato"=>$this->getEti())
				 );
		$query = "select *
				    from movimiento_etiqueta
				   where usuario = ?
				     and mov_id = IFNULL(?,mov_id)
				     and eti_id = IFNULL(?,eti_id)";
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
	public function listaMovimientoEtiqueta() {
		return $this->recupera();
	}
	
	
	
}

?>