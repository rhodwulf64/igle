<?php

  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
   	require_once("../clases/clsCombos.php");
   	require_once("../clases/clsFuncionesGlobales.php");
	$loCombos=new clsCombos();
	$loFuncion =new clsFunciones();

	$loCombos->asCod_Combo=$_POST["KcodCombo"];
	$loCombos->asForaneoID=$_POST["KcodForaneo"];
	$loCombos->asDescripCombo=$_POST["f_descripcion"];
	$loCombos->asSelector= "estado";


	$lsOperacion=$_POST["txtOperacion"];
	$liHay=$_POST["txtHay"];


	switch($lsOperacion)
   	{

   		case "incluir":

			if($loCombos->buscar())
			{
				$liHay = 0;
			}
			else
			{
				$liHay = 1;
				$loCombos->incluir();  
			}
			
			break;


		case "buscar":
			
			if($loCombos->buscar()){
				$lsCod_Combo=$loCombos->asCod_Combo;
				$lsCod_Foraneo=$loCombos->asForaneoID; 
				$lsDescripcion=$loCombos->asDescripCombo; 
				$liHay = 1;
			}
			else
			{
				$liHay = 0;
			}
			
			break;

		case "buscar2":
			
			if($loCombos->buscar2()){
				$lsCod_Combo=$loCombos->asCod_Combo;
				$lsCod_Foraneo=$loCombos->asForaneoID; 
				$lsDescripcion=$loCombos->asDescripCombo; 
				$liHay = 1;
			}
			else
			{
				$liHay = 0;
			}
		
			break;

		case "modificar":
	
			if($loCombos->modificar()>=1){
				$liHay = 1;
			}else{
				$liHay = 0;
			}
		
			break;
	
		case "eliminar":
	
			if($loCombos->eliminar()>=1){   
				$liHay = 1;	
			}else{
				$liHay = 0;
			}
		
			break;

				
    }    	 	


		header('Content-type: text/javascript');
		$json = array( "lsCod_Combo" => $lsCod_Combo, "lsCod_Foraneo" => $lsCod_Foraneo, "lsDescripcion" => $lsDescripcion, "lsOperacion" => $lsOperacion, "liHay" => $liHay);
		
		$envi = array("Confi"=>$json);

		echo json_encode( $envi );
		

?>






