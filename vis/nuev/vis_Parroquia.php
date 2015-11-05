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
$la_Nombres=Array("Codigo","Nombre","Parroquia","Municipio","Estado");
$Fecha=explode('-', $la_Campos['Fecha_Creacion']);
$correo=explode('@', $la_Campos['Correo']);
$la_Campos['CorreoT']=$correo[0].'@'.$correo[1];

$tele=explode('-', $la_Campos['Telefono']);
$la_Campos['Telefono']=$tele[1];
$la_Campos['Telefono1']=$tele[0].'-'.$tele[1];
$la_Campos['Correo1']=$correo[0];
$la_Campos['Correo2']=$correo[1];
$la_Campos['Fecha_Creacion']=$Fecha[2].'-'.$Fecha[1].'-'.$Fecha[0];
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
		
<link rel="stylesheet" type="text/css" href="css/prueba.css">
		

</head>
<body onload="cargar(<?php if(isset($_GET['buscar'])) echo 1;else echo 0;?>)">
	<center>
	<div Contenedor>
	<?php $lobj_Cuerpo->f_Cabecera();?>
			<?php $lobj_Cuerpo->f_Menu();?>
		<div formulario>
			<h2>Parroquia</h2>
		<form name="form1" action="../controladores/cor_Parroquia.php" method="POST">
			<?php $lobj_Cuerpo->f_Control($la_Campos); ?>
			<table><tr>
			<td><label>Codigo </label></td>
			<td><img src="imagenes/asterisco.png"><input type="text" validar="" name="Codigo" requerido="obligatorio"  value="<?php print($la_Campos['Codigo']);?>" onblur="f_PerderFocus();"/></td><td><label>Archiprestasgo</label></td>
			<td> <img src="imagenes/asterisco.png"><select name="Codigo_Archipreztasgo">
					<option value='-'>seleccione</option>
					<?php $lobjCombo->fGenerar("select *from archiprestasgo","codigo","nombre",$la_Campos['Codigo_Archipreztasgo']); ?>
				</select> </td></tr>
			<tr><td><label>Nombre </label></td>
			<td><img src="imagenes/asterisco.png"><input type="text" validar="solo letras" placeholder="Nombre de Parroquia"  requerido="obligatorio" name="Nombre"  value="<?php print($la_Campos['Nombre']);?>" /></td><td><label>Telefono </label></td>
			<td><img style="margin-left:-57px;" src="imagenes/asterisco.png"><font >
				<select name="cod" >
					<option value='-'>Seleccione</option>
					<option <?php if($la_Campos['cod']==6){ print('selected');}?> value='6'>0255</option>
					<option <?php if($la_Campos['cod']==7){ print('selected');}?> value='7'>0256</option>
					<option <?php if($la_Campos['cod']==1){ print('selected');}?> value='1'>0412</option>
					<option <?php if($la_Campos['cod']==2){ print('selected');}?> value='2'>0414</option>
					<option <?php if($la_Campos['cod']==3){ print('selected');}?> value='3'>0416</option>
					<option <?php if($la_Campos['cod']==4){ print('selected');}?> value='4'>0424</option>
					<option <?php if($la_Campos['cod']==5){ print('selected');}?> value='5'>0426</option>
				</select>
				<input type="text" placeholder="" onblur="tel()" size="5" maxlength="7" validar="solo numeros" name="telefono" requerido="obligatorio"  value="<?php print($la_Campos['Telefono']);?>" </td>

			<tr><td><label>Mision </label></td>
			<td><font style="margin-left:15px;"><textarea validar="" name="Mision" value="" /><?php print($la_Campos['Mision']);?></textarea></td>
			<td><label>Fecha <br></label><label>Creacion </label></td>
			<td><img style="margin-left:-60px;" src="imagenes/asterisco.png"><input type="text" placeholder="" validar="" name="Fecha_Creacion" onblur="f_Fecha();" value="<?php print($la_Campos['Fecha_Creacion']);?>"/></td></tr>
			
			<tr><td><label>Vision </label></td>
			<td><font style="margin-left:15px;"><textarea validar="" name="Vision"  value="" /><?php print($la_Campos['Vision']);?></textarea></td>
			<td><label>Direccion </label></td>
			<td><img style="margin-left:-10px;"  src="imagenes/asterisco.png"><textarea validar="" name="Direccion" placeholder="Ejemplo Av.32, con Calle 40"  requerido="obligatorio" value="" /><?php print($la_Campos['Direccion']);?></textarea></td></tr></tr>
			
			<tr><td><label>Correo </label></td>
				<td><img src="imagenes/asterisco.png">
					<font style="margin-left:-4px;"><input type="text" placeholder="" validar=" " size="5" maxlength="30 " name="ini" value="<?php print($la_Campos['Correo1']);?>"/><L style="color:white">@</L>
					<font style="margin-left:-4px;">
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
				</td>
			
				<td colspan="2">
					<font style="margin-left:170px;"><input type="button" name="Siguiente" onclick="agregar()" value="Agresar Historial">
				</td>
			</tr>
			
		<tr>
	</tr>
		
			</table>
		<div id="agregar"></div>

				<input type="hidden" name="Telefono" value="<?php print($la_Campos['Telefono1']);?>">
				<?php $lobj_Cuerpo->f_BotonNuevo();?>
			</div>
				
				<input type="hidden" name="Correo" value="<?php  print($la_Campos['CorreoT']);?>"> 

			</form>
			<div class='ordenar'></div>

	<?php $lobj_Cuerpo->f_Pie();?>
	</div>
	</div>
	</center>
	<?php $lobj_Cuerpo->f_Listar($la_listados,$la_Nombres,$la_Campos["pg"],$la_Campos["valor"],"Parroquia");?>
