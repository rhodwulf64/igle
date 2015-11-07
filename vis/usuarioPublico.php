<?php

    session_start();

	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion =new clsFunciones;
	$acciona=$_GET["key"];
   	
	$lsObj=4;	
	$objetivo="Feligrés";


    $lsOperacion=$_GET["lsOperacion"];
	$lsHacer=$_GET["lsHacer"];
	$liHay=$_GET["liHay"];
	$CeduImportada=$_GET["Cedu"];
	$FunIncio="fpInicio();";
	if ($CeduImportada!="")
	{
		if($acciona=="")
		{
			$FunIncio="fpPredeterminado();";
		}
		else
		{
			$FunIncio="fpBusquedaForanea();";
		}
	}

	echo utf8_Decode('
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>Inscripción de '.$objetivo.'</title>

	');
			print(encabezado_menu("../"));

echo utf8_Decode('
		</head>

	<body onload='.$FunIncio.'>
<div class="mygrid-wrapper-div">
<div class="container pre-scrollable" style="margin-top:5px; min-height: 530px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">

	');

	encab("../"); //logo de la iglesia
	menu_general_web(""); //menu principal

	echo utf8_Decode('
		<form name="fr_Persona" id="fr_Persona" action="../cntller/cn_personas.php" method="post">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered table-hover"  border="1" >
						<thead>		
							<tr>
								<th colspan="3"><center>Inscripción de '.$objetivo.'</center></th>
							</tr>
						</thead>
						<tr>
							<th><div class="form-group has-default" id="haf_cedula"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">CI de '.$objetivo.':</font><input type="text" name="f_cedula" id="f_cedula" class="form-control" value="" size="6" maxlength="13" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id); fpPerderFocus(this);" placeholder="V-99999999"><div class="tool-tip  slideIn" id="ttipf_cedula" style="display:none;"></div></div></div></th>
							<th><div class="form-group has-default" id="haf_nombres"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Nombres de '.$objetivo.':</font><input type="text" name="f_nombres" id="f_nombres" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_nombres" style="display:none;"></div></div></div></th>
						</tr>
						<tr>
							<th><div class="form-group has-default" id="haf_apellidos"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Apellidos de '.$objetivo.':</font><input type="text" name="f_apellidos" id="f_apellidos" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_apellidos" style="display:none;"></div></div></div></th>
							');
							if (($lsObj!=2)&&($lsObj!=3))
							{
								$style=' style="display:block;" '; 
							}
							else
							{
								$style=' style="display:none;" '; 
							}
								
							echo utf8_decode('
							<th colspan="2"'.$style.'><div class="form-group has-default" id="haf_sexo"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Sexo:</font><select name="f_sexo" id="f_sexo" value="" class="form-control" onblur="vCampoVacio(this.id);"><option value=""><p><strong></strong></p></option><option value="F"><p><strong>Femenino</strong></p></option><option value="M"><p><strong>Masculino</strong></p></option></select><div class="tool-tip  slideIn" id="ttipf_sexo" style="display:none;"></div></div></div></th>
							');
							
						echo utf8_decode('
						</tr>
						<tr>
							<th><div class="form-group has-default" id="haf_fechaNac"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha de Nacimiento:</font><input type="date" name="f_fechaNac" id="f_fechaNac" class="form-control" onblur="vSoloFechaAnterior(this.id);vMayorDeEdad(this.id);" value=""><div class="tool-tip  slideIn" id="ttipf_fechaNac" style="display:none;"></div></div></div></th>
							<th><div class="form-group has-default" id="haf_telefono"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Teléfono:</font><input type="text" name="f_telefono" id="f_telefono" size="8" maxlenght="12" class="form-control" value="" placeholder="(999)9999999" onfocus="MaskTelefono(this.id)" onkeypress="vSoloTelefono();" onblur="vCampoVacio(this.id);" size="8" maxlenght="12"><div class="tool-tip  slideIn" id="ttipf_telefono" style="display:none;"></div></div></div></th>
						</tr>
						<tr>
							<th>
							<div class="form-group has-default" id="hacmb_Estado"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Estado" name="cmb_Estado" class="form-control" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Estado\',this.id)"><option value="0">*Seleccione Estado</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("estado", "","cod_estado","", ' ',"","descripcion", $selectestado,"", "", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Estado" style="display:none;"></div></div></div>
							<div class="form-group has-default" id="hacmb_Municipio"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Municipio" name="cmb_Municipio" class="form-control" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Municipio\',this.id)"><option value="0">*Seleccione Municipio</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("municipio", "","cod_municipio","", ' ',"","descripcion", $selectmunicipio,"", "cod_foraneo", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Municipio" style="display:none;"></div></div></div>
							<div class="form-group has-default" id="hacmb_Parroquia"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Parroquia" name="cmb_Parroquia" class="form-control" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Parroquia\',this.id)"><option value="0">*Seleccione Parroquia</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("parroquia", "","cod_parroquia","", ' ',"","descripcion", $selectparroquia,"", "cod_foraneo", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Parroquia" style="display:none;"></div></div></div>
							<div class="form-group has-default" id="hacmb_Ciudad"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Ciudad" name="cmb_Ciudad" class="form-control" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Ciudad\',this.id)"><option value="0">*Seleccione Ciudad</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("ciudad", "","cod_ciudad","", ' ',"","descripcion", $selectciudad,"", "cod_foraneo", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Ciudad" style="display:none;"></div></div></div>
							</th>
							<th>
								<div class="form-group has-default" id="haf_direccion">
									<div class="on-focus clearfix" style="position: relative;">
										<span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Dirección:</font>
										<textarea name="f_direccion" id="f_direccion" class="form-control" style="resize:none; overflow-y:scroll; height:100px;" maxlenght="150" onblur="vCampoVacio(this.id);" disabled></textarea>
										<div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;">
										</div>
									</div>
								</div>
								<div class="form-group has-default" id="hacmb_Iglesia">
									<div class="on-focus clearfix" style="position: relative;">
										<span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Parroquia:</font>
											<select id="cmb_Iglesia" name="cmb_Iglesia" class="form-control"  onblur="vCampoVacio(this.id);">
											<option value="0">Seleccione Iglesia</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("tparroquiaiglesia", "","codigoParroquiaIglesia","", ' ',"","nombre", $selectiglesia,"", "", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Iglesia" style="display:none;">
									</div>
								</div>

							</th>
						</tr>
						<tr>
							<th><div class="form-group has-success" id="haf_cedulaMadre"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">CI de</font><font class="control-label" id="ntf_cedulaMadre"> la madre de '.$objetivo.':</font><input type="text" name="f_cedulaMadre" id="f_cedulaMadre" class="form-control" value="" size="6" maxlength="13" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); fpPadres(this);" placeholder="V-99999999 (Opcional)"><div class="tool-tip  slideIn" id="ttipf_cedulaMadre" style="display:none;"></div></div></div></th>
							<th><div class="form-group has-success" id="haf_cedulaPadre"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">CI de</font><font class="control-label" id="ntf_cedulaPadre">l padre de '.$objetivo.':</font><input type="text" name="f_cedulaPadre" id="f_cedulaPadre" class="form-control" value="" size="6" maxlength="13" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); fpPadres(this);" placeholder="V-99999999 (Opcional)"><div class="tool-tip  slideIn" id="ttipf_cedulaPadre" style="display:none;"></div></div></div></th>
						</tr>
						<tr>
							<th colspan="2"><center><h4>Datos Para el Usuario</h4></center></th>
						</tr>
						<tr>
							<th><div class="form-group has-default" id="haf_clavePri"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Contraseña:</font><input type="password" name="f_clavePri" id="f_clavePri" onblur="vCampoVacio(this.id);" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_clavePri" style="display:none;"></div></div></div></th>
							<th><div class="form-group has-default" id="haf_claveSeg"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Repita la Contraseña:</font><input type="password" name="f_claveSeg" id="f_claveSeg" onblur="vCampoVacio(this.id);" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_claveSeg" style="display:none;"></div></div></div></th>
						</tr>
						<tr>
							<th><div class="form-group has-default" id="haf_AskUser"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Pregunta de Seguridad:</font><input type="text" name="f_AskUser" id="f_AskUser" onblur="vCampoVacio(this.id);" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_AskUser" style="display:none;"></div></div></div></th>
							<th><div class="form-group has-default" id="haf_AnswerUser"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Respuesta de Seguridad:</font><input type="text" name="f_AnswerUser" id="f_AnswerUser" onblur="vCampoVacio(this.id);" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_AnswerUser" style="display:none;"></div></div></div></th>
						</tr>		
					</table>
					<br>
				</div>
			</div>
		<div class="container" style="margin-top:5px; padding:5px; min-height: auto; background: #FFFFFF; -webkit-box-shadow: 0px 2px 5px 2px #999; -moz-box-shadow: 2px 2px 5px #999;">
			<table class="table table-striped table-bordered table-hover" border="1" style="margin:0px">
				<tr>
					<th colspan="2"><center>
						<input type="hidden" name="txtOperacion" id="txtOperacion" value="'.$lsOperacion.'">
						<input type="hidden" name="txtHacer" id="txtHacer" value="'.$lsHacer.'">
						<input type="hidden" name="txtHay" id="txtHay" value="'.$liHay.'">
						<input type="hidden" name="lsObj" id="lsObj" value="'.$lsObj.'">
						<input type="hidden" name="auxCiudad" id="auxCiudad" value="">
						<input type="hidden" name="auxMunicipio" id="auxMunicipio" value="">
						<input type="hidden" name="auxParroquia" id="auxParroquia" value="">		
						<input type="hidden" name="temporal" id="temporal" value="">
						<input type="hidden" name="f_refFeligres" id="f_refFeligres" value="">
						<input type="button" class="btn btn-default" name="b_Guardar" value="Guardar" onclick="fpGuardar()">
						<input type="button" class="btn btn-default" name="b_Cancelar" value="Regresar" onclick="window.location.assign(\'../../\');"></center>
					</th>
				</tr>
			</table>
		</div>');

	footer(); // pie de pagina

	echo utf8_decode('</form>
</div>

</body>
	<script>
	var loF=document.fr_Persona;
		function fpInicio()
		{
			fpCancelar();
			fpNuevo();
		}
		
		function fpNuevo()
		{
			fpEncender();
			loF.txtOperacion.value="incluirPublico";
			loF.txtHacer.value="buscar";
			loF.f_cedula.focus();
		}
		
		function fpEncender()
		{
			loF.f_cedula.disabled=false;
			loF.f_nombres.disabled=false;
			loF.f_apellidos.disabled=false;
			loF.f_sexo.disabled=false;
			loF.f_fechaNac.disabled=false;
			loF.f_direccion.disabled=false;
			loF.cmb_Estado.disabled=false;
			loF.cmb_Ciudad.disabled=false;
			loF.cmb_Municipio.disabled=false;
			loF.cmb_Parroquia.disabled=false;
			loF.f_telefono.disabled=false;
			loF.f_cedulaMadre.disabled=false;
			loF.f_cedulaPadre.disabled=false;
			loF.cmb_Iglesia.disabled=false;		
			loF.f_clavePri.disabled=false;		
			loF.f_claveSeg.disabled=false;		
			loF.f_AskUser.disabled=false;		
			loF.f_AnswerUser.disabled=false;		


		}
		
		function fpApagar()
		{
			loF.f_cedula.disabled=true;
			loF.f_nombres.disabled=true;
			loF.f_apellidos.disabled=true;
			loF.f_sexo.disabled=true;
			loF.f_fechaNac.disabled=true;
			loF.f_direccion.disabled=true;
			loF.cmb_Estado.disabled=true;
			loF.cmb_Ciudad.disabled=true;
			loF.cmb_Municipio.disabled=true;
			loF.cmb_Parroquia.disabled=true;
			loF.f_telefono.disabled=true;
			loF.f_cedulaMadre.disabled=true;
			loF.f_cedulaPadre.disabled=true;
			loF.cmb_Iglesia.disabled=true;
			loF.f_clavePri.disabled=true;
			loF.f_claveSeg.disabled=true;
			loF.f_AskUser.disabled=true;
			loF.f_AnswerUser.disabled=true;
			fpCombosDireccion("apagar","");
		}
		
		function fpCancelar()
		{
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.f_refFeligres.value="";
			loF.f_cedula.value="";
			loF.f_nombres.value="";
			loF.f_apellidos.value="";
			loF.f_sexo.value="N";
			loF.f_fechaNac.value="";
			loF.f_direccion.value="";
			loF.f_telefono.value="";
			loF.f_cedulaMadre.value="";
			loF.f_cedulaPadre.value="";
			loF.f_clavePri.value="";
			loF.f_claveSeg.value="";
			loF.f_AskUser.value="";
			loF.f_AnswerUser.value="";
			loF.cmb_Estado.value="0";
			loF.cmb_Ciudad.value="0";
			loF.cmb_Municipio.value="0";
			loF.cmb_Parroquia.value="0";
			loF.cmb_Iglesia.value="0";


			document.getElementById("ntf_cedulaMadre").innerHTML=" la madre de '.$objetivo.'";
			document.getElementById("haf_cedula").className = "form-group has-default";
			document.getElementById("ntf_cedulaPadre").innerHTML="l padre de '.$objetivo.'";
			document.getElementById("haf_nombres").className = "form-group has-default";
			document.getElementById("haf_apellidos").className = "form-group has-default";
			document.getElementById("haf_sexo").className = "form-group has-default";
			document.getElementById("haf_fechaNac").className = "form-group has-default";
			document.getElementById("haf_telefono").className = "form-group has-default";
			document.getElementById("haf_direccion").className = "form-group has-default";
			document.getElementById("hacmb_Estado").className = "form-group has-default";
			document.getElementById("hacmb_Ciudad").className = "form-group has-default";
			document.getElementById("hacmb_Municipio").className = "form-group has-default";
			document.getElementById("hacmb_Parroquia").className = "form-group has-default";
			document.getElementById("haf_cedulaMadre").className = "form-group has-default";
			document.getElementById("haf_cedulaPadre").className = "form-group has-default";
			document.getElementById("hacmb_Iglesia").className = "form-group has-default";
			document.getElementById("haf_clavePri").className = "form-group has-default";
			document.getElementById("haf_claveSeg").className = "form-group has-default";
			document.getElementById("haf_AskUser").className = "form-group has-default";
			document.getElementById("haf_AnswerUser").className = "form-group has-default";

			fpApagar();
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
			

			loF.f_cedula.value=lke.nvaCedula.value;
			loF.f_refFeligres.value=lke.nvaidPersona.value;
			loF.f_cedula.disabled=false;
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.txtHay.value="0";
			fpPerderFocus(loF.f_cedula);

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
			loF.f_cedula.disabled=false;
			loF.f_cedula.focus();
		}

		function fpCombosDireccion(orden,objeto)
		{
				var avanza=0;
				var opcciudad = loF.auxCiudad.value;
				var opcmunicipio = loF.auxMunicipio.value;
				var opcparroquia = loF.auxParroquia.value;


			if (orden=="apagar")
			{
				if ((loF.auxCiudad.value=="")&&(loF.auxMunicipio.value=="")&&(loF.auxParroquia.value==""))
				{
					loF.auxCiudad.value=$("#cmb_Ciudad option").length;
					loF.auxMunicipio.value=$("#cmb_Municipio option").length;
					loF.auxParroquia.value=$("#cmb_Parroquia option").length;
				}
				opcciudad = loF.auxCiudad.value;
				opcmunicipio = loF.auxMunicipio.value;
				opcparroquia = loF.auxParroquia.value;

							
				for (i = 1; i < opcmunicipio; i++)
				{ 
					avanza=$(\'select#cmb_Municipio option\').eq(1).val();
					$("#cmb_Municipio").hideOption(avanza);
				}
				
					
				for (i = 1; i < opcparroquia; i++)
				{ 
					avanza=$(\'select#cmb_Parroquia option\').eq(1).val();
					$("#cmb_Parroquia").hideOption(avanza);
				}
					
				for (i = 1; i < opcciudad; i++)
				{ 
					avanza=$(\'select#cmb_Ciudad option\').eq(1).val();
					$("#cmb_Ciudad").hideOption(avanza);
				
				}
			}
			if (orden=="Estado")
			{
				for (i = 1; i < opcmunicipio; i++)
				{ 
					avanza=$(\'select#cmb_Municipio option\').eq(1).val();
					$("#cmb_Municipio").hideOption(avanza);
				}
				for (i = 1; i < opcparroquia; i++)
				{ 
					avanza=$(\'select#cmb_Parroquia option\').eq(1).val();
					$("#cmb_Parroquia").hideOption(avanza);
				}
				for (i = 1; i < opcciudad; i++)
				{ 
					avanza=$(\'select#cmb_Ciudad option\').eq(1).val();
					$("#cmb_Ciudad").hideOption(avanza);
				
				}
				var valorAmostrar = $("#"+objeto+" option:selected").val();
				var o=0;
				for (i = 1; i < opcmunicipio; i++)
				{ 
					$("#cmb_Municipio").showOption(i);
					if (document.getElementById("Mu"+i)==null)
					{	
						do{
							i++;
							opcmunicipio++;
							$("#cmb_Municipio").showOption(i);	
						}while (document.getElementById("Mu"+i)==null);											
					}
					if (document.getElementById("Mu"+i).className!="Mu"+valorAmostrar)
					{
						$("#cmb_Municipio").hideOption(i);
					}
				}
				$("#cmb_Municipio").focus();
				
			}
			if (orden=="Municipio")
			{
				for (i = 1; i < opcparroquia; i++)
				{ 
					avanza=$(\'select#cmb_Parroquia option\').eq(1).val();
					$("#cmb_Parroquia").hideOption(avanza);
				}
				for (i = 1; i < opcciudad; i++)
				{ 
					avanza=$(\'select#cmb_Ciudad option\').eq(1).val();
					$("#cmb_Ciudad").hideOption(avanza);
				
				}
				var valorAmostrar = $("#"+objeto+" option:selected").val();
				var o=0;
				for (i = 1; i < opcparroquia; i++)
				{ 
					$("#cmb_Parroquia").showOption(i);
					if (document.getElementById("Pa"+i)==null)
					{	
						do{
							i++;
							opcparroquia++;
							$("#cmb_Parroquia").showOption(i);	
						}while (document.getElementById("Pa"+i)==null);											
					}
					if (document.getElementById("Pa"+i).className!="Pa"+valorAmostrar)
					{
						$("#cmb_Parroquia").hideOption(i);
					}
				}
				$("#cmb_Parroquia").focus();
	  		}
			if (orden=="Parroquia")
			{					
				for (i = 1; i < opcciudad; i++)
				{ 
					avanza=$(\'select#cmb_Ciudad option\').eq(1).val();
					$("#cmb_Ciudad").hideOption(avanza);
				
				}
				var valorAmostrar = $("#"+objeto+" option:selected").val();
				var o=0;
				for (i = 1; i < opcciudad; i++)
				{ 
					$("#cmb_Ciudad").showOption(i);
					if (document.getElementById("Ci"+i)==null)
					{	
						do{
							i++;
							opcciudad++;
							$("#cmb_Ciudad").showOption(i);	
						}while (document.getElementById("Ci"+i)==null);											
					}
					if (document.getElementById("Ci"+i).className!="Ci"+valorAmostrar)
					{
						
						$("#cmb_Ciudad").hideOption(i);
					}
				}
				$("#cmb_Ciudad").focus();
	  		}
	  	
		}
		
		function fpPerderFocus(Rcampo)
		{

			if((loF.f_cedula.value!="")&&(loF.txtHacer.value=="buscar")&&(loF.f_cedula.value.trim().length>7))
			{
				
						
				var $forme = $("#fr_Persona");

					$.ajax({
						url: \'../cntller/cn_personas.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var persona=data[\'Person\'];
           					var padres=data[\'Padres\'];
							if((persona.lsCedula!=""))
							{
									if((loF.txtHacer.value=="buscar")&&(persona.liHay==1))
									{
										Rcampo.value = persona.lsCedula;
										document.getElementById("haf_cedula").className = "form-group has-danger";
										loF.f_refFeligres.value = persona.lsIDpersona;
										loF.f_nombres.value = persona.lsNombre;
										loF.f_apellidos.value = persona.lsApellido;
										loF.f_sexo.value = persona.lsSexo;
										loF.f_fechaNac.value = persona.lsFechaNaci;
										loF.f_telefono.value = persona.lsTelefono;
										loF.f_direccion.value = persona.lsDireccion;
										loF.f_cedulaMadre.value = persona.lsCedulaMadre;
										loF.f_AskUser.value = persona.lsPreguntaSecreta;
										loF.f_AnswerUser.value = persona.lsRespuestaSecreta;
										document.getElementById("ntf_cedulaMadre").innerHTML=" "+persona.lsNombMadre+" (Madre)";
										loF.f_cedulaPadre.value = persona.lsCedulaPadre;
										document.getElementById("ntf_cedulaPadre").innerHTML=" "+persona.lsNombPadre+" (Padre)";
										Rcampo.disabled=true;

										fpApagar();

										if (loF.txtOperacion.value=="incluirPublico")
										{
											NotificaE("Esta cedula ya se encuentra registrada");
											fpNuevo();
									
										}
										$("#cmb_Ciudad").showOption(persona.lsCiudad);
										$("#cmb_Municipio").showOption(persona.lsMunicipio);
										$("#cmb_Parroquia").showOption(persona.lsParroquia);
										loF.cmb_Estado.value = persona.lsEstado;
										loF.cmb_Ciudad.value = persona.lsCiudad;
										loF.cmb_Municipio.value = persona.lsMunicipio;
										loF.cmb_Parroquia.value = persona.lsParroquia;
										loF.cmb_Iglesia.value = persona.lsIglesia;
									}
													
									if((loF.txtOperacion.value=="incluirPublico")&&(loF.txtHacer.value=="incluir")&&(persona.liHay==0))
									{
										NotificaE(\'No se pudo registrar el Feligres\');
										Rcampo.disabled=true;
										loF.f_nombres.focus();
										loF.txtOperacion.value="incluirPublico";
										loF.txtHacer.value="incluir";
										loF.txtHay.value=0;

									}

									if((loF.txtOperacion.value=="incluirPublico")&&(loF.txtHacer.value=="buscar")&&(persona.liHay==0))
									{
										document.getElementById("haf_cedula").className = "form-group has-success";
										Rcampo.disabled=true;
										loF.f_nombres.focus();
										loF.txtOperacion.value="incluirPublico";
										loF.txtHacer.value="incluir";
										loF.txtHay.value=0;

									}

									if ((loF.txtOperacion.value=="buscar")&&(loF.txtHacer.value=="buscar")&&(persona.liHay==0))
									{
										loF.txtOperacion.value="buscar";
										loF.txtHacer.value="buscar";
										loF.txtHay.value="0";
										Rcampo.value="";
										Rcampo.focus();
										NotificaE("No se encontro Feligres con la cedula ingresada.")
									}

							
							}
						}
					});
		
			}
			else
			{
				NotificaW("Ingrese un número de cedula valido.")
				loF.f_cedula.focus();
			}
		
		}

		function fpPredeterminado()
		{
			fpApagar();
			var Cedu="'.$CeduImportada.'";
			if (Cedu!="")
			{
				fpEncender();
				document.getElementById("haf_cedula").className = "form-group has-success";
				loF.f_cedula.disabled=true;
				loF.txtOperacion.value="incluirPublico";
				loF.txtHacer.value="incluirPublico";
				loF.txtHay.value=0;
				loF.f_cedula.value=Cedu;
				loF.f_nombres.focus();

			}
		}
		function fpBusquedaForanea()
		{
			loF.f_cedula.value="'.$CeduImportada.'";
			loF.f_cedula.disabled=false;
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.txtHay.value=0;
			fpPerderFocus(document.getElementById("f_cedula"));
		}

		function fpPadres(PCampos)
		{
				var OperacionOld=loF.txtOperacion.value;	//respalda operacion principal
				var HacerOld=loF.txtHacer.value;	//respalda hacer
				loF.txtOperacion.value="ExaminaPadre";	
				loF.txtHacer.value=PCampos.id;	
				var $forme = $("#fr_Persona");

					$.ajax(
					{
						url: \'../cntller/cn_personas.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var persona=data[\'Person\'];
           					var padres=data[\'Padres\'];
							if((persona.lsCedula!=""))
							{

								if((persona.lsOperacion=="ExaminaPadre")&&(persona.liHay==1))
								{
									PCampos.value = persona.lsCedula;
									document.getElementById("ha"+PCampos.id).className = "form-group has-success";
									document.getElementById("nt"+PCampos.id).innerHTML=" "+persona.lsNombre;
									PCampos.disabled = true;

								}
								else if((persona.lsOperacion=="ExaminaPadre")&&(persona.liHay==0))
								{
									document.getElementById("ha"+PCampos.id).className = "form-group has-warning";
									document.getElementById("nt"+PCampos.id).innerHTML=" "+" (No especificado)";
								}

								if((persona.lsOperacion=="ExaminaPadre")&&(persona.liHay==3))
								{
									PCampos.value = persona.lsCedula;
									document.getElementById("ha"+PCampos.id).className = "form-group has-error";

							 	 	NotificaE("Lo siento, la cedula ingresada no es del sexo femenino");
									PCampos.value="";
									PCampos.focus();
									

								}
								if((persona.lsOperacion=="ExaminaPadre")&&(persona.liHay==4))
								{
									PCampos.value = persona.lsCedula;
									document.getElementById("ha"+PCampos.id).className = "form-group has-error";

							 	 	NotificaE("Lo siento, la cedula ingresada no es del sexo masculino");
									PCampos.value="";
									PCampos.focus();

								}

							}
						}
					});

				loF.txtOperacion.value=OperacionOld; //restaura operacion principal
				loF.txtHacer.value=HacerOld; //restaura hacer anterior
		}
			
		
		function fpGuardar()
		{
			if(fbValidar())
			{
				loF.f_cedula.disabled=false;
				loF.f_cedulaMadre.disabled=false;
				loF.f_cedulaPadre.disabled=false;

				var $forme = $("#fr_Persona");
				var Cedu=\''.$CeduImportada.'\';
				var pagAnterior=\'solicitudes.php\';
					$.ajax(
					{
						url: \'../cntller/cn_personas.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var persona=data[\'Person\'];
           					var padres=data[\'Padres\'];
							if((persona.liHay!=""))
							{
								if ((loF.txtHacer.value=="incluir")&&(persona.liHay==0))
								{

									NotificaE("El Registro no se pudo incluir.");

								}

								if ((loF.txtHacer.value=="incluir")&&(Cedu=="")&&(persona.liHay==1))
								{

									NotificaS("Registro incluido con exito.");
									fpCancelar();
									
									setTimeout(function(){ window.location=pagAnterior; }, 1000);

								}
										
								if ((loF.txtHacer.value=="incluir")&&(Cedu!="")&&(persona.liHay==1))
								{

									NotificaS("Registro incluido con exito.");
									fpCancelar();
									setTimeout(function(){ window.location=pagAnterior; }, 1000);

								}
								

							}
						}
					});


			}
		}
		
		function fbValidar()
		{
			var lbValido=false;
			var invalido=0;
			
			if(vCampoVacio("f_cedula"))
			{
				invalido=1;
			}
			if(vCampoVacio("f_nombres"))
			{
				invalido=1;
			}
			if(vCampoVacio("f_apellidos"))
			{
				invalido=1;
			}');

				if (($lsObj!=2)&&($lsObj!=3))
				{
				echo utf8_decode('

					if(vCampoVacio("f_sexo"))
					{
						invalido=1;
					}

					');
			}
		echo utf8_decode('
			if(vCampoVacio("f_fechaNac"))
			{
				invalido=1;
			}
			if(vMayorDeEdad("f_fechaNac")==false)
			{
				invalido=1;
			}
			if(vCampoVacio("f_direccion"))
			{
				invalido=1;
			}
			if(vCampoVacio("f_telefono"))
			{
				invalido=1;
			}
			if(vCampoVacioDireccion("cmb_Estado"))
			{
				invalido=1;
			}
			if(vCampoVacioDireccion("cmb_Ciudad"))
			{
				invalido=1;
			}
			if(vCampoVacioDireccion("cmb_Municipio"))
			{
				invalido=1;
			}
			if(vCampoVacioDireccion("cmb_Parroquia"))
			{
				invalido=1;
			}
			if(vCampoVacio("cmb_Iglesia"))
			{
				invalido=1;
			}
			if(vCampoVacio("f_clavePri"))
			{
				invalido=1;
			}
			if(vCampoVacio("f_claveSeg"))
			{
				invalido=1;
			}
			if(loF.f_clavePri.value != loF.f_claveSeg.value)
			{
				NotificaE("Las Claves ingresadas no coinciden");
				loF.f_clavePri.value="";
				loF.f_claveSeg.value="";
				loF.f_clavePri.focus();
			}
			if(vCampoVacio("f_AskUser"))
			{
				invalido=1;
			}
			if(vCampoVacio("f_AnswerUser"))
			{
				invalido=1;
			}

			if (invalido==0)
			{
				lbValido=true;
			}
			return lbValido;
		}
		
		
		function buscar_like(e){
			var parametros = "?AccionGet=buscar_like&txtcadena="+e.value;
			var url = "../cntller/cn_personas.php";
			consulta_ajax(url,parametros);
			document.getElementById("cargar").innerHTML = document.getElementById("temporal").value;
		}

</script>
</html>
'); 

?>
