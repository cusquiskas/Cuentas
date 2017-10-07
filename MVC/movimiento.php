<?php

class servicioMovimiento {
	public function saldoReal($user, $dia) {
		$filtro = array (
				0=>array("tipo"=>"s", "dato"=>$user),
				1=>array("tipo"=>"s", "dato"=>$dia),
		);
		$query = "select sum(IMPORTE) as IMP 
				    from movimiento 
				   where usuario = ? 
		             and FECHA <= STR_TO_DATE(?, '%d/%m/%Y') 
				     and visa not in (select id 
				                        from visa 
				                       where d_recordatorio > 0
				                      )";
		$link = new Conexion();
		$data = $link->consulta($query, $filtro);
		$link->close();
		return $data[0]["IMP"];
	}
	
	public function saldoEstimado($user, $dia) {
		$real = $this->saldoReal($user, $dia);
		$filtro = array (
				0=>array("tipo"=>"s", "dato"=>$user),
				1=>array("tipo"=>"s", "dato"=>$dia),
		);
		$query = "select sum(importe) as IMP 
				    from recordatorio 
				   where usuario = ? 
		             and fecha <= STR_TO_DATE(?, '%d/%m/%Y')";
		$link = new Conexion();
		$data = $link->consulta($query, $filtro);
		$link->close();
		return $real+$data[0]["IMP"];
	}
	
	public function datosMovimiento($user, $id) {
		$filtro = array (
					0=>array("tipo"=>"s", "dato"=>$user),
					1=>array("tipo"=>"i", "dato"=>$id)
				);
		$query = "select id,
				         DATE_FORMAT(FECHA, '%d/%m/%Y') AS fecha,
				         importe,
						 descripcion,
						 visa,
						 concepto1,
						 concepto2,
						 concepto3,
						 concepto4,
						 concepto5,
						 concepto6,
						 usuario
				    from movimiento
			       where usuario = ?
				     and id = ?";
		$link = new Conexion();
		$data = $link->consulta($query, $filtro);
		$link->close();
		return $data[0];
	}
	
	public function listaRegistros($usuario) {
		$filtro = array(array("tipo"=>"s", "dato"=>$usuario));
		$query  = "select id,
				         DATE_FORMAT(FECHA, '%d/%m/%Y') AS fecha,
				         importe,
						 descripcion,
						 visa,
						 concepto1,
						 concepto2,
						 concepto3,
						 concepto4,
						 concepto5,
						 concepto6,
						 usuario
				    from movimiento
			       where usuario = ?
					order by id desc
					limit 50";
		$link = new Conexion();
		$data = $link->consulta($query, $filtro);
		$link->close();
		return $data;
	}
	
