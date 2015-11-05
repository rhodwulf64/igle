<?php


	require_once("menu_principal.php");
	require_once("encabezado.php");

   	
    $lsOperacion=$_GET["lsOperacion"];
	$lsHacer=$_GET["lsHacer"];
	$liHay=$_GET["liHay"];
	
	$lsCedulaPerso=$_GET["lsCedula"];
	$lsAskUser=$_GET["lsPreguntaSeguridad"];
	$subTopic=$_GET["subTopic"];


	echo utf8_Decode('

<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Recuperación de Clave.</title>

	');
			print(encabezado_menu("../"));

	echo utf8_Decode('
		</head>
		<body onload="fpInicio()">');
		encab("../");
		menu_general("");
		
echo utf8_Decode('
	<center>
	<div class="mygrid-wrapper-div">
		<form name="fr_recuperaUsuario" action="../cntller/cValidaUser.php?Topic=RecuperaUsuario" method="post" autocomplete="off">
			<div class="container pre-scrollable" style="margin-top:5px; min-height: 400px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">
					<div class="col-lg-12">
						<table class="table table-striped table-bordered table-hover"  border="1" >
							<thead>		
								<tr>
									<th colspan="2" align="center"><center>Recuperar Usuario</center></th>
								</tr>
							</thead>
							<tr>
								<th><div class="form-group has-default" id="haf_cedula"><font class="control-label">Cedula del Usuario:</font></th>
								<th><div class="on-focus clearfix" style="position: relative;"><input type="text" name="f_cedula" id="f_cedula" onkeypress="vSoloNumeros()" class="form-control" placeholder="CEDULA (Solo Numero)" size="6" maxlength="8" value="'.$lsCedulaPerso.'" onblur="vCampoVacio(this.id);fpPerderFocus()"><div class="tool-tip  slideIn" id="ttipf_cedula" style="display:none;"></div></div></div></th>
							</tr>
							<tr>
								<th><font class="control-label">Pregunta de Seguridad:</font></th>
								<th><div class="alert alert-info">'.$lsAskUser.'</div></th>								
							</tr>		
							<tr>
								<th><div class="form-group has-default" id="haf_AnswerUser"><font class="control-label">Respuesta de Seguridad:</font></th>
								<th><div class="on-focus clearfix" style="position: relative;"><input type="text" name="f_AnswerUser" id="f_AnswerUser" class="form-control" value="" size="6" maxlength="30" ><div class="tool-tip  slideIn" id="ttipf_AnswerUser" style="display:none;"></div></div></div></th>
							</tr>
								<tr>
										<th colspan=>

										<input type="hidden" name="txtOperacion" id="txtOperacion" value="'.$lsOperacion.'">
										<input type="hidden" name="txtHacer" id="txtHacer" value="'.$lsHacer.'">
										<input type="hidden" name="txtHay" id="txtHay" value="'.$liHay.'">
										<input type="hidden" name="subTopic" id="subTopic" value="'.$subTopic.'">
										<input type="hidden" name="lsAskUser" id="lsAskUser" value="'.$lsAskUser.'">					
										<input type="button" class="Registros_tabla_botones" name="b_Guardar" value="Enviar" onclick="fpGuardar()">
										<input type="button" class="Registros_tabla_botones" name="b_Cancelar" value="Volver" onclick="window.location=\'../index.php\';"></th>
										<th> <textarea style="height:80px; resize:none" id="mensajeUsuario" class="control-label" disabled></textarea></th>
								</tr>
							
							</table>
		</form>
	</div>
	</center>
	</body>
	<script>
	var loF=document.fr_recuperaUsuario;
	function fpInicio()
	{
			
			switch(loF.txtOperacion.value)
			{
				case "":

					loF.f_cedula.focus();
					break;
				case "buscar":

					if(loF.txtHay.value==1&&loF.subTopic.value==1)
					{
						loF.f_cedula.disabled=true;
						loF.txtOperacion.value="buscar";
						loF.txtHacer.value="buscar";
						loF.f_AnswerUser.focus();
						document.getElementById("mensajeUsuario").value="Indique su Respuesta de Seguridad.";
					}

					if(loF.txtHay.value==0&&loF.subTopic.value==2)
					{
						loF.f_cedula.disabled=true;
						loF.txtOperacion.value="buscar";
						loF.txtHacer.value="buscar";
						loF.txtHay.value="1";
						loF.subTopic.value="1";
						loF.f_AnswerUser.focus();
						document.getElementById("mensajeUsuario").value="Respuesta de Seguridad Incorrecta.";
					}

					if(loF.txtHay.value==0&&loF.subTopic.value==3)
					{
						loF.f_cedula.disabled=false;
						loF.f_cedula.value="";
						loF.f_cedula.focus();
						loF.txtOperacion.value="buscar";
						loF.txtHacer.value="";
						document.getElementById("mensajeUsuario").value="No se encontro ningun Usuario con esa Cedula.";

					}

					if(loF.txtHay.value==0&&loF.subTopic.value==4)
					{
						loF.f_cedula.disabled=false;
						loF.f_cedula.value="";
						loF.f_AnswerUser.focus();
						loF.txtOperacion.value="buscar";
						loF.txtHacer.value="buscar";
						document.getElementById("mensajeUsuario").value="Respuesta de Seguridad no puede estar en Blanco.";

					}

					if(loF.txtHay.value==0&&loF.subTopic.value==5)
					{
						loF.f_cedula.disabled=false;
						loF.f_cedula.value="";
						loF.f_AnswerUser.focus();
						loF.txtOperacion.value="buscar";
						loF.txtHacer.value="buscar";
						document.getElementById("mensajeUsuario").value="No se pudo Restablecer o ya se habia restablecido la Contraseña con anterioridad, intente ingresar con su cedula como contraseña.";
						fpApagar();
					}

					if(loF.txtHay.value==1&&loF.subTopic.value==5)
					{
						loF.f_cedula.disabled=false;
						loF.f_cedula.value="";
						loF.f_AnswerUser.focus();
						loF.txtOperacion.value="buscar";
						loF.txtHacer.value="buscar";
						document.getElementById("mensajeUsuario").value="Contraseña restablecida, intente ingresar con su cedula como contraseña.";
						fpApagar();
					}
					break;
				
			}
		}
		
		
		function fpEncender()
		{
			loF.f_cedula.disabled=false;
			loF.f_AnswerUser.disabled=false;
		}
		function fpEncenderUsuario()
		{
			loF.f_cedula.disabled=true;
			loF.f_AnswerUser.disabled=false;
		}
		function fpApagar()
		{
			loF.f_cedula.disabled=true;
			loF.f_AnswerUser.disabled=true;
		}

		function fpPerderFocus()
		{
			if((loF.f_cedula.value!="")&&(loF.txtHacer.value==""))
			{
				loF.submit();
			}
			else
			{
				loF.f_cedula.focus();
			}
		}
		
		function fpGuardar()
		{
			if(fbValidar())
			{
				loF.f_cedula.disabled=false;
				loF.submit();
			}
		}
		
		function fbValidar()
		{
			var lbValido=false;
			
			if(loF.f_cedula.value=="")
			{
				alert("Campo Cédula esta en Blanco");
				loF.f_cedula.value="";
				loF.f_cedula.focus();
			}
			else if(loF.f_AnswerUser.value=="")
			{
				alert("Campo Respuesta de Seguridad esta en Blanco");
				loF.f_AnswerUser.value="";
				loF.f_AnswerUser.focus();
			}
			else
			{
				lbValido=true;
			}
			return lbValido;
		}
		
</script>
</html>
'); 

?>
