<?php
require_once 'modelsT/historiaModel.php';
use PHPUnit\Framework\TestCase;

class HistoriaTest extends TestCase
{
	private $historia;
	/** @test **/

	public function setUp(): void
	{
		$this->historia = new historia_model([
			"id_historia" => '60',
			"id_servicio" => '14',
			"id_cita" => '117',
			'id_enfermedad' => '5',
			'fecha' => '2023-12-10',
			'diente' => 'D14',
			'cara' => 'Distal',
			'presupuesto' => '20',
			'id_evolucion' => '16',
			'id_insumo' => '3',
			'cantidad' => '2',
			'evolucion' => 'Mejoria',
			'observacion' => 'En observacion',
			'indicacion' => 'Ibuprofeno',
			'id_detalle' => '20', 
			'newUsada' => '3',
			'id_evInsumo' => '4'
		]);
		

		$this->assertEquals(true, true);
	}

	public function testList()
	{
		$all = $this->historia->Consultar('listarhistoria');
		// var_dump($all);
		$result = is_array($all);
		// var_dump($result);
		$this->assertEquals(true, $result);
	}
	public function testListEnfermedades()
	{
		$all = $this->historia->Consultar('listarTodasEnfermedades');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListServicios()
	{
		$all = $this->historia->Consultar('listarTodosServicios');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testValidarCedula()
	{
		$all = $this->historia->Consultar('validarCedula', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testBuscarCitaPaciente()
	{
		$all = $this->historia->Consultar('BuscarCitaPaciente', '2023-12-06');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testBuscarPacienteCita()
	{
		$all = $this->historia->Consultar('BuscarPacienteCita', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testHistoriaPaciente()
	{
		$all = $this->historia->Consultar('BuscarHistoriaPaciente', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testInsumosAsignado()
	{
		$all = $this->historia->Consultar('BuscarInsumosAsignado', '1');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testEvolucionPaciente()
	{
		$all = $this->historia->Consultar('BuscarEvolucionPaciente', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testEvolucionParaInsumos()
	{
		$all = $this->historia->Consultar('ExtraerEvolucionParaInsumos', '14');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testValidarServicios()
	{
		$all = $this->historia->Consultar('ValidarServicios', 'Resina');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testValidarEnfermedad()
	{
		$all = $this->historia->Consultar('ValidarEnfermedad', 'Fractura');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testValidarPaciente()
	{
		$all = $this->historia->Consultar('ValidarPaciente', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testValidarCita()
	{
		$all = $this->historia->Consultar('ValidarCita', '103');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testCondicionMedica()
	{
		$all = $this->historia->Consultar('listarCondicionMedicaPaciente', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testEnfermedadesCita()
	{
		$all = $this->historia->Consultar('listarEnfermedadesCita', '103');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testlistarTodosInsumos()
	{
		$all = $this->historia->Consultar('listarTodosInsumos', '1');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testListarInsumosEvolucion()
	{
		$all = $this->historia->Consultar('listarInsumosEvolucion', '14');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testConsultarInsumosEvolucion()
	{
		$all = $this->historia->Consultar('ConsultarInsumosEvolucion', '14');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testHistoriaOdontograma()
	{
		$all = $this->historia->Consultar('listarHistoriaOdontograma', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testHistoriaServicios()
	{
		$all = $this->historia->Consultar('listarHistoriaServicios', '22186490');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testValidarInsumosEvolucion()
	{
		$all = $this->historia->Consultar('ValidarInsumosEvolucion', '14', '1');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testValidarHistoriaServicio()
	{
		$all = $this->historia->Consultar('ValidarHistoriaServicio', '57', '6');
		$result = is_array($all);
		$this->assertEquals(true, $result);
	}
	public function testRegistrar()
	{
		$all = $this->historia->Registrar('registrarHistoria', $this->historia);
		$this->assertEquals(true, $all);
	}
	public function testRegistrarHistoriaServicio()
	{
		$all = $this->historia->Registrar('registrarHistoriaServicio', $this->historia);
		$this->assertEquals(true, $all);
	}
	public function testRegistrarEvolucionInsumo()
	{
		$all = $this->historia->Registrar('registrarEvolucionInsumo', $this->historia);
		$this->assertEquals(true, $all);
	}
	public function testActualizarHistoriaServicio()
	{
		$all = $this->historia->Modificar('actualizarHistoriaServicio', $this->historia);
		$this->assertEquals(true, $all);
	}
	public function testActualizarAsignacionInsumo()
	{
		$all = $this->historia->Modificar('actualizarAsignacionInsumo', $this->historia);
		$this->assertEquals(true, $all);
	}
	public function testActualizarEvolucionInsumo()
	{
		$all = $this->historia->Modificar('actualizarEvolucionInsumo', $this->historia);
		$this->assertEquals(true, $all);
	}
	public function testEliminarServicio()
	{
		$all = $this->historia->Eliminar('eliminarServicio', '19');
		$this->assertEquals(true, $all);
	}
	
}
