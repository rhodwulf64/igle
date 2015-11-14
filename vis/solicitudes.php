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
		<title>'.$_SESSION['title'].' - Registro de Grupo Apostolado</title>

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
		<form name="fr_solicitudes" id="fr_solicitudes" action="../cntller/cn_solicitudFeligres.php" method="post">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered table-hover"  border="1" >
						<thead>		
							<tr>
								<th colspan="3"><center>Solicitud de Citas</center></th>
							</tr>
						</thead>
						<tr>
							<th colspan="2">
								<center>
									<div class="form-group has-default" id="haf_listarTipoSolicitud" style="width:400px;"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Tipo de Solicitud:</font><br><select name="f_listarTipoSolicitud" class="form-control" size="1" tabindex="1" onblur="vCampoVacio(this.id);" id="f_listarTipoSolicitud" value=""><option value="0">*Seleccione un tipo de Solicitud</opction>');

									echo utf8_decode($loFuncion->fncreateComboSelect("tipo_solicitud", "","idTipoSolicitud","", ' ',"","descripcion", $selectTipoSolicitud,"", "", "")); 
									echo utf8_Decode('
									</select><div class="tool-tip  slideIn" id="ttipf_listarTipoSolicitud" style="display:none;"></div></div></div>
								</center>
							</th>
						</tr>
						<tr>
							<th>
								<font class="control-label">Requisitos:</font>
								<textarea name="f_Requisitos" id="f_Requisitos" class="form-control" maxlength="100" tabindex="2" style="height:200px;" disabled></textarea>
							</th>
							<th><font class="control-label">Citas Pendientes a la fecha:</font><br><select name="f_listarCitasPendientes" class="form-control" size="11" tabindex="1" onchange="SeleccionaItem(this.value);" id="f_listarCitasPendientes" value="" disabled>');

									//echo utf8_decode($loFuncion->fncreateComboSelect("tipo_solicitud", "","idTipoSolicitud","", ' ',"","descripcion", $selectTipoSolicitud,"", "", "")); 
									echo utf8_Decode('
									</select>
							</th>
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
						<input type="hidden" name="KopcionCita" id="KopcionCita" value="">
						<input type="hidden" name="txtIdApostolado" id="txtIdApostolado" value="">		
						<input type="hidden" name="temporal" id="temporal" value="">		
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
	var loF=document.fr_solicitudes;
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
			loF.f_mision.disabled=false;
			loF.f_nombre.disabled=false;
			loF.f_vision.disabled=false;
		}
		
		function fpApagar()
		{
			loF.f_mision.disabled=true;
			loF.f_nombre.disabled=true;
			loF.f_vision.disabled=true;
			fpEstadoActual();
		}
		
		function fpCancelar()
		{
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.f_mision.value="";
			loF.f_nombre.value="";
			loF.f_vision.value="";

			document.getElementById("haf_mision").className = "form-group has-default";
			document.getElementById("haf_nombre").className = "form-group has-default";
			document.getElementById("haf_vision").className = "form-group has-default";

			fpApagar();
			fpInicial();
			loF.KestadoActual.value=1;
		}
		function buscar_like(e){
			var parametros = "?AccionGet=buscar_like&txtcadena="+e.value;
			var url = "../cntller/cn_solicitudFeligres.php";
			consulta_ajax(url,parametros);
			document.getElementById("cargar").innerHTML = document.getElementById("temporal").value;
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
			loF.f_nombre.value=lke.nvaNombre.value;
			loF.txtIdApostolado.value=lke.nvaidApostolado.value;
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.txtHay.value="0";
			fpPerderFocus();

		}

		function salir()
		{
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");
			

			mas.style.display = "none";
			bus.style.display = "none";
			

			fpCancelar();			
		}

		function SeleccionaItem()
		{
			var valueIndex=loF.f_listarCitasPendientes.selectedIndex;
			loF.KopcionCita.value=loF.f_listarCitasPendientes.options[valueIndex].text;
			loF.txtOperacion.value="busEstatus";
			var $forme = $("#fr_solicitudes");

			$.ajax({
				url: \'../cntller/cn_solicitudFeligres.php\',
				dataType: \'json\',
				type: \'post\',
				data: $forme.serialize(),
		        success: function(data){
		        	var Cita=data[\'Cita\'];
					if(Cita.liHay==1)
					{
							loF.KestadoActual.value=Confi.lsEstatus;	
							fpEstadoActual();	
					}
					else	
					{
							NotificaE("Error en el Estatus del elemento.");
															
					}
					
				}
			});

		}

		function fpBuscar()
		{
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.f_nombre.disabled=false;
			fpCambioB();
			loF.f_nombre.focus();
		}

		function fpPerderFocus()
		{
			if(loF.txtHacer.value=="buscar")
			{
				
						
				var $forme = $("#fr_solicitudes");

					$.ajax({
						url: \'../cntller/cn_solicitudFeligres.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var arrayDato=data[\'ArrDatos\'];
								
									if((loF.txtHacer.value=="buscar")&&(arrayDato.liHay==1))
									{
										loF.f_nombre.value=arrayDato.lsNombre;
										loF.f_mision.value=arrayDato.lsMision;
										loF.f_vision.value=arrayDato.lsVision;
										loF.KestadoActual.value=arrayDato.lsEstatus;
										loF.txtIdApostolado.value=arrayDato.lsidApostolado;
										loF.f_nombre.disabled=true;
										fpCambioE();
										fpApagar();

										if (loF.txtOperacion.value=="incluir")
										{
											document.getElementById("haf_mision").className = "form-group has-warning";
											NotificaE("Esta cedula ya se encuentra registrada");
											fpCambioE();
											fpApagar();
										}
									}
													

									if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(arrayDato.liHay==0))
									{
										document.getElementById("haf_nombre").className = "form-group has-success";
										loF.f_nombre.disabled=true;
										loF.f_mision.focus();
										loF.txtOperacion.value="incluir";
										loF.txtHacer.value="incluir";
										loF.txtHay.value=0;

									}

									if ((loF.txtOperacion.value=="buscar")&&(loF.txtHacer.value=="buscar")&&(arrayDato.liHay==0))
									{
										loF.txtOperacion.value="buscar";
										loF.txtHacer.value="buscar";
										loF.txtHay.value="0";
										loF.f_nombre.value="";
										loF.f_nombre.focus();
										NotificaE("No se encontro Apostolado");
									}

						
						}
					});
		
			}
		
		}
		
		
	function fpGuardar()
		{
			if(fbValidar())
			{
				loF.f_nombre.disabled=false;
				var $forme = $("#fr_solicitudes");
				var pagAnterior="'.$_SESSION["UrlAnterior"].'";
					$.ajax(
					{
						url: \'../cntller/cn_solicitudFeligres.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        		var arrayDato=data[\'ArrDatos\'];

								if ((loF.txtHacer.value=="buscar")&&(arrayDato.liHay==1))
								{

									NotificaE("El Nombre de ingresado ya se encuentra registrado.");
								}

								if ((loF.txtHacer.value=="incluir")&&(arrayDato.liHay==0))
								{

									NotificaE("El Registro no se pudo incluir.");

								}

								if ((loF.txtHacer.value=="incluir")&&(arrayDato.liHay==1))
								{

									NotificaS("Registro incluido con exito.");
									fpCancelar();

								}
								
						
								if ((loF.txtHacer.value=="modificar")&&(arrayDato.liHay==0))
								{

									NotificaE("El Registro no se pudo modificar.");

								}

								if ((loF.txtHacer.value=="modificar")&&(arrayDato.liHay==1))
								{

									NotificaS("Registro modificado con exito.");
									loF.txtOperacion.value="buscar";
									loF.txtHacer.value="buscar";
									loF.txtHay.value="0";
									fpPerderFocus();


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
			if(vCampoVacio("f_mision"))
			{
				invalido=1;
			}			
			if(vCampoVacio("f_vision"))
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
				if(confirm("Desea Reactivar Apostolado?"))
				{
					loF.f_mision.disabled=false;
					loF.txtOperacion.value="reactivar";
					loF.txtHacer.value="reactivar";
					var $forme = $("#fr_solicitudes");

					$.ajax({
						url: \'../cntller/cn_solicitudFeligres.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var arrayDato=data[\'ArrDatos\'];
							if(arrayDato.liHay==1)
							{
									fpCancelar();
									NotificaS("Registro de Apostolado ha sido Reactivado");
									loF.KestadoActual.value=1;
									fpInicial();
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Reactivar Apostolado");
									loF.KestadoActual.value=1;
									fpInicial();									
							}
						}
					});


				}
			}
			else
			{
				if(confirm("Desea Desactivar Apostolado?"))
				{
					loF.f_mision.disabled=false;
					loF.txtOperacion.value="desactivar";
					loF.txtHacer.value="desactivar";

					var $forme = $("#fr_solicitudes");

					$.ajax({
						url: \'../cntller/cn_solicitudFeligres.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var arrayDato=data[\'ArrDatos\'];
							if(arrayDato.liHay==1)
							{
									fpCancelar();
									NotificaS("Registro de Apostolado ha sido Desactivado");
									loF.KestadoActual.value=1;
									fpInicial();							
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Desactivar Apostolado.");
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
