function hoverTxtDiente(idTxtDiente)
{
	var idDiente=idTxtDiente.substring(3, 6);
	var css=
	{
		"box-shadow": "0px 0px 10px blue"
	}
	$("#"+idDiente).css(css);
}

function outTxtDiente(idTxtDiente)
{
	var idDiente=idTxtDiente.substring(3, 6);
	var css=
	{
		"box-shadow": "none"
	}
	$("#"+idDiente).css(css);
}



function seleccionarCara(idCaraDiente)
{
	$("#txtCaraTratada").val(idCaraDiente);
}

function seleccionarDiente(idDiente)
{
	$("#txtIdentificadorDienteGeneral").val(idDiente);
	$("#txtDienteTratado").val(idDiente);
}

var indexEnfermedad=2;
var indexServicio=3;
var indexPrecio=4;

function agregarTratamiento(diente, cara, estado, servicio)
{
	if(diente=="" || cara=="")
	{
		alert("Debe seleccionar el diente y la cara de dicho diente para agregar un Tratamiento");
		return;
	}

	var agregarFila=true;

	$("#tablaTratamiento").find("tr").each(function(index, elemento) 
	{
		var dienteAsignado;

		if(!agregarFila)
		{
			return false;
		}
		// console.log($("#tablaTratamiento"));
		var enfermedades = [];
		var servicios = [];
		var num = $("#tablaTratamiento > tbody > tr").length;
		var numeroChild = $("#tablaTratamiento > tbody")[0]['children'];
		for (var i = 0; i < numeroChild.length; i++){
			var numeroChildChil = numeroChild[i]['children'];
			for (var j = 0; j < numeroChildChil.length; j++) {
				var numeroChildChildChild = numeroChildChil[j]['children'][0];
				var className = numeroChildChildChild['classList'][0];
				// console.log($("."+className).val());
				if(j==indexEnfermedad){
					var className = numeroChildChildChild['classList'][0];
					// console.log(numeroChildChil);
					enfermedades.push($("."+className).val());
				}
				if(j==indexServicio){
					var className = numeroChildChildChild['classList'][0];
					// console.log(numeroChildChil);
					servicios.push($("."+className).val());
				}

			}
		}
		var posEl = servicio.indexOf(" ($");
		var newS = servicio.substring(0, posEl);
		for(var z = 0; z<enfermedades.length; z++){
			if(enfermedades[z]==estado && servicios[z]==newS){
				alert("El tratamiento ya fue asignado");
				agregarFila=false;
			}
		}

		// $(elemento).find("td").each(function(index2, elemento2)
		// {
		// 	if(index2==0)
		// 	{
		// 		dienteAsignado=$(elemento2).text();
		// 	}
		// 	// console.log(index2);
		// 	var partesEstado2;
		// 	if(index2==2){
		// 		partesEstado2=$(elemento2).text().split("-");
		// 		console.log("partesEstado2");
		// 		console.log(partesEstado2[0]);
		// 	}
		// 	var partesEstado3;
		// 	if(index2==3){
		// 		partesEstado3=$(elemento2).text().split("-");
		// 		var posEl = servicio.indexOf(" ($");
		// 		var newS = servicio.substring(0, posEl);
		// 		console.log("partesEstado3");
		// 		console.log(partesEstado3[0]);

		// 		console.log(partesEstado2[0]);
		// 		console.log(estado);
		// 		console.log(partesEstado3[0]);
		// 		console.log(newS);
		// 		console.log(" ----------- ------------------ ");
		// 	}

        // 	// // switch(index2)
        // 	// // {
        // 	// // 	case 3:
        // 	// // 		var partesEstado=$(elemento2).text().split("-");
        // 	// // 		var posEl = servicio.indexOf(" ($");
        // 	// // 		var newS = servicio.substring(0, posEl);
        // 	// // 		console.log("");
        // 	// // 		console.log($(elemento).find("td"));
        // 	// // 		console.log("");
        // 	// // 		console.log("NEW Servicio ");
        // 	// // 		console.log(newS);
        // 	// // 		console.log("");
        // 	// // 		console.log(" ----------- ------------------ ");

        // 	// // 		if(partesEstado[0]==newS){
        // 	// // 			alert("El tratamiento ya fue asignado");
        // 	// // 			agregarFila=false;
        // 	// // 		}
        // 	// // 		break;
        // 	// // }
        // });
    });

	if(agregarFila)
	{
		var num = $("#tablaTratamiento > tbody > tr").length;
		num = num + 1;
		var posElement = servicio.indexOf(" ($");
		// alert(posElement);
		var newServicio = servicio.substring(0, posElement);
		var newPrecio = servicio.substring(posElement+2, servicio.indexOf(")"));
		// alert(newServicio);
		// alert(newPrecio);
		var filaHtml="";
		filaHtml+="<tr>";
		filaHtml+="<td><input type='hidden' class='diente"+num+"' name='dientes[]' value='"+diente+"'>"+diente+"</td>";
		filaHtml+="<td><input type='hidden' class='cara"+num+"' name='caras[]' value='"+cara+"'>"+cara+"</td>";
		filaHtml+="<td><input type='hidden' class='estado"+num+"' name='enfermedades[]' value='"+estado+"'>"+estado+"</td>";
		filaHtml+="<td><input type='hidden' class='servicios"+num+"' name='servicios[]' value='"+newServicio+"'>"+newServicio+"</td>";
		filaHtml+="<td><input type='hidden' class='precio"+num+"' name='precios[]' value='"+newPrecio+"'>"+newPrecio+"</td>";
		filaHtml+="</td><td class='widthEditarTable'><input type='button' class='button2' value='Eliminar' onclick='quitarTratamiento(this);'></td>";
		filaHtml+="</tr>";
		// console.log(filaHtml);
		$("#tablaTratamiento > tbody").append(filaHtml);
		$("#divTratamiento").scrollTop($("#tablaTratamiento").height());
		
		var precios = [];
		var numeroChild = $("#tablaTratamiento > tbody")[0]['children'];
		for (var i = 0; i < numeroChild.length; i++){
			var numeroChildChil = numeroChild[i]['children'];
			for (var j = 0; j < numeroChildChil.length; j++) {
				var numeroChildChildChild = numeroChildChil[j]['children'][0];
				if(j==indexPrecio){
					var className = numeroChildChildChild['classList'][0];
					// console.log(numeroChildChil);
					precios.push($("."+className).val());
				}
			}
		}
		var totalPrecio = 0;
		for (var i = 0; i < precios.length; i++) {
			var prec = precios[i];
			var nprec = prec.substring(1);
			var nPosPrec = nprec.indexOf(",");
			var prec1 = nprec.substring(0, nPosPrec);
			var prec2 = nprec.substring(nPosPrec+1);
			var precf = prec1+"."+prec2;
			// var precioFinal = parseFloat(precf);
			totalPrecio += parseFloat(precf);
		}
		var tPrecio = totalPrecio.toString();
		var nPosPrec = tPrecio.indexOf(".");
		if(nPosPrec!= -1){
			var prec1 = tPrecio.substring(0, nPosPrec);
			var prec2 = tPrecio.substring(nPosPrec+1);
			var precf = prec1+","+prec2;
			precf = precf+"0";
		}else{
			var precf = tPrecio+",00";
		}
		// console.log(totalPrecio);
		// console.log(tPrecio);
		// console.log(precf);
		$("#presupuestoValor").html(precf);
	}
}

