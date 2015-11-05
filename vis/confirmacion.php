<?php


  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}

	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion = new clsFunciones;
	echo utf8_Decode('

<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Inscripción de Confirmación</title>
		');
			print(encabezado_menu("../"));

	echo utf8_Decode('
		</head>
		<body onload="fpInicio();">
	<div class="mygrid-wrapper-div">
	<div class="container pre-scrollable" style="margin-top:5px; min-height: 530px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">

		');
		encab("../");
		menu_general("");
		
echo utf8_Decode('
		<form name="fr_confirmacion" id="fr_confirmacion" action="../con/cn_comunion.php" method="post">
			<div class="col-lg-12">
				<table class="table table-striped table-bordered table-hover"  border="1" >
					<thead>		
						<tr>
							<th colspan="3"><center>Inscripción de Confirmación</center></th>
						</tr>
					</thead>
					<tr id="filaOcultaPartiNaci">
						<th><div class="form-group has-default" id="haf_PartiPrefectura"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Reg. Civil Prefectura de:</font><br><input type="text" size="12" maxlength="15" id="f_PartiPrefectura" name="f_PartiPrefectura" class="form-control" value="" onkeypress="vAlfaNum();" onblur="fpCreaReferencia(1,this.id,\'\');"><div class="tool-tip  slideIn" id="ttipf_PartiPrefectura" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_PartiPresentado"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Presentado(a) El:</font><br><input type="date" size="12" maxlength="12" id="f_PartiPresentado" name="f_PartiPresentado" class="form-control" onblur="fpCreaReferencia(2,this.id,\'date\');" value=""><div class="tool-tip  slideIn" id="ttipf_PartiPresentado" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_PartiNumero"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Bajo el Número:</font><br><input type="text" size="6" maxlength="20" id="f_PartiNumero" name="f_PartiNumero" class="form-control" value="" onkeypress="vSoloNumeros();" onblur="fpCreaReferencia(3,this.id,\'\');"><div class="tool-tip  slideIn" id="ttipf_PartiNumero" style="display:none;"></div></div></div></th>
					</tr>
					<tr>
						<th><div class="form-group has-default" id="haf_cedulaEstu"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">CI del Participante: <input type=radio id="radNoCI" value="radNoCI" onclick="fpMuestraSinCedula()">¿No posee CI?</font><input type="text" name="f_cedulaEstu" id="f_cedulaEstu" class="form-control" value="" size="6" maxlength="13" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id); fpPerderFocus();" placeholder="V-99999999"><div class="tool-tip  slideIn" id="ttipf_cedulaEstu" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_nombres"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Nombres:</font><input type="text" id="f_nombres" name="f_nombres" class="form-control" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);" value=""><div class="tool-tip  slideIn" id="ttipf_nombres" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_apellidos"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Apellidos:</font><input type="text" name="f_apellidos" id="f_apellidos" class="form-control" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);" value=""><div class="tool-tip  slideIn" id="ttipf_apellidos" style="display:none;"></div></div></div></th>
					</tr>
					<tr>
						<th><div class="form-group has-default" id="haf_sexo"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Sexo:</font><br><select name="f_sexo" id="f_sexo" class="form-control" onblur="vCampoVacio(this.id);" value=""><option value="" ><p><strong></strong></p></option><option value="F" ><p><strong>F</strong></p></option><option value="M"><p><strong>M</strong></p></option></select><div class="tool-tip  slideIn" id="ttipf_sexo" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_fechaNac"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Fecha de Nacimiento:</font><input type="date" id="f_fechaNac" name="f_fechaNac" onblur="vSoloFechaAnterior(this.id);" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_fechaNac" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_direccion"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Dirección:</font><textarea name="f_direccion" id="f_direccion" class="form-control" style="resize:none; overflow-y:scroll" maxlenght="150" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"></div></div></div></th>
					</tr>
					<tr>
						<th><div class="form-group has-default" id="haf_telefonos"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Teléfono:</font><input type="text" name="f_telefonos" id="f_telefonos" size="8" maxlenght="12" class="form-control" value="" placeholder="(999)9999999" onfocus="MaskTelefono(this.id)" onkeypress="vSoloTelefono();" onblur="vCampoVacio(this.id);" size="8" maxlenght="12"><div class="tool-tip  slideIn" id="ttipf_telefonos" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="hacmb_gradoEstu"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Grado De Estudio: </font><br><select id="cmb_gradoEstu" name="cmb_gradoEstu" class="form-control"  onblur="vCampoVacio(this.id);" onchange=""><option></option>
						');
						echo utf8_decode($loFuncion->fncreateComboSelect("gradoestudio", "","idTgradoEstudio","", ' ',"","Grado", $selectTallaFrane,"", "", "")); 
						echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_gradoEstu" style="display:none;"></div></div></div>
						</th>
						<th><div class="form-group has-default" id="hacmb_tallaFrane"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Talla De Franela: </font><br><select id="cmb_tallaFrane" name="cmb_tallaFrane" class="form-control" onblur="vCampoVacio(this.id);" onchange=""><option></option>
						');
						echo utf8_decode($loFuncion->fncreateComboSelect("tallafranela", "","idTtallaFranela","", ' ',"","Talla", $selectTallaFrane,"", "", "")); 
						echo utf8_Decode('
						</select><div class="tool-tip  slideIn" id="ttipcmb_tallaFrane" style="display:none;"></div></div></div></th>
					</tr>
					<tr>
						<th><div class="form-group has-default" id="haf_refInfante"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Referencia del Infante:</font><br><input type="text" size="10" maxlength="30" id="f_refInfante" name="f_refInfante" class="form-control" value="" onkeypress="vSoloNumeros();" onblur="fpPerderFocus()"><div class="tool-tip  slideIn" id="ttipf_refInfante" style="display:none;"></div></div></div></th>
						<th><center><div class="alert alert-info" id="divf_cambiaConfirma"><font id="ntf_cambiaConfirma"></font></div></center></th>
						<th></th>
					</tr>

					</table>
					<br>				<table class="table table-striped table-bordered table-hover" border="1" >
					
							<thead>		
								<tr>
									<th colspan="7"><center>Registro de Representantes</center></th>
								</tr>
							</thead>
								<tr>
										<th align="center"><div class="form-group has-default" id="haf_cedulaMama"><div class="on-focus clearfix" style="position: relative;"><input type=radio name="rad_representante" id="rad_representante1" value="madre" onclick="rad_select(1)">
										<font class="control-label">
											CI de la Madre:</font><br> 
											<input type="text"name="f_cedulaMama" id="f_cedulaMama" class="form-control" value="" size="6" maxlength="13" onfocus="MaskCedulaNac(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id);" placeholder="V-99999999"><div class="tool-tip  slideIn" id="ttipf_cedulaMama" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_NombresMama"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Nombres</font><br>
											<input type="text" name="f_NombresMama" id="f_NombresMama" class="form-control" value="" size="12" maxlenght="50" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_NombresMama" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_ApellidosMama"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Apellidos</font><br>
											<input type="text" name="f_ApellidosMama" id="f_ApellidosMama" class="form-control" value="" size="12" maxlenght="3" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_ApellidosMama" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ></th>
										<th align="center" ><div class="form-group has-default" id="haf_DireccionMama"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Direccion</font><br>
											<textarea name="f_DireccionMama" id="f_DireccionMama" class="form-control" style="width:120px; resize:none; overflow-y:scroll" maxlenght="150" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_DireccionMama" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_TelefonoMama"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Telefono</font><br>
											<input type="text" name="f_TelefonoMama" id="f_TelefonoMama" class="form-control" value="" size="8" maxlenght="12" placeholder="(999)9999999" onfocus="MaskTelefono(this.id)" onkeypress="vSoloTelefono();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_TelefonoMama" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_FechaNacimientoMama"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Fecha de Nacimiento</font><br>
											<input type="date" name="f_FechaNacimientoMama" id="f_FechaNacimientoMama" class="form-control" value="" size="12" maxlenght="12" onblur="vSoloFechaAnterior(this.id);"><div class="tool-tip  slideIn" id="ttipf_FechaNacimientoMama" style="display:none;"></div></div></div> 
										</th>

								</tr>
								<tr>
							
										<th align="center"><div class="form-group has-default" id="haf_cedulaPapa"><div class="on-focus clearfix" style="position: relative;"><input type=radio name="rad_representante" id="rad_representante2" value="padre" onclick="rad_select(2)"><font class="control-label">
											CI del Padre:</font><br> 
											<input type="text" size="6" maxlength="13" id="f_cedulaPapa" name="f_cedulaPapa" placeholder="V-99999999" class="form-control" value="" onfocus="MaskCedulaNac(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_cedulaPapa" style="display:none;"></div></div></div>
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_NombresPapa"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Nombres</font><br>
											<input type="text" name="f_NombresPapa" id="f_NombresPapa" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);" size="12" maxlenght="50" ><div class="tool-tip  slideIn" id="ttipf_NombresPapa" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_ApellidosPapa"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Apellidos</font><br>
											<input type="text" name="f_ApellidosPapa" id="f_ApellidosPapa" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);" size="12" maxlenght="3"  ><div class="tool-tip  slideIn" id="ttipf_ApellidosPapa" style="display:none;"></div></div></div>
										</th>
										<th align="center" ></th>
										<th align="center" ><div class="form-group has-default" id="haf_DireccionPapa"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Direccion</font><br>
											<textarea name="f_DireccionPapa" id="f_DireccionPapa" class="form-control" style="width:120px; resize:none; overflow-y:scroll" maxlenght="150" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_DireccionPapa" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_TelefonoPapa"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Telefono</font><br>
											<input type="text" name="f_TelefonoPapa" id="f_TelefonoPapa" class="form-control" value="" placeholder="(999)9999999" onfocus="MaskTelefono(this.id)" onkeypress="vSoloTelefono();" onblur="vCampoVacio(this.id);" size="8" maxlenght="12"><div class="tool-tip  slideIn" id="ttipf_TelefonoPapa" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_FechaNacimientoPapa"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Fecha de Nacimiento</font><br>
											<input type="date" name="f_FechaNacimientoPapa" id="f_FechaNacimientoPapa" class="form-control" value="" onblur="vSoloFechaAnterior(this.id);" size="12" maxlenght="12"><div class="tool-tip  slideIn" id="ttipf_FechaNacimientoPapa" style="display:none;"></div></div></div> 
										</th>
								</tr>
								<tr>
										<th align="center"><div class="form-group has-default" id="haf_cedulaRepre"><div class="on-focus clearfix" style="position: relative;"><input type=radio name="rad_representante" id="rad_representante3" value="tercero" onclick="rad_select(3)"><font class="control-label">

											CI del Representante:</font><br>
											<input type="text" size="6" maxlength="13" id="f_cedulaRepre" name="f_cedulaRepre" placeholder="V-99999999" class="form-control" value="" onfocus="MaskCedulaNac(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_cedulaRepre" style="display:none;"></div></div></div>
											<div class="form-group has-default" id="hacmb_parentesco"><div class="on-focus clearfix" style="position: relative;"><select class="form-control" id="cmb_parentesco" name="cmb_parentesco" onchange="" onblur="vCampoVacio(this.id);"><option></option>
											');
											echo utf8_decode($loFuncion->fncreateComboSelect("parentescorepre", "","idTparentescoRepre","", ' ',"","Nombre", $selectParentesco,"", "", "")); 
											echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_parentesco" style="display:none;"></div></div></div>
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_NombresRepre"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Nombres</font><br>
											<input type="text" name="f_NombresRepre" id="f_NombresRepre" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);" size="12" maxlenght="50" ><div class="tool-tip  slideIn" id="ttipf_NombresRepre" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_ApellidosRepre"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Apellidos</font><br>
											<input type="text" name="f_ApellidosRepre" id="f_ApellidosRepre" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);" size="12" maxlenght="3"  ><div class="tool-tip  slideIn" id="ttipf_ApellidosRepre" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_SexoRepre"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Sexo</font><br>
											<select class="form-control" name="f_SexoRepre" id="f_SexoRepre" class="form-control" value="" onblur="vCampoVacio(this.id);"><option value="" ><p><strong></strong></p></option><option value="F" ><p><strong>F</strong></p></option><option value="M" ><p><strong>M</strong></p></option></select><div class="tool-tip  slideIn" id="ttipf_SexoRepre" style="display:none;"></div></div></div>
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_DireccionRepre"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Direccion</font><br>
											<textarea name="f_DireccionRepre" id="f_DireccionRepre" class="form-control" style="width:120px; resize:none; overflow-y:scroll" maxlenght="150" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_DireccionRepre" style="display:none;"></div></div></div>
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_TelefonoRepre"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Telefono</font><br>
											<input type="text" name="f_TelefonoRepre" id="f_TelefonoRepre" class="form-control" value="" placeholder="(999)9999999" onfocus="MaskTelefono(this.id)" onkeypress="vSoloTelefono();" onblur="vCampoVacio(this.id);" size="8" maxlenght="12"><div class="tool-tip  slideIn" id="ttipf_TelefonoRepre" style="display:none;"></div></div></div> 
										</th>
										<th align="center" ><div class="form-group has-default" id="haf_FechaNacimientoRepre"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">
											Fecha de Nacimiento</font><br>
											<input type="date" name="f_FechaNacimientoRepre" id="f_FechaNacimientoRepre" class="form-control" value="" onblur="vSoloFechaAnterior(this.id);" size="12" maxlenght="12"><div class="tool-tip  slideIn" id="ttipf_FechaNacimientoRepre" style="display:none;"></div></div></div> 
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
				<th><div class="form-group has-default" id="haf_libro"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Libro:</font><br><input type="text" size="10" id="f_libro" name="f_libro" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_libro" style="display:none;"></div></div></div></th>
				<th><div class="form-group has-default" id="haf_Folio"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Folio:</font><br><input type="text" size="10" id="f_Folio" name="f_Folio" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_Folio" style="display:none;"></div></div></div></th>
				<th><div class="form-group has-default" id="haf_Numero"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Numero:</font><br><input type="text" size="10" id="f_Numero" name="f_Numero" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_Numero" style="display:none;"></div></div></div></th>
			</tr>	
			<tr>
				<th><div class="form-group has-default" id="haf_notaMarginal"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Nota Marginal:</font><br><textarea class="form-control" name="f_notaMarginal" id="f_notaMarginal" style="height:60px; width:100%; resize:none; overflow-y:scroll"></textarea><div class="tool-tip  slideIn" id="ttipf_notaMarginal" style="display:none;"></div></div></div></th>
				<th><div class="form-group has-default" id="hacmb_presbitero"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Presbítero: </font><br><select class="form-control" id="cmb_presbitero" name="cmb_presbitero" onblur="vCampoVacio(this.id);"><option></option>
				');
				echo utf8_decode($loFuncion->fncreateComboSelect("tsacerdote", "tpersonas","idTsacerdote","nombres", ' ',"apellidos","concatext", $selectSacer,"INNER JOIN", "idFpersona", "idTpersonas")); 
				echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_presbitero" style="display:none;"></div></div></div></th>
				<th><div class="form-group has-default" id="hacmb_ministro"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Ministro: </font><br><select class="form-control" id="cmb_ministro" name="cmb_ministro" onblur="vCampoVacio(this.id);"><option></option>
				');
				echo utf8_decode($loFuncion->fncreateComboSelect("tsacerdote", "tpersonas","idTsacerdote","nombres", ' ',"apellidos","concatext", $selectSacer,"INNER JOIN", "idFpersona", "idTpersonas")); 
				echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_ministro" style="display:none;"></div></div></div></center></th>
			</tr>
		</table>
<br>
		<table class="table table-striped table-bordered table-hover" border="1" >
								<thead>		
									<tr>
										<th colspan="9"><center>Padrinos De Confirmación</center></th>
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
										<th align="center" ><font class="control-label">
											Direccion</font><br>
											<textarea name="f_padDireccion" id="f_padDireccion" class="form-control" style="height:30px; width:120px; resize:none; overflow-y:scroll" maxlenght="150" disabled></textarea>
										</th>
										<th align="center" ><font class="control-label">
											Telefono</font><br>
											<input type="text" name="f_padTelefono" id="f_padTelefono" class="form-control" value="" size="8" maxlenght="12" disabled> 
										</th>
										<th align="center" ><font class="control-label">
											Fecha de Nacimiento</font><br>
											<input type="date" name="f_padFechaNacimiento" id="f_padFechaNacimiento" class="form-control" value="" size="12" maxlenght="12" disabled> 
										</th>
										<th align="center" ><font class="control-label">Tipo:</font><br>
											<select class="form-control" name="f_padriTipo" id="f_padriTipo" class="form-control" value="" disabled><option value=""><p><strong></strong></p></option><option value="C"><p><strong>Celestial</strong></p></option><option value="T"><p><strong>De tierra</strong></p></option></select>
										</th>
										<th align="center" >		
											<button type="button" name="btnAgregar" style="margin:10px 8px; width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.428571429" class="btn btn-default btn-circle" onclick="fpAgregar()"><i class="fa fa-plus">+</i></button>
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
				<th colspan="3"><center>
					<input type="hidden" name="f_ceduModifi" id="f_ceduModifi" value="'.$lsCedula.'">
					<input type="hidden" name="txtOperacion" id="txtOperacion" value="'.$lsOperacion.'">
					<input type="hidden" name="txtHacer" id="txtHacer" value="'.$lsHacer.'">
					<input type="hidden" name="txtHay" id="txtHay" value="'.$liHay.'">
					<input type="hidden" name="txtFila" id="txtFila" value="">
					<input type="hidden" name="KestadoActual" id="KestadoActual" value="">
					<input type="hidden" name="CIpadriAlter" value="0">
					<input type="hidden" name="varNoCI" value="0">
					<input type="button" class="btn btn-default" name="b_Nuevo" value="Nuevo" onclick="fpNuevo()">
					<input type="button" class="btn btn-default" name="b_Modificar" value="Modificar" onclick="fpModificar()">
					<input type="button" class="btn btn-default" name="b_Buscar" value="Buscar" onclick="fpBuscar()">
					<input type="button" class="btn btn-default" name="b_Eliminar" value="Desactivar" onclick="fpDesactivar()">
					<input type="button" class="btn btn-default" name="b_Guardar" value="Guardar" onclick="fpGuardar()">
					<input type="button" class="btn btn-default" name="b_Cancelar" value="Cancelar" onclick="fpCancelar()"></center>
				</th>
			</tr>
		
		</table>
	</div>');

	footer(); // pie de pagina

	echo utf8_decode('</form>
	</div>

	</body>
<script>
var loF=document.fr_confirmacion;

	var muestraPadri="no";
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
			loF.f_cedulaEstu.focus();
		}
		
		function fpEncender()
		{
			var liFila=Number(loF.txtFila.value);
			loF.radNoCI.disabled=false;
			loF.f_PartiPrefectura.disabled=false;
			loF.f_PartiPresentado.disabled=false;
			loF.f_PartiNumero.disabled=false;
			loF.f_cedulaEstu.disabled=false;
			loF.f_nombres.disabled=false;
			loF.f_apellidos.disabled=false;
			loF.f_sexo.disabled=false;
			loF.f_fechaNac.disabled=false;
			loF.f_direccion.disabled=false;
			loF.f_telefonos.disabled=false;
			loF.cmb_gradoEstu.disabled=false;
			loF.cmb_tallaFrane.disabled=false;
			loF.cmb_presbitero.disabled=false;
			loF.cmb_ministro.disabled=false;
			loF.f_notaMarginal.disabled=false;
			loF.f_cedulaMama.disabled=false;
			loF.f_NombresMama.disabled=false;
			loF.f_ApellidosMama.disabled=false;
			loF.f_DireccionMama.disabled=false;
			loF.f_TelefonoMama.disabled=false;
			loF.f_FechaNacimientoMama.disabled=false;
			loF.f_cedulaPapa.disabled=false;
			loF.f_NombresPapa.disabled=false;
			loF.f_ApellidosPapa.disabled=false;
			loF.f_DireccionPapa.disabled=false;
			loF.f_TelefonoPapa.disabled=false;
			loF.f_FechaNacimientoPapa.disabled=false;			
			loF.f_cedulaRepre.disabled=false;
			loF.cmb_parentesco.disabled=false;
			loF.f_NombresRepre.disabled=false;
			loF.f_ApellidosRepre.disabled=false;
			loF.f_SexoRepre.disabled=false;
			loF.f_DireccionRepre.disabled=false;
			loF.f_TelefonoRepre.disabled=false;
			loF.f_FechaNacimientoRepre.disabled=false;
			loF.f_libro.disabled=false;
			loF.f_Folio.disabled=false;
			loF.f_Numero.disabled=false;
			loF.btnAgregar.disabled=false;

			for(liY=1;liY<=liFila;liY++)
            {
			
				document.getElementById("f_padNombres"+liY).disabled=false;
				document.getElementById("f_padApellidos"+liY).disabled=false;
				document.getElementById("f_padSexo"+liY).disabled=false;
				document.getElementById("f_padDireccion"+liY).disabled=false;
				document.getElementById("f_padTelefono"+liY).disabled=false;
				document.getElementById("f_padFechaNacimiento"+liY).disabled=false;
				document.getElementById("f_padriTipo"+liY).disabled=false;
			}

			
		}
		function fpEnciendeCI()
		{
			var liFila=Number(loF.txtFila.value);
			for(liY=1;liY<=liFila;liY++)
	        {
			document.getElementById("f_padCedula"+liY).disabled=false;
			}
		}
		function fpApagar()
		{
			var liFila=Number("0");
			loF.radNoCI.disabled=true;
			loF.f_PartiPrefectura.disabled=true;
			loF.f_PartiPresentado.disabled=true;
			loF.f_PartiNumero.disabled=true;
			loF.f_cedulaEstu.disabled=true;
			loF.f_nombres.disabled=true;
			loF.f_apellidos.disabled=true;
			loF.f_sexo.disabled=true;
			loF.f_fechaNac.disabled=true;
			loF.f_direccion.disabled=true;
			loF.f_telefonos.disabled=true;
			loF.cmb_gradoEstu.disabled=true;
			loF.cmb_tallaFrane.disabled=true;
			loF.cmb_presbitero.disabled=true;
			loF.cmb_ministro.disabled=true;
			loF.f_refInfante.disabled=true;
			loF.f_notaMarginal.disabled=true;
			loF.f_cedulaMama.disabled=true;
			loF.f_NombresMama.disabled=true;
			loF.f_ApellidosMama.disabled=true;
			loF.f_DireccionMama.disabled=true;
			loF.f_TelefonoMama.disabled=true;
			loF.f_FechaNacimientoMama.disabled=true;
			loF.f_cedulaPapa.disabled=true;
			loF.f_NombresPapa.disabled=true;
			loF.f_ApellidosPapa.disabled=true;
			loF.f_DireccionPapa.disabled=true;
			loF.f_TelefonoPapa.disabled=true;
			loF.f_FechaNacimientoPapa.disabled=true;			
			loF.f_cedulaRepre.disabled=true;
			loF.cmb_parentesco.disabled=true;
			loF.f_NombresRepre.disabled=true;
			loF.f_ApellidosRepre.disabled=true;
			loF.f_SexoRepre.disabled=true;
			loF.f_DireccionRepre.disabled=true;
			loF.f_TelefonoRepre.disabled=true;
			loF.f_FechaNacimientoRepre.disabled=true;
			loF.f_libro.disabled=true;
			loF.f_Folio.disabled=true;
			loF.f_Numero.disabled=true;
			loF.btnAgregar.disabled=true;
		    for(liY=1;liY<=liFila;liY++)
            {
				document.getElementById("f_padCedula"+liY).disabled=true;
				document.getElementById("f_padNombres"+liY).disabled=true;
				document.getElementById("f_padApellidos"+liY).disabled=true;
				document.getElementById("f_padSexo"+liY).disabled=true;
				document.getElementById("f_padDireccion"+liY).disabled=true;
				document.getElementById("f_padTelefono"+liY).disabled=true;
				document.getElementById("f_padFechaNacimiento"+liY).disabled=true;
				document.getElementById("f_padriTipo"+liY).disabled=true;
			}
			
			document.getElementById("ntf_cambiaConfirma").innerHTML="Estado de la Confirmación";
			document.getElementById("divf_cambiaConfirma").className = "alert alert-info";

		}
		
		function fpCancelar()
		{
			var liFila=Number(loF.txtFila.value);
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.KestadoActual.value=1;
			loF.f_PartiPrefectura.value="";
			loF.f_PartiPresentado.value="";
			loF.f_PartiNumero.value="";
			loF.f_cedulaEstu.value="";
			loF.f_nombres.value="";
			loF.f_apellidos.value="";
			loF.f_sexo.value="";
			loF.f_fechaNac.value="";
			loF.f_direccion.value="";
			loF.f_telefonos.value="";
			loF.cmb_gradoEstu.value="";
			loF.cmb_tallaFrane.value="";
			loF.cmb_presbitero.value="";
			loF.cmb_ministro.value="";
			loF.f_refInfante.value="";
			loF.f_notaMarginal.value="";
			loF.f_cedulaMama.value="";
			loF.f_NombresMama.value="";
			loF.f_ApellidosMama.value="";
			loF.f_DireccionMama.value="";
			loF.f_TelefonoMama.value="";
			loF.f_FechaNacimientoMama.value="";
			loF.f_cedulaPapa.value="";
			loF.f_NombresPapa.value="";
			loF.f_ApellidosPapa.value="";
			loF.f_DireccionPapa.value="";
			loF.f_TelefonoPapa.value="";
			loF.f_FechaNacimientoPapa.value="";
			loF.f_cedulaRepre.value="";
			loF.cmb_parentesco.value="";
			loF.f_NombresRepre.value="";
			loF.f_ApellidosRepre.value="";
			loF.f_SexoRepre.value="";
			loF.f_DireccionRepre.value="";
			loF.f_TelefonoRepre.value="";
			loF.f_FechaNacimientoRepre.value="";
			loF.f_libro.value="";
			loF.f_Folio.value="";
			loF.f_Numero.value="";
			document.getElementById("filaOcultaPartiNaci").style.display = \'none\';
			fpApagar();
			fpInicial();
			fpEliminaFilas();
			fpEstadoActual();
		}

		function fpCreaReferencia(proxCamp)
		{
			if (proxCamp==1)
			{
				loF.f_PartiPresentado.focus();
				var numRef=loF.f_PartiNumero.value+loF.f_PartiPresentado.value.substring(0,4);
				loF.f_refInfante.value=numRef;
			}
			else if (proxCamp==2)
			{
				loF.f_PartiNumero.focus();
				var numRef=loF.f_PartiNumero.value+loF.f_PartiPresentado.value.substring(0,4);
				loF.f_refInfante.value=numRef;
			}
			else
			{
				loF.f_nombres.focus();
				var numRef=loF.f_PartiNumero.value+loF.f_PartiPresentado.value.substring(0,4);
				loF.f_refInfante.value=numRef;
			}
		}

		function fpMuestraSinCedula()
		{
			loF.f_PartiPrefectura.disabled=false;
			loF.f_PartiPresentado.disabled=false;
			loF.f_PartiNumero.disabled=false;
			loF.f_cedulaEstu.disabled=true;
			loF.varNoCI.value="1";
			document.getElementById("filaOcultaPartiNaci").style.display = \'table-row\';
			loF.f_PartiPrefectura.focus();

		}
		
		function fpBuscar()
		{
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.f_cedulaEstu.disabled=false;
			loF.f_refInfante.disabled=false;
			loF.f_cedulaEstu.focus();
			fpCambioB();
			
		}

		function fpPerderFocus()
		{
			if((loF.f_cedulaEstu.value!="")&&(loF.txtHacer.value=="buscar"))
			{
				
						
				var $forme = $("#fr_confirmacion");

					$.ajax({
						url: \'../cntller/cn_confirmacion.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var data21=data[\'Matri\'];
           					var data22=data[\'Padri\'];
							if((data21.lscedunovia!=""))
							{

								if ((data21.lscedunovia!="")&&(data21.lsnombnovia!=""))
								{
									document.getElementById("EncontroNovia").value="Novia: "+data21.lsnombnovia;
									loF.f_cedulaEstu.value = data21.lscedunovia;
								}
								if ((data21.lscedunovio!="")&&(data21.lsnombnovio!=""))
								{
									document.getElementById("EncontroNovio").value="Novio: "+data21.lsnombnovio;
									loF.f_cedunovio.value = data21.lscedunovio;
								}

								loF.f_sacerdote.value = data21.lscedusacerdote;
								loF.f_fechamatrimonio.value = data21.lsfechamatrimonio;
								
								if ((loF.txtOperacion.value=="buscar")&&(data21.liHay!=0))
								{
									fpCambioE();
									fpApagar();
								}

								
								if (data21.lsedomatri==0){
									loF.btn_EstadoConfirmacion.value="En espera de la Confirmación";
								}
								else if(data21.lsedomatri==1){

									loF.btn_EstadoConfirmacion.value="Confirmado";
								}
								else if(data21.lsedomatri==2){
									loF.btn_EstadoConfirmacion.value="Suspendido";
								}
								else if(data21.lsedomatri==3){
									loF.btn_EstadoConfirmacion.value="No se realizo la Confirmación";
								}
								else
								{
									loF.btn_EstadoConfirmacion.value="Estado no disponible";
								}

							}

							if ((loF.txtOperacion.value=="buscar")&&(data21.liHay==0))
							{
								alert("No se encontro ninguna Confirmación con la referencia ingresada");
								loF.f_cedulaEstu.value="";
								loF.f_cedulaEstu.focus();
							}

							if ((loF.txtOperacion.value=="buscar")&&(data21.liHay==1))
							{
								muestraPadri="si";
							}
							
							if((loF.txtOperacion.value=="incluir")&&(data21.liHay==0))
							{
								alert("La cedula ingresada no esta registrada");
											loF.f_cedulaEstu.value="";
											loF.f_cedulaEstu.focus();
							}

							if((loF.txtOperacion.value=="incluir")&&(data21.liHay==1)) //si la cedula existe y ya tiene Matrimonio.
							{
								alert("La referencia Ingresada ya tiene una Confirmación registrado");
									muestraPadri="no";
									fpCancelar();
									loF.txtOperacion.value="incluir";
									loF.txtHacer.value="buscar";
									loF.txtHay.value=0;
									loF.f_cedulaEstu.focus();

							}

							if((loF.txtOperacion.value=="incluir")&&(data21.liHay==2)) //si la cedula de la Novia no existe.
							{
									loF.txtOperacion.value="incluir";
									loF.txtHacer.value="buscar";
									loF.txtHay.value=0;
									loF.f_cedunovio.focus();
									loF.f_cedulaEstu.disabled=true;
							}

							if((loF.txtOperacion.value=="incluir")&&(data21.liHay==3)) //si la cedula de la Novia no existe.
							{
								if (confirm("La cedula Ingresada No esta asignada a ninguna persona, desea registrarla ahora?"))
								{

									/*Abrir registro de personas*/

								}else{
									fpCancelar();

								}

							}

							if((loF.txtOperacion.value=="incluir")&&(data21.liHay==3)) //si la cedula del Novio no existe.
							{
								if (confirm("La cedula Ingresada No esta asignada a ninguna persona, desea registrarla ahora?"))
								{

									/*Abrir registro de personas*/

								}else{
									fpCancelar();

								}
							}


							if((loF.txtOperacion.value=="incluir")&&(data21.liHay==4)) 
							{

							loF.txtHay.value=0;
							alert("La cedula ingresada no es de Sexo Femenino.");
							loF.f_cedulaEstu.value="";
							loF.f_cedulaEstu.focus();

							}


							if((loF.txtOperacion.value=="incluir")&&(data21.liHay==5)) 
							{

							loF.txtHay.value=0;
							alert("La cedula ingresada no es de Sexo Masculino.");
							loF.f_cedunovio.value="";
							loF.f_cedunovio.focus();	

							}

							
							if((data22)&&(muestraPadri=="si"))
							{
								fpListarPadri(data22);
							}

						}
					});
		
			}
			else if((loF.f_cedulaEstu.value=="")&&(loF.txtOperacion.value=="incluir"))
			{
				loF.f_cedulaEstu.focus();
			}
			else
			{
				loF.f_cedunovio.focus();
			}
		}
		function fpGuardar()
		{
			if(fbValidar())
			{
				loF.f_cedunovio.disabled=false;
				loF.f_cedulaEstu.disabled=false;
				fpEnciendeCI();
				var $forme = $("#fr_matrimonio");

					$.ajax(
					{
						url: \'../cntller/cn_matrimonio.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var data21=data[\'Matri\'];
           					var data22=data[\'Padri\'];
							if((data21.liHay!=""))
							{
								if ((loF.txtHacer.value=="incluir")&&(data21.liHay==0))
								{



								}

								if ((loF.txtHacer.value=="incluir")&&(data21.liHay==1))
								{

									alert("Registro incluido con exito.");

								}


							}
						}
					});
			}
			
		}


		function fbValidar()
		{
			var lbValido=false;
			
			if(loF.f_cedulaEstu.value=="")
			{
	
				loF.f_cedulaEstu.value="";
			
			}
			else if(loF.f_cedunovio.value=="")
			{
	
				loF.f_cedunovio.value="";
	
			}
			else if(loF.f_sacerdote.value=="")
			{
	
				loF.f_sacerdote.value="";
	
			}
			else if(loF.f_fechamatrimonio.value=="")
			{
	
				loF.f_fechamatrimonio.value="";
	
			}
			else
			{
				lbValido=fbValidaPadrinos();
			}
			return lbValido;
		}

		function fbValidaPadrinos()
		{
			var lbValido=false;

			var liFila=Number(loF.txtFila.value);
			if (liFila>0)
			{
	            for(liY=1;liY<=liFila;liY++)
	            {
	            	
					if(document.getElementById("f_padCedula"+liY).value=="")
					{
						alert("Campo Cedula esta en Blanco");
						document.getElementById("f_padCedula"+liY).focus();
					}
					else if(document.getElementById("f_padNombres"+liY).value=="")
					{
						alert("Campo Nombres esta en Blanco");
						document.getElementById("f_padNombres"+liY).focus();
					}
					else if(document.getElementById("f_padApellidos"+liY).value=="")
					{
						alert("Campo Apellidos esta en Blanco");
						document.getElementById("f_padApellidos"+liY).focus();
					}
					else if(document.getElementById("f_padSexo"+liY).value=="")
					{
						alert("Sexo No ha sido seleccionado");
						document.getElementById("f_padSexo"+liY).focus();
					}
					else if(document.getElementById("f_padDireccion"+liY).value=="")
					{
						alert("Campo Direccion esta en Blanco");
						document.getElementById("f_padDireccion"+liY).focus();
					}
					else if(document.getElementById("f_padTelefono"+liY).value=="")
					{
						alert("Campo Telefono esta en Blanco");
						document.getElementById("f_padTelefono"+liY).focus();
					}
					else if(document.getElementById("f_padFechaNacimiento"+liY).value=="")
					{
						alert("Campo Fecha de Nacimiento esta en Blanco");
						document.getElementById("f_padFechaNacimiento"+liY).focus();
					}
					else if(document.getElementById("f_padriTipo"+liY).value=="")
					{
						alert("Tipo de padrino No ha sido seleccionado");
						document.getElementById("f_padriTipo"+liY).focus();
					}
					else
					{
					lbValido=true;
					}
				}
			}
			else
			{
				alert("Lo siento, debe agregar al menos 2 padrinos reales para poder Guardar");
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
			loF.f_cedulaEstu.disabled=true;
			loF.f_cedunovio.disabled=true;
			loF.f_padCedula.focus();
		}
		
		function fpEstadoActual()
		{
			var KedoActual=loF.KestadoActual.value;
			if(KedoActual==1)
			{
				loF.b_Eliminar.value="Desactivar";

			}
			else
			{
				loF.b_Eliminar.value="Reactivar";
			}
			
		}

		function fpDesactivar()
		{
			if (loF.b_Eliminar.value=="Reactivar")
			{
				if(confirm("Desea Reactivar el Matrimonio?"))
				{
					loF.f_cedulaEstu.disabled=false;
					loF.txtOperacion.value="reactivar";
					loF.txtHacer.value="reactivar";
					
					var $forme = $("#fr_matrimonio");

					$.ajax({
						url: \'../cntller/corUsuario.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
							if(data.liHay==1)
							{
									fpCancelar();
									alert("Matrimonio Reactivado");
									fpInicial();
									loF.KestadoActual.value=1;
							}
							else	
							{
									fpCancelar();
									alert("No se pudo Reactivar el Matrimonio");
									fpInicial();
									loF.KestadoActual.value=1;
									
							}
						}
					});


				}
			}
			else
			{
				if(confirm("Desea Desactivar el Matrimonio?"))
				{
					loF.f_cedulaEstu.disabled=false;
					loF.txtOperacion.value="eliminar";
					loF.txtHacer.value="eliminar";
					var $forme = $("#fr_matrimonio");

					$.ajax({
						url: \'../cntller/corUsuario.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
							if(data.liHay==1)
							{
									fpCancelar();
									alert("Matrimonio Desactivado");
									fpInicial();
									loF.KestadoActual.value=1;
							}
							else	
							{
									fpCancelar();
									alert("No se pudo Desactivar el Matrimonio");
									fpInicial();
									loF.KestadoActual.value=1;
									
							}
						}
					});

				}
			}
		}
		function fpListarPadri(arre) {

			var liFila=Number(loF.txtFila.value);
			var loTabla = document.getElementById("tabPadrinos");

			liFila=eval(liFila+arre.length);
			loF.txtFila.value=liFila;
		    $.each(arre, function(a, padrino) {
   			i=a+1;

            var loFila = loTabla.insertRow(a);
            var loCelda1 = loFila.insertCell(0);
            var loCelda2 = loFila.insertCell(1);
            var loCelda3 = loFila.insertCell(2);
            var loCelda4 = loFila.insertCell(3);
            var loCelda5 = loFila.insertCell(4);
            var loCelda6 = loFila.insertCell(5);
			var loCelda7 = loFila.insertCell(6);
            var loCelda8 = loFila.insertCell(7);
			var loCelda9 = loFila.insertCell(8);

 

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
			lof_padCedula.setAttribute(\'onblur\',"this.value=this.value.toUpperCase(); vCampoVacio(this.id)");
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

			var halof_padDireccion = document.createElement("div"); 
			halof_padDireccion.setAttribute(\'class\',"form-group has-default");
			halof_padDireccion.setAttribute(\'id\',"haf_padDireccion"+i);
			
			var ttiplof_padDireccion = document.createElement("div");
			ttiplof_padDireccion.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padDireccion.setAttribute(\'id\',"ttipf_padDireccion"+i);
			ttiplof_padDireccion.setAttribute(\'style\',"display:none;");
							
			var lof_padDireccion = document.createElement("textarea");
			lof_padDireccion.setAttribute(\'class\',"form-control");
			lof_padDireccion.setAttribute(\'name\',"f_padDireccion"+i);
			lof_padDireccion.setAttribute(\'id\',"f_padDireccion"+i);
			lof_padDireccion.setAttribute(\'value\',loF.f_padDireccion.value);
			lof_padDireccion.setAttribute(\'style\',"width:120px;");
			lof_padDireccion.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padDireccion.setAttribute(\'maxlenght\',"150");

			var halof_padTelefono = document.createElement("div"); 
			halof_padTelefono.setAttribute(\'class\',"form-group has-default");
			halof_padTelefono.setAttribute(\'id\',"haf_padTelefono"+i);
			
			var ttiplof_padTelefono = document.createElement("div");
			ttiplof_padTelefono.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padTelefono.setAttribute(\'id\',"ttipf_padTelefono"+i);
			ttiplof_padTelefono.setAttribute(\'style\',"display:none;");

			var lof_padTelefono = document.createElement("input");
			lof_padTelefono.setAttribute(\'type\',"text");
			lof_padTelefono.setAttribute(\'class\',"form-control");
			lof_padTelefono.setAttribute(\'name\',"f_padTelefono"+i);
			lof_padTelefono.setAttribute(\'id\',"f_padTelefono"+i);
			lof_padTelefono.setAttribute(\'value\',loF.f_padTelefono.value);
			lof_padTelefono.setAttribute(\'size\',"8");
			lof_padTelefono.setAttribute(\'placeholder\',"(999)9999999");
			lof_padTelefono.setAttribute(\'onfocus\',"MaskTelefono(this.id);");
			lof_padTelefono.setAttribute(\'onkeypress\',"vSoloTelefono();");
			lof_padTelefono.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padTelefono.setAttribute(\'maxlenght\',"12");

			var halof_padFechaNacimiento = document.createElement("div"); 
			halof_padFechaNacimiento.setAttribute(\'class\',"form-group has-default");
			halof_padFechaNacimiento.setAttribute(\'id\',"haf_padFechaNacimiento"+i);
			
			var ttiplof_padFechaNacimiento = document.createElement("div");
			ttiplof_padFechaNacimiento.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padFechaNacimiento.setAttribute(\'id\',"ttipf_padFechaNacimiento"+i);
			ttiplof_padFechaNacimiento.setAttribute(\'style\',"display:none;");

			var lof_padFechaNacimiento = document.createElement("input");
			lof_padFechaNacimiento.setAttribute(\'type\',"date");
			lof_padFechaNacimiento.setAttribute(\'class\',"form-control");
			lof_padFechaNacimiento.setAttribute(\'name\',"f_padFechaNacimiento"+i);
			lof_padFechaNacimiento.setAttribute(\'id\',"f_padFechaNacimiento"+i);
			lof_padFechaNacimiento.setAttribute(\'value\',loF.f_padFechaNacimiento.value);
			lof_padFechaNacimiento.setAttribute(\'size\',"12");
			lof_padFechaNacimiento.setAttribute(\'onblur\',"vSoloFechaAnterior(this.id);");
			lof_padFechaNacimiento.setAttribute(\'maxlenght\',"12");

			var halof_padriTipo = document.createElement("div"); 
			halof_padriTipo.setAttribute(\'class\',"form-group has-default");
			halof_padriTipo.setAttribute(\'id\',"haf_padriTipo"+i);
			
			var ttiplof_padriTipo = document.createElement("div");
			ttiplof_padriTipo.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padriTipo.setAttribute(\'id\',"ttipf_padriTipo"+i);
			ttiplof_padriTipo.setAttribute(\'style\',"display:none;");


			var lof_padriTipo = document.getElementById("f_padriTipo").cloneNode(true);
			lof_padriTipo.setAttribute(\'name\',"f_padriTipo"+i);
			lof_padriTipo.setAttribute(\'id\',"f_padriTipo"+i);
			lof_padriTipo.setAttribute(\'class\',"form-control");
			lof_padriTipo.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padriTipo.removeAttribute("disabled");
		
             // CON EL METODO appendChild(); LOS AGREGO A LA CELDA QUE QUIERO

            loCelda1.appendChild(halof_padCedula).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padCedula).appendChild(ttiplof_padCedula);
            loCelda2.appendChild(halof_padNombres).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padNombres).appendChild(ttiplof_padNombres);
            loCelda3.appendChild(halof_padApellidos).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padApellidos).appendChild(ttiplof_padApellidos);
            loCelda4.appendChild(halof_padSexo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padSexo).appendChild(ttiplof_padSexo);
            loCelda5.appendChild(halof_padDireccion).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padDireccion).appendChild(ttiplof_padDireccion);
            loCelda6.appendChild(halof_padTelefono).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padTelefono).appendChild(ttiplof_padTelefono);
            loCelda7.appendChild(halof_padFechaNacimiento).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padFechaNacimiento).appendChild(ttiplof_padFechaNacimiento);
            loCelda8.appendChild(halof_padriTipo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padriTipo).appendChild(ttiplof_padriTipo);

            document.getElementById("f_padCedula"+i).disabled="true";
   			document.getElementById("f_padCedula"+i).value=padrino.Cedula;
   			document.getElementById("f_padCedula"+i).disabled="true";
			document.getElementById("f_padNombres"+i).value=padrino.Nombres;
			document.getElementById("f_padNombres"+i).disabled="true";
			document.getElementById("f_padApellidos"+i).value=padrino.Apellidos;
			document.getElementById("f_padApellidos"+i).disabled="true";
			document.getElementById("f_padSexo"+i).value=padrino.Sexo;
			document.getElementById("f_padSexo"+i).disabled="true";
			document.getElementById("f_padDireccion"+i).value=padrino.Direccion;
			document.getElementById("f_padDireccion"+i).disabled="true";
			document.getElementById("f_padTelefono"+i).value=padrino.Telefono;
			document.getElementById("f_padTelefono"+i).disabled="true";
			document.getElementById("f_padFechaNacimiento"+i).value=padrino.FechaNacimiento;
			document.getElementById("f_padFechaNacimiento"+i).disabled="true";
			document.getElementById("f_padriTipo"+i).value=padrino.TipoPadri;
			document.getElementById("f_padriTipo"+i).disabled="true";
		
  		
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
            var loCelda6 = loFila.insertCell(5);
			var loCelda7 = loFila.insertCell(6);
            var loCelda8 = loFila.insertCell(7);
			var loCelda9 = loFila.insertCell(8);

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
			lof_padCedula.setAttribute(\'onblur\',"this.value=this.value.toUpperCase(); vCampoVacio(this.id)");
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

			var halof_padDireccion = document.createElement("div"); 
			halof_padDireccion.setAttribute(\'class\',"form-group has-default");
			halof_padDireccion.setAttribute(\'id\',"haf_padDireccion"+liFila);
			
			var ttiplof_padDireccion = document.createElement("div");
			ttiplof_padDireccion.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padDireccion.setAttribute(\'id\',"ttipf_padDireccion"+liFila);
			ttiplof_padDireccion.setAttribute(\'style\',"display:none;");
							
			var lof_padDireccion = document.createElement("textarea");
			lof_padDireccion.setAttribute(\'class\',"form-control");
			lof_padDireccion.setAttribute(\'name\',"f_padDireccion"+liFila);
			lof_padDireccion.setAttribute(\'id\',"f_padDireccion"+liFila);
			lof_padDireccion.setAttribute(\'value\',loF.f_padDireccion.value);
			lof_padDireccion.setAttribute(\'style\',"width:120px;");
			lof_padDireccion.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padDireccion.setAttribute(\'maxlenght\',"150");

			var halof_padTelefono = document.createElement("div"); 
			halof_padTelefono.setAttribute(\'class\',"form-group has-default");
			halof_padTelefono.setAttribute(\'id\',"haf_padTelefono"+liFila);
			
			var ttiplof_padTelefono = document.createElement("div");
			ttiplof_padTelefono.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padTelefono.setAttribute(\'id\',"ttipf_padTelefono"+liFila);
			ttiplof_padTelefono.setAttribute(\'style\',"display:none;");

			var lof_padTelefono = document.createElement("input");
			lof_padTelefono.setAttribute(\'type\',"text");
			lof_padTelefono.setAttribute(\'class\',"form-control");
			lof_padTelefono.setAttribute(\'name\',"f_padTelefono"+liFila);
			lof_padTelefono.setAttribute(\'id\',"f_padTelefono"+liFila);
			lof_padTelefono.setAttribute(\'value\',loF.f_padTelefono.value);
			lof_padTelefono.setAttribute(\'size\',"8");
			lof_padTelefono.setAttribute(\'placeholder\',"(999)9999999");
			lof_padTelefono.setAttribute(\'onfocus\',"MaskTelefono(this.id);");
			lof_padTelefono.setAttribute(\'onkeypress\',"vSoloTelefono();");
			lof_padTelefono.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padTelefono.setAttribute(\'maxlenght\',"12");

			var halof_padFechaNacimiento = document.createElement("div"); 
			halof_padFechaNacimiento.setAttribute(\'class\',"form-group has-default");
			halof_padFechaNacimiento.setAttribute(\'id\',"haf_padFechaNacimiento"+liFila);
			
			var ttiplof_padFechaNacimiento = document.createElement("div");
			ttiplof_padFechaNacimiento.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padFechaNacimiento.setAttribute(\'id\',"ttipf_padFechaNacimiento"+liFila);
			ttiplof_padFechaNacimiento.setAttribute(\'style\',"display:none;");

			var lof_padFechaNacimiento = document.createElement("input");
			lof_padFechaNacimiento.setAttribute(\'type\',"date");
			lof_padFechaNacimiento.setAttribute(\'class\',"form-control");
			lof_padFechaNacimiento.setAttribute(\'name\',"f_padFechaNacimiento"+liFila);
			lof_padFechaNacimiento.setAttribute(\'id\',"f_padFechaNacimiento"+liFila);
			lof_padFechaNacimiento.setAttribute(\'value\',loF.f_padFechaNacimiento.value);
			lof_padFechaNacimiento.setAttribute(\'size\',"12");
			lof_padFechaNacimiento.setAttribute(\'onblur\',"vSoloFechaAnterior(this.id);");
			lof_padFechaNacimiento.setAttribute(\'maxlenght\',"12");

			var halof_padriTipo = document.createElement("div"); 
			halof_padriTipo.setAttribute(\'class\',"form-group has-default");
			halof_padriTipo.setAttribute(\'id\',"haf_padriTipo"+liFila);
			
			var ttiplof_padriTipo = document.createElement("div");
			ttiplof_padriTipo.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padriTipo.setAttribute(\'id\',"ttipf_padriTipo"+liFila);
			ttiplof_padriTipo.setAttribute(\'style\',"display:none;");


			var lof_padriTipo = document.getElementById("f_padriTipo").cloneNode(true);
			lof_padriTipo.setAttribute(\'name\',"f_padriTipo"+liFila);
			lof_padriTipo.setAttribute(\'id\',"f_padriTipo"+liFila);
			lof_padriTipo.setAttribute(\'class\',"form-control");
			lof_padriTipo.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padriTipo.removeAttribute("disabled");

			var lobtnQuitar = document.createElement("input");
			lobtnQuitar.setAttribute(\'type\',"button");
			lobtnQuitar.setAttribute(\'name\',"btnQuitar"+liFila);
			lobtnQuitar.setAttribute(\'id\',"btnQuitar"+liFila);
			lobtnQuitar.setAttribute(\'class\',"btn btn-default btn-circle");
			lobtnQuitar.setAttribute(\'value\',"-");
			lobtnQuitar.setAttribute(\'style\',"margin:10px 8px; width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.428571429");
			lobtnQuitar.setAttribute(\'onclick\',"fpQuitar(this);");
			
             // CON EL METODO appendChild(); LOS AGREGO A LA CELDA QUE QUIERO

            loCelda1.appendChild(halof_padCedula).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padCedula).appendChild(ttiplof_padCedula);
            loCelda2.appendChild(halof_padNombres).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padNombres).appendChild(ttiplof_padNombres);
            loCelda3.appendChild(halof_padApellidos).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padApellidos).appendChild(ttiplof_padApellidos);
            loCelda4.appendChild(halof_padSexo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padSexo).appendChild(ttiplof_padSexo);
            loCelda5.appendChild(halof_padDireccion).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padDireccion).appendChild(ttiplof_padDireccion);
            loCelda6.appendChild(halof_padTelefono).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padTelefono).appendChild(ttiplof_padTelefono);
            loCelda7.appendChild(halof_padFechaNacimiento).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padFechaNacimiento).appendChild(ttiplof_padFechaNacimiento);
            loCelda8.appendChild(halof_padriTipo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padriTipo).appendChild(ttiplof_padriTipo);
            loCelda9.appendChild(lobtnQuitar);

            
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
				document.getElementById("f_padDireccion"+liY).name="f_padDireccion"+liA;
				document.getElementById("f_padDireccion"+liY).id="f_padDireccion"+liA;
				document.getElementById("f_padTelefono"+liY).name="f_padTelefono"+liA;
				document.getElementById("f_padTelefono"+liY).id="f_padTelefono"+liA;
				document.getElementById("f_padFechaNacimiento"+liY).name="f_padFechaNacimiento"+liA;
				document.getElementById("f_padFechaNacimiento"+liY).id="f_padFechaNacimiento"+liA;
				document.getElementById("f_padriTipo"+liY).name="f_padriTipo"+liA;
				document.getElementById("f_padriTipo"+liY).id="f_padriTipo"+liA;
				document.getElementById("btnQuitar"+liY).name="btnQuitar"+liA;
				document.getElementById("btnQuitar"+liY).id="btnQuitar"+liA;

			}
            liFila=liFila-1;
			loF.txtFila.value=liFila;
        }
       
        function fpEliminaFilas()
        {
        	var liFila=Number(loF.txtFila.value);
        	for(i=0;i<liFila;i++)
            {
            	document.getElementById("tabPadrinos").deleteRow(0);
        	}
			loF.txtFila.value="0";
        }
</script>




</html>
'); 






?>
