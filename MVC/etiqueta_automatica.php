<?php

class EtiquetaAutomatica {
	private $usuario;
	private $id;
	private $nombre;
	private $patron;
	private $idetiqueta;

	public function setUsuario($valor) { $this->usuario = (string)$valor; }
	public function setId($valor) { $this->id = ($valor === '' ? null : (int)$valor); }
	public function setNombre($valor) { $this->nombre = trim((string)$valor); }
	public function setPatron($valor) { $this->patron = trim((string)$valor); }
	public function setIdEtiqueta($valor) { $this->idetiqueta = (int)$valor; }

	public function lista() {
		$filtro = array(array("tipo"=>"s", "dato"=>$this->usuario));
		$query = "SELECT id AS ID, nombre AS NOMBRE, patron AS PATRON, eti_id AS IDETIQUETA
				    FROM etiqueta_automatica
				   WHERE usuario = ?
				   ORDER BY nombre";
		$link = new Conexion();
		$data = $link->consulta($query, $filtro);
		$link->close();
		return $data;
	}

	public function guardar() {
		if ($this->nombre === '' || $this->patron === '' || $this->idetiqueta <= 0) {
			new Excepcion("Nombre, patrón y etiqueta son obligatorios", 1);
			return false;
		}

		$link = new Conexion();
		if ($this->id === null) {
			$filtro = array(
				array("tipo"=>"s", "dato"=>$this->usuario),
				array("tipo"=>"s", "dato"=>$this->nombre),
				array("tipo"=>"s", "dato"=>$this->patron),
				array("tipo"=>"i", "dato"=>$this->idetiqueta)
			);
			$query = "INSERT INTO etiqueta_automatica
				(usuario, nombre, patron, eti_id)
				VALUES (?, ?, ?, ?)";
		} else {
			$filtro = array(
				array("tipo"=>"s", "dato"=>$this->nombre),
				array("tipo"=>"s", "dato"=>$this->patron),
				array("tipo"=>"i", "dato"=>$this->idetiqueta),
				array("tipo"=>"i", "dato"=>$this->id),
				array("tipo"=>"s", "dato"=>$this->usuario)
			);
			$query = "UPDATE etiqueta_automatica
				     SET nombre = ?, patron = ?, eti_id = ?
				   WHERE id = ? AND usuario = ?";
		}
		$link->ejecuta($query, $filtro);
		$sinError = !$link->hayError();
		$link->close();
		if ($sinError) new Excepcion("Se ha guardado la etiquetación automática", 0);
		return $sinError;
	}

	public function eliminar() {
		$filtro = array(
			array("tipo"=>"i", "dato"=>$this->id),
			array("tipo"=>"s", "dato"=>$this->usuario)
		);
		$link = new Conexion();
		$link->ejecuta("DELETE FROM etiqueta_automatica WHERE id = ? AND usuario = ?", $filtro);
		$sinError = !$link->hayError();
		$link->close();
		return $sinError;
	}

	public function aplicar($usuario, $movimientoId, $movimiento) {
		$anterior = $this->usuario;
		$this->usuario = (string)$usuario;
		$reglas = $this->lista();
		$this->usuario = $anterior;

		$campos = array(
			isset($movimiento["descripcion"]) ? $movimiento["descripcion"] : '',
			isset($movimiento["concepto1"]) ? $movimiento["concepto1"] : '',
			isset($movimiento["concepto2"]) ? $movimiento["concepto2"] : '',
			isset($movimiento["concepto3"]) ? $movimiento["concepto3"] : '',
			isset($movimiento["concepto4"]) ? $movimiento["concepto4"] : '',
			isset($movimiento["concepto5"]) ? $movimiento["concepto5"] : '',
			isset($movimiento["concepto6"]) ? $movimiento["concepto6"] : ''
		);

		foreach ($reglas as $regla) {
			$patron = (string)$regla["PATRON"];
			if ($patron === '') continue;

			$patrones = preg_split('/[\r\n,;]+/', $patron);
			foreach ($patrones as $patronItem) {
				$patronItem = trim($patronItem);
				if ($patronItem === '') continue;

				foreach ($campos as $campo) {
					if (stripos((string)$campo, $patronItem) !== false) {
						$MovEti = new MovimientoEtiqueta();
						$MovEti->setUsuario($usuario);
						$MovEti->setMov($movimientoId);
						$MovEti->setEti((int)$regla["IDETIQUETA"]);
						if (!$MovEti->existe()) $MovEti->guardaAsignacion();
						unset($MovEti);
						break 2;
					}
				}
			}
		}
	}
}
?>
