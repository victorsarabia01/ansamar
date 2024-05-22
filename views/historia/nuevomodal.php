
 <link rel="stylesheet" href="resources/css/select2.min.css">

 

    <link href="resources/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <style type="text/css">
  #permanente,#txt,#permanente1{
    display:none;
   
  }
  #decidua,#decidua1{
    display:none;
  }
  #controls,#dientegeneral2{
    display:none;
  }
  #dientegeneral3,#dientegeneral4{
	display:none;
  }
</style>

<!-- MODAL -->
<div class="modal fade" id="nuevoModal" tabindex="-1" aria-labelledby="nuevoModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog" style="min-width: 85%;">
    <!--Con el min-width manejo el ancho del modal -->
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="alert alert-success" role="alert"><h3>HISTORIA CLINICA </h3>
                         
                       
        </div>
       

	


		<input type="hidden" id="txtCodigoPaciente" name="txtCodigoPaciente" value="">
		<input type="hidden" id="txtCodigoProfesional" name="txtCodigoProfesional" value="">
		
          
	    <div> 	
			<h5 style="font-family:verdana;">Paciente:  </h5>
			<h5 style="font-family:verdana;">Cedula: </h5>
	
				
		</div>

	<br>
	
	<section id="seccionRegistrarTratamiento" class="textAlignLeft sombraFormulario">
			<section class="displayInlineBlockMiddle">
				<div class="dienteGeneral" id="dientegeneral1"><div id="DISTAL" onclick="seleccionarCara(this.id);"></div><div id="VESTIBULAR" onclick="seleccionarCara(this.id);"></div><div id="MESIAL" onclick="seleccionarCara(this.id);"></div><div id="PALATINO" onclick="seleccionarCara(this.id);"></div><div id="OCLUSAL" onclick="seleccionarCara(this.id);"></div><input type="text" id="txtIdentificadorDienteGeneral" name="txtIdentificadorDienteGeneral" value="DS1" readonly="readonly"></div>
				<div class="dienteGeneral" id="dientegeneral2"><div id="MESIAL" onclick="seleccionarCara(this.id);"></div><div id="VESTIBULAR" onclick="seleccionarCara(this.id);"></div><div id="DISTAL" onclick="seleccionarCara(this.id);"></div><div id="PALATINO" onclick="seleccionarCara(this.id);"></div><div id="OCLUSAL" onclick="seleccionarCara(this.id);"></div><input type="text" id="txtIdentificadorDienteGeneral" name="txtIdentificadorDienteGeneral" value="DS2" readonly="readonly"></div>
				<div class="dienteGeneral" id="dientegeneral3"><div id="MESIAL" onclick="seleccionarCara(this.id);"></div><div id="LINGUAL" onclick="seleccionarCara(this.id);"></div><div id="DISTAL" onclick="seleccionarCara(this.id);"></div><div id="VESTIBULAR" onclick="seleccionarCara(this.id);"></div><div id="OCLUSAL" onclick="seleccionarCara(this.id);"></div><input type="text" id="txtIdentificadorDienteGeneral" name="txtIdentificadorDienteGeneral" value="DI3" readonly="readonly"></div>
				<div class="dienteGeneral" id="dientegeneral4"><div id="DISTAL" onclick="seleccionarCara(this.id);"></div><div id="LINGUAL" onclick="seleccionarCara(this.id);"></div><div id="MESIAL" onclick="seleccionarCara(this.id);"></div><div id="VESTIBULAR" onclick="seleccionarCara(this.id);"></div><div id="OCLUSAL" onclick="seleccionarCara(this.id);"></div><input type="text" id="txtIdentificadorDienteGeneral" name="txtIdentificadorDienteGeneral" value="DI4" readonly="readonly"></div>
			</section>

			
			
			
			<section class="displayInlineBlockMiddle">
			
				<form class="formulario sombraFormulario labelPequenio" style="text-align: left;" method="post" name="test" action="index.php?c=historia&a=guardarhistoria">
					<div class="alert alert-success"><b>DETALLES OBSERVADOS</b> </div>
					<div class="contenidoInterno">
						<label ><b>DIENTE</b></label>
						<input type="text" id="txtDienteTratado" name="txtDienteTratado" class="textAlignCenter" size="4" readonly="readonly">
						<br>
						<label ><b>CARA</b></label>
						<input type="text" id="txtCaraTratada" name="txtCaraTratada" class="textAlignCenter" size="4" readonly="readonly">
						<br>
						<label for=""><b>ENFERMEDAD DENTAL</b></label>
						<select id="Estado" class="Estado" name="Estado">
							 <?php foreach ($this->mode->listarTodostratamiento()  as $k) : ?>
                                      <option value="<?php echo $k->id=$k->trabajo ?>"> <?php echo $k->trabajo ?></option>
									  
                                  <?php endforeach ?></select>  
								  <hr>

						<option value=""></option>


						<div class="seccionBotones">
							<button type="button" class="btn btn-outline-success" value="Agregar " onclick="agregarTratamiento($('#txtDienteTratado').val(), $('#txtCaraTratada').val(), $('#Estado').val());">
						Agregar</button>
						</div>
					</div>
				<!--/form-->
			</section>
			<section class="displayInlineBlockTop textAlignCenter" style="margin-left: 10px;width: 230px;">
				<div id="divTratamiento" class="displayInlineBlockTop sombraFormulario" style="width: 600px;height:150px;overflow-y: scroll;">
					<table id="tablaTratamiento" width="100%">
						<tbody></tbody>
					</table>
				</div>
				
			</section>
			<hr>
			<div>
				<section id="seccionPaginaAjax"></section>
			
				<button class="btn btn-outline-primary" href="javascript:void(0);" type="button" onclick="ocultarpermanente();"> Decidua</button>
                 	<button class="btn btn-outline-primary" type="button" onclick="ocultardecidua();"> Permanente</button>
				<button type="button"  class="btn btn-outline-primary"  onclick="prepararImpresion(); javascript:window.print(); terminarImpresion();">Imprimir Odontograma</button>
				<!--input type="button" href="?c=guardarhistoria" name="guardar" id="guardar"  class="btn btn-outline-primary"  value="Guardar Tratamientos" onclick="guardarTratamiento();"-->
				<button class="btn btn-outline-success"   href="?c=guardarhistoria" name="guardar" id="guardar" >Guadar</button>
             
			</div>

		</section>
		<hr>
		</form>
	<section>			
		<section style="width: 1342px;">
			
			<section id="seccionDientes" class="displayInlineBlockTop" style="padding: 10px;height: 300px;width: 911px;">
 
	<br>
