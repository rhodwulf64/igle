<?php
	
	session_start();
	if(!array_key_exists("usuario", $_SESSION)) 
	{
		header("location: visSalir.php");
	}	
	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion= new clsFunciones;
	
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
			$lsCedulaRepre=$_GET["lsCedulaRepre"];
			$lsNombreParentescoRep=$_GET["lsNombreParentescoRep"];
			$lsCedulaMama=$_GET["lsCedulaMama"];
			$lsCedulaPapa=$_GET["lsCedulaPapa"];
			$lsDescripSacerdote=$_GET["lsDescripSacerdote"];
			$lsNumPartidaNac=$_GET["lsNumPartidaNac"];
			$lsEstatus=$_GET["lsEstatus"];
			$lsProxEscolarMama=$_GET["lsProxEscolarMama"];
			$lsProxEscolarPapa=$_GET["lsProxEscolarPapa"];
			$lsProxEscolarRepre=$_GET["lsProxEscolarRepre"];
			$loadBody="";
			if ((!empty($_GET["bautiRef"]))&&(isset($_GET["bautiRef"])))
			{
				$loadBody='buscaBautImportado('.$_GET["bautiRef"].')';
			}


echo utf8_Decode('
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Inscripción de Bautismo</title>
		');
print(encabezado_menu("../")); //Etiquetas en head-generales
echo utf8_Decode('
	</head>

	<body onload="fpInicio();'.$loadBody.'">
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

	<div class="modal-dialog" id="certificado" style="display:none;z-index: 1100;position:absolute;top:25%;left:30%;">
        <div class="modal-content">
        <form name="fr_Certifi" id="fr_Certifi" action="reportes/CertificadoBautismo.php" method="GET">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="salir();" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Certificado para fines:</h4>
            </div>
            <div class="modal-body">
				<table>
					<tr>
						<td><input type="text" class="form-control" style="width:500px;" placeholder="Ingrese el fin para el presente Certificado" name="FinesCertificado" id="FinesCertificado"/></td>
					</tr>
				</table>
				<br>
				<table id="cargar" class="table table-striped table-bordered table-hover" style="width:640px;"></table>
          	 </div>
            <div class="modal-footer">
            	<input type="hidden" name="ReFinfante" id="ReFinfante" value="">	
           		<button type="submit" class="btn btn-default" data-dismiss="modal">Imprimir Certificado</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="salir();">Cerrar</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>


	');

	encab("../"); //logo de la iglesia
	menu_general(""); //menu principal

	echo utf8_Decode('
	<form name="fr_Bautismo" id="fr_Bautismo" action="../cntller/cn_bautismo.php?lsCedulaRepre='.$lsCedulaRepre.'" method="post">
				<div class="col-lg-12">
				<input type="hidden" id="temporal"/>
				

				<table class="table table-striped table-bordered table-hover"  border="1" >
					<thead>		
						<tr>
							<th colspan="3"><center><div class="alert alert-info" id="divf_cambiaBau"><font id="ntf_cambiaBau" onclick="accionEstados(this.id)"></font></div></center></th>
						</tr>
					</thead>
				<tr title="DATOS DE LA PARTIDA DE NACIMIENTO">
					<th><div class="form-group has-default" id="haf_PartiPresentado"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Presentado(a) El:</font><br><input type="date" size="12" maxlength="12" id="f_PartiPresentado" name="f_PartiPresentado" class="form-control" onblur="fpCreaReferencia(1,this.id,\'date\');" value=""><div class="tool-tip  slideIn" id="ttipf_PartiPresentado" style="display:none;"></div></div></div></th>
					<th><div class="form-group has-default" id="haf_PartiNumero"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Bajo el Número:</font><br><input type="text" size="6" maxlength="20" id="f_PartiNumero" name="f_PartiNumero" class="form-control" value="" onkeypress="vSoloNumeros();" onblur="fpCreaReferencia(2,this.id,\'\');fpActivador();"><div class="tool-tip  slideIn" id="ttipf_PartiNumero" style="display:none;"></div></div></div></th>
					<th><div class="form-group has-default" id="haf_PartiPrefectura"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Reg. Civil Prefectura de:</font><br><input type="text" size="12" maxlength="15" id="f_PartiPrefectura" name="f_PartiPrefectura" class="form-control" value="" onkeypress="vAlfaNum();"><div class="tool-tip  slideIn" id="ttipf_PartiPrefectura" style="display:none;"></div></div></div></th>
					
				</tr>
				<tr>
					<th><div class="form-group has-default" id="haf_nombres"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Nombres del infante:</font><br><input type="text" size="12" maxlength="50" id="f_nombres" name="f_nombres" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_nombres" style="display:none;"></div></div></div></th>
					<th><div class="form-group has-default" id="haf_apellidos"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Apellidos del infante:</font><br><input type="text" size="12" maxlength="50" id="f_apellidos" name="f_apellidos" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_apellidos" style="display:none;"></div></div></div></th>
					<th><div class="form-group has-default" id="haf_sexo"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Sexo del infante:</font><br><select class="form-control" name="f_sexo" id="f_sexo" value="" onblur="vCampoVacio(this.id);"><option value="N" ><p><strong></strong></p></option><option value="F" ><p><strong>Femenino</strong></p></option><option value="M"><p><strong>Masculino</strong></p></option></select><div class="tool-tip  slideIn" id="ttipf_sexo" style="display:none;"></div></div></div></th>
				</tr>
				<tr>
					<th>
						<div class="form-group has-default" id="hacmb_Estado"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Estado" name="cmb_Estado" class="form-control"  onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Estado\',this.id)"><option value="0">*Seleccione Estado</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("estado", "","cod_estado","", ' ',"","descripcion", $selectestado,"", "", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Estado" style="display:none;"></div></div></div>
							<div class="form-group has-default" id="hacmb_Municipio"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Municipio" name="cmb_Municipio" class="form-control"  onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Municipio\',this.id)"><option value="0">*Seleccione Municipio</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("municipio", "","cod_municipio","", ' ',"","descripcion", $selectmunicipio,"", "cod_foraneo", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Municipio" style="display:none;"></div></div></div>
							<div class="form-group has-default" id="hacmb_Parroquia"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Parroquia" name="cmb_Parroquia" class="form-control"  onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Parroquia\',this.id)"><option value="0">*Seleccione Parroquia</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("parroquia", "","cod_parroquia","", ' ',"","descripcion", $selectparroquia,"", "cod_foraneo", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Parroquia" style="display:none;"></div></div></div>
							<div class="form-group has-default" id="hacmb_Ciudad"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Ciudad" name="cmb_Ciudad" class="form-control"  onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Ciudad\',this.id)"><option value="0">*Seleccione Ciudad</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("ciudad", "","cod_ciudad","", ' ',"","descripcion", $selectciudad,"", "cod_foraneo", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Ciudad" style="display:none;"></div></div></div>
					</th>
					<th><div class="form-group has-default" id="haf_direccion"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Dirección:</font><textarea name="f_direccion" id="f_direccion" class="form-control" style="resize:none; overflow-y:scroll; height:100px;" maxlenght="150" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"></div></div></div></th>
					<th><div class="form-group has-default" id="hacmb_presbitero"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Presbítero: </font><br><select class="form-control" id="cmb_presbitero" name="cmb_presbitero" onblur="vCampoVacio(this.id);" ><option></option>
				');
				echo utf8_decode($loFuncion->fncreateComboSelect("tsacerdote", "tpersonas","idTsacerdote","nombres", ' ',"apellidos","concatext", $selectSacer,"INNER JOIN", "idFpersona", "idTpersonas")); 
				echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_presbitero" style="display:none;"></div></div></div>
				<div class="form-group has-default" id="hacmb_ministro"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Ministro: </font><br><select class="form-control" id="cmb_ministro" name="cmb_ministro" onblur="vCampoVacio(this.id);" ><option></option>
				');
				echo utf8_decode($loFuncion->fncreateComboSelect("tsacerdote", "tpersonas","idTsacerdote","nombres", ' ',"apellidos","concatext", $selectSacer,"INNER JOIN", "idFpersona", "idTpersonas")); 
				echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_ministro" style="display:none;"></div></div></div></center></th>
				</tr>
				<tr>
					<th><div class="form-group has-default" id="haf_fechaNac"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha de Nacimiento:</font><br><input type="date" size="12" maxlength="10" id="f_fechaNac" name="f_fechaNac" class="form-control" onblur="vSoloFechaAnterior(this.id);FechaMenorNaciomiento();" value=""><div class="tool-tip  slideIn" id="ttipf_fechaNac" style="display:none;"></div></div></div></th>
				
                                        
						<th><div class="form-group has-default" id="haf_fechaBau"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha del Bautizo:</font><br><input type="date" size="12" maxlength="12" id="f_fechaBau" name="f_fechaBau" class="form-control" value="'.substr($lsFechaBautizo,0,10).'" onblur="vCampoVacio(this.id);vFechaEvento(this.id);"><div class="tool-tip  slideIn" id="ttipf_fechaBau" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_horaBau"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Hora del Bautizo:</font><br><input type="time" size="12" maxlength="12" id="f_horaBau" name="f_horaBau" class="form-control" value="'.substr($lsFechaBautizo,11,8).'" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_horaBau" style="display:none;"></div></div></div></th>
					
				</tr>				
				</table>
				<br>
				<table class="table table-striped table-bordered table-hover" border="1" >
					
							<thead>		
								<tr>
									<th colspan="7"><center>Registro de Representantes</center></th>
								</tr>
							</thead>
								<tr>
										<th align="center"><div class="form-group has-default" id="haf_cedulaMama"><div class="on-focus clearfix" style="position: relative;">
										<font class="control-label">
											CI de la Madre:</font><br> 
											<input type="text"name="f_cedulaMama" id="f_cedulaMama" class="form-control" value="" size="6" maxlength="13" onfocus="MaskCedulaNac(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id); BuscaUnPadre(this.id);" placeholder="V-99999999"><div class="tool-tip  slideIn" id="ttipf_cedulaMama" style="display:none;"></div></div></div> 
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
								</tr>
								<tr>
							
										<th align="center"><div class="form-group has-default" id="haf_cedulaPapa"><div class="on-focus clearfix" style="position: relative;">
											CI del Padre:</font><br> 
											<input type="text" size="6" maxlength="13" id="f_cedulaPapa" name="f_cedulaPapa" placeholder="V-99999999" class="form-control" value="" onfocus="MaskCedulaNac(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id); BuscaUnPadre(this.id);"><div class="tool-tip  slideIn" id="ttipf_cedulaPapa" style="display:none;"></div></div></div>
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
								</tr>
								<tr>
										<th align="center"><div class="form-group has-default" id="haf_cedulaRepre"><div class="on-focus clearfix" style="position: relative;">

											CI del Representante:</font><br>
											<input type="text" size="6" maxlength="13" id="f_cedulaRepre" name="f_cedulaRepre" placeholder="V-99999999" class="form-control" value="" onfocus="MaskCedulaNac(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id); BuscaUnPadre(this.id);"><div class="tool-tip  slideIn" id="ttipf_cedulaRepre" style="display:none;"></div></div></div>
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
											<select class="form-control" name="f_SexoRepre" id="f_SexoRepre" class="form-control" value="" onblur="vCampoVacio(this.id);"><option value="N" ><p><strong></strong></p></option><option value="F" ><p><strong>F</strong></p></option><option value="M" ><p><strong>M</strong></p></option></select><div class="tool-tip  slideIn" id="ttipf_SexoRepre" style="display:none;"></div></div></div>
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
										<th colspan="9"><center>Padrinos Del Bautizo</center></th>
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
											<button type="button" name="btnAgregar" style="margin:10px 8px; width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.428571429" class="btn btn-default btn-circle" onclick="fpAgregar()"><i class="fa fa-plus"></i></button>
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
			
							<input type="text" size="10" maxlength="30" id="f_refInfante" name="f_refInfante" placeholder="Referencia del Bautizo" class="form-control" value="" onkeypress="vSoloNumeros();" style="margin-right:7%;width:26%">
							<input type="hidden" name="f_ceduModifi" id="f_ceduModifi" value="'.$lsCedula.'">
							<input type="hidden" name="txtOperacion" id="txtOperacion" value="'.$lsOperacion.'">
							<input type="hidden" name="txtHacer" id="txtHacer" value="'.$lsHacer.'">
							<input type="hidden" name="txtHay" id="txtHay" value="'.$liHay.'">
							<input type="hidden" name="txtFila" id="txtFila" value="">
							<input type="hidden" name="KestadoActual" id="KestadoActual" value="">
							<input type="hidden" name="CIpadriAlter" value="0">
							<input type="hidden" name="auxiliarHacer" value="">
							<input type="hidden" name="auxiliarOpera" value="">
							<input type="hidden" name="auxiliarPadrino" value="">
							<input type="hidden" name="auxiliarPadre" value="">
							<input type="hidden" name="auxCiudad" id="auxCiudad" value="">
							<input type="hidden" name="auxMunicipio" id="auxMunicipio" value="">
							<input type="hidden" name="auxParroquia" id="auxParroquia" value="">					
							<input type="hidden" name="RefInfanteBuscar" id="RefInfanteBuscar" value="">					
							<input type="button" class="btn btn-default" name="b_Nuevo" value="Nuevo" onclick="fpNuevo()">
							<input type="button" class="btn btn-default" name="b_Modificar" value="Modificar" onclick="fbModificar()">
							<input type="button" class="btn btn-default" name="b_Buscar" value="Buscar" onclick="fpBuscarLike();">
							<input type="button" class="btn btn-default" name="b_Eliminar" value="Estado" onclick="fpDesactivar()">
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
	var loF=document.fr_Bautismo;


	
	
	function fpInicio()
	{
		fpInicial();
		fpCancelar();

	}

	function buscaBautImportado(refe)
	{
		loF.txtOperacion.value="buscar";
		loF.txtHacer.value="buscar";
		loF.RefInfanteBuscar.value=refe;
		fpPerderFocus();
	}

		function rad_select(paramEscri){
			if (loF.txtOperacion.value == "buscar"){
				switch(paramEscri)
				{
				    case 1:
				  	loF.f_cedulaMama.disabled=false;
					loF.f_cedulaPapa.disabled=true;
					loF.f_cedulaRepre.disabled=true;
					loF.f_cedulaMama.focus();
				        break;
				    case 2:
				  	loF.f_cedulaMama.disabled=true;
					loF.f_cedulaPapa.disabled=false;
					loF.f_cedulaRepre.disabled=true;
					loF.f_cedulaPapa.focus();
				        break;
				    case 3:
				  	loF.f_cedulaMama.disabled=true;
					loF.f_cedulaPapa.disabled=true;
					loF.f_cedulaRepre.disabled=false;
					loF.f_cedulaRepre.focus();
				        break;
				    default:
				   	loF.f_cedulaMama.disabled=true;
					loF.f_cedulaPapa.disabled=true;
					loF.f_cedulaRepre.disabled=false;
					loF.f_cedulaRepre.focus();
				}


			}
		}
		

		function fpNuevo()
		{
			fpCambioN();
			loF.f_PartiPresentado.disabled=false;
			loF.f_PartiNumero.disabled=false;
			loF.txtOperacion.value="incluir";
			loF.txtHacer.value="buscar";
			loF.f_PartiPresentado.focus();
		}
		
		function fpEncender()
		{
			var liFila=Number(loF.txtFila.value);
			loF.f_PartiPrefectura.disabled=false;
			loF.f_PartiPresentado.disabled=false;
			loF.f_PartiNumero.disabled=false;
			loF.f_nombres.disabled=false;
			loF.f_apellidos.disabled=false;
			loF.f_sexo.disabled=false;
			loF.f_fechaNac.disabled=false;
			loF.f_fechaBau.disabled=false;
			loF.f_horaBau.disabled=false;
			loF.cmb_presbitero.disabled=false;
			loF.cmb_ministro.disabled=false;
			loF.f_notaMarginal.disabled=false;
			loF.f_cedulaMama.disabled=false;
			loF.f_NombresMama.disabled=false;
			loF.f_ApellidosMama.disabled=false;
			loF.f_cedulaPapa.disabled=false;
			loF.f_NombresPapa.disabled=false;
			loF.f_ApellidosPapa.disabled=false;
			loF.f_cedulaRepre.disabled=false;
			loF.cmb_parentesco.disabled=false;
			loF.f_NombresRepre.disabled=false;
			loF.f_ApellidosRepre.disabled=false;
			loF.f_SexoRepre.disabled=false;
			loF.f_libro.disabled=false;
			loF.f_Folio.disabled=false;
			loF.f_Numero.disabled=false;
			loF.btnAgregar.disabled=false;
			loF.f_direccion.disabled=false;
			loF.cmb_Estado.disabled=false;
			loF.cmb_Ciudad.disabled=false;
			loF.cmb_Municipio.disabled=false;
			loF.cmb_Parroquia.disabled=false;

			for(liY=1;liY<=liFila;liY++)
            {
			
				document.getElementById("f_padNombres"+liY).disabled=false;
				document.getElementById("f_padApellidos"+liY).disabled=false;
				document.getElementById("f_padSexo"+liY).disabled=false;
			}
		}

		function fpEnciendeCI()
		{
			var liFila=Number(loF.txtFila.value);
			for(liY=1;liY<=liFila;liY++)
	        {
				document.getElementById("f_padCedula"+liY).disabled=false;
				document.getElementById("f_padNombres"+liY).disabled=false;
				document.getElementById("f_padApellidos"+liY).disabled=false;
				document.getElementById("f_padSexo"+liY).disabled=false;
			}
		}
		
		function fpApagaNotas()
		{
				document.getElementById("haf_PartiPrefectura").className = "form-group has-default";
				document.getElementById("haf_PartiPresentado").className = "form-group has-default";
				document.getElementById("haf_PartiNumero").className = "form-group has-default";
				document.getElementById("haf_nombres").className = "form-group has-default";
				document.getElementById("haf_apellidos").className = "form-group has-default";
				document.getElementById("haf_sexo").className = "form-group has-default";
				document.getElementById("haf_fechaNac").className = "form-group has-default";
				document.getElementById("haf_fechaBau").className = "form-group has-default";
				document.getElementById("haf_horaBau").className = "form-group has-default";
				document.getElementById("haf_direccion").className = "form-group has-default";
				document.getElementById("hacmb_presbitero").className = "form-group has-default";
				document.getElementById("hacmb_ministro").className = "form-group has-default";
				document.getElementById("hacmb_Estado").className = "form-group has-default";
				document.getElementById("hacmb_Municipio").className = "form-group has-default";
				document.getElementById("hacmb_Parroquia").className = "form-group has-default";
				document.getElementById("hacmb_Ciudad").className = "form-group has-default";
				document.getElementById("haf_notaMarginal").className = "form-group has-default";
				document.getElementById("haf_cedulaMama").className = "form-group has-default";
				document.getElementById("haf_NombresMama").className = "form-group has-default";
				document.getElementById("haf_ApellidosMama").className = "form-group has-default";
				document.getElementById("haf_cedulaPapa").className = "form-group has-default";
				document.getElementById("haf_NombresPapa").className = "form-group has-default";
				document.getElementById("haf_ApellidosPapa").className = "form-group has-default";
				document.getElementById("haf_cedulaRepre").className = "form-group has-default";
				document.getElementById("hacmb_parentesco").className = "form-group has-default";
				document.getElementById("haf_NombresRepre").className = "form-group has-default";
				document.getElementById("haf_ApellidosRepre").className = "form-group has-default";
				document.getElementById("haf_SexoRepre").className = "form-group has-default";
				document.getElementById("haf_libro").className = "form-group has-default";
				document.getElementById("haf_Folio").className = "form-group has-default";
				document.getElementById("haf_Numero").className = "form-group has-default";
			
		}

		function fpApagar()
		{
			var liFila=Number(loF.txtFila.value);
			loF.f_PartiPrefectura.disabled=true;
			loF.f_PartiPresentado.disabled=true;
			loF.f_PartiNumero.disabled=true;
			loF.f_nombres.disabled=true;
			loF.f_apellidos.disabled=true;
			loF.f_sexo.disabled=true;
			loF.f_fechaNac.disabled=true;
			loF.f_fechaBau.disabled=true;
			loF.f_horaBau.disabled=true;
			loF.f_refInfante.disabled=true;
			loF.cmb_presbitero.disabled=true;
			loF.cmb_ministro.disabled=true;
			loF.f_cedulaRepre.disabled=true;
			loF.cmb_parentesco.disabled=true;
			loF.f_cedulaMama.disabled=true;
			loF.f_cedulaPapa.disabled=true;
			loF.f_libro.disabled=true;
			loF.f_Folio.disabled=true;
			loF.f_Numero.disabled=true;
			loF.f_notaMarginal.disabled=true;
			loF.f_NombresMama.disabled=true;
			loF.f_ApellidosMama.disabled=true;
			loF.f_NombresPapa.disabled=true;
			loF.f_ApellidosPapa.disabled=true;
			loF.f_NombresRepre.disabled=true;
			loF.f_ApellidosRepre.disabled=true;
			loF.f_SexoRepre.disabled=true;
			loF.btnAgregar.disabled=true;
			loF.f_direccion.disabled=true;
			loF.cmb_Estado.disabled=true;
			loF.cmb_Ciudad.disabled=true;
			loF.cmb_Municipio.disabled=true;
			loF.cmb_Parroquia.disabled=true;
			document.getElementById("ntf_cambiaBau").innerHTML="Inscripción de Bautismo";
			document.getElementById("divf_cambiaBau").className = "alert alert-info";
			setTimeout(function(){ fpApagaNotas(); }, 300);
						

			for(liY=1;liY<=liFila;liY++)
            {
				document.getElementById("f_padCedula"+liY).disabled=true;
				document.getElementById("f_padNombres"+liY).disabled=true;
				document.getElementById("f_padApellidos"+liY).disabled=true;
				document.getElementById("f_padSexo"+liY).disabled=true;
			}
			fpCombosDireccion("apagar","");
			fpEstadoActual();
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
			loF.f_nombres.value="";
			loF.f_apellidos.value="";
			loF.f_direccion.value="";
			loF.f_sexo.value="";
			loF.f_fechaNac.value="";
			loF.f_fechaBau.value="";
			loF.f_horaBau.value="";
			loF.f_refInfante.value="";
			loF.cmb_presbitero.value="";
			loF.cmb_ministro.value="";
			loF.cmb_Estado.value="0";
			loF.cmb_Municipio.value="0";
			loF.cmb_Parroquia.value="0";
			loF.cmb_Ciudad.value="0";
			loF.f_cedulaRepre.value="";
			loF.cmb_parentesco.value="";
			loF.f_cedulaMama.value="";
			loF.f_cedulaPapa.value="";
			loF.f_libro.value="";
			loF.f_Folio.value="";
			loF.f_Numero.value="";
			loF.f_notaMarginal.value="";
			loF.f_NombresMama.value="";
			loF.f_ApellidosMama.value="";
			loF.f_NombresPapa.value="";
			loF.f_ApellidosPapa.value="";
			loF.f_NombresRepre.value="";
			loF.f_ApellidosRepre.value="";
			loF.f_SexoRepre.value="";
		
			fpApagar();
			fpInicial();
			loF.auxiliarHacer.value="buscar";	
			fpEliminaFilas();

			
		}

		function fpBuscarLike()
		{
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");

			mas.style.display = "block";
			bus.style.display = "block";

			document.getElementById("txtbuscador").focus();
		}

		function ImprimeCertificado()
		{
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("certificado");

			mas.style.display = "block";
			bus.style.display = "block";

			document.getElementById("FinesCertificado").focus();
		}

		function fbValidarReportes()
		{
			return true;
		}

		function accionEstados(estadoid)
		{
			var formuCerti=document.getElementById("fr_Certifi");
			var valorEstado = document.getElementById(estadoid).innerHTML;


					if (valorEstado=="Bautizado <br> (Click Aqui Para imprimir Certificado)")
					{
						if(fbValidarReportes())
						{
							ImprimeCertificado();
							formuCerti.ReFinfante.value=loF.RefInfanteBuscar.value;
						}
						else
						{
							NotificaE("Debe completar los campos obligatorios antes de imprimir algun reporte");
						}
					}
		}

		function fpSelectLike(idlke)
		{
			var lke = document.getElementById(idlke);
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");
			

			mas.style.display = "none";
			bus.style.display = "none";
			

			loF.RefInfanteBuscar.value=lke.RefInfante.value;
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.txtHay.value=0;
			fpPerderFocus();

		}

		function salir()
		{
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");
			var mas2 = document.getElementById("certificado");

			mas.style.display = "none";
			bus.style.display = "none";
			mas2.style.display = "none";
			

			fpCancelar();			
		}

		
		function fpBuscar()
		{
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.f_refInfante.disabled=false;

			fpCambioB();
			loF.f_refInfante.focus();
			
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
		
		function fpPerderFocus()
		{
				if((loF.RefInfanteBuscar.value!="")&&(loF.txtHacer.value=="buscar"))
					{
						var $forme = $("#fr_Bautismo");

					$.ajax({
						url: \'../cntller/cn_bautismo.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var Bautizo=data[\'Bauti\'];
				        	var Repres=data[\'Repres\']
           					var Padri=data[\'Padri\'];
							if((Bautizo.lsNombresBau!=null))
							{

									loF.f_PartiPrefectura.value = Bautizo.lsPrefectuDe;
									loF.f_PartiPresentado.value = Bautizo.lsPresentadoEl;
									loF.f_PartiNumero.value = Bautizo.lsNumPartidaNac;
									loF.f_nombres.value = Bautizo.lsNombresBau;
									loF.f_apellidos.value = Bautizo.lsApellidosBau;
									loF.f_sexo.value = Bautizo.lsSexoBau;
									loF.f_fechaNac.value = Bautizo.lsFechaNacimiento;
									loF.f_fechaBau.value = Bautizo.lsFechaBautizo;
									loF.f_horaBau.value = Bautizo.lsHoraBautizo;
									loF.f_direccion.value = Bautizo.lsDireccion;
									loF.f_refInfante.value = Bautizo.lsReferenciaInfante;
									loF.cmb_presbitero.value = Bautizo.lsIDSacerdote;
									loF.cmb_ministro.value = Bautizo.lsIDMinistro;
									loF.f_cedulaRepre.value = Bautizo.lsCeduRepre;
									loF.cmb_parentesco.value = Bautizo.lsIDParentesco;
									loF.f_cedulaMama.value = Bautizo.lsCeduMama;
									loF.f_cedulaPapa.value = Bautizo.lsCeduPapa;
									loF.f_libro.value = Bautizo.lsLibro_registro;
									loF.f_Folio.value = Bautizo.lsFolio_registro;
									loF.f_Numero.value = Bautizo.lsNumero_registro;
									loF.f_notaMarginal.value = Bautizo.lsNotaMarginal;
	

									loF.f_NombresMama.value = Repres.lsNombreMama;
									loF.f_ApellidosMama.value = Repres.lsApellidoMama;
								
									loF.f_NombresPapa.value = Repres.lsNombrePapa;
									loF.f_ApellidosPapa.value = Repres.lsApellidoPapa;
									
									loF.f_NombresRepre.value = Repres.lsNombreRepre;
									loF.f_ApellidosRepre.value = Repres.lsApellidoRepre;
									loF.f_SexoRepre.value = Repres.lsSexoRepre;

									loF.KestadoActual.value = Bautizo.lsEstatusBau;

		
									muestraPadri="si";

									if((Padri)&&(muestraPadri=="si"))
									{
										fpListarPadri(Padri);

									}


								if ((loF.txtOperacion.value=="buscar")&&(Bautizo.liHay!=0))
								{
									fpCambioE();
									fpApagar();
								}
									$("#cmb_Ciudad").showOption(Bautizo.lsCiudad);
									$("#cmb_Municipio").showOption(Bautizo.lsMunicipio);
									$("#cmb_Parroquia").showOption(Bautizo.lsParroquia);
									loF.cmb_Estado.value = Bautizo.lsEstado;
									loF.cmb_Ciudad.value = Bautizo.lsCiudad;
									loF.cmb_Municipio.value = Bautizo.lsMunicipio;
									loF.cmb_Parroquia.value = Bautizo.lsParroquia;

								if (Bautizo.lsEstatusBau==0)
								{
									document.getElementById("ntf_cambiaBau").innerHTML="No se realizó el Bautizo";
									document.getElementById("divf_cambiaBau").className = "alert alert-danger";
								}
								else if(Bautizo.lsEstatusBau==1)
								{
									document.getElementById("ntf_cambiaBau").innerHTML="Bautizado <br> (Click Aqui Para imprimir Certificado)";
									document.getElementById("divf_cambiaBau").className = "alert alert-success";
								}
								else
								{
									document.getElementById("ntf_cambiaBau").innerHTML="Estado";
									document.getElementById("divf_cambiaBau").className = "alert alert-info";
								}


							}



							if ((loF.txtOperacion.value=="buscar")&&(Bautizo.liHay==0))
							{
								NotificaE("No se encontro ningun Bautizo con la referencia ingresada");
								loF.f_refInfante.value="";
								loF.f_refInfante.focus();
							}

							if ((loF.txtOperacion.value=="buscar")&&(Bautizo.liHay==1))
							{
								muestraPadri="si";
							}
							
							if((loF.txtOperacion.value=="incluir")&&(Bautizo.liHay==0))
							{
								//ARRANCA ACA




							}

							if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(Bautizo.liHay==1)) //si ya tiene Bautizo registrado.
							{
								NotificaE("La Referencia Ingresada ya tiene un Bautizo registrado");
									muestraPadri="si";
									fpCambioE();
									fpApagar();
									loF.txtOperacion.value="buscar";
									loF.txtHacer.value="buscar";
									loF.txtHay.value=0;

							}

							if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(Bautizo.liHay==0)) //si no tiene Bautizo registrado.
							{
									muestraPadri="si";
									fpEncender();
									loF.f_refInfante.disabled=true;
									loF.f_PartiPresentado.disabled=true;
									loF.f_PartiNumero.disabled=true;
									document.getElementById("haf_PartiPresentado").className = "form-group has-success";
									document.getElementById("haf_PartiNumero").className = "form-group has-success";
									loF.txtOperacion.value="incluir";
									loF.txtHacer.value="incluir";
									loF.txtHay.value=0;
									loF.f_PartiPrefectura.focus();
							}
							
						}
					});
					}
				else
					{
						loF.f_refInfante.focus();
					}
			
		}


		function fpPerderFocus1()
		{
			if((loF.f_cedulaMama.value!="")&&(loF.txtHacer.value=="buscar1"))
			{
				loF.submit();
			}
			else
			{
				loF.f_cedulaMama.focus();
			}
		}
		
		function fpPerderFocus2()
		{
			if((loF.f_cedulaPapa.value!="")&&(loF.txtHacer.value=="buscar2"))
			{
				loF.submit();
			}
			else
			{
				loF.f_cedulaPapa.focus();
			}
		}

		function fpPerderFocus3()
		{

				if((loF.f_cedulaRepre.value!="")&&(loF.txtHacer.value=="buscar3"))
				{
					loF.submit();
				}
				else
				{
					loF.f_cedulaRepre.focus();
				}

		}


		function fpGuardar()
		{
			if(fbValidar())
			{
				loF.f_refInfante.disabled=false;
				loF.f_PartiPresentado.disabled=false;
				loF.f_PartiNumero.disabled=false;
				loF.f_cedulaRepre.disabled=false;
				loF.f_cedulaRepre.disabled=false;
				loF.f_cedulaMama.disabled=false;
				loF.f_cedulaPapa.disabled=false;

				fpEnciendeCI();
				var $forme = $("#fr_Bautismo");
				

					$.ajax(
					{
						url: \'../cntller/cn_bautismo.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var data21=data[\'Bauti\'];
           					var data22=data[\'Padri\'];
							if((data21.liHay!=null))
							{
								if ((loF.txtHacer.value=="incluir")&&(data21.liHay==2))
								{
									NotificaE("Registro no pudo ser incluido.");

								}
								if ((loF.txtHacer.value=="incluir")&&(data21.liHay==1))
								{
									NotificaS("Registro incluido con exito.");
									fpCancelar();
								}

								if ((loF.txtHacer.value=="modificar")&&(data21.liHay==2))
								{
									NotificaE("Registro no pudo ser modificado.");

								}

								if ((loF.txtHacer.value=="modificar")&&(data21.liHay==1))
								{
									NotificaS("Registro modificado con exito.");
									fpCancelar();
								}

								if ((loF.txtHacer.value=="reactivar")&&(data21.liHay==2))
								{
									NotificaE("Registro no pudo ser Reactivado.");

								}

								if ((loF.txtHacer.value=="reactivar")&&(data21.liHay==1))
								{
									NotificaS("Registro Reactivado con exito.");
									fpCancelar();
								}

								if ((loF.txtHacer.value=="eliminar")&&(data21.liHay==2))
								{
									NotificaE("Registro no pudo ser Desactivado.");

								}

								if ((loF.txtHacer.value=="eliminar")&&(data21.liHay==1))
								{
									NotificaS("Registro Desactivado con exito.");
									fpCancelar();
								}


							}
						}
					});
			}
		}
		
		function FechaMenorNaciomiento()
		{
			if(loF.f_PartiPresentado.value<loF.f_fechaNac.value)
			{
				document.getElementById("haf_fechaNac").className = "form-group has-error";
			  	document.getElementById("ttipf_fechaNac").style.display = "block";
			  	document.getElementById("ttipf_fechaNac").textContent = "No pudo ser presentado antes de Nacer";
				vInvalido=1;
			}
			else
			{
				document.getElementById("haf_fechaNac").className = "form-group has-default";
	  			document.getElementById("ttipf_fechaNac").style.display = "none";
			}
		}
		function fbValidar()
		{
			var lbValido=false;
			var vInvalido=0;
			if(loF.f_PartiPrefectura.value=="")
			{
				loF.f_PartiPrefectura.focus();
				vCampoVacio("f_PartiPrefectura");
				vInvalido=1;
			}
			if(vSoloFechaAnterior("f_PartiPresentado")==false)
			{
				loF.f_PartiPresentado.focus();
				vInvalido=1;
			}

			if(loF.f_PartiNumero.value=="")
			{
				loF.f_PartiNumero.focus();
				vCampoVacio("f_PartiNumero");
				vInvalido=1;
			}
			if(loF.f_nombres.value=="")
			{
				loF.f_nombres.focus();
				vCampoVacio("f_nombres");
				vInvalido=1;
			}
			if(loF.f_apellidos.value=="")
			{
				loF.f_apellidos.focus();
				vCampoVacio("f_apellidos");
				vInvalido=1;
			}
			if(loF.f_sexo.value=="")
			{
				loF.f_sexo.focus();
				vCampoVacio("f_sexo");
				vInvalido=1;
			}
			if(vSoloFechaAnterior("f_fechaNac")==false)
			{
				loF.f_fechaNac.focus();
				vInvalido=1;
			}

			if(loF.f_fechaBau.value=="")
			{
				loF.f_fechaBau.focus();
				vCampoVacio("f_fechaBau");
				vInvalido=1;
			}

			if(vFechaEvento("f_fechaBau")==false)
			{
				loF.f_fechaBau.focus();
				vInvalido=1;
			}
			if(loF.f_horaBau.value=="")
			{
				loF.f_horaBau.focus();
				vCampoVacio("f_horaBau");
				vInvalido=1;
			}
			if(loF.cmb_presbitero.value=="")
			{
				loF.cmb_presbitero.focus();
				vCampoVacio("cmb_presbitero");
				vInvalido=1;
			}
			if(loF.cmb_ministro.value=="")
			{
				loF.cmb_ministro.focus();
				vCampoVacio("cmb_ministro");
				vInvalido=1;
			}
			if(loF.f_cedulaMama.value=="")
			{
				loF.f_cedulaMama.focus();
				vCampoVacio("f_cedulaMama");
				vInvalido=1;
			}
			if(loF.f_NombresMama.value=="")
			{
				loF.f_NombresMama.focus();
				vCampoVacio("f_NombresMama");
				vInvalido=1;
			}
			if(loF.f_ApellidosMama.value=="")
			{
				loF.f_ApellidosMama.focus();
				vCampoVacio("f_ApellidosMama");
				vInvalido=1;
			}
			if(loF.f_cedulaPapa.value=="")
			{
				loF.f_cedulaPapa.focus();
				vCampoVacio("f_cedulaPapa");
				vInvalido=1;
			}
			if(loF.f_NombresPapa.value=="")
			{
				loF.f_NombresPapa.focus();
				vCampoVacio("f_NombresPapa");
				vInvalido=1;
			}
			if(loF.f_ApellidosPapa.value=="")
			{
				loF.f_ApellidosPapa.focus();
				vCampoVacio("f_ApellidosPapa");
				vInvalido=1;
			}
			if(loF.f_cedulaRepre.value=="")
			{
				loF.f_cedulaRepre.focus();
				vCampoVacio("f_cedulaRepre");
				vInvalido=1;
			}
			if(loF.cmb_parentesco.value=="")
			{
				loF.cmb_parentesco.focus();
				vCampoVacio("cmb_parentesco");
				vInvalido=1;
			}
			if(loF.f_NombresRepre.value=="")
			{
				loF.f_NombresRepre.focus();
				vCampoVacio("f_NombresRepre");
				vInvalido=1;
			}
			if(loF.f_ApellidosRepre.value=="")
			{
				loF.f_ApellidosRepre.focus();
				vCampoVacio("f_ApellidosRepre");
				vInvalido=1;
			}
			if(loF.f_SexoRepre.value=="")
			{
				loF.f_SexoRepre.focus();
				vCampoVacio("f_SexoRepre");
				vInvalido=1;
			}

			if(loF.f_PartiPresentado.value<loF.f_fechaNac.value)
			{
				document.getElementById("haf_fechaNac").className = "form-group has-error";
			  	document.getElementById("ttipf_fechaNac").style.display = "block";
			  	document.getElementById("ttipf_fechaNac").textContent = "No pudo ser presentado antes de Nacer";
				vInvalido=1;
			}
			else
			{
				document.getElementById("haf_fechaNac").className = "form-group has-default";
	  			document.getElementById("ttipf_fechaNac").style.display = "none";
			}
			if (vInvalido==0)
			{
				lbValido=fbValidaPadrinos();
			}
			return lbValido;
		}

		function fpActivador()
		{
			if(vSoloFechaAnterior("f_PartiPresentado"))
			{

				if ((loF.f_PartiPresentado.value!="")&&(loF.f_PartiNumero.value!=""))
				{

					fpPerderFocus();
				}
			
			}
		}

		function fbValidaPadrinos()
		{
			var lbValido=false;
			var vInvalido=0;

			var liFila=Number(loF.txtFila.value);
			if (liFila>1)
			{
	            for(liY=1;liY<=liFila;liY++)
	            {
	            	
					if(document.getElementById("f_padCedula"+liY).value=="")
					{

						document.getElementById("f_padCedula"+liY).focus();
						vCampoVacio("f_padCedula"+liY);
					}
					if(document.getElementById("f_padNombres"+liY).value=="")
					{
						document.getElementById("f_padNombres"+liY).focus();
						vCampoVacio("f_padNombres"+liY);
					}
					if(document.getElementById("f_padApellidos"+liY).value=="")
					{
						document.getElementById("f_padApellidos"+liY).focus();
						vCampoVacio("f_padApellidos"+liY);
					}
					if(document.getElementById("f_padSexo"+liY).value=="")
					{
						document.getElementById("f_padSexo"+liY).focus();
						vCampoVacio("f_padSexo"+liY);
					}
					if(vInvalido==0)
					{
						lbValido=true;
					}
				}
			}
			else
			{
				NotificaE("Lo siento, debe agregar al menos 2 Padrinos");
			}
		
			return lbValido;
		}
		
		function fbModificar()
		{
			fpEncender();
			fpCambioN();
			loF.txtOperacion.value="modificar";
			loF.txtHacer.value="modificar";
			loF.f_nombres.focus();
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
				if(confirm("Desea Reactivar el Bautizo?"))
				{
					loF.f_refInfante.disabled=false;
					loF.txtOperacion.value="activar";
					loF.txtHacer.value="activar";
					
					var $forme = $("#fr_Bautismo");

					$.ajax({
						url: \'../cntller/cn_bautismo.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
						var Bautizo=data[\'Bauti\'];
							if(Bautizo.liHay==1)
							{
									fpCancelar();
									NotificaS("Bautizo Reactivado");
									fpInicial();
									loF.KestadoActual.value=1;
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Reactivar el Bautizo");
									fpInicial();
									loF.KestadoActual.value=0;
									
							}
						}
					});


				}
			}
			else
			{
				if(confirm("Desea Desactivar el Bautizo?"))
				{
					loF.f_refInfante.disabled=false;
					loF.txtOperacion.value="desactivar";
					loF.txtHacer.value="desactivar";
					var $forme = $("#fr_Bautismo");

					$.ajax({
						url: \'../cntller/cn_bautismo.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        var Bautizo=data[\'Bauti\'];
							if(Bautizo.liHay==1)
							{
									fpCancelar();
									NotificaS("Bautizo Desactivado");
									fpInicial();
									loF.KestadoActual.value=0;
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Desactivar el Bautizo");
									fpInicial();
									loF.KestadoActual.value=1;
									
							}
						}
					});

				}
			}
		}

		function BuscaUnPadre(objetoID)
		{
			loF.auxiliarHacer.value=loF.txtHacer.value;
			loF.auxiliarOpera.value=loF.txtOperacion.value;
			var cedupadre=document.getElementById(objetoID).value.split(\' \').join(\'\');
			loF.txtOperacion.value="buscarPadre";
			var prosigue = 0;
			loF.txtHacer.value="buscarPadre";
			document.getElementById(objetoID).disabled=false;
			var CIrepre=loF.f_cedulaRepre.value.trim();
			var CImadre=loF.f_cedulaMama.value.trim();
			var CIpadre=loF.f_cedulaPapa.value.trim();
			var ceduPad=document.getElementById(objetoID).value.trim();

			if ((CIpadre==CImadre)&&(CImadre!=""))
			{
				document.getElementById(objetoID).value="";
				document.getElementById(objetoID).focus();
				NotificaE("No puede registrar el mismo representante como padre.");
				prosigue = 1;
			}
			if ((cedupadre.length>5)&&(prosigue==0))
			{
				loF.auxiliarPadre.value=cedupadre;
				var $forme = $("#fr_Bautismo");

				$.ajax({
					url: \'../cntller/cn_bautismo.php\',
					dataType: \'json\',
					type: \'post\',
					data: $forme.serialize(),
			        success: function(data){
			        	var Bautizo=data[\'Bauti\']
			        	var PerPadre=data[\'PersoPadres\'];
						if((Bautizo.liHay==1)&&(Bautizo.lsHacer=="buscarPadre"))
						{
							if(objetoID=="f_cedulaRepre")
							{
								document.getElementById("haf_cedulaRepre").className = "form-group has-warning";				
								document.getElementById("haf_NombresRepre").className = "form-group has-default";
								document.getElementById("haf_ApellidosRepre").className = "form-group has-default";
								document.getElementById("haf_SexoRepre").className = "form-group has-default";
								document.getElementById("f_cedulaRepre").value = PerPadre.lscedu;
								document.getElementById("f_NombresRepre").value = PerPadre.lsNomb;
								document.getElementById("f_ApellidosRepre").value = PerPadre.lsApel;
								document.getElementById("f_SexoRepre").value = PerPadre.lsSexo;
								document.getElementById("f_cedulaRepre").disabled = true;
								document.getElementById("f_NombresRepre").disabled = true;
								document.getElementById("f_ApellidosRepre").disabled = true;
								document.getElementById("f_SexoRepre").disabled = true;
							}
							else if(objetoID=="f_cedulaMama")
							{
								document.getElementById("haf_cedulaMama").className = "form-group has-warning";				
								document.getElementById("haf_NombresMama").className = "form-group has-default";
								document.getElementById("haf_ApellidosMama").className = "form-group has-default";
								document.getElementById("f_cedulaMama").value = PerPadre.lscedu;
								document.getElementById("f_NombresMama").value = PerPadre.lsNomb;
								document.getElementById("f_ApellidosMama").value = PerPadre.lsApel;
								document.getElementById("f_cedulaMama").disabled = true;
								document.getElementById("f_NombresMama").disabled = true;
								document.getElementById("f_ApellidosMama").disabled = true;
							}
							else if(objetoID=="f_cedulaPapa")
							{
								document.getElementById("haf_cedulaPapa").className = "form-group has-warning";				
								document.getElementById("haf_NombresPapa").className = "form-group has-default";
								document.getElementById("haf_ApellidosPapa").className = "form-group has-default";
								document.getElementById("f_cedulaPapa").value = PerPadre.lscedu;
								document.getElementById("f_NombresPapa").value = PerPadre.lsNomb;
								document.getElementById("f_ApellidosPapa").value = PerPadre.lsApel;
								document.getElementById("f_cedulaPapa").disabled = true;
								document.getElementById("f_NombresPapa").disabled = true;
								document.getElementById("f_ApellidosPapa").disabled = true;
							}							

						}
						else	
						{
							document.getElementById("ha"+objetoID).className = "form-group has-success";
						}
					}
				});
			}
			else
			{
				document.getElementById("ha"+objetoID).className = "form-group has-error";
			}

		loF.txtHacer.value=loF.auxiliarHacer.value;
		loF.txtOperacion.value=loF.auxiliarOpera.value;
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
			var CIrepre=loF.f_cedulaRepre.value.trim();
			var CImadre=loF.f_cedulaMama.value.trim();
			var CIpadre=loF.f_cedulaPapa.value.trim();
			var ceduPad=document.getElementById("f_padCedula"+linea).value.trim();

			if ((ceduPad==CIrepre)&&(CIrepre!="")||(ceduPad==CImadre)&&(CImadre!="")||(ceduPad==CIpadre)&&(CIpadre!=""))
			{
				document.getElementById("f_padCedula"+linea).value="";
				document.getElementById("f_padCedula"+linea).focus();
				NotificaE("No puede registrar el mismo representante como padrino.");
				prosigue = 1;
			}
			if ((cedupadri.length>5)&&(prosigue==0))
			{
				loF.auxiliarPadrino.value=cedupadri;
				var $forme = $("#fr_Bautismo");

				$.ajax({
					url: \'../cntller/cn_bautismo.php\',
					dataType: \'json\',
					type: \'post\',
					data: $forme.serialize(),
			        success: function(data){
			        	var Bautizo=data[\'Bauti\']
			        	var PerPadri=data[\'PersoPadri\'];
						if((Bautizo.liHay==1)&&(Bautizo.lsHacer=="buscarPadri"))
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
            loCelda5.appendChild(lobtnQuitar);

            
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
        	for(i=0;i<liFila;i++)
            {
            	document.getElementById("tabPadrinos").deleteRow(0);
        	}
			loF.txtFila.value="0";
        }

        function buscar_like(e){
			var parametros = "?AccionGet=buscar_like&txtcadena="+e.value;
			var url = "../cntller/cn_bautismo.php";
			consulta_ajax(url,parametros);
			document.getElementById("cargar").innerHTML = document.getElementById("temporal").value;
		}

</script>

	</html>

'); 






?>
