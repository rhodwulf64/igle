<?php

  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
   	require_once("../clases/claAgendaCitas.php");
   	require_once("../clases/clsFuncionesGlobales.php");
	$loCita=new claAgendaCitas();
	$loFuncion =new clsFunciones();

	$fechaHoy=date("Y-m-j");
	$diasArestar=10; //OJO cambiar aqui si quieres modificar los dias que debe esperar un feligres para pedir la misma cita
	$maximoCitasPorDia=5;
	$loCita->asCod_Combo=$_POST["KcodCombo"];
	$loCita->asForaneoID=$_POST["KcodForaneo"];
	$loCita->asSelector= $_POST["KcharSelector"];
	$loCita->asDescripCombo=$_POST["f_descripcion"];
	$idCitas=$_POST["txtIdCita"];
	$loCita->asidtPersona=$_SESSION["IDTpersona"];
	$loCita->asOpcionSolicitud=$_POST["KopcionCita"];
	$fechaNDiasAtras=$loFuncion->fRestaDiasAfecha($fechaHoy,$diasArestar); //fecha actual menos los dias especificados en la variable

	$lsOperacion=$_POST["txtOperacion"];
	$liHay=$_POST["txtHay"];
	$liError=0;

	switch($lsOperacion)
   	{

   		case "solicitaCita":

			if($loCita->fpermiteCrearCita($fechaNDiasAtras))
			{
				$liHay = 0;
				$liError = $loCita->asErroNume; //aqui regresa el numero del error para que la vista lo proyecte
			}
			else
			{
				if ($loCita->fDameFechaDeCita($maximoCitasPorDia,$loFuncion))
				{

					$loCita->fDiasDeCitaDesactivados($maximoCitasPorDia,$loFuncion);//Enciende el modulo de verificacion de dias desactivados y en cuyo caso modifica la fecha y la hora

					if ($loCita->solicitarDiaCita())
					{  

						$liHay = 1;
					}
					else
					{
						$liHay = 0;
						$liError = $loCita->asErroNume;
					}
				}
			}
			
			break;


		case "buscar":
			
			if($loCita->buscar()){
				$lsCod_Combo=$loCita->asCod_Combo;
				$lsCod_Foraneo=$loCita->asForaneoID; 
				$lsDescripcion=$loCita->asDescripCombo; 
				$liHay = 1;
			}
			else
			{
				$liHay = 0;
			}
			
			break;

		case "busEstatus":
			
			if($loCita->buscar2()){
				$lsCod_Combo=$loCita->asCod_Combo;
				$lsCod_Foraneo=$loCita->asForaneoID; 
				$lsDescripcion=$loCita->asDescripCombo; 
				$lsEstatus=$loCita->asEstatus; 
				$liHay = 1;
			}
			else
			{
				$liHay = 0;
			}
			
			break;

		case "buscar2":
			
			if($loCita->buscar2()){
				$lsCod_Combo=$loCita->asCod_Combo;
				$lsCod_Foraneo=$loCita->asForaneoID; 
				$lsDescripcion=$loCita->asDescripCombo; 
				$liHay = 1;
			}
			else
			{
				$liHay = 0;
			}
		
			break;

		case "modificar":
	
			if($loCita->modificar()>=1){
				$liHay = 1;
			}else{
				$liHay = 0;
			}
		
			break;
	
		case "anularCita":
	
			if($loCita->fpAnularCitaFeligres($idCitas)){   
				$liHay = 1;	
			}
			else
			{
				$liHay = 0;
			}
		
			break;
		case "reactivar":
	
			if($loCita->reactivar()>=1){   
				$liHay = 1;	
				$lsEstatus=1;
			}else{
				$liHay = 0;
			}
		
			break;

				
    }    	 	


		header('Content-type: text/javascript');
		$json = array( "lsCod_Combo" => $lsCod_Combo, "lsCod_Foraneo" => $lsCod_Foraneo, "lsDescripcion" => $lsDescripcion, "lsEstatus" => $lsEstatus, "lsOperacion" => $lsOperacion, "liHay" => $liHay, "liError" => $liError);
		
		$envi = array("Solici"=>$json);

		echo json_encode( $envi );
		

?>