function quitarTratamiento(elemento)
{
	$(elemento).parent().parent().remove();
	var precios = [];
		var numeroChild = $("#tablaTratamiento > tbody")[0]['children'];
		for (var i = 0; i < numeroChild.length; i++){
			var numeroChildChil = numeroChild[i]['children'];
			for (var j = 0; j < numeroChildChil.length; j++) {
				var numeroChildChildChild = numeroChildChil[j]['children'][0];
				if(j==indexPrecio){
					var className = numeroChildChildChild['classList'][0];
					precios.push($("."+className).val());
				}
			}
		}
		var totalPrecio = 0;
		for (var i = 0; i < precios.length; i++) {
			var prec = precios[i];
			var nprec = prec.substring(1);
			var nPosPrec = nprec.indexOf(",");
			var prec1 = nprec.substring(0, nPosPrec);
			var prec2 = nprec.substring(nPosPrec+1);
			var precf = prec1+"."+prec2;
			// var precioFinal = parseFloat(precf);
			totalPrecio += parseFloat(precf);
		}
		var tPrecio = totalPrecio.toString();
		var nPosPrec = tPrecio.indexOf(".");
		if(nPosPrec!= -1){
			var prec1 = tPrecio.substring(0, nPosPrec);
			var prec2 = tPrecio.substring(nPosPrec+1);
			var precf = prec1+","+prec2;
			precf = precf+"0";
		}else{
			var precf = tPrecio+",00";
		}
		// console.log(totalPrecio);
		// console.log(tPrecio);
		// console.log(precf);
		$("#presupuestoValor").html(precf);
}

