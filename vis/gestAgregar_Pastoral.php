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
		<title>'.$_SESSION['title'].' - Inscripción de Feligreses en Pastoral</title>
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
	
	<form name="fr_Pastoral" id="fr_Pastoral" action="../con/cn_matrimonio.php" method="post">
		<div class="col-lg-12">
			<input type="hidden" id="temporal"/>
				<table class="table table-striped table-bordered table-hover"  border="1" >
					<thead>		
						<tr>
							<th colspan="2"><center><div class="alert alert-info" id="divf_cambiaMatri"><font id="ntf_cambiaMatri" onclick="accionEstados(this.id)">Inscripción de Feligreses en Pastoral</font><br><i id="CargaReporteIco" style="display:none;" class="fa fa-circle-o-notch fa-spin"></i></div></center></th>
						</tr>
					</thead>
				<tr>
					<th>
						<div class="form-group has-default" id="hacmb_Pastoral"><div class="on-focus clearfix" style="position: relative;"><span class="control-label" style="margin-right:2px;font-size:18px;color:red;">*</span><font class="control-label">Pastoral:</font><select id="cmb_Pastoral" name="cmb_Pastoral" class="form-control"  onblur="vCampoVacio(this.id);" onchange="fpCombosDireccion(\'Parroquia\')"><option value="0">Seleccione Pastoral</option>
						');
						echo utf8_decode($loFuncion->fncreateComboSelect("tpastoral", "","codigoPastoral","", ' ',"","nombre", $selecttpastoral,"", "", "")); 
						echo utf8_Decode('</select><div class="tool-tip  slideIn" id="ttipcmb_Pastoral" style="display:none;"></div></div></div>
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
										<th align="center" ><font class="control-label">Tipo:</font><br>
											<select class="form-control" name="f_padriTipo" id="f_padriTipo" class="form-control" value="" disabled><option value=""><p><strong></strong></p></option><option value="C"><p><strong>Celestial</strong></p></option><option value="T"><p><strong>De tierra</strong></p></option></select>
										</th>
										<th align="center" >		
											<button type="button" name="btnAgregar" style="margin:10px 8px; width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.428571429" class="btn btn-default btn-circle" onclick="fpAgregar()"><i class="fa fa-plus"></i></button>
										</th>

									</tr>
									
		</table>

<table align="center" border="1" name="tabPadrinos" id="tabPadrinos" class="table table-striped table-bordered table-hover">


</table>

<br>



</div>
	</div>
	<div class="container" style="margin-top:5px; padding:5px; min-height: auto; background: #FFFFFF; -webkit-box-shadow: 0px 2px 5px 2px #999; -moz-box-shadow: 2px 2px 5px #999;">
		<table class="table table-striped table-bordered table-hover" border="1" style="margin:0px">	
		<tr>
			<th colspan="2">
			<div class="controls form-inline">
					<center style="margin-right:27%">
					<input type="text" size="10" maxlength="30" id="f_refGrupoApostolado" name="f_refGrupoApostolado" placeholder="Referencia del Pastoral" class="form-control" value="" style="margin-right:7%;width:26%" onkeypress="vSoloNumeros();" disabled>
					<input type="hidden" name="txtOperacion" id="txtOperacion" value="">
					<input type="hidden" name="txtHacer" id="txtHacer" value="">
					<input type="hidden" name="txtHay" id="txtHay" value="">
					<input type="hidden" name="KestadoActual" id="KestadoActual" value="">
					<input type="hidden" name="txtFila" value="0">
					<input type="hidden" name="CIpadriAlter" value="0">
					<input type="hidden" name="auxiliarHacer" value="">
					<input type="hidden" name="auxiliarOpera" value="">
					<input type="hidden" name="auxiliarPadrino" value="">
					<input type="button" class="btn btn-default" name="b_Nuevo" value="Nuevo" onclick="fpNuevo()">
					<input type="button" class="btn btn-default" name="b_Modificar" value="Modificar" onclick="fpModificar()">
					<input type="button" class="btn btn-default" name="b_Buscar" value="Buscar" onclick="fpBuscarLike()">
					<input type="button" class="btn btn-default" name="b_Eliminar" value="Estado" disabled>
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
	var loF=document.fr_Pastoral;
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
			loF.f_cedunovia.focus();
		}
		
		function fpEncender()
		{
			var liFila=Number(loF.txtFila.value);
			loF.cmb_Pastoral.disabled=false;
			loF.btnAgregar.disabled=false;

			for(liY=1;liY<=liFila;liY++)
            {
			
				document.getElementById("f_padNombres"+liY).disabled=false;
				document.getElementById("f_padApellidos"+liY).disabled=false;
				document.getElementById("f_padSexo"+liY).disabled=false;
				document.getElementById("f_padriTipo"+liY).disabled=false;
			}

			
		}

				
		
		function fpEnciendeCampos()
		{
			loF.cmb_Pastoral.disabled=false;
			var liFila=Number(loF.txtFila.value);
			for(liY=1;liY<=liFila;liY++)
	        {
	        QuitarMask("f_padCedula"+liY);
			document.getElementById("f_padCedula"+liY).disabled=false;
			document.getElementById("f_padNombres"+liY).disabled=false;
			document.getElementById("f_padApellidos"+liY).disabled=false;
			document.getElementById("f_padSexo"+liY).disabled=false;
			}
		}
		function fpApagar()
		{
			var liFila=Number(loF.txtFila.value);
			loF.cmb_Pastoral.disabled=true;

			loF.btnAgregar.disabled=true;
		    for(liY=1;liY<=liFila;liY++)
            {
				document.getElementById("f_padCedula"+liY).disabled=true;
				document.getElementById("f_padNombres"+liY).disabled=true;
				document.getElementById("f_padApellidos"+liY).disabled=true;
				document.getElementById("f_padSexo"+liY).disabled=true;
				document.getElementById("f_padriTipo"+liY).disabled=true;
			}
			
			document.getElementById("ntf_cambiaMatri").innerHTML="Registro de Feligreses a Pastoral";
			document.getElementById("divf_cambiaMatri").className = "alert alert-info";
			loF.b_Eliminar.disabled=true;	
		}

		function fpCancelar()
		{
			var liFila=Number(loF.txtFila.value);
			loF.txtOperacion.value="";
			loF.txtHacer.value="";
			loF.txtHay.value=0;
			loF.cmb_Pastoral.value=0;		
			document.getElementById("hacmb_Pastoral").className = "form-group has-default";

			loF.auxiliarHacer.value="buscar";		
			fpEliminaFilas();
			fpApagar();
			fpInicial();
			loF.KestadoActual.value=9;
			fpEstadoActual();
			

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
			

			loF.cmb_Pastoral.value=lke.nvaGrupoApostolado.value;
			loF.txtOperacion.value="buscar";
			loF.txtHacer.value="buscar";
			loF.txtHay.value="0";
			fpPerderFocus(loF.f_cedunovia);

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
			loF.cmb_Pastoral.disabled=false;
			loF.cmb_Pastoral.focus();
			fpCambioB();
			
		}

		function fpPerderFocus(Rcampo)
		{
		var obje="";
			
			if(loF.txtHacer.value=="buscar")
			{
				
						
				var $forme = $("#fr_Pastoral");

					$.ajax({
						url: \'../cntller/cn_matrimonio.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var apostolo=data[\'Matri\'];
           					var padres=data[\'Padres\'];
           					var padrinos=data[\'Padri\'];
							if((apostolo.lsIglesia!="")&&(apostolo.lsGrupoApostolado!=""))
							{
								loF.f_refGrupoApostolado.value=apostolo.lsMatriS;
								if((apostolo.lsIglesia!="")&&(apostolo.lsGrupoApostolado!=""))
								{
									
									loF.cmb_Pastoral.value = apostolo.lsGrupoApostolado;
					
								}
																		
												
								if ((loF.txtHacer.value=="buscar")&&(apostolo.liHay==1))
								{
									loF.KestadoActual.value = apostolo.lsedomatri;
									fpCambioE();
									fpApagar();
								fpEstadoActual();

									
								}
																
							}

							if ((loF.txtOperacion.value=="buscar")&&(apostolo.liHay==0))
							{
								NotificaE("No se encontro ningun Pastoral activo con la Referencia ingresada");
								Rcampo.value="";
								Rcampo.focus();
							}

							if((loF.txtOperacion.value=="incluir")&&(loF.txtHacer.value=="buscar")&&(apostolo.liHay==1)) 
							{
									loF.txtOperacion.value="incluir";
									loF.auxiliarHacer.value="buscar";
									loF.txtHay.value=0;

							}

						
							if(padrinos)
							{
								fpListarPadri(padrinos);
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
				loF.f_refGrupoApostolado.disabled=false;
				var $forme = $("#fr_Pastoral");

					$.ajax(
					{
						url: \'../cntller/cn_matrimonio.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
				        	var apostolo=data[\'Matri\'];
           					var padrinos=data[\'Padri\'];
							if((apostolo.liHay!=""))
							{
								if ((loF.txtHacer.value=="incluir")&&(apostolo.liHay==0))
								{
									NotificaE("El Registro no pudo ser incluido.");


								}

								if ((loF.txtHacer.value=="incluir")&&(apostolo.liHay==1))
								{

									NotificaS("Registro incluido con exito. Numero de Referencia: "+apostolo.lsMatriS);
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

								if ((loF.txtHacer.value=="modificar")&&(apostolo.liHay==2))
								{
									NotificaE("El Registro no pudo ser modificado.");


								}


							}
						}
					});
			}
			
		}
		
		function fbValidar()
		{
			var lbValido=false;
			var vInvalido=0;
			if(loF.cmb_Pastoral.value=="0")
			{
				loF.cmb_Pastoral.focus();
				vCampoVacio("cmb_Pastoral");
				vInvalido=1;
			}
			if (vInvalido==0)
			{
				lbValido=fbValidaPadrinos();
			}
			else if (vInvalido==3)
			{
				
				lbValido=fbValidaPadrinos();
				
			}
			return lbValido;
		}

		function fbValidaPadrinos()
		{
			var lbValido=false;
			var vInvalido=0;
			var vPadriTipoC=0;

			var liFila=Number(loF.txtFila.value);
			
	            for(liY=1;liY<=liFila;liY++)
	            {
	            	
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
					if(document.getElementById("f_padriTipo"+liY).value=="")
					{
						document.getElementById("f_padriTipo"+liY).focus();
						vCampoVacio("f_padriTipo"+liY);
						vInvalido=1;
					}
					else
					{
						if(document.getElementById("f_padriTipo"+liY).value=="C")
						{
							vPadriTipoC++;
						}
					}
				}
				if(vInvalido==0)
				{
					if (vPadriTipoC<2)
					{
						NotificaE("Debe asignar al menos 2 Padrinos Celestiales para poder Guardar");
					}
					else
					{
						lbValido=true;
					}
				}
			
		
			return lbValido;
		}
		
		function fpModificar()
		{
			fpEncender();
			fpCambioN();
			loF.txtOperacion.value="modificar";
			loF.txtHacer.value="modificar";
			loF.txtHay.value=0;
			loF.cmb_Pastoral.disabled=true;
			loF.cmb_Pastoral.focus();
		}
		
		function fpEstadoActual()
		{
			loF.b_Eliminar.disabled=true;
			var KedoActual=loF.KestadoActual.value;
			if(KedoActual==0)
			{
				loF.b_Eliminar.value="Pendiente";

			}
			else if(KedoActual==1)
			{
				loF.b_Eliminar.value="Casado";

			}
			else if(KedoActual==2)
			{
				loF.b_Eliminar.value="Suspendido";
			}
			else if(KedoActual==3)
			{
				loF.b_Eliminar.value="Anulado";

			}
			else
			{
				loF.b_Eliminar.value="Estado";
			}
		
		}

		function fpDesactivar()
		{
			if (loF.b_Eliminar.value=="Reactivar")
			{
				if(confirm("Desea Reactivar el Registro?"))
				{
					loF.f_cedunovia.disabled=false;
					loF.txtOperacion.value="reactivar";
					loF.txtHacer.value="reactivar";
					loF.f_cedunovia.disabled=false;
					loF.f_cedunovio.disabled=false;
					
					var $forme = $("#fr_Pastoral");

					$.ajax({
						url: \'../cntller/cn_matrimonio.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var apostolo=data[\'Matri\'];
							if(apostolo.liHay==1)
							{
									fpCancelar();
									NotificaS("Registro Reactivado");
									loF.KestadoActual.value=1;
									fpInicial();
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Reactivar el Registro");
									loF.KestadoActual.value=1;
									fpInicial();									
							}
						}
					});


				}
			}
			else
			{
				if(confirm("Desea Desactivar el Registro?"))
				{
					loF.f_cedunovia.disabled=false;
					loF.txtOperacion.value="desactivar";
					loF.txtHacer.value="desactivar";
					loF.f_cedunovia.disabled=false;
					loF.f_cedunovio.disabled=false;

					var $forme = $("#fr_Pastoral");

					$.ajax({
						url: \'../cntller/cn_matrimonio.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data){
				        	var apostolo=data[\'Matri\'];
							if(apostolo.liHay==1)
							{
									fpCancelar();
									NotificaS("Registro Desactivado");
									loF.KestadoActual.value=1;
									fpInicial();							
							}
							else	
							{
									fpCancelar();
									NotificaE("No se pudo Desactivar el Registro, solo se puede desactivar si el mismo no se ha llevado a cabo.");
									loF.KestadoActual.value=1;
									fpInicial();									
							}
						}
					});

				}
			}
		}

		function BuscaUnPadri(linea)
		{
			loF.auxiliarHacer.value=loF.txtHacer.value;
			loF.auxiliarOpera.value=loF.txtOperacion.value;
			var cedupadri=document.getElementById("f_padCedula"+linea).value.split(\' \').join(\'\');
			loF.txtOperacion.value="buscarPadri";
			var prosigue = 0;
			loF.txtHacer.value="buscarPadri";
			document.getElementById("f_padCedula"+linea).disabled=false;
			var ceduNovia=loF.f_cedunovia.value.trim();
			var ceduNovio=loF.f_cedunovio.value.trim();
			var ceduPad=document.getElementById("f_padCedula"+linea).value.trim();

			if ((ceduPad==ceduNovia)&&(ceduNovia!="")||(ceduPad==ceduNovio)&&(ceduNovio!=""))
			{
				document.getElementById("f_padCedula"+linea).value="";
				document.getElementById("f_padCedula"+linea).focus();
				NotificaE("No puede registrar el mismo contrayente como testigo.");
				prosigue = 1;
			}
			if ((cedupadri.length>5)&&(prosigue==0))
			{
				loF.auxiliarPadrino.value=cedupadri;
				var $forme = $("#fr_Pastoral");

				$.ajax({
					url: \'../cntller/cn_matrimonio.php\',
					dataType: \'json\',
					type: \'post\',
					data: $forme.serialize(),
			        success: function(data){
			        	var Matri=data[\'Matri\']
			        	var PerPadri=data[\'PersoPadri\'];
						if((Matri.liHay==1)&&(Matri.lsHacer=="buscarPadri"))
						{
							document.getElementById("haf_padCedula"+linea).className = "form-group has-warning";				
							document.getElementById("f_padCedula"+linea).value = PerPadri.lscedu;
							document.getElementById("f_padNombres"+linea).value = PerPadri.lsNomb;
							document.getElementById("f_padApellidos"+linea).value = PerPadri.lsApel;
							document.getElementById("f_padSexo"+linea).value = PerPadri.lsSexo;
							document.getElementById("f_padCedula"+linea).disabled = true;
							document.getElementById("f_padNombres"+linea).disabled = true;
							document.getElementById("f_padApellidos"+linea).disabled = true;
							document.getElementById("f_padSexo"+linea).disabled = true;
							document.getElementById("haf_padNombres"+linea).className = "form-group has-default";
							document.getElementById("haf_padApellidos"+linea).className = "form-group has-default";
							document.getElementById("haf_padSexo"+linea).className = "form-group has-default";
							document.getElementById("haf_padriTipo"+linea).className = "form-group has-default";

						}
						else	
						{
							document.getElementById("haf_padCedula"+linea).className = "form-group has-success";
						}
					}
				});
			}
			else
			{
				document.getElementById("haf_padCedula"+linea).className = "form-group has-error";
			}

		loF.txtHacer.value=loF.auxiliarHacer.value;
		loF.txtOperacion.value=loF.auxiliarOpera.value;
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

		function fpListarPadri(arre) {
			
			var liFila=Number(loF.txtFila.value);
			var loTabla = document.getElementById("tabPadrinos");

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


if (padrino.EstatusPadri==1)
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
			lof_padCedula.setAttribute(\'onblur\',"this.value=this.value.toUpperCase(); vCampoVacio(this.id); BuscaUnPadri(this.id.substring(11));");
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

			var halof_padriTipo = document.createElement("div"); 
			halof_padriTipo.setAttribute(\'class\',"form-group has-default");
			halof_padriTipo.setAttribute(\'id\',"haf_padriTipo"+i);
			
			var ttiplof_padriTipo = document.createElement("div");
			ttiplof_padriTipo.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padriTipo.setAttribute(\'id\',"ttipf_padriTipo"+i);
			ttiplof_padriTipo.setAttribute(\'style\',"display:none;");


			var lof_padriTipo = document.getElementById("f_padriTipo").cloneNode(true);
			lof_padriTipo.setAttribute(\'name\',"f_padriTipo"+i);
			lof_padriTipo.setAttribute(\'id\',"f_padriTipo"+i);
			lof_padriTipo.setAttribute(\'class\',"form-control");
			lof_padriTipo.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padriTipo.removeAttribute("disabled");


             // CON EL METODO appendChild(); LOS AGREGO A LA CELDA QUE QUIERO

            loCelda1.appendChild(halof_padCedula).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padCedula).appendChild(ttiplof_padCedula);
            loCelda2.appendChild(halof_padNombres).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padNombres).appendChild(ttiplof_padNombres);
            loCelda3.appendChild(halof_padApellidos).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padApellidos).appendChild(ttiplof_padApellidos);
            loCelda4.appendChild(halof_padSexo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padSexo).appendChild(ttiplof_padSexo);
            loCelda5.appendChild(halof_padriTipo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padriTipo).appendChild(ttiplof_padriTipo);

            document.getElementById("f_padCedula"+i).disabled="true";
   			document.getElementById("f_padCedula"+i).value=padrino.Cedula;
   			document.getElementById("f_padCedula"+i).disabled="true";
			document.getElementById("f_padNombres"+i).value=padrino.Nombres;
			document.getElementById("f_padNombres"+i).disabled="true";
			document.getElementById("f_padApellidos"+i).value=padrino.Apellidos;
			document.getElementById("f_padApellidos"+i).disabled="true";
			document.getElementById("f_padSexo"+i).value=padrino.Sexo;
			document.getElementById("f_padSexo"+i).disabled="true";
			document.getElementById("f_padriTipo"+i).value=padrino.TipoPadri;
			document.getElementById("f_padriTipo"+i).disabled="true";
		
  		
  			});

        }


		function fpAgregar() {
			var liFila=Number(loF.txtFila.value);
						
            var loTabla = document.getElementById("tabPadrinos");
            var loFila = loTabla.insertRow(liFila);
            var loCelda1 = loFila.insertCell(0);
            var loCelda2 = loFila.insertCell(1);
            var loCelda3 = loFila.insertCell(2);
            var loCelda4 = loFila.insertCell(3);
            var loCelda5 = loFila.insertCell(4);
            var loCelda6 = loFila.insertCell(5);

			loFila.setAttribute(\'class\',\'active\');


			liFila=liFila+1;
			loF.txtFila.value=liFila;

			var ttipclearfix = document.createElement("div"); 
			ttipclearfix.setAttribute(\'class\',"on-focus clearfix");
			ttipclearfix.setAttribute(\'style\',"position: relative;");

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
			lof_padCedula.setAttribute(\'onblur\',"this.value=this.value.toUpperCase(); vCampoVacio(this.id); BuscaUnPadri(this.id.substring(11));");
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

			var halof_padriTipo = document.createElement("div"); 
			halof_padriTipo.setAttribute(\'class\',"form-group has-default");
			halof_padriTipo.setAttribute(\'id\',"haf_padriTipo"+liFila);
			
			var ttiplof_padriTipo = document.createElement("div");
			ttiplof_padriTipo.setAttribute(\'class\',"tool-tip  slideIn");
			ttiplof_padriTipo.setAttribute(\'id\',"ttipf_padriTipo"+liFila);
			ttiplof_padriTipo.setAttribute(\'style\',"display:none;");


			var lof_padriTipo = document.getElementById("f_padriTipo").cloneNode(true);
			lof_padriTipo.setAttribute(\'name\',"f_padriTipo"+liFila);
			lof_padriTipo.setAttribute(\'id\',"f_padriTipo"+liFila);
			lof_padriTipo.setAttribute(\'class\',"form-control");
			lof_padriTipo.setAttribute(\'onblur\',"vCampoVacio(this.id);");
			lof_padriTipo.removeAttribute("disabled");

			var lobtnQuitar = document.createElement("button");
			lobtnQuitar.setAttribute(\'name\',"btnQuitar"+liFila);
			lobtnQuitar.setAttribute(\'id\',"btnQuitar"+liFila);
			lobtnQuitar.setAttribute(\'class\',"btn btn-default btn-circle");
			lobtnQuitar.setAttribute(\'style\',"margin:10px 8px; width: 30px; height: 30px; padding: 6px 0px; border-radius: 15px; text-align: center; font-size: 12px; line-height: 1.428571429");
			lobtnQuitar.setAttribute(\'onclick\',"fpQuitar(this);");

			var lob_iconoboton = document.createElement("i");
			lob_iconoboton.setAttribute(\'class\',"fa fa-minus");
			
			
             // CON EL METODO appendChild(); LOS AGREGO A LA CELDA QUE QUIERO

            loCelda1.appendChild(halof_padCedula).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padCedula).appendChild(ttiplof_padCedula);
            loCelda2.appendChild(halof_padNombres).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padNombres).appendChild(ttiplof_padNombres);
            loCelda3.appendChild(halof_padApellidos).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padApellidos).appendChild(ttiplof_padApellidos);
            loCelda4.appendChild(halof_padSexo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padSexo).appendChild(ttiplof_padSexo);
            loCelda5.appendChild(halof_padriTipo).appendChild(ttipclearfix.cloneNode(false)).appendChild(lof_padriTipo).appendChild(ttiplof_padriTipo);
            loCelda6.appendChild(lobtnQuitar).appendChild(lob_iconoboton);

            
			// document.getElementById("f_padCedula"+liFila).focus();
        }

        function fpQuitar(poB)
        {
			var liFila=Number(loF.txtFila.value);
			liLinea=poB.name.substring(9);
			liN=Number(liLinea);
			liN=liN-1;
            document.getElementById("tabPadrinos").deleteRow(liN);
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
				document.getElementById("f_padriTipo"+liY).name="f_padriTipo"+liA;
				document.getElementById("f_padriTipo"+liY).id="f_padriTipo"+liA;
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

	            	document.getElementById("tabPadrinos").deleteRow(0);

	        	}
				loF.txtFila.value=0;
			}
        }
		
        function buscar_like(e){
			var parametros = "?AccionGet=buscar_like&txtcadena="+e.value;
			var url = "../cntller/cn_matrimonio.php";
			consulta_ajax(url,parametros);
			document.getElementById("cargar").innerHTML = document.getElementById("temporal").value;
		}

</script>



</html>
'); 






?>
