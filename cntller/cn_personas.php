<?php
	session_start();
   	require_once("../clases/claPersonas.php");
   	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion =new clsFunciones();
   	


		$lsGradoEstudio="1";
		$lsTallaFranela="1";
		$lsSexoFeligres=$_POST["f_sexo"];
		$lsCIyNaci=$loFuncion->DameCIyNaci($_POST["f_cedula"]);
		$lsNacionalidad=$lsCIyNaci["0"];
		$lsCedula=$lsCIyNaci["1"];


		$loPersona=new claPersonas();
		$loPersona->asNacionalidad=$lsNacionalidad;
		$loPersona->asCedula=$lsCedula;
		$loPersona->asIDpersona=$_POST["f_refFeligres"];
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
			$lbEnc=$loPersona->fbBuscar();
			if (!$lbEnc)
			{
				$lbEnc=$loPersona->fbBuscarPorCedula();
			}
			if($lbEnc)
			{
				$liHay=1;			
				$lsIDpersona=$loPersona->asIDpersona;
				$lsNacionalidad=$loPersona->asNacionalidad;
				$lsCedula=$loPersona->asCedula;
				$lsNombre=$loPersona->asNombre;
				$lsApellido=$loPersona->asApellido;
				$lsSexo=$loPersona->asSexo;
				$lsFechaNaci=$loPersona->asFechaNaci;
				$lsDireccion=$loPersona->asDireccion;
				$lsDireccion=$loPersona->asDireccion;
				$lsEstado=$loPersona->asIDFestado;
				$lsCiudad=$loPersona->asIDFciudad;
				$lsMunicipio=$loPersona->asIDFmunicipio;
				$lsParroquia=$loPersona->asIDFparroquia;				
				$lsTelefono=$loPersona->asTelefono;
				$lsIglesia=$loPersona->asIDIglesia;
				$lsCedulaMadre=$loPersona->asCedulaMadre;
				$lsNombMadre=$loPersona->asNombreMadre;
				$lsCedulaPadre=$loPersona->asCedulaPadre;
				$lsNombPadre=$loPersona->asNombrePadre;	
				$lsFechaRegistro=$loPersona->asFechaRegistro;		
				$lsGradoEstudio=$loPersona->asGradoEstudio;
				$lsTallaFranela=$loPersona->asTallaFranela;
				$lsEstatus=$loPersona->asEstatus;
			}
			else
			{
				$liHay=0;
			}
			break;


		case "buscar_like":
			$cadena = strtoupper($_REQUEST['txtcadena']);
			$arr = $loPersona->buscarLike("proximo",$cadena);
			$cabecera = "<tr>
							<td>Cedula</td>
							<td>Nombre</td>
							<td>Apellido</td>
							<td>Sexo</td>
							<td>Teléfono</td>
							<td>Parroquia</td>
							<td>-</td>
						</tr>";
			for($i=0;$i<count($arr);$i++){
				$line.="<tr>";
					$line.="<td>".$arr[$i]['Cedula']."</td>";
					$line.="<td>".$arr[$i]['Nombres']."</td>";
					$line.="<td>".$arr[$i]['Apellidos']."</td>";
					$line.="<td>".$arr[$i]['SexoDescrip']."</td>";
					$line.="<td>".$arr[$i]['Telefono']."</td>";
					$line.="<td>".$arr[$i]['NombreParroquia']."</td>";
					$line.="<td>
					<form name=\"fr_matriLike".$i."\" id=\"fr_matriLike".$i."\" action=\"".$_SERVER['HTTP_REFERER']."\" method=\"post\">
					<input type=\"hidden\" name=\"nvaCedula\" id=\"nvaCedula\" value=\"".$arr[$i]['Cedula']."\">
					<input type=\"hidden\" name=\"nvaidPersona\" id=\"nvaidPersona\" value=\"".$arr[$i]['idTpersonas']."\">
					<button type=\"button\" style=\"display:block; margin:0 auto; padding:3px;\" onclick=\"fpSelectLike('fr_matriLike".$i."');\" class=\"btn btn-primary\" name=\"b_Nuevo\"><span class=\"fa fa-check\"></span></button>
					</form></td>";
				$line.="</tr>";
			}
			print $cabecera.$line;
		break;

		case "ExaminaPadre":

		$CIPersona=$loFuncion->DameCIyNaci($_POST[$lsHacer]);
		$lsPersona=$loPersona->DameIDpersonaDesdeCI($CIPersona["0"]."-".$CIPersona["1"],true);
		$lsCedula=$lsPersona["CedulaFull"];
		$lsNombre=$lsPersona["NombreFull"];
		$lsSexo=$lsPersona["Sexo"];
		$liHay=$lsPersona["liHay"];
		if ($lsHacer=="f_cedulaMadre")
		{
			if ($lsSexo=="M")
			{
				$liHay=3;
			}
		}
		elseif ($lsHacer=="f_cedulaPadre")
		{
			if ($lsSexo=="F")
			{
				$liHay=4;
			}
		}
		break;

		case "incluir":

			if($lsHacer=="buscar")
			{
				$lbEnc=$loPersona->fbBuscar();
				if (!$lbEnc)
				{
					$lbEnc=$loPersona->fbBuscarPorCedula();
				}
				if($lbEnc)
				{
					$liHay=1;
				$lsIDpersona=$loPersona->asIDpersona;
				$lsNacionalidad=$loPersona->asNacionalidad;
				$lsCedula=$loPersona->asCedula;
				$lsNombre=$loPersona->asNombre;
				$lsApellido=$loPersona->asApellido;
				$lsSexo=$loPersona->asSexo;
				$lsFechaNaci=$loPersona->asFechaNaci;
				$lsDireccion=$loPersona->asDireccion;
				$lsEstado=$loPersona->asIDFestado;
				$lsCiudad=$loPersona->asIDFciudad;
				$lsMunicipio=$loPersona->asIDFmunicipio;
				$lsParroquia=$loPersona->asIDFparroquia;	
				$lsTelefono=$loPersona->asTelefono;
				$lsIglesia=$loPersona->asIDIglesia;
				$lsCedulaMadre=$loPersona->asCedulaMadre;
				$lsNombMadre=$loPersona->asNombreMadre;
				$lsCedulaPadre=$loPersona->asCedulaPadre;
				$lsNombPadre=$loPersona->asNombrePadre;	
				$lsFechaRegistro=$loPersona->asFechaRegistro;
				$lsGradoEstudio=$loPersona->asGradoEstudio;
				$lsTallaFranela=$loPersona->asTallaFranela;
				$lsEstatus=$loPersona->asEstatus;

				}
				else
				{
					$liHay=0;
				
				}
			}
			if($lsHacer=="incluir")
			{
				fpPasar_Campos($loPersona,$loFuncion,$lsGradoEstudio,$lsTallaFranela,$lsNacionalidad,$lsCedula,$lsSexoFeligres);
				$lbHecho=$loPersona->fbIncluir();
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

		case "incluirPublico":

			if($lsHacer=="buscar")
			{
				$lbEnc=$loPersona->fbBuscar();
				if (!$lbEnc)
				{
					$lbEnc=$loPersona->fbBuscarPorCedula();
				}
				if($lbEnc)
				{
					$liHay=1;
				}
				else
				{
					$liHay=0;
				
				}
			}
			if($lsHacer=="incluir")
			{
				fpPasar_Campos($loPersona,$loFuncion,$lsGradoEstudio,$lsTallaFranela,$lsNacionalidad,$lsCedula,$lsSexoFeligres);
				$lbHecho=$loPersona->fbIncluirPublico();
				if($lbHecho)
				{

					$_SESSION["usuario"]=$lsCedula;
					$_SESSION["rol"]='4';
					$_SESSION["sexoUsuario"]=$lsSexoFeligres;
					$_SESSION["nombreUsuario"]=$lsNombre." ".$lsApellido;
					$_SESSION["IDTpersona"]=$lsIDpersona;
					$_SESSION["title"]="Software para la Diocesis de Acarigua-Araure";

					switch($_SESSION["rol"])
					{
						case "A":	//Administrador
							$_SESSION["rolNombre"]="Administrador";
							break;
						case "S":	//Sacerdote
							$_SESSION["rolNombre"]="Sacerdote";
							break;
						case "O":	//Operador
							$_SESSION["rolNombre"]="Operador";
							break;
						case "F":	//Feligres
							$_SESSION["rolNombre"]="Feligrés";
							break;
					}
					$liHay=1;
				}
				else
				{
					$liHay=0;

				}
			}
			break;
		case "modificar":
			fpPasar_Campos($loPersona,$loFuncion,$lsGradoEstudio,$lsTallaFranela,$lsNacionalidad,$lsCedula,$lsSexoFeligres);
			$lbHecho=$loPersona->fbModificar();
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
			$lbHecho=$loPersona->fbActivar("1");
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
			$lbHecho=$loPersona->fbActivar("0");
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
    	
	if (empty($_GET["AccionGet"])&&(!empty($_POST["txtOperacion"])))
	{
		header('Content-type: text/javascript');
		
		$json = array( "lsIDpersona" => $lsIDpersona, "lsNacionalidad" => $lsNacionalidad, "lsCedula" => $lsCedula, "lsNombre" => $lsNombre, "lsApellido" => $lsApellido, "lsSexo" => $lsSexo, "lsFechaNaci" => $lsFechaNaci, "lsDireccion"=> $lsDireccion, "lsEstado" => $lsEstado, "lsCiudad" => $lsCiudad, "lsMunicipio" => $lsMunicipio, "lsParroquia" => $lsParroquia, "lsTelefono" => $lsTelefono, "lsIglesia" => $lsIglesia, "lsCedulaMadre" => $lsCedulaMadre, "lsNombMadre" => $lsNombMadre, "lsCedulaPadre" => $lsCedulaPadre, "lsNombPadre" => $lsNombPadre, "lsFechaRegistro" => $lsFechaRegistro, "lsGradoEstudio" => $lsGradoEstudio, "lsTallaFranela" => $lsTallaFranela, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer"=> $lsHacer, "lsEstatus"=> $lsEstatus);
		
		$envi = array("Person"=>$json,"Padres"=>$laMatrizPadres);

		echo json_encode( $envi );
	}	
   
    function fpPasar_Campos($poPersona,$poFuncion,$lsGradoEstudio,$lsTallaFranela,$lsNacionalidad,$lsCedula,$lsSexoFeligres)
    {
		
		$lsIDpersona=$_POST["f_refFeligres"];
		$lsNombre=$_POST["f_nombres"];
		$lsApellido=$_POST["f_apellidos"];
		$lsSexo=$lsSexoFeligres;
		$lsFechaNaci=$_POST["f_fechaNac"];
		$lsDireccion=$_POST["f_direccion"];
		$lsEstado=$_POST["cmb_Estado"];
		$lsCiudad=$_POST["cmb_Ciudad"];
		$lsMunicipio=$_POST["cmb_Municipio"];
		$lsParroquia=$_POST["cmb_Parroquia"];
		$lsIglesia=$_POST["cmb_Iglesia"];
		$lsTelefono=$_POST["f_telefono"];
		$lsClave=$_POST["f_clavePri"];
		$lsPreguntaSecreta=$_POST["f_AskUser"];
		$lsRespuestaSecreta=$_POST["f_AnswerUser"];
		$CIMadre=$poFuncion->DameCIyNaci($_POST["f_cedulaMadre"]);
		$CIPadre=$poFuncion->DameCIyNaci($_POST["f_cedulaPadre"]);
		$lsIDMadre=$poPersona->DameIDpersonaDesdeCI($CIMadre["0"]."-".$CIMadre["1"],false);
		$lsIDPadre=$poPersona->DameIDpersonaDesdeCI($CIPadre["0"]."-".$CIPadre["1"],false);

		$poPersona->asNacionalidad=$lsNacionalidad;
		$poPersona->asIDpersona=$lsIDpersona;
		$poPersona->asCedula=$lsCedula;
		$poPersona->asNombre=$lsNombre;
		$poPersona->asApellido=$lsApellido;
		$poPersona->asSexo=$lsSexo;
		$poPersona->asDireccion=$lsDireccion;
		$poPersona->asIDFestado=$lsEstado;
		$poPersona->asIDFciudad=$lsCiudad;
		$poPersona->asIDFmunicipio=$lsMunicipio;
		$poPersona->asIDFparroquia=$lsParroquia;
		$poPersona->asTelefono=$lsTelefono;
		$poPersona->asIDIglesia=$lsIglesia;
		$poPersona->asIDFmadre=$lsIDMadre;
		$poPersona->asIDFpadre=$lsIDPadre;
		$poPersona->asFechaNaci=$lsFechaNaci;
		$poPersona->asGradoEstudio=$lsGradoEstudio;
		$poPersona->asTallaFranela=$lsTallaFranela;
		$poPersona->asUsuario=$lsCedula;
		$poPersona->fpSetClave(sha1(md5($lsClave)));
		$poPersona->asPreguntaSecreta=$lsPreguntaSecreta;
		$poPersona->asRespuestaSecreta=$lsRespuestaSecreta;

	}
?>
