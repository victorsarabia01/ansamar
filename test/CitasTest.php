<?php

require_once 'modelsT/citaModel.php';

use PHPUnit\Framework\TestCase;

class CitasTest extends TestCase
{
	private $cita;
	/** @test **/

	public function setUp(): void
	{
		$this->cita = new cita_model([
			"fechaCita" => '2024-02-08',
			"mesRegistro" => '2',
			"id_paciente" => '42',
			"idPlanificacion" => '318',
			"id" => '128',
			'cedula' => '27828164',
			'nombre' => 'Naty',
			'apellido' => 'Ramos',
			'correo' => 'nath@gmail.com',
			'telefono' => '04161234567',
			'sexo' => 'F'
		]);
		

		$this->assertEquals(true, true);
	}

	public function testList()
	{
		$all = $this->cita->Consultar('listarTodosConsultorios');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListTodosTurnos()
	{
		$all = $this->cita->Consultar('listarTodosTurnos');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListTodosDoctores()
	{
		$all = $this->cita->Consultar('listarTodosDoctores');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListarCitas()
	{
		$all = $this->cita->Consultar('listarCitas', '128');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListarCitasParaHoy()
	{
		$all = $this->cita->Consultar('listarCitasParaHoy', '1');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testCargarCita()
	{
		$all = $this->cita->Consultar('cargarCita', '128');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testCargarInformacionCita()
	{
		$all = $this->cita->Consultar('cargarInformacionCita', '128');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testPdfCita()
	{
		$all = $this->cita->Consultar('pdfCita', '128');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testCargarCedula()
	{
		$all = $this->cita->Consultar('cargarCedula', '22186490');
		$result = is_object($all);
		$this->assertEquals(true, $result);
	}
	public function testCargarIdPaciente()
	{
		$all = $this->cita->Consultar('cargarIdPaciente', '14');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testConsultarOdontologo()
	{
		$all = $this->cita->Consultar('consultarOdontologo', '25630259');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testBuscarRegistroPaciente()
	{
		$all = $this->cita->Consultar('buscarRegistroPaciente', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testBuscarRegistroCita()
	{
		$all = $this->cita->Consultar('buscarRegistroCita', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testConsultarOdontologos()
	{
		$all = $this->cita->Consultar('consultarOdontologos', '21', '3');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testContadorCitas()
	{
		$all = $this->cita->Consultar('contadorCitas', '2023-12-06', '2', '3');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testVerificarIdPlanificacion()
	{
		$all = $this->cita->Consultar('verificarIdPlanificacion', '3', '2', '21');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testVerificarExistenciaCita()
	{
		$all = $this->cita->Consultar('verificarExistenciaCita', '2023-12-06', '1');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testverificarDiaSemana()
	{
		$all = $this->cita->Consultar('verificarDiaSemana', '3', '2', '21', '2');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testRegistrarCita()
	{
		$all = $this->cita->Registrarx('registrarCita', $this->cita);
		$this->assertEquals(true, $all);
	}
	public function testRegistrar()
	{
		$all = $this->cita->Registrar('registrarC', $this->cita);
		$this->assertEquals(true, $all);
	}
	public function testModificarCita()
	{
		$all = $this->cita->Modificar('modificarCita', $this->cita);
		$this->assertEquals(true, $all);
	}
	public function testEliminar()
	{
		$result = $this->cita->Eliminar('eliminar', '128');
		$this->assertEquals(true, $result);
	}
	
}
