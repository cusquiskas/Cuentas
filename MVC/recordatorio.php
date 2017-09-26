<?php


class servicioRecordatorio {
	public function esSistema($id) {
		$filtro = array(0=>array("tipo"=>"i", "dato"=>$id));
		$link = new Conexion();
		$data = $link->consulta("select sistema from recordatorio where id = ?", $filtro);
		$link->close();
		return $data[0]["sistema"];
	}
	
	public function buscaId ($recordatorio) {
		$filtro = array(
				   0=>array("tipo"=>"s", "dato"=>$recordatorio["usuario_id"]),
				   1=>array("tipo"=>"i", "dato"=>$recordatorio["id"])
		          );
		$query = 'select id, 
				         DATE_FORMAT(fecha, "%d/%m/%Y") AS fecha, 
				         descripcion, 
				         importe, 
				         sistema,
						 usuario as usuario_id
				    from recordatorio 
				   where usuario = ?
				     and id = ?';
		$link = new Conexion();
		$reg = $link->consulta($query, $filtro);
		$link->close();
		return $reg[0];
	}
	
	private function buscaRecordatorioFecha($recordatorio) {
		$filtro = array(
				0=>array("tipo"=>"s", "dato"=>$recordatorio["usuario_id"]),
				1=>array("tipo"=>"s", "dato"=>$recordatorio["recordatorio"]),
				2=>array("tipo"=>"i", "dato"=>$recordatorio["visa"])
		);
		$query = 'select id,
				         DATE_FORMAT(fecha, "%d/%m/%Y") AS fecha,
				         descripcion,
				         importe,
				         sistema, id_visa
				    from recordatorio
				   where usuario = ?
				     and fecha = STR_TO_DATE(?, "%d/%m/%Y")
				     and id_visa = ?';
		$link = new Conexion();
		$reg = $link->consulta($query, $filtro);
		$link->close();
		return $reg[0];
	}
	
	private function update($recordatorio) {
		$filtro = array(
				   0=>array("tipo"=>"s", "dato"=>$recordatorio["fecha"]),
				   1=>array("tipo"=>"s", "dato"=>$recordatorio["descripcion"]),
				   2=>array("tipo"=>"d", "dato"=>$recordatorio["importe"]),
				   3=>array("tipo"=>"s", "dato"=>$recordatorio["sistema"]),
				   4=>array("tipo"=>"s", "dato"=>$recordatorio["usuario_id"]),
				   5=>array("tipo"=>"i", "dato"=>$recordatorio["id"])
		          );
		$query = 'UPDATE recordatorio
				     SET FECHA = STR_TO_DATE(?, "%d/%m/%Y"),
                         DESCRIPCION = ?,
                         IMPORTE = ?,
                         SISTEMA = ?
                   WHERE USUARIO = ?
                   	 and ID = ?';
		$link = new Conexion();
		$data = $link->ejecuta($query, $filtro);
		$link->close();
		return (!$link->hayError());
	}
	
	private function insert($recordatorio) {
		$filtro = array(
				0=>array("tipo"=>"s", "dato"=>$recordatorio["usuario_id"]),
				1=>array("tipo"=>"s", "dato"=>$recordatorio["fecha"]),
				2=>array("tipo"=>"s", "dato"=>$recordatorio["descripcion"]),
				3=>array("tipo"=>"d", "dato"=>$recordatorio["importe"]),
				4=>array("tipo"=>"s", "dato"=>$recordatorio["sistema"]),
				5=>array("tipo"=>"i", "dato"=>$recordatorio["visa"])
		);
		$query = 'INSERT 
				    INTO recordatorio 
				         (USUARIO, FECHA, DESCRIPCION, IMPORTE, SISTEMA, ID_VISA)
                  VALUES (?, STR_TO_DATE(?, "%d/%m/%Y"), ?, ?, ?, ?)';
		$link = new Conexion();
		$link->ejecuta($query, $filtro);
		$link->close();
		return (!$link->hayError());
	}
	
	private function delete($recordatorio) {
		$filtro = array(
				0=>array("tipo"=>"s", "dato"=>$recordatorio["usuario_id"]),
				1=>array("tipo"=>"i", "dato"=>$recordatorio["id"])
		);
		$query = 'delete 
				    from recordatorio 
			       where usuario = ?
				     and id = ?';
		$link = new Conexion();
		$link->ejecuta($query, $filtro);
		$link->close();
		if ($link->filasAfectadas()==0) new Excepcion('No se ha eliminado ningún registro',2);
		return (!$link->hayError() && $link->filasAfectadas()==1);
	}
	
	public function guardar($recordatorio) {
		$sistema = null;
		if (isset($recordatorio['id'])) $sistema = $this->esSistema($recordatorio["id"]);
		elseif (isset($recordatorio['recordatorio'])) {
			$oldRecordatorio = $this->buscaRecordatorioFecha($recordatorio);
			if (!empty($oldRecordatorio['id'])) $sistema = "N";
			$recordatorio['importe']+=$oldRecordatorio['importe'];
			$recordatorio['id'] = $oldRecordatorio['id'];
		}
		if ($sistema=="S") {
			new Excepcion("Los recordatorios generados por el sistema no son modificables", 2);
		} elseif ($sistema == "N") {
			if ($this->update($recordatorio)) new Excepcion("Se ha modificado el recordatorio con fecha ".$recordatorio['fecha'], 0);
		} else {
			if ($this->insert($recordatorio)) new Excepcion("Se ha creado el recordatorio con fecha ".$recordatorio['fecha'], 0);
		}
	}
	
	public function borrar($recordatorio) {
		$recordatorio = $this->buscaId($recordatorio);
		if ($this->delete($recordatorio)) new Excepcion("Se ha eliminado el recordatorio con fecha ".$recordatorio['fecha'],0);
	}
	
	
} $Recordatorio = new servicioRecordatorio();
?>