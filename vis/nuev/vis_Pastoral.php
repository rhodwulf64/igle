<?php
session_start();
include_once("../clases/cls_Cuerpo.php");
$lobj_Cuerpo= new cls_Cuerpo();
include_once("../clases/cls_Combo.php");
$lobjCombo= new cls_Combo();
$la_Campos=$_SESSION["Campos"];
unset($_SESSION["Campos"]);
$la_listados=$_SESSION["matriz"];
unset($_SESSION["matriz"]);
$lobj_Cuerpo->f_Redireccion();
$correo=explode('@', $la_Campos['Correo']);
$la_Campos['Correo1']=$correo[0];
$la_Campos['Correo2']=$correo[1];
$la_Campos['CorreoT']=$correo[0].'@'.$correo[1];

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
			<h2>Pastoral</h2>
		<form name="form1" action="../controladores/cor_Pastoral.php" method="POST">
			<?php $lobj_Cuerpo->f_Control($la_Campos); ?>
			<table><tr>
			<td><label>Codigo </label></td>
			<td><input type="text" validar="" name="Codigo" requerido="obligatorio"  value="<?php print($la_Campos['Codigo']);?>" onblur="f_PerderFocus();"/> <img src="imagenes/asterisco.png"></td>
			</tr><tr><td><label>Nombre </label></td>
			<td><input type="text" validar="solo letras" title="Nombre de Pastoral" requerido="obligatorio" name="Nombre"  value="<?php print($la_Campos['Nombre']);?>" /><img src="imagenes/asterisco.png"></td>
			</tr><tr><td><label>Mision </label></td>
			<td><textarea validar="" name="Mision"  requerido="obligatorio" value="" /><?php print($la_Campos['Mision']);?></textarea><img src="imagenes/asterisco.png"></td>
			</tr><tr><td><label>Vision </label></td>
			<td><textarea validar="" name="Vision"  requerido="obligatorio"  value="" /><?php print($la_Campos['Vision']);?></textarea><img src="imagenes/asterisco.png"></td>
			</tr><tr><td><label>Dia Encuentro</label></td>
			<td><textarea validar="" name="Dia_Encuentro" title="Seleccione un Dia para su Encuetro" requerido="obligatorio" value="" /><?php print($la_Campos['Dia_Encuentro']);?></textarea><img src="imagenes/asterisco.png"></td></tr>    
			</tr><tr><td><label>Correo </label></td>
			<td>
				<input type="text" placeholder="" validar=" " size="5" maxlength="20 " name="ini" requerido="obligatorio"  value="<?php print($la_Campos['Correo1']);?>"/><L style="color:white;">@
					<select name="correo" >
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
               </L><img src="imagenes/asterisco.png">
			</td></tr>
		
			</tr><tr><td><label>Parroquia</label></td>
			<td><select name="Parroquia">
				<option value="-">Seleccione</option>
				<?php $lobjCombo->fGenerar("SELECT *FROM parroquia","codigo","nombre",$la_Campos['Parroquia'],''); ?>
			</select></td></tr>			</table>
				<input type="hidden" name="Correo" value="<?php  print($la_Campos['CorreoT']);?>"> 

		</div>
			<?php $lobj_Cuerpo->f_BotonNuevo();?>
		</form>
</div>
	<?php $lobj_Cuerpo->f_Pie();?>
	
	</div>
	</center>
</body>
<script type="text/javascript">
		function f_arreglar(){
		document.form1.Correo.value=document.form1.ini.value+'@'+document.form1.fin.value;
	}
	</script>
<script src="JS/motorValidaciones.js"></script>
<script src="JS/maestros.inicio.js"></script>
</html>
