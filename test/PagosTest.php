<?php

require_once 'modelsT/pagosModel.php';

use PHPUnit\Framework\TestCase;

class PagosTest extends TestCase
{
	private $pagos;
	/** @test **/
	public function setUp(): void
	{
		$this->pagos = new pagos_model([
			"id" => '2',
			"id_evolucion" => '19',
			'fecha' => '2023-12-10',
			'tipo' => 'Divisas (Dolares)',
			'tasa' => '35.25',
			'referencia' => 'AA122719A',
			'monto' => '150',
			'equivalente' => '20',
			'leyenda' => 'Pago'
		]);

		$this->assertEquals(true, true);
	}

	public function testList()
	{
		$all = $this->pagos->Consultar('listarPagos');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testEvolucion()
	{
		$all = $this->pagos->Consultar('extraerEvolucionCita', 'evolucion', '104');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testCita()
	{
		$all = $this->pagos->Consultar('extraerEvolucionCita', 'cita', '14');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListarStatus()
	{
		$all = $this->pagos->Consultar('listarStatus');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testlistarPagosPaciente()
	{
		$all = $this->pagos->Consultar('listarPagosPaciente', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testlistarCargarPagos()
	{
		$all = $this->pagos->Consultar('cargarPagos', '1');
		$result = is_object($all);
		$this->assertEquals(true, $result);
	}

	public function testRegistrarPagos()
	{
		$all = $this->pagos->Registrar('registrarPagos', $this->pagos);
		$this->assertEquals(true, $all);
	}
	public function testModificar()
	{
		$all = $this->pagos->Modificar('modificarPagos', $this->pagos);
		$this->assertEquals(true, $all);
	}
	public function testEliminar()
	{
		$all = $this->pagos->Eliminar('inhabilitarPagos', '6');
		$this->assertEquals(true, $all);
	}
}
