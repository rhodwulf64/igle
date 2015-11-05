<?php
session_start();
include_once("../clases/cls_Cuerpo.php");
$lobj_Cuerpo= new cls_Cuerpo();
$la_Campos=$_SESSION["Campos"];
include_once("../clases/cls_Combo.php");
$lobjCombo= new cls_Combo();
unset($_SESSION["Campos"]);
$la_listados=$_SESSION["matriz"];
unset($_SESSION["matriz"]);
$lobj_Cuerpo->f_Redireccion();
$correo=explode('@', $la_Campos['Correo']);
$tele=explode('-', $la_Campos['Telefono']);
$la_Nombres=Array("Codigo","Nombre","");

$la_Campos['Telefono']=$tele[1];
$la_Campos['Telefono1']=$tele[0].'-'.$tele[1];
$la_Campos['Correo1']=$correo[0];
$la_Campos['Correo2']=$correo[1];
$la_Campos['CorreoT']=$correo[0].'@'.$correo[1];
$fecha=explode('-',$la_Campos['Fecha_creacion']);
$la_Campos['Fecha_creacion']=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];
?>
<html>
<head>
	<?php $lobj_Cuerpo->f_Librerias();?>
	<title>Registro</title>
	<script>
		laNombre=new Array("Estatus1","Estatus1","Estatus2");
		laValor=new Array("checked","bloqueado","bloqueado");
	</script>
</head>
<body onload="cargar(<?php if(isset($_GET['buscar'])) echo 1;else echo 0;?>)" >
	<center>
	<div Contenedor>
	<?php $lobj_Cuerpo->f_Cabecera();?>
			<?php $lobj_Cuerpo->f_Menu();?>
		<div formulario>
			<h2>Capilla</h2>
		<form name="form1" action="../controladores/cor_Capilla.php" method="POST">
			<?php $lobj_Cuerpo->f_Control($la_Campos); ?>
			<table>
				<tr>
					<td>
						<label>Codigo </label>
					</td>
					<td><img src="imagenes/asterisco.png">
						<a class="tooltip" ><input type="text" validar="solo numeros" requerido="obligatorio" name="Codigo"  value="<?php print($la_Campos['Codigo']);?>" onblur="f_PerderFocus();"/><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Codigo autoincrementable</em>codigo con que se<br>identifica la ciudad</span></a><br><br>
				</td>
				</tr>
				<tr>
					<td>
						<label>Nombre </label>
					</td>
					<td><img src="imagenes/asterisco.png">
						<a class="tooltip" ><input type="text" validar="solo letras"  requerido="obligatorio" name="Nombre"  value="<?php print($la_Campos['Nombre']);?>"/><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em></em>Inserte el Nombre de la Capilla<br></span></a><br><br>
					</td>
				</tr>
				<tr>
					<td>
						<label>Direccion </label>
					</td>
					<td><img src="imagenes/asterisco.png">
						<a class="tooltip" ><textarea type="text" validar=" " requerido="obligatorio" name="Direccion"  value=""/><?php print($la_Campos['Direccion']);?></textarea><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Indique Puntualmente</em>la Direccion o Calle de la Capilla<br></span></a><br><br><br>
					</td>
				</tr>
				<tr>
					<td>
						<label>Parroquia </label>
					</td>
					<td><img src="imagenes/asterisco.png">
						<a class="tooltip" ><select validar " " requerido="obligatorio" name="Codigo_p">
							<option value='-'>Seleccione</option>
							<?php $lobjCombo->fGenerar("SELECT *FROM parroquia","codigo","nombre",$la_Campos['Codigo_p']);?>
						</select><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Seleccion la Parroquia</em>A la Que Pertenece la Capilla</span></a><br><br>
					</td>
				</tr>
				<tr>
					<td>
						<label>Telefono</label>
					</td>
			<td><img src="imagenes/asterisco.png"><select name="cod"><option value="0255">0255</option></select><input type="text" placeholder="" onblur="tel()" size="5" maxlength="7" validar="solo numeros" name="telefono" requerido="obligatorio"  value="<?php print($la_Campos['Telefono']);?>" </td>
				
				</tr>
				<tr>
					<td>
						<label>Fecha de<br></label><label>Creacion</label>
					</td>
					<td><img src="imagenes/asterisco.png">
						<a class="tooltip" ><input type="text" validar=" " style="margin-top:8px;" title="Ingrese dia-mes-año" requerido="obligatorio" name="Fecha_creacion"  value="<?php print($la_Campos['Fecha_creacion']);?>"/><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Inserte una fecha Valida</em>Indique Dia-Mes-Año este orden especifico<br></span></a><br><br><br>
					</td>
				</tr>
				<tr>
					<td>
						<label>Correo</label>
					</td>
					<td>
						<a class="tooltip" ><input type="text" placeholder="" validar=" " size="5" maxlength="20" title="Coloque Nombre y Elija Extension" name="ini" value="<?php print($la_Campos['Correo1']);?>"/><L style="color:white;">@
							<select name="correo">
							<option value="-">Seleccione</option>
							<option value="Hotmail.com">Hotmail.com</option>
							<option value="Hotmail.es">Homail.es</option>
							<option value="Gmail.com">Gmail.com</option>
							<option value="Yahoo.com">Yahoo.com</option>
							<option value="Live.com">Live.com</option>
							<option value="Live.es">Live.es</option>
							<option value="Ymail.com">Ymail.com</option>
							<option value="rocketmail.com">rocketmail.com</option>
							<option value="cantv.net">cantv.net</option>
							</select>
						</L><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Introduzca el Nombre de su Correo</em>Elija una Extencion de Correo Electronico<br></span></a><br><br><br>
					</td>
				</tr>
				
				</tr>
				<input type="hidden" name="Correo" value="<?php  print($la_Campos['CorreoT']);?>"> 
				<input type="hidden" name="Telefono" value="<?php print($la_Campos['Telefono1']);?>">

			</table>
			<?php $lobj_Cuerpo->f_BotonNuevo();?>
		</div>
			
		</form>
		<div class='ordenar'></div>
	<?php $lobj_Cuerpo->f_Pie();?>
	</div>
	</div>
	</center>
	<?php $lobj_Cuerpo->f_Listar($la_listados,$la_Nombres,$la_Campos["pg"],$la_Campos["valor"],"Actividad");?>
</body>
<script type="text/javascript">
	function tel(){
		document.form1.Telefono.value=document.form1.cod.value+'-'+document.form1.telefono.value;

	}
		function f_arreglar(){
		document.form1.Correo.value=document.form1.ini.value+'@'+document.form1.fin.value;
	}
</script>
<script src="JS/motorValidaciones.js"></script>
<script src="JS/maestros.inicio.js"></script>
</html>
