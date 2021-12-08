<?php
class SplitEtiqueta {
	# valores del modelo #
	private $usuario;
	private $spl_id;
	private $eti_id;

	# functiones del modelo #
	function setUsuario($valor) { $this->usuario = (string)$valor; }
	function setSpl ($valor) { $this->spl_id = (int)$valor; }
	function setEti ($valor) { $this->eti_id = (int)$valor; }

	function getUsuario() { return $this->usuario; }
	function getSpl () { return $this->spl_id; }
	function getEti () { return $this->eti_id; }

	function setSplEti ($SplEti) {
		$this->setUsuario($SplEti['usuario']);
		$this->setSpl($SplEti['spl_id']);
		$this->setEti($SplEti['eti_id']);
	}

	# servicio DAO #
	private function insert() {
		$datos = array(
				0=> array("tipo"=>"s", "dato"=>$this->getUsuario()),
				1=> array("tipo"=>"i", "dato"=>$this->getSpl()),
				2=> array("tipo"=>"i", "dato"=>$this->getEti())
		);
		$query = "insert into split_etiqueta (usuario, spl_id, eti_id) values (?, ?, ?)";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	private function delete() {
		$datos = array(
				0=> array("tipo"=>"s", "dato"=>$this->getUsuario()),
				1=> array("tipo"=>"i", "dato"=>$this->getSpl())
		);
		$query = "delete from split_etiqueta where usuario = ? and spl_id = ?";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	private function recupera() {
		$datos = array(
				0=> array("tipo"=>"s", "dato"=>$this->getUsuario()),
				1=> array("tipo"=>"i", "dato"=>$this->getSpl()),
				2=> array("tipo"=>"i", "dato"=>$this->getEti())
		);
		$query = "select *
				    from split_etiqueta
				   where usuario = ?
				     and spl_id = IFNULL(?,spl_id)
				     and eti_id = IFNULL(?,eti_id)";
		$link = new Conexion();
		$data = $link->consulta($query, $datos);
		$link->close();
		return $data;
	}

	# controlador de split_etiqueta #
	public function existe() {
		$datos = $this->recupera();
		return (count($datos)==1);
	}
	public function limpiaSplit(){
		return $this->delete();
	}
	public function guardaAsignacion() {
		return $this->insert();
	}
	public function listaSplitEtiqueta() {
		return $this->recupera();
	}



}
?>