	public function listaMovimiento($user, $mes, $año) {
		$filtro = array (
					0=>array("tipo"=>"s", "dato"=>$user),
					1=>array("tipo"=>"s", "dato"=>"01/$mes/$año"),
					2=>array("tipo"=>"s", "dato"=>"01/$mes/$año"),
					3=>array("tipo"=>"s", "dato"=>$user),
					4=>array("tipo"=>"s", "dato"=>"01/$mes/$año"),
					5=>array("tipo"=>"s", "dato"=>"01/$mes/$año"),
					6=>array("tipo"=>"s", "dato"=>$user),
					7=>array("tipo"=>"s", "dato"=>"01/$mes/$año"),
					8=>array("tipo"=>"s", "dato"=>"01/$mes/$año"),
					9=>array("tipo"=>"s", "dato"=>$user),
				   10=>array("tipo"=>"s", "dato"=>"01/$mes/$año"),
				   11=>array("tipo"=>"s", "dato"=>"01/$mes/$año")
		          );
		$query = "select ID, 
				         DATE_FORMAT(FECHA, '%d/%m/%Y') AS FECHA, 
				         IFNULL(IF(CONCEPTO6='NULL', NULL, concepto6),DESCRIPCION) AS DESCRIPCION, 
				         IMPORTE, 
				         VISA,
				         null as split
				    from movimiento MO
				   where usuario = ? 
				     and FECHA >= STR_TO_DATE(?, '%d/%m/%Y') 
				     and FECHA <= last_day(STR_TO_DATE(?, '%d/%m/%Y'))
				     and id not in (select mov_id from split where usuario = ? and FECHA >= STR_TO_DATE(?, '%d/%m/%Y') and FECHA <= last_day(STR_TO_DATE(?, '%d/%m/%Y')))
                   union
                  select ID, 
                         DATE_FORMAT(FECHA, '%d/%m/%Y') AS FECHA, 
                         DESCRIPCION, 
                         IMPORTE, 
                         0 VISA,
				         null as split
                    from recordatorio 
                   where usuario = ? 
                     and FECHA >= STR_TO_DATE(?, '%d/%m/%Y') 
                     and FECHA <= last_day(STR_TO_DATE(?, '%d/%m/%Y'))
				   union
				  select mov_id as ID, 
                         DATE_FORMAT(FECHA, '%d/%m/%Y') AS FECHA, 
                         DESCRIPCION, 
                         IMPORTE, 
                         -1 VISA,
					     id as split
				    from split 
				   where usuario = ? 
				     and FECHA >= STR_TO_DATE(?, '%d/%m/%Y') 
				     and FECHA <= last_day(STR_TO_DATE(?, '%d/%m/%Y'))
                   order 
		              by FECHA desc, id desc";
		$link = new Conexion();
		$data = $link->consulta($query, $filtro);
		$link->close();
		return $data;
	}
	
	private function update($movimiento) {
		$filtro = array (
				0=>array("tipo"=>"s", "dato"=>$movimiento["fecha"]),
				1=>array("tipo"=>"s", "dato"=>$movimiento["descripcion"]),
				2=>array("tipo"=>"d", "dato"=>$movimiento["importe"]),
				3=>array("tipo"=>"s", "dato"=>$movimiento["concepto1"]),
				4=>array("tipo"=>"s", "dato"=>$movimiento["concepto2"]),
				5=>array("tipo"=>"s", "dato"=>$movimiento["concepto3"]),
				6=>array("tipo"=>"s", "dato"=>$movimiento["concepto4"]),
				7=>array("tipo"=>"s", "dato"=>$movimiento["concepto5"]),
			    8=>array("tipo"=>"s", "dato"=>$movimiento["concepto6"]),
			    9=>array("tipo"=>"i", "dato"=>$movimiento["visa"]),
			   10=>array("tipo"=>"s", "dato"=>$movimiento["usuario"]),
			   11=>array("tipo"=>"i", "dato"=>$movimiento["id"]),
				
		);
		$query = 'UPDATE movimiento 
				     SET FECHA = STR_TO_DATE(?, "%d/%m/%Y"),
                         DESCRIPCION = ?,
                         IMPORTE = ?,
                         CONCEPTO1 = ?, 
                         CONCEPTO2 = ?, 
                         CONCEPTO3 = ?,
                         CONCEPTO4 = ?, 
                         CONCEPTO5 = ?, 
                         CONCEPTO6 = ?,
                         VISA = ?
                   WHERE USUARIO = ?
                     AND ID = ?';
		$link = new Conexion();
		$link->ejecuta($query, $filtro);
		$link->close();
		return (!$link->hayError());
	}
	
