<?php

	require_once("menu_principal.php");
	require_once("encabezado.php");
echo utf8_Decode('
<html>
	<head>
		<title>'.$_SESSION['title'].' - Inscripción de Comunión</title>
		');print(encabezado_menu("../"));
echo utf8_Decode('
		</head>
		<body>');
		encab("../");
		menu_general("");
	echo utf8_Decode('
	<center>
	<div class="formuRegistros">
		<form action="../con/cn_comunion.php" method="post">
		<table id="tablaReg" border="1" class="Registros_tabla">
		<tr>
			<td colspan="2" align="center"><font class="Registros_tabla_titulo">Inscripción de Comunión</font></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Nombres:</font></td>
			<td><input type="text" name="f_nombres" class="Registros_tabla_campos" value=""></td>
		</tr>		
		<tr>
			<td><font class="Registros_tabla_descripciones">Apellidos:</font></td>
			<td><input type="text" name="f_apellidos" class="Registros_tabla_campos" value=""></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Fecha de Nacimiento:</font></td>
			<td><input type="text" name="f_fechaNac" class="Registros_tabla_campos" value=""></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Dirección:</font></td>
			<td><input type="text" name="f_direccion" class="Registros_tabla_campos" value=""></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Nombre del Representante:</font></td>
			<td><input type="text" name="f_nombreRepre" class="Registros_tabla_campos" value=""></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">CI de Representante:</font></td>
			<td><input type="text" name="f_cedulaRepre" class="Registros_tabla_campos" value=""></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Teléfono:</font></td>
			<td><input type="text" name="f_telefonos" class="Registros_tabla_campos" value=""></td>
		</tr>

		<tr>
					<td colspan="2"><input type="button" class="Registros_tabla_botones" name="b_Nuevo" value="Nuevo" onclick="Nuevo()">
					<input type="button" class="Registros_tabla_botones" name="b_Modificar" value="Modificar" onclick="Modificar()">
					<input type="button" class="Registros_tabla_botones" name="b_Buscar" value="Buscar" onclick="Buscar()">
					<input type="button" class="Registros_tabla_botones" name="b_Eliminar" value="Eliminar" onclick="Eliminar()">
					<input type="button" class="Registros_tabla_botones" name="b_Guardar" value="Guardar" onclick="Guardar()">
					<input type="button" class="Registros_tabla_botones" name="b_Cancelar" value="Cancelar" onclick="Cancelar()"></td>
		</tr>
		
		</table>
		</form>
	</div>
	</center>
	</body>
</html>
'); 






?>
