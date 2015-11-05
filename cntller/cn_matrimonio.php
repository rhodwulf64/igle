<?php

  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}

   	require_once("../clases/claMatrimonio.php");
   	require_once("../clases/claPersonas.php");
   	require_once("../clases/claPadrinos.php");
   	require_once("../clases/clsFuncionesGlobales.php");
	$loMatrimo=new claMatrimonio();
	$loPersonas=new claPersonas();
	$loPadrinos=new claPadrinos();
	$loFuncion =new clsFunciones();
	$lsCIyNaci=$loFuncion->DameCIyNaci($_POST["f_cedunovia"]);
	$lsNacionalidadNovia=$lsCIyNaci["0"];
	$lscedunovia=$lsCIyNaci["1"];

	$lsCIyNaci=$loFuncion->DameCIyNaci($_POST["f_cedunovio"]);
	$lsNacionalidadNovio=$lsCIyNaci["0"];
	$lscedunovio=$lsCIyNaci["1"]; 

	$loMatrimo->asRefMatrimonio=$_POST["f_refMatrimonio"];
	$lsIDnovia="";
	$lsIDnovio="";
	$lsFila=$_POST["txtFila"];
	$lsMatriS=$_POST["f_refMatrimonio"];
	$varMoF=4;
	$laotraCI="";
	if (!empty($lscedunovia) and (empty($lscedunovio)))
	{
		$loPersonas->asNacionalidad=$lsNacionalidadNovia;
		$loPersonas->asCedula=$lscedunovia;
		$varMoF=0;
	}
	elseif (empty($lscedunovia) and (!empty($lscedunovio)))
	{
		$loPersonas->asNacionalidad=$lsNacionalidadNovio;
		$loPersonas->asCedula=$lscedunovio;
		$varMoF=1;
	}

			$lsOperacion=$_POST["txtOperacion"];
			$lsHacer=$_POST["txtHacer"];
			$liHay=$_POST["txtHay"];

		if (empty($lsOperacion))
		{
			$lsOperacion=$_GET["AccionGet"];
		}

	switch($lsOperacion)
   	{

   		case "buscar":
   		
		$loPadrinos->fpSetEventoPadrino("M");
   			
			$lbEnc=$loMatrimo->fbBuscarMatrimonio();
			if($lbEnc and $varMoF!=4)
			{
					$liHay=1;
					$lsIDmatrimonio=$loMatrimo->fpGetIDTmatrimonio();
					$lsFechaInscri=$loMatrimo->fpGetFechaInscri();
					$lsFechaMatrimonio=$loMatrimo->fsGetFechaMatrimonio();
					$lsIDsacerdote=$loMatrimo->fsGetIDsacerdote();
					$lsNacionovia=$loMatrimo->fsGetNacionovia();
					$lscedunovia=$loMatrimo->fsGetCInovia();
					$lsNombnovia=$loMatrimo->fsGetNombnovia();
					$lsEdadnovia=$loFuncion->fDameEdad($loMatrimo->fsGetFechaNaciNovia());
					$lsEdadnovio=$loFuncion->fDameEdad($loMatrimo->fsGetFechaNaciNovio());
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
					$lsNombnovio=$loMatrimo->fsGetNombnovio();
					$lsFechaProclamaUno=$loMatrimo->fsGetFechaProclamaUno();
					$lsFechaProclamaDos=$loMatrimo->fsGetFechaProclamaDos();
					$lsFechaProclamaTres=$loMatrimo->fsGetFechaProclamaTres();
					$lsEstadoMatrimonio=$loMatrimo->fsGetEstadoMatrimonio();
					$lsInterLibro=$loMatrimo->fsGetInterLibro();
					$lsInterFolio=$loMatrimo->fsGetInterFolio();
					$lsInterNumero=$loMatrimo->fsGetInterNumero();
					$lsNotaMarginal=$loMatrimo->fsGetNotaMarginal();
					$lsRefMatrimonio=$loMatrimo->fsGetRefMatrimonio();
					$lsEstatus=$loMatrimo->fsGetEstatus();
					$loPadrinos->fpSetIDcumatba($lsIDmatrimonio);
					$laMatrizPadres=$loMatrimo->fsGetDatosPadres();
					$laMatrizPadrinos=$loPadrinos->faListarPadrinos();
					$loPersonas->asNacionalidad=$lsNacionovia;
					$loPersonas->asCedula=$lscedunovia;
					$lbEncNovia=$loPersonas->fbBuscarPorCedula();

					if($lbEncNovia)
					{	

							$lsSexoNovia=$loPersonas->asSexo;
							$lsPadreNovia=$loPersonas->asNombrePadre;
							$lsMadreNovia=$loPersonas->asNombreMadre;
							$lsCeduPadreNovia=$loPersonas->asCedulaPadre;
							$lsCeduMadreNovia=$loPersonas->asCedulaMadre;
							$loPersonas->asNacionalidad=$lsNacionovio;
							$loPersonas->asCedula=$lscedunovio;
							$lbEncNovio=$loPersonas->fbBuscarPorCedula();

							if($lbEncNovio)
							{
									$lsSexoNovio=$loPersonas->asSexo;
									$lsPadreNovio=$loPersonas->asNombrePadre;
									$lsMadreNovio=$loPersonas->asNombreMadre;
									$lsCeduPadreNovio=$loPersonas->asCedulaPadre;
									$lsCeduMadreNovio=$loPersonas->asCedulaMadre;							
							}
					}
			  		$liHay=$lbEnc;
			}
			else
			{

				$liHay=0;
				$lsNombnovia="";
				$lsNombnovio="";

			}
		break;

		case "buscar_like":

			$cadena = strtoupper($_REQUEST['txtcadena']);
			$arr = $loMatrimo->buscarLike("proximo",$cadena);
			$cabecera = "
						<thead>
							<tr>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">Ref</h4></th>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">Novia</h4></th>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">Novio</h4></th>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">Estado</h4></th>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">Ceremonia</h4></th>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">-</h4></th>
							</tr>
						</thead>";
			for($i=0;$i<count($arr);$i++){
				$line.="<tr height=\"1%\">";
					$line.="<th>".$arr[$i]['ReferenciaMatrimonio']."</th>";
					$line.="<th>".$arr[$i]['NvaNombre']."</th>";
					$line.="<th>".$arr[$i]['NvoNombre']."</th>";
					$line.="<th><center>".fpMatriEstado($arr[$i]['MatriEdo'],$i,$arr[$i]['ReferenciaMatrimonio'])."</center></th>";
					$line.="<th>".$loFuncion->fDameFechaEscrita(substr($arr[$i]['MatriFecha'],0,10))."</th>";
					$line.="<th>
					<form name=\"fr_matriLike".$i."\" id=\"fr_matriLike".$i."\" action=\"".$_SERVER['HTTP_REFERER']."\" method=\"post\">
						<input type=\"hidden\" name=\"nvaCedula\" id=\"nvaCedula\" value=\"".$arr[$i]['NvaCedula']."\">
						<input type=\"hidden\" name=\"nvoCedula\" id=\"nvoCedula\" value=\"".$arr[$i]['NvoCedula']."\">
						<input type=\"hidden\" name=\"NvaNombre\" id=\"NvaNombre\" value=\"".$arr[$i]['NvaNombre']."\">
						<input type=\"hidden\" name=\"NvoNombre\" id=\"NvoNombre\" value=\"".$arr[$i]['NvoNombre']."\">
						<input type=\"hidden\" name=\"NvaEdad\" id=\"NvaEdad\" value=\"".$loFuncion->fDameEdad($arr[$i]['FechaNaciNovia'])."\">
						<input type=\"hidden\" name=\"NvoEdad\" id=\"NvoEdad\" value=\"".$loFuncion->fDameEdad($arr[$i]['FechaNaciNovio'])."\">
						<input type=\"hidden\" name=\"FechaProclamaUno\" id=\"FechaProclamaUno\" value=\"".$arr[$i]['FechaProclamaUno']."\">
						<input type=\"hidden\" name=\"FechaProclamaDos\" id=\"FechaProclamaDos\" value=\"".$arr[$i]['FechaProclamaDos']."\">
						<input type=\"hidden\" name=\"FechaProclamaTres\" id=\"FechaProclamaTres\" value=\"".$arr[$i]['FechaProclamaTres']."\">
						<input type=\"hidden\" name=\"interLibro\" id=\"interLibro\" value=\"".$arr[$i]['interLibro']."\">
						<input type=\"hidden\" name=\"interFolio\" id=\"interFolio\" value=\"".$arr[$i]['interFolio']."\">
						<input type=\"hidden\" name=\"interNumero\" id=\"interNumero\" value=\"".$arr[$i]['interNumero']."\">
						<input type=\"hidden\" name=\"NotaMarginal\" id=\"NotaMarginal\" value=\"".$arr[$i]['NotaMarginal']."\">
						<input type=\"hidden\" name=\"MatriMotivo\" id=\"MatriMotivo\" value=\"".$arr[$i]['Motivo']."\">
						<input type=\"hidden\" name=\"MatriS\" id=\"MatriS\" value=\"".$arr[$i]['ReferenciaMatrimonio']."\">
						<input type=\"hidden\" name=\"MatriIDSacer\" id=\"MatriIDSacer\" value=\"".$arr[$i]['IDSacer']."\">
						<input type=\"hidden\" name=\"MatriSacer\" id=\"MatriSacer\" value=\"".$arr[$i]['NombreSacer']."\">
						<input type=\"hidden\" name=\"MatriFecha\" id=\"MatriFecha\" value=\"".$loFuncion->fDameFechaEscrita(substr($arr[$i]['MatriFecha'],0,10))." a las ".$loFuncion->fDameHoraEstandar(substr($arr[$i]['MatriFecha'],11,8))."\">
						<textarea name=\"MatriEdo\" id=\"MatriEdo\" style=\"display:none;\">".fpMatriEstado($arr[$i]['MatriEdo'],$i,$arr[$i]['ReferenciaMatrimonio'])."</textarea>
						<input type=\"hidden\" name=\"MatriEdoNum\" id=\"MatriEdoNum\" value=\"".$arr[$i]['MatriEdo']."\">
						<input type=\"hidden\" name=\"ItemNum\" id=\"ItemNum\" value=\"".$i."\">
						<button type=\"button\" style=\"display:block; margin:0 auto; padding:3px;\" onclick=\"fpSelectLike('fr_matriLike".$i."');\" class=\"btn btn-primary\" name=\"b_Nuevo\"><span class=\"fa fa-check\"></span></button>
						</form></th>";
				$line.="</tr>";
			}
			print $cabecera.$line;
		break;

		case "buscarPadri":
			if($lsHacer=="buscarPadri")
			{
					$lsCIyNaci=$loFuncion->DameCIyNaci($_POST["auxiliarPadrino"]);
					$lsNacio=$lsCIyNaci["0"];
					$lscedu=$lsCIyNaci["1"];
					$loPersonas->asNacionalidad=$lsNacio;
					$loPersonas->asCedula=$lscedu;
					$lbEncPersonas=$loPersonas->fbBuscarPorCedula();

					if($lbEncPersonas)
					{	
						$liHay=1;

						$RegistroPadrino["lsNacio"]=$loPersonas->asNacionalidad;								
						$RegistroPadrino["lscedu"]=$loPersonas->asCedula;
						$RegistroPadrino["lsEstado"]=$loPersonas->asEstadoN;
						$RegistroPadrino["lsCiudad"]=$loPersonas->asCiudadN;
						$RegistroPadrino["lsMunicipio"]=$loPersonas->asMunicipioN;
						$RegistroPadrino["lsParroquia"]=$loPersonas->asParroquiaN;
						$RegistroPadrino["lsSexo"]=$loPersonas->asSexo;
						$RegistroPadrino["lsNomb"]=$loPersonas->asNombre;
						$RegistroPadrino["lsApel"]=$loPersonas->asApellido;
						$RegistroPadrino["lsPadre"]=$loPersonas->asNombrePadre;
						$RegistroPadrino["lsMadre"]=$loPersonas->asNombreMadre;
						$RegistroPadrino["lsCeduPadre"]=$loPersonas->asCedulaPadre;
						$RegistroPadrino["lsCeduMadre"]=$loPersonas->asCedulaMadre;
						$RegistroPadrino["lsEstatus"]=$loPersonas->asEstatus;
					}
					else
					{
						$liHay=2;			
					}
			}


		break;
			
		case "incluir":

			if($lsHacer=="buscar")
			{

					$lbEncPersonas=$loPersonas->fbBuscarPorCedula();

					if($lbEncPersonas)
					{	
						$liHay=7;
						if ($loMatrimo->EsSacerdoteCedula($loPersonas->asIDpersona))
						{
							$liHay=10;
						}
						if ($loFuncion->fDameEdad($loPersonas->asFechaNaci)<18)
						{
							$liHay=11;
						}
						if ($varMoF==0)
						{
								$lsNacionovia=$loPersonas->asNacionalidad;								
								$lscedunovia=$loPersonas->asCedula;
								$lsEstadonovia=$loPersonas->asEstadoN;
								$lsCiudadnovia=$loPersonas->asCiudadN;
								$lsMunicipionovia=$loPersonas->asMunicipioN;
								$lsParroquianovia=$loPersonas->asParroquiaN;
								$lsEdadnovia=$loFuncion->fDameEdad($loPersonas->asFechaNaci);
								$lsEdadnovio="";
								$lsSexoNovia=$loPersonas->asSexo;
								$lscedunovio="";
								$lsNombnovia=$loPersonas->asNombre." ".$loPersonas->asApellido;
								$lsNombnovio="";
								$lsPadreNovia=$loPersonas->asNombrePadre;
								$lsMadreNovia=$loPersonas->asNombreMadre;
								$lsCeduPadreNovia=$loPersonas->asCedulaPadre;
								$lsCeduMadreNovia=$loPersonas->asCedulaMadre;
								$lsCeduPadreNovio="";
								$lsCeduMadreNovio="";

								$lsPadreNovio="";
								$lsMadreNovio="";									
								$lsEstatus=$loPersonas->asEstatus;
						}
						else
						{
								$lsNacionovio=$loPersonas->asNacionalidad;
								$lscedunovia="";
								$lscedunovio=$loPersonas->asCedula;
								$lsEstadonovio=$loPersonas->asEstadoN;
								$lsCiudadnovio=$loPersonas->asCiudadN;
								$lsMunicipionovio=$loPersonas->asMunicipioN;
								$lsSexoNovio=$loPersonas->asSexo;
								$lsParroquianovio=$loPersonas->asParroquiaN;
								$lsEdadnovia="";
								$lsEdadnovio=$loFuncion->fDameEdad($loPersonas->asFechaNaci);
								$lsNombnovia="";
								$lsPadreNovia="";
								$lsMadreNovia="";
								$lsPadreNovio=$loPersonas->asNombrePadre;
								$lsMadreNovio=$loPersonas->asNombreMadre;
								$lsCeduPadreNovio=$loPersonas->asCedulaPadre;
								$lsCeduMadreNovio=$loPersonas->asCedulaMadre;	
								$lsCeduPadreNovia="";
								$lsCeduMadreNovia="";							
								$lsNombnovio=$loPersonas->asNombre." ".$loPersonas->asApellido;
								$lsEstatus=$loPersonas->asEstatus;
						}

					}
					else
					{
						$liHay=9;
						$lsNombnovia="";
						$lsNombnovio="";
				
					}
					
					$loPadrinos->fpSetEventoPadrino("M");
				   	$lbEnc=$loMatrimo->fbBuscarMatrimonio($varMoF,"todos");
						
					if($lbEnc and $varMoF!=4 and $lbEncPersonas)
					{
						$lsEstadoMatrimonio=$loMatrimo->fsGetEstadoMatrimonio();
						if (($lsEstadoMatrimonio==0)OR($lsEstadoMatrimonio==2))
						{
							$lsIDmatrimonio=$loMatrimo->fpGetIDTmatrimonio();
							$lsFechaInscri=$loMatrimo->fpGetFechaInscri();
							$lsFechaMatrimonio=$loMatrimo->fsGetFechaMatrimonio();
							$lsIDsacerdote=$loMatrimo->fsGetIDsacerdote();
							$lsNacionovia=$loMatrimo->fsGetNacionovia();
							$lscedunovia=$loMatrimo->fsGetCInovia();
							$lsNombnovia=$loMatrimo->fsGetNombnovia();
							$lsNacionovio=$loMatrimo->fsGetNacionovio();
							$lscedunovio=$loMatrimo->fsGetCInovio();
							$lsNombnovio=$loMatrimo->fsGetNombnovio();
							$lsFechaProclamaUno=$loMatrimo->fsGetFechaProclamaUno();
							$lsFechaProclamaDos=$loMatrimo->fsGetFechaProclamaDos();
							$lsFechaProclamaTres=$loMatrimo->fsGetFechaProclamaTres();
							$lsEstadoMatrimonio=$loMatrimo->fsGetEstadoMatrimonio();
							$lsInterLibro=$loMatrimo->fsGetInterLibro();
							$lsInterFolio=$loMatrimo->fsGetInterFolio();
							$lsInterNumero=$loMatrimo->fsGetInterNumero();
							$lsNotaMarginal=$loMatrimo->fsGetNotaMarginal();
							$lsRefMatrimonio=$loMatrimo->fsGetRefMatrimonio();
							$lsEstatus=$loMatrimo->fsGetEstatus();
							$loPadrinos->fpSetIDcumatba($lsIDmatrimonio);
							$laMatrizPadres=$loMatrimo->fsGetDatosPadres();
							$laMatrizPadrinos=$loPadrinos->faListarPadrinos();
							$loPersonas->asNacionalidad=$lsNacionovia;
							$loPersonas->asCedula=$lscedunovia;
							$lbEncNovia=$loPersonas->fbBuscarPorCedula();

							if($lbEncNovia)
							{	

									$lsSexoNovia=$loPersonas->asSexo;
									$lsPadreNovia=$loPersonas->asNombrePadre;
									$lsMadreNovia=$loPersonas->asNombreMadre;
									$lsCeduPadreNovia=$loPersonas->asCedulaPadre;
									$lsCeduMadreNovia=$loPersonas->asCedulaMadre;
									$loPersonas->asNacionalidad=$lsNacionovio;
									$loPersonas->asCedula=$lscedunovio;
									$lbEncNovio=$loPersonas->fbBuscarPorCedula();

									if($lbEncNovio)
									{
											$lsSexoNovio=$loPersonas->asSexo;
											$lsPadreNovio=$loPersonas->asNombrePadre;
											$lsMadreNovio=$loPersonas->asNombreMadre;
											$lsCeduPadreNovio=$loPersonas->asCedulaPadre;
											$lsCeduMadreNovio=$loPersonas->asCedulaMadre;							
									}
							}

								$liHay=1;
						}
					}
			}	
			if($lsHacer=="incluir")
			{
				$pasa=false;
				$loPersonas->asNacionalidad=$lsNacionalidadNovia;
				$loPersonas->asCedula=$lscedunovia;
				$lbEncNovia=$loPersonas->fbBuscarPorCedula();
				if ($lbEncNovia)
				{

					$lsIDnovia=$loPersonas->asIDpersona;
					$loPersonas->asNacionalidad=$lsNacionalidadNovio;
					$loPersonas->asCedula=$lscedunovio;
					$lbEncNovio=$loPersonas->fbBuscarPorCedula();
				
					if ($lbEncNovio)
					{
						$lsIDnovio=$loPersonas->asIDpersona;
						$pasa=true;
					}
				}
				
				

					if($pasa)
					{
											
						fpPasar_Campos($loMatrimo,$loFuncion,$lsIDnovia,$lsIDnovio,$lsFila);
						$lbHecho=$loMatrimo->fbIncluirMatrimonio();
						if($lbHecho)
						{
							$lsRefMatrimonio=$loMatrimo->fsGetRefMatrimonio();
							$liHay=1;
						}
						else
						{
							$liHay=12;

						}

					}
					

			}
				
			

		break;

		case "modificar":

				$pasa=false;
				$loPersonas->asNacionalidad=$lsNacionalidadNovia;
				$loPersonas->asCedula=$lscedunovia;
				$lbEncNovia=$loPersonas->fbBuscarPorCedula();
				if ($lbEncNovia)
				{
					$loPersonas->asNacionalidad=$lsNacionalidadNovio;
					$lsIDnovia=$loPersonas->asIDpersona;
					$loPersonas->asCedula=$lscedunovio;
					$lbEncNovio=$loPersonas->fbBuscarPorCedula();
				
					if ($lbEncNovio)
					{
						$lsIDnovio=$loPersonas->asIDpersona;
						$pasa=true;
					}
				}
				if($pasa)
				{

					fpPasar_Campos($loMatrimo,$loFuncion,$lsIDnovia,$lsIDnovio,$lsFila);
					$lbHecho=$loMatrimo->fbModificarMatrimonio($_POST["f_refMatrimonio"]);
					if($lbHecho)
					{
						$liHay=1;
					}
					else
					{
						$liHay=2;
					}
					
				}
		break;		


		case "reactivar":
			$lbHecho=$loMatrimo->fbActivar("1");
			if($lbHecho)
			{
				$liHay=1;
			}
			else
			{
				$liHay=2;
			}
			break;

		case "desactivar":
			$lbHecho=$loMatrimo->fbActivar("0");
			if($lbHecho)
			{
				$liHay=1;
			}
			else
			{
				$liHay=2;
			}
			break;	

		case "ToPendiente":
			$lbHecho=$loMatrimo->fbGestion(0,"",$lsMatriS);
				if($lbHecho=="1")
				{
					$liHay=1;
				}
				elseif($lbHecho=="99")
				{
					$liHay=3;
				}
				else
				{
					$liHay=0;
				}
			break;
		case "ToCasar":
			$lbHecho=$loMatrimo->fbGestion(1,"",$lsMatriS);
			if($lbHecho=="1")
			{
				$liHay=1;
			}
			else
			{
				$liHay=0;
			}
			break;
		case "ToSuspender":
			$lbHecho=$loMatrimo->fbGestion(2,$_POST["f_motivo"],$lsMatriS);
			if($lbHecho=="1")
			{
				$liHay=1;
			}
			else
			{
				$liHay=0;
			}
			break;
		case "ToAnular":
			$lbHecho=$loMatrimo->fbGestion(3,$_POST["f_motivo"],$lsMatriS);
			if($lbHecho=="1")
			{
				$liHay=1;
			}
			else
			{
				$liHay=0;
			}
			break;		
		case "ToPendienteAnular":
			$lbHecho=$loMatrimo->fbGestion(4,$_POST["f_motivo"],$lsMatriS);
			if($lbHecho=="1")
			{
				$liHay=1;
			}
			else
			{
				$liHay=0;
			}
			break;

		case "ActivaPadri":
				$pasa=false;
				$loPersonas->asCedula=$lscedunovia;
				$lbEncNovia=$loPersonas->fbBuscarPorCedula();
				if ($lbEncNovia)
				{

					$lsIDnovia=$loPersonas->fsGetIDpersona();
					$loPersonas->asCedula=$lscedunovio;
					$lbEncNovio=$loPersonas->fbBuscarPorCedula();
				
					if ($lbEncNovio)
					{
						$lsIDnovio=$loPersonas->fsGetIDpersona();
						$pasa=true;
					}
				}
				if($pasa)
				{
					fpPasar_Campos($loMatrimo,$loFuncion,$lsIDnovia,$lsIDnovio,$lsFila);
					$loMatrimo->fbceduPadri($_POST["CIpadriAlter"]);
					$lbHecho=$loMatrimo->fbActivarPadri("1");
					if($lbHecho)
					{
						$liHay=1;
					}
					else
					{
						$liHay=2;
					}
				}
				break;
						
			case "DesactivaPadri":
				$pasa=false;
				$loPersonas->asCedula=$lscedunovia;
				$lbEncNovia=$loPersonas->fbBuscarPorCedula();
				if ($lbEncNovia)
				{

					$lsIDnovia=$loPersonas->fsGetIDpersona();
					$loPersonas->asCedula=$lscedunovio;
					$lbEncNovio=$loPersonas->fbBuscarPorCedula();
				
					if ($lbEncNovio)
					{
						$lsIDnovio=$loPersonas->fsGetIDpersona();
						$pasa=true;
					}
				}
				if($pasa)
				{
					fpPasar_Campos($loMatrimo,$loFuncion,$lsIDnovia,$lsIDnovio,$lsFila);
					$loMatrimo->fbceduPadri($_POST["CIpadriAlter"]);
					$lbHecho=$loMatrimo->fbActivarPadri("0");
					if($lbHecho)
					{
						$liHay=1;
					}
					else
					{
						$liHay=2;
					}
				}
				break;
				
    }    	 	

