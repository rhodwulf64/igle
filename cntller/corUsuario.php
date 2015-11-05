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
	$lsCeduUser=$lsCIyNaci["1"];
	
	$loUsuario=new claUser();

	$loUsuario->fpSetNacionalidad($lsNacionalidad);
	$loUsuario->fpSetCedula($lsCeduUser);
	$loPersona=new claPersonas();

	$loPersona->asIDpersona=$_POST['txtIDTpersona'];
	$loPersona->asNacionalidad=$lsNacionalidad;
	$loUsuario->fpSetUsuario($lsCeduUser);
	$loUsuario->fpSetIDTusuario($_POST['txtIDTusuario']);
	$lsCedula=$lsCeduUser;
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
				$lsIDTusuario=$loUsuario->fsGetIDTusuario();
				$lsIDTpersona=$loUsuario->fsGetIDTpersonas();
				$lsNacionalidadUser=$loUsuario->fsGetNacioUser();
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
				if($lbEnc > 0)
				{
					$liHay=1;
					$lsIDTusuario=$loUsuario->fsGetIDTusuario();
					$lsIDTpersona=$loUsuario->fsGetIDTpersonas();
					$lsNacionalidadUser=$loUsuario->fsGetNacioUser();
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
					fpPasarCamposUser($loUsuario,$lsNacionalidad,$lsCeduUser);
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
				elseif ($liHay=="0")
				{
					fpPasarCamposPersonas($loPersona,$loFuncion);
					fpPasarCamposUser($loUsuario,$lsNacionalidad,$lsCeduUser);
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
					$liHay=2;
					}
				}
			}
			break;
		case "modificar":
			$liHay=0;
			fpPasarCamposPersonas($loPersona,$loFuncion);
			fpPasarCamposUser($loUsuario,$lsNacionalidad,$lsCeduUser);
			$lbHecho=$loPersona->fbModificar();
			if ($lbHecho)
			{
				$liHay=3; //modifico solo personas
			}
			$lbHecho=$loUsuario->fbModificar();
			if($lbHecho)
			{
				$liHay=1; //modifico usuario
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
$json = array( "lsIDTpersona" => $lsIDTpersona, "lsIDTusuario" => $lsIDTusuario, "lsNacionalidadUser" => $lsNacionalidadUser, "lsCedula" => $lsCedula, "lsNombre" => $lsNombre, "lsApellido" => $lsApellido, "lsUsuario" => $lsUsuario, "lsRol" => $lsRol, "lsPreguntaSecreta" => $lsPreguntaSecreta, "lsRespuestaSecreta" => $lsRespuestaSecreta, "lsEstatus" => $lsEstatus, "lsSexo" => $lsSexo, "lsDireccion" => $lsDireccion, "lsTelefono" => $lsTelefono, "lsFechaNaci" => $lsFechaNaci, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer" => $lsHacer );

echo json_encode( $json );
   
    function fpPasarCamposUser($poUsuario,$lsNacionalidad,$lsCeduUser)
    {
    	$poUsuario->fpSetNacionalidad($lsNacionalidad);
		$poUsuario->fpSetCedula($lsCeduUser);
    	$poUsuario->fpSetUsuario($lsCeduUser);
		$poUsuario->fpSetRol($_POST["f_rolUser"]);
		$poUsuario->fpSetClave($_POST["f_clavePri"]);
		$poUsuario->fpSetPreguntaSecreta($_POST["f_AskUser"]);
		$poUsuario->fpSetRespuestaSecreta(strtoupper(trim($_POST["f_AnswerUser"])));
		$poUsuario->fpSetEstatus(1);



    }

    function fpPasarCamposPersonas($poPersona,$poFuncion)
    {

    	$lsDatosUser=$poFuncion->DameCIyNaci($_POST["f_cedula"]);
		$lsNacionalidadUser=$lsDatosUser["0"];
		$lsCedulaUser=$lsDatosUser["1"]; 

		$poPersona->asNombre=$_POST["f_nombres"];
		$poPersona->asCedula=$lsCedulaUser;
		$poPersona->asApellido=$_POST["f_apellidos"];
		$poPersona->asSexo=$_POST["f_sexo"];
		$poPersona->asDireccion=$_POST["f_direccion"];
		$poPersona->asFechaNaci=$_POST["f_fechaNac"];
		$poPersona->asTelefono=$_POST["f_telefono"];
		$poPersona->asIDFestado="";
		$poPersona->asIDFciudad="";
		$poPersona->asIDFmunicipio="";
		$poPersona->asIDFparroquia="";
		$poPersona->asGradoEstudio=1;
		$poPersona->asTallaFranela=1;
		$poPersona->asEstatus=1;
    }
?>
