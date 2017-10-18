<?php
class modeloBusqueda {
	private $año;
	private $mes;
	private $dia;
	
	function setAño($año) { $_SESSION['data']['buscar']['movimiento']['año'] = $año; $this->año = $año; }
	function setMes($mes) { $_SESSION['data']['buscar']['movimiento']['mes'] = $mes; $this->mes = $mes; }
	function setDia($dia) { $_SESSION['data']['buscar']['movimiento']['dia'] = $dia; $this->dia = $dia; }
	
    function getAño() { return $this->año; }
	function getMes() { return $this->mes; }
	function getDia() { return $this->dia; }
	
	function __construct() {
		if (isset($_SESSION['data']['buscar']['movimiento']['dia'])) {
			$this->año = $_SESSION['data']['buscar']['movimiento']['año'];
		    $this->mes = $_SESSION['data']['buscar']['movimiento']['mes'];
		    $this->dia = $_SESSION['data']['buscar']['movimiento']['dia'];
		} else {
			$this->setAño(date("Y", time()));
			$this->setMes(date("m", time()));
			$this->setDia("28/".date("m/Y", time()));
		}
	}
} $Buscar = new modeloBusqueda();

class modeloEstadistica {
	private $año;
	private $etiqueta1;
	private $etiqueta2;
	private $etiqueta3;
	
	function setAño($año) { $_SESSION['data']['estadistica']['año'] = $año; $this->año = $año; }
	function setEtiqueta1 ($etq) { if ($etq=="")$etq=NULL; $_SESSION['data']['estadistica']['etiqueta1'] = $año; $this->etiqueta1 = $etq; }
	function setEtiqueta2 ($etq) { if ($etq=="")$etq=NULL; $_SESSION['data']['estadistica']['etiqueta2'] = $año; $this->etiqueta2 = $etq; }
	function setEtiqueta3 ($etq) { if ($etq=="")$etq=NULL; $_SESSION['data']['estadistica']['etiqueta3'] = $año; $this->etiqueta3 = $etq; }


	function getAño() { return $this->año; }
	function getEtiqueta1() { return $this->etiqueta1; }
	function getEtiqueta2() { return $this->etiqueta2; }
	function getEtiqueta3() { return $this->etiqueta3; }
	
