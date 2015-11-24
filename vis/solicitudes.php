<?php

    session_start();
    if(!array_key_exists("usuario", $_SESSION)) 
	{
		header("location: visSalir.php");
	}
	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");
	require_once("../clases/claAgendaCitas.php");
	$loCitas=new claAgendaCitas();
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
	$loCitas->asidtPersona=$_SESSION["IDTpersona"];

	echo utf8_Decode('
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Registro de Solicitudes</title>

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
                <h4 class="modal-title" id="myModalLabel">Motivo de Anulación</h4>
            </div>
            <div class="modal-body pre-scrollable">
				<table>
					<tr>
						<td><input type="text" class="form-control" style="width:640px;" placeholder="Ingrese un motivo para anular la cita" name="txtCita" id="txtCita"/></td>
					</tr>
				</table>
				<br>
				<table id="cargar" class="table table-striped table-bordered table-hover" style="width:640px;"></table>
          	 </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="fpAnularCita();salir();">Continuar</button>
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
									<div class="form-group has-default" id="haf_listarTipoSolicitud" style="width:400px;"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Tipo de Solicitud:</font><br><select name="f_listarTipoSolicitud" class="form-control" size="1" tabindex="1" onblur="vCampoVacio(this.id);" onchange="fpSeleccionaSolicitud(this.value);" id="f_listarTipoSolicitud" value=""><option value="0">*Seleccione un tipo de Solicitud</opction>');

									echo utf8_decode($loFuncion->fncreateComboSelectSolicitudes("tipo_solicitud", "idTipoSolicitud","descripcion","requisitos", $selectTipoSolicitud)); 
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
							<th><font class="control-label">Citas Pendientes a la fecha:</font><br>
							');
								$arrCitas=$loCitas->fpListaCitasFeligresPendiente();	
								$i=0;
								foreach ($arrCitas as &$ACitas) 
								{
									$i++;
									echo utf8_decode('<div class="alert alert-success" id="citas'.$i.'"><div style="display: inline-block;" val="'.$ACitas['idTSolicitud'].'*'.$ACitas['descripcion'].'*'.$ACitas['requisitos'].'" onclick="fpSeleccionaSolicitudListaC($(this).attr(\'val\'));">'.$i.'-'.$ACitas['descripcion'].' ('.$loFuncion->fDameFechaEscrita($ACitas['FechaCita']).' - '.$loFuncion->fDameHoraEstandar($ACitas['HoraCita']).')</div> <input type="button" class="btn btn-danger" name="b_Anular" value="Anular" onclick="fpPreAnularCitaMotivo(\''.$ACitas['idTSolicitud'].'\',\''.$ACitas['descripcion'].'\','.$i.');"></div>');
								}
								echo utf8_Decode('
									
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
						<input type="hidden" name="txtIdCita" id="txtIdCita" value="">		
						<input type="hidden" name="txtDescriCita" id="txtDescriCita" value="">		
						<input type="hidden" name="txtNumeCita" id="txtNumeCita" value="">		
						<input type="hidden" name="txtMotivoCita" id="txtMotivoCita" value="">		
						<input type="hidden" name="txtDescripcionCita" id="txtDescripcionCita" value="">		
						<input type="hidden" name="temporal" id="temporal" value="">		
						<input type="button" class="btn btn-default" name="b_Guardar" value="Solicitar" onclick="fpGuardar()">
						<input type="button" class="btn btn-default" name="b_Cancelar" value="Cancelar" onclick="fpCancelar()"></center>
					</th>
				</tr>
			</table>
		</div>



		');


	footer(); // pie de pagina

	echo utf8_decode('</form>
</div>

</body>
	<script>
	var loF=document.fr_solicitudes;
		function fpInicio()
		{
			fpInicial2();
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.f_listarTipoSolicitud.value="0";
			fpCambioN2();
		}
		
		function fpNuevo()
		{
			fpCambioN2();
			fpEncender();
			loF.txtOperacion.value="incluir";
			loF.txtHacer.value="buscar";
			loF.f_nombre.focus();
		}
		
		function fpCancelar()
		{
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.f_listarTipoSolicitud.value="0";
			loF.f_Requisitos.innerHTML="";
			fpCambioN2();
			$( ".tool-tip.slideIn" ).each(function(i) {$(this).css( "display", "none" );});
			$( ".form-group.has-error" ).each(function(i) {$(this).attr( "class", "form-group has-default" );});
		}
		function buscar_like(e){
			var parametros = "?AccionGet=buscar_like&txtcadena="+e.value;
			var url = "../cntller/cn_solicitudFeligres.php";
			consulta_ajax(url,parametros);
			document.getElementById("cargar").innerHTML = document.getElementById("temporal").value;
		}

		function fpSeleccionar()
		{
			loF.txtOperacion.value="seleccionar";
			loF.txtHay.value=0;
			loF.f_listarCitasPendientes.disabled=false;


			fpCambioE2();
			
		}

		function fpSelectLike(idlke)
		{
			var lke = document.getElementById(idlke);
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");

			mas.style.display = "none";
			bus.style.display = "none";
			loF.f_nombre.value=lke.nvaNombre.value;
			loF.txtIdCita.value=lke.nvaidApostolado.value;
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


		function fpBuscar()
		{
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.f_nombre.disabled=false;
			fpCambioB2();
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
										loF.txtIdCita.value=arrayDato.lsidApostolado;
										loF.f_nombre.disabled=true;
										fpCambioE2();
										fpApagar();

										if (loF.txtOperacion.value=="incluir")
										{
											document.getElementById("haf_mision").className = "form-group has-warning";
											NotificaE("Esta cedula ya se encuentra registrada");
											fpCambioE2();
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
			if(loF.txtDescripcionCita.value!="")
			{
				if(confirm("Desea solicitar una cita para \""+loF.txtDescripcionCita.value+"\""))
				{
					if(fbValidar())
					{
						loF.txtOperacion.value="solicitaCita";
						loF.txtHacer.value="solicitaCita";
						loF.txtHay.value="0";
						var $forme = $("#fr_solicitudes");
							$.ajax(
							{
								url: \'../cntller/cn_solicitudFeligres.php\',
								dataType: \'json\',
								type: \'post\',
								data: $forme.serialize(),
						        success: function(data)
						        {

						        		var arrayDato=data[\'Solici\'];

										if ((loF.txtHacer.value=="buscar")&&(arrayDato.liHay==1))
										{
											NotificaE("El Nombre de ingresado ya se encuentra registrado.");
										}

										if ((loF.txtHacer.value=="solicitaCita")&&(arrayDato.liHay==0))
										{
											NotificaE("El Registro no se pudo incluir.");
										}

										if ((loF.txtHacer.value=="solicitaCita")&&(arrayDato.liHay==1))
										{
											NotificaS("Registro incluido con exito.");
											location.reload();
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
			}
		}
		
		function fbValidar()
		{
			var lbValido=false;
			var invalido=0;
			
			if(vCampoVacio("f_listarTipoSolicitud"))
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
			fpCambioN2();
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

		function fpPreAnularCitaMotivo(idCita,descripcion,nume)
		{

			loF.txtIdCita.value=idCita;
			loF.txtDescriCita.value=descripcion;
			loF.txtNumeCita.value=nume;
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");
			mas.style.display = "block";
			bus.style.display = "block";
		}
		
		function fpAnularCita()
		{
			loF.txtMotivoCita.value=document.getElementById(\'txtCita\').value;
			var idCita=loF.txtIdCita.value;
			var descripcion=loF.txtDescriCita.value;
			var nume=loF.txtNumeCita.value;
				if(confirm("Desea Desactivar la cita para \""+descripcion+"\""))
				{
					loF.txtOperacion.value="anularCita";
					loF.txtHacer.value="anularCita";
					var $forme = $("#fr_solicitudes");

					$.ajax({
						url: \'../cntller/cn_solicitudFeligres.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var arrayDato=data[\'Solici\'];
							if(arrayDato.liHay==1)
							{
									fpCancelar();
									NotificaS("La cita ha sido Anulada.");
									$( "#citas"+nume ).remove();
									
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Anular Cita");
																	
							}
						}
					});


				}
		}

		function fpSeleccionaSolicitud(valor)
		{
			var valores = valor.split("*");
			var xIDsolicitud=valores["0"];
			loF.KopcionCita.value=xIDsolicitud;
			loF.txtDescripcionCita.value=valores["1"];
			loF.f_Requisitos.innerHTML=valores["1"]+"\n"+valores["2"];
		}

		function fpSeleccionaSolicitudListaC(valor)
		{
			var valores = valor.split("*");
			var xIDsolicitud=valores["0"];
			loF.f_Requisitos.innerHTML=valores["1"]+"\n"+valores["2"];
		}

</script>
</html>
'); 

?>
