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
$la_Nombres=Array("Codigo","Nombre","");

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
<body onload="cargar(<?php if(isset($_GET['buscar'])) echo 1;else echo 0;?>)"  >
	<center>
	<div Contenedor>
	<?php $lobj_Cuerpo->f_Cabecera();?>
			<?php $lobj_Cuerpo->f_Menu();?>
		<div formulario>
			<h2>Archiprestasgo</h2>
		<form name="form1" action="../controladores/cor_Archi.php" method="POST">
			<?php $lobj_Cuerpo->f_Control($la_Campos); ?>
			<table>
				<tr>
					<td>
						<label>Codigo </label>
					</td>
					<td>
						<img src="imagenes/asterisco.png"><a class="tooltip" ><input type="text" validar="solo numeros" requerido="obligatorio" name="Codigo"  value="<?php print($la_Campos['Codigo']);?>" onblur="f_PerderFocus();"/><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Codigo autoincrementable</em>codigo con que se<br>identifica la Diocesis</span></a><br><br></td>
				
				</tr>
				<tr>
					<td>
						<label>Nombre </label>
					</td>
					<td>
						<img src="imagenes/asterisco.png"><a class="tooltip" ><input type="text" validar="solo letras" placeholder="Ingrese Nombre"  title="Ingrese Nombre" requerido="obligatorio" name="Nombre"  value="<?php print($la_Campos['Nombre']);?>"/><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Codigo autoincrementable</em>codigo con que se<br>identifica la Diocesis</span></a><br><br>
					</td>
				</tr>
				<tr>
					<td>
						<label>Diocesis </label>
					</td>
					<td>			
						<img src="imagenes/asterisco.png"><a class="tooltip" ><select requerido="obligatorio" name="Diocesis">
							<option value='-'>Seleccione</option>
							<?php $lobjCombo->fGenerar("SELECT *FROM diocesis","codigo","nombre",$la_Campos['Diocesis']);?>
						</select><span class="custom info"><img src="imagenes/Info.png" alt="Informacion" height="48" width="48" /><em>Codigo autoincrementable</em>codigo con que se<br>identifica la Diocesis</span></a><br><br>
					</td>
				</tr>
			
			</table>
			
		</div>
		<?php $lobj_Cuerpo->f_BotonNuevo();?>	
		</form>
		<div class='ordenar'></div>
	<?php $lobj_Cuerpo->f_Pie();?>
	</div>
	</div>
	</center>
	<?php $lobj_Cuerpo->f_Listar($la_listados,$la_Nombres,$la_Campos["pg"],$la_Campos["valor"],"Actividad");?>
</body>
<script src="JS/motorValidaciones.js"></script>
<script src="JS/maestros.inicio.js"></script>
</html>
