<?php 
include("../clases/claAgendaDiocesana.php");
session_start();
if(array_key_exists('txtOperacion',$_POST))
{
	$laForm=$_POST;
	$lobj_Tip= new claAgendaDiocesana();
	$lobj_Tip->f_SetsForm($laForm);
}

if($_POST['txtOperacion']=="incluir")
{

	$lb_Hecho=false;
	$lb_Hecho=$lobj_Tip->fpIncluirActividad('1');
	$lsArrayRet=$lobj_Tip->f_GetsForm();
	if ($lb_Hecho)
	{
		$liHay=1;
	}
	else
	{
		$liHay=0;
	}
}
if($laForm['txtOperacion']=="modificar")
{
	$lb_Hecho=false;
	$lb_Hecho=$lobj_Tip->fpModificarActividad('1');
	$lsArrayRet=$lobj_Tip->f_GetsForm();
	if ($lb_Hecho)
	{
		$liHay=1;
	}
	else
	{
		$liHay=0;
	}
}
if($laForm['txtOperacion']=="ActualizaEstado")
{
	$lb_Hecho=false;
	$lb_Hecho=$lobj_Tip->fpDesactivar($laForm['EstatusAgenda']);
	$lsArrayRet=$lobj_Tip->f_GetsForm();
	if ($lb_Hecho)
	{
		$liHay=1;
	}
	else
	{
		$liHay=0;
	}

}

		$RetornAnno=date("Y", strtotime($lsArrayRet['Fecha_Ini']));
		$RetornMes=date("m", strtotime($lsArrayRet['Fecha_Ini']));
		
		header('Content-type: text/javascript');
		$json = array( "lsEstatus" => $lsEstatus, "lsAnnoReg" => $RetornAnno, "lsMesReg" => $RetornMes, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "lsHacer" => $lsHacer);
		$arrayFinal=array_merge($json,$lsArrayRet);
		
		$envi = array("Agenda"=>$arrayFinal);

		echo json_encode( $envi );

?>