<div id="odontogramaSuperior" class="textAlignCenter">
    <div class="" id="txt">
			<input type="text" id="txtD18" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD17" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD16" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD15" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD14" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD13" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD12" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD11" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		
		<input type="text" id="txtD21" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD22" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD23" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD24" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD25" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD26" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD27" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly">
		<input type="text" id="txtD28" class="textDiente" size="1" onmouseover="hoverTxtDiente(this.id);" onmouseout="outTxtDiente(this.id);" readonly="readonly"><hr><br>
		</div>
<div class="row">
		<div class="sup" id="permanente">

		<div class="diente" id="D18"><div id="D18-C1"></div><div id="D18-C2"></div><div id="D18-C3"></div><div id="D18-C4"></div><div id="D18-C5"></div><div onclick="seleccionarDiente('D18');dientegeneral1();">D18</div></div>
		<div class="diente" id="D17"><div id="D17-C1"></div><div id="D17-C2"></div><div id="D17-C3"></div><div id="D17-C4"></div><div id="D17-C5"></div><div onclick="seleccionarDiente('D17');dientegeneral1();">D17</div></div>
		<div class="diente" id="D16"><div id="D16-C1"></div><div id="D16-C2"></div><div id="D16-C3"></div><div id="D16-C4"></div><div id="D16-C5"></div><div onclick="seleccionarDiente('D16');dientegeneral1();">D16</div></div>
		<div class="diente" id="D15"><div id="D15-C1"></div><div id="D15-C2"></div><div id="D15-C3"></div><div id="D15-C4"></div><div id="D15-C5"></div><div onclick="seleccionarDiente('D15');dientegeneral1();">D15</div></div>
		<div class="diente" id="D14"><div id="D14-C1"></div><div id="D14-C2"></div><div id="D14-C3"></div><div id="D14-C4"></div><div id="D14-C5"></div><div onclick="seleccionarDiente('D14');dientegeneral1();">D14</div></div>
		<div class="diente" id="D13"><div id="D13-C1"></div><div id="D13-C2"></div><div id="D13-C3"></div><div id="D13-C4"></div><div id="D13-C5"></div><div onclick="seleccionarDiente('D13');dientegeneral1();">D13</div></div>
		<div class="diente" id="D12"><div id="D12-C1"></div><div id="D12-C2"></div><div id="D12-C3"></div><div id="D12-C4"></div><div id="D12-C5"></div><div onclick="seleccionarDiente('D12');dientegeneral1();">D12</div></div>
		<div class="diente" id="D11"><div id="D11-C1"></div><div id="D11-C2"></div><div id="D11-C3"></div><div id="D11-C4"></div><div id="D11-C5"></div><div onclick="seleccionarDiente('D11');dientegeneral1();">D11</div></div>
    |-|
		<div class="diente" id="D21"><div id="D21-C1"></div><div id="D21-C2"></div><div id="D21-C3"></div><div id="D21-C4"></div><div id="D21-C5"></div><div onclick="seleccionarDiente('D21');dientegeneral2();">D21</div></div>
		<div class="diente" id="D22"><div id="D22-C1"></div><div id="D22-C2"></div><div id="D22-C3"></div><div id="D22-C4"></div><div id="D22-C5"></div><div onclick="seleccionarDiente('D22');dientegeneral2();">D22</div></div>
		<div class="diente" id="D23"><div id="D23-C1"></div><div id="D23-C2"></div><div id="D23-C3"></div><div id="D23-C4"></div><div id="D23-C5"></div><div onclick="seleccionarDiente('D23');dientegeneral2();">D23</div></div>
		<div class="diente" id="D24"><div id="D24-C1"></div><div id="D24-C2"></div><div id="D24-C3"></div><div id="D24-C4"></div><div id="D24-C5"></div><div onclick="seleccionarDiente('D24');dientegeneral2();">D24</div></div>
		<div class="diente" id="D25"><div id="D25-C1"></div><div id="D25-C2"></div><div id="D25-C3"></div><div id="D25-C4"></div><div id="D25-C5"></div><div onclick="seleccionarDiente('D25');dientegeneral2();">D25</div></div>
		<div class="diente" id="D26"><div id="D26-C1"></div><div id="D26-C2"></div><div id="D26-C3"></div><div id="D26-C4"></div><div id="D26-C5"></div><div onclick="seleccionarDiente('D26');dientegeneral2();">D26</div></div>
		<div class="diente" id="D27"><div id="D27-C1"></div><div id="D27-C2"></div><div id="D27-C3"></div><div id="D27-C4"></div><div id="D27-C5"></div><div onclick="seleccionarDiente('D27');dientegeneral2();">D27</div></div>
		<div class="diente" id="D28"><div id="D28-C1"></div><div id="D28-C2"></div><div id="D28-C3"></div><div id="D28-C4"></div><div id="D28-C5"></div><div onclick="seleccionarDiente('D28');dientegeneral2();">D28</div></div><br><br><br><hr><br>
		<br><br>
	
		<div class="diente" id="D48"><div id="D48-C1"></div><div id="D48-C2"></div><div id="D48-C3"></div><div id="D48-C4"></div><div id="D48-C5"></div><div onclick="seleccionarDiente('D48');dientegeneral4();">D48</div></div>
		<div class="diente" id="D47"><div id="D47-C1"></div><div id="D47-C2"></div><div id="D47-C3"></div><div id="D47-C4"></div><div id="D47-C5"></div><div onclick="seleccionarDiente('D47');dientegeneral4();">D47</div></div>
		<div class="diente" id="D46"><div id="D46-C1"></div><div id="D46-C2"></div><div id="D46-C3"></div><div id="D46-C4"></div><div id="D46-C5"></div><div onclick="seleccionarDiente('D46');dientegeneral4();">D46</div></div>
		<div class="diente" id="D45"><div id="D45-C1"></div><div id="D45-C2"></div><div id="D45-C3"></div><div id="D45-C4"></div><div id="D45-C5"></div><div onclick="seleccionarDiente('D45');dientegeneral4();">D45</div></div>
		<div class="diente" id="D44"><div id="D44-C1"></div><div id="D44-C2"></div><div id="D44-C3"></div><div id="D44-C4"></div><div id="D44-C5"></div><div onclick="seleccionarDiente('D44');dientegeneral4();">D44</div></div>
		<div class="diente" id="D43"><div id="D43-C1"></div><div id="D43-C2"></div><div id="D43-C3"></div><div id="D43-C4"></div><div id="D43-C5"></div><div onclick="seleccionarDiente('D43');dientegeneral4();">D43</div></div>
		<div class="diente" id="D42"><div id="D42-C1"></div><div id="D42-C2"></div><div id="D42-C3"></div><div id="D42-C4"></div><div id="D42-C5"></div><div onclick="seleccionarDiente('D42');dientegeneral4();">D42</div></div>
		<div class="diente" id="D41"><div id="D41-C1"></div><div id="D41-C2"></div><div id="D41-C3"></div><div id="D41-C4"></div><div id="D41-C5"></div><div onclick="seleccionarDiente('D41');dientegeneral4();">D41</div></div>
		|-|
		<div class="diente" id="D31"><div id="D31-C1"></div><div id="D31-C2"></div><div id="D31-C3"></div><div id="D31-C4"></div><div id="D31-C5"></div><div onclick="seleccionarDiente('D31');dientegeneral4();">D31</div></div>
		<div class="diente" id="D32"><div id="D32-C1"></div><div id="D32-C2"></div><div id="D32-C3"></div><div id="D32-C4"></div><div id="D32-C5"></div><div onclick="seleccionarDiente('D32');dientegeneral4();">D32</div></div>
		<div class="diente" id="D33"><div id="D33-C1"></div><div id="D33-C2"></div><div id="D33-C3"></div><div id="D33-C4"></div><div id="D33-C5"></div><div onclick="seleccionarDiente('D33');dientegeneral4();">D33</div></div>
		<div class="diente" id="D34"><div id="D34-C1"></div><div id="D34-C2"></div><div id="D34-C3"></div><div id="D34-C4"></div><div id="D34-C5"></div><div onclick="seleccionarDiente('D34');dientegeneral4();">D34</div></div>
		<div class="diente" id="D35"><div id="D35-C1"></div><div id="D35-C2"></div><div id="D35-C3"></div><div id="D35-C4"></div><div id="D35-C5"></div><div onclick="seleccionarDiente('D35');dientegeneral4();">D35</div></div>
		<div class="diente" id="D36"><div id="D36-C1"></div><div id="D36-C2"></div><div id="D36-C3"></div><div id="D36-C4"></div><div id="D36-C5"></div><div onclick="seleccionarDiente('D36');dientegeneral4();">D36</div></div>
		<div class="diente" id="D37"><div id="D37-C1"></div><div id="D37-C2"></div><div id="D37-C3"></div><div id="D37-C4"></div><div id="D37-C5"></div><div onclick="seleccionarDiente('D37');dientegeneral4();">D37</div></div>
		<div class="diente" id="D38"><div id="D38-C1"></div><div id="D38-C2"></div><div id="D38-C3"></div><div id="D38-C4"></div><div id="D38-C5"></div><div onclick="seleccionarDiente('D38');dientegeneral4();">D38</div></div><br><br><br><hr>
		</div>
		</div>

	  <div class="row">
	  <div class="decidua" id="decidua">
		<div class="diente" id="D55"><div id="D55-C1"></div><div id="D55-C2"></div><div id="D55-C3"></div><div id="D55-C4"></div><div id="D55-C5"></div><div onclick="seleccionarDiente('D55');dientegeneral1();">D55</div></div>
		<div class="diente" id="D54"><div id="D54-C1"></div><div id="D54-C2"></div><div id="D54-C3"></div><div id="D54-C4"></div><div id="D54-C5"></div><div onclick="seleccionarDiente('D54');dientegeneral1();">D54</div></div>
		<div class="diente" id="D53"><div id="D53-C1"></div><div id="D53-C2"></div><div id="D53-C3"></div><div id="D53-C4"></div><div id="D53-C5"></div><div onclick="seleccionarDiente('D53');dientegeneral1();">D53</div></div>
		<div class="diente" id="D52"><div id="D52-C1"></div><div id="D52-C2"></div><div id="D52-C3"></div><div id="D52-C4"></div><div id="D52-C5"></div><div onclick="seleccionarDiente('D52');dientegeneral1();">D52</div></div>
		<div class="diente" id="D51"><div id="D51-C1"></div><div id="D51-C2"></div><div id="D51-C3"></div><div id="D51-C4"></div><div id="D51-C5"></div><div onclick="seleccionarDiente('D51');dientegeneral1();">D51</div></div>
		|-|
		<div class="diente" id="D61"><div id="D61-C1"></div><div id="D61-C2"></div><div id="D61-C3"></div><div id="D61-C4"></div><div id="D61-C5"></div><div onclick="seleccionarDiente('D61');dientegeneral2();">D61</div></div>
		<div class="diente" id="D62"><div id="D62-C1"></div><div id="D62-C2"></div><div id="D62-C3"></div><div id="D62-C4"></div><div id="D62-C5"></div><div onclick="seleccionarDiente('D62');dientegeneral2();">D62</div></div>
		<div class="diente" id="D63"><div id="D63-C1"></div><div id="D63-C2"></div><div id="D63-C3"></div><div id="D63-C4"></div><div id="D63-C5"></div><div onclick="seleccionarDiente('D63');dientegeneral2();">D63</div></div>
		<div class="diente" id="D64"><div id="D64-C1"></div><div id="D64-C2"></div><div id="D64-C3"></div><div id="D64-C4"></div><div id="D64-C5"></div><div onclick="seleccionarDiente('D64');dientegeneral2();">D64</div></div>
		<div class="diente" id="D65"><div id="D65-C1"></div><div id="D65-C2"></div><div id="D65-C3"></div><div id="D65-C4"></div><div id="D65-C5"></div><div onclick="seleccionarDiente('D65');dientegeneral2();">D65</div></div>
	    <br>
		<br>
