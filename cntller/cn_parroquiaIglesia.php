<?php
	session_start();
   	require_once("../clases/clsFuncionesGlobales.php");
   	require_once("../clases/claParroquiaIglesia.php");
	$loFuncion =new clsFunciones();
	$loParroquia=new claParroquiaIglesia();

	$lsidParroquia=$_POST["txtidParroquia"];
	$lsNombre=$_POST["f_nombre"];
	$lsOperacion=$_POST["txtOperacion"];
	$lsHacer=$_POST["txtHacer"];
	$liHay=$_POST["txtHay"];

	$loParroquia->asidParroquiaIglesia=$lsidParroquia;
	$loParroquia->asNombre=$lsNombre;

		if (empty($lsOperacion))
		{
			$lsOperacion=$_GET["AccionGet"];
			$lsidParroquia=$_GET["IdClave"];
		}

		
	switch($lsOperacion)
   	{
		case "buscar":
			$lbEnc=$loParroquia->fbBuscar();
			if($lbEnc)
			{
				$liHay=1;			
				$lsidParroquiaIglesia=$loParroquia->asidParroquiaIglesia;
				$lsNombre=$loParroquia->asNombre;
				$lsMision=$loParroquia->asMision;
				$lsVision=$loParroquia->asVision;
				$lsDireccion=$loParroquia->asDireccion;
				$lsTelefono=$loParroquia->asTelefono;
				$lsCorreo=$loParroquia->asCorreo;
				$lsidFestado=$loParroquia->idFestado;
				$lsidFciudad=$loParroquia->idFciudad;
				$lsidFmunicipio=$loParroquia->idFmunicipio;
				$lsidFparroquia=$loParroquia->idFparroquia;
				$lsFecha_creacion=$loParroquia->asFecha_creacion;
				$lsCodigo_archi=$loParroquia->asCodigo_archi;
				$lsNombreArchi=$loParroquia->asNombreArchi;
				$lsEstatus=$loParroquia->asEstatus;
			}
			else
			{
				$liHay=0;
			}
			break;


		case "buscar_like":
			$cadena = strtoupper($_REQUEST['txtcadena']);
			$arr = $loParroquia->buscarLike("proximo",$cadena);
			$colorArr=array(0 => 'warning',1 => 'success'); //COLOR DE LA FILA
			$titleArr=array(0 => 'Registro Desactivado',1 => ''); //TOOL TIP TEXT DE LA FILA
			$cabecera = '<tr>
							<td>Codigo</td>
							<td>Nombre</td>
							<td>Telefono</td>
							<td>Correo</td>
							<td>Direccion</td>
							<td>Archiprestasgo</td>
							<td>Fecha de Creacion</td>
							<td>-</td>
						</tr>';
			for($i=0;$i<count($arr);$i++){
				$line.='<tr class="'.$colorArr[$arr[$i]['Estatus']].'" title="'.$titleArr[$arr[$i]['Estatus']].'">';
					$line.='<td>'.$arr[$i]['codigoParroquiaIglesia'].'</td>';
					$line.='<td>'.$arr[$i]['nombre'].'</td>';
					$line.='<td>'.$arr[$i]['telefono'].'</td>';
					$line.='<td>'.$arr[$i]['correo'].'</td>';
					$line.='<td>'.$arr[$i]['direccion'].'</td>';
					$line.='<td>'.$arr[$i]['nombreArchi'].'</td>';
					$line.='<td>'.$loFuncion->fDameFechaEscrita($arr[$i]['fecha_creacion']).'</td>';
					$line.='<td>
					<form name="fr_matriLike'.$i.'" id="fr_matriLike'.$i.'" action="'.$_SERVER['HTTP_REFERER'].'" method="post">
					<input type="hidden" name="nvaidParroquia" id="nvaidParroquia" value="'.$arr[$i]['codigoParroquiaIglesia'].'">
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
				$lbEnc=$loParroquia->fbBuscarNombre();
				if ($lbEnc)
				{
					$liHay=1;
					$lsidParroquiaIglesia=$loParroquia->asidParroquiaIglesia;
					$lsNombre=$loParroquia->asNombre;
					$lsMision=$loParroquia->asMision;
					$lsVision=$loParroquia->asVision;
					$lsDireccion=$loParroquia->asDireccion;
					$lsTelefono=$loParroquia->asTelefono;
					$lsCorreo=$loParroquia->asCorreo;
					$lsidFestado=$loParroquia->idFestado;
					$lsidFciudad=$loParroquia->idFciudad;
					$lsidFmunicipio=$loParroquia->idFmunicipio;
					$lsidFparroquia=$loParroquia->idFparroquia;
					$lsFecha_creacion=$loParroquia->asFecha_creacion;
					$lsCodigo_archi=$loParroquia->asCodigo_archi;
					$lsNombreArchi=$loParroquia->asNombreArchi;
					$lsEstatus=$loParroquia->asEstatus;
					
				}
				else
				{
					$liHay=0;
				
				}
			}
			if($lsHacer=="incluir")
			{
				fpPasar_Campos($loParroquia);
				$lbHecho=$loParroquia->fbIncluir();
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
			fpPasar_Campos($loParroquia);
			$lbHecho=$loParroquia->fbModificar();
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
			$lbHecho=$loParroquia->fbActivar($_POST["KestadoActual"]);
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
			$lbHecho=$loParroquia->fbActivar($_POST["KestadoActual"]);
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
		
		$json = array( "lsidParroquiaIglesia" => $lsidParroquiaIglesia, "lsNombre" => $lsNombre, "lsMision" => $lsMision, "lsVision" => $lsVision, "lsDireccion" => $lsDireccion, "lsTelefono" => $lsTelefono, "lsCorreo" => $lsCorreo, "lsidFestado" => $lsidFestado, "lsidFciudad" => $lsidFciudad, "lsidFmunicipio" => $lsidFmunicipio, "lsidFparroquia" => $lsidFparroquia, "lsFecha_creacion" => $lsFecha_creacion, "lsCodigo_archi"=> $lsCodigo_archi, "lsNombreArchi"=> $lsNombreArchi, "lsEstatus"=> $lsEstatus, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer"=> $lsHacer);
		
		$envi = array("ArrDatos"=>$json);

		echo json_encode( $envi );
	}	
   
    function fpPasar_Campos($poParroquia)
    {
		
		$lsidParroquiaIglesia=$_POST["txtidParroquia"];
		$lsNombre=$_POST["f_nombre"];
		$lsMision=$_POST["f_mision"];
		$lsVision=$_POST["f_vision"];
		$lsDireccion=$_POST["f_direccion"];
		$lsTelefono=$_POST["f_telefono"];
		$lsCorreo=$_POST["txtCorreo"];
		$lsidFestado=$_POST["cmb_Estado"];
		$lsidFciudad=$_POST["cmb_Ciudad"];
		$lsidFmunicipio=$_POST["cmb_Municipio"];
		$lsidFparroquia=$_POST["cmb_Parroquia"];
		$lsCodigo_archi=$_POST["cmb_Archiprestasgo"];
		$lsFecha_creacion=$_POST["f_fechaCreacion"];

		$poParroquia->asidParroquiaIglesia=$lsidParroquiaIglesia;
		$poParroquia->asNombre=$lsNombre;
		$poParroquia->asMision=$lsMision;
		$poParroquia->asVision=$lsVision;
		$poParroquia->asDireccion=$lsDireccion;
		$poParroquia->asTelefono=$lsTelefono;
		$poParroquia->asCorreo=$lsCorreo;
		$poParroquia->asidFestado=$lsidFestado;
		$poParroquia->asidFciudad=$lsidFciudad;
		$poParroquia->asidFmunicipio=$lsidFmunicipio;
		$poParroquia->asidFparroquia=$lsidFparroquia;
		$poParroquia->asFecha_creacion=$lsFecha_creacion;
		$poParroquia->asCodigo_archi=$lsCodigo_archi;

	}
?>
