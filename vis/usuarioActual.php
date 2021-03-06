<?php


  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	die;
	}
		if ($_SESSION["rol"]!="F")
		{
			$_SESSION["message"]="Usted no tiene los accesos necesarios para entrar a esta pagina.";
			header("location: ../index.php");
		}
		

			require_once("menu_principal.php");
			require_once("encabezado.php");
			require_once("../clases/clsFuncionesGlobales.php");
			$loFuncion = new clsFunciones;
			echo utf8_Decode('

		<!DOCTYPE html>
		<html lang="es">
		  <head>
				<title>'.$_SESSION['title'].' - Registro de Usuarios.</title>

			');
					print(encabezado_menu("../"));

			echo utf8_Decode('
				</head>
				<body onload="fpInicio()"><div class="mygrid-wrapper-div">
		<div class="container pre-scrollable" style="margin-top:5px; min-height: 530px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">');
				encab("../");
				menu_general("");
				
		echo utf8_Decode('
			<form name="fr_usuarios" id="fr_usuarios" action="../cntller/corUsuarioActual.php" method="post">
					<div class="col-lg-12">
						<table class="table table-striped table-bordered table-hover"  border="1" >
							<thead>	
								<tr>
									<th colspan="2"><center>Registro de Usuarios</center></th>
								</tr>
							</thead>
					<tr>
						<th><div class="form-group has-default" id="haf_cedula"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Cedula del Usuario:</font><input type="text" name="f_cedula" id="f_cedula" class="form-control" value="" size="6" maxlength="13" onfocus="MaskCedulaNac(this.id);" onkeypress="CedulaVenezolanaDefault(this.id);" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id); fpPerderFocus();" placeholder="V-99999999"><div class="tool-tip  slideIn" id="ttipf_cedula" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_nombres"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Nombres:</font><input type="text" name="f_nombres" id="f_nombres" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_nombres" style="display:none;"></div></div></div></th>
					</tr>		
					<tr>
						<th><div class="form-group has-default" id="haf_apellidos"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Apellidos:</font><input type="text" name="f_apellidos" id="f_apellidos" class="form-control" value="" onkeypress="vSoloLetras();" onblur="vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_apellidos" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_sexo"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Sexo:</font><select name="f_sexo" id="f_sexo" value="" class="form-control" onblur="vCampoVacio(this.id);"><option value=""><p><strong></strong></p></option><option value="F"><p><strong>Femenino</strong></p></option><option value="M"><p><strong>Masculino</strong></p></option></select><div class="tool-tip  slideIn" id="ttipf_sexo" style="display:none;"></div></div></div></th>
					</tr>
					<tr>
						<th><div class="form-group has-default" id="haf_fechaNac"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha de Nacimiento:</font><input type="date" name="f_fechaNac" id="f_fechaNac" class="form-control" onblur="vSoloFechaAnterior(this.id);vMayorDeEdad(this.id);" value=""><div class="tool-tip  slideIn" id="ttipf_fechaNac" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_direccion"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Dirección:</font><textarea name="f_direccion" id="f_direccion" class="form-control" style="resize:none; overflow-y:scroll" maxlenght="150" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"></div></div></div></th>
					</tr>
					<tr>
						<th><div class="form-group has-default" id="haf_telefono"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Teléfono:</font><input type="text" name="f_telefono" id="f_telefono" class="form-control" value="" placeholder="(999)9999999" onfocus="MaskTelefono(this.id)" onkeypress="vSoloTelefono();" onblur="vCampoVacio(this.id);" size="8" maxlenght="12"><div class="tool-tip  slideIn" id="ttipf_telefono" style="display:none;"></div></div></div></th>
						<th></th>
						</tr>
					<tr>
						<th><div class="form-group has-default" id="haf_clavePri"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Contraseña:</font><input type="password" name="f_clavePri" id="f_clavePri" class="form-control" value="" minlength="6" maxlength="8"><div class="tool-tip  slideIn" id="ttipf_clavePri" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_claveSeg"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Repita la Contraseña:</font><input type="password" name="f_claveSeg" id="f_claveSeg" class="form-control" value="" minlength="6" maxlength="8"><div class="tool-tip  slideIn" id="ttipf_claveSeg" style="display:none;"></div></div></div></th>
					</tr>
					<tr>
						<th><div class="form-group has-default" id="haf_AskUser"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Pregunta de Seguridad:</font><input type="text" name="f_AskUser" id="f_AskUser" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_AskUser" style="display:none;"></div></div></div></th>
						<th><div class="form-group has-default" id="haf_AnswerUser"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Respuesta de Seguridad:</font><input type="text" name="f_AnswerUser" id="f_AnswerUser" class="form-control" value=""><div class="tool-tip  slideIn" id="ttipf_AnswerUser" style="display:none;"></div></div></div></th>
					</tr>					
				</table>
		<br>
				</div>
			</div>
			<div class="container" style="margin-top:5px; padding:5px; min-height: auto; background: #FFFFFF; -webkit-box-shadow: 0px 2px 5px 2px #999; -moz-box-shadow: 2px 2px 5px #999;">
				<table class="table table-striped table-bordered table-hover" border="1" style="margin:0px">
					<tr>
						<th colspan="2"><center>
							<input type="hidden" name="txtOperacion" id="txtOperacion" value="">
							<input type="hidden" name="txtHacer" id="txtHacer" value="">
							<input type="hidden" name="txtHay" id="txtHay" value="">
							<input type="hidden" name="KestadoActual" id="KestadoActual" value="">
							<input type="hidden" name="txtIDTusuario" id="txtIDTusuario" value="">
							<input type="hidden" name="txtIDTpersona" id="txtIDTpersona" value="">
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
			var loF=document.fr_usuarios;
			function fpInicio()
			{	
					fpInicial2();
					fpCancelar();
					fpPerderFocus();

			}
				
	
				function fpEncender()
				{
					loF.f_cedula.disabled=false;
					loF.f_nombres.disabled=false;
					loF.f_apellidos.disabled=false;
					loF.f_sexo.disabled=false;
					loF.f_direccion.disabled=false;
					loF.f_telefono.disabled=false;
					loF.f_fechaNac.disabled=false;
					loF.f_clavePri.disabled=false;
					loF.f_claveSeg.disabled=false;
					loF.f_AskUser.disabled=false;
					loF.f_AnswerUser.disabled=false;
				}
				function fpEncenderUsuario()
				{
					
					loF.f_cedula.disabled=true;
					loF.f_nombres.disabled=true;
					loF.f_apellidos.disabled=true;
					loF.f_sexo.disabled=true;
					loF.f_direccion.disabled=true;
					loF.f_telefono.disabled=true;
					loF.f_fechaNac.disabled=true;
					loF.f_clavePri.disabled=false;
					loF.f_claveSeg.disabled=false;
					loF.f_AskUser.disabled=false;
					loF.f_AnswerUser.disabled=false;
				}
				
				function fpCancelar()
				{
					loF.txtOperacion.value="modificar";
					loF.txtHacer.value="modificar";
					loF.txtHay.value=0;
					loF.f_cedula.value="";
					loF.f_nombres.value="";
					loF.f_apellidos.value="";
					loF.f_sexo.value="";
					loF.f_direccion.value="";
					loF.f_telefono.value="";
					loF.f_fechaNac.value="";
					loF.f_clavePri.value="";
					loF.f_claveSeg.value="";
					loF.f_AskUser.value="";
					loF.f_AnswerUser.value="";

					document.getElementById("haf_cedula").className = "form-group has-default";
					document.getElementById("haf_nombres").className = "form-group has-default";
					document.getElementById("haf_apellidos").className = "form-group has-default";
					document.getElementById("haf_sexo").className = "form-group has-default";
					document.getElementById("haf_fechaNac").className = "form-group has-default";
					document.getElementById("haf_telefono").className = "form-group has-default";
					document.getElementById("haf_direccion").className = "form-group has-default";
					document.getElementById("haf_clavePri").className = "form-group has-default";
					document.getElementById("haf_claveSeg").className = "form-group has-default";
					document.getElementById("haf_AskUser").className = "form-group has-default";
					document.getElementById("haf_AnswerUser").className = "form-group has-default";
					
					fpEncender();
					fpCambioN2();
				
				}
				
				function fpBuscar()
				{
					loF.txtOperacion.value="buscar";
					loF.txtHacer.value="buscar";
					loF.f_cedula.disabled=false;
					fpCambioB2();
					loF.f_cedula.focus();
				}
				
				function fpPerderFocus()
				{
					loF.txtOperacion.value="buscar";
					loF.txtHacer.value="buscar";
					loF.txtHay.value=0;			
								
						var $forme = $("#fr_usuarios");

							$.ajax({
								url: \'../cntller/corUsuarioActual.php\',
								dataType: \'json\',
								type: \'post\',
								data: $forme.serialize(),
						        success: function(data){
									if((data.lsNombre!=null)&&(data.lsUsuario!=null))
									{
										loF.txtIDTusuario.value = data.lsIDTusuario;
										loF.txtIDTpersona.value = data.lsIDTpersona;
										loF.f_nombres.value = data.lsNombre;
										loF.f_apellidos.value = data.lsApellido;
										loF.f_sexo.value = data.lsSexo;
										loF.f_direccion.value = data.lsDireccion;
										loF.f_telefono.value = data.lsTelefono;
										loF.f_fechaNac.value = data.lsFechaNaci;
										loF.f_AskUser.value = data.lsPreguntaSecreta;
										loF.f_AnswerUser.value = data.lsRespuestaSecreta;
										loF.KestadoActual.value = data.lsEstatus;
										fpCambioN2();
										loF.txtOperacion.value="modificar";
										loF.txtHacer.value="modificar";
										loF.txtHay.value=0;
										loF.f_cedula.disabled=true;
										loF.f_nombres.focus();
									}
									else if((data.lsCedula!=null)&&(data.lsRol==null)&&(loF.txtOperacion.value=="incluir")){
									
										loF.f_nombres.value = data.lsNombre;
										loF.f_apellidos.value = data.lsApellido;
										loF.f_sexo.value = data.lsSexo;
										loF.f_direccion.value = data.lsDireccion;
										loF.f_telefono.value = data.lsTelefono;
										loF.f_fechaNac.value = data.lsFechaNaci;
										loF.txtOperacion.value = "incluir";
										loF.txtHacer.value = "incluir";
										loF.txtHay.value = 1;
										loF.KestadoActual.value = data.lsEstatus;
										fpCambioN2();
										fpEncenderUsuario();
										loF.txtOperacion.value="modificar";
										loF.txtHacer.value="modificar";
										loF.txtHay.value=0;
										loF.f_cedula.disabled=true;
										loF.f_nombres.focus();
									}
									else
									{
										NotificaE("No se encontro ningun usuario con esa cedula");
										loF.txtHay.value=0;
										loF.f_cedula.focus();
									}
											
											if((loF.txtOperacion.value=="incluir")&&(data.liHay==0)){

											loF.txtOperacion.value="incluir";
											loF.txtHacer.value="incluir";
											loF.txtHay.value=0;

													fpCambioN2();
													fpEncender();
													loF.f_cedula.disabled=true;
													loF.f_nombres.focus();
											}
											else if((loF.txtOperacion.value=="buscar")&&(data.lsNombre==null))
											{

												if (confirm("La cedula Ingresada No esta asignada a ningun usuario, desea registrarlo ahora?"))
												{

												loF.txtOperacion.value="incluir";
												loF.txtHacer.value="incluir";
												loF.txtHay.value=0;

													fpCambioN2();
													fpEncender();
													loF.f_cedula.disabled=true;
													loF.f_nombres.focus();

												}else{
														fpCancelar();

												}
											}
								}
							});
					
				}
				
				function fpGuardar()
				{
					if(fbValidar())
					{
							loF.f_cedula.disabled=false;

							var $forme = $("#fr_usuarios");

							$.ajax({
								url: \'../cntller/corUsuarioActual.php\',
								dataType: \'json\',
								type: \'post\',
								data: $forme.serialize(),
						        success: function(data){
									if((data.lsHacer=="incluir")&&(data.liHay==1))
									{
											fpCancelar();
											NotificaS("Usuario Incluido");
											fpInicial2();
											loF.KestadoActual.value=1;
									}
									if((loF.txtHacer.value=="incluir")&&(data.liHay==2))
									{
											fpCancelar();
											NotificaE("Usuario No Incluido");
											
											loF.KestadoActual.value=1;
									}
									if((loF.txtHacer.value=="incluir")&&(data.liHay==0))
									{
											fpCancelar();
											NotificaE("Registro No Incluido");
											
											loF.KestadoActual.value=1;
									}
									
									if ((data.lsOperacion=="modificar")&&(data.liHay==1))
									{
												
											fpCancelar();
											NotificaS("Usuario Modificado");
											fpInicial2();
											loF.KestadoActual.value=1;
									}
									if ((data.lsOperacion=="modificar")&&(data.liHay==2))
									{
											fpCancelar();
											NotificaS("Datos de Identidad Modificados");
											fpInicial2();
											loF.KestadoActual.value=1;
									}
									if ((data.lsOperacion=="modificar")&&(data.liHay==0))
									{
											fpCancelar();
											NotificaE("No se modifico ningun Usuario");
											loF.KestadoActual.value=1;
									}

									
									

								}
							});
				
						
					}
				}
				
				function fbValidar()
				{
					var lbValido=false;
					
					var invalido=0;

					if(vCampoVacio("f_nombres"))
					{
						invalido=1;
					}
					if(vCampoVacio("f_apellidos"))
					{
						invalido=1;
					}
					if(vCampoVacio("f_sexo"))
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
					if(vCampoVacio("f_telefono"))
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
					if(vValidaPass("f_clavePri")==false)
					{
						invalido=1;
					}
					if(vValidaPass("f_claveSeg")==false)
					{
						invalido=1;
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
					

		</script>
		</html>
		'); 


?>