function recuperarDatosTratamiento(callback)
{
	var codigoPaciente;
	var codigoProfesional;
	var estados="";
	var descripcion;

	codigoPaciente=$("#txtCodigoPaciente").val();
	codigoProfesional=$("#txtCodigoProfesional").val();

	$("#tablaTratamiento").find("tr").each(function(index, elemento) 
    {
        $(elemento).find("td").each(function(index2, elemento2)
        {
        	estados+=$(elemento2).text()+"_";
        });
    });

    descripcion=$("#txtDescripcion").val();
    estados=estados.substring(0, estados.length-2);

    callback(codigoPaciente, codigoProfesional, estados, descripcion);
}

function guardarTratamiento()
{
	recuperarDatosTratamiento(function(codigoPaciente, codigoProfesional, estados, descripcion)
	{
		if(estados=="")
		{
			alert("Ud. debe agregar algún Tratamiento");
			return;
		}
		$.post("registrar.php",
	    {
	    	codigoPaciente: codigoPaciente,
	    	codigoProfesional: codigoProfesional,
	    	estados: estados,
	    	descripcion: descripcion
	    }, 
	    function(pagina)
	    {
	    	limpiarDatosTratamiento();
	    	$("#seccionPaginaAjax").html(pagina);
	    	setTimeout(function()
	    	{
	    		$("#seccionPaginaAjax").html("");
	    	}, 7000);
	    }).done(function(){
	    	cargarTratamientos('seccionTablaTratamientos', 'verodontograma.php', codigoPaciente); 
	    	cargarDientes('seccionDientes', 'dientes.php', '', codigoPaciente);
	    });

	});
}

function limpiarDatosTratamiento()
{
	$("#txtIdentificadorDienteGeneral").val("DXX");
	$("#txtDienteTratado").val("");
	$("#txtCaraTratada").val("");
	$("#txtDescripcion").val("");
	$("#tablaTratamiento").find("tr").each(function(index, row)
	{
		$(row).remove();
	});
}

function cargarDientes(idSeccion, url, estados, codigoPaciente)
{
	$.ajax(
    {
        url: url,
        type: "POST",
        data: {codigoPaciente: codigoPaciente, estados: estados},
        cache: true
    }).done(function(pagina) 
    {
        $("#"+idSeccion).html(pagina);
    });
}

function cargarTratamientos(idSeccion, url, codigoPaciente)
{
	$.ajax(
    {
        url: url,
        type: "POST",
        data: {codigoPaciente: codigoPaciente},
        cache: true
    }).done(function(pagina) 
    {
        $("#"+idSeccion).html(pagina);
    });
}

function prepararImpresion()
{
	$("body #seccionTablaTratamientos").css({"display": "none"});
	$("body #seccionRegistrarTratamiento").css({"display": "none"});
}

function terminarImpresion()
{
	$("body #seccionTablaTratamientos").css({"display": "inline-block"});
	$("body #seccionRegistrarTratamiento").css({"display": "inline-block"});
}