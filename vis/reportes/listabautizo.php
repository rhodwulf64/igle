<?php
  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
require_once("../../clases/claBautismo.php");
require_once("../../clases/clsFuncionesGlobales.php");
require("../../pdf/fpdf.php");


class PDF extends FPDF{		

function Header()
{
	$loFuncion =new clsFunciones();

    // Logo
    $this->Image('../../logos/encabezado.png',5,5,200,0,'','localhost/iglesia/vis/lista_bautizos.php');
    // Arial bold 15
	$this->Ln(35);
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
	
    $this->Cell(30,10,'Listado de Bautizos',0,0,'C');
    $this->Ln(10);
    $this->SetFont('Arial','I',8);
    $this->setX(20);
    $this->Cell(40,10,'Fecha: '.$loFuncion->fDameFechaEscrita(date("Y-m-d"))." ".$loFuncion->fDameHoraEstandar(substr(date("d-m-Y H:i:s"),11,8)),0,0,'R');
    // Salto de línea
    $this->Ln(15);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->AliasNbPages();
    $this->Cell(0,10,'Pagina  Nro '.$this->PageNo()." de {nb}",0,0,'C');
}

function CompletaCaracteres($cadena)
{
	
	if (strlen($cadena)>17)
	{
		$cadena=substr($cadena,0,17);
	}
	
	return $cadena;
}

	// Tabla simple
	function BasicTable($header,$data)
	{
		$loFuncion =new clsFunciones();
		$estadoIMG="img/info_verifique.png";
		$w = array(20,35,35,35,35,25);
		$this->SetFont('Arial','B',14);
		for($i=0;$i<count($header);$i++)
		{
			$this->Cell($w[$i],7,$header[$i],1,0,'C');
			
		}
		
		$this->ln();
		
		for($z=0;$z<count($data);$z++)
		{
		$x=$z;
			$lsEstadoBauti=$data[$z]['Estatus'];
			$BienPueda="0";

			if (($lsEstadoBauti==$_POST["option0"])&&($_POST["option0"]!=""))
			{
				$BienPueda="1";
			}
			if (($lsEstadoBauti==$_POST["option1"])&&($_POST["option1"]!=""))
			{
				$BienPueda="1";
			}
			if (($_POST["option0"]=="")&&($_POST["option1"]==""))
			{
				$_POST["option0"]="0";
				$_POST["option1"]="1";
				$BienPueda="1";
			}



			if ($BienPueda=="1")
			{
				switch ($lsEstadoBauti)
				{
				    case "0":
				       	$estadoIMG="img/info_nobautizado.png";
				    break;
				    case "1":
				       	$estadoIMG="img/info_bautizado.png";
		        	break;
	        	}


	        		$this->SetFont('Arial','',8);
					$this->Cell($w[0],7,$this->CompletaCaracteres($data[$z]['ReferenciaInfante']),1,0,'C');
					$this->Cell($w[1],7,$loFuncion->fDameFechaEscrita(substr($data[$z]['FechaBautizo'], 0, 10)),1,0,'C');
					$this->Cell($w[3],7,$this->CompletaCaracteres($data[$z]['NombresBau']." ".$data[$z]['ApellidosBau']),1,0,'C');
					$this->Cell($w[4],7,$this->CompletaCaracteres($data[$z]['SexoBauDescrip']),1,0,'C');
					$this->Cell($w[2],7,$this->CompletaCaracteres($data[$z]['NombreFullRepre']),1,0,'C');
					$da=$this->getY();
					$this->Cell($w[5],7,$this->Image($estadoIMG,171.3,$da+0.6,0,0,'','../bautismo.php?bautiRef='.$data[$z]['ReferenciaInfante']),1,0,'C');
					$this->Ln(7);
			
			}
		}

		$this->Ln(10);
	    $this->SetFont('Arial','I',8);
	    $this->setX(20);
	    $this->Cell(40,10,'Usuario: '.$_SESSION["nombreUsuario"]." (".$_SESSION["rolNombre"].")",0,0,'L');
		
	
	}

}

$objC=new claBautismo();
$objC->asFechaInicioR=$_POST["f_Inicio"];
$objC->asFechaFinR=$_POST["f_Fin"];
$arregloCl = $objC->faListarBautizos();
$header = array('Ref',' Fecha Bautizo',' Infante', 'Sexo', 'Representante', 'Estado');
$pdf = new PDF();
$pdf->AddPage();
$pdf->BasicTable($header,$arregloCl);
$pdf->Output();
?>