<br>
<br>
<br>
		<div class="diente" id="D85"><div id="D85-C1"></div><div id="D85-C2"></div><div id="D85-C3"></div><div id="D85-C4"></div><div id="D85-C5"></div><div onclick="seleccionarDiente('D85');dientegeneral4();">D85</div></div>
		<div class="diente" id="D84"><div id="D84-C1"></div><div id="D84-C2"></div><div id="D84-C3"></div><div id="D84-C4"></div><div id="D84-C5"></div><div onclick="seleccionarDiente('D84');dientegeneral4();">D84</div></div>
		<div class="diente" id="D83"><div id="D83-C1"></div><div id="D83-C2"></div><div id="D83-C3"></div><div id="D83-C4"></div><div id="D83-C5"></div><div onclick="seleccionarDiente('D83');dientegeneral4();">D83</div></div>
		<div class="diente" id="D82"><div id="D82-C1"></div><div id="D82-C2"></div><div id="D82-C3"></div><div id="D82-C4"></div><div id="D82-C5"></div><div onclick="seleccionarDiente('D82');dientegeneral4();">D82</div></div>
		<div class="diente" id="D81"><div id="D81-C1"></div><div id="D81-C2"></div><div id="D81-C3"></div><div id="D81-C4"></div><div id="D81-C5"></div><div onclick="seleccionarDiente('D81');dientegeneral4();">D81</div></div>
		|-|
		<div class="diente" id="D71"><div id="D71-C1"></div><div id="D71-C2"></div><div id="D71-C3"></div><div id="D71-C4"></div><div id="D71-C5"></div><div onclick="seleccionarDiente('D71');">D71</div></div>
		<div class="diente" id="D72"><div id="D72-C1"></div><div id="D72-C2"></div><div id="D72-C3"></div><div id="D72-C4"></div><div id="D72-C5"></div><div onclick="seleccionarDiente('D72');">D72</div></div>
		<div class="diente" id="D73"><div id="D73-C1"></div><div id="D73-C2"></div><div id="D73-C3"></div><div id="D73-C4"></div><div id="D73-C5"></div><div onclick="seleccionarDiente('D73');">D73</div></div>
		<div class="diente" id="D74"><div id="D74-C1"></div><div id="D74-C2"></div><div id="D74-C3"></div><div id="D74-C4"></div><div id="D74-C5"></div><div onclick="seleccionarDiente('D74');">D74</div></div>
		<div class="diente" id="D75"><div id="D75-C1"></div><div id="D75-C2"></div><div id="D75-C3"></div><div id="D75-C4"></div><div id="D75-C5"></div><div onclick="seleccionarDiente('D75');">D75</div></div><br><br><br><hr>
    </div>

 
  </div>
  
