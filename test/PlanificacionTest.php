<?php

require_once 'modelsT/planificacionModel.php';

use PHPUnit\Framework\TestCase;

class PlanificacionTest extends TestCase
{
	private $planificacion;
	/** @test **/

	public function setUp(): void
	{
		$this->planificacion = new planificacion_model([
			"id_consultorio" => '1',
			"turno" => '2',
			"id_doctor" => '23',
			"diaSemana" => '2',
			"id" => '322'
		]);
		

		$this->assertEquals(true, true);
	}

	public function testList()
	{
		$all = $this->planificacion->Consultar('listarTodosConsultorios');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListTodosTurnos()
	{
		$all = $this->planificacion->Consultar('listarTodosTurnos');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListDiaSemana()
	{
		$all = $this->planificacion->Consultar('listarDiaSemana');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListarTodosDoctores()
	{
		$all = $this->planificacion->Consultar('listarTodosDoctores');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListarStatus()
	{
		$all = $this->planificacion->Consultar('listarStatus');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListarPlanificacion()
	{
		$all = $this->planificacion->Consultar('listarPlanificacion');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testConsultarSillas()
	{
		$all = $this->planificacion->Consultar('consultarSillas', '1');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testPlanificacionAEditar()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionAEditar', '322');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testRegistroPlanificacion()
	{
		$all = $this->planificacion->Consultar('buscarRegistroPlanificacion', 'Centro');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testCargarPlanificacion()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacion1', '1', '22', '3');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testConsultarCantPlanificacion()
	{
		$all = $this->planificacion->Consultar('consultarCantPlanificacion', '3', '2', '2');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testPlanificacionLunes()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionLunes1', '1', '21', '1');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testPlanificacionMartes()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionMartes1', '2', '21', '2');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testPlanificacionMiercoles()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionMiercoles1', '1', '21', '3');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
    public function testPlanificacionJueves()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionJueves1', '1', '21', '4');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
    public function testPlanificacionViernes()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionViernes1', '2', '21', '5');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
    public function testPlanificacionSabado()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionSabado1', '1', '22', '6');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
    public function testCargarPlanif()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacion', '3', '2', '21', '2');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
    public function testPlanificacionLunesConsultorio()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionLunes', '1', '1', '21', '1');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testPlanificacionMartesConsultorio()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionMartes', '3', '2', '21', '2');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testPlanificacionMiercolesConsultorio()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionMiercoles', '1', '1', '21', '3');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
    public function testPlanificacionJuevesConsultorio()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionJueves', '1', '1', '21', '4');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
    public function testPlanificacionViernesConsultorio()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionViernes', '1', '2', '21', '5');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
    public function testPlanificacionSabadoConsultorio()
	{
		$all = $this->planificacion->Consultar('cargarPlanificacionSabado', '2', '1', '22', '6');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testRegistrar()
	{
		$all = $this->planificacion->Registrar('registrarPlanificacion', $this->planificacion);
		$this->assertEquals(true, $all);
	}
	public function testModificar()
	{
		$all = $this->planificacion->Modificar('modificarPlanificacion', $this->planificacion);
		$this->assertEquals(true, $all);
	}
	public function testEliminar()
	{
		$result = $this->planificacion->Eliminar('deletePlanificacion', '315');
		$this->assertEquals(true, $result);
	}
    public function testHabilitar()
	{
		$result = $this->planificacion->Eliminar('habilitarPlanificacion', '322');
		$this->assertEquals(true, $result);
	}
	
}
