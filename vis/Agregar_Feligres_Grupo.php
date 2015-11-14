<?php


  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}

	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");

	$LoadEjecuta="";
	if (!empty($_GET["matriRef"]))
	{
		$LoadEjecuta="ejecutaPrimero();";
	}
	$loFuncion = new clsFunciones;
	echo utf8_Decode('

<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Inscripción de Feligreses en Grupo Apostolado</title>
		');
			print(encabezado_menu("../"));

	echo utf8_Decode('
		</head>
		<body onload="fpInicio();'.$LoadEjecuta.'">
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
		encab("../");
		menu_general("");
		
echo utf8_Decode('
	
	<form name="fr_grupoApostolado" id="fr_grupoApostolado" action="../con/cn_apostoladoFeligres.php" method="post">
		<div class="col-lg-12">
			
				<table class="table table-striped table-bordered table-hover"  border="1" >
					<thead>		
						<tr>
							<th colspan="2"><center><div class="alert alert-info" id="divf_cambiaMatri"><font id="ntf_cambiaMatri" onclick="accionEstados(this.id)">Inscripción de Feligreses en Grupo Apostolado</font><br><i id="CargaReporteIco" style="display:none;" class="fa fa-circle-o-notch fa-spin"></i></div></center></th>
						</tr>
					</thead>
				<tr>
					<th>
						<div class="form-group has-default" id="hacmb_GrupoApostolado"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Grupo Apostolado:</font><select id="cmb_GrupoApostolado" name="cmb_GrupoApostolado" class="form-control"  onblur="vCampoVacio(this.id);" onchange="fpCombosIncluir(\'\');"><option value="0">Seleccione Grupo Apostolado</option>
						');
						echo utf8_decode($loFuncion->fncreateComboSelect("tgrupo", "","codigoGrupo","", ' ',"","nombre", $selecttgrupo,"", "", "")); 
						echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_GrupoApostolado" style="display:none;"></div></div></div>
					</th>
					<th>
						<div class="form-group has-default" id="hacmb_Iglesia"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Parroquia:</font><select id="cmb_Iglesia" name="cmb_Iglesia" class="form-control"  onblur="vCampoVacio(this.id);" onchange="fpCombosIncluir(\'\');"><option value="0">Seleccione La Parroquia</option>
						');
						echo utf8_decode($loFuncion->fncreateComboSelect("tparroquiaiglesia", "","codigoParroquiaIglesia","", ' ',"","nombre", $selectiglesia,"", "", "")); 
						echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Iglesia" style="display:none;"></div></div></div>
					</th>
				</tr>
				
<br>

		<table class="table table-striped table-bordered table-hover" border="1" >
								<thead>		
									<tr>
										<th colspan="9"><center>Feligreses</center></th>
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
										<th align="center" ><font class="control-label">Telefono:</font><br>
											<input type="text" name="f_padTelefono" id="f_padTelefono" class="form-control" value="" size="8" maxlenght="50"   disabled> 
										</th>
										<th align="center" ><font class="control-label">Correo:</font><br>
											<input type="text" name="f_padCorreo" id="f_padCorreo" class="form-control" value="" size="8" maxlenght="50"   disabled> 
										</th>
										<th align="center" ><font class="control-label">Parroquia:</font><br>
											<select class="form-control" name="f_padParroquia" id="f_padParroquia" class="form-control" value="" disabled><option value=""><option value="0">Seleccione Parroquia</option>
											');
										echo utf8_decode($loFuncion->fncreateComboSelect("tparroquiaiglesia", "","codigoParroquiaIglesia","", ' ',"","nombre", $selectiglesia,"", "", "")); 
										echo utf8_Decode('</select>
										</th>									
										<th align="center" >		
											<button type="button" name="btnAgregar" style="margin:10px 8px; width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.428571429" class="btn btn-default btn-circle" onclick="fpAgregar()"><i class="fa fa-plus"></i></button>
										</th>

									</tr>
									
		</table>

<table align="center" border="1" name="tabFeligres" id="tabFeligres" class="table table-striped table-bordered table-hover">


</table>

<br>



</div>
	</div>
	<div class="container" style="margin-top:5px; padding:5px; min-height: auto; background: #FFFFFF; -webkit-box-shadow: 0px 2px 5px 2px #999; -moz-box-shadow: 2px 2px 5px #999;">
		<table class="table table-striped table-bordered table-hover" border="1" style="margin:0px">	
		<tr>
			<th colspan="2">
			<div class="controls form-inline">
					<center>
					<input type="hidden" name="txtOperacion" id="txtOperacion" value="">
					<input type="hidden" name="txtHacer" id="txtHacer" value="">
					<input type="hidden" name="txtHay" id="txtHay" value="">
					<input type="hidden" name="txtFila" value="0">
					<input type="hidden" name="auxiliarHacer" value="">
					<input type="hidden" name="auxiliarOpera" value="">
					<input type="hidden" name="auxiliarFeligres" value="">
					<input type="hidden" name="txtidRegistro" id="txtidRegistro" value="">
					<input type="hidden" id="temporal" name="temporal" value="">
					<input type="button" class="btn btn-default" name="b_Nuevo" value="Nuevo" onclick="fpNuevo()">
					<input type="button" class="btn btn-default" name="b_Buscar" value="Buscar" onclick="fpBuscarLike()">
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
	var loF=document.fr_grupoApostolado;
	function fpInicio()
	{	

			fpInicialnoElimMod();
			fpCancelar();
			fpNuevo();
						

	}
		
		function fpNuevo()
		{
			var liFila=Number(loF.txtFila.value);
			loF.cmb_Iglesia.disabled=false;
			loF.cmb_GrupoApostolado.disabled=false;
			loF.txtOperacion.value="incluir";
			loF.txtHacer.value="buscar";
			loF.cmb_GrupoApostolado.focus();
			fpCambioNnoElimMod();
		}
		
		function fpEncender()
		{
			var liFila=Number(loF.txtFila.value);
			loF.cmb_Iglesia.disabled=false;
			loF.cmb_GrupoApostolado.disabled=false;
			loF.btnAgregar.disabled=false;

			for(liY=1;liY<=liFila;liY++)
            {
			
				document.getElementById("f_padNombres"+liY).disabled=false;
				document.getElementById("f_padApellidos"+liY).disabled=false;
				document.getElementById("f_padSexo"+liY).disabled=false;
				document.getElementById("f_padParroquia"+liY).disabled=false;
				document.getElementById("f_padTelefono"+liY).disabled=false;
				document.getElementById("f_padCorreo"+liY).disabled=false;

			}

			
		}

				
		
		function fpEnciendeCampos()
		{
			loF.cmb_Iglesia.disabled=false;
			loF.cmb_GrupoApostolado.disabled=false;
			var liFila=Number(loF.txtFila.value);
			for(liY=1;liY<=liFila;liY++)
	        {
	        QuitarMask("f_padCedula"+liY);
			document.getElementById("f_padCedula"+liY).disabled=false;
			document.getElementById("f_padNombres"+liY).disabled=false;
			document.getElementById("f_padApellidos"+liY).disabled=false;
			document.getElementById("f_padSexo"+liY).disabled=false;
			document.getElementById("f_padTelefono"+liY).disabled=false;
			document.getElementById("f_padCorreo"+liY).disabled=false;
			document.getElementById("f_padParroquia"+liY).disabled=false;
			}
		}
		function fpApagar()
		{
			var liFila=Number(loF.txtFila.value);
			loF.cmb_Iglesia.disabled=true;
			loF.cmb_GrupoApostolado.disabled=true;

			loF.btnAgregar.disabled=true;
		    for(liY=1;liY<=liFila;liY++)
            {
				document.getElementById("f_padCedula"+liY).disabled=true;
				document.getElementById("f_padNombres"+liY).disabled=true;
				document.getElementById("f_padApellidos"+liY).disabled=true;
				document.getElementById("f_padSexo"+liY).disabled=true;
				document.getElementById("f_padParroquia"+liY).disabled=true;
			}
			
			document.getElementById("ntf_cambiaMatri").innerHTML="Registro de Feligreses a Grupo Apostolado";
			document.getElementById("divf_cambiaMatri").className = "alert alert-info";
		}

		function fpCancelar()
		{
			var liFila=Number(loF.txtFila.value);
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.cmb_Iglesia.value=0;
			loF.cmb_GrupoApostolado.value=0;		
			$( ".tool-tip.slideIn" ).each(function(i) {$(this).css( "display", "none" );});
			$( ".form-group.has-error" ).each(function(i) {$(this).attr( "class", "form-group has-default" );});

			loF.auxiliarHacer.value="buscar";		
			fpEliminaFilas();
			fpApagar();
			fpInicialnoElimMod();
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
			

			loF.cmb_GrupoApostolado.value=lke.nvaidApostolado.value;
			loF.cmb_Iglesia.value=lke.nvaidParroquiaIglesia.value;
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.txtHay.value="0";
			loF.cmb_GrupoApostolado.disabled=false;
			loF.cmb_Iglesia.disabled=false;
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
			loF.cmb_Iglesia.disabled=false;
			loF.cmb_GrupoApostolado.disabled=false;
			loF.cmb_Iglesia.focus();
			fpCambioBnoElimMod();
			
		}

		function fpCombosIncluir()
		{
			var campo1=loF.cmb_GrupoApostolado.value;
			var campo2=loF.cmb_Iglesia.value;

			if ((campo1!="0")&&(campo2!="0"))
			{
				loF.txtOperacion.value="incluir";
				loF.txtHacer.value="buscar";
				loF.txtHay.value="0";
				loF.cmb_GrupoApostolado.disabled=false;
				loF.cmb_Iglesia.disabled=false;
				fpPerderFocus();
			}
		}

		function fpPerderFocus()
		{
		var obje="";
			
			if(loF.txtHacer.value=="buscar")
			{
				
						
				var $forme = $("#fr_grupoApostolado");

					$.ajax({
						url: \'../cntller/cn_apostoladoFeligres.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var apostolo=data[\'AposFeligres\'];
           					var padres=data[\'Padres\'];
           					var Feligres=data[\'Feli\'];
											
								if ((loF.txtHacer.value=="buscar")&&(apostolo.liHay==1))
								{
									fpCambioNnoElimMod();
									fpApagar();
									fpListarFeligres(Feligres);
									if(loF.txtOperacion.value=="buscar")
									{
										fpModificar();
									}

								}

								if ((loF.txtOperacion.value=="buscar")&&(apostolo.liHay==0))
								{
									NotificaE("No se encontro ningun Feligres Asociado a Grupo Apostolado activo con la Referencia ingresada");
								}
								if ((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar"))
								{
									loF.txtOperacion.value="incluir";
									loF.txtHacer.value="incluir";
									loF.btnAgregar.disabled=false;
								}
						}
					});
				
		
			}
		
		}
		
		
		function fpGuardar()
		{
			if(fbValidar())
			{
				fpEnciendeCampos();
				var $forme = $("#fr_grupoApostolado");

					$.ajax(
					{
						url: \'../cntller/cn_apostoladoFeligres.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var apostolo=data[\'AposFeligres\'];
           					var Feligres=data[\'Padri\'];

							if ((loF.txtHacer.value=="incluir")&&(apostolo.liHay==0))
							{
								NotificaE("El Registro no pudo ser incluido.");


							}

							if ((loF.txtHacer.value=="incluir")&&(apostolo.liHay==1))
							{

								NotificaS("Registro incluido con exito.");
								fpCancelar();


							}
							if ((loF.txtHacer.value=="modificar")&&(apostolo.liHay==0))
							{
								NotificaE("El Registro no pudo ser modificado.");


							}

							if ((loF.txtHacer.value=="modificar")&&(apostolo.liHay==1))
							{

								NotificaS("Registro modificado con exito.");
								fpCancelar();
							}

						}
					});
			}
			
		}
		
		function fbValidar()
		{
			var lbValido=false;
			var vInvalido=0;
			if(loF.cmb_Iglesia.value=="0")
			{
				loF.cmb_Iglesia.focus();
				vCampoVacio("cmb_Iglesia");
				vInvalido=1;
			}
			if(loF.cmb_GrupoApostolado.value=="0")
			{
				loF.cmb_GrupoApostolado.focus();
				vCampoVacio("cmb_GrupoApostolado");
				vInvalido=1;
			}
			if (vInvalido==0)
			{
				lbValido=fbValidaFeligres();
			}
			else if (vInvalido==3)
			{
				
				lbValido=fbValidaFeligres();
				
			}
			return lbValido;
		}

		function fbValidaFeligres()
		{
			var lbValido=false;
			var vInvalido=0;

			var liFila=Number(loF.txtFila.value);
			
	            for(liY=1;liY<=liFila;liY++)
	            {

	            	for(liO=1;liO<=liFila;liO++)
	            	{
						if((document.getElementById("f_padCedula"+liY).value.trim()==document.getElementById("f_padCedula"+liO).value.trim())&&(liY!=liO))
						{
							document.getElementById("f_padCedula"+liY).focus();
							vInvalido=1;
						}
					}
	            	
					if(document.getElementById("f_padCedula"+liY).value=="")
					{

						document.getElementById("f_padCedula"+liY).focus();
						vCampoVacio("f_padCedula"+liY);
						vInvalido=1;
					}
					if(document.getElementById("f_padNombres"+liY).value=="")
					{
						document.getElementById("f_padNombres"+liY).focus();
						vCampoVacio("f_padNombres"+liY);
						vInvalido=1;
					}
					if(document.getElementById("f_padApellidos"+liY).value=="")
					{
						document.getElementById("f_padApellidos"+liY).focus();
						vCampoVacio("f_padApellidos"+liY);
						vInvalido=1;
					}
					if(document.getElementById("f_padSexo"+liY).value=="")
					{
						document.getElementById("f_padSexo"+liY).focus();
						vCampoVacio("f_padSexo"+liY);
						vInvalido=1;
					}
					if(document.getElementById("f_padTelefono"+liY).value=="")
					{
						document.getElementById("f_padTelefono"+liY).focus();
						vCampoVacio("f_padTelefono"+liY);
						vInvalido=1;
					}
					if(document.getElementById("f_padCorreo"+liY).value=="")
					{
						document.getElementById("f_padCorreo"+liY).focus();
						vCampoVacio("f_padCorreo"+liY);
						vInvalido=1;
					}
					if(document.getElementById("f_padParroquia"+liY).value=="")
					{
						document.getElementById("f_padParroquia"+liY).focus();
						vCampoVacio("f_padParroquia"+liY);
						vInvalido=1;
					}
			
				}
				if(vInvalido==0)
				{
					
					lbValido=true;
					
				}
			
		
			return lbValido;
		}
		
		function fpModificar()
		{
			fpEncender();
			fpCambioNnoElimMod();
			loF.txtOperacion.value="modificar";
			loF.txtHacer.value="modificar";
			loF.txtHay.value=0;
			loF.cmb_Iglesia.disabled=true;
			loF.cmb_GrupoApostolado.disabled=true;
			loF.cmb_Iglesia.focus();
		}
		
		function fpCambiaEstadoFeli(idRegis,opera,fila)
        {
            loF.txtidRegistro.value=idRegis;
            loF.txtOperacion.value=opera;
            loF.txtHacer.value=opera;
            loF.txtHay.value="0";
            var $forme = $("#fr_grupoApostolado");
			$.ajax({
				url: \'../cntller/cn_apostoladoFeligres.php\',
                    dataType: \'json\',
                    type: \'post\',
                    data: $forme.serialize(),
                    success: function(data)
                    {
			        	var AposFeligres=data[\'AposFeligres\']
			        	var FeliEncontrado=data[\'FeliEncontrado\'];
                        
                            if ((loF.txtHacer.value=="activarFeli")&&(AposFeligres.liHay==0))
                            {
                                NotificaE("Feligres no pudo ser activado.");

                            }
                            if ((loF.txtHacer.value=="activarFeli")&&(AposFeligres.liHay==1))
                            {
                                NotificaS("Feligres activado con exito.");
                                document.getElementById("estadoTR"+fila).className="success";
                                $(\'#btnEstadoFeli\'+fila).attr("onclick","fpCambiaEstadoFeli("+idRegis+",\"desactivarFeli\","+fila+");");
                                $(\'#btnEstadoFeli\'+fila).attr("title","Click Para Desactivar el Feligres");
                                document.getElementById("btnEstadoFeli"+fila).innerHTML="<i class=\"fa fa-times\"></i>";
                            }

                            if ((loF.txtHacer.value=="desactivarFeli")&&(AposFeligres.liHay==0))
                            {
                                NotificaE("Feligres no pudo ser desactivado.");

                            }

                            if ((loF.txtHacer.value=="desactivarFeli")&&(AposFeligres.liHay==1))
                            {
                                NotificaS("Feligres desactivado con exito.");
                                document.getElementById("estadoTR"+fila).className="danger";
                                $(\'#btnEstadoFeli\'+fila).attr("onclick","fpCambiaEstadoFeli("+idRegis+",\"activarFeli\","+fila+");");
                                $(\'#btnEstadoFeli\'+fila).attr("title","Click Para Activar el Feligres");
                                document.getElementById("btnEstadoFeli"+fila).innerHTML="<i class=\"fa fa-check\"></i>";

                            }
                       
                    }
                });

            

        }

		function BuscaUnFeli(linea)
		{
			var liFila=Number(loF.txtFila.value);
			var EnviaConsulta=true;
			for(liO=1;liO<=liFila;liO++)
	    	{
				if((document.getElementById("f_padCedula"+linea).value.trim()==document.getElementById("f_padCedula"+liO).value.trim())&&(linea!=liO))
				{
					NotificaE("Lo siento, no puede incluir un feligres que ya se encuentra agregado.");
					document.getElementById("f_padCedula"+linea).focus();
					EnviaConsulta=false;
				}
			}
			if (EnviaConsulta)
			{
				loF.auxiliarHacer.value=loF.txtHacer.value;
				loF.auxiliarOpera.value=loF.txtOperacion.value;
				var cedufeli=document.getElementById("f_padCedula"+linea).value.split(\' \').join(\'\');
				loF.txtOperacion.value="buscarFeli";
				loF.txtHacer.value="buscarFeli";
				document.getElementById("f_padCedula"+linea).disabled=false;
				
				if (cedufeli.length>7)
				{
					loF.auxiliarFeligres.value=cedufeli;
					var $forme = $("#fr_grupoApostolado");

					$.ajax({
						url: \'../cntller/cn_apostoladoFeligres.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var AposFeligres=data[\'AposFeligres\']
				        	var FeliEncontrado=data[\'FeliEncontrado\'];
							if((AposFeligres.liHay==1)&&(AposFeligres.lsHacer=="buscarFeli"))
							{
								document.getElementById("haf_padCedula"+linea).className = "form-group has-warning";				
								document.getElementById("f_padCedula"+linea).value = FeliEncontrado.lscedu;
								document.getElementById("f_padNombres"+linea).value = FeliEncontrado.lsNomb;
								document.getElementById("f_padApellidos"+linea).value = FeliEncontrado.lsApel;
								document.getElementById("f_padSexo"+linea).value = FeliEncontrado.lsSexo;
								document.getElementById("f_padTelefono"+linea).value = FeliEncontrado.lsTelefono;
								document.getElementById("f_padCorreo"+linea).value = FeliEncontrado.lsCorreo;
								document.getElementById("f_padParroquia"+linea).value = FeliEncontrado.lsParroquiaIglesia;
								document.getElementById("f_padCedula"+linea).disabled = true;
								document.getElementById("haf_padNombres"+linea).className = "form-group has-default";
								document.getElementById("haf_padApellidos"+linea).className = "form-group has-default";
								document.getElementById("haf_padSexo"+linea).className = "form-group has-default";
								document.getElementById("haf_padTelefono"+linea).className = "form-group has-default";
								document.getElementById("haf_padCorreo"+linea).className = "form-group has-default";
								document.getElementById("haf_padParroquia"+linea).className = "form-group has-default";

							}
							else	
							{
								document.getElementById("haf_padCedula"+linea).className = "form-group has-success";
								document.getElementById("f_padCedula"+linea).disabled=true;
							}
						}
					});
				}
				else
				{
					NotificaE(\'La cedula debe contener al menos 7 digitos numericos\');
					document.getElementById("haf_padCedula"+linea).className = "form-group has-error";
				}

				loF.txtHacer.value=loF.auxiliarHacer.value;
				loF.txtOperacion.value=loF.auxiliarOpera.value;
			}
		}

		function fpListarPadres(arre)
		{
			$.each(arre, function(a, padres)
			{
	   			i=a+1;
				if (padres.Nombres==null)
				{
					document.getElementById("ntf_EncontroPadre"+i).innerHTML=" No se encuentra registrado";
					document.getElementById("haf_ceduPadres"+i).className = "form-group has-warning";
				}
				else
				{
					document.getElementById("ntf_EncontroPadre"+i).innerHTML=" "+padres.Nombres;
					document.getElementById("f_ceduPadres"+i).value = padres.Cedula;
					document.getElementById("haf_ceduPadres"+i).className = "form-group has-success";
				}
			});

		}

		function fpListarFeligres(arre) {
			
			var liFila=Number(loF.txtFila.value);
			var loTabla = document.getElementById("tabFeligres");

			liFila=liFila+arre.length;
			loF.txtFila.value=liFila;

				

		    $.each(arre, function(a, padrino) {
   			i=a+1;

            var loFila = loTabla.insertRow(a);
            var loCelda1 = loFila.insertCell(0);
            var loCelda2 = loFila.insertCell(1);
            var loCelda3 = loFila.insertCell(2);
            var loCelda4 = loFila.insertCell(3);
            var loCelda5 = loFila.insertCell(4);
            var loCelda6 = loFila.insertCell(5);
            var loCelda7 = loFila.insertCell(6);
            var loCelda8 = loFila.insertCell(7);

		loFila.setAttribute(\'id\',\'estadoTR\'+i);
		if (padrino.Estatus==1)
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
			lof_padCedula.setAttribute(\'onblur\',"this.value=this.value.toUpperCase(); vCampoVacio(this.id); BuscaUnFeli(this.id.substring(11));");
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

			var halof_padTelefono = document.createElement("div"); 
			halof_padTelefono.setAttribute(\'class\',"form-group has-default");
			halof_padTelefono.setAttribute(\'id\',"haf_padTelefono"+i);
			
			var ttiplof_padTelefono = document.createElement("div");
			ttiplof_padTelefono.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padTelefono.setAttribute(\'id\',"ttipf_padTelefono"+i);
			ttiplof_padTelefono.setAttribute(\'style\',"display:none;");

			var lof_padTelefono = document.createElement("input");
			lof_padTelefono.setAttribute(\'type\',"text");
			lof_padTelefono.setAttribute(\'class\',"form-control");
			lof_padTelefono.setAttribute(\'name\',"f_padTelefono"+i);
			lof_padTelefono.setAttribute(\'id\',"f_padTelefono"+i);
			lof_padTelefono.setAttribute(\'value\',loF.f_padTelefono.value);
			lof_padTelefono.setAttribute(\'size\',"8");
			lof_padTelefono.setAttribute(\'placeholder\',"(999)9999999");
			lof_padTelefono.setAttribute(\'onkeypress\',"vSoloTelefono();");
			lof_padTelefono.setAttribute(\'onfocus\',"MaskTelefono(this.id);");
			lof_padTelefono.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padTelefono.setAttribute(\'maxlenght\',"50");

			var halof_padCorreo = document.createElement("div"); 
			halof_padCorreo.setAttribute(\'class\',"form-group has-default");
			halof_padCorreo.setAttribute(\'id\',"haf_padCorreo"+i);
			
			var ttiplof_padCorreo = document.createElement("div");
			ttiplof_padCorreo.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padCorreo.setAttribute(\'id\',"ttipf_padCorreo"+i);
			ttiplof_padCorreo.setAttribute(\'style\',"display:none;");

			var lof_padCorreo = document.createElement("input");
			lof_padCorreo.setAttribute(\'type\',"text");
			lof_padCorreo.setAttribute(\'class\',"form-control");
			lof_padCorreo.setAttribute(\'name\',"f_padCorreo"+i);
			lof_padCorreo.setAttribute(\'id\',"f_padCorreo"+i);
			lof_padCorreo.setAttribute(\'value\',loF.f_padCorreo.value);
			lof_padCorreo.setAttribute(\'size\',"8");
			lof_padCorreo.setAttribute(\'placeholder\',"feligres@correo.com");
			lof_padCorreo.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padCorreo.setAttribute(\'maxlenght\',"50");

			var halof_padParroquia = document.createElement("div"); 
			halof_padParroquia.setAttribute(\'class\',"form-group has-default");
			halof_padParroquia.setAttribute(\'id\',"haf_padParroquia"+i);
			
			var ttiplof_padParroquia = document.createElement("div");
			ttiplof_padParroquia.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padParroquia.setAttribute(\'id\',"ttipf_padParroquia"+i);
			ttiplof_padParroquia.setAttribute(\'style\',"display:none;");


			var lof_padParroquia = document.getElementById("f_padParroquia").cloneNode(true);
			lof_padParroquia.setAttribute(\'name\',"f_padParroquia"+i);
			lof_padParroquia.setAttribute(\'id\',"f_padParroquia"+i);
			lof_padParroquia.setAttribute(\'class\',"form-control");
			lof_padParroquia.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padParroquia.removeAttribute("disabled");


			var lof_padIDPersona = document.createElement("input");
			lof_padIDPersona.setAttribute(\'type\',"hidden");
			lof_padIDPersona.setAttribute(\'name\',"f_padIDPersona"+i);
			lof_padIDPersona.setAttribute(\'id\',"f_padIDPersona"+i);

			var lobtnEstado = document.createElement("button");
            lobtnEstado.setAttribute(\'type\',"button");
            lobtnEstado.setAttribute(\'name\',"btnEstadoFeli"+i);
            lobtnEstado.setAttribute(\'id\',"btnEstadoFeli"+i);
            lobtnEstado.setAttribute(\'class\',"btn btn-default btn-circle");
            lobtnEstado.setAttribute(\'style\',"margin:10px 8px; width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.428571429");

			if (padrino.Estatus=="0")
            {
                lobtnEstado.setAttribute(\'title\',"Click Para Activar el Feligres");
                lobtnEstado.setAttribute(\'onclick\',"fpCambiaEstadoFeli("+padrino.Detalle_Grupocol+",\"activarFeli\","+i+");");
                var lobtnMinus = document.createElement("i");
                lobtnMinus.setAttribute(\'class\',"fa fa-check");
            }
            else
            {
                lobtnEstado.setAttribute(\'title\',"Click Para Desactivar el Feligres");
                lobtnEstado.setAttribute(\'onclick\',"fpCambiaEstadoFeli("+padrino.Detalle_Grupocol+",\"desactivarFeli\","+i+");");
                var lobtnMinus = document.createElement("i");
                lobtnMinus.setAttribute(\'class\',"fa fa-times");
            }


             // CON EL METODO appendChild(); LOS AGREGO A LA CELDA QUE QUIERO

            loCelda1.appendChild(halof_padCedula).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padCedula).appendChild(ttiplof_padCedula).appendChild(lof_padIDPersona);
            loCelda2.appendChild(halof_padNombres).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padNombres).appendChild(ttiplof_padNombres);
            loCelda3.appendChild(halof_padApellidos).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padApellidos).appendChild(ttiplof_padApellidos);
            loCelda4.appendChild(halof_padSexo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padSexo).appendChild(ttiplof_padSexo);
            loCelda5.appendChild(halof_padTelefono).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padTelefono).appendChild(ttiplof_padTelefono);
            loCelda6.appendChild(halof_padCorreo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padCorreo).appendChild(ttiplof_padCorreo);
            loCelda7.appendChild(halof_padParroquia).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padParroquia).appendChild(ttiplof_padParroquia);
 			loCelda8.appendChild(lobtnEstado).appendChild(lobtnMinus);

            document.getElementById("f_padCedula"+i).disabled="true";
   			document.getElementById("f_padCedula"+i).value=padrino.Cedula;
			document.getElementById("f_padNombres"+i).value=padrino.Nombres;
			document.getElementById("f_padNombres"+i).disabled="true";
			document.getElementById("f_padApellidos"+i).value=padrino.Apellidos;
			document.getElementById("f_padApellidos"+i).disabled="true";
			document.getElementById("f_padSexo"+i).value=padrino.Sexo;
			document.getElementById("f_padSexo"+i).disabled="true";
			document.getElementById("f_padTelefono"+i).value=padrino.Telefono;
			document.getElementById("f_padTelefono"+i).disabled="true";
			document.getElementById("f_padCorreo"+i).value=padrino.Correo;
			document.getElementById("f_padCorreo"+i).disabled="true";
			document.getElementById("f_padParroquia"+i).value=padrino.idFparroquiaCodigo;
			document.getElementById("f_padIDPersona"+i).value=padrino.idTpersonas;
			document.getElementById("f_padParroquia"+i).disabled="true";
		
  			});

        }


		function fpAgregar() {
			var liFila=Number(loF.txtFila.value);
						
            var loTabla = document.getElementById("tabFeligres");
            var loFila = loTabla.insertRow(liFila);
            var loCelda1 = loFila.insertCell(0);
            var loCelda2 = loFila.insertCell(1);
            var loCelda3 = loFila.insertCell(2);
            var loCelda4 = loFila.insertCell(3);
            var loCelda5 = loFila.insertCell(4);
            var loCelda6 = loFila.insertCell(5);
            var loCelda7 = loFila.insertCell(6);
            var loCelda8 = loFila.insertCell(7);

			loFila.setAttribute(\'class\',\'active\');


			liFila=liFila+1;
			loF.txtFila.value=liFila;

			var ttipclearfix = document.createElement("div"); 
			ttipclearfix.setAttribute(\'class\',"on-focus clearfix");
			ttipclearfix.setAttribute(\'style\',"position: relative;");

			var lof_padIDPersona = document.createElement("input");
			lof_padIDPersona.setAttribute(\'type\',"hidden");
			lof_padIDPersona.setAttribute(\'name\',"f_padIDPersona"+liFila);
			lof_padIDPersona.setAttribute(\'id\',"f_padIDPersona"+liFila);


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
			lof_padCedula.setAttribute(\'onblur\',"this.value=this.value.toUpperCase(); vCampoVacio(this.id); BuscaUnFeli(this.id.substring(11));");
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

			var halof_padTelefono = document.createElement("div"); 
			halof_padTelefono.setAttribute(\'class\',"form-group has-default");
			halof_padTelefono.setAttribute(\'id\',"haf_padTelefono"+liFila);
			
			var ttiplof_padTelefono = document.createElement("div");
			ttiplof_padTelefono.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padTelefono.setAttribute(\'id\',"ttipf_padTelefono"+liFila);
			ttiplof_padTelefono.setAttribute(\'style\',"display:none;");

			var lof_padTelefono = document.createElement("input");
			lof_padTelefono.setAttribute(\'type\',"text");
			lof_padTelefono.setAttribute(\'class\',"form-control");
			lof_padTelefono.setAttribute(\'name\',"f_padTelefono"+liFila);
			lof_padTelefono.setAttribute(\'id\',"f_padTelefono"+liFila);
			lof_padTelefono.setAttribute(\'value\',loF.f_padTelefono.value);
			lof_padTelefono.setAttribute(\'size\',"8");
			lof_padTelefono.setAttribute(\'placeholder\',"(999)9999999");
			lof_padTelefono.setAttribute(\'onkeypress\',"vSoloTelefono();");
			lof_padTelefono.setAttribute(\'onfocus\',"MaskTelefono(this.id);");
			lof_padTelefono.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padTelefono.setAttribute(\'maxlenght\',"50");

			var halof_padCorreo = document.createElement("div"); 
			halof_padCorreo.setAttribute(\'class\',"form-group has-default");
			halof_padCorreo.setAttribute(\'id\',"haf_padCorreo"+liFila);
			
			var ttiplof_padCorreo = document.createElement("div");
			ttiplof_padCorreo.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padCorreo.setAttribute(\'id\',"ttipf_padCorreo"+liFila);
			ttiplof_padCorreo.setAttribute(\'style\',"display:none;");

			var lof_padCorreo = document.createElement("input");
			lof_padCorreo.setAttribute(\'type\',"text");
			lof_padCorreo.setAttribute(\'class\',"form-control");
			lof_padCorreo.setAttribute(\'name\',"f_padCorreo"+liFila);
			lof_padCorreo.setAttribute(\'id\',"f_padCorreo"+liFila);
			lof_padCorreo.setAttribute(\'value\',loF.f_padCorreo.value);
			lof_padCorreo.setAttribute(\'size\',"8");
			lof_padCorreo.setAttribute(\'placeholder\',"feligres@correo.com");
			lof_padCorreo.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padCorreo.setAttribute(\'maxlenght\',"50");

			var halof_padParroquia = document.createElement("div"); 
			halof_padParroquia.setAttribute(\'class\',"form-group has-default");
			halof_padParroquia.setAttribute(\'id\',"haf_padParroquia"+liFila);
			
			var ttiplof_padParroquia = document.createElement("div");
			ttiplof_padParroquia.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padParroquia.setAttribute(\'id\',"ttipf_padParroquia"+liFila);
			ttiplof_padParroquia.setAttribute(\'style\',"display:none;");


			var lof_padParroquia = document.getElementById("f_padParroquia").cloneNode(true);
			lof_padParroquia.setAttribute(\'name\',"f_padParroquia"+liFila);
			lof_padParroquia.setAttribute(\'id\',"f_padParroquia"+liFila);
			lof_padParroquia.setAttribute(\'class\',"form-control");
			lof_padParroquia.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padParroquia.removeAttribute("disabled");

			var lobtnQuitar = document.createElement("button");
			lobtnQuitar.setAttribute(\'name\',"btnQuitar"+liFila);
			lobtnQuitar.setAttribute(\'id\',"btnQuitar"+liFila);
			lobtnQuitar.setAttribute(\'class\',"btn btn-default btn-circle");
			lobtnQuitar.setAttribute(\'style\',"margin:10px 8px; width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.428571429");
			lobtnQuitar.setAttribute(\'onclick\',"fpQuitar(this);");

			var lob_iconoboton = document.createElement("i");
			lob_iconoboton.setAttribute(\'class\',"fa fa-minus");


			var lof_padIDPersona = document.createElement("input");
			lof_padIDPersona.setAttribute(\'type\',"hidden");
			lof_padIDPersona.setAttribute(\'name\',"f_padIDPersona"+liFila);
			lof_padIDPersona.setAttribute(\'id\',"f_padIDPersona"+liFila);

			
			
             // CON EL METODO appendChild(); LOS AGREGO A LA CELDA QUE QUIERO

            loCelda1.appendChild(halof_padCedula).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padCedula).appendChild(ttiplof_padCedula).appendChild(lof_padIDPersona);
            loCelda2.appendChild(halof_padNombres).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padNombres).appendChild(ttiplof_padNombres);
            loCelda3.appendChild(halof_padApellidos).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padApellidos).appendChild(ttiplof_padApellidos);
            loCelda4.appendChild(halof_padSexo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padSexo).appendChild(ttiplof_padSexo);
            loCelda5.appendChild(halof_padTelefono).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padTelefono).appendChild(ttiplof_padTelefono);
            loCelda6.appendChild(halof_padCorreo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padCorreo).appendChild(ttiplof_padCorreo);
            loCelda7.appendChild(halof_padParroquia).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padParroquia).appendChild(ttiplof_padParroquia);
            loCelda8.appendChild(lobtnQuitar).appendChild(lob_iconoboton);

            
			// document.getElementById("f_padCedula"+liFila).focus();
        }

        function fpQuitar(poB)
        {
			var liFila=Number(loF.txtFila.value);
			liLinea=poB.name.substring(9);
			liN=Number(liLinea);
			liN=liN-1;
            document.getElementById("tabFeligres").deleteRow(liN);
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
				document.getElementById("f_padParroquia"+liY).name="f_padParroquia"+liA;
				document.getElementById("f_padParroquia"+liY).id="f_padParroquia"+liA;
				document.getElementById("btnQuitar"+liY).name="btnQuitar"+liA;
				document.getElementById("btnQuitar"+liY).id="btnQuitar"+liA;

			}
            liFila=liFila-1;
			loF.txtFila.value=liFila;
        }
       
        function fpEliminaFilas()
        {

        var liFila=Number(loF.txtFila.value);
			if (liFila>0)
			{

	        	for(i=0;i<liFila;i++)
	            {

	            	document.getElementById("tabFeligres").deleteRow(0);

	        	}
				loF.txtFila.value=0;
			}
        }
		
        function buscar_like(e){
			var parametros = "?AccionGet=buscar_like&txtcadena="+e.value;
			var url = "../cntller/cn_apostoladoFeligres.php";
			consulta_ajax(url,parametros);
			document.getElementById("cargar").innerHTML = document.getElementById("temporal").value;
		}

</script>



</html>
'); 






?>
