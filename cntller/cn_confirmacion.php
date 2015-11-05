<?php

  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}

   	require_once("../clases/claMatrimonio.php");
   	require_once("../clases/claPersonas.php");
   	require_once("../clases/claPadrinos.php");
	$loMatrimo=new claMatrimonio();
	$loPersonas=new claPersonas();
	$loPadrinos=new claPadrinos();
	$loMatrimo->fpSetCInovia($_POST["f_cedunovia"]);
	$loMatrimo->fpSetCInovio($_POST["f_cedunovio"]);
	$lsCednovia="";
	$lsCednovio="";

	$lsFila=$_POST["txtFila"];
	$varMoF=4;
	if (!empty($_POST["f_cedunovia"]) and (empty($_POST["f_cedunovio"])))
	{
		$loPersonas->fpSetCedula($_POST["f_cedunovia"]);
		$varMoF=0;
	}
	elseif (empty($_POST["f_cedunovia"]) and (!empty($_POST["f_cedunovio"])))
	{
		$loPersonas->fpSetCedula($_POST["f_cedunovio"]);
		$varMoF=1;
	}
	elseif (!empty($_POST["f_cedunovia"]) and (!empty($_POST["f_cedunovio"])))
	{
		$loPersonas->fpSetCedula($_POST["f_cedunovio"]);
		$varMoF=2;
	}
	else
	{
		$varMoF=4;
	}
			$lsOperacion=$_POST["txtOperacion"];
			$lsHacer=$_POST["txtHacer"];
			$liHay=$_POST["txtHay"];



	switch($lsOperacion)
   	{

   		case "buscar":
   		
		$loPadrinos->fpSetEventoPadrino("M");
   			
			$lbEnc=$loMatrimo->fbBuscarMatrimonio($varMoF);
			if($lbEnc and $varMoF!=4)
			{
				$liHay=1;
					$lsNombnovio=$loMatrimo->fsGetNombnovio();
					$lsIDmatrimonio=$loMatrimo->fpGetIDTmatrimonio();
					$lsFechaInscri=$loMatrimo->fpGetFechaInscri();
					$lsFechaMatrimonio=$loMatrimo->fsGetFechaMatrimonio();
					$lsCIFsacerdote=$loMatrimo->fsGetIDsacerdote();
					$lsCIFnovia=$loMatrimo->fsGetCInovia();
					$lsNombnovia=$loMatrimo->fsGetNombnovia();
					$lsCIFnovio=$loMatrimo->fsGetCInovio();
			
					$lsEstadoMatrimonio=$loMatrimo->fsGetEstadoMatrimonio();
					$lsEstatus=$loMatrimo->fsGetEstatus();
					$loPadrinos->fpSetIDcumatba($lsIDmatrimonio);
					$laMatriz=$loPadrinos->faListarPadrinos();
			  	$liHay=$lbEnc;
			}
			else
			{

				$liHay=0;
				$lsCIFnovia=$_POST["f_cedunovia"];
				$lsCIFnovio=$_POST["f_cedunovio"];

				$lsNombnovia="";
				$lsNombnovio="";

			}
		break;
								
		case "incluir":

			if($lsHacer=="buscar")
			{
				$loPadrinos->fpSetEventoPadrino("M");
		   						$lbEnc=$loMatrimo->fbBuscarMatrimonio($varMoF);
				if($lbEnc and $varMoF!=4)
				{
					$liHay=1;
						$lsNombnovio=$loMatrimo->fsGetNombnovio();
						$lsIDmatrimonio=$loMatrimo->fpGetIDTmatrimonio();
						$lsFechaInscri=$loMatrimo->fpGetFechaInscri();
						$lsFechaMatrimonio=$loMatrimo->fsGetFechaMatrimonio();
						$lsCIFsacerdote=$loMatrimo->fsGetIDsacerdote();
						$lsCIFnovia=$loMatrimo->fsGetCInovia();
						$lsNombnovia=$loMatrimo->fsGetNombnovia();
						$lsCIFnovio=$loMatrimo->fsGetCInovio();
				
						$lsEstadoMatrimonio=$loMatrimo->fsGetEstadoMatrimonio();
						$lsEstatus=$loMatrimo->fsGetEstatus();
						$loPadrinos->fpSetIDcumatba($lsIDmatrimonio);
						$laMatriz=$loPadrinos->faListarPadrinos();
				  		$liHay=$lbEnc;
				}
				else
				{

					
					$lbEnc=$loPersonas->fbBuscar();

						if($lbEnc)
						{	
							if ($varMoF==0)
							{
									$liHay=2;
									$lsCIFnovia=$loPersonas->fsGetCedula();
									$lsCIFnovio="";
									$lsNombnovia=$loPersonas->fsGetNombre()." ".$loPersonas->fsGetApellido();
									$lsNombnovio="";
									$lsEstatus=$loPersonas->fsGetEstatus();
							}
							else
							{
									$liHay=2;
									$lsCIFnovia="";
									$lsCIFnovio=$loPersonas->fsGetCedula();
									$lsNombnovia="";
									$lsNombnovio=$loPersonas->fsGetNombre()." ".$loPersonas->fsGetApellido();
									$lsEstatus=$loPersonas->fsGetEstatus();
							}

						}
						else
						{
							$liHay=3;
							$lsCIFnovia=$_POST["f_cedunovia"];
							$lsCIFnovio=$_POST["f_cedunovio"];
							$lsNombnovia="";
							$lsNombnovio="";
					
						}
		
				}

			}

				
			if($lsHacer=="incluir")
			{
				$pasa=false;
				$loPersonas->fpSetCedula($_POST["f_cedunovia"]);
				$lbEncNovia=$loPersonas->fbBuscar();
				if ($lbEncNovia)
				{

					$lsCednovia=$loPersonas->fsGetIDpersona();
					$loPersonas->fpSetCedula($_POST["f_cedunovio"]);
					$lbEncNovio=$loPersonas->fbBuscar();
				
					if ($lbEncNovio)
					{
						$lsCednovio=$loPersonas->fsGetIDpersona();
						$pasa=true;
					}
				}
				
				

					if($pasa)
					{
											
						fpPasar_Campos($loMatrimo,$lsCednovia,$lsCednovio,$lsFila);
						$lbHecho=$loMatrimo->fbIncluirMatrimonio();
						if($lbHecho)
						{
						
							$liHay=1;
						}
						else
						{
							$liHay=9;

						}

					}
					

			}
				
			

		break;

		case "modificar":
				$pasa=false;
				$loPersonas->fpSetCedula($_POST["f_cedunovia"]);
				$lbEncNovia=$loPersonas->fbBuscar();
				if ($lbEncNovia)
				{

					$lsCednovia=$loPersonas->fsGetIDpersona();
					$loPersonas->fpSetCedula($_POST["f_cedunovio"]);
					$lbEncNovio=$loPersonas->fbBuscar();
				
					if ($lbEncNovio)
					{
						$lsCednovio=$loPersonas->fsGetIDpersona();
						$pasa=true;
					}
				}

					if($pasa)
					{
						fpPasar_Campos($loMatrimo,$lsCednovia,$lsCednovio,$lsFila);
						$lbHecho=$loMatrimo->fbModificarMatrimonio();
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


		case "activar":
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

		case "ActivaPadri":
				$pasa=false;
				$loPersonas->fpSetCedula($_POST["f_cedunovia"]);
				$lbEncNovia=$loPersonas->fbBuscar();
				if ($lbEncNovia)
				{

					$lsCednovia=$loPersonas->fsGetIDpersona();
					$loPersonas->fpSetCedula($_POST["f_cedunovio"]);
					$lbEncNovio=$loPersonas->fbBuscar();
				
					if ($lbEncNovio)
					{
						$lsCednovio=$loPersonas->fsGetIDpersona();
						$pasa=true;
					}
				}
				if($pasa)
				{
					fpPasar_Campos($loMatrimo,$lsCednovia,$lsCednovio,$lsFila);
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
				$loPersonas->fpSetCedula($_POST["f_cedunovia"]);
				$lbEncNovia=$loPersonas->fbBuscar();
				if ($lbEncNovia)
				{

					$lsCednovia=$loPersonas->fsGetIDpersona();
					$loPersonas->fpSetCedula($_POST["f_cedunovio"]);
					$lbEncNovio=$loPersonas->fbBuscar();
				
					if ($lbEncNovio)
					{
						$lsCednovio=$loPersonas->fsGetIDpersona();
						$pasa=true;
					}
				}
				if($pasa)
				{
					fpPasar_Campos($loMatrimo,$lsCednovia,$lsCednovio,$lsFila);
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


		header('Content-type: text/javascript');
		$json = array( "lsFechaInscri" => $lsFechaInscri, "lsfechamatrimonio" => substr($lsFechaMatrimonio,0,10), "lshoramatrimonio" => substr($lsFechaMatrimonio,11,18), "lscedusacerdote" => $lsCIFsacerdote, "lscedunovia" => $lsCIFnovia, "lsnombnovia"=> $lsNombnovia, "lscedunovio" => $lsCIFnovio, "lsnombnovio"=> $lsNombnovio, "lsedomatri" => $lsEstadoMatrimonio, "lsEstatus" => $lsEstatus, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer" => $lsHacer);
		
		$envi = array("Matri"=>$json, "Padri"=>$laMatriz);

		echo json_encode( $envi );
		
    function fpPasar_Campos($poMatrimo, $lsCednovia, $lsCednovio, $lsFila)
    {

    	$MatrizPadri=array(array());
		print $IDmatri;
		for($liI=1;$liI<=$lsFila;$liI++)
		{
			$MatrizPadri[$liI][1]=$_POST["f_padCedula".$liI];
			$MatrizPadri[$liI][2]=$_POST["f_padNombres".$liI];
			$MatrizPadri[$liI][3]=$_POST["f_padApellidos".$liI];
			$MatrizPadri[$liI][4]=$_POST["f_padSexo".$liI];
			$MatrizPadri[$liI][5]=$_POST["f_padDireccion".$liI];
			$MatrizPadri[$liI][6]=$_POST["f_padTelefono".$liI];
			$MatrizPadri[$liI][7]=$_POST["f_padFechaNacimiento".$liI];
			$MatrizPadri[$liI][8]=1;
			$MatrizPadri[$liI][9]=1;
			$MatrizPadri[$liI][10]=1;
			$MatrizPadri[$liI][11]=$_POST["f_padriTipo".$liI];
			$MatrizPadri[$liI][12]=1;
		}
		$poMatrimo->fpSetMatrizPadri($MatrizPadri);
		$poMatrimo->fpSetFilaPadri($lsFila);
		$poMatrimo->fpSetFechaInscri(date("Y-m-d"));
		$poMatrimo->fpSetFechaMatrimonio($_POST["f_fechamatrimonio"]);
		$poMatrimo->fpSetIDsacerdote($_POST["f_sacerdote"]);
		$poMatrimo->fpSetCInovia($lsCednovia);
		$poMatrimo->fpSetCInovio($lsCednovio);
		$poMatrimo->fpSetEstadoMatrimonio(0);
	}
?>






