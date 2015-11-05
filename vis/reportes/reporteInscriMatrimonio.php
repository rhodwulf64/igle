<?php
session_start();
	if(!array_key_exists("usuario", $_SESSION)) 
	{
		header("location: visSalir.php");
	}
	if ((empty($_GET["RPrefMatri"]))&&(!isset($_GET["RPrefMatri"])))
	{
		$_SESSION["message"]="No se pudo mostrar el reporte";
		header("location: ../../index.php");
	}
	require_once("../../clases/claMatrimonio.php");
	require_once("../../clases/clsFuncionesGlobales.php");
	$loMatrimo=new claMatrimonio();
	$loFuncion =new clsFunciones();


	$loMatrimo->fpSetRefMatrimonio($_GET["RPrefMatri"]);

	$lbEnc=$loMatrimo->fbBuscarMatrimonio($varMoF,"uno");

		if($lbEnc and $varMoF!=4)
		{
				$laMatrizPadres=$loMatrimo->fsGetDatosPadres();
				if (($laMatrizPadres[0]["Nombres"]=="")||($laMatrizPadres[1]["Nombres"]=="")||($laMatrizPadres[2]["Nombres"]=="")||($laMatrizPadres[3]["Nombres"]==""))
				{
					$_SESSION["message"]="No se pudo mostrar el reporte, debe registrar los padres de la novia y de el novio.";
					header("location: ../../index.php");
				}
				$lsIDmatrimonio=$loMatrimo->fpGetIDTmatrimonio();
				$lsFechaInscri=$loMatrimo->fpGetFechaInscri();
				$lsFechaHoraMatrimonio=$loMatrimo->fsGetFechaMatrimonio();
				$lsFechaMatrimonio=$loFuncion->fDameFechaEscrita(substr($lsFechaHoraMatrimonio,0,10));
				$lsIDsacerdote=$loMatrimo->fsGetIDsacerdote();
				$lsNacionovia=$loMatrimo->fsGetNacionovia();
				$lscedunovia=$loMatrimo->fsGetCInovia();
				$lsNombreNovia=$loMatrimo->fsGetNombnovia();
				$lsEstadonovia=$loMatrimo->fsGetEstadonovia();					
				$lsCiudadnovia=$loMatrimo->fsGetCiudadnovia();
				$lsMunicipionovia=$loMatrimo->fsGetMunicipionovia();
				$lsParroquianovia=$loMatrimo->fsGetParroquianovia();
				$lsEstadonovio=$loMatrimo->fsGetEstadonovio();
				$lsCiudadnovio=$loMatrimo->fsGetCiudadnovio();
				$lsMunicipionovio=$loMatrimo->fsGetMunicipionovio();
				$lsParroquianovio=$loMatrimo->fsGetParroquianovio();					
				$lsNacionovio=$loMatrimo->fsGetNacionovio();
				$lscedunovio=$loMatrimo->fsGetCInovio();
				$lsNombreNovio=$loMatrimo->fsGetNombnovio();
				$lsFechaHoraProclamaUno=$loMatrimo->fsGetFechaProclamaUno();
				$lsFechaHoraProclamaDos=$loMatrimo->fsGetFechaProclamaDos();
				$lsFechaHoraProclamaTres=$loMatrimo->fsGetFechaProclamaTres();
				$lsFechaProclamaUno=$loFuncion->fDameFechaEscrita(substr($lsFechaHoraProclamaUno,0,10));
				$lsFechaProclamaDos=$loFuncion->fDameFechaEscrita(substr($lsFechaHoraProclamaDos,0,10));
				$lsFechaProclamaTres=$loFuncion->fDameFechaEscrita(substr($lsFechaHoraProclamaTres,0,10));
				$lsHoraProclamaUno=$loFuncion->fDameHoraEstandar(substr($lsFechaHoraProclamaUno,11,8));
				$lsHoraProclamaDos=$loFuncion->fDameHoraEstandar(substr($lsFechaHoraProclamaDos,11,8));
				$lsHoraProclamaTres=$loFuncion->fDameHoraEstandar(substr($lsFechaHoraProclamaTres,11,8));
				$lsEstadoMatrimonio=$loMatrimo->fsGetEstadoMatrimonio();
				$lsFechanaciNovia=$loMatrimo->fsGetFechaNaciNovia();
				$lsFechanaciNovio=$loMatrimo->fsGetFechaNaciNovio();
				$lsEdadNovia=$loFuncion->fDameEdad($lsFechanaciNovia);
				$lsEdadNovio=$loFuncion->fDameEdad($lsFechanaciNovio);
		}
		else
		{
			$_SESSION["message"]="No se encontro ningun matrimonio";
			header("location: ../../index.php");
		}
	require_once("encabezado_reportes.php");
	echo ('
	</head>
	<body>
		<div id="contendor_reporte">
			<div id="cabecera">
				<img style="margin: 5px;float:right; height:150px;" src="img/FotoSpace.png"/>
				<img style="margin: 5px;float:right; height:150px;"src="img/FotoSpace.png"/>
				<br><br>
				<strong><font style="text-align:center;">Tlf. (0255) 6234587</font><br><font style="border-bottom: double;">Acarigua Estado Portuguesa</font></strong>

				<br><br><br><font style="font-size:50px; text-align:justify; font-family:hotel_coral_essexregular;">&nbsp;&nbsp;Proclama</br>Matrimonial</font>
				<div id="fecha">'); 
				print 'Acarigua, '.$loFuncion->fDameFechaEscrita(date("Y-m-d")).", ".$loFuncion->fDameHoraEstandar(substr(date("d-m-Y H:i:s"),11,8)); 

				echo ('
				</div>

			</div>

<br><br>
			<div id="tit"><font style="text-align: center; font-size:25px;">DESEA CONTRAER MATRIMONIO</font></div>
<br>

			<center><table style="width:800px;">
				<tr>
					<td colspan="2"><font style="text-align: justify; font-size:20px; line-height: 2.5em;">
					<strong>'.$lsNombreNovio.'</strong> de <strong>'.$lsEdadNovio.'</strong> años de edad, hijo de <strong>'.$laMatrizPadres[3]["Nombres"].'</strong> y de <strong>'.$laMatrizPadres[2]["Nombres"].'</strong>,
					 natural de '.$lsCiudadnovio.', Estado '.$lsEstadonovio.' Con <strong>'.$lsNombreNovia.'</strong> de <strong>'.$lsEdadNovia.'</strong> años de edad,
					hija de <strong>'.$laMatrizPadres[1]["Nombres"].'</strong> y de <strong>'.$laMatrizPadres[0]["Nombres"].'</strong>, natural de '.$lsCiudadnovia.', Estado '.$lsEstadonovia.'
					El matrimonio se realizará el <strong>'.$lsFechaMatrimonio.'.</strong>
					');
				echo('
					</font></td>
				</tr>
				</table></center>
				<br><br>
			<center><table style="width:600px;">
				<tr align="left">
					<td style="width:500px;"><strong>Primera proclama: '.$lsFechaProclamaUno.'</strong></td>
					<td style="width:400px;" align="center"><strong>Hora: '.$lsHoraProclamaUno.'</strong></td>
				</tr>
				<tr align="left">
					<td style="width:500px;"><strong>Segunda proclama: '.$lsFechaProclamaDos.'</strong></td>
					<td style="width:400px;" align="center"><strong>Hora: '.$lsHoraProclamaDos.'</strong></td>
				</tr>
				<tr align="left">
					<td style="width:500px;"><strong>Tercera proclama: '.$lsFechaProclamaTres.'</strong></td>
					<td style="width:400px;" align="center"><strong>Hora: '.$lsHoraProclamaTres.'</strong></td>
				</tr>
				 <tr>
				 	<td colspan="10" align="center"><button type="button" onclick="history.go(-1);" id="volver">Volver</button><button type="button" onclick="imprimir()" id="impri">Imprimir</button></td>
				 </tr>
			</table></center><br><br><br><br><b>
			<center><div style="width:800px;">Quien(es) conozca(n) algún impedimento que pueda hacer inválido este matrimonio tiene(n) la obligación de manifestarlo al Párroco.</div></center>
			<br><br><br><br><br><div align="center">_____________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________________</div>
			<div align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Los contrayentes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

	<br><br><br><br><div align="center" style="float:right; margin-right:100px;">_____________________________<br>
			Párroco</div>
			
			<div id="usuario">Elaborado por: ');
			print $_SESSION["nombreUsuario"];

			echo ('</div>
		</div>
		<script type="text/javascript">
		imprimir=function(){
			document.getElementById("impri").style.display = "none";
			document.getElementById("volver").style.display = "none";
			window.print();
			document.getElementById("impri").style.display = "block";
			document.getElementById("volver").style.display = "block";
		}
		</script>
	</body>
	</html>');
?>