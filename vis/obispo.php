<?php

    session_start();
    if(!array_key_exists("usuario", $_SESSION)) 
	{
		header("location: visSalir.php");
	}
	if ($_SESSION["rol"]!="S")
	{
		$_SESSION["message"]="Usted no tiene los accesos para realizar esa accion.";
		header("location: ../index.php");
	}
	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");

		$loFuncion =new clsFunciones;
		$objetivo=$loFuncion->fTipoPersona($lsObj);
	
    $lsOperacion=$_GET["lsOperacion"];
	$lsHacer=$_GET["lsHacer"];
	$liHay=$_GET["liHay"];
	$CeduImportada=$_GET["Cedu"];
	
	$lsCedulaRepre=$_GET["lsCedula"];
	$lsNombre=$_GET["lsNombre"];
	$lsApellido=$_GET["lsApellido"];
	$lsFechaNaci=$_GET["lsFechaNaci"];
	$lsDireccion=$_GET["lsDireccion"];
	$lsTelefono=$_GET["lsTelefono"];
	$lsFechaRegistro=$_GET["lsFechaRegistro"];
	$FunIncio="fpInicio();";
	if ($CeduImportada!="")
	{
		$FunIncio="fpPredeterminado();";
	}

	echo utf8_Decode('
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Registro del Obispo</title>

	');
			print(encabezado_menu("../"));

echo utf8_Decode('
		</head>

	<body onload='.$FunIncio.'>
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

	encab("../"); //logo de la iglesia
	menu_general(""); //menu principal

	echo utf8_Decode('
		<form name="fr_Persona" id="fr_Persona" action="../cntller/cn_obispo.php" method="post">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered table-hover"  border="1" >
						<thead>		
							<tr>
								<th colspan="3"><center>Registro del Obispo</center></th>
							</tr>
						</thead>
						<tr>
							<th><div class="form-group has-default" id="haf_cedula"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">CI:</font><input type="text" name="f_cedula" id="f_cedula" class="form-control" value="" size="6" maxlength="13" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id); fpPerderFocus(this);" placeholder="V-99999999"><div class="tool-tip  slideIn" id="ttipf_cedula" style="display:none;"></div></div></div></th>
							<th><div class="form-group has-default" id="haf_fechaNac"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha de Nacimiento:</font><input type="date" name="f_fechaNac" id="f_fechaNac" class="form-control" onblur="vSoloFechaAnterior(this.id);vMayorDeEdad(this.id);" value=""><div class="tool-tip  slideIn" id="ttipf_fechaNac" style="display:none;"></div></div></div></th>
						</tr>
						<tr>
							<th><div class="form-group has-default" id="haf_nombres"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Nombres:</font><input type="text" name="f_nombres" id="f_nombres" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_nombres" style="display:none;"></div></div></div></th>
							<th><div class="form-group has-default" id="haf_apellidos"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Apellidos:</font><input type="text" name="f_apellidos" id="f_apellidos" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_apellidos" style="display:none;"></div></div></div></th>
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
							<th><div class="form-group has-default" id="haf_direccion"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Dirección:</font><textarea name="f_direccion" id="f_direccion" class="form-control" style="resize:none; overflow-y:scroll; height:100px;" maxlenght="150" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"></div></div></div>
								<div class="form-group has-default" id="haf_Observacion">
									<div class="on-focus clearfix" style="position: relative;">
										<span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span>
											<font class="control-label">Observación:</font>
												<textarea name="f_Observacion" id="f_Observacion" class="form-control" style="resize:none; overflow-y:scroll; height:60px;" maxlenght="150" onblur="vCampoVacio(this.id);" disabled>
												</textarea>
												<div class="tool-tip  slideIn" id="ttipf_Observacion" style="display:none;"></div>
									</div>
								</div>
							</th>
						</tr>
						<tr>
							<th>
							<div class="form-group has-default" id="haf_telefono"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Teléfono:</font><input type="text" name="f_telefono" id="f_telefono" size="8" maxlenght="12" class="form-control" value="" placeholder="(999)9999999" onfocus="MaskTelefono(this.id)" onkeypress="vSoloTelefono();" onblur="vCampoVacio(this.id);" size="8" maxlenght="12"><div class="tool-tip  slideIn" id="ttipf_telefono" style="display:none;"></div></div></div>
							</th>
							<th>
							</th>
						</tr>
						<tr>
							<th><div class="form-group has-default" id="haf_fechaInicioDiocesis"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha Inicio en Diócesis:</font><input type="date" name="f_fechaInicioDiocesis" id="f_fechaInicioDiocesis" class="form-control" onblur="vSoloFechaAnterior(this.id);" value=""><div class="tool-tip  slideIn" id="ttipf_fechaInicioDiocesis" style="display:none;"></div></div></div></th>
							<th><div class="form-group has-default" id="haf_fechaFinDiocesis"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha Fin en Diócesis:</font><input type="date" name="f_fechaFinDiocesis" id="f_fechaFinDiocesis" class="form-control" onblur="vSoloFechaAnterior(this.id);" value=""><div class="tool-tip  slideIn" id="ttipf_fechaFinDiocesis" style="display:none;"></div></div></div></th>
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
						<input type="hidden" name="KestadoActual" id="KestadoActual" value="">
						<input type="hidden" name="lsObj" id="lsObj" value="'.$lsObj.'">
						<input type="hidden" name="auxCiudad" id="auxCiudad" value="">
						<input type="hidden" name="auxMunicipio" id="auxMunicipio" value="">
						<input type="hidden" name="auxParroquia" id="auxParroquia" value="">	
						<input type="hidden" name="temporal" id="temporal" value="">	
						<input type="hidden" name="f_refFeligres" id="f_refFeligres" value="">	
						<input type="hidden" name="f_refSacerdo" id="f_refSacerdo" value="">
						<input type="button" class="btn btn-default" name="b_Nuevo" value="Nuevo" onclick="fpNuevo()">
						<input type="button" class="btn btn-default" name="b_Modificar" value="Modificar" onclick="fpModificar()">
						<input type="button" class="btn btn-default" name="b_Buscar" value="Buscar" onclick="fpBuscarLike()">
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
	var loF=document.fr_Persona;
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

						fpCambioE();
						fpApagar();

					}
					else
					{
						NotificaE("No Existe");
						fpCancelar();
					}
					break;
				case "incluir":
					if ((loF.txtHacer.value=="buscar")&&(loF.txtHay.value==1))
					{
						NotificaS("Ese Registro Existe");
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
						loF.f_nombres.focus();
					}
					if((loF.txtHacer.value=="incluir")&&(loF.txtHay.value==1))
					{
						NotificaS("Registro Incluido");
						
						fpCancelar();
					}
					if((loF.txtHacer.value=="incluir")&&(loF.txtHay.value==2))
					{
						NotificaE("Registro No Incluido");
						
						fpCancelar();
					}
					break;
				case "modificar":
					if(loF.txtHay.value==1)
					{
						NotificaS("Registro Modificado");
						
						fpCancelar();
					}
					else
					{
						NotificaE("Registro No Modificado");
						
						fpCancelar();
					}
					break;
				case "eliminar":
					if(loF.txtHay.value==1)
					{
						NotificaS("Registro Eliminado");
						
						fpCancelar();
					}
					else
					{
						NotificaE("Registro No Eliminado");
						
						fpCancelar();
					}
					break;
			}
		}
		
		function fpNuevo()
		{
			fpCambioN();
			fpEncender();
			loF.txtOperacion.value="incluir";
			loF.txtHacer.value="buscar";
			loF.f_cedula.focus();
		}
		
		function fpEncender()
		{
			loF.f_cedula.disabled=false;
			loF.f_nombres.disabled=false;
			loF.f_apellidos.disabled=false;
			loF.f_fechaNac.disabled=false;
			loF.f_fechaInicioDiocesis.disabled=false;
			loF.f_fechaFinDiocesis.disabled=false;
			loF.f_direccion.disabled=false;
			loF.f_Observacion.disabled=false;
			loF.cmb_Estado.disabled=false;
			loF.cmb_Ciudad.disabled=false;
			loF.cmb_Municipio.disabled=false;
			loF.cmb_Parroquia.disabled=false;
			loF.f_telefono.disabled=false;



		}
		
		function fpApagar()
		{
			loF.f_cedula.disabled=true;
			loF.f_nombres.disabled=true;
			loF.f_apellidos.disabled=true;
			loF.f_fechaNac.disabled=true;
			loF.f_fechaInicioDiocesis.disabled=true;
			loF.f_fechaFinDiocesis.disabled=true;
			loF.f_direccion.disabled=true;
			loF.f_Observacion.disabled=true;
			loF.cmb_Estado.disabled=true;
			loF.cmb_Ciudad.disabled=true;
			loF.cmb_Municipio.disabled=true;
			loF.cmb_Parroquia.disabled=true;
			loF.f_telefono.disabled=true;
			fpEstadoActual();
			fpCombosDireccion("apagar","");
		}
		
		function fpCancelar()
		{
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.f_cedula.value="";
			loF.f_nombres.value="";
			loF.f_apellidos.value="";
			loF.f_fechaNac.value="";
			loF.f_fechaInicioDiocesis.value="";
			loF.f_fechaFinDiocesis.value="";
			loF.f_direccion.value="";
			loF.f_Observacion.value="";
			loF.f_telefono.value="";
			loF.cmb_Estado.value="0";
			loF.cmb_Ciudad.value="0";
			loF.cmb_Municipio.value="0";
			loF.cmb_Parroquia.value="0";

			document.getElementById("haf_cedula").className = "form-group has-default";
			document.getElementById("haf_nombres").className = "form-group has-default";
			document.getElementById("haf_apellidos").className = "form-group has-default";
			document.getElementById("haf_fechaNac").className = "form-group has-default";
			document.getElementById("haf_fechaInicioDiocesis").className = "form-group has-default";
			document.getElementById("haf_fechaFinDiocesis").className = "form-group has-default";
			document.getElementById("haf_telefono").className = "form-group has-default";
			document.getElementById("haf_direccion").className = "form-group has-default";
			document.getElementById("haf_Observacion").className = "form-group has-default";
			document.getElementById("hacmb_Estado").className = "form-group has-default";
			document.getElementById("hacmb_Ciudad").className = "form-group has-default";
			document.getElementById("hacmb_Municipio").className = "form-group has-default";
			document.getElementById("hacmb_Parroquia").className = "form-group has-default";


			fpApagar();
			fpInicial();
			loF.KestadoActual.value=1;
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
			loF.f_refSacerdo.value=lke.nvaidSacerdo.value;
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
			fpCambioB();
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
			if((loF.f_cedula.value!="")&&(loF.txtHacer.value=="buscar"))
			{
				
						
				var $forme = $("#fr_Persona");

					$.ajax({
						url: \'../cntller/cn_obispo.php\',
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
										document.getElementById("haf_cedula").className = "form-group has-warning";
										loF.f_nombres.value = persona.lsNombre;
										loF.f_apellidos.value = persona.lsApellido;
										loF.f_fechaNac.value = persona.lsFechaNaci;
										loF.f_fechaInicioDiocesis.value = persona.lsFechaInicioDiocesis;
										loF.f_fechaFinDiocesis.value = persona.lsFechaFinDiocesis;
										loF.f_telefono.value = persona.lsTelefono;
										loF.f_direccion.value = persona.lsDireccion;
										loF.f_Observacion.value = persona.lsObservacion;
										loF.KestadoActual.value = persona.lsEstatus;
										Rcampo.disabled=true;
										fpCambioE();
										fpApagar();

										if (loF.txtOperacion.value=="incluir")
										{
											NotificaE("Esta cedula ya se encuentra registrada");
											fpCambioE();
											fpApagar();
										}
										$("#cmb_Ciudad").showOption(persona.lsCiudad);
										$("#cmb_Municipio").showOption(persona.lsMunicipio);
										$("#cmb_Parroquia").showOption(persona.lsParroquia);
										loF.cmb_Estado.value = persona.lsEstado;
										loF.cmb_Ciudad.value = persona.lsCiudad;
										loF.cmb_Municipio.value = persona.lsMunicipio;
										loF.cmb_Parroquia.value = persona.lsParroquia;
									}
													

									if((loF.txtOperacion.value=="buscar")&&(loF.txtHacer.value=="buscar")&&(persona.liHay==0))
									{
										loF.f_cedula.value="";
										loF.f_cedula.focus();
										NotificaE("No se encontro ningun Sacerdote con la cedula ingresada");

									}

									if ((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(persona.liHay==1))
									{
										loF.txtOperacion.value="incluir";
										loF.txtHacer.value="incluir";
										loF.txtHay.value="0";
									}

									if ((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(persona.liHay==3))
									{
										loF.f_cedula.value="";
										loF.f_cedula.focus();
										NotificaE("No es posible registrar a una mujer como Sacerdote");

									}

									if ((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(persona.liHay==4))
									{
										
										document.getElementById("haf_cedula").className = "form-group has-success";
										Rcampo.disabled=true;
										loF.txtOperacion.value="incluir";
										loF.txtHacer.value="incluir";
										loF.txtHay.value="0";
										loF.f_nombres.value = persona.lsNombre;
										loF.f_apellidos.value = persona.lsApellido;
										loF.f_fechaNac.value = persona.lsFechaNaci;
										loF.f_fechaInicioDiocesis.value = persona.lsFechaInicioParroquia;
										loF.f_fechaFinDiocesis.value = persona.lsFechaFinParroquia;
										loF.f_telefono.value = persona.lsTelefono;
										loF.f_direccion.value = persona.lsDireccion;
										loF.f_Observacion.value = persona.lsObservacion;
										loF.KestadoActual.value = persona.lsEstatus;
									}



									if ((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(persona.liHay==0))
									{
										document.getElementById("haf_cedula").className = "form-group has-success";
										Rcampo.disabled=true;
										loF.txtOperacion.value="incluir";
										loF.txtHacer.value="incluir";
										loF.txtHay.value="0";
										loF.f_nombres.focus();
									}


								
							}
						}
					});
		
			}
		
		}

		function fpPredeterminado()
		{
			var Cedu="'.$CeduImportada.'";
			if (Cedu!="")
			{
				fpEncender();
				document.getElementById("haf_cedula").className = "form-group has-success";
				loF.f_cedula.disabled=true;
				loF.txtOperacion.value="incluir";
				loF.txtHacer.value="incluir";
				loF.txtHay.value=0;
				loF.f_cedula.value=Cedu;
				loF.f_nombres.focus();
				fpCambioN();

			}
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
						url: \'../cntller/cn_obispo.php\',
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
								else
								{
									document.getElementById("ha"+PCampos.id).className = "form-group has-warning";
									NotificaE("Esta cedula no esta registrada, puede registrarla posteriormente a este registro.")
									/*
									if (confirm("Desea registrar padre ahora?"))
									{

									}
									else
									{
										
									}*/

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
				var $forme = $("#fr_Persona");
				var Cedu="'.$CeduImportada.'";
				var pagAnterior="'.$_SESSION["UrlAnterior"].'";
					$.ajax(
					{
						url: \'../cntller/cn_obispo.php\',
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

								}
										
								if ((loF.txtHacer.value=="incluir")&&(Cedu!="")&&(persona.liHay==1))
								{

									NotificaS("Registro incluido con exito.");
									
									window.location=pagAnterior;

								}
								
								if ((loF.txtHacer.value=="modificar")&&(persona.liHay==0))
								{

									NotificaE("El Registro no se pudo modificar.");

								}

								if ((loF.txtHacer.value=="modificar")&&(persona.liHay==1))
								{

									NotificaS("Registro modificado con exito.");

									fpCancelar();

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
			}
			if(vCampoVacio("f_fechaInicioDiocesis"))
			{
				invalido=1;
			}
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
			if(vCampoVacio("f_Observacion"))
			{
				invalido=1;
			}
			if(vCampoVacio("f_telefono"))
			{
				invalido=1;
			}
			/*
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
			*/
			if (invalido==0)
			{
				lbValido=true;
			}
			return lbValido;
		}
		
		function fpModificar()
		{
			fpEncender();
			fpCambioN();
			loF.txtOperacion.value="modificar";
			loF.txtHacer.value="modificar";
			loF.f_cedula.disabled=true;
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
				if(confirm("Desea Reactivar el Sacerdote?"))
				{
					loF.f_cedula.disabled=false;
					loF.txtOperacion.value="reactivar";
					loF.txtHacer.value="reactivar";
					var $forme = $("#fr_Persona");

					$.ajax({
						url: \'../cntller/cn_obispo.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var persona=data[\'Person\'];
							if(persona.liHay==1)
							{
									fpCancelar();
									NotificaS("Registro del Obispo ha sido Reactivado");
									loF.KestadoActual.value=1;
									fpInicial();
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Reactivar el Sacerdote");
									loF.KestadoActual.value=1;
									fpInicial();									
							}
						}
					});


				}
			}
			else
			{
				if(confirm("Desea Desactivar el Sacerdote?"))
				{
					loF.f_cedula.disabled=false;
					loF.txtOperacion.value="desactivar";
					loF.txtHacer.value="desactivar";

					var $forme = $("#fr_Persona");

					$.ajax({
						url: \'../cntller/cn_obispo.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var persona=data[\'Person\'];
							if(persona.liHay==1)
							{
									fpCancelar();
									NotificaS("Registro del Obispo ha sido Desactivado");
									loF.KestadoActual.value=1;
									fpInicial();							
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Desactivar el Sacerdote.");
									loF.KestadoActual.value=1;
									fpInicial();									
							}
						}
					});

				}
			}
		}

		function buscar_like(e){
			var parametros = "?AccionGet=buscar_like&txtcadena="+e.value;
			var url = "../cntller/cn_obispo.php";
			consulta_ajax(url,parametros);
			document.getElementById("cargar").innerHTML = document.getElementById("temporal").value;
		}

</script>
</html>
'); 

?>
