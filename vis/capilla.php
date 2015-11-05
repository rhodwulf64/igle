<?php

    session_start();
    if(!array_key_exists("usuario", $_SESSION)) 
	{
		header("location: visSalir.php");
	}
	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");
		$loFuncion =new clsFunciones;


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
		<title>'.$_SESSION['title'].' - Inscripción de Parroquia</title>

	');
			print(encabezado_menu("../"));

echo utf8_Decode('
		</head>

	<body onload='.$FunIncio.'>
<div class="mygrid-wrapper-div">
<div class="container pre-scrollable" style="margin-top:5px; min-height: 530px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">

	');

	encab("../"); //logo de la iglesia
	menu_general(""); //menu principal


	echo utf8_Decode('
		<form name="fr_Parroquia" id="fr_Parroquia" action="../cntller/cn_personas.php" method="post">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered table-hover"  border="1" >
						<thead>		
							<tr>
								<th colspan="3"><center>Registro de Capilla</center></th>
							</tr>
						</thead>
						<tr>
							<th><div class="form-group has-default" id="haf_nombre"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Nombre:</font><input type="text" name="f_nombre" id="f_nombre" class="form-control" value="" onkeypress="vSoloLetras();" tabindex="1" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_nombre" style="display:none;"></div></div></div></th>
							<th><div class="form-group has-default" id="haf_telefono"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Teléfono:</font><input type="text" name="f_telefono" id="f_telefono" size="8" maxlenght="12" class="form-control" value="" placeholder="(999)9999999" onfocus="MaskTelefono(this.id)" onkeypress="vSoloTelefono();" tabindex="2" onblur="vCampoVacio(this.id);" size="8" maxlenght="12"><div class="tool-tip  slideIn" id="ttipf_telefono" style="display:none;"></div></div></div></th>

						</tr>
						<tr>
							<th><div class="form-group has-default" id="haf_direccion"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Dirección:</font><textarea name="f_direccion" id="f_direccion" class="form-control" style="resize:none; overflow-y:scroll; height:100px;" maxlenght="150" tabindex="3" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"></div></div></div>
                                <div class="form-group has-default" id="hatxtCorreo1">
                                            <div class="on-focus clearfix" style="position: relative;">
                                                    <span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><label class="control-label">Correo Electronico Principal</label>
                                                    <input type="text" id="txtCorreo1" name="txtCorreo1" class="form-control" placeholder="cliente@micorreo.com" onkeypress="vSoloCorreo();" tabindex="4" onblur="vCampoVacioUnder(this.id);vSoloEmail(this.id);" value="">
                                                    <div class="tool-tip  slideIn" id="ttiptxtCorreo1" style="display:none;"></div>
                                            </div>
                                </div>							
							</th>
							<th>
								<div class="form-group has-default" id="hacmb_Estado"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Estado" name="cmb_Estado" class="form-control" tabindex="5" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Estado\',this.id)"><option value="0">*Seleccione Estado</option>
								');
								echo utf8_decode($loFuncion->fncreateComboSelect("estado", "","cod_estado","", ' ',"","descripcion", $selectestado,"", "", "")); 
								echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Estado" style="display:none;"></div></div></div>
								<div class="form-group has-default" id="hacmb_Municipio"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Municipio" name="cmb_Municipio" class="form-control" tabindex="6" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Municipio\',this.id)"><option value="0">*Seleccione Municipio</option>
								');
								echo utf8_decode($loFuncion->fncreateComboSelect("municipio", "","cod_municipio","", ' ',"","descripcion", $selectmunicipio,"", "cod_foraneo", "")); 
								echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Municipio" style="display:none;"></div></div></div>
								<div class="form-group has-default" id="hacmb_Parroquia"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Parroquia" name="cmb_Parroquia" class="form-control" tabindex="7" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Parroquia\',this.id)"><option value="0">*Seleccione Parroquia</option>
								');
								echo utf8_decode($loFuncion->fncreateComboSelect("parroquia", "","cod_parroquia","", ' ',"","descripcion", $selectparroquia,"", "cod_foraneo", "")); 
								echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Parroquia" style="display:none;"></div></div></div>
								<div class="form-group has-default" id="hacmb_Ciudad"><div class="on-focus clearfix" style="position: relative;"><select id="cmb_Ciudad" name="cmb_Ciudad" class="form-control" tabindex="8" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Ciudad\',this.id)"><option value="0">*Seleccione Ciudad</option>
								');
								echo utf8_decode($loFuncion->fncreateComboSelect("ciudad", "","cod_ciudad","", ' ',"","descripcion", $selectciudad,"", "cod_foraneo", "")); 
								echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Ciudad" style="display:none;"></div></div></div>
							</th>
						</tr>
						<tr>
							<th><div class="form-group has-default" id="haf_fechaCreacion"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha de Creación:</font><input type="date" name="f_fechaCreacion" id="f_fechaCreacion" class="form-control" tabindex="9" onblur="vSoloFechaAnterior(this.id);vMayorDeEdad(this.id);" value=""><div class="tool-tip  slideIn" id="ttipf_fechaCreacion" style="display:none;"></div></div></div></th>
							<th>
							<div class="form-group has-default" id="hacmb_ParroquiaIgle"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><label class="control-label">Parroquia:</label><select id="cmb_ParroquiaIgle" name="cmb_ParroquiaIgle" class="form-control" tabindex="10" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Ciudad\',this.id)"><option value="0">*Seleccione Parroquia</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("tparroquiaiglesia", "","codigoParroquiaIglesia","", ' ',"","nombre", $selectarchiprestazgo,"", "codigo_archi", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_ParroquiaIgle" style="display:none;"></div></div></div>
							</th>
							');
							
						echo utf8_decode('
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
						<input type="hidden" name="txtCodigoCapilla" id="txtCodigoCapilla" value="">
						<input type="hidden" name="auxCiudad" id="auxCiudad" value="">
						<input type="hidden" name="auxMunicipio" id="auxMunicipio" value="">
						<input type="hidden" name="auxParroquia" id="auxParroquia" value="">		
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
	var loF=document.fr_Parroquia;
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
						loF.f_nombre.focus();
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
			loF.f_nombre.focus();
		}
		
		function fpEncender()
		{
			loF.f_nombre.disabled=false;
			loF.txtCorreo1.disabled=false;
			loF.f_fechaCreacion.disabled=false;
			loF.f_direccion.disabled=false;
			loF.cmb_Estado.disabled=false;
			loF.cmb_Ciudad.disabled=false;
			loF.cmb_ParroquiaIgle.disabled=false;
			loF.cmb_Municipio.disabled=false;
			loF.cmb_Parroquia.disabled=false;
			loF.f_telefono.disabled=false;
	


		}
		
		function fpApagar()
		{
			loF.f_nombre.disabled=true;
			loF.txtCorreo1.disabled=true;
			loF.f_fechaCreacion.disabled=true;
			loF.f_direccion.disabled=true;
			loF.cmb_Estado.disabled=true;
			loF.cmb_Ciudad.disabled=true;
			loF.cmb_ParroquiaIgle.disabled=true;
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
			loF.f_nombre.value="";
			loF.txtCorreo1.value="";
			loF.f_fechaCreacion.value="";
			loF.f_direccion.value="";
			loF.f_telefono.value="";

			loF.cmb_Estado.value="0";
			loF.cmb_Ciudad.value="0";
			loF.cmb_ParroquiaIgle.value="0";
			loF.cmb_Municipio.value="0";
			loF.cmb_Parroquia.value="0";



			document.getElementById("haf_nombre").className = "form-group has-default";
			document.getElementById("hatxtCorreo1").className = "form-group has-default";
			document.getElementById("haf_fechaCreacion").className = "form-group has-default";
			document.getElementById("haf_telefono").className = "form-group has-default";
			document.getElementById("haf_direccion").className = "form-group has-default";
			document.getElementById("hacmb_Estado").className = "form-group has-default";
			document.getElementById("hacmb_Ciudad").className = "form-group has-default";
			document.getElementById("hacmb_ParroquiaIgle").className = "form-group has-default";
			document.getElementById("hacmb_Municipio").className = "form-group has-default";
			document.getElementById("hacmb_Parroquia").className = "form-group has-default";


			fpApagar();
			fpInicial();
			loF.KestadoActual.value=1;
		}
		
		function fpBuscar()
		{
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			fpCambioB();
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
			if(loF.txtHacer.value=="buscar")
			{
				
						
				var $forme = $("#fr_Parroquia");

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
										loF.f_nombre.value = persona.lsNombre;
										loF.txtCorreo1.value = persona.lsApellido;
										loF.f_fechaCreacion.value = persona.lsFechaNaci;
										loF.f_telefono.value = persona.lsTelefono;
										loF.f_direccion.value = persona.lsDireccion;
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
										loF.cmb_ParroquiaIgle.value = persona.lsArchiprestasgo;
										loF.cmb_Municipio.value = persona.lsMunicipio;
										loF.cmb_Parroquia.value = persona.lsParroquia;
									}
													

									if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(persona.liHay==0))
									{
										Rcampo.disabled=true;
										loF.f_nombre.focus();
										loF.txtOperacion.value="incluir";
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
		
		}

		function fpPredeterminado()
		{
			fpApagar();
			var Cedu="'.$CeduImportada.'";
			if (Cedu!="")
			{
				fpEncender();
				document.getElementById("hatxtCodigoCapilla").className = "form-group has-success";
				loF.txtCodigoCapilla.disabled=true;
				loF.txtOperacion.value="incluir";
				loF.txtHacer.value="incluir";
				loF.txtHay.value=0;
				loF.txtCodigoCapilla.value=Cedu;
				loF.f_nombre.focus();
				fpCambioN();

			}
		}
		function fpBusquedaForanea()
		{
			loF.txtCodigoCapilla.value="'.$CeduImportada.'";
			loF.txtCodigoCapilla.disabled=false;
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.txtHay.value=0;
			fpPerderFocus(document.getElementById("txtCodigoCapilla"));
		}

		function fpPadres(PCampos)
		{
				var OperacionOld=loF.txtOperacion.value;	//respalda operacion principal
				var HacerOld=loF.txtHacer.value;	//respalda hacer
				loF.txtOperacion.value="ExaminaPadre";	
				loF.txtHacer.value=PCampos.id;	
				var $forme = $("#fr_Parroquia");

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
		

				var $forme = $("#fr_Parroquia");
				var Cedu="'.$CeduImportada.'";
				var pagAnterior="'.$_SESSION["UrlAnterior"].'";
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

			if(vCampoVacio("f_nombre"))
			{
				invalido=1;
			}
			if(vCampoVacio("txtCorreo1"))
			{
				invalido=1;
			}
			if(vCampoVacio("f_fechaCreacion"))
			{
				invalido=1;
			}
			if(vMayorDeEdad("f_fechaCreacion")==false)
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
			if(vCampoVacioDireccion("cmb_ParroquiaIgle"))
			{
				invalido=1;
			}
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
			loF.f_nombre.focus();
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
				if(confirm("Desea Reactivar Parroquia?"))
				{
					loF.txtOperacion.value="reactivar";
					loF.txtHacer.value="reactivar";
					var $forme = $("#fr_Parroquia");

					$.ajax({
						url: \'../cntller/cn_personas.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var persona=data[\'Person\'];
							if(persona.liHay==1)
							{
									fpCancelar();
									NotificaS("Registro de Capilla ha sido Reactivado");
									loF.KestadoActual.value=1;
									fpInicial();
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Reactivar Parroquia");
									loF.KestadoActual.value=1;
									fpInicial();									
							}
						}
					});


				}
			}
			else
			{
				if(confirm("Desea Desactivar Parroquia?"))
				{
					loF.txtOperacion.value="desactivar";
					loF.txtHacer.value="desactivar";

					var $forme = $("#fr_Parroquia");

					$.ajax({
						url: \'../cntller/cn_personas.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var persona=data[\'Person\'];
							if(persona.liHay==1)
							{
									fpCancelar();
									NotificaS("Registro de Capilla ha sido Desactivado");
									loF.KestadoActual.value=1;
									fpInicial();							
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Desactivar Parroquia.");
									loF.KestadoActual.value=1;
									fpInicial();									
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
