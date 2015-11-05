<?php
session_start();
include_once("../clases/cls_Cuerpo.php");
$lobj_Cuerpo= new cls_Cuerpo();
$la_Campos=$_SESSION["Campos"];
unset($_SESSION["Campos"]);
include_once("../clases/cls_Combo.php");
$lobjCombo= new cls_Combo();
$la_listados=$_SESSION["matriz"];
unset($_SESSION["matriz"]);
//$lobj_Cuerpo->f_Redireccion();
?>
<html>
<head>
	<?php $lobj_Cuerpo->f_Librerias();?>
	<title>Registro</title>
	<script>
		laNombre=new Array("Estatus1","Estatus1","Estatus2");
		laValor=new Array("checked","bloqueado","bloqueado");
	</script>
	<style type="text/css">
fieldset {
 
    border-radius: 2px;
    width: 420px;
    height: auto;
    margin: 2px auto 0px;
    z-index: 3;
    opacity: 0.8;
    max-height: 400px;
    transition: all 1s ease 0s;
    background: white;
	box-shadow: 0px 1px 4px 0px black;
    border: 1px solid silver;	
}
legend{
	margin-left: 4px;
	background: #1B356F;
	font-weight:bold;
	border-radius: 4px;
	color: white;
	padding: 4px 4px;
}
	</style>
</head>
<body >
	<div Contenedor>
	<?php $lobj_Cuerpo->f_Cabecera();?>
			<?php $lobj_Cuerpo->f_Menu();?>
		<div formulario>
			<h2></h2>
		<form name="form1" action="../controladores/cor_Patoral.php" method="POST">
			<input type='hidden' name="Control">
			
			<?php $lobj_Cuerpo->f_Control($la_Campos); ?>
			<fieldset><legend>Asignar Feligreses a Pastoral</legend>
				<table id="Agregar">
					<tr>
						<td>Parroquia</td>
						<td>
							<select name="Parroquia" id="padre" onchange="f_Cambio(this)">
								<option value="-">Selecciona</option>	
								<?php $lobjCombo->fGenerar("Select *from parroquia ","codigo","nombre"); ?>
							</select>
						</td>
						<td>Pastoral</td>
						<td>
							<input list="Grupo" validar="solo letras" name="Pastoral" onblur="f_Blo();" value="<?php print($la_Campos['Grupo']);?>"/><br>
								<datalist id="Grupo" >
									
								</datalist>
								<datalist id="Grupo-2" >
										<?php $lobjCombo->fGenerar("Select * from pastoral ;","codigo","nombre","","codigo_parr"); ?>
								</datalist>
						</td>
								
					</tr>
					
				</table>
			</fieldset>
			<fieldset>
				<table style="margin-left:35%;">
					<tr>
						<td>
							<input  value='agregar'  onclick="agregar()" type="button">	
						</td>
						<td>
							<input  value='Guardar'  onclick="Guardar()" type="button">			
						</td>
						</tr>
				</table>
			</fieldset>
		
				</div>
		
		</form>
		<div class='ordenar'></div>
	<?php $lobj_Cuerpo->f_Pie();?>
	</div>
	</div>
</body>

<script type="text/javascript">

	var x=0;
	var s=0;	
	function f_Cambio(obj){
		var hijo=document.getElementById("Grupo");
		var hijos=document.getElementById("Grupo").childNodes;
		var hijo2=document.getElementById("Grupo-2").childNodes;
		var value=obj.value;
		var opcion;
		for(var x=0;x<hijos.length;x++){
			if(hijos[x].nodeName!="#text"){
				hijo.removeChild(hijos[x]);
			}
		}
		for(var x=0;x<hijo2.length;x++){
			if(hijo2[x].nodeName!="#text"){
				if(hijo2[x].className=="hijo "+value){
					opcion=document.createElement("option");
					opcion.value=hijo2[x].value;
					opcion.textContent=hijo2[x].textContent;
					hijo.appendChild(opcion);
				}
			}
			
		}
		hijo.value="-";
	}									
	function agregar(){
		
		<?php $ls_Sql=" select *,concat(apelido,'-',nombre,'-',cedula) as nombres from persona where(tipo='F')";?>
		
		nuevoCampo =document.getElementById("Agregar").insertRow(-1);
		nuevoCampo.id=x;
		nuevoEspacio=nuevoCampo.insertCell(-1);
		nuevoEspacio.innerHTML="<td>Feligres</td>";					
		nuevoEspacio=nuevoCampo.insertCell(-1);
		nuevoEspacio.innerHTML="<td><select name='Cedula"+x+"'><option value='-'>Seleccione</option><?php $lobjCombo->fGenerar2($ls_Sql,'cedula','nombres','','');?></select></td>";
		nuevoEspacio=nuevoCampo.insertCell(-1);
		nuevoEspacio.innerHTML="<td><input size='5' type='button' value='eliminar' onclick='eliminar(this)'></td>";
		x++;
	}
	function eliminar(obj){
		x--;
		s--;		
		var oTr = obj; 
		while(oTr.nodeName.toLowerCase()!='tr'){
		   oTr=oTr.parentNode; 
		}
		var root = oTr.parentNode;
		root.removeChild(oTr); 
	}
	function Guardar(){
		if(document.form1.Parroquia.value!="") {
			if(document.form1.Grupo.value!=""){
			document.form1.Control.value=x;
			document.form1.submit();
		}else{
			alert("Ingrese todos los campos son Obligatorios");

		}
		}else{

			alert("Ingrese todos los campos son Obligatorios");
		}
	}
		function f_Blo(){
		document.form1.Grupo.disabled="true";
	}

</script>
</html>