</div>



</section>	
			<section id="seccionTablaTratamientos" style="height: 320px;overflow-y: scroll;width: 400px;" class="displayInlineBlockTop sombraFormulario">
			<table class="table">
	<thead>
		<th>Numero de Tratamiento</th>
		<th>DESCRIPCIÓN</th>
		<th class="widthDetalleTable">FECHA REGISTRO</th>
		<th class="widthDetalleTable"></th>
		<th class="widthDetalleTable"></th>
	</thead>
	<tbody style="font-size: 13px;">
		
			<tr>
				<td></td>
				<td></td>
				<td><input id="" type="button" class="btn btn-outline-success" value="Ver Detalle" onclick="cargarDientes('seccionDientes', 'dientes.php', this.id);"></td>
				<td id="realizado"><input id="" type="button" class="btn btn-outline-success" id="realizado" name="realizado"  value="Realizado" onclick="eliminar(this.id);"></td>
			</tr>
		
	</tbody>
</table>
		</section>

		</section>

		<br><br>
		
	</section>
	

	<script src="resources/js/jsTratamiento.js"></script>
<script type="">
	$(document).ready(function() {
			$('#cbxEstado').select2({
    			sorter: function(data) {
    			return data.sort(function(a, b) {
        		return a.text < b.text ? -1 : a.text > b.text ? 1 : 0;
    								});
				}
				});

});	
</script>

