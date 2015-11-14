<?php

  session_start();




require_once("vis/menu_principal.php");
require_once("vis/encabezado.php");
require_once("clases/claAgendaCitas.php");
require_once("clases/clsFuncionesGlobales.php");
$loFuncion =new clsFunciones();
$loCitas=new claAgendaCitas();

    $lsOperacion=$_GET["lsOperacion"];
	$lsHacer=$_GET["lsHacer"];
	$liHay=$_GET["liHay"];
	$inicia="";
	$titulo='<center>¿Quienes Somos?</center>';
	$texto='Nuestro Salvador, en la última Cena, la noche en que fue entregado, instituyó el Sacrificio Eucarístico de su cuerpo y su sangre para perpetuar por los siglos, hasta su vuelta, el sacrificio de la cruz y confiar así a su Esposa amada, la Iglesia, el memorial de su muerte y resurrección, sacramento de piedad, signo de unidad, vínculo de amor, banquete pascual en el que se recibe a Cristo, el alma se llena de gracia y se nos da una prenda de la gloria futura.</p>';


	if($_GET["Tag"]=="mv")
	{
		$inicia="fpmuestravision();";
	}
echo utf8_Decode('

<!DOCTYPE html>
<html lang="es">
  <head>
<title>'.$_SESSION["title"].' - Bienvenidos</title>

<style>

		div[Pie] img{
			width: 105.5px;
			height: 80px;
			margin: 5px 0px;
			border-radius: 3px;

		}



		div[Pie] img:hover{
			box-shadow: 2px 2px 15px #184B7C;
		}

		img[cand]:hover{
			box-shadow: 1px 1px 3px green;
		}
</style>
		');
print(encabezado_menu(""));
	if ($_SESSION["message"]!="")
	{
		echo utf8_Decode('<script>setTimeout(function(){ NotificaE("'.$_SESSION["message"].'"); }, 150);</script>');
		$_SESSION["message"]="";
	}

	echo utf8_Decode('
    <link rel="stylesheet" href="css/bootstrap-social/bootstrap-social.css">
	<script>
		function fpmuestravision()
	{
		var titulo="'.$titulo.'";
		var texto="'.$texto.'";
	document.getElementById("modiTitulo").innerHTML=titulo;
	document.getElementById("modiTexto").innerHTML=texto;

	}




		</script>');

echo('</head><body onload="'.$inicia.'"><div class="mygrid-wrapper-div"><div class="container" style=" min-height: 530px; margin-top:5px; background: #FFFFFF; -webkit-box-shadow: 2px 0px 10px 2px #999; -moz-box-shadow: 2px 0px 10px 2px #999; box-shadow: 2px 0px 10px 2px #999;">');
encab("");
menu_general("vis/");

echo utf8_decode('

					<div class="row">
						<div class="col-lg-8">
						<br>
	');
  if(!array_key_exists("usuario", $_SESSION)) 
	{
						

echo utf8_decode('
				

						 

				<div class="panel panel-info">
                        <div class="panel-heading">
                            Diócesis de Acarigua-Araure
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <a class="btn btn-block btn-social btn-vk">
                                <i class="fa fa-arrow-circle-o-up"></i> Archiprestasgo NORTE
                            </a>
                            <a class="btn btn-block btn-social btn-dropbox">
                                <i class="fa fa-arrow-circle-o-down"></i> Archiprestasgo SUR
                            </a>
                            <a class="btn btn-block btn-social btn-vk">
                                <i class="fa fa-dot-circle-o"></i> Archiprestasgo CENTRO
                            </a>
                            <a class="btn btn-block btn-social btn-dropbox">
                                <i class="fa fa-compass"></i> Archiprestasgo FORANEO
                            </a>
                            <a class="btn btn-block btn-social btn-instagram">
                                <i class="fa fa-arrows-alt"></i> PASTORALES DIOCESANAS
                            </a>
                    	</div>
                    <!-- /.panel-body -->
                </div>




							<div class="panel panel-info">
							    <div class="panel-heading" id="modiTitulo">
		                       		<center>Diócesis Acarigua-Araure</center>
		                        </div>
		                        <div class="panel-body" id="modiTexto">
		                            <p align="justify" style="text-indent: 40px;">Por exigencia radical de su catolicidad, obediente al mandato de su Fundador, se esfuerza en anunciar el Evangelio a todos los hombres. Sus sucesores están obligados a perpetuar esta obra, a fin de que la palabra de Dios se difunda y glorifique y el reino de Dios sea anunciado y establecido en toda la tierra".</p>
		                        </div>
		                        <div class="panel-footer">
		                            
		                        </div>
	                    	</div>

						');
	}
	else
	{

		if ($_SESSION["rol"]=="O")
		{
			echo utf8_decode('
				<div class="panel panel-info">
					<form name="fr_Busqueda" id="fr_Busqueda">
	                    <div class="panel-heading">
	                        Citas Pendientes 
	                       	<div class="col-md-5 pull-right">
	                       		<div class="input-group">
	                       			<input type="text" class="form-control" placeholder="Cedula Feligres, Nro Solicitud" style="z-index:1">
	                       			<span class="input-group-addon"><span class="fa fa-search fa-lg"></span></span>
	                       		</div>
	                       	</div>
	                    </div>
	                </form>
	                    <!-- /.panel-heading -->
	                    <div class="panel-body">');
			$arrCitas=$loCitas->fpListaCitasSecretaria();
			echo utf8_decode('
 			<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Feligres</th>
                                            <th>Nro Solicitud</th>
                                            <th>Tipo de Cita</th>
                                            <th>Fecha de Cita</th>
                                            <th>Hora de Cita</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>');
			for($i=0;$i<count($arrCitas);$i++)
			{
				switch ($arrCitas[$i]['EstadoSolicitud']) 
				{
					case 0:
						$estadoCita='info';
						break;
					case 1:
						$estadoCita='success';
						break;
					case 2:
						$estadoCita='warning';
						break;
					case 3:
						$estadoCita='danger';
						break;

					default:
						$estadoCita='info';
						break;
				}			
            echo utf8_decode('  <tr class="'.$estadoCita.'">
                                    <td>'.intval($i+1).'</td>
                                    <td>'.$arrCitas[$i]['Cedula'].' '.$arrCitas[$i]['Nombres'].' '.$arrCitas[$i]['Apellidos'].'</td>
                                    <td>'.$arrCitas[$i]['idTSolicitud'].'</td>
                                    <td>'.$arrCitas[$i]['descripcion'].'</td>
                                    <td>'.$loFuncion->fDameFechaEscrita($arrCitas[$i]['FechaCita']).'</td>
                                    <td>'.$loFuncion->fDameHoraEstandar($arrCitas[$i]['HoraCita']).'</td>
                                    <td><div class="controls form-inline" style="display:flex;"><input type="button" dato="'.$arrCitas[$i]['idTSolicitud'].'" class="btn btn-success" style="width: 75px; display:inline-block;" name="b_Proc" value="Procesar" onclick=""> <input type="button" dato="'.$arrCitas[$i]['idTSolicitud'].'" style="width: 90px; display:inline-block;" class="btn btn-warning" name="b_susp" value="Suspender" onclick=""></div></td>
                                </tr>');
			}
            echo utf8_decode('
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
			');
			echo utf8_decode('
	                	</div>
	                <!-- /.panel-body -->
	            </div>');
		}
		elseif ($_SESSION["rol"]=="F")
		{
			echo utf8_decode('
				<div class="panel panel-info">
	                    <div class="panel-heading">
	                       Mis Citas Pendientes
	                    </div>
	                    <!-- /.panel-heading -->
	                    <div class="panel-body">');
			$loCitas->asidtPersona=$_SESSION["IDTpersona"];
			$arrCitas=$loCitas->fpListaCitasFeligres();
			echo utf8_decode('
 			<div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tipo de Cita</th>
                                            <th>Requisitos</th>
                                            <th>Fecha de Cita</th>
                                            <th>Hora de Cita</th>
                                        </tr>
                                    </thead>
                                    <tbody>');
			for($i=0;$i<count($arrCitas);$i++)
			{
            echo utf8_decode('  <tr class="success">
                                    <td>'.$arrCitas[$i]['idTSolicitud'].'</td>
                                    <td>'.$arrCitas[$i]['descripcion'].'</td>
                                    <td>'.$arrCitas[$i]['requisitos'].'</td>
                                    <td>'.$loFuncion->fDameFechaEscrita($arrCitas[$i]['FechaCita']).'</td>
                                    <td>'.$loFuncion->fDameHoraEstandar($arrCitas[$i]['HoraCita']).'</td>
                                </tr>');
			}
            echo utf8_decode('
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
			');
			echo utf8_decode('
	                	</div>
	                <!-- /.panel-body -->
	            </div>');
		}
		else
		{	
				echo utf8_decode('
					<div class="panel panel-info">
		                    <div class="panel-heading">
		                        Bienvenido
		                    </div>
		                    <!-- /.panel-heading -->
		                    <div class="panel-body">
		                	</div>
		                <!-- /.panel-body -->
		            </div>');
		}
	}
	echo utf8_decode('
</div>
	<div class="col-lg-4">
		<br>

		');

					  if(array_key_exists("usuario", $_SESSION)) 
						{
						
						echo utf8_decode('
										<div class="panel panel-primary">
					                       	<div class="panel-heading">
					                            Acceso Concedido (Bienvenido)
					                        </div>
					                        <div class="panel-body">
					                            
														<center>'.$_SESSION["nombreUsuario"].'.</center>
														<br>	
														<center><img src="vis/img/old/'.$_SESSION["sexoUsuario"].'Profile.png" alt="Imagen de Perfil"></center>											
					                        </div>
					                        <div class="panel-footer">
														<center><a href="vis/visSalir.php">Cerrar Sesión</a></center>
					                        </div>
					                    </div>');
						}
						else
						{
						
						echo utf8_decode('
							
						<form name="fr_InicioSesion" action="cntller/cValidaUser.php" method="post" autocomplete="off">
							<div class="panel panel-primary">
		                       	<div class="panel-heading">
		                            Acceso Usuario
		                        </div>
		                        <div class="panel-body">
		                            
											<font class="control-label">Usuario:</font>
											<input type="text" class="form-control" name="textUsuario" maxlength="8" onkeypress="vSoloNumeros()">
										
										
											<font class="control-label">Clave:</font>
											<input type="password" class="form-control" maxlength="25" name="textClave">
										
		                        </div>
		                        <div class="panel-footer">
												<input type="hidden" class="btn btn-default" name="txtOperacion" id="txtOperacion" value="'.$lsOperacion.'">
												<input type="hidden" class="btn btn-default" name="txtHacer" id="txtHacer" value="'.$lsHacer.'">
												<input type="hidden" class="btn btn-default" name="txtHay" id="txtHay" value="'.$liHay.'">
												<input type="submit" class="btn btn-dropbox" name="bsubmit" value="Entrar">  <input type=button class="btn btn-vk" onClick="parent.location=\'vis/recuperar.php\'" value="¿Olvido Su Contraseña?">
		                        </div>
		                    </div>
						</form>
							<div class="panel panel-warning">
		                       	<div class="panel-heading">
		                            Panel para Feligres
		                        </div>
		                        <div class="panel-body" align="justify">
		                            Si aún no se ha registrado presione el botón "Registrar Nuevo Feligres", de esta manera podrá realizar las solicitudes que usted desee.
										
										
		                        </div>
		                        <div class="panel-footer">
												<input type=button class="btn btn-vk" onClick="parent.location=\'vis/usuarioPublico.php\'" value="Registrar Nuevo Feligres">
		                        </div>
		                    </div>


		                    ');
						}
			if(!array_key_exists("usuario", $_SESSION)) 
			{
						
							echo utf8_decode('
							<center>
								<div redes>
								 	<img src="vis/img/old/papa.gif" class="img-rounded" width="49%" height="220" alt="Diócesis Acarigua-Araure">
								 	<img src="vis/img/old/imagen.gif" class="img-rounded" width="49%" height="220" alt="Diócesis Acarigua-Araure">
									
								</div>
								<br>
								<div class="panel panel-primary">
			                        <div class="panel-heading">
			                            Síguenos en:
			                        </div>
			                        <div class="panel-body">
			                          	<a title="Twitter" href="https://twitter.com/DiocesisA"><img title="Twitter" src="vis/img/old/twitter.png" width="100px" height="100px" style="margin-left:35px; ">
										<a title="Facebook" href="https://www.facebook.com/profile.php?id=100004937207282"><img title="Facebook" src="vis/img/old/facebook.png" width="100px" height="100px" style="float:right; margin-right:35px; ">
			                        </div>
			  
			                    </div>
									<br><br>
							</center> ');
			}
echo utf8_decode('

						</div>
				</div>
<center>		   
<div Pie>
	<div enlaces>
		<a target="_blanck" href="http://www.es.catholic.net/"><img title="Catholic" src="vis/img/old/catholicnet.jpg"></a>
		<a target="_blanck" href="http://www.vatican.va/content/vatican/it.html"><img title="La Santa Sede" src="vis/img/old/logo_vaticano.jpg" ></a>
		<a target="_blanck" href="http://www.seguroshorizonte.com/"><img title="Seguros Horizonte" src="vis/img/old/logo_seguros_horizonte01.jpg" ></a>
		<a target="_blanck" href="http://www.vatican.va/news_services/or/or_spa/"><img title="Observatorio Romano" src="vis/img/old/osservat3.jpg" ></a>
		<a target="_blanck" href="http://www.cev.org.ve/"><img title="Conferencia Episcopal Venezolana" src="vis/img/old/cev-logo.jpg" ></a>
		<a target="_blanck" href="http://www.unica.edu.ve/cpv/"><img title="Concilio Planario de Venezuela" src="vis/img/old/concilio_plenario_venezuela.jpg" ></a>
		<a target="_blanck" href="http://www.arquidiocesisdemerida.org.ve/"><img title="Arquidiocesis de Merida" src="vis/img/old/cropped-logo-blanco.jpg" ></a>
		<a target="_blanck" href="http://www.celam.org/"><img title="Celam" src="vis/img/old/images.jpg" ></a>
		<a target="_blanck" href="http://www.aciprensa.com/"><img title="Aci-Prensa" src="vis/img/old/descarga.jpg" ></a>
	</div>
</div>
</center>
	</div></div>

	');

	footer(); // pie de pagina

	echo utf8_decode('
</div>

</body>
<script>
	var loF=document.fr_InicioSesion;
	function fpInicio()
	{
	loF.textUsuario.focus();
		
	}

	if(loF.txtHay.value==\'2\')
	{
		NotificaE("Usuario o clave Incorrecta");
	}
	if(loF.txtHay.value==\'3\')
	{
		NotificaE("Usuario Bloqueado");
	}
	

</script>
	
</html>');

?>