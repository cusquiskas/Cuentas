<?php
 class modeloUsuario {
 	private $id;
 	private $nombre;
 	
 	public function getUsuario(){ return array('id'=>$this->id, 'nombre'=>$this->nombre); }
 	public function getId()     { return $this->id; }
 	public function getNombre() { return $this->nombre; }
 	
 	
 	public function setUsuario($obj=array('id'=>"",'nombre'=>"")) {
 		if (isset($obj['id']))     $this->id     = $obj['id'];
 		if (isset($obj['nombre'])) $this->nombre = $obj['nombre'];
 		$_SESSION['data']['user'] = $this->getUsuario();
 	}
 	
 	function __construct() {
 		if (isset($_SESSION['data']['user']['id'])) 
 		  $this->setUsuario($_SESSION['data']['user']);
 	}
 }

 class servicioUsuario extends modeloUsuario {
 	public function valida($usuario) {
 		$filtro = array(
 				0=>array("tipo"=>"s", "dato"=>session_id()),
 				1=>array("tipo"=>"s", "dato"=>$usuario['clave'])
 		);
 		$query = "select count(0) num, id
   		                 from usuario
   		                where MD5(CONCAT(id,CONCAT(?,clave))) = ?";
 		$link = new Conexion();
 		$reg = $link->consulta($query,$filtro);
 		$link->close();
 		if ($reg[0]['num']==1) {
 			$this->setUsuario($this->recupera($reg[0]['id']));
 		} else {
 			new Excepcion('Usuario o contraseña no válido', 1);
 		}
 	}
 
 	public function guarda($usuario) {
 		$link = new Conexion();
 		$link->save("insert
   		          into usuario
   		              (id,
   		               nombre,
   		               clave
   		              )
                values('".$usuario['id']."',
   		               '".$usuario['nombre']."',
   		               '".$usuario['clave']."'
   		              )"
 				);
 		$link->close();
 	}
 	public function recupera($id="") {
 		$filtro = array(
 				0=>array("tipo"=>"s", "dato"=>$id),
 		);
 		$query = "select id,
   		             nombre
   		        from usuario
   		       where id = ?";
 		$link = new Conexion();
 		$reg = $link->consulta($query,$filtro);
 		$link->close();
 		if (count($reg) == 1) {
 			return $reg[0];
 		} else {
 			return null;
 		}
 	}
 
 }
 $Usuario = new servicioUsuario();
 
?>