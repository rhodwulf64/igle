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
		<title>'.$_SESSION['title'].' - Inscripción de Capilla</title>

	');
			print(encabezado_menu("../"));

echo utf8_Decode('
		</head>

	<body onload='.$FunIncio.'>
<div class="mygrid-wrapper-div">
<div class="container pre-scrollable" style="margin-top:5px; min-height: 530px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">
<div id="mascara" onclick="salir();"></div>
	<div class="modal-dialog" id="buscador" style="width:805px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="salir();" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Buscador</h4>
            </div>
            <div class="modal-body pre-scrollable">
				<table>
					<tr>
						<td><input type="text" onkeyup="buscar_like(this);" class="form-control" style="width:760px;" placeholder="Ingrese una palabra clave..." name="txtbuscador" id="txtbuscador"/></td>
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
		<form name="fr_Capilla" id="fr_Capilla" action="../cntller/cn_capilla.php" method="post">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered table-hover"  border="1" >
						<thead>		
							<tr>
								<th colspan="3"><center>Registro de Capilla</center></th>
							</tr>
						</thead>
						<tr>
							<th><div class="form-group has-default" id="haf_nombre"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Nombre:</font><input type="text" name="f_nombre" id="f_nombre" class="form-control" value="" onkeypress="vSoloLetras();" tabindex="1" onblur="fpPerderFocus();vCampoVacio(this.id);"><div class="tool-tip  slideIn" id="ttipf_nombre" style="display:none;"></div></div></div></th>
							<th><div class="form-group has-default" id="haf_telefono"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Teléfono:</font><input type="text" name="f_telefono" id="f_telefono" size="8" maxlenght="12" class="form-control" value="" placeholder="(999)9999999" onfocus="MaskTelefono(this.id)" onkeypress="vSoloTelefono();" tabindex="2" onblur="vCampoVacio(this.id);" size="8" maxlenght="12"><div class="tool-tip  slideIn" id="ttipf_telefono" style="display:none;"></div></div></div></th>

						</tr>
						<tr>
							<th><div class="form-group has-default" id="haf_direccion"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Dirección:</font><textarea name="f_direccion" id="f_direccion" class="form-control" style="resize:none; overflow-y:scroll; height:100px;" maxlenght="150" tabindex="3" onblur="vCampoVacio(this.id);" disabled></textarea><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"><div class="tool-tip  slideIn" id="ttipf_direccion" style="display:none;"></div></div></div>
                                <div class="form-group has-default" id="hatxtCorreo">
                                            <div class="on-focus clearfix" style="position: relative;">
                                                    <span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><label class="control-label">Correo Electronico Principal</label>
                                                    <input type="text" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="cliente@micorreo.com" onkeypress="vSoloCorreo();" tabindex="4" onblur="vCampoVacioUnder(this.id);vSoloEmail(this.id);" value="">
                                                    <div class="tool-tip  slideIn" id="ttiptxtCorreo" style="display:none;"></div>
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
							<th><div class="form-group has-default" id="haf_fechaCreacion"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Fecha de Creación:</font><input type="date" name="f_fechaCreacion" id="f_fechaCreacion" class="form-control" tabindex="9" onblur="vSoloFechaAnterior(this.id);" value=""><div class="tool-tip  slideIn" id="ttipf_fechaCreacion" style="display:none;"></div></div></div></th>
							<th>
							<div class="form-group has-default" id="hacmb_ParroquiaIgle"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><label class="control-label">Parroquia Iglesia:</label><select id="cmb_ParroquiaIgle" name="cmb_ParroquiaIgle" class="form-control" tabindex="10" onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Ciudad\',this.id)"><option value="0">*Seleccione Parroquia Iglesia</option>
							');
							echo utf8_decode($loFuncion->fncreateComboSelect("tparroquiaiglesia", "","codigoParroquiaIglesia","", ' ',"","nombre", $selecttparroquiaiglesia,"", "codigo_archi", "")); 
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
						<input type="hidden" name="txtidCapilla" id="txtidCapilla" value="">	
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
	var loF=document.fr_Capilla;
	
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
			loF.f_nombre.focus();
		}
		
		function fpEncender()
		{
			loF.f_nombre.disabled=false;
			loF.txtCorreo.disabled=false;
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
			loF.txtCorreo.disabled=true;
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
			loF.txtCorreo.value="";
			loF.f_fechaCreacion.value="";
			loF.f_direccion.value="";
			loF.f_telefono.value="";

			loF.cmb_Estado.value="0";
			loF.cmb_Ciudad.value="0";
			loF.cmb_Municipio.value="0";
			loF.cmb_Parroquia.value="0";
			loF.cmb_ParroquiaIgle.value="0";


			$( ".tool-tip.slideIn" ).each(function(i) {$(this).css( "display", "none" );});
			$( ".form-group" ).each(function(i) {$(this).attr( "class", "form-group has-default" );});


			fpApagar();
			fpInicial();
			loF.KestadoActual.value=1;
		}
		
		function buscar_like(e){
			var parametros = "?AccionGet=buscar_like&txtcadena="+e.value;
			var url = "../cntller/cn_capilla.php";
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
			loF.txtidCapilla.value=lke.nvaidCapilla.value;
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
			fpCambioB();
			loF.f_nombre.focus();
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
									
				var $forme = $("#fr_Capilla");

					$.ajax({
						url: \'../cntller/cn_capilla.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var arrayDato=data[\'ArrDatos\'];
           					var arrayFeligres=data[\'Feligres\'];
							
								
							if((loF.txtHacer.value=="buscar")&&(arrayDato.liHay==1))
							{
								loF.txtidCapilla.value = arrayDato.lsidCapilla;
								loF.f_nombre.value = arrayDato.lsNombre;
								loF.txtCorreo.value = arrayDato.lsCorreo;
								loF.f_fechaCreacion.value = arrayDato.lsFecha_creacion;
								loF.f_telefono.value = arrayDato.lsTelefono;
								loF.f_direccion.value = arrayDato.lsDireccion;
								loF.KestadoActual.value = arrayDato.lsEstatus;
								fpCambioE();
								fpApagar();

								if (loF.txtOperacion.value=="incluir")
								{
									document.getElementById("haf_nombre").className = "form-group has-warning";
									loF.f_nombre.disabled=true;
									NotificaE("Esta cedula ya se encuentra registrada");
									fpCambioE();
									fpApagar();
								}

								$("#cmb_Ciudad").showOption(arrayDato.lsidFciudad);
								$("#cmb_Municipio").showOption(arrayDato.lsidFmunicipio);
								$("#cmb_Parroquia").showOption(arrayDato.lsidFparroquia);
								loF.cmb_Estado.value = arrayDato.lsidFestado;
								loF.cmb_Ciudad.value = arrayDato.lsidFciudad;
								loF.cmb_ParroquiaIgle.value = arrayDato.lsCodigo_ParroquiaIgle;
								loF.cmb_Municipio.value = arrayDato.lsidFmunicipio;
								loF.cmb_Parroquia.value = arrayDato.lsidFparroquia;
							}
													

							if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(arrayDato.liHay==0))
							{
								document.getElementById("haf_nombre").className = "form-group has-success";
								loF.f_nombre.disabled=true;
								loF.f_telefono.focus();
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
								NotificaE("No se encontro Capilla con la cedula ingresada.")
							}

							
							
						}
					});
				
		}

		function fpPredeterminado()
		{
			fpApagar();
			var Cedu="'.$CeduImportada.'";
			if (Cedu!="")
			{
				fpEncender();
				document.getElementById("haf_nombre").className = "form-group has-success";
				loF.f_nombre.disabled=true;
				loF.txtOperacion.value="incluir";
				loF.txtHacer.value="incluir";
				loF.txtHay.value=0;
				loF.f_nombre.value=Cedu;
				loF.f_nombre.focus();
				fpCambioN();

			}
		}
		function fpBusquedaForanea()
		{
			loF.f_nombre.value="'.$CeduImportada.'";
			loF.f_nombre.disabled=false;
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.txtHay.value=0;
			fpPerderFocus();
		}

		function fpPadres(PCampos)
		{
				var OperacionOld=loF.txtOperacion.value;	//respalda operacion principal
				var HacerOld=loF.txtHacer.value;	//respalda hacer
				loF.txtOperacion.value="ExaminaPadre";	
				loF.txtHacer.value=PCampos.id;	
				var $forme = $("#fr_Capilla");

					$.ajax(
					{
						url: \'../cntller/cn_capilla.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var arrayDato=data[\'ArrDatos\'];
           					var arrayFeligres=data[\'Feligres\'];
							if((arrayDato.lsCedula!=""))
							{

								if((arrayDato.lsOperacion=="ExaminaPadre")&&(arrayDato.liHay==1))
								{
									PCampos.value = arrayDato.lsCedula;
									document.getElementById("ha"+PCampos.id).className = "form-group has-success";
									document.getElementById("nt"+PCampos.id).innerHTML=" "+arrayDato.lsNombre;
									PCampos.disabled = true;

								}
								else if((arrayDato.lsOperacion=="ExaminaPadre")&&(arrayDato.liHay==0))
								{
									document.getElementById("ha"+PCampos.id).className = "form-group has-warning";
									document.getElementById("nt"+PCampos.id).innerHTML=" "+" (No especificado)";
								}

								if((arrayDato.lsOperacion=="ExaminaPadre")&&(arrayDato.liHay==3))
								{
									PCampos.value = arrayDato.lsCedula;
									document.getElementById("ha"+PCampos.id).className = "form-group has-error";

							 	 	NotificaE("Lo siento, la cedula ingresada no es del sexo femenino");
									PCampos.value="";
									PCampos.focus();
									

								}
								if((arrayDato.lsOperacion=="ExaminaPadre")&&(arrayDato.liHay==4))
								{
									PCampos.value = arrayDato.lsCedula;
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
				loF.f_nombre.disabled=false;

				var $forme = $("#fr_Capilla");
					$.ajax(
					{
						url: \'../cntller/cn_capilla.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var arrayDato=data[\'ArrDatos\'];
           					var arrayFeligres=data[\'Feligres\'];
						
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
			if(vCampoVacio("txtCorreo"))
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
				if(confirm("Desea Reactivar Capilla?"))
				{
					loF.txtOperacion.value="reactivar";
					loF.txtHacer.value="reactivar";
					var $forme = $("#fr_Capilla");

					$.ajax({
						url: \'../cntller/cn_capilla.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var arrayDato=data[\'ArrDatos\'];
							if(arrayDato.liHay==1)
							{
									fpCancelar();
									NotificaS("Registro de Capilla ha sido Reactivado");
									loF.KestadoActual.value=1;
									fpInicial();
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Reactivar Capilla");
									loF.KestadoActual.value=1;
									fpInicial();									
							}
						}
					});


				}
			}
			else
			{
				if(confirm("Desea Desactivar Capilla?"))
				{
					loF.txtOperacion.value="desactivar";
					loF.txtHacer.value="desactivar";

					var $forme = $("#fr_Capilla");

					$.ajax({
						url: \'../cntller/cn_capilla.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var arrayDato=data[\'ArrDatos\'];
							if(arrayDato.liHay==1)
							{
									fpCancelar();
									NotificaS("Registro de Capilla ha sido Desactivado");
									loF.KestadoActual.value=1;
									fpInicial();							
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Desactivar Capilla.");
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
