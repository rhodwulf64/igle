<?php

    session_start();
    if(!array_key_exists("usuario", $_SESSION)) 
	{
		header("location: visSalir.php");
	}
	require_once("menu_principal.php");
	require_once("encabezado.php");
	require_once("../clases/clsFuncionesGlobales.php");

  

		$loFuncion =new clsFunciones;
		$objetivo=$loFuncion->fTipoPersona($lsObj);


    $lsOperacion=$_GET["lsOperacion"];
	$lsHacer=$_GET["lsHacer"];
	$liHay=$_GET["liHay"];
	
	$lsCedulaRepre=$_GET["lsCedula"];
	$lsNombre=$_GET["lsNombre"];
	$lsApellido=$_GET["lsApellido"];
	$lsSexo=$_GET["lsSexo"];
	${$lsSexo."ada"}="selected";
	$lsFechaNaci=$_GET["lsFechaNaci"];
	$lsDireccion=$_GET["lsDireccion"];
	$lsTelefono=$_GET["lsTelefono"];
	$lsFechaRegistro=$_GET["lsFechaRegistro"];
	$selectGradoEstudio=$_GET["cmb_gradoEstu"];
	$selectTallaFrane=$_GET["cmb_tallaFrane"];
	
	echo utf8_Decode('
<!DOCTYPE html>
<html lang="es">
  <head>
		<title>'.$_SESSION['title'].' - Lista de Actividades Diocesanas</title>

	');
			print(encabezado_menu("../"));

echo utf8_Decode('
		</head>

	<body>
<div class="mygrid-wrapper-div">
<div class="container pre-scrollable" style="margin-top:5px; min-height: 530px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">

	');

	encab("../"); //logo de la iglesia
	menu_general(""); //menu principal

	echo utf8_Decode('
		<form name="fr_Persona" action="reportes/listaAgendas.php" method="post">
				<div class="col-lg-12">
					<table class="table table-striped table-bordered table-hover"  border="1" >
						<thead>		
							<tr>
								<th colspan="3"><center>Listado de Agenda de Actividades Diocesanas</center></th>
							</tr>
						</thead>

						<tr>
							<th>
								<center>
									<font class="control-label">Fecha de inicio:</font><input type="date" min="1970-01-01" max="2099-01-01" id="f_Inicio" name="f_Inicio" style="width:180px;" class="form-control" onblur="vValidaRangoFecha(this.id)" value="">
									<font class="control-label">Fecha de fin:</font><input type="date" min="1970-01-01" max="2099-01-01" id="f_Fin" name="f_Fin" style="width:180px;" class="form-control" onblur="vValidaRangoFecha(this.id)" value="">
								</center>
							</th>
						</tr>
					</table>
					<table class="table table-striped table-bordered table-hover"  border="1" >
						<thead>		
							<tr>
							<th></th>
							<th width="15%">
								<input type="checkbox" name="option1" value="1"> Activos<br>
								<input type="checkbox" name="option0" value="0"> Anulados<br>
							</th>
							<th></th>
							</tr>
						</thead>
					</table>			
								
								

			
					<br>
				</div>
			</div>
		<div class="container" style="margin-top:5px; padding:5px; min-height: auto; background: #FFFFFF; -webkit-box-shadow: 0px 2px 5px 2px #999; -moz-box-shadow: 2px 2px 5px #999;">
			<table class="table table-striped table-bordered table-hover" border="1" style="margin:0px">
				<tr>
					<th colspan="2"><center>

						<input type="hidden" name="txtOperacion" id="txtOperacion" value="'.$lsOperacion.'">
						<input type="hidden" name="txtHacer" id="txtHacer" value="'.$lsHacer.'">
						<input type="hidden" name="txtHay" id="txtHay" value="'.$liHay.'">
						<input type="hidden" name="txtTipoAgenda" id="txtTipoAgenda" value="1">
	
						<input type="submit" class="btn btn-default" name="cargar" value="cargar">
						
					</th>
				</tr>
			</table>
		</div>');

	footer(); // pie de pagina

	echo utf8_decode('</form>
</div>

</body>

</html>
'); 

?>
