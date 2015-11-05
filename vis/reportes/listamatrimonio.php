<?php
  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
require_once("../../clases/claMatrimonio.php");
require_once("../../clases/clsFuncionesGlobales.php");
require("../../pdf/fpdf.php");


class PDF extends FPDF{		

function Header()
{
	$loFuncion =new clsFunciones();

    // Logo
    $this->Image('../../logos/encabezado.png',5,5,200,0,'','localhost/iglesia/vis/lista_matrimonios.php');
    // Arial bold 15
	$this->Ln(35);
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
	
    $this->Cell(30,10,'Listado de matrimonios',0,0,'C');
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
			$lsEstadoMatri=$data[$z]['EstadoMatrimonio'];
			$BienPueda="0";

			if (($lsEstadoMatri==$_POST["option0"])&&($_POST["option0"]!=""))
			{
				$BienPueda="1";
			}
			if (($lsEstadoMatri==$_POST["option1"])&&($_POST["option1"]!=""))
			{
				$BienPueda="1";
			}
			if (($lsEstadoMatri==$_POST["option2"])&&($_POST["option2"]!=""))
			{
				$BienPueda="1";
			}
			if (($lsEstadoMatri==$_POST["option3"])&&($_POST["option3"]!=""))
			{
				$BienPueda="1";
			}
			if (($_POST["option0"]=="")&&($_POST["option1"]=="")&&($_POST["option2"]=="")&&($_POST["option3"]==""))
			{
				$_POST["option0"]="0";
				$_POST["option1"]="1";
				$_POST["option2"]="2";
				$_POST["option3"]="3";
				$BienPueda="1";
			}



			if (($data[$z]['FechaMatrimonio']>=$_POST["f_Inicio"])&&($data[$z]['FechaMatrimonio']<=$_POST["f_Fin"])&&$BienPueda=="1")
			{
			switch ($lsEstadoMatri)
			{
			    case "0":
			       	$estadoIMG="img/info_pendiente.png";
			    break;

			    case "1":
			       	$estadoIMG="img/info_casados.png";
			    break;

			    case "2":
			       	$estadoIMG="img/info_suspendido.png";
	        	break;

			    case "3":
			       	$estadoIMG="img/info_anulado.png";
	        	break;
        	}


        		$this->SetFont('Arial','',8);
				$this->Cell($w[0],7,$this->CompletaCaracteres($data[$z]['ReferenciaMatrimonio']),1,0,'C');
				$this->Cell($w[1],7,$loFuncion->fDameFechaEscrita(substr($data[$z]['FechaMatrimonio'], 0, 10)),1,0,'C');
				$this->Cell($w[2],7,$this->CompletaCaracteres($data[$z]['Nombnovia']." ".$data[$z]['Apellnovia']),1,0,'C');
				$this->Cell($w[3],7,$this->CompletaCaracteres($data[$z]['Nombnovio']." ".$data[$z]['Apellnovio']),1,0,'C');
				$this->Cell($w[4],7,$this->CompletaCaracteres($data[$z]['Motivo']),1,0,'C');
				$da=$this->getY();
				$this->Cell($w[5],7,$this->Image($estadoIMG,171.3,$da+0.6,0,0,'','../matrimonio.php?matriRef='.$data[$z]['ReferenciaMatrimonio']),1,0,'C');
				$this->Ln(7);
		
			}
		}

		$this->Ln(10);
	    $this->SetFont('Arial','I',8);
	    $this->setX(20);
	    $this->Cell(40,10,'Usuario: '.$_SESSION["nombreUsuario"]." (".$_SESSION["rolNombre"].")",0,0,'L');
		
	
	}

}
$objC=new claMatrimonio();

$arregloCl = $objC->faListarMatrimonios();
$header = array('Ref',' Fecha',' Novia', 'Novio', 'Motivo', 'Estado');
$pdf = new PDF();
$pdf->AddPage();
$pdf->BasicTable($header,$arregloCl);
$pdf->Output();
?>