if (($_GET["AccionGet"]=="")&&($_POST["txtOperacion"]!=""))
{
		header('Content-type: text/javascript');
		$json = array( "lsMatriS" => $lsRefMatrimonio, "lsFechaInscri" => $lsFechaInscri, "lsfechamatrimonio" => substr($lsFechaMatrimonio,0,10), "lshoramatrimonio" => substr($lsFechaMatrimonio,11,18), "lscedusacerdote" => $lsIDsacerdote, "lsNacionovia" => $lsNacionovia, "lscedunovia" => $lscedunovia, "lsnombnovia"=> $lsNombnovia, "lsSexoNovia"=>$lsSexoNovia, "lsSexoNovio"=>$lsSexoNovio, "lsEstadonovia" => $lsEstadonovia, "lsCiudadnovia" => $lsCiudadnovia, "lsMunicipionovia" => $lsMunicipionovia, "lsParroquianovia" => $lsParroquianovia, "lsCeduPadreNovia" => $lsCeduPadreNovia, "lsCeduMadreNovia" => $lsCeduMadreNovia, "lsMadreNovia" => $lsMadreNovia, "lsPadreNovia" => $lsPadreNovia, "lsEdadnovia" => $lsEdadnovia, "lsNacionovio" => $lsNacionovio, "lscedunovio" => $lscedunovio, "lsnombnovio"=> $lsNombnovio, "lsEstadonovio" => $lsEstadonovio, "lsCiudadnovio" => $lsCiudadnovio, "lsMunicipionovio" => $lsMunicipionovio, "lsParroquianovio" => $lsParroquianovio, "lsCeduPadreNovio" => $lsCeduPadreNovio, "lsCeduMadreNovio" => $lsCeduMadreNovio, "lsMadreNovio" => $lsMadreNovio, "lsPadreNovio" => $lsPadreNovio, "lsEdadnovio" => $lsEdadnovio, "lsFechaProclamaUno"=> $lsFechaProclamaUno, "lsFechaProclamaDos"=> $lsFechaProclamaDos, "lsFechaProclamaTres"=> $lsFechaProclamaTres, "lsedomatri" => $lsEstadoMatrimonio, "lsInterLibro" => $lsInterLibro, "lsInterFolio" => $lsInterFolio, "lsInterNumero" => $lsInterNumero, "lsNotaMarginal" => $lsNotaMarginal, "lsEstatus" => $lsEstatus, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer" => $lsHacer);
		
		$envi = array("Matri"=>$json,"Padres"=>$laMatrizPadres, "Padri"=>$laMatrizPadrinos, "PersoPadri"=>$RegistroPadrino);

		echo json_encode( $envi );
}		
    function fpPasar_Campos($poMatrimo, $poFuncion, $lsIDnovia, $lsIDnovio, $lsFila)
    {

    	$MatrizPadri=array(array());
		for($liI=1;$liI<=$lsFila;$liI++)
		{


		$lsCIyNaci=$poFuncion->DameCIyNaci($_POST["f_padCedula".$liI]);
		$lsNacioPad=$lsCIyNaci["0"];
		$lsCeduPad=$lsCIyNaci["1"];

			$MatrizPadri[$liI][1]=$lsNacioPad;
			$MatrizPadri[$liI][2]=$lsCeduPad;
			$MatrizPadri[$liI][3]=$_POST["f_padNombres".$liI];
			$MatrizPadri[$liI][4]=$_POST["f_padApellidos".$liI];
			$MatrizPadri[$liI][5]=$_POST["f_padSexo".$liI];
			$MatrizPadri[$liI][6]="";
			$MatrizPadri[$liI][7]="";
			$MatrizPadri[$liI][8]="";
			$MatrizPadri[$liI][9]=1;
			$MatrizPadri[$liI][10]=1;
			$MatrizPadri[$liI][11]=1;
			$MatrizPadri[$liI][12]=$_POST["f_padriTipo".$liI];
			$MatrizPadri[$liI][13]=1;
		}
		$poMatrimo->fpSetMatrizPadri($MatrizPadri);
		$poMatrimo->fpSetFilaPadri($lsFila);
		$poMatrimo->fpSetFechaInscri(date("Y-m-d"));
		$poMatrimo->fpSetFechaMatrimonio($_POST["f_fechamatrimonio"]);
		$poMatrimo->fpSetIDsacerdote($_POST["f_sacerdote"]);
		$poMatrimo->fpSetIDnovia($lsIDnovia);
		$poMatrimo->fpSetIDnovio($lsIDnovio);
		$poMatrimo->fpSetFechaProclamaUno($_POST["f_ProclamaUnoFecha"]." ".$_POST["f_ProclamaUnoHora"]);
		$poMatrimo->fpSetFechaProclamaDos($_POST["f_ProclamaDosFecha"]." ".$_POST["f_ProclamaDosHora"]);
		$poMatrimo->fpSetFechaProclamaTres($_POST["f_ProclamaTresFecha"]." ".$_POST["f_ProclamaTresHora"]);
		$poMatrimo->fpSetEstadoMatrimonio(0);
		$poMatrimo->fpSetInterLibro($_POST["f_libro"]);
		$poMatrimo->fpSetInterFolio($_POST["f_Folio"]);
		$poMatrimo->fpSetInterNumero($_POST["f_Numero"]);
		$poMatrimo->fpSetNotaMarginal($_POST["f_notaMarginal"]);
		$poMatrimo->fpSetRefMatrimonio($_POST["f_refMatrimonio"]);

	}

	function fpMatriEstado($param,$i,$reF)
	{
		$result=array("<div class=\"alert alert-info\" onclick=\"accionEstados(this.id,'$reF')\" style=\"padding:0px;\" id=\"textoEstado$i\">Pendiente</div>",
			"<div class=\"alert alert-success\" onclick=\"accionEstados(this.id,'$reF')\" style=\"padding:0px;\" id=\"textoEstado$i\">Casados</div>",
			"<div class=\"alert alert-warning\" onclick=\"accionEstados(this.id,'$reF')\" style=\"padding:0px;\" id=\"textoEstado$i\">Suspendido</div>",
			"<div class=\"alert alert-danger\" onclick=\"accionEstados(this.id,'$reF')\" style=\"padding:0px;\" id=\"textoEstado$i\">Anulado</div>",
			"<div class=\"alert alert-danger\" onclick=\"accionEstados(this.id,'$reF')\" style=\"padding:0px;\" id=\"textoEstado$i\">Anulación Pendiente</div>"
			);
		return $result[$param];
	}
?>






