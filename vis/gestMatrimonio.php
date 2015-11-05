<?php


  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
	if (($_SESSION["rol"]=="O")||($_SESSION["rol"]=="A"))
	{
		$_SESSION["message"]="Usted no tiene los accesos para realizar esa accion.";
		header("location: ../index.php");
	}
	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion = new clsFunciones;



	if (!empty($_POST["MatriEdo"])&&isset($_POST["MatriEdo"]))
	{
		$lsnvaCedula=$_POST["nvaCedula"];
		$lsnvoCedula=$_POST["nvoCedula"];
		$lsNvaNombre=$_POST["NvaNombre"];
		$lsNvoNombre=$_POST["NvoNombre"];
		$lsMatriSacer=$_POST["MatriSacer"];
		$lsMatriFecha=$_POST["MatriFecha"];
		$lsMatriMotivo=$_POST["MatriMotivo"];
		$lsMatriEdo=$_POST["MatriEdo"];
		$lsMatriEdoNum=$_POST["MatriEdoNum"];
	}

	$activaMotivo="disabled";
	if($lsnvaCedula!="")
	{
		$activaMotivo="";
	}




	echo utf8_Decode('

<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Gestión de Matrimonios</title>
		');
			print(encabezado_menu("../"));

	echo utf8_Decode('
		</head>
		<body onload="fpInicio();">
		<div class="mygrid-wrapper-div">
	<div class="container pre-scrollable" style="margin-top:5px; min-height: 530px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">
<div id="mascara"></div>
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
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="salir();">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>

		');
		encab("../");
		menu_general("");
		
echo utf8_Decode('
	
	<form name="fr_matrimonio" id="fr_matrimonio" action="../con/cn_matrimonio.php" method="post">
		<div class="col-lg-12">
			<input type="hidden" id="temporal"/>
				<table class="table table-striped table-bordered table-hover"  border="1" >
					<thead>		
						<tr>
							<th colspan="2"><center><div class="alert alert-info" id="divf_cambiaMatri"><font id="ntf_cambiaMatri">Gestión de Matrimonios</font><br><i id="CargaReporteIco" style="display:none;" class="fa fa-circle-o-notch fa-spin"></i></div></center></th>
						</tr>
					</thead>
				<tr>
					<th><font class="control-label" id="ntf_EncontroNovia">Novia:</font><br><font class="control-label" id="f_cedunovia"></font></th>
					<th><font class="control-label" id="ntf_EncontroNovio">Novio:</font><br><font class="control-label" id="f_cedunovio"></font></th>
				</tr>
				<!--
				<tr>
					<th><font class="control-label">Madre de la Novia:</font><br><font class="control-label" id="ntf_EncontroPadre1"></font></th>
					<th><font class="control-label">Madre del Novio:</font><br><font class="control-label" id="ntf_EncontroPadre3"></font></th>
				</tr>
				<tr>
					<th><font class="control-label">Padre de la Novia:</font><br><font class="control-label" id="ntf_EncontroPadre2"></font></th>
					<th><font class="control-label">Padre del Novio:</font><br><font class="control-label" id="ntf_EncontroPadre4"></font></th>..
				</tr>
				-->
				<tr>
					<th>
						<font class="control-label">Sacerdote:</font><br><font class="control-label" id="f_sacerdote"></font>
					</th>
					<th>
						<font class="control-label">Fecha de el Matrimonio:</font><br><font class="control-label" id="f_fechamatrimonio">'.$lsMatriFecha.'</font></th>
					</th>
				</tr>
				<tr>
					<th colspan="2"><center><span id="EstadoAparece"></span><div class="form-group has-default" id="haf_motivo"><div class="on-focus clearfix" style="position: relative;"><font class="control-label">Motivo:</font><textarea name="f_motivo" id="f_motivo" class="form-control" style="resize:none; overflow-y:scroll; height:40px;width:500px;" maxlenght="150" onblur="vCampoVacio(this.id);"></textarea><div class="tool-tip  slideIn" id="ttipf_motivo" style="display:none;"></div></div></div></center></th>
				</tr>
				<tr>
					<th colspan="2"><center>

					<input type="hidden" name="txtOperacion" id="txtOperacion" value="">
					<input type="hidden" name="txtHay" id="txtHay" value="">
					<input type="hidden" name="h_cedunovia" id="h_cedunovia" value="">
					<input type="hidden" name="h_cedunovio" id="h_cedunovio" value="">
					<input type="hidden" name="f_refMatrimonio" id="f_refMatrimonio" value="">

					<input type="button" class="btn btn-info" name="b_Pendiente" value="Pendiente" onclick="fpGestionMatri(0)">
					<input type="button" class="btn btn-success" name="b_Casar" value="Casar" onclick="fpGestionMatri(1)">
					<input type="button" class="btn btn-warning" name="b_Suspender" value="Suspender" onclick="fpGestionMatri(2)">
					<input type="button" class="btn btn-danger" name="b_Anular" value="Anular" onclick="fpGestionMatri(3)">



					</center></th>						
				</tr>
		</table>
<br>

</div>
	</div>
	<div class="container" style="margin-top:5px; padding:5px; min-height: auto; background: #FFFFFF; -webkit-box-shadow: 0px 2px 5px 2px #999; -moz-box-shadow: 2px 2px 5px #999;">
		<table class="table table-striped table-bordered table-hover" border="1" style="margin:0px">	
		<tr>
			<th colspan="2"><center>
					<input type="button" class="btn btn-default" name="b_Buscar" value="Buscar" onclick="buscar()">
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
	var loF=document.fr_matrimonio;

function fpInicialMatri()
{
	loF.b_Pendiente.disabled=true;
	loF.b_Casar.disabled=true;
	loF.b_Suspender.disabled=true;
	loF.b_Anular.disabled=true;
	loF.b_Buscar.disabled=false;
	loF.b_Cancelar.disabled=true;
	fpApagar();
}

function fpCambioBMatri()
{
	loF.b_Pendiente.disabled=true;
	loF.b_Casar.disabled=true;
	loF.b_Suspender.disabled=true;
	loF.b_Anular.disabled=true;
	loF.b_Buscar.disabled=true;
	loF.b_Cancelar.disabled=false;

}


	function fpInicio()
	{	
				
		fpInicialMatri();
	}
		
		function fpEncender()
		{

			document.getElementById("f_cedunovia").innerHTML="";
			document.getElementById("f_cedunovio").innerHTML="";
			document.getElementById("f_sacerdote").innerHTML="";
			document.getElementById("f_fechamatrimonio").innerHTML="";
			document.getElementById("f_sacerdote").innerHTML="";
			document.getElementById("f_fechamatrimonio").innerHTML="";

		
		}
		function vValidaTodosDatos()
		{
			var result=false;
			

			return true;
		}
		function accionEstados(estadoid,refer)
		{
			var valorEstado = document.getElementById(estadoid).innerHTML;
				if(vValidaTodosDatos())
				{
					if (valorEstado=="Pendiente")
					{
					$("#CargaReporteIco").css("display","inline");
						setTimeout(function(){ window.location=\'reportes/reporteInscriMatrimonio.php?RPrefMatri=\'+refer; }, 1000);
						
					}
				}
				else
				{
					NotificaE("Debe completar los campos obligatorios antes de imprimir algun reporte");
				}
		}
		function fpEnciendeCI()
		{
			loF.f_cedunovio.disabled=false;
			loF.f_cedunovia.disabled=false;
			QuitarMask("f_cedunovio");
			QuitarMask("f_cedunovia");
		}
		function fpApagar()
		{
			document.getElementById("f_cedunovia").innerHTML="";
			document.getElementById("f_cedunovio").innerHTML="";
			document.getElementById("f_sacerdote").innerHTML="";
			document.getElementById("f_fechamatrimonio").innerHTML="";
			document.getElementById("f_sacerdote").innerHTML="";
			document.getElementById("f_fechamatrimonio").innerHTML="";
			loF.f_motivo.disabled=true;

			
			document.getElementById("ntf_cambiaMatri").innerHTML="Gestión de Matrimonios";
			document.getElementById("divf_cambiaMatri").className = "alert alert-info";

		}
		
		function fpCancelar()
		{
			loF.txtOperacion.value="";
			loF.txtHay.value=0;
			loF.f_motivo.value="";
			document.getElementById("haf_motivo").className = "form-group has-default";
			document.getElementById("EstadoAparece").innerHTML = "";

			fpApagar();
			fpInicialMatri();
		
		
			
		}

		function buscar()
		{
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");

			mas.style.display = "block";
			bus.style.display = "block";

			document.getElementById("txtbuscador").focus();
		}
		function fpCambioE(param)
		{
			switch(param) {
		    case 0:
		    	loF.b_Pendiente.disabled=true;
				loF.b_Casar.disabled=false;
				loF.b_Suspender.disabled=false;
				loF.b_Anular.disabled=false;
		        break;
		    case 1:
			    loF.b_Pendiente.disabled=true;
				loF.b_Casar.disabled=true;
				loF.b_Suspender.disabled=true;
				loF.b_Anular.disabled=false;
				loF.f_motivo.disabled=false;
		        break;
			case 2:
			    loF.b_Pendiente.disabled=false;
				loF.b_Casar.disabled=true;
				loF.b_Suspender.disabled=true;
				loF.b_Anular.disabled=false;
		    	break;
		    case 3:
		    	loF.b_Pendiente.disabled=true;
				loF.b_Casar.disabled=true;
				loF.b_Suspender.disabled=true;
				loF.b_Anular.disabled=true;
		   		break;		    
		   	case 4:
		    	loF.b_Pendiente.disabled=false;
				loF.b_Casar.disabled=true;
				loF.b_Suspender.disabled=true;
				loF.b_Anular.disabled=false;
		   		break;
		   	}
			loF.b_Buscar.disabled=true;
			loF.b_Cancelar.disabled=false;
		}

		function fpSelectLike(idlke)
		{
			var lke = document.getElementById(idlke);
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");
			var EstadoMatrimonio=lke.MatriEdoNum.value;
			if(EstadoMatrimonio==\'4\')
			{
				loF.b_Anular.setAttribute("onclick", "fpGestionMatri(4)");
			}
			else
			{
				loF.b_Anular.setAttribute("onclick", "fpGestionMatri(3)");
			}

			mas.style.display = "none";
			bus.style.display = "none";
			

			loF.h_cedunovia.value=lke.nvaCedula.value;
			loF.h_cedunovio.value=lke.nvoCedula.value;
			loF.f_refMatrimonio.value=lke.MatriS.value;
			loF.f_refMatrimonio.disabled=false;
			fpCambioE(Number(lke.MatriEdoNum.value));
			document.getElementById("f_cedunovia").innerHTML=lke.NvaNombre.value+" ("+lke.nvaCedula.value+")";
			document.getElementById("f_cedunovio").innerHTML=lke.NvoNombre.value+" ("+lke.nvoCedula.value+")";
			document.getElementById("f_sacerdote").innerHTML=lke.MatriSacer.value;
			document.getElementById("EstadoAparece").innerHTML=lke.MatriEdo.value;
			document.getElementById("f_fechamatrimonio").innerHTML=lke.MatriFecha.value;
			loF.f_motivo.value=lke.MatriMotivo.value;


		}

		function salir()
		{
			var mas = document.getElementById("mascara");
			var bus = document.getElementById("buscador");

			mas.style.display = "none";
			bus.style.display = "none";

			fpCancelar();			
		}


		
		
        function buscar_like(e){
			var parametros = "?AccionGet=buscar_like&txtcadena="+e.value;
			var url = "../cntller/cn_matrimonio.php";
			consulta_ajax(url,parametros);
			document.getElementById("cargar").innerHTML = document.getElementById("temporal").value;
		}

		function fpGestionMatri(param)
		{
			var accion="";
			var vInvalido=0;
			switch(param){
		    case 0:
					loF.txtOperacion.value="ToPendiente";
					accion="Activar";
		        break;
		    case 1:
					loF.txtOperacion.value="ToCasar";
					accion="Casar";
		        break;
			case 2:
					if(vCampoVacio("f_motivo"))
					{
						loF.f_motivo.disabled=false;
						loF.f_motivo.focus();
						vInvalido=1;
					}
					else
					{
						loF.txtOperacion.value="ToSuspender";
						accion="Suspender";
					}
		    	break;
		    case 3:
					if(vCampoVacio("f_motivo"))
					{
						loF.f_motivo.disabled=false;
						loF.f_motivo.focus();
						vInvalido=1;
					}
					else
					{
						loF.txtOperacion.value="ToPendienteAnular";
						accion="abrir un proceso de anulacion para";
					}
		   		break;
		   	case 4:
					if(vCampoVacio("f_motivo"))
					{
						loF.f_motivo.disabled=false;
						loF.f_motivo.focus();
						vInvalido=1;
					}
					else
					{
						loF.txtOperacion.value="ToAnular";
						accion="Anular";
					}
		   		break;
		   	}
		   		if (vInvalido==0)
		   		{
					if (confirm("¿Realmente desea "+accion+" este matrimonio?"))
					{
						var $forme = $("#fr_matrimonio");

								$.ajax(
								{
									url: \'../cntller/cn_matrimonio.php\',
									dataType: \'json\',
									type: \'post\',
									data: $forme.serialize(),
							        success: function(data)
							        {
							        	var matrimo=data[\'Matri\'];
			           					var padrinos=data[\'Padri\'];
										if((matrimo.liHay!=""))
										{
											if ((loF.txtOperacion.value=="ToPendiente")&&(matrimo.liHay==0))
											{
													NotificaE("El Matrimonio no pudo ser Reactivado.");
													fpCancelar();
								
											}

											if ((loF.txtOperacion.value=="ToPendiente")&&(matrimo.liHay==1))
											{
													NotificaS("Matrimonio Reactivado con exito.");
													fpCancelar();
										
											}

											if ((loF.txtOperacion.value=="ToPendiente")&&(matrimo.liHay==3))
											{
													NotificaE("El Matrimonio No pudo ser Reactivado porque ya uno de los contrayentes posee un matrimonio activo, el mismo debe ser anulado para poder continuar.");
													fpCancelar();
										
											}

											if ((loF.txtOperacion.value=="ToCasar")&&(matrimo.liHay==0))
											{
													NotificaE("El Matrimonio no pudo ser Actualizado.");
													fpCancelar();
										
											}

											if ((loF.txtOperacion.value=="ToCasar")&&(matrimo.liHay==1))
											{
													NotificaS("Matrimonio Realizado con exito.");
													fpCancelar();
										
											}

											if ((loF.txtOperacion.value=="ToSuspender")&&(matrimo.liHay==0))
											{
													NotificaE("El Matrimonio no pudo ser Suspendido.");
													fpCancelar();
									
											}

											if ((loF.txtOperacion.value=="ToSuspender")&&(matrimo.liHay==1))
											{
													NotificaS("Matrimonio Suspendido con exito.");
													fpCancelar();
												
											}

											if ((loF.txtOperacion.value=="ToAnular")&&(matrimo.liHay==0))
											{
													NotificaE("El Matrimonio no pudo ser Anulado.");
													fpCancelar();
											
											}

											if ((loF.txtOperacion.value=="ToAnular")&&(matrimo.liHay==1))
											{
													NotificaS("Matrimonio Anulado con exito.");
													fpCancelar();
											
											}
											if ((loF.txtOperacion.value=="ToPendienteAnular")&&(matrimo.liHay==0))
											{
													NotificaE("El Matrimonio no pudo ser Anulado.");
													fpCancelar();
											
											}

											if ((loF.txtOperacion.value=="ToPendienteAnular")&&(matrimo.liHay==1))
											{
													NotificaS("Matrimonio en proceso de anulación");
													fpCancelar();
											
											}

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
