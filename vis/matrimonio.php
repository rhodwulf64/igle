<?php


  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}

	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");

	$LoadEjecuta="";
	if (!empty($_GET["matriRef"]))
	{
		$LoadEjecuta="ejecutaPrimero();";
	}
	$loFuncion = new clsFunciones;
	echo utf8_Decode('

<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Inscripción de Matrimonio</title>
		');
			print(encabezado_menu("../"));

	echo utf8_Decode('
		</head>
		<body onload="fpInicio();'.$LoadEjecuta.'">
		<div class="mygrid-wrapper-div">
	<div class="container pre-scrollable" style="margin-top:5px; min-height: 530px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">
	<div id="mascara" onclick="salir();"></div>
		<div class="modal-dialog" id="buscador">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="salir();" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Buscador</h4>
            </div>
            <div class="modal-body pre-scrollable">
				<table>
					<tr>
						<td><input type="text" onkeyup="buscar_like(this);" class="form-control" style="width:640px;" placeholder="Ingrese una palabra clave..." name="txtbuscador" id="txtbuscador"/></td>
					</tr>
				</table>
				<br>
				<table id="cargar" class="table table-striped table-bordered table-hover" style="width:640px;"></table>
          	 </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="salir();">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
		');
		encab("../");
		menu_general("");
		
echo utf8_Decode('
	
	<form name="fr_matrimonio" id="fr_matrimonio" action="../con/cn_matrimonio.php" method="post">
		<div class="col-lg-12">
			<input type="hidden" id="temporal"/>
				<table class="table table-striped table-bordered table-hover"  border="1" >
					<thead>		
						<tr>
							<th colspan="2"><center><div class="alert alert-info" id="divf_cambiaMatri"><font id="ntf_cambiaMatri" onclick="accionEstados(this.id)">Inscripción del Matrimonio</font><br><i id="CargaReporteIco" style="display:none;" class="fa fa-circle-o-notch fa-spin"></i></div></center></th>
						</tr>
					</thead>
				<tr>
					<th><div class="form-group has-default" id="haf_cedunovia"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label" id="ntf_EncontroNovia"></font><font class="control-label" id="TituNovia"></font><input type="text" id="f_cedunovia" name="f_cedunovia" class="form-control" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id); fpPerderFocus(this);" placeholder="V-99999999" value=""><div class="tool-tip  slideIn" id="ttipf_cedunovia" style="display:none;"></div></div></div></th>
					<th><div class="form-group has-default" id="haf_cedunovio"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label" id="ntf_EncontroNovio"></font><font class="control-label" id="TituNovio"></font><input type="text" id="f_cedunovio" name="f_cedunovio" class="form-control" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id); fpPerderFocus(this);" placeholder="V-99999999" value=""><div class="tool-tip  slideIn" id="ttipf_cedunovio" style="display:none;"></div></div></div></th>
				</tr>
				<tr>
					<th><div class="form-group has-default" id="haf_ceduPadres1"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Madre de la Novia:</font><font class="control-label" id="ntf_EncontroPadre1"></font><input type="text" id="f_ceduPadres1" name="f_ceduPadres1" class="form-control" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id);" placeholder="V-99999999" value=""><div class="tool-tip  slideIn" id="ttipf_ceduPadres1" style="display:none;"></div></div></div></th>
					<th><div class="form-group has-default" id="haf_ceduPadres3"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Madre del Novio:</font><font class="control-label" id="ntf_EncontroPadre3"></font><input type="text" id="f_ceduPadres3" name="f_ceduPadres3" class="form-control" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id);" placeholder="V-99999999" value=""><div class="tool-tip  slideIn" id="ttipf_ceduPadres3" style="display:none;"></div></div></div></th>
				</tr>
				<tr>
					<th><div class="form-group has-default" id="haf_ceduPadres2"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Padre de la Novia:</font><font class="control-label" id="ntf_EncontroPadre2"></font><input type="text" id="f_ceduPadres2" name="f_ceduPadres2" class="form-control" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id);" placeholder="V-99999999" value=""><div class="tool-tip  slideIn" id="ttipf_ceduPadres2" style="display:none;"></div></div></div></th>
					<th><div class="form-group has-default" id="haf_ceduPadres4"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Padre del Novio:</font><font class="control-label" id="ntf_EncontroPadre4"></font><input type="text" id="f_ceduPadres4" name="f_ceduPadres4" class="form-control" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id);" placeholder="V-99999999" value=""><div class="tool-tip  slideIn" id="ttipf_ceduPadres4" style="display:none;"></div></div></div></th>
				</tr>
				<tr>
					<th><div class="form-group has-default" id="haf_sacerdote"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Seleccione el Sacerdote:</font><br><select name="f_sacerdote" class="form-control" onblur="vCampoVacio(this.id);" id="f_sacerdote" value=""><option value=""><p><strong></strong></p></option>');

					echo utf8_decode($loFuncion->fncreateComboSelect("tsacerdote", "tpersonas","idTsacerdote","nombres", ' ',"apellidos","concatext", $selectSacer,"INNER JOIN", "idFpersona", "idTpersonas")); 
					echo utf8_Decode('
					</select><div class="tool-tip  slideIn" id="ttipf_sacerdote" style="display:none;"></div></div></div></th>
					<th><div class="form-group has-default" id="haf_fechamatrimonio"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha de el Matrimonio:</font><input type="date" id="f_fechamatrimonio" name="f_fechamatrimonio" class="form-control" onblur="vFechaEvento(this.id);vfechaProclamas();" value=""><div class="tool-tip  slideIn" id="ttipf_fechamatrimonio" style="display:none;"></div></div></div></th>
				</tr>
				<tr>
					<th>
						<div class="form-group has-default" id="haf_ProclamaUnoFecha"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha Primera proclama:</font><input type="date" id="f_ProclamaUnoFecha" name="f_ProclamaUnoFecha" class="form-control" value="" onblur="vFechaMenor(this.id,\'f_fechamatrimonio\')"><div class="tool-tip  slideIn" id="ttipf_ProclamaUnoFecha" style="display:none;"></div></div></div>
						<div class="form-group has-default" id="haf_ProclamaDosFecha"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha Segunda proclama:</font><input type="date" id="f_ProclamaDosFecha" name="f_ProclamaDosFecha" class="form-control" value="" onblur="vFechaMenor(this.id,\'f_fechamatrimonio\')"><div class="tool-tip  slideIn" id="ttipf_ProclamaDosFecha" style="display:none;"></div></div></div>
						<div class="form-group has-default" id="haf_ProclamaTresFecha"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha Tercera proclama:</font><input type="date" id="f_ProclamaTresFecha" name="f_ProclamaTresFecha" class="form-control" value="" onblur="vFechaMenor(this.id,\'f_fechamatrimonio\')"><div class="tool-tip  slideIn" id="ttipf_ProclamaTresFecha" style="display:none;"></div></div></div>
					</th>
					<th>
						<div class="form-group has-default" id="haf_ProclamaUnoHora"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Hora Primera proclama:</font><input type="time" id="f_ProclamaUnoHora" name="f_ProclamaUnoHora" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_ProclamaUnoHora" style="display:none;"></div></div></div>
						<div class="form-group has-default" id="haf_ProclamaDosHora"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Hora Segunda proclama:</font><input type="time" id="f_ProclamaDosHora" name="f_ProclamaDosHora" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_ProclamaDosHora" style="display:none;"></div></div></div>
						<div class="form-group has-default" id="haf_ProclamaTresHora"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Hora Tercera proclama:</font><input type="time" id="f_ProclamaTresHora" name="f_ProclamaTresHora" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_ProclamaTresHora" style="display:none;"></div></div></div>
					</th>
				</tr>
		</table>
<br>
		<table class="table table-striped table-bordered table-hover" border="1">
		<thead>		
			<tr>
				<th colspan="3"><center>Registro Interno</center></th>
			</tr>
		</thead>	
			<tr>
				<th><div class="form-group has-default" id="haf_libro"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Libro:</font><br><input type="text" size="10" id="f_libro" name="f_libro" onkeypress="vSoloNumeros();" maxlength="13" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_libro" style="display:none;"></div></div></div></th>
				<th><div class="form-group has-default" id="haf_Folio"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Folio:</font><br><input type="text" size="10" id="f_Folio" name="f_Folio" onkeypress="vSoloNumeros();" maxlength="13" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_Folio" style="display:none;"></div></div></div></th>
				<th><div class="form-group has-default" id="haf_Numero"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Numero:</font><br><input type="text" size="10" id="f_Numero" name="f_Numero" onkeypress="vSoloNumeros();" maxlength="13" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_Numero" style="display:none;"></div></div></div></th>
			</tr>	
			<tr>
				<th></th>
				<th><center><div class="form-group has-default" id="haf_notaMarginal"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Nota Marginal:</font><br><textarea class="form-control" name="f_notaMarginal" maxlength="120" id="f_notaMarginal" style="height:60px; width:100%; resize:none; overflow-y:scroll"></textarea><div class="tool-tip  slideIn" id="ttipf_notaMarginal" style="display:none;"></div></div></div></center></th>
				<th></th>
			</tr>
		</table>
<br>



		<table class="table table-striped table-bordered table-hover" border="1" >
								<thead>		
									<tr>
										<th colspan="9"><center>Testigos Del Matrimonio</center></th>
									</tr>
								</thead>	
									<tr>
										<th align="center"><font class="control-label">
											Cedula</font><br> 
											<input type="text" name="f_padCedula" id="f_padCedula" placeholder="V-99999999" class="form-control" value="" size="6" maxlenght="13" disabled> 
										</th>
										<th align="center" ><font class="control-label">
											Nombres</font><br>
											<input type="text" name="f_padNombres" id="f_padNombres" class="form-control" value="" size="8" maxlenght="50"  disabled> 
										</th>
										<th align="center" ><font class="control-label">
											Apellidos</font><br>
											<input type="text" name="f_padApellidos" id="f_padApellidos" class="form-control" value="" size="8" maxlenght="50"   disabled> 
										</th>
										<th align="center" ><font class="control-label">
											Sexo</font><br>
											<select class="form-control" name="f_padSexo" id="f_padSexo" class="form-control" value="" disabled><option value=""><p><strong></strong></p></option><option value="F"><p><strong>F</strong></p></option><option value="M"><p><strong>M</strong></p></option></select>
										</th>
										<th align="center" >		
											<button type="button" name="btnAgregar" style="width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.428571429" class="btn btn-default btn-circle" onclick="fpAgregar()"><i class="fa fa-plus"></i></button>
										</th>

									</tr>
									
		</table>

<table align="center" border="1" name="tabPadrinos" id="tabPadrinos" class="table table-striped table-bordered table-hover">


</table>

<br>



</div>
	</div>
	<div class="container" style="margin-top:5px; padding:5px; min-height: auto; background: #FFFFFF; -webkit-box-shadow: 0px 2px 5px 2px #999; -moz-box-shadow: 2px 2px 5px #999;">
		<table class="table table-striped table-bordered table-hover" border="1" style="margin:0px">	
		<tr>
			<th colspan="2">
			<div class="controls form-inline">
					<center style="margin-right:27%">
					<input type="text" size="10" maxlength="30" id="f_refMatrimonio" name="f_refMatrimonio" placeholder="Referencia del Matrimonio" class="form-control" value="" style="margin-right:7%;width:26%" onkeypress="vSoloNumeros();" disabled>
					<input type="hidden" name="txtOperacion" id="txtOperacion" value="">
					<input type="hidden" name="txtHacer" id="txtHacer" value="">
					<input type="hidden" name="txtHay" id="txtHay" value="">
					<input type="hidden" name="KestadoActual" id="KestadoActual" value="">
					<input type="hidden" name="txtFila" value="0">
					<input type="hidden" name="CIpadriAlter" value="0">
					<input type="hidden" name="auxiliarHacer" value="">
					<input type="hidden" name="auxiliarOpera" value="">
					<input type="hidden" name="auxiliarPadrino" value="">
					<input type="button" class="btn btn-default" name="b_Nuevo" value="Nuevo" onclick="fpNuevo()">
					<input type="button" class="btn btn-default" name="b_Modificar" value="Modificar" onclick="fpModificar()">
					<input type="button" class="btn btn-default" name="b_Buscar" value="Buscar" onclick="fpBuscarLike()">
					<input type="button" class="btn btn-default" name="b_Eliminar" value="Estado" disabled>
					<input type="button" class="btn btn-default" name="b_Guardar" value="Guardar" onclick="fpGuardar()">
					<input type="button" class="btn btn-default" name="b_Cancelar" value="Cancelar" onclick="fpCancelar()">
					</center>
			</div>
			</th>
		</tr>		
		</table>
	</div>');

	footer(); // pie de pagina

	echo utf8_decode('</form>
</div>

</body>
<script>
	var loF=document.fr_matrimonio;
	function fpInicio()
	{	

			fpInicial();
			fpCancelar();
						

	}
		
		function fpNuevo()
		{
			fpCambioN();
			fpEncender();
			loF.txtOperacion.value="incluir";
			loF.txtHacer.value="buscar";
			loF.f_cedunovia.focus();
		}
		
		function fpEncender()
		{
			var liFila=Number(loF.txtFila.value);
			loF.f_cedunovia.disabled=false;
			loF.f_cedunovio.disabled=false;
			loF.f_sacerdote.disabled=false;
			loF.f_fechamatrimonio.disabled=false;
			loF.btnAgregar.disabled=false;
			loF.f_ProclamaUnoFecha.disabled=false;
			loF.f_ProclamaDosFecha.disabled=false;
			loF.f_ProclamaTresFecha.disabled=false;
			loF.f_ProclamaUnoHora.disabled=false;
			loF.f_ProclamaDosHora.disabled=false;
			loF.f_ProclamaTresHora.disabled=false;
			loF.f_libro.disabled=false;
			loF.f_Folio.disabled=false;
			loF.f_Numero.disabled=false;
			loF.f_notaMarginal.disabled=false;

			for(liY=1;liY<=liFila;liY++)
            {
			
				document.getElementById("f_padNombres"+liY).disabled=false;
				document.getElementById("f_padApellidos"+liY).disabled=false;
				document.getElementById("f_padSexo"+liY).disabled=false;
			}

			
		}

				
		function accionEstados(estadoid)
		{
			var valorEstado = document.getElementById(estadoid).innerHTML;


					if (valorEstado=="En espera del Matrimonio <br> (Click Aqui Para imprimir Proclama Matrimonial)")
					{
						if(fbValidarReportes())
						{
							$("#CargaReporteIco").css("display","inline");
							setTimeout(function(){ window.location=\'reportes/reporteInscriMatrimonio.php?RPrefMatri=\'+loF.f_refMatrimonio.value; }, 1000);
						}
						else
						{
							NotificaE("Debe completar los campos obligatorios antes de imprimir algun reporte");
						}
					}
					else if(valorEstado=="Casados <br> (Click Aqui Para imprimir Certificado de Matrimonio)")
					{
						if(fbValidarReportes())
						{
							$("#CargaReporteIco").css("display","inline");
							setTimeout(function(){ window.location=\'reportes/CertificadoMatrimonio.php?ReFmatrimonio=\'+loF.f_refMatrimonio.value; }, 1000);
						}
						else
						{
							NotificaE("Debe completar los campos obligatorios antes de imprimir algun reporte");
						}
					}

		}
		function fpEnciendeCI()
		{
			loF.f_cedunovio.disabled=false;
			loF.f_cedunovia.disabled=false;
			QuitarMask("f_cedunovio");
			QuitarMask("f_cedunovia");
			var liFila=Number(loF.txtFila.value);
			for(liY=1;liY<=liFila;liY++)
	        {
	        QuitarMask("f_padCedula"+liY);
			document.getElementById("f_padCedula"+liY).disabled=false;
			document.getElementById("f_padNombres"+liY).disabled=false;
			document.getElementById("f_padApellidos"+liY).disabled=false;
			document.getElementById("f_padSexo"+liY).disabled=false;
			}
		}
		function fpApagar()
		{
			var liFila=Number(loF.txtFila.value);
			loF.f_cedunovia.disabled=true;
			loF.f_cedunovio.disabled=true;
			loF.f_sacerdote.disabled=true;
			loF.f_fechamatrimonio.disabled=true;
			loF.f_ceduPadres1.disabled=true;
			loF.f_ceduPadres2.disabled=true;
			loF.f_ceduPadres3.disabled=true;
			loF.f_ceduPadres4.disabled=true;
			loF.f_ProclamaUnoFecha.disabled=true;
			loF.f_ProclamaDosFecha.disabled=true;
			loF.f_ProclamaTresFecha.disabled=true;
			loF.f_ProclamaUnoHora.disabled=true;
			loF.f_ProclamaDosHora.disabled=true;
			loF.f_ProclamaTresHora.disabled=true;
			loF.f_libro.disabled=true;
			loF.f_Folio.disabled=true;
			loF.f_Numero.disabled=true;
			loF.f_notaMarginal.disabled=true;
			loF.f_refMatrimonio.disabled=true;

			loF.btnAgregar.disabled=true;
		    for(liY=1;liY<=liFila;liY++)
            {
				document.getElementById("f_padCedula"+liY).disabled=true;
				document.getElementById("f_padNombres"+liY).disabled=true;
				document.getElementById("f_padApellidos"+liY).disabled=true;
				document.getElementById("f_padSexo"+liY).disabled=true;
			}
			
			document.getElementById("ntf_cambiaMatri").innerHTML="Inscripción del Matrimonio";
			document.getElementById("divf_cambiaMatri").className = "alert alert-info";
			loF.b_Eliminar.disabled=true;	
		}

		function fpCancelar()
		{
			var liFila=Number(loF.txtFila.value);
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.f_cedunovia.value="";
			loF.f_cedunovio.value="";
			loF.f_sacerdote.value="";
			loF.f_ceduPadres1.value="";
			loF.f_ceduPadres2.value="";
			loF.f_ceduPadres3.value="";
			loF.f_ceduPadres4.value="";
			loF.f_ProclamaUnoFecha.value="";
			loF.f_ProclamaDosFecha.value="";
			loF.f_ProclamaTresFecha.value="";
			loF.f_ProclamaUnoHora.value="";
			loF.f_ProclamaDosHora.value="";
			loF.f_ProclamaTresHora.value="";
			loF.f_libro.value="";
			loF.f_Folio.value="";
			loF.f_Numero.value="";
			loF.f_notaMarginal.value="";
			loF.f_refMatrimonio.value="";

			loF.f_fechamatrimonio.value="";
			document.getElementById("ntf_EncontroNovia").innerHTML="";
			document.getElementById("ntf_EncontroNovio").innerHTML="";
			document.getElementById("TituNovia").innerHTML="Cedula de la Novia:";
			document.getElementById("haf_cedunovia").className = "form-group has-default";
			document.getElementById("TituNovio").innerHTML="Cedula de el Novio:";
			document.getElementById("haf_cedunovio").className = "form-group has-default";
			document.getElementById("ntf_EncontroPadre1").innerHTML="";
			document.getElementById("haf_ceduPadres1").className = "form-group has-default";
			document.getElementById("ntf_EncontroPadre2").innerHTML="";
			document.getElementById("haf_ceduPadres2").className = "form-group has-default";
			document.getElementById("ntf_EncontroPadre3").innerHTML="";
			document.getElementById("haf_ceduPadres3").className = "form-group has-default";
			document.getElementById("ntf_EncontroPadre4").innerHTML="";
			document.getElementById("haf_ceduPadres4").className = "form-group has-default";

			document.getElementById("haf_sacerdote").className = "form-group has-default";
			document.getElementById("haf_fechamatrimonio").className = "form-group has-default";
			document.getElementById("haf_ProclamaUnoFecha").className = "form-group has-default";
			document.getElementById("haf_ProclamaDosFecha").className = "form-group has-default";
			document.getElementById("haf_ProclamaTresFecha").className = "form-group has-default";
			document.getElementById("haf_ProclamaUnoHora").className = "form-group has-default";
			document.getElementById("haf_ProclamaDosHora").className = "form-group has-default";
			document.getElementById("haf_ProclamaTresHora").className = "form-group has-default";

			loF.auxiliarHacer.value="buscar";		
			fpEliminaFilas();
			fpApagar();
			fpInicial();
			loF.KestadoActual.value=9;
			fpEstadoActual();
			

		}

		function fpBuscarLike()
		{
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");

			mas.style.display = "block";
			bus.style.display = "block";

			document.getElementById("txtbuscador").focus();
		}

		function fpSelectLike(idlke)
		{
			var lke = document.getElementById(idlke);
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");
			

			mas.style.display = "none";
			bus.style.display = "none";
			

			loF.f_cedunovia.value=lke.nvaCedula.value;
			loF.f_refMatrimonio.value=lke.MatriS.value;
			loF.f_refMatrimonio.disabled=false;
			loF.f_cedunovia.disabled=false;
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.txtHay.value="0";
			fpPerderFocus(loF.f_cedunovia);

		}

		function salir()
		{
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");
			

			mas.style.display = "none";
			bus.style.display = "none";
			

			fpCancelar();			
		}

		function fpBuscar()
		{
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.f_cedunovia.disabled=false;
			loF.f_cedunovio.disabled=false;
			loF.f_cedunovia.focus();
			fpCambioB();
			
		}

		function fpPerderFocus(Rcampo)
		{
		var obje="";
		var Prosigue=1;
		var enviar=1;
		var ceduNovia=loF.f_cedunovia.value.trim();
		var ceduNovio=loF.f_cedunovio.value.trim();

			if ((ceduNovia==ceduNovio)&&(ceduNovia!="")&&(ceduNovio!=""))
			{
				NotificaE("Lo siento no puede agregar 2 veces al mismo contrayente");
				Rcampo.value="";
				Rcampo.focus();
				enviar=0;
			}

			if((loF.f_cedunovia.value!="")&&(loF.txtHacer.value=="buscar")&&(enviar==1)||(loF.f_cedunovio.value!="")&&(loF.txtHacer.value=="buscar")&&(enviar==1))
			{
				
						
				var $forme = $("#fr_matrimonio");

					$.ajax({
						url: \'../cntller/cn_matrimonio.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var matrimo=data[\'Matri\'];
           					var padres=data[\'Padres\'];
           					var padrinos=data[\'Padri\'];
							if((matrimo.lscedunovia!="")||(matrimo.lscedunovio!=""))
							{
								loF.f_refMatrimonio.value=matrimo.lsMatriS;
								if((matrimo.lscedunovio!="")&&(matrimo.lsnombnovio!="")&&(matrimo.lscedunovia!="")&&(matrimo.lsnombnovia!=""))
								{
									
									document.getElementById("ntf_EncontroNovia").innerHTML="Novia: "+matrimo.lsnombnovia+", de "+matrimo.lsEstadonovia+" Años <button type=\"button\" style=\"padding:2px;margin-bottom:3px;\" onclick=\"window.location=\'feligres.php?obj=4&key=O&Cedu="+matrimo.lscedunovia+"\'\" class=\"btn btn-success\">Ver Mas Detalles</button><br>";
									loF.f_cedunovia.value = matrimo.lscedunovia;
									document.getElementById("haf_cedunovia").className = "form-group has-success";
									document.getElementById("ntf_EncontroNovio").innerHTML="Novio: "+matrimo.lsnombnovio+", de "+matrimo.lsEstadonovio+" Años <button type=\"button\" style=\"padding:2px;margin-bottom:3px;\" onclick=\"window.location=\'feligres.php?obj=4&key=O&Cedu="+matrimo.lscedunovio+"\'\" class=\"btn btn-success\">Ver Mas Detalles</button><br>";
									loF.f_cedunovio.value = matrimo.lscedunovio;
									document.getElementById("haf_cedunovio").className = "form-group has-success";
									loF.f_sacerdote.value = matrimo.lscedusacerdote;
									loF.f_fechamatrimonio.value = matrimo.lsfechamatrimonio;
									loF.f_cedunovia.disabled=true;
									loF.f_cedunovio.disabled=true;
									if(padres.length>0)
									{
										fpListarPadres(padres);					
									}

									loF.f_ProclamaUnoFecha.value = matrimo.lsFechaProclamaUno.substring(0,10);
									loF.f_ProclamaDosFecha.value = matrimo.lsFechaProclamaDos.substring(0,10);
									loF.f_ProclamaTresFecha.value = matrimo.lsFechaProclamaTres.substring(0,10);

									loF.f_ProclamaUnoHora.value = matrimo.lsFechaProclamaUno.substring(11,19);
									loF.f_ProclamaDosHora.value = matrimo.lsFechaProclamaDos.substring(11,19);
									loF.f_ProclamaTresHora.value = matrimo.lsFechaProclamaTres.substring(11,19);
									loF.f_libro.value = matrimo.lsInterLibro;
									loF.f_Folio.value = matrimo.lsInterFolio;
									loF.f_Numero.value = matrimo.lsInterNumero;
									loF.f_notaMarginal.value = matrimo.lsNotaMarginal;

								}

								if ((matrimo.lscedunovia!="")&&(matrimo.lsnombnovia!=""))
								{
									if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(matrimo.liHay==7))
									{
										if (matrimo.lsSexoNovia=="F")
										{
											Prosigue=1;
										}
										else
										{
											Prosigue=0;
										}
									}
									if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(matrimo.liHay==10))
									{
											Prosigue=2;
									}
									if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(matrimo.liHay==11))
									{
											Prosigue=3;
									}
									if ((matrimo.lsCeduMadreNovia==loF.f_ceduPadres3.value)&&(loF.f_ceduPadres3.value!="")||(matrimo.lsCeduPadreNovia==loF.f_ceduPadres4.value)&&(loF.f_ceduPadres4.value!=""))
									{
										Prosigue=4;
									}
								if (Prosigue==1)
								{
									document.getElementById("ntf_EncontroNovia").innerHTML="Novia: "+matrimo.lsnombnovia+", de "+matrimo.lsEdadnovia+" Años <button type=\"button\" style=\"padding:2px;margin-bottom:3px;\" onclick=\"window.location=\'feligres.php?obj=4&key=O&Cedu="+matrimo.lscedunovia+"\'\" class=\"btn btn-success\">Ver Mas Detalles</button><br>";
									loF.f_cedunovia.value = matrimo.lscedunovia;
									loF.f_cedunovia.disabled=true;
								}
								else if (Prosigue==2)
								{
									NotificaE("Disculpe un sacerdote no se puede casar.");
									if (loF.txtOperacion.value=="incluir")
									{
										Rcampo.value="";
									}
									Rcampo.focus();

								}
								else if (Prosigue==3)
								{
									NotificaE("Disculpe la novia tiene que ser mayor de edad.");
									if (loF.txtOperacion.value=="incluir")
									{
										Rcampo.value="";
									}
									Rcampo.focus();

								}
								else if (Prosigue==4)
								{
									NotificaE("Disculpe la novia y el novio no pueden tener los mismos padres");
									if (loF.txtOperacion.value=="incluir")
									{
										Rcampo.value="";
									}
									Rcampo.focus();

								}
								else
								{
									NotificaE("Disculpe la novia tiene que ser de sexo Femenino.");
									if (loF.txtOperacion.value=="incluir")
									{
										Rcampo.value="";
									}
									Rcampo.focus();
								}

								}
								if((matrimo.lscedunovio!="")&&(matrimo.lsnombnovio!=""))
								{

									if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(matrimo.liHay==7))
									{
										if (matrimo.lsSexoNovio=="M")
										{
											Prosigue=1;
										}
										else
										{
											Prosigue=0;
										}
									}
									if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(matrimo.liHay==10))
									{
											Prosigue=2;
									}
									if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(matrimo.liHay==11))
									{
											Prosigue=3;
									}
									if ((loF.f_ceduPadres1.value==matrimo.lsCeduMadreNovio)&&(loF.f_ceduPadres1.value!="")||(loF.f_ceduPadres2.value==matrimo.lsCeduPadreNovio)&&(loF.f_ceduPadres2.value!=""))
									{
										Prosigue=4;
									}
								if (Prosigue==1)
								{
									document.getElementById("ntf_EncontroNovio").innerHTML="Novio: "+matrimo.lsnombnovio+", de "+matrimo.lsEdadnovio+" Años <button type=\"button\" style=\"padding:2px;margin-bottom:3px;\" onclick=\"window.location=\'feligres.php?obj=4&key=O&Cedu="+matrimo.lscedunovio+"\'\" class=\"btn btn-success\">Ver Mas Detalles</button><br>";
									loF.f_cedunovio.value = matrimo.lscedunovio;
									document.getElementById("haf_cedunovio").className = "form-group has-success";
									loF.f_cedunovio.disabled=true;
								}
								else if (Prosigue==2)
								{
									NotificaE("Disculpe un sacerdote no se puede casar.");
									if (loF.txtOperacion.value=="incluir")
									{
										Rcampo.value="";
									}
									Rcampo.focus();
								}
								else if (Prosigue==3)
								{
									NotificaE("Disculpe el novio tiene que ser mayor de edad.");
									if (loF.txtOperacion.value=="incluir")
									{
										Rcampo.value="";
									}
									Rcampo.focus();

								}
								else if (Prosigue==4)
								{
									NotificaE("Disculpe la novia y el novio no pueden tener los mismos padres");
									if (loF.txtOperacion.value=="incluir")
									{
										Rcampo.value="";
									}
									Rcampo.focus();

								}
								else
								{
									NotificaE("Disculpe el novio tiene que ser de sexo Masculino.");
									if (loF.txtOperacion.value=="incluir")
									{
										Rcampo.value="";
									}
									Rcampo.focus();
								}
								}
					
								if ((loF.txtHacer.value=="buscar")&&(matrimo.liHay==1))
								{
									loF.KestadoActual.value = matrimo.lsedomatri;
									fpCambioE();
									fpApagar();

									
								}
								if ((loF.txtHacer.value=="buscar")&&(matrimo.liHay==8))
								{
									NotificaE("Este matrimonio ya se encuentra registrado");
									loF.KestadoActual.value = matrimo.lsedomatri;
									fpCambioE();
									fpApagar();

									
								}
								if ((loF.txtHacer.value=="buscar")&&(matrimo.liHay==3))
								{
									loF.KestadoActual.value = matrimo.lsedomatri;
									fpCambioE();
									fpApagar();

									
								}
								
								fpEstadoActual();
								if (matrimo.lsedomatri==0){
									document.getElementById("ntf_cambiaMatri").innerHTML="En espera del Matrimonio <br> (Click Aqui Para imprimir Proclama Matrimonial)";
									document.getElementById("divf_cambiaMatri").className = "alert alert-info";
								}
								else if(matrimo.lsedomatri==1){

									document.getElementById("ntf_cambiaMatri").innerHTML="Casados <br> (Click Aqui Para imprimir Certificado de Matrimonio)";
									document.getElementById("divf_cambiaMatri").className = "alert alert-success";
								}
								else if(matrimo.lsedomatri==2){
									document.getElementById("ntf_cambiaMatri").innerHTML="Suspendido";
									document.getElementById("divf_cambiaMatri").className = "alert alert-warning";
								}
								else if(matrimo.lsedomatri==3){
									document.getElementById("ntf_cambiaMatri").innerHTML="Matrimonio Anulado";
									document.getElementById("divf_cambiaMatri").className = "alert alert-danger";
								}
								else
								{
									document.getElementById("ntf_cambiaMatri").innerHTML="Inscripción del Matrimonio";
									document.getElementById("divf_cambiaMatri").className = "alert alert-info";
								}

							}

							if ((loF.txtOperacion.value=="buscar")&&(matrimo.liHay==0))
							{
								NotificaE("No se encontro ningun matrimonio activo con la cedula ingresada");
								Rcampo.value="";
								Rcampo.focus();
							}

							if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(matrimo.liHay==1)) //si la cedula existe y si tiene Matrimonio.
							{
									loF.txtOperacion.value="incluir";
									loF.auxiliarHacer.value="buscar";
									loF.txtHay.value=0;

							}

							if((loF.txtOperacion.value=="incluir")&&(matrimo.liHay==7)&&(Prosigue==1)) //si la cedula existe y no tiene Matrimonio.
							{
									
									loF.txtOperacion.value="incluir";
									loF.txtHacer.value=loF.auxiliarHacer.value;
									loF.txtHay.value=0;
									loF.auxiliarHacer.value="incluir";

							}

							if((loF.txtOperacion.value=="incluir")&&(matrimo.liHay==2)) //si la cedula de la Novia no existe.
							{
									loF.txtOperacion.value="incluir";
									loF.txtHacer.value="buscar";
									loF.txtHay.value=0;
									Rcampo.focus();
									Rcampo.disabled=true;
							}

							if((loF.txtOperacion.value=="incluir")&&(matrimo.liHay==9)) 
							{
								if (Rcampo.value!="")
								{
									if (confirm("La cedula Ingresada No esta asignada a ninguna persona, desea registrarla ahora?"))
									{
										');									
										$_SESSION["UrlAnterior"]="matrimonio.php";
									echo utf8_decode('
										if (Rcampo.id=="f_cedunovia")
										{
											obje=2;
										}
										else
										{
											obje=3;
										}
										window.location="feligres.php?obj="+obje+"&Cedu="+Rcampo.value.trim()+"&pre=1";
									}
									else
									{
										
										
										
									}
								}
							}

							if((loF.txtOperacion.value=="incluir")&&(matrimo.liHay==4)) 
							{

							loF.txtHay.value=0;
							NotificaE("La cedula ingresada no es de Sexo Femenino.");
							Rcampo.value="";
							Rcampo.focus();

							}


							if((loF.txtOperacion.value=="incluir")&&(matrimo.liHay==5)) 
							{

							loF.txtHay.value=0;
							NotificaE("La cedula ingresada no es de Sexo Masculino.");
							Rcampo.value="";
							Rcampo.focus();	

							}

							if(padrinos)
							{
								fpListarPadri(padrinos);
							}

						}
					});
				
		
			}
		
		}
		
		function ejecutaPrimero()
		{
			var objeto=document.getElementById("f_cedunovia");
			loF.f_refMatrimonio.value="'.$_GET["matriRef"].'";
			loF.f_cedunovia.value="234561";
			loF.f_refMatrimonio.disabled=false;
			loF.f_cedunovia.disabled=false;
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.txtHay.value="0";
			fpPerderFocus(objeto);
		}

		function DomingoCercanoDe(fecha)
		{
			var fecharetorn="";
			var fechin=new Date(fecha);
			var dayOfMonth = fechin.getDate()+1;
			var fechaDia=fechin.getDay()+1;
			var restaDias=dayOfMonth - fechaDia;
			fechin.setDate(restaDias);

			fecharetorn=fechin.getDate() + \'-\' + (fechin.getMonth() + 1) + \'-\' +  fechin.getFullYear();
			return DameFechaFormato(fecharetorn,"US");

		}

		function vfechaProclamas()
		{
			var fechin=loF.f_fechamatrimonio.value;
			var Fecha1 = DomingoCercanoDe(fechin);
			var Fecha2 = DomingoCercanoDe(Fecha1);
			var Fecha3 = DomingoCercanoDe(Fecha2);
			loF.f_ProclamaTresFecha.value=Fecha1;
			loF.f_ProclamaDosFecha.value=Fecha2;
			loF.f_ProclamaUnoFecha.value=Fecha3;

			loF.f_ProclamaUnoHora.value="09:00:00";
			loF.f_ProclamaDosHora.value="09:00:00";
			loF.f_ProclamaTresHora.value="09:00:00";
		
		}

		function fpGuardar()
		{
			if(fbValidar())
			{
				fpEnciendeCI();
				loF.f_refMatrimonio.disabled=false;
				var $forme = $("#fr_matrimonio");

					$.ajax(
					{
						url: \'../cntller/cn_matrimonio.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var matrimo=data[\'Matri\'];
           					var padrinos=data[\'Padri\'];
							if((matrimo.liHay!=""))
							{
								if ((loF.txtHacer.value=="incluir")&&(matrimo.liHay==0))
								{
									NotificaE("El Registro no pudo ser incluido.");


								}

								if ((loF.txtHacer.value=="incluir")&&(matrimo.liHay==1))
								{

									NotificaS("Registro incluido con exito. Numero de Referencia: "+matrimo.lsMatriS);
									fpCancelar();


								}
								if ((loF.txtHacer.value=="modificar")&&(matrimo.liHay==0))
								{
									NotificaE("El Registro no pudo ser modificado.");


								}

								if ((loF.txtHacer.value=="modificar")&&(matrimo.liHay==1))
								{

									NotificaS("Registro modificado con exito.");
									fpCancelar();
								}

								if ((loF.txtHacer.value=="modificar")&&(matrimo.liHay==2))
								{
									NotificaE("El Registro no pudo ser modificado.");


								}


							}
						}
					});
			}
			
		}

		function fbValidarReportes()
		{
			var lbValido=false;
			var vInvalido=0;

			if(loF.f_cedunovia.value=="")
			{
				loF.f_cedunovia.focus();
				vCampoVacio("f_cedunovia");
				vInvalido=1;
			}
			if(loF.f_cedunovio.value=="")
			{
				loF.f_cedunovio.focus();
				vCampoVacio("f_cedunovio");
				vInvalido=1;
			}
			if(loF.f_sacerdote.value=="")
			{
				loF.f_sacerdote.focus();
				vCampoVacio("f_sacerdote");
				vInvalido=1;
			}
			if(loF.f_fechamatrimonio.value=="")
			{
				loF.f_fechamatrimonio.focus();
				vCampoVacio("f_fechamatrimonio");
				vInvalido=1;
			}
			if(loF.f_ProclamaUnoFecha.value=="")
			{
				loF.f_ProclamaUnoFecha.focus();
				vCampoVacio("f_ProclamaUnoFecha");
				vInvalido=1;
			}
			if(loF.f_ProclamaDosFecha.value=="")
			{
				loF.f_ProclamaDosFecha.focus();
				vCampoVacio("f_ProclamaDosFecha");
				vInvalido=1;
			}
			if(loF.f_ProclamaTresFecha.value=="")
			{
				loF.f_ProclamaTresFecha.focus();
				vCampoVacio("f_ProclamaTresFecha");
				vInvalido=1;
			}
			if(loF.f_ProclamaUnoHora.value=="")
			{
				loF.f_ProclamaUnoHora.focus();
				vCampoVacio("f_ProclamaUnoHora");
				vInvalido=1;
			}
			if(loF.f_ProclamaDosHora.value=="")
			{
				loF.f_ProclamaDosHora.focus();
				vCampoVacio("f_ProclamaDosHora");
				vInvalido=1;
			}
			if(loF.f_ProclamaTresHora.value=="")
			{
				loF.f_ProclamaTresHora.focus();
				vCampoVacio("f_ProclamaTresHora");
				vInvalido=1;
			}

			if (vInvalido==0)
			{
				lbValido=true;
			}
			return lbValido;
		}

		function fbValidar()
		{
			var lbValido=false;
			var vInvalido=0;
			if(loF.f_cedunovia.value=="")
			{
				loF.f_cedunovia.focus();
				vCampoVacio("f_cedunovia");
				vInvalido=1;
			}
			if(loF.f_cedunovio.value=="")
			{
				loF.f_cedunovio.focus();
				vCampoVacio("f_cedunovio");
				vInvalido=1;
			}
			if(loF.f_ceduPadres1.value=="")
			{
				loF.f_ceduPadres1.focus();
				vCampoVacio("f_ceduPadres1");
				vInvalido=3;
			}
			if(loF.f_ceduPadres2.value=="")
			{
				loF.f_ceduPadres2.focus();
				vCampoVacio("f_ceduPadres2");
				vInvalido=3;
			}
			if(loF.f_ceduPadres3.value=="")
			{
				loF.f_ceduPadres3.focus();
				vCampoVacio("f_ceduPadres3");
				vInvalido=3;
			}
			if(loF.f_ceduPadres4.value=="")
			{
				loF.f_ceduPadres4.focus();
				vCampoVacio("f_ceduPadres4");
				vInvalido=3;
			}
			if(loF.f_sacerdote.value=="")
			{
				loF.f_sacerdote.focus();
				vCampoVacio("f_sacerdote");
				vInvalido=1;
			}
			if(loF.f_fechamatrimonio.value=="")
			{
				loF.f_fechamatrimonio.focus();
				vCampoVacio("f_fechamatrimonio");
				vInvalido=1;
			}
			if(loF.f_ProclamaUnoFecha.value=="")
			{
				loF.f_ProclamaUnoFecha.focus();
				vCampoVacio("f_ProclamaUnoFecha");
				vInvalido=1;
			}
			if(loF.f_ProclamaDosFecha.value=="")
			{
				loF.f_ProclamaDosFecha.focus();
				vCampoVacio("f_ProclamaDosFecha");
				vInvalido=1;
			}
			if(loF.f_ProclamaTresFecha.value=="")
			{
				loF.f_ProclamaTresFecha.focus();
				vCampoVacio("f_ProclamaTresFecha");
				vInvalido=1;
			}
				if (loF.txtOperacion.value=="incluir")
				{
					if (vFechaMenor("f_ProclamaUnoFecha","f_fechamatrimonio")==false)
					{
						loF.f_ProclamaUnoFecha.focus();
						vInvalido=1;
					}
					if (vFechaMenor("f_ProclamaDosFecha","f_fechamatrimonio")==false)
					{
						loF.f_ProclamaDosFecha.focus();
						vInvalido=1;
					}
					if (vFechaMenor("f_ProclamaTresFecha","f_fechamatrimonio")==false)
					{
						loF.f_ProclamaTresFecha.focus();
						vInvalido=1;
					}
				}
				else if (loF.txtOperacion.value=="modificar")
				{
					if (vFechaMenor("f_ProclamaUnoFecha","f_fechamatrimonio")==false)
					{
						loF.f_ProclamaUnoFecha.focus();
						
					}
					if (vFechaMenor("f_ProclamaDosFecha","f_fechamatrimonio")==false)
					{
						loF.f_ProclamaDosFecha.focus();
						
					}
					if (vFechaMenor("f_ProclamaTresFecha","f_fechamatrimonio")==false)
					{
						loF.f_ProclamaTresFecha.focus();
						
					}
				}
			if(loF.f_ProclamaUnoHora.value=="")
			{
				loF.f_ProclamaUnoHora.focus();
				vCampoVacio("f_ProclamaUnoHora");
				vInvalido=1;
			}
			if(loF.f_ProclamaDosHora.value=="")
			{
				loF.f_ProclamaDosHora.focus();
				vCampoVacio("f_ProclamaDosHora");
				vInvalido=1;
			}
			if(loF.f_ProclamaTresHora.value=="")
			{
				loF.f_ProclamaTresHora.focus();
				vCampoVacio("f_ProclamaTresHora");
				vInvalido=1;
			}
			if(vFechaEvento("f_fechamatrimonio")==false)
			{
				loF.f_fechamatrimonio.focus();
				vInvalido=1;
			}
			
			if (vInvalido==0)
			{
				lbValido=fbValidaPadrinos();
			}
			else if (vInvalido==3)
			{
				
				lbValido=fbValidaPadrinos();
				
			}
			return lbValido;
		}

		function fbValidaPadrinos()
		{
			var lbValido=false;
			var vInvalido=0;
			var vPadriTipoC=0;

			var liFila=Number(loF.txtFila.value);
			if (liFila>1)
			{
	            for(liY=1;liY<=liFila;liY++)
	            {
	            	
					if(document.getElementById("f_padCedula"+liY).value=="")
					{

						document.getElementById("f_padCedula"+liY).focus();
						vCampoVacio("f_padCedula"+liY);
						vInvalido=1;
					}
					if(document.getElementById("f_padNombres"+liY).value=="")
					{
						document.getElementById("f_padNombres"+liY).focus();
						vCampoVacio("f_padNombres"+liY);
						vInvalido=1;
					}
					if(document.getElementById("f_padApellidos"+liY).value=="")
					{
						document.getElementById("f_padApellidos"+liY).focus();
						vCampoVacio("f_padApellidos"+liY);
						vInvalido=1;
					}
					if(document.getElementById("f_padSexo"+liY).value=="")
					{
						document.getElementById("f_padSexo"+liY).focus();
						vCampoVacio("f_padSexo"+liY);
						vInvalido=1;
					}

				}
				if(vInvalido==0)
				{
					lbValido=true;
				}
			}
			else
			{
				NotificaE("Lo siento, debe agregar al menos 2 Padrinos");
			}
		
			return lbValido;
		}
		
		function fpModificar()
		{
			fpEncender();
			fpCambioN();
			loF.txtOperacion.value="modificar";
			loF.txtHacer.value="modificar";
			loF.txtHay.value=0;
			loF.f_cedunovia.disabled=true;
			loF.f_cedunovio.disabled=true;
			loF.f_padCedula.focus();
		}
		
		function fpEstadoActual()
		{
			loF.b_Eliminar.disabled=true;
			var KedoActual=loF.KestadoActual.value;
			if(KedoActual==0)
			{
				loF.b_Eliminar.value="Pendiente";

			}
			else if(KedoActual==1)
			{
				loF.b_Eliminar.value="Casado";

			}
			else if(KedoActual==2)
			{
				loF.b_Eliminar.value="Suspendido";
			}
			else if(KedoActual==3)
			{
				loF.b_Eliminar.value="Anulado";

			}
			else
			{
				loF.b_Eliminar.value="Estado";
			}
		
		}

		function fpDesactivar()
		{
			if (loF.b_Eliminar.value=="Reactivar")
			{
				if(confirm("Desea Reactivar el Matrimonio?"))
				{
					loF.f_cedunovia.disabled=false;
					loF.txtOperacion.value="reactivar";
					loF.txtHacer.value="reactivar";
					loF.f_cedunovia.disabled=false;
					loF.f_cedunovio.disabled=false;
					
					var $forme = $("#fr_matrimonio");

					$.ajax({
						url: \'../cntller/cn_matrimonio.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var Matrimo=data[\'Matri\'];
							if(Matrimo.liHay==1)
							{
									fpCancelar();
									NotificaS("Matrimonio Reactivado");
									loF.KestadoActual.value=1;
									fpInicial();
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Reactivar el Matrimonio");
									loF.KestadoActual.value=1;
									fpInicial();									
							}
						}
					});


				}
			}
			else
			{
				if(confirm("Desea Desactivar el Matrimonio?"))
				{
					loF.f_cedunovia.disabled=false;
					loF.txtOperacion.value="desactivar";
					loF.txtHacer.value="desactivar";
					loF.f_cedunovia.disabled=false;
					loF.f_cedunovio.disabled=false;

					var $forme = $("#fr_matrimonio");

					$.ajax({
						url: \'../cntller/cn_matrimonio.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var Matrimo=data[\'Matri\'];
							if(Matrimo.liHay==1)
							{
									fpCancelar();
									NotificaS("Matrimonio Desactivado");
									loF.KestadoActual.value=1;
									fpInicial();							
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Desactivar el Matrimonio, solo se puede desactivar si el mismo no se ha llevado a cabo.");
									loF.KestadoActual.value=1;
									fpInicial();									
							}
						}
					});

				}
			}
		}

		function BuscaUnPadri(linea)
		{
			loF.auxiliarHacer.value=loF.txtHacer.value;
			loF.auxiliarOpera.value=loF.txtOperacion.value;
			var cedupadri=document.getElementById("f_padCedula"+linea).value.split(\' \').join(\'\');
			loF.txtOperacion.value="buscarPadri";
			var prosigue = 0;
			loF.txtHacer.value="buscarPadri";
			document.getElementById("f_padCedula"+linea).disabled=false;
			var ceduNovia=loF.f_cedunovia.value.trim();
			var ceduNovio=loF.f_cedunovio.value.trim();
			var ceduPad=document.getElementById("f_padCedula"+linea).value.trim();

			if ((ceduPad==ceduNovia)&&(ceduNovia!="")||(ceduPad==ceduNovio)&&(ceduNovio!=""))
			{
				document.getElementById("f_padCedula"+linea).value="";
				document.getElementById("f_padCedula"+linea).focus();
				NotificaE("No puede registrar el mismo contrayente como testigo.");
				prosigue = 1;
			}
			if ((cedupadri.length>5)&&(prosigue==0))
			{
				loF.auxiliarPadrino.value=cedupadri;
				var $forme = $("#fr_matrimonio");

				$.ajax({
					url: \'../cntller/cn_matrimonio.php\',
					dataType: \'json\',
					type: \'post\',
					data: $forme.serialize(),
			        success: function(data){
			        	var Matri=data[\'Matri\']
			        	var PerPadri=data[\'PersoPadri\'];
						if((Matri.liHay==1)&&(Matri.lsHacer=="buscarPadri"))
						{
							document.getElementById("haf_padCedula"+linea).className = "form-group has-warning";				
							document.getElementById("f_padCedula"+linea).value = PerPadri.lscedu;
							document.getElementById("f_padNombres"+linea).value = PerPadri.lsNomb;
							document.getElementById("f_padApellidos"+linea).value = PerPadri.lsApel;
							document.getElementById("f_padSexo"+linea).value = PerPadri.lsSexo;
							document.getElementById("f_padCedula"+linea).disabled = true;
							document.getElementById("f_padNombres"+linea).disabled = true;
							document.getElementById("f_padApellidos"+linea).disabled = true;
							document.getElementById("f_padSexo"+linea).disabled = true;
							document.getElementById("haf_padNombres"+linea).className = "form-group has-default";
							document.getElementById("haf_padApellidos"+linea).className = "form-group has-default";
							document.getElementById("haf_padSexo"+linea).className = "form-group has-default";
						}
						else	
						{
							document.getElementById("haf_padCedula"+linea).className = "form-group has-success";
						}
					}
				});
			}
			else
			{
				document.getElementById("haf_padCedula"+linea).className = "form-group has-error";
			}

		loF.txtHacer.value=loF.auxiliarHacer.value;
		loF.txtOperacion.value=loF.auxiliarOpera.value;
		}

		function fpListarPadres(arre)
		{
			$.each(arre, function(a, padres)
			{
	   			i=a+1;
				if (padres.Nombres==null)
				{
					document.getElementById("ntf_EncontroPadre"+i).innerHTML=" No se encuentra registrado";
					document.getElementById("haf_ceduPadres"+i).className = "form-group has-warning";
				}
				else
				{
					document.getElementById("ntf_EncontroPadre"+i).innerHTML=" "+padres.Nombres;
					document.getElementById("f_ceduPadres"+i).value = padres.Cedula;
					document.getElementById("haf_ceduPadres"+i).className = "form-group has-success";
				}
			});

		}

		function fpListarPadri(arre) {
			
			var liFila=Number(loF.txtFila.value);
			var loTabla = document.getElementById("tabPadrinos");

			liFila=liFila+arre.length;

			loF.txtFila.value=liFila;

				

		    $.each(arre, function(a, padrino) {
   			i=a+1;

            var loFila = loTabla.insertRow(a);
            var loCelda1 = loFila.insertCell(0);
            var loCelda2 = loFila.insertCell(1);
            var loCelda3 = loFila.insertCell(2);
            var loCelda4 = loFila.insertCell(3);
            var loCelda5 = loFila.insertCell(4);


if (padrino.EstatusPadri==1)
		{
			loFila.setAttribute(\'class\',\'info\');
		}	
		else
		{
			loFila.setAttribute(\'class\',\'danger\');
		}

		 
		var ttipclearfix = document.createElement("div"); 
			ttipclearfix.setAttribute(\'class\',"on-focus clearfix");
			ttipclearfix.setAttribute(\'style\',"position: relative;");

			var halof_padCedula = document.createElement("div"); 
			halof_padCedula.setAttribute(\'class\',"form-group has-default");
			halof_padCedula.setAttribute(\'id\',"haf_padCedula"+i);
			
			var ttiplof_padCedula = document.createElement("div");
			ttiplof_padCedula.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padCedula.setAttribute(\'id\',"ttipf_padCedula"+i);
			ttiplof_padCedula.setAttribute(\'style\',"display:none;");

			var lof_padCedula = document.createElement("input");
			lof_padCedula.setAttribute(\'type\',"text");
			lof_padCedula.setAttribute(\'class\',"form-control");
			lof_padCedula.setAttribute(\'name\',"f_padCedula"+i);
			lof_padCedula.setAttribute(\'id\',"f_padCedula"+i);
			lof_padCedula.setAttribute(\'value\',loF.f_padCedula.value);
			lof_padCedula.setAttribute(\'size\',"6");
			lof_padCedula.setAttribute(\'placeholder\',"V-99999999");
			lof_padCedula.setAttribute(\'onfocus\',"MaskCedulaNac(this.id)");
			lof_padCedula.setAttribute(\'onblur\',"this.value=this.value.toUpperCase(); vCampoVacio(this.id); BuscaUnPadri(this.id.substring(11));");
			lof_padCedula.setAttribute(\'maxlenght\',"13");

			var halof_padNombres = document.createElement("div"); 
			halof_padNombres.setAttribute(\'class\',"form-group has-default");
			halof_padNombres.setAttribute(\'id\',"haf_padNombres"+i);
			
			var ttiplof_padNombres = document.createElement("div");
			ttiplof_padNombres.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padNombres.setAttribute(\'id\',"ttipf_padNombres"+i);
			ttiplof_padNombres.setAttribute(\'style\',"display:none;");

			var lof_padNombres = document.createElement("input");
			lof_padNombres.setAttribute(\'type\',"text");
			lof_padNombres.setAttribute(\'class\',"form-control");
			lof_padNombres.setAttribute(\'name\',"f_padNombres"+i);
			lof_padNombres.setAttribute(\'id\',"f_padNombres"+i);
			lof_padNombres.setAttribute(\'value\',loF.f_padNombres.value);
			lof_padNombres.setAttribute(\'size\',"8");
			lof_padNombres.setAttribute(\'onkeypress\',"vSoloLetras();");
			lof_padNombres.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padNombres.setAttribute(\'maxlenght\',"50");

			var halof_padApellidos = document.createElement("div"); 
			halof_padApellidos.setAttribute(\'class\',"form-group has-default");
			halof_padApellidos.setAttribute(\'id\',"haf_padApellidos"+i);
			
			var ttiplof_padApellidos = document.createElement("div");
			ttiplof_padApellidos.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padApellidos.setAttribute(\'id\',"ttipf_padApellidos"+i);
			ttiplof_padApellidos.setAttribute(\'style\',"display:none;");

			var lof_padApellidos = document.createElement("input");
			lof_padApellidos.setAttribute(\'type\',"text");
			lof_padApellidos.setAttribute(\'class\',"form-control");
			lof_padApellidos.setAttribute(\'name\',"f_padApellidos"+i);
			lof_padApellidos.setAttribute(\'id\',"f_padApellidos"+i);
			lof_padApellidos.setAttribute(\'value\',loF.f_padApellidos.value);
			lof_padApellidos.setAttribute(\'size\',"8");
			lof_padApellidos.setAttribute(\'onkeypress\',"vSoloLetras();");
			lof_padApellidos.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padApellidos.setAttribute(\'maxlenght\',"50");

			var halof_padSexo = document.createElement("div"); 
			halof_padSexo.setAttribute(\'class\',"form-group has-default");
			halof_padSexo.setAttribute(\'id\',"haf_padSexo"+i);
			
			var ttiplof_padSexo = document.createElement("div");
			ttiplof_padSexo.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padSexo.setAttribute(\'id\',"ttipf_padSexo"+i);
			ttiplof_padSexo.setAttribute(\'style\',"display:none;");

			var lof_padSexo = document.getElementById("f_padSexo").cloneNode(true);
			lof_padSexo.setAttribute(\'name\',"f_padSexo"+i);
			lof_padSexo.setAttribute(\'id\',"f_padSexo"+i);
			lof_padSexo.setAttribute(\'class\',"form-control");
			lof_padSexo.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padSexo.removeAttribute("disabled");

             // CON EL METODO appendChild(); LOS AGREGO A LA CELDA QUE QUIERO

            loCelda1.appendChild(halof_padCedula).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padCedula).appendChild(ttiplof_padCedula);
            loCelda2.appendChild(halof_padNombres).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padNombres).appendChild(ttiplof_padNombres);
            loCelda3.appendChild(halof_padApellidos).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padApellidos).appendChild(ttiplof_padApellidos);
            loCelda4.appendChild(halof_padSexo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padSexo).appendChild(ttiplof_padSexo);

            document.getElementById("f_padCedula"+i).disabled="true";
   			document.getElementById("f_padCedula"+i).value=padrino.Cedula;
   			document.getElementById("f_padCedula"+i).disabled="true";
			document.getElementById("f_padNombres"+i).value=padrino.Nombres;
			document.getElementById("f_padNombres"+i).disabled="true";
			document.getElementById("f_padApellidos"+i).value=padrino.Apellidos;
			document.getElementById("f_padApellidos"+i).disabled="true";
			document.getElementById("f_padSexo"+i).value=padrino.Sexo;
			document.getElementById("f_padSexo"+i).disabled="true";
		
  		
  			});

        }


		function fpAgregar() {
			var liFila=Number(loF.txtFila.value);
						
            var loTabla = document.getElementById("tabPadrinos");
            var loFila = loTabla.insertRow(liFila);
            var loCelda1 = loFila.insertCell(0);
            var loCelda2 = loFila.insertCell(1);
            var loCelda3 = loFila.insertCell(2);
            var loCelda4 = loFila.insertCell(3);
            var loCelda5 = loFila.insertCell(4);

			loFila.setAttribute(\'class\',\'active\');


			liFila=liFila+1;
			loF.txtFila.value=liFila;

			var ttipclearfix = document.createElement("div"); 
			ttipclearfix.setAttribute(\'class\',"on-focus clearfix");
			ttipclearfix.setAttribute(\'style\',"position: relative;");

			var halof_padCedula = document.createElement("div"); 
			halof_padCedula.setAttribute(\'class\',"form-group has-default");
			halof_padCedula.setAttribute(\'id\',"haf_padCedula"+liFila);
			
			var ttiplof_padCedula = document.createElement("div");
			ttiplof_padCedula.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padCedula.setAttribute(\'id\',"ttipf_padCedula"+liFila);
			ttiplof_padCedula.setAttribute(\'style\',"display:none;");

			var lof_padCedula = document.createElement("input");
			lof_padCedula.setAttribute(\'type\',"text");
			lof_padCedula.setAttribute(\'class\',"form-control");
			lof_padCedula.setAttribute(\'name\',"f_padCedula"+liFila);
			lof_padCedula.setAttribute(\'id\',"f_padCedula"+liFila);
			lof_padCedula.setAttribute(\'value\',loF.f_padCedula.value);
			lof_padCedula.setAttribute(\'size\',"6");
			lof_padCedula.setAttribute(\'placeholder\',"V-99999999");
			lof_padCedula.setAttribute(\'onfocus\',"MaskCedulaNac(this.id)");
			lof_padCedula.setAttribute(\'onblur\',"this.value=this.value.toUpperCase(); vCampoVacio(this.id); BuscaUnPadri(this.id.substring(11));");
			lof_padCedula.setAttribute(\'maxlenght\',"13");

			var halof_padNombres = document.createElement("div"); 
			halof_padNombres.setAttribute(\'class\',"form-group has-default");
			halof_padNombres.setAttribute(\'id\',"haf_padNombres"+liFila);
			
			var ttiplof_padNombres = document.createElement("div");
			ttiplof_padNombres.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padNombres.setAttribute(\'id\',"ttipf_padNombres"+liFila);
			ttiplof_padNombres.setAttribute(\'style\',"display:none;");

			var lof_padNombres = document.createElement("input");
			lof_padNombres.setAttribute(\'type\',"text");
			lof_padNombres.setAttribute(\'class\',"form-control");
			lof_padNombres.setAttribute(\'name\',"f_padNombres"+liFila);
			lof_padNombres.setAttribute(\'id\',"f_padNombres"+liFila);
			lof_padNombres.setAttribute(\'value\',loF.f_padNombres.value);
			lof_padNombres.setAttribute(\'size\',"8");
			lof_padNombres.setAttribute(\'onkeypress\',"vSoloLetras();");
			lof_padNombres.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padNombres.setAttribute(\'maxlenght\',"50");

			var halof_padApellidos = document.createElement("div"); 
			halof_padApellidos.setAttribute(\'class\',"form-group has-default");
			halof_padApellidos.setAttribute(\'id\',"haf_padApellidos"+liFila);
			
			var ttiplof_padApellidos = document.createElement("div");
			ttiplof_padApellidos.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padApellidos.setAttribute(\'id\',"ttipf_padApellidos"+liFila);
			ttiplof_padApellidos.setAttribute(\'style\',"display:none;");

			var lof_padApellidos = document.createElement("input");
			lof_padApellidos.setAttribute(\'type\',"text");
			lof_padApellidos.setAttribute(\'class\',"form-control");
			lof_padApellidos.setAttribute(\'name\',"f_padApellidos"+liFila);
			lof_padApellidos.setAttribute(\'id\',"f_padApellidos"+liFila);
			lof_padApellidos.setAttribute(\'value\',loF.f_padApellidos.value);
			lof_padApellidos.setAttribute(\'size\',"8");
			lof_padApellidos.setAttribute(\'onkeypress\',"vSoloLetras();");
			lof_padApellidos.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padApellidos.setAttribute(\'maxlenght\',"50");

			var halof_padSexo = document.createElement("div"); 
			halof_padSexo.setAttribute(\'class\',"form-group has-default");
			halof_padSexo.setAttribute(\'id\',"haf_padSexo"+liFila);
			
			var ttiplof_padSexo = document.createElement("div");
			ttiplof_padSexo.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padSexo.setAttribute(\'id\',"ttipf_padSexo"+liFila);
			ttiplof_padSexo.setAttribute(\'style\',"display:none;");

			var lof_padSexo = document.getElementById("f_padSexo").cloneNode(true);
			lof_padSexo.setAttribute(\'name\',"f_padSexo"+liFila);
			lof_padSexo.setAttribute(\'id\',"f_padSexo"+liFila);
			lof_padSexo.setAttribute(\'class\',"form-control");
	
			lof_padSexo.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padSexo.removeAttribute("disabled");


			var lobtnQuitar = document.createElement("button");
			lobtnQuitar.setAttribute(\'name\',"btnQuitar"+liFila);
			lobtnQuitar.setAttribute(\'id\',"btnQuitar"+liFila);
			lobtnQuitar.setAttribute(\'class\',"btn btn-default btn-circle");
			lobtnQuitar.setAttribute(\'style\',"width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.428571429");
			lobtnQuitar.setAttribute(\'onclick\',"fpQuitar(this);");

			var lob_iconoboton = document.createElement("i");
			lob_iconoboton.setAttribute(\'class\',"fa fa-minus");
			
			
             // CON EL METODO appendChild(); LOS AGREGO A LA CELDA QUE QUIERO

            loCelda1.appendChild(halof_padCedula).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padCedula).appendChild(ttiplof_padCedula);
            loCelda2.appendChild(halof_padNombres).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padNombres).appendChild(ttiplof_padNombres);
            loCelda3.appendChild(halof_padApellidos).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padApellidos).appendChild(ttiplof_padApellidos);
            loCelda4.appendChild(halof_padSexo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padSexo).appendChild(ttiplof_padSexo);
            loCelda5.appendChild(lobtnQuitar).appendChild(lob_iconoboton);

            
			// document.getElementById("f_padCedula"+liFila).focus();
        }

        function fpQuitar(poB)
        {
			var liFila=Number(loF.txtFila.value);
			liLinea=poB.name.substring(9);
			liN=Number(liLinea);
			liN=liN-1;
            document.getElementById("tabPadrinos").deleteRow(liN);
            liN=liN+2
            for(liY=liN;liY<=liFila;liY++)
            {
				liA=liY-1;
				document.getElementById("f_padCedula"+liY).name="f_padCedula"+liA;
				document.getElementById("f_padCedula"+liY).id="f_padCedula"+liA;
				document.getElementById("f_padNombres"+liY).name="f_padNombres"+liA;
				document.getElementById("f_padNombres"+liY).id="f_padNombres"+liA;
				document.getElementById("f_padApellidos"+liY).name="f_padApellidos"+liA;
				document.getElementById("f_padApellidos"+liY).id="f_padApellidos"+liA;
				document.getElementById("f_padSexo"+liY).name="f_padSexo"+liA;
				document.getElementById("f_padSexo"+liY).id="f_padSexo"+liA;
				document.getElementById("btnQuitar"+liY).name="btnQuitar"+liA;
				document.getElementById("btnQuitar"+liY).id="btnQuitar"+liA;

			}
            liFila=liFila-1;
			loF.txtFila.value=liFila;
        }
       
        function fpEliminaFilas()
        {

        var liFila=Number(loF.txtFila.value);
			if (liFila>0)
			{

	        	for(i=0;i<liFila;i++)
	            {

	            	document.getElementById("tabPadrinos").deleteRow(0);

	        	}
				loF.txtFila.value=0;
			}
        }
		
        function buscar_like(e){
			var parametros = "?AccionGet=buscar_like&txtcadena="+e.value;
			var url = "../cntller/cn_matrimonio.php";
			consulta_ajax(url,parametros);
			document.getElementById("cargar").innerHTML = document.getElementById("temporal").value;
		}

</script>



</html>
'); 






?>
