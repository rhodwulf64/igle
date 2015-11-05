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
		<title>'.$_SESSION['title'].' - Inscripción de Comunión</title>
		');
			print(encabezado_menu("../"));

	echo utf8_Decode('
		</head>
		<body onload="fpInicio();"><div class="mygrid-wrapper-div">
<div class="container pre-scrollable" style="margin-top:5px; min-height: 530px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">');
		encab("../");
		menu_general("");
		
echo utf8_Decode('
	<form name="fr_pracomunion" id="fr_pracomunion" action="../con/cn_comunion.php" method="post">
			<div class="col-lg-12">
				<table class="table table-striped table-bordered table-hover"  border="1" >
					<thead>		
						<tr>
							<th colspan="3"><center>Inscripción de Primera Comunión</center></th>
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
						<th><center><div class="alert alert-info" id="divf_cambiaComunion"><font id="ntf_cambiaComunion"></font></div></center></th>
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
											<textarea name="f_DireccionMama" id="f_DireccionMama" class="form-control" style="width:120px; resize:none; overflow-y:scroll" maxlenght="12" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_DireccionMama" style="display:none;"></div></div></div> 
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
											<textarea name="f_DireccionPapa" id="f_DireccionPapa" class="form-control" style="width:120px; resize:none; overflow-y:scroll" maxlenght="12" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_DireccionPapa" style="display:none;"></div></div></div> 
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
											<textarea name="f_DireccionRepre" id="f_DireccionRepre" class="form-control" style="width:120px; resize:none; overflow-y:scroll" maxlenght="12" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_DireccionRepre" style="display:none;"></div></div></div>
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

		</div>
	</div>
	<div class="container" style="margin-top:5px; padding:5px; min-height: auto; background: #FFFFFF; -webkit-box-shadow: 0px 2px 5px 2px #999; -moz-box-shadow: 2px 2px 5px #999;">
		<table class="table table-striped table-bordered table-hover" border="1" style="margin:0px">
			<tr>
				<th colspan="2"><center>
					<input type="hidden" name="txtOperacion" id="txtOperacion" value="'.$lsOperacion.'">
					<input type="hidden" name="txtHacer" id="txtHacer" value="'.$lsHacer.'">
					<input type="hidden" name="txtHay" id="txtHay" value="'.$liHay.'">
					<input type="hidden" name="KestadoActual" id="KestadoActual" value="">
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
var loF=document.fr_pracomunion;

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

		
		}


		function fpApagar()
		{
			
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
			document.getElementById("ntf_cambiaComunion").innerHTML="Estado de la Primera Comunion";
			document.getElementById("divf_cambiaComunion").className = "alert alert-info";

		}
		
		function fpCancelar()
		{
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
				
						
				var $forme = $("#fr_pracomunion");

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
									loF.btn_EstadoPraComunion.value="En espera de la Primera Comunion";
								}
								else if(data21.lsedomatri==1){

									loF.btn_EstadoPraComunion.value="Confirmado";
								}
								else if(data21.lsedomatri==2){
									loF.btn_EstadoPraComunion.value="Suspendido";
								}
								else if(data21.lsedomatri==3){
									loF.btn_EstadoPraComunion.value="No se realizo la Primera Comunion";
								}
								else
								{
									loF.btn_EstadoPraComunion.value="Estado no disponible";
								}

							}

							if ((loF.txtOperacion.value=="buscar")&&(data21.liHay==0))
							{
								alert("No se encontro ninguna Primera Comunion con la referencia ingresada");
								loF.f_cedulaEstu.value="";
								loF.f_cedulaEstu.focus();
							}

												
							if((loF.txtOperacion.value=="incluir")&&(data21.liHay==0))
							{
								alert("La cedula ingresada no esta registrada");
											loF.f_cedulaEstu.value="";
											loF.f_cedulaEstu.focus();
							}

							if((loF.txtOperacion.value=="incluir")&&(data21.liHay==1)) //si la cedula existe y ya tiene Matrimonio.
							{
								alert("La referencia Ingresada ya tiene una Primera Comunion registrado");
								
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
			
</script>

</html>
'); 






?>
