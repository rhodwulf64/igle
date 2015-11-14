<?php
	session_start();
   	require_once("../clases/clsFuncionesGlobales.php");
   	require_once("../clases/claCapilla.php");
	$loFuncion =new clsFunciones();
	$loCapilla=new claCapilla();

	$lsidCapilla=$_POST["txtidCapilla"];
	$lsNombre=$_POST["f_nombre"];
	$lsOperacion=$_POST["txtOperacion"];
	$lsHacer=$_POST["txtHacer"];
	$liHay=$_POST["txtHay"];

	$loCapilla->asidCapilla=$lsidCapilla;
	$loCapilla->asNombre=$lsNombre;

		if (empty($lsOperacion))
		{
			$lsOperacion=$_GET["AccionGet"];
			$lsidCapilla=$_GET["IdClave"];
		}

	
	switch($lsOperacion)
   	{
		case "buscar":
			$lbEnc=$loCapilla->fbBuscar();
			if($lbEnc)
			{
				$liHay=1;			
				$lsidCapilla=$loCapilla->asidCapilla;
				$lsNombre=$loCapilla->asNombre;
				$lsDireccion=$loCapilla->asDireccion;
				$lsTelefono=$loCapilla->asTelefono;
				$lsCorreo=$loCapilla->asCorreo;
				$lsidFestado=$loCapilla->idFestado;
				$lsidFciudad=$loCapilla->idFciudad;
				$lsidFmunicipio=$loCapilla->idFmunicipio;
				$lsidFparroquia=$loCapilla->idFparroquia;
				$lsFecha_creacion=$loCapilla->asFecha_creacion;
				$lsCodigo_ParroquiaIgle=$loCapilla->asCodigo_ParroIgle;
				$lsNombreParroIgle=$loCapilla->asNombre_ParroIgle;
				$lsEstatus=$loCapilla->asEstatus;
			}
			else
			{
				$liHay=0;
			}
			break;


		case "buscar_like":
			$cadena = strtoupper($_REQUEST['txtcadena']);
			$arr = $loCapilla->buscarLike("proximo",$cadena);
			$colorArr=array(0 => 'warning',1 => 'success'); //COLOR DE LA FILA
			$titleArr=array(0 => 'Registro Desactivado',1 => ''); //TOOL TIP TEXT DE LA FILA
			$cabecera = '<tr>
							<td>Codigo</td>
							<td>Nombre</td>
							<td>Telefono</td>
							<td>Correo</td>
							<td>Direccion</td>
							<td>Parroquia Iglesia</td>
							<td>Fecha de Creacion</td>
							<td>-</td>
						</tr>';
			for($i=0;$i<count($arr);$i++){
				$line.='<tr class="'.$colorArr[$arr[$i]['Estatus']].'" title="'.$titleArr[$arr[$i]['Estatus']].'">';
					$line.='<td>'.$arr[$i]['codigoCapilla'].'</td>';
					$line.='<td>'.$arr[$i]['nombre'].'</td>';
					$line.='<td>'.$arr[$i]['telefono'].'</td>';
					$line.='<td>'.$arr[$i]['correo'].'</td>';
					$line.='<td>'.$arr[$i]['direccion'].'</td>';
					$line.='<td>'.$arr[$i]['nombreParroIgle'].'</td>';
					$line.='<td>'.$loFuncion->fDameFechaEscrita($arr[$i]['fecha_creacion']).'</td>';
					$line.='<td>
					<form name="fr_matriLike'.$i.'" id="fr_matriLike'.$i.'" action="'.$_SERVER['HTTP_REFERER'].'" method="post">
					<input type="hidden" name="nvaidCapilla" id="nvaidCapilla" value="'.$arr[$i]['codigoCapilla'].'">
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
				$lbEnc=$loCapilla->fbBuscarNombre();
				if ($lbEnc)
				{
					$liHay=1;
					$lsidCapilla=$loCapilla->asidCapilla;
					$lsNombre=$loCapilla->asNombre;
					$lsDireccion=$loCapilla->asDireccion;
					$lsTelefono=$loCapilla->asTelefono;
					$lsCorreo=$loCapilla->asCorreo;
					$lsidFestado=$loCapilla->idFestado;
					$lsidFciudad=$loCapilla->idFciudad;
					$lsidFmunicipio=$loCapilla->idFmunicipio;
					$lsidFparroquia=$loCapilla->idFparroquia;
					$lsFecha_creacion=$loCapilla->asFecha_creacion;
					$lsCodigo_ParroquiaIgle=$loCapilla->asCodigo_ParroIgle;
					$lsNombreParroIgle=$loCapilla->asNombre_ParroIgle;
					$lsEstatus=$loCapilla->asEstatus;
					
				}
				else
				{
					$liHay=0;
				
				}
			}
			if($lsHacer=="incluir")
			{
				fpPasar_Campos($loCapilla);
				$lbHecho=$loCapilla->fbIncluir();
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
			fpPasar_Campos($loCapilla);
			$lbHecho=$loCapilla->fbModificar();
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
			$lbHecho=$loCapilla->fbActivar($_POST["KestadoActual"]);
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
			$lbHecho=$loCapilla->fbActivar($_POST["KestadoActual"]);
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
		
		$json = array( "lsidCapilla" => $lsidCapilla, "lsNombre" => $lsNombre, "lsDireccion" => $lsDireccion, "lsTelefono" => $lsTelefono, "lsCorreo" => $lsCorreo, "lsidFestado" => $lsidFestado, "lsidFciudad" => $lsidFciudad, "lsidFmunicipio" => $lsidFmunicipio, "lsidFparroquia" => $lsidFparroquia, "lsFecha_creacion" => $lsFecha_creacion, "lsCodigo_ParroquiaIgle"=> $lsCodigo_ParroquiaIgle, "lsNombreParroIgle"=> $lsNombreParroIgle, "lsEstatus"=> $lsEstatus, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer"=> $lsHacer);
		
		$envi = array("ArrDatos"=>$json);

		echo json_encode( $envi );
	}	
   
    function fpPasar_Campos($poParroquia)
    {
		
		$lsidCapilla=$_POST["txtidCapilla"];
		$lsNombre=$_POST["f_nombre"];
		$lsDireccion=$_POST["f_direccion"];
		$lsTelefono=$_POST["f_telefono"];
		$lsCorreo=$_POST["txtCorreo"];
		$lsidFestado=$_POST["cmb_Estado"];
		$lsidFciudad=$_POST["cmb_Ciudad"];
		$lsidFmunicipio=$_POST["cmb_Municipio"];
		$lsidFparroquia=$_POST["cmb_Parroquia"];
		$lsCodigo_ParroquiaIgle=$_POST["cmb_ParroquiaIgle"];
		$lsFecha_creacion=$_POST["f_fechaCreacion"];

		$poParroquia->asidCapilla=$lsidCapilla;
		$poParroquia->asNombre=$lsNombre;
		$poParroquia->asDireccion=$lsDireccion;
		$poParroquia->asTelefono=$lsTelefono;
		$poParroquia->asCorreo=$lsCorreo;
		$poParroquia->asidFestado=$lsidFestado;
		$poParroquia->asidFciudad=$lsidFciudad;
		$poParroquia->asidFmunicipio=$lsidFmunicipio;
		$poParroquia->asidFparroquia=$lsidFparroquia;
		$poParroquia->asFecha_creacion=$lsFecha_creacion;
		$poParroquia->asCodigo_ParroIgle=$lsCodigo_ParroquiaIgle;

	}
?>
