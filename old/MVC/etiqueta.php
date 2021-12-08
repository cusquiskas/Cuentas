<?php
class Etiqueta {
	# valores del modelo #
	private $usuario;
	private $id;
	private $descripcion;
	private $activo;
	
	# functiones del modelo #
	function setUsuario    ($valor) { $this->usuario     = (string)$valor; }
	function setId         ($valor) { $this->id          =    (int)$valor; }
	function setDescripcion($valor) { $this->descripcion = (string)$valor; }
	function setActivo     ($valor) { 
		if     ($valor === "S" || $valor === "s" || $valor === "1" || $valor === 1) $this->activo = 1; 
		elseif ($valor === "N" || $valor === "n" || $valor === "0" || $valor === 0) $this->activo = 0;
		else   $this->activo = null;
	}
	
	function getUsuario    () { return $this->usuario;     }
	function getId         () { return $this->id;          }
	function getDescripcion() { return $this->descripcion; }
	function getActivo     () { return $this->activo;      }
	
	function setEtiqueta ($array) {
		$this->setUsuario    ($array['usuario']    );
		$this->setId         ($array['id']         );
		$this->setDescripcion($array['descripcion']);
		$this->setActivo     ($array['activo']     );
	}
	
	# servicio DAO #
	private function insert () {
		$datos = array(
					0=>array("tipo"=>'s', "dato"=>$this->getUsuario()),
					1=>array("tipo"=>'s', "dato"=>$this->getDescripcion())
				 );
		$query = "INSERT 
				    INTO etiqueta 
				         (USUARIO,DESCRIPCION,ACTIVO) 
				  VALUES (?,      ?,          1)";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	private function update () {
		$datos = array(
					0=>array("tipo"=>'s', "dato"=>$this->getDescripcion()),
					1=>array("tipo"=>'i', "dato"=>$this->getActivo()),
					2=>array("tipo"=>'i', "dato"=>$this->getId()),
					3=>array("tipo"=>'s', "dato"=>$this->getUsuario())
				 );
		$query = "UPDATE etiqueta 
				     SET DESCRIPCION = ?,
				         ACTIVO = ?
				   WHERE ID = ? 
				     and usuario = ?";
		$link = new Conexion();
		$link->ejecuta($query, $datos);
		$link->close();
		return (!$link->hayError());
	}
	private function recupera() {
		$datos = array(
					0=>array("tipo"=>"s", "dato"=>$this->getUsuario()),
					1=>array("tipo"=>"i", "dato"=>$this->getId()),
					2=>array("tipo"=>"i", "dato"=>$this->getActivo())
				 );
		$query = "select *
				    from etiqueta
			       where usuario = ?
				     and id = IFNULL(?, id)
				     and activo = IFNULL(?, activo)
				   order
				      by descripcion";
		$link = new Conexion();
		$data = $link->consulta($query,$datos);
		$link->close();
		return $data;
		
	}
	
public function BuscaId($etiqueta) {
		$filtro = array(
				  0=>array("tipo"=>"s", "dato"=>$etiqueta['usuario']),
				  1=>array("tipo"=>"i", "dato"=>$etiqueta['id'])
		);
		$query = "select * 
				    from movimiento_etiqueta, 
				         etiqueta 
			       where id = eti_id 
				     and movimiento_etiqueta.usuario = etiqueta.usuario 
				     and movimiento_etiqueta.usuario = ?
		             and mov_id = ?";
		$link = new Conexion();
		$reg = $link->consulta($query,$filtro);
		$link->close();
		return $reg;
	}
	
	public function BuscaIdSplit($etiqueta) {
		$filtro = array(
				0=>array("tipo"=>"s", "dato"=>$etiqueta['usuario']),
				1=>array("tipo"=>"i", "dato"=>$etiqueta['id'])
		);
		$query = "select *
				    from split_etiqueta,
				         etiqueta
			       where id = eti_id
				     and split_etiqueta.usuario = etiqueta.usuario
				     and split_etiqueta.usuario = ?
		             and spl_id = ?";
		$link = new Conexion();
		$reg = $link->consulta($query,$filtro);
		$link->close();
		return $reg;
	}
	

	public function listaEtiqueta () {
		return $this->recupera();
	}
	public function cargaId() {
		$data = $this->recupera();
		if (count($data)==1) {
			$this->setActivo($data[0]['activo']);
			$this->setDescripcion($data[0]['descripcion']);
		} elseif (count($data)==0){
			$this->setId(null);
		} else {
			new Excepcion("Se ha encontrado más de un registro",1);
		}
	}
	public function guardaEtiqueta() {
    	if (empty($this->getId())) {
    		if ($this->insert()) new Excepcion("Se ha guardado la etiqueta",0);
    	} else {
    		if ($this->update()) new Excepcion("Se ha actualizado la etiqueta",0);
    	}
    }
}
?>