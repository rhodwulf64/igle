<?php



$objetivo=$_GET['lsObj'];
${$lsSexo."ada"}="selected";
if ($objetivo!=""){
echo utf8_Decode('

	<div class="formuLeft">
		<form name="fr_Persona" action="../cntller/cn_personas.php" method="post">
		<table id="tablaReg" border="1" class="Registros_tabla">
		<tr>
			<td colspan="2" align="center"><font class="Registros_tabla_titulo">Inscripción de '.$objetivo.'</font></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">CI del '.$objetivo.'</font></td>
			<td><input type="text" name="f_cedula" class="Registros_tabla_campos" value="'.$lsCedulaRepre.'" disable></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Nombres del '.$objetivo.':</font></td>
			<td><input type="text" name="f_nombres" class="Registros_tabla_campos" value="'.$lsNombre.'"></td>
		</tr>		
		<tr>
			<td><font class="Registros_tabla_descripciones">Apellidos del '.$objetivo.':</font></td>
			<td><input type="text" name="f_apellidos" class="Registros_tabla_campos" value="'.$lsApellido.'"></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Sexo:</font></td>
			<td><select name="f_sexo" id="Sexo" value=""><option value="N" '.$Nada.'><p><strong></strong></p></option><option value="F" '.$Fada.'><p><strong>F</strong></p></option><option value="M" '.$Mada.'><p><strong>M</strong></p></option></select></td>

		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Fecha de Nacimiento:</font></td>
			<td><input type="text" name="f_fechaNac" class="Registros_tabla_campos" value="'.$lsFechaNaci.'"></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Dirección:</font></td>
			<td><input type="text" name="f_direccion" class="Registros_tabla_campos" value="'.$lsDireccion.'"></td>
		</tr>
		<tr>
			<td><font class="Registros_tabla_descripciones">Teléfono:</font></td>
			<td><input type="text" name="f_telefono" class="Registros_tabla_campos" value="'.$lsTelefono.'"></td>
		</tr>

		<tr>
					<td colspan="2"><input type="button" class="Registros_tabla_botones" name="bins_Nuevo" value="Nuevo" onclick="Nuevo()">
					<input type="button" class="Registros_tabla_botones" name="bins_Modificar" value="Modificar" onclick="Modificar()">
					<input type="button" class="Registros_tabla_botones" name="bins_Buscar" value="Buscar" onclick="Buscar()">
					<input type="button" class="Registros_tabla_botones" name="bins_Eliminar" value="Eliminar" onclick="Eliminar()">
					<input type="submit" class="Registros_tabla_botones" name="bins_Guardar" value="Guardar" onclick="Guardar()">
					<input type="button" class="Registros_tabla_botones" name="bins_Cancelar" value="Cancelar" onclick="Cancelar()"></td>
		</tr>
		
		</table>
		</form>
	</div>
'); 
}

?>
