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
	include_once("../clases/cls_Calendario.php");
	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion = new clsFunciones;
	$lobj_Calendario= new cls_Calendario();
	$lobj_Calendario->Cargar('tagendadiocesana'); //el nombre de la tabla agenda
	$la_Campos=$_SESSION["Campos"];
	unset($_SESSION["Campos"]);
	$ano=$_GET["CalendarioA"];
	$mes=$_GET["CalendarioM"];
	if(!$ano)
	{
		$hoy=explode('/',DATE('Y/m/d'));
		$ano=$hoy[0];
		$mes=$hoy[1];
	}

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


	$mes=$mes-1;
	echo utf8_Decode('

<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Gestion de Matrimonio</title>
		');
			print(encabezado_menu("../"));

	echo utf8_Decode('
	<link href="Calendario/css/fullcalendar.css" rel="stylesheet" />
	<link href="Calendario/css/fullcalendar.print.css" rel="stylesheet" media="print" />
	<script src="Calendario/javascript/jquery.min.js"></script>
	<script src="Calendario/javascript/jquery-ui.custom.min.js"></script>
	<script src="Calendario/javascript/fullcalendar.js"></script>
	<script>

	anoACargar='.$ano.';
	mesACargar='.$mes.';
	superWidth=\'127px\';
	superHeight=\'108px\';

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		$(\'#calendar\').fullCalendar({
			theme: true,
			header: {
				left: \'prev,next today\',
				center: \'title\',
				rigth: \'gotoDate\'
			},
			editable: true,
			events: [');
		$lobj_Calendario->eventos();
	echo utf8_Decode(']
		});
		
	});

</script>
<style>

	body {
		text-align: center;
		font-size: 13px;
		font-family: \'Lucida Grande\',Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 900px;
		margin:5px auto;
		float:left;
		margin-left:5%;
		margin-top:20px;
	}

div[Cabecera]{
	margin: 0px auto;
	width: 1024px;
	height: 50px;
	border: 1px solid silver;
	background: url(\'img/pie.png\') repeat-x;
	background-size: 100% 100%;
	border-radius: 10px 10px 0px 0px ;
}

div[Cabecera] p{
	font-size: 28px;
	float: left;
	margin: 6px 0px 0px 50px;
	text-shadow:1px 1px 5px #184B7C;
	color: #184B7C;
}

	div[Menu]{
		height: auto;
		min-height: 30px;
		background:silver;
		width: 100%;
		border: none;
		margin-top: 0px;

	}

div[Contenedor]{
	margin: 0px auto ;
	width: 1024px;
	height: 840px;
	border: 1px solid silver;
	box-shadow: 1px 1px 10px black;
	border-radius: 10px 10px 10px 10px ;
	overflow: auto;
}

.fc-header {
    	background: url(\'img/pie.png\') repeat-x;
	background-size: 100% 100%;
	text-shadow: 1px 1px 5px rgb(24, 75, 124);
	color: rgb(24, 75, 124);
}
/*******************************MENU*************************/

ul#css3menu1,ul#css3menu1 ul{
	list-style:none;
	padding:0;
	color:black;
	background: url(\'img/pie.png\') repeat-x;
	background-size: 100% 100%;
	border-width:0px;
	border-style:solid;
	border-color:rgb(41,56,140);

	}
	
ul#css3menu1 ul{
	display:none;
	position:absolute;
	color:#B01111;
	}
	
ul#css3menu1 li:hover>*{
	display:block;
	box-shadow:5px 5px 10px -8px white;
	font-weight:bold;
	}
	
ul#css3menu1 li{
	position:relative;
	display:block;
	float:left;
	

	}
	
ul#css3menu1 li:hover{
	z-index:1;}
	
ul#css3menu1 ul ul{
	position:absolute;
	left:30%;
	top:0;
	}
	
ul#css3menu1{
	font-size:0;
	display:inline-block;
	padding:0px 0px 0px 0;
}
	

ul#css3menu1>li{
	margin:0 0 0 0px;
	}
	
ul#css3menu1 ul>li{
	margin:0px 0 0;
	width:auto;

	
 }
	