	function listaEtiquetas() {
		$datos = array(
					array("tipo"=>"s", "dato"=>$_SESSION['data']['user']['id']),
					array("tipo"=>"s", "dato"=>$this->getAño()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta1()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta2()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta3()),
					array("tipo"=>"s", "dato"=>$_SESSION['data']['user']['id']),
					array("tipo"=>"s", "dato"=>$this->getAño()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta1()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta2()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta3()),
					array("tipo"=>"s", "dato"=>$_SESSION['data']['user']['id']),
					array("tipo"=>"s", "dato"=>$this->getAño()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta1()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta2()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta3()),
					array("tipo"=>"s", "dato"=>$_SESSION['data']['user']['id']),
					array("tipo"=>"s", "dato"=>$this->getAño()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta1()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta2()),
					array("tipo"=>"i", "dato"=>$this->getEtiqueta3())
		);
		$query = "SELECT
					  etiqueta,
					  descripcion,
					  mes,
					  SUM(importe) importe
					FROM
					  (
					  SELECT
					    eti.id etiqueta,
					    eti.descripcion descripcion,
					    DATE_FORMAT(mov.fecha,'%m') mes,
					    mov.importe importe
					  FROM
					    movimiento mov,
					    etiqueta eti,
					    movimiento_etiqueta met
					  WHERE
					    met.mov_id = mov.id AND 
				        met.eti_id = eti.id AND 
				        met.usuario = mov.usuario AND 
				        met.usuario = eti.usuario AND 
				        met.usuario = ? AND 
				        DATE_FORMAT(mov.fecha,'%Y') = ? AND 
				        mov.id IN(SELECT mov_id FROM movimiento_etiqueta WHERE eti_id = IFNULL(?,eti_id)) AND 
				        mov.id IN(SELECT mov_id FROM movimiento_etiqueta WHERE eti_id = IFNULL(?,eti_id)) AND 
				        mov.id IN(SELECT mov_id FROM movimiento_etiqueta WHERE eti_id = IFNULL(?,eti_id))
					UNION
					SELECT
					  eti.id etiqueta,
					  eti.descripcion descripcion,
					  DATE_FORMAT(spl.fecha,'%m') mes,
					  spl.importe importe
					FROM
					  split spl,
					  etiqueta eti,
					  split_etiqueta met
					WHERE
					  met.spl_id = spl.id AND 
				      met.eti_id = eti.id AND 
				      met.usuario = spl.usuario AND 
				      met.usuario = eti.usuario AND 
				      met.usuario = ? AND 
				      DATE_FORMAT(spl.fecha,'%Y') = ? AND 
				      spl.id IN(SELECT spl_id FROM split_etiqueta WHERE eti_id = IFNULL(?,eti_id)) AND 
				      spl.id IN(SELECT spl_id FROM split_etiqueta WHERE eti_id = IFNULL(?,eti_id)) AND 
				      spl.id IN(SELECT spl_id FROM split_etiqueta WHERE eti_id = IFNULL(?,eti_id))
				    UNION
					 SELECT
					    piso.id etiqueta,
					    piso.nombre descripcion,
					    DATE_FORMAT(mov.fecha,'%m') mes,
					    mov.importe importe
					  FROM
					    movimiento mov,
					    (select piso.usuario usuario, piso.id id, CONCAT(piso.nombre,' - ',pro.nombre) nombre from piso,propietario pro where piso.propietario = pro.id and pro.usuario = piso.usuario) piso,
					    movimiento_piso mpi
					  WHERE
					    mpi.mov_id = mov.id AND 
				        mpi.piso_id = piso.id AND 
				        mpi.usuario = mov.usuario AND 
				        mpi.usuario = piso.usuario AND 
				        mpi.usuario = ? AND 
				        DATE_FORMAT(mov.fecha,'%Y') = ? AND 
				        mov.id IN(SELECT mov_id FROM movimiento_piso WHERE piso_id = IFNULL(?,piso_id)) AND 
				        mov.id IN(SELECT mov_id FROM movimiento_piso WHERE piso_id = IFNULL(?,piso_id)) AND 
				        mov.id IN(SELECT mov_id FROM movimiento_piso WHERE piso_id = IFNULL(?,piso_id))
					 UNION
					SELECT
					  piso.id etiqueta,
					  piso.nombre descripcion,
					  DATE_FORMAT(spl.fecha,'%m') mes,
					  spl.importe importe
					FROM
					  split spl,
					  (select piso.usuario usuario, piso.id id, CONCAT(piso.nombre,' - ',pro.nombre) nombre from piso,propietario pro where piso.propietario = pro.id and pro.usuario = piso.usuario) piso,
					  split_piso spi
					WHERE
					  spi.spl_id = spl.id AND 
				      spi.piso_id = piso.id AND 
				      spi.usuario = spl.usuario AND 
				      spi.usuario = piso.usuario AND 
				      spi.usuario = ? AND 
				      DATE_FORMAT(spl.fecha,'%Y') = ? AND 
				      spl.id IN(SELECT spl_id FROM split_piso WHERE piso_id = IFNULL(?,piso_id)) AND 
				      spl.id IN(SELECT spl_id FROM split_piso WHERE piso_id = IFNULL(?,piso_id)) AND 
				      spl.id IN(SELECT spl_id FROM split_piso WHERE piso_id = IFNULL(?,piso_id))
					) alias
					GROUP BY
					  etiqueta,
					  descripcion,
					  mes
					ORDER BY
					  descripcion,
					  mes";
		$link = new Conexion();	
		$data = $link->consulta($query,$datos);
		$link->close();
		return $data;
	}
	
	function __construct() {
		if (isset($_SESSION['data']['estadistica']['año'])) {
			$this->año = $_SESSION['data']['estadistica']['año'];
			$this->etiqueta1 = $_SESSION['data']['estadistica']['etiqueta1'];
		} else {
			$this->año = date("Y", time());
		}
	}
} $Estadistica = new modeloEstadistica();

?>