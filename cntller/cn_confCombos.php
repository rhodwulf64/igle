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
	$loCombos->asSelector= $_POST["KcharSelector"];
	$loCombos->asDescripCombo=$_POST["f_descripcion"];

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
				
				if ($loCombos->incluir())
				{  
					$liHay = 1;
					$lsEstatus=1;
				}
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

		case "busEstatus":
			
			if($loCombos->buscar2()){
				$lsCod_Combo=$loCombos->asCod_Combo;
				$lsCod_Foraneo=$loCombos->asForaneoID; 
				$lsDescripcion=$loCombos->asDescripCombo; 
				$lsEstatus=$loCombos->asEstatus; 
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
	
		case "desactivar":
	
			if($loCombos->desactivar()>=1){   
				$liHay = 1;	
				$lsEstatus=0;
			}else{
				$liHay = 0;
			}
		
			break;
		case "reactivar":
	
			if($loCombos->reactivar()>=1){   
				$liHay = 1;	
				$lsEstatus=1;
			}else{
				$liHay = 0;
			}
		
			break;

				
    }    	 	


		header('Content-type: text/javascript');
		$json = array( "lsCod_Combo" => $lsCod_Combo, "lsCod_Foraneo" => $lsCod_Foraneo, "lsDescripcion" => $lsDescripcion, "lsEstatus" => $lsEstatus, "lsOperacion" => $lsOperacion, "liHay" => $liHay);
		
		$envi = array("Confi"=>$json);

		echo json_encode( $envi );
		

?>