ul#css3menu1 a{
	display:block;
	text-decoration:none;
	font:13px Arial;color:#ffffff;
	cursor:pointer;
	width:120px;
	padding:5.5px 25px;
	border-width:0;
	border-style:;
	border-color:transparent; 
	}
	
ul#css3menu1 ul li{
	float:none;
	}
	
ul#css3menu1 ul a{
	text-align:left;
	}
	
ul#css3menu1 li:hover>a,ul#css3menu1 li a.pressed{
	background: none repeat scroll 0% 0% rgb(0, 196, 196);
	border-color:#F8F8F8;
	border-style:;
	color:rgb(0, 106, 106);  /* letras li de hipervinculo*/
	transition-property: background-color, border-color, box-shadow;
	transition-duration:0.5s;
	text-decoration:none;
	}
	
ul#css3menu1 li.topmenu>a{
  margin-top:0px;
	border:0px solid ;
	border-color:silver;
	font:bold 16px Arial;
	color:#184B7C;
	text-decoration:none;
	}
	
ul#css3menu1 li.topmenu:hover>a,ul#css3menu1 li.topmenu a.pressed{
	background: none repeat scroll 0% 0% rgb(0, 196, 196);
	border-style:;
	color:rgb(0, 106, 106);
	text-decoration:none;
	 
	}


</style>
</head>
		<body onload="cargar();">
	<div class="mygrid-wrapper-div">
	<div class="container pre-scrollable" style="margin-top:5px; min-height: 600px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">
		
		');
		encab('../');
		menu_general('');
		
