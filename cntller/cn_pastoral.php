<?php
	session_start();
   	require_once("../clases/clsFuncionesGlobales.php");
   	require_once("../clases/claPastoral.php");
	$loFuncion =new clsFunciones();
	$loPastoral=new claPastoral();

	$asidPastoral=$_POST["txtIdPastoral"];
	$asNombre=$_POST["f_nombre"];
	$lsOperacion=$_POST["txtOperacion"];
	$lsHacer=$_POST["txtHacer"];
	$liHay=$_POST["txtHay"];

	$loPastoral->asidPastoral=$asidPastoral;
	$loPastoral->asNombre=$asNombre;

		if (empty($lsOperacion))
		{
			$lsOperacion=$_GET["AccionGet"];
			$asidPastoral=$_GET["IdClave"];
		}

		
	switch($lsOperacion)
   	{
		case "buscar":
			$lbEnc=$loPastoral->fbBuscar();
			if($lbEnc)
			{
				$liHay=1;			
				$lsidPastoral=$loPastoral->asidPastoral;
				$lsNombre=$loPastoral->asNombre;
				$lsMision=$loPastoral->asMision;
				$lsVision=$loPastoral->asVision;
				$lsFechaRegistro=$loPastoral->asFechaRegistro;
				$lsEstatus=$loPastoral->asEstatusPastoral;
				$lscantFeligreses=$loPastoral->ascantFeligreses;
			}
			else
			{
				$liHay=0;
			}
			break;


		case "buscar_like":
			$cadena = strtoupper($_REQUEST['txtcadena']);
			$arr = $loPastoral->buscarLike("proximo",$cadena);
			$colorArr=array(0 => 'warning',1 => 'success'); //COLOR DE LA FILA
			$titleArr=array(0 => 'Registro Desactivado',1 => ''); //TOOL TIP TEXT DE LA FILA
			$cabecera = '<tr>
							<td>Codigo</td>
							<td>Nombre</td>
							<td>Mision</td>
							<td>Vision</td>
							<td>Registrado el</td>
							<td>Cantidad de Feligreses</td>
							<td>-</td>
						</tr>';
			for($i=0;$i<count($arr);$i++){
				$line.='<tr class="'.$colorArr[$arr[$i]['EstatusPastoral']].'" title="'.$titleArr[$arr[$i]['EstatusPastoral']].'">';
					$line.='<td>'.$arr[$i]['codigoPastoral'].'</td>';
					$line.='<td>'.$arr[$i]['nombre'].'</td>';
					$line.='<td>'.$arr[$i]['mision'].'</td>';
					$line.='<td>'.$arr[$i]['vision'].'</td>';
					$line.='<td>'.$loFuncion->fDameFechaEscrita($arr[$i]['SoloFechaRegistro']).'</td>';
					$line.='<td>'.$arr[$i]['cantFeligreses'].'</td>';
					$line.='<td>
					<form name="fr_matriLike'.$i.'" id="fr_matriLike'.$i.'" action="'.$_SERVER['HTTP_REFERER'].'" method="post">
					<input type="hidden" name="nvaidPastoral" id="nvaidPastoral" value="'.$arr[$i]['codigoPastoral'].'">
					<input type="hidden" name="nvaNombre" id="nvaNombre" value="'.$arr[$i]['nombre'].'">
					<button type="button" style="display:block; margin:0 auto; padding:3px;" onclick="fpSelectLike(\'fr_matriLike'.$i.'\');" class="btn btn-primary" name="b_Nuevo">
					<span class="fa fa-check"></span></button>
					</form></td>';


				$line.="</tr>";
			}
			print $cabecera.$line;
		break;

		case "incluir":

			if($lsHacer=="buscar")
			{
				$lbEnc=$loPastoral->fbBuscarNombre();
				if ($lbEnc)
				{
					$liHay=1;
					$lsidPastoral=$loPastoral->asidPastoral;
					$lsNombre=$loPastoral->asNombre;
					$lsMision=$loPastoral->asMision;
					$lsVision=$loPastoral->asVision;
					$lsFechaRegistro=$loPastoral->asFechaRegistro;
					$lsEstatus=$loPastoral->asEstatusPastoral;
					$lscantFeligreses=$loPastoral->ascantFeligreses;
					
				}
				else
				{
					$liHay=0;
				
				}
			}
			if($lsHacer=="incluir")
			{
				fpPasar_Campos($loPastoral);
				$lbHecho=$loPastoral->fbIncluir();
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
			fpPasar_Campos($loPastoral);
			$lbHecho=$loPastoral->fbModificar();
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
			$lbHecho=$loPastoral->fbActivar($_POST["KestadoActual"]);
			if($lbHecho)
			{
				$liHay=1;
			}
			else
			{
				$liHay=0;
			}
			break;

		case "desactivar":
			$lbHecho=$loPastoral->fbActivar($_POST["KestadoActual"]);
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
    	
	if (empty($_GET["AccionGet"])&&(!empty($_POST["txtOperacion"])))
	{
		header('Content-type: text/javascript');
		
		$json = array( "lsidPastoral" => $lsidPastoral, "lsNombre" => $lsNombre, "lsMision" => $lsMision, "lsVision" => $lsVision, "lsFechaRegistro" => $lsFechaRegistro, "lsEstatus" => $lsEstatus, "lscantFeligreses"=> $lscantFeligreses, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer"=> $lsHacer);
		
		$envi = array("ArrDatos"=>$json);

		echo json_encode( $envi );
	}	
   
    function fpPasar_Campos($poPastoral)
    {
		
		$lsidPastoral=$_POST["txtIdPastoral"];
		$lsNombre=$_POST["f_nombre"];
		$lsMision=$_POST["f_mision"];
		$lsVision=$_POST["f_vision"];

		$poPastoral->asidPastoral=$lsidPastoral;
		$poPastoral->asNombre=$lsNombre;
		$poPastoral->asMision=$lsMision;
		$poPastoral->asVision=$lsVision;
	}
?>
