<?php
	session_start();
   	require_once("../clases/claSacerdote.php");
   	require_once("../clases/claPersonas.php");
   	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion =new clsFunciones();
	$loPersona=new claPersonas();


		$lsCIyNaci=$loFuncion->DameCIyNaci($_POST["f_cedula"]);
		$lsNacionalidad=$lsCIyNaci["0"];
		$lsCedula=$lsCIyNaci["1"];
		
		$lsGradoEstudio="1";
		$lsTallaFranela="1";

		$loSacerdote=new claSacerdote();
		$loSacerdote->asNacionalidad=$lsNacionalidad;
		$loSacerdote->asCedula=$lsCedula;
		$loPersona->asNacionalidad=$lsNacionalidad;
		$loPersona->asCedula=$lsCedula;
		$loSacerdote->asIDSacerdo=$_POST["f_refSacerdo"];
		$loSacerdote->asIDpersona=$_POST["f_refFeligres"];
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
			$lbEnc=$loSacerdote->fbBuscar();
			if($lbEnc)
			{
				$liHay=1;			
				$lsNacionalidad=$loSacerdote->asNacionalidad;
				$lsCedula=$loSacerdote->asCedula;
				$lsNombre=$loSacerdote->asNombre;
				$lsApellido=$loSacerdote->asApellido;
				$lsSexo=$loSacerdote->asSexo;
				$lsFechaNaci=$loSacerdote->asFechaNaci;
				$lsIglesia=$loSacerdote->asIDFiglesia;
				$lsDireccion=$loSacerdote->asDireccion;
				$lsObservacion=$loSacerdote->asObservacion;
				$lsEstado=$loSacerdote->asIDFestado;
				$lsCiudad=$loSacerdote->asIDFciudad;
				$lsMunicipio=$loSacerdote->asIDFmunicipio;
				$lsParroquia=$loSacerdote->asIDFparroquia;				
				$lsTelefono=$loSacerdote->asTelefono;
				$lsCedulaMadre=$loSacerdote->asCedulaMadre;
				$lsNombMadre=$loSacerdote->asNombreMadre;
				$lsCedulaPadre=$loSacerdote->asCedulaPadre;
				$lsNombPadre=$loSacerdote->asNombrePadre;	
				$lsFechaRegistro=$loSacerdote->asFechaRegistro;		
				$lsGradoEstudio=$loSacerdote->asGradoEstudio;
				$lsTallaFranela=$loSacerdote->asTallaFranela;
				$lsFechaInicioParroquia=$loSacerdote->asFechaInicioParroquia;
				$lsFechaFinParroquia=$loSacerdote->asFechaFinParroquia;
				$lsEstatus=$loSacerdote->asEstatus;
			}
			else
			{
				$liHay=0;
			}
			break;


		case "buscar_like":
			$cadena = strtoupper($_REQUEST['txtcadena']);
			$arr = $loSacerdote->buscarLike("proximo",$cadena);
			$cabecera = "<tr>
							<td>Cedula</td>
							<td>Nombre</td>
							<td>Apellido</td>
							<td>Teléfono</td>
							<td>Parroquia</td>
							<td>Fecha Inicio en Parroquia</td>
							<td>-</td>
						</tr>";
			for($i=0;$i<count($arr);$i++){
				$line.="<tr>";
					$line.="<td>".$arr[$i]['Cedula']."</td>";
					$line.="<td>".$arr[$i]['Nombres']."</td>";
					$line.="<td>".$arr[$i]['Apellidos']."</td>";
					$line.="<td>".$arr[$i]['Telefono']."</td>";
					$line.="<td>".$arr[$i]['NombreParroquia']."</td>";
					$line.="<td>".$arr[$i]['FechaInicioParroquia']."</td>";
					$line.="<td>
					<form name=\"fr_matriLike".$i."\" id=\"fr_matriLike".$i."\" action=\"".$_SERVER['HTTP_REFERER']."\" method=\"post\">
					<input type=\"hidden\" name=\"nvaCedula\" id=\"nvaCedula\" value=\"".$arr[$i]['Cedula']."\">
					<input type=\"hidden\" name=\"nvaidPersona\" id=\"nvaidPersona\" value=\"".$arr[$i]['idTpersonas']."\">
					<input type=\"hidden\" name=\"nvaidSacerdo\" id=\"nvaidSacerdo\" value=\"".$arr[$i]['idTsacerdote']."\">
					<button type=\"button\" style=\"display:block; margin:0 auto; padding:3px;\" onclick=\"fpSelectLike('fr_matriLike".$i."');\" class=\"btn btn-primary\" name=\"b_Nuevo\"><span class=\"fa fa-check\"></span></button>
					</form></td>";
				$line.="</tr>";
			}
			print $cabecera.$line;
		break;

		case "ExaminaPadre":

		$CIPersona=$loFuncion->DameCIyNaci($_POST[$lsHacer]);
		$lsPersona=$loSacerdote->DameIDpersonaDesdeCI($CIPersona["1"],true);
		$lsCedula=$lsPersona["CedulaFull"];
		$lsNombre=$lsPersona["NombreFull"];
		$liHay=$lsPersona["liHay"];

		break;

		case "incluir":

			if($lsHacer=="buscar")
			{
				$lbEncP=$loPersona->fbBuscar();
				if ($lbEncP)
				{
					$liHay=4;
					$lsNacionalidad=$loPersona->asNacionalidad;
					$lsCedula=$loPersona->asCedula;
					$lsNombre=$loPersona->asNombre;
					$lsApellido=$loPersona->asApellido;
					$lsSexo=$loPersona->asSexo;
					$lsDireccion=$loPersona->asDireccion;
					$lsEstado=$loPersona->asIDFestado;
					$lsCiudad=$loPersona->asIDFciudad;
					$lsMunicipio=$loPersona->asIDFmunicipio;
					$lsParroquia=$loPersona->asIDFparroquia;
					$lsTelefono=$loPersona->asTelefono;
					$lsFechaNaci=$loPersona->asFechaNaci;
					if ($lsSexo=="F")
					{
						$liHay=3;
					}
					$lbEnc=$loSacerdote->fbBuscar();
					if($lbEnc)
					{
						$liHay=1;

					$lsNacionalidad=$loSacerdote->asNacionalidad;
					$lsCedula=$loSacerdote->asCedula;
					$lsNombre=$loSacerdote->asNombre;
					$lsApellido=$loSacerdote->asApellido;
					$lsSexo=$loSacerdote->asSexo;
					$lsFechaNaci=$loSacerdote->asFechaNaci;
					$lsIglesia=$loSacerdote->asIDFiglesia;
					$lsDireccion=$loSacerdote->asDireccion;
					$lsEstado=$loSacerdote->asIDFestado;
					$lsCiudad=$loSacerdote->asIDFciudad;
					$lsMunicipio=$loSacerdote->asIDFmunicipio;
					$lsParroquia=$loSacerdote->asIDFparroquia;	
					$lsTelefono=$loSacerdote->asTelefono;
					$lsCedulaMadre=$loSacerdote->asCedulaMadre;
					$lsNombMadre=$loSacerdote->asNombreMadre;
					$lsCedulaPadre=$loSacerdote->asCedulaPadre;
					$lsNombPadre=$loSacerdote->asNombrePadre;	
					$lsFechaRegistro=$loSacerdote->asFechaRegistro;
					$lsGradoEstudio=$loSacerdote->asGradoEstudio;
					$lsTallaFranela=$loSacerdote->asTallaFranela;
					$lsEstatus=$loSacerdote->asEstatus;

					}
				}
				else
				{
					$liHay=0;
				
				}
			}
			if($lsHacer=="incluir")
			{
				fpPasar_Campos($loSacerdote,$loFuncion,$lsGradoEstudio,$lsTallaFranela,$lsNacionalidad,$lsCedula);
				$lbHecho=$loSacerdote->fbIncluir();
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
		case "modificar":
			fpPasar_Campos($loSacerdote,$loFuncion,$lsGradoEstudio,$lsTallaFranela,$lsNacionalidad,$lsCedula);
			$lbHecho=$loSacerdote->fbModificar();
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
			$lbHecho=$loSacerdote->fbActivar();
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
			$lbHecho=$loSacerdote->fbActivar();
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
		
		$json = array( "lsNacionalidad" => $lsNacionalidad, "lsCedula" => $lsCedula, "lsNombre" => $lsNombre, "lsApellido" => $lsApellido, "lsSexo" => $lsSexo, "lsFechaNaci" => $lsFechaNaci, "lsIglesia"=> $lsIglesia, "lsDireccion"=> $lsDireccion, "lsObservacion"=> $lsObservacion, "lsEstado" => $lsEstado, "lsCiudad" => $lsCiudad, "lsMunicipio" => $lsMunicipio, "lsParroquia" => $lsParroquia, "lsTelefono" => $lsTelefono, "lsCedulaMadre" => $lsCedulaMadre, "lsNombMadre" => $lsNombMadre, "lsCedulaPadre" => $lsCedulaPadre, "lsNombPadre" => $lsNombPadre, "lsFechaRegistro" => $lsFechaRegistro, "lsGradoEstudio" => $lsGradoEstudio, "lsTallaFranela" => $lsTallaFranela, "lsFechaInicioParroquia" => $lsFechaInicioParroquia, "lsFechaFinParroquia" => $lsFechaFinParroquia, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer"=> $lsHacer, "lsEstatus"=> $lsEstatus);
		
		$envi = array("Person"=>$json,"Padres"=>$laMatrizPadres);

		echo json_encode( $envi );
	}	
   
    function fpPasar_Campos($poPersona,$poFuncion,$lsGradoEstudio,$lsTallaFranela,$lsNacionalidad,$lsCedula)
    {
		
		$lsNombre=$_POST["f_nombres"];
		$lsApellido=$_POST["f_apellidos"];
		$lsSexo="M";
		$lsFechaNaci=$_POST["f_fechaNac"];
		$lsIglesia=$_POST["cmb_Iglesia"];
		$lsDireccion=$_POST["f_direccion"];
		$lsEstado=$_POST["cmb_Estado"];
		$lsCiudad=$_POST["cmb_Ciudad"];
		$lsMunicipio=$_POST["cmb_Municipio"];
		$lsParroquia=$_POST["cmb_Parroquia"];
		$lsTelefono=$_POST["f_telefono"];
		$CIMadre=$poFuncion->DameCIyNaci($_POST["f_cedulaMadre"]);
		$CIPadre=$poFuncion->DameCIyNaci($_POST["f_cedulaPadre"]);
		$lsIDMadre=$poPersona->DameIDpersonaDesdeCI($CIMadre["1"],false);
		$lsIDPadre=$poPersona->DameIDpersonaDesdeCI($CIPadre["1"],false);
		$lsidFiglesia=$_POST["cmb_Iglesia"];
		$lsFechaInicioParroquia=$_POST["f_fechaInicioParroquia"];
		$lsFechaFinParroquia=$_POST["f_fechaFinParroquia"];
		$lsObservacion=$_POST["f_Observacion"];

		$poPersona->asNacionalidad=$lsNacionalidad;
		$poPersona->asCedula=$lsCedula;
		$poPersona->asNombre=$lsNombre;
		$poPersona->asApellido=$lsApellido;
		$poPersona->asSexo=$lsSexo;
		$poPersona->asIDFiglesia=$lsIglesia;
		$poPersona->asDireccion=$lsDireccion;
		$poPersona->asIDFestado=$lsEstado;
		$poPersona->asIDFciudad=$lsCiudad;
		$poPersona->asIDFmunicipio=$lsMunicipio;
		$poPersona->asIDFparroquia=$lsParroquia;
		$poPersona->asTelefono=$lsTelefono;
		$poPersona->asIDFmadre=$lsIDMadre;
		$poPersona->asIDFpadre=$lsIDPadre;
		$poPersona->asFechaNaci=$lsFechaNaci;
		$poPersona->asGradoEstudio=$lsGradoEstudio;
		$poPersona->asTallaFranela=$lsTallaFranela;
		//TABLA SACERDOTE
		$poPersona->asidFiglesia=$lsidFiglesia;
		$poPersona->asFechaInicioParroquia=$lsFechaInicioParroquia;
		$poPersona->asFechaFinParroquia=$lsFechaFinParroquia;
		$poPersona->asObservacion=$lsObservacion;






	}
?>
