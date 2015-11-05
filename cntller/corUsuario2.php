<?php

  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
	
   	require_once("../clases/claUser.php");
   	require_once("../clases/claPersonas.php"); 
   	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion =new clsFunciones;
	$lsCIyNaci=$loFuncion->DameCIyNaci($_POST["f_cedula"]);
	$lsNacionalidad=$lsCIyNaci["0"];
	$_POST["f_cedula"]=$lsCIyNaci["1"];
	
	$loUsuario=new claUser();
	$loUsuario->fpSetCedula($_POST["f_cedula"]);
	$loPersona=new claPersonas();
	$loPersona->fpSetCedula($_POST["f_cedula"]);

	$lsCedula=$_POST["f_cedula"];
	$lsOperacion=$_POST["txtOperacion"];
	$lsHacer=$_POST["txtHacer"];
	$liHay=$_POST["txtHay"];
	
	switch($lsOperacion)
   	{

		case "buscar":
	 
			$lbEnc=$loUsuario->fbBuscar();
			if($lbEnc > 0)
			{
				
				$liHay=1;
				$lsCedula=$loUsuario->fsGetCedula();
				$lsNombre=$loUsuario->fsGetNombre();
				$lsApellido=$loUsuario->fsGetApellido();
				$lsUsuario=$loUsuario->fsGetUsuario();
				$lsContrasena=$loUsuario->fsGetClave();
				$lsRol=$loUsuario->fsGetRol();
				$lsPreguntaSecreta=$loUsuario->fsGetPreguntaSecreta();
				$lsRespuestaSecreta=$loUsuario->fsGetRespuestaSecreta();
				$lsEstatus=$loUsuario->fsGetEstatus();
				$lsSexo=$loUsuario->fsGetSexo();
				$lsDireccion=$loUsuario->fsGetDireccion();
				$lsTelefono=$loUsuario->fsGetTelefono();
				$lsFechaNaci=$loUsuario->fsGetFechaNaci();
				$lsRegistroPer=$loUsuario->fsGetRegistroPer();
				$lsGradoEstudio=$loUsuario->fsGetGradoEstudio();
				$lsTallaFranela=$loUsuario->fsGetTallaFranela();
				$lsEstatusPer=$loUsuario->fsGetEstatusPer();

			}
			else
			{
				
				$liHay=0;
			}
			break;
		case "incluir":
			if($lsHacer=="buscar")
			{
				$lbEnc=$loUsuario->fbBuscar();
				if($lbEnc  == 1) //SI ENCUENTRA EN LA TABLA PERSONA PERO NO EXISTE USUARIO
				{

					$liHay=1;
					$lsCedula=$loUsuario->fsGetCedula();
					$lsNombre=$loUsuario->fsGetNombre();
					$lsApellido=$loUsuario->fsGetApellido();
					$lsSexo=$loUsuario->fsGetSexo();
					$lsDireccion=$loUsuario->fsGetDireccion();
					$lsTelefono=$loUsuario->fsGetTelefono();
					$lsFechaNaci=$loUsuario->fsGetFechaNaci();
					$lsRegistroPer=$loUsuario->fsGetRegistroPer();
					$lsGradoEstudio=$loUsuario->fsGetGradoEstudio();
					$lsTallaFranela=$loUsuario->fsGetTallaFranela();
					$lsEstatusPer=$loUsuario->fsGetEstatusPer();
				
				}

				elseif($lbEnc == 2) //SI ENCUENTRA TANTO EN LA TABLA PERSONA COMO EN LA DE USUARIO
				{
					$liHay=2;
					$lsCedula=$loUsuario->fsGetCedula();
					$lsNombre=$loUsuario->fsGetNombre();
					$lsApellido=$loUsuario->fsGetApellido();
					$lsUsuario=$loUsuario->fsGetUsuario();
					$lsContrasena=$loUsuario->fsGetClave();
					$lsRol=$loUsuario->fsGetRol();
					$lsPreguntaSecreta=$loUsuario->fsGetPreguntaSecreta();
					$lsRespuestaSecreta=$loUsuario->fsGetRespuestaSecreta();
					$lsEstatus=$loUsuario->fsGetEstatus();
					$lsSexo=$loUsuario->fsGetSexo();
					$lsDireccion=$loUsuario->fsGetDireccion();
					$lsTelefono=$loUsuario->fsGetTelefono();
					$lsFechaNaci=$loUsuario->fsGetFechaNaci();
					$lsRegistroPer=$loUsuario->fsGetRegistroPer();
					$lsGradoEstudio=$loUsuario->fsGetGradoEstudio();
					$lsTallaFranela=$loUsuario->fsGetTallaFranela();
					$lsEstatusPer=$loUsuario->fsGetEstatusPer();
				}
				else
				{
			
					$liHay=0;
				}
			}
			if($lsHacer=="incluir")
			{
				if ($liHay=="1")
				{
					fpPasarCamposUser($loUsuario);
					$lbHecho=$loUsuario->fbIncluir();
					if($lbHecho)
					{
						$liHay=1;
					}
					else
					{
						$liHay=2;
					}
				}elseif ($liHay=="0")
				{
					fpPasarCamposPersonas($loPersona);
					fpPasarCamposUser($loUsuario);
					$lbHecho=$loPersona->fbIncluir();
					if ($lbHecho)
					{
					$lbHecho=$loUsuario->fbIncluir();
						if($lbHecho)
						{
							$liHay=1;
						}
						else
						{
							$liHay=2;
						}
					}
					else
					{
					$liHay=3;
					}
				}
			}
			break;
		case "modificar":
			fpPasarCamposPersonas($loPersona);
			fpPasarCamposUser($loUsuario);
			$lbHecho=$loPersona->fbModificar();
			if ($lbHecho)
					{
					$lbHecho=$loUsuario->fbModificar();
						if($lbHecho)
						{
							$liHay=1;
						}
						else
						{
							$liHay=2;
						}
					}
					else
					{
					$liHay=3;
					}
			break;
		case "eliminar":
			$lbHecho=$loUsuario->fbActivar(0);
			if($lbHecho)
			{
				$liHay=1;
			}
			else
			{
				$liHay=2;
			}
			break;
		case "reactivar":
			$lbHecho=$loUsuario->fbActivar(1);
			if($lbHecho)
			{
				$liHay=1;
			}
			else
			{
				$liHay=2;
			}
			break;


    }
