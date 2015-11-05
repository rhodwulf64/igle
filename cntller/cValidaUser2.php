<?php

    session_start();
    require_once("../clases/claUser.php");
	$loUsuario=new claUser();
	if ($_GET["Topic"]=="RecuperaUsuario")
	{

		$subTopic=$_POST["subTopic"];
		if (!empty($_POST["f_cedula"]))
		{
			$lsCedula=$_POST["f_cedula"];
			$lsPreguntaSeguridad=$_POST["lsAskUser"];
			$loUsuario->fpSetCedula($lsCedula);
		}
			
			if ($subTopic=="1")
			{
				if (!empty($_POST["f_AnswerUser"]))
				{
					$lsAnswerUser=$_POST["f_AnswerUser"];
					$lsAnswerUser=strtoupper(trim($lsAnswerUser));
				
						$lbEnc=$loUsuario->fbBuscar();
						if($lbEnc)
						{
							$lsRespuestaSeguridad=$loUsuario->fsGetRespuestaSecreta();

							if ($lsAnswerUser==$lsRespuestaSeguridad)
							{
								$userName=$loUsuario->fsGetUsuario();
								$loUsuario->fpSetClave($userName);
								$mbEnc=$loUsuario->fbRecuperarClave();
								if ($mbEnc){
									header("location: ../vis/recuperar.php?subTopic=5&lsCedula=$lsCedula&lsOperacion=buscar&liHay=1");
								}
								else
								{
									header("location: ../vis/recuperar.php?subTopic=5&lsCedula=$lsCedula&lsOperacion=buscar&liHay=0");
								}
							}
							else
							{
								header("location: ../vis/recuperar.php?subTopic=2&lsCedula=$lsCedula&lsPreguntaSeguridad=$lsPreguntaSeguridad&lsOperacion=buscar&liHay=0");
							}
						}
						else
						{

							header("location: ../vis/recuperar.php?subTopic=3&lsCedula=$lsCedula&lsOperacion=buscar&liHay=0");
						}
				}
				else
				{
					header("location: ../vis/recuperar.php?subTopic=4&lsCedula=$lsCedula&lsPreguntaSeguridad=$lsPreguntaSeguridad&lsOperacion=buscar&liHay=0");
				}
			}
			else
			{

				$lbEnc=$loUsuario->fbBuscar();
				if($lbEnc)
				{
					$lsPreguntaSeguridad=$loUsuario->fsGetPreguntaSecreta();

					header("location: ../vis/recuperar.php?subTopic=1&lsCedula=$lsCedula&lsPreguntaSeguridad=$lsPreguntaSeguridad&lsOperacion=buscar&liHay=1");
				}
				else{
					header("location: ../vis/recuperar.php?subTopic=3&lsCedula=$lsCedula&lsOperacion=buscar&liHay=0");
				}
			}

	}
	else
	{
		$loUsuario->fpSetCedula($_POST["textUsuario"]);
		$loUsuario->fpSetClave($_POST["textClave"]);
	    $lbEnc=$loUsuario->fbBuscar2();
	    if($lbEnc)
	    {
	    	if ($loUsuario->fsGetEstatus()==1)
	    	{
				$_SESSION["usuario"]=$loUsuario->fsGetCedula();
				$_SESSION["rol"]=$loUsuario->fsGetRol();
				$_SESSION["nombreUsuario"]=$loUsuario->fsGetNombre()." ".$loUsuario->fsGetApellido();

				switch($_SESSION["rol"])
				{
					case "A":	//Administrador
						$_SESSION["rolNombre"]="Administrador";
						break;
					case "C":	//Catequista
						$_SESSION["rolNombre"]="Catequista";
						break;
					case "O":	//Operador
						$_SESSION["rolNombre"]="Operador";
						break;
					case "S":	//Sacerdote
						$_SESSION["rolNombre"]="Sacerdote";
						break;
					
				}
				$_SESSION["message"]="";
				header("location: ../index.php");
			}
			else
			{
				$liHay="3";
			}
		}
		else
		{
			$liHay="2";
		}
		
		header("location: ../index.php?liHay=$liHay");
	}
?>
