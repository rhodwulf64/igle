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
	echo utf8_Decode('
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Registro de Actividad</title>

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
		<form name="fr_Actividad" id="fr_Actividad" action="../cntller/cn_personas.php" method="post">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered table-hover"  border="1" >
						<thead>		
							<tr>
								<th colspan="3"><center>Registro de Actividad</center></th>
							</tr>
						</thead>
						<tr>
							<th><div class="form-group has-default" id="haf_nombre"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Nombre:</font><input type="text" name="f_nombre" id="f_nombre" class="form-control" value="" onkeypress="vSoloLetras();" tabindex="1" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_nombre" style="display:none;"></div></div></div></th>
							<th>
							<div class="form-group has-default" id="hacmb_tipoActividad"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><label class="control-label">Parroquia:</label><select id="cmb_tipoActividad" name="cmb_tipoActividad" class="form-control" tabindex="10" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Ciudad\',this.id)"><option value="0">*Seleccione Parroquia</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("tparroquiaiglesia", "","codigoParroquiaIglesia","", ' ',"","nombre", $selectarchiprestazgo,"", "codigo_archi", "")); 
							echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_tipoActividad" style="display:none;"></div></div></div>
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
	var loF=document.fr_Actividad;
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
			loF.cmb_tipoActividad.disabled=false;
		}
		
		function fpApagar()
		{
			loF.f_nombre.disabled=true;	
			loF.cmb_tipoActividad.disabled=true;
			fpEstadoActual();
		}
		
		function fpCancelar()
		{
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.f_nombre.value="";
			loF.cmb_tipoActividad.value="0";



			document.getElementById("haf_nombre").className = "form-group has-default";
			document.getElementById("hacmb_tipoActividad").className = "form-group has-default";

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

	
		
		function fpPerderFocus(Rcampo)
		{
			if(loF.txtHacer.value=="buscar")
			{
				
						
				var $forme = $("#fr_Actividad");

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
										loF.cmb_tipoActividad.value = persona.lsTipoActividad;
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

		function fpGuardar()
		{
			if(fbValidar())
			{
		

				var $forme = $("#fr_Actividad");
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
			if(vCampoVacioDireccion("cmb_tipoActividad"))
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
					var $forme = $("#fr_Actividad");

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
									NotificaS("Registro de Actividad ha sido Reactivado");
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

					var $forme = $("#fr_Actividad");

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
									NotificaS("Registro de Actividad ha sido Desactivado");
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