	private function delete($movimiento) {
		$link = new Conexion();
		$filtro = array (
				array("tipo"=>"s", "dato"=>$movimiento["usuario"]),
				array("tipo"=>"s", "dato"=>$movimiento["usuario"]),
				array("tipo"=>"i", "dato"=>$movimiento["id"]),
		);
		$query = "delete split_etiqueta
           		   where usuario = ?
                     and eti_id in (select id
                                      from split
								     where usuario = ?
				                       and mov_id = ? )";
		$link->ejecuta($query, $filtro);
		$filtro = array (
				array("tipo"=>"s", "dato"=>$movimiento["usuario"]),
				array("tipo"=>"i", "dato"=>$movimiento["id"]),
		);
		$query = "delete movimiento_etiqueta
				   where usuario = ?
                     and mov_id = ?";
		$link->ejecuta($query, $filtro);
		$filtro = array (
				array("tipo"=>"s", "dato"=>$movimiento["usuario"]),
				array("tipo"=>"i", "dato"=>$movimiento["id"]),
		);
		$query = "delete split
				   where usuario = ?
                     and mov_id = ?";
		$link->ejecuta($query, $filtro);
		$query = "delete movimiento
				   where usuario = ?
                     and id = ?";
		$link->ejecuta($query, $filtro);
		$link->close();
		return (!$link->hayError());
	}
	
	private function insert($movimiento) {
		$filtro = array (
				0=>array("tipo"=>"s", "dato"=>$movimiento["usuario"]),
				1=>array("tipo"=>"s", "dato"=>$movimiento["fecha"]),
				2=>array("tipo"=>"s", "dato"=>$movimiento["descripcion"]),
				3=>array("tipo"=>"d", "dato"=>$movimiento["importe"]),
				4=>array("tipo"=>"s", "dato"=>$movimiento["concepto1"]),
				5=>array("tipo"=>"s", "dato"=>$movimiento["concepto2"]),
				6=>array("tipo"=>"s", "dato"=>$movimiento["concepto3"]),
				7=>array("tipo"=>"s", "dato"=>$movimiento["concepto4"]),
				8=>array("tipo"=>"s", "dato"=>$movimiento["concepto5"]),
				9=>array("tipo"=>"s", "dato"=>$movimiento["concepto6"]),
			   10=>array("tipo"=>"i", "dato"=>$movimiento["visa"])
		);
		$query = "INSERT 
				    INTO movimiento 
				        (USUARIO, 
				         FECHA, 
				         DESCRIPCION, 
				         IMPORTE, 
				         CONCEPTO1, 
				         CONCEPTO2, 
				         CONCEPTO3, 
				         CONCEPTO4, 
				         CONCEPTO5, 
				         CONCEPTO6, 
				         VISA)
                  VALUES (?, STR_TO_DATE(?, '%d/%m/%Y'), ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$link = new Conexion();
		$link->ejecuta($query, $filtro);
		$link->close();
		return (!$link->hayError());
	}	
	
	private function duplicado ($movimiento) {
		$filtro = array (
				0=>array("tipo"=>"s", "dato"=>$movimiento["usuario"]),
				1=>array("tipo"=>"s", "dato"=>$movimiento["fecha"]),
				2=>array("tipo"=>"s", "dato"=>$movimiento["descripcion"]),
				3=>array("tipo"=>"d", "dato"=>$movimiento["importe"])
		);
		
		$query = 'select count(0) CNT 
				    from movimiento 
				    where usuario = ? 
				      and fecha = STR_TO_DATE(?, "%d/%m/%Y")
				      and descripcion = ?
				      and importe = ?';
		$link = new Conexion();
		$data = $link->consulta($query, $filtro);
		$link->close();
		return ($data[0]["CNT"] > 0);
	}
	
	public function guardar($movimiento) {
		$resultado = true;
		if ($movimiento["id"]=="") {
			if ($this->duplicado($movimiento)) {
				$resultado = false;
				new Excepcion("Registro de fecha ".$movimiento['fecha']." e importe ".$movimiento['importe']." duplicado",1);
			} else {
				if ($this->insert($movimiento)) new Excepcion("Se ha guardado el movimiento con fecha ".$movimiento['fecha']." e importe ".$movimiento['importe'],0);
				else $resultado = false;
			}
		} else {
			if ($this->update($movimiento)) new Excepcion("Se ha actualziado el movimiento con fecha ".$movimiento['fecha']." e importe ".$movimiento['importe'],0);
			else $resultado = false;
		}
		return $resultado;
	}
} $Movimiento = new servicioMovimiento();

?>