<?php
	session_start();
   	require_once("../clases/clsFuncionesGlobales.php");
   	require_once("../clases/claApostolado.php");
	$loFuncion =new clsFunciones();
	$loApostolado=new claApostolado();

	$asidApostolado=$_POST["txtIdApostolado"];
	$asNombre=$_POST["f_nombre"];
	$lsOperacion=$_POST["txtOperacion"];
	$lsHacer=$_POST["txtHacer"];
	$liHay=$_POST["txtHay"];

	$loApostolado->asidApostolado=$asidApostolado;
	$loApostolado->asNombre=$asNombre;

		if (empty($lsOperacion))
		{
			$lsOperacion=$_GET["AccionGet"];
			$asidApostolado=$_GET["IdClave"];
		}

		
	switch($lsOperacion)
   	{
		case "buscar":
			$lbEnc=$loApostolado->fbBuscar();
			if($lbEnc)
			{
				$liHay=1;			
				$lsidApostolado=$loApostolado->asidApostolado;
				$lsNombre=$loApostolado->asNombre;
				$lsMision=$loApostolado->asMision;
				$lsVision=$loApostolado->asVision;
				$lsFechaRegistro=$loApostolado->asFechaRegistro;
				$lsEstatus=$loApostolado->asEstatusApostolado;
				$lscantFeligreses=$loApostolado->ascantFeligreses;
			}
			else
			{
				$liHay=0;
			}
			break;


		case "buscar_like":
			$cadena = strtoupper($_REQUEST['txtcadena']);
			$arr = $loApostolado->buscarLike("proximo",$cadena);
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
				$line.='<tr class="'.$colorArr[$arr[$i]['EstatusApostolado']].'" title="'.$titleArr[$arr[$i]['EstatusApostolado']].'">';
					$line.='<td>'.$arr[$i]['codigoGrupo'].'</td>';
					$line.='<td>'.$arr[$i]['nombre'].'</td>';
					$line.='<td>'.$arr[$i]['mision'].'</td>';
					$line.='<td>'.$arr[$i]['vision'].'</td>';
					$line.='<td>'.$loFuncion->fDameFechaEscrita($arr[$i]['SoloFechaRegistro']).'</td>';
					$line.='<td>'.$arr[$i]['cantFeligreses'].'</td>';
					$line.='<td>
					<form name="fr_matriLike'.$i.'" id="fr_matriLike'.$i.'" action="'.$_SERVER['HTTP_REFERER'].'" method="post">
					<input type="hidden" name="nvaidApostolado" id="nvaidApostolado" value="'.$arr[$i]['codigoGrupo'].'">
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
				$lbEnc=$loApostolado->fbBuscarNombre();
				if ($lbEnc)
				{
					$liHay=1;
					$lsidApostolado=$loApostolado->asidApostolado;
					$lsNombre=$loApostolado->asNombre;
					$lsMision=$loApostolado->asMision;
					$lsVision=$loApostolado->asVision;
					$lsFechaRegistro=$loApostolado->asFechaRegistro;
					$lsEstatus=$loApostolado->asEstatusApostolado;
					$lscantFeligreses=$loApostolado->ascantFeligreses;
					
				}
				else
				{
					$liHay=0;
				
				}
			}
			if($lsHacer=="incluir")
			{
				fpPasar_Campos($loApostolado);
				$lbHecho=$loApostolado->fbIncluir();
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
			fpPasar_Campos($loApostolado);
			$lbHecho=$loApostolado->fbModificar();
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
			$lbHecho=$loApostolado->fbActivar($_POST["KestadoActual"]);
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
			$lbHecho=$loApostolado->fbActivar($_POST["KestadoActual"]);
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
		
		$json = array( "lsidApostolado" => $lsidApostolado, "lsNombre" => $lsNombre, "lsMision" => $lsMision, "lsVision" => $lsVision, "lsFechaRegistro" => $lsFechaRegistro, "lsEstatus" => $lsEstatus, "lscantFeligreses"=> $lscantFeligreses, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer"=> $lsHacer);
		
		$envi = array("ArrDatos"=>$json);

		echo json_encode( $envi );
	}	
   
    function fpPasar_Campos($poApostolado)
    {
		
		$lsidApostolado=$_POST["txtIdApostolado"];
		$lsNombre=$_POST["f_nombre"];
		$lsMision=$_POST["f_mision"];
		$lsVision=$_POST["f_vision"];

		$poApostolado->asidApostolado=$lsidApostolado;
		$poApostolado->asNombre=$lsNombre;
		$poApostolado->asMision=$lsMision;
		$poApostolado->asVision=$lsVision;
	}
?>
