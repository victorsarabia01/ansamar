<?php
	
	class historia_model extends conexion {
		
		public $CNX;
		public $id_paciente;
		public $cedula_paciente;
		public $id_cita;
		public $diente;
		public $cara;
		public $id_enfermedad;
		public $fecha;
		public $status;

		public $consulta="";
	  	public $paciente;
		public $historia;
		public $id_historia;
		public $id_servicio;
		public $id_detalle;
		public $servicio;
		public $precio;

		public $evolucion;
		public $observacion;
		public $indicacion;
		
		
		public function __construct(){
			try {
				$this->CNX = parent::conectar();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function Consultar($metodo, $param1="", $param2=""){
			if($metodo=="listarhistoria"){ return self::listarhistoria(); }
			if($metodo=="listarTodasEnfermedades"){ return self::listarTodasEnfermedades(); }
			if($metodo=="listarTodosServicios"){ return self::listarTodosServicios(); }

			if($metodo=="listarPresupuestos" && $param1!=""){ return self::listarPresupuestos($param1); }
			if($metodo=="validarCedula" && $param1!=""){ return self::validarCedula($param1); }
			if($metodo=="BuscarCitaPaciente"){ return self::BuscarCitaPaciente($param1); }
			if($metodo=="BuscarPacienteCita" && $param1!=""){ return self::BuscarPacienteCita($param1); }
			if($metodo=="BuscarHistoriaPaciente" && $param1!=""){ return self::BuscarHistoriaPaciente($param1); }
			if($metodo=="BuscarInsumosAsignado" && $param1!=""){ return self::BuscarInsumosAsignado($param1); }

			if($metodo=="BuscarEvolucionPaciente" && $param1!=""){ return self::BuscarEvolucionPaciente($param1); }
			if($metodo=="ExtraerEvolucionParaInsumos" && $param1!=""){ return self::ExtraerEvolucionParaInsumos($param1); }
			if($metodo=="ValidarServicios" && $param1!=""){ return self::ValidarServicios($param1); }
			if($metodo=="ValidarEnfermedad" && $param1!=""){ return self::ValidarEnfermedad($param1); }
			if($metodo=="ValidarPaciente" && $param1!=""){ return self::ValidarPaciente($param1); }
			if($metodo=="ValidarCita" && $param1!=""){ return self::ValidarCita($param1); }
			if($metodo=="listarCondicionMedicaPaciente" && $param1!=""){ return self::listarCondicionMedicaPaciente($param1); }
			if($metodo=="listarEnfermedadesCita" && $param1!=""){ return self::listarEnfermedadesCita($param1); }
			if($metodo=="listarTodosInsumos" && $param1!=""){ return self::listarTodosInsumos($param1); }
			if($metodo=="listarInsumosEvolucion" && $param1!=""){ return self::listarInsumosEvolucion($param1); }
			//if($metodo=="listarCondicionMedicaPaciente" && $param1!=""){ return self::listarCondicionMedicaPaciente($param1); }
			if($metodo=="ConsultarInsumosEvolucion" && $param1!=""){ return self::ConsultarInsumosEvolucion($param1); }
			if($metodo=="listarHistoriaOdontograma" && $param1!=""){ return self::listarHistoriaOdontograma($param1); }
			if($metodo=="listarHistoriaServicios" && $param1!=""){ return self::listarHistoriaServicios($param1); }


			if($metodo=="ValidarInsumosEvolucion" && $param1!="" && $param2!=""){ return self::ValidarInsumosEvolucion($param1, $param2); }
			if($metodo=="ValidarHistoriaServicio" && $param1!="" && $param2!=""){ return self::ValidarHistoriaServicio($param1, $param2); }
			// if($metodo=="listarHistoriaOdontograma" && $param1!="" && $param2!=""){ return self::listarHistoriaOdontograma($param1, $param2); }
			// if($metodo=="listarHistoriaServicios" && $param1!="" && $param2!=""){ return self::listarHistoriaServicios($param1, $param2); }
		}
		public function Registrar($metodo, historia_model $param1){
			if($metodo=="registrarHistoria" && !empty($param1)){ return self::registrarHistoria($param1); }
			if($metodo=="registrarHistoriaPresupuesto" && !empty($param1)){ return self::registrarHistoriaPresupuesto($param1); }

			if($metodo=="registrarHistoriaServicio" && !empty($param1)){ return self::registrarHistoriaServicio($param1); }
			if($metodo=="registrarEvolucionInsumo" && !empty($param1)){ return self::registrarEvolucionInsumo($param1); }
		}
		public function Modificar($metodo, historia_model $param1){
			if($metodo=="actualizarHistoriaServicio" && !empty($param1)){ return self::actualizarHistoriaServicio($param1); }
			if($metodo=="actualizarAsignacionInsumo" && !empty($param1)){ return self::actualizarAsignacionInsumo($param1); }
			if($metodo=="actualizarEvolucionInsumo" && !empty($param1)){ return self::actualizarEvolucionInsumo($param1); }
		}
		public function Eliminar($metodo, $param1=""){
			if($metodo=="eliminarServicio" && $param1!=""){ return self::eliminarServicio($param1); }
		}
		
		
		private function listarPresupuestos($id_historia){
			try {
				$query="SELECT * FROM presupuesto WHERE id_historia=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id_historia));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function validarCedula($cedula){
			try {
				$query="SELECT id as consulta from paciente where cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function BuscarCitaPaciente($fechaCita){
			try {
				$query="SELECT p.id as id_paciene, p.cedula as cedula_paciente, p.nombres as nombre_paciente, p.apellidos as apellido_paciente, ci.id as id_cita, ci.fecha as fecha_cita, co.descripcion, co.direccion, co.tlfno as telefono_consultorio, co.sillas, e.cedula as cedula_empleado, e.nombres as nombre_empleado, e.apellidos as apellido_empleado FROM paciente as p, cita as ci, planificacion as pl, consultorio as co, empleado as e WHERE p.id=ci.id_paciente and ci.id_planificacion = pl.id and pl.id_consultorio=co.id and e.id=pl.id_empleado";
				// echo $query;
				if($fechaCita!=""){
					$query .= " and ci.fecha='{$fechaCita}'";
				}
				// $query="SELECT p.id as id_paciene, p.cedula as cedula_paciente, p.nombres as nombre_paciente, p.apellidos as apellido_paciente, ci.fecha as fecha_cita, co.descripcion, co.direccion, co.tlfno as telefono_consultorio, co.sillas, e.cedula as cedula_empleado, e.nombres as nombre_empleado, e.apellidos as apellido_empleado FROM paciente as p, cita as ci, consultorio as co, empleado as e WHERE p.id=ci.id_paciente and co.id=ci.id_consultorio and e.id=ci.id_empleado and p.cedula=?";
				// $query="SELECT ci.fecha as fecha_cita, co.descripcion, co.direccion, co.tlfno as telefono_consultorio, co.sillas, e.cedula as cedula_empleado, e.nombres as nombre_empleado, e.apellidos as apellido_empleado FROM cita as ci, consultorio as co, empleado as e WHERE co.id=ci.id_consultorio and e.id=ci.id_empleado";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function BuscarPacienteCita($cedula){
			try {
				// $query="SELECT p.id as id_paciene, p.cedula as cedula_paciente, p.nombres as nombre_paciente, p.apellidos as apellido_paciente, ci.fecha as fecha_cita, co.descripcion, co.direccion, co.tlfno as telefono_consultorio, co.sillas, e.cedula as cedula_empleado, e.nombres as nombre_empleado, e.apellidos as apellido_empleado FROM paciente as p, cita as ci, consultorio as co, empleado as e WHERE p.id=ci.id_paciente and co.id=ci.id_consultorio and e.id=ci.id_empleado and p.cedula=?";
				$query="SELECT * FROM paciente as p WHERE p.cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function BuscarHistoriaPaciente($cedula){
			try {
				$query="SELECT *, h.id as id_historia, c.id as id_cita, p.id as id_paciente, e.id as id_enfermedad FROM historia as h, cita as c, paciente as p, enfermedades as e WHERE h.id_cita=c.id and c.id_paciente=p.id and h.id_enfermedad=e.id and p.cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function BuscarInsumosAsignado($id){
			try {
				$query="SELECT * FROM asignacion_insumo as ai WHERE ai.id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function ExtraerEvolucionParaInsumos($id_ev){
			try {
				$query="SELECT *, ev.id as id_evolucion, h.fecha as fecha_historia FROM enfermedades as e, historia as h, evolucion as ev, servicio_dental as s WHERE e.id=h.id_enfermedad and h.id=ev.id_historia and s.id=ev.id_servicio_dental and ev.id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id_ev));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function BuscarEvolucionPaciente($cedula){
			try {
				$query="SELECT *, h.id as id_historia, c.id as id_cita, p.id as id_paciente, e.id as id_enfermedad, ev.id as id_evolucion FROM evolucion as ev, historia as h, cita as c, paciente as p, enfermedades as e WHERE ev.id_historia=h.id and h.id_cita=c.id and c.id_paciente=p.id and h.id_enfermedad=e.id and ev.status=1 and p.cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarTodasEnfermedades(){
			try {
				$query="SELECT * from enfermedades WHERE status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarEnfermedadesCita($id_cita){
			try {
				$query="SELECT *, e.id as id_enfermedad, h.id as id_historia from enfermedades as e, historia as h WHERE e.id = h.id_enfermedad and e.status=1 and h.id_cita=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id_cita));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		

		private function listarTodosServicios(){
			try {
				$query="SELECT * from servicio_dental WHERE status=1";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarTodosInsumos($consultorio){
			try {
				$query="SELECT *, ai.id as id_ai FROM insumo as i, asignacion_insumo as ai, consultorio as co WHERE i.id=ai.id_insumo and co.id=ai.id_consultorio and i.status=1 and co.id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($consultorio));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		
		private function listarInsumosEvolucion($id){
			try {
				$query="SELECT * FROM insumo_evolucion as ei, asignacion_insumo as ai, insumo as i WHERE ei.id_asignacion_insumo=ai.id and ai.id_insumo=i.id and ei.id_evolucion=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		
		private function ValidarServicios($servicio){
			try {
				$query="SELECT * from servicio_dental WHERE nombre=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($servicio));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		private function ValidarEnfermedad($enfermedad){
			try {
				$query="SELECT * from enfermedades WHERE enfermedad=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($enfermedad));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function ValidarPaciente($cedula){
			try {
				$query="SELECT * from paciente WHERE cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function ValidarCita($id_cita){
			try {
				$query="SELECT * FROM paciente as p, cita as c WHERE p.id = c.id_paciente and c.id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id_cita));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function ValidarHistoriaServicio($historia, $servicio){
			try {
				$query="SELECT * from evolucion WHERE id_historia=? and id_servicio_dental=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($historia, $servicio));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		private function ValidarInsumosEvolucion($evolucion, $insumo){
			try {
				$query="SELECT * from insumo_evolucion WHERE id_evolucion=? and id_asignacion_insumo=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($evolucion, $insumo));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function ConsultarInsumosEvolucion($id_evolucion){
			try {
				$query="SELECT * from insumo_evolucion WHERE id_evolucion=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id_evolucion));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarhistoria(){
			try {
				$query="SELECT DISTINCT p.id as id_paciente, p.cedula, p.nombres, p.apellidos, p.fechaNacimiento, p.sexo FROM paciente as p, historia as h, cita as c WHERE p.id = c.id_paciente and c.id = h.id_cita";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$return['paciente']=$smt->fetchAll(PDO::FETCH_OBJ);
				
				$query="SELECT h.id_cita as id, p.id as id_paciente, h.presupuesto FROM paciente as p, historia as h, cita as c WHERE p.id = c.id_paciente and c.id = h.id_cita";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				$return['presupuesto']=$smt->fetchAll(PDO::FETCH_OBJ);

				return $return;
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarHistoriaOdontograma($cedula){
			try {
				// $query="SELECT p.id as id_paciente, p.cedula, p.nombres, p.apellidos, c.id as id_cita, c.fecha as fecha_cita, h.id as id_historia, h.fecha as fecha_historia, h.pieza_dental, h.posicion_dental, e.id as id_enfermedad, e.enfermedad, e.campo FROM paciente as p, cita as c, historia as h, enfermedades as e WHERE p.id=c.id_paciente and c.id=h.id_cita and e.id = h.id_enfermedad and p.cedula=? and c.id=?";
				$query="SELECT p.id as id_paciente, p.cedula, p.nombres, p.apellidos, c.id as id_cita, c.fecha as fecha_cita, h.id as id_historia, h.fecha as fecha_historia, h.pieza_dental, h.posicion_dental, h.presupuesto, e.id as id_enfermedad, e.enfermedad, e.campo FROM paciente as p, cita as c, historia as h, enfermedades as e WHERE p.id=c.id_paciente and c.id=h.id_cita and e.id = h.id_enfermedad and p.cedula=?";
				// $query="SELECT p.id as id_paciente, p.cedula, p.nombres, p.apellidos, c.id as id_cita, c.fecha as fecha_cita, h.id as id_historia, h.fecha as fecha_historia, h.pieza_dental, h.posicion_dental, e.id as id_enfermedad, e.enfermedad, e.campo FROM paciente as p, cita as c, historia as h, enfermedades as e WHERE p.id=h.id_paciente and c.id=h.id_cita and e.id = h.id_enfermedad and p.cedula=? and c.id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarCondicionMedicaPaciente($cedula){
			try {
				$query="SELECT * FROM condicion_medica as cm, detalles_condicion_medica as dcm, paciente as p WHERE cm.id=dcm.id_condicion_medica and dcm.id_paciente = p.id and p.cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function listarHistoriaServicios($cedula){
			try {
				$query="SELECT d.id, h.id as id_historia, h.pieza_dental, h.posicion_dental, c.fecha as fecha_cita, h.fecha as fecha_historia, e.enfermedad, e.campo, s.nombre as tratamiento, s.descripcion, s.precio, d.evolucion, d.observacion, d.indicaciones FROM paciente as p, cita as c, historia as h, enfermedades as e, evolucion as d, servicio_dental as s WHERE p.id=c.id_paciente and c.id = h.id_cita and e.id=h.id_enfermedad and h.id = d.id_historia and s.id = d.id_servicio_dental and d.status=1 and p.cedula=?";
				// $query="SELECT d.id, h.pieza_dental, h.posicion_dental, c.fecha as fecha_cita, h.fecha as fecha_historia, e.enfermedad, e.campo, s.nombre as tratamiento, s.descripcion, s.precio, d.evolucion, d.observacion, d.indicaciones FROM paciente as p, cita as c, historia as h, enfermedades as e, evolucion as d, servicio_dental as s WHERE p.id=c.id_paciente and c.id = h.id_cita and e.id=h.id_enfermedad and h.id = d.id_historia and s.id = d.id_servicio_dental and d.status=1 and c.id=? and p.cedula=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($cedula));
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}



		//RESGISTRAR EMPLEADO EN BD
		private function registrarHistoria(historia_model $data){
			try {
				// $query="INSERT into historia (id_paciente, id_cita, id_enfermedad, fecha, pieza_dental, posicion_dental, status) VALUES (?,?,?,?,?,?,?)";
				// $this->CNX->prepare($query)->execute(array($data->id_paciente, $data->id_cita, $data->id_enfermedad, $data->fecha, $data->diente, $data->cara, "1"));
				// $query="INSERT into historia (motivo,fecha,id_lesiones,id_tipo,observacion,id_tratamiento) VALUES (?,?,?,?,?,?)";
				// $this->CNX->prepare($query)->execute(array($data->motivo,$data->fecha,$data->id_lesiones,$data->dolor,$data->id_tipo,$data->observacion,$data->id_tratamiento));
				
				$query="INSERT into historia (id_cita, id_enfermedad, fecha, pieza_dental, posicion_dental, presupuesto, status) VALUES (?,?,?,?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->id_cita, $data->id_enfermedad, $data->fecha, $data->diente, $data->cara, $data->presupuesto, "1"));
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		//RESGISTRAR EMPLEADO EN BD
		private function registrarHistoriaPresupuesto(historia_model $data){
			try {
				$query="INSERT into presupuesto (id_historia, servicio, precio, status) VALUES (?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->id_historia, $data->servicio, $data->precio, "1"));
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		//RESGISTRAR EMPLEADO EN BD
		
		private function registrarHistoriaServicio(historia_model $data){
			try {
				$query="INSERT into evolucion (id_historia, id_servicio_dental, fecha, status) VALUES (?,?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->id_historia, $data->id_servicio, date("Y-m-d"), "1"));
				// $query="INSERT into historia (motivo,fecha,id_lesiones,id_tipo,observacion,id_tratamiento) VALUES (?,?,?,?,?,?)";
				// $this->CNX->prepare($query)->execute(array($data->motivo,$data->fecha,$data->id_lesiones,$data->dolor,$data->id_tipo,$data->observacion,$data->id_tratamiento));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function registrarEvolucionInsumo(historia_model $data){
			try {
				$query="INSERT into insumo_evolucion (id_evolucion, id_asignacion_insumo, cantidad) VALUES (?,?,?)";
				$this->CNX->prepare($query)->execute(array($data->id_evolucion, $data->id_insumo, $data->cantidad));
				// $query="INSERT into historia (motivo,fecha,id_lesiones,id_tipo,observacion,id_tratamiento) VALUES (?,?,?,?,?,?)";
				// $this->CNX->prepare($query)->execute(array($data->motivo,$data->fecha,$data->id_lesiones,$data->dolor,$data->id_tipo,$data->observacion,$data->id_tratamiento));
				
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function actualizarHistoriaServicio(historia_model $data){
			try {
				$query="UPDATE evolucion set evolucion=?, observacion=?, indicaciones=? WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($data->evolucion, $data->observacion, $data->indicacion, $data->id_detalle));
				// return $smt->fetch();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function actualizarAsignacionInsumo(historia_model $data){
			try {
				$query="UPDATE asignacion_insumo set cantidad_usada=? WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($data->newUsada, $data->id_insumo));
				// return $smt->fetch();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function actualizarEvolucionInsumo(historia_model $data){
			try {
				$query="UPDATE insumo_evolucion set cantidad=? WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($data->cantidad, $data->id_evInsumo));
				// return $smt->fetch();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		private function eliminarServicio($id){
			try {
				$query="UPDATE evolucion set status='0' WHERE id=?";
				$smt = $this->CNX->prepare($query);
				$smt->execute(array($id));
				// return $smt->fetch();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}




		public function listarTodostipo(){
			try {
				
				$query="SELECT * from tipo";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		public function listarTodoslesiones(){
			try {
				
				$query="SELECT * from lesiones";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		public function listarTodostratamiento(){
			try {
				
				$query="SELECT * from tratamiento";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}


		
		// public function listarhistoria(){
		// 	try {
		// 		$query="SELECT p.id,p.cedula,p.nombres,p.apellidos,h.id_tratamiento,h.id_paciente,t.trabajo FROM paciente as p INNER JOIN historia as h 
		// 			JOIN tratamiento as t 
		// 			ON h.id=p.id";
		// 		$smt = $this->CNX->prepare($query);
		// 		$smt->execute();
		// 		return $smt->fetchAll(PDO::FETCH_OBJ);
		// 	} catch (Exception $e) {
		// 		die($e->getMessage());
		// 	}
		// }

		public function editarhistoria(){
			try {
			   	
				  $query="UPDATE historia SET motivo=value,fecha=value,id_paciente=value,toma_medicamento=value,id_lesiones=value,hablar=value,dolor=value,id_tipo=value,enfermedad=value,alergia=value,observacion=value,id_tratamiento=value<th>cedula</th>";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		
	
		
		
		//RESGISTRAR CONSULTORIO EN BD
		
		
	}
	
?>