</body>
<script type="text/javascript">
	function tel(){
		document.form1.Telefono.value=document.form1.cod.value+'-'+document.form1.telefono.value;

	}
	function f_arreglar(){
		document.form1.Correo.value=document.form1.ini.value+'@'+document.form1.fin.value;
	}
	function f_Fecha(){
        var fecha=document.form1.Fecha_Creacion.value.split('-');
        var dia = new Date();
		
		var diaa=dia.getDate();
    	var mes=dia.getMonth()+1;
    	var ano= dia.getFullYear();

    	var dias=parseInt(fecha[0]);
      	var meses=parseInt(fecha[1]);
      	var anos=parseInt(fecha[2]);

      	if(ano<anos){
      		alert("Fecha no validad");
      		document.form1.Fecha_Creacion.value="";
      	}else if(ano==anos){
      		if(mes<meses){
      			alert("Fecha no validad");
      			document.form1.Fecha_Creacion.value="";
      		}else if(mes==meses){
      			if(diaa<dias){
      				alert("Fecha no validad");
      				document.form1.Fecha_Creacion.value="";
      			}else if(diaa==dias){
     				alert("Fecha no validad");
      				document.form1.Fecha_Creacion.value="";
 
      			}
      		}
      	}
    
    }
  

</script>
<script type="text/javascript" >
	var A=0;
function agregar(){
	<?php $ls_Sql="select *from persona where(tipo='S')";?>
	var contenedor=document.getElementById("agregar");
	var newElement=document.createElement('div');
	var campos="<input list='newCamp0-"+A+"' id='newCamp0-"+A+"' name='newCamp0-"+A+"'><datalist><?php $lobjCombo->fGenerar($ls_Sql,'cedula','nombre','',''); ?></datalist><input type='text' name='newCamp1-"+A+"'><input type='text' name='newCamp2-"+A+"'>";
	var botones="<input type='button' value='eliminar' onclick='eliminar(this)'><input type='button' value='modificar'>";
	newElement.innerHTML=campos+botones;
	newElement.id="Registro"+A;	
	contenedor.appendChild(newElement);
	A++;
}
function eliminar(oldElement){
	var divContenedor=oldElement.parentNode;
	divContenedor.parentNode.removeChild(divContenedor);
	gestionDeRegistros();
	A--;
}
function gestionDeRegistros(){
	var Registro;
	var Campo;
	for(var x=0;x<A;x++){
		if(!document.getElementById("Registro"+x)){
			if(document.getElementById("Registro"+parseInt(x+1))){
				Registro=document.getElementById("Registro"+parseInt(x+1));
				Registro.id="Registro"+x;
				Campo=Registro.firstChild;
				for(var y=0;y<Registro.childNodes.length-2;y++){
					if(y!=0){
						Campo=Campo.nextSibling;
					}
					Campo.name="newCamp"+y+"-"+x;
					Campo.id="newCamp"+y+"-"+x;
				}
			}
		}
	}
}
</script>

<script src="JS/motorValidaciones.js"></script>
<script src="JS/maestros.inicio.js"></script>
</html>