echo utf8_Decode('
			<div class="col-lg-12">
				<div Contenedor style=" background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">
					<div Cabecera>
						<p>Agenda Diocesana</p>
					</div>
					<div  id="calendar"></div>
					<div class="formulario" >
						<form method="POST" name="fr_agenda" id="fr_agenda" action="../cntller/cn_agendaDiocesana.php">	
							<h2>Actividad 
							<input type="button" value="x" onclick="this.parentNode.parentNode.parentNode.style.display=\'none\';"></h2>
							<input type="hidden" name="Codigo" id="Codigo" value="">
							<input type="hidden" name="txtOperacion" id="txtOperacion" value="">
							<input type="hidden" name="txtHay" id="txtHay" value="">
							<input type="hidden" name="Proyecto" value="'.$pro.'">	
							<table align="center">
								<tr>
									<td>
										<div id="containerActividad2" style="display:none;">
											<label>Tipo de Actividad</label><br>
											<select name="CodigoTipoActividad" onblur="">
											<option value="-">Seleccione</option><br>
											');
											echo utf8_decode($loFuncion->fncreateComboSelect("tipo_actividad", "","idtipo_actividad","", ' ',"","nombre", $selecttipo_actividad,"", "", "")); 
											echo utf8_Decode('
											</select><br>
											
										</div>
									</td>
									<td colspan="2">
										<div id="containerActividad1" style="display:none;">
											<label>Nombre Actividad</label><br>
											<input type="text" title="ingrese Nombre" validar="solo letras" requerido="obligatorio" name="Nombre" id="Nombre" value="'.$la_Campos['Nombre'].'" /><br>
										</div>
										<div id="containerActividad3" style="display:none;">
											<label>Seleccione Actividad</label><br>
											<select  requerido="obligatorio"name="Actividad"><option value="-">Seleccione</option>
											');
											echo utf8_decode($loFuncion->fncreateComboSelect("tactividad", "","codigoActividad","", ' ',"","nombre", $selectactividad,"", "", "")); 
											echo utf8_Decode('
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td>
											<label>Grupo Apostolado</label><br>
											<select name="Codigo_Grupo" onblur="" >
											</sbr><option value="-">Seleccione</option>
											');
											echo utf8_decode($loFuncion->fncreateComboSelect("tgrupo", "","codigoGrupo","", ' ',"","nombre", $selecttgrupo,"", "", "")); 
											echo utf8_Decode('
											</select><br>
									</td>
									<td colspan="2">
											<label>Fecha Inicio</label><br>
											<input type="text" maxlength="10" placeholder="01-12-1991" validar="Fecha_Ini" name="Fecha_Ini" requerido="obligatorio" value="'.$la_Campos['Fecha'].'" /><br>
									</td>
								</tr>
								<tr>
									<td>
											<label>Pastoral</label><br>
											<select name="Codigo_Pastoral" onblur="">
											<option value="-"  >Seleccione</option>
											');
											echo utf8_decode($loFuncion->fncreateComboSelect("tpastoral", "","codigoPastoral","", ' ',"","nombre", $selecttpastoral,"", "", "")); 
											echo utf8_Decode('
											</select><br>										
									</td>
									<td colspan="2">
											<label>Hora </label><br>
											<input type="time" validar="Hora_Ini" name="Hora_Ini" onblur="" requerido="obligatorio" value="'.$la_Campos['Hora'].'" /><br>
									</td>
								</tr>
								<tr>
									<td colspan="3">
											<label>Lugar de Encuentro</label><br>
											<textarea name="Lugar_enc"></textarea><br>
									</td>
								</tr>
								<tr>
									<td>
										<input type="button" name="btn_Despli" id="btn_Despli" onclick="fpDespliegaActividades();" style="float:left;" value="Nueva Actividad">
									</td>
									<td>
										<input type="button" onclick="f_Eliminar()" value="Estado" name="Eliminar"><br><br>
									</td>
									<td>
										<input type="button" onclick="fGuardar()" value="Guardar">
									</td>
								</tr>
							</table>
								<input type="hidden" value="0" name="ModoActividad" id="ModoActividad">
								<input type="hidden" value="0" name="EstatusAgenda" id="EstatusAgenda">
								
						</form>
					</div>
				</div>
		
			</div>
	</div>
	</div>
	');
	footer(); // pie de pagina
	echo utf8_decode('
</div>

</body>
<script type="text/javascript">
var loF=document.fr_agenda;
	function cargar(){
		var lista=document.getElementsByTagName(\'td\');
		for(var x=0;x<lista.length;x++){
			if(lista[x].classList.contains(\'fc-day\')){				
				lista[x].onclick=function(){cargaFormulario(this.getAttribute(\'data-date\'),this.getAttribute(\'data-date\'),\'\',\'\',\'\',\'-\',this,\'\',\'-\',\'-\',\'-\',\'\');};
		
			}
		}
		lista=document.getElementsByTagName(\'span\');
		for(var y=0;y<lista.length;y++){
			lista[y].onclick=function(){setTimeout(\'cargar()\',50);};
		}
		lista=document.getElementsByTagName(\'div\');
		for( y=0;y<lista.length;y++){
			if(lista[y].classList.contains(\'fc-event-inner\')){	
				lista[y].onclick=function(){cargaFormulario(this.parentNode.getAttribute(\'inicia\'),this.parentNode.getAttribute(\'finaliza\'),this.parentNode.getAttribute(\'hora_ini\'),this.parentNode.getAttribute(\'codigo\'),this.parentNode.getAttribute(\'nombre\'),this.parentNode.getAttribute(\'Actividad\'),this.parentNode,this.parentNode.getAttribute(\'lugar_enc\'),this.parentNode.getAttribute(\'grupo_apos\'),this.parentNode.getAttribute(\'pastoral\'),this.parentNode.getAttribute(\'tipo_acti\'),this.parentNode.getAttribute(\'evento_estatus\'));};
				
			}
		}
		loF.txtOperacion.value="modificar";

	}
	function dayClick(date){
		calendar=document.getElementById(\'calendar\');
    	calendar.fullCalendar(\'gotoDate\', date);
    	calendar.fullCalendar(\'changeView\',\'agendaDay\');



	}

	function f_cambiar(obj,padre){
		obj.style.transition = \'all 1s ease-out 0.5s\';	
		obj.style.display=\'block\';
		obj.style.marginTop=(parseInt(padre.offsetTop)+45)+\'px\';
		obj.style.marginLeft=(parseInt(padre.offsetLeft)+120)+\'px\';	
		loF.ModoActividad.value=\'1\';
		fpDespliegaActividades();
	}
	function cargaFormulario(fechaInicio,fechaFin,hora_ini,codigo,nombre,Actividad,objeto,lugar_enc,grupo_apos,pastoral,tipo_acti,even_estatus){
		var obj=document.getElementsByClassName(\'formulario\');
		f_cambiar(obj[0],objeto);
		if(codigo!=\'\'){
			document.getElementsByName(\'Eliminar\')[0].style.display=\'block\';
		}else {
			document.getElementsByName(\'Eliminar\')[0].style.display=\'none\';
		}
		if(even_estatus==\'1\')
		{
			document.getElementsByName(\'Eliminar\')[0].value=\'Desactivar\';
		}
		else
		{
			document.getElementsByName(\'Eliminar\')[0].value=\'Reactivar\';
		}

		var a = fechaInicio.substring(0,4);
		var m = fechaInicio.substring(5,7);
		var d = fechaInicio.substring(8,10);
		if(codigo){
			if(m==\'00\'){
				m=\'01\';
			}else{
				m=parseInt(m)+1;
			}
		}
		if(d.length==1){
			d=\'0\'+d;
		}
		if(m.toString().length==1){
			m=\'0\'+m;
		}
		document.getElementsByName(\'Fecha_Ini\')[0].value=d+\'-\'+m+\'-\'+a;
		var a = fechaFin.substring(0,4);
		var m = fechaFin.substring(5,7);
		var d = fechaFin.substring(8,10);
		if(codigo){
			if(m==\'00\'){
				m=\'01\';

			}else{
				m=parseInt(m)+1;
			}
		}
		if(d.length==1){
			d=\'0\'+d;
		}
		if(m.toString().length==1){
			m=\'0\'+m;
		}
		document.getElementsByName(\'Fecha_Ini\')[0].value=d+\'-\'+m+\'-\'+a;
		document.getElementsByName(\'Codigo\')[0].value=codigo;
		document.getElementsByName(\'Actividad\')[0].value=Actividad;
		document.getElementsByName(\'Hora_Ini\')[0].value=hora_ini;
		document.getElementsByName(\'Lugar_enc\')[0].value=lugar_enc;
		document.getElementsByName(\'Nombre\')[0].value=nombre;
		document.getElementsByName(\'Codigo_Grupo\')[0].value=grupo_apos;
		document.getElementsByName(\'Codigo_Pastoral\')[0].value=pastoral;
		document.getElementsByName(\'CodigoTipoActividad\')[0].value=tipo_acti;
		document.getElementsByName(\'EstatusAgenda\')[0].value=even_estatus;
		if (loF.Codigo.value==\'\')
		{
			loF.txtOperacion.value="incluir";
		}
		else
		{
			loF.txtOperacion.value="modificar";
		}
		loF.Actividad.focus();
	}

	function fpDespliegaActividades()
	{
		loF.Actividad.value=\'-\';
		loF.Nombre.value=\'\';
		loF.CodigoTipoActividad.value=\'\';
		if (loF.ModoActividad.value==\'0\')
		{
			loF.Actividad.disabled=true;
			document.getElementById(\'containerActividad1\').style.display=\'block\';
			document.getElementById(\'containerActividad2\').style.display=\'block\';
			document.getElementById(\'containerActividad3\').style.display=\'none\';
			loF.btn_Despli.value=\'Seleccionar Actividad\';
			loF.ModoActividad.value=\'1\';
			loF.Nombre.focus();
		}
		else
		{
			loF.Actividad.disabled=false;
			document.getElementById(\'containerActividad1\').style.display=\'none\';
			document.getElementById(\'containerActividad2\').style.display=\'none\';
			document.getElementById(\'containerActividad3\').style.display=\'block\';
			loF.btn_Despli.value=\'Nueva Actividad\';
			loF.ModoActividad.value=\'0\';
			loF.Actividad.focus();
		}
	}


	function fbValidar()
	{
		var lbValido=false;
		var vInvalido=0;
		var ModoFormu=loF.ModoActividad.value;
				
			if(loF.Lugar_enc.value=="")
			{
				NotificaW("Escriba un lugar para la Actividad.");
				loF.Lugar_enc.focus();
				vInvalido=1;
			}
			if(loF.Hora_Ini.value=="")
			{
				NotificaW("Indique una Hora para la Actividad.");
				loF.Hora_Ini.focus();
				vInvalido=1;
			}
			if(loF.Fecha_Ini.value=="")
			{
				NotificaW("Indique una Fecha para la Actividad.");
				loF.Fecha_Ini.focus();
				vInvalido=1;
			}
			switch(ModoFormu) 
			{
			    case \'1\':

					if(loF.CodigoTipoActividad.value=="-")
					{
						NotificaW("Seleccione Tipo de Actividad.");
						loF.CodigoTipoActividad.focus();
						vInvalido=1;
					}
					/*
			       	if(loF.Codigo_Pastoral.value=="-")
					{
						NotificaW("Seleccione una Pastoral.");
						loF.Codigo_Pastoral.focus();
						vInvalido=1;
					}
					if(loF.Codigo_Grupo.value=="-")
					{
						NotificaW("Seleccione un Grupo Apostolado.");
						loF.Codigo_Grupo.focus();
						vInvalido=1;
					}
					*/
					if(loF.Nombre.value=="")
					{
						NotificaW("Escriba un Nombre para la Actividad.");
						loF.Nombre.focus();
						vInvalido=1;
					}

			    break;
			    case \'0\':
			       	if(loF.Actividad.value=="-")
					{
						NotificaW("Seleccione una Actividad.");
						loF.Actividad.focus();
						vInvalido=1;
					}
			    break;
			}
				if (vInvalido==0)
				{
					lbValido=true;
				}

		return lbValido;
	}

	function fGuardar(){
	
		if(fbValidar())
			{
				var $forme = $("#fr_agenda");
			
					$.ajax(
					{
						url: \'../cntller/cn_agendaDiocesana.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {

      					    var ReAgenda=data[\'Agenda\'];
							
							if ((loF.txtOperacion.value=="incluir")&&(ReAgenda.liHay==0))
							{
								NotificaE("No se pudo incluir el Registro.");
							}

							if ((loF.txtOperacion.value=="incluir")&&(ReAgenda.liHay==1))
							{

								NotificaS("Registro incluido con exito.");
								
								setTimeout(function(){ document.location.href = "gestAgendaDiocesana.php?CalendarioA="+ReAgenda.lsAnnoReg+"&CalendarioM="+ReAgenda.lsMesReg+""; }, 1000);
								
							}

							if ((loF.txtOperacion.value=="modificar")&&(ReAgenda.liHay==0))
							{
								NotificaE("No se pudo modificar el Registro.");
							}

							if ((loF.txtOperacion.value=="modificar")&&(ReAgenda.liHay==1))
							{

								NotificaS("Registro modificado con exito.");
								setTimeout(function(){ document.location.href = "gestAgendaDiocesana.php?CalendarioA="+ReAgenda.lsAnnoReg+"&CalendarioM="+ReAgenda.lsMesReg+""; }, 1000);

							}
						}
					});
			}
	}
		function f_Eliminar(){
			if (confirm(\'Desea Continuar con la operación?\'))
			{
				loF.txtOperacion.value=\'ActualizaEstado\';
				var $forme = $("#fr_agenda");
			
					$.ajax(
					{
						url: \'../cntller/cn_agendaDiocesana.php\',
						dataType: \'json\',
						type: \'post\',
						data: $forme.serialize(),
				        success: function(data)
				        {
      					    var ReAgenda=data[\'Agenda\'];
      					    var NuevoEstado=\'\';

      					    if (ReAgenda.EstatusAgenda==\'0\')
      					    {
      					    	NuevoEstado=\'Reactivado\';
      					    }
      					    else
      					    {
      					    	NuevoEstado=\'Desactivado\';
      					    }

							if ((loF.txtOperacion.value=="ActualizaEstado")&&(ReAgenda.liHay==0))
							{
								NotificaE("El registro no pudo ser "+NuevoEstado+".");
							}

							if ((loF.txtOperacion.value=="ActualizaEstado")&&(ReAgenda.liHay==1))
							{

								NotificaS("Registro "+NuevoEstado+" con exito.");
								setTimeout(function(){ document.location.href = "gestAgendaDiocesana.php?CalendarioA="+ReAgenda.lsAnnoReg+"&CalendarioM="+ReAgenda.lsMesReg+""; }, 1000);
								
							}
						}
					});
			}
		}
	
</script>



</html>
'); 






?>
