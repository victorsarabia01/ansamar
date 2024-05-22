<?php
	
	class listarCitas_model extends conexion {
		
		private $db;
		private $cita;
		public $CNX;
		public $cedula;
		public $nombres;
		public $apellidos;
		public $tlfn;
		public $cedula_cliente;
		public $alertify;
		public $verificarDia;
		public function __construct(){
			try {
				$this->CNX = parent::conectar();
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
		public function listarCitas(){
			try {
				$fecha = date('Y-m-d');
				
				//$query="SELECT x.descripcion as consultorio,c.id_consultorio, p.nombres,p.apellidos,p.tlfno,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.fecha desc,c.id_consultorio";
				$query="SELECT c.id,x.descripcion as consultorio,c.id_consultorio, p.nombres,p.apellidos,p.tlfno,t.descripcion AS turno, e.nombres AS nombresDoctor,e.apellidos as apellidosDoctor,c.fecha FROM cita AS c INNER JOIN paciente AS p INNER JOIN empleado AS e INNER JOIN turno AS t inner join consultorio as x WHERE YEAR(c.fecha) = YEAR(CURRENT_DATE()) AND MONTH(c.fecha) = MONTH(CURRENT_DATE()) and c.id_consultorio=x.id and c.id_paciente=p.id AND c.id_turno=t.id AND c.id_empleado=e.id ORDER BY c.fecha desc,c.id_consultorio";
				$smt = $this->CNX->prepare($query);
				$smt->execute();
				return $smt->fetchAll(PDO::FETCH_OBJ);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}

		
	} 
?>