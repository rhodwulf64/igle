<?php

  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}

   	require_once("../clases/claPastoralFeligres.php");
   	require_once("../clases/claPersonas.php");
   	require_once("../clases/clsFuncionesGlobales.php");
	$loPastoralFeligres=new claPastoralFeligres();
	$loPersonas =new claPersonas();
	$loFuncion =new clsFunciones();
	
	$loPastoralFeligres->ascodigo_pastoral=$_POST["cmb_Pastoral"];

	$lsFila=$_POST["txtFila"];
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
	
			$laMatrizFeligreses=$loPastoralFeligres->fbBuscarFeligreses();
			if(count($laMatrizFeligreses)>0)
			{
					$liHay=1;	
			}
			else
			{
					$liHay=0;
			}
		break;

		case "buscar_like":
			$cadena = strtoupper($_REQUEST['txtcadena']);
			$arr = $loPastoralFeligres->buscarLike("proximo",$cadena);
			$colorArr=array(0 => 'warning',1 => 'success'); //COLOR DE LA FILA
			$titleArr=array(0 => 'Registro Desactivado',1 => ''); //TOOL TIP TEXT DE LA FILA
			$cabecera = '<tr>
							<td>Codigo</td>
							<td>Pastoral</td>
							<td>Cantidad de Feligreses</td>
							<td>-</td>
						</tr>';
			for($i=0;$i<count($arr);$i++){
				$line.='<tr class="'.$colorArr[$arr[$i]['Estatus']].'" title="'.$titleArr[$arr[$i]['Estatus']].'">';
					$line.='<td>'.$arr[$i]['Detalle_Pastoralcol'].'</td>';
					$line.='<td>'.$arr[$i]['NombreGrupo'].'</td>';
					$line.='<td>'.$arr[$i]['cantFeligreses'].'</td>';
					$line.='<td>
					<form name="fr_PastoralLike'.$i.'" id="fr_PastoralLike'.$i.'" action="'.$_SERVER['HTTP_REFERER'].'" method="post">
					<input type="hidden" name="nvaidPastoral" id="nvaidPastoral" value="'.$arr[$i]['codigo_pastoral'].'">
					<input type="hidden" name="nvaidParroquiaIglesia" id="nvaidParroquiaIglesia" value="'.$arr[$i]['codigoParroquiaIglesia'].'">
					<button type="button" style="display:block; margin:0 auto; padding:3px;" onclick="fpSelectLike(\'fr_PastoralLike'.$i.'\');" class="btn btn-primary" name="b_Nuevo">
					<span class="fa fa-check"></span></button>
					</form></td>';


				$line.="</tr>";
			}
			print $cabecera.$line;
		break;

		case "buscarFeli":
			if($lsHacer=="buscarFeli")
			{
					$lsCIyNaci=$loFuncion->DameCIyNaci($_POST["auxiliarFeligres"]);
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
						$RegistroPadrino["lsTelefono"]=$loPersonas->asTelefono;
						$RegistroPadrino["lsCorreo"]=$loPersonas->asCorreo;
						$RegistroPadrino["lsParroquiaIglesia"]=$loPersonas->asIDIglesia;
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
				$laMatrizFeligreses=$loPastoralFeligres->fbBuscarFeligreses();
				if(count($laMatrizFeligreses)>0)
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
				$pasa=false;

				fpPasar_Campos($loPastoralFeligres,$loFuncion,$lsFila);
				$lbHecho=$loPastoralFeligres->fbModificarFeligresPastoral();
				if($lbHecho)
				{
					$liHay=1;
				}
				else
				{
					$liHay=0;
				}
					

			}
				
			

		break;

		case "modificar":

				$pasa=false;

				fpPasar_Campos($loPastoralFeligres,$loFuncion,$lsFila);
				$lbHecho=$loPastoralFeligres->fbModificarFeligresPastoral();
				if($lbHecho)
				{
					$liHay=1;
				}
				else
				{
					$liHay=0;
				}
					
			
		break;		


		case "reactivar":
			$lbHecho=$loPastoralFeligres->fbActivar("1");
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
			$lbHecho=$loPastoralFeligres->fbActivar("0");
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
			$lbHecho=$loPastoralFeligres->fbGestion(0,"",$lsMatriS);
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
			$lbHecho=$loPastoralFeligres->fbGestion(1,"",$lsMatriS);
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
			$lbHecho=$loPastoralFeligres->fbGestion(2,$_POST["f_motivo"],$lsMatriS);
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
			$lbHecho=$loPastoralFeligres->fbGestion(3,$_POST["f_motivo"],$lsMatriS);
			if($lbHecho=="1")
			{
				$liHay=1;
			}
			else
			{
				$liHay=0;
			}
			break;

		case "activarFeli":
			$loPastoralFeligres->asDetalle_Pastoralcol=$_POST["txtidRegistro"];
			$lbHecho=$loPastoralFeligres->fbActivar("1");
			if($lbHecho)
			{
				$liHay=1;
			}
			else
			{
				$liHay=0;
			}
			break;
		case "desactivarFeli":
			$loPastoralFeligres->asDetalle_Pastoralcol=$_POST["txtidRegistro"];
			$lbHecho=$loPastoralFeligres->fbActivar("0");
			if($lbHecho)
			{
				$liHay=1;
			}
			else
			{
				$liHay=0;
			}
			break;
				
    }    	 	

