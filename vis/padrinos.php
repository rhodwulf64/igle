<?php


	
  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
	
	require_once("menu_principal.php");
	require_once("encabezado.php");
	
    $lsOperacion=$_GET["lsOperacion"];
	$lsHacer=$_GET["lsHacer"];
	$liHay=$_GET["liHay"];
	$lsCedulaRepre=$_GET["lsCedulaRepre"];
	$lsNombreRepre=$_GET["lsNombreRepre"];
	$lsApellidoRepre=$_GET["lsApellidoRepre"];
	$lsRepresentados=$_GET["lsRepresentados"];
	$lsRepresenNumeros=$_GET["lsRepresenNumeros"];
	$lsRepresenCanti=$_GET["lsRepreCanti"];
					$lsNumPartidaNac=$_GET["lsNumPartidaNac"];
					$lsFechaInscri=$_GET["lsFechaInscri"];
					$lsFechaBautizo=$_GET["lsFechaBautizo"];
					$lsNombres=$_GET["lsNombres"];
					$lsApellidos=$_GET["lsApellidos"];

					$lsSexo=$_GET["lsSexo"];
					${$lsSexo."ada"}="selected";
					$lsFechaNacimiento=$_GET["lsFechaNacimiento"];
					$lsBautizado=$_GET["lsBautizado"];
					$lsIDrepresentante=$_GET["lsIDrepresentante"];
					$lsIDparentescoRep=$_GET["lsIDparentescoRep"];
					$lsIDFmama=$_GET["lsIDFmama"];
					$lsIDFpapa=$_GET["lsIDFpapa"];
					$lsIDFsacerdote=$_GET["lsIDFsacerdote"];
					$lsNumPartidaNac=$_GET["lsNumPartidaNac"];
					$lsEstatus=$_GET["lsEstatus"];


