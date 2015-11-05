<?php 
session_start();
include_once("../clases/cls_Calendario.php");
include_once("../clases/cls_Combo.php");
$lobjCombo= new cls_Combo();
$lobj_Calendario= new cls_Calendario();
$lobj_Calendario->Cargar();
$ano=$_GET["CalendarioA"];
$mes=$_GET["CalendarioM"];
if(!$ano){
	$hoy=explode('/',DATE('Y/m/d'));
	$ano=$hoy[0];
	$mes=$hoy[1];
}
include_once("../clases/cls_Cuerpo.php");
$lobj_Cuerpo= new cls_Cuerpo();
$la_Campos=$_SESSION["Campos"];
unset($_SESSION["Campos"]);
?>
<html>
<head>
<meta charset="utf-8">
<link rel='stylesheet' href='css/jquery-ui.min.css' />
<link href='JS/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='JS/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='JS/fullcalendar/jquery.min.js'></script>
<script src='JS/fullcalendar/jquery-ui.custom.min.js'></script>
<script src='JS/fullcalendar/fullcalendar.js'></script>

<script>
	anoACargar=<?php print($ano);?>;
	mesACargar=<?php print($mes-1);?>;
	superWidth="127px";
	superHeight="108px";

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				rigth: 'gotoDate'
			},
			editable: true,
			events: [<?php $lobj_Calendario->eventos(); ?>]
		});
		
	});

</script>
<style>

	body {
		text-align: center;
		font-size: 13px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
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
	background: url("imagenes/pie.png") repeat-x;
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
    	background: url("imagenes/pie.png") repeat-x;
	background-size: 100% 100%;
	text-shadow: 1px 1px 5px rgb(24, 75, 124);
	color: rgb(24, 75, 124);
}
/*******************************MENU*************************/

ul#css3menu1,ul#css3menu1 ul{
	list-style:none;
	padding:0;
	color:black;
	background: url("imagenes/pie.png") repeat-x;
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

/**********************fin menu**********************************/

</style>
</head>
<body onload="cargar();">
<div Contenedor>
	<?php $lobj_Cuerpo->f_Cabecera();?>
			<?php $lobj_Cuerpo->f_Menu();?>
	<div  id='calendar'></div>
	<div class="formulario" >
	<form method="POST" action="../controladores/cor_Agenda.php">	
		<h2>Actividad <input type="button" value="x" onclick="this.parentNode.parentNode.parentNode.style.display='none';"></h2>
		<input type="hidden" name="Codigo">
		<input type="hidden" name="Operacion" value="Guardar">
		<input type="hidden" name="Proyecto" value="<?php print($pro);?>">
		<?php print($_SESSION['Usuario']);?>
	
		<label>Nombre</label><br>
			<input type="text" title="ingrese Nombre" name="Nombre" ><br>
		<label>Fecha Inicio</label><br>
			<input type="text"  name="Fecha_Ini" ><br>
		<label>Lugar de Encuentro</label><br>
			<input type="text"  name="Lugar_enc" ><br>
		<label>Actividad</label><br>
			<select  requerido="obligatorio"name="Actividad"><option value="-" selected="selected">Seleccione</option>
				<?php $lobjCombo->fGenerar("SELECT * FROM actividad","codigo","nombre",$la_Campos['Actividad'],"")?>
			</select><br>
			<input type="button" onclick="fpDespliegaActividades(this);" style="float:left;" value="Nueva Actividad">
			<input type="button" onclick="fGuardar()" value="Guardar">
			<input type="button" onclick="f_Eliminar()" value="Eliminar" name="Eliminar"><br><br>
			<div id="containerActividad" style="display:none;">
					<label>Codigo </label><br>
					<input type="text" validar="solo numeros" name="codigo"  value="<?php print($la_Campos['codigo']);?>" onblur="f_PerderFocus();"/>
					<br><label>Nombre </label><br>
					<input type="text" validar="solo letras" requerido="obligatorio" name="Nombre"  value="<?php print($la_Campos['Nombre']);?>" />
					<br><label>Fecha </label><br>
					<input type="text" validar="fecha" name="Fecha" onblur="f_Fecha();" requerido="obligatorio" value="<?php print($la_Campos['Fecha']);?>" />
					<br><label>Dirección </label><br>
					<textarea  validar=" " name="Direccion"  requerido="obligatorio" value="" /><?php print($la_Campos['Direccion']);?></textarea>
					<br><label>Hora </label><br>
					<input type="text" validar=" " name="Hora"  requerido="obligatorio" value="<?php print($la_Campos['Hora']);?>"/>
					<br><label>Grupo</label><br>
					<select name="Codigo_Grupo" onblur="f_Qloquiar('1');" >
					</sbr><option value="-">Seleccione</option><br>
					<?php $lobjCombo->fGenerar("SELECT *FROM grupo","codigo","nombre",$la_Campos['Codigo_Grupo']); ?>
					</select>
					<br><label>Pastoral</label><br>
					<br><select name="Codigo_Pastoral" onblur="f_Qloquiar('2');">
					<option value="-"  >Seleccione</option><br>
					<?php $lobjCombo->fGenerar("SELECT *FROM pastoral","codigo","nombre",$la_Campos['Codigo_Pastoral']); ?>
					</select>
					<option value="-">Seleccione</option><br>
		  			<input type="radio" name ="Status" value="A" id="Status1"<?php if($la_Campos['Status']=='A'){print("checked");} ?>><label>Activo</label>
					<input type="radio" name="Status" value="I" id="Status2"<?php if($la_Campos['Status']=='I'){print("checked");} ?>><label>Inactivo</label>
					<input type="hidden" value="0" name="ModoActividad" id="ModoActividad">
			</div>
	</form>
	</div>