if (($_GET["AccionGet"]=="")&&($_POST["txtOperacion"]!=""))
{
		header('Content-type: text/javascript');
		$json = array( "lsDetalle_Grupocol" => $lsDetalle_Grupocol, "lscodigo_persona" => $lscodigo_persona, "lscodigo_grupo" => $lscodigo_grupo, "lsFechaRegistro" => $lsFechaRegistro, "lsidFparroquiaIglesia" => $lsidFparroquiaIglesia, "lsEstatus" => $lsEstatus, "lsFilaPadri" => $lsFilaPadri, "lsNombreGrupo" => $lsNombreGrupo, "lsMatrizFeligres" => $lsMatrizFeligres, "lsEstatus" => $lsEstatus, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer" => $lsHacer);
		
		$envi = array("PastoFeligres"=>$json,"Padres"=>$laMatrizPadres, "Feli"=>$laMatrizFeligreses, "FeliEncontrado"=>$RegistroPadrino);

		echo json_encode( $envi );
}		
    function fpPasar_Campos($poPastoralFeligres, $poFuncion, $lsFila)
    {
    	$poPastoralFeligres->asFilaFeli=$_POST["txtFila"];
    	$MatrizFeligreses=array(array());
		for($liI=1;$liI<=$lsFila;$liI++)
		{

			$lsCIyNaci=$poFuncion->DameCIyNaci($_POST["f_padCedula".$liI]);
			$lsNacioPad=$lsCIyNaci["0"];
			$lsCeduPad=$lsCIyNaci["1"];
			$MatrizFeligreses[$liI][1]=$lsNacioPad;
			$MatrizFeligreses[$liI][2]=$lsCeduPad;
			$MatrizFeligreses[$liI][3]=$_POST["f_padNombres".$liI];
			$MatrizFeligreses[$liI][4]=$_POST["f_padApellidos".$liI];
			$MatrizFeligreses[$liI][5]=$_POST["f_padSexo".$liI];
			$MatrizFeligreses[$liI][6]=$_POST["f_padTelefono".$liI];
			$MatrizFeligreses[$liI][7]=$_POST["f_padCorreo".$liI];
			$MatrizFeligreses[$liI][8]=""; //no utilizado
			$MatrizFeligreses[$liI][9]=""; //no utilizado
			$MatrizFeligreses[$liI][10]=""; //no utilizado
			$MatrizFeligreses[$liI][11]=""; //no utilizado
			$MatrizFeligreses[$liI][12]=$_POST["f_padParroquia".$liI];
			$MatrizFeligreses[$liI][13]=""; //no utilizado
		}
		$poPastoralFeligres->fpSetMatrizFeligres($MatrizFeligreses);


	}

	function fpMatriEstado($param,$i,$reF)
	{
		$result=array("<div class=\"alert alert-info\" onclick=\"accionEstados(this.id,'$reF')\" style=\"padding:0px;\" id=\"textoEstado$i\">Pendiente</div>",
			"<div class=\"alert alert-success\" onclick=\"accionEstados(this.id,'$reF')\" style=\"padding:0px;\" id=\"textoEstado$i\">Casados</div>",
			"<div class=\"alert alert-warning\" onclick=\"accionEstados(this.id,'$reF')\" style=\"padding:0px;\" id=\"textoEstado$i\">Suspendido</div>",
			"<div class=\"alert alert-danger\" onclick=\"accionEstados(this.id,'$reF')\" style=\"padding:0px;\" id=\"textoEstado$i\">Anulado</div>");
		return $result[$param];
	}
?>






