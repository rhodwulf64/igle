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
		<title>'.$_SESSION['title'].' - Configuración</title>
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
	
	<form name="fr_configuracion" id="fr_configuracion" action="../cntller/cn_confCombos.php" method="post">
		<div class="col-lg-12">
			<input type="hidden" id="temporal"/>
				<table class="table table-striped table-bordered table-hover"  border="1" >
					<thead>		
						<tr>
							<th colspan="2"><center>Configuracion de Estados</center></th>
						</tr>
					</thead>
				<tr colspan="2">
					<th>
						<center>
							<div class="form-group has-default" onclick="fpAvisaSeleccionar(document.getElementById(\'KcodCombo\').value);" id="haf_listarEstado" style="width:400px;"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Estado a Editar:</font><br><select title="Debe presionar el boton \'Seleccionar\' antes de editar un elemento."name="f_listarEstado" class="form-control" size="10" onblur="vCampoVacio(this.id);" onchange="SeleccionaItem(this.value);" id="f_listarEstado" value="">');

							echo utf8_decode($loFuncion->fncreateComboSelectConf("estado", "","cod_estado","", ' ',"","descripcion", $selectEstado,"", "", "")); 
							echo utf8_Decode('
							</select><div class="tool-tip  slideIn" id="ttipf_listarEstado" style="display:none;"></div></div></div>
						</center>
					</th>
				</tr>
				<tr colspan="2">
					<th><center><div class="form-group has-default" id="haf_descripcion" style="width:400px;"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Descripción:</font><input type="text" id="f_descripcion" name="f_descripcion" class="form-control" onkeypress="vSoloLetras();" onblur="this.value=this.value.toUpperCase(); vCampoVacio(this.id);" value=""><div class="tool-tip  slideIn" id="ttipf_descripcion" style="display:none;"></div></div></div></center></th>
					
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
					<input type="hidden" name="txtHay" id="txtHay" value="">
					<input type="hidden" name="KcodCombo" id="KcodCombo" value="">
					<input type="hidden" name="KcodForaneo" value="">
					<input type="hidden" name="KcharSelector" value="estado">
					<input type="hidden" name="KestadoActual" id="KestadoActual" value="">
					<input type="button" class="btn btn-default" name="b_Nuevo" value="Nuevo" onclick="fpNuevo()">
					<input type="button" class="btn btn-default" name="b_Modificar" value="Modificar" onclick="fpModificar()">
					<input type="button" class="btn btn-default" name="b_Buscar" value="Seleccionar" onclick="fpSeleccionar()">
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
	var loF=document.fr_configuracion;
	function fpInicio()
	{	

			fpInicial();
			fpCancelar();
						

	}
		
		function fpNuevo()
		{
			fpCambioN();
			loF.f_descripcion.disabled=false;
			loF.txtOperacion.value="incluir";
			loF.f_descripcion.focus();
		}
		
		function fpEncender()
		{

			loF.f_listarEstado.disabled=false;
			loF.f_descripcion.disabled=false;

			
		}

		function fpApagar()
		{

			loF.f_listarEstado.disabled=true;
			loF.f_descripcion.disabled=true;
			loF.KestadoActual.value=2;
			fpEstadoActual();

		}
		
		function fpCancelar()
		{

			loF.txtOperacion.value="";
			loF.txtHay.value=0;
			loF.f_listarEstado.value="";
			loF.f_descripcion.value="";
			$( ".tool-tip.slideIn" ).each(function(i) {$(this).css( "display", "none" );});
			$( ".form-group.has-error" ).each(function(i) {$(this).attr( "class", "form-group has-default" );});
			loF.KcodCombo.value="";			


			fpApagar();
			fpInicial();

		}

		function buscar()
		{
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");

			mas.style.display = "block";
			bus.style.display = "block";

			document.getElementById("txtbuscador").focus();
		}

		function fpModificar()
		{
			loF.txtOperacion.value="modificar";
			loF.txtHay.value=0;
			loF.f_listarEstado.disabled=true;
			loF.f_descripcion.disabled=false;
			loF.f_descripcion.focus();
			fpCambioN();

		}


		function fpSeleccionar()
		{
			loF.txtOperacion.value="seleccionar";
			loF.txtHay.value=0;
			loF.f_listarEstado.disabled=false;


			fpCambioE();
			
		}

		function SeleccionaItem()
		{
			var valueIndex=loF.f_listarEstado.selectedIndex;
			loF.f_descripcion.value=loF.f_listarEstado.options[valueIndex].text;
			loF.KcodCombo.value=loF.f_listarEstado.options[valueIndex].value;
			loF.f_descripcion.focus();

			loF.txtOperacion.value="busEstatus";
			var $forme = $("#fr_configuracion");

			$.ajax({
				url: \'../cntller/cn_confCombos.php\',
				dataType: \'json\',
				type: \'post\',
				data: $forme.serialize(),
		        success: function(data){
		        	var Confi=data[\'Confi\'];
					if(Confi.liHay==1)
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

		function fpEstadoActual()
		{
			var KedoActual=loF.KestadoActual.value;
			if(KedoActual==1)
			{
				loF.b_Eliminar.value="Desactivar";

			}
			else if(KedoActual==2)
			{
				loF.b_Eliminar.value="Estado";

			}
			else
			{
				loF.b_Eliminar.value="Activar";
			}
			
		}

				
		function fpDesactivar()
		{
			if (loF.b_Eliminar.value=="Desactivar")
			{
				if(confirm("Desea Desactivar a "+loF.f_descripcion.value+"?"))
				{
					loF.txtOperacion.value="desactivar";
					var $forme = $("#fr_configuracion");

					$.ajax({
						url: \'../cntller/cn_confCombos.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var Confi=data[\'Confi\'];
							if(Confi.liHay==1)
							{
									fpCancelar();
									NotificaS(loF.f_descripcion.value+" Desactivado");
									document.location.reload();
									fpInicial();							
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Desactivar "+loF.f_descripcion.value+".");
									fpInicial();									
							}
							
						}
					});

				}
			}
			if (loF.b_Eliminar.value=="Activar")
			{
				if(confirm("Desea Reactivar a "+loF.f_descripcion.value+"?"))
				{
					loF.txtOperacion.value="reactivar";
					var $forme = $("#fr_configuracion");

					$.ajax({
						url: \'../cntller/cn_confCombos.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var Confi=data[\'Confi\'];
							if(Confi.liHay==1)
							{
									fpCancelar();
									NotificaS(loF.f_descripcion.value+" Reactivado");
									document.location.reload();

									fpInicial();							
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Reactivar "+loF.f_descripcion.value+".");

									fpInicial();									
							}
							
						}
					});

				}

			}
		}


		function fbValidar()
		{
			var lbValido=false;
			var vInvalido=0;
			if(loF.f_descripcion.value=="")
			{
				loF.f_descripcion.focus();
				vCampoVacio("f_descripcion");
				vInvalido=1;
			}
			if (vInvalido==0)
			{
				lbValido=true;
			}
			return lbValido;
		}




		function fpGuardar()
		{
			if(fbValidar())
			{

				var $forme = $("#fr_configuracion");

					$.ajax(
					{
						url: \'../cntller/cn_confCombos.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var Confi=data[\'Confi\'];
								if ((loF.txtOperacion.value=="incluir")&&(Confi.liHay==0))
								{
									NotificaE("La descripción que ha introducido ya se encuentra registrada.");
									loF.f_descripcion.focus();
								}

								if ((loF.txtOperacion.value=="incluir")&&(Confi.liHay==1))
								{

									NotificaS("Registro incluido con exito.");
									setTimeout(function(){ document.location.reload(); }, 1500);
									
								}

								if ((loF.txtOperacion.value=="modificar")&&(Confi.liHay==0))
								{
									NotificaE("El dato que ha introducido ya se encuentra registrado.");
								}

								if ((loF.txtOperacion.value=="modificar")&&(Confi.liHay==1))
								{

									NotificaS("Registro modificado con exito.");
									setTimeout(function(){ document.location.reload(); }, 1500);

								}
						}
					});
			}
			
		}


	

</script>



</html>
'); 






?>
