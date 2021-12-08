<?php
class SplitPiso {
	# valores del modelo #
	private $usuario;
	private $spl_id;
	private $piso_id;
	
	# functiones del modelo #
	function setUsuario($valor) { $this->usuario = (string)$valor; }
	function setSplId  ($valor) { $this->spl_id  =    (int)$valor; }
	function setPisoId ($valor) { $this->piso_id =    (int)$valor; }
	
	function getUsuario() { return $this->usuario; }
	function getSplId  () { return $this->spl_id;  }
	function getPisoId () { return $this->piso_id; }
	
	function setDatos ($datos) {
		$this->setUsuario($datos['usuario']);
		$this->setSplId  ($datos['spl_id'] );
		$this->setPisoId ($datos['piso_id']);
	}
	
	# servicio DAO #
	private function insert() {
		$datos = array(
				array("tipo"=>"s", "dato"=>$this->getUsuario()),
				array("tipo"=>"i", "dato"=>$this->getSplId()  ),
				array("tipo"=>"i", "dato"=>$this->getPisoId() )
		);
		$query = "insert into split_piso (usuario, spl_id, piso_id) values (?, ?, ?)";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	private function delete() {
		$datos = array(
				array("tipo"=>"s", "dato"=>$this->getUsuario()),
				array("tipo"=>"i", "dato"=>$this->getSplId()  )
		);
		$query = "delete from split_piso where usuario = ? and spl_id = ?";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	private function recupera() {
		$datos = array(
				array("tipo"=>"s", "dato"=>$this->getUsuario()),
				array("tipo"=>"i", "dato"=>$this->getSplId()  ),
				array("tipo"=>"i", "dato"=>$this->getPisoId() )
		);
		$query = "select *
				    from split_piso
				   where usuario = ?
				     and spl_id  = IFNULL(?,spl_id)
				     and piso_id = IFNULL(?,piso_id)";
		$link = new Conexion();
		$data = $link->consulta($query, $datos);
		$link->close();
		return $data;
	}
	
	# controlador #
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
	public function listaSplitPiso() {
		return $this->recupera();
	}
	
	
	
}
?>