</div>
</body>
<script type="text/javascript">
	function cargar(){
		var lista=document.getElementsByTagName('td');
		for(var x=0;x<lista.length;x++){
			if(lista[x].classList.contains("fc-day")){				
				lista[x].onclick=function(){cargaFormulario(this.getAttribute("data-date"),this.getAttribute("data-date"),"","","-",this);};
		
			}
		}
		lista=document.getElementsByTagName('span');
		for(var y=0;y<lista.length;y++){
			lista[y].onclick=function(){setTimeout("cargar()",50);};
		}
		lista=document.getElementsByTagName('div');
		for( y=0;y<lista.length;y++){
			if(lista[y].classList.contains("fc-event-inner")){	
				lista[y].onclick=function(){cargaFormulario(this.parentNode.getAttribute("inicia"),this.parentNode.getAttribute("finaliza"),this.parentNode.getAttribute("codigo"),this.parentNode.getAttribute("nombre"),this.parentNode.getAttribute("Actividad"),this.parentNode,this.parentNode.getAttribute("lugar_enc"));};
				
			}
		}
	}
	function dayClick(date){
		calendar=document.getElementById('calendar');
    	calendar.fullCalendar('gotoDate', date);
    	calendar.fullCalendar('changeView',"agendaDay");
	}

	function f_cambiar(obj,padre){
		obj.style.transition = "all 1s ease-out 0.5s";	
		obj.style.display="block";
		obj.style.marginTop=(parseInt(padre.offsetTop)+45)+"px";
		obj.style.marginLeft=(parseInt(padre.offsetLeft)+120)+"px";	

	}
	function cargaFormulario(fechaInicio,fechaFin,codigo,nombre,Actividad,objeto,Lugar_enc){
		var obj=document.getElementsByClassName("formulario");
		f_cambiar(obj[0],objeto);
		if(codigo!=""){
			document.getElementsByName('Eliminar')[0].style.display="block";
		}else {
			document.getElementsByName('Eliminar')[0].style.display="none";
		}
		var a = fechaInicio.substring(0,4);
		var m = fechaInicio.substring(5,7);
		var d = fechaInicio.substring(8,10);
		if(codigo){
			if(m=="00"){
				m="01";
			}else{
				m=parseInt(m)+1;
			}
		}
		if(d.length==1){
			d="0"+d;
		}
		if(m.toString().length==1){
			m="0"+m;
		}
		document.getElementsByName("Fecha_Ini")[0].value=d+"-"+m+"-"+a;
		var a = fechaFin.substring(0,4);
		var m = fechaFin.substring(5,7);
		var d = fechaFin.substring(8,10);
		if(codigo){
			if(m=="00"){
				m="01";

			}else{
				m=parseInt(m)+1;
			}
		}
		if(d.length==1){
			d="0"+d;
		}
		if(m.toString().length==1){
			m="0"+m;
		}
		document.getElementsByName("Fecha_Ini")[0].value=d+"-"+m+"-"+a;
		document.getElementsByName("Codigo")[0].value=codigo;
		document.getElementsByName("Actividad")[0].value=Actividad;
		document.getElementsByName("Lugar_enc")[0].value=Lugar_enc;
		document.getElementsByName("Nombre")[0].value=nombre;
	}

	function fpDespliegaActividades(objButon)
	{
		if (objButon.value=="Nueva Actividad")
		{
			document.getElementById('containerActividad').style.display='block';
			objButon.value="Cancelar Actividad";
			document.getElementById('ModoActividad').value="1";
		}
		else
		{
			document.getElementById('containerActividad').style.display='none';
			objButon.value="Nueva Actividad";
			document.getElementById('ModoActividad').value="0";
		}

	}

	function fGuardar(){
		f=document.forms[0];
		var cont=0;
		if(f.Nombre.value.length<3){
			cont++;
			alert("Coloque un nombre para el Evento");
			f.Nombre.focus();
		}else if(f.Actividad.value=="-"){
			cont++;
			alert("selecione una Red");
		}
		if(cont==0){
			f.submit();	
		}
	}
		function f_Eliminar(){
			f=document.forms[0];
			f.Operacion.value="Eliminar";
			f.submit();
		}
	
</script>
</html>