<!--COMENTADO 01-02-2024-->
<!--<script type="text/javascript">
	$(document).ready(function() {
			recargarLista();
			$('#cbxEstado').change(function(){
				recargarLista();
			});

});	
</script>
<script type="text/javascript">
	functionrecargarLista(){
		$.ajax({
			type:"POST",
			url:"historiaModel.php",
			dat:"reparaciones=" +$('#cbxEstado').val(),
			success:function(r){
				$('#cbxreparacion').html(r);
			}
		});
	}
			

</script>-->
<script type="text/javascript">
     function ocultardecidua() {
       document.getElementById("permanente").style.display = 'block';
       document.getElementById("decidua").style.display = 'none';
	   document.getElementById("permanente1").style.display = 'block';
 }
 function ocultarpermanente() {
       document.getElementById("permanente").style.display = 'none';
       document.getElementById("decidua").style.display = 'block';
	   document.getElementById("decidua1").style.display = 'block';
 }
 function dientegeneral2() {
       document.getElementById("dientegeneral2").style.display = 'block';
       document.getElementById("dientegeneral3").style.display = 'none';
	   document.getElementById("dientegeneral4").style.display = 'none';
	   document.getElementById("dientegeneral1").style.display = 'none';
 }
 function dientegeneral3() {
       document.getElementById("dientegeneral2").style.display = 'none';
       document.getElementById("dientegeneral3").style.display = 'block';
	   document.getElementById("dientegeneral4").style.display = 'none';
	   document.getElementById("dientegeneral1").style.display = 'none';
 }
 function dientegeneral4() {
       document.getElementById("dientegeneral2").style.display = 'none';
       document.getElementById("dientegeneral3").style.display = 'none';
	   document.getElementById("dientegeneral4").style.display = 'block';
	   document.getElementById("dientegeneral1").style.display = 'none';
 }
 function dientegeneral1() {
       document.getElementById("dientegeneral2").style.display = 'none';
       document.getElementById("dientegeneral3").style.display = 'none';
	   document.getElementById("dientegeneral4").style.display = 'none';
	   document.getElementById("dientegeneral1").style.display = 'block';
 }
 </script>
