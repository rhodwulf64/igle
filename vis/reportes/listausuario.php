<?php
  session_start();
  if(!array_key_exists("usuario", $_SESSION)) 
	{
	header("location: visSalir.php");
	}
require_once("../../clases/claUser.php");
require_once("../../clases/clsFuncionesGlobales.php");
require("../../pdf/fpdf.php");
class PDF extends FPDF{		

function Header()
{
	$loFuncion =new clsFunciones();
    // Logo
    $this->Image('../../logos/encabezado.png',5,5,200);
    // Arial bold 15
	$this->Ln(35);
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
	
    $this->Cell(30,10,'Listado de usuarios',0,0,'C');
    // Salto de línea
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

	// Tabla simple
	function BasicTable($header,$data)
	{
		$w = array(20,25,30,30,50,40);
		  $this->SetFont('Arial','B',12);
		for($i=0;$i<count($header);$i++)
		{
			$this->Cell($w[$i],7,$header[$i],1,0,'L');
			
		}
		
		$this->ln();
		
		for($x=0;$x<count($data);$x++)
		{

			if (($_POST["cmb_rol"]==$data[$x]['RolID'])||($_POST["cmb_rol"]==""))
			{

				$this->SetFont('Arial','',10);
				$this->Cell($w[0],7,$data[$x]['Usuario'],1,0,'L');
				$this->Cell($w[1],7,$data[$x]['Nombres'],1,0,'L');
				$this->Cell($w[2],7,$data[$x]['Apellidos'],1,0,'L');
				$this->Cell($w[3],7,$data[$x]['Sexo'],1,0,'L');
				$this->Cell($w[4],7,$data[$x]['RolDesc'],1,0,'L');
				$this->ln();

			}
		}

		$this->Ln(10);
	    $this->SetFont('Arial','I',8);
	    $this->setX(20);
	    $this->Cell(40,10,'Usuario: '.$_SESSION["nombreUsuario"]." (".$_SESSION["rolNombre"].")",0,0,'L');	
		
        
	
	}

}

$objC = new claUser;
$arregloCl = $objC->faListar();
$header = array('Usuario',' Nombre', 'Apellido', 'Sexo', 'Rol');
$pdf = new PDF();
$pdf->AddPage();
$pdf->BasicTable($header,$arregloCl);
$pdf->Output();
?>
