<?php

  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
		header("location: ../vis/visSalir.php");
	}
   	require_once("../clases/claBautismo.php");
   	require_once("../clases/claPersonas.php");
   	require_once("../clases/claPadrinos.php");
   	require_once("../clases/clsFuncionesGlobales.php");
	$loFuncion =new clsFunciones();
	$loPadrinos=new claPadrinos();
	$loBautismo=new claBautismo();
	$loPersona=new claPersonas();
	$loBautismo->asReferenciaInfante=$_POST["RefInfanteBuscar"];
	$lsOperacion=$_POST["txtOperacion"];
	$paramGive=$_POST["lsRepresentados"];
	$paramTive=$_POST["lsRepresenNumeros"];

	$lsDatosRepre=$loFuncion->DameCIyNaci($_POST["f_cedulaRepre"]);
	$lsNacionalidadRepre=$lsDatosRepre["0"];
	$lsCedulaRepre=$lsDatosRepre["1"]; 

	$lsDatosMama=$loFuncion->DameCIyNaci($_POST["f_cedulamama"]);
	$lsNacionalidadMama=$lsDatosMama["0"];
	$lsCeduMama=$lsDatosMama["1"]; 

	$lsDatosPapa=$loFuncion->DameCIyNaci($_POST["f_cedulapapa"]);
	$lsNacionalidadPapa=$lsDatosPapa["0"];
	$lsCedulaPapa=$lsDatosPapa["1"]; 

	$lsRepreCanti=$_POST["lsRepresenCanti"];
	$lsNombreRepre=$_POST["lsNombreRepre"];
	$lsApellidoRepre=$_POST["lsApellidoRepre"];
	$lsProxEscolarMama=$_POST["lsProxEscolarMama"];
	$lsProxEscolarPapa=$_POST["lsProxEscolarPapa"];
	$lsProxEscolarRepre=$_POST["lsProxEscolarRepre"];	
	$lsHacer=$_POST["txtHacer"];
	$liHay=$_POST["txtHay"];
	$lsObj=$_GET["obj"];
	$lsFila=$_POST["txtFila"];
	$datRepre=array();
	$datMama=array();
	$datPapa=array();



		if (empty($lsOperacion))
		{
			$lsOperacion=$_GET["AccionGet"];
		}


	switch($lsOperacion)
   	{
   		case "buscar":
   		if($lsHacer=="buscar")
			{

		   			$loPadrinos->fpSetEventoPadrino("B");
					$lbEnc=$loBautismo->fbBuscarBauti();
					if($lbEnc)
					{
						$liHay=1;

							$lsIDbautizo=$loBautismo->asIDbautizo;
							$lsFechaInscri=$loBautismo->asFechaInscri;
							$lsFechaBautizo=$loBautismo->asFechaBautizo;
							$lsReferenciaInfante=$loBautismo->asReferenciaInfante;
							$lsNombresBau=$loBautismo->asNombresBau;
							$lsApellidosBau=$loBautismo->asApellidosBau;
							$lsSexoBau=$loBautismo->asSexoBau;
							$lsFechaNacimiento=$loBautismo->asFechaNacimiento;
							$lsBautizado=$loBautismo->asBautizado;
							$lsDireccion=$loBautismo->asDireccion;
							$lsEstado=$loBautismo->asIDestado;
							$lsCiudad=$loBautismo->asIDciudad;
							$lsMunicipio=$loBautismo->asIDmunicipio;
							$lsParroquia=$loBautismo->asIDparroquia;
							$lsNacionalidadRepre=$loBautismo->asNacioRepre;
							$lsCeduRepre=$loBautismo->asCeduRepre;
							$lsIDParentesco=$loBautismo->asIDParentesco;
							$lsNacionalidadMama=$loBautismo->asNacioMama;
							$lsCeduMama=$loBautismo->asCeduMama;
							$lsNacionalidadPapa=$loBautismo->asNacioPapa;
							$lsCeduPapa=$loBautismo->asCeduPapa;
							$lsIDSacerdote=$loBautismo->asIDSacerdote;
							$lsIDMinistro=$loBautismo->asIDMinistro;
							$lsNotaMarginal=$loBautismo->asNotaMarginal;
							$lsPrefectuDe=$loBautismo->asPrefectuDe;
							$lsPresentadoEl=$loBautismo->asPresentadoEl;
							$lsNumPartidaNac=$loBautismo->asNumPartidaNac;
							$lsLibro_registro=$loBautismo->asLibro_registro;
							$lsFolio_registro=$loBautismo->asFolio_registro;
							$lsNumero_registro=$loBautismo->asNumero_registro;
							$lsEstatusBau=$loBautismo->asEstatusBau;
				
							$loPadrinos->fpSetIDcumatba($lsIDbautizo);
							$laMatrizPadri=$loPadrinos->faListarPadrinos();

							$pasa=false;
							
							$loPersona->asCedula=$lsCeduRepre;
							$lbEncRepre=$loPersona->fbBuscarPorCedula();

							if ($lbEncRepre)
							{
			
								$datRepre = array( "lsCeduRepre" => $loPersona->asCedula, "lsNombreRepre" => $loPersona->asNombre, "lsApellidoRepre" => $loPersona->asApellido, "lsSexoRepre" => $loPersona->asSexo, "lsFechaNaciRepre"=> $loPersona->asFechaNaci, "lsDireccionRepre" => $loPersona->asDireccion, "lsTelefonoRepre" => $loPersona->asTelefono, "lsFechaRegistroRepre"=> $loPersona->asFechaRegistro, "lsGradoEstudioRepre" => $loPersona->asGradoEstudio, "lsTallaFranelaRepre"=> $loPersona->asTallaFranela, "lsEstatusRepre"=> $loPersona->asEstatus);
								$loPersona->asNacionalidad="";
							}					
							
							$loPersona->asCedula=$lsCeduMama;
							$lbEncMama=$loPersona->fbBuscar();
							if ($lbEncMama)
							{

							
								$datMama = array( "lsCeduMama" => $loPersona->asCedula, "lsNombreMama" => $loPersona->asNombre, "lsApellidoMama" => $loPersona->asApellido, "lsSexoMama" => $loPersona->asSexo, "lsFechaNaciMama"=> $loPersona->asFechaNaci, "lsDireccionMama" => $loPersona->asDireccion, "lsTelefonoMama" => $loPersona->asTelefono, "lsFechaRegistroMama"=> $loPersona->asFechaRegistro, "lsGradoEstudioMama" => $loPersona->asGradoEstudio, "lsTallaFranelaMama"=> $loPersona->asTallaFranela, "lsEstatusMama"=> $loPersona->asEstatus);
								$loPersona->asNacionalidad="";
							}
							
							$loPersona->asCedula=$lsCeduPapa;
							$lbEncPapa=$loPersona->fbBuscar();
							if ($lbEncPapa)
							{

							
								$datPapa = array( "lsCeduPapa" => $loPersona->asCedula, "lsNombrePapa" => $loPersona->asNombre, "lsApellidoPapa" => $loPersona->asApellido, "lsSexoPapa" => $loPersona->asSexo, "lsFechaNaciPapa"=> $loPersona->asFechaNaci, "lsDireccionPapa" => $loPersona->asDireccion, "lsTelefonoPapa" => $loPersona->asTelefono, "lsFechaRegistroPapa"=> $loPersona->asFechaRegistro, "lsGradoEstudioPapa" => $loPersona->asGradoEstudio, "lsTallaFranelaPapa"=> $loPersona->asTallaFranela, "lsEstatusPapa"=> $loPersona->asEstatus);
								$loPersona->asNacionalidad="";
						
								$pasa=true;
							}
							$Representantes=array_merge($datRepre, $datMama, $datPapa);

			  	
					}
					else
					{
						$liHay=0;
						$lsCedulaRepre=$_POST["f_cedulaRepre"];
						$lsReferenciaInfante=$_POST["f_refInfante"];
					}
			}


   		break;
   		case "incluir":
   			if($lsHacer=="buscar")
			{

		   			$loPadrinos->fpSetEventoPadrino("B");
					$lbEnc=$loBautismo->fbBuscarBauti();
					if($lbEnc)
					{
						$liHay=1;

							$lsIDbautizo=$loBautismo->asIDbautizo;
							$lsFechaInscri=$loBautismo->asFechaInscri;
							$lsFechaBautizo=$loBautismo->asFechaBautizo;
							$lsReferenciaInfante=$loBautismo->asReferenciaInfante;
							$lsNombresBau=$loBautismo->asNombresBau;
							$lsApellidosBau=$loBautismo->asApellidosBau;
							$lsSexoBau=$loBautismo->asSexoBau;
							$lsFechaNacimiento=$loBautismo->asFechaNacimiento;
							$lsBautizado=$loBautismo->asBautizado;
							$lsDireccion=$loBautismo->asDireccion;
							$lsEstado=$loBautismo->asIDestado;
							$lsCiudad=$loBautismo->asIDciudad;
							$lsMunicipio=$loBautismo->asIDmunicipio;
							$lsParroquia=$loBautismo->asIDparroquia;
							$lsCeduRepre=$loBautismo->asCeduRepre;
							$lsIDParentesco=$loBautismo->asIDParentesco;
							$lsCeduMama=$loBautismo->asCeduMama;
							$lsCeduPapa=$loBautismo->asCeduPapa;
							$lsIDSacerdote=$loBautismo->asIDSacerdote;
							$lsIDMinistro=$loBautismo->asIDMinistro;
							$lsNotaMarginal=$loBautismo->asNotaMarginal;
							$lsPrefectuDe=$loBautismo->asPrefectuDe;
							$lsPresentadoEl=$loBautismo->asPresentadoEl;
							$lsNumPartidaNac=$loBautismo->asNumPartidaNac;
							$lsLibro_registro=$loBautismo->asLibro_registro;
							$lsFolio_registro=$loBautismo->asFolio_registro;
							$lsNumero_registro=$loBautismo->asNumero_registro;
							$lsEstatusBau=$loBautismo->asEstatusBau;
				
							$loPadrinos->fpSetIDcumatba($lsIDbautizo);
							$laMatrizPadri=$loPadrinos->faListarPadrinos();

							$pasa=false;


							$loPersona->asCedula=$lsCeduRepre;
							$lbEncRepre=$loPersona->fbBuscar();
							if ($lbEncRepre)
							{
			
								$datRepre = array( "lsCeduRepre" => $loPersona->asCedula, "lsNombreRepre" => $loPersona->asNombre, "lsApellidoRepre" => $loPersona->asApellido, "lsSexoRepre" => $loPersona->asSexo, "lsFechaNaciRepre"=> $loPersona->asFechaNaci, "lsDireccionRepre" => $loPersona->asDireccion, "lsTelefonoRepre" => $loPersona->asTelefono, "lsFechaRegistroRepre"=> $loPersona->asFechaRegistro, "lsGradoEstudioRepre" => $loPersona->asGradoEstudio, "lsTallaFranelaRepre"=> $loPersona->asTallaFranela, "lsEstatusRepre"=> $loPersona->asEstatus);
								$loPersona->asNacionalidad="";
									
							}	


							$loPersona->asCedula=$lsCeduMama;
							$lbEncMama=$loPersona->fbBuscar();
							if ($lbEncMama)
							{

							
								$datMama = array( "lsCeduMama" => $loPersona->asCedula, "lsNombreMama" => $loPersona->asNombre, "lsApellidoMama" => $loPersona->asApellido, "lsSexoMama" => $loPersona->asSexo, "lsFechaNaciMama"=> $loPersona->asFechaNaci, "lsDireccionMama" => $loPersona->asDireccion, "lsTelefonoMama" => $loPersona->asTelefono, "lsFechaRegistroMama"=> $loPersona->asFechaRegistro, "lsGradoEstudioMama" => $loPersona->asGradoEstudio, "lsTallaFranelaMama"=> $loPersona->asTallaFranela, "lsEstatusMama"=> $loPersona->asEstatus);
								$loPersona->asNacionalidad="";
							}
							
							$loPersona->asCedula=$lsCeduPapa;
							$lbEncPapa=$loPersona->fbBuscar();
							if ($lbEncPapa)
							{

							
								$datPapa = array( "lsCeduPapa" => $loPersona->asCedula, "lsNombrePapa" => $loPersona->asNombre, "lsApellidoPapa" => $loPersona->asApellido, "lsSexoPapa" => $loPersona->asSexo, "lsFechaNaciPapa"=> $loPersona->asFechaNaci, "lsDireccionPapa" => $loPersona->asDireccion, "lsTelefonoPapa" => $loPersona->asTelefono, "lsFechaRegistroPapa"=> $loPersona->asFechaRegistro, "lsGradoEstudioPapa" => $loPersona->asGradoEstudio, "lsTallaFranelaPapa"=> $loPersona->asTallaFranela, "lsEstatusPapa"=> $loPersona->asEstatus);
								$loPersona->asNacionalidad="";
						
								$pasa=true;
							}
							$Representantes=array_merge($datRepre, $datMama, $datPapa);

			  	
					}
					else
					{
						$liHay=0;
						$lsCedulaRepre=$_POST["f_cedulaRepre"];
						$lsReferenciaInfante=$_POST["f_refInfante"];
					}
			}

			if($lsHacer=="incluir")
			{
					fpPasar_Campos($loBautismo,$loFuncion);
					$lbHecho=$loBautismo->fbIncluir();
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
			
		case "buscar_like":

			$cadena = strtoupper($_REQUEST['txtcadena']);
			$arr = $loBautismo->buscarLike("proximo",$cadena);
			$cabecera = "
						<thead>
							<tr>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">Ref</h4></th>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">Nombres y Apellidos</h4></th>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">Representante</h4></th>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">Bautizo</h4></th>
								<th><h4 class=\"modal-title\" id=\"myModalLabel\">-</h4></th>
							</tr>
						</thead>";
			for($i=0;$i<count($arr);$i++){
				if ($arr[$i]['Estatus']=="1")
				{
					$filaColor=' class="success" ';
				}
				else
				{
					$filaColor=' class="danger" ';
				}
				$line.="<tr height=\"1%\"$filaColor>";
					$line.="<th>".$arr[$i]['ReferenciaInfante']."</th>";
					$line.="<th>".CompletaCaracteres($arr[$i]['NombresBau']." ".$arr[$i]['ApellidosBau'],30)."</th>";
					$line.="<th><center>".CompletaCaracteres($arr[$i]['RepreFull'],30)."</center></th>";
					$line.="<th>".substr($arr[$i]['FechaBautizo'],0,10)."</th>";
					$line.="<th>
					<form name=\"fr_matriLike".$i."\" id=\"fr_matriLike".$i."\" action=\"".$_SERVER['HTTP_REFERER']."\" method=\"post\">
						<input type=\"hidden\" name=\"RefInfante\" id=\"RefInfante\" value=\"".$arr[$i]['ReferenciaInfante']."\">
						<button type=\"button\" style=\"display:block; margin:0 auto; padding:3px;\" onclick=\"fpSelectLike('fr_matriLike".$i."');\" class=\"btn btn-primary\" name=\"b_Nuevo\"><span class=\"fa fa-check\"></span></button>
						</form></th>";
				$line.="</tr>";
			}
			print $cabecera.$line;
		break;
		
		case "buscarPadre":
			if($lsHacer=="buscarPadre")
			{
					$lsCIyNaci=$loFuncion->DameCIyNaci($_POST["auxiliarPadre"]);
					$lsNacio=$lsCIyNaci["0"];
					$lscedu=$lsCIyNaci["1"];
					$loPersona->asNacionalidad=$lsNacio;
					$loPersona->asCedula=$lscedu;
					$lbEncPersonas=$loPersona->fbBuscarPorCedula();

					if($lbEncPersonas)
					{	
						$liHay=1;

						$RegistroPadres["lsNacio"]=$loPersona->asNacionalidad;								
						$RegistroPadres["lscedu"]=$loPersona->asCedula;
						$RegistroPadres["lsEstado"]=$loPersona->asEstadoN;
						$RegistroPadres["lsCiudad"]=$loPersona->asCiudadN;
						$RegistroPadres["lsMunicipio"]=$loPersona->asMunicipioN;
						$RegistroPadres["lsParroquia"]=$loPersona->asParroquiaN;
						$RegistroPadres["lsSexo"]=$loPersona->asSexo;
						$RegistroPadres["lsNomb"]=$loPersona->asNombre;
						$RegistroPadres["lsApel"]=$loPersona->asApellido;
						$RegistroPadres["lsPadre"]=$loPersona->asNombrePadre;
						$RegistroPadres["lsMadre"]=$loPersona->asNombreMadre;
						$RegistroPadres["lsCeduPadre"]=$loPersona->asCedulaPadre;
						$RegistroPadres["lsCeduMadre"]=$loPersona->asCedulaMadre;
						$RegistroPadres["lsEstatus"]=$loPersona->asEstatus;
					}
					else
					{
						$liHay=2;			
					}
			}
		break;


		case "buscarPadri":
			if($lsHacer=="buscarPadri")
			{
					$lsCIyNaci=$loFuncion->DameCIyNaci($_POST["auxiliarPadrino"]);
					$lsNacio=$lsCIyNaci["0"];
					$lscedu=$lsCIyNaci["1"];
					$loPersona->asNacionalidad=$lsNacio;
					$loPersona->asCedula=$lscedu;
					$lbEncPersonas=$loPersona->fbBuscarPorCedula();

					if($lbEncPersonas)
					{	
						$liHay=1;

						$RegistroPadrino["lsNacio"]=$loPersona->asNacionalidad;								
						$RegistroPadrino["lscedu"]=$loPersona->asCedula;
						$RegistroPadrino["lsEstado"]=$loPersona->asEstadoN;
						$RegistroPadrino["lsCiudad"]=$loPersona->asCiudadN;
						$RegistroPadrino["lsMunicipio"]=$loPersona->asMunicipioN;
						$RegistroPadrino["lsParroquia"]=$loPersona->asParroquiaN;
						$RegistroPadrino["lsSexo"]=$loPersona->asSexo;
						$RegistroPadrino["lsNomb"]=$loPersona->asNombre;
						$RegistroPadrino["lsApel"]=$loPersona->asApellido;
						$RegistroPadrino["lsPadre"]=$loPersona->asNombrePadre;
						$RegistroPadrino["lsMadre"]=$loPersona->asNombreMadre;
						$RegistroPadrino["lsCeduPadre"]=$loPersona->asCedulaPadre;
						$RegistroPadrino["lsCeduMadre"]=$loPersona->asCedulaMadre;
						$RegistroPadrino["lsEstatus"]=$loPersona->asEstatus;
					}
					else
					{
						$liHay=2;			
					}
			}
			break;

		case "modificar":
			fpPasar_Campos($loBautismo,$loFuncion);
			$lbHecho=$loBautismo->fbModificar();
			if($lbHecho)
			{
				$liHay=1;
			}
			else
			{
				$liHay=2;
			}
			break;
		case "activar":
			$lbHecho=$loBautismo->fbActivar("1");
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
			$lbHecho=$loBautismo->fbActivar("0");
			if($lbHecho)
			{
				$liHay=1;
			}
			else
			{
				$liHay=2;
			}
			break;
		case "DesactivaPadri":

					fpPasar_Campos($loBautismo,$loFuncion);
					$loBautismo->fpceduPadri($_POST["CIpadriAlter"]);
					$lbHecho=$loMatrimo->fbActivarPadri("0");
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
	if (($_GET["AccionGet"]=="")&&($_POST["txtOperacion"]!=""))
	{
	
		header('Content-type: text/javascript');
		$json = array( "lsFechaInscri" => $lsFechaInscri, "lsFechaBautizo" => substr($lsFechaBautizo,0,10), "lsHoraBautizo" => substr($lsFechaBautizo,11,18), "lsReferenciaInfante" => $lsReferenciaInfante, "lsNombresBau"=> $lsNombresBau, "lsApellidosBau" => $lsApellidosBau, "lsSexoBau" => $lsSexoBau, "lsFechaNacimiento"=> $lsFechaNacimiento, "lsBautizado" => $lsBautizado, "lsDireccion" => $lsDireccion, "lsEstado" => $lsEstado, "lsCiudad" => $lsCiudad, "lsMunicipio" => $lsMunicipio, "lsParroquia" => $lsParroquia, "lsCeduRepre"=> $lsCeduRepre, "lsIDParentesco" => $lsIDParentesco, "lsCeduMama" => $lsCeduMama, "lsCeduPapa" => $lsCeduPapa, "lsIDSacerdote"=> $lsIDSacerdote, "lsIDMinistro" => $lsIDMinistro, "lsNotaMarginal"=> $lsNotaMarginal, "lsPrefectuDe" => $lsPrefectuDe, "lsPresentadoEl" => $lsPresentadoEl, "lsNumPartidaNac" => $lsNumPartidaNac, "lsLibro_registro" => $lsLibro_registro, "lsFolio_registro" => $lsFolio_registro, "lsNumero_registro" => $lsNumero_registro, "lsEstatusBau" => $lsEstatusBau, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer" => $lsHacer);
		$envi = array("Bauti"=>$json, "Repres" =>$Representantes, "Padri"=>$laMatrizPadri, "PersoPadri"=>$RegistroPadrino, "PersoPadres"=>$RegistroPadres);

		echo json_encode( $envi );
 	}
    function fpPasar_Campos($poBautismo,$poFuncion)
    {
    	$lsFila=$_POST["txtFila"];
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
		}



		$IdentiRepre=$poFuncion->DameCIyNaci($_POST["f_cedulaRepre"]);
		$lsNacioRepre=$IdentiRepre["0"];
		$lsCedulaRepre=$IdentiRepre["1"];
		$IdentiMama=$poFuncion->DameCIyNaci($_POST["f_cedulaMama"]);
		$lsNacioMama=$IdentiMama["0"];
		$lsCedulaMama=$IdentiMama["1"];
		$IdentiPapa=$poFuncion->DameCIyNaci($_POST["f_cedulaPapa"]);
		$lsNacioPapa=$IdentiPapa["0"];
		$lsCedulaPapa=$IdentiPapa["1"];


		$poBautismo->fpSetMatrizPadri($MatrizPadri);
		$poBautismo->asFilaPadri=$lsFila;
		$poBautismo->asFechaBautizo=$_POST["f_fechaBau"]." ".$_POST["f_horaBau"];
		$poBautismo->asReferenciaInfante=$_POST["f_refInfante"];
		$poBautismo->asNombresBau=$_POST["f_nombres"];
		$poBautismo->asApellidosBau=$_POST["f_apellidos"];
		$poBautismo->asSexoBau=$_POST["f_sexo"];
		$poBautismo->asFechaNacimiento=$_POST["f_fechaNac"];
		$poBautismo->asDireccion=$_POST["f_direccion"];
		$poBautismo->asIDestado=$_POST["cmb_Estado"];
		$poBautismo->asIDciudad=$_POST["cmb_Ciudad"];
		$poBautismo->asIDmunicipio=$_POST["cmb_Municipio"];
		$poBautismo->asIDparroquia=$_POST["cmb_Parroquia"];
		$poBautismo->asNacioRepre=$lsNacioRepre;
		$poBautismo->asCeduRepre=$lsCedulaRepre;
		$poBautismo->asIDParentesco=$_POST["cmb_parentesco"];
		$poBautismo->asNacioMama=$lsNacioMama;
		$poBautismo->asCeduMama=$lsCedulaMama;
		$poBautismo->asNacioPapa=$lsNacioPapa;
		$poBautismo->asCeduPapa=$lsCedulaPapa;
		$poBautismo->asNombRepre=$_POST["f_NombresRepre"];
		$poBautismo->asApellRepre=$_POST["f_ApellidosRepre"];
		$poBautismo->asSexoRepre=$_POST["f_SexoRepre"];
		$poBautismo->asNombMama=$_POST["f_NombresMama"];
		$poBautismo->asApellMama=$_POST["f_ApellidosMama"];
		$poBautismo->asNombPapa=$_POST["f_NombresPapa"];
		$poBautismo->asApellPapa=$_POST["f_ApellidosPapa"];
		$poBautismo->asIDSacerdote=$_POST["cmb_presbitero"];
		$poBautismo->asIDMinistro=$_POST["cmb_ministro"];
		$poBautismo->asNotaMarginal=$_POST["f_notaMarginal"];
		$poBautismo->asPrefectuDe=$_POST["f_PartiPrefectura"];
		$poBautismo->asPresentadoEl=$_POST["f_PartiPresentado"];
		$poBautismo->asNumPartidaNac=$_POST["f_PartiNumero"];
		$poBautismo->asLibro_registro=$_POST["f_libro"];
		$poBautismo->asFolio_registro=$_POST["f_Folio"];
		$poBautismo->asNumero_registro=$_POST["f_Numero"];
}


	function CompletaCaracteres($cadena,$cantidad)
	{
		
		if (strlen($cadena)>$cantidad)
		{
			$cadena=substr($cadena,0,$cantidad);
		}
		
		return $cadena;
	}

?>