header('Content-type: text/javascript');
$json = array( "lsCedula" => $lsCedula, "lsNombre" => $lsNombre, "lsApellido" => $lsApellido, "lsUsuario" => $lsUsuario, "lsRol" => $lsRol, "lsPreguntaSecreta" => $lsPreguntaSecreta, "lsRespuestaSecreta" => $lsRespuestaSecreta, "lsEstatus" => $lsEstatus, "lsSexo" => $lsSexo, "lsDireccion" => $lsDireccion, "lsTelefono" => $lsTelefono, "lsFechaNaci" => $lsFechaNaci, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer" => $lsHacer );

echo json_encode( $json );
   
    function fpPasarCamposUser($poUsuario)
    {
    	$poUsuario->fpSetUsuario($_POST["f_cedula"]);
		$poUsuario->fpSetRol($_POST["f_rolUser"]);
		$poUsuario->fpSetClave($_POST["f_clavePri"]);
		$poUsuario->fpSetPreguntaSecreta($_POST["f_AskUser"]);
		$poUsuario->fpSetRespuestaSecreta(strtoupper(trim($_POST["f_AnswerUser"])));
		$poUsuario->fpSetEstatus(1);



    }

    function fpPasarCamposPersonas($poPersona)
    {
		$poPersona->fpSetNombre($_POST["f_nombres"]);
		$poPersona->fpSetCedula($_POST["f_cedula"]);
		$poPersona->fpSetApellido($_POST["f_apellidos"]);
		$poPersona->fpSetSexo($_POST["f_sexo"]);
		$poPersona->fpSetDireccion($_POST["f_direccion"]);
		$poPersona->fpSetTelefono($_POST["f_telefono"]);
		$poPersona->fpSetFechaNaci($_POST["f_fechaNac"]);
		$poPersona->fpSetGradoEstudio(1);
		$poPersona->fpSetTallaFranela(1);
		$poPersona->fpSetEstatus(1);
    }
?>
