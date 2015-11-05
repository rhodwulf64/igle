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
<body >
	<center>
	<div Contenedor>
	<?php $lobj_Cuerpo->f_Cabecera();?>
			<?php $lobj_Cuerpo->f_Menu();?>
		<div formulario>
			<h2>Tipo de Actividad</h2>
		<form name="form1" action="../controladores/cor_Tipo.php" method="POST">
			<?php $lobj_Cuerpo->f_Control($la_Campos); ?>
			<table>
				<tr>
					<td>
						<label>Codigo </label>
					</td>
					<td>
						<img src="imagenes/asterisco.png"><a class="tooltip" ><input type="text" validar="solo numeros" name="Codigo"  value="<?php print($la_Campos['Codigo']);?>" onblur="f_PerderFocus();"/><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Codigo autoincrementable</em>codigo con que se<br>identifica el Tipo de la Actividad</span></a><br><br></td>
				
				</tr>
				<tr>
					<td>
						<label>Nombre </label>
					</td>
					<td>
						<img src="imagenes/asterisco.png"><a class="tooltip" ><input type="text" validar="solo letras" name="Nombre"  value="<?php print($la_Campos['Nombre']);?>"/><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Nombre</em>con que se<br>identifica el Tipo de la Actividad</span></a><br><br>
					</td>
				</tr>
				<tr>
					<td>
						<label>Descripcion </label>
					</td>
					<td>
						<img src="imagenes/asterisco.png"><a class="tooltip" ><input type="text" validar="solo letras" name="Descripcion"  value="<?php print($la_Campos['Descripcion']);?>"/><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Descripcion</em>con que se<br> va a identificar el Tipo de la Actividad</span></a><br><br>
					</td>
				</tr>
				<tr>
					<td>
						<label>Status</label>
					</td>
					<td><input type="radio" name ="Status" value="A" id="Status1"<?php if($la_Campos['Status']=='A'){print("checked");} ?>><label>Activo</label></td>
					<td><input type="radio" name="Status" value="I" id="Status2"<?php if($la_Campos['Status']=='I'){print("checked");} ?>><label>Inactivo</label></td>
				</tr>
			</table>
			<?php $lobj_Cuerpo->f_BotonNuevo();?>
		</div>
			
			
		</form>
		<div class='ordenar'></div>
	<?php $lobj_Cuerpo->f_Pie();?>
	</div>
	</div>
	</center>
</body>
<script src="JS/motorValidaciones.js"></script>
<script src="JS/maestros.inicio.js"></script>
</html>
