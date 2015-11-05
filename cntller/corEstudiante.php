<?php
	/*
    *      corEstudiante.php
    *      
    *      Copyright 2014 José Silva <jobasiher@cantv.net>
    *      
    *      Este programa es software libre, puede redistribuirlo y / o modificar
    *      Bajo los términos de la GNU Licensia Pública General(GPL) publicada por
    *      La Fundación de Software Libre(FSF), bien de la versión 2 o cualquier versión posterior.
    *      
    *      Este programa se distribuye con la esperanza de que sea útil,
    *      Pero SIN NINGUNA GARANTÍA, incluso sin la garantía implícita de
    *      COMERCIALIZACIÓN o IDONEIDAD PARA UN PROPÓSITO PARTICULAR.
    */
   	require_once("../modelos/clsEstudiante.php");
	$loEstudiante=new clsEstudiante();
	$loEstudiante->fpSetCedula($_POST["txtCedula"]);
	$lsOperacion=$_POST["txtOperacion"];
	$lsHacer=$_POST["txtHacer"];
	$liHay=$_POST["txtHay"];
	switch($lsOperacion)
   	{
		case "buscar":
			$lbEnc=$loEstudiante->fbBuscar();
			if($lbEnc)
			{
				$liHay=1;
				$lsCedula=$loEstudiante->fsGetCedula();
				$lsNombre=$loEstudiante->fsGetNombre();
				$lsApellido=$loEstudiante->fsGetApellido();
				$lsFecha_Naci=$loEstudiante->fsGetFecha_Naci();
				$lsE_Civil=$loEstudiante->fsGetE_Civil();
				$lsSexo=$loEstudiante->fsGetSexo();
			}
			else
			{
				$liHay=0;
			}
			break;
		case "incluir":
			if($lsHacer=="buscar")
			{
				$lbEnc=$loEstudiante->fbBuscar();
				if($lbEnc)
				{
					$liHay=1;
					$lsCedula=$loEstudiante->fsGetCedula();
					$lsNombre=$loEstudiante->fsGetNombre();
					$lsApellido=$loEstudiante->fsGetApellido();
					$lsFecha_Naci=$loEstudiante->fsGetFecha_Naci();
					$lsE_Civil=$loEstudiante->fsGetE_Civil();
					$lsSexo=$loEstudiante->fsGetSexo();
				}
				else
				{
					$liHay=0;
					$lsCedula=$_POST["txtCedula"];
				}
			}
			if($lsHacer=="incluir")
			{
				fpPasar_Campos($loEstudiante);
				$lbHecho=$loEstudiante->fbIncluir();
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
			fpPasar_Campos($loEstudiante);
			$lbHecho=$loEstudiante->fbModificar();
			if($lbHecho)
			{
				$liHay=1;
			}
			else
			{
				$liHay=2;
			}
			break;
		case "eliminar":
			$lbHecho=$loEstudiante->fbEliminar();
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
    header("location: ../vistas/formularios/visEstudiante.php?lsCedula=$lsCedula&lsNombre=$lsNombre&lsApellido=$lsApellido&lsFecha_Naci=$lsFecha_Naci&lsE_Civil=$lsE_Civil&lsSexo=$lsSexo&lsOperacion=$lsOperacion&liHay=$liHay&lsHacer=$lsHacer");
   
    function fpPasar_Campos($poEstudiante)
    {
		$poEstudiante->fpSetNombre($_POST["txtNombre"]);
		$poEstudiante->fpSetApellido($_POST["txtApellido"]);
		$poEstudiante->fpSetE_Civil($_POST["cmbE_Civil"]);
		$poEstudiante->fpSetFecha_Naci($_POST["txtFecha_Naci"]);
		$poEstudiante->fpSetSexo($_POST["radSexo"]);
    }
?>
