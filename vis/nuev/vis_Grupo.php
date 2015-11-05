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
			<h2>Grupo de Apostolado</h2>
		<form name="form1" action="../controladores/cor_Grupo.php" method="POST">
			<?php $lobj_Cuerpo->f_Control($la_Campos); ?>
			<table><tr>
			<td><label>Codigo </label></td>
			<td>
				<img src="imagenes/asterisco.png"><a class="tooltip" ><input type="text" validar="" name="Codigo"  requerido="obligatorio" value="<?php print($la_Campos['Codigo']);?>" onblur="f_PerderFocus();"/><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Codigo auto-incrementable</em>Con que se<br>identifica el Grupo de Apostolado</span></a><br><br>
			</td>
			</tr><tr><td><label>Nombre </label></td>
			<td>
				<img src="imagenes/asterisco.png"><a class="tooltip" ><input type="text" validar="solo letras" name="Nombre" title="Nombre de la Parroquia" requerido="obligatorio" value="<?php print($la_Campos['Nombre']);?>" /><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Nombre</em>Con que se<br>identifica el Grupo de Apostolado</span></a><br><br>
			</td>
			</tr><tr><td><label>Mision </label></td>
			<td>
				<img src="imagenes/asterisco.png"><a class="tooltip" ><textarea validar=" " name="Mision" value="" /><?php print($la_Campos['Mision']);?></textarea><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Describa la Mision</em> del Grupo de Apostolado</span></a><br><br><br>
			</td>
			</tr><tr><td><label>Vision </label></td>
			<td>
				<img src="imagenes/asterisco.png"><a class="tooltip" ><textarea validar=" " name="Vision" value="" /><?php print($la_Campos['Vision']);?></textarea><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Perspectivas y Metas Deseadas</em>Por y Para el Grupo de Apostolado</span></a><br><br><br>
			</td>
			</tr><tr><td><label>Correo Electronico </label></td>
			<td>
				<img src="imagenes/asterisco.png"><a class="tooltip" ><input type="text" placeholder="" validar" " size="5" maxlength="20 " title="Ingrese Nombre y Extencion" name="ini" value="<?php print($la_Campos['Correo1']);?>"/><L style="color:white;">@
					<select style="margin-left:0px;"name="correo" >
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
						</select><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Indique de Forma especifica el correo del Grupo de Apostolado</em>y elija su extencion segun el Tipo</span></a><br><br>
				</L>
			</td></tr>
		
			</tr>
			<tr>
				<td><label>Dia de Encuentro</label></td>
				<td>
					<img src="imagenes/asterisco.png"><a class="tooltip" ><select name="Dia">
						<option value="Lunes">Lunes</option>
						<option value="Martes">Martes</option>
						<option value="Miercoles">Miércoles</option>
						<option value="Jueves">Jueves</option>
						<option value="Viernes">Viernes</option>
						<option value="Sábado">Sábado</option>
						<option value="Domingo">Domingo</option>
					</select><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Indique de Forma especifica el dia de encuentro</em>o Reunion del Grupo de Apostolado</span></a><br><br>
				</td>
			</tr>
			<tr><td><label>Lugar de Encuentro </label></td>
			<td><img src="imagenes/asterisco.png"><a class="tooltip" ><textarea validar=" " name="Lugar"/><?php print($la_Campos['Lugar']);?></textarea><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Indique especificamente el lugar de encuentro</em>o Reunion del Grupo de Apostolado</span></a><br><br><br></td>
			</tr>
			<tr><td><label>Parroquia</label></td>
			<td><img src="imagenes/asterisco.png"><a class="tooltip" ><select name="Parroquia">
				<option value="-">Seleccione</option>
				<?php $lobjCombo->fGenerar("SELECT *FROM parroquia","codigo","nombre",$la_Campos['Parroquia'],''); ?>
			</select><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Indique de Forma especifica el dia de encuentro</em>o Reunion del Grupo de Apostolado</span></a><br><br></td></tr>
			</table>
				<input type="hidden" name="Correo" value="<?php  print($la_Campos['CorreoT']);?>"> 

	
		<?php $lobj_Cuerpo->f_BotonNuevo();?>	
		</div>
			
		</form>
		<div class='ordenar'></div>
	<?php $lobj_Cuerpo->f_Pie();?>
	</div>
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