echo utf8_Decode('
<html>
	<head>
		<title>'.$_SESSION['title'].' - Inscripción de Padrinos</title>
		');print(encabezado_menu("../"));
echo utf8_Decode('
	</head>

	<body onload="fpInicio()">


	');

	encab("../");
	menu_general("");

	echo utf8_Decode('
	<center>
	<div class="formuRegistros">
		<form name="fr_Bautismo" id="fr_Bautismo" action="../cntller/cn_bautismo.php?lsCedulaRepre='.$lsCedulaRepre.'" method="post">

		<table id="tablaReg"  border="1" class="Registros_tabla">
		<tr>
			<td colspan="2" align="center"><font class="Registros_tabla_titulo">Inscripción de Padrinos de Bautismo</font>

			</td>
		</tr>

		<tr>
			<td><font class="Registros_tabla_descripciones">CI del Representante:</font></td>
			<td><input type="text" id="f_cedulaRepre" name="f_cedulaRepre" class="Registros_tabla_campos" value="'.$lsCedulaRepre.'" onblur="fpPerderFocus()"></td>
		</tr>
		<tr id="filaOcultaRepresentante">
			<td><font class="Registros_tabla_descripciones">Representados de: </font><br><font color="green" id="ParamNombreMostrar">'.$lsNombreRepre.' '.$lsApellidoRepre.'</font></td>
			<td>
				<select size="3" id="ComboRepresentados" name="decision" onchange="fpSelectCombo()">
				</select>
			</td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Numero de la Partida</font><br><font>de Nacimiento del niño:</font></td>
			<td><input type="text" id="f_numParNaci" name="f_numParNaci" class="Registros_tabla_campos" value="'.$lsNumPartidaNac.'" onblur="fpPerderFocusBauti()"></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Nombres del niño:</font></td>
			<td><input type="text" id="f_nombres" name="f_nombres" class="Registros_tabla_campos" value="'.$lsNombres.'"></td>
		</tr>		
		<tr>
			<td><font class="Registros_tabla_descripciones">Apellidos del niño:</font></td>
			<td><input type="text" id="f_apellidos" name="f_apellidos" class="Registros_tabla_campos" value="'.$lsApellidos.'"></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Sexo del niño:</font></td>
			<td><select name="f_sexo" id="Sexo" value=""><option value="N" '.$Nada.'><p><strong></strong></p></option><option value="F" '.$Fada.'><p><strong>F</strong></p></option><option value="M" '.$Mada.'><p><strong>M</strong></p></option></select></td>

		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Fecha de Nacimiento:</font></td>
			<td><input type="date" id="f_fechaNac" name="f_fechaNac" class="Registros_tabla_campos" value="'.$lsFechaNacimiento.'"></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Fecha del Bautizo:</font></td>
			<td><input type="date" id="f_fechaBau" name="f_fechaBau" class="Registros_tabla_campos" value="'.substr($lsFechaBautizo,0,10).'"></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Hora del Bautizo:</font></td>
			<td><input type="time" id="f_horaBau" name="f_horaBau" class="Registros_tabla_campos" value="'.substr($lsFechaBautizo,11,8).'"></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Cantidad de Padrinos:</font></td>
			<td><input type="text" id="f_CantPadrinos" name="f_CantPadrinos" class="Registros_tabla_campos" value="'.$lsCantidadPadrinos.'"></td>
		</tr>
		<tr>
					<td colspan="2">
					<input type="hidden" name="f_ceduModifi" id="f_ceduModifi" value="'.$lsCedula.'">
					<input type="hidden" name="txtOperacion" id="txtOperacion" value="'.$lsOperacion.'">
					<input type="hidden" name="txtHacer" id="txtHacer" value="'.$lsHacer.'">
					<input type="hidden" name="txtHay" id="txtHay" value="'.$liHay.'">
					<input type="hidden" name="lsNombreRepre" id="lsNombreRepre" value="'.$lsNombreRepre.'">
					<input type="hidden" name="lsApellidoRepre" id="lsApellidoRepre" value="'.$lsApellidoRepre.'">
					<input type="hidden" name="lsRepresentados" id="lsRepresentados" value="'.$lsRepresentados.'">
					<input type="hidden" name="lsRepresenNumeros" id="lsRepresenNumeros" value="'.$lsRepresenNumeros.'">
					<input type="hidden" name="lsRepresenCanti" id="lsRepresenCanti" value="'.$lsRepresenCanti.'">	
					<input type="hidden" name="varScriptFocus" id="varScriptFocus" value="1">					
					<input type="button" class="Registros_tabla_botones" name="b_Nuevo" value="Nuevo" onclick="fpNuevo()">
					<input type="button" class="Registros_tabla_botones" name="b_Modificar" value="Modificar" onclick="fbModificar()">
					<input type="button" class="Registros_tabla_botones" name="b_Buscar" value="Buscar" onclick="fpBuscar()">
					<input type="button" class="Registros_tabla_botones" name="b_Eliminar" value="Eliminar" onclick="fbEliminar()">
					<input type="button" class="Registros_tabla_botones" name="b_Guardar" value="Guardar" onclick="fpGuardar()">
					<input type="button" class="Registros_tabla_botones" name="b_Cancelar" value="Cancelar" onclick="fpCancelar()"></td>
		</tr>
		
		</table>
		</form>
	</div>
	</center>
</body>
<script>
	var loF=document.fr_Bautismo;
	
	function fpInicio()
		{

		switch(loF.txtOperacion.value)
			{
				case "":
					fpInicial();
			
						
					fpCancelar();
					break;
				case "buscar":
					if(loF.txtHay.value==1)
					{
						
						fpApagarBauti();

						fpCambioN();
						loF.txtOperacion.value="buscarNumParti";
						loF.txtHacer.value="buscarNumParti";
						loF.f_cedulaRepre.disabled=true;
						loF.f_numParNaci.focus();
						fpMuestraRepresentados();


					}
					else
					{
						var NuevoRepresentante = confirm("El representante con la Cedula ingresada no existe, desea registrarlo ahora?");
						
						
						if (NuevoRepresentante){
							var url1 = "personas.php?obj=1&lsCedula=";
							var url2 = "&lsNombre=&lsApellido=&lsSexo=&lsFechaNaci=&lsDireccion=&lsTelefono=&lsFechaRegistro=&lsGradoEstudio=1&lsTallaFranela=1&lsOperacion=incluir&liHay=0&lsHacer=buscar";
							loF.f_ceduModifi.value=loF.f_cedulaRepre.value;
							var variParam = loF.f_ceduModifi.value;
							var urlfin = url1+variParam+url2;
								window.location=urlfin;

						}
						else{
							window.location="bautismo.php";
						}
						
					}
					break;
				case "buscarNumParti":
					if(loF.txtHay.value==1)
					{
						
						fpApagarBauti();
						fpCambioNSegundo();
						loF.txtOperacion.value="buscarNumParti";
						loF.txtHacer.value="buscarNumParti";
						loF.f_cedulaRepre.disabled=true;
						loF.f_numParNaci.focus();
						fpMuestraRepresentados();


					}
					else
					{
						if(confirm("No se encontro ningun niño con la referencia indicada, Desea registrar uno nuevo?"))
						{
							fpInicial();
							fpCancelar();
							fpNuevo();
						}
					}

					break;


				case "incluir":
					if ((loF.txtHacer.value=="buscar")&&(loF.txtHay.value==1))
					{
						alert("Ese Registro Existe");
						fpCambioE();
						fpApagar();
					}
					if((loF.txtHacer.value=="buscar")&&(loF.txtHay.value==0))
					{
						loF.txtOperacion.value="incluir";
						loF.txtHacer.value="incluir";
						loF.txtHay.value=0;
						fpCambioN();
						fpEncender();
						loF.f_numParNaci.focus();
					}
					if((loF.txtHacer.value=="incluir")&&(loF.txtHay.value==1))
					{
						alert("Registro Incluido");
						fpInicial();
						fpCancelar();
					}
					if((loF.txtHacer.value=="incluir")&&(loF.txtHay.value==2))
					{
						alert("Registro No Incluido");
						fpInicial();
						fpCancelar();
					}
					break;
				case "modificar":
					if(loF.txtHay.value==1)
					{
						alert("Registro Modificado");
						fpInicial();
						fpCancelar();
					}
					else
					{
						alert("Registro No Modificado");
						fpInicial();
						fpCancelar();
					}
					break;
				case "eliminar":
					if(loF.txtHay.value==1)
					{
						alert("Registro Eliminado");
						fpInicial();
						fpCancelar();
					}
					else
					{
						alert("Registro No Eliminado");
						fpInicial();
						fpCancelar();
					}
					break;

			}
		}
		
		function fpMuestraRepresentados()
		{
			var originStn ="'.$lsRepresentados.'";
			var originNum ="'.$lsRepresenNumeros.'"
			var cantStn ="'.$lsRepresenCanti.'";
			var ArNombresRepresen = originStn.split("*");
			var ArNumerosRepresen = originNum.split("*");
			for (i = 1; i <= cantStn; i++) 
			{ 
				var ComboRepresen = document.getElementById("ComboRepresentados");
				var option = document.createElement("option");
				option.text = ArNombresRepresen[i];
				option.value = ArNumerosRepresen[i];
				ComboRepresen.add(option);

			}
		}
		function fpSelectCombo(){

			var ComboRepresen = document.getElementById("ComboRepresentados").value;
			loF.txtHacer.value="buscarNumParti";
			loF.txtOperacion.value="buscarNumParti";
			loF.f_numParNaci.value=ComboRepresen;
			loF.varScriptFocus.value="0";
			document.getElementById("ComboRepresentados").blur()
			loF.f_numParNaci.focus();



		}

		function fpNuevo()
		{
			fpCambioN();
			fpEncender();
			loF.txtOperacion.value="incluir";
			loF.txtHacer.value="buscar";
			loF.f_cedulaRepre.focus();
		}
		
		function fpEncender()
		{
			loF.f_cedulaRepre.disabled=true;
			document.getElementById("ComboRepresentados").disabled=true;
			loF.f_numParNaci.disabled=true;
			loF.f_nombres.disabled=false;
			loF.f_apellidos.disabled=false;
			loF.f_sexo.disabled=false;
			loF.f_fechaNac.disabled=false;
			loF.f_fechaBau.disabled=false;
			loF.f_horaBau.disabled=false;
			loF.f_CantPadrinos.disabled=false;
		}
		
		function fpApagar()
		{
			loF.f_cedulaRepre.disabled=true;
			loF.f_numParNaci.disabled=true;
			loF.f_nombres.disabled=true;
			loF.f_apellidos.disabled=true;
			loF.f_sexo.disabled=true;
			loF.f_fechaNac.disabled=true;
			loF.f_fechaBau.disabled=true;
			loF.f_horaBau.disabled=true;
			loF.f_CantPadrinos.disabled=true;
		}



		function fpApagarBauti()
		{
			loF.f_cedulaRepre.disabled=true;
			loF.f_numParNaci.disabled=false;
			loF.f_nombres.disabled=true;
			loF.f_apellidos.disabled=true;
			loF.f_sexo.disabled=true;
			loF.f_fechaNac.disabled=true;
			loF.f_fechaBau.disabled=true;
			loF.f_horaBau.disabled=true;
			loF.f_CantPadrinos.disabled=true;
		}
		
		function fpCancelar()
		{
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.f_cedulaRepre.value="";
			loF.f_numParNaci.value="";
			loF.f_nombres.value="";
			loF.f_apellidos.value="";
			loF.f_sexo.value="N";
			loF.f_fechaNac.value="";
			loF.f_fechaBau.value="";
			loF.f_horaBau.value="";
			loF.f_CantPadrinos.value="";
			document.getElementById("ParamNombreMostrar").hidden="true";
			document.getElementById("filaOcultaRepresentante").style.display = \'none\';
			fpApagar();
			fpInicial();
		}
		
		function fpBuscar()
		{
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.f_cedulaRepre.disabled=false;
			fpCambioB();
			loF.f_cedulaRepre.focus();
		}
		
		function fpPerderFocus()
		{

			if((loF.f_cedulaRepre.value!="")&&(loF.txtHacer.value=="buscar"))
			{
				loF.submit();
			}
			else
			{
				loF.f_cedulaRepre.focus();
			}
		}


		function fpPerderFocusBauti()
		{
			if ((loF.varScriptFocus.value=="0"))
			{	

				if((loF.f_numParNaci.value!="")&&(loF.txtHacer.value=="buscarNumParti"))
					{
						loF.submit();
					}
				else
					{
						loF.f_numParNaci.focus();
					}
			}else{
				loF.varScriptFocus.value="0";
			}

		}


		function fpGuardar()
		{
			if(fbValidar())
			{
				loF.f_cedulaRepre.disabled=false;
				loF.submit();
			}
		}
		
		function fbValidar()
		{
			var lbValido=false;
			
			if(loF.f_cedulaRepre.value=="")
			{
				alert("Cédula en Blanco");
				loF.f_cedulaRepre.value="";
				loF.f_cedulaRepre.focus();
			}
			else if(loF.f_numParNaci.value=="")
			{
				alert("Nombre en Blanco");
				loF.f_numParNaci.value="";
				loF.f_numParNaci.focus();
			}
			else if(loF.f_nombres.value=="")
			{
				alert("Apellido en Blanco");
				loF.f_nombres.value="";
				loF.f_nombres.focus();
			}
			else if((loF.f_apellidos.checked==false)&&(loF.f_fechaNac.checked==false)&&(loF.f_fechaBau.checked==false))
			{
				alert("Rol sin Seleccionar");
				loF.f_apellidos.focus();
			}
			else if(loF.f_horaBau.value=="")
			{
				alert("Contraseña en Blanco");
				loF.f_horaBau.value="";
				loF.f_horaBau.focus();
			}
			else
			{
				lbValido=true;
			}
			return lbValido;
		}
		
		function fbModificar()
		{
			fpEncender();
			fpCambioN();
			loF.txtOperacion.value="modificar";
			loF.txtHacer.value="modificar";
			loF.f_cedulaRepre.disabled=true;
			loF.f_nombres.focus();
		}
		
		function fbEliminar()
		{
			if(fpCuestionamiento("Eliminar",loF.f_nombres.value+" "+loF.f_apellidos.value,"Sacramento de Bautismo?"))
			{
				loF.f_cedulaRepre.disabled=false;
				loF.f_numParNaci.disabled=false;
				loF.txtOperacion.value="desactivar";
				loF.txtHacer.value="eliminar";
				loF.submit();
			}
		}

</script>

	</html>
'); 